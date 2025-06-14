<?php include 'app/views/shares/header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" />

<div class="container my-4">
    <!-- Tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#">1. THÔNG TIN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">2. THANH TOÁN</a>
        </li>
    </ul>

    <!-- Sản phẩm -->
    <div class="mt-3 border p-3">
        <h5>Sản phẩm</h5>
        <?php
        $total = 0;
        if (!empty($_POST['selected']) && !empty($_SESSION['cart'])):
            foreach ($_POST['selected'] as $id):
                if (isset($_SESSION['cart'][$id])):
                    $item = $_SESSION['cart'][$id];
                    $total += $item['price'] * $item['quantity'];
        ?>
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <strong><?= htmlspecialchars($item['name']) ?></strong><br>
                            Giá: <span class="text-danger"><?= number_format($item['price'], 0, ',', '.') ?> VND</span>
                            <span class="ml-3">Số lượng: <?= $item['quantity'] ?></span>
                        </div>
                    </div>
                    <input type="hidden" name="selected[]" value="<?= $id ?>">
        <?php
                endif;
            endforeach;
        endif;
        ?>
    </div>


    <form action="/webbanhang/Product/processCheckout" method="POST">
        <!-- Giao hàng -->
        <h5>Thông tin nhận hàng</h5>
        <div class="border rounded p-3 mb-4">

            <div class="form-group">
                <label>Họ tên người nhận</label>
                <input type="text" name="receiver_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>SĐT người nhận</label>
                <input type="text" name="receiver_phone" class="form-control" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Tỉnh / Thành phố</label>
                    <select class="form-control" name="province" id="province" required>
                        <option value="">-- Chọn tỉnh --</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Quận / Huyện</label>
                    <select class="form-control" name="district" id="district" required>
                        <option value="">-- Chọn quận/huyện --</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Phường / Xã</label>
                    <select class="form-control" name="ward" id="ward">
                        <option value="">-- Chọn phường/xã --</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Số nhà, tên đường</label>
                    <input type="text" name="street" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label>Ghi chú khác (nếu có)</label>
                <textarea name="note" class="form-control" rows="2"></textarea>
            </div>
        </div>


        <!-- Tổng tiền -->
        <div class="text-right my-3">
            <h5>Tổng tiền tạm tính: <span class="text-danger"><?= number_format($total, 0, ',', '.') ?> VND</span></h5>
            <small class="text-muted">Chưa gồm chiết khấu hoặc thuế</small>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-danger">Xác nhận đơn hàng</button>
        </div>
    </form>
</div>

<script>
    const provinceSelect = document.getElementById('province');
    const districtSelect = document.getElementById('district');
    const wardSelect = document.getElementById('ward');

    // Load danh sách tỉnh/thành phố
    fetch("https://provinces.open-api.vn/api/p/")
        .then(response => response.json())
        .then(data => {
            data.forEach(province => {
                const option = document.createElement('option');
                option.value = province.code;
                option.textContent = province.name;
                provinceSelect.appendChild(option);
            });
        });

    // Khi chọn tỉnh -> load huyện
    provinceSelect.addEventListener('change', () => {
        const provinceCode = provinceSelect.value;
        districtSelect.innerHTML = '<option value="">-- Chọn quận/huyện --</option>';
        wardSelect.innerHTML = '<option value="">-- Chọn phường/xã --</option>';

        if (provinceCode) {
            fetch(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`)
                .then(response => response.json())
                .then(data => {
                    data.districts.forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.code;
                        option.textContent = district.name;
                        districtSelect.appendChild(option);
                    });
                });
        }
    });

    // Khi chọn huyện -> load xã
    districtSelect.addEventListener('change', () => {
        const districtCode = districtSelect.value;
        wardSelect.innerHTML = '<option value="">-- Chọn phường/xã --</option>';

        if (districtCode) {
            fetch(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`)
                .then(response => response.json())
                .then(data => {
                    data.wards.forEach(ward => {
                        const option = document.createElement('option');
                        option.value = ward.name;
                        option.textContent = ward.name;
                        wardSelect.appendChild(option);
                    });
                });
        }
    });
</script>


<?php include 'app/views/shares/footer.php'; ?>