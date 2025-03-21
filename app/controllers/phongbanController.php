<?php
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../models/phongbanModel.php');

class PhongBanController
{
    private $phongbanModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->phongbanModel = new PhongBanModel($this->db);
    }

    // Hiển thị danh sách phòng ban
    public function index()
    {
        $danhsachphongban = $this->phongbanModel->getDanhSachPhongBan();
        include __DIR__ . '/../views/phongban/list.php';
    }

    // Hiển thị chi tiết phòng ban
    public function show($Ma_Phong)
    {
        $phongban = $this->phongbanModel->getPhongBanById($Ma_Phong);
        if ($phongban) {
            include __DIR__ . '/../views/phongban/show.php';
        } else {
            echo "Không tìm thấy phòng ban.";
        }
    }

    // Hiển thị form thêm mới
    public function add()
    {
        include __DIR__ . '/../views/phongban/add.php';
    }

    // Lưu phòng ban mới
    public function save()
    {
        $Ma_Phong = $_POST['Ma_Phong'] ?? '';
        $Ten_Phong = $_POST['Ten_Phong'] ?? '';
        
        $result = $this->phongbanModel->addPhongBan($Ma_Phong, $Ten_Phong);

        if (is_array($result)) {
            // Có lỗi, load lại form và hiển thị lỗi
            $errors = $result;
            include __DIR__ . '/../views/phongban/add.php';
        } else {
            header("Location: /kiemtragiuaky/phongban/index");
            exit();
        }
    }

    // Hiển thị form chỉnh sửa
    public function edit($Ma_Phong)
    {
        $phongban = $this->phongbanModel->getPhongBanById($Ma_Phong);
        if ($phongban) {
            include __DIR__ . '/../views/phongban/edit.php';
        } else {
            echo "Không tìm thấy phòng ban.";
        }
    }

    // Cập nhật phòng ban
    public function update($Ma_Phong)
    {
        $Ten_Phong = $_POST['Ten_Phong'] ?? '';

        $success = $this->phongbanModel->updatePhongBan($Ma_Phong, $Ten_Phong);

        if ($success) {
            header("Location: /kiemtragiuaky/phongban/index");
            exit();
        } else {
            echo "Đã xảy ra lỗi khi cập nhật phòng ban.";
        }
    }

    // Xóa phòng ban
    public function delete($Ma_Phong)
    {
        try {
            $this->phongbanModel->deletePhongBan($Ma_Phong);
            header("Location: /kiemtragiuaky/phongban/index");
        } catch (Exception $e) {
            header("Location: /kiemtragiuaky/phongban/index");
        }
    }
}
?>
