<?php 
$title = htmlspecialchars($category->name) . " - Chi tiết danh mục";
include 'app/views/shares/header.php'; 
?>

<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" data-aos="fade-down">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/category/list">Danh mục</a></li>
            <li class="breadcrumb-item active"><?= htmlspecialchars($category->name) ?></li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-6 fw-bold mb-3">
                        <i class="fas fa-tag me-3 text-primary"></i>
                        <?= htmlspecialchars($category->name) ?>
                    </h1>
                    <p class="lead text-muted">Chi tiết thông tin danh mục</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="/category/edit/<?= $category->id ?>" class="btn btn-warning btn-lg">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa
                    </a>
                    <button onclick="deleteCategory(<?= $category->id ?>)" class="btn btn-danger btn-lg">
                        <i class="fas fa-trash me-2"></i>Xóa
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Category Information -->
        <div class="col-lg-8">
            <!-- Basic Info Card -->
            <div class="card shadow-lg border-0 mb-4" data-aos="fade-right">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Thông tin cơ bản
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <div class="category-icon bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="fas fa-tag fa-3x"></i>
                            </div>
                            <div class="badges">
                                <span class="badge bg-success mb-2 d-block">Hoạt động</span>
                                <span class="badge bg-warning">Nổi bật</span>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-semibold" width="30%">ID Danh mục:</td>
                                    <td>#<?= str_pad($category->id, 3, '0', STR_PAD_LEFT) ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Tên danh mục:</td>
                                    <td class="h5 text-primary"><?= htmlspecialchars($category->name) ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Ngày tạo:</td>
                                    <td><?= date('d/m/Y H:i') ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Cập nhật lần cuối:</td>
                                    <td><?= date('d/m/Y H:i') ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Trạng thái:</td>
                                    <td>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Đang hoạt động
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            <div class="card shadow-lg border-0 mb-4" data-aos="fade-right" data-aos-delay="100">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-align-left me-2"></i>Mô tả danh mục
                    </h5>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($category->description)): ?>
                        <div class="description-content">
                            <p class="lead"><?= nl2br(htmlspecialchars($category->description)) ?></p>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Chưa có mô tả</h6>
                            <p class="text-muted mb-3">Danh mục này chưa có mô tả chi tiết</p>
                            <a href="/category/edit/<?= $category->id ?>" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Thêm mô tả
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Products in Category -->
            <div class="card shadow-lg border-0" data-aos="fade-right" data-aos-delay="200">
                <div class="card-header bg-warning text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-box me-2"></i>Sản phẩm trong danh mục
                    </h5>
                </div>
                <div class="card-body p-4">
                    <!-- Sample products (in real app, this would come from database) -->
                    <div class="row g-3">
                        <?php 
                        // Sample products for this category
                        $sampleProducts = [
                            ['id' => 1, 'name' => 'iPhone 15 Pro Max', 'price' => 29990000, 'status' => 'active'],
                            ['id' => 2, 'name' => 'Samsung Galaxy S24 Ultra', 'price' => 27990000, 'status' => 'active'],
                            ['id' => 3, 'name' => 'MacBook Air M3', 'price' => 32990000, 'status' => 'inactive']
                        ];
                        
                        if (!empty($sampleProducts)): ?>
                            <?php foreach($sampleProducts as $product): ?>
                                <div class="col-md-6">
                                    <div class="product-item d-flex align-items-center p-3 border rounded">
                                        <div class="product-image me-3">
                                            <img src="https://via.placeholder.com/60x60/<?= $product['status'] == 'active' ? '28a745' : '6c757d' ?>/ffffff?text=SP" 
                                                 alt="<?= $product['name'] ?>" 
                                                 class="rounded" 
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        </div>
                                        <div class="product-info flex-grow-1">
                                            <h6 class="mb-1"><?= $product['name'] ?></h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-primary fw-bold"><?= number_format($product['price'], 0, ',', '.') ?>đ</span>
                                                <span class="badge bg-<?= $product['status'] == 'active' ? 'success' : 'secondary' ?>">
                                                    <?= $product['status'] == 'active' ? 'Đang bán' : 'Ngừng bán' ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            
                            <div class="col-12 text-center mt-4">
                                <a href="/Product?category=<?= $category->id ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-eye me-2"></i>Xem tất cả sản phẩm
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="col-12 text-center py-4">
                                <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_E2DuUN.json" 
                                               background="transparent" 
                                               speed="1" 
                                               style="width: 200px; height: 200px; margin: 0 auto;" 
                                               loop autoplay></lottie-player>
                                <h6 class="text-muted mt-3">Chưa có sản phẩm nào</h6>
                                <p class="text-muted mb-3">Hãy thêm sản phẩm đầu tiên cho danh mục này</p>
                                <a href="/Product/add?category=<?= $category->id ?>" class="btn btn-success">
                                    <i class="fas fa-plus me-2"></i>Thêm sản phẩm
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Sidebar -->
        <div class="col-lg-4">
            <!-- Statistics Card -->
            <div class="card shadow-lg border-0 mb-4" data-aos="fade-left">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Thống kê
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="stat-item mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Tổng sản phẩm</span>
                            <span class="h4 text-primary mb-0">3</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 100%"></div>
                        </div>
                    </div>

                    <div class="stat-item mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Đang bán</span>
                            <span class="h5 text-success mb-0">2</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: 67%"></div>
                        </div>
                    </div>

                    <div class="stat-item mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Ngừng bán</span>
                            <span class="h5 text-secondary mb-0">1</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-secondary" style="width: 33%"></div>
                        </div>
                    </div>

                    <div class="stat-item mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Lượt xem</span>
                            <span class="h5 text-info mb-0">1,234</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" style="width: 85%"></div>
                        </div>
                    </div>

                    <hr>

                    <div class="revenue-stats">
                        <h6 class="text-muted mb-3">Doanh thu</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Hôm nay:</span>
                            <span class="fw-bold text-success">2,500,000đ</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tuần này:</span>
                            <span class="fw-bold text-info">15,000,000đ</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Tháng này:</span>
                            <span class="fw-bold text-warning">65,000,000đ</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card shadow-lg border-0 mb-4" data-aos="fade-left" data-aos-delay="100">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Thao tác nhanh
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-3">
                        <a href="/Product/add?category=<?= $category->id ?>" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>Thêm sản phẩm mới
                        </a>
                        <a href="/category/edit/<?= $category->id ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Chỉnh sửa danh mục
                        </a>
                        <button onclick="duplicateCategory()" class="btn btn-info">
                            <i class="fas fa-copy me-2"></i>Nhân bản danh mục
                        </button>
                        <button onclick="exportCategory()" class="btn btn-outline-primary">
                            <i class="fas fa-download me-2"></i>Xuất báo cáo
                        </button>
                        <hr>
                        <button onclick="deleteCategory(<?= $category->id ?>)" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>Xóa danh mục
                        </button>
                    </div>
                </div>
            </div>

            <!-- Related Categories -->
            <div class="card shadow-lg border-0" data-aos="fade-left" data-aos-delay="200">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-link me-2"></i>Danh mục liên quan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="related-categories">
                        <?php 
                        $relatedCategories = [
                            ['id' => 2, 'name' => 'Laptop', 'count' => 15],
                            ['id' => 3, 'name' => 'Phụ kiện', 'count' => 28],
                            ['id' => 4, 'name' => 'Tai nghe', 'count' => 12]
                        ];
                        foreach($relatedCategories as $related): ?>
                            <div class="related-item d-flex justify-content-between align-items-center mb-3 p-2 border rounded">
                                <div>
                                    <h6 class="mb-0"><?= $related['name'] ?></h6>
                                    <small class="text-muted"><?= $related['count'] ?> sản phẩm</small>
                                </div>
                                <a href="/category/show/<?= $related['id'] ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to List -->
    <div class="row mt-5">
        <div class="col-12 text-center" data-aos="fade-up">
            <a href="/category/list" class="btn btn-secondary btn-lg">
                <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
            </a>
        </div>
    </div>
</div>

<script>
    // Delete category function
    function deleteCategory(id) {
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: "Hành động này không thể hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Có, xóa ngay!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();
                window.location.href = `/category/delete/${id}`;
            }
        });
    }

    // Duplicate category function
    function duplicateCategory() {
        Swal.fire({
            title: 'Nhân bản danh mục',
            input: 'text',
            inputLabel: 'Tên danh mục mới:',
            inputValue: '<?= htmlspecialchars($category->name) ?> - Copy',
            showCancelButton: true,
            confirmButtonText: 'Nhân bản',
            cancelButtonText: 'Hủy',
            inputValidator: (value) => {
                if (!value) {
                    return 'Vui lòng nhập tên danh mục mới';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Đang nhân bản...',
                    text: 'Vui lòng đợi trong giây lát',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Simulate processing
                setTimeout(() => {
                    Swal.fire('Thành công!', `Đã nhân bản danh mục "${result.value}"`, 'success');
                }, 2000);
            }
        });
    }

    // Export category function
    function exportCategory() {
        Swal.fire({
            title: 'Xuất báo cáo danh mục',
            html: `
                <div class="export-options">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="includeProducts" checked>
                        <label class="form-check-label" for="includeProducts">
                            Bao gồm danh sách sản phẩm
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="includeStats" checked>
                        <label class="form-check-label" for="includeStats">
                            Bao gồm thống kê
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="includeRevenue">
                        <label class="form-check-label" for="includeRevenue">
                            Bao gồm doanh thu
                        </label>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Xuất Excel',
            cancelButtonText: 'Hủy',
            focusConfirm: false,
            preConfirm: () => {
                return {
                    includeProducts: document.getElementById('includeProducts').checked,
                    includeStats: document.getElementById('includeStats').checked,
                    includeRevenue: document.getElementById('includeRevenue').checked
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Đang xuất...', 'File Excel sẽ được tải xuống trong giây lát', 'info');
                // Implement actual export logic here
            }
        });
    }

    // Animate statistics on scroll
    function animateStats() {
        const statItems = document.querySelectorAll('.stat-item');
        
        statItems.forEach((item, index) => {
            const progressBar = item.querySelector('.progress-bar');
            const currentWidth = progressBar.style.width;
            
            // Reset width
            progressBar.style.width = '0%';
            
            // Animate to current width
            setTimeout(() => {
                progressBar.style.transition = 'width 1s ease-in-out';
                progressBar.style.width = currentWidth;
            }, index * 200);
        });
    }

    // Initialize animations
    document.addEventListener('DOMContentLoaded', function() {
        // Animate product items
        anime({
            targets: '.product-item',
            translateX: [-30, 0],
            opacity: [0, 1],
            duration: 600,
            delay: anime.stagger(100),
            easing: 'easeOutQuad'
        });

        // Animate related categories
        anime({
            targets: '.related-item',
            translateY: [20, 0],
            opacity: [0, 1],
            duration: 600,
            delay: anime.stagger(50, {start: 300}),
            easing: 'easeOutQuad'
        });

        // Animate statistics when they come into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    observer.unobserve(entry.target);
                }
            });
        });

        const statsCard = document.querySelector('.card .bg-info');
        if (statsCard) {
            observer.observe(statsCard.closest('.card'));
        }
    });
</script>

<?php include 'app/views/shares/footer.php'; ?>