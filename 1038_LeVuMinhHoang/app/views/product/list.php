<?php 
$title = "Danh sách sản phẩm - TechTafu";
include 'app/views/shares/header.php'; 
?>

<div class="container py-4">
    <!-- Hero Section -->
    <div class="hero-section text-center mb-5" data-aos="fade-down">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInUp">
                <i class="fas fa-mobile-alt me-3"></i>
                Thiết bị điện tử chính hãng
            </h1>
            <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                Khám phá bộ sưu tập thiết bị điện tử đa dạng với chất lượng tốt nhất
            </p>
            <div class="animate__animated animate__fadeInUp animate__delay-2s">
                <a href="#products" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-eye me-2"></i>Xem sản phẩm
                </a>
                <a href="/Product/add" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-plus me-2"></i>Thêm sản phẩm
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-5" id="stats">
        <div class="col-md-3 mb-3" data-aos="fade-up">
            <div class="card bg-primary text-white text-center">
                <div class="card-body">
                    <i class="fas fa-boxes fa-2x mb-2"></i>
                    <h3><?php echo count($products); ?></h3>
                    <p class="mb-0">Tổng sản phẩm</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3" data-aos="fade-up" data-aos-delay="100">
            <div class="card bg-success text-white text-center">
                <div class="card-body">
                    <i class="fas fa-tags fa-2x mb-2"></i>
                    <h3>
                        <?php 
                        $categories = array_unique(array_column($products, 'category_name'));
                        echo count(array_filter($categories));
                        ?>
                    </h3>
                    <p class="mb-0">Danh mục</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3" data-aos="fade-up" data-aos-delay="200">
            <div class="card bg-info text-white text-center">
                <div class="card-body">
                    <i class="fas fa-star fa-2x mb-2"></i>
                    <h3>0</h3>
                    <p class="mb-0">Đánh giá TB</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3" data-aos="fade-up" data-aos-delay="300">
            <div class="card bg-warning text-white text-center">
                <div class="card-body">
                    <i class="fas fa-shipping-fast fa-2x mb-2"></i>
                    <h3>24h</h3>
                    <p class="mb-0">Giao hàng</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Search Section -->
    <div class="card shadow-sm mb-4" data-aos="fade-up" id="filters">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <select id="categoryFilter" class="form-select">
                        <option value="">Tất cả danh mục</option>
                        <?php 
                        $uniqueCategories = array_unique(array_filter(array_column($products, 'category_name')));
                        foreach ($uniqueCategories as $categoryName): 
                        ?>
                            <option value="<?php echo htmlspecialchars($categoryName); ?>">
                                <?php echo htmlspecialchars($categoryName); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <select id="priceFilter" class="form-select">
                        <option value="">Tất cả giá</option>
                        <option value="0-500000">Dưới 500K</option>
                        <option value="500000-1000000">500K - 1M</option>
                        <option value="1000000-5000000">1M - 5M</option>
                        <option value="5000000-999999999">Trên 5M</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <select id="sortSelect" class="form-select">
                        <option value="name_asc">Tên A-Z</option>
                        <option value="name_desc">Tên Z-A</option>
                        <option value="price_asc">Giá thấp → cao</option>
                        <option value="price_desc">Giá cao → thấp</option>
                        <option value="newest">Mới nhất</option>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted">Hiển thị <strong id="resultCount"><?php echo count($products); ?></strong> sản phẩm</span>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary active" id="gridView">
                                <i class="fas fa-th"></i>
                            </button>
                            <button type="button" class="btn btn-outline-primary" id="listView">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div id="products">
        <?php if (empty($products)): ?>
            <div class="text-center py-5" data-aos="fade-up">
                <div class="card shadow-sm">
                    <div class="card-body py-5">
                        <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                        <h3 class="text-muted">Chưa có sản phẩm nào</h3>
                        <p class="text-muted mb-4">Hãy thêm sản phẩm đầu tiên để bắt đầu bán hàng</p>
                        <a href="/Product/add" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>Thêm sản phẩm mới
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Grid View -->
            <div class="row" id="productsGrid">
                <?php foreach ($products as $index => $product): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 product-item" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                        <div class="card h-100 product-card shadow-sm border-0">
                            <!-- Product Image -->
                            <div class="position-relative">
                                <?php if (!empty($product->image)): ?>
                                    <img src="<?php echo htmlspecialchars($product->image); ?>" 
                                        class="card-img-top product-image" 
                                        alt="<?php echo htmlspecialchars($product->name); ?>"
                                        loading="lazy"
                                        onerror="this.src='/public/image/no-image.jpg'; console.log('Image failed to load: ' + this.src);">
                                <?php else: ?>
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center product-image" 
                                        style="background-image: url('/public/image/image-pattern.png'); background-size: 30px; background-repeat: repeat;">
                                        <div class="d-flex flex-column align-items-center p-3 text-center">
                                            <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                            <small class="text-muted d-block">Hình ảnh chưa có sẵn</small>
                                            <small class="text-muted">hoặc đang tải...</small>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Category Badge -->
                                <?php if (!empty($product->category_name)): ?>
                                    <span class="position-absolute top-0 start-0 m-2 category-badge">
                                        <?php echo htmlspecialchars($product->category_name); ?>
                                    </span>
                                <?php endif; ?>
                                
                                <!-- Quick Actions -->
                                <div class="position-absolute top-0 end-0 m-2">
                                    <div class="btn-group-vertical btn-group-sm">
                                        <button class="btn btn-light btn-sm" onclick="addToWishlist(<?php echo $product->id; ?>)" data-bs-toggle="tooltip" title="Yêu thích">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <button class="btn btn-light btn-sm" onclick="quickView(<?php echo $product->id; ?>)" data-bs-toggle="tooltip" title="Xem nhanh">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Product Info -->
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title mb-2">
                                    <a href="/Product/show/<?php echo $product->id; ?>" class="text-decoration-none text-dark">
                                        <?php echo htmlspecialchars($product->name); ?>
                                    </a>
                                </h6>
                                <p class="card-text text-muted small flex-grow-1">
                                    <?php echo mb_substr(htmlspecialchars($product->description), 0, 80) . '...'; ?>
                                </p>
                                
                                <!-- Rating -->
                                <div class="mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="text-warning me-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <small class="text-muted">(4.8)</small>
                                    </div>
                                </div>
                                
                                <!-- Price -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="price h5 mb-0 text-primary fw-bold">
                                        <?php echo number_format($product->price, 0) . ' vnđ'; ?>
                                    </span>
                                    <small class="text-muted">Còn hàng</small>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary flex-fill" onclick="addToCart(<?php echo $product->id; ?>, this)">
                                        <i class="fas fa-cart-plus me-1"></i>Mua
                                    </button>
                                    <div class="btn-group">
                                        <a href="/Product/show/<?php echo $product->id; ?>" class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="/Product/edit/<?php echo $product->id; ?>" class="btn btn-outline-warning" data-bs-toggle="tooltip" title="Sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-outline-danger" onclick="deleteProduct(<?php echo $product->id; ?>)" data-bs-toggle="tooltip" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- List View (Hidden by default) -->
            <div id="productsList" style="display: none;">
                <?php foreach ($products as $product): ?>
                    <div class="card mb-3 product-item-list">
                        <div class="row g-0">
                            <div class="col-md-3">
                                <?php if (!empty($product->image)): ?>
                                    <img src="/<?php echo htmlspecialchars($product->image); ?>" 
                                         class="img-fluid rounded-start h-100" 
                                         alt="<?php echo htmlspecialchars($product->name); ?>"
                                         style="object-fit: cover;">
                                <?php else: ?>
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center product-image" style="height: 200px; background: #f8f9fa;">
                                    <div class="d-flex flex-column align-items-center p-3 text-center">
                                        <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                        <small class="text-muted d-block">Hình ảnh chưa có sẵn</small>
                                        <small class="text-muted">hoặc đang tải...</small>
                                        <button class="btn btn-sm btn-outline-secondary mt-2" onclick="loadProductImage(<?php echo $product->id; ?>, this)">
                                            <i class="fas fa-sync-alt me-1"></i> Tải lại
                                        </button>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="flex-grow-1">
                                            <h5 class="card-title">
                                                <a href="/Product/show/<?php echo $product->id; ?>" class="text-decoration-none">
                                                    <?php echo htmlspecialchars($product->name); ?>
                                                </a>
                                            </h5>
                                            <p class="card-text"><?php echo htmlspecialchars($product->description); ?></p>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    Danh mục: <?php echo htmlspecialchars($product->category_name ?? 'Chưa phân loại'); ?>
                                                </small>
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            <h4 class="price text-primary mb-3">
                                                <?php echo number_format($product->price, 0, ',', '.'); ?>đ
                                            </h4>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-primary" onclick="addToCart(<?php echo $product->id; ?>, this)">
                                                    <i class="fas fa-cart-plus me-1"></i>Mua
                                                </button>
                                                <a href="/Product/show/<?php echo $product->id; ?>" class="btn btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/Product/edit/<?php echo $product->id; ?>" class="btn btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-outline-danger" onclick="deleteProduct(<?php echo $product->id; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Load More Button -->
    <?php if (!empty($products) && count($products) >= 12): ?>
        <div class="text-center mt-4" data-aos="fade-up">
            <button class="btn btn-outline-primary btn-lg" id="loadMoreBtn">
                <i class="fas fa-plus me-2"></i>Xem thêm sản phẩm
            </button>
        </div>
    <?php endif; ?>
</div>

<!-- Quick View Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xem nhanh sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="quickViewContent">
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // CẬP NHẬT: Add to Cart với AJAX
    function addToCart(productId, button) {
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang thêm...';
        button.disabled = true;
        
        // Gửi AJAX request đến server
        fetch('/Product/addToCart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'product_id=' + productId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                button.innerHTML = '<i class="fas fa-check me-1"></i>Đã thêm!';
                button.classList.remove('btn-primary');
                button.classList.add('btn-success');
                
                // Hiển thị thông báo thành công
                if (typeof toastr !== 'undefined') {
                    toastr.success(data.message);
                } else {
                    alert(data.message);
                }
                
                // Cập nhật số lượng giỏ hàng trong navbar
                updateCartCount(data.cart_count);
                
                // Reset button sau 2 giây
                setTimeout(function() {
                    button.innerHTML = originalText;
                    button.classList.remove('btn-success');
                    button.classList.add('btn-primary');
                    button.disabled = false;
                }, 2000);
            } else {
                // Hiển thị lỗi
                if (typeof toastr !== 'undefined') {
                    toastr.error(data.message);
                } else {
                    alert('Lỗi: ' + data.message);
                }
                
                // Reset button
                button.innerHTML = originalText;
                button.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (typeof toastr !== 'undefined') {
                toastr.error('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng');
            } else {
                alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng');
            }
            
            // Reset button
            button.innerHTML = originalText;
            button.disabled = false;
        });
    }

    // Hàm cập nhật số lượng giỏ hàng
    function updateCartCount(count) {
        const cartBadge = document.querySelector('.navbar .badge');
        if (cartBadge) {
            cartBadge.textContent = count;
        }
    }

    // Buy Now
    function buyNow() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Mua ngay',
                text: 'Chuyển đến trang thanh toán?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (typeof toastr !== 'undefined') {
                        toastr.info('Chuyển đến trang thanh toán...');
                    }
                    // Redirect to checkout page
                    window.location.href = '/Product/checkout';
                }
            });
        } else {
            if (confirm('Chuyển đến trang thanh toán?')) {
                window.location.href = '/Product/checkout';
            }
        }
    }

    // Add to Wishlist
    function addToWishlist(productId) {
        if (typeof toastr !== 'undefined') {
            toastr.success('Đã thêm vào danh sách yêu thích!');
        } else {
            alert('Đã thêm vào danh sách yêu thích!');
        }
    }

    // Compare Product
    function compareProduct() {
        if (typeof toastr !== 'undefined') {
            toastr.info('Đã thêm vào danh sách so sánh!');
        } else {
            alert('Đã thêm vào danh sách so sánh!');
        }
    }

    // Share Product
    function shareProduct() {
        if (navigator.share) {
            navigator.share({
                title: document.querySelector('h1').textContent,
                text: document.querySelector('.product-description')?.textContent || '',
                url: window.location.href
            });
        } else {
            // Fallback: copy URL to clipboard
            navigator.clipboard.writeText(window.location.href).then(function() {
                if (typeof toastr !== 'undefined') {
                    toastr.success('Đã sao chép link sản phẩm!');
                } else {
                    alert('Đã sao chép link sản phẩm!');
                }
            });
        }
    }

    // Zoom Image
    function zoomImage() {
        const modal = new bootstrap.Modal(document.getElementById('imageZoomModal'));
        modal.show();
    }

    // Admin Functions
    function toggleStatus() {
        if (typeof toastr !== 'undefined') {
            toastr.success('Đã thay đổi trạng thái sản phẩm!');
        } else {
            alert('Đã thay đổi trạng thái sản phẩm!');
        }
    }

    function duplicateProduct() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Nhân bản sản phẩm',
                text: 'Tạo bản sao của sản phẩm này?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (typeof toastr !== 'undefined') {
                        toastr.success('Đã tạo bản sao sản phẩm!');
                    } else {
                        alert('Đã tạo bản sao sản phẩm!');
                    }
                }
            });
        } else {
            if (confirm('Tạo bản sao của sản phẩm này?')) {
                alert('Đã tạo bản sao sản phẩm!');
            }
        }
    }

    function deleteProduct(id) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Xác nhận xóa',
                text: 'Bạn có chắc chắn muốn xóa sản phẩm này? Hành động này không thể hoàn tác!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/Product/delete/' + id;
                }
            });
        } else if (typeof confirmDelete === 'function') {
            confirmDelete('Bạn có chắc chắn muốn xóa sản phẩm này? Hành động này không thể hoàn tác!').then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/Product/delete/' + id;
                }
            });
        } else {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này? Hành động này không thể hoàn tác!')) {
                window.location.href = '/Product/delete/' + id;
            }
        }
    }

    // Price Animation
    document.addEventListener('DOMContentLoaded', function() {
        const priceElement = document.querySelector('.price');
        if (priceElement) {
            priceElement.classList.add('animate__animated', 'animate__bounceIn');
        }
    });
</script>

<?php include 'app/views/shares/footer.php'; ?>