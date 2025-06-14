<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentUrl = $_SERVER['REQUEST_URI'];
$isAuthPage = strpos($currentUrl, '/account/login') !== false 
           || strpos($currentUrl, '/account/register') !== false
           || strpos($currentUrl, '/account/forgot-password') !== false;
?>

<?php if (!$isAuthPage): ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý sản phẩm</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    .main-header {
      background: linear-gradient(to right, #e2e8f0, #cbd5e0);
      color: #333;
      padding: 12px 0;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .header-section {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
    }
    .logo-nav {
      display: flex;
      align-items: center;
      gap: 30px;
    }
    .logo-section {
      font-size: 20px;
      font-weight: bold;
      color: #2d3748;
      text-decoration: none;
    }
    .logo-section:hover {
      color: #1a202c;
    }
    .nav-link-custom {
      color: #4a5568;
      font-weight: 500;
    }
    .nav-link-custom:hover {
      color: #2d3748;
      text-decoration: none;
    }
    .header-actions {
      display: flex;
      align-items: center;
      gap: 25px;
    }
    .cart-badge {
      background-color: #4a5568;
      color: white;
      border-radius: 50%;
      padding: 2px 6px;
      font-size: 11px;
      font-weight: bold;
      margin-left: 4px;
    }
    .dropdown-menu .dropdown-item:hover {
      background-color: #a0aec0;
      color: white;
    }
    .user-avatar {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background-color: #cbd5e0;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-right: 6px;
    }
  </style>
</head>
<body>

<header class="main-header">
  <div class="header-section">
    <div class="logo-nav">
      <a href="/webbanhang" class="logo-section">
        <i class="fas fa-store mr-2"></i>
        Cửa hàng điện tử
      </a>
      <div class="nav d-flex align-items-center gap-3">
        <div class="dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle" href="#" id="productDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-box"></i> Quản lý sản phẩm
          </a>
          <div class="dropdown-menu" aria-labelledby="productDropdown">
            <a class="dropdown-item" href="/webbanhang/Product/">Danh sách sản phẩm</a>
            <a class="dropdown-item" href="/webbanhang/Product/add">Thêm sản phẩm</a>
          </div>
        </div>

        <div class="dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle" href="#" id="categoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-tags"></i> Quản lý phân loại
          </a>
          <div class="dropdown-menu" aria-labelledby="categoryDropdown">
            <a class="dropdown-item" href="/webbanhang/Category">Danh sách phân loại</a>
            <a class="dropdown-item" href="/webbanhang/Category/add">Thêm phân loại</a>
          </div>
        </div>
      </div>
    </div>

    <div class="header-actions">
      <a href="/webbanhang/Product/cart" class="nav-link nav-link-custom">
        <i class="fas fa-shopping-bag"></i>
        Giỏ hàng 
        <span class="cart-badge">
  <?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0; ?>
</span>

      </a>

      <?php if (!isset($_SESSION['user'])): ?>
        <a href="/webbanhang/account/login" class="nav-link nav-link-custom">
          <i class="fas fa-user"></i> Đăng nhập
        </a>
      <?php else: ?>
        <div class="dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
            <span class="user-avatar"><i class="fas fa-user"></i></span>
            <?php echo htmlspecialchars($_SESSION['user']['username']); ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="/webbanhang/account/profile">
              <i class="fas fa-user-circle mr-2"></i>Thông tin cá nhân
            </a>
            <a class="dropdown-item" href="/webbanhang/account/orders">
              <i class="fas fa-list-alt mr-2"></i>Đơn hàng của tôi
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/webbanhang/account/logout">
              <i class="fas fa-sign-out-alt mr-2"></i>Đăng xuất
            </a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</header>

<div class="container mt-4">
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
  $('.dropdown-toggle').dropdown();
});
</script>
