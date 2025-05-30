<?php
$title = "Thanh toán";
include_once 'app/views/shares/header.php';

// Calculate cart total
$cart = $_SESSION['cart'] ?? [];
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="/Product" class="text-white-50">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="/Product/cart" class="text-white-50">Giỏ hàng</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Thanh toán</li>
                    </ol>
                </nav>
                <h1 class="h2 mb-0 animate__animated animate__fadeInLeft">
                    <i class="fas fa-credit-card me-2"></i>Thanh toán đơn hàng
                </h1>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="/Product/cart" class="btn btn-outline-light animate__animated animate__fadeInRight">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại giỏ hàng
                </a>
            </div>
        </div>
    </div>
</div>

<?php if (empty($cart)): ?>
    <!-- Empty Cart Redirect -->
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5" data-aos="fade-up">
                    <i class="fas fa-shopping-cart text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                    <h3 class="text-muted mt-3 mb-3">Giỏ hàng trống</h3>
                    <p class="text-muted mb-4">Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán</p>
                    <a href="/Product" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i>Tiếp tục mua sắp
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <!-- Checkout Form -->
    <div class="container my-5">
        <form action="/Product/processCheckout" method="POST" id="checkoutForm">
            <div class="row">
                <!-- Customer Information -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-lg mb-4" data-aos="fade-right">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user me-2"></i>Thông tin khách hàng
                            </h5>
                        </div>
                        
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="name" class="form-label fw-bold">
                                        <i class="fas fa-user me-1 text-primary"></i>Họ và tên *
                                    </label>
                                    <input type="text" class="form-control form-control-lg" 
                                           id="name" name="name" 
                                           placeholder="Nhập họ và tên đầy đủ..." required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-bold">
                                        <i class="fas fa-phone me-1 text-primary"></i>Số điện thoại *
                                    </label>
                                    <input type="tel" class="form-control form-control-lg" 
                                           id="phone" name="phone" 
                                           placeholder="0123456789" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">
                                        <i class="fas fa-envelope me-1 text-primary"></i>Email
                                    </label>
                                    <input type="email" class="form-control form-control-lg" 
                                           id="email" name="email" 
                                           placeholder="email@example.com">
                                </div>
                                
                                <div class="col-12">
                                    <label for="address" class="form-label fw-bold">
                                        <i class="fas fa-map-marker-alt me-1 text-primary"></i>Địa chỉ giao hàng *
                                    </label>
                                    <textarea class="form-control" id="address" name="address" 
                                              rows="3" placeholder="Nhập địa chỉ giao hàng chi tiết..." required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Method -->
                    <div class="card border-0 shadow-lg mb-4" data-aos="fade-right" data-aos-delay="100">
                        <div class="card-header bg-success text-white py-3">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-credit-card me-2"></i>Phương thức thanh toán
                            </h5>
                        </div>
                        
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-check form-check-card">
                                        <input class="form-check-input" type="radio" name="payment_method" 
                                               id="payment_cod" value="cod" checked>
                                        <label class="form-check-label" for="payment_cod">
                                            <div class="card h-100">
                                                <div class="card-body text-center py-3">
                                                    <i class="fas fa-money-bill-wave fa-2x text-success mb-2"></i>
                                                    <h6 class="mb-1">Thanh toán khi nhận hàng</h6>
                                                    <small class="text-muted">Trả tiền mặt khi nhận hàng</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-check form-check-card">
                                        <input class="form-check-input" type="radio" name="payment_method" 
                                               id="payment_bank" value="bank">
                                        <label class="form-check-label" for="payment_bank">
                                            <div class="card h-100">
                                                <div class="card-body text-center py-3">
                                                    <i class="fas fa-university fa-2x text-primary mb-2"></i>
                                                    <h6 class="mb-1">Chuyển khoản ngân hàng</h6>
                                                    <small class="text-muted">Chuyển khoản trước khi giao</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Bank Transfer Info (Hidden by default) -->
                            <div id="bankInfo" class="mt-3" style="display: none;">
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-info-circle me-2"></i>Thông tin chuyển khoản:</h6>
                                    <p class="mb-1"><strong>Ngân hàng:</strong> Vietcombank</p>
                                    <p class="mb-1"><strong>Số tài khoản:</strong> 1234567890</p>
                                    <p class="mb-1"><strong>Chủ tài khoản:</strong> CONG TY TECHTAFU</p>
                                    <p class="mb-0"><strong>Nội dung:</strong> Thanh toan don hang [Số điện thoại]</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Special Instructions -->
                    <div class="card border-0 shadow-lg" data-aos="fade-right" data-aos-delay="200">
                        <div class="card-header bg-info text-white py-3">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-sticky-note me-2"></i>Ghi chú đặc biệt
                            </h5>
                        </div>
                        
                        <div class="card-body p-4">
                            <textarea class="form-control" name="notes" rows="3" 
                                      placeholder="Ghi chú về đơn hàng (thời gian giao hàng, yêu cầu đặc biệt...)"></textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-lg sticky-top" data-aos="fade-left" style="top: 100px;">
                        <div class="card-header bg-warning text-dark py-3">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-receipt me-2"></i>Tóm tắt đơn hàng
                            </h5>
                        </div>
                        
                        <div class="card-body p-0">
                            <!-- Cart Items -->
                            <div class="p-4 border-bottom">
                                <h6 class="mb-3">Sản phẩm đã chọn:</h6>
                                <?php foreach ($cart as $productId => $item): ?>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0 me-3">
                                            <?php if (!empty($item['image']) && file_exists($item['image'])): ?>
                                                <img src="/<?php echo htmlspecialchars($item['image']); ?>" 
                                                     class="rounded" style="width: 50px; height: 50px; object-fit: cover;"
                                                     alt="<?php echo htmlspecialchars($item['name']); ?>">
                                            <?php else: ?>
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 50px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small"><?php echo htmlspecialchars($item['name']); ?></h6>
                                            <p class="mb-0 small text-muted">
                                                <?php echo $item['quantity']; ?> × <?php echo number_format($item['price'], 0, ',', '.'); ?>₫
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            <span class="fw-bold text-success">
                                                <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?>₫
                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <!-- Order Calculation -->
                            <div class="p-4">
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
                                    <span class="text-muted">Đã bao gồm</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <h6 class="mb-0">Tổng thanh toán:</h6>
                                    <h4 class="mb-0 text-danger">
                                        <?php echo number_format($total, 0, ',', '.'); ?>₫
                                    </h4>
                                </div>
                                
                                <!-- Checkout Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-check-circle me-2"></i>Đặt hàng ngay
                                    </button>
                                </div>
                                
                                <div class="text-center mt-3">
                                    <small class="text-muted">
                                        <i class="fas fa-shield-alt me-1"></i>
                                        Thông tin của bạn được bảo mật tuyệt đối
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Policies -->
                    <div class="card border-0 shadow-sm mt-3" data-aos="fade-left" data-aos-delay="100">
                        <div class="card-body">
                            <h6 class="card-title">
                                <i class="fas fa-info-circle me-2 text-primary"></i>Chính sách mua hàng
                            </h6>
                            <ul class="list-unstyled small mb-0">
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Miễn phí giao hàng toàn quốc
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Đổi trả trong 7 ngày nếu lỗi
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Bảo hành chính hãng đầy đủ
                                </li>
                                <li>
                                    <i class="fas fa-check text-success me-2"></i>
                                    Hỗ trợ kỹ thuật 24/7
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>

<script>
    // Payment method toggle
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const bankInfo = document.getElementById('bankInfo');
            if (this.value === 'bank') {
                bankInfo.style.display = 'block';
                bankInfo.classList.add('animate__animated', 'animate__fadeIn');
            } else {
                bankInfo.style.display = 'none';
            }
        });
    });

    // Form validation
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const address = document.getElementById('address').value.trim();
        
        // Validation
        if (!name) {
            toastr.error('Vui lòng nhập họ và tên');
            document.getElementById('name').focus();
            return;
        }
        
        if (!phone) {
            toastr.error('Vui lòng nhập số điện thoại');
            document.getElementById('phone').focus();
            return;
        }
        
        if (!/^[0-9]{10,11}$/.test(phone)) {
            toastr.error('Số điện thoại không hợp lệ');
            document.getElementById('phone').focus();
            return;
        }
        
        if (!address) {
            toastr.error('Vui lòng nhập địa chỉ giao hàng');
            document.getElementById('address').focus();
            return;
        }
        
        // Confirmation dialog
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        const paymentText = paymentMethod === 'cod' ? 'thanh toán khi nhận hàng' : 'chuyển khoản ngân hàng';
        
        Swal.fire({
            title: 'Xác nhận đặt hàng',
            html: `
                <div class="text-start">
                    <p><strong>Họ tên:</strong> ${name}</p>
                    <p><strong>Số điện thoại:</strong> ${phone}</p>
                    <p><strong>Địa chỉ:</strong> ${address}</p>
                    <p><strong>Tổng tiền:</strong> <span class="text-danger"><?php echo number_format($total, 0, ',', '.'); ?>₫</span></p>
                    <p><strong>Thanh toán:</strong> ${paymentText}</p>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Xác nhận đặt hàng',
            cancelButtonText: 'Kiểm tra lại',
            width: '500px'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();
                
                // Submit form
                const formData = new FormData(this);
                
                fetch('/Product/processCheckout', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = '/Product/orderConfirmation';
                    } else {
                        throw new Error('Network response was not ok');
                    }
                })
                .catch(error => {
                    hideLoading();
                    toastr.error('Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại!');
                    console.error('Error:', error);
                });
            }
        });
    });

    // Phone number formatting
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 11) {
            value = value.slice(0, 11);
        }
        e.target.value = value;
    });

    // Auto-focus next field on Enter
    const formInputs = document.querySelectorAll('#checkoutForm input, #checkoutForm textarea');
    formInputs.forEach((input, index) => {
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && index < formInputs.length - 1) {
                e.preventDefault();
                formInputs[index + 1].focus();
            }
        });
    });

    // Save form data to sessionStorage for recovery
    const saveFormData = () => {
        const formData = {
            name: document.getElementById('name').value,
            phone: document.getElementById('phone').value,
            email: document.getElementById('email').value,
            address: document.getElementById('address').value
        };
        sessionStorage.setItem('checkoutForm', JSON.stringify(formData));
    };

    // Load saved form data
    const loadFormData = () => {
        const savedData = sessionStorage.getItem('checkoutForm');
        if (savedData) {
            const data = JSON.parse(savedData);
            document.getElementById('name').value = data.name || '';
            document.getElementById('phone').value = data.phone || '';
            document.getElementById('email').value = data.email || '';
            document.getElementById('address').value = data.address || '';
        }
    };

    // Auto-save form data on input
    formInputs.forEach(input => {
        input.addEventListener('input', saveFormData);
    });

    // Load form data on page load
    document.addEventListener('DOMContentLoaded', loadFormData);

    // Clear saved data on successful submission
    document.getElementById('checkoutForm').addEventListener('submit', function() {
        sessionStorage.removeItem('checkoutForm');
    });

    // Estimate delivery time
    document.getElementById('address').addEventListener('blur', function() {
        const address = this.value.toLowerCase();
        let deliveryTime = '2-3 ngày';
        
        if (address.includes('hồ chí minh') || address.includes('tp hcm') || address.includes('sài gòn')) {
            deliveryTime = '1-2 ngày';
        } else if (address.includes('hà nội') || address.includes('đà nẵng')) {
            deliveryTime = '1-2 ngày';
        }
        
        // Show delivery estimation
        let deliveryInfo = document.getElementById('deliveryInfo');
        if (!deliveryInfo) {
            deliveryInfo = document.createElement('small');
            deliveryInfo.id = 'deliveryInfo';
            deliveryInfo.className = 'text-info mt-1 d-block';
            this.parentNode.appendChild(deliveryInfo);
        }
        
        deliveryInfo.innerHTML = `<i class="fas fa-truck me-1"></i>Dự kiến giao hàng: ${deliveryTime}`;
    });
</script>

<?php include_once 'app/views/shares/footer.php'; ?>