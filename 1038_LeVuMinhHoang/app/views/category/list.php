<?php include 'app/views/shares/header.php'; ?>

<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center" data-aos="fade-down">
            <h2 class="mb-0">
                <i class="bi bi-tags-fill me-2 text-primary"></i>
                Quản lý danh mục
            </h2>
            <a href="/category/create" class="btn btn-primary hvr-float">
                <i class="bi bi-plus-circle me-2"></i>Thêm danh mục mới
            </a>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3" data-aos="zoom-in" data-aos-delay="100">
        <div class="card text-white bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Tổng danh mục</h6>
                        <h2 class="mb-0 counter" data-target="<?php echo count($categories); ?>">0</h2>
                    </div>
                    <i class="bi bi-tags-fill fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Table -->
<div class="card shadow-lg" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);" data-aos="fade-up">
    <div class="card-header bg-transparent border-bottom border-secondary">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary">
                <i class="bi bi-list-ul me-2"></i>Danh sách danh mục
            </h5>
            <div class="input-group" style="width: 300px;">
                <span class="input-group-text bg-transparent border-secondary">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="searchInput" class="form-control bg-transparent border-secondary text-white" 
                       placeholder="Tìm kiếm danh mục...">
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="categoriesTable">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="30%">Tên danh mục</th>
                        <th width="40%">Mô tả</th>
                        <th width="20%" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($categories)): ?>
                        <?php foreach($categories as $category): ?>
                            <tr data-aos="fade-left" data-aos-delay="100">
                                <td>
                                    <span class="badge bg-primary">#<?php echo $category->id; ?></span>
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($category->name); ?></strong>
                                </td>
                                <td>
                                    <span class="text-muted">
                                        <?php echo htmlspecialchars($category->description ?: 'Chưa có mô tả'); ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="/category/show/<?php echo $category->id; ?>" 
                                           class="btn btn-sm btn-info hvr-grow"
                                           data-tippy-content="Xem chi tiết">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="/category/edit/<?php echo $category->id; ?>" 
                                           class="btn btn-sm btn-warning hvr-grow"
                                           data-tippy-content="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button onclick="deleteCategory(<?php echo $category->id; ?>)" 
                                                class="btn btn-sm btn-danger hvr-grow"
                                                data-tippy-content="Xóa">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                    <p>Chưa có danh mục nào. <a href="/category/create">Thêm danh mục mới</a></p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Counter Animation
document.querySelectorAll('.counter').forEach(counter => {
    const target = +counter.getAttribute('data-target');
    const countUp = new countUp.CountUp(counter, target);
    countUp.start();
});

// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#categoriesTable tbody tr');
    
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
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