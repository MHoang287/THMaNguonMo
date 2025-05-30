<?php
$title = "Đặt hàng thành công";
include_once 'app/views/shares/header.php';
?>

<!-- Success Header -->
<div class="page-header">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="animate__animated animate__bounceIn">
                    <i class="fas fa-check-circle text-white" style="font-size: 4rem;"></i>
                </div>
                <h1 class="h2 mt-3 mb-2 animate__animated animate__fadeInUp">
                    Đặt hàng thành công!
                </h1>
                <p class="lead mb-0 animate__animated animate__fadeInUp animate__delay-1s">
                    Cảm ơn bạn đã tin tướng và mua sắm tại TechTafu
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Success Message -->
            <div class="card border-0 shadow-lg mb-4" data-aos="fade-up">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-check text-white fa-2x"></i>
                        </div>
                    </div>
                    
                    <h3 class="text-success mb-3">Đơn hàng đã được ghi nhận!</h3>
                    <p class="text-muted mb-4">
                        Chúng tôi đã nhận được đơn hàng của bạn và sẽ xử lý trong thời gian sớm nhất. 
                        Bạn sẽ nhận được cuộc gọi xác nhận từ nhân viên trong vòng 30 phút.
                    </p>
                    
                    <div class="row g-3 justify-content-center">
                        <div class="col-auto">
                            <a href="/Product" class="btn btn-primary btn-lg">
                                <i class="fas fa-shopping-bag me-2"></i>Tiếp tục mua sắm
                            </a>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-outline-success btn-lg" onclick="printOrder()">
                                <i class="fas fa-print me-2"></i>In đơn hàng
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order Timeline -->
            <div class="card border-0 shadow-lg mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock me-2"></i>Tiến trình đơn hàng
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <div class="timeline">
                        <div class="timeline-item active">
                            <div class="timeline-marker bg-success">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Đặt hàng thành công</h6>
                                <small class="text-muted">
                                    <?php echo date('d/m/Y H:i'); ?> - Đơn hàng đã được ghi nhận
                                </small>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Xác nhận đơn hàng</h6>
                                <small class="text-muted">Trong vòng 30 phút - Nhân viên sẽ gọi xác nhận</small>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info">
                                <i class="fas fa-box text-white"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Chuẩn bị hàng</h6>
                                <small class="text-muted">1-2 giờ - Đóng gói và chuẩn bị giao hàng</small>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary">
                                <i class="fas fa-shipping-fast text-white"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Giao hàng</h6>
                                <small class="text-muted">1-3 ngày - Giao hàng tận nơi</small>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-marker bg-secondary">
                                <i class="fas fa-handshake text-white"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Hoàn thành</h6>
                                <small class="text-muted">Giao hàng thành công</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="card border-0 shadow-lg mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-headset me-2"></i>Thông tin liên hệ
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Hotline hỗ trợ</h6>
                                    <p class="mb-0 text-primary fw-bold">1900 1234</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-success text-white rounded-circle me-3 d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Email hỗ trợ</h6>
                                    <p class="mb-0 text-success fw-bold">support@techtafu.com</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="alert alert-info mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Lưu ý:</strong> Nếu không nhận được cuộc gọi xác nhận trong vòng 1 giờ, 
                                vui lòng liên hệ hotline để được hỗ trợ.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Social Share -->
            <div class="card border-0 shadow-lg" data-aos="fade-up" data-aos-delay="300">
                <div class="card-body text-center py-4">
                    <h6 class="mb-3">Chia sẻ trải nghiệm mua sắm</h6>
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn btn-primary btn-sm" onclick="shareToFacebook()">
                            <i class="fab fa-facebook-f me-2"></i>Facebook
                        </button>
                        <button class="btn btn-info btn-sm" onclick="shareToTwitter()">
                            <i class="fab fa-twitter me-2"></i>Twitter
                        </button>
                        <button class="btn btn-success btn-sm" onclick="shareToWhatsApp()">
                            <i class="fab fa-whatsapp me-2"></i>WhatsApp
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Buttons -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1000;">
    <div class="d-flex flex-column gap-2">
        <button class="btn btn-success rounded-circle" onclick="callSupport()" title="Gọi hỗ trợ">
            <i class="fas fa-phone"></i>
        </button>
        <button class="btn btn-primary rounded-circle" onclick="openChat()" title="Chat hỗ trợ">
            <i class="fas fa-comments"></i>
        </button>
    </div>
</div>

<style>
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #dee2e6;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 30px;
    }
    
    .timeline-item:last-child {
        margin-bottom: 0;
    }
    
    .timeline-marker {
        position: absolute;
        left: -22px;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .timeline-item.active .timeline-marker {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
    }
    
    .timeline-content {
        padding-left: 20px;
    }
    
    .form-check-card .form-check-input:checked + .form-check-label .card {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    }
    
    .form-check-card .card {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .form-check-card .card:hover {
        transform: translateY(-2px);
    }
</style>

<script>
    // Print order function
    function printOrder() {
        const printContent = `
            <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
                <div style="text-align: center; margin-bottom: 30px;">
                    <h1 style="color: #007bff;">TechTafu</h1>
                    <h2>XÁC NHẬN ĐƠN HÀNG</h2>
                </div>
                
                <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                    <h3>Thông tin đơn hàng</h3>
                    <p><strong>Ngày đặt:</strong> ${new Date().toLocaleDateString('vi-VN')}</p>
                    <p><strong>Trạng thái:</strong> Đã xác nhận</p>
                </div>
                
                <div style="text-align: center; margin-top: 30px;">
                    <p>Cảm ơn bạn đã mua sắm tại TechTafu!</p>
                    <p>Hotline: 1900 1234 | Email: support@techtafu.com</p>
                </div>
            </div>
        `;
        
        const newWindow = window.open('', '_blank');
        newWindow.document.write(`
            <html>
                <head>
                    <title>Đơn hàng - TechTafu</title>
                    <style>
                        body { margin: 0; padding: 20px; }
                        @media print { body { margin: 0; } }
                    </style>
                </head>
                <body>
                    ${printContent}
                    <script>
                        window.onload = function() {
                            window.print();
                            window.close();
                        }
                    </script>
                </body>
            </html>
        `);
    }

    // Social sharing functions
    function shareToFacebook() {
        const url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.origin)}`;
        window.open(url, '_blank', 'width=600,height=400');
    }

    function shareToTwitter() {
        const text = 'Vừa mua sắm tại TechTafu - Thiết bị điện tử chính hãng!';
        const url = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(window.location.origin)}`;
        window.open(url, '_blank', 'width=600,height=400');
    }

    function shareToWhatsApp() {
        const text = 'Vừa đặt hàng thành công tại TechTafu - Thiết bị điện tử chính hãng!';
        const url = `https://wa.me/?text=${encodeURIComponent(text)}`;
        window.open(url, '_blank');
    }

    // Support functions
    function callSupport() {
        window.location.href = 'tel:19001234';
    }

    function openChat() {
        Swal.fire({
            title: 'Hỗ trợ trực tuyến',
            html: `
                <div class="text-start">
                    <p class="mb-3">Chúng tôi sẵn sàng hỗ trợ bạn!</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" onclick="window.open('https://wa.me/84901234567', '_blank')">
                            <i class="fab fa-whatsapp me-2"></i>Chat qua WhatsApp
                        </button>
                        <button class="btn btn-primary" onclick="window.open('https://m.me/techtafu', '_blank')">
                            <i class="fab fa-facebook-messenger me-2"></i>Chat qua Messenger
                        </button>
                        <button class="btn btn-info" onclick="window.location.href='tel:19001234'">
                            <i class="fas fa-phone me-2"></i>Gọi hotline: 1900 1234
                        </button>
                    </div>
                </div>
            `,
            showConfirmButton: false,
            showCloseButton: true,
            width: '400px'
        });
    }

    // Auto redirect to homepage after 5 minutes
    setTimeout(() => {
        Swal.fire({
            title: 'Chuyển hướng',
            text: 'Bạn sẽ được chuyển về trang chủ sau 10 giây nữa',
            icon: 'info',
            timer: 10000,
            timerProgressBar: true,
            showCancelButton: true,
            confirmButtonText: 'Chuyển ngay',
            cancelButtonText: 'Ở lại'
        }).then((result) => {
            if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
                window.location.href = '/Product';
            }
        });
    }, 300000); // 5 minutes

    // Confetti animation on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Create confetti effect
        const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#f9ca24', '#6c5ce7'];
        
        for (let i = 0; i < 50; i++) {
            setTimeout(() => {
                createConfetti();
            }, i * 50);
        }
        
        function createConfetti() {
            const confetti = document.createElement('div');
            confetti.style.position = 'fixed';
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.top = '-10px';
            confetti.style.width = '10px';
            confetti.style.height = '10px';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.borderRadius = '50%';
            confetti.style.pointerEvents = 'none';
            confetti.style.zIndex = '9999';
            confetti.style.animation = `fall ${2 + Math.random() * 3}s linear forwards`;
            
            document.body.appendChild(confetti);
            
            setTimeout(() => {
                confetti.remove();
            }, 5000);
        }
        
        // Add CSS animation for confetti
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fall {
                to {
                    transform: translateY(100vh) rotate(360deg);
                }
            }
        `;
        document.head.appendChild(style);
    });

    // Play success sound (optional)
    function playSuccessSound() {
        const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmNQDAiHzvLCfiwBHnfE8OWTQwocYbrm7apYFgdGnt72yHMhBTOH0fO8ai0BHnnFjkfveFwrPnPE8OdQQAoUXrPp66hVFApGnz3zvmNQDAiHzvK6fSwBHnfE8OWTQwocYbnm7apYFgdGntz2yHMhBTOH0fO8ai0BHnnF8OdQQAoUXrPp66hVFApGnz3zvmNQDAiHzvK6fSwBHnfE8OWUIwocYbnm7apYFgdGntz2yHMhBTOH0fO8ai0BHnnF8OdQQAoUXrPp66hVFApGnz3zvmNQDAiHzvK6fSwBHnfE8OWUIwocYbnm7apYFgdGntz2yHMhBTOH0fO8ai0BHnnF8OdQQAoUXrPp66kiBhxgotPhUfqwY2EcBTGX7PJN/w2UjwrgciIB');
        audio.play().catch(() => {
            // Ignore if audio can't be played
        });
    }

    // Call success sound on load
    setTimeout(playSuccessSound, 1000);
</script>

<?php include_once 'app/views/shares/footer.php'; ?>