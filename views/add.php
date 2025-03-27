<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['toast'] = [
        'type' => 'danger',
        'message' => 'Bạn không có quyền thêm nhân viên!'
    ];
    header("Location: ../controllers/nhanvienController.php");
    exit;
}

include '../includes/header.php';
include_once '../models/NhanVien.php';

$departments = getDepartments();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'Ma_NV'     => $_POST['Ma_NV'],
        'Ten_NV'    => $_POST['Ten_NV'],
        'Phai'      => $_POST['Phai'],
        'Noi_Sinh'  => $_POST['Noi_Sinh'],
        'Ma_Phong'  => $_POST['Ma_Phong'],
        'Luong'     => $_POST['Luong'],
        'Role'      => $_POST['Role']
    ];

    if (addNhanVien($data)) {
        $_SESSION['toast'] = [
            'type' => 'success',
            'message' => 'Thêm nhân viên thành công!'
        ];
        header("Location: ../controllers/nhanvienController.php");
        exit;
    } else {
        $_SESSION['toast'] = [
            'type' => 'danger',
            'message' => 'Thêm nhân viên thất bại. Mã nhân viên có thể đã tồn tại.'
        ];
        header("Location: add.php");
        exit;
    }
}
?>

<div class="container">
    <h3 class="text-center">Thêm Nhân Viên</h3>
    <form method="POST" class="col-md-6 offset-md-3">
        <div class="mb-3">
            <label class="form-label">Mã Nhân Viên</label>
            <input type="text" name="Ma_NV" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tên Nhân Viên</label>
            <input type="text" name="Ten_NV" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giới tính</label>
            <select name="Phai" class="form-select" required>
                <option value="NAM">Nam</option>
                <option value="NU">Nữ</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Nơi Sinh</label>
            <input type="text" name="Noi_Sinh" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phòng</label>
            <select name="Ma_Phong" class="form-select" required>
                <?php foreach ($departments as $d): ?>
                    <option value="<?= $d['Ma_Phong'] ?>"><?= $d['Ten_Phong'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Lương</label>
            <input type="number" name="Luong" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phân quyền</label>
            <select name="Role" class="form-select" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Thêm Nhân Viên</button>
        <a href="../controllers/nhanvienController.php" class="btn btn-secondary w-100 mt-2">Quay lại</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>