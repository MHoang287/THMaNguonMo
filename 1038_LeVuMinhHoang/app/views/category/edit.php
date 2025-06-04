<?php include 'app/views/shares/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);" data-aos="fade-up">
            <div class="card-header bg-transparent border-bottom border-secondary">
                <h4 class="mb-0 text-warning">
                    <i class="bi bi-pencil-square me-2"></i>Chỉnh sửa danh mục
                </h4>
            </div>
            <div class="card-body">
                <form action="/category/update/<?php echo $category->id; ?>" method="POST" id="editCategoryForm">
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
                                   value="<?php echo htmlspecialchars($_SESSION['old_data']['name'] ?? $category->name); ?>"
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
                                      placeholder="Nhập mô tả cho danh mục"><?php echo htmlspecialchars($_SESSION['old_data']['description'] ?? $category->description); ?></textarea>
                        </div>
                    </div>
                    
                    <!-- Category Info -->
                    <div class="alert alert-info bg-transparent border-info text-info mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>ID danh mục:</strong> #<?php echo $category->id; ?>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="/category/list" class="btn btn-secondary hvr-sweep-to-left">
                            <i class="bi bi-arrow-left me-2"></i>Quay lại
                        </a>
                        <button type="submit" class="btn btn-warning hvr-sweep-to-right">
                            <i class="bi bi-check-circle me-2"></i>Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Animated Background -->
        <div id="particles-js" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"></div>
    </div>
</div>

<script>
// Particles.js Configuration
particlesJS('particles-js', {
    particles: {
        number: { value: 30, density: { enable: true, value_area: 800 } },
        color: { value: '#00d4ff' },
        shape: { type: 'circle' },
        opacity: { value: 0.3, random: true },
        size: { value: 3, random: true },
        line_linked: { enable: true, distance: 150, color: '#00d4ff', opacity: 0.2, width: 1 },
        move: { enable: true, speed: 2, direction: 'none', random: false, straight: false, out_mode: 'out', bounce: false }
    },
    interactivity: {
        detect_on: 'canvas',
        events: { onhover: { enable: true, mode: 'grab' }, onclick: { enable: true, mode: 'push' }, resize: true },
        modes: { grab: { distance: 140, line_linked: { opacity: 0.5 } }, push: { particles_nb: 4 } }
    },
    retina_detect: true
});

// Form Validation
document.getElementById('editCategoryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const name = document.getElementById('name').value.trim();
    const nameInput = document.getElementById('name');
    const nameError = document.getElementById('nameError');
    const categoryId = <?php echo $category->id; ?>;
    
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
        body: `name=${encodeURIComponent(name)}&exclude_id=${categoryId}`
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