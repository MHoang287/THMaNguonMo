<?php 
$pageTitle = "Thêm danh mục mới";
include 'app/views/shares/app/views/shares/header.php'; 
?>

<div class="container mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" data-aos="fade-right">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/category/list">Danh mục</a></li>
            <li class="breadcrumb-item active">Thêm mới</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12" data-aos="fade-down">
            <h1 class="display-6 fw-bold">
                <i class="fas fa-plus-circle text-success me-3"></i>Thêm Danh Mục Mới
            </h1>
            <p class="text-muted">Tạo danh mục mới để phân loại sản phẩm trong cửa hàng</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0" data-aos="fade-up">
                <div class="card-header bg-gradient-success text-white">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Thông Tin Danh Mục
                    </h4>
                </div>
                
                <div class="card-body p-4">
                    <form action="/category/store" method="POST" id="categoryForm" enctype="multipart/form-data">
                        <!-- Category Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">
                                <i class="fas fa-tag text-primary me-2"></i>Tên danh mục
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg" 
                                   id="name" 
                                   name="name" 
                                   placeholder="Ví dụ: Điện thoại, Laptop, Phụ kiện..."
                                   value="<?php echo isset($_SESSION['old_data']['name']) ? htmlspecialchars($_SESSION['old_data']['name']) : ''; ?>"
                                   required>
                            <div class="form-text">Tên danh mục nên ngắn gọn và dễ hiểu</div>
                            <div class="invalid-feedback">Vui lòng nhập tên danh mục</div>
                        </div>

                        <!-- Category Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">
                                <i class="fas fa-align-left text-info me-2"></i>Mô tả danh mục
                            </label>
                            <textarea class="form-control" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="Mô tả chi tiết về danh mục sản phẩm..."><?php echo isset($_SESSION['old_data']['description']) ? htmlspecialchars($_SESSION['old_data']['description']) : ''; ?></textarea>
                            <div class="form-text">Mô tả ngắn gọn về các sản phẩm trong danh mục này</div>
                        </div>

                        <!-- Category Icon -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-icons text-purple me-2"></i>Biểu tượng danh mục
                            </label>
                            <div class="icon-selector">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="radio" class="btn-check" name="icon" id="icon-phone" value="fas fa-mobile-alt" autocomplete="off">
                                        <label class="btn btn-outline-primary icon-btn" for="icon-phone">
                                            <i class="fas fa-mobile-alt fa-2x"></i>
                                            <span>Điện thoại</span>
                                        </label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" class="btn-check" name="icon" id="icon-laptop" value="fas fa-laptop" autocomplete="off">
                                        <label class="btn btn-outline-primary icon-btn" for="icon-laptop">
                                            <i class="fas fa-laptop fa-2x"></i>
                                            <span>Laptop</span>
                                        </label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" class="btn-check" name="icon" id="icon-tablet" value="fas fa-tablet-alt" autocomplete="off">
                                        <label class="btn btn-outline-primary icon-btn" for="icon-tablet">
                                            <i class="fas fa-tablet-alt fa-2x"></i>
                                            <span>Tablet</span>
                                        </label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" class="btn-check" name="icon" id="icon-headphones" value="fas fa-headphones" autocomplete="off">
                                        <label class="btn btn-outline-primary icon-btn" for="icon-headphones">
                                            <i class="fas fa-headphones fa-2x"></i>
                                            <span>Âm thanh</span>
                                        </label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" class="btn-check" name="icon" id="icon-camera" value="fas fa-camera" autocomplete="off">
                                        <label class="btn btn-outline-primary icon-btn" for="icon-camera">
                                            <i class="fas fa-camera fa-2x"></i>
                                            <span>Camera</span>
                                        </label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" class="btn-check" name="icon" id="icon-gamepad" value="fas fa-gamepad" autocomplete="off">
                                        <label class="btn btn-outline-primary icon-btn" for="icon-gamepad">
                                            <i class="fas fa-gamepad fa-2x"></i>
                                            <span>Gaming</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Category Image -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">
                                <i class="fas fa-image text-purple me-2"></i>Hình ảnh danh mục
                            </label>
                            <div class="upload-area" onclick="document.getElementById('image').click()">
                                <div class="upload-content">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <h5>Kéo thả hoặc click để chọn ảnh</h5>
                                    <p class="text-muted">Hỗ trợ: JPG, JPEG, PNG (tối đa 5MB)</p>
                                </div>
                                <input type="file" 
                                       class="form-control d-none" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*"
                                       onchange="previewImage(this)">
                            </div>
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                                <button type="button" class="btn btn-sm btn-danger ms-2" onclick="removeImage()">
                                    <i class="fas fa-times"></i> Xóa
                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/category/list" class="btn btn-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Quay lại
                            </a>
                            <button type="reset" class="btn btn-outline-warning btn-lg">
                                <i class="fas fa-undo me-2"></i>Làm mới
                            </button>
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save me-2"></i>Lưu danh mục
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Quick Tips -->
        <div class="col-lg-4">
            <div class="card shadow-sm" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-lightbulb text-warning me-2"></i>Gợi ý hữu ích
                    </h5>
                </div>
                <div class="card-body">
                    <div class="tip-item mb-3">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Tên danh mục</strong>
                        <p class="text-muted small mb-0">Nên đặt tên ngắn gọn, dễ hiểu và phù hợp với sản phẩm</p>
                    </div>
                    <div class="tip-item mb-3">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Mô tả chi tiết</strong>
                        <p class="text-muted small mb-0">Viết mô tả rõ ràng để khách hàng hiểu về danh mục</p>
                    </div>
                    <div class="tip-item mb-3">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Chọn biểu tượng</strong>
                        <p class="text-muted small mb-0">Biểu tượng giúp nhận diện danh mục dễ dàng hơn</p>
                    </div>
                    <div class="tip-item">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Hình ảnh chất lượng</strong>
                        <p class="text-muted small mb-0">Sử dụng ảnh có độ phân giải cao và liên quan</p>
                    </div>
                </div>
            </div>

            <!-- Category Examples -->
            <div class="card shadow-sm mt-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-example text-info me-2"></i>Ví dụ danh mục
                    </h5>
                </div>
                <div class="card-body">
                    <div class="example-category mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-mobile-alt fa-2x text-primary me-3"></i>
                            <div>
                                <strong>Điện thoại thông minh</strong>
                                <p class="text-muted small mb-0">iPhone, Samsung, Xiaomi...</p>
                            </div>
                        </div>
                    </div>
                    <div class="example-category mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-laptop fa-2x text-success me-3"></i>
                            <div>
                                <strong>Laptop & Máy tính</strong>
                                <p class="text-muted small mb-0">MacBook, Dell, HP, Asus...</p>
                            </div>
                        </div>
                    </div>
                    <div class="example-category">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-headphones fa-2x text-warning me-3"></i>
                            <div>
                                <strong>Phụ kiện âm thanh</strong>
                                <p class="text-muted small mb-0">Tai nghe, loa, micro...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.upload-area:hover {
    border-color: var(--success-color);
    background: rgba(40, 167, 69, 0.05);
}

.upload-area.dragover {
    border-color: var(--success-color);
    background: rgba(40, 167, 69, 0.1);
}

.icon-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 15px;
    width: 100px;
    height: 100px;
    justify-content: center;
    transition: all 0.3s ease;
}

.icon-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.icon-btn span {
    font-size: 0.8rem;
    margin-top: 8px;
}

.tip-item {
    display: flex;
    align-items: flex-start;
}

.tip-item i {
    margin-top: 2px;
}

.example-category {
    padding: 10px;
    border-radius: 8px;
    background: #f8f9fa;
}

.form-check-input:checked + .icon-btn {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}
</style>

<script>
// Image preview function
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Remove image function
function removeImage() {
    document.getElementById('image').value = '';
    document.getElementById('imagePreview').style.display = 'none';
    document.getElementById('preview').src = '';
}

// Drag and drop functionality
const uploadArea = document.querySelector('.upload-area');

uploadArea.addEventListener('dragover', function(e) {
    e.preventDefault();
    uploadArea.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', function(e) {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
});

uploadArea.addEventListener('drop', function(e) {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('image').files = files;
        previewImage(document.getElementById('image'));
    }
});

// Form validation
document.getElementById('categoryForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    
    if (!name) {
        e.preventDefault();
        document.getElementById('name').classList.add('is-invalid');
        document.getElementById('name').focus();
        
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: 'Vui lòng nhập tên danh mục'
        });
        return;
    }
    
    // Check if name already exists (AJAX call)
    checkCategoryName(name, function(exists) {
        if (exists) {
            e.preventDefault();
            document.getElementById('name').classList.add('is-invalid');
            
            Swal.fire({
                icon: 'error',
                title: 'Tên danh mục đã tồn tại!',
                text: 'Vui lòng chọn tên khác cho danh mục'
            });
        } else {
            showLoading();
        }
    });
});

// Check category name exists
function checkCategoryName(name, callback) {
    fetch('/category/checkName', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'name=' + encodeURIComponent(name)
    })
    .then(response => response.json())
    .then(data => {
        callback(data.exists);
    })
    .catch(error => {
        console.error('Error:', error);
        callback(false);
    });
}

// Real-time validation
document.getElementById('name').addEventListener('input', function() {
    const name = this.value.trim();
    
    if (name) {
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
        
        // Check name availability after 500ms delay
        clearTimeout(this.timeoutId);
        this.timeoutId = setTimeout(() => {
            checkCategoryName(name, (exists) => {
                if (exists) {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                    this.nextElementSibling.textContent = 'Tên danh mục đã tồn tại';
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        }, 500);
    } else {
        this.classList.remove('is-valid', 'is-invalid');
    }
});

// Auto-resize textarea
document.getElementById('description').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = this.scrollHeight + 'px';
});

// Initialize animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate form fields
    anime({
        targets: '.mb-4',
        translateY: [30, 0],
        opacity: [0, 1],
        delay: anime.stagger(100),
        duration: 600,
        easing: 'easeOutExpo'
    });
    
    // Animate icon buttons
    anime({
        targets: '.icon-btn',
        scale: [0.8, 1],
        opacity: [0, 1],
        delay: anime.stagger(50, {start: 800}),
        duration: 400,
        easing: 'easeOutExpo'
    });
});
</script>

<?php 
// Clear old data from session
unset($_SESSION['old_data']);
include 'app/views/shares/app/views/shares/footer.php'; 
?>