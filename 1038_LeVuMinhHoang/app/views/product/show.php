<?php 
$title = htmlspecialchars($product->name) . " - TechTafu";
include 'app/views/shares/header.php'; 
?>

<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" data-aos="fade-right">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản phẩm</a></li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars($product->name); ?></li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Images -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 mb-4" data-aos="fade-up">
                <div class="card-body p-4">
                    <!-- Main Image -->
                    <div class="text-center mb-4">
                        <?php if (!empty($product->image)): ?>
                            <img id="mainImage" src="/<?php echo htmlspecialchars($product->image); ?>" 
                                 alt="<?php echo htmlspecialchars($product->name); ?>" 
                                 class="img-fluid rounded shadow-sm main-product-image"
                                 onerror="this.src='/public/image/no-image.jpg'">
                        <?php else: ?>
                            <div class="bg-light rounded d-flex align-items-center justify-content-center main-product-image">
                                <div class="text-center">
                                    <i class="fas fa-image fa-5x text-muted mb-3"></i>
                                    <p class="text-muted">Chưa có hình ảnh</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Image Actions -->
                    <div class="d-flex justify-content-center gap-2">
                        <?php if (!empty($product->image)): ?>
                            <button class="btn btn-outline-primary btn-sm" onclick="zoomImage()">
                                <i class="fas fa-search-plus me-1"></i>Phóng to
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" onclick="shareProduct()">
                                <i class="fas fa-share-alt me-1"></i>Chia sẻ
                            </button>
                        <?php endif; ?>
                        <a href="/Product/edit/<?php echo $product->id; ?>" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-edit me-1"></i>Chỉnh sửa
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Information -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-body p-4">
                    <!-- Product Title -->
                    <h1 class="h2 mb-3 text-primary"><?php echo htmlspecialchars($product->name); ?></h1>
                    
                    <!-- Product ID & Status -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-secondary me-2">ID: <?php echo $product->id; ?></span>
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i>Còn hàng
                        </span>
                    </div>

                    <!-- Category -->
                    <?php 
                    $db = (new Database())->getConnection();
                    $stmt = $db->prepare("SELECT name FROM category WHERE id = ?");
                    $stmt->execute([$product->category_id]);
                    $category = $stmt->fetch(PDO::FETCH_OBJ);
                    ?>
                    <?php if ($category): ?>
                        <div class="mb-3">
                            <small class="text-muted">Danh mục:</small>
                            <a href="/Product?category=<?php echo $product->category_id; ?>" class="text-decoration-none ms-2">
                                <span class="category-badge">
                                    <i class="fas fa-tag me-1"></i>
                                    <?php echo htmlspecialchars($category->name); ?>
                                </span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Rating -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <div class="text-warning me-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="me-2">4.8/5</span>
                            <small class="text-muted">(124 đánh giá)</small>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <h2 class="price text-primary mb-0 me-3">
                                <?php echo number_format($product->price, 0) . ' vnđ'; ?>
                            </h2>
                            <del class="text-muted h5 mb-0">
                                <?php echo number_format($product->price * 1.2, 0) . ' vnđ'; ?>
                            </del>
                            <span class="badge bg-danger ms-2">-20%</span>
                        </div>
                        <small class="text-muted">Đã bao gồm VAT</small>
                    </div>

                    <!-- Product Actions -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-2">
                            <button class="btn btn-primary btn-lg w-100" onclick="addToCart(<?php echo $product->id; ?>, this)">
                                <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ
                            </button>
                        </div>
                        <div class="col-md-6 mb-2">
                            <button class="btn btn-success btn-lg w-100" onclick="buyNow()">
                                <i class="fas fa-bolt me-2"></i>Mua ngay
                            </button>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="d-flex gap-2 mb-4">
                        <button class="btn btn-outline-danger flex-fill" onclick="addToWishlist(<?php echo $product->id; ?>)">
                            <i class="fas fa-heart me-1"></i>Yêu thích
                        </button>
                        <button class="btn btn-outline-info flex-fill" onclick="compareProduct()">
                            <i class="fas fa-balance-scale me-1"></i>So sánh
                        </button>
                        <button class="btn btn-outline-secondary flex-fill" onclick="shareProduct()">
                            <i class="fas fa-share-alt me-1"></i>Chia sẻ
                        </button>
                    </div>

                    <!-- Product Features -->
                    <div class="bg-light rounded p-3">
                        <h6 class="mb-3">
                            <i class="fas fa-shield-alt text-success me-2"></i>
                            Chính sách bán hàng
                        </h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1">
                                <i class="fas fa-check text-success me-2"></i>
                                Bảo hành chính hãng 12 tháng
                            </li>
                            <li class="mb-1">
                                <i class="fas fa-check text-success me-2"></i>
                                Miễn phí giao hàng toàn quốc
                            </li>
                            <li class="mb-1">
                                <i class="fas fa-check text-success me-2"></i>
                                Đổi trả trong 30 ngày
                            </li>
                            <li class="mb-0">
                                <i class="fas fa-check text-success me-2"></i>
                                Hỗ trợ kỹ thuật 24/7
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details Tabs -->
    <div class="card shadow-sm border-0 mb-4" data-aos="fade-up">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">
                        <i class="fas fa-info-circle me-2"></i>Mô tả sản phẩm
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
                        <i class="fas fa-star me-2"></i>Đánh giá (124)
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab">
                        <i class="fas fa-cog me-2"></i>Quản trị
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="productTabsContent">
                <!-- Description Tab -->
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-8">
                            <h5 class="mb-3">Chi tiết sản phẩm</h5>
                            <div class="product-description">
                                <?php echo nl2br(htmlspecialchars($product->description)); ?>
                            </div>
                            
                            <!-- Additional Product Info -->
                            <div class="mt-4">
                                <h6>Đặc điểm nổi bật:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-star text-warning me-2"></i>
                                        Thiết kế hiện đại, sang trọng
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-star text-warning me-2"></i>
                                        Hiệu năng mạnh mẽ, ổn định
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-star text-warning me-2"></i>
                                        Chất lượng cao, bền bỉ
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-star text-warning me-2"></i>
                                        Giá cả hợp lý, cạnh tranh
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-info-circle text-primary me-2"></i>
                                        Thông tin sản phẩm
                                    </h6>
                                    <table class="table table-borderless table-sm">
                                        <tr>
                                            <td class="text-muted">Mã sản phẩm:</td>
                                            <td><strong>SP<?php echo str_pad($product->id, 6, '0', STR_PAD_LEFT); ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Thương hiệu:</td>
                                            <td><strong>TechTafu</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Xuất xứ:</td>
                                            <td><strong>Chính hãng</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Bảo hành:</td>
                                            <td><strong>12 tháng</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specifications Tab -->
                <div class="tab-pane fade" id="specs" role="tabpanel">
                    <h5 class="mb-3">Thông số kỹ thuật</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="fw-bold">Tên sản phẩm</td>
                                    <td><?php echo htmlspecialchars($product->name); ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Giá bán</td>
                                    <td class="text-primary fw-bold"><?php echo number_format($product->price, 0, ',', '.'); ?>₫</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Danh mục</td>
                                    <td><?php echo $category ? htmlspecialchars($category->name) : 'Chưa phân loại'; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Trạng thái</td>
                                    <td><span class="badge bg-success">Còn hàng</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Kích thước</td>
                                    <td>Đang cập nhật</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Trọng lượng</td>
                                    <td>Đang cập nhật</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Màu sắc</td>
                                    <td>Đa dạng</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Bảo hành</td>
                                    <td>12 tháng chính hãng</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card bg-primary text-white text-center">
                                <div class="card-body">
                                    <h2 class="mb-1">4.8</h2>
                                    <div class="text-warning mb-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="mb-0">124 đánh giá</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-2">5 sao</span>
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 80%"></div>
                                    </div>
                                    <span class="text-muted">80%</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-2">4 sao</span>
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 15%"></div>
                                    </div>
                                    <span class="text-muted">15%</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-2">3 sao</span>
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 3%"></div>
                                    </div>
                                    <span class="text-muted">3%</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-2">2 sao</span>
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 1%"></div>
                                    </div>
                                    <span class="text-muted">1%</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="me-2">1 sao</span>
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 1%"></div>
                                    </div>
                                    <span class="text-muted">1%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Sample Reviews -->
                    <div class="review-item mb-4">
                        <div class="d-flex align-items-start">
                            <div class="avatar me-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    N
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-2">
                                    <strong class="me-2">Nguyễn Văn A</strong>
                                    <div class="text-warning me-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <small class="text-muted">2 ngày trước</small>
                                </div>
                                <p class="mb-0">Sản phẩm chất lượng tốt, giao hàng nhanh. Rất hài lòng với dịch vụ của shop!</p>
                            </div>
                        </div>
                    </div>

                    <div class="review-item mb-4">
                        <div class="d-flex align-items-start">
                            <div class="avatar me-3">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    T
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-2">
                                    <strong class="me-2">Trần Thị B</strong>
                                    <div class="text-warning me-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <small class="text-muted">1 tuần trước</small>
                                </div>
                                <p class="mb-0">Sản phẩm đúng như mô tả, đóng gói cẩn thận. Giá cả hợp lý.</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-plus me-2"></i>Xem thêm đánh giá
                        </button>
                    </div>
                </div>

                <!-- Admin Tab -->
                <div class="tab-pane fade" id="admin" role="tabpanel">
                    <h5 class="mb-3">
                        <i class="fas fa-cog text-primary me-2"></i>
                        Quản trị sản phẩm
                    </h5>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">
                                        <i class="fas fa-edit me-2"></i>
                                        Thao tác nhanh
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning">
                                            <i class="fas fa-edit me-2"></i>Chỉnh sửa sản phẩm
                                        </a>
                                        <button class="btn btn-success" onclick="toggleStatus()">
                                            <i class="fas fa-toggle-on me-2"></i>Bật/Tắt hiển thị
                                        </button>
                                        <button class="btn btn-info" onclick="duplicateProduct()">
                                            <i class="fas fa-copy me-2"></i>Nhân bản sản phẩm
                                        </button>
                                        <button class="btn btn-outline-danger" onclick="deleteProduct(<?php echo $product->id; ?>)">
                                            <i class="fas fa-trash me-2"></i>Xóa sản phẩm
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0">
                                        <i class="fas fa-chart-bar me-2"></i>
                                        Thống kê
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-6 mb-3">
                                            <h4 class="text-primary">124</h4>
                                            <small class="text-muted">Lượt xem</small>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h4 class="text-success">15</h4>
                                            <small class="text-muted">Đã bán</small>
                                        </div>
                                        <div class="col-6">
                                            <h4 class="text-warning">8</h4>
                                            <small class="text-muted">Yêu thích</small>
                                        </div>
                                        <div class="col-6">
                                            <h4 class="text-info">4.8</h4>
                                            <small class="text-muted">Đánh giá</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0">
                                    <i class="fas fa-history me-2"></i>
                                    Lịch sử thay đổi
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="timeline">
                                    <div class="timeline-item mb-3">
                                        <div class="d-flex">
                                            <div class="timeline-marker bg-primary"></div>
                                            <div class="timeline-content ms-3">
                                                <h6 class="mb-1">Tạo sản phẩm</h6>
                                                <p class="text-muted small mb-0">Sản phẩm được tạo lần đầu</p>
                                                <small class="text-muted">Hôm nay</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="card shadow-sm border-0" data-aos="fade-up">
        <div class="card-header bg-success text-white">
            <h5 class="card-title mb-0">
                <i class="fas fa-boxes me-2"></i>
                Sản phẩm liên quan
            </h5>
        </div>
        <div class="card-body">
            <?php
            // Get related products from same category
            $stmt = $db->prepare("SELECT * FROM product WHERE category_id = ? AND id != ? ORDER BY RAND() LIMIT 4");
            $stmt->execute([$product->category_id, $product->id]);
            $relatedProducts = $stmt->fetchAll(PDO::FETCH_OBJ);
            ?>
            
            <?php if (!empty($relatedProducts)): ?>
                <div class="row">
                    <?php foreach ($relatedProducts as $relatedProduct): ?>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card h-100 product-card shadow-sm">
                                <?php if (!empty($relatedProduct->image)): ?>
                                    <img src="/<?php echo htmlspecialchars($relatedProduct->image); ?>" 
                                         class="card-img-top" alt="<?php echo htmlspecialchars($relatedProduct->name); ?>"
                                         style="height: 200px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-image fa-2x text-muted"></i>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title">
                                        <a href="/Product/show/<?php echo $relatedProduct->id; ?>" class="text-decoration-none">
                                            <?php echo htmlspecialchars($relatedProduct->name); ?>
                                        </a>
                                    </h6>
                                    <p class="card-text text-muted small flex-grow-1">
                                        <?php echo mb_substr($relatedProduct->description, 0, 60) . '...'; ?>
                                    </p>
                                    <div class="mt-auto">
                                        <div class="price h6 text-primary mb-2">
                                            <?php echo number_format($relatedProduct->price, 0, ',', '.'); ?>₫
                                        </div>
                                        <button class="btn btn-primary btn-sm w-100" onclick="addToCart(<?php echo $relatedProduct->id; ?>, this)">
                                            <i class="fas fa-cart-plus me-1"></i>Thêm vào giỏ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-4">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Không có sản phẩm liên quan</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Image Zoom Modal -->
<div class="modal fade" id="imageZoomModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo htmlspecialchars($product->name); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <?php if (!empty($product->image)): ?>
                    <img src="/<?php echo htmlspecialchars($product->image); ?>" 
                         class="img-fluid" alt="<?php echo htmlspecialchars($product->name); ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // CẬP NHẬT: Add to Cart với AJAX thực sự
    function addToCart(productId, button) {
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang thêm...';
        button.disabled = true;
        
        // Gửi AJAX request đến server
        fetch('/Product/addToCart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'product_id=' + productId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                button.innerHTML = '<i class="fas fa-check me-1"></i>Đã thêm!';
                button.classList.remove('btn-primary');
                button.classList.add('btn-success');
                
                // Hiển thị thông báo thành công
                if (typeof toastr !== 'undefined') {
                    toastr.success(data.message);
                } else {
                    alert(data.message);
                }
                
                // Cập nhật số lượng giỏ hàng trong navbar
                updateCartCount(data.cart_count);
                
                // Reset button sau 2 giây
                setTimeout(function() {
                    button.innerHTML = originalText;
                    button.classList.remove('btn-success');
                    button.classList.add('btn-primary');
                    button.disabled = false;
                }, 2000);
            } else {
                // Hiển thị lỗi
                if (typeof toastr !== 'undefined') {
                    toastr.error(data.message);
                } else {
                    alert('Lỗi: ' + data.message);
                }
                
                // Reset button
                button.innerHTML = originalText;
                button.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (typeof toastr !== 'undefined') {
                toastr.error('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng');
            } else {
                alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng');
            }
            
            // Reset button
            button.innerHTML = originalText;
            button.disabled = false;
        });
    }

    // Hàm cập nhật số lượng giỏ hàng
    function updateCartCount(count) {
        const cartBadge = document.querySelector('.navbar .badge');
        if (cartBadge) {
            cartBadge.textContent = count;
        }
    }
    
    // Buy Now
    function buyNow() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Mua ngay',
                text: 'Chuyển đến trang thanh toán?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (typeof toastr !== 'undefined') {
                        toastr.info('Chuyển đến trang thanh toán...');
                    }
                    // Redirect to checkout page
                    window.location.href = '/Product/checkout';
                }
            });
        } else {
            if (confirm('Chuyển đến trang thanh toán?')) {
                window.location.href = '/Product/checkout';
            }
        }
    }
    
    // Add to Wishlist
    function addToWishlist(productId) {
        if (typeof toastr !== 'undefined') {
            toastr.success('Đã thêm vào danh sách yêu thích!');
        } else {
            alert('Đã thêm vào danh sách yêu thích!');
        }
    }
    
    // Compare Product
    function compareProduct() {
        if (typeof toastr !== 'undefined') {
            toastr.info('Đã thêm vào danh sách so sánh!');
        } else {
            alert('Đã thêm vào danh sách so sánh!');
        }
    }
    
    // Share Product
    function shareProduct() {
        if (navigator.share) {
            navigator.share({
                title: <?php echo json_encode($product->name); ?>,
                text: <?php echo json_encode($product->description); ?>,
                url: window.location.href
            });
        } else {
            // Fallback: copy URL to clipboard
            navigator.clipboard.writeText(window.location.href).then(function() {
                if (typeof toastr !== 'undefined') {
                    toastr.success('Đã sao chép link sản phẩm!');
                } else {
                    alert('Đã sao chép link sản phẩm!');
                }
            });
        }
    }
    
    // Zoom Image
    function zoomImage() {
        const modal = new bootstrap.Modal(document.getElementById('imageZoomModal'));
        modal.show();
    }
    
    // Admin Functions
    function toggleStatus() {
        if (typeof toastr !== 'undefined') {
            toastr.success('Đã thay đổi trạng thái sản phẩm!');
        } else {
            alert('Đã thay đổi trạng thái sản phẩm!');
        }
    }
    
    function duplicateProduct() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Nhân bản sản phẩm',
                text: 'Tạo bản sao của sản phẩm này?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (typeof toastr !== 'undefined') {
                        toastr.success('Đã tạo bản sao sản phẩm!');
                    } else {
                        alert('Đã tạo bản sao sản phẩm!');
                    }
                }
            });
        } else {
            if (confirm('Tạo bản sao của sản phẩm này?')) {
                alert('Đã tạo bản sao sản phẩm!');
            }
        }
    }
    
    function deleteProduct(id) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Xác nhận xóa',
                text: 'Bạn có chắc chắn muốn xóa sản phẩm này? Hành động này không thể hoàn tác!',
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
        } else if (typeof confirmDelete === 'function') {
            confirmDelete('Bạn có chắc chắn muốn xóa sản phẩm này? Hành động này không thể hoàn tác!').then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/Product/delete/' + id;
                }
            });
        } else {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này? Hành động này không thể hoàn tác!')) {
                window.location.href = '/Product/delete/' + id;
            }
        }
    }
    
    // Price Animation
    document.addEventListener('DOMContentLoaded', function() {
        const priceElement = document.querySelector('.price');
        if (priceElement) {
            priceElement.classList.add('animate__animated', 'animate__bounceIn');
        }
    });
</script>

<style>
    .main-product-image {
        max-height: 500px;
        width: 100%;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    
    .main-product-image:hover {
        transform: scale(1.05);
    }
    
    .product-card {
        transition: all 0.3s ease;
        border: none;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .timeline-marker {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-top: 4px;
    }
    
    .avatar {
        flex-shrink: 0;
    }
    
    .review-item {
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }
    
    .review-item:last-child {
        border-bottom: none;
    }
    
    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 500;
    }
    
    .nav-tabs .nav-link.active {
        background-color: transparent;
        border-bottom: 3px solid #007bff;
        color: #007bff;
    }
    
    @media (max-width: 768px) {
        .main-product-image {
            max-height: 300px;
        }
        
        .nav-tabs {
            flex-wrap: nowrap;
            overflow-x: auto;
        }
        
        .nav-tabs .nav-link {
            white-space: nowrap;
        }
    }
</style>

<?php include 'app/views/shares/footer.php'; ?>