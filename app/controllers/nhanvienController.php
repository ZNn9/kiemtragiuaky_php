<?php
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../models/nhanvienModel.php');
require_once(__DIR__ . '/../models/phongbanModel.php');

class NhanVienController
{
    private $nhanvienModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->nhanvienModel = new NhanVienModel($this->db);
    }

    // public function index()
    // {
    //     $danhsachnhanvien = $this->nhanvienModel->getDanhSachNhanVien();
    //     include __DIR__ . '/../views/nhanvien/list.php';
    // }

    public function index()
    {
        $limit = 5; // Số nhân viên mỗi trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $limit;

        $danhsachnhanvien = $this->nhanvienModel->getDanhSachNhanVienPhanTrang($limit, $offset);
        $tongSoNhanVien = $this->nhanvienModel->getTongSoNhanVien();
        $totalPages = ceil($tongSoNhanVien / $limit);

        include __DIR__ . '/../views/nhanvien/list.php';
    }


    public function show($Ma_NV)
    {
        $nhanvien = $this->nhanvienModel->getNhanVienById($Ma_NV);

        if ($nhanvien) {
            include __DIR__ . '/../views/nhanvien/show.php';
        } else {
            echo "Không thấy nhân viên.";
        }
    }

    public function add()
    {
        $danhsachphongban = (new PhongBanModel($this->db))->getDanhSachPhongBan();
        include_once __DIR__ . '/../views/nhanvien/add.php';
    }

// Lưu nhân viên mới
    public function save()
    {
        $errorMessage = '';
        // $imagePath = '';

        // Kiểm tra image nếu có
        // if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        //     $uploadResult = $this->handleImageUpload($_FILES['image']);
        //     if ($uploadResult['status']) {
        //         $imagePath = $uploadResult['path'];
        //     } else {
        //         $errorMessage = $uploadResult['message'];
        //     }
        // } else {
        //     $errorMessage = "Vui lòng chọn ảnh nhân viên.";
        // }

        // Nếu không có lỗi, tiến hành lưu
        if (empty($errorMessage)) {
            $Ma_NV = $_POST['Ma_NV'];
            $Ten_NV = $_POST['Ten_NV'];
            $Phai = $_POST['Phai'];
            $Noi_Sinh = $_POST['Noi_Sinh'];
            $Ma_Phong = $_POST['Ma_Phong'];
            $Luong = $_POST['Luong'];

            $this->nhanvienModel->addNhanVien($Ma_NV, $Ten_NV, $Phai, $Noi_Sinh, $Ma_Phong, $Luong);

            header("Location: /kiemtragiuaky/nhanvien/index");
            exit();
        } else {
            include './views/nhanvien/create.php';
            echo "<p style='color:red;'>$errorMessage</p>";
        }
    }


    public function edit($Ma_NV)
    {
        $nhanvien = $this->nhanvienModel->getNhanVienById($Ma_NV);
        $danhsachphongban = (new PhongBanModel($this->db))->getDanhSachPhongBan();

        if ($nhanvien) {
            include __DIR__ . '/../views/nhanvien/edit.php';
        } else {
            echo "Không thấy nhân viên.";
        }
    }

    // Cập nhật nhân viên
    public function update($Ma_NV)
    {
        $errorMessage = '';

        // Lấy dữ liệu hiện tại
        $nhanvien = $this->nhanvienModel->getNhanVienById($Ma_NV);
        // $imagePath = $nhanvien->image; // Giữ ảnh cũ nếu không upload mới

        // Nếu upload ảnh mới
        // if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        //     $uploadResult = $this->handleImageUpload($_FILES['image']);
        //     if ($uploadResult['status']) {
        //         $imagePath = $uploadResult['path'];
        //     } else {
        //         $errorMessage = $uploadResult['message'];
        //     }
        // }

        // Cập nhật dữ liệu
        if (empty($errorMessage)) {
            $Ten_NV = $_POST['Ten_NV'];
            $Phai = $_POST['Phai'];
            $Noi_Sinh = $_POST['Noi_Sinh'];
            $Ma_Phong = $_POST['Ma_Phong'];
            $Luong = $_POST['Luong'];

            $this->nhanvienModel->updateNhanVien($Ma_NV, $Ten_NV, $Phai, $Noi_Sinh, $Ma_Phong, $Luong);

            header("Location: /kiemtragiuaky/nhanvien/index");
            exit();
        } else {
            include './views/phongban/edit.php';
            echo "<p style='color:red;'>$errorMessage</p>";
        }
    }

    public function delete($Ma_NV)
    {
        if ($this->nhanvienModel->deleteNhanVien($Ma_NV)) {
            header('Location: /kiemtragiuaky');
        } else {
            echo "Đã xảy ra lỗi khi xóa nhân viên.";
        }
    }
    // Xử lý upload image chung cho save & update
    private function handleImageUpload($file)
    {
        $fileTmpPath = $file['tmp_Ten_NV'];
        $fileName = $file['Ten_NV'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $fileTmpPath);
            finfo_close($finfo);

            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($mime, $allowedMimes)) {
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = './assets/images/';
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    return [
                        'status' => true,
                        'path' => '/kiemtragiuaky/assets/images/' . $newFileName
                    ];
                } else {
                    return [
                        'status' => false,
                        'message' => "Lỗi khi upload file."
                    ];
                }
            } else {
                return [
                    'status' => false,
                    'message' => "File không đúng định dạng ảnh hợp lệ."
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => "Chỉ cho phép file ảnh (jpg, jpeg, png, gif)."
            ];
        }
    }
}
?>