<?php
include_once '../config/db.php';

// Lấy tất cả nhân viên
function getAllNhanVien() {
    global $conn;
    $sql = "SELECT n.*, p.Ten_Phong FROM Nhanvien n JOIN Phongban p ON n.Ma_Phong = p.Ma_Phong";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Lấy nhân viên theo phân trang
function getNhanVienByPage($page = 1, $limit = 5) {
    global $conn;
    $offset = ($page - 1) * $limit;
    $sql = "SELECT n.*, p.Ten_Phong FROM Nhanvien n 
            JOIN Phongban p ON n.Ma_Phong = p.Ma_Phong 
            LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Đếm tổng nhân viên
function getTotalNhanVien() {
    global $conn;
    $sql = "SELECT COUNT(*) as total FROM Nhanvien";
    $result = $conn->query($sql);
    return $result->fetch_assoc()['total'];
}

// Thêm nhân viên
function addNhanVien($data) {
    global $conn;
    $sql = "INSERT INTO Nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $data['Ma_NV'], $data['Ten_NV'], $data['Phai'], $data['Noi_Sinh'], $data['Ma_Phong'], $data['Luong']);
    return $stmt->execute();
}

// Cập nhật nhân viên
function updateNhanVien($data) {
    global $conn;
    $sql = "UPDATE Nhanvien SET Ten_NV = ?, Phai = ?, Noi_Sinh = ?, Ma_Phong = ?, Luong = ? WHERE Ma_NV = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $data['Ten_NV'], $data['Phai'], $data['Noi_Sinh'], $data['Ma_Phong'], $data['Luong'], $data['Ma_NV']);
    return $stmt->execute();
}

// Xoá nhân viên
function deleteNhanVien($Ma_NV) {
    global $conn;
    $sql = "DELETE FROM Nhanvien WHERE Ma_NV = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Ma_NV);
    return $stmt->execute();
}

// Lấy danh sách phòng ban
function getDepartments() {
    global $conn;
    $result = $conn->query("SELECT * FROM Phongban");
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
