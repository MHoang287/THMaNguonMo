<?php 
$title = "Giỏ hàng - TechTafu";
include 'app/views/shares/header.php'; 
?>

<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" data-aos="fade-right">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản phẩm</a></li>
            <li class="breadcrumb-item active">Giỏ hàng</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1" data-aos="fade-right">
                        <i class="fas fa-shopping-cart text-primary me-2"></i>
                        Giỏ hàng của bạn
                    </h2>
                    <p class="text-muted mb-0" data-aos="fade-right" data-aos-delay="100">
                        <?php echo count($cart); ?> sản phẩm trong giỏ hàng
                    </p>
                </div>
                <div data-aos="fade-left">
                    <a href="/Product" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php if (empty($cart)): ?>
        <!-- Empty Cart -->
        <div class="text-center py-5" data-aos="fade-up">
            <div class="card shadow-sm">
                <div class="card-body py-5">
                    <div class="empty-cart-animation mb-4">
                        <i class="fas fa-shopping-cart fa-5x text-muted animate__animated animate__bounce"></i>
                    </div>
                    <h3 class="text-muted mb-3">Giỏ hàng trống</h3>
                    <p class="text-muted mb-4">Hãy thêm một số sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
                    <a href="/Product" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i>Khám phá sản phẩm
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4" data-aos="fade-up">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-list me-2"></i>
                            Sản phẩm đã chọn
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" width="60">
                                            <input type="checkbox" id="selectAll" class="form-check-input">
                                        </th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col" width="120">Đơn giá</th>
                                        <th scope="col" width="150">Số lượng</th>
                                        <th scope="col" width="120">Thành tiền</th>
                                        <th scope="col" width="80">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $total = 0;
                                    foreach ($cart as $productId => $item): 
                                        $itemTotal = $item['price'] * $item['quantity'];
                                        $total += $itemTotal;
                                    ?>
                                        <tr class="cart-item animate__animated animate__fadeIn" data-product-id="<?php echo $productId; ?>">
                                            <td>
                                                <input type="checkbox" class="form-check-input item-checkbox" value="<?php echo $productId; ?>">
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="product-image me-3">
                                                        <?php if (!empty($item['image'])): ?>
                                                            <img src="/<?php echo htmlspecialchars($item['image']); ?>" 
                                                                 alt="<?php echo htmlspecialchars($item['name']); ?>" 
                                                                 class="rounded" style="width: 60px; height: 60px; object-fit: cover;"
                                                                 onerror="this.src='/assets/images/no-image.svg'">
                                                        <?php else: ?>
                                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                                <i class="fas fa-image text-muted"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1"><?php echo htmlspecialchars($item['name']); ?></h6>
                                                        <small class="text-muted">Còn hàng</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-primary">
                                                    <?php echo number_format($item['price'], 0, ',', '.'); ?>đ
                                                </span>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm" style="width: 120px;">
                                                    <button class="btn btn-outline-secondary btn-decrease" type="button" data-product-id="<?php echo $productId; ?>">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="number" class="form-control text-center quantity-input" 
                                                           value="<?php echo $item['quantity']; ?>" 
                                                           min="1" max="99"
                                                           data-product-id="<?php echo $productId; ?>">
                                                    <button class="btn btn-outline-secondary btn-increase" type="button" data-product-id="<?php echo $productId; ?>">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-success item-total">
                                                    <?php echo number_format($itemTotal, 0, ',', '.'); ?>đ
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-danger btn-sm btn-remove" 
                                                        data-product-id="<?php echo $productId; ?>"
                                                        data-bs-toggle="tooltip" title="Xóa khỏi giỏ hàng">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button class="btn btn-outline-danger btn-sm" id="removeSelected">
                                    <i class="fas fa-trash me-1"></i>Xóa đã chọn
                                </button>
                                <button class="btn btn-outline-secondary btn-sm ms-2" id="clearCart">
                                    <i class="fas fa-times me-1"></i>Xóa tất cả
                                </button>
                            </div>
                            <div>
                                <span class="text-muted me-3">Tổng cộng:</span>
                                <span class="h5 text-primary mb-0" id="cartTotal">
                                    <?php echo number_format($total, 0, ',', '.'); ?>đ
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <!-- Summary Card -->
                <div class="card shadow-sm border-0 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-receipt me-2"></i>
                            Tóm tắt đơn hàng
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <span id="subtotal"><?php echo number_format($total, 0, ',', '.'); ?>đ</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển:</span>
                            <span class="text-success">Miễn phí</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Giảm giá:</span>
                            <span class="text-danger" id="discount">0đ</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Tổng tiền:</strong>
                            <strong class="text-primary h5" id="finalTotal">
                                <?php echo number_format($total, 0, ',', '.'); ?>đ
                            </strong>
                        </div>
                        
                        <!-- Coupon -->
                        <div class="mb-3">
                            <label class="form-label small">Mã giảm giá:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="couponCode" placeholder="Nhập mã...">
                                <button class="btn btn-outline-primary" type="button" id="applyCoupon">
                                    Áp dụng
                                </button>
                            </div>
                        </div>
                        
                        <a href="/Product/checkout" class="btn btn-success btn-lg w-100 mb-2">
                            <i class="fas fa-credit-card me-2"></i>Thanh toán ngay
                        </a>
                        <a href="/Product" class="btn btn-outline-primary w-100">
                            <i class="fas fa-shopping-bag me-2"></i>Tiếp tục mua sắm
                        </a>
                    </div>
                </div>

                <!-- Shipping Info -->
                <div class="card shadow-sm border-0 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-header bg-info text-white">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-shipping-fast me-2"></i>
                            Thông tin vận chuyển
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <small>Miễn phí vận chuyển toàn quốc</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-clock text-info me-2"></i>
                            <small>Giao hàng trong 1-2 ngày</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-shield-alt text-warning me-2"></i>
                            <small>Đảm bảo chất lượng 100%</small>
                        </div>
                    </div>
                </div>

                <!-- Recommended Products -->
                <div class="card shadow-sm border-0" data-aos="fade-up" data-aos-delay="400">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-star me-2"></i>
                            Có thể bạn quan tâm
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- Sample recommended products -->
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                            <div class="bg-light rounded me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-mobile-alt fa-lg text-muted d-flex align-items-center justify-content-center h-100"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 small">iPhone 15 Pro Max</h6>
                                <span class="text-primary small fw-bold">29.990.000đ</span>
                            </div>
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-laptop fa-lg text-muted d-flex align-items-center justify-content-center h-100"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 small">MacBook Air M2</h6>
                                <span class="text-primary small fw-bold">28.990.000đ</span>
                            </div>
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    // Update quantity
    document.querySelectorAll('.btn-increase, .btn-decrease').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const quantityInput = document.querySelector(`input[data-product-id="${productId}"]`);
            const isIncrease = this.classList.contains('btn-increase');
            
            let currentQty = parseInt(quantityInput.value);
            if (isIncrease) {
                currentQty = Math.min(currentQty + 1, 99);
            } else {
                currentQty = Math.max(currentQty - 1, 1);
            }
            
            quantityInput.value = currentQty;
            updateItemTotal(productId, currentQty);
        });
    });

    // Direct quantity input change
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const productId = this.dataset.productId;
            const quantity = parseInt(this.value) || 1;
            this.value = Math.max(1, Math.min(quantity, 99));
            updateItemTotal(productId, this.value);
        });
    });

    // Update item total
    function updateItemTotal(productId, quantity) {
        const row = document.querySelector(`tr[data-product-id="${productId}"]`);
        const priceText = row.querySelector('td:nth-child(3) span').textContent;
        const price = parseInt(priceText.replace(/[^\d]/g, ''));
        const itemTotal = price * quantity;
        
        row.querySelector('.item-total').textContent = new Intl.NumberFormat('vi-VN').format(itemTotal) + 'đ';
        updateCartTotal();
        
        // Animate the change
        row.querySelector('.item-total').classList.add('animate__animated', 'animate__pulse');
        setTimeout(() => {
            row.querySelector('.item-total').classList.remove('animate__animated', 'animate__pulse');
        }, 1000);
    }

    // Update cart total
    function updateCartTotal() {
        let total = 0;
        document.querySelectorAll('.item-total').forEach(element => {
            const amount = parseInt(element.textContent.replace(/[^\d]/g, ''));
            total += amount;
        });
        
        document.getElementById('cartTotal').textContent = new Intl.NumberFormat('vi-VN').format(total) + 'đ';
        document.getElementById('subtotal').textContent = new Intl.NumberFormat('vi-VN').format(total) + 'đ';
        document.getElementById('finalTotal').textContent = new Intl.NumberFormat('vi-VN').format(total) + 'đ';
    }

    // Remove item
    document.querySelectorAll('.btn-remove').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const row = document.querySelector(`tr[data-product-id="${productId}"]`);
            
            Swal.fire({
                title: 'Xác nhận xóa',
                text: 'Bạn có muốn xóa sản phẩm này khỏi giỏ hàng?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    row.classList.add('animate__animated', 'animate__fadeOut');
                    setTimeout(() => {
                        row.remove();
                        updateCartTotal();
                        toastr.success('Đã xóa sản phẩm khỏi giỏ hàng');
                        
                        // Check if cart is empty
                        if (document.querySelectorAll('.cart-item').length === 0) {
                            location.reload();
                        }
                    }, 500);
                }
            });
        });
    });

    // Select all checkbox
    document.getElementById('selectAll')?.addEventListener('change', function() {
        const isChecked = this.checked;
        document.querySelectorAll('.item-checkbox').forEach(checkbox => {
            checkbox.checked = isChecked;
        });
    });

    // Remove selected items
    document.getElementById('removeSelected')?.addEventListener('click', function() {
        const selectedItems = document.querySelectorAll('.item-checkbox:checked');
        if (selectedItems.length === 0) {
            toastr.warning('Vui lòng chọn sản phẩm cần xóa');
            return;
        }
        
        Swal.fire({
            title: 'Xác nhận xóa',
            text: `Bạn có muốn xóa ${selectedItems.length} sản phẩm đã chọn?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                selectedItems.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    row.classList.add('animate__animated', 'animate__fadeOut');
                    setTimeout(() => {
                        row.remove();
                        updateCartTotal();
                    }, 500);
                });
                toastr.success('Đã xóa các sản phẩm đã chọn');
            }
        });
    });

    // Clear cart
    document.getElementById('clearCart')?.addEventListener('click', function() {
        Swal.fire({
            title: 'Xóa toàn bộ giỏ hàng?',
            text: 'Hành động này không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Xóa tất cả',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = '/Product/clearCart';
            }
        });
    });

    // Apply coupon
    document.getElementById('applyCoupon')?.addEventListener('click', function() {
        const couponCode = document.getElementById('couponCode').value.trim();
        if (!couponCode) {
            toastr.warning('Vui lòng nhập mã giảm giá');
            return;
        }
        
        // Simulate coupon validation
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        this.disabled = true;
        
        setTimeout(() => {
            if (couponCode.toLowerCase() === 'save10') {
                document.getElementById('discount').textContent = '100.000đ';
                toastr.success('Áp dụng mã giảm giá thành công!');
            } else {
                toastr.error('Mã giảm giá không hợp lệ');
            }
            
            this.innerHTML = 'Áp dụng';
            this.disabled = false;
        }, 1500);
    });

    // Auto-save cart changes (simulate)
    let saveTimeout;
    function autoSaveCart() {
        clearTimeout(saveTimeout);
        saveTimeout = setTimeout(() => {
            // Simulate AJAX save
            console.log('Auto-saving cart...');
        }, 2000);
    }

    // Add auto-save to quantity changes
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', autoSaveCart);
    });
</script>

<style>
    .empty-cart-animation {
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }
    
    .cart-item:hover {
        background-color: #f8f9fa;
    }
    
    .quantity-input {
        max-width: 60px;
    }
    
    .product-image img {
        transition: transform 0.3s ease;
    }
    
    .product-image:hover img {
        transform: scale(1.1);
    }
    
    .table td {
        vertical-align: middle;
    }
</style>

<?php include 'app/views/shares/footer.php'; ?>