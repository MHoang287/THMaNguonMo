<?php 
$title = "Quản lý danh mục - TechTafu";
include 'app/views/shares/header.php'; 
?>

<div class="container py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1" data-aos="fade-right">
                        <i class="fas fa-tags text-primary me-2"></i>
                        Quản lý danh mục
                    </h2>
                    <p class="text-muted mb-0" data-aos="fade-right" data-aos-delay="100">
                        Quản lý tất cả danh mục sản phẩm
                    </p>
                </div>
                <div data-aos="fade-left">
                    <a href="/category/create" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>Thêm danh mục mới
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3" data-aos="fade-up">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <i class="fas fa-tags fa-2x mb-2"></i>
                    <h4><?php echo count($categories); ?></h4>
                    <p class="mb-0">Tổng danh mục</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3" data-aos="fade-up" data-aos-delay="100">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <i class="fas fa-eye fa-2x mb-2"></i>
                    <h4><?php echo count(array_filter($categories, function($cat) { return !empty($cat->description); })); ?></h4>
                    <p class="mb-0">Có mô tả</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3" data-aos="fade-up" data-aos-delay="200">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <i class="fas fa-clock fa-2x mb-2"></i>
                    <h4>24/7</h4>
                    <p class="mb-0">Hoạt động</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3" data-aos="fade-up" data-aos-delay="300">
            <div class="card bg-warning text-white">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-2x mb-2"></i>
                    <h4>100%</h4>
                    <p class="mb-0">Hiệu quả</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" data-aos="fade-up">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm danh mục...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select id="sortSelect" class="form-select">
                                <option value="name_asc">Tên A-Z</option>
                                <option value="name_desc">Tên Z-A</option>
                                <option value="id_desc" selected>Mới nhất</option>
                                <option value="id_asc">Cũ nhất</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <?php if (empty($categories)): ?>
        <div class="text-center py-5" data-aos="fade-up">
            <div class="card shadow-sm">
                <div class="card-body py-5">
                    <i class="fas fa-tags fa-5x text-muted mb-4"></i>
                    <h3 class="text-muted">Chưa có danh mục nào</h3>
                    <p class="text-muted mb-4">Hãy thêm danh mục đầu tiên để bắt đầu</p>
                    <a href="/category/create" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>Thêm danh mục mới
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row" id="categoriesContainer">
            <?php foreach ($categories as $index => $category): ?>
                <div class="col-lg-4 col-md-6 mb-4 category-item" data-aos="fade-up" data-aos-delay="<?php echo $index * 50; ?>">
                    <div class="card h-100 shadow-sm category-card">
                        <div class="card-header bg-gradient-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-tag me-2"></i>
                                    <?php echo htmlspecialchars($category->name); ?>
                                </h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="/category/show/<?php echo $category->id; ?>">
                                                <i class="fas fa-eye me-2"></i>Xem chi tiết
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="/category/edit/<?php echo $category->id; ?>">
                                                <i class="fas fa-edit me-2"></i>Chỉnh sửa
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="deleteCategory(<?php echo $category->id; ?>)">
                                                <i class="fas fa-trash me-2"></i>Xóa
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="mb-3">
                                <strong class="text-muted">ID:</strong> 
                                <span class="badge bg-secondary">#<?php echo $category->id; ?></span>
                            </div>
                            
                            <?php if (!empty($category->description)): ?>
                                <p class="card-text text-muted">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <?php echo htmlspecialchars($category->description); ?>
                                </p>
                            <?php else: ?>
                                <p class="card-text text-muted">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <em>Chưa có mô tả</em>
                                </p>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-between">
                                <a href="/category/show/<?php echo $category->id; ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>Chi tiết
                                </a>
                                <a href="/category/edit/<?php echo $category->id; ?>" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-edit me-1"></i>Sửa
                                </a>
                                <button class="btn btn-outline-danger btn-sm" onclick="deleteCategory(<?php echo $category->id; ?>)">
                                    <i class="fas fa-trash me-1"></i>Xóa
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const categories = document.querySelectorAll('.category-item');
        
        categories.forEach(function(category) {
            const categoryName = category.querySelector('.card-title').textContent.toLowerCase();
            const categoryDesc = category.querySelector('.card-text').textContent.toLowerCase();
            
            if (categoryName.includes(searchTerm) || categoryDesc.includes(searchTerm)) {
                category.style.display = 'block';
                category.classList.add('animate__animated', 'animate__fadeIn');
            } else {
                category.style.display = 'none';
            }
        });
    });

    // Sort functionality
    document.getElementById('sortSelect').addEventListener('change', function() {
        const sortBy = this.value;
        const container = document.getElementById('categoriesContainer');
        const categories = Array.from(container.children);
        
        categories.sort(function(a, b) {
            let aValue, bValue;
            
            switch(sortBy) {
                case 'name_asc':
                    aValue = a.querySelector('.card-title').textContent.toLowerCase();
                    bValue = b.querySelector('.card-title').textContent.toLowerCase();
                    return aValue.localeCompare(bValue);
                case 'name_desc':
                    aValue = a.querySelector('.card-title').textContent.toLowerCase();
                    bValue = b.querySelector('.card-title').textContent.toLowerCase();
                    return bValue.localeCompare(aValue);
                case 'id_asc':
                    aValue = parseInt(a.querySelector('.badge').textContent.replace('#', ''));
                    bValue = parseInt(b.querySelector('.badge').textContent.replace('#', ''));
                    return aValue - bValue;
                case 'id_desc':
                default:
                    aValue = parseInt(a.querySelector('.badge').textContent.replace('#', ''));
                    bValue = parseInt(b.querySelector('.badge').textContent.replace('#', ''));
                    return bValue - aValue;
            }
        });
        
        // Re-append sorted elements
        categories.forEach(function(category) {
            container.appendChild(category);
        });
        
        // Re-animate
        categories.forEach(function(category, index) {
            category.style.animationDelay = (index * 50) + 'ms';
            category.classList.add('animate__animated', 'animate__fadeInUp');
        });
    });

    // Delete category function
    function deleteCategory(id) {
        confirmDelete('Bạn có chắc chắn muốn xóa danh mục này?').then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Đang xóa...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Redirect to delete
                window.location.href = '/category/delete/' + id;
            }
        });
    }

    // Add hover effects to cards
    document.querySelectorAll('.category-card').forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.classList.add('animate__animated', 'animate__pulse');
        });
        
        card.addEventListener('mouseleave', function() {
            this.classList.remove('animate__animated', 'animate__pulse');
        });
    });
</script>

<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
    }
    
    .category-card {
        transition: all 0.3s ease;
        border: none;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    
    .card-header {
        border-bottom: none;
    }
    
    .dropdown-toggle::after {
        display: none;
    }
</style>

<?php include 'app/views/shares/footer.php'; ?>