<?php
// File: app/views/account/forgot_password.php
?>
<style>
    body {
        background: linear-gradient(to right, #e0f2f7, #c1e7f3);
    }

    .auth-card {
        background-color: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 40px;
        max-width: 500px;
        width: 100%;
        text-align: center;
        margin-top: 50px;
        margin-bottom: 50px;
    }

    .auth-card .user-icon-circle {
        width: 80px;
        height: 80px;
        background-color: #e0f2f7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: -80px auto 20px auto;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .auth-card .user-icon-circle svg {
        color: #888;
        width: 40px;
        height: 40px;
    }

    .auth-card h1 {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 30px;
    }

    .form-control.form-control-lg {
        border-radius: 10px;
        height: 50px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding-left: 45px;
    }
    
    .form-group-with-icon {
        position: relative;
        margin-bottom: 20px;
    }

    .form-group-with-icon .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        font-size: 1.2rem;
    }

    .btn-action {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 50px;
        padding: 12px 20px;
        font-size: 1.1em;
        font-weight: bold;
        width: 100%;
        margin-top: 20px;
        color: white;
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        transition: all 0.3s ease;
    }

    .btn-action:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.4);
        transform: translateY(-2px);
    }

    .bottom-link-section {
        margin-top: 20px;
        font-size: 0.95em;
        color: #666;
    }

    .bottom-link-section a {
        color: #007bff;
        font-weight: bold;
        text-decoration: none;
    }

    .bottom-link-section a:hover {
        text-decoration: underline;
    }

    .error-message {
        color: #dc3545;
        font-size: 0.9em;
        margin-top: 5px;
        text-align: left;
    }

    .success-message {
        color: #28a745;
        font-size: 0.9em;
        margin-bottom: 20px;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        padding: 10px;
    }
</style>

<?php include 'app/views/shares/header.php'; ?> 

<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: calc(100vh - 56px);">
    <div class="auth-card">
        <div class="user-icon-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
            </svg>
        </div>

        <h1>Quên mật khẩu</h1>
        <p class="text-secondary mb-4">Nhập email để nhận link đặt lại mật khẩu!</p>

        <?php if (isset($success)): ?>
            <div class="success-message">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form action="/webbanhang/account/send-reset-email" method="post"> 
            <div class="form-group-with-icon"> 
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                </svg>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email của bạn" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" /> 
                <?php if (isset($errors['email'])): ?>
                    <div class="error-message"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div> 
            
            <button class="btn btn-action" type="submit">Gửi link reset</button> 
            
            <div class="bottom-link-section"> 
                <p class="mb-0">Nhớ lại mật khẩu? 
                    <a href="/webbanhang/account/login">Đăng nhập</a> 
                </p> 
            </div> 
        </form> 
    </div> 
</div> 
      
<?php include 'app/views/shares/footer.php'; ?>