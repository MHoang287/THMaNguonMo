<!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                    <h5 class="mb-3">
                        <i class="fas fa-bolt me-2"></i>TechTafu
                    </h5>
                    <p class="text-light">
                        Cửa hàng thiết bị điện tử hàng đầu với các sản phẩm chính hãng, 
                        chất lượng cao và dịch vụ tận tâm.
                    </p>
                    <div class="social-links">
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <h6 class="mb-3">Liên kết</h6>
                    <ul class="list-unstyled">
                        <li><a href="/Product" class="text-light text-decoration-none">Trang chủ</a></li>
                        <li><a href="/Product" class="text-light text-decoration-none">Sản phẩm</a></li>
                        <li><a href="/category/list" class="text-light text-decoration-none">Danh mục</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Liên hệ</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <h6 class="mb-3">Hỗ trợ</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Chính sách bảo hành</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Chính sách đổi trả</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Hướng dẫn mua hàng</a></li>
                        <li><a href="#" class="text-light text-decoration-none">FAQ</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <h6 class="mb-3">Liên hệ</h6>
                    <ul class="list-unstyled text-light">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            123 Đường ABC, Quận 1, TP.HCM
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            (028) 1234 5678
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            info@techtafu.com
                        </li>
                        <li>
                            <i class="fas fa-clock me-2"></i>
                            T2-CN: 8:00 - 22:00
                        </li>
                    </ul>
                </div>
            </div>
            
            <hr class="border-light">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-light">
                        &copy; <?php echo date('Y'); ?> TechTafu. Tất cả quyền được bảo lưu.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <img src="https://via.placeholder.com/40x25/007bff/ffffff?text=VISA" alt="Visa" class="me-2">
                    <img src="https://via.placeholder.com/40x25/ff6b35/ffffff?text=MC" alt="Mastercard" class="me-2">
                    <img src="https://via.placeholder.com/40x25/00457c/ffffff?text=PP" alt="PayPal">
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Toastr configuration
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            preventDuplicates: false,
            onclick: null,
            showDuration: '300',
            hideDuration: '1000',
            timeOut: '5000',
            extendedTimeOut: '1000',
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut'
        };

        // Loading overlay functions
        function showLoading() {
            $('#loading').fadeIn();
        }

        function hideLoading() {
            $('#loading').fadeOut();
        }

        // Add to cart function with AJAX
        function addToCart(productId) {
            showLoading();
            
            $.ajax({
                url: '/Product/addToCart',
                type: 'POST',
                data: {
                    product_id: productId
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    hideLoading();
                    if (response.success) {
                        toastr.success(response.message);
                        // Update cart count in navbar
                        updateCartCount(response.cart_count);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    hideLoading();
                    toastr.error('Có lỗi xảy ra. Vui lòng thử lại!');
                }
            });
        }

        // Update cart count in navbar
        function updateCartCount(count) {
            const cartLink = $('.nav-link[href="/Product/cart"]');
            const existingBadge = cartLink.find('.cart-badge');
            
            if (count > 0) {
                if (existingBadge.length) {
                    existingBadge.text(count);
                } else {
                    cartLink.find('i').after('<span class="cart-badge">' + count + '</span>');
                }
            } else {
                existingBadge.remove();
            }
        }

        // Confirm delete function
        function confirmDelete(url, message = 'Bạn có chắc chắn muốn xóa?') {
            Swal.fire({
                title: 'Xác nhận xóa',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    window.location.href = url;
                }
            });
        }

        // Format currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(amount);
        }

        // Smooth scroll for anchor links
        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 5000);

        // Form validation enhancement
        $('form').on('submit', function() {
            const submitBtn = $(this).find('button[type="submit"]');
            if (submitBtn.length) {
                submitBtn.prop('disabled', true);
                const originalText = submitBtn.text();
                submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...');
                
                setTimeout(function() {
                    submitBtn.prop('disabled', false);
                    submitBtn.text(originalText);
                }, 3000);
            }
        });

        // Price formatting on page load
        $(document).ready(function() {
            $('.price').each(function() {
                const price = parseFloat($(this).text().replace(/[^\d]/g, ''));
                if (!isNaN(price)) {
                    $(this).text(formatCurrency(price));
                }
            });
        });

        // Back to top button
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                if ($('#backToTop').length === 0) {
                    $('body').append(`
                        <button id="backToTop" class="btn btn-primary rounded-circle position-fixed" 
                                style="bottom: 30px; right: 30px; z-index: 1000; width: 50px; height: 50px;">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                    `);
                }
            } else {
                $('#backToTop').remove();
            }
        });

        // Back to top click handler
        $(document).on('click', '#backToTop', function() {
            $('html, body').animate({scrollTop: 0}, 'slow');
        });

        // Image lazy loading fallback
        $('img').on('error', function() {
            $(this).attr('src', 'https://via.placeholder.com/300x200/f8f9fa/6c757d?text=No+Image');
        });

    </script>
</body>
</html>