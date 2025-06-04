<?php include 'app/views/shares/header.php'; ?>

<div class="row">
    <div class="col-lg-5" data-aos="fade-right">
        <div class="card shadow-lg" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);">
            <div class="card-body">
                <div class="product-gallery">
                    <img src="<?php echo $product->image ?: 'https://via.placeholder.com/500x500/1a1a2e/00d4ff?text=No+Image'; ?>" 
                         class="img-fluid rounded gallery-image" 
                         alt="<?php echo htmlspecialchars($product->name); ?>"
                         id="mainImage">
                    
                    <!-- Thumbnail images (if multiple images available) -->
                    <div class="mt-3">
                        <div class="swiper thumbSwiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="<?php echo $product->image ?: 'https://via.placeholder.com/100x100/1a1a2e/00d4ff?text=1'; ?>" 
                                         class="img-thumbnail thumb-img active">
                                </div>
                                <!-- Add more thumbnails if available -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-7" data-aos="fade-left">
        <div class="card shadow-lg" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h2 class="mb-0"><?php echo htmlspecialchars($product->name); ?></h2>
                    <span class="badge bg-primary">#<?php echo $product->id; ?></span>
                </div>
                
                <div class="mb-3">
                    <span class="badge bg-secondary me-2">
                        <i class="bi bi-tag me-1"></i><?php echo htmlspecialchars($product->category_name ?: 'Chưa phân loại'); ?>
                    </span>
                    <?php if($product->price > 10000000): ?>
                        <span class="badge bg-danger">Hot Deal</span>
                    <?php endif; ?>
                </div>
                
                <div class="price-section mb-4">
                    <h3 class="text-primary mb-0">
                        <?php echo number_format($product->price, 0, ',', '.'); ?>đ
                    </h3>
                    <p class="text-muted small">Giá đã bao gồm VAT</p>
                </div>
                
                <div class="description-section mb-4">
                    <h5 class="text-primary mb-3">
                        <i class="bi bi-info-circle me-2"></i>Mô tả sản phẩm
                    </h5>
                    <div class="p-3 rounded" style="background: rgba(255,255,255,0.05);">
                        <p class="mb-0"><?php echo nl2br(htmlspecialchars($product->description)); ?></p>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <button onclick="addToCart(<?php echo $product->id; ?>)" class="btn btn-success btn-lg hvr-grow me-2">
                        <i class="bi bi-cart-plus me-2"></i>Thêm vào giỏ hàng
                    </button>
                    <button class="btn btn-outline-primary btn-lg hvr-grow">
                        <i class="bi bi-bag-check me-2"></i>Mua ngay
                    </button>
                </div>
                
                <hr class="my-4">
                
                <div class="product-features">
                    <h5 class="text-primary mb-3">
                        <i class="bi bi-shield-check me-2"></i>Cam kết từ TechTafu
                    </h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="feature-item">
                                <i class="bi bi-patch-check-fill text-success me-2"></i>
                                <span>Hàng chính hãng 100%</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="feature-item">
                                <i class="bi bi-truck text-success me-2"></i>
                                <span>Miễn phí vận chuyển</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="feature-item">
                                <i class="bi bi-arrow-repeat text-success me-2"></i>
                                <span>Đổi trả trong 7 ngày</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="feature-item">
                                <i class="bi bi-shield-fill-check text-success me-2"></i>
                                <span>Bảo hành chính hãng</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="admin-actions mt-4 pt-4 border-top">
                    <a href="/Product" class="btn btn-secondary hvr-sweep-to-left me-2">
                        <i class="bi bi-arrow-left me-2"></i>Quay lại
                    </a>
                    <a href="/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning hvr-grow me-2">
                        <i class="bi bi-pencil me-2"></i>Chỉnh sửa
                    </a>
                    <button onclick="deleteProduct(<?php echo $product->id; ?>)" class="btn btn-danger hvr-grow">
                        <i class="bi bi-trash me-2"></i>Xóa
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Products Section -->
<div class="mt-5">
    <h3 class="mb-4" data-aos="fade-up">
        <i class="bi bi-grid-3x3-gap me-2"></i>Sản phẩm liên quan
    </h3>
    <div class="swiper relatedSwiper" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
            <!-- Sample related products -->
            <?php for($i = 1; $i <= 6; $i++): ?>
            <div class="swiper-slide">
                <div class="card product-card" style="background: var(--card-bg);">
                    <img src="https://via.placeholder.com/200x150/1a1a2e/00d4ff?text=Product+<?php echo $i; ?>" 
                         class="card-img-top" alt="Related Product">
                    <div class="card-body">
                        <h6 class="card-title text-truncate">Sản phẩm liên quan <?php echo $i; ?></h6>
                        <p class="text-primary mb-0">9.999.000đ</p>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<style>
.gallery-image {
    cursor: zoom-in;
    transition: transform 0.3s ease;
}

.gallery-image:hover {
    transform: scale(1.05);
}

.thumb-img {
    cursor: pointer;
    opacity: 0.6;
    transition: all 0.3s ease;
}

.thumb-img.active, .thumb-img:hover {
    opacity: 1;
    border: 2px solid var(--primary-color);
}

.feature-item {
    padding: 10px;
    background: rgba(255,255,255,0.05);
    border-radius: 5px;
    transition: all 0.3s ease;
}

.feature-item:hover {
    background: rgba(0,212,255,0.1);
    transform: translateY(-2px);
}

.product-card {
    height: 100%;
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 212, 255, 0.3);
}
</style>

<script>
// Initialize PhotoSwipe for gallery
const pswpElement = document.querySelectorAll('.pswp')[0];
const galleryImage = document.getElementById('mainImage');

galleryImage.addEventListener('click', function() {
    const items = [{
        src: this.src,
        w: 1200,
        h: 900
    }];
    
    const options = {
        index: 0,
        bgOpacity: 0.9,
        showHideOpacity: true
    };
    
    const gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();
});

// Initialize Swiper for thumbnails
const thumbSwiper = new Swiper('.thumbSwiper', {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
});

// Initialize Swiper for related products
const relatedSwiper = new Swiper('.relatedSwiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        1024: {
            slidesPerView: 4,
        },
    }
});

// Add to cart function
function addToCart(productId) {
    // Animation when adding to cart
    anime({
        targets: '.btn-success',
        scale: [1, 1.2, 1],
        duration: 600,
        easing: 'easeInOutQuad'
    });
    
    window.location.href = `/Product/addToCart/${productId}`;
}

// Delete product
function deleteProduct(id) {
    Swal.fire({
        title: 'Xác nhận xóa?',
        text: "Bạn có chắc chắn muốn xóa sản phẩm này?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy',
        background: 'var(--card-bg)',
        color: 'var(--text-light)'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/Product/delete/${id}`;
        }
    });
}
</script>

<?php include 'app/views/shares/footer.php'; ?>