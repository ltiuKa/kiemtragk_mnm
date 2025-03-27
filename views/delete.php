<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['toast'] = [
        'type' => 'danger',
        'message' => 'Bạn không có quyền xoá nhân viên!'
    ];
    header("Location: ../controllers/nhanvienController.php");
    exit;
}

include_once '../models/NhanVien.php';

if (!isset($_GET['id'])) {
    $_SESSION['toast'] = [
        'type' => 'warning',
        'message' => 'Thiếu mã nhân viên cần xoá.'
    ];
    header("Location: ../controllers/nhanvienController.php");
    exit;
}

$ma_nv = $_GET['id'];

if (deleteNhanVien($ma_nv)) {
    $_SESSION['toast'] = [
        'type' => 'success',
        'message' => 'Xoá nhân viên thành công!'
    ];
    header("Location: ../controllers/nhanvienController.php");
    exit;
} else {
    $_SESSION['toast'] = [
        'type' => 'danger',
        'message' => 'Xoá thất bại hoặc mã nhân viên không tồn tại.'
    ];
    header("Location: ../controllers/nhanvienController.php");
    exit;
}
?>
