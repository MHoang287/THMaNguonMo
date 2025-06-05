<?php require_once 'app/views/shares/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section bg-gradient py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 text-white fw-bold mb-4">Khám phá công nghệ mới nhất</h1>
                <p class="lead text-white-50 mb-4">Hàng ngàn sản phẩm điện tử chính hãng với giá tốt nhất</p>
                <div class="d-flex gap-3">
                    <a href="#products" class="btn btn-light btn-lg rounded-pill px-4">
                        <i class="bi bi-shop"></i> Mua ngay
                    </a>
                    <a href="/category/list" class="btn btn-outline-light btn-lg rounded-pill px-4">
                        <i class="bi bi-grid"></i> Xem danh mục
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="swiper heroSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://via.placeholder.com/600x400/FF6B6B/FFFFFF?text=iPhone+15+Pro" class="img-fluid rounded-3 shadow" alt="Featured Product">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://via.placeholder.com/600x400/4ECDC4/FFFFFF?text=MacBook+Pro+M3" class="img-fluid rounded-3 shadow" alt="Featured Product">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://via.placeholder.com/600x400/45B7D1/FFFFFF?text=Samsung+Galaxy+S24" class="img-fluid rounded-3 shadow" alt="Featured Product">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3" data-aos="fade-up">
                <div class="text-center">
                    <i class="bi bi-truck fs-1 text-primary"></i>
                    <h6 class="mt-2">Miễn phí vận chuyển</h6>
                    <small class="text-muted">Đơn hàng từ 500k</small>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <i class="bi bi-shield-check fs-1 text-success"></i>
                    <h6 class="mt-2">Bảo hành chính hãng</h6>
                    <small class="text-muted">Cam kết 100%</small>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <i class="bi bi-arrow-repeat fs-1 text-warning"></i>
                    <h6 class="mt-2">Đổi trả dễ dàng</h6>
                    <small class="text-muted">Trong vòng 7 ngày</small>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <i class="bi bi-headset fs-1 text-info"></i>
                    <h6 class="mt-2">Hỗ trợ 24/7</h6>
                    <small class="text-muted">Hotline: 1900 1234</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section id="products" class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-6">
                <h2 class="fw-bold" data-aos="fade-right">Tất cả sản phẩm</h2>
                <p class="text-muted" data-aos="fade-right" data-aos-delay="100">Khám phá bộ sưu tập thiết bị điện tử đa dạng của chúng tôi</p>
            </div>
            <div class="col-lg-6 text-lg-end" data-aos="fade-left">
                <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
                    <a href="/Product/add" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-plus-circle"></i> Thêm sản phẩm mới
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Filter and Sort -->
        <div class="row mb-4">
            <div class="col-md-4" data-aos="fade-up">
                <select class="form-select" id="categoryFilter">
                    <option value="">Tất cả danh mục</option>
                    <?php
                    $db = (new Database())->getConnection();
                    $categoryModel = new CategoryModel($db);
                    $categories = $categoryModel->getCategories();
                    foreach($categories as $category): ?>
                        <option value="<?= $category->id ?>"><?= htmlspecialchars($category->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <select class="form-select" id="sortBy">
                    <option value="newest">Mới nhất</option>
                    <option value="price-asc">Giá thấp đến cao</option>
                    <option value="price-desc">Giá cao đến thấp</option>
                    <option value="name-asc">Tên A-Z</option>
                </select>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchProduct" placeholder="Tìm kiếm sản phẩm...">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row g-4" id="productsGrid">
            <?php if(empty($products)): ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-box-seam fs-1 text-muted"></i>
                    <p class="mt-3 text-muted">Chưa có sản phẩm nào</p>
                </div>
            <?php else: ?>
                <?php foreach($products as $product): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 product-item" data-aos="fade-up" data-category="<?= $product->category_id ?>">
                        <div class="card h-100 shadow-sm border-0 product-card">
                            <div class="position-relative overflow-hidden">
                                <?php if($product->image): ?>
                                    <img src="<?= htmlspecialchars($product->image) ?>" class="card-img-top product-image" alt="<?= htmlspecialchars($product->name) ?>">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/300x300/f8f9fa/6c757d?text=No+Image" class="card-img-top product-image" alt="No Image">
                                <?php endif; ?>
                                <div class="product-overlay">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="/Product/show/<?= $product->id ?>" class="btn btn-light btn-sm rounded-circle" data-bs-toggle="tooltip" title="Xem chi tiết">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button class="btn btn-light btn-sm rounded-circle" onclick="addToCart(<?= $product->id ?>)" data-bs-toggle="tooltip" title="Thêm vào giỏ">
                                            <i class="bi bi-cart-plus"></i>
                                        </button>
                                        <button class="btn btn-light btn-sm rounded-circle" onclick="addToWishlist(<?= $product->id ?>)" data-bs-toggle="tooltip" title="Yêu thích">
                                            <i class="bi bi-heart"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php if(rand(0,1)): ?>
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-2">-<?= rand(10,30) ?>%</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small mb-1"><?= htmlspecialchars($product->category_name ?? 'Chưa phân loại') ?></p>
                                <h5 class="card-title text-truncate"><?= htmlspecialchars($product->name) ?></h5>
                                <p class="card-text small text-muted text-truncate"><?= htmlspecialchars($product->description) ?></p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="h5 text-primary mb-0"><?= number_format($product->price, 0, ',', '.') ?>₫</span>
                                        <?php if(rand(0,1)): ?>
                                            <br><small class="text-muted text-decoration-line-through"><?= number_format($product->price * 1.2, 0, ',', '.') ?>₫</small>
                                        <?php endif; ?>
                                    </div>
                                    <div class="rating">
                                        <?php $rating = rand(3,5); ?>
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <i class="bi bi-star<?= $i <= $rating ? '-fill' : '' ?> text-warning small"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0 p-3">
                                <div class="d-grid gap-2">
                                    <a href="/Product/addToCart/<?= $product->id ?>" class="btn btn-primary btn-sm">
                                        <i class="bi bi-cart-plus"></i> Thêm vào giỏ
                                    </a>
                                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
                                        <div class="btn-group" role="group">
                                            <a href="/Product/edit/<?= $product->id ?>" class="btn btn-outline-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button onclick="deleteProduct(<?= $product->id ?>)" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation" class="mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Trước</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Sau</a>
                </li>
            </ul>
        </nav>
    </div>
</section>

<style>
.product-card {
    transition: all 0.3s ease;
    height: 100%;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.product-image {
    height: 250px;
    object-fit: cover;
    transition: all 0.3s ease;
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.product-card:hover .product-image {
    transform: scale(1.1);
}

.rating i {
    font-size: 0.8rem;
}
</style>

<?php
$additionalScripts = '
<script>
// Initialize Swiper
var swiper = new Swiper(".heroSwiper", {
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    loop: true,
});

// Initialize Choices.js for select
const categorySelect = new Choices("#categoryFilter", {
    searchEnabled: false,
    itemSelectText: "",
});

const sortSelect = new Choices("#sortBy", {
    searchEnabled: false,
    itemSelectText: "",
});

// Product filtering
$("#categoryFilter").change(function() {
    var selectedCategory = $(this).val();
    if(selectedCategory === "") {
        $(".product-item").show();
    } else {
        $(".product-item").hide();
        $(".product-item[data-category=\"" + selectedCategory + "\"]").show();
    }
});

// Product search
$("#searchProduct").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".product-item").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

// Add to cart function
function addToCart(productId) {
    $.ajax({
        url: "/Product/addToCart/" + productId,
        method: "POST",
        success: function(response) {
            Swal.fire({
                icon: "success",
                title: "Thành công!",
                text: "Đã thêm sản phẩm vào giỏ hàng",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                location.reload();
            });
        }
    });
}

// Add to wishlist function
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

// Initialize GLightbox for product images
const lightbox = GLightbox({
    selector: ".glightbox"
});
</script>
';
?>

<?php require_once 'app/views/shares/footer.php'; ?>