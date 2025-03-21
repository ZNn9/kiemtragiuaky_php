<?php
require_once 'app/config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

spl_autoload_register(function ($class) {
    $path = "app/controllers/" . $class . ".php";
    if (file_exists($path)) {
        require_once $path;
    }
});

// Lấy tham số từ URL
$controller = $_GET['controller'] ?? 'nhanvien';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

// Chuyển tên controller thành PascalCase + "Controller"
$controller = ucfirst(strtolower($controller)) . 'Controller';
$controllerPath = "app/controllers/{$controller}.php";

// Danh sách các controller & action chỉ cho admin
$adminOnlyActions = [
    'NhanvienController' => ['add', 'edit', 'delete'],
    'PhongbanController' => ['add', 'edit', 'delete']
];


if (file_exists($controllerPath)) {
    $controllerInstance = new $controller();

    if (isset($adminOnlyActions[$controller]) && in_array($action, $adminOnlyActions[$controller])) {
        if (!isset($_SESSION['user']) || $_SESSION['user']->role_id !== 1) {
            echo "<h3 style='color:red; text-align:center;'>Bạn không có quyền truy cập vào chức năng này.</h3>";
            exit;
        }
    }

    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action($id);
    } else {
        http_response_code(404);
        echo "Không tìm thấy action: $action trong controller $controller";
    }
} else {
    http_response_code(404);
    echo "Không tìm thấy controller: $controller";
}
