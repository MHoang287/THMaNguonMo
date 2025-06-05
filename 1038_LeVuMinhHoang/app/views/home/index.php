<?php 
$pageTitle = "Trang chủ";
include 'app/views/shares/header.php'; 
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-4">
                    Thiết Bị Điện Tử <br>
                    <span style="color: #ffd700;">Chính Hãng</span>
                </h1>
                <p class="lead mb-4">
                    Khám phá bộ sưu tập thiết bị điện tử hiện đại với chất lượng tốt nhất, 
                    giá cả hợp lý và dịch vụ chăm sóc khách hàng tận tâm.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="/Product" class="btn btn-custom btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i>Mua sắm ngay
                    </a>
                    <a href="#products" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-eye me-2"></i>Xem sản phẩm
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <lottie-player 
                        src="https://assets5.lottiefiles.com/packages/lf20_qp1q7mct.json"
                        background="transparent"
                        speed="1"
                        style="width: 100%; height: 400px;"
                        loop
                        autoplay>
                    </lottie-player>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="stats-card">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <div class="stats-number">10000</div>
                    <p class="text-muted">Khách hàng hài lòng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-card">
                    <i class="fas fa-box fa-3x text-success mb-3"></i>
                    <div class="stats-number">5000</div>
                    <p class="text-muted">Sản phẩm chất lượng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-card">
                    <i class="fas fa-shipping-fast fa-3x text-warning mb-3"></i>
                    <div class="stats-number">24</div>
                    <p class="text-muted">Giao hàng trong 24h</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-card">
                    <i class="fas fa-shield-alt fa-3x text-info mb-3"></i>
                    <div class="stats-number">12</div>
                    <p class="text-muted">Tháng bảo hành</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-5" id="products">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">Sản Phẩm Nổi Bật</h2>
                <p class="lead text-muted">Khám phá những sản phẩm công nghệ mới nhất và hot nhất</p>
            </div>
        </div>

        <!-- Swiper -->
        <div class="swiper" data-aos="fade-up">
            <div class="swiper-wrapper">
                <?php
                // Giả lập dữ liệu sản phẩm nổi bật
                $featuredProducts = [
                    [
                        'id' => 1,
                        'name' => 'iPhone 15 Pro Max',
                        'price' => 29990000,
                        'image' => 'https://via.placeholder.com/300x200/007bff/ffffff?text=iPhone+15',
                        'category' => 'Điện thoại'
                    ],
                    [
                        'id' => 2,
                        'name' => 'MacBook Air M3',
                        'price' => 34990000,
                        'image' => 'https://via.placeholder.com/300x200/28a745/ffffff?text=MacBook',
                        'category' => 'Laptop'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Samsung Galaxy S24',
                        'price' => 22990000,
                        'image' => 'https://via.placeholder.com/300x200/dc3545/ffffff?text=Samsung',
                        'category' => 'Điện thoại'
                    ],
                    [
                        'id' => 4,
                        'name' => 'iPad Pro 12.9"',
                        'price' => 27990000,
                        'image' => 'https://via.placeholder.com/300x200/ffc107/ffffff?text=iPad',
                        'category' => 'Tablet'
                    ],
                    [
                        'id' => 5,
                        'name' => 'AirPods Pro',
                        'price' => 6990000,
                        'image' => 'https://via.placeholder.com/300x200/17a2b8/ffffff?text=AirPods',
                        'category' => 'Phụ kiện'
                    ]
                ];

                foreach ($featuredProducts as $product):
                ?>
                <div class="swiper-slide">
                    <div class="card product-card h-100">
                        <div class="position-relative">
                            <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>" style="height: 200px; object-fit: cover;">
                            <span class="category-chip position-absolute top-0 start-0 m-2">
                                <?php echo $product['category']; ?>
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <div class="mt-auto">
                                <div class="price-tag mb-3">
                                    <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                                </div>
                                <div class="d-grid gap-2">
                                    <a href="/Product/show/<?php echo $product['id']; ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-eye me-2"></i>Xem chi tiết
                                    </a>
                                    <button class="btn btn-custom" onclick="addToCartAnimation(this)">
                                        <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-up">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-shipping-fast fa-2x"></i>
                    </div>
                    <h4>Giao Hàng Nhanh</h4>
                    <p class="text-muted">Giao hàng trong 24h tại TP.HCM và các tỉnh thành lớn</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-shield-alt fa-2x"></i>
                    </div>
                    <h4>Bảo Hành Chính Hãng</h4>
                    <p class="text-muted">Bảo hành chính hãng toàn quốc, hỗ trợ 24/7</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-undo fa-2x"></i>
                    </div>
                    <h4>Đổi Trả Dễ Dàng</h4>
                    <p class="text-muted">Đổi trả trong 7 ngày nếu không hài lòng</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-5" style="background: var(--gradient-primary);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-white" data-aos="fade-up">
                <h3 class="mb-3">Đăng Ký Nhận Tin Khuyến Mãi</h3>
                <p class="mb-4">Nhận thông tin về sản phẩm mới và ưu đãi đặc biệt</p>
                <div class="row g-2">
                    <div class="col-md-8">
                        <input type="email" class="form-control form-control-lg" placeholder="Nhập email của bạn...">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-light btn-lg w-100" type="button">
                            <i class="fas fa-paper-plane me-2"></i>Đăng ký
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>