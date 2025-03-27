<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: ../controllers/nhanvienController.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1508780709619-79562169bc64') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            width: 350px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            color: white;
        }

        .glass-card input, .glass-card button {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
        }

        .glass-card input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .glass-card button:hover {
            background: rgba(255, 255, 255, 0.4);
        }
    </style>
</head>
<body>
    <form action="login.php" method="POST" class="glass-card">
        <h3 class="text-center mb-4">🧑‍💻 Đăng Nhập</h3>
        <div class="mb-3">
            <input type="text" name="username" class="form-control" placeholder="Tài khoản" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
        </div>
        <button type="submit" class="btn btn-light w-100">Đăng nhập</button>
    </form>
</body>
</html>
