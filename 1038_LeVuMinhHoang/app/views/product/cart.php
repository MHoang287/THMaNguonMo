<?php include 'app/views/shares/header.php'; ?>

<div class="row">
    <div class="col-12">
        <h2 class="mb-4" data-aos="fade-down">
            <i class="bi bi-cart3 me-2 text-primary"></i>Giỏ hàng của bạn
        </h2>
    </div>
</div>

<?php if(!empty($cart)): ?>
    <div class="row">
        <div class="col-lg-8" data-aos="fade-right">
            <div class="card shadow-lg" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th width="15%">Đơn giá</th>
                                    <th width="15%">Số lượng</th>
                                    <th width="15%">Thành tiền</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total = 0;
                                foreach($cart as $id => $item): 
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                                ?>
                                <tr class="cart-item" data-id="<?php echo $id; ?>">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?php echo $item['image'] ?: 'https://via.placeholder.com/60x60/1a1a2e/00d4ff'; ?>" 
                                                 class="img-thumbnail me-3" 
                                                 style="width: 60px; height: 60px; object-fit: cover;"
                                                 alt="<?php echo htmlspecialchars($item['name']); ?>">
                                            <div>
                                                <h6 class="mb-0"><?php echo htmlspecialchars($item['name']); ?></h6>
                                                <small class="text-muted">ID: #<?php echo $id; ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="price"><?php echo number_format($item['price'], 0, ',', '.'); ?>đ</span>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm" style="width: 120px;">
                                            <button class="btn btn-outline-secondary btn-minus" type="button">
                                                <i class="bi bi-dash"></i>
                                            </button>
                                            <input type="number" 
                                                   class="form-control text-center quantity-input" 
                                                   value="<?php echo $item['quantity']; ?>" 
                                                   min="1" 
                                                   max="99">
                                            <button class="btn btn-outline-secondary btn-plus" type="button">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <strong class="subtotal text-primary">
                                            <?php echo number_format($subtotal, 0, ',', '.'); ?>đ
                                        </strong>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger btn-remove hvr-grow" 
                                                data-tippy-content="Xóa khỏi giỏ">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-3">
                        <a href="/Product" class="btn btn-secondary hvr-sweep-to-left">
                            <i class="bi bi-arrow-left me-2"></i>Tiếp tục mua sắm
                        </a>
                        <button class="btn btn-outline-danger" onclick="clearCart()">
                            <i class="bi bi-trash me-2"></i>Xóa tất cả
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4" data-aos="fade-left">
            <div class="card shadow-lg" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);">
                <div class="card-header bg-transparent border-bottom border-secondary">
                    <h5 class="mb-0">
                        <i class="bi bi-receipt me-2"></i>Tổng đơn hàng
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
                        <span>0đ</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="mb-0">Tổng cộng:</h5>
                        <h5 class="mb-0 text-primary" id="total">
                            <?php echo number_format($total, 0, ',', '.'); ?>đ
                        </h5>
                    </div>
                    
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control bg-transparent border-secondary text-white" 
                                   placeholder="Mã giảm giá">
                            <button class="btn btn-outline-primary" type="button">Áp dụng</button>
                        </div>
                    </div>
                    
                    <a href="/Product/checkout" class="btn btn-primary w-100 btn-lg hvr-sweep-to-right">
                        <i class="bi bi-credit-card me-2"></i>Tiến hành thanh toán
                    </a>
                    
                    <div class="mt-3 text-center">
                        <small class="text-muted">
                            <i class="bi bi-shield-check me-1"></i>
                            Thanh toán an toàn & bảo mật
                        </small>
                    </div>
                </div>
            </div>
            
            <!-- Features -->
            <div class="mt-3">
                <div class="row g-2 text-center">
                    <div class="col-4">
                        <div class="p-2">
                            <i class="bi bi-truck fs-3 text-primary d-block mb-1"></i>
                            <small>Miễn phí vận chuyển</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2">
                            <i class="bi bi-arrow-repeat fs-3 text-primary d-block mb-1"></i>
                            <small>Đổi trả 7 ngày</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2">
                            <i class="bi bi-headset fs-3 text-primary d-block mb-1"></i>
                            <small>Hỗ trợ 24/7</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg" style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1);">
                <div class="card-body text-center py-5">
                    <div id="empty-cart-animation" style="width: 300px; height: 300px; margin: 0 auto;"></div>
                    <h4 class="mb-3">Giỏ hàng của bạn đang trống</h4>
                    <p class="text-muted mb-4">Hãy khám phá các sản phẩm tuyệt vời của chúng tôi!</p>
                    <a href="/Product" class="btn btn-primary btn-lg hvr-float">
                        <i class="bi bi-bag-plus me-2"></i>Bắt đầu mua sắm
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
// Lottie animation for empty cart
<?php if(empty($cart)): ?>
lottie.loadAnimation({
    container: document.getElementById('empty-cart-animation'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: 'https://assets3.lottiefiles.com/packages/lf20_ysrn2iwp.json'
});
<?php endif; ?>

// Update quantity
document.querySelectorAll('.btn-minus, .btn-plus').forEach(btn => {
    btn.addEventListener('click', function() {
        const input = this.parentElement.querySelector('.quantity-input');
        const currentValue = parseInt(input.value);
        
        if (this.classList.contains('btn-minus') && currentValue > 1) {
            input.value = currentValue - 1;
        } else if (this.classList.contains('btn-plus') && currentValue < 99) {
            input.value = currentValue + 1;
        }
        
        updateCart(input);
    });
});

document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function() {
        if (this.value < 1) this.value = 1;
        if (this.value > 99) this.value = 99;
        updateCart(this);
    });
});

function updateCart(input) {
    const row = input.closest('tr');
    const id = row.dataset.id;
    const quantity = parseInt(input.value);
    const price = parseInt(row.querySelector('.price').textContent.replace(/[^\d]/g, ''));
    const subtotal = price * quantity;
    
    // Update subtotal
    row.querySelector('.subtotal').textContent = new Intl.NumberFormat('vi-VN').format(subtotal) + 'đ';
    
    // Update total
    updateTotal();
    
    // TODO: Send AJAX request to update session cart
}

function updateTotal() {
    let total = 0;
    document.querySelectorAll('.subtotal').forEach(el => {
        total += parseInt(el.textContent.replace(/[^\d]/g, ''));
    });
    
    document.getElementById('subtotal').textContent = new Intl.NumberFormat('vi-VN').format(total) + 'đ';
    document.getElementById('total').textContent = new Intl.NumberFormat('vi-VN').format(total) + 'đ';
}

// Remove item
document.querySelectorAll('.btn-remove').forEach(btn => {
    btn.addEventListener('click', function() {
        const row = this.closest('tr');
        
        Swal.fire({
            title: 'Xóa sản phẩm?',
            text: "Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy',
            background: 'var(--card-bg)',
            color: 'var(--text-light)'
        }).then((result) => {
            if (result.isConfirmed) {
                // Animate removal
                anime({
                    targets: row,
                    translateX: [0, -100],
                    opacity: [1, 0],
                    duration: 500,
                    easing: 'easeInOutQuad',
                    complete: function() {
                        row.remove();
                        updateTotal();
                        // TODO: Send AJAX request to remove from session
                    }
                });
            }
        });
    });
});

// Clear cart
function clearCart() {
    Swal.fire({
        title: 'Xóa toàn bộ giỏ hàng?',
        text: "Tất cả sản phẩm sẽ bị xóa khỏi giỏ hàng!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Xóa tất cả',
        cancelButtonText: 'Hủy',
        background: 'var(--card-bg)',
        color: 'var(--text-light)'
    }).then((result) => {
        if (result.isConfirmed) {
            // TODO: Clear cart via AJAX
            location.reload();
        }
    });
}
</script>

<?php include 'app/views/shares/footer.php'; ?>