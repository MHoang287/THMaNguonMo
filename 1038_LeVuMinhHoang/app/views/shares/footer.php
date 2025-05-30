</main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                    <h5><i class="fas fa-bolt me-2"></i>TechTafu</h5>
                    <p class="text-light">Cửa hàng thiết bị điện tử hàng đầu với các sản phẩm chất lượng cao và dịch vụ tốt nhất.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <h6>Liên kết nhanh</h6>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-light text-decoration-none">Trang chủ</a></li>
                        <li><a href="/Product" class="text-light text-decoration-none">Sản phẩm</a></li>
                        <li><a href="/category/list" class="text-light text-decoration-none">Danh mục</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Liên hệ</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <h6>Hỗ trợ khách hàng</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Chính sách bảo hành</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Hướng dẫn mua hàng</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Chính sách đổi trả</a></li>
                        <li><a href="#" class="text-light text-decoration-none">FAQ</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <h6>Thông tin liên hệ</h6>
                    <div class="contact-info">
                        <p class="text-light mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            123 Đường ABC, Quận 1, TP.HCM
                        </p>
                        <p class="text-light mb-2">
                            <i class="fas fa-phone me-2"></i>
                            (028) 1234 5678
                        </p>
                        <p class="text-light mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            info@TechTafu.com
                        </p>
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-light mb-0">&copy; 2025 TechTafu. Tất cả quyền được bảo lưu.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-light mb-0">Thiết kế bởi <strong>TechTafu Team</strong></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="btn btn-primary position-fixed bottom-0 end-0 m-4 rounded-circle" style="display: none; z-index: 1000;">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Toastr configuration
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // Back to top button
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#backToTop').fadeIn();
            } else {
                $('#backToTop').fadeOut();
            }
        });

        $('#backToTop').click(function() {
            $('html, body').animate({scrollTop: 0}, 800);
        });

        // Smooth scrolling for anchor links
        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
            }
        });

        // Loading animation for buttons
        $('.btn').on('click', function() {
            var $btn = $(this);
            if (!$btn.hasClass('no-loading')) {
                $btn.addClass('disabled');
                var originalText = $btn.html();
                $btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...');
                
                setTimeout(function() {
                    $btn.removeClass('disabled').html(originalText);
                }, 2000);
            }
        });

        // Auto-hide alerts
        $('.alert').each(function() {
            var $alert = $(this);
            setTimeout(function() {
                $alert.fadeOut('slow');
            }, 5000);
        });

        // Card hover effects
        $('.card').hover(
            function() {
                $(this).addClass('shadow-lg');
            },
            function() {
                $(this).removeClass('shadow-lg');
            }
        );

        // Form validation enhancement
        $('form').on('submit', function() {
            var $form = $(this);
            var $submitBtn = $form.find('button[type="submit"]');
            
            $submitBtn.prop('disabled', true);
            $submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...');
        });

        // Price formatting
        $('.price').each(function() {
            var price = parseFloat($(this).text().replace(/[^\d.-]/g, ''));
            if (!isNaN(price)) {
                $(this).text(new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(price));
            }
        });

        // Search functionality enhancement
        $('.search-box').on('input', function() {
            var query = $(this).val();
            if (query.length > 2) {
                // Add search suggestions or live search here
                $(this).addClass('border-primary');
            } else {
                $(this).removeClass('border-primary');
            }
        });

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Initialize popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });

        // Custom delete confirmation
        function confirmDelete(message = 'Bạn có chắc chắn muốn xóa?') {
            return Swal.fire({
                title: 'Xác nhận xóa',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            });
        }

        // Add to cart animation
        function addToCartAnimation(button) {
            var $btn = $(button);
            var originalText = $btn.html();
            
            $btn.html('<i class="fas fa-check me-2"></i>Đã thêm!');
            $btn.removeClass('btn-primary').addClass('btn-success');
            
            setTimeout(function() {
                $btn.html(originalText);
                $btn.removeClass('btn-success').addClass('btn-primary');
            }, 2000);
        }
    </script>

    <?php if (isset($additional_scripts)): ?>
        <?php echo $additional_scripts; ?>
    <?php endif; ?>
</body>
</html>