<?php
$title = "Chỉnh sửa danh mục - " . ($category->name ?? 'Không tìm thấy');
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
                        <li class="breadcrumb-item active text-white" aria-current="page">Chỉnh sửa</li>
                    </ol>
                </nav>
                <h1 class="h2 mb-0 animate__animated animate__fadeInLeft">
                    <i class="fas fa-edit me-2"></i>Chỉnh sửa danh mục
                </h1>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="btn-group animate__animated animate__fadeInRight" role="group">
                    <a href="/category/list" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                    <a href="/category/show/<?php echo $category->id; ?>" class="btn btn-outline-light">
                        <i class="fas fa-eye me-2"></i>Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg animate-fade-in" data-aos="fade-up">
                <div class="card-header bg-warning text-dark py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Cập nhật thông tin danh mục
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <!-- Current Category Info -->
                    <div class="alert alert-info mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-tag fa-lg"></i>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <h6 class="alert-heading mb-2">Thông tin hiện tại:</h6>
                                <p class="mb-1"><strong>ID:</strong> <?php echo $category->id; ?></p>
                                <p class="mb-1"><strong>Tên:</strong> <?php echo htmlspecialchars($category->name); ?></p>
                                <p class="mb-0"><strong>Mô tả:</strong> <?php echo htmlspecialchars($category->description ?: 'Chưa có mô tả'); ?></p>
                            </div>
                        </div>
                    </div>

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

                    <form action="/category/update/<?php echo $category->id; ?>" method="POST" id="editCategoryForm">
                        <div class="row g-4">
                            <!-- Category Name -->
                            <div class="col-12">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-tag me-1 text-warning"></i>Tên danh mục *
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="name" 
                                       name="name" 
                                       placeholder="Nhập tên danh mục..."
                                       value="<?php echo htmlspecialchars($_SESSION['old_data']['name'] ?? $category->name); ?>"
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
                                    <i class="fas fa-align-left me-1 text-warning"></i>Mô tả danh mục
                                </label>
                                <textarea class="form-control" 
                                          id="description" 
                                          name="description" 
                                          rows="5" 
                                          placeholder="Nhập mô tả chi tiết về danh mục..."
                                          maxlength="500"><?php echo htmlspecialchars($_SESSION['old_data']['description'] ?? $category->description); ?></textarea>
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
                                                <div class="bg-warning text-dark rounded-circle me-3 d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 50px;">
                                                    <i class="fas fa-tag"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1" id="previewName"><?php echo htmlspecialchars($category->name); ?></h6>
                                                    <p class="text-muted mb-0 small" id="previewDescription"><?php echo htmlspecialchars($category->description ?: 'Chưa có mô tả'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Change History -->
                            <div class="col-12">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        <h6 class="mb-0">
                                            <i class="fas fa-history me-2"></i>Lịch sử thay đổi
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Ngày tạo</small>
                                                        <strong><?php echo date('d/m/Y H:i', strtotime($category->created_at ?? 'now')); ?></strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-edit text-warning me-2"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Lần cập nhật cuối</small>
                                                        <strong><?php echo date('d/m/Y H:i', strtotime($category->updated_at ?? 'now')); ?></strong>
                                                    </div>
                                                </div>
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
                                        <button type="button" class="btn btn-outline-danger btn-lg" 
                                                onclick="confirmDelete('/category/delete/<?php echo $category->id; ?>', 'Bạn có chắc chắn muốn xóa danh mục này?')">
                                            <i class="fas fa-trash me-2"></i>Xóa danh mục
                                        </button>
                                        <button type="submit" class="btn btn-warning btn-lg text-dark">
                                            <i class="fas fa-save me-2"></i>Cập nhật danh mục
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

<!-- Related Products (if any) -->
<div class="container mb-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-box me-2 text-primary"></i>Sản phẩm trong danh mục này
                    </h6>
                </div>
                <div class="card-body">
                    <div id="relatedProducts">
                        <div class="text-center py-3">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Đang tải...</span>
                            </div>
                            <p class="mt-2 text-muted">Đang tải danh sách sản phẩm...</p>
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
        previewName.textContent = this.value || '<?php echo htmlspecialchars($category->name); ?>';
    });

    document.getElementById('description').addEventListener('input', function() {
        const previewDescription = document.getElementById('previewDescription');
        previewDescription.textContent = this.value || 'Chưa có mô tả';
    });

    // Check name availability (exclude current category)
    let nameCheckTimeout;
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value.trim();
        const originalName = '<?php echo addslashes($category->name); ?>';
        const availabilityDiv = document.getElementById('nameAvailability');
        
        clearTimeout(nameCheckTimeout);
        
        // If name is same as original, don't check
        if (name === originalName) {
            availabilityDiv.innerHTML = '<small class="text-info"><i class="fas fa-info-circle me-1"></i>Tên hiện tại</small>';
            this.setCustomValidity('');
            return;
        }
        
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
                body: 'name=' + encodeURIComponent(name) + '&exclude_id=<?php echo $category->id; ?>'
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
    document.getElementById('editCategoryForm').addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        
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

        // Confirmation dialog
        e.preventDefault();
        Swal.fire({
            title: 'Xác nhận cập nhật',
            text: 'Bạn có chắc chắn muốn cập nhật danh mục này?',
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
        
        // Load related products
        loadRelatedProducts();
    });

    // Load related products
    function loadRelatedProducts() {
        setTimeout(() => {
            const relatedProductsDiv = document.getElementById('relatedProducts');
            const mockProducts = [
                { name: 'iPhone 14 Pro', count: 3 },
                { name: 'Samsung Galaxy S23', count: 2 },
                { name: 'MacBook Air M2', count: 1 }
            ];
            
            if (mockProducts.length > 0) {
                let html = '<div class="row g-2">';
                mockProducts.forEach(product => {
                    html += `
                        <div class="col-md-4">
                            <div class="d-flex align-items-center bg-light p-2 rounded">
                                <i class="fas fa-box text-primary me-2"></i>
                                <div class="flex-grow-1">
                                    <small class="fw-bold">${product.name}</small>
                                    <br><small class="text-muted">${product.count} sản phẩm</small>
                                </div>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                
                html += `
                    <div class="mt-3 text-center">
                        <a href="/Product?category=${<?php echo $category->id; ?>}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-2"></i>Xem tất cả sản phẩm
                        </a>
                    </div>
                `;
                
                relatedProductsDiv.innerHTML = html;
            } else {
                relatedProductsDiv.innerHTML = `
                    <div class="text-center py-3 text-muted">
                        <i class="fas fa-inbox fa-2x mb-2"></i>
                        <p class="mb-0">Chưa có sản phẩm nào trong danh mục này</p>
                    </div>
                `;
            }
        }, 1500);
    }

    // Check for unsaved changes
    let formChanged = false;
    const form = document.getElementById('editCategoryForm');
    const inputs = form.querySelectorAll('input, textarea');
    
    // Store original values
    const originalValues = {};
    inputs.forEach(input => {
        originalValues[input.name] = input.value;
        
        input.addEventListener('change', function() {
            formChanged = Object.keys(originalValues).some(key => {
                const input = form.querySelector(`[name="${key}"]`);
                return input && input.value !== originalValues[key];
            });
        });
    });

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

    // Auto-save draft
    let autoSaveTimeout;
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(() => {
                const formData = new FormData(form);
                const data = Object.fromEntries(formData);
                localStorage.setItem('categoryEditDraft_<?php echo $category->id; ?>', JSON.stringify(data));
            }, 1000);
        });
    });

    // Show changes indicator
    function showChangesIndicator() {
        let indicator = document.getElementById('changesIndicator');
        if (!indicator) {
            indicator = document.createElement('div');
            indicator.id = 'changesIndicator';
            indicator.className = 'alert alert-warning position-fixed top-0 start-50 translate-middle-x mt-3';
            indicator.style.zIndex = '1050';
            indicator.innerHTML = `
                <i class="fas fa-exclamation-triangle me-2"></i>
                Bạn có thay đổi chưa được lưu
                <button type="button" class="btn-close ms-2" onclick="this.parentElement.remove()"></button>
            `;
            document.body.appendChild(indicator);
        }
    }

    // Hide changes indicator
    function hideChangesIndicator() {
        const indicator = document.getElementById('changesIndicator');
        if (indicator) {
            indicator.remove();
        }
    }

    // Monitor changes
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (formChanged) {
                showChangesIndicator();
            } else {
                hideChangesIndicator();
            }
        });
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl + S: Save form
        if (e.ctrlKey && e.key === 's') {
            e.preventDefault();
            document.getElementById('editCategoryForm').submit();
        }
        
        // Escape: Go back
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
                        document.getElementById('editCategoryForm').submit();
                    } else if (result.isDenied) {
                        window.location.href = '/category/list';
                    }
                });
            } else {
                window.location.href = '/category/list';
            }
        }
    });

    // Show success message if coming from update
    <?php if (isset($_SESSION['success'])): ?>
        toastr.success('<?php echo $_SESSION['success']; ?>');
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    // Compare changes function
    function showChangesSummary() {
        const currentValues = {};
        inputs.forEach(input => {
            currentValues[input.name] = input.value;
        });
        
        const changes = [];
        Object.keys(originalValues).forEach(key => {
            if (originalValues[key] !== currentValues[key]) {
                changes.push({
                    field: key,
                    old: originalValues[key],
                    new: currentValues[key]
                });
            }
        });
        
        if (changes.length > 0) {
            let html = '<div class="table-responsive"><table class="table table-sm"><thead><tr><th>Trường</th><th>Giá trị cũ</th><th>Giá trị mới</th></tr></thead><tbody>';
            changes.forEach(change => {
                html += `<tr><td>${change.field}</td><td>${change.old || '<em>Trống</em>'}</td><td>${change.new || '<em>Trống</em>'}</td></tr>`;
            });
            html += '</tbody></table></div>';
            
            Swal.fire({
                title: 'Tóm tắt thay đổi',
                html: html,
                width: '600px',
                showConfirmButton: false,
                showCloseButton: true
            });
        } else {
            toastr.info('Không có thay đổi nào');
        }
    }

    // Add changes summary button
    document.addEventListener('DOMContentLoaded', function() {
        const buttonGroup = document.querySelector('.d-flex.gap-2');
        if (buttonGroup) {
            const summaryBtn = document.createElement('button');
            summaryBtn.type = 'button';
            summaryBtn.className = 'btn btn-outline-info btn-lg';
            summaryBtn.innerHTML = '<i class="fas fa-list me-2"></i>Xem thay đổi';
            summaryBtn.onclick = showChangesSummary;
            
            buttonGroup.insertBefore(summaryBtn, buttonGroup.firstChild);
        }
    });
</script>

<?php include_once 'app/views/shares/footer.php'; ?>