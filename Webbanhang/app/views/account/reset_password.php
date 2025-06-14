<?php
// File: app/views/account/reset_password.php
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

    .general-error {
        color: #dc3545;
        font-size: 0.9em;
        margin-bottom: 20px;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
        padding: 10px;
    }
</style>

<?php include 'app/views/shares/header.php'; ?> 

<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: calc(100vh - 56px);">
    <div class="auth-card">
        <div class="user-icon-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-shield-lock-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5z"/>
            </svg>
        </div>

        <h1>Đặt lại mật khẩu</h1>
        <p class="text-secondary mb-4">Nhập mật khẩu mới cho tài khoản của bạn!</p>

        <?php if (isset($errors['token']) || isset($errors['general'])): ?>
            <div class="general-error">
                <?php echo $errors['token'] ?? $errors['general']; ?>
            </div>
        <?php endif; ?>

        <form action="/webbanhang/account/process-reset-password" method="post"> 
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">
            
            <div class="form-group-with-icon"> 
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 0-2 2v4H5a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H10V3a2 2 0 0 0-2-2"/>
                </svg>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu mới" /> 
                <?php if (isset($errors['password'])): ?>
                    <div class="error-message"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
            </div> 

            <div class="form-group-with-icon"> 
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 0-2 2v4H5a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H10V3a2 2 0 0 0-2-2"/>
                </svg>
                <input type="password" name="confirm_password" class="form-control form-control-lg" placeholder="Xác nhận mật khẩu" /> 
                <?php if (isset($errors['confirm_password'])): ?>
                    <div class="error-message"><?php echo $errors['confirm_password']; ?></div>
                <?php endif; ?>
            </div> 
            
            <button class="btn btn-action" type="submit">Đặt lại mật khẩu</button> 
            
            <div class="bottom-link-section"> 
                <p class="mb-0">Nhớ lại mật khẩu? 
                    <a href="/webbanhang/account/login">Đăng nhập</a> 
                </p> 
            </div> 
        </form> 
    </div> 
</div> 
      
<?php include 'app/views/shares/footer.php'; ?>