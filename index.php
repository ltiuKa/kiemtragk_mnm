<?php
session_start();

$controllerPath = 'controllers/nhanvienController.php';
$loginPath = 'auth/login_form.php';

// Nếu chưa đăng nhập hoặc thiếu role
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    if (file_exists($loginPath)) {
        header("Location: $loginPath");
    } else {
        die("Lỗi: Không tìm thấy trang đăng nhập ($loginPath)");
    }
    exit;
}

// Nếu đã đăng nhập, điều hướng theo role
if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'user') {
    if (file_exists($controllerPath)) {
        header("Location: $controllerPath");
    } else {
        die("Lỗi: Không tìm thấy controller chính ($controllerPath)");
    }
} else {
    echo "Bạn không có quyền truy cập.";
}
exit;
?>
