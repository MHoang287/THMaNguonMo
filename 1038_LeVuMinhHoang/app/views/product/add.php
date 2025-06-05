<?php require_once 'app/views/shares/header.php'; ?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm mới</li>
        </ol>
    </div>
</nav>

<!-- Add Product Form -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow" data-aos="fade-up">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Thêm sản phẩm mới</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php if(isset($errors) && !empty($errors)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h6 class="alert-heading"><i class="bi bi-exclamation-triangle"></i> Có lỗi xảy ra:</h6>
                                <ul class="mb-0">
                                    <?php foreach($errors as $field => $error): ?>
                                        <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="/Product/save" method="POST" enctype="multipart/form-data" id="addProductForm">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                                           id="name" 
                                           name="name" 
                                           value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>"
                                           placeholder="Nhập tên sản phẩm"
                                           required>
                                    <?php if(isset($errors['name'])): ?>
                                        <div class="invalid-feedback"><?= $errors['name'] ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Giá sản phẩm <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">₫</span>
                                        <input type="number" 
                                               class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>" 
                                               id="price" 
                                               name="price" 
                                               value="<?= isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '' ?>"
                                               placeholder="0"
                                               min="0"
                                               step="1000"
                                               required>
                                        <?php if(isset($errors['price'])): ?>
                                            <div class="invalid-feedback"><?= $errors['price'] ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <small class="text-muted">Nhập giá bán của sản phẩm</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        <option value="">-- Chọn danh mục --</option>
                                        <?php foreach($categories as $category): ?>
                                            <option value="<?= $category->id ?>" 
                                                    <?= (isset($_POST['category_id']) && $_POST['category_id'] == $category->id) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($category->name) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">Mô tả sản phẩm <span class="text-danger">*</span></label>
                                    <textarea class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>" 
                                              id="description" 
                                              name="description" 
                                              rows="5" 
                                              placeholder="Nhập mô tả chi tiết về sản phẩm"
                                              required><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
                                    <?php if(isset($errors['description'])): ?>
                                        <div class="invalid-feedback"><?= $errors['description'] ?></div>
                                    <?php endif; ?>
                                    <small class="text-muted">Mô tả chi tiết giúp khách hàng hiểu rõ hơn về sản phẩm</small>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                                    <div class="input-group">
                                        <input type="file" 
                                               class="form-control" 
                                               id="image" 
                                               name="image" 
                                               accept="image/*"
                                               onchange="previewImage(event)">
                                        <label class="input-group-text" for="image">
                                            <i class="bi bi-upload"></i> Tải lên
                                        </label>
                                    </div>
                                    <small class="text-muted">Chấp nhận định dạng: JPG, JPEG, PNG, GIF (Tối đa 10MB)</small>
                                    
                                    <!-- Image Preview -->
                                    <div id="imagePreview" class="mt-3" style="display: none;">
                                        <p class="mb-2">Xem trước:</p>
                                        <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                                        <button type="button" class="btn btn-sm btn-danger ms-2" onclick="removeImage()">
                                            <i class="bi bi-trash"></i> Xóa
                                        </button>
                                    </div>
                                </div>

                                <!-- Additional Fields (Optional) -->
                                <div class="col-12">
                                    <h5 class="mb-3">Thông tin bổ sung (Tùy chọn)</h5>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="brand" class="form-label">Thương hiệu</label>
                                    <input type="text" class="form-control" id="brand" name="brand" placeholder="VD: Apple, Samsung...">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="warranty" class="form-label">Bảo hành</label>
                                    <input type="text" class="form-control" id="warranty" name="warranty" placeholder="VD: 12 tháng">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="stock" class="form-label">Số lượng tồn kho</label>
                                    <input type="number" class="form-control" id="stock" name="stock" min="0" placeholder="0">
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <a href="/Product" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Quay lại
                                </a>
                                <div>
                                    <button type="reset" class="btn btn-outline-secondary">
                                        <i class="bi bi-x-circle"></i> Đặt lại
                                    </button>
                                    <button type="submit" class="btn btn-primary ms-2">
                                        <i class="bi bi-check-circle"></i> Thêm sản phẩm
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.form-label {
    font-weight: 600;
    color: #495057;
}

.form-control:focus,
.form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

#imagePreview img {
    border: 2px solid #dee2e6;
    border-radius: 0.375rem;
}
</style>

<?php
$additionalScripts = '
<script>
// Initialize Choices.js for category select
const categorySelect = new Choices("#category_id", {
    searchEnabled: true,
    itemSelectText: "",
    searchPlaceholderValue: "Tìm kiếm danh mục..."
});

// Preview image before upload
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById("preview");
    const previewContainer = document.getElementById("imagePreview");
    
    if (file) {
        // Check file size (10MB limit)
        if (file.size > 10 * 1024 * 1024) {
            Swal.fire({
                icon: "error",
                title: "File quá lớn",
                text: "Vui lòng chọn file có kích thước nhỏ hơn 10MB"
            });
            event.target.value = "";
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = "block";
            
            // Animate preview
            anime({
                targets: previewContainer,
                opacity: [0, 1],
                translateY: [20, 0],
                duration: 500,
                easing: "easeOutQuad"
            });
        }
        reader.readAsDataURL(file);
    }
}

// Remove selected image
function removeImage() {
    document.getElementById("image").value = "";
    document.getElementById("imagePreview").style.display = "none";
}

// Form validation
document.getElementById("addProductForm").addEventListener("submit", function(e) {
    e.preventDefault();
    
    // Show loading
    Swal.fire({
        title: "Đang xử lý...",
        text: "Vui lòng đợi trong giây lát",
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });
    
    // Submit form
    this.submit();
});

// Auto format price input
document.getElementById("price").addEventListener("input", function(e) {
    let value = e.target.value;
    value = value.replace(/\D/g, "");
    e.target.value = value;
});

// Character counter for description
const description = document.getElementById("description");
const maxLength = 1000;

description.addEventListener("input", function() {
    const remaining = maxLength - this.value.length;
    if (!document.getElementById("charCounter")) {
        const counter = document.createElement("small");
        counter.id = "charCounter";
        counter.className = "text-muted";
        this.parentElement.appendChild(counter);
    }
    document.getElementById("charCounter").textContent = `Còn lại ${remaining} ký tự`;
});
</script>
';
?>

<?php require_once 'app/views/shares/footer.php'; ?>