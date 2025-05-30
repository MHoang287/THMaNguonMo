<?php
$title = "Danh sách sản phẩm";
include_once 'app/views/shares/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInUp">
                    Thiết bị điện tử chính hãng
                </h1>
                <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                    Khám phá bộ sưu tập thiết bị điện tử hiện đại với chất lượng tốt nhất và giá cả cạnh tranh
                </p>
                <div class="d-flex flex-wrap gap-3 animate__animated animate__fadeInUp animate__delay-2s">
                    <a href="#products" class="btn btn-light btn-lg px-4">
                        <i class="fas fa-shopping-bag me-2"></i>Mua ngay
                    </a>
                    <a href="/category/list" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-list me-2"></i>Danh mục
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="text-center">
                    <i class="fas fa-mobile-alt" style="font-size: 12rem; opacity: 0.1;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search and Filter Section -->
<div class="container mt-5" id="products">
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm" data-aos="fade-up">
                <div class="card-body p-4">
                    <form class="row g-3" method="GET">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm..." 
                                       name="search" value="<?php echo $_GET['search'] ?? ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" name="category">
                                <option value="">Tất cả danh mục</option>
                                <!-- Categories sẽ được load từ database -->
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-filter me-1"></i>Lọc
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products Grid -->
<div class="container mb-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0" data-aos="fade-right">
                    <i class="fas fa-box-open me-2 text-primary"></i>Sản phẩm nổi bật
                </h2>
                <a href="/Product/add" class="btn btn-primary" data-aos="fade-left">
                    <i class="fas fa-plus me-2"></i>Thêm sản phẩm
                </a>
            </div>
        </div>
    </div>

    <?php if (empty($products)): ?>
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5" data-aos="fade-up">
                    <i class="fas fa-box-open text-muted" style="font-size: 4rem;"></i>
                    <h4 class="mt-3 text-muted">Chưa có sản phẩm nào</h4>
                    <p class="text-muted">Hãy thêm sản phẩm đầu tiên của bạn</p>
                    <a href="/Product/add" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Thêm sản phẩm mới
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($products as $index => $product): ?>
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                    <div class="product-card card h-100">
                        <div class="position-relative overflow-hidden">
                            <?php if (!empty($product->image) && file_exists($product->image)): ?>
                                <img src="/<?php echo htmlspecialchars($product->image); ?>" 
                                     class="product-image" 
                                     alt="<?php echo htmlspecialchars($product->name); ?>">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/300x200/f8f9fa/6c757d?text=<?php echo urlencode($product->name); ?>" 
                                     class="product-image" 
                                     alt="<?php echo htmlspecialchars($product->name); ?>">
                            <?php endif; ?>
                            
                            <!-- Category Badge -->
                            <?php if (!empty($product->category_name)): ?>
                                <span class="category-badge position-absolute top-0 start-0 m-2">
                                    <?php echo htmlspecialchars($product->category_name); ?>
                                </span>
                            <?php endif; ?>
                            
                            <!-- Quick Actions -->
                            <div class="position-absolute top-0 end-0 m-2">
                                <div class="btn-group-vertical" role="group">
                                    <a href="/Product/show/<?php echo $product->id; ?>" 
                                       class="btn btn-sm btn-light rounded-circle mb-1" 
                                       title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/Product/edit/<?php echo $product->id; ?>" 
                                       class="btn btn-sm btn-warning rounded-circle mb-1" 
                                       title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="confirmDelete('/Product/delete/<?php echo $product->id; ?>', 'Bạn có chắc chắn muốn xóa sản phẩm này?')" 
                                            class="btn btn-sm btn-danger rounded-circle" 
                                            title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-bold mb-2">
                                <?php echo htmlspecialchars($product->name); ?>
                            </h6>
                            
                            <p class="card-text text-muted small flex-grow-1 mb-3">
                                <?php echo htmlspecialchars(substr($product->description, 0, 80)) . (strlen($product->description) > 80 ? '...' : ''); ?>
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="price h5 mb-0">
                                    <?php echo number_format($product->price, 0, ',', '.'); ?>₫
                                </span>
                                <button onclick="addToCart(<?php echo $product->id; ?>)" 
                                        class="btn btn-primary btn-sm">
                                    <i class="fas fa-cart-plus me-1"></i>Mua
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="0">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 60px; height: 60px;">
                        <i class="fas fa-shipping-fast fa-lg"></i>
                    </div>
                    <h6 class="fw-bold">Giao hàng nhanh</h6>
                    <p class="text-muted small">Giao hàng trong 24h tại TP.HCM</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 60px; height: 60px;">
                        <i class="fas fa-shield-alt fa-lg"></i>
                    </div>
                    <h6 class="fw-bold">Bảo hành chính hãng</h6>
                    <p class="text-muted small">Bảo hành 12-24 tháng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 60px; height: 60px;">
                        <i class="fas fa-medal fa-lg"></i>
                    </div>
                    <h6 class="fw-bold">Chất lượng đảm bảo</h6>
                    <p class="text-muted small">100% hàng chính hãng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 60px; height: 60px;">
                        <i class="fas fa-headset fa-lg"></i>
                    </div>
                    <h6 class="fw-bold">Hỗ trợ 24/7</h6>
                    <p class="text-muted small">Tư vấn và hỗ trợ mọi lúc</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once 'app/views/shares/footer.php'; ?>