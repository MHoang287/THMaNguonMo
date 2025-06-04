<?php include 'app/views/shares/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-lg" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);" data-aos="fade-up">
            <div class="card-header bg-transparent border-bottom border-secondary">
                <h4 class="mb-0 text-primary">
                    <i class="bi bi-plus-square me-2"></i>Thêm sản phẩm mới
                </h4>
            </div>
            <div class="card-body">
                <form action="/Product/save" method="POST" enctype="multipart/form-data" id="addProductForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    Tên sản phẩm <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-secondary">
                                        <i class="bi bi-box"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control bg-transparent border-secondary text-white <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" 
                                           id="name" 
                                           name="name" 
                                           placeholder="VD: iPhone 15 Pro Max"
                                           value="<?php echo $_POST['name'] ?? ''; ?>"
                                           required>
                                    <?php if(isset($errors['name'])): ?>
                                        <div class="invalid-feedback"><?php echo $errors['name']; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="price" class="form-label">
                                    Giá sản phẩm <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-secondary">
                                        <i class="bi bi-currency-dollar"></i>
                                    </span>
                                    <input type="number" 
                                           class="form-control bg-transparent border-secondary text-white <?php echo isset($errors['price']) ? 'is-invalid' : ''; ?>" 
                                           id="price" 
                                           name="price" 
                                           placeholder="VD: 29990000"
                                           value="<?php echo $_POST['price'] ?? ''; ?>"
                                           min="0"
                                           required>
                                    <span class="input-group-text bg-transparent border-secondary">VNĐ</span>
                                    <?php if(isset($errors['price'])): ?>
                                        <div class="invalid-feedback"><?php echo $errors['price']; ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-text text-muted">
                                    Giá hiển thị: <span id="priceDisplay" class="text-primary">0đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="category_id" class="form-label">
                                    Danh mục <span class="text-danger">*</span>
                                </label>
                                <select class="form-select bg-transparent border-secondary text-white select2" 
                                        id="category_id" 
                                        name="category_id" 
                                        required>
                                    <option value="">-- Chọn danh mục --</option>
                                    <?php foreach($categories as $category): ?>
                                        <option value="<?php echo $category->id; ?>" 
                                                <?php echo (isset($_POST['category_id']) && $_POST['category_id'] == $category->id) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($category->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                                <div class="dropzone" id="productDropzone">
                                    <div class="dz-message">
                                        <i class="bi bi-cloud-upload fs-1 d-block mb-2"></i>
                                        <span>Kéo thả hình ảnh vào đây hoặc click để chọn</span>
                                        <div class="text-muted small mt-2">
                                            (JPG, PNG, GIF - Tối đa 10MB)
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="image" id="uploadedImage">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label">
                            Mô tả sản phẩm <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control bg-transparent border-secondary text-white <?php echo isset($errors['description']) ? 'is-invalid' : ''; ?>" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Mô tả chi tiết về sản phẩm..."
                                  required><?php echo $_POST['description'] ?? ''; ?></textarea>
                        <?php if(isset($errors['description'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['description']; ?></div>
                        <?php endif; ?>
                        <div class="form-text text-muted">
                            <span id="charCount">0</span> ký tự
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="/Product" class="btn btn-secondary hvr-sweep-to-left">
                            <i class="bi bi-arrow-left me-2"></i>Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary hvr-sweep-to-right">
                            <i class="bi bi-check-circle me-2"></i>Thêm sản phẩm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.dropzone {
    border: 2px dashed rgba(255, 255, 255, 0.3);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.05);
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.dropzone:hover {
    border-color: var(--primary-color);
    background: rgba(0, 212, 255, 0.1);
}

.dropzone.dz-drag-hover {
    border-color: var(--primary-color);
    background: rgba(0, 212, 255, 0.2);
}

.dz-preview {
    margin: 10px;
}

.dz-image img {
    border-radius: 5px;
}
</style>

<script>
// Dropzone configuration
Dropzone.autoDiscover = false;
const myDropzone = new Dropzone("#productDropzone", {
    url: "/Product/uploadImage",
    maxFilesize: 10,
    maxFiles: 1,
    acceptedFiles: "image/*",
    addRemoveLinks: true,
    init: function() {
        this.on("success", function(file, response) {
            document.getElementById('uploadedImage').value = response.filename;
            toastr.success('Đã tải lên hình ảnh thành công!');
        });
        this.on("error", function(file, errorMessage) {
            toastr.error('Lỗi khi tải lên: ' + errorMessage);
        });
    }
});

// Price formatter
document.getElementById('price').addEventListener('input', function() {
    const value = this.value;
    const formatted = new Intl.NumberFormat('vi-VN').format(value);
    document.getElementById('priceDisplay').textContent = formatted + 'đ';
});

// Character counter
document.getElementById('description').addEventListener('input', function() {
    document.getElementById('charCount').textContent = this.value.length;
});

// Form validation
document.getElementById('addProductForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const price = document.getElementById('price').value;
    const description = document.getElementById('description').value.trim();
    const category = document.getElementById('category_id').value;
    
    let hasError = false;
    
    if (!name) {
        toastr.error('Vui lòng nhập tên sản phẩm');
        hasError = true;
    }
    
    if (!price || price < 0) {
        toastr.error('Vui lòng nhập giá hợp lệ');
        hasError = true;
    }
    
    if (!description) {
        toastr.error('Vui lòng nhập mô tả sản phẩm');
        hasError = true;
    }
    
    if (!category) {
        toastr.error('Vui lòng chọn danh mục');
        hasError = true;
    }
    
    if (hasError) {
        e.preventDefault();
    }
});
</script>

<?php include 'app/views/shares/footer.php'; ?>