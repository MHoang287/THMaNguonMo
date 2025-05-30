<?php 
$title = "Chỉnh sửa danh mục - TechTafu";
include 'app/views/shares/header.php'; 
?>

<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" data-aos="fade-right">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/category/list" class="text-decoration-none">Danh mục</a></li>
            <li class="breadcrumb-item active">Chỉnh sửa</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1" data-aos="fade-right">
                        <i class="fas fa-edit text-warning me-2"></i>
                        Chỉnh sửa danh mục
                    </h2>
                    <p class="text-muted mb-0" data-aos="fade-right" data-aos-delay="100">
                        Cập nhật thông tin danh mục: <strong><?php echo htmlspecialchars($category->name); ?></strong>
                    </p>
                </div>
                <div data-aos="fade-left">
                    <a href="/category/list" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                    <a href="/category/show/<?php echo $category->id; ?>" class="btn btn-outline-info">
                        <i class="fas fa-eye me-2"></i>Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0" data-aos="fade-up">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Cập nhật thông tin
                        </h5>
                        <span class="badge bg-dark">ID: <?php echo $category->id; ?></span>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="/category/update/<?php echo $category->id; ?>" id="categoryForm" class="needs-validation" novalidate>
                        <!-- Category Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">
                                <i class="fas fa-tag text-primary me-2"></i>
                                Tên danh mục <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                <input 
                                    type="text" 
                                    class="form-control form-control-lg" 
                                    id="name" 
                                    name="name" 
                                    placeholder="Nhập tên danh mục..." 
                                    value="<?php echo isset($_SESSION['old_data']['name']) ? htmlspecialchars($_SESSION['old_data']['name']) : htmlspecialchars($category->name); ?>"
                                    required 
                                    maxlength="100"
                                >
                                <div class="invalid-feedback">
                                    Vui lòng nhập tên danh mục
                                </div>
                            </div>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Tên danh mục phải từ 1-100 ký tự và không được trùng lặp
                            </div>
                            <div id="nameExists" class="text-danger mt-2" style="display:none;">
                                <i class="fas fa-exclamation-triangle me-1"></i>
                                Tên danh mục đã tồn tại
                            </div>
                        </div>

                        <!-- Category Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">
                                <i class="fas fa-align-left text-info me-2"></i>
                                Mô tả danh mục
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                <textarea 
                                    class="form-control" 
                                    id="description" 
                                    name="description" 
                                    rows="4" 
                                    placeholder="Nhập mô tả cho danh mục (tùy chọn)..."
                                    maxlength="500"
                                ><?php echo isset($_SESSION['old_data']['description']) ? htmlspecialchars($_SESSION['old_data']['description']) : htmlspecialchars($category->description); ?></textarea>
                            </div>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Mô tả giúp khách hàng hiểu rõ hơn về danh mục (tối đa 500 ký tự)
                            </div>
                            <div class="text-end">
                                <small class="text-muted">
                                    <span id="charCount">0</span>/500 ký tự
                                </small>
                            </div>
                        </div>

                        <!-- Before/After Comparison -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-balance-scale text-success me-2"></i>
                                So sánh thay đổi
                            </label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card border-secondary">
                                        <div class="card-header bg-secondary text-white">
                                            <h6 class="mb-0">
                                                <i class="fas fa-clock me-2"></i>Trước khi sửa
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="text-primary">
                                                <i class="fas fa-tag me-2"></i>
                                                <?php echo htmlspecialchars($category->name); ?>
                                            </h6>
                                            <p class="text-muted mb-0">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <?php echo !empty($category->description) ? htmlspecialchars($category->description) : '<em>Chưa có mô tả</em>'; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border-warning" id="previewCard">
                                        <div class="card-header bg-warning text-dark">
                                            <h6 class="mb-0">
                                                <i class="fas fa-edit me-2"></i>Sau khi sửa
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="text-primary" id="previewName">
                                                <i class="fas fa-tag me-2"></i>
                                                <?php echo htmlspecialchars($category->name); ?>
                                            </h6>
                                            <p class="text-muted mb-0" id="previewDesc">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <?php echo !empty($category->description) ? htmlspecialchars($category->description) : '<em>Chưa có mô tả</em>'; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="/category/list" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-times me-2"></i>Hủy bỏ
                                </a>
                            </div>
                            <div>
                                <button type="reset" class="btn btn-outline-warning btn-lg me-2">
                                    <i class="fas fa-undo me-2"></i>Khôi phục
                                </button>
                                <button type="submit" class="btn btn-warning btn-lg" id="submitBtn">
                                    <i class="fas fa-save me-2"></i>Cập nhật
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="col-lg-4">
            <!-- Category Info -->
            <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Thông tin danh mục
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong class="text-muted">ID:</strong>
                        <span class="badge bg-primary ms-2">#<?php echo $category->id; ?></span>
                    </div>
                    <div class="mb-3">
                        <strong class="text-muted">Tên hiện tại:</strong>
                        <div class="mt-1">
                            <span class="badge bg-secondary"><?php echo htmlspecialchars($category->name); ?></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <strong class="text-muted">Trạng thái:</strong>
                        <div class="mt-1">
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>Hoạt động
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm mt-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Thao tác nhanh
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="/category/show/<?php echo $category->id; ?>" class="btn btn-outline-info">
                            <i class="fas fa-eye me-2"></i>Xem chi tiết
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

            <!-- Help -->
            <div class="card border-0 shadow-sm mt-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-question-circle me-2"></i>
                        Hướng dẫn
                    </h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-light">
                        <i class="fas fa-lightbulb text-warning me-2"></i>
                        <small>Chỉnh sửa cẩn thận để không ảnh hưởng đến sản phẩm đã có</small>
                    </div>
                    <ul class="list-unstyled small">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Kiểm tra tên không trùng lặp
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Mô tả rõ ràng, dễ hiểu
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Xem trước trước khi lưu
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                        toastr.error('Vui lòng kiểm tra lại thông tin!');
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Initialize character counter
    document.addEventListener('DOMContentLoaded', function() {
        const description = document.getElementById('description');
        const charCount = document.getElementById('charCount');
        charCount.textContent = description.value.length;
        updateCharCountColor(description.value.length);
    });

    // Character counter for description
    document.getElementById('description').addEventListener('input', function() {
        const charCount = this.value.length;
        document.getElementById('charCount').textContent = charCount;
        updateCharCountColor(charCount);
    });

    function updateCharCountColor(count) {
        const charCountEl = document.getElementById('charCount');
        if (count > 450) {
            charCountEl.className = 'text-danger';
        } else if (count > 300) {
            charCountEl.className = 'text-warning';
        } else {
            charCountEl.className = 'text-success';
        }
    }

    // Real-time preview
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value.trim();
        const previewName = document.getElementById('previewName');
        
        if (name) {
            previewName.innerHTML = '<i class="fas fa-tag me-2"></i>' + name;
        } else {
            previewName.innerHTML = '<i class="fas fa-tag me-2"></i><?php echo htmlspecialchars($category->name); ?>';
        }
    });

    document.getElementById('description').addEventListener('input', function() {
        const desc = this.value.trim();
        const previewDesc = document.getElementById('previewDesc');
        
        if (desc) {
            previewDesc.innerHTML = '<i class="fas fa-info-circle me-2"></i>' + desc;
            previewDesc.className = 'text-dark mb-0';
        } else {
            previewDesc.innerHTML = '<i class="fas fa-info-circle me-2"></i><em>Chưa có mô tả</em>';
            previewDesc.className = 'text-muted mb-0';
        }
    });

    // Check category name exists (AJAX)
    let nameCheckTimeout;
    const originalName = '<?php echo htmlspecialchars($category->name); ?>';
    
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value.trim();
        const nameExists = document.getElementById('nameExists');
        
        if (name.length > 0 && name !== originalName) {
            clearTimeout(nameCheckTimeout);
            nameCheckTimeout = setTimeout(function() {
                fetch('/category/checkName', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'name=' + encodeURIComponent(name) + '&exclude_id=<?php echo $category->id; ?>'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        nameExists.style.display = 'block';
                        document.getElementById('submitBtn').disabled = true;
                    } else {
                        nameExists.style.display = 'none';
                        document.getElementById('submitBtn').disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }, 500);
        } else {
            nameExists.style.display = 'none';
            document.getElementById('submitBtn').disabled = false;
        }
    });

    // Reset form to original values
    document.querySelector('button[type="reset"]').addEventListener('click', function() {
        setTimeout(function() {
            document.getElementById('name').value = '<?php echo htmlspecialchars($category->name); ?>';
            document.getElementById('description').value = '<?php echo htmlspecialchars($category->description); ?>';
            
            const charCount = document.getElementById('description').value.length;
            document.getElementById('charCount').textContent = charCount;
            updateCharCountColor(charCount);
            
            // Reset preview
            document.getElementById('previewName').innerHTML = '<i class="fas fa-tag me-2"></i><?php echo htmlspecialchars($category->name); ?>';
            document.getElementById('previewDesc').innerHTML = '<i class="fas fa-info-circle me-2"></i><?php echo !empty($category->description) ? htmlspecialchars($category->description) : "<em>Chưa có mô tả</em>"; ?>';
            
            document.getElementById('nameExists').style.display = 'none';
            document.getElementById('submitBtn').disabled = false;
        }, 100);
    });

    // Delete category function
    function deleteCategory(id) {
        confirmDelete('Bạn có chắc chắn muốn xóa danh mục này? Hành động này không thể hoàn tác!').then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Đang xóa...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                window.location.href = '/category/delete/' + id;
            }
        });
    }

    // Highlight changes
    function highlightChanges() {
        const nameInput = document.getElementById('name');
        const descInput = document.getElementById('description');
        
        if (nameInput.value !== originalName) {
            nameInput.style.borderColor = '#ffc107';
            nameInput.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';
        } else {
            nameInput.style.borderColor = '';
            nameInput.style.boxShadow = '';
        }
        
        const originalDesc = '<?php echo htmlspecialchars($category->description); ?>';
        if (descInput.value !== originalDesc) {
            descInput.style.borderColor = '#ffc107';
            descInput.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';
        } else {
            descInput.style.borderColor = '';
            descInput.style.boxShadow = '';
        }
    }

    document.getElementById('name').addEventListener('input', highlightChanges);
    document.getElementById('description').addEventListener('input', highlightChanges);

    // Auto-focus first input
    document.getElementById('name').focus();
    document.getElementById('name').select();
</script>

<?php 
// Clear old data after displaying
unset($_SESSION['old_data']);
include 'app/views/shares/footer.php'; 
?>