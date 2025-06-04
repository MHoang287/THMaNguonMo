<?php include 'app/views/shares/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);" data-aos="fade-up">
            <div class="card-header bg-transparent border-bottom border-secondary">
                <h4 class="mb-0 text-primary">
                    <i class="bi bi-plus-square me-2"></i>Thêm danh mục mới
                </h4>
            </div>
            <div class="card-body">
                <form action="/category/store" method="POST" id="createCategoryForm">
                    <div class="mb-4">
                        <label for="name" class="form-label">
                            Tên danh mục <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-secondary">
                                <i class="bi bi-tag"></i>
                            </span>
                            <input type="text" 
                                   class="form-control bg-transparent border-secondary text-white" 
                                   id="name" 
                                   name="name" 
                                   placeholder="Nhập tên danh mục"
                                   value="<?php echo $_SESSION['old_data']['name'] ?? ''; ?>"
                                   required>
                        </div>
                        <div class="form-text text-muted">Tối đa 100 ký tự</div>
                        <div id="nameError" class="invalid-feedback"></div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label">Mô tả</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-secondary">
                                <i class="bi bi-text-paragraph"></i>
                            </span>
                            <textarea class="form-control bg-transparent border-secondary text-white" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      placeholder="Nhập mô tả cho danh mục"><?php echo $_SESSION['old_data']['description'] ?? ''; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="/category/list" class="btn btn-secondary hvr-sweep-to-left">
                            <i class="bi bi-arrow-left me-2"></i>Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary hvr-sweep-to-right">
                            <i class="bi bi-check-circle me-2"></i>Thêm danh mục
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Lottie Animation -->
        <div class="text-center mt-4" data-aos="zoom-in">
            <div id="lottie-animation" style="width: 200px; height: 200px; margin: 0 auto;"></div>
        </div>
    </div>
</div>

<script>
// Lottie Animation
lottie.loadAnimation({
    container: document.getElementById('lottie-animation'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: 'https://assets2.lottiefiles.com/packages/lf20_uwR49r.json'
});

// Form Validation
document.getElementById('createCategoryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const name = document.getElementById('name').value.trim();
    const nameInput = document.getElementById('name');
    const nameError = document.getElementById('nameError');
    
    // Reset errors
    nameInput.classList.remove('is-invalid');
    
    // Validate name
    if (!name) {
        nameInput.classList.add('is-invalid');
        nameError.textContent = 'Tên danh mục không được để trống';
        return;
    }
    
    if (name.length > 100) {
        nameInput.classList.add('is-invalid');
        nameError.textContent = 'Tên danh mục không được quá 100 ký tự';
        return;
    }
    
    // Check duplicate name via AJAX
    fetch('/category/checkName', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `name=${encodeURIComponent(name)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.exists) {
            nameInput.classList.add('is-invalid');
            nameError.textContent = 'Tên danh mục đã tồn tại';
        } else {
            // Submit form
            this.submit();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        this.submit();
    });
});

// Real-time validation
document.getElementById('name').addEventListener('input', function() {
    const value = this.value.trim();
    const nameError = document.getElementById('nameError');
    
    this.classList.remove('is-invalid', 'is-valid');
    
    if (!value) {
        this.classList.add('is-invalid');
        nameError.textContent = 'Tên danh mục không được để trống';
    } else if (value.length > 100) {
        this.classList.add('is-invalid');
        nameError.textContent = 'Tên danh mục không được quá 100 ký tự';
    } else {
        this.classList.add('is-valid');
    }
});
</script>

<?php 
unset($_SESSION['old_data']);
include 'app/views/shares/footer.php'; 
?>