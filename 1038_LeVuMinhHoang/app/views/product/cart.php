<?php
$title = "Giỏ hàng";
include_once 'app/views/shares/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="/Product" class="text-white-50">Trang chủ</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Giỏ hàng</li>
                    </ol>
                </nav>
                <h1 class="h2 mb-0 animate__animated animate__fadeInLeft">
                    <i class="fas fa-shopping-cart me-2"></i>Giỏ hàng của bạn
                </h1>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="/Product" class="btn btn-outline-light animate__animated animate__fadeInRight">
                    <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <?php if (empty($cart)): ?>
        <!-- Empty Cart -->
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5" data-aos="fade-up">
                    <div class="mb-4">
                        <i class="fas fa-shopping-cart text-muted" style="font-size: 6rem; opacity: 0.3;"></i>
                    </div>
                    <h3 class="text-muted mb-3">Giỏ hàng của bạn đang trống</h3>
                    <p class="text-muted mb-4">Hãy thêm một số sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
                    <a href="/Product" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i>Bắt đầu mua sắm
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Cart Items -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg" data-aos="fade-right">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-list me-2"></i>Sản phẩm trong giỏ hàng (<?php echo count($cart); ?> sản phẩm)
                        </h5>
                    </div>
                    
                    <div class="card-body p-0">
                        <?php 
                        $total = 0;
                        foreach ($cart as $productId => $item): 
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        ?>
                            <div class="cart-item border-bottom p-4" data-product-id="<?php echo $productId; ?>">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <?php if (!empty($item['image']) && file_exists($item['image'])): ?>
                                            <img src="/<?php echo htmlspecialchars($item['image']); ?>" 
                                                 class="img-thumbnail" 
                                                 alt="<?php echo htmlspecialchars($item['name']); ?>"
                                                 style="width: 80px; height: 80px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 80px; height: 80px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h6 class="mb-1 fw-bold">
                                            <?php echo htmlspecialchars($item['name']); ?>
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            Đơn giá: <span class="fw-bold text-primary">
                                                <?php echo number_format($item['price'], 0, ',', '.'); ?>₫
                                            </span>
                                        </p>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="input-group input-group-sm">
                                            <button class="btn btn-outline-secondary" type="button" 
                                                    onclick="updateQuantity(<?php echo $productId; ?>, -1)">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control text-center quantity-input" 
                                                   value="<?php echo $item['quantity']; ?>" 
                                                   data-product-id="<?php echo $productId; ?>"
                                                   onchange="updateQuantity(<?php echo $productId; ?>, 0, this.value)"
                                                   readonly>
                                            <button class="btn btn-outline-secondary" type="button" 
                                                    onclick="updateQuantity(<?php echo $productId; ?>, 1)">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="text-end">
                                            <div class="fw-bold text-success mb-1">
                                                <?php echo number_format($subtotal, 0, ',', '.'); ?>₫
                                            </div>
                                            <button class="btn btn-outline-danger btn-sm" 
                                                    onclick="removeFromCart(<?php echo $productId; ?>)"
                                                    title="Xóa khỏi giỏ hàng">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="card-footer bg-light py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-outline-danger" onclick="clearCart()">
                                <i class="fas fa-trash me-2"></i>Xóa toàn bộ giỏ hàng
                            </button>
                            <button class="btn btn-outline-primary" onclick="updateAllQuantities()">
                                <i class="fas fa-sync me-2"></i>Cập nhật giỏ hàng
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg sticky-top" data-aos="fade-left" style="top: 100px;">
                    <div class="card-header bg-success text-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-calculator me-2"></i>Tóm tắt đơn hàng
                        </h5>
                    </div>
                    
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <span class="fw-bold"><?php echo number_format($total, 0, ',', '.'); ?>₫</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Phí vận chuyển:</span>
                                <span class="text-success fw-bold">Miễn phí</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Thuế VAT:</span>
                                <span>Đã bao gồm</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="mb-0">Tổng cộng:</h6>
                                <h5 class="mb-0 text-danger">
                                    <?php echo number_format($total, 0, ',', '.'); ?>₫
                                </h5>
                            </div>
                        </div>
                        
                        <!-- Discount Code -->
                        <div class="mb-3">
                            <label for="discountCode" class="form-label small">Mã giảm giá:</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="discountCode" 
                                       placeholder="Nhập mã giảm giá">
                                <button class="btn btn-outline-secondary" type="button" onclick="applyDiscount()">
                                    Áp dụng
                                </button>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="/Product/checkout" class="btn btn-success btn-lg">
                                <i class="fas fa-credit-card me-2"></i>Thanh toán
                            </a>
                            <a href="/Product" class="btn btn-outline-primary">
                                <i class="fas fa-plus me-2"></i>Thêm sản phẩm khác
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-light text-center">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt me-1"></i>
                            Thanh toán an toàn & bảo mật
                        </small>
                    </div>
                </div>
                
                <!-- Delivery Info -->
                <div class="card border-0 shadow-sm mt-3" data-aos="fade-left" data-aos-delay="100">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="fas fa-truck me-2 text-primary"></i>Thông tin giao hàng
                        </h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-1">
                                <i class="fas fa-check text-success me-2"></i>
                                Giao hàng miễn phí toàn quốc
                            </li>
                            <li class="mb-1">
                                <i class="fas fa-check text-success me-2"></i>
                                Giao hàng trong 1-3 ngày
                            </li>
                            <li class="mb-1">
                                <i class="fas fa-check text-success me-2"></i>
                                Kiểm tra hàng khi nhận
                            </li>
                            <li>
                                <i class="fas fa-check text-success me-2"></i>
                                Đổi trả trong 7 ngày
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    // Update quantity function
    function updateQuantity(productId, change, newValue = null) {
        const quantityInput = document.querySelector(`input[data-product-id="${productId}"]`);
        let currentQuantity = parseInt(quantityInput.value);
        let newQuantity;
        
        if (newValue !== null) {
            newQuantity = parseInt(newValue) || 1;
        } else {
            newQuantity = currentQuantity + change;
        }
        
        if (newQuantity < 1) {
            newQuantity = 1;
        }
        
        if (newQuantity > 99) {
            newQuantity = 99;
            toastr.warning('Số lượng tối đa là 99');
        }
        
        quantityInput.value = newQuantity;
        
        // Update cart via AJAX (if implemented)
        // For now, just update the display
        updateCartDisplay(productId, newQuantity);
    }

    // Update cart display
    function updateCartDisplay(productId, quantity) {
        const cartItem = document.querySelector(`[data-product-id="${productId}"]`);
        const priceElement = cartItem.querySelector('.text-muted .fw-bold');
        const subtotalElement = cartItem.querySelector('.text-success');
        
        if (priceElement && subtotalElement) {
            const price = parseInt(priceElement.textContent.replace(/[^\d]/g, ''));
            const newSubtotal = price * quantity;
            
            subtotalElement.textContent = new Intl.NumberFormat('vi-VN').format(newSubtotal) + '₫';
            
            // Update total
            updateTotal();
        }
    }

    // Update total calculation
    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const subtotalElement = item.querySelector('.text-success');
            const subtotal = parseInt(subtotalElement.textContent.replace(/[^\d]/g, ''));
            total += subtotal;
        });
        
        // Update all total displays
        const totalElements = document.querySelectorAll('.text-danger h5, .fw-bold');
        totalElements.forEach(element => {
            if (element.textContent.includes('₫')) {
                element.textContent = new Intl.NumberFormat('vi-VN').format(total) + '₫';
            }
        });
    }

    // Remove item from cart
    function removeFromCart(productId) {
        Swal.fire({
            title: 'Xóa sản phẩm',
            text: 'Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                const cartItem = document.querySelector(`[data-product-id="${productId}"]`);
                if (cartItem) {
                    cartItem.style.transition = 'all 0.3s ease';
                    cartItem.style.opacity = '0';
                    cartItem.style.transform = 'translateX(-100%)';
                    
                    setTimeout(() => {
                        cartItem.remove();
                        updateTotal();
                        
                        // Check if cart is empty
                        if (document.querySelectorAll('.cart-item').length === 0) {
                            location.reload();
                        }
                        
                        toastr.success('Đã xóa sản phẩm khỏi giỏ hàng');
                    }, 300);
                }
            }
        });
    }

    // Clear entire cart
    function clearCart() {
        Swal.fire({
            title: 'Xóa toàn bộ giỏ hàng',
            text: 'Bạn có chắc chắn muốn xóa tất cả sản phẩm trong giỏ hàng?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Xóa tất cả',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                // Clear cart session via AJAX or form submission
                showLoading();
                // Simulate clearing cart
                setTimeout(() => {
                    hideLoading();
                    location.reload();
                }, 1000);
            }
        });
    }

    // Apply discount code
    function applyDiscount() {
        const discountCode = document.getElementById('discountCode').value.trim();
        
        if (!discountCode) {
            toastr.warning('Vui lòng nhập mã giảm giá');
            return;
        }
        
        showLoading();
        
        // Simulate discount validation
        setTimeout(() => {
            hideLoading();
            
            // Mock discount codes
            const validCodes = {
                'TECHTAFU10': 10,
                'WELCOME20': 20,
                'SALE30': 30
            };
            
            if (validCodes[discountCode.toUpperCase()]) {
                const discount = validCodes[discountCode.toUpperCase()];
                toastr.success(`Áp dụng thành công mã giảm giá ${discount}%`);
                
                // Apply discount to UI
                const discountRow = document.createElement('div');
                discountRow.className = 'd-flex justify-content-between mb-2 text-success';
                discountRow.innerHTML = `
                    <span>Giảm giá (${discountCode.toUpperCase()}):</span>
                    <span class="fw-bold">-${discount}%</span>
                `;
                
                const hrElement = document.querySelector('.card-body hr');
                hrElement.parentNode.insertBefore(discountRow, hrElement);
                
                // Disable discount input
                document.getElementById('discountCode').disabled = true;
                document.querySelector('button[onclick="applyDiscount()"]').disabled = true;
                
            } else {
                toastr.error('Mã giảm giá không hợp lệ hoặc đã hết hạn');
            }
        }, 1500);
    }

    // Update all quantities
    function updateAllQuantities() {
        toastr.info('Đã cập nhật giỏ hàng');
        updateTotal();
    }

    // Auto-save cart changes
    let cartUpdateTimeout;
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('quantity-input')) {
            clearTimeout(cartUpdateTimeout);
            cartUpdateTimeout = setTimeout(() => {
                // Auto-save cart changes
                console.log('Auto-saving cart changes...');
            }, 2000);
        }
    });

    // Checkout validation
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutBtn = document.querySelector('a[href="/Product/checkout"]');
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', function(e) {
                const cartItems = document.querySelectorAll('.cart-item');
                if (cartItems.length === 0) {
                    e.preventDefault();
                    toastr.error('Giỏ hàng trống, không thể thanh toán');
                }
            });
        }
    });

    // Quantity input validation
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('blur', function() {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            } else if (value > 99) {
                this.value = 99;
            }
            
            const productId = this.dataset.productId;
            updateCartDisplay(productId, parseInt(this.value));
        });
    });
</script>

<?php include_once 'app/views/shares/footer.php'; ?>