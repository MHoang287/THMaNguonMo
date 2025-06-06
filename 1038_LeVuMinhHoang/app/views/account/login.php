<?php
session_start();
$pageTitle = "Đăng Nhập";
require_once 'app/views/shares/header.php';
?>

<div class="min-vh-100 d-flex align-items-center py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card shadow-lg border-0" data-aos="fade-up">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="feature-icon mx-auto mb-3">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <h2 class="fw-bold text-dark">Đăng Nhập</h2>
                            <p class="text-muted">Chào mừng bạn quay trở lại TechTafu</p>
                        </div>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <?= htmlspecialchars($error) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="/account/checkLogin" method="POST" id="loginForm" novalidate>
                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">
                                    <i class="fas fa-user me-2 text-primary"></i>Tên đăng nhập
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="username" 
                                       name="username" 
                                       value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                                       placeholder="Nhập tên đăng nhập" 
                                       required>
                                <div class="invalid-feedback">
                                    Vui lòng nhập tên đăng nhập
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-2 text-primary"></i>Mật khẩu
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control form-control-lg" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Nhập mật khẩu" 
                                           required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập mật khẩu
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label text-muted" for="rememberMe">
                                        Ghi nhớ đăng nhập
                                    </label>
                                </div>
                                <a href="#" class="text-primary text-decoration-none" id="forgotPasswordLink">
                                    Quên mật khẩu?
                                </a>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>Đăng Nhập
                                </button>
                            </div>

                            <div class="text-center">
                                <p class="text-muted">
                                    Chưa có tài khoản? 
                                    <a href="/account/register" class="text-primary text-decoration-none fw-semibold">
                                        Đăng ký ngay
                                    </a>
                                </p>
                            </div>
                        </form>

                        <hr class="my-4">

                        <!-- Social Login Options -->
                        <div class="text-center">
                            <p class="text-muted mb-3">Hoặc đăng nhập với</p>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                    <i class="fab fa-facebook-f me-2"></i>Facebook
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                    <i class="fab fa-google me-2"></i>Google
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Access Cards -->
                <div class="row mt-4">
                    <div class="col-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card bg-transparent border-0 text-white text-center">
                            <div class="card-body p-2">
                                <i class="fas fa-shipping-fast fa-2x mb-2 text-warning"></i>
                                <small>Giao hàng nhanh</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card bg-transparent border-0 text-white text-center">
                            <div class="card-body p-2">
                                <i class="fas fa-medal fa-2x mb-2 text-success"></i>
                                <small>Chất lượng cao</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card bg-transparent border-0 text-white text-center">
                            <div class="card-body p-2">
                                <i class="fas fa-undo fa-2x mb-2 text-info"></i>
                                <small>Đổi trả dễ dàng</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Toggle password visibility
    $('#togglePassword').click(function() {
        const passwordField = $('#password');
        const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        
        const icon = $(this).find('i');
        icon.toggleClass('fa-eye fa-eye-slash');
    });

    // Form validation
    $('#loginForm').on('submit', function(e) {
        let isValid = true;
        
        // Validate username
        const username = $('#username').val().trim();
        if (!username) {
            $('#username').addClass('is-invalid');
            isValid = false;
        } else {
            $('#username').removeClass('is-invalid').addClass('is-valid');
        }

        // Validate password
        const password = $('#password').val().trim();
        if (!password) {
            $('#password').addClass('is-invalid');
            isValid = false;
        } else {
            $('#password').removeClass('is-invalid').addClass('is-valid');
        }

        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Vui lòng điền đầy đủ thông tin đăng nhập!'
            });
            return;
        }

        // Show loading
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...');
        submitBtn.prop('disabled', true);

        // Re-enable button after 3 seconds (in case of errors)
        setTimeout(() => {
            submitBtn.html(originalText);
            submitBtn.prop('disabled', false);
        }, 3000);
    });

    // Remove validation classes on input
    $('#username, #password').on('input', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Handle forgot password
    $('#forgotPasswordLink').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Quên mật khẩu?',
            text: 'Vui lòng liên hệ quản trị viên để được hỗ trợ khôi phục mật khẩu.',
            icon: 'info',
            confirmButtonText: 'Đã hiểu',
            confirmButtonColor: '#3498db'
        });
    });

    // Handle social login (demo)
    $('.btn-outline-primary, .btn-outline-danger').click(function() {
        const platform = $(this).text().trim();
        Swal.fire({
            title: 'Tính năng đang phát triển',
            text: `Đăng nhập với ${platform} sẽ sớm được cập nhật!`,
            icon: 'info',
            confirmButtonText: 'Đã hiểu'
        });
    });

    // Auto-focus first input
    $('#username').focus();
});
</script>

<?php require_once 'app/views/shares/footer.php'; ?>