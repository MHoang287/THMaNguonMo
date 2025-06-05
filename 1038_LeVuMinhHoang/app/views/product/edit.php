<?php require_once 'app/views/shares/header.php'; ?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa: <?= htmlspecialchars($product->name) ?></li>
        </ol>
    </div>
</nav>

<!-- Edit Product Form -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow" data-aos="fade-up">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Chỉnh sửa sản phẩm</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="/Product/update" method="POST" enctype="multipart/form-data" id="editProductForm">
                            <input type="hidden" name="id" value="<?= $product->id ?>">
                            <input type="hidden" name="existing_image" value="<?= htmlspecialchars($product->image) ?>">
                            
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="name" 
                                           name="name" 
                                           value="<?= htmlspecialchars($product->name) ?>"
                                           placeholder="Nhập tên sản phẩm"
                                           required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Giá sản phẩm <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">₫</span>
                                        <input type="number" 
                                               class="form-control" 
                                               id="price" 
                                               name="price" 
                                               value="<?= $product->price ?>"
                                               placeholder="0"
                                               min="0"
                                               step="1000"
                                               required>
                                    </div>
                                    <small class="text-muted">Giá hiện tại: <?= number_format($product->price, 0, ',', '.') ?>₫</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        <option value="">-- Chọn danh mục --</option>
                                        <?php foreach($categories as $category): ?>
                                            <option value="<?= $category->id ?>" 
                                                    <?= ($product->category_id == $category->id) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($category->name) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">Mô tả sản phẩm <span class="text-danger">*</span></label>
                                    <textarea class="form-control" 
                                              id="description" 
                                              name="description" 
                                              rows="5" 
                                              placeholder="Nhập mô tả chi tiết về sản phẩm"
                                              required><?= htmlspecialchars($product->description) ?></textarea>
                                    <small class="text-muted">Mô tả chi tiết giúp khách hàng hiểu rõ hơn về sản phẩm</small>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                                    
                                    <!-- Current Image -->
                                    <?php if($product->image): ?>
                                        <div class="mb-3">
                                            <p class="mb-2">Hình ảnh hiện tại:</p>
                                            <img src="<?= htmlspecialchars($product->image) ?>" 
                                                 alt="Current Image" 
                                                 class="img-thumbnail"
                                                 style="max-height: 200px;">
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="input-group">
                                        <input type="file" 
                                               class="form-control" 
                                               id="image" 
                                               name="image" 
                                               accept="image/*"
                                               onchange="previewImage(event)">
                                        <label class="input-group-text" for="image">
                                            <i class="bi bi-upload"></i> Tải lên hình mới
                                        </label>
                                    </div>
                                    <small class="text-muted">Để trống nếu không muốn thay đổi hình ảnh. Chấp nhận: JPG, JPEG, PNG, GIF (Tối đa 10MB)</small>
                                    
                                    <!-- New Image Preview -->
                                    <div id="imagePreview" class="mt-3" style="display: none;">
                                        <p class="mb-2">Xem trước hình mới:</p>
                                        <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                                        <button type="button" class="btn btn-sm btn-danger ms-2" onclick="removeImage()">
                                            <i class="bi bi-trash"></i> Xóa
                                        </button>
                                    </div>
                                </div>

                                <!-- Additional Info -->
                                <div class="col-12 mb-3">
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle"></i> 
                                        <strong>Thông tin:</strong>
                                        <ul class="mb-0 mt-2">
                                            <li>ID sản phẩm: #<?= $product->id ?></li>
                                            <li>Ngày tạo: <?= date('d/m/Y H:i', strtotime($product->created_at ?? 'now')) ?></li>
                                            <li>Lần cập nhật cuối: <?= date('d/m/Y H:i', strtotime($product->updated_at ?? 'now')) ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="/Product" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i> Quay lại
                                    </a>
                                    <a href="/Product/show/<?= $product->id ?>" class="btn btn-info ms-2">
                                        <i class="bi bi-eye"></i> Xem sản phẩm
                                    </a>
                                </div>
                                <div>
                                    <button type="reset" class="btn btn-outline-secondary" onclick="resetForm()">
                                        <i class="bi bi-arrow-clockwise"></i> Hoàn tác
                                    </button>
                                    <button type="submit" class="btn btn-warning ms-2">
                                        <i class="bi bi-check-circle"></i> Cập nhật
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card mt-3 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body">
                        <h6 class="card-title">Hành động nhanh</h6>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary" onclick="duplicateProduct()">
                                <i class="bi bi-copy"></i> Nhân bản sản phẩm
                            </button>
                            <button class="btn btn-sm btn-outline-danger" onclick="deleteProduct(<?= $product->id ?>)">
                                <i class="bi bi-trash"></i> Xóa sản phẩm
                            </button>
                        </div>
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
    border-color: #ffc107;
    box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
}

.alert-info {
    background-color: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
}
</style>

<?php
$additionalScripts = '
<script>
// Store original values for reset
const originalValues = {
    name: "' . addslashes($product->name) . '",
    price: ' . $product->price . ',
    category_id: ' . ($product->category_id ?? 'null') . ',
    description: "' . addslashes($product->description) . '"
};

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

// Reset form to original values
function resetForm() {
    document.getElementById("name").value = originalValues.name;
    document.getElementById("price").value = originalValues.price;
    document.getElementById("description").value = originalValues.description;
    categorySelect.setChoiceByValue(originalValues.category_id.toString());
    removeImage();
}

// Form validation and submission
document.getElementById("editProductForm").addEventListener("submit", function(e) {
    e.preventDefault();
    
    // Check if any changes were made
    const currentValues = {
        name: document.getElementById("name").value,
        price: parseInt(document.getElementById("price").value),
        category_id: parseInt(document.getElementById("category_id").value),
        description: document.getElementById("description").value
    };
    
    const hasChanges = JSON.stringify(originalValues) !== JSON.stringify(currentValues) || 
                      document.getElementById("image").files.length > 0;
    
    if (!hasChanges) {
        Swal.fire({
            icon: "info",
            title: "Không có thay đổi",
            text: "Bạn chưa thực hiện thay đổi nào",
            confirmButtonText: "OK"
        });
        return;
    }
    
    // Show loading
    Swal.fire({
        title: "Đang cập nhật...",
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

// Duplicate product function
function duplicateProduct() {
    Swal.fire({
        title: "Nhân bản sản phẩm?",
        text: "Tạo một bản sao của sản phẩm này",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Nhân bản",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/Product/duplicate/' . $product->id . '";
        }
    });
}

// Delete product
function deleteProduct(id) {
    Swal.fire({
        title: "Xác nhận xóa?",
        text: "Bạn có chắc chắn muốn xóa sản phẩm này? Hành động này không thể hoàn tác!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/Product/delete/" + id;
        }
    });
}
</script>
';
?>

<?php require_once 'app/views/shares/footer.php'; ?>