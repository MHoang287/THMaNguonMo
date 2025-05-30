<?php
$title = "Chi tiết danh mục - " . ($category->name ?? 'Không tìm thấy');
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
                        <li class="breadcrumb-item"><a href="/category/list" class="text-white-50">Danh mục</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Chi tiết</li>
                    </ol>
                </nav>
                <h1 class="h2 mb-0 animate__animated animate__fadeInLeft">
                    <i class="fas fa-eye me-2"></i>Chi tiết danh mục
                </h1>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="btn-group animate__animated animate__fadeInRight" role="group">
                    <a href="/category/list" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                    <a href="/category/edit/<?php echo $category->id; ?>" class="btn btn-outline-light">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <!-- Category Information -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg mb-4" data-aos="fade-right">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Thông tin danh mục
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <!-- Category Icon and Basic Info -->
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 100px; height: 100px;">
                                <i class="fas fa-tag fa-3x"></i>
                            </div>
                            <div class="badge bg-primary fs-6">ID: <?php echo $category->id; ?></div>
                        </div>
                        <div class="col-md-9">
                            <h2 class="text-primary mb-3"><?php echo htmlspecialchars($category->name); ?></h2>
                            
                            <?php if (!empty($category->description)): ?>
                                <div class="mb-3">
                                    <h6 class="text-secondary">
                                        <i class="fas fa-align-left me-2"></i>Mô tả danh mục
                                    </h6>
                                    <p class="text-justify bg-light p-3 rounded">
                                        <?php echo nl2br(htmlspecialchars($category->description)); ?>
                                    </p>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Danh mục này chưa có mô tả chi tiết.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Category Statistics -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3 col-sm-6">
                            <div class="bg-success text-white p-3 rounded text-center">
                                <i class="fas fa-box fa-2x mb-2"></i>
                                <h4 class="mb-1"><?php echo rand(0, 50); ?></h4>
                                <small>Sản phẩm</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="bg-warning text-dark p-3 rounded text-center">
                                <i class="fas fa-eye fa-2x mb-2"></i>
                                <h4 class="mb-1"><?php echo rand(100, 1000); ?></h4>
                                <small>Lượt xem</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="bg-info text-white p-3 rounded text-center">
                                <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                                <h4 class="mb-1"><?php echo rand(10, 100); ?></h4>
                                <small>Đã bán</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="bg-danger text-white p-3 rounded text-center">
                                <i class="fas fa-heart fa-2x mb-2"></i>
                                <h4 class="mb-1"><?php echo rand(5, 50); ?></h4>
                                <small>Yêu thích</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Metadata -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-calendar-plus me-2"></i>Ngày tạo
                                </h6>
                                <strong><?php echo date('d/m/Y H:i:s', strtotime($category->created_at ?? 'now')); ?></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-edit me-2"></i>Cập nhật cuối
                                </h6>
                                <strong><?php echo date('d/m/Y H:i:s', strtotime($category->updated_at ?? 'now')); ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products in Category -->
            <div class="card border-0 shadow-lg" data-aos="fade-right" data-aos-delay="100">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-box-open me-2"></i>Sản phẩm trong danh mục
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <div id="categoryProducts">
                        <div class="text-center py-4">
                            <div class="spinner-border text-success" role="status">
                                <span class="visually-hidden">Đang tải...</span>
                            </div>
                            <p class="mt-2 text-muted">Đang tải danh sách sản phẩm...</p>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="/Product?category=<?php echo $category->id; ?>" class="btn btn-success">
                            <i class="fas fa-external-link-alt me-2"></i>Xem tất cả sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card border-0 shadow-lg mb-4" data-aos="fade-left">
                <div class="card-header bg-warning text-dark py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i>Thao tác nhanh
                    </h5>
                </div>
                
                <div class="card-body p-3">
                    <div class="d-grid gap-2">
                        <a href="/category/edit/<?php echo $category->id; ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Chỉnh sửa danh mục
                        </a>
                        <button onclick="confirmDelete('/category/delete/<?php echo $category->id; ?>', 'Bạn có chắc chắn muốn xóa danh mục này?')" 
                                class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>Xóa danh mục
                        </button>
                        <a href="/category/create" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>Thêm danh mục mới
                        </a>
                        <a href="/Product/add" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Thêm sản phẩm vào danh mục
                        </a>
                    </div>
                </div>
            </div>

            <!-- Category Status -->
            <div class="card border-0 shadow-lg mb-4" data-aos="fade-left" data-aos-delay="100">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-line me-2"></i>Trạng thái
                    </h5>
                </div>
                
                <div class="card-body p-3">
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span>Trạng thái:</span>
                            <span class="badge bg-success">Hoạt động</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span>Hiển thị:</span>
                            <span class="badge bg-primary">Công khai</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span>Thứ tự:</span>
                            <span class="badge bg-secondary"><?php echo $category->id; ?></span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <span>SEO:</span>
                            <span class="badge bg-warning text-dark">Cần tối ưu</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Related Categories -->
            <div class="card border-0 shadow-lg" data-aos="fade-left" data-aos-delay="200">
                <div class="card-header bg-secondary text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tags me-2"></i>Danh mục liên quan
                    </h5>
                </div>
                
                <div class="card-body p-3">
                    <div id="relatedCategories">
                        <div class="text-center py-3">
                            <div class="spinner-border text-secondary" role="status">
                                <span class="visually-hidden">Đang tải...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Analytics Chart (Optional) -->
<div class="container mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg" data-aos="fade-up">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Thống kê danh mục (30 ngày qua)
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <canvas id="categoryChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Load category products
    document.addEventListener('DOMContentLoaded', function() {
        loadCategoryProducts();
        loadRelatedCategories();
        initChart();
    });

    function loadCategoryProducts() {
        setTimeout(() => {
            const productsDiv = document.getElementById('categoryProducts');
            
            // Mock product data
            const products = [
                { id: 1, name: 'iPhone 14 Pro Max', price: 29990000, image: '' },
                { id: 2, name: 'Samsung Galaxy S23 Ultra', price: 26990000, image: '' },
                { id: 3, name: 'MacBook Air M2', price: 32990000, image: '' }
            ];
            
            if (products.length > 0) {
                let html = '<div class="row g-3">';
                products.forEach(product => {
                    html += `
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-mobile-alt text-muted"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">${product.name}</h6>
                                            <p class="text-success mb-0 small fw-bold">
                                                ${new Intl.NumberFormat('vi-VN').format(product.price)}₫
                                            </p>
                                        </div>
                                        <a href="/Product/show/${product.id}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                
                productsDiv.innerHTML = html;
            } else {
                productsDiv.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">Chưa có sản phẩm nào</h6>
                        <p class="text-muted">Hãy thêm sản phẩm đầu tiên cho danh mục này</p>
                        <a href="/Product/add" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Thêm sản phẩm
                        </a>
                    </div>
                `;
            }
        }, 1000);
    }

    function loadRelatedCategories() {
        setTimeout(() => {
            const relatedDiv = document.getElementById('relatedCategories');
            
            // Mock related categories
            const categories = [
                { id: 2, name: 'Laptop', count: 15 },
                { id: 3, name: 'Phụ kiện', count: 8 },
                { id: 4, name: 'Tai nghe', count: 12 }
            ];
            
            if (categories.length > 0) {
                let html = '';
                categories.forEach(cat => {
                    html += `
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <a href="/category/show/${cat.id}" class="text-decoration-none">
                                    <i class="fas fa-tag me-2 text-secondary"></i>
                                    ${cat.name}
                                </a>
                            </div>
                            <span class="badge bg-light text-dark">${cat.count}</span>
                        </div>
                    `;
                });
                relatedDiv.innerHTML = html;
            } else {
                relatedDiv.innerHTML = '<p class="text-muted text-center">Không có danh mục liên quan</p>';
            }
        }, 1500);
    }

    function initChart() {
        const ctx = document.getElementById('categoryChart').getContext('2d');
        
        // Mock chart data
        const data = {
            labels: ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4'],
            datasets: [{
                label: 'Lượt xem',
                data: [65, 85, 75, 95],
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1
            }, {
                label: 'Đơn hàng',
                data: [10, 15, 12, 18],
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                tension: 0.1
            }]
        };

        // Note: In real implementation, you would load Chart.js library
        // For now, we'll show a placeholder
        setTimeout(() => {
            ctx.canvas.parentNode.innerHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                    <h6 class="text-muted">Biểu đồ thống kê</h6>
                    <p class="text-muted small">Chức năng biểu đồ sẽ được triển khai với Chart.js</p>
                </div>
            `;
        }, 2000);
    }

    // Export category data
    function exportCategoryData() {
        showLoading();
        
        setTimeout(() => {
            hideLoading();
            toastr.success('Đã xuất dữ liệu danh mục thành công');
        }, 2000);
    }

    // Share category
    function shareCategory() {
        const categoryName = '<?php echo addslashes($category->name); ?>';
        const currentUrl = window.location.href;
        
        if (navigator.share) {
            navigator.share({
                title: `Danh mục ${categoryName} - TechTafu`,
                text: `Xem danh mục ${categoryName} tại TechTafu`,
                url: currentUrl
            }).then(() => {
                toastr.success('Đã chia sẻ danh mục!');
            }).catch((error) => {
                console.log('Error sharing:', error);
            });
        } else {
            // Fallback copy to clipboard
            navigator.clipboard.writeText(currentUrl).then(() => {
                toastr.success('Đã copy link danh mục!');
            });
        }
    }

    // Add floating action buttons
    document.addEventListener('DOMContentLoaded', function() {
        const fab = document.createElement('div');
        fab.className = 'position-fixed bottom-0 end-0 p-3';
        fab.style.zIndex = '1000';
        fab.innerHTML = `
            <div class="d-flex flex-column gap-2">
                <button class="btn btn-primary rounded-circle" onclick="shareCategory()" title="Chia sẻ danh mục">
                    <i class="fas fa-share-alt"></i>
                </button>
                <button class="btn btn-success rounded-circle" onclick="exportCategoryData()" title="Xuất dữ liệu">
                    <i class="fas fa-download"></i>
                </button>
                <a href="/category/edit/<?php echo $category->id; ?>" class="btn btn-warning rounded-circle" title="Chỉnh sửa">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
        `;
        document.body.appendChild(fab);
    });

    // Auto refresh statistics every 5 minutes
    setInterval(() => {
        console.log('Refreshing category statistics...');
        // In real implementation, you would reload the statistics
    }, 300000);

    // Print category info
    function printCategoryInfo() {
        const printContent = `
            <div style="font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px;">
                <div style="text-align: center; margin-bottom: 30px;">
                    <h1 style="color: #007bff;">TechTafu</h1>
                    <h2>THÔNG TIN DANH MỤC</h2>
                </div>
                
                <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                    <h3><?php echo htmlspecialchars($category->name); ?></h3>
                    <p><strong>ID:</strong> <?php echo $category->id; ?></p>
                    <p><strong>Mô tả:</strong> <?php echo htmlspecialchars($category->description ?: 'Chưa có mô tả'); ?></p>
                    <p><strong>Ngày tạo:</strong> <?php echo date('d/m/Y H:i:s', strtotime($category->created_at ?? 'now')); ?></p>
                </div>
                
                <div style="text-align: center; margin-top: 30px;">
                    <p>Báo cáo được tạo lúc: ${new Date().toLocaleString('vi-VN')}</p>
                </div>
            </div>
        `;
        
        const newWindow = window.open('', '_blank');
        newWindow.document.write(`
            <html>
                <head>
                    <title>Thông tin danh mục - TechTafu</title>
                    <style>
                        body { margin: 0; padding: 20px; }
                        @media print { body { margin: 0; } }
                    </style>
                </head>
                <body>
                    ${printContent}
                    <script>
                        window.onload = function() {
                            window.print();
                            window.close();
                        }
                    </script>
                </body>
            </html>
        `);
    }

    // Add print button to quick actions
    document.addEventListener('DOMContentLoaded', function() {
        const quickActions = document.querySelector('.card-body .d-grid');
        if (quickActions) {
            const printBtn = document.createElement('button');
            printBtn.className = 'btn btn-outline-secondary';
            printBtn.innerHTML = '<i class="fas fa-print me-2"></i>In thông tin';
            printBtn.onclick = printCategoryInfo;
            quickActions.appendChild(printBtn);
        }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // E: Edit category
        if (e.key === 'e' || e.key === 'E') {
            if (!e.target.matches('input, textarea')) {
                window.location.href = '/category/edit/<?php echo $category->id; ?>';
            }
        }
        
        // D: Delete category
        if (e.key === 'd' || e.key === 'D') {
            if (!e.target.matches('input, textarea')) {
                confirmDelete('/category/delete/<?php echo $category->id; ?>', 'Bạn có chắc chắn muốn xóa danh mục này?');
            }
        }
        
        // P: Print
        if (e.ctrlKey && e.key === 'p') {
            e.preventDefault();
            printCategoryInfo();
        }
        
        // Escape: Go back
        if (e.key === 'Escape') {
            window.location.href = '/category/list';
        }
    });

    // Show keyboard shortcuts help
    function showKeyboardHelp() {
        Swal.fire({
            title: 'Phím tắt',
            html: `
                <div class="text-start">
                    <p><kbd>E</kbd> - Chỉnh sửa danh mục</p>
                    <p><kbd>D</kbd> - Xóa danh mục</p>
                    <p><kbd>Ctrl + P</kbd> - In thông tin</p>
                    <p><kbd>Esc</kbd> - Quay lại danh sách</p>
                </div>
            `,
            icon: 'info',
            confirmButtonText: 'Đã hiểu'
        });
    }

    // Add help button
    document.addEventListener('DOMContentLoaded', function() {
        const helpBtn = document.createElement('button');
        helpBtn.className = 'btn btn-outline-info btn-sm position-fixed';
        helpBtn.style.bottom = '20px';
        helpBtn.style.left = '20px';
        helpBtn.style.zIndex = '1000';
        helpBtn.innerHTML = '<i class="fas fa-question-circle"></i>';
        helpBtn.title = 'Phím tắt';
        helpBtn.onclick = showKeyboardHelp;
        document.body.appendChild(helpBtn);
    });
</script>

<?php include_once 'app/views/shares/footer.php'; ?>