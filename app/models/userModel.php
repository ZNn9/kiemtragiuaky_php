<?php
class UserModel
{
    private $conn;
    private $tableName = "user";
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function checkLogin($username, $password)
    {
        $query = "SELECT * FROM " . $this->tableName . " WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); // Hiện tại bạn lưu plain text, sau này nên dùng hash

        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }

    public function getUsers()
    {
        $query = "SELECT user.id, user.username, user.password, user.fullname, user.email, role.role_name as role_name
                  FROM " . $this->tableName . " user
                  LEFT JOIN role ON user.role_id = role.id";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    
    public function getUserById($id)
    {
        $query = "SELECT user.id, user.username, user.password, user.fullname, user.email, role.role_name as role_name
                  FROM " . $this->tableName . " user
                  LEFT JOIN role ON user.role_id = role.id
                  WHERE user.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    

    public function addUser($username, $password, $fullname, $email, $role_id)
    {
        $errors = [];
        if (empty($username)) {
            $errors['username'] = 'Tên không được để trống';
        }
        if (empty($password)) {
            $errors['password'] = 'Mật khẩu không được để trống';
        }
        if (empty($role_id)) {
            $errors['role_id'] = 'Quyền không được để trống';
        }
        if (count($errors) > 0) {
            return $errors;
        }

        $query = "INSERT INTO " . $this->tableName . " (username, password, fullname, email, role_id) 
              VALUES (:username, :password, :fullname, :email ,:role_id)";
        $stmt = $this->conn->prepare($query);

        $username = htmlspecialchars(strip_tags($username));
        $password = htmlspecialchars(strip_tags($password));
        $fullname = htmlspecialchars(strip_tags($fullname));
        $email = htmlspecialchars(strip_tags($email));
        $role_id = htmlspecialchars(strip_tags($role_id));

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role_id', $role_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function updateUser($id, $username, $password, $fullname, $email, $role_id)
    {
        $query = "UPDATE " . $this->tableName . " SET username=:username, password=:password, fullname=:fullname, email=:email, role_id=:role_id WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $username = htmlspecialchars(strip_tags($username));
        $password = htmlspecialchars(strip_tags($password));
        $fullname = htmlspecialchars(strip_tags($fullname));
        $email = htmlspecialchars(strip_tags($email));
        $role_id = htmlspecialchars(strip_tags($role_id));

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role_id', $role_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM " . $this->tableName . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
