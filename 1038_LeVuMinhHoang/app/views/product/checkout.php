<?php include 'app/views/shares/header.php'; ?>

<div class="row">
    <div class="col-12">
        <h2 class="mb-4" data-aos="fade-down">
            <i class="bi bi-credit-card me-2 text-primary"></i>Thanh toán đơn hàng
        </h2>
        
        <!-- Progress Steps -->
        <div class="checkout-steps mb-4" data-aos="fade-up">
            <div class="step completed">
                <div class="step-icon">
                    <i class="bi bi-cart-check"></i>
                </div>
                <span>Giỏ hàng</span>
            </div>
            <div class="step active">
                <div class="step-icon">
                    <i class="bi bi-person-check"></i>
                </div>
                <span>Thông tin</span>
            </div>
            <div class="step">
                <div class="step-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <span>Hoàn tất</span>
            </div>
        </div>
    </div>
</div>

<form action="/Product/processCheckout" method="POST" id="checkoutForm">
    <div class="row">
        <div class="col-lg-8" data-aos="fade-right">
            <div class="card shadow-lg mb-4" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);">
                <div class="card-header bg-transparent border-bottom border-secondary">
                    <h5 class="mb-0">
                        <i class="bi bi-person me-2"></i>Thông tin khách hàng
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-secondary">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" 
                                       class="form-control bg-transparent border-secondary text-white" 
                                       id="name" 
                                       name="name" 
                                       placeholder="Nguyễn Văn A"
                                       required>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-secondary">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                <input type="tel" 
                                       class="form-control bg-transparent border-secondary text-white" 
                                       id="phone" 
                                       name="phone" 
                                       placeholder="0901234567"
                                       pattern="[0-9]{10}"
                                       required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-secondary">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" 
                                   class="form-control bg-transparent border-secondary text-white" 
                                   id="email" 
                                   name="email" 
                                   placeholder="email@example.com">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-secondary">
                                <i class="bi bi-geo-alt"></i>
                            </span>
                            <textarea class="form-control bg-transparent border-secondary text-white" 
                                      id="address" 
                                      name="address" 
                                      rows="3" 
                                      placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố"
                                      required></textarea>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="notes" class="form-label">Ghi chú đơn hàng</label>
                        <textarea class="form-control bg-transparent border-secondary text-white" 
                                  id="notes" 
                                  name="notes" 
                                  rows="2" 
                                  placeholder="Ghi chú về đơn hàng, ví dụ: thời gian giao hàng..."></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Payment Method -->
            <div class="card shadow-lg" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);">
                <div class="card-header bg-transparent border-bottom border-secondary">
                    <h5 class="mb-0">
                        <i class="bi bi-wallet2 me-2"></i>Phương thức thanh toán
                    </h5>
                </div>
                <div class="card-body">
                    <div class="payment-methods">
                        <div class="form-check payment-option mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                            <label class="form-check-label w-100" for="cod">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-cash me-2"></i>
                                        <strong>Thanh toán khi nhận hàng (COD)</strong>
                                        <p class="text-muted small mb-0">Thanh toán bằng tiền mặt khi nhận hàng</p>
                                    </div>
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                </div>
                            </label>
                        </div>
                        
                        <div class="form-check payment-option mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="banking" value="banking">
                            <label class="form-check-label w-100" for="banking">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-bank me-2"></i>
                                        <strong>Chuyển khoản ngân hàng</strong>
                                        <p class="text-muted small mb-0">Chuyển khoản qua Internet Banking</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        
                        <div class="form-check payment-option">
                            <input class="form-check-input" type="radio" name="payment_method" id="vnpay" value="vnpay">
                            <label class="form-check-label w-100" for="vnpay">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-qr-code me-2"></i>
                                        <strong>VNPAY</strong>
                                        <p class="text-muted small mb-0">Thanh toán qua ví điện tử VNPAY</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4" data-aos="fade-left">
            <!-- Order Summary -->
            <div class="card shadow-lg sticky-top" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1); top: 100px;">
                <div class="card-header bg-transparent border-bottom border-secondary">
                    <h5 class="mb-0">
                        <i class="bi bi-receipt me-2"></i>Đơn hàng của bạn
                    </h5>
                </div>
                <div class="card-body">
                    <?php 
                    $cart = $_SESSION['cart'] ?? [];
                    $total = 0;
                    ?>
                    
                    <div class="order-items mb-3" style="max-height: 300px; overflow-y: auto;">
                        <?php foreach($cart as $id => $item): 
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        ?>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <p class="mb-0"><?php echo htmlspecialchars($item['name']); ?></p>
                                <small class="text-muted">x<?php echo $item['quantity']; ?></small>
                            </div>
                            <span><?php echo number_format($subtotal, 0, ',', '.'); ?>đ</span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính:</span>
                        <span><?php echo number_format($total, 0, ',', '.'); ?>đ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Phí vận chuyển:</span>
                        <span class="text-success">Miễn phí</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="mb-0">Tổng cộng:</h5>
                        <h5 class="mb-0 text-primary"><?php echo number_format($total, 0, ',', '.'); ?>đ</h5>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 btn-lg hvr-sweep-to-right">
                        <i class="bi bi-check-circle me-2"></i>Đặt hàng
                    </button>
                    
                    <div class="mt-3 text-center">
                        <small class="text-muted">
                            <i class="bi bi-shield-check me-1"></i>
                            Bằng việc đặt hàng, bạn đồng ý với các điều khoản và điều kiện của chúng tôi
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
.checkout-steps {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 2rem;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    flex: 1;
    text-align: center;
}

.step:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 25px;
    left: 50%;
    width: 100%;
    height: 2px;
    background: rgba(255,255,255,0.2);
    z-index: -1;
}

.step.completed:not(:last-child)::after,
.step.active:not(:last-child)::after {
    background: var(--primary-color);
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    border: 2px solid rgba(255,255,255,0.2);
}

.step.completed .step-icon,
.step.active .step-icon {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

.step span {
    font-size: 0.875rem;
    color: rgba(255,255,255,0.6);
}

.step.completed span,
.step.active span {
    color: var(--text-light);
}

.payment-option {
    padding: 1rem;
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.payment-option:hover {
    border-color: var(--primary-color);
    background: rgba(0,212,255,0.05);
}

.form-check-input:checked ~ .form-check-label .payment-option {
    border-color: var(--primary-color);
    background: rgba(0,212,255,0.1);
}
</style>

<script>
// Form validation
document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const name = document.getElementById('name').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const address = document.getElementById('address').value.trim();
    
    let hasError = false;
    
    if (!name) {
        toastr.error('Vui lòng nhập họ và tên');
        hasError = true;
    }
    
    if (!phone || !/^[0-9]{10}$/.test(phone)) {
        toastr.error('Vui lòng nhập số điện thoại hợp lệ (10 chữ số)');
        hasError = true;
    }
    
    if (!address) {
        toastr.error('Vui lòng nhập địa chỉ giao hàng');
        hasError = true;
    }
    
    if (!hasError) {
        // Show loading
        Swal.fire({
            title: 'Đang xử lý đơn hàng...',
            html: 'Vui lòng đợi trong giây lát',
            allowOutsideClick: false,
            showConfirmButton: false,
            background: 'var(--card-bg)',
            color: 'var(--text-light)',
            willOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Submit form
        setTimeout(() => {
            this.submit();
        }, 1000);
    }
});

// Payment method selection animation
document.querySelectorAll('.payment-option').forEach(option => {
    option.addEventListener('click', function() {
        const radio = this.querySelector('input[type="radio"]');
        radio.checked = true;
        
        // Remove active class from all options
        document.querySelectorAll('.payment-option').forEach(opt => {
            opt.classList.remove('active');
        });
        
        // Add active class to selected option
        this.classList.add('active');
        
        // Animate selection
        anime({
            targets: this,
            scale: [1, 1.02, 1],
            duration: 300,
            easing: 'easeInOutQuad'
        });
    });
});

// Auto-format phone number
document.getElementById('phone').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 10) {
        value = value.substr(0, 10);
    }
    e.target.value = value;
});
</script>

<?php include 'app/views/shares/footer.php'; ?>