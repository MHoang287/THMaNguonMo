<?php require_once 'app/views/shares/header.php'; ?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
        </ol>
    </div>
</nav>

<!-- Cart Section -->
<section class="py-5">
    <div class="container">
        <?php if(empty($cart)): ?>
            <!-- Empty Cart -->
            <div class="text-center py-5" data-aos="fade-up">
                <i class="bi bi-cart-x display-1 text-muted"></i>
                <h3 class="mt-4">Giỏ hàng trống</h3>
                <p class="text-muted">Bạn chưa có sản phẩm nào trong giỏ hàng</p>
                <a href="/Product" class="btn btn-primary btn-lg mt-3">
                    <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
                </a>
            </div>
        <?php else: ?>
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8" data-aos="fade-right">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">
                                <i class="bi bi-cart3"></i> Giỏ hàng của bạn 
                                <span class="badge bg-primary rounded-pill"><?= count($cart) ?> sản phẩm</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-end">Giá</th>
                                            <th class="text-end">Tổng</th>
                                            <th width="50"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $total = 0;
                                        foreach($cart as $id => $item): 
                                            $subtotal = $item['price'] * $item['quantity'];
                                            $total += $subtotal;
                                        ?>
                                            <tr class="cart-item" data-aos="fade-up">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <?php if(isset($item['image']) && $item['image']): ?>
                                                            <img src="<?= htmlspecialchars($item['image']) ?>" 
                                                                 alt="<?= htmlspecialchars($item['name']) ?>" 
                                                                 class="img-thumbnail me-3"
                                                                 style="width: 80px; height: 80px; object-fit: cover;">
                                                        <?php else: ?>
                                                            <img src="https://via.placeholder.com/80x80/f8f9fa/6c757d?text=No+Image" 
                                                                 alt="No Image" 
                                                                 class="img-thumbnail me-3"
                                                                 style="width: 80px; height: 80px;">
                                                        <?php endif; ?>
                                                        <div>
                                                            <h6 class="mb-0"><?= htmlspecialchars($item['name']) ?></h6>
                                                            <small class="text-muted">Mã SP: #<?= $id ?></small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="quantity-control d-flex justify-content-center align-items-center">
                                                        <form action="/Product/updateCartQuantity" method="POST" class="d-inline">
                                                            <input type="hidden" name="product_id" value="<?= $id ?>">
                                                            <input type="hidden" name="action" value="decrease">
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                                <i class="bi bi-dash"></i>
                                                            </button>
                                                        </form>
                                                        <span class="mx-3 fw-bold"><?= $item['quantity'] ?></span>
                                                        <form action="/Product/updateCartQuantity" method="POST" class="d-inline">
                                                            <input type="hidden" name="product_id" value="<?= $id ?>">
                                                            <input type="hidden" name="action" value="increase">
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                                <i class="bi bi-plus"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <?= number_format($item['price'], 0, ',', '.') ?>₫
                                                </td>
                                                <td class="text-end fw-bold text-primary">
                                                    <?= number_format($subtotal, 0, ',', '.') ?>₫
                                                </td>
                                                <td class="text-center">
                                                    <a href="/Product/removeFromCart/<?= $id ?>" 
                                                       class="btn btn-sm btn-outline-danger"
                                                       onclick="return confirmRemove()">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Cart Actions -->
                            <div class="d-flex justify-content-between mt-3">
                                <a href="/Product" class="btn btn-outline-primary">
                                    <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
                                </a>
                                <button class="btn btn-outline-danger" onclick="clearCart()">
                                    <i class="bi bi-trash"></i> Xóa toàn bộ
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Coupon Section -->
                    <div class="card shadow-sm mt-4" data-aos="fade-up">
                        <div class="card-body">
                            <h6 class="mb-3"><i class="bi bi-ticket-perforated"></i> Mã giảm giá</h6>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nhập mã giảm giá">
                                <button class="btn btn-primary" type="button">Áp dụng</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4" data-aos="fade-left">
                    <div class="card shadow-sm sticky-top" style="top: 20px;">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-receipt"></i> Tóm tắt đơn hàng</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <span><?= number_format($total, 0, ',', '.') ?>₫</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Phí vận chuyển:</span>
                                <span class="text-success">Miễn phí</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Giảm giá:</span>
                                <span>0₫</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <strong>Tổng cộng:</strong>
                                <strong class="text-primary fs-5"><?= number_format($total, 0, ',', '.') ?>₫</strong>
                            </div>
                            
                            <div class="d-grid">
                                <a href="/Product/checkout" class="btn btn-primary btn-lg mb-2">
                                    <i class="bi bi-credit-card"></i> Tiến hành thanh toán
                                </a>
                                <button class="btn btn-success btn-lg" onclick="quickCheckout()">
                                    <i class="bi bi-lightning"></i> Thanh toán nhanh
                                </button>
                            </div>
                            
                            <!-- Features -->
                            <div class="mt-4">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-shield-check text-success me-2"></i>
                                    <small>Thanh toán an toàn & bảo mật</small>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-truck text-primary me-2"></i>
                                    <small>Miễn phí vận chuyển đơn từ 500k</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-arrow-repeat text-warning me-2"></i>
                                    <small>Đổi trả trong 7 ngày</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recommended Products -->
                    <div class="card shadow-sm mt-4" data-aos="fade-up">
                        <div class="card-header bg-white">
                            <h6 class="mb-0"><i class="bi bi-stars"></i> Gợi ý cho bạn</h6>
                        </div>
                        <div class="card-body p-2">
                            <?php for($i = 1; $i <= 2; $i++): ?>
                                <div class="d-flex align-items-center p-2 border-bottom">
                                    <img src="https://via.placeholder.com/60x60/<?= dechex(rand(0x000000, 0xFFFFFF)) ?>/FFFFFF?text=<?= $i ?>" 
                                         class="img-thumbnail me-2" 
                                         style="width: 60px; height: 60px;">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 small">Sản phẩm gợi ý <?= $i ?></h6>
                                        <small class="text-primary"><?= number_format(rand(500000, 5000000), 0, ',', '.') ?>₫</small>
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
.cart-item {
    transition: all 0.3s ease;
}

.cart-item:hover {
    background-color: #f8f9fa;
}

.quantity-control button {
    width: 30px;
    height: 30px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.sticky-top {
    z-index: 100;
}
</style>

<?php
$additionalScripts = '
<script>
// Confirm remove item
function confirmRemove() {
    return confirm("Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?");
}

// Clear entire cart
function clearCart() {
    Swal.fire({
        title: "Xóa toàn bộ giỏ hàng?",
        text: "Bạn có chắc muốn xóa tất cả sản phẩm trong giỏ hàng?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa tất cả",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            // Implement clear cart functionality
            window.location.href = "/Product/clearCart";
        }
    });
}

// Quick checkout
function quickCheckout() {
    Swal.fire({
        title: "Thanh toán nhanh",
        text: "Tính năng này sẽ giúp bạn thanh toán nhanh chóng với thông tin đã lưu",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Tiếp tục",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/Product/quickCheckout";
        }
    });
}

// Animate cart items on load
document.addEventListener("DOMContentLoaded", function() {
    anime({
        targets: ".cart-item",
        translateX: [-50, 0],
        opacity: [0, 1],
        delay: anime.stagger(100),
        duration: 600,
        easing: "easeOutQuad"
    });
});

// Update cart count in header when quantity changes
$(".quantity-control form").on("submit", function(e) {
    // Show loading spinner
    $(this).find("button").html(\'<span class="spinner-border spinner-border-sm"></span>\');
});
</script>
';
?>

<?php require_once 'app/views/shares/footer.php'; ?>