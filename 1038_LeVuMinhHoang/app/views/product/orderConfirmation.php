<?php 
$title = "Đặt hàng thành công - TechTafu";
include 'app/views/shares/header.php'; 
?>

<div class="container py-4">
    <!-- Success Animation -->
    <div class="text-center mb-5" data-aos="zoom-in">
        <div class="success-animation mb-4">
            <div class="success-circle">
                <i class="fas fa-check text-white"></i>
            </div>
        </div>
        <h1 class="text-success mb-3 animate__animated animate__bounceIn">
            Đặt hàng thành công!
        </h1>
        <p class="lead text-muted animate__animated animate__fadeInUp animate__delay-1s">
            Cảm ơn bạn đã tin tưởng TechTafu. Đơn hàng của bạn đã được tiếp nhận và đang được xử lý.
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Order Status -->
            <div class="card shadow-lg border-0 mb-4" data-aos="fade-up">
                <div class="card-header bg-success text-white text-center py-4">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-clipboard-check me-2"></i>
                        Thông tin đơn hàng
                    </h3>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="info-item">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-hashtag text-primary me-2"></i>
                                    Mã đơn hàng
                                </h6>
                                <p class="h5 text-primary mb-0">#DH<?php echo str_pad(rand(100000, 999999), 8, '0', STR_PAD_LEFT); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="info-item">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-calendar-alt text-info me-2"></i>
                                    Ngày đặt hàng
                                </h6>
                                <p class="h6 mb-0"><?php echo date('d/m/Y H:i'); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="info-item">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-credit-card text-warning me-2"></i>
                                    Phương thức thanh toán
                                </h6>
                                <p class="mb-0">
                                    <span class="badge bg-success">
                                        <i class="fas fa-money-bill-wave me-1"></i>
                                        Thanh toán khi nhận hàng (COD)
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="info-item">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-truck text-success me-2"></i>
                                    Trạng thái đơn hàng
                                </h6>
                                <p class="mb-0">
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-clock me-1"></i>
                                        Đang xử lý
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Order Timeline -->
                    <div class="mt-4">
                        <h6 class="text-muted mb-3">
                            <i class="fas fa-route text-secondary me-2"></i>
                            Tiến trình đơn hàng
                        </h6>
                        <div class="order-timeline">
                            <div class="timeline-step active">
                                <div class="timeline-marker bg-success">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Đặt hàng thành công</h6>
                                    <small class="text-muted"><?php echo date('H:i - d/m/Y'); ?></small>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="timeline-marker bg-secondary">
                                    <i class="fas fa-box text-white"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Chuẩn bị hàng</h6>
                                    <small class="text-muted">Dự kiến: <?php echo date('H:i - d/m/Y', strtotime('+1 day')); ?></small>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="timeline-marker bg-secondary">
                                    <i class="fas fa-shipping-fast text-white"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Đang giao hàng</h6>
                                    <small class="text-muted">Dự kiến: <?php echo date('H:i - d/m/Y', strtotime('+2 days')); ?></small>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="timeline-marker bg-secondary">
                                    <i class="fas fa-home text-white"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Giao hàng thành công</h6>
                                    <small class="text-muted">Dự kiến: <?php echo date('H:i - d/m/Y', strtotime('+3 days')); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- What's Next -->
            <div class="card shadow-sm border-0 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Thông tin quan trọng
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-primary">
                                    <i class="fas fa-phone me-2"></i>
                                    Liên hệ hỗ trợ
                                </h6>
                                <p class="mb-2">Hotline: <strong>1800-1234</strong></p>
                                <p class="mb-0">Email: <strong>support@TechTafu.com</strong></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-success">
                                    <i class="fas fa-clock me-2"></i>
                                    Thời gian giao hàng
                                </h6>
                                <p class="mb-2">Trong nội thành: <strong>1-2 ngày</strong></p>
                                <p class="mb-0">Ngoại thành: <strong>2-3 ngày</strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Lưu ý:</strong> Vui lòng giữ máy để shipper có thể liên hệ khi giao hàng. 
                        Nếu có thay đổi địa chỉ hoặc thời gian nhận hàng, vui lòng liên hệ hotline.
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card shadow-sm border-0 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card-body text-center p-4">
                    <h5 class="mb-4">Bạn muốn làm gì tiếp theo?</h5>
                    <div class="row g-3">
                        <div class="col-md-3 col-6">
                            <a href="/Product" class="btn btn-outline-primary w-100">
                                <i class="fas fa-shopping-bag mb-2 d-block"></i>
                                Mua thêm sản phẩm
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <button class="btn btn-outline-info w-100" onclick="trackOrder()">
                                <i class="fas fa-search mb-2 d-block"></i>
                                Theo dõi đơn hàng
                            </button>
                        </div>
                        <div class="col-md-3 col-6">
                            <button class="btn btn-outline-success w-100" onclick="downloadInvoice()">
                                <i class="fas fa-download mb-2 d-block"></i>
                                Tải hóa đơn
                            </button>
                        </div>
                        <div class="col-md-3 col-6">
                            <button class="btn btn-outline-secondary w-100" onclick="shareOrder()">
                                <i class="fas fa-share-alt mb-2 d-block"></i>
                                Chia sẻ
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivery Information -->
            <div class="card shadow-sm border-0" data-aos="fade-up" data-aos-delay="400">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Thông tin giao hàng
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Người nhận hàng</h6>
                            <p class="mb-3">
                                <strong>Nguyễn Văn A</strong><br>
                                <i class="fas fa-phone text-success me-1"></i> 0901234567<br>
                                <i class="fas fa-envelope text-info me-1"></i> customer@email.com
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Địa chỉ giao hàng</h6>
                            <p class="mb-3">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                123 Đường ABC, Phường 1,<br>
                                Quận 1, TP. Hồ Chí Minh
                            </p>
                        </div>
                    </div>

                    <div class="bg-light rounded p-3">
                        <h6 class="mb-2">
                            <i class="fas fa-sticky-note text-warning me-2"></i>
                            Ghi chú đơn hàng
                        </h6>
                        <p class="mb-0 text-muted fst-italic">
                            Giao hàng vào buổi chiều. Gọi trước 15 phút.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Order Summary -->
            <div class="card shadow-sm border-0 mb-4" data-aos="fade-left">
                <div class="card-header bg-primary text-white">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-receipt me-2"></i>
                        Chi tiết đơn hàng
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Sample Order Items -->
                    <div class="order-item mb-3 pb-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <div class="product-image me-3">
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-mobile-alt text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 small">iPhone 15 Pro Max 256GB</h6>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">x1</small>
                                    <strong class="text-primary small">29.990.000đ</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-item mb-3 pb-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <div class="product-image me-3">
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-laptop text-secondary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 small">MacBook Air M2 13inch</h6>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">x1</small>
                                    <strong class="text-primary small">28.990.000đ</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Price Summary -->
                    <div class="price-summary">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <span>58.980.000đ</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển:</span>
                            <span class="text-success">Miễn phí</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Giảm giá:</span>
                            <span class="text-danger">-500.000đ</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Tổng cộng:</strong>
                            <strong class="text-primary h5">58.480.000đ</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Support -->
            <div class="card shadow-sm border-0 mb-4" data-aos="fade-left" data-aos-delay="200">
                <div class="card-header bg-success text-white">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-headset me-2"></i>
                        Hỗ trợ khách hàng
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="tel:18001234" class="btn btn-outline-success">
                            <i class="fas fa-phone me-2"></i>
                            Gọi hotline: 1800-1234
                        </a>
                        <button class="btn btn-outline-primary" onclick="openLiveChat()">
                            <i class="fas fa-comments me-2"></i>
                            Chat trực tuyến
                        </button>
                        <a href="mailto:support@TechTafu.com" class="btn btn-outline-info">
                            <i class="fas fa-envelope me-2"></i>
                            Gửi email hỗ trợ
                        </a>
                    </div>

                    <div class="mt-3 text-center">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            Hỗ trợ 24/7 - Luôn sẵn sàng giúp bạn
                        </small>
                    </div>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="card shadow-sm border-0" data-aos="fade-left" data-aos-delay="300">
                <div class="card-header bg-warning text-dark">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-bell me-2"></i>
                        Nhận thông báo
                    </h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-3">
                        Đăng ký nhận thông báo về khuyến mãi và sản phẩm mới
                    </p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email của bạn...">
                        <button class="btn btn-warning" type="button">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="smsNotification">
                        <label class="form-check-label small" for="smsNotification">
                            Nhận thông báo qua SMS
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommended Products -->
    <div class="mt-5">
        <div class="text-center mb-4" data-aos="fade-up">
            <h3>Sản phẩm có thể bạn quan tâm</h3>
            <p class="text-muted">Khám phá thêm các sản phẩm tuyệt vời khác</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="200">
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 product-card shadow-sm border-0">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-<?php echo ['mobile-alt', 'laptop', 'headphones', 'tablet-alt'][$i-1]; ?> fa-3x text-muted"></i>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title">Sản phẩm <?php echo $i; ?></h6>
                            <p class="card-text text-muted small flex-grow-1">
                                Mô tả ngắn về sản phẩm này...
                            </p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="h6 text-primary mb-0"><?php echo number_format(rand(1000000, 50000000), 0, ',', '.'); ?>đ</span>
                                    <div class="text-warning small">
                                        ★★★★★ (4.8)
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-cart-plus me-1"></i>Thêm vào giỏ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>

<!-- Celebration Modal -->
<div class="modal fade" id="celebrationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <div class="celebration-animation mb-4">
                    <i class="fas fa-gift fa-5x text-warning animate__animated animate__bounceIn"></i>
                </div>
                <h4 class="text-success mb-3">Chúc mừng!</h4>
                <p class="mb-4">Bạn đã đặt hàng thành công và sẽ nhận được ưu đãi đặc biệt!</p>
                <div class="coupon-code p-3 bg-light rounded mb-3">
                    <h5 class="text-primary mb-1">Mã giảm giá: <strong>WELCOME10</strong></h5>
                    <small class="text-muted">Giảm 10% cho đơn hàng tiếp theo</small>
                </div>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                    <i class="fas fa-check me-2"></i>Tuyệt vời!
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Show celebration modal after page load
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            const modal = new bootstrap.Modal(document.getElementById('celebrationModal'));
            modal.show();
        }, 2000);
    });

    // Track order function
    function trackOrder() {
        Swal.fire({
            title: 'Theo dõi đơn hàng',
            html: `
                <div class="text-start">
                    <p><strong>Mã đơn hàng:</strong> #DH00123456</p>
                    <p><strong>Trạng thái:</strong> <span class="badge bg-warning">Đang xử lý</span></p>
                    <p><strong>Dự kiến giao:</strong> ${new Date(Date.now() + 2*24*60*60*1000).toLocaleDateString('vi-VN')}</p>
                    <div class="progress mt-3">
                        <div class="progress-bar bg-success" style="width: 25%"></div>
                    </div>
                    <small class="text-muted">25% hoàn thành</small>
                </div>
            `,
            icon: 'info',
            confirmButtonText: 'Đóng'
        });
    }

    // Download invoice function
    function downloadInvoice() {
        Swal.fire({
            title: 'Tải hóa đơn',
            text: 'Hóa đơn đang được chuẩn bị...',
            icon: 'info',
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            toastr.success('Hóa đơn đã được tải xuống!');
        });
    }

    // Share order function
    function shareOrder() {
        if (navigator.share) {
            navigator.share({
                title: 'Đơn hàng TechTafu',
                text: 'Tôi vừa đặt hàng thành công tại TechTafu!',
                url: window.location.href
            });
        } else {
            // Fallback
            navigator.clipboard.writeText(window.location.href).then(() => {
                toastr.success('Đã sao chép link đơn hàng!');
            });
        }
    }

    // Open live chat
    function openLiveChat() {
        Swal.fire({
            title: 'Chat trực tuyến',
            html: `
                <div class="text-start">
                    <div class="chat-message mb-2 p-2 bg-light rounded">
                        <strong>Hỗ trợ:</strong> Xin chào! Tôi có thể giúp gì cho bạn?
                    </div>
                    <textarea class="form-control" rows="3" placeholder="Nhập tin nhắn của bạn..."></textarea>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Gửi tin nhắn',
            cancelButtonText: 'Đóng'
        }).then((result) => {
            if (result.isConfirmed) {
                toastr.success('Tin nhắn đã được gửi! Chúng tôi sẽ phản hồi sớm nhất.');
            }
        });
    }

    // Auto-scroll animation for timeline
    function animateTimeline() {
        const timelineSteps = document.querySelectorAll('.timeline-step');
        timelineSteps.forEach((step, index) => {
            setTimeout(() => {
                step.classList.add('animate__animated', 'animate__fadeInLeft');
            }, index * 300);
        });
    }

    // Initialize animations
    setTimeout(animateTimeline, 1000);

    // Confetti animation
    function createConfetti() {
        const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#ffeaa7'];
        for (let i = 0; i < 50; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + '%';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.animationDelay = Math.random() * 3 + 's';
            document.body.appendChild(confetti);
            
            setTimeout(() => {
                confetti.remove();
            }, 5000);
        }
    }

    // Trigger confetti on page load
    setTimeout(createConfetti, 1000);
</script>

<style>
    .success-circle {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #28a745, #20c997);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
        animation: pulse 2s infinite;
    }

    .success-circle i {
        font-size: 3rem;
        animation: bounceIn 1s ease-out;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    @keyframes bounceIn {
        0% { transform: scale(0); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .timeline-step {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        position: relative;
    }

    .timeline-step:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 20px;
        top: 40px;
        width: 2px;
        height: 30px;
        background: #dee2e6;
    }

    .timeline-step.active::after {
        background: #28a745;
    }

    .timeline-marker {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .timeline-content h6 {
        margin-bottom: 0.25rem;
    }

    .product-card {
        transition: all 0.3s ease;
        border: none;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .info-item {
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 0.5rem;
        height: 100%;
    }

    .confetti {
        position: fixed;
        width: 10px;
        height: 10px;
        z-index: 9999;
        animation: confetti-fall 3s linear infinite;
    }

    @keyframes confetti-fall {
        0% {
            transform: translateY(-100vh) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) rotate(720deg);
            opacity: 0;
        }
    }

    .celebration-animation {
        animation: tada 1s ease-in-out;
    }

    @keyframes tada {
        0% { transform: scale(1); }
        10%, 20% { transform: scale(0.9) rotate(-3deg); }
        30%, 50%, 70%, 90% { transform: scale(1.1) rotate(3deg); }
        40%, 60%, 80% { transform: scale(1.1) rotate(-3deg); }
        100% { transform: scale(1) rotate(0); }
    }

    .coupon-code {
        border: 2px dashed #007bff;
        position: relative;
        overflow: hidden;
    }

    .coupon-code::before {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        background: linear-gradient(45deg, transparent, rgba(0,123,255,0.1), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .order-item {
        transition: all 0.3s ease;
    }

    .order-item:hover {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 0.5rem;
        margin: -0.5rem;
    }

    .success-animation {
        position: relative;
    }

    .success-animation::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200px;
        height: 200px;
        border: 3px solid rgba(40, 167, 69, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        animation: ripple 2s infinite;
    }

    @keyframes ripple {
        0% {
            transform: translate(-50%, -50%) scale(0.8);
            opacity: 1;
        }
        100% {
            transform: translate(-50%, -50%) scale(1.5);
            opacity: 0;
        }
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .price-summary .d-flex {
        transition: all 0.3s ease;
    }

    .price-summary .d-flex:hover {
        background-color: #f8f9fa;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        margin: -0.25rem -0.5rem;
    }

    .timeline-step {
        transition: all 0.3s ease;
    }

    .timeline-step:hover {
        transform: translateX(5px);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .success-circle {
            width: 80px;
            height: 80px;
        }
        
        .success-circle i {
            font-size: 2rem;
        }
        
        .timeline-step {
            flex-direction: column;
            text-align: center;
        }
        
        .timeline-marker {
            margin-bottom: 0.5rem;
            margin-right: 0;
        }
        
        .timeline-step:not(:last-child)::after {
            display: none;
        }
        
        .info-item {
            margin-bottom: 1rem;
        }
        
        .btn {
            margin-bottom: 0.5rem;
        }
    }

    /* Loading Animation */
    .loading {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255,255,255,.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Hover Effects */
    .product-image:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease;
    }

    .badge {
        transition: all 0.3s ease;
    }

    .badge:hover {
        transform: scale(1.05);
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Print Styles */
    @media print {
        .btn, .modal, .confetti {
            display: none !important;
        }
        
        .card {
            border: 1px solid #000 !important;
            box-shadow: none !important;
        }
        
        .success-circle {
            background: #28a745 !important;
        }
    }
</style>

<?php include 'app/views/shares/footer.php'; ?>