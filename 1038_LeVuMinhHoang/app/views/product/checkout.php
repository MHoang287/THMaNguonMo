<?php 
$title = "Thanh toán - TechTafu";
include 'app/views/shares/header.php'; 

// Get cart data
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" data-aos="fade-right">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản phẩm</a></li>
            <li class="breadcrumb-item"><a href="/Product/cart" class="text-decoration-none">Giỏ hàng</a></li>
            <li class="breadcrumb-item active">Thanh toán</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-1" data-aos="fade-right">
                <i class="fas fa-credit-card text-success me-2"></i>
                Thanh toán đơn hàng
            </h2>
            <p class="text-muted mb-0" data-aos="fade-right" data-aos-delay="100">
                Vui lòng kiểm tra thông tin và hoàn tất đơn hàng
            </p>
        </div>
    </div>

    <?php if (empty($cart)): ?>
        <!-- Empty Cart Redirect -->
        <div class="text-center py-5" data-aos="fade-up">
            <div class="card shadow-sm">
                <div class="card-body py-5">
                    <i class="fas fa-exclamation-triangle fa-5x text-warning mb-4"></i>
                    <h3 class="text-muted mb-3">Giỏ hàng trống</h3>
                    <p class="text-muted mb-4">Bạn cần thêm sản phẩm vào giỏ hàng trước khi thanh toán</p>
                    <a href="/Product" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i>Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <form method="POST" action="/Product/processCheckout" id="checkoutForm" class="needs-validation" novalidate>
            <div class="row">
                <!-- Customer Information -->
                <div class="col-lg-7">
                    <!-- Delivery Information -->
                    <div class="card shadow-sm border-0 mb-4" data-aos="fade-up">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user me-2"></i>
                                Thông tin giao hàng
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label fw-bold">
                                        <i class="fas fa-user text-primary me-2"></i>
                                        Họ và tên <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name" 
                                           placeholder="Nhập họ và tên..." required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập họ và tên
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label fw-bold">
                                        <i class="fas fa-phone text-success me-2"></i>
                                        Số điện thoại <span class="text-danger">*</span>
                                    </label>
                                    <input type="tel" class="form-control form-control-lg" id="phone" name="phone" 
                                           placeholder="Nhập số điện thoại..." required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập số điện thoại hợp lệ
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">
                                    <i class="fas fa-envelope text-info me-2"></i>
                                    Email (tùy chọn)
                                </label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" 
                                       placeholder="Nhập email để nhận thông báo...">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label fw-bold">
                                    <i class="fas fa-map-marker-alt text-warning me-2"></i>
                                    Địa chỉ giao hàng <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="address" name="address" rows="3" 
                                          placeholder="Nhập địa chỉ chi tiết (số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố)..." required></textarea>
                                <div class="invalid-feedback">
                                    Vui lòng nhập địa chỉ giao hàng
                                </div>
                            </div>
                            
                            <!-- Quick Address Selection -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-map text-secondary me-2"></i>
                                    Chọn nhanh địa chỉ
                                </label>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <select class="form-select" id="province">
                                            <option value="">Chọn tỉnh/thành</option>
                                            <option value="Ho Chi Minh">TP. Hồ Chí Minh</option>
                                            <option value="Ha Noi">Hà Nội</option>
                                            <option value="Da Nang">Đà Nẵng</option>
                                            <option value="Can Tho">Cần Thơ</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <select class="form-select" id="district">
                                            <option value="">Chọn quận/huyện</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <select class="form-select" id="ward">
                                            <option value="">Chọn phường/xã</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="note" class="form-label fw-bold">
                                    <i class="fas fa-sticky-note text-secondary me-2"></i>
                                    Ghi chú đơn hàng
                                </label>
                                <textarea class="form-control" id="note" name="note" rows="2" 
                                          placeholder="Ghi chú thêm cho đơn hàng (tùy chọn)..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card shadow-sm border-0 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-credit-card me-2"></i>
                                Phương thức thanh toán
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check p-3 border rounded payment-option">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                        <label class="form-check-label w-100" for="cod">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-money-bill-wave fa-2x text-success me-3"></i>
                                                <div>
                                                    <strong>Thanh toán khi nhận hàng (COD)</strong>
                                                    <small class="d-block text-muted">Thanh toán bằng tiền mặt khi nhận hàng</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check p-3 border rounded payment-option">
                                        <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer">
                                        <label class="form-check-label w-100" for="bank_transfer">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-university fa-2x text-primary me-3"></i>
                                                <div>
                                                    <strong>Chuyển khoản ngân hàng</strong>
                                                    <small class="d-block text-muted">Chuyển khoản trước khi giao hàng</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check p-3 border rounded payment-option">
                                        <input class="form-check-input" type="radio" name="payment_method" id="momo" value="momo">
                                        <label class="form-check-label w-100" for="momo">
                                            <div class="d-flex align-items-center">
                                                <i class="fab fa-cc-paypal fa-2x text-danger me-3"></i>
                                                <div>
                                                    <strong>Ví điện tử MoMo</strong>
                                                    <small class="d-block text-muted">Thanh toán qua ví MoMo</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check p-3 border rounded payment-option">
                                        <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card">
                                        <label class="form-check-label w-100" for="credit_card">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-credit-card fa-2x text-info me-3"></i>
                                                <div>
                                                    <strong>Thẻ tín dụng/ghi nợ</strong>
                                                    <small class="d-block text-muted">Visa, MasterCard, JCB</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Options -->
                    <div class="card shadow-sm border-0" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-shipping-fast me-2"></i>
                                Tùy chọn giao hàng
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check p-3 border rounded shipping-option">
                                        <input class="form-check-input" type="radio" name="shipping_method" id="standard" value="standard" checked>
                                        <label class="form-check-label w-100" for="standard">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong>Giao hàng tiêu chuẩn</strong>
                                                    <small class="d-block text-muted">2-3 ngày làm việc</small>
                                                </div>
                                                <span class="badge bg-success">Miễn phí</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check p-3 border rounded shipping-option">
                                        <input class="form-check-input" type="radio" name="shipping_method" id="express" value="express">
                                        <label class="form-check-label w-100" for="express">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong>Giao hàng nhanh</strong>
                                                    <small class="d-block text-muted">1-2 ngày làm việc</small>
                                                </div>
                                                <span class="badge bg-warning">30.000đ</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Lưu ý:</strong> Đơn hàng từ 1.000.000đ được miễn phí giao hàng nhanh
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 sticky-top" data-aos="fade-up" data-aos-delay="400" style="top: 20px;">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-receipt me-2"></i>
                                Tóm tắt đơn hàng
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Order Items -->
                            <div class="order-items mb-4" style="max-height: 300px; overflow-y: auto;">
                                <?php foreach ($cart as $productId => $item): ?>
                                    <div class="d-flex align-items-center mb-3 p-2 bg-light rounded">
                                        <div class="product-image me-3">
                                            <?php if (!empty($item['image'])): ?>
                                                <img src="/<?php echo htmlspecialchars($item['image']); ?>" 
                                                     alt="<?php echo htmlspecialchars($item['name']); ?>" 
                                                     class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                            <?php else: ?>
                                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                    <i class="fas fa-image text-white"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small"><?php echo htmlspecialchars($item['name']); ?></h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">SL: <?php echo $item['quantity']; ?></small>
                                                <strong class="text-primary small">
                                                    <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?>đ
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Price Breakdown -->
                            <div class="price-breakdown">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tạm tính:</span>
                                    <span><?php echo number_format($total, 0, ',', '.'); ?>đ</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Phí vận chuyển:</span>
                                    <span id="shippingFee" class="text-success">Miễn phí</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Thuế VAT:</span>
                                    <span class="text-muted">Đã bao gồm</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <strong>Tổng cộng:</strong>
                                    <strong class="text-primary h5" id="grandTotal">
                                        <?php echo number_format($total, 0, ',', '.'); ?>đ
                                    </strong>
                                </div>
                            </div>

                            <!-- Order Actions -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg" id="placeOrderBtn">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Đặt hàng ngay
                                </button>
                                <a href="/Product/cart" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Quay lại giỏ hàng
                                </a>
                            </div>

                            <!-- Security Info -->
                            <div class="mt-4 text-center">
                                <small class="text-muted d-block mb-2">
                                    <i class="fas fa-shield-alt text-success me-1"></i>
                                    Thông tin của bạn được bảo mật 100%
                                </small>
                                <div class="security-badges">
                                    <i class="fab fa-cc-visa fa-2x text-primary me-2"></i>
                                    <i class="fab fa-cc-mastercard fa-2x text-warning me-2"></i>
                                    <i class="fas fa-shield-alt fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>

<script>
    // Form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                        toastr.error('Vui lòng kiểm tra lại thông tin!');
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Phone number validation
    document.getElementById('phone').addEventListener('input', function() {
        const phone = this.value.replace(/\D/g, '');
        this.value = phone;
        
        if (phone.length >= 10 && phone.length <= 11) {
            this.setCustomValidity('');
        } else {
            this.setCustomValidity('Số điện thoại phải có 10-11 chữ số');
        }
    });

    // Payment method change
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.payment-option').forEach(option => {
                option.classList.remove('border-primary', 'bg-light');
            });
            
            if (this.checked) {
                this.closest('.payment-option').classList.add('border-primary', 'bg-light');
            }
        });
    });

    // Shipping method change
    document.querySelectorAll('input[name="shipping_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.shipping-option').forEach(option => {
                option.classList.remove('border-primary', 'bg-light');
            });
            
            if (this.checked) {
                this.closest('.shipping-option').classList.add('border-primary', 'bg-light');
            }
            
            updateShippingFee();
        });
    });

    // Update shipping fee
    function updateShippingFee() {
        const express = document.getElementById('express').checked;
        const subtotal = <?php echo $total; ?>;
        const freeShippingThreshold = 1000000;
        
        let shippingFee = 0;
        if (express && subtotal < freeShippingThreshold) {
            shippingFee = 30000;
        }
        
        const shippingFeeElement = document.getElementById('shippingFee');
        if (shippingFee > 0) {
            shippingFeeElement.textContent = new Intl.NumberFormat('vi-VN').format(shippingFee) + 'đ';
            shippingFeeElement.className = 'text-warning';
        } else {
            shippingFeeElement.textContent = 'Miễn phí';
            shippingFeeElement.className = 'text-success';
        }
        
        const grandTotal = subtotal + shippingFee;
        document.getElementById('grandTotal').textContent = new Intl.NumberFormat('vi-VN').format(grandTotal) + 'đ';
    }

    // Address auto-complete simulation
    document.getElementById('province').addEventListener('change', function() {
        const district = document.getElementById('district');
        district.innerHTML = '<option value="">Chọn quận/huyện</option>';
        
        if (this.value === 'Ho Chi Minh') {
            district.innerHTML += `
                <option value="Quan 1">Quận 1</option>
                <option value="Quan 3">Quận 3</option>
                <option value="Quan 5">Quận 5</option>
                <option value="Quan 7">Quận 7</option>
                <option value="Quan 10">Quận 10</option>
            `;
        } else if (this.value === 'Ha Noi') {
            district.innerHTML += `
                <option value="Ba Dinh">Ba Đình</option>
                <option value="Hoan Kiem">Hoàn Kiếm</option>
                <option value="Dong Da">Đống Đa</option>
                <option value="Hai Ba Trung">Hai Bà Trưng</option>
            `;
        }
    });

    document.getElementById('district').addEventListener('change', function() {
        const ward = document.getElementById('ward');
        ward.innerHTML = '<option value="">Chọn phường/xã</option>';
        
        if (this.value) {
            ward.innerHTML += `
                <option value="Phuong 1">Phường 1</option>
                <option value="Phuong 2">Phường 2</option>
                <option value="Phuong 3">Phường 3</option>
            `;
        }
    });

    // Auto-fill address from selections
    function updateFullAddress() {
        const province = document.getElementById('province').selectedOptions[0]?.text || '';
        const district = document.getElementById('district').selectedOptions[0]?.text || '';
        const ward = document.getElementById('ward').selectedOptions[0]?.text || '';
        
        if (province && district && ward) {
            const currentAddress = document.getElementById('address').value;
            const addressParts = currentAddress.split(',');
            
            if (addressParts.length <= 1) {
                document.getElementById('address').value = `${currentAddress}, ${ward}, ${district}, ${province}`.replace(/^,\s*/, '');
            }
        }
    }

    document.getElementById('ward').addEventListener('change', updateFullAddress);

    // Form submission
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('placeOrderBtn');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';
        btn.disabled = true;
        
        // Show loading
        Swal.fire({
            title: 'Đang xử lý đơn hàng...',
            html: 'Vui lòng đợi trong giây lát',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    });

    // Initialize payment method highlighting
    document.getElementById('cod').closest('.payment-option').classList.add('border-primary', 'bg-light');
    document.getElementById('standard').closest('.shipping-option').classList.add('border-primary', 'bg-light');

    // Auto-focus first input
    document.getElementById('name').focus();
</script>

<style>
    .payment-option, .shipping-option {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .payment-option:hover, .shipping-option:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    
    .order-items::-webkit-scrollbar {
        width: 6px;
    }
    
    .order-items::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .order-items::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    
    .order-items::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    
    .security-badges i {
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }
    
    .security-badges i:hover {
        opacity: 1;
    }
    
    .sticky-top {
        z-index: 1020;
    }
    
    @media (max-width: 768px) {
        .sticky-top {
            position: static !important;
        }
    }
</style>

<?php include 'app/views/shares/footer.php'; ?>