<?php
session_start();
include '../includes/header.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login_form.php");
    exit;
}

include_once '../models/NhanVien.php';

// Phân trang
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 5;

$listNV = getNhanVienByPage($page, $limit);
$totalPages = ceil(getTotalNhanVien() / $limit);
include '../views/list.php';
?>
