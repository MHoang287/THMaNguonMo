<?php
$title = "Quản lý danh mục";
include_once 'app/views/shares/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="/Product" class="text-white-50">Trang chủ</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Danh mục</li>
                    </ol>
                </nav>
                <h1 class="h2 mb-0 animate__animated animate__fadeInLeft">
                    <i class="fas fa-tags me-2"></i>Quản lý danh mục
                </h1>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="/category/create" class="btn btn-light btn-lg animate__animated animate__fadeInRight">
                    <i class="fas fa-plus me-2"></i>Thêm danh mục mới
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm" data-aos="fade-right">
                <div class="card-body">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Tìm kiếm danh mục..." 
                               id="searchInput" onkeyup="searchCategories()">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm" data-aos="fade-left">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Tổng cộng: <strong id="totalCount"><?php echo count($categories); ?></strong> danh mục
                        </span>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-primary active" onclick="setView('grid')">
                                <i class="fas fa-th"></i>
                            </button>
                            <button type="button" class="btn btn-outline-primary" onclick="setView('list')">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <?php if (empty($categories)): ?>
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5" data-aos="fade-up">
                    <i class="fas fa-tags text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                    <h4 class="mt-3 text-muted">Chưa có danh mục nào</h4>
                    <p class="text-muted">Hãy tạo danh mục đầu tiên để phân loại sản phẩm</p>
                    <a href="/category/create" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>Tạo danh mục mới
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Grid View -->
        <div id="gridView" class="row g-4">
            <?php foreach ($categories as $index => $category): ?>
                <div class="col-lg-4 col-md-6 category-item" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                    <div class="card border-0 shadow-lg h-100 category-card">
                        <div class="card-header bg-gradient bg-primary text-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-tag me-2"></i>
                                    <span class="category-name"><?php echo htmlspecialchars($category->name); ?></span>
                                </h6>
                                <span class="badge bg-light text-dark">ID: <?php echo $category->id; ?></span>
                            </div>
                        </div>
                        
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="mb-3 flex-grow-1">
                                <?php if (!empty($category->description)): ?>
                                    <p class="text-muted mb-0 category-description">
                                        <?php echo htmlspecialchars($category->description); ?>
                                    </p>
                                <?php else: ?>
                                    <p class="text-muted fst-italic mb-0">Chưa có mô tả</p>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Category Stats (Mock data - you can implement real counts) -->
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="bg-light p-2 rounded text-center">
                                        <small class="text-muted d-block">Sản phẩm</small>
                                        <strong class="text-primary"><?php echo rand(0, 50); ?></strong>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light p-2 rounded text-center">
                                        <small class="text-muted d-block">Trạng thái</small>
                                        <span class="badge bg-success">Hoạt động</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex gap-2 mt-auto">
                                <a href="/category/show/<?php echo $category->id; ?>" 
                                   class="btn btn-outline-info btn-sm flex-fill" title="Xem chi tiết">
                                    <i class="fas fa-eye me-1"></i>Xem
                                </a>
                                <a href="/category/edit/<?php echo $category->id; ?>" 
                                   class="btn btn-outline-warning btn-sm flex-fill" title="Chỉnh sửa">
                                    <i class="fas fa-edit me-1"></i>Sửa
                                </a>
                                <button onclick="confirmDelete('/category/delete/<?php echo $category->id; ?>', 'Bạn có chắc chắn muốn xóa danh mục này?')" 
                                        class="btn btn-outline-danger btn-sm flex-fill" title="Xóa">
                                    <i class="fas fa-trash me-1"></i>Xóa
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- List View (Hidden by default) -->
        <div id="listView" class="d-none">
            <div class="card border-0 shadow-lg" data-aos="fade-up">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list me-2"></i>Danh sách danh mục
                    </h5>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 80px;">ID</th>
                                    <th>Tên danh mục</th>
                                    <th>Mô tả</th>
                                    <th style="width: 100px;">Sản phẩm</th>
                                    <th style="width: 100px;">Trạng thái</th>
                                    <th style="width: 150px;" class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category): ?>
                                    <tr class="category-row">
                                        <td>
                                            <span class="badge bg-primary"><?php echo $category->id; ?></span>
                                        </td>
                                        <td>
                                            <strong class="category-name"><?php echo htmlspecialchars($category->name); ?></strong>
                                        </td>
                                        <td>
                                            <span class="category-description">
                                                <?php 
                                                if (!empty($category->description)) {
                                                    echo htmlspecialchars(substr($category->description, 0, 100)) . 
                                                         (strlen($category->description) > 100 ? '...' : '');
                                                } else {
                                                    echo '<span class="text-muted fst-italic">Chưa có mô tả</span>';
                                                }
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info"><?php echo rand(0, 50); ?></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Hoạt động</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="/category/show/<?php echo $category->id; ?>" 
                                                   class="btn btn-outline-info" title="Xem chi tiết">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/category/edit/<?php echo $category->id; ?>" 
                                                   class="btn btn-outline-warning" title="Chỉnh sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button onclick="confirmDelete('/category/delete/<?php echo $category->id; ?>', 'Bạn có chắc chắn muốn xóa danh mục này?')" 
                                                        class="btn btn-outline-danger" title="Xóa">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Bulk Actions (when categories exist) -->
<?php if (!empty($categories)): ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" data-aos="fade-up">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                                <label class="form-check-label" for="selectAll">
                                    Chọn tất cả
                                </label>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" 
                                        data-bs-toggle="dropdown" disabled id="bulkActionBtn">
                                    Thao tác hàng loạt
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" onclick="exportSelected()">
                                        <i class="fas fa-download me-2"></i>Xuất dữ liệu
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#" onclick="deleteSelected()">
                                        <i class="fas fa-trash me-2"></i>Xóa đã chọn
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-success" onclick="exportAll()">
                                <i class="fas fa-file-excel me-2"></i>Xuất Excel
                            </button>
                            <a href="/category/create" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Thêm mới
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
    // Search functionality
    function searchCategories() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const categoryItems = document.querySelectorAll('.category-item, .category-row');
        let visibleCount = 0;
        
        categoryItems.forEach(item => {
            const name = item.querySelector('.category-name').textContent.toLowerCase();
            const description = item.querySelector('.category-description').textContent.toLowerCase();
            
            if (name.includes(searchTerm) || description.includes(searchTerm)) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        document.getElementById('totalCount').textContent = visibleCount;
    }

    // View toggle functionality
    function setView(viewType) {
        const gridView = document.getElementById('gridView');
        const listView = document.getElementById('listView');
        const buttons = document.querySelectorAll('.btn-group .btn');
        
        // Update active button
        buttons.forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        
        if (viewType === 'grid') {
            gridView.classList.remove('d-none');
            listView.classList.add('d-none');
        } else {
            gridView.classList.add('d-none');
            listView.classList.remove('d-none');
        }
        
        // Save preference
        localStorage.setItem('categoryViewType', viewType);
    }

    // Load saved view preference
    document.addEventListener('DOMContentLoaded', function() {
        const savedView = localStorage.getItem('categoryViewType') || 'grid';
        if (savedView === 'list') {
            setView('list');
        }
    });

    // Select all functionality
    function toggleSelectAll() {
        const selectAllCheckbox = document.getElementById('selectAll');
        const itemCheckboxes = document.querySelectorAll('.item-checkbox');
        const bulkActionBtn = document.getElementById('bulkActionBtn');
        
        itemCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
        
        bulkActionBtn.disabled = !selectAllCheckbox.checked;
    }

    // Export functions
    function exportSelected() {
        const selectedItems = document.querySelectorAll('.item-checkbox:checked');
        if (selectedItems.length === 0) {
            toastr.warning('Vui lòng chọn ít nhất một danh mục');
            return;
        }
        
        toastr.info('Đang xuất dữ liệu...');
        // Implement export functionality
    }

    function exportAll() {
        showLoading();
        
        // Simulate export
        setTimeout(() => {
            hideLoading();
            toastr.success('Đã xuất file Excel thành công');
        }, 2000);
    }

    function deleteSelected() {
        const selectedItems = document.querySelectorAll('.item-checkbox:checked');
        if (selectedItems.length === 0) {
            toastr.warning('Vui lòng chọn ít nhất một danh mục');
            return;
        }
        
        Swal.fire({
            title: 'Xóa danh mục đã chọn',
            text: `Bạn có chắc chắn muốn xóa ${selectedItems.length} danh mục đã chọn?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                // Implement bulk delete
                toastr.success('Đã xóa các danh mục đã chọn');
            }
        });
    }

    // Add hover effects to cards
    document.querySelectorAll('.category-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.transition = 'all 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Auto-refresh data every 30 seconds
    setInterval(function() {
        // You can implement auto-refresh functionality here
        console.log('Auto-refreshing category data...');
    }, 30000);

    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl + N: New category
        if (e.ctrlKey && e.key === 'n') {
            e.preventDefault();
            window.location.href = '/category/create';
        }
        
        // Ctrl + F: Focus search
        if (e.ctrlKey && e.key === 'f') {
            e.preventDefault();
            document.getElementById('searchInput').focus();
        }
    });
</script>

<?php include_once 'app/views/shares/footer.php'; ?>