<?php include 'app/views/shares/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);" data-aos="zoom-in">
            <div class="card-body text-center py-5">
                <!-- Success Animation -->
                <div id="success-animation" style="width: 250px; height: 250px; margin: 0 auto;"></div>
                
                <h2 class="mb-3 text-success">Đặt hàng thành công!</h2>
                <p class="text-muted mb-4">
                    Cảm ơn bạn đã tin tưởng và mua sắm tại TechTafu. 
                    Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.
                </p>
                
                <!-- Order Details -->
                <div class="order-details p-4 rounded mb-4" style="background: rgba(255,255,255,0.05);">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="text-start">
                                <label class="text-muted small">Mã đơn hàng</label>
                                <p class="mb-0 fw-bold">#DH<?php echo str_pad(rand(1000, 9999), 6, '0', STR_PAD_LEFT); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="text-start">
                                <label class="text-muted small">Thời gian đặt hàng</label>
                                <p class="mb-0 fw-bold"><?php echo date('d/m/Y H:i'); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="text-start">
                                <label class="text-muted small">Phương thức thanh toán</label>
                                <p class="mb-0 fw-bold">Thanh toán khi nhận hàng (COD)</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="text-start">
                                <label class="text-muted small">Trạng thái</label>
                                <p class="mb-0">
                                    <span class="badge bg-warning">Đang xử lý</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Timeline -->
                <div class="timeline mb-4">
                    <div class="timeline-item active">
                        <div class="timeline-icon">
                            <i class="bi bi-check"></i>
                        </div>
                        <div class="timeline-content">
                            <h6>Đơn hàng đã được tiếp nhận</h6>
                            <small class="text-muted">Vừa xong</small>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <i class="bi bi-box"></i>
                        </div>
                        <div class="timeline-content">
                            <h6>Đang chuẩn bị hàng</h6>
                            <small class="text-muted">Dự kiến: 1-2 ngày</small>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <div class="timeline-content">
                            <h6>Đang giao hàng</h6>
                            <small class="text-muted">Dự kiến: 3-5 ngày</small>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <i class="bi bi-house-check"></i>
                        </div>
                        <div class="timeline-content">
                            <h6>Giao hàng thành công</h6>
                            <small class="text-muted">Chờ xác nhận</small>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="d-flex justify-content-center gap-3">
                    <a href="/Product" class="btn btn-outline-primary hvr-float">
                        <i class="bi bi-bag-plus me-2"></i>Tiếp tục mua sắm
                    </a>
                    <a href="#" class="btn btn-primary hvr-float">
                        <i class="bi bi-list-check me-2"></i>Xem đơn hàng
                    </a>
                </div>
                
                <!-- Contact Info -->
                <div class="mt-4 pt-4 border-top">
                    <p class="text-muted mb-2">Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ:</p>
                    <p class="mb-0">
                        <i class="bi bi-telephone me-2"></i>Hotline: <strong>090 123 4567</strong> | 
                        <i class="bi bi-envelope me-2 ms-3"></i>Email: <strong>support@techtafu.com</strong>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Confetti Effect -->
        <canvas id="confetti-canvas" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 9999;"></canvas>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 2px;
    background: rgba(255,255,255,0.2);
    transform: translateX(-50%);
}

.timeline-item {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
    position: relative;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    position: relative;
    z-index: 1;
}

.timeline-item.active .timeline-icon {
    background: var(--primary-color);
    color: white;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(0, 212, 255, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(0, 212, 255, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(0, 212, 255, 0);
    }
}

.timeline-content {
    flex: 1;
    text-align: left;
}
</style>

<script>
// Lottie Success Animation
lottie.loadAnimation({
    container: document.getElementById('success-animation'),
    renderer: 'svg',
    loop: false,
    autoplay: true,
    path: 'https://assets5.lottiefiles.com/packages/lf20_lk80fpsm.json'
});

// Confetti Animation
const canvas = document.getElementById('confetti-canvas');
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const confetti = [];
const confettiCount = 150;
const gravity = 0.5;
const terminalVelocity = 5;
const drag = 0.075;
const colors = ['#00d4ff', '#ff6b35', '#764ba2', '#667eea', '#f093fb', '#4facfe'];

// Confetti class
class Confetto {
    constructor() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height - canvas.height;
        this.w = Math.random() * 10 + 5;
        this.h = this.w * 0.4;
        this.velocity = Math.random() * 3 + 2;
        this.angle = Math.random() * 360;
        this.angleVelocity = Math.random() * 0.2 - 0.1;
        this.color = colors[Math.floor(Math.random() * colors.length)];
        this.scale = 1;
        this.opacity = 1;
    }
    
    update() {
        this.velocity += gravity;
        this.velocity = Math.min(this.velocity, terminalVelocity);
        this.y += this.velocity;
        this.angle += this.angleVelocity;
        
        if (this.y > canvas.height) {
            this.y = -this.h;
            this.x = Math.random() * canvas.width;
            this.velocity = Math.random() * 3 + 2;
        }
    }
    
    draw() {
        ctx.save();
        ctx.translate(this.x, this.y);
        ctx.rotate(this.angle * Math.PI / 180);
        ctx.globalAlpha = this.opacity;
        ctx.fillStyle = this.color;
        ctx.fillRect(-this.w / 2, -this.h / 2, this.w, this.h);
        ctx.restore();
    }
}

// Initialize confetti
for (let i = 0; i < confettiCount; i++) {
    confetti.push(new Confetto());
}

// Animation loop
function animateConfetti() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    confetti.forEach(c => {
        c.update();
        c.draw();
    });
    
    requestAnimationFrame(animateConfetti);
}

animateConfetti();

// Stop confetti after 5 seconds
setTimeout(() => {
    canvas.style.display = 'none';
}, 5000);

// Show success notification
setTimeout(() => {
    toastr.success('Đơn hàng của bạn đã được ghi nhận!', 'Thành công', {
        timeOut: 5000,
        progressBar: true
    });
}, 1000);
</script>

<?php include 'app/views/shares/footer.php'; ?>