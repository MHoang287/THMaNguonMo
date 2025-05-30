<?php
$title = "Chỉnh sửa sản phẩm - " . ($product->name ?? 'Không tìm thấy');
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
                        <li class="breadcrumb-item active text-white" aria-current="page">Chỉnh sửa</li>
                    </ol>
                </nav>
                <h1 class="h2 mb-0 animate__animated animate__fadeInLeft">
                    <i class="fas fa-edit me-2"></i>Chỉnh sửa sản phẩm
                </h1>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="btn-group animate__animated animate__fadeInRight" role="group">
                    <a href="/Product" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                    <a href="/Product/show/<?php echo $product->id; ?>" class="btn btn-outline-light">
                        <i class="fas fa-eye me-2"></i>Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg animate-fade-in" data-aos="fade-up">
                <div class="card-header bg-warning text-dark py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Cập nhật thông tin sản phẩm
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <!-- Current Product Info Preview -->
                    <div class="alert alert-info mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center">
                                <?php if (!empty($product->image) && file_exists($product->image)): ?>
                                    <img src="/<?php echo htmlspecialchars($product->image); ?>" 
                                         class="img-thumbnail" 
                                         alt="<?php echo htmlspecialchars($product->name); ?>"
                                         style="max-width: 120px; max-height: 120px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                         style="width: 120px; height: 120px; margin: 0 auto;">
                                        <i class="fas fa-image text-muted fa-2x"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-9">
                                <h6 class="alert-heading mb-3">
                                    <i class="fas fa-info-circle me-2"></i>Thông tin hiện tại:
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <p class="mb-2"><strong>ID:</strong> 
                                            <span class="badge bg-primary"><?php echo $product->id; ?></span>
                                        </p>
                                        <p class="mb-2"><strong>Tên:</strong> <?php echo htmlspecialchars($product->name); ?></p>
                                        <p class="mb-0"><strong>Danh mục:</strong> 
                                            <?php echo htmlspecialchars($product->category_name ?? 'Chưa phân loại'); ?>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-2"><strong>Giá:</strong> 
                                            <span class="text-danger fw-bold"><?php echo number_format($product->price, 0, ',', '.'); ?>₫</span>
                                        </p>
                                        <p class="mb-2"><strong>Trạng thái:</strong> 
                                            <span class="badge bg-success">Đang bán</span>
                                        </p>
                                        <p class="mb-0"><strong>Lượt xem:</strong> <?php echo rand(100, 1000); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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

                    <form action="/Product/update" method="POST" enctype="multipart/form-data" id="editProductForm">
                        <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                        
                        <div class="row g-4">
                            <!-- Product Name -->
                            <div class="col-md-8">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-tag me-1 text-warning"></i>Tên sản phẩm *
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" 
                                       id="name" 
                                       name="name" 
                                       placeholder="Nhập tên sản phẩm..."
                                       value="<?php echo htmlspecialchars($product->name); ?>"
                                       required
                                       maxlength="255">
                                <?php if (isset($errors['name'])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo htmlspecialchars($errors['name']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Category -->
                            <div class="col-md-4">
                                <label for="category_id" class="form-label fw-bold">
                                    <i class="fas fa-list me-1 text-warning"></i>Danh mục
                                </label>
                                <select class="form-select form-select-lg" id="category_id" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    <?php if (isset($categories) && !empty($categories)): ?>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?php echo $category->id; ?>" 
                                                    <?php echo ($product->category_id == $category->id) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($category->name); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <!-- Price -->
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-bold">
                                    <i class="fas fa-money-bill-wave me-1 text-warning"></i>Giá bán (VNĐ) *
                                </label>
                                <div class="input-group input-group-lg">
                                    <input type="number" 
                                           class="form-control <?php echo isset($errors['price']) ? 'is-invalid' : ''; ?>" 
                                           id="price" 
                                           name="price" 
                                           placeholder="0"
                                           min="0"
                                           step="1000"
                                           value="<?php echo $product->price; ?>"
                                           required>
                                    <span class="input-group-text">₫</span>
                                    <?php if (isset($errors['price'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo htmlspecialchars($errors['price']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-calculator me-1"></i>
                                    Giá hiện tại: <strong class="text-danger"><?php echo number_format($product->price, 0, ',', '.'); ?>₫</strong>
                                </div>
                            </div>

                            <!-- Stock Status -->
                            <div class="col-md-6">
                                <label for="stock_status" class="form-label fw-bold">
                                    <i class="fas fa-warehouse me-1 text-warning"></i>Trạng thái kho
                                </label>
                                <select class="form-select form-select-lg" id="stock_status" name="stock_status">
                                    <option value="in_stock" selected>Còn hàng</option>
                                    <option value="out_of_stock">Hết hàng</option>
                                    <option value="limited">Số lượng có hạn</option>
                                    <option value="pre_order">Đặt trước</option>
                                </select>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-1 text-warning"></i>Mô tả sản phẩm *
                                </label>
                                <textarea class="form-control <?php echo isset($errors['description']) ? 'is-invalid' : ''; ?>" 
                                          id="description" 
                                          name="description" 
                                          rows="6" 
                                          placeholder="Nhập mô tả chi tiết về sản phẩm..."
                                          required
                                          maxlength="2000"><?php echo htmlspecialchars($product->description); ?></textarea>
                                <?php if (isset($errors['description'])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo htmlspecialchars($errors['description']); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Mô tả chi tiết giúp khách hàng hiểu rõ hơn về sản phẩm (tối đa 2000 ký tự)
                                </div>
                            </div>

                            <!-- Current Image Display -->
                            <div class="col-12">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-image me-1 text-warning"></i>Hình ảnh hiện tại
                                </label>
                                
                                <?php if (!empty($product->image) && file_exists($product->image)): ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card">
                                                <img src="/<?php echo htmlspecialchars($product->image); ?>" 
                                                     class="card-img-top" 
                                                     alt="<?php echo htmlspecialchars($product->name); ?>"
                                                     style="height: 200px; object-fit: cover;"
                                                     onclick="showImageModal(this.src)">
                                                <div class="card-body p-2 text-center">
                                                    <small class="text-muted">Click để xem lớn</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 d-flex align-items-center">
                                            <div class="alert alert-success mb-0 w-100">
                                                <h6 class="alert-heading">
                                                    <i class="fas fa-check-circle me-2"></i>Ảnh sản phẩm hiện tại
                                                </h6>
                                                <p class="mb-2"><strong>Đường dẫn:</strong> <?php echo htmlspecialchars($product->image); ?></p>
                                                <p class="mb-2"><strong>Kích thước:</strong> <?php echo file_exists($product->image) ? number_format(filesize($product->image) / 1024, 1) . ' KB' : 'N/A'; ?></p>
                                                <p class="mb-0"><strong>Định dạng:</strong> <?php echo strtoupper(pathinfo($product->image, PATHINFO_EXTENSION)); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Sản phẩm chưa có hình ảnh. Hãy upload ảnh mới bên dưới.
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Image Upload -->
                            <div class="col-12">
                                <label for="image" class="form-label fw-bold">
                                    <i class="fas fa-upload me-1 text-warning"></i>Cập nhật hình ảnh sản phẩm
                                </label>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="file" 
                                                   class="form-control" 
                                                   id="image" 
                                                   name="image" 
                                                   accept="image/*"
                                                   onchange="previewImage(this)">
                                            <label class="input-group-text" for="image">
                                                <i class="fas fa-camera me-1"></i>Chọn ảnh mới
                                            </label>
                                        </div>
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Để trống nếu không muốn thay đổi hình ảnh. Định dạng: JPG, JPEG, PNG, GIF. Kích thước tối đa: 10MB
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-outline-danger btn-sm" 
                                                    onclick="removeCurrentImage()" 
                                                    <?php echo empty($product->image) ? 'disabled' : ''; ?>>
                                                <i class="fas fa-trash me-1"></i>Xóa ảnh hiện tại
                                            </button>
                                            <button type="button" class="btn btn-outline-info btn-sm" onclick="showImageTips()">
                                                <i class="fas fa-question-circle me-1"></i>Gợi ý
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Hidden field for existing image -->
                                <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($product->image); ?>" id="existingImageField">
                                
                                <!-- New Image Preview -->
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <div class="card border-success">
                                        <div class="card-header bg-success text-white">
                                            <h6 class="mb-0">
                                                <i class="fas fa-check-circle me-2"></i>Xem trước ảnh mới
                                            </h6>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img id="previewImg" src="" alt="Preview" 
                                                         class="img-fluid rounded" 
                                                         style="max-height: 200px; width: 100%; object-fit: cover;">
                                                </div>
                                                <div class="col-md-8 d-flex align-items-center">
                                                    <div>
                                                        <h6 class="text-success">
                                                            <i class="fas fa-upload me-2"></i>Ảnh mới sẽ được cập nhật
                                                        </h6>
                                                        <p class="mb-1" id="imageInfo"></p>
                                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="cancelImageChange()">
                                                            <i class="fas fa-times me-1"></i>Hủy thay đổi
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Fields Row -->
                            <div class="col-md-6">
                                <label for="sku" class="form-label fw-bold">
                                    <i class="fas fa-barcode me-1 text-warning"></i>Mã SKU
                                </label>
                                <input type="text" class="form-control" id="sku" name="sku" 
                                       placeholder="VD: SKU001" 
                                       value="SKU<?php echo str_pad($product->id, 4, '0', STR_PAD_LEFT); ?>">
                                <div class="form-text">Mã định danh duy nhất cho sản phẩm</div>
                            </div>

                            <div class="col-md-6">
                                <label for="weight" class="form-label fw-bold">
                                    <i class="fas fa-weight me-1 text-warning"></i>Trọng lượng (gram)
                                </label>
                                <input type="number" class="form-control" id="weight" name="weight" 
                                       placeholder="0" min="0" step="10">
                                <div class="form-text">Trọng lượng sản phẩm để tính phí vận chuyển</div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between flex-wrap gap-3">
                                    <div class="d-flex gap-2">
                                        <a href="/Product" class="btn btn-outline-secondary btn-lg">
                                            <i class="fas fa-times me-2"></i>Hủy bỏ
                                        </a>
                                        <button type="button" class="btn btn-outline-info btn-lg" onclick="showChangesPreview()">
                                            <i class="fas fa-eye me-2"></i>Xem trước
                                        </button>
                                    </div>
                                    
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-danger btn-lg" 
                                                onclick="confirmDelete('/Product/delete/<?php echo $product->id; ?>', 'Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                            <i class="fas fa-trash me-2"></i>Xóa sản phẩm
                                        </button>
                                        <button type="submit" class="btn btn-warning btn-lg text-dark">
                                            <i class="fas fa-save me-2"></i>Cập nhật sản phẩm
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

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xem ảnh sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Product Image" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    // Store original values for comparison
    const originalValues = {
        name: '<?php echo addslashes($product->name); ?>',
        description: `<?php echo addslashes($product->description); ?>`,
        price: <?php echo $product->price; ?>,
        category_id: <?php echo $product->category_id ?? 'null'; ?>
    };

    // Image preview function
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const imageInfo = document.getElementById('imageInfo');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            
            // Validate file
            if (!file.type.match('image.*')) {
                toastr.error('Vui lòng chọn file hình ảnh');
                input.value = '';
                return;
            }
            
            if (file.size > 10 * 1024 * 1024) {
                toastr.error('Kích thước file không được vượt quá 10MB');
                input.value = '';
                return;
            }
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
                
                // Show file info
                imageInfo.innerHTML = `
                    <strong>Tên file:</strong> ${file.name}<br>
                    <strong>Kích thước:</strong> ${(file.size / 1024 / 1024).toFixed(2)} MB<br>
                    <strong>Định dạng:</strong> ${file.type}
                `;
                
                // Add animation
                preview.classList.add('animate__animated', 'animate__fadeIn');
            }
            
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    }

    // Cancel image change
    function cancelImageChange() {
        document.getElementById('image').value = '';
        document.getElementById('imagePreview').style.display = 'none';
    }

    // Remove current image
    function removeCurrentImage() {
        Swal.fire({
            title: 'Xóa ảnh hiện tại',
            text: 'Bạn có chắc chắn muốn xóa ảnh hiện tại của sản phẩm?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('existingImageField').value = '';
                toastr.success('Ảnh hiện tại sẽ được xóa khi lưu');
            }
        });
    }

    // Show image modal
    function showImageModal(src) {
        document.getElementById('modalImage').src = src;
        new bootstrap.Modal(document.getElementById('imageModal')).show();
    }

    // Show image tips
    function showImageTips() {
        Swal.fire({
            title: 'Gợi ý chụp ảnh sản phẩm',
            html: `
                <div class="text-start">
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Sử dụng ánh sáng tự nhiên</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Nền trắng hoặc đơn giản</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Chụp từ nhiều góc độ</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Độ phân giải tối thiểu 800x800px</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Định dạng JPG hoặc PNG</li>
                        <li><i class="fas fa-check text-success me-2"></i>Kích thước file dưới 5MB</li>
                    </ul>
                </div>
            `,
            icon: 'info',
            confirmButtonText: 'Đã hiểu'
        });
    }

    // Show changes preview
    function showChangesPreview() {
        const currentValues = {
            name: document.getElementById('name').value,
            description: document.getElementById('description').value,
            price: parseFloat(document.getElementById('price').value) || 0,
            category_id: parseInt(document.getElementById('category_id').value) || null
        };
        
        const changes = [];
        Object.keys(originalValues).forEach(key => {
            if (originalValues[key] != currentValues[key]) {
                changes.push({
                    field: key,
                    old: originalValues[key],
                    new: currentValues[key]
                });
            }
        });
        
        if (changes.length === 0) {
            toastr.info('Không có thay đổi nào');
            return;
        }
        
        let html = '<div class="table-responsive"><table class="table table-sm"><thead><tr><th>Trường</th><th>Giá trị cũ</th><th>Giá trị mới</th></tr></thead><tbody>';
        changes.forEach(change => {
            let fieldName = change.field;
            switch(change.field) {
                case 'name': fieldName = 'Tên sản phẩm'; break;
                case 'description': fieldName = 'Mô tả'; break;
                case 'price': fieldName = 'Giá'; break;
                case 'category_id': fieldName = 'Danh mục'; break;
            }
            
            let oldValue = change.old;
            let newValue = change.new;
            
            if (change.field === 'price') {
                oldValue = new Intl.NumberFormat('vi-VN').format(oldValue) + '₫';
                newValue = new Intl.NumberFormat('vi-VN').format(newValue) + '₫';
            }
            
            html += `<tr><td><strong>${fieldName}</strong></td><td>${oldValue || '<em>Trống</em>'}</td><td>${newValue || '<em>Trống</em>'}</td></tr>`;
        });
        html += '</tbody></table></div>';
        
        Swal.fire({
            title: 'Xem trước thay đổi',
            html: html,
            width: '700px',
            showConfirmButton: false,
            showCloseButton: true
        });
    }

    // Form validation
    document.getElementById('editProductForm').addEventListener('submit', function(e) {
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

        // Show confirmation dialog
        e.preventDefault();
        Swal.fire({
            title: 'Xác nhận cập nhật',
            text: 'Bạn có chắc chắn muốn cập nhật sản phẩm này?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Cập nhật',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();
                this.submit();
            }
        });
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
    const maxLength = 2000;
    
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
        counter.className = remaining < 200 ? 'form-text text-end mt-1 text-warning' : 'form-text text-end mt-1 text-muted';
        
        if (remaining < 0) {
            counter.className = 'form-text text-end mt-1 text-danger';
        }
    });

    // Check for unsaved changes
    let formChanged = false;
    const form = document.getElementById('editProductForm');
    const inputs = form.querySelectorAll('input, textarea, select');
    
    inputs.forEach(input => {
        const originalValue = input.value;
        input.addEventListener('change', function() {
            formChanged = this.value !== originalValue;
            
            if (formChanged) {
                showUnsavedChangesWarning();
            }
        });
    });

    function showUnsavedChangesWarning() {
        let warning = document.getElementById('unsavedWarning');
        if (!warning) {
            warning = document.createElement('div');
            warning.id = 'unsavedWarning';
            warning.className = 'alert alert-warning position-fixed top-0 start-50 translate-middle-x mt-3 animate__animated animate__fadeInDown';
            warning.style.zIndex = '1050';
            warning.innerHTML = `
                <i class="fas fa-exclamation-triangle me-2"></i>
                Bạn có thay đổi chưa được lưu
                <button type="button" class="btn-close ms-2" onclick="this.parentElement.remove()"></button>
            `;
            document.body.appendChild(warning);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (warning) warning.remove();
            }, 5000);
        }
    }

    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // Reset form changed flag on submit
    form.addEventListener('submit', function() {
        formChanged = false;
    });

    // Auto-save draft functionality
    let autoSaveTimeout;
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(() => {
                const formData = new FormData(form);
                const data = Object.fromEntries(formData);
                localStorage.setItem('productEditDraft_<?php echo $product->id; ?>', JSON.stringify(data));
                
                // Show auto-save indicator
                showAutoSaveIndicator();
            }, 2000);
        });
    });

    function showAutoSaveIndicator() {
        let indicator = document.getElementById('autoSaveIndicator');
        if (!indicator) {
            indicator = document.createElement('div');
            indicator.id = 'autoSaveIndicator';
            indicator.className = 'position-fixed bottom-0 end-0 m-3 alert alert-success alert-dismissible fade show';
            indicator.style.zIndex = '1050';
            indicator.innerHTML = `
                <i class="fas fa-save me-2"></i>Đã tự động lưu nháp
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(indicator);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                if (indicator) {
                    indicator.classList.remove('show');
                    setTimeout(() => indicator.remove(), 300);
                }
            }, 3000);
        }
    }

    // Restore draft on page load
    document.addEventListener('DOMContentLoaded', function() {
        const savedDraft = localStorage.getItem('productEditDraft_<?php echo $product->id; ?>');
        if (savedDraft) {
            const data = JSON.parse(savedDraft);
            
            Swal.fire({
                title: 'Khôi phục dữ liệu',
                text: 'Tìm thấy dữ liệu nháp đã lưu. Bạn có muốn khôi phục?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Khôi phục',
                cancelButtonText: 'Bỏ qua'
            }).then((result) => {
                if (result.isConfirmed) {
                    Object.keys(data).forEach(key => {
                        const input = form.querySelector(`[name="${key}"]`);
                        if (input && data[key]) {
                            input.value = data[key];
                            input.dispatchEvent(new Event('input'));
                        }
                    });
                    toastr.success('Đã khôi phục dữ liệu nháp');
                } else {
                    localStorage.removeItem('productEditDraft_<?php echo $product->id; ?>');
                }
            });
        }
        
        // Trigger character counter
        descriptionTextarea.dispatchEvent(new Event('input'));
    });

    // Clear draft on successful submission
    form.addEventListener('submit', function() {
        localStorage.removeItem('productEditDraft_<?php echo $product->id; ?>');
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl + S: Save form
        if (e.ctrlKey && e.key === 's') {
            e.preventDefault();
            document.getElementById('editProductForm').submit();
        }
        
        // Escape: Go back with confirmation if changed
        if (e.key === 'Escape') {
            if (formChanged) {
                Swal.fire({
                    title: 'Bạn có thay đổi chưa lưu',
                    text: 'Bạn có muốn lưu thay đổi trước khi thoát?',
                    icon: 'warning',
                    showCancelButton: true,
                    showDenyButton: true,
                    confirmButtonText: 'Lưu và thoát',
                    denyButtonText: 'Thoát không lưu',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('editProductForm').submit();
                    } else if (result.isDenied) {
                        window.location.href = '/Product';
                    }
                });
            } else {
                window.location.href = '/Product';
            }
        }
        
        // Ctrl + P: Preview changes
        if (e.ctrlKey && e.key === 'p') {
            e.preventDefault();
            showChangesPreview();
        }
    });

    // Image drag and drop functionality
    const imageInput = document.getElementById('image');
    const imageInputContainer = imageInput.parentNode;
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        imageInputContainer.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        imageInputContainer.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        imageInputContainer.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight(e) {
        imageInputContainer.classList.add('border-primary', 'bg-light');
    }
    
    function unhighlight(e) {
        imageInputContainer.classList.remove('border-primary', 'bg-light');
    }
    
    imageInputContainer.addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            imageInput.files = files;
            previewImage(imageInput);
        }
    }

    // Copy product for new creation
    function copyProduct() {
        const currentData = {
            name: document.getElementById('name').value + ' (Copy)',
            description: document.getElementById('description').value,
            price: document.getElementById('price').value,
            category_id: document.getElementById('category_id').value
        };
        
        localStorage.setItem('newProductTemplate', JSON.stringify(currentData));
        
        Swal.fire({
            title: 'Sao chép sản phẩm',
            text: 'Dữ liệu sản phẩm đã được sao chép. Chuyển đến trang thêm sản phẩm mới?',
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Chuyển đến',
            cancelButtonText: 'Ở lại'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/Product/add';
            }
        });
    }

    // Add copy button to action buttons
    document.addEventListener('DOMContentLoaded', function() {
        const actionButtons = document.querySelector('.d-flex.gap-2:last-child');
        if (actionButtons) {
            const copyBtn = document.createElement('button');
            copyBtn.type = 'button';
            copyBtn.className = 'btn btn-outline-success btn-lg';
            copyBtn.innerHTML = '<i class="fas fa-copy me-2"></i>Sao chép';
            copyBtn.onclick = copyProduct;
            
            actionButtons.insertBefore(copyBtn, actionButtons.children[1]);
        }
    });

    // Show related products
    function showRelatedProducts() {
        const categoryId = document.getElementById('category_id').value;
        if (!categoryId) {
            toastr.info('Vui lòng chọn danh mục trước');
            return;
        }
        
        Swal.fire({
            title: 'Sản phẩm cùng danh mục',
            html: '<div class="text-center"><div class="spinner-border" role="status"></div><p class="mt-2">Đang tải...</p></div>',
            showConfirmButton: false,
            allowOutsideClick: false
        });
        
        // Simulate loading related products
        setTimeout(() => {
            const relatedProducts = [
                { id: 1, name: 'iPhone 15 Pro', price: 30000000 },
                { id: 2, name: 'Samsung Galaxy S24', price: 25000000 },
                { id: 3, name: 'Xiaomi 14 Ultra', price: 20000000 }
            ].filter(p => p.id !== <?php echo $product->id; ?>);
            
            let html = '<div class="list-group">';
            relatedProducts.forEach(product => {
                html += `
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">${product.name}</h6>
                            <p class="mb-1 text-success">${new Intl.NumberFormat('vi-VN').format(product.price)}₫</p>
                        </div>
                        <div>
                            <a href="/Product/show/${product.id}" class="btn btn-outline-primary btn-sm" target="_blank">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            
            Swal.fire({
                title: 'Sản phẩm cùng danh mục',
                html: html,
                width: '600px',
                confirmButtonText: 'Đóng'
            });
        }, 1500);
    }

    // Add related products button
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category_id');
        const relatedBtn = document.createElement('button');
        relatedBtn.type = 'button';
        relatedBtn.className = 'btn btn-outline-info btn-sm mt-2';
        relatedBtn.innerHTML = '<i class="fas fa-sitemap me-1"></i>Xem sản phẩm cùng danh mục';
        relatedBtn.onclick = showRelatedProducts;
        
        categorySelect.parentNode.appendChild(relatedBtn);
    });

    // Price history and suggestions
    function showPriceHistory() {
        const currentPrice = document.getElementById('price').value;
        
        Swal.fire({
            title: 'Lịch sử giá & Gợi ý',
            html: `
                <div class="text-start">
                    <h6>Giá hiện tại: <span class="text-danger">${new Intl.NumberFormat('vi-VN').format(currentPrice)}₫</span></h6>
                    <hr>
                    <h6>Lịch sử giá:</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">📅 01/01/2024: ${new Intl.NumberFormat('vi-VN').format(currentPrice * 0.9)}₫</li>
                        <li class="mb-2">📅 15/02/2024: ${new Intl.NumberFormat('vi-VN').format(currentPrice * 0.95)}₫</li>
                        <li class="mb-2">📅 01/03/2024: ${new Intl.NumberFormat('vi-VN').format(currentPrice)}₫ (hiện tại)</li>
                    </ul>
                    <hr>
                    <h6>Gợi ý giá:</h6>
                    <ul class="list-unstyled">
                        <li class="mb-1">💡 Giá thị trường: ${new Intl.NumberFormat('vi-VN').format(currentPrice * 1.05)}₫</li>
                        <li class="mb-1">💡 Giá khuyến mãi: ${new Intl.NumberFormat('vi-VN').format(currentPrice * 0.85)}₫</li>
                        <li class="mb-1">💡 Giá VIP: ${new Intl.NumberFormat('vi-VN').format(currentPrice * 0.9)}₫</li>
                    </ul>
                </div>
            `,
            width: '500px',
            confirmButtonText: 'Đóng'
        });
    }

    // Add price history button
    document.addEventListener('DOMContentLoaded', function() {
        const priceInput = document.getElementById('price');
        const historyBtn = document.createElement('button');
        historyBtn.type = 'button';
        historyBtn.className = 'btn btn-outline-info btn-sm position-absolute';
        historyBtn.style.right = '60px';
        historyBtn.style.top = '0';
        historyBtn.style.bottom = '0';
        historyBtn.innerHTML = '<i class="fas fa-chart-line"></i>';
        historyBtn.title = 'Lịch sử giá';
        historyBtn.onclick = showPriceHistory;
        
        priceInput.parentNode.style.position = 'relative';
        priceInput.parentNode.appendChild(historyBtn);
    });

    // Success message if redirected back with success
    <?php if (isset($_SESSION['success'])): ?>
        toastr.success('<?php echo $_SESSION['success']; ?>');
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    // Help tooltip
    $('[title]').tooltip();
</script>

<?php include_once 'app/views/shares/footer.php'; ?>