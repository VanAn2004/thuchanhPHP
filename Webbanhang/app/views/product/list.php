<?php include 'app/views/shares/header.php'; ?>

<div class="container my-4">
    <h1 class="mb-4">Danh sách sản phẩm</h1>
    <a href="/webbanhang/Product/add" class="btn btn-success mb-4">Thêm sản phẩm mới</a>

    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <?php if (!empty($product->image)): ?>
                        <img src="/webbanhang/<?php echo htmlspecialchars($product->image); ?>" 
                             class="card-img-top" alt="Ảnh sản phẩm" 
                             style="height: 220px; object-fit: cover;">
                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary" style="min-height: 48px;">
                            <?php echo htmlspecialchars($product->name); ?>
                        </h5>
                        <p class="card-text small text-muted" style="min-height: 40px;">
                            <?php echo htmlspecialchars($product->description); ?>
                        </p>
                        <p class="text-danger font-weight-bold mb-1">
                            <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                        </p>
                        <p class="text-muted mb-2">Danh mục: <?php echo htmlspecialchars($product->category_name); ?></p>

                        <div class="mt-auto">
                            <div class="btn-group w-100" role="group">
                                <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                                <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" 
                                   class="btn btn-primary btn-sm">Thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
