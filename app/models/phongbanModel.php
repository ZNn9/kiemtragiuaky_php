<?php
class PhongBanModel
{
    private $conn;
    private $tableName = "phongban";
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getDanhSachPhongBan()
    {
        $query = "SELECT Ma_Phong, Ten_Phong FROM " . $this->tableName;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    
    public function getPhongBanById($Ma_Phong)
    {
        $query = "SELECT * FROM " . $this->tableName . " WHERE Ma_Phong = :Ma_Phong";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Ma_Phong', $Ma_Phong);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function addPhongBan($Ma_Phong, $Ten_Phong)
    {
        $errors = [];
        if (empty($Ma_Phong)) {
            $errors['Ten_Phong'] = 'Tên thể loại không được để trống';
        }
        if (empty($Ten_Phong)) {
            $errors['Ten_Phong'] = 'Tên thể loại không được để trống';
        }
        if (count($errors) > 0) {
            return $errors;
        }

        $query = "INSERT INTO " . $this->tableName . " (Ma_Phong, Ten_Phong) 
              VALUES (:Ma_Phong, :Ten_Phong)";
        $stmt = $this->conn->prepare($query);

        $Ma_Phong = htmlspecialchars(strip_tags($Ma_Phong));
        $Ten_Phong = htmlspecialchars(strip_tags($Ten_Phong));

        $stmt->bindParam(':Ma_Phong', $Ma_Phong);
        $stmt->bindParam(':Ten_Phong', $Ten_Phong);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function updatePhongBan($Ma_Phong, $Ten_Phong)
    {
        if (empty($Ma_Phong)) {
            return false;
        }
        
        $query = "UPDATE " . $this->tableName . " SET Ten_Phong=:Ten_Phong WHERE Ma_Phong=:Ma_Phong";
        $stmt = $this->conn->prepare($query);

        $Ten_Phong = htmlspecialchars(strip_tags($Ten_Phong));

        $stmt->bindParam(':Ma_Phong', $Ma_Phong);
        $stmt->bindParam(':Ten_Phong', $Ten_Phong);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deletePhongBan($Ma_Phong)
    {
        $query = "DELETE FROM " . $this->tableName . " WHERE Ma_Phong=:Ma_Phong";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Ma_Phong', $Ma_Phong);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
