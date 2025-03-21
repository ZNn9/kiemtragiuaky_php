<?php
require_once 'app/config/database.php';

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

if (file_exists($controllerPath)) {
    $controllerInstance = new $controller();

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
