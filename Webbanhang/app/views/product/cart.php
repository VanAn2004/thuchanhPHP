<?php include 'app/views/shares/header.php'; ?>

<h1>Giỏ hàng</h1>

<?php if (!empty($cart)): ?>
    <form method="post" action="/webbanhang/Product/checkout" id="cart-form">
        <ul class="list-group">
            <?php foreach ($cart as $id => $item): ?>
                <li class="list-group-item">
                    <input type="checkbox" name="selected[]" value="<?= $id ?>" class="select-product" checked>
                    <strong><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?></strong><br>

                    <?php if (!empty($item['image'])): ?>
                        <img src="/webbanhang/<?= htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') ?>" 
                             alt="Ảnh" style="max-width: 100px;">
                    <?php endif; ?>

                    <p>Giá: <?= number_format($item['price'], 0, ',', '.') ?> VND</p>

                    <!-- Tăng/giảm bằng JS -->
                    <div class="d-inline-flex align-items-center mt-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                onclick="updateQuantity('<?= $id ?>', 'decrease')">−</button>

                        <input type="text" value="<?= $item['quantity'] ?>" readonly 
                               class="form-control mx-2 text-center" style="width: 60px;">

                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                onclick="updateQuantity('<?= $id ?>', 'increase')">+</button>

                        <a href="/webbanhang/Product/deleteFromCart/<?= $id ?>" 
                           class="btn btn-sm btn-danger ml-3"
                           onclick="return confirm('Xóa sản phẩm này khỏi giỏ hàng?');">Xóa</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="mt-4 text-right">
            <h4>Tạm tính: <span id="total-price" class="text-danger">0 VND</span></h4>
            <small class="text-muted">Chưa gồm chiết khấu hoặc thuế (nếu có)</small>
        </div>

        <div class="mt-3 text-right">
            <a href="/webbanhang/Product" class="btn btn-secondary">Tiếp tục mua sắm</a>
            <button type="submit" class="btn btn-danger">Mua ngay</button>
        </div>
    </form>

    <!-- JS gửi POST tăng/giảm -->
    <form id="update-form" method="post" action="/webbanhang/Product/updateQuantity" style="display: none;">
        <input type="hidden" name="product_id" id="update-product-id">
        <input type="hidden" name="action" id="update-action">
    </form>

    <script>
        function updateQuantity(productId, action) {
            document.getElementById('update-product-id').value = productId;
            document.getElementById('update-action').value = action;
            document.getElementById('update-form').submit();
        }

        // Tính tổng động
        const checkboxes = document.querySelectorAll('.select-product');
        const totalElement = document.getElementById('total-price');

        function updateTotal() {
            let total = 0;
            <?php foreach ($cart as $id => $item): ?>
                const cb<?= $id ?> = document.querySelector('input[value="<?= $id ?>"].select-product');
                if (cb<?= $id ?> && cb<?= $id ?>.checked) {
                    total += <?= $item['price'] * $item['quantity'] ?>;
                }
            <?php endforeach; ?>
            totalElement.innerText = total.toLocaleString('vi-VN') + " VND";
        }

        checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
        window.addEventListener('DOMContentLoaded', updateTotal);
    </script>
<?php else: ?>
    <p>Giỏ hàng của bạn đang trống.</p>
<?php endif; ?>

<?php include 'app/views/shares/footer.php'; ?>
