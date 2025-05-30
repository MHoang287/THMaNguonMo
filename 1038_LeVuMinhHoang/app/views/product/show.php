<?php
$title = "Chi tiết sản phẩm - " . ($product->name ?? 'Không tìm thấy');
include_once 'app/views/shares/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="/Product" class="text-white-50">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="/Product" class="text-white-50">Sản phẩm</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Chi tiết</li>
                    </ol>
                </nav>
                <h1 class="h2 mb-0 animate__animated animate__fadeInLeft">
                    <i class="fas fa-eye me-2"></i>Chi tiết sản phẩm
                </h1>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="btn-group animate__animated animate__fadeInRight" role="group">
                    <a href="/Product" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                    <a href="/Product/edit/<?php echo $product->id; ?>" class="btn btn-outline-light">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-lg-6 mb-4" data-aos="fade-right">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-0">
                    <div class="position-relative">
                        <?php if (!empty($product->image) && file_exists($product->image)): ?>
                            <img src="/<?php echo htmlspecialchars($product->image); ?>" 
                                 class="card-img-top rounded" 
                                 alt="<?php echo htmlspecialchars($product->name); ?>"
                                 style="height: 400px; object-fit: cover;">
                        <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center bg-light rounded" 
                                 style="height: 400px;">
                                <div class="text-center text-muted">
                                    <i class="fas fa-image fa-4x mb-3"></i>
                                    <p class="mb-0">Chưa có hình ảnh</p>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Category Badge -->
                        <?php if (!empty($product->category_name)): ?>
                            <span class="category-badge position-absolute top-0 start-0 m-3">
                                <i class="fas fa-tag me-1"></i><?php echo htmlspecialchars($product->category_name); ?>
                            </span>
                        <?php endif; ?>
                        
                        <!-- Product ID Badge -->
                        <span class="position-absolute top-0 end-0 m-3 badge bg-dark">
                            ID: <?php echo $product->id; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Information -->
        <div class="col-lg-6" data-aos="fade-left">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Thông tin sản phẩm
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <!-- Product Name -->
                    <h2 class="h3 mb-3 text-primary">
                        <?php echo htmlspecialchars($product->name); ?>
                    </h2>
                    
                    <!-- Price -->
                    <div class="mb-4">
                        <h3 class="h2 text-danger mb-0">
                            <i class="fas fa-tag me-2"></i><?php echo number_format($product->price, 0, ',', '.'); ?>₫
                        </h3>
                        <small class="text-muted">Giá bán lẻ đã bao gồm VAT</small>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="mb-4">
                        <h5 class="text-secondary mb-3">
                            <i class="fas fa-clipboard-list me-2"></i>Thông tin chi tiết
                        </h5>
                        
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="p-3 bg-light rounded">
                                    <small class="text-muted d-block">Danh mục</small>
                                    <strong><?php echo htmlspecialchars($product->category_name ?? 'Chưa phân loại'); ?></strong>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded">
                                    <small class="text-muted d-block">Mã sản phẩm</small>
                                    <strong>SP<?php echo str_pad($product->id, 4, '0', STR_PAD_LEFT); ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-4">
                        <h5 class="text-secondary mb-3">
                            <i class="fas fa-align-left me-2"></i>Mô tả sản phẩm
                        </h5>
                        <div class="p-3 bg-light rounded">
                            <p class="mb-0 text-justify" style="white-space: pre-line;">
                                <?php echo htmlspecialchars($product->description); ?>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <button onclick="addToCart(<?php echo $product->id; ?>)" 
                                class="btn btn-success btn-lg flex-fill">
                            <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                        </button>
                        <button class="btn btn-outline-primary btn-lg" onclick="shareProduct()">
                            <i class="fas fa-share-alt me-2"></i>Chia sẻ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Management Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" data-aos="fade-up">
                <div class="card-header bg-secondary text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i>Quản lý sản phẩm
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="/Product/edit/<?php echo $product->id; ?>" 
                               class="btn btn-warning w-100">
                                <i class="fas fa-edit me-2"></i>Chỉnh sửa
                            </a>
                        </div>
                        <div class="col-md-3">
                            <button onclick="confirmDelete('/Product/delete/<?php echo $product->id; ?>', 'Bạn có chắc chắn muốn xóa sản phẩm này?')" 
                                    class="btn btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>Xóa sản phẩm
                            </button>
                        </div>
                        <div class="col-md-3">
                            <a href="/Product/add" class="btn btn-success w-100">
                                <i class="fas fa-plus me-2"></i>Thêm sản phẩm mới
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="/Product" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-list me-2"></i>Danh sách sản phẩm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Features -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-star me-2"></i>Ưu điểm nổi bật
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-shield-alt fa-lg"></i>
                                </div>
                                <h6 class="fw-bold">Bảo hành chính hãng</h6>
                                <p class="text-muted small mb-0">Bảo hành 12-24 tháng</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-shipping-fast fa-lg"></i>
                                </div>
                                <h6 class="fw-bold">Giao hàng nhanh</h6>
                                <p class="text-muted small mb-0">Miễn phí giao hàng</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-medal fa-lg"></i>
                                </div>
                                <h6 class="fw-bold">Chất lượng cao</h6>
                                <p class="text-muted small mb-0">100% hàng chính hãng</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-headset fa-lg"></i>
                                </div>
                                <h6 class="fw-bold">Hỗ trợ 24/7</h6>
                                <p class="text-muted small mb-0">Tư vấn chuyên nghiệp</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Share product function
    function shareProduct() {
        const productName = '<?php echo addslashes($product->name); ?>';
        const productPrice = '<?php echo number_format($product->price, 0, ',', '.'); ?>₫';
        const currentUrl = window.location.href;
        
        if (navigator.share) {
            navigator.share({
                title: `${productName} - TechTafu`,
                text: `Xem sản phẩm ${productName} với giá ${productPrice} tại TechTafu`,
                url: currentUrl
            }).then(() => {
                toastr.success('Đã chia sẻ sản phẩm!');
            }).catch((error) => {
                console.log('Error sharing:', error);
                fallbackShare();
            });
        } else {
            fallbackShare();
        }
    }

    function fallbackShare() {
        const shareData = {
            facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`,
            twitter: `https://twitter.com/intent/tweet?url=${encodeURIComponent(window.location.href)}&text=${encodeURIComponent('Xem sản phẩm tại TechTafu')}`,
            whatsapp: `https://wa.me/?text=${encodeURIComponent('Xem sản phẩm này: ' + window.location.href)}`
        };

        Swal.fire({
            title: 'Chia sẻ sản phẩm',
            html: `
                <div class="d-flex justify-content-center gap-3">
                    <a href="${shareData.facebook}" target="_blank" class="btn btn-primary">
                        <i class="fab fa-facebook-f me-2"></i>Facebook
                    </a>
                    <a href="${shareData.twitter}" target="_blank" class="btn btn-info">
                        <i class="fab fa-twitter me-2"></i>Twitter
                    </a>
                    <a href="${shareData.whatsapp}" target="_blank" class="btn btn-success">
                        <i class="fab fa-whatsapp me-2"></i>WhatsApp
                    </a>
                </div>
                <div class="mt-3">
                    <input type="text" class="form-control" value="${window.location.href}" onclick="this.select()" readonly>
                    <small class="text-muted">Hoặc copy link trên để chia sẻ</small>
                </div>
            `,
            showConfirmButton: false,
            showCloseButton: true,
            width: '500px'
        });
    }

    // Add zoom effect to product image
    document.addEventListener('DOMContentLoaded', function() {
        const productImage = document.querySelector('.card-img-top');
        if (productImage) {
            productImage.addEventListener('click', function() {
                Swal.fire({
                    imageUrl: this.src,
                    imageAlt: this.alt,
                    showConfirmButton: false,
                    showCloseButton: true,
                    customClass: {
                        image: 'img-fluid'
                    }
                });
            });
            
            // Add cursor pointer
            productImage.style.cursor = 'pointer';
            productImage.title = 'Click để xem ảnh lớn';
        }
    });

    // Price animation on page load
    document.addEventListener('DOMContentLoaded', function() {
        const priceElement = document.querySelector('.text-danger.h2');
        if (priceElement) {
            priceElement.classList.add('animate__animated', 'animate__pulse');
        }
    });

    // Auto-scroll to product on page load if coming from list
    if (document.referrer.includes('/Product') && !document.referrer.includes('/Product/show/')) {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                window.scrollTo({
                    top: 200,
                    behavior: 'smooth'
                });
            }, 500);
        });
    }
</script>

<?php include_once 'app/views/shares/footer.php'; ?>