<?php
// Khởi tạo session ở đầu file
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'TechTafu - Thiết Bị Điện Tử'; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootswatch Theme (Lux) -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/lux/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/ui-lightness/jquery-ui.css">
    
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .navbar-nav .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
            transform: translateY(-2px);
        }
        
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
            margin-bottom: 40px;
        }
        
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .btn {
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        .product-card {
            height: 100%;
            transition: all 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .product-image {
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
        }
        
        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
        }
        
        .category-badge {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .search-box {
            border-radius: 25px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .search-box:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        .admin-sidebar {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .admin-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateX(5px);
        }
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 0;
            }
            
            .product-image {
                height: 200px;
            }
        }
    </style>
    
    <!-- jQuery (required by toastr and other plugins) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

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

        // Global confirm delete function using SweetAlert2
        function confirmDelete(message) {
            return Swal.fire({
                title: 'Xác nhận xóa',
                text: message || 'Bạn có chắc chắn muốn xóa?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            });
        }

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand animate__animated animate__fadeInLeft" href="/">
                <i class="fas fa-bolt me-2"></i>TechTafu
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="fas fa-home me-1"></i>Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Product"><i class="fas fa-mobile-alt me-1"></i>Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/category/list"><i class="fas fa-tags me-1"></i>Danh mục</a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center">
                    <!-- Search Box -->
                    <form class="d-flex me-3" method="GET" action="/Product">
                        <input class="form-control search-box" type="search" placeholder="Tìm kiếm sản phẩm..." name="search" style="width: 250px;">
                        <button class="btn btn-outline-light ms-2" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    
                    <!-- Cart -->
                    <a href="/Product/cart" class="btn btn-outline-light me-2 position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                            <span class="visually-hidden">items in cart</span>
                        </span>
                    </a>
                    
                    <!-- Admin Panel -->
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-cog me-1"></i>Quản trị
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/Product/add"><i class="fas fa-plus me-1"></i>Thêm sản phẩm</a></li>
                            <li><a class="dropdown-item" href="/category/create"><i class="fas fa-plus me-1"></i>Thêm danh mục</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/Product"><i class="fas fa-list me-1"></i>Quản lý sản phẩm</a></li>
                            <li><a class="dropdown-item" href="/category/list"><i class="fas fa-list me-1"></i>Quản lý danh mục</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success('<?php echo $_SESSION['success']; ?>');
            });
        </script>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.error('<?php echo $_SESSION['error']; ?>');
            });
        </script>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['errors'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    toastr.error('<?php echo $error; ?>');
                <?php endforeach; ?>
            });
        </script>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="main-content">