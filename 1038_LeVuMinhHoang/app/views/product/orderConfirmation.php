<?php require_once 'app/views/shares/header.php'; ?>

<!-- Order Confirmation Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if(isset($_SESSION['last_order'])): ?>
                    <!-- Success Message -->
                    <div class="text-center mb-5" data-aos="zoom-in">
                        <div class="success-animation mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                        </div>
                        <h1 class="display-5 fw-bold mb-3">Đặt hàng thành công!</h1>
                        <p class="lead text-muted">Cảm ơn bạn đã tin tưởng và mua sắm tại TechTafu</p>
                    </div>

                    <!-- Order Details Card -->
                    <div class="card shadow-lg mb-4" data-aos="fade-up">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-receipt"></i> Thông tin đơn hàng #<?= $_SESSION['last_order']['order_id'] ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-3">Thông tin giao hàng</h6>
                                    <p class="mb-1"><strong>Người nhận:</strong> <?= htmlspecialchars($_POST['name'] ?? 'N/A') ?></p>
                                    <p class="mb-1"><strong>Số điện thoại:</strong> <?= htmlspecialchars($_POST['phone'] ?? 'N/A') ?></p>
                                    <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($_POST['email'] ?? 'N/A') ?></p>
                                    <p class="mb-0"><strong>Địa chỉ:</strong> <?= htmlspecialchars($_POST['address'] ?? 'N/A') ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-3">Thông tin thanh toán</h6>
                                    <p class="mb-1"><strong>Phương thức:</strong> 
                                        <?php
                                        $payment_methods = [
                                            'cod' => 'Thanh toán khi nhận hàng (COD)',
                                            'bank_transfer' => 'Chuyển khoản ngân hàng',
                                            'momo' => 'Ví MoMo',
                                            'credit_card' => 'Thẻ tín dụng/Ghi nợ'
                                        ];
                                        echo $payment_methods[$_SESSION['last_order']['payment_method']] ?? 'N/A';
                                        ?>
                                    </p>
                                    <p class="mb-1"><strong>Tổng tiền:</strong> 
                                        <span class="text-primary fs-5"><?= number_format($_SESSION['last_order']['total_amount'], 0, ',', '.') ?>₫</span>
                                    </p>
                                    <p class="mb-0"><strong>Trạng thái:</strong> 
                                        <span class="badge bg-warning">Đang xử lý</span>
                                    </p>
                                </div>
                            </div>

                            <?php if($_SESSION['last_order']['payment_method'] == 'bank_transfer'): ?>
                                <!-- Bank Transfer Instructions -->
                                <div class="alert alert-info" role="alert">
                                    <h6 class="alert-heading"><i class="bi bi-info-circle"></i> Thông tin chuyển khoản</h6>
                                    <hr>
                                    <p class="mb-2"><strong>Ngân hàng:</strong> Vietcombank</p>
                                    <p class="mb-2"><strong>Số tài khoản:</strong> 1234567890</p>
                                    <p class="mb-2"><strong>Chủ tài khoản:</strong> CÔNG TY TNHH TECHTAFU</p>
                                    <p class="mb-2"><strong>Nội dung:</strong> DH<?= $_SESSION['last_order']['order_id'] ?></p>
                                    <p class="mb-0"><strong>Số tiền:</strong> <?= number_format($_SESSION['last_order']['total_amount'], 0, ',', '.') ?>₫</p>
                                </div>
                            <?php endif; ?>

                            <!-- Timeline -->
                            <h6 class="text-muted mb-3">Tiến trình đơn hàng</h6>
                            <div class="timeline">
                                <div class="timeline-item active">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <strong>Đặt hàng thành công</strong>
                                        <p class="text-muted small mb-0"><?= date('d/m/Y H:i') ?></p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <strong>Xác nhận đơn hàng</strong>
                                        <p class="text-muted small mb-0">Dự kiến: Trong 30 phút</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <strong>Đang giao hàng</strong>
                                        <p class="text-muted small mb-0">Dự kiến: 2-3 ngày</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <strong>Giao hàng thành công</strong>
                                        <p class="text-muted small mb-0">Dự kiến: 3-5 ngày</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Next Steps -->
                    <div class="card shadow-sm mb-4" data-aos="fade-up">
                        <div class="card-body">
                            <h5 class="card-title">Các bước tiếp theo</h5>
                            <ul class="mb-0">
                                <li>Chúng tôi sẽ gửi email xác nhận đơn hàng đến địa chỉ email của bạn</li>
                                <li>Nhân viên sẽ liên hệ xác nhận đơn hàng trong vòng 30 phút</li>
                                <li>Bạn có thể theo dõi đơn hàng thông qua mã đơn hàng</li>
                                <li>Nếu có thắc mắc, vui lòng liên hệ hotline: <strong>1900 1234</strong></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-center" data-aos="fade-up">
                        <a href="/Product" class="btn btn-primary btn-lg me-2">
                            <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
                        </a>
                        <a href="/orders/<?= $_SESSION['last_order']['order_id'] ?>" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-eye"></i> Xem chi tiết đơn hàng
                        </a>
                    </div>

                    <?php unset($_SESSION['last_order']); ?>
                <?php else: ?>
                    <!-- No Order Found -->
                    <div class="text-center py-5">
                        <i class="bi bi-exclamation-circle display-1 text-warning"></i>
                        <h3 class="mt-4">Không tìm thấy thông tin đơn hàng</h3>
                        <p class="text-muted">Vui lòng kiểm tra lại hoặc liên hệ với chúng tôi</p>
                        <a href="/Product" class="btn btn-primary btn-lg mt-3">
                            <i class="bi bi-arrow-left"></i> Quay lại cửa hàng
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center" data-aos="fade-up">
                <h3 class="mb-3">Đăng ký nhận tin khuyến mãi</h3>
                <p class="text-muted mb-4">Nhận ngay thông tin về các chương trình khuyến mãi và sản phẩm mới</p>
                <form class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Nhập email của bạn">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-envelope"></i> Đăng ký
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
.success-animation {
    animation: successPulse 1s ease-out;
}

@keyframes successPulse {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    padding-left: 60px;
    padding-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: 10px;
    top: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #fff;
    border: 3px solid #dee2e6;
}

.timeline-item.active .timeline-marker {
    background: #28a745;
    border-color: #28a745;
}

.timeline-content {
    padding: 10px 20px;
    background: #f8f9fa;
    border-radius: 8px;
}
</style>

<?php
$additionalScripts = '
<script>
// Success animation
anime({
    targets: ".success-animation i",
    rotate: 360,
    duration: 1000,
    easing: "easeInOutQuad"
});

// Confetti effect
function createConfetti() {
    const colors = ["#FF6B6B", "#4ECDC4", "#45B7D1", "#FED766", "#5CDB95"];
    const confettiCount = 50;
    
    for (let i = 0; i < confettiCount; i++) {
        const confetti = document.createElement("div");
        confetti.style.position = "fixed";
        confetti.style.width = "10px";
        confetti.style.height = "10px";
        confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.left = Math.random() * 100 + "%";
        confetti.style.top = "-10px";
        confetti.style.opacity = Math.random();
        confetti.style.transform = "rotate(" + Math.random() * 360 + "deg)";
        confetti.style.pointerEvents = "none";
        confetti.style.zIndex = "9999";
        document.body.appendChild(confetti);
        
        anime({
            targets: confetti,
            translateY: window.innerHeight + 10,
            translateX: anime.random(-100, 100),
            rotate: anime.random(0, 360),
            duration: anime.random(2000, 4000),
            easing: "easeOutQuad",
            complete: function() {
                confetti.remove();
            }
        });
    }
}

// Run confetti on page load
document.addEventListener("DOMContentLoaded", function() {
    if (document.querySelector(".success-animation")) {
        setTimeout(createConfetti, 500);
    }
});

// Copy order ID to clipboard
function copyOrderId() {
    const orderId = "<?= $_SESSION["last_order"]["order_id"] ?? "" ?>";
    navigator.clipboard.writeText(orderId).then(function() {
        Swal.fire({
            icon: "success",
            title: "Đã sao chép!",
            text: "Mã đơn hàng đã được sao chép",
            showConfirmButton: false,
            timer: 1500
        });
    });
}
</script>
';
?>

<?php require_once 'app/views/shares/footer.php'; ?>