<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');

class ProductController {
    private $productModel;
    private $db;
    
    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function index() {
        $products = $this->productModel->getProducts();
        include 'app/views/product/list.php';
    }

    public function show($id) {
        $product = $this->productModel->getProductById($id);

        if ($product) {
            include 'app/views/product/show.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function add() {
        $categories = (new CategoryModel($this->db))->getCategories();
        include_once 'app/views/product/add.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = $this->uploadImage($_FILES['image']);
            } else {
                $image = "";
            }

            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);

            if (is_array($result)) {
                $errors = $result;
                $categories = (new CategoryModel($this->db))->getCategories();
                include 'app/views/product/add.php';
            } else {
                header('Location: /Product');
            }
        }
    }

    public function edit($id) {
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();
        
        if ($product) {
            include 'app/views/product/edit.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = $this->uploadImage($_FILES['image']);
            } else {
                $image = $_POST['existing_image'];
            } 

            $edit = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);

            if ($edit) {
                header('Location: /Product');
            } else {
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }
        }
    }

    public function delete($id) {
        if ($this->productModel->deleteProduct($id)) {
            header('Location: /Product');
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    }

    private function uploadImage($file) {
        $target_dir = "uploads/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($file["tmp_name"]);

        if ($check === false) {
            throw new Exception("File không phải là hình ảnh.");
        }

        if ($file["size"] > 10 * 1024 * 1024) {
            throw new Exception("Hình ảnh có kích thước quá lớn.");
        }

        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            throw new Exception("Chỉ cho phép các định dạng JPG, JPEG, PNG và GIF.");
        }
        
        if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            throw new Exception("Có lỗi xảy ra khi tải lên hình ảnh.");
        }

        return $target_file;
    }

    public function addToCart($id)
    {
        $product = $this->productModel->getProductById($id);

        if (!$product) {
            if ($this->isAjaxRequest()) {
                $this->returnJsonResponse(false, 'Không tìm thấy sản phẩm.');
                return;
            }
            echo "Không tìm thấy sản phẩm.";
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        if ($this->isAjaxRequest()) {
            $cartInfo = $this->calculateCartTotal();
            $this->returnJsonResponse(true, 'Đã thêm sản phẩm vào giỏ hàng.', [
                'cart_count' => count($_SESSION['cart']),
                'cart_total' => $cartInfo['total'],
                'product_name' => $product->name
            ]);
            return;
        }

        header('Location: /Product/cart');
    }

    public function cart()
    {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $cartInfo = $this->calculateCartTotal();
        include 'app/views/product/cart.php';
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng
     */
    public function updateCartQuantity()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            if ($this->isAjaxRequest()) {
                $this->returnJsonResponse(false, 'Invalid request method.');
                return;
            }
            header('Location: /Product/cart');
            return;
        }

        $productId = $_POST['product_id'] ?? null;
        $quantity = (int)($_POST['quantity'] ?? 0);

        if (!$productId || $quantity < 1) {
            if ($this->isAjaxRequest()) {
                $this->returnJsonResponse(false, 'Dữ liệu không hợp lệ.');
                return;
            }
            header('Location: /Product/cart');
            return;
        }

        if (!isset($_SESSION['cart']) || !isset($_SESSION['cart'][$productId])) {
            if ($this->isAjaxRequest()) {
                $this->returnJsonResponse(false, 'Sản phẩm không có trong giỏ hàng.');
                return;
            }
            header('Location: /Product/cart');
            return;
        }

        // Kiểm tra số lượng tối đa (có thể lấy từ database)
        $maxQuantity = 99; // Hoặc lấy từ product model
        if ($quantity > $maxQuantity) {
            if ($this->isAjaxRequest()) {
                $this->returnJsonResponse(false, "Số lượng tối đa là {$maxQuantity}.");
                return;
            }
            header('Location: /Product/cart');
            return;
        }

        // Cập nhật số lượng
        $_SESSION['cart'][$productId]['quantity'] = $quantity;

        if ($this->isAjaxRequest()) {
            $cartInfo = $this->calculateCartTotal();
            $itemTotal = $_SESSION['cart'][$productId]['price'] * $_SESSION['cart'][$productId]['quantity'];
            
            $this->returnJsonResponse(true, 'Đã cập nhật số lượng.', [
                'item_total' => number_format($itemTotal),
                'cart_subtotal' => number_format($cartInfo['subtotal']),
                'cart_total' => number_format($cartInfo['total']),
                'cart_count' => array_sum(array_column($_SESSION['cart'], 'quantity'))
            ]);
            return;
        }

        header('Location: /Product/cart');
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng
     */
    public function removeFromCart($productId = null)
    {
        if (!$productId) {
            $productId = $_POST['product_id'] ?? null;
        }

        if (!$productId) {
            if ($this->isAjaxRequest()) {
                $this->returnJsonResponse(false, 'ID sản phẩm không hợp lệ.');
                return;
            }
            header('Location: /Product/cart');
            return;
        }

        if (!isset($_SESSION['cart']) || !isset($_SESSION['cart'][$productId])) {
            if ($this->isAjaxRequest()) {
                $this->returnJsonResponse(false, 'Sản phẩm không có trong giỏ hàng.');
                return;
            }
            header('Location: /Product/cart');
            return;
        }

        $productName = $_SESSION['cart'][$productId]['name'];
        unset($_SESSION['cart'][$productId]);

        if ($this->isAjaxRequest()) {
            $cartInfo = $this->calculateCartTotal();
            $this->returnJsonResponse(true, "Đã xóa {$productName} khỏi giỏ hàng.", [
                'cart_count' => count($_SESSION['cart']),
                'cart_subtotal' => number_format($cartInfo['subtotal']),
                'cart_total' => number_format($cartInfo['total']),
                'is_empty' => empty($_SESSION['cart'])
            ]);
            return;
        }

        header('Location: /Product/cart');
    }

    /**
     * Xóa tất cả sản phẩm khỏi giỏ hàng
     */
    public function clearCart()
    {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            if ($this->isAjaxRequest()) {
                $this->returnJsonResponse(false, 'Giỏ hàng đã trống.');
                return;
            }
            header('Location: /Product/cart');
            return;
        }

        $itemCount = count($_SESSION['cart']);
        unset($_SESSION['cart']);

        if ($this->isAjaxRequest()) {
            $this->returnJsonResponse(true, "Đã xóa {$itemCount} sản phẩm khỏi giỏ hàng.", [
                'cart_count' => 0,
                'cart_subtotal' => 0,
                'cart_total' => 0,
                'is_empty' => true
            ]);
            return;
        }

        header('Location: /Product/cart');
    }

    /**
     * Tính tổng tiền giỏ hàng
     */
    private function calculateCartTotal()
    {
        $cart = $_SESSION['cart'] ?? [];
        $subtotal = 0;
        $itemCount = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
            $itemCount += $item['quantity'];
        }

        // Tính phí vận chuyển (miễn phí từ 1 triệu)
        $shippingFee = ($subtotal >= 1000000) ? 0 : 30000;

        // Tính thuế VAT 10%
        $taxRate = 0.10;
        $taxAmount = $subtotal * $taxRate;

        // Giảm giá (có thể implement logic phức tạp hơn)
        $discountAmount = 0;

        $total = $subtotal + $shippingFee + $taxAmount - $discountAmount;

        return [
            'subtotal' => $subtotal,
            'shipping_fee' => $shippingFee,
            'tax_amount' => $taxAmount,
            'tax_rate' => $taxRate,
            'discount_amount' => $discountAmount,
            'total' => $total,
            'item_count' => $itemCount,
            'product_count' => count($cart)
        ];
    }

    /**
     * Áp dụng mã giảm giá
     */
    public function applyCoupon()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            if ($this->isAjaxRequest()) {
                $this->returnJsonResponse(false, 'Invalid request method.');
                return;
            }
            header('Location: /Product/cart');
            return;
        }

        $couponCode = trim($_POST['coupon_code'] ?? '');

        if (empty($couponCode)) {
            if ($this->isAjaxRequest()) {
                $this->returnJsonResponse(false, 'Vui lòng nhập mã giảm giá.');
                return;
            }
            header('Location: /Product/cart');
            return;
        }

        // Danh sách mã giảm giá mẫu (trong thực tế sẽ lấy từ database)
        $validCoupons = [
            'TECHTAFU10' => ['discount' => 0.10, 'type' => 'percentage', 'min_amount' => 500000],
            'SAVE50K' => ['discount' => 50000, 'type' => 'fixed', 'min_amount' => 1000000],
            'NEWUSER' => ['discount' => 0.15, 'type' => 'percentage', 'min_amount' => 0],
        ];

        $cartInfo = $this->calculateCartTotal();

        if (!isset($validCoupons[$couponCode])) {
            if ($this->isAjaxRequest()) {
                $this->returnJsonResponse(false, 'Mã giảm giá không hợp lệ.');
                return;
            }
            header('Location: /Product/cart');
            return;
        }

        $coupon = $validCoupons[$couponCode];

        if ($cartInfo['subtotal'] < $coupon['min_amount']) {
            $minAmountFormatted = number_format($coupon['min_amount']);
            if ($this->isAjaxRequest()) {
                $this->returnJsonResponse(false, "Đơn hàng tối thiểu {$minAmountFormatted}đ để sử dụng mã này.");
                return;
            }
            header('Location: /Product/cart');
            return;
        }

        // Tính giảm giá
        if ($coupon['type'] === 'percentage') {
            $discountAmount = $cartInfo['subtotal'] * $coupon['discount'];
        } else {
            $discountAmount = $coupon['discount'];
        }

        // Lưu thông tin coupon vào session
        $_SESSION['applied_coupon'] = [
            'code' => $couponCode,
            'discount_amount' => $discountAmount,
            'type' => $coupon['type'],
            'discount_rate' => $coupon['discount']
        ];

        if ($this->isAjaxRequest()) {
            // Tính lại tổng tiền với coupon
            $newTotal = $cartInfo['total'] - $discountAmount;
            $this->returnJsonResponse(true, 'Đã áp dụng mã giảm giá thành công!', [
                'discount_amount' => number_format($discountAmount),
                'new_total' => number_format($newTotal),
                'coupon_code' => $couponCode
            ]);
            return;
        }

        header('Location: /Product/cart');
    }

    /**
     * Xóa mã giảm giá
     */
    public function removeCoupon()
    {
        unset($_SESSION['applied_coupon']);

        if ($this->isAjaxRequest()) {
            $cartInfo = $this->calculateCartTotal();
            $this->returnJsonResponse(true, 'Đã xóa mã giảm giá.', [
                'cart_total' => number_format($cartInfo['total'])
            ]);
            return;
        }

        header('Location: /Product/cart');
    }

    /**
     * Lấy thông tin giỏ hàng (AJAX)
     */
    public function getCartInfo()
    {
        if (!$this->isAjaxRequest()) {
            header('Location: /Product/cart');
            return;
        }

        $cart = $_SESSION['cart'] ?? [];
        $cartInfo = $this->calculateCartTotal();

        $this->returnJsonResponse(true, 'Cart info retrieved.', [
            'cart' => $cart,
            'cart_info' => $cartInfo,
            'applied_coupon' => $_SESSION['applied_coupon'] ?? null
        ]);
    }

    /**
     * Kiểm tra xem có phải AJAX request không
     */
    private function isAjaxRequest()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    /**
     * Trả về JSON response
     */
    private function returnJsonResponse($success, $message, $data = [])
    {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ]);
        exit;
    }

    public function checkout()
    {
        // Kiểm tra giỏ hàng
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            header('Location: /Product/cart');
            return;
        }

        $cartInfo = $this->calculateCartTotal();
        include 'app/views/product/checkout.php';
    }

    public function processCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';

            // Kiểm tra giỏ hàng
            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo "Giỏ hàng trống.";
                return;
            }

            // Bắt đầu giao dịch
            $this->db->beginTransaction();

            try {
                $cartInfo = $this->calculateCartTotal();
                
                // Lưu thông tin đơn hàng vào bảng orders
                $query = "INSERT INTO orders (name, phone, address, total_amount) VALUES (:name, :phone, :address, :total_amount)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':total_amount', $cartInfo['total']);
                $stmt->execute();
                $order_id = $this->db->lastInsertId();

                // Lưu chi tiết đơn hàng vào bảng order_details
                $cart = $_SESSION['cart'];
                foreach ($cart as $product_id => $item) {
                    $query = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':order_id', $order_id);
                    $stmt->bindParam(':product_id', $product_id);
                    $stmt->bindParam(':quantity', $item['quantity']);
                    $stmt->bindParam(':price', $item['price']);
                    $stmt->execute();
                }

                // Lưu thông tin đơn hàng vào session để hiển thị ở trang confirmation
                $_SESSION['last_order'] = [
                    'order_id' => $order_id,
                    'cart_info' => $cartInfo,
                    'customer_info' => [
                        'name' => $name,
                        'phone' => $phone,
                        'address' => $address
                    ],
                    'cart_items' => $cart
                ];

                // Xóa giỏ hàng và coupon sau khi đặt hàng thành công
                unset($_SESSION['cart']);
                unset($_SESSION['applied_coupon']);

                // Commit giao dịch
                $this->db->commit();

                // Chuyển hướng đến trang xác nhận đơn hàng
                header('Location: /Product/orderConfirmation');
            } catch (Exception $e) {
                // Rollback giao dịch nếu có lỗi
                $this->db->rollBack();
                echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage();
            }
        }
    }

    public function orderConfirmation()
    {
        include 'app/views/product/orderConfirmation.php';
    }

    public function list() {
        $products = $this->productModel->getProducts();
        require_once 'app/views/product/list.php';
    }
}
?>