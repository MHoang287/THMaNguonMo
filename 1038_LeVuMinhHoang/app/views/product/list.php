<?php 
$pageTitle = "Danh Sách Sản Phẩm";
include_once 'app/views/shares/header.php'; 
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-4">
                    Khám Phá Thế Giới <span class="text-warning">Công Nghệ</span>
                </h1>
                <p class="lead mb-4">
                    Tìm kiếm những sản phẩm điện tử chất lượng cao với giá cả hợp lý. 
                    Từ smartphone đến laptop, tất cả đều có tại TechTafu.
                </p>
                <div class="d-flex gap-3">
                    <a href="/Product/add" class="btn btn-warning btn-lg">
                        <i class="fas fa-plus me-2"></i>Thêm Sản Phẩm
                    </a>
                    <a href="#products" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-arrow-down me-2"></i>Xem Sản Phẩm
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="swiper hero-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://via.placeholder.com/600x400/3498db/ffffff?text=Laptop+Gaming" 
                                 alt="Laptop Gaming" class="img-fluid rounded-3">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://via.placeholder.com/600x400/e74c3c/ffffff?text=Smartphone" 
                                 alt="Smartphone" class="img-fluid rounded-3">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://via.placeholder.com/600x400/27ae60/ffffff?text=Tablet" 
                                 alt="Tablet" class="img-fluid rounded-3">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                <div class="stats-card">
                    <i class="fas fa-laptop fa-3x mb-3"></i>
                    <h3 class="counter" data-count="<?= count($products) ?>">0</h3>
                    <p class="mb-0">Sản Phẩm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-card">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h3 class="counter" data-count="0">0</h3>
                    <p class="mb-0">Khách Hàng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-card">
                    <i class="fas fa-truck fa-3x mb-3"></i>
                    <h3 class="counter" data-count="0">0</h3>
                    <p class="mb-0">Đơn Hàng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-card">
                    <i class="fas fa-star fa-3x mb-3"></i>
                    <h3 class="counter" data-count="0">0</h3>
                    <p class="mb-0">Đánh Giá</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section id="products" class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6 mx-auto text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">Sản Phẩm Nổi Bật</h2>
                <p class="lead text-muted">
                    Khám phá bộ sưu tập sản phẩm điện tử hàng đầu của chúng tôi
                </p>
            </div>
        </div>

        <!-- Filter and Sort -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="productSearch" placeholder="Tìm kiếm sản phẩm...">
                </div>
            </div>
            <div class="col-lg-3">
                <select class="form-select" id="categoryFilter">
                    <option value="">Tất cả danh mục</option>
                    <!-- Populate with categories -->
                </select>
            </div>
            <div class="col-lg-3">
                <select class="form-select" id="sortBy">
                    <option value="name">Tên A-Z</option>
                    <option value="price-low">Giá thấp đến cao</option>
                    <option value="price-high">Giá cao đến thấp</option>
                </select>
            </div>
        </div>

        <div class="row" id="productsContainer">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $index => $product): ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                        <div class="card product-card h-100">
                            <div class="position-relative">
                                <img src="<?= !empty($product->image) ? $product->image : 'https://via.placeholder.com/300x250/f8f9fa/6c757d?text=No+Image' ?>" 
                                     class="card-img-top glightbox" 
                                     alt="<?= htmlspecialchars($product->name) ?>"
                                     data-gallery="products">
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-primary"><?= htmlspecialchars($product->category_name ?? 'Chưa phân loại') ?></span>
                                </div>
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold"><?= htmlspecialchars($product->name) ?></h5>
                                <p class="card-text text-muted flex-grow-1"><?= htmlspecialchars(substr($product->description, 0, 100)) ?>...</p>
                                <div class="price mb-3"><?= number_format($product->price) ?> VNĐ</div>
                                
                                <div class="btn-group w-100" role="group">
                                    <a href="/Product/show/<?= $product->id ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/Product/addToCart/<?= $product->id ?>" class="btn btn-primary flex-grow-1">
                                        <i class="fas fa-cart-plus me-1"></i>Thêm vào giỏ
                                    </a>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="/Product/edit/<?= $product->id ?>">
                                                <i class="fas fa-edit me-2"></i>Chỉnh sửa
                                            </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#" onclick="deleteProduct(<?= $product->id ?>)">
                                                <i class="fas fa-trash me-2"></i>Xóa
                                            </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="text-center py-5" data-aos="fade-up">
                        <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                        <h3 class="text-muted">Chưa có sản phẩm nào</h3>
                        <p class="text-muted mb-4">Hãy thêm sản phẩm đầu tiên để bắt đầu!</p>
                        <a href="/Product/add" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>Thêm Sản Phẩm
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
// Initialize Hero Swiper
const heroSwiper = new Swiper('.hero-swiper', {
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});

// Animate counters
document.querySelectorAll('.counter').forEach(counter => {
    const target = parseInt(counter.getAttribute('data-count'));
    animateValue(counter, 0, target, 2000);
});

// Product search and filter
function filterProducts() {
    const searchTerm = document.getElementById('productSearch').value.toLowerCase();
    const categoryFilter = document.getElementById('categoryFilter').value;
    const sortBy = document.getElementById('sortBy').value;
    
    // Implement filtering logic here
}

document.getElementById('productSearch').addEventListener('input', filterProducts);
document.getElementById('categoryFilter').addEventListener('change', filterProducts);
document.getElementById('sortBy').addEventListener('change', filterProducts);

// Delete product function
function deleteProduct(id) {
    Swal.fire({
        title: 'Bạn có chắc chắn?',
        text: "Sản phẩm sẽ bị xóa vĩnh viễn!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/Product/delete/' + id;
        }
    });
}
</script>

<?php include_once 'app/views/shares/footer.php'; ?>