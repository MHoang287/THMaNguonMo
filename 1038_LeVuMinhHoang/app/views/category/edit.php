<?php 
$title = "Chỉnh sửa danh mục";
include 'app/views/shares/header.php'; 
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" data-aos="fade-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="/category/list">Danh mục</a></li>
                    <li class="breadcrumb-item active">Chỉnh sửa</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="d-inline-flex align-items-center justify-content-center bg-warning text-white rounded-circle mb-3" style="width: 80px; height: 80px;">
                    <i class="fas fa-edit fa-2x"></i>
                </div>
                <h1 class="display-6 fw-bold mb-3">Chỉnh sửa danh mục</h1>
                <p class="lead text-muted">Cập nhật thông tin danh mục <?= htmlspecialchars($category->name) ?></p>
            </div>

            <!-- Form Card -->
            <div class="card shadow-lg border-0" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header bg-warning text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Thông tin danh mục
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="/category/update/<?= $category->id ?>" id="categoryForm" novalidate>
                        <div class="row g-4">
                            <!-- Category ID (Display Only) -->
                            <div class="col-md-4">
                                <label class="form-label">
                                    <i class="fas fa-hashtag me-1 text-warning"></i>ID Danh mục
                                </label>
                                <input type="text" class="form-control" value="#<?= str_pad($category->id, 3, '0', STR_PAD_LEFT) ?>" readonly>
                            </div>

                            <!-- Created Date (Display Only) -->
                            <div class="col-md-8">
                                <label class="form-label">
                                    <i class="fas fa-calendar me-1 text-warning"></i>Ngày tạo
                                </label>
                                <input type="text" class="form-control" value="<?= date('d/m/Y H:i') ?>" readonly>
                            </div>

                            <!-- Category Name -->
                            <div class="col-12">
                                <label for="name" class="form-label">
                                    <i class="fas fa-tag me-1 text-warning"></i>Tên danh mục *
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="name" 
                                       name="name" 
                                       value="<?= htmlspecialchars($category->name) ?>"
                                       placeholder="Nhập tên danh mục..." 
                                       required
                                       maxlength="100">
                                <div class="invalid-feedback">
                                    Vui lòng nhập tên danh mục (tối đa 100 ký tự)
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Tên danh mục sẽ được hiển thị trên website
                                </div>
                                <div class="name-check-result mt-2"></div>
                            </div>

                            <!-- Category Description -->
                            <div class="col-12">
                                <label for="description" class="form-label">
                                    <i class="fas fa-align-left me-1 text-warning"></i>Mô tả danh mục
                                </label>
                                <textarea class="form-control" 
                                          id="description" 
                                          name="description" 
                                          rows="5" 
                                          placeholder="Nhập mô tả chi tiết về danh mục..."><?= htmlspecialchars($category->description) ?></textarea>
                                <div class="form-text">
                                    <i class="fas fa-lightbulb me-1"></i>
                                    Mô tả giúp khách hàng hiểu rõ hơn về danh mục này
                                </div>
                                <div class="character-count text-end mt-2">
                                    <small class="text-muted">
                                        <span id="charCount"><?= strlen($category->description) ?></span> ký tự
                                    </small>
                                </div>
                            </div>

                            <!-- Category Settings -->
                            <div class="col-12">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="fas fa-cogs me-2 text-warning"></i>Cài đặt danh mục
                                        </h6>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="isActive" checked>
                                                    <label class="form-check-label" for="isActive">
                                                        Kích hoạt danh mục
                                                    </label>
                                                </div>
                                                <small class="text-muted">Danh mục sẽ hiển thị trên website</small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="isFeatured">
                                                    <label class="form-check-label" for="isFeatured">
                                                        Danh mục nổi bật
                                                    </label>
                                                </div>
                                                <small class="text-muted">Hiển thị ở vị trí ưu tiên</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistics -->
                            <div class="col-12">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        <h6 class="mb-0">
                                            <i class="fas fa-chart-bar me-2"></i>Thống kê danh mục
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row text-center">
                                            <div class="col-md-3">
                                                <div class="stat-item">
                                                    <h4 class="text-primary mb-1">0</h4>
                                                    <small class="text-muted">Tổng sản phẩm</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="stat-item">
                                                    <h4 class="text-success mb-1">0</h4>
                                                    <small class="text-muted">Đang bán</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="stat-item">
                                                    <h4 class="text-warning mb-1">0</h4>
                                                    <small class="text-muted">Hết hàng</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="stat-item">
                                                    <h4 class="text-info mb-1">0</h4>
                                                    <small class="text-muted">Lượt xem</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="/category/list" class="btn btn-secondary btn-lg">
                                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                                    </a>
                                    <div class="d-flex gap-3">
                                        <a href="/category/show/<?= $category->id ?>" class="btn btn-outline-info btn-lg">
                                            <i class="fas fa-eye me-2"></i>Xem chi tiết
                                        </a>
                                        <button type="button" class="btn btn-outline-warning btn-lg" onclick="previewCategory()">
                                            <i class="fas fa-eye me-2"></i>Xem trước
                                        </button>
                                        <button type="submit" class="btn btn-warning btn-lg btn-custom" id="submitBtn">
                                            <i class="fas fa-save me-2"></i>Cập nhật
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-4 border-danger" data-aos="fade-up" data-aos-delay="400">
                <div class="card-header bg-danger text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>Hành động nhanh
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <button class="btn btn-outline-primary w-100" onclick="duplicateCategory()">
                                <i class="fas fa-copy me-2"></i>Nhân bản danh mục
                            </button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-outline-info w-100" onclick="exportCategory()">
                                <i class="fas fa-download me-2"></i>Xuất dữ liệu
                            </button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-outline-danger w-100" onclick="deleteCategory(<?= $category->id ?>)">
                                <i class="fas fa-trash me-2"></i>Xóa danh mục
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-eye me-2"></i>Xem trước danh mục
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="preview-content">
                    <div class="category-preview-card">
                        <div class="card border-warning">
                            <div class="card-header bg-warning text-white">
                                <h5 class="mb-0" id="previewName"><?= htmlspecialchars($category->name) ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <div class="category-icon bg-warning text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                            <i class="fas fa-tag fa-2x"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <h6>Mô tả danh mục:</h6>
                                        <p class="text-muted" id="previewDescription"><?= htmlspecialchars($category->description) ?></p>
                                        
                                        <div class="mt-3">
                                            <h6>Thông tin:</h6>
                                            <div class="d-flex gap-2 flex-wrap">
                                                <span class="badge bg-info">ID: #<?= str_pad($category->id, 3, '0', STR_PAD_LEFT) ?></span>
                                                <span class="badge bg-success" id="previewStatus">Hoạt động</span>
                                                <span class="badge bg-warning d-none" id="previewFeatured">Nổi bật</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-warning" onclick="$('#categoryForm').submit()">
                    <i class="fas fa-save me-2"></i>Cập nhật danh mục
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Duplicate Modal -->
<div class="modal fade" id="duplicateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-copy me-2"></i>Nhân bản danh mục
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="duplicateForm">
                    <div class="mb-3">
                        <label for="duplicateName" class="form-label">Tên danh mục mới:</label>
                        <input type="text" class="form-control" id="duplicateName" value="<?= htmlspecialchars($category->name) ?> - Copy" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="copyProducts">
                            <label class="form-check-label" for="copyProducts">
                                Sao chép cả sản phẩm trong danh mục
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" onclick="processDuplicate()">
                    <i class="fas fa-copy me-2"></i>Nhân bản
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Character count for description
    document.getElementById('description').addEventListener('input', function() {
        const charCount = this.value.length;
        document.getElementById('charCount').textContent = charCount;
        
        // Auto-resize textarea
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Check name availability (exclude current category)
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const currentName = '<?= htmlspecialchars($category->name) ?>';
        
        if (name.length < 2 || name === currentName) return;
        
        const resultDiv = document.querySelector('.name-check-result');
        resultDiv.innerHTML = '<small class="text-info"><i class="fas fa-spinner fa-spin me-1"></i>Đang kiểm tra...</small>';
        
        // Simulate API call
        setTimeout(() => {
            const isAvailable = true; // Simulate result
            
            if (isAvailable) {
                resultDiv.innerHTML = '<small class="text-success"><i class="fas fa-check me-1"></i>Tên danh mục có thể sử dụng</small>';
            } else {
                resultDiv.innerHTML = '<small class="text-danger"><i class="fas fa-times me-1"></i>Tên danh mục đã tồn tại</small>';
            }
        }, 1000);
    });

    // Preview category function
    function previewCategory() {
        const name = document.getElementById('name').value || 'Tên danh mục';
        const description = document.getElementById('description').value || 'Chưa có mô tả';
        const isActive = document.getElementById('isActive').checked;
        const isFeatured = document.getElementById('isFeatured').checked;

        // Update modal content
        document.getElementById('previewName').textContent = name;
        document.getElementById('previewDescription').textContent = description;
        
        const statusBadge = document.getElementById('previewStatus');
        const featuredBadge = document.getElementById('previewFeatured');
        
        if (isActive) {
            statusBadge.textContent = 'Hoạt động';
            statusBadge.className = 'badge bg-success';
        } else {
            statusBadge.textContent = 'Tạm ngưng';
            statusBadge.className = 'badge bg-secondary';
        }
        
        if (isFeatured) {
            featuredBadge.classList.remove('d-none');
        } else {
            featuredBadge.classList.add('d-none');
        }

        // Show modal
        new bootstrap.Modal(document.getElementById('previewModal')).show();
    }

    // Duplicate category function
    function duplicateCategory() {
        new bootstrap.Modal(document.getElementById('duplicateModal')).show();
    }

    function processDuplicate() {
        const newName = document.getElementById('duplicateName').value;
        const copyProducts = document.getElementById('copyProducts').checked;
        
        if (!newName) {
            Swal.fire('Lỗi', 'Vui lòng nhập tên danh mục mới', 'error');
            return;
        }
        
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
            Swal.fire('Thành công!', `Đã nhân bản danh mục "${newName}"`, 'success');
            bootstrap.Modal.getInstance(document.getElementById('duplicateModal')).hide();
        }, 2000);
    }

    // Export category function
    function exportCategory() {
        Swal.fire({
            title: 'Xuất dữ liệu danh mục',
            text: 'Chọn định dạng file muốn xuất:',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Excel (.xlsx)',
            cancelButtonText: 'PDF (.pdf)',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Export to Excel
                Swal.fire('Đang xuất...', 'File Excel sẽ được tải xuống', 'info');
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Export to PDF
                Swal.fire('Đang xuất...', 'File PDF sẽ được tải xuống', 'info');
            }
        });
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

    // Form validation
    document.getElementById('categoryForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            
            // Scroll to first invalid field
            const firstInvalid = this.querySelector(':invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus();
            }
            return;
        }

        // Confirm update
        Swal.fire({
            title: 'Xác nhận cập nhật',
            text: 'Bạn có chắc chắn muốn cập nhật danh mục này?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Có, cập nhật!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                const submitBtn = document.getElementById('submitBtn');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang cập nhật...';
                submitBtn.disabled = true;

                // Submit form
                this.submit();
            }
        });
    });

    // Real-time validation and preview updates
    document.querySelectorAll('input[required], textarea[required]').forEach(field => {
        field.addEventListener('blur', function() {
            if (this.checkValidity()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
            }
        });

        field.addEventListener('input', function() {
            if (this.classList.contains('is-invalid') && this.checkValidity()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
            
            // Update preview in real-time
            updatePreview();
        });
    });

    function updatePreview() {
        const name = document.getElementById('name').value || 'Tên danh mục';
        const description = document.getElementById('description').value || 'Chưa có mô tả';
        const isActive = document.getElementById('isActive').checked;
        const isFeatured = document.getElementById('isFeatured').checked;

        document.getElementById('previewName').textContent = name;
        document.getElementById('previewDescription').textContent = description;
        
        const statusBadge = document.getElementById('previewStatus');
        const featuredBadge = document.getElementById('previewFeatured');
        
        if (isActive) {
            statusBadge.textContent = 'Hoạt động';
            statusBadge.className = 'badge bg-success';
        } else {
            statusBadge.textContent = 'Tạm ngưng';
            statusBadge.className = 'badge bg-secondary';
        }
        
        if (isFeatured) {
            featuredBadge.classList.remove('d-none');
        } else {
            featuredBadge.classList.add('d-none');
        }
    }

    // Auto-resize textarea on load
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('description');
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
    });
</script>

<?php include 'app/views/shares/footer.php'; ?>