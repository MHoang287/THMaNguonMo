<?php 
$title = "Thêm danh mục mới - TechTafu";
include 'app/views/shares/header.php'; 
?>

<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" data-aos="fade-right">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/category/list" class="text-decoration-none">Danh mục</a></li>
            <li class="breadcrumb-item active">Thêm mới</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1" data-aos="fade-right">
                        <i class="fas fa-plus-circle text-primary me-2"></i>
                        Thêm danh mục mới
                    </h2>
                    <p class="text-muted mb-0" data-aos="fade-right" data-aos-delay="100">
                        Tạo danh mục sản phẩm mới cho cửa hàng
                    </p>
                </div>
                <div data-aos="fade-left">
                    <a href="/category/list" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0" data-aos="fade-up">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Thông tin danh mục
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="/category/store" id="categoryForm" class="needs-validation" novalidate>
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
                                    value="<?php echo isset($_SESSION['old_data']['name']) ? htmlspecialchars($_SESSION['old_data']['name']) : ''; ?>"
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
                                ><?php echo isset($_SESSION['old_data']['description']) ? htmlspecialchars($_SESSION['old_data']['description']) : ''; ?></textarea>
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

                        <!-- Preview Card -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-eye text-warning me-2"></i>
                                Xem trước
                            </label>
                            <div class="card border-2 border-dashed" id="previewCard">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0" id="previewName">
                                        <i class="fas fa-tag me-2"></i>
                                        <span class="text-muted">Nhập tên danh mục...</span>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <p class="card-text text-muted mb-0" id="previewDesc">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <em>Nhập mô tả danh mục...</em>
                                    </p>
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
                                    <i class="fas fa-undo me-2"></i>Làm mới
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                    <i class="fas fa-save me-2"></i>Lưu danh mục
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Help Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-lightbulb me-2"></i>
                        Gợi ý
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-primary">
                            <i class="fas fa-check-circle me-2"></i>
                            Tên danh mục tốt:
                        </h6>
                        <ul class="list-unstyled ms-3">
                            <li><i class="fas fa-mobile-alt me-2 text-success"></i>Điện thoại</li>
                            <li><i class="fas fa-laptop me-2 text-success"></i>Laptop</li>
                            <li><i class="fas fa-tv me-2 text-success"></i>Tivi & Audio</li>
                            <li><i class="fas fa-gamepad me-2 text-success"></i>Gaming</li>
                        </ul>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Lưu ý:
                        </h6>
                        <ul class="list-unstyled ms-3 small">
                            <li><i class="fas fa-dot-circle me-2"></i>Tên ngắn gọn, dễ hiểu</li>
                            <li><i class="fas fa-dot-circle me-2"></i>Không trùng lặp</li>
                            <li><i class="fas fa-dot-circle me-2"></i>Phù hợp với sản phẩm</li>
                        </ul>
                    </div>

                    <div class="alert alert-light">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        <small>Danh mục giúp khách hàng tìm kiếm sản phẩm dễ dàng hơn</small>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card border-0 shadow-sm mt-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        Thống kê nhanh
                    </h6>
                </div>
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-primary mb-1">
                                <?php 
                                $db = (new Database())->getConnection();
                                $stmt = $db->query("SELECT COUNT(*) as count FROM category");
                                echo $stmt->fetch(PDO::FETCH_OBJ)->count;
                                ?>
                            </h4>
                            <small class="text-muted">Danh mục hiện có</small>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success mb-1">+1</h4>
                            <small class="text-muted">Sẽ có sau khi thêm</small>
                        </div>
                    </div>
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
            Array.prototype.filter.call(forms, function(form) {
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

    // Character counter for description
    document.getElementById('description').addEventListener('input', function() {
        const charCount = this.value.length;
        document.getElementById('charCount').textContent = charCount;
        
        if (charCount > 450) {
            document.getElementById('charCount').className = 'text-danger';
        } else if (charCount > 300) {
            document.getElementById('charCount').className = 'text-warning';
        } else {
            document.getElementById('charCount').className = 'text-success';
        }
    });

    // Real-time preview
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value.trim();
        const previewName = document.getElementById('previewName');
        
        if (name) {
            previewName.innerHTML = '<i class="fas fa-tag me-2"></i>' + name;
            previewName.className = 'mb-0 text-primary';
        } else {
            previewName.innerHTML = '<i class="fas fa-tag me-2"></i><span class="text-muted">Nhập tên danh mục...</span>';
            previewName.className = 'mb-0';
        }
    });

    document.getElementById('description').addEventListener('input', function() {
        const desc = this.value.trim();
        const previewDesc = document.getElementById('previewDesc');
        
        if (desc) {
            previewDesc.innerHTML = '<i class="fas fa-info-circle me-2"></i>' + desc;
            previewDesc.className = 'card-text text-dark mb-0';
        } else {
            previewDesc.innerHTML = '<i class="fas fa-info-circle me-2"></i><em>Nhập mô tả danh mục...</em>';
            previewDesc.className = 'card-text text-muted mb-0';
        }
    });

    // Check category name exists (AJAX)
    let nameCheckTimeout;
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value.trim();
        const nameExists = document.getElementById('nameExists');
        
        if (name.length > 0) {
            clearTimeout(nameCheckTimeout);
            nameCheckTimeout = setTimeout(function() {
                fetch('/category/checkName', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'name=' + encodeURIComponent(name)
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

    // Reset form
    document.querySelector('button[type="reset"]').addEventListener('click', function() {
        setTimeout(function() {
            document.getElementById('charCount').textContent = '0';
            document.getElementById('charCount').className = 'text-muted';
            document.getElementById('previewName').innerHTML = '<i class="fas fa-tag me-2"></i><span class="text-muted">Nhập tên danh mục...</span>';
            document.getElementById('previewDesc').innerHTML = '<i class="fas fa-info-circle me-2"></i><em>Nhập mô tả danh mục...</em>';
            document.getElementById('nameExists').style.display = 'none';
            document.getElementById('submitBtn').disabled = false;
        }, 100);
    });

    // Auto-focus first input
    document.getElementById('name').focus();
</script>

<?php 
// Clear old data after displaying
unset($_SESSION['old_data']);
include 'app/views/shares/footer.php'; 
?>