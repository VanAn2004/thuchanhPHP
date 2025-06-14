<?php 
class AccountModel 
{ 
    private $conn; 
    private $table_name = "account"; 
    private $reset_table = "password_resets";
    
    public function __construct($db) 
    { 
        $this->conn = $db; 
    } 
    
    public function getAccountByUsername($username) 
    { 
        $query = "SELECT * FROM account WHERE username = :username"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':username', $username, PDO::PARAM_STR); 
        $stmt->execute(); 
        $result = $stmt->fetch(PDO::FETCH_OBJ); 
        return $result; 
    }

    public function getAccountByEmail($email) 
    { 
        $query = "SELECT * FROM account WHERE email = :email"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); 
        $stmt->execute(); 
        $result = $stmt->fetch(PDO::FETCH_OBJ); 
        return $result; 
    }
 
    function save($username, $name, $email, $password, $role="user"){ 
 
        $query = "INSERT INTO " . $this->table_name . "(username, fullname, email, password, role) 
VALUES (:username, :fullname, :email, :password, :role)"; 
         
        $stmt = $this->conn->prepare($query); 
 
        // Làm sạch dữ liệu 
        $name = htmlspecialchars(strip_tags($name)); 
        $username = htmlspecialchars(strip_tags($username)); 
        $email = htmlspecialchars(strip_tags($email));
 
        // Gán dữ liệu vào câu lệnh 
        $stmt->bindParam(':username', $username); 
        $stmt->bindParam(':fullname', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); 
        $stmt->bindParam(':role', $role); 
 
        // Thực thi câu lệnh 
        if ($stmt->execute()) { 
            return true; 
        } 
 
        return false; 
    }

    // Lưu token reset password
    public function saveResetToken($userId, $token, $expiry) {
        // Xóa token cũ của user này trước
        $deleteQuery = "DELETE FROM " . $this->reset_table . " WHERE user_id = :user_id";
        $deleteStmt = $this->conn->prepare($deleteQuery);
        $deleteStmt->bindParam(':user_id', $userId);
        $deleteStmt->execute();

        // Thêm token mới
        $query = "INSERT INTO " . $this->reset_table . " (user_id, token, expiry) VALUES (:user_id, :token, :expiry)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expiry', $expiry);
        
        return $stmt->execute();
    }

    // Lấy thông tin reset token
    public function getResetToken($token) {
        $query = "SELECT * FROM " . $this->reset_table . " WHERE token = :token";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Cập nhật mật khẩu
    public function updatePassword($userId, $newPassword) {
        $query = "UPDATE " . $this->table_name . " SET password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':password', $newPassword);
        $stmt->bindParam(':id', $userId);
        
        return $stmt->execute();
    }

    // Xóa token reset password
    public function deleteResetToken($token) {
        $query = "DELETE FROM " . $this->reset_table . " WHERE token = :token";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':token', $token);
        
        return $stmt->execute();
    }
}