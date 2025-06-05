<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle . ' - ' : '' ?>TechTafu - Thiết Bị Điện Tử Chính Hãng</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootswatch Theme -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/flatly/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- GLightbox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <!-- Choices.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/ui-lightness/jquery-ui.css">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --dark-color: #34495e;
            --light-bg: #ecf0f1;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: var(--primary-color) !important;
        }
        
        .navbar-brand i {
            color: var(--secondary-color);
            margin-right: 8px;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.5;
        }
        
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--secondary-color), #5dade2);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
        }
        
        .product-card {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
        }
        
        .product-card .card-img-top {
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .product-card:hover .card-img-top {
            transform: scale(1.05);
        }
        
        .price {
            font-size: 1.4rem;
            font-weight: bold;
            color: var(--accent-color);
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }
        
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
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--secondary-color), #5dade2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: white;
        }

        /* Swiper Styles */
        .hero-swiper {
            width: 100%;
            height: 400px;
        }

        .hero-swiper .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.5);
        }

        .swiper-pagination-bullet-active {
            background: white;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-microchip"></i>TechTafu
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="fas fa-home me-1"></i>Trang Chủ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-laptop me-1"></i>Sản Phẩm
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/Product"><i class="fas fa-list me-2"></i>Tất Cả Sản Phẩm</a></li>
                            <li><a class="dropdown-item" href="/Product/add"><i class="fas fa-plus me-2"></i>Thêm Sản Phẩm</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-tags me-1"></i>Danh Mục
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/category/list"><i class="fas fa-list me-2"></i>Tất Cả Danh Mục</a></li>
                            <li><a class="dropdown-item" href="/category/create"><i class="fas fa-plus me-2"></i>Thêm Danh Mục</a></li>
                        </ul>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm..." id="searchInput">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    
                    <a href="/Product/cart" class="btn btn-outline-primary position-relative me-2">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-badge" id="cartCount">
                            <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                        </span>
                    </a>
                    
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle me-2"></i>Tài Khoản</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Cài Đặt</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Đăng Xuất</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= $_SESSION['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?= $_SESSION['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['errors'])): ?>
        <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <ul class="mb-0">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <!-- Scripts - Moved before closing body tag -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS - Load before usage -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- GLightbox -->
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <!-- Choices.js -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <!-- Anime.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <script>
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-in-out',
                    once: true
                });
            }

            // Initialize GLightbox
            if (typeof GLightbox !== 'undefined') {
                const lightbox = GLightbox({
                    selector: '.glightbox'
                });
            }

            // Initialize tooltips
            if (typeof bootstrap !== 'undefined') {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }
        });

        // jQuery ready function
        $(document).ready(function() {
            // Back to top button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('#backToTop').fadeIn();
                } else {
                    $('#backToTop').fadeOut();
                }
            });

            $('#backToTop').click(function() {
                $('html, body').animate({scrollTop: 0}, 600);
                return false;
            });

            // Search functionality
            $('#searchInput').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                // Implement search logic here
                console.log('Searching for:', searchTerm);
            });

            // Auto-hide alerts
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 5000);
        });

        // Animate numbers function
        function animateValue(element, start, end, duration) {
            if (typeof anime !== 'undefined') {
                anime({
                    targets: element,
                    innerHTML: [start, end],
                    easing: 'easeInOutQuad',
                    duration: duration,
                    round: 1
                });
            }
        }

        // Initialize Swiper function (for pages that use it)
        function initializeSwiper(selector, options = {}) {
            if (typeof Swiper !== 'undefined') {
                const defaultOptions = {
                    loop: true,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    }
                };
                
                const mergedOptions = { ...defaultOptions, ...options };
                return new Swiper(selector, mergedOptions);
            }
            return null;
        }

        // Cart functions
        function updateCartCount() {
            fetch('/Product/getCartInfo', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('cartCount').textContent = data.data.cart_info.product_count || 0;
                }
            })
            .catch(error => {
                console.error('Error updating cart count:', error);
            });
        }

        // Add to cart function
        function addToCart(productId) {
            fetch(`/Product/addToCart/${productId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartCount();
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        alert(data.message);
                    }
                } else {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: data.message
                        });
                    } else {
                        alert(data.message);
                    }
                }
            })
            .catch(error => {
                console.error('Error adding to cart:', error);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng'
                    });
                }
            });
        }

        // Global error handler
        window.addEventListener('error', function(e) {
            console.error('JavaScript Error:', e.error);
        });
    </script>