<?php
$title = "Thêm danh mục mới";
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
                        <li class="breadcrumb-item"><a href="/category/list" class="text-white-50">Danh mục</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Thêm mới</li>
                    </ol>
                </nav>
                <h1 class="h2 mb-0 animate__animated animate__fadeInLeft">
                    <i class="fas fa-plus-circle me-2"></i>Tạo danh mục mới
                </h1>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="/category/list" class="btn btn-outline-light animate__animated animate__fadeInRight">
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
                <div class="card-header bg-success text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Thông tin danh mục
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
                        <div class="alert alert-danger animate__animated animate__shakeX">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Vui lòng kiểm tra lại:</strong>
                            <ul class="mb-0 mt-2">
                                <?php foreach ($_SESSION['errors'] as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php unset($_SESSION['errors']); ?>
                    <?php endif; ?>

                    <form action="/category/store" method="POST" id="categoryForm">
                        <div class="row g-4">
                            <!-- Category Name -->
                            <div class="col-12">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-tag me-1 text-success"></i>Tên danh mục *
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="name" 
                                       name="name" 
                                       placeholder="Nhập tên danh mục..."
                                       value="<?php echo htmlspecialchars($_SESSION['old_data']['name'] ?? ''); ?>"
                                       required
                                       maxlength="100">
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Tên danh mục sẽ hiển thị cho khách hàng (tối đa 100 ký tự)
                                </div>
                                <div id="nameAvailability" class="mt-2"></div>
                            </div>

                            <!-- Category Description -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-1 text-success"></i>Mô tả danh mục
                                </label>
                                <textarea class="form-control" 
                                          id="description" 
                                          name="description" 
                                          rows="5" 
                                          placeholder="Nhập mô tả chi tiết về danh mục..."
                                          maxlength="500"><?php echo htmlspecialchars($_SESSION['old_data']['description'] ?? ''); ?></textarea>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Mô tả sẽ giúp khách hàng hiểu rõ hơn về danh mục sản phẩm (tối đa 500 ký tự)
                                </div>
                            </div>

                            <!-- Category Preview -->
                            <div class="col-12">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h6 class="mb-0">
                                            <i class="fas fa-eye me-2"></i>Xem trước danh mục
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="categoryPreview">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-success text-white rounded-circle me-3 d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 50px;">
                                                    <i class="fas fa-tag"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1" id="previewName">Tên danh mục sẽ hiển thị ở đây</h6>
                                                    <p class="text-muted mb-0 small" id="previewDescription">Mô tả danh mục sẽ hiển thị ở đây</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SEO Options (Optional) -->
                            <div class="col-12">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        <h6 class="mb-0">
                                            <i class="fas fa-search me-2"></i>Tùy chọn SEO (Tùy chọn)
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="meta_title" class="form-label">Meta Title</label>
                                                <input type="text" class="form-control" id="meta_title" name="meta_title" 
                                                       placeholder="Tiêu đề SEO cho danh mục..." maxlength="60">
                                                <div class="form-text">Tối đa 60 ký tự</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" 
                                                       placeholder="từ khóa, seo, danh mục...">
                                            </div>
                                            <div class="col-12">
                                                <label for="meta_description" class="form-label">Meta Description</label>
                                                <textarea class="form-control" id="meta_description" name="meta_description" 
                                                          rows="2" placeholder="Mô tả SEO cho danh mục..." maxlength="160"></textarea>
                                                <div class="form-text">Tối đa 160 ký tự</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between flex-wrap gap-3">
                                    <a href="/category/list" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-times me-2"></i>Hủy bỏ
                                    </a>
                                    
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-success btn-lg" onclick="resetForm()">
                                            <i class="fas fa-undo me-2"></i>Đặt lại
                                        </button>
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="fas fa-save me-2"></i>Lưu danh mục
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

<!-- Quick Tips -->
<div class="container mb-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-lightbulb me-2 text-warning"></i>Gợi ý tạo danh mục hiệu quả
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                <div>
                                    <strong>Tên rõ ràng:</strong> Sử dụng tên dễ hiểu và phù hợp với sản phẩm
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                <div>
                                    <strong>Mô tả chi tiết:</strong> Giải thích rõ loại sản phẩm trong danh mục
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                <div>
                                    <strong>Tên duy nhất:</strong> Không trùng lặp với danh mục đã có
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                <div>
                                    <strong>SEO thân thiện:</strong> Điền thông tin SEO để tối ưu tìm kiếm
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Clear old data after displaying
    <?php unset($_SESSION['old_data']); ?>

    // Real-time preview update
    document.getElementById('name').addEventListener('input', function() {
        const previewName = document.getElementById('previewName');
        previewName.textContent = this.value || 'Tên danh mục sẽ hiển thị ở đây';
    });

    document.getElementById('description').addEventListener('input', function() {
        const previewDescription = document.getElementById('previewDescription');
        previewDescription.textContent = this.value || 'Mô tả danh mục sẽ hiển thị ở đây';
    });

    // Check name availability
    let nameCheckTimeout;
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value.trim();
        const availabilityDiv = document.getElementById('nameAvailability');
        
        clearTimeout(nameCheckTimeout);
        
        if (name.length < 2) {
            availabilityDiv.innerHTML = '';
            return;
        }
        
        availabilityDiv.innerHTML = '<small class="text-muted"><i class="fas fa-spinner fa-spin me-1"></i>Đang kiểm tra...</small>';
        
        nameCheckTimeout = setTimeout(() => {
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
                    availabilityDiv.innerHTML = '<small class="text-danger"><i class="fas fa-times me-1"></i>Tên danh mục đã tồn tại</small>';
                    this.setCustomValidity('Tên danh mục đã tồn tại');
                } else {
                    availabilityDiv.innerHTML = '<small class="text-success"><i class="fas fa-check me-1"></i>Tên danh mục có thể sử dụng</small>';
                    this.setCustomValidity('');
                }
            })
            .catch(error => {
                availabilityDiv.innerHTML = '<small class="text-warning"><i class="fas fa-exclamation-triangle me-1"></i>Không thể kiểm tra</small>';
            });
        }, 500);
    });

    // Form validation
    document.getElementById('categoryForm').addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const description = document.getElementById('description').value.trim();
        
        if (!name) {
            e.preventDefault();
            toastr.error('Vui lòng nhập tên danh mục');
            document.getElementById('name').focus();
            return;
        }
        
        if (name.length < 2) {
            e.preventDefault();
            toastr.error('Tên danh mục phải có ít nhất 2 ký tự');
            document.getElementById('name').focus();
            return;
        }
        
        if (name.length > 100) {
            e.preventDefault();
            toastr.error('Tên danh mục không được quá 100 ký tự');
            document.getElementById('name').focus();
            return;
        }
    });

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
                document.getElementById('categoryForm').reset();
                document.getElementById('previewName').textContent = 'Tên danh mục sẽ hiển thị ở đây';
                document.getElementById('previewDescription').textContent = 'Mô tả danh mục sẽ hiển thị ở đây';
                document.getElementById('nameAvailability').innerHTML = '';
                toastr.info('Đã đặt lại form');
            }
        });
    }

    // Character counters
    function addCharacterCounter(inputId, maxLength) {
        const input = document.getElementById(inputId);
        const counter = document.createElement('div');
        counter.className = 'form-text text-end mt-1';
        counter.id = inputId + 'Counter';
        input.parentNode.appendChild(counter);
        
        input.addEventListener('input', function() {
            const currentLength = this.value.length;
            const remaining = maxLength - currentLength;
            
            counter.innerHTML = `<i class="fas fa-keyboard me-1"></i>${currentLength}/${maxLength} ký tự`;
            counter.className = remaining < maxLength * 0.1 ? 'form-text text-end mt-1 text-warning' : 'form-text text-end mt-1 text-muted';
            
            if (remaining < 0) {
                counter.className = 'form-text text-end mt-1 text-danger';
            }
        });
        
        // Trigger initial count
        input.dispatchEvent(new Event('input'));
    }

    // Add character counters
    document.addEventListener('DOMContentLoaded', function() {
        addCharacterCounter('name', 100);
        addCharacterCounter('description', 500);
        addCharacterCounter('meta_title', 60);
        addCharacterCounter('meta_description', 160);
    });

    // Auto-generate meta fields from name and description
    document.getElementById('name').addEventListener('blur', function() {
        const metaTitle = document.getElementById('meta_title');
        if (!metaTitle.value && this.value) {
            metaTitle.value = this.value + ' - TechTafu';
        }
    });

    document.getElementById('description').addEventListener('blur', function() {
        const metaDescription = document.getElementById('meta_description');
        if (!metaDescription.value && this.value) {
            metaDescription.value = this.value.substring(0, 160);
        }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl + S: Save form
        if (e.ctrlKey && e.key === 's') {
            e.preventDefault();
            document.getElementById('categoryForm').submit();
        }
        
        // Escape: Go back
        if (e.key === 'Escape') {
            window.location.href = '/category/list';
        }
    });

    // Auto-save to localStorage for recovery
    const formInputs = document.querySelectorAll('#categoryForm input, #categoryForm textarea');
    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            const formData = new FormData(document.getElementById('categoryForm'));
            const data = Object.fromEntries(formData);
            localStorage.setItem('categoryFormDraft', JSON.stringify(data));
        });
    });

    // Restore from localStorage on page load
    document.addEventListener('DOMContentLoaded', function() {
        const savedData = localStorage.getItem('categoryFormDraft');
        if (savedData) {
            const data = JSON.parse(savedData);
            Object.keys(data).forEach(key => {
                const input = document.querySelector(`[name="${key}"]`);
                if (input && !input.value) { // Only restore if field is empty
                    input.value = data[key];
                    input.dispatchEvent(new Event('input')); // Trigger events
                }
            });
        }
    });

    // Clear draft on successful submission
    document.getElementById('categoryForm').addEventListener('submit', function() {
        localStorage.removeItem('categoryFormDraft');
    });

    // Show draft recovery option
    window.addEventListener('load', function() {
        const savedData = localStorage.getItem('categoryFormDraft');
        if (savedData && Object.values(JSON.parse(savedData)).some(value => value)) {
            toastr.info('Có dữ liệu nháp được tìm thấy. Dữ liệu đã được khôi phục tự động.', 'Khôi phục dữ liệu');
        }
    });
</script>

<?php include_once 'app/views/shares/footer.php'; ?>