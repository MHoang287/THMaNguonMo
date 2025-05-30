<?php 
$title = "Thêm sản phẩm mới - TechTafu";
include 'app/views/shares/header.php'; 
?>

<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" data-aos="fade-right">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản phẩm</a></li>
            <li class="breadcrumb-item active">Thêm mới</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1" data-aos="fade-right">
                        <i class="fas fa-plus-circle text-success me-2"></i>
                        Thêm sản phẩm mới
                    </h2>
                    <p class="text-muted mb-0" data-aos="fade-right" data-aos-delay="100">
                        Tạo sản phẩm mới cho cửa hàng điện tử
                    </p>
                </div>
                <div data-aos="fade-left">
                    <a href="/Product" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="/Product/save" enctype="multipart/form-data" id="productForm" class="needs-validation" novalidate>
        <div class="row">
            <!-- Main Form -->
            <div class="col-lg-8">
                <!-- Basic Information -->
                <div class="card shadow-sm border-0 mb-4" data-aos="fade-up">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Thông tin cơ bản
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <!-- Product Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">
                                <i class="fas fa-tag text-primary me-2"></i>
                                Tên sản phẩm <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                <input type="text" class="form-control form-control-lg" id="name" name="name" 
                                       placeholder="Nhập tên sản phẩm..." required maxlength="255"
                                       value="<?php echo isset($errors) ? ($_POST['name'] ?? '') : ''; ?>">
                                <div class="invalid-feedback">
                                    Vui lòng nhập tên sản phẩm
                                </div>
                            </div>
                            <?php if (isset($errors['name'])): ?>
                                <div class="text-danger mt-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    <?php echo $errors['name']; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Product Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">
                                <i class="fas fa-align-left text-info me-2"></i>
                                Mô tả sản phẩm <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                <textarea class="form-control" id="description" name="description" rows="5" 
                                          placeholder="Nhập mô tả chi tiết về sản phẩm..." required><?php echo isset($errors) ? ($_POST['description'] ?? '') : ''; ?></textarea>
                                <div class="invalid-feedback">
                                    Vui lòng nhập mô tả sản phẩm
                                </div>
                            </div>
                            <?php if (isset($errors['description'])): ?>
                                <div class="text-danger mt-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    <?php echo $errors['description']; ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-text">
                                Mô tả chi tiết giúp khách hàng hiểu rõ hơn về sản phẩm
                            </div>
                        </div>

                        <!-- Price and Category Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="price" class="form-label fw-bold">
                                        <i class="fas fa-dollar-sign text-success me-2"></i>
                                        Giá sản phẩm <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₫</span>
                                        <input type="number" class="form-control form-control-lg" id="price" name="price" 
                                               placeholder="0" required min="0" step="1000"
                                               value="<?php echo isset($errors) ? ($_POST['price'] ?? '') : ''; ?>">
                                        <span class="input-group-text">VND</span>
                                        <div class="invalid-feedback">
                                            Vui lòng nhập giá hợp lệ
                                        </div>
                                    </div>
                                    <?php if (isset($errors['price'])): ?>
                                        <div class="text-danger mt-2">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            <?php echo $errors['price']; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-text">
                                        Nhập giá bán của sản phẩm (VND)
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="category_id" class="form-label fw-bold">
                                        <i class="fas fa-tags text-warning me-2"></i>
                                        Danh mục <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                                        <select class="form-select form-select-lg" id="category_id" name="category_id" required>
                                            <option value="">Chọn danh mục...</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?php echo $category->id; ?>"
                                                        <?php echo (isset($errors) && ($_POST['category_id'] ?? '') == $category->id) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($category->name); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Vui lòng chọn danh mục
                                        </div>
                                    </div>
                                    <div class="form-text">
                                        <a href="/category/create" class="text-decoration-none">
                                            <i class="fas fa-plus me-1"></i>Thêm danh mục mới
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Image -->
                <div class="card shadow-sm border-0 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-image me-2"></i>
                            Hình ảnh sản phẩm
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">
                                <i class="fas fa-camera text-primary me-2"></i>
                                Chọn hình ảnh
                            </label>
                            <input type="file" class="form-control form-control-lg" id="image" name="image" 
                                   accept="image/jpeg,image/png,image/gif,image/webp">
                            <div class="form-text">
                                Chấp nhận: JPG, PNG, GIF, WEBP. Tối đa 10MB
                            </div>
                        </div>
                        
                        <!-- Image Preview -->
                        <div id="imagePreview" class="text-center" style="display: none;">
                            <div class="border rounded p-3 bg-light">
                                <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 300px;">
                                <div class="mt-2">
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeImage()">
                                        <i class="fas fa-trash me-1"></i>Xóa hình
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Upload Area -->
                        <div id="uploadArea" class="border-2 border-dashed border-primary rounded p-4 text-center bg-light">
                            <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                            <h5 class="text-primary">Kéo thả hình ảnh vào đây</h5>
                            <p class="text-muted mb-0">hoặc click để chọn file</p>
                        </div>
                    </div>
                </div>

                <!-- Product Preview -->
                <div class="card shadow-sm border-0" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-eye me-2"></i>
                            Xem trước sản phẩm
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div id="previewImage" class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 250px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h4 id="previewName" class="text-muted">Tên sản phẩm sẽ hiển thị ở đây</h4>
                                <p id="previewDescription" class="text-muted">Mô tả sản phẩm sẽ hiển thị ở đây...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 id="previewPrice" class="text-primary mb-0">0₫</h3>
                                    <span id="previewCategory" class="badge bg-secondary">Chưa chọn danh mục</span>
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-primary disabled">
                                        <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Actions -->
                <div class="card shadow-sm border-0 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-bolt me-2"></i>
                            Thao tác nhanh
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save me-2"></i>Lưu sản phẩm
                            </button>
                            <button type="reset" class="btn btn-outline-warning">
                                <i class="fas fa-undo me-2"></i>Làm mới form
                            </button>
                            <a href="/Product" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Hủy bỏ
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="card shadow-sm border-0 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-header bg-info text-white">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-lightbulb me-2"></i>
                            Gợi ý
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="text-primary">
                                <i class="fas fa-check-circle me-2"></i>
                                Tên sản phẩm tốt:
                            </h6>
                            <ul class="list-unstyled ms-3 small">
                                <li><i class="fas fa-mobile-alt me-2 text-success"></i>iPhone 15 Pro Max 256GB</li>
                                <li><i class="fas fa-laptop me-2 text-success"></i>MacBook Air M2 13inch</li>
                                <li><i class="fas fa-headphones me-2 text-success"></i>AirPods Pro Gen 2</li>
                            </ul>
                        </div>
                        
                        <div class="alert alert-light">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <small>Tên rõ ràng, mô tả chi tiết giúp tăng doanh số</small>
                        </div>
                    </div>
                </div>

                <!-- Categories Stats -->
                <div class="card shadow-sm border-0" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-header bg-secondary text-white">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-chart-pie me-2"></i>
                            Thống kê danh mục
                        </h6>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($categories)): ?>
                            <?php foreach (array_slice($categories, 0, 5) as $category): ?>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted"><?php echo htmlspecialchars($category->name); ?></span>
                                    <span class="badge bg-primary">
                                        <?php
                                        // Count products in category (assuming you have access to product count)
                                        echo rand(1, 20); // Placeholder
                                        ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted text-center">
                                <i class="fas fa-info-circle me-2"></i>
                                Chưa có danh mục nào
                            </p>
                            <div class="text-center">
                                <a href="/category/create" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-2"></i>Tạo danh mục
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
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

    // Real-time preview updates
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value.trim();
        document.getElementById('previewName').textContent = name || 'Tên sản phẩm sẽ hiển thị ở đây';
        document.getElementById('previewName').className = name ? 'text-dark' : 'text-muted';
    });

    document.getElementById('description').addEventListener('input', function() {
        const desc = this.value.trim();
        document.getElementById('previewDescription').textContent = desc || 'Mô tả sản phẩm sẽ hiển thị ở đây...';
        document.getElementById('previewDescription').className = desc ? 'text-dark' : 'text-muted';
    });

    document.getElementById('price').addEventListener('input', function() {
        const price = parseFloat(this.value) || 0;
        document.getElementById('previewPrice').textContent = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(price);
    });

    document.getElementById('category_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const categoryName = selectedOption.text;
        const previewCategory = document.getElementById('previewCategory');
        
        if (this.value) {
            previewCategory.textContent = categoryName;
            previewCategory.className = 'badge bg-primary';
        } else {
            previewCategory.textContent = 'Chưa chọn danh mục';
            previewCategory.className = 'badge bg-secondary';
        }
    });

    // Image upload handling
    const imageInput = document.getElementById('image');
    const uploadArea = document.getElementById('uploadArea');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const previewImage = document.getElementById('previewImage');

    // Click to select file
    uploadArea.addEventListener('click', function() {
        imageInput.click();
    });

    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('border-success');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('border-success');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('border-success');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            handleImageSelect(files[0]);
        }
    });

    // File input change
    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            handleImageSelect(this.files[0]);
        }
    });

    function handleImageSelect(file) {
        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!allowedTypes.includes(file.type)) {
            toastr.error('Chỉ chấp nhận file hình ảnh (JPG, PNG, GIF, WEBP)');
            return;
        }

        // Validate file size (10MB)
        if (file.size > 10 * 1024 * 1024) {
            toastr.error('File hình ảnh không được vượt quá 10MB');
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            imagePreview.style.display = 'block';
            uploadArea.style.display = 'none';
            
            // Update preview card
            previewImage.innerHTML = `<img src="${e.target.result}" alt="Preview" class="img-fluid rounded" style="height: 250px; object-fit: cover;">`;
        };
        reader.readAsDataURL(file);
    }

    function removeImage() {
        imageInput.value = '';
        imagePreview.style.display = 'none';
        uploadArea.style.display = 'block';
        previewImage.innerHTML = '<i class="fas fa-image fa-3x text-muted"></i>';
    }

    // Price formatting
    document.getElementById('price').addEventListener('blur', function() {
        const value = parseFloat(this.value);
        if (!isNaN(value)) {
            this.value = Math.round(value);
        }
    });

    // Auto-focus first input
    document.getElementById('name').focus();

    // Form reset handler
    document.querySelector('button[type="reset"]').addEventListener('click', function() {
        setTimeout(function() {
            // Reset preview
            document.getElementById('previewName').textContent = 'Tên sản phẩm sẽ hiển thị ở đây';
            document.getElementById('previewName').className = 'text-muted';
            document.getElementById('previewDescription').textContent = 'Mô tả sản phẩm sẽ hiển thị ở đây...';
            document.getElementById('previewDescription').className = 'text-muted';
            document.getElementById('previewPrice').textContent = '0₫';
            document.getElementById('previewCategory').textContent = 'Chưa chọn danh mục';
            document.getElementById('previewCategory').className = 'badge bg-secondary';
            
            // Reset image
            removeImage();
        }, 100);
    });
</script>

<?php include 'app/views/shares/footer.php'; ?>