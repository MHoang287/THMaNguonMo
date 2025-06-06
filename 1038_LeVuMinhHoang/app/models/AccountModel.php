<?php
class AccountModel {
    private $conn;
    private $table_name = "account";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAccountByUsername($username) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getAccountById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getAccountByEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function save($username, $fullName, $password, $phone = null, $email = null, $avatar = null, $role = 'user') {
        // Kiểm tra username đã tồn tại
        if ($this->getAccountByUsername($username)) {
            return false;
        }

        // Kiểm tra email đã tồn tại (nếu có email)
        if ($email && $this->getAccountByEmail($email)) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " SET 
                  username=:username, 
                  fullname=:fullname, 
                  phone=:phone, 
                  email=:email, 
                  avatar=:avatar, 
                  password=:password, 
                  role=:role";
        
        $stmt = $this->conn->prepare($query);

        // Sanitize dữ liệu
        $username = htmlspecialchars(strip_tags($username));
        $fullName = htmlspecialchars(strip_tags($fullName));
        $phone = $phone ? htmlspecialchars(strip_tags($phone)) : null;
        $email = $email ? htmlspecialchars(strip_tags($email)) : null;
        $avatar = $avatar ? htmlspecialchars(strip_tags($avatar)) : null;
        $password = password_hash($password, PASSWORD_BCRYPT);
        $role = htmlspecialchars(strip_tags($role));

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":fullname", $fullName);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":avatar", $avatar);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":role", $role);
        
        return $stmt->execute();
    }

    public function update($id, $username = null, $fullName = null, $phone = null, $email = null, $avatar = null, $role = null) {
        // Kiểm tra account có tồn tại không
        if (!$this->getAccountById($id)) {
            return false;
        }

        $updateFields = [];
        $params = [':id' => $id];

        if ($username !== null) {
            // Kiểm tra username mới có trung với account khác không
            $existingAccount = $this->getAccountByUsername($username);
            if ($existingAccount && $existingAccount->id != $id) {
                return false;
            }
            $updateFields[] = "username = :username";
            $params[':username'] = htmlspecialchars(strip_tags($username));
        }

        if ($fullName !== null) {
            $updateFields[] = "fullname = :fullname";
            $params[':fullname'] = htmlspecialchars(strip_tags($fullName));
        }

        if ($phone !== null) {
            $updateFields[] = "phone = :phone";
            $params[':phone'] = htmlspecialchars(strip_tags($phone));
        }

        if ($email !== null) {
            // Kiểm tra email mới có trung với account khác không
            $existingAccount = $this->getAccountByEmail($email);
            if ($existingAccount && $existingAccount->id != $id) {
                return false;
            }
            $updateFields[] = "email = :email";
            $params[':email'] = htmlspecialchars(strip_tags($email));
        }

        if ($avatar !== null) {
            $updateFields[] = "avatar = :avatar";
            $params[':avatar'] = htmlspecialchars(strip_tags($avatar));
        }

        if ($role !== null) {
            $updateFields[] = "role = :role";
            $params[':role'] = htmlspecialchars(strip_tags($role));
        }

        if (empty($updateFields)) {
            return false;
        }

        $query = "UPDATE " . $this->table_name . " SET " . implode(", ", $updateFields) . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute($params);
    }

    public function updatePassword($id, $newPassword) {
        $query = "UPDATE " . $this->table_name . " SET password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }

    public function getAllAccounts($limit = null, $offset = 0) {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        
        if ($limit) {
            $query .= " LIMIT :offset, :limit";
        }
        
        $stmt = $this->conn->prepare($query);
        
        if ($limit) {
            $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
            $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function countAccounts() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ)->total;
    }

    public function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }
}
?>