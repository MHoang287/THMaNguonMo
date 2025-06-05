<?php 
$title = "Quản lý danh mục";
include 'app/views/shares/header.php'; 
?>

<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" data-aos="fade-down">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active">Quản lý danh mục</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-6 fw-bold mb-3">
                        <i class="fas fa-list me-3 text-primary"></i>Quản lý danh mục
                    </h1>
                    <p class="lead text-muted">Quản lý các danh mục sản phẩm của cửa hàng</p>
                </div>
                <div>
                    <a href="/category/create" class="btn btn-success btn-lg btn-custom">
                        <i class="fas fa-plus me-2"></i>Thêm danh mục mới
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-5 g-4">
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-list fa-lg"></i>
                    </div>
                    <h3 class="fw-bold text-primary"><?= count($categories ?? []) ?></h3>
                    <p class="text-muted mb-0">Tổng danh mục</p>
                </div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon bg-success text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-eye fa-lg"></i>
                    </div>
                    <h3 class="fw-bold text-success"><?= count(array_filter($categories ?? [], function($cat) { return !empty($cat->name); })) ?></h3>
                    <p class="text-muted mb-0">Đang hoạt động</p>
                </div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon bg-warning text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-box fa-lg"></i>
                    </div>
                    <h3 class="fw-bold text-warning">-</h3>
                    <p class="text-muted mb-0">Tổng sản phẩm</p>
                </div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon bg-info text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-chart-line fa-lg"></i>
                    </div>
                    <h3 class="fw-bold text-info">100%</h3>
                    <p class="text-muted mb-0">Hiệu suất</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-md-6" data-aos="fade-right">
            <div class="search-box position-relative">
                <input type="text" class="form-control form-control-lg" id="searchInput" placeholder="Tìm kiếm danh mục...">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-6" data-aos="fade-left">
            <div class="d-flex gap-2 justify-content-md-end">
                <select class="form-select" id="sortSelect">
                    <option value="">Sắp xếp theo</option>
                    <option value="name_asc">Tên A-Z</option>
                    <option value="name_desc">Tên Z-A</option>
                    <option value="id_asc">Cũ nhất</option>
                    <option value="id_desc">Mới nhất</option>
                </select>
                <button class="btn btn-outline-primary" onclick="exportCategories()">
                    <i class="fas fa-download me-2"></i>Xuất Excel
                </button>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="card shadow-lg border-0" data-aos="fade-up">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="fas fa-table me-2"></i>Danh sách danh mục
            </h5>
        </div>
        <div class="card-body p-0">
            <?php if (!empty($categories)): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="categoriesTable">
                        <thead class="table-light">
                            <tr>
                                <th width="10%">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                        <label class="form-check-label" for="selectAll">ID</label>
                                    </div>
                                </th>
                                <th width="25%">Tên danh mục</th>
                                <th width="40%">Mô tả</th>
                                <th width="15%">Trạng thái</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $index => $category): ?>
                                <tr class="category-row" data-id="<?= $category->id ?>" data-name="<?= strtolower($category->name) ?>">
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input row-checkbox" type="checkbox" value="<?= $category->id ?>">
                                            <label class="form-check-label fw-bold text-primary">
                                                #<?= str_pad($category->id, 3, '0', STR_PAD_LEFT) ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="category-icon bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fas fa-tag"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1"><?= htmlspecialchars($category->name) ?></h6>
                                                <small class="text-muted">Danh mục #<?= $category->id ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="description-cell">
                                            <?php if (!empty($category->description)): ?>
                                                <p class="mb-0 text-muted">
                                                    <?= htmlspecialchars(substr($category->description, 0, 100)) ?>
                                                    <?= strlen($category->description) > 100 ? '...' : '' ?>
                                                </p>
                                            <?php else: ?>
                                                <span class="text-muted fst-italic">Chưa có mô tả</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Hoạt động
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-info" 
                                                    onclick="viewCategory(<?= $category->id ?>)"
                                                    data-bs-toggle="tooltip" 
                                                    title="Xem chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="/category/edit/<?= $category->id ?>" 
                                               class="btn btn-sm btn-outline-warning"
                                               data-bs-toggle="tooltip" 
                                               title="Chỉnh sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-danger" 
                                                    onclick="deleteCategory(<?= $category->id ?>)"
                                                    data-bs-toggle="tooltip" 
                                                    title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Bulk Actions -->
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bulk-actions d-none">
                            <span class="text-muted me-3">
                                <span id="selectedCount">0</span> mục đã chọn
                            </span>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-danger" onclick="bulkDelete()">
                                    <i class="fas fa-trash me-1"></i>Xóa tất cả
                                </button>
                                <button class="btn btn-sm btn-outline-success" onclick="bulkExport()">
                                    <i class="fas fa-download me-1"></i>Xuất Excel
                                </button>
                            </div>
                        </div>
                        <div class="pagination-info text-muted">
                            Hiển thị <?= count($categories) ?> danh mục
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <!-- Empty State -->
                <div class="text-center py-5">
                    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_E2DuUN.json" 
                                   background="transparent" 
                                   speed="1" 
                                   style="width: 200px; height: 200px; margin: 0 auto;" 
                                   loop autoplay></lottie-player>
                    <h4 class="text-muted mt-3">Chưa có danh mục nào</h4>
                    <p class="text-muted mb-4">Hãy tạo danh mục đầu tiên cho cửa hàng của bạn!</p>
                    <a href="/category/create" class="btn btn-primary btn-lg btn-custom">
                        <i class="fas fa-plus me-2"></i>Tạo danh mục đầu tiên
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Category Detail Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-eye me-2"></i>Chi tiết danh mục
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="category-detail-info">
                            <h6 class="text-primary mb-3">Thông tin cơ bản</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-semibold">ID:</td>
                                    <td id="modalCategoryId">-</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Tên danh mục:</td>
                                    <td id="modalCategoryName">-</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Trạng thái:</td>
                                    <td>
                                        <span class="badge bg-success">Hoạt động</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Ngày tạo:</td>
                                    <td><?= date('d/m/Y H:i') ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="category-stats">
                            <h6 class="text-primary mb-3">Thống kê</h6>
                            <div class="stat-item d-flex justify-content-between mb-2">
                                <span>Tổng sản phẩm:</span>
                                <span class="fw-bold">0</span>
                            </div>
                            <div class="stat-item d-flex justify-content-between mb-2">
                                <span>Sản phẩm hoạt động:</span>
                                <span class="fw-bold text-success">0</span>
                            </div>
                            <div class="stat-item d-flex justify-content-between mb-2">
                                <span>Lượt xem:</span>
                                <span class="fw-bold text-info">0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">Mô tả</h6>
                        <div class="bg-light p-3 rounded">
                            <p id="modalCategoryDescription" class="mb-0 text-muted">Chưa có mô tả</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-warning" onclick="editCategoryFromModal()">
                    <i class="fas fa-edit me-2"></i>Chỉnh sửa
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentCategoryId = null;

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('.category-row');
        
        rows.forEach(row => {
            const name = row.dataset.name;
            if (name.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Sort functionality
    document.getElementById('sortSelect').addEventListener('change', function() {
        const sortValue = this.value;
        const tbody = document.querySelector('#categoriesTable tbody');
        const rows = Array.from(tbody.querySelectorAll('.category-row'));
        
        rows.sort((a, b) => {
            switch(sortValue) {
                case 'name_asc':
                    return a.dataset.name.localeCompare(b.dataset.name);
                case 'name_desc':
                    return b.dataset.name.localeCompare(a.dataset.name);
                case 'id_asc':
                    return parseInt(a.dataset.id) - parseInt(b.dataset.id);
                case 'id_desc':
                    return parseInt(b.dataset.id) - parseInt(a.dataset.id);
                default:
                    return 0;
            }
        });
        
        rows.forEach(row => tbody.appendChild(row));
    });

    // Select all functionality
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkActions();
    });

    // Row checkbox functionality
    document.querySelectorAll('.row-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });

    function updateBulkActions() {
        const selectedCheckboxes = document.querySelectorAll('.row-checkbox:checked');
        const bulkActions = document.querySelector('.bulk-actions');
        const selectedCount = document.getElementById('selectedCount');
        
        if (selectedCheckboxes.length > 0) {
            bulkActions.classList.remove('d-none');
            selectedCount.textContent = selectedCheckboxes.length;
        } else {
            bulkActions.classList.add('d-none');
        }
    }

    // View category function
    function viewCategory(id) {
        currentCategoryId = id;
        
        // Find category data (in real app, this would be from database)
        const row = document.querySelector(`[data-id="${id}"]`);
        const name = row.querySelector('h6').textContent;
        const description = row.querySelector('.description-cell p')?.textContent || 'Chưa có mô tả';
        
        // Update modal content
        document.getElementById('modalCategoryId').textContent = '#' + String(id).padStart(3, '0');
        document.getElementById('modalCategoryName').textContent = name;
        document.getElementById('modalCategoryDescription').textContent = description;
        
        // Show modal
        new bootstrap.Modal(document.getElementById('categoryModal')).show();
    }

    // Edit from modal
    function editCategoryFromModal() {
        if (currentCategoryId) {
            window.location.href = `/category/edit/${currentCategoryId}`;
        }
    }

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

    // Bulk delete function
    function bulkDelete() {
        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked'))
                                .map(cb => cb.value);
        
        if (selectedIds.length === 0) return;
        
        Swal.fire({
            title: 'Xóa nhiều danh mục?',
            text: `Bạn có chắc chắn muốn xóa ${selectedIds.length} danh mục đã chọn?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Có, xóa tất cả!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                // Implement bulk delete logic here
                console.log('Deleting categories:', selectedIds);
                Swal.fire('Đã xóa!', 'Các danh mục đã được xóa.', 'success');
            }
        });
    }

    // Export functions
    function exportCategories() {
        Swal.fire({
            title: 'Xuất dữ liệu',
            text: 'Bạn muốn xuất toàn bộ danh mục ra file Excel?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Có, xuất ngay!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                // Implement export logic here
                Swal.fire('Đang xuất...', 'File sẽ được tải xuống trong giây lát', 'info');
            }
        });
    }

    function bulkExport() {
        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked'))
                                .map(cb => cb.value);
        
        if (selectedIds.length === 0) return;
        
        // Implement bulk export logic here
        console.log('Exporting categories:', selectedIds);
    }

    // Initialize animations
    document.addEventListener('DOMContentLoaded', function() {
        // Animate table rows
        anime({
            targets: '.category-row',
            translateX: [-50, 0],
            opacity: [0, 1],
            duration: 600,
            delay: anime.stagger(50),
            easing: 'easeOutQuad'
        });

        // Animate stat cards
        anime({
            targets: '.stat-icon',
            scale: [0, 1],
            duration: 800,
            delay: anime.stagger(100),
            easing: 'easeOutBack'
        });
    });
</script>

<?php include 'app/views/shares/footer.php'; ?>