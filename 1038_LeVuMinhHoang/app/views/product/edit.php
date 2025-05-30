<?php 
$title = "Chỉnh sửa sản phẩm: " . htmlspecialchars($product->name) . " - TechTafu";
include 'app/views/shares/header.php'; 
?>

<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" data-aos="fade-right">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản phẩm</a></li>
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
                        Chỉnh sửa sản phẩm
                    </h2>
                    <p class="text-muted mb-0" data-aos="fade-right" data-aos-delay="100">
                        Cập nhật thông tin: <strong><?php echo htmlspecialchars($product->name); ?></strong>
                    </p>
                </div>
                <div data-aos="fade-left">
                    <a href="/Product" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                    <a href="/Product/show/<?php echo $product->id; ?>" class="btn btn-outline-info">
                        <i class="fas fa-eye me-2"></i>Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="/Product/update" enctype="multipart/form-data" id="productForm" class="needs-validation" novalidate>
        <input type="hidden" name="id" value="<?php echo $product->id; ?>">
        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($product->image ?? ''); ?>">
        
        <div class="row">
            <!-- Main Form -->
            <div class="col-lg-8">
                <!-- Basic Information -->
                <div class="card shadow-sm border-0 mb-4" data-aos="fade-up">
                    <div class="card-header bg-warning text-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                Thông tin cơ bản
                            </h5>
                            <span class="badge bg-dark">ID: <?php echo $product->id; ?></span>
                        </div>
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
                                       value="<?php echo htmlspecialchars($product->name); ?>">
                                <div class="invalid-feedback">
                                    Vui lòng nhập tên sản phẩm
                                </div>
                            </div>
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
                                          placeholder="Nhập mô tả chi tiết về sản phẩm..." required><?php echo htmlspecialchars($product->description); ?></textarea>
                                <div class="invalid-feedback">
                                    Vui lòng nhập mô tả sản phẩm
                                </div>
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
                                               value="<?php echo $product->price; ?>">
                                        <span class="input-group-text">VND</span>
                                        <div class="invalid-feedback">
                                            Vui lòng nhập giá hợp lệ
                                        </div>
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
                                                        <?php echo ($product->category_id == $category->id) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($category->name); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Vui lòng chọn danh mục
                                        </div>
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
                        <!-- Current Image -->
                        <?php if (!empty($product->image)): ?>
                            <div class="mb-4">
                                <div id="currentImage" class="text-center mb-3">
                                    <div class="border rounded p-3 bg-light">
                                        <img src="/<?php echo htmlspecialchars($product->image); ?>" 
                                             alt="<?php echo htmlspecialchars($product->name); ?>" 
                                             class="img-fluid rounded" style="max-height: 300px;"
                                             onerror="this.src='/public/image/no-image.jpg'">
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeCurrentImage()">
                                                <i class="fas fa-trash me-1"></i>Xóa hình hiện tại
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">
                                <i class="fas fa-camera text-primary me-2"></i>
                                Chọn hình ảnh mới
                            </label>
                            <input type="file" class="form-control form-control-lg" id="image" name="image" 
                                   accept="image/jpeg,image/png,image/gif,image/webp">
                            <div class="form-text">
                                Chấp nhận: JPG, PNG, GIF, WEBP. Tối đa 10MB. Để trống nếu không muốn thay đổi
                            </div>
                        </div>
                        
                        <!-- New Image Preview -->
                        <div id="imagePreview" class="text-center" style="display: none;">
                            <div class="border rounded p-3 bg-light">
                                <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 300px;">
                                <div class="mt-2">
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeNewImage()">
                                        <i class="fas fa-trash me-1"></i>Xóa hình mới
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Upload Area -->
                        <div id="uploadArea" class="border-2 border-dashed border-primary rounded p-4 text-center bg-light">
                            <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                            <h5 class="text-primary">Kéo thả hình ảnh mới vào đây</h5>
                            <p class="text-muted mb-0">hoặc click để chọn file</p>
                        </div>
                    </div>
                </div>

                <!-- Before/After Comparison -->
                <div class="card shadow-sm border-0 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-balance-scale me-2"></i>
                            So sánh thay đổi
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-secondary">
                                    <div class="card-header bg-secondary text-white">
                                        <h6 class="mb-0">
                                            <i class="fas fa-clock me-2"></i>Trước khi sửa
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <?php if (!empty($product->image)): ?>
                                                    <img src="/<?php echo htmlspecialchars($product->image); ?>" 
                                                         alt="Original" class="img-fluid rounded">
                                                <?php else: ?>
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-8">
                                                <h6 class="text-primary"><?php echo htmlspecialchars($product->name); ?></h6>
                                                <p class="text-muted small mb-1"><?php echo mb_substr($product->description, 0, 50) . '...'; ?></p>
                                                <strong class="text-success"><?php echo number_format($product->price, 0, ',', '.'); ?>đ</strong>
                                            </div>
                                        </div>
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
                                        <div class="row">
                                            <div class="col-4">
                                                <div id="previewImage" class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                                    <?php if (!empty($product->image)): ?>
                                                        <img src="/<?php echo htmlspecialchars($product->image); ?>" 
                                                             alt="Preview" class="img-fluid rounded">
                                                    <?php else: ?>
                                                        <i class="fas fa-image text-muted"></i>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <h6 class="text-primary" id="previewName"><?php echo htmlspecialchars($product->name); ?></h6>
                                                <p class="text-muted small mb-1" id="previewDescription"><?php echo mb_substr($product->description, 0, 50) . '...'; ?></p>
                                                <strong class="text-success" id="previewPrice"><?php echo number_format($product->price, 0, ',', '.'); ?>đ</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Product Info -->
                <div class="card shadow-sm border-0 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-header bg-info text-white">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Thông tin sản phẩm
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong class="text-muted">ID:</strong>
                            <span class="badge bg-primary ms-2">#<?php echo $product->id; ?></span>
                        </div>
                        <div class="mb-3">
                            <strong class="text-muted">Danh mục hiện tại:</strong>
                            <div class="mt-1">
                                <span class="badge bg-secondary">
                                    <?php 
                                    $currentCategory = array_filter($categories, function($cat) use ($product) {
                                        return $cat->id == $product->category_id;
                                    });
                                    echo $currentCategory ? htmlspecialchars(reset($currentCategory)->name) : 'Chưa phân loại';
                                    ?>
                                </span>
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
                <div class="card shadow-sm border-0 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-bolt me-2"></i>
                            Thao tác nhanh
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning btn-lg">
                                <i class="fas fa-save me-2"></i>Cập nhật sản phẩm
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-2"></i>Khôi phục
                            </button>
                            <a href="/Product/show/<?php echo $product->id; ?>" class="btn btn-outline-info">
                                <i class="fas fa-eye me-2"></i>Xem chi tiết
                            </a>
                            <a href="/Product" class="btn btn-outline-primary">
                                <i class="fas fa-list me-2"></i>Danh sách sản phẩm
                            </a>
                            <button type="button" class="btn btn-outline-danger" onclick="deleteProduct(<?php echo $product->id; ?>)">
                                <i class="fas fa-trash me-2"></i>Xóa sản phẩm
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Edit History -->
                <div class="card shadow-sm border-0" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-header bg-secondary text-white">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-history me-2"></i>
                            Lịch sử chỉnh sửa
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <small>Hãy cẩn thận khi chỉnh sửa để không ảnh hưởng đến đơn hàng</small>
                        </div>
                        <ul class="list-unstyled small">
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Kiểm tra thông tin trước khi lưu
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Đảm bảo giá cả hợp lý
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Chọn danh mục phù hợp
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Store original values for comparison
    const originalValues = {
        name: <?php echo json_encode($product->name); ?>,
        description: <?php echo json_encode($product->description); ?>,
        price: <?php echo $product->price; ?>,
        category_id: <?php echo $product->category_id; ?>
    };

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
        const previewName = document.getElementById('previewName');
        previewName.textContent = name || originalValues.name;
        highlightChanges();
    });

    document.getElementById('description').addEventListener('input', function() {
        const desc = this.value.trim();
        const previewDesc = document.getElementById('previewDescription');
        previewDesc.textContent = (desc || originalValues.description).substring(0, 50) + '...';
        highlightChanges();
    });

    document.getElementById('price').addEventListener('input', function() {
        const price = parseFloat(this.value) || 0;
        document.getElementById('previewPrice').textContent = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(price);
        highlightChanges();
    });

    document.getElementById('category_id').addEventListener('change', function() {
        highlightChanges();
    });

    // Highlight changes
    function highlightChanges() {
        const inputs = ['name', 'description', 'price', 'category_id'];
        inputs.forEach(function(inputName) {
            const input = document.getElementById(inputName);
            const currentValue = inputName === 'price' ? parseFloat(input.value) : input.value;
            const originalValue = originalValues[inputName];
            
            if (currentValue != originalValue) {
                input.style.borderColor = '#ffc107';
                input.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';
            } else {
                input.style.borderColor = '';
                input.style.boxShadow = '';
            }
        });
    }

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
            previewImage.innerHTML = `<img src="${e.target.result}" alt="Preview" class="img-fluid rounded" style="height: 80px; object-fit: cover;">`;
        };
        reader.readAsDataURL(file);
    }

    function removeNewImage() {
        imageInput.value = '';
        imagePreview.style.display = 'none';
        uploadArea.style.display = 'block';
        
        // Reset preview to original image
        <?php if (!empty($product->image)): ?>
            previewImage.innerHTML = '<img src="/<?php echo htmlspecialchars($product->image); ?>" alt="Original" class="img-fluid rounded" style="height: 80px; object-fit: cover;">';
        <?php else: ?>
            previewImage.innerHTML = '<i class="fas fa-image text-muted"></i>';
        <?php endif; ?>
    }

    function removeCurrentImage() {
        const currentImage = document.getElementById('currentImage');
        if (currentImage) {
            currentImage.style.display = 'none';
            // Set a flag to indicate current image should be removed
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'remove_current_image';
            hiddenInput.value = '1';
            document.getElementById('productForm').appendChild(hiddenInput);
            
            toastr.info('Hình ảnh hiện tại sẽ được xóa khi lưu');
        }
    }

    // Delete product function
    function deleteProduct(id) {
        confirmDelete('Bạn có chắc chắn muốn xóa sản phẩm này? Hành động này không thể hoàn tác!').then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/Product/delete/' + id;
            }
        });
    }

    // Form reset handler
    document.querySelector('button[type="reset"]').addEventListener('click', function() {
        setTimeout(function() {
            // Reset to original values
            document.getElementById('name').value = originalValues.name;
            document.getElementById('description').value = originalValues.description;
            document.getElementById('price').value = originalValues.price;
            document.getElementById('category_id').value = originalValues.category_id;
            
            // Reset preview
            document.getElementById('previewName').textContent = originalValues.name;
            document.getElementById('previewDescription').textContent = originalValues.description.substring(0, 50) + '...';
            document.getElementById('previewPrice').textContent = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(originalValues.price);
            
            // Reset image
            removeNewImage();
            
            // Remove highlighting
            ['name', 'description', 'price', 'category_id'].forEach(function(inputName) {
                const input = document.getElementById(inputName);
                input.style.borderColor = '';
                input.style.boxShadow = '';
            });
        }, 100);
    });

    // Auto-focus first input
    document.getElementById('name').focus();
    document.getElementById('name').select();
</script>

<?php include 'app/views/shares/footer.php'; ?>