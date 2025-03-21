<?php
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../models/userModel.php');

class UserController
{
    private $userModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->userModel = new userModel($this->db);
    }

    public function login()
    {
        $error = '';
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $user = $this->userModel->checkLogin($username, $password);
    
            if ($user) {
                $_SESSION['user'] = $user; // Không cần session_start() nữa
                header("Location: /kiemtragiuaky/nhanvien");
                exit;
            } else {
                $error = "Invalid username or password!";
            }
        }
    
        include __DIR__ . '/../views/user/login.php';
    }
    
    public function logout()
    {
        session_destroy();
        header("Location: /kiemtragiuaky/user/login");
        exit;
    }
    

}
?>