<?php
class NhanVienModel
{
    private $conn;
    private $tableName = "nhanvien";
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getDanhSachNhanVien()
    {
        $query = "SELECT nv.Ma_NV, nv.Ten_NV, nv.Phai, nv.Noi_Sinh, pb.Ten_Phong as PhongBan_Ten, nv.Luong
                  FROM " . $this->tableName . " nv
                  LEFT JOIN phongban pb ON nv.Ma_Phong = pb.Ma_Phong";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getDanhSachNhanVienPhanTrang($limit, $offset)
    {
        $query = "SELECT nv.Ma_NV, nv.Ten_NV, nv.Phai, nv.Noi_Sinh, pb.Ten_Phong as PhongBan_Ten, nv.Luong
                  FROM " . $this->tableName . " nv
                  LEFT JOIN phongban pb ON nv.Ma_Phong = pb.Ma_Phong
                  LIMIT :limit OFFSET :offset";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function getTongSoNhanVien()
    {
        $query = "SELECT COUNT(*) as total FROM nhanvien";
        $stmt = $this->conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->total;
    }
    
    public function getNhanVienById($Ma_NV)
    {
        $query = "SELECT nv.Ma_NV, nv.Ten_NV, nv.Phai, nv.Noi_Sinh, pb.Ten_Phong as PhongBan_Ten, nv.Luong
                  FROM " . $this->tableName . " nv
                  LEFT JOIN phongban pb ON nv.Ma_Phong = pb.Ma_Phong
                  WHERE nv.Ma_NV = :Ma_NV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Ma_NV', $Ma_NV);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    

    public function addNhanVien($Ma_NV, $Ten_NV, $Phai, $Noi_Sinh, $Ma_Phong, $Luong)
    {
        $errors = [];
        if (empty($Ma_NV)) {
            $errors['Ma_NV'] = 'Tên không được để trống';
        }
        if (empty($Ten_NV)) {
            $errors['Ten_NV'] = 'Tên không được để trống';
        }
        if (count($errors) > 0) {
            return $errors;
        }

        $query = "INSERT INTO " . $this->tableName . " (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) 
              VALUES (:Ma_NV, :Ten_NV, :Phai, :Noi_Sinh, :Ma_Phong ,:Luong)";
        $stmt = $this->conn->prepare($query);

        $Ma_NV = htmlspecialchars(strip_tags($Ma_NV));
        $Ten_NV = htmlspecialchars(strip_tags($Ten_NV));
        $Phai = htmlspecialchars(strip_tags($Phai));
        $Noi_Sinh = htmlspecialchars(strip_tags($Noi_Sinh));
        $Ma_Phong = htmlspecialchars(strip_tags($Ma_Phong));
        $Luong = htmlspecialchars(strip_tags($Luong));

        $stmt->bindParam(':Ma_NV', $Ma_NV);
        $stmt->bindParam(':Ten_NV', $Ten_NV);
        $stmt->bindParam(':Phai', $Phai);
        $stmt->bindParam(':Noi_Sinh', $Noi_Sinh);
        $stmt->bindParam(':Ma_Phong', $Ma_Phong);
        $stmt->bindParam(':Luong', $Luong);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function updateNhanVien($Ma_NV, $Ten_NV, $Phai, $Noi_Sinh, $Ma_Phong, $Luong)
    {
        $query = "UPDATE " . $this->tableName . " SET Ten_NV=:Ten_NV, Phai=:Phai, Noi_Sinh=:Noi_Sinh, Ma_Phong=:Ma_Phong, Luong=:Luong WHERE Ma_NV=:Ma_NV";
        $stmt = $this->conn->prepare($query);

        $Ten_NV = htmlspecialchars(strip_tags($Ten_NV));
        $Phai = htmlspecialchars(strip_tags($Phai));
        $Noi_Sinh = htmlspecialchars(strip_tags($Noi_Sinh));
        $Ma_Phong = htmlspecialchars(strip_tags($Ma_Phong));
        $Luong = htmlspecialchars(strip_tags($Luong));

        $stmt->bindParam(':Ma_NV', $Ma_NV);
        $stmt->bindParam(':Ten_NV', $Ten_NV);
        $stmt->bindParam(':Phai', $Phai);
        $stmt->bindParam(':Noi_Sinh', $Noi_Sinh);
        $stmt->bindParam('Ma_Phong', $Ma_Phong);
        $stmt->bindParam(':Luong', $Luong);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteNhanVien($Ma_NV)
    {
        $query = "DELETE FROM " . $this->tableName . " WHERE Ma_NV=:Ma_NV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Ma_NV', $Ma_NV);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }



}
