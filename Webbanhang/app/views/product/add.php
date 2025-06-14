<?php include 'app/views/shares/header.php'; ?>

<div class="container py-5">
    <h2 class="text-center text-primary font-weight-bold mb-4">Thêm sản phẩm mới</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm p-4 bg-light">
        <form method="POST" action="/webbanhang/Product/save" enctype="multipart/form-data" onsubmit="return validateForm();">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name" class="font-weight-bold">Tên sản phẩm:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nhập tên sản phẩm" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="price" class="font-weight-bold">Giá (VND):</label>
                    <input type="number" id="price" name="price" class="form-control" step="1000" placeholder="VD: 7000000" required>
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="font-weight-bold">Mô tả:</label>
                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Mô tả chi tiết về sản phẩm" required></textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="category_id" class="font-weight-bold">Danh mục:</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category->id; ?>">
                                <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="image" class="font-weight-bold">Hình ảnh:</label>
                    <input type="file" id="image" name="image" class="form-control-file">
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5">+ Thêm sản phẩm</button>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="/webbanhang/Product/" class="btn btn-outline-secondary">Quay lại danh sách</a>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>