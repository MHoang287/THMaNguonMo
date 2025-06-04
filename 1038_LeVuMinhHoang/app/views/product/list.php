<?php include 'app/views/shares/header.php'; ?>

<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center" data-aos="fade-down">
            <h2 class="mb-0">
                <i class="bi bi-box-seam-fill me-2 text-primary"></i>
                Sản phẩm
            </h2>
            <a href="/Product/add" class="btn btn-primary hvr-float">
                <i class="bi bi-plus-circle me-2"></i>Thêm sản phẩm mới
            </a>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="card mb-4" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);" data-aos="fade-down">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-secondary">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="searchProduct" class="form-control bg-transparent border-secondary text-white" 
                           placeholder="Tìm kiếm sản phẩm...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select bg-transparent border-secondary text-white select2" id="filterCategory">
                    <option value="">Tất cả danh mục</option>
                    <option value="laptop">Laptop</option>
                    <option value="phone">Điện thoại</option>
                    <option value="accessory">Phụ kiện</option>
                </select>
            </div>
            <div class="col-md-3">
                <div id="price-slider" class="mt-2"></div>
                <small class="text-muted">Giá: <span id="price-range">0đ - 50tr</span></small>
            </div>
            <div class="col-md-2">
                <select class="form-select bg-transparent border-secondary text-white" id="sortBy">
                    <option value="newest">Mới nhất</option>
                    <option value="price-asc">Giá tăng dần</option>
                    <option value="price-desc">Giá giảm dần</option>
                    <option value="name">Tên A-Z</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Products Grid -->
<div class="row g-4" id="productsGrid">
    <?php if(!empty($products)): ?>
        <?php foreach($products as $index => $product): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 product-item" data-aos="zoom-in" data-aos-delay="<?php echo $index * 50; ?>">
                <div class="card h-100 product-card hvr-float" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);">
                    <div class="position-relative overflow-hidden">
                        <img src="<?php echo $product->image ?: 'https://via.placeholder.com/300x200/1a1a2e/00d4ff?text=No+Image'; ?>" 
                             class="card-img-top product-image" 
                             alt="<?php echo htmlspecialchars($product->name); ?>"
                             style="height: 200px; object-fit: cover;">
                        <div class="product-overlay">
                            <div class="btn-group" role="group">
                                <a href="/Product/show/<?php echo $product->id; ?>" 
                                   class="btn btn-sm btn-info" 
                                   data-tippy-content="Xem chi tiết">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <button onclick="addToCart(<?php echo $product->id; ?>)" 
                                        class="btn btn-sm btn-success"
                                        data-tippy-content="Thêm vào giỏ">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                        <?php if($product->price > 10000000): ?>
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">Hot</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title text-truncate">
                            <?php echo htmlspecialchars($product->name); ?>
                        </h6>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-tag me-1"></i><?php echo htmlspecialchars($product->category_name ?: 'Chưa phân loại'); ?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-primary mb-0">
                                <?php echo number_format($product->price, 0, ',', '.'); ?>đ
                            </h5>
                            <div class="btn-group" role="group">
                                <a href="/Product/edit/<?php echo $product->id; ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button onclick="deleteProduct(<?php echo $product->id; ?>)" 
                                        class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <div class="text-muted">
                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                <p>Chưa có sản phẩm nào. <a href="/Product/add">Thêm sản phẩm mới</a></p>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
.product-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 212, 255, 0.3);
}

.product-image {
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.1);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-overlay {
    opacity: 1;
}
</style>

<script>
// Initialize price slider
const priceSlider = document.getElementById('price-slider');
noUiSlider.create(priceSlider, {
    start: [0, 50000000],
    connect: true,
    range: {
        'min': 0,
        'max': 100000000
    },
    format: {
        to: value => Math.round(value),
        from: value => Number(value)
    }
});

priceSlider.noUiSlider.on('update', function(values) {
    document.getElementById('price-range').textContent = 
        `${formatPrice(values[0])}đ - ${formatPrice(values[1])}đ`;
});

function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price);
}

// Search functionality
document.getElementById('searchProduct').addEventListener('keyup', function() {
    filterProducts();
});

document.getElementById('filterCategory').addEventListener('change', function() {
    filterProducts();
});

document.getElementById('sortBy').addEventListener('change', function() {
    sortProducts();
});

function filterProducts() {
    // Implementation for filtering products
    const searchValue = document.getElementById('searchProduct').value.toLowerCase();
    const categoryValue = document.getElementById('filterCategory').value;
    const products = document.querySelectorAll('.product-item');
    
    products.forEach(product => {
        const productName = product.querySelector('.card-title').textContent.toLowerCase();
        const productCategory = product.querySelector('.text-muted').textContent.toLowerCase();
        
        const matchesSearch = productName.includes(searchValue);
        const matchesCategory = !categoryValue || productCategory.includes(categoryValue);
        
        product.style.display = matchesSearch && matchesCategory ? '' : 'none';
    });
}

function sortProducts() {
    const sortBy = document.getElementById('sortBy').value;
    const grid = document.getElementById('productsGrid');
    const products = Array.from(grid.querySelectorAll('.product-item'));
    
    products.sort((a, b) => {
        switch(sortBy) {
            case 'price-asc':
                return getPriceValue(a) - getPriceValue(b);
            case 'price-desc':
                return getPriceValue(b) - getPriceValue(a);
            case 'name':
                return a.querySelector('.card-title').textContent.localeCompare(b.querySelector('.card-title').textContent);
            default:
                return 0;
        }
    });
    
    products.forEach(product => grid.appendChild(product));
}

function getPriceValue(element) {
    const priceText = element.querySelector('.text-primary').textContent;
    return parseInt(priceText.replace(/[^\d]/g, ''));
}

// Add to cart with animation
function addToCart(productId) {
    fetch(`/Product/addToCart/${productId}`)
        .then(response => {
            if (response.ok) {
                // Success animation
                Swal.fire({
                    icon: 'success',
                    title: 'Đã thêm vào giỏ hàng!',
                    showConfirmButton: false,
                    timer: 1500,
                    background: 'var(--card-bg)',
                    color: 'var(--text-light)'
                });
                
                // Update cart badge
                updateCartBadge();
            }
        })
        .catch(error => {
            toastr.error('Có lỗi xảy ra!');
        });
}

function updateCartBadge() {
    // Implementation to update cart badge count
    const cartBadge = document.querySelector('.cart-badge');
    if (cartBadge) {
        const currentCount = parseInt(cartBadge.textContent) || 0;
        cartBadge.textContent = currentCount + 1;
    }
}

// Delete product
function deleteProduct(id) {
    Swal.fire({
        title: 'Xác nhận xóa?',
        text: "Bạn có chắc chắn muốn xóa sản phẩm này?",
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
            window.location.href = `/Product/delete/${id}`;
        }
    });
}

// Initialize Masonry layout
const msnry = new Masonry('#productsGrid', {
    itemSelector: '.product-item',
    columnWidth: '.product-item',
    percentPosition: true
});

// GLightbox for product images
const lightbox = GLightbox({
    selector: '.product-image',
    touchNavigation: true,
    loop: true
});
</script>

<?php include 'app/views/shares/footer.php'; ?>