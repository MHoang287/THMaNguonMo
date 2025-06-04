<?php include 'app/views/shares/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);" data-aos="fade-up">
            <div class="card-header bg-transparent border-bottom border-secondary">
                <h4 class="mb-0 text-info">
                    <i class="bi bi-info-square me-2"></i>Chi tiết danh mục
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="text-muted small">ID Danh mục</label>
                            <p class="fs-5">
                                <span class="badge bg-primary">#<?php echo $category->id; ?></span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="text-muted small">Tên danh mục</label>
                            <p class="fs-5 fw-bold"><?php echo htmlspecialchars($category->name); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="text-muted small">Mô tả</label>
                    <div class="p-3 rounded" style="background: rgba(255,255,255,0.05);">
                        <p class="mb-0">
                            <?php echo htmlspecialchars($category->description ?: 'Chưa có mô tả'); ?>
                        </p>
                    </div>
                </div>
                
                <!-- Related Products Stats -->
                <div class="alert alert-info bg-transparent border-info">
                    <i class="bi bi-box-seam me-2"></i>
                    <strong>Thống kê:</strong> Có <span class="badge bg-info">0</span> sản phẩm trong danh mục này
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="/category/list" class="btn btn-secondary hvr-sweep-to-left">
                        <i class="bi bi-arrow-left me-2"></i>Quay lại
                    </a>
                    <div>
                        <a href="/category/edit/<?php echo $category->id; ?>" class="btn btn-warning hvr-grow me-2">
                            <i class="bi bi-pencil me-2"></i>Chỉnh sửa
                        </a>
                        <button onclick="deleteCategory(<?php echo $category->id; ?>)" class="btn btn-danger hvr-grow">
                            <i class="bi bi-trash me-2"></i>Xóa
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Anime.js Animation -->
        <div class="text-center mt-4">
            <div class="anime-box" style="width: 100px; height: 100px; background: var(--primary-color); margin: 0 auto; border-radius: 10px;"></div>
        </div>
    </div>
</div>

<script>
// Anime.js Animation
anime({
    targets: '.anime-box',
    translateX: [-50, 50],
    rotate: '1turn',
    duration: 3000,
    loop: true,
    direction: 'alternate',
    easing: 'easeInOutSine'
});

// Delete Category
function deleteCategory(id) {
    Swal.fire({
        title: 'Xác nhận xóa?',
        text: "Bạn có chắc chắn muốn xóa danh mục này?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy',
        background: 'var(--card-bg)',
        color: 'var(--text-light)'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/category/delete/${id}`;
        }
    });
}
</script>

<?php include 'app/views/shares/footer.php'; ?>