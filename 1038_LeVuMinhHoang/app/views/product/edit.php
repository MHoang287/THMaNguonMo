<?php include 'app/views/shares/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-lg" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);" data-aos="fade-up">
            <div class="card-header bg-transparent border-bottom border-secondary">
                <h4 class="mb-0 text-warning">
                    <i class="bi bi-pencil-square me-2"></i>Chỉnh sửa sản phẩm
                </h4>
            </div>
            <div class="card-body">
                <form action="/Product/update" method="POST" enctype="multipart/form-data" id="editProductForm">
                    <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                    <input type="hidden" name="existing_image" value="<?php echo $product->image; ?>">
                    
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
                                           class="form-control bg-transparent border-secondary text-white" 
                                           id="name" 
                                           name="name" 
                                           value="<?php echo htmlspecialchars($product->name); ?>"
                                           required>
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
                                           class="form-control bg-transparent border-secondary text-white" 
                                           id="price" 
                                           name="price" 
                                           value="<?php echo $product->price; ?>"
                                           min="0"
                                           required>
                                    <span class="input-group-text bg-transparent border-secondary">VNĐ</span>
                                </div>
                                <div class="form-text text-muted">
                                    Giá hiển thị: <span id="priceDisplay" class="text-primary"><?php echo number_format($product->price, 0, ',', '.'); ?>đ</span>
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
                                                <?php echo ($product->category_id == $category->id) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($category->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label">Hình ảnh sản phẩm</label>
                                
                                <?php if($product->image): ?>
                                    <div class="mb-3">
                                        <img src="<?php echo $product->image; ?>" 
                                             class="img-thumbnail" 
                                             style="max-height: 150px;"
                                             alt="Current image">
                                        <p class="text-muted small mt-2">Hình ảnh hiện tại</p>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="input-group">
                                    <input type="file" 
                                           class="form-control bg-transparent border-secondary text-white" 
                                           id="image" 
                                           name="image"
                                           accept="image/*">
                                    <label class="input-group-text bg-transparent border-secondary" for="image">
                                        <i class="bi bi-upload"></i>
                                    </label>
                                </div>
                                <div class="form-text text-muted">Để trống nếu không muốn thay đổi hình ảnh</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label">
                            Mô tả sản phẩm <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control bg-transparent border-secondary text-white" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  required><?php echo htmlspecialchars($product->description); ?></textarea>
                        <div class="form-text text-muted">
                            <span id="charCount"><?php echo strlen($product->description); ?></span> ký tự
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="alert alert-info bg-transparent border-info text-info mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>ID sản phẩm:</strong> #<?php echo $product->id; ?> | 
                        <strong>Danh mục hiện tại:</strong> <?php echo htmlspecialchars($product->category_name ?: 'Chưa phân loại'); ?>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="/Product" class="btn btn-secondary hvr-sweep-to-left">
                            <i class="bi bi-arrow-left me-2"></i>Quay lại
                        </a>
                        <button type="submit" class="btn btn-warning hvr-sweep-to-right">
                            <i class="bi bi-check-circle me-2"></i>Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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

// Image preview
document.getElementById('image').addEventListener('change', function(e) {
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            Swal.fire({
                title: 'Xem trước hình ảnh mới',
                html: `<img src="${e.target.result}" class="img-fluid" style="max-height: 300px;">`,
                showConfirmButton: true,
                confirmButtonText: 'OK',
                background: 'var(--card-bg)',
                color: 'var(--text-light)'
            });
        }
        reader.readAsDataURL(e.target.files[0]);
    }
});

// Form validation
document.getElementById('editProductForm').addEventListener('submit', function(e) {
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