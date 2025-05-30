<?php 
$title = "Chi tiết danh mục: " . htmlspecialchars($category->name) . " - TechTafu";
include 'app/views/shares/header.php'; 
?>

<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" data-aos="fade-right">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/category/list" class="text-decoration-none">Danh mục</a></li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars($category->name); ?></li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1" data-aos="fade-right">
                        <i class="fas fa-tag text-primary me-2"></i>
                        <?php echo htmlspecialchars($category->name); ?>
                    </h2>
                    <p class="text-muted mb-0" data-aos="fade-right" data-aos-delay="100">
                        Chi tiết thông tin danh mục #<?php echo $category->id; ?>
                    </p>
                </div>
                <div data-aos="fade-left">
                    <a href="/category/list" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                    <div class="btn-group">
                        <a href="/category/edit/<?php echo $category->id; ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Chỉnh sửa
                        </a>
                        <button class="btn btn-danger" onclick="deleteCategory(<?php echo $category->id; ?>)">
                            <i class="fas fa-trash me-2"></i>Xóa
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Category Information Card -->
            <div class="card shadow-lg border-0 mb-4" data-aos="fade-up">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Thông tin chi tiết
                        </h5>
                        <span class="badge bg-light text-dark">ID: <?php echo $category->id; ?></span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-hashtag me-2"></i>Mã danh mục
                            </h6>
                            <div class="p-3 bg-light rounded">
                                <span class="badge bg-primary fs-6">#<?php echo $category->id; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-tag me-2"></i>Tên danh mục
                            </h6>
                            <div class="p-3 bg-light rounded">
                                <h5 class="mb-0 text-primary"><?php echo htmlspecialchars($category->name); ?></h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">
                            <i class="fas fa-align-left me-2"></i>Mô tả danh mục
                        </h6>
                        <div class="p-3 bg-light rounded">
                            <?php if (!empty($category->description)): ?>
                                <p class="mb-0"><?php echo nl2br(htmlspecialchars($category->description)); ?></p>
                            <?php else: ?>
                                <p class="mb-0 text-muted fst-italic">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Danh mục này chưa có mô tả
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products in Category -->
            <div class="card shadow-lg border-0" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-boxes me-2"></i>
                        Sản phẩm trong danh mục
                    </h5>
                </div>
                <div class="card-body">
                    <?php
                    // Get products in this category
                    $db = (new Database())->getConnection();
                    $stmt = $db->prepare("SELECT * FROM product WHERE category_id = ? ORDER BY id DESC");
                    $stmt->execute([$category->id]);
                    $products = $stmt->fetchAll(PDO::FETCH_OBJ);
                    ?>
                    
                    <?php if (empty($products)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                            <h4 class="text-muted mb-3">Chưa có sản phẩm nào</h4>
                            <p class="text-muted mb-4">Danh mục này chưa có sản phẩm nào</p>
                            <a href="/Product/add" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Thêm sản phẩm đầu tiên
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($products as $index => $product): ?>
                                <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?php echo 300 + ($index * 100); ?>">
                                    <div class="card h-100 product-card border-0 shadow-sm">
                                        <?php if (!empty($product->image)): ?>
                                            <img src="/<?php echo htmlspecialchars($product->image); ?>" 
                                                 class="card-img-top product-image" 
                                                 alt="<?php echo htmlspecialchars($product->name); ?>"
                                                 onerror="this.src='/public/image/no-image.jpg'">
                                        <?php else: ?>
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                                <i class="fas fa-image fa-3x text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="card-body">
                                            <h6 class="card-title"><?php echo htmlspecialchars($product->name); ?></h6>
                                            <p class="card-text text-muted small">
                                                <?php echo mb_substr(htmlspecialchars($product->description), 0, 80) . '...'; ?>
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="price text-primary fw-bold">
                                                    <?php echo number_format($product->price, 0) . ' vnđ'; ?>
                                                </span>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="/Product/show/<?php echo $product->id; ?>" class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="/Product/edit/<?php echo $product->id; ?>" class="btn btn-outline-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="/Product?category=<?php echo $category->id; ?>" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-2"></i>Xem tất cả sản phẩm (<?php echo count($products); ?>)
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Stats -->
            <div class="card border-0 shadow-sm mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        Thống kê nhanh
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <h3 class="text-primary mb-1"><?php echo count($products); ?></h3>
                            <small class="text-muted">Sản phẩm</small>
                        </div>
                        <div class="col-6 mb-3">
                            <h3 class="text-success mb-1">
                                <?php echo !empty($category->description) ? '✓' : '✗'; ?>
                            </h3>
                            <small class="text-muted">Có mô tả</small>
                        </div>
                    </div>
                    
                    <?php if (count($products) > 0): ?>
                        <?php
                        $totalValue = array_sum(array_column($products, 'price'));
                        $avgPrice = $totalValue / count($products);
                        ?>
                        <hr>
                        <div class="text-center">
                            <h5 class="text-warning mb-1">
                                <?php echo number_format($avgPrice, 0, ',', '.'); ?>đ
                            </h5>
                            <small class="text-muted">Giá trung bình</small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Thao tác nhanh
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="/category/edit/<?php echo $category->id; ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Chỉnh sửa danh mục
                        </a>
                        <a href="/Product/add?category=<?php echo $category->id; ?>" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>Thêm sản phẩm mới
                        </a>
                        <a href="/category/list" class="btn btn-outline-primary">
                            <i class="fas fa-list me-2"></i>Danh sách danh mục
                        </a>
                        <button class="btn btn-outline-danger" onclick="deleteCategory(<?php echo $category->id; ?>)">
                            <i class="fas fa-trash me-2"></i>Xóa danh mục
                        </button>
                    </div>
                </div>
            </div>

            <!-- Category Info -->
            <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="300">
                <div class="card-header bg-secondary text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Thông tin bổ sung
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Trạng thái:</small>
                        <div class="mt-1">
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>Hoạt động
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted">Độ dài tên:</small>
                        <div class="mt-1">
                            <span class="badge bg-info">
                                <?php echo mb_strlen($category->name); ?> ký tự
                            </span>
                        </div>
                    </div>
                    
                    <?php if (!empty($category->description)): ?>
                        <div class="mb-3">
                            <small class="text-muted">Độ dài mô tả:</small>
                            <div class="mt-1">
                                <span class="badge bg-info">
                                    <?php echo mb_strlen($category->description); ?> ký tự
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="alert alert-light mb-0">
                        <i class="fas fa-lightbulb text-warning me-2"></i>
                        <small>Danh mục giúp tổ chức sản phẩm hiệu quả hơn</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Delete category function
    function deleteCategory(id) {
        const productCount = <?php echo count($products); ?>;
        let message = 'Bạn có chắc chắn muốn xóa danh mục này?';
        
        if (productCount > 0) {
            message = `Danh mục này có ${productCount} sản phẩm. Bạn có chắc chắn muốn xóa? Điều này có thể ảnh hưởng đến các sản phẩm liên quan.`;
        }
        
        confirmDelete(message).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Đang xóa...',
                    text: 'Vui lòng đợi trong giây lát',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                window.location.href = '/category/delete/' + id;
            }
        });
    }

    // Print category info
    function printCategory() {
        window.print();
    }

    // Copy category info
    function copyCategory() {
        const categoryInfo = `
Danh mục: <?php echo htmlspecialchars($category->name); ?>
ID: <?php echo $category->id; ?>
Mô tả: <?php echo htmlspecialchars($category->description); ?>
        navigator.clipboard.writeText(categoryInfo).then(function() {
            toastr.success('Đã sao chép thông tin danh mục!');
        }).catch(function() {
            toastr.error('Không thể sao chép!');
        });
    }

    // Enhanced product card interactions
    document.querySelectorAll('.product-card').forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Lazy loading for product images
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.classList.add('fade-in');
                observer.unobserve(img);
            }
        });
    });

    document.querySelectorAll('.product-image').forEach(img => {
        imageObserver.observe(img);
    });
</script>

<style>
    .product-card {
        transition: all 0.3s ease;
        border: none !important;
    }
    
    .product-card:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .product-image {
        height: 200px;
        object-fit: cover;
        border-radius: 8px 8px 0 0;
    }
    
    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @media print {
        .btn, .card-header, nav {
            display: none !important;
        }
        
        .card {
            border: 1px solid #000 !important;
            box-shadow: none !important;
        }
    }
</style>

<?php include 'app/views/shares/footer.php'; ?>