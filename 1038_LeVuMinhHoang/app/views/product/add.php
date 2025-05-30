<?php
$title = "Thêm sản phẩm mới";
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
                        <li class="breadcrumb-item"><a href="/Product" class="text-white-50">Sản phẩm</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Thêm mới</li>
                    </ol>
                </nav>
                <h1 class="h2 mb-0 animate__animated animate__fadeInLeft">
                    <i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm mới
                </h1>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="/Product" class="btn btn-outline-light animate__animated animate__fadeInRight">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg animate-fade-in" data-aos="fade-up">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Thông tin sản phẩm
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <?php if (isset($errors) && !empty($errors)): ?>
                        <div class="alert alert-danger animate__animated animate__shakeX">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Vui lòng kiểm tra lại:</strong>
                            <ul class="mb-0 mt-2">
                                <?php foreach ($errors as $field => $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="/Product/save" method="POST" enctype="multipart/form-data" id="productForm">
                        <div class="row g-4">
                            <!-- Product Name -->
                            <div class="col-12">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-tag me-1 text-primary"></i>Tên sản phẩm *
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" 
                                       id="name" 
                                       name="name" 
                                       placeholder="Nhập tên sản phẩm..."
                                       value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                                       required>
                                <?php if (isset($errors['name'])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo htmlspecialchars($errors['name']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Category -->
                            <div class="col-md-6">
                                <label for="category_id" class="form-label fw-bold">
                                    <i class="fas fa-list me-1 text-primary"></i>Danh mục
                                </label>
                                <select class="form-select form-select-lg" id="category_id" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    <?php if (isset($categories) && !empty($categories)): ?>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?php echo $category->id; ?>" 
                                                    <?php echo (($_POST['category_id'] ?? '') == $category->id) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($category->name); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <!-- Price -->
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-bold">
                                    <i class="fas fa-money-bill-wave me-1 text-primary"></i>Giá bán (VNĐ) *
                                </label>
                                <div class="input-group input-group-lg">
                                    <input type="number" 
                                           class="form-control <?php echo isset($errors['price']) ? 'is-invalid' : ''; ?>" 
                                           id="price" 
                                           name="price" 
                                           placeholder="0"
                                           min="0"
                                           step="1000"
                                           value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>"
                                           required>
                                    <span class="input-group-text">₫</span>
                                    <?php if (isset($errors['price'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo htmlspecialchars($errors['price']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-1 text-primary"></i>Mô tả sản phẩm *
                                </label>
                                <textarea class="form-control <?php echo isset($errors['description']) ? 'is-invalid' : ''; ?>" 
                                          id="description" 
                                          name="description" 
                                          rows="5" 
                                          placeholder="Nhập mô tả chi tiết về sản phẩm..."
                                          required><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
                                <?php if (isset($errors['description'])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo htmlspecialchars($errors['description']); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Mô tả chi tiết giúp khách hàng hiểu rõ hơn về sản phẩm
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="col-12">
                                <label for="image" class="form-label fw-bold">
                                    <i class="fas fa-image me-1 text-primary"></i>Hình ảnh sản phẩm
                                </label>
                                <div class="input-group">
                                    <input type="file" 
                                           class="form-control" 
                                           id="image" 
                                           name="image" 
                                           accept="image/*"
                                           onchange="previewImage(this)">
                                    <label class="input-group-text" for="image">
                                        <i class="fas fa-upload me-1"></i>Chọn file
                                    </label>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Định dạng: JPG, JPEG, PNG, GIF. Kích thước tối đa: 10MB
                                </div>
                                
                                <!-- Image Preview -->
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <div class="text-center">
                                        <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 200px;">
                                        <p class="mt-2 text-muted">Xem trước hình ảnh</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between flex-wrap gap-3">
                                    <a href="/Product" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-times me-2"></i>Hủy bỏ
                                    </a>
                                    
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-primary btn-lg" onclick="resetForm()">
                                            <i class="fas fa-undo me-2"></i>Đặt lại
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-save me-2"></i>Lưu sản phẩm
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Image preview function
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }

    // Reset form function
    function resetForm() {
        Swal.fire({
            title: 'Xác nhận đặt lại',
            text: 'Bạn có chắc chắn muốn xóa tất cả dữ liệu đã nhập?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Đặt lại',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('productForm').reset();
                document.getElementById('imagePreview').style.display = 'none';
                toastr.info('Đã đặt lại form');
            }
        });
    }

    // Form validation
    document.getElementById('productForm').addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const price = document.getElementById('price').value;
        const description = document.getElementById('description').value.trim();
        
        if (!name) {
            e.preventDefault();
            toastr.error('Vui lòng nhập tên sản phẩm');
            document.getElementById('name').focus();
            return;
        }
        
        if (!price || price <= 0) {
            e.preventDefault();
            toastr.error('Vui lòng nhập giá hợp lệ');
            document.getElementById('price').focus();
            return;
        }
        
        if (!description) {
            e.preventDefault();
            toastr.error('Vui lòng nhập mô tả sản phẩm');
            document.getElementById('description').focus();
            return;
        }
    });

    // Auto-format price input
    document.getElementById('price').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value) {
            e.target.value = parseInt(value);
        }
    });

    // Character counter for description
    const descriptionTextarea = document.getElementById('description');
    const maxLength = 1000;
    
    descriptionTextarea.addEventListener('input', function() {
        const currentLength = this.value.length;
        const remaining = maxLength - currentLength;
        
        // Add or update character counter
        let counter = document.getElementById('descriptionCounter');
        if (!counter) {
            counter = document.createElement('div');
            counter.id = 'descriptionCounter';
            counter.className = 'form-text text-end mt-1';
            this.parentNode.appendChild(counter);
        }
        
        counter.innerHTML = `<i class="fas fa-keyboard me-1"></i>${currentLength}/${maxLength} ký tự`;
        counter.className = remaining < 100 ? 'form-text text-end mt-1 text-warning' : 'form-text text-end mt-1 text-muted';
        
        if (remaining < 0) {
            counter.className = 'form-text text-end mt-1 text-danger';
        }
    });
</script>

<?php include_once 'app/views/shares/footer.php'; ?>