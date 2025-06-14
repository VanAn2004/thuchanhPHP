<?php 
require_once('app/config/database.php'); 
require_once('app/models/AccountModel.php'); 
class AccountController { 
    private $accountModel; 
    private $db; 
    public function __construct() { 
        $this->db = (new Database())->getConnection(); 
        $this->accountModel = new AccountModel($this->db); 
    } 
 
    function register(){ 
        include_once 'app/views/account/register.php'; 
    } 

    public function login() {
        require_once 'app/views/account/login.php';
    }

 
    function save(){ 
         
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $username = $_POST['username'] ?? ''; 
            $fullName = $_POST['fullname'] ?? ''; 
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? ''; 
            $confirmPassword = $_POST['confirmpassword'] ?? ''; 
 
            $errors =[]; 
            if(empty($username)){ 
                $errors['username'] = "Vui long nhap userName!"; 
            } 
            if(empty($fullName)){ 
                $errors['fullname'] = "Vui long nhap fullName!"; 
            }
            if(empty($email)){ 
                $errors['email'] = "Vui long nhap email!"; 
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email không hợp lệ!";
            }
            if(empty($password)){ 
                $errors['password'] = "Vui long nhap password!"; 
            } 
            if($password != $confirmPassword){ 
                $errors['confirmPass'] = "Mat khau va xac nhan chua dung"; 
            } 
            //kiểm tra username đã được đăng ký chưa? 
            $account = $this->accountModel->getAccountByUsername($username); 
 
            if($account){ 
                $errors['account'] = "Tai khoan nay da co nguoi dang ky!"; 
            }

            // Kiểm tra email đã được đăng ký chưa?
            $emailExists = $this->accountModel->getAccountByEmail($email);
            if($emailExists){
                $errors['email'] = "Email nay da duoc dang ky!";
            }
             
            if(count($errors) > 0){ 
                include_once 'app/views/account/register.php'; 
            }else{ 
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]); 
                $result = $this->accountModel->save($username, $fullName, $email, $password); 
                 
                if($result){ 
                    header('Location: /webbanhang/account/login'); 
                } 
            } 
        }        
        
    } 
    function logout() {
    session_start();           // Đảm bảo session đã bắt đầu
    session_unset();           // Xóa tất cả biến session
    session_destroy();         // Hủy toàn bộ session

    header('Location: /webbanhang/Product'); // Quay lại trang login
    exit;
}

    public function checkLogin() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $account = $this->accountModel->getAccountByUserName($username);
        if ($account) {
            $pwd_hashed = $account->password;
            if (password_verify($password, $pwd_hashed)) {

                session_start();

                // Thiết lập thông tin người dùng
                $_SESSION['user'] = [
                    'id' => $account->id,
                    'username' => $account->username
                ];

                header('Location: /webbanhang/product');
                exit;
            } else {
                echo "Password incorrect.";
            }
        } else {
            echo "Báo lỗi không tìm thấy tài khoản";
        }
    }
}


    // Hiển thị trang quên mật khẩu
    public function forgotPassword() {
        include_once 'app/views/account/forgot_password.php';
    }

    // Xử lý gửi email reset password
    public function sendResetEmail() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $errors = [];

            if (empty($email)) {
                $errors['email'] = "Vui lòng nhập email!";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email không hợp lệ!";
            }

            if (count($errors) == 0) {
                $account = $this->accountModel->getAccountByEmail($email);
                if ($account) {
                    // Tạo token reset password
                    $resetToken = bin2hex(random_bytes(32));
                    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token hết hạn sau 1 giờ

                    // Lưu token vào database
                    $this->accountModel->saveResetToken($account->id, $resetToken, $expiry);

                    // Gửi email
                    if ($this->sendResetPasswordEmail($email, $resetToken)) {
                        $success = "Đã gửi link reset mật khẩu đến email của bạn!";
                        include_once 'app/views/account/forgot_password.php';
                    } else {
                        $errors['email'] = "Có lỗi xảy ra khi gửi email. Vui lòng thử lại!";
                        include_once 'app/views/account/forgot_password.php';
                    }
                } else {
                    $errors['email'] = "Email không tồn tại trong hệ thống!";
                    include_once 'app/views/account/forgot_password.php';
                }
            } else {
                include_once 'app/views/account/forgot_password.php';
            }
        }
    }

    // Hiển thị trang reset password
    public function resetPassword() {
        $token = $_GET['token'] ?? '';
        if (empty($token)) {
            header('Location: /webbanhang/account/change_password');
            exit;
        }

        // Kiểm tra token có hợp lệ không
        $resetData = $this->accountModel->getResetToken($token);
        if (!$resetData || strtotime($resetData->expiry) < time()) {
            $error = "Link reset mật khẩu không hợp lệ hoặc đã hết hạn!";
            include_once 'app/views/account/login.php';
            return;
        }

        include_once 'app/views/account/reset_password.php';
    }

    // Xử lý reset password
    public function processResetPassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $token = $_POST['token'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            $errors = [];

            if (empty($password)) {
                $errors['password'] = "Vui lòng nhập mật khẩu mới!";
            }
            if ($password != $confirmPassword) {
                $errors['confirm_password'] = "Mật khẩu xác nhận không khớp!";
            }

            // Kiểm tra token
            $resetData = $this->accountModel->getResetToken($token);
            if (!$resetData || strtotime($resetData->expiry) < time()) {
                $errors['token'] = "Link reset mật khẩu không hợp lệ hoặc đã hết hạn!";
            }

            if (count($errors) == 0) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                
                // Cập nhật mật khẩu mới
                if ($this->accountModel->updatePassword($resetData->user_id, $hashedPassword)) {
                    // Xóa token đã sử dụng
                    $this->accountModel->deleteResetToken($token);
                    
                    $success = "Đặt lại mật khẩu thành công! Vui lòng đăng nhập.";
                    include_once 'app/views/account/login.php';
                } else {
                    $errors['general'] = "Có lỗi xảy ra. Vui lòng thử lại!";
                    include_once 'app/views/account/reset_password.php';
                }
            } else {
                include_once 'app/views/account/reset_password.php';
            }
        }
    }

    // Hiển thị trang đổi mật khẩu
    public function changePassword() {
        session_start();
        if (!isset($_SESSION['username'])) {
            header('Location: /webbanhang/account/login');
            exit;
        }
        include_once 'app/views/account/change_password.php';
    }

    // Xử lý đổi mật khẩu
    public function processChangePassword() {
        session_start();
        if (!isset($_SESSION['username'])) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            $errors = [];

            if (empty($currentPassword)) {
                $errors['current_password'] = "Vui lòng nhập mật khẩu hiện tại!";
            }
            if (empty($newPassword)) {
                $errors['new_password'] = "Vui lòng nhập mật khẩu mới!";
            }
            if ($newPassword != $confirmPassword) {
                $errors['confirm_password'] = "Mật khẩu xác nhận không khớp!";
            }

            if (count($errors) == 0) {
                $account = $this->accountModel->getAccountByUsername($_SESSION['username']);
                
                // Kiểm tra mật khẩu hiện tại
                if (!password_verify($currentPassword, $account->password)) {
                    $errors['current_password'] = "Mật khẩu hiện tại không đúng!";
                }
                // Kiểm tra mật khẩu mới không trùng với mật khẩu cũ
                elseif (password_verify($newPassword, $account->password)) {
                    $errors['new_password'] = "Mật khẩu mới không được trùng với mật khẩu cũ!";
                }

                if (count($errors) == 0) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]);
                    
                    if ($this->accountModel->updatePassword($account->id, $hashedPassword)) {
                        $success = "Đổi mật khẩu thành công!";
                        include_once 'app/views/account/change_password.php';
                    } else {
                        $errors['general'] = "Có lỗi xảy ra. Vui lòng thử lại!";
                        include_once 'app/views/account/change_password.php';
                    }
                } else {
                    include_once 'app/views/account/change_password.php';
                }
            } else {
                include_once 'app/views/account/change_password.php';
            }
        }
    }

    // Hàm gửi email reset password
    private function sendResetPasswordEmail($email, $token) {
        $resetLink = "http://localhost/webbanhang/account/reset-password?token=" . $token;
        
        $subject = "Reset mật khẩu - Website bán hàng";
        $message = "
        <html>
        <head>
            <title>Reset mật khẩu</title>
        </head>
        <body>
            <h2>Yêu cầu reset mật khẩu</h2>
            <p>Bạn đã yêu cầu reset mật khẩu cho tài khoản của mình.</p>
            <p>Vui lòng click vào link bên dưới để reset mật khẩu:</p>
            <p><a href='{$resetLink}'>Reset mật khẩu</a></p>
            <p>Link này sẽ hết hạn sau 1 giờ.</p>
            <p>Nếu bạn không yêu cầu reset mật khẩu, vui lòng bỏ qua email này.</p>
        </body>
        </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: noreply@webbanhang.local' . "\r\n";

        return mail($email, $subject, $message, $headers);
    }
}