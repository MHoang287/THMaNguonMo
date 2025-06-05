<?php require_once 'app/views/shares/header.php'; ?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($product->name) ?></li>
        </ol>
    </div>
</nav>

<!-- Product Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Product Images -->
            <div class="col-lg-6" data-aos="fade-right">
                <div class="product-images">
                    <div class="main-image mb-3">
                        <?php if($product->image): ?>
                            <a href="<?= htmlspecialchars($product->image) ?>" class="glightbox">
                                <img src="<?= htmlspecialchars($product->image) ?>" class="img-fluid rounded shadow" alt="<?= htmlspecialchars($product->name) ?>" id="mainImage">
                            </a>
                        <?php else: ?>
                            <img src="https://via.placeholder.com/600x600/f8f9fa/6c757d?text=No+Image" class="img-fluid rounded shadow" alt="No Image">
                        <?php endif; ?>
                    </div>
                    
                    <!-- Thumbnail Gallery -->
                    <div class="swiper thumbSwiper">
                        <div class="swiper-wrapper">
                            <?php for($i = 1; $i <= 4; $i++): ?>
                                <div class="swiper-slide">
                                    <img src="https://via.placeholder.com/150x150/<?= dechex(rand(0x000000, 0xFFFFFF)) ?>/FFFFFF?text=Image+<?= $i ?>" 
                                         class="img-fluid rounded cursor-pointer" 
                                         onclick="changeMainImage(this.src)"
                                         alt="Thumbnail <?= $i ?>">
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6" data-aos="fade-left">
                <div class="product-info">
                    <p class="text-muted mb-2">
                        <i class="bi bi-tag"></i> <?= htmlspecialchars($product->category_name ?? 'Chưa phân loại') ?>
                    </p>
                    
                    <h1 class="h2 mb-3"><?= htmlspecialchars($product->name) ?></h1>
                    
                    <!-- Rating -->
                    <div class="rating mb-3">
                        <?php $rating = rand(4,5); ?>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <i class="bi bi-star<?= $i <= $rating ? '-fill' : '' ?> text-warning"></i>
                        <?php endfor; ?>
                        <span class="ms-2 text-muted">(<?= rand(10,200) ?> đánh giá)</span>
                    </div>
                    
                    <!-- Price -->
                    <div class="price-section mb-4 p-3 bg-light rounded">
                        <div class="d-flex align-items-center gap-3">
                            <h3 class="text-primary mb-0"><?= number_format($product->price, 0, ',', '.') ?>₫</h3>
                            <?php if(rand(0,1)): ?>
                                <span class="text-muted text-decoration-line-through"><?= number_format($product->price * 1.2, 0, ',', '.') ?>₫</span>
                                <span class="badge bg-danger">-20%</span>
                            <?php endif; ?>
                        </div>
                        <p class="mb-0 mt-2 text-success"><i class="bi bi-check-circle"></i> Còn hàng</p>
                    </div>
                    
                    <!-- Description -->
                    <div class="description mb-4">
                        <h5 class="mb-3">Mô tả sản phẩm</h5>
                        <p class="text-muted"><?= nl2br(htmlspecialchars($product->description)) ?></p>
                    </div>
                    
                    <!-- Key Features -->
                    <div class="features mb-4">
                        <h5 class="mb-3">Tính năng nổi bật</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check2 text-success"></i> Bảo hành chính hãng 12 tháng</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success"></i> Đổi trả trong 7 ngày</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success"></i> Miễn phí vận chuyển toàn quốc</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success"></i> Hỗ trợ trả góp 0% lãi suất</li>
                        </ul>
                    </div>
                    
                    <!-- Quantity and Add to Cart -->
                    <div class="action-section">
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Số lượng:</label>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input type="number" class="form-control text-center" id="quantity" value="1" min="1" max="99">
                                    <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3 mb-4">
                            <a href="/Product/addToCart/<?= $product->id ?>" class="btn btn-primary btn-lg flex-fill">
                                <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                            </a>
                            <button class="btn btn-outline-danger btn-lg" onclick="addToWishlist(<?= $product->id ?>)">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                        
                        <div class="d-grid">
                            <a href="/Product/checkout" class="btn btn-success btn-lg">
                                <i class="bi bi-lightning"></i> Mua ngay
                            </a>
                        </div>
                    </div>
                    
                    <!-- Share -->
                    <div class="share-section mt-4 pt-4 border-top">
                        <span class="me-3">Chia sẻ:</span>
                        <a href="#" class="text-primary me-2"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-info me-2"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-danger me-2"><i class="fab fa-pinterest fa-lg"></i></a>
                        <a href="#" class="text-success"><i class="fab fa-whatsapp fa-lg"></i></a>
                    </div>
                    
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
                        <div class="admin-actions mt-4 pt-4 border-top">
                            <h6 class="text-muted mb-3">Quản trị viên</h6>
                            <div class="d-flex gap-2">
                                <a href="/Product/edit/<?= $product->id ?>" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Chỉnh sửa
                                </a>
                                <button onclick="deleteProduct(<?= $product->id ?>)" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Xóa sản phẩm
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Product Tabs -->
        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button">
                            <i class="bi bi-list-ul"></i> Thông số kỹ thuật
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button">
                            <i class="bi bi-star"></i> Đánh giá
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="warranty-tab" data-bs-toggle="tab" data-bs-target="#warranty" type="button">
                            <i class="bi bi-shield-check"></i> Bảo hành
                        </button>
                    </li>
                </ul>
                
                <div class="tab-content border border-top-0 p-4" id="productTabContent">
                    <div class="tab-pane fade show active" id="specs" role="tabpanel">
                        <h5 class="mb-3">Thông số kỹ thuật</h5>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th width="30%">Thương hiệu</th>
                                    <td>Apple</td>
                                </tr>
                                <tr>
                                    <th>Model</th>
                                    <td>iPhone 15 Pro Max</td>
                                </tr>
                                <tr>
                                    <th>Màn hình</th>
                                    <td>6.7 inch Super Retina XDR OLED</td>
                                </tr>
                                <tr>
                                    <th>CPU</th>
                                    <td>Apple A17 Pro</td>
                                </tr>
                                <tr>
                                    <th>RAM</th>
                                    <td>8GB</td>
                                </tr>
                                <tr>
                                    <th>Bộ nhớ trong</th>
                                    <td>256GB</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <h5 class="mb-4">Đánh giá từ khách hàng</h5>
                        
                        <!-- Review Summary -->
                        <div class="row mb-4">
                            <div class="col-md-4 text-center">
                                <h1 class="display-3 mb-0">4.5</h1>
                                <div class="rating mb-2">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <i class="bi bi-star<?= $i <= 4 ? '-fill' : '' ?> text-warning"></i>
                                    <?php endfor; ?>
                                </div>
                                <p class="text-muted">Dựa trên 125 đánh giá</p>
                            </div>
                            <div class="col-md-8">
                                <!-- Rating bars -->
                                <?php for($stars = 5; $stars >= 1; $stars--): ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="me-2"><?= $stars ?> <i class="bi bi-star-fill text-warning small"></i></span>
                                        <div class="progress flex-grow-1 me-2" style="height: 10px;">
                                            <div class="progress-bar bg-warning" style="width: <?= rand(20, 90) ?>%"></div>
                                        </div>
                                        <span class="text-muted small"><?= rand(10, 50) ?></span>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        
                        <!-- Sample Reviews -->
                        <?php for($i = 1; $i <= 3; $i++): ?>
                            <div class="review-item border-bottom pb-3 mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <strong>Nguyễn Văn A</strong>
                                        <div class="rating small">
                                            <?php for($j = 1; $j <= 5; $j++): ?>
                                                <i class="bi bi-star<?= $j <= rand(4,5) ? '-fill' : '' ?> text-warning"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <small class="text-muted"><?= rand(1,30) ?> ngày trước</small>
                                </div>
                                <p class="mb-0">Sản phẩm rất tốt, đúng như mô tả. Giao hàng nhanh, đóng gói cẩn thận.</p>
                            </div>
                        <?php endfor; ?>
                        
                        <button class="btn btn-outline-primary">Xem thêm đánh giá</button>
                    </div>
                    
                    <div class="tab-pane fade" id="warranty" role="tabpanel">
                        <h5 class="mb-3">Chính sách bảo hành</h5>
                        <ul>
                            <li>Bảo hành chính hãng 12 tháng tại trung tâm bảo hành ủy quyền</li>
                            <li>1 đổi 1 trong 30 ngày đầu nếu có lỗi phần cứng từ nhà sản xuất</li>
                            <li>Bảo hành pin 12 tháng</li>
                            <li>Không bảo hành các lỗi do người dùng: rơi vỡ, vào nước, can thiệp phần cứng</li>
                        </ul>
                        
                        <h5 class="mt-4 mb-3">Quy trình bảo hành</h5>
                        <ol>
                            <li>Khách hàng mang sản phẩm đến cửa hàng TechTafu</li>
                            <li>Nhân viên kiểm tra và lập phiếu bảo hành</li>
                            <li>Thời gian bảo hành từ 3-7 ngày tùy lỗi</li>
                            <li>Khách hàng nhận sản phẩm sau khi sửa chữa</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="mb-4">Sản phẩm liên quan</h3>
                <div class="swiper relatedSwiper">
                    <div class="swiper-wrapper">
                        <?php for($i = 1; $i <= 8; $i++): ?>
                            <div class="swiper-slide">
                                <div class="card h-100 shadow-sm border-0">
                                    <img src="https://via.placeholder.com/300x300/<?= dechex(rand(0x000000, 0xFFFFFF)) ?>/FFFFFF?text=Product+<?= $i ?>" 
                                         class="card-img-top" alt="Related Product <?= $i ?>">
                                    <div class="card-body">
                                        <h6 class="card-title text-truncate">Sản phẩm liên quan <?= $i ?></h6>
                                        <p class="text-primary mb-0"><?= number_format(rand(1000000, 50000000), 0, ',', '.') ?>₫</p>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.thumbSwiper .swiper-slide {
    cursor: pointer;
    opacity: 0.6;
    transition: all 0.3s ease;
}

.thumbSwiper .swiper-slide:hover,
.thumbSwiper .swiper-slide.active {
    opacity: 1;
}

.main-image img {
    cursor: zoom-in;
}

.tab-content {
    background: #f8f9fa;
}

.review-item:last-child {
    border-bottom: none !important;
}
</style>

<?php
$additionalScripts = '
<script>
// Initialize Swiper for thumbnails
var thumbSwiper = new Swiper(".thumbSwiper", {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
});

// Initialize Swiper for related products
var relatedSwiper = new Swiper(".relatedSwiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
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

// Change main image
function changeMainImage(src) {
    document.getElementById("mainImage").src = src;
    anime({
        targets: "#mainImage",
        scale: [0.9, 1],
        duration: 300,
        easing: "easeOutQuad"
    });
}

// Quantity controls
function increaseQuantity() {
    var input = document.getElementById("quantity");
    var value = parseInt(input.value);
    if(value < 99) {
        input.value = value + 1;
    }
}

function decreaseQuantity() {
    var input = document.getElementById("quantity");
    var value = parseInt(input.value);
    if(value > 1) {
        input.value = value - 1;
    }
}

// Add to wishlist
function addToWishlist(productId) {
    anime({
        targets: event.target.closest("button"),
        scale: [1, 1.3, 1],
        duration: 300,
        easing: "easeInOutQuad"
    });
    
    Swal.fire({
        icon: "success",
        title: "Đã thêm vào yêu thích!",
        showConfirmButton: false,
        timer: 1500
    });
}

// Delete product (Admin)
function deleteProduct(id) {
    Swal.fire({
        title: "Xác nhận xóa?",
        text: "Bạn có chắc chắn muốn xóa sản phẩm này?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/Product/delete/" + id;
        }
    });
}

// Initialize GLightbox
const lightbox = GLightbox({
    selector: ".glightbox"
});
</script>
';
?>

<?php require_once 'app/views/shares/footer.php'; ?>