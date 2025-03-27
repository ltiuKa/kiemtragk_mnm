<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>QL Nhân Sự</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://plus.unsplash.com/premium_photo-1672201106204-58e9af7a2888?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Z3JhZGllbnQlMjBiYWNrZ3JvdW5kfGVufDB8fDB8fHww') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border-radius: 20px;
            padding: 30px;
            margin-top: 40px;
            color: #fff;
        }
        label, h3, .form-label, .form-control, .form-select {
            color: white;
        }
        .form-control, .form-select {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
        }
        .form-control::placeholder {
            color: rgba(255,255,255,0.7);
        }
        footer {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            color: #fff;
            padding: 15px 0;
            text-align: center;
            border-top: 1px solid rgba(255,255,255,0.2);
            margin-top: 40px;
        }
    </style>
</head>
<body>
<div class="container">
<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
if (isset($_SESSION['toast'])): ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
      <div class="toast align-items-center text-bg-<?= $_SESSION['toast']['type'] ?> border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            <?= $_SESSION['toast']['message'] ?>
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>
    <script>
        const toastElList = [].slice.call(document.querySelectorAll('.toast'))
        toastElList.map(function (toastEl) {
          return new bootstrap.Toast(toastEl).show()
        });
    </script>
<?php unset($_SESSION['toast']); endif; ?>

<footer>
    <div class="container">
        <p class="mb-0">&copy; <?= date('Y') ?> Quản Lý Nhân Sự.✨</p>
    </div>
</footer>
</body>
</html>
