<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0f2f7, #c1e7f3);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
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
    .form-control.form-control-user {
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

    .forgot-password-link {
        margin-top: 15px;
        font-size: 0.9em;
    }

    .forgot-password-link a {
        color: #6c757d;
        text-decoration: none;
    }

    .forgot-password-link a:hover {
        color: #007bff;
        text-decoration: underline;
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

    .error-message {
        color: #dc3545;
        font-size: 0.9em;
        margin-bottom: 20px;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
        padding: 10px;
    }
    </style>
</head>
<body>

<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="auth-card">
        <div class="user-icon-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
        </div>

        <h1>Login</h1>
        <p class="text-secondary mb-4">Please enter your username and password!</p>

        <?php if (isset($success)): ?>
            <div class="success-message">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="/webbanhang/account/checklogin" method="post"> 
            <div class="form-group-with-icon"> 
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                </svg>
                <input type="text" name="username" class="form-control form-control-lg" placeholder="username" /> 
            </div> 

            <div class="form-group-with-icon"> 
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 0-2 2v4H5a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H10V3a2 2 0 0 0-2-2"/>
                </svg>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="password" /> 
            </div> 

            <div class="forgot-password-link">
                <a href="/webbanhang/account/forgot-password">Quên mật khẩu?</a>
            </div>
            
            <button class="btn btn-action" type="submit">Login</button> 
            
            <div class="bottom-link-section"> 
                <p class="mb-0">Don't have an account? 
                    <a href="/webbanhang/account/register">Sign Up</a> 
                </p> 
            </div> 
        </form> 
    </div> 
</div> 
</body>
</html>
      
