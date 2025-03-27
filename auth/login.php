<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM USERS WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Dùng password_verify nếu mật khẩu được hash
        if (password_verify($password, $user['password']) || $user['password'] === md5($password)) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['fullname'] = $user['fullname'];

            header("Location: ../controllers/nhanvienController.php");
            exit;
        } else {
            echo "<script>alert('Sai mật khẩu'); history.back();</script>";
        }
    } else {
        echo "<script>alert('Tài khoản không tồn tại'); history.back();</script>";
    }
}
?>
