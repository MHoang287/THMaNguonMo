<?php require_once 'app/views/shares/header.php'; ?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/Product/cart" class="text-decoration-none">Giỏ hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
        </ol>
    </div>
</nav>

<!-- Checkout Section -->
<section class="py-5">
    <div class="container">
        <?php if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
            <!-- Empty Cart -->
            <div class="text-center py-5">
                <i class="bi bi-cart-x display-1 text-muted"></i>
                <h3 class="mt-4">Giỏ hàng trống</h3>
                <p class="text-muted">Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán</p>
                <a href="/Product" class="btn btn-primary btn-lg mt-3">
                    <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
                </a>
            </div>
        <?php else: ?>
            <form action="/Product/processCheckout" method="POST" id="checkoutForm">
                <div class="row">
                    <!-- Billing Information -->
                    <div class="col-lg-8" data-aos="fade-right">
                        <!-- Customer Information -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-person"></i> Thông tin khách hàng</h5>
                            </div>
                            <div class="card-body">
                                <?php if(isset($_SESSION['checkout_errors'])): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <h6 class="alert-heading"><i class="bi bi-exclamation-triangle"></i> Vui lòng kiểm tra lại:</h6>
                                        <ul class="mb-0">
                                            <?php foreach($_SESSION['checkout_errors'] as $error): ?>
                                                <li><?= htmlspecialchars($error) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                    <?php unset($_SESSION['checkout_errors']); ?>
                                <?php endif; ?>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" required 
                                               value="<?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['name']) : '' ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="phone" name="phone" required
                                               pattern="[0-9]{10,11}" placeholder="0901234567">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" required
                                               value="<?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['email']) : '' ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="company" class="form-label">Công ty (Tùy chọn)</label>
                                        <input type="text" class="form-control" id="company" name="company">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="card shadow-sm mb-4" data-aos="fade-up">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-geo-alt"></i> Địa chỉ giao hàng</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="address" class="form-label">Địa chỉ <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="address" name="address" required
                                               placeholder="Số nhà, tên đường">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="city" class="form-label">Tỉnh/Thành phố <span class="text-danger">*</span></label>
                                        <select class="form-select" id="city" name="city" required>
                                            <option value="">Chọn tỉnh/thành phố</option>
                                            <option value="HCM">TP. Hồ Chí Minh</option>
                                            <option value="HN">Hà Nội</option>
                                            <option value="DN">Đà Nẵng</option>
                                            <option value="CT">Cần Thơ</option>
                                            <option value="HP">Hải Phòng</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="district" class="form-label">Quận/Huyện <span class="text-danger">*</span></label>
                                        <select class="form-select" id="district" name="district" required>
                                            <option value="">Chọn quận/huyện</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="ward" class="form-label">Phường/Xã <span class="text-danger">*</span></label>
                                        <select class="form-select" id="ward" name="ward" required>
                                            <option value="">Chọn phường/xã</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="notes" class="form-label">Ghi chú (Tùy chọn)</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3" 
                                                  placeholder="Ghi chú về đơn hàng, ví dụ: thời gian giao hàng..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="card shadow-sm mb-4" data-aos="fade-up">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-credit-card"></i> Phương thức thanh toán</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-check payment-option">
                                            <input class="form-check-input" type="radio" name="payment_method" 
                                                   id="cod" value="cod" checked>
                                            <label class="form-check-label w-100" for="cod">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <i class="bi bi-cash text-success"></i>
                                                        <span class="ms-2">Thanh toán khi nhận hàng (COD)</span>
                                                    </div>
                                                    <i class="bi bi-check-circle text-success"></i>
                                                </div>
                                                <small class="text-muted d-block mt-1">Thanh toán bằng tiền mặt khi nhận hàng</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check payment-option">
                                            <input class="form-check-input" type="radio" name="payment_method" 
                                                   id="bank_transfer" value="bank_transfer">
                                            <label class="form-check-label w-100" for="bank_transfer">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <i class="bi bi-bank text-primary"></i>
                                                        <span class="ms-2">Chuyển khoản ngân hàng</span>
                                                    </div>
                                                </div>
                                                <small class="text-muted d-block mt-1">Chuyển khoản qua tài khoản ngân hàng</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check payment-option">
                                            <input class="form-check-input" type="radio" name="payment_method" 
                                                   id="momo" value="momo">
                                            <label class="form-check-label w-100" for="momo">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <i class="bi bi-phone text-danger"></i>
                                                        <span class="ms-2">Ví MoMo</span>
                                                    </div>
                                                </div>
                                                <small class="text-muted d-block mt-1">Thanh toán qua ví điện tử MoMo</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check payment-option">
                                            <input class="form-check-input" type="radio" name="payment_method" 
                                                   id="credit_card" value="credit_card">
                                            <label class="form-check-label w-100" for="credit_card">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <i class="bi bi-credit-card-2-front text-info"></i>
                                                        <span class="ms-2">Thẻ tín dụng/Ghi nợ</span>
                                                    </div>
                                                </div>
                                                <small class="text-muted d-block mt-1">Visa, Mastercard, JCB</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4" data-aos="fade-left">
                        <div class="card shadow-sm sticky-top" style="top: 20px;">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0"><i class="bi bi-receipt"></i> Đơn hàng của bạn</h5>
                            </div>
                            <div class="card-body">
                                <!-- Order Items -->
                                <div class="order-items mb-3" style="max-height: 300px; overflow-y: auto;">
                                    <?php 
                                    $total = 0;
                                    foreach($_SESSION['cart'] as $id => $item): 
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $total += $subtotal;
                                    ?>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center">
                                                <?php if(isset($item['image']) && $item['image']): ?>
                                                    <img src="<?= htmlspecialchars($item['image']) ?>" 
                                                         alt="<?= htmlspecialchars($item['name']) ?>" 
                                                         class="img-thumbnail me-2"
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                <?php else: ?>
                                                    <div class="bg-light rounded me-2" style="width: 50px; height: 50px;"></div>
                                                <?php endif; ?>
                                                <div>
                                                    <h6 class="mb-0 small"><?= htmlspecialchars($item['name']) ?></h6>
                                                    <small class="text-muted">Số lượng: <?= $item['quantity'] ?></small>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <strong><?= number_format($subtotal, 0, ',', '.') ?>₫</strong>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                
                                <hr>
                                
                                <!-- Price Summary -->
                                <div class="price-summary">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Tạm tính:</span>
                                        <span><?= number_format($total, 0, ',', '.') ?>₫</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Phí vận chuyển:</span>
                                        <span class="text-success">Miễn phí</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Thuế VAT (10%):</span>
                                        <span><?= number_format($total * 0.1, 0, ',', '.') ?>₫</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between mb-4">
                                        <strong class="fs-5">Tổng cộng:</strong>
                                        <strong class="text-primary fs-4"><?= number_format($total * 1.1, 0, ',', '.') ?>₫</strong>
                                    </div>
                                </div>
                                
                                <!-- Terms and Submit -->
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label small" for="terms">
                                        Tôi đã đọc và đồng ý với <a href="#" class="text-decoration-none">điều khoản sử dụng</a> 
                                        và <a href="#" class="text-decoration-none">chính sách bảo mật</a>
                                    </label>
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-check-circle"></i> Đặt hàng
                                </button>
                                
                                <!-- Security badges -->
                                <div class="text-center mt-3">
                                    <small class="text-muted">
                                        <i class="bi bi-shield-lock text-success"></i> Thanh toán an toàn & bảo mật
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</section>

<style>
.payment-option {
    padding: 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.payment-option:hover {
    border-color: #0d6efd;
    background-color: #f8f9fa;
}

.form-check-input:checked ~ .form-check-label .payment-option {
    border-color: #0d6efd;
    background-color: #e7f1ff;
}

.order-items::-webkit-scrollbar {
    width: 5px;
}

.order-items::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.order-items::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 5px;
}

.form-control:focus,
.form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}
</style>

<?php
$additionalScripts = '
<script>
// Initialize Choices.js for selects
const citySelect = new Choices("#city", {
    searchEnabled: true,
    itemSelectText: "",
    searchPlaceholderValue: "Tìm kiếm..."
});

const districtSelect = new Choices("#district", {
    searchEnabled: true,
    itemSelectText: "",
    searchPlaceholderValue: "Tìm kiếm..."
});

const wardSelect = new Choices("#ward", {
    searchEnabled: true,
    itemSelectText: "",
    searchPlaceholderValue: "Tìm kiếm..."
});

// Update districts when city changes
document.getElementById("city").addEventListener("change", function() {
    const city = this.value;
    const districtOptions = {
        "HCM": ["Quận 1", "Quận 2", "Quận 3", "Quận 7", "Quận 9", "Quận Bình Thạnh", "Quận Gò Vấp"],
        "HN": ["Quận Ba Đình", "Quận Hoàn Kiếm", "Quận Hai Bà Trưng", "Quận Đống Đa", "Quận Cầu Giấy"],
        "DN": ["Quận Hải Châu", "Quận Thanh Khê", "Quận Sơn Trà", "Quận Ngũ Hành Sơn"],
        "CT": ["Quận Ninh Kiều", "Quận Bình Thủy", "Quận Cái Răng", "Quận Ô Môn"],
        "HP": ["Quận Hồng Bàng", "Quận Lê Chân", "Quận Ngô Quyền", "Quận Kiến An"]
    };
    
    // Clear and update district options
    districtSelect.clearStore();
    if (districtOptions[city]) {
        districtOptions[city].forEach(district => {
            districtSelect.setChoices([{value: district, label: district}], "value", "label", false);
        });
    }
    
    // Clear ward options
    wardSelect.clearStore();
});

// Update wards when district changes
document.getElementById("district").addEventListener("change", function() {
    const district = this.value;
    // Simulate ward data
    const wards = ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"];
    
    wardSelect.clearStore();
    wards.forEach(ward => {
        wardSelect.setChoices([{value: ward, label: ward}], "value", "label", false);
    });
});

// Payment method selection animation
$(".payment-option").click(function() {
    $(this).find("input[type=radio]").prop("checked", true);
    
    anime({
        targets: this,
        scale: [0.95, 1],
        duration: 200,
        easing: "easeOutQuad"
    });
});

// Form validation
document.getElementById("checkoutForm").addEventListener("submit", function(e) {
    e.preventDefault();
    
    // Validate phone number
    const phone = document.getElementById("phone").value;
    if (!/^[0-9]{10,11}$/.test(phone)) {
        Swal.fire({
            icon: "error",
            title: "Số điện thoại không hợp lệ",
            text: "Vui lòng nhập số điện thoại từ 10-11 chữ số"
        });
        return;
    }
    
    // Show confirmation
    Swal.fire({
        title: "Xác nhận đặt hàng",
        html: `
            <p>Bạn có chắc chắn muốn đặt hàng với thông tin sau?</p>
            <div class="text-start">
                <strong>Người nhận:</strong> ${document.getElementById("name").value}<br>
                <strong>Số điện thoại:</strong> ${phone}<br>
                <strong>Địa chỉ:</strong> ${document.getElementById("address").value}<br>
                <strong>Tổng tiền:</strong> <?= number_format($total * 1.1, 0, ",", ".") ?>₫
            </div>
        `,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Xác nhận đặt hàng",
        cancelButtonText: "Kiểm tra lại",
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#6c757d"
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: "Đang xử lý đơn hàng...",
                text: "Vui lòng đợi trong giây lát",
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit form
            this.submit();
        }
    });
});

// Auto-fill demo data for testing
document.addEventListener("DOMContentLoaded", function() {
    // Add demo button for testing
    if (window.location.hostname === "localhost") {
        const demoBtn = document.createElement("button");
        demoBtn.className = "btn btn-sm btn-secondary position-fixed bottom-0 end-0 m-3";
        demoBtn.innerHTML = "<i class=\"bi bi-magic\"></i> Demo";
        demoBtn.onclick = function() {
            document.getElementById("name").value = "Nguyễn Văn Test";
            document.getElementById("phone").value = "0901234567";
            document.getElementById("email").value = "test@example.com";
            document.getElementById("address").value = "123 Nguyễn Văn Linh";
            document.getElementById("notes").value = "Giao hàng trong giờ hành chính";
            
            // Trigger change events for select boxes
            citySelect.setChoiceByValue("HCM");
            document.getElementById("city").dispatchEvent(new Event("change"));
            
            setTimeout(() => {
                districtSelect.setChoiceByValue("Quận 7");
                document.getElementById("district").dispatchEvent(new Event("change"));
            }, 500);
            
            setTimeout(() => {
                wardSelect.setChoiceByValue("Phường 1");
            }, 1000);
        };
        document.body.appendChild(demoBtn);
    }
});
</script>
';
?>

<?php require_once 'app/views/shares/footer.php'; ?>