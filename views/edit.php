<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['toast'] = [
        'type' => 'danger',
        'message' => 'Bạn không có quyền cập nhật nhân viên!'
    ];
    header("Location: ../controllers/nhanvienController.php");
    exit;
}

include '../includes/header.php';
include_once '../models/NhanVien.php';

$departments = getDepartments();

if (!isset($_GET['id'])) {
    $_SESSION['toast'] = [
        'type' => 'warning',
        'message' => 'Thiếu mã nhân viên.'
    ];
    header("Location: ../controllers/nhanvienController.php");
    exit;
}

$ma_nv = $_GET['id'];

// Lấy thông tin nhân viên hiện tại
global $conn;
$sql = "SELECT * FROM Nhanvien WHERE Ma_NV = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ma_nv);
$stmt->execute();
$result = $stmt->get_result();
$nv = $result->fetch_assoc();

if (!$nv) {
    $_SESSION['toast'] = [
        'type' => 'warning',
        'message' => 'Không tìm thấy nhân viên.'
    ];
    header("Location: ../controllers/nhanvienController.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'Ma_NV'     => $ma_nv,
        'Ten_NV'    => $_POST['Ten_NV'],
        'Phai'      => $_POST['Phai'],
        'Noi_Sinh'  => $_POST['Noi_Sinh'],
        'Ma_Phong'  => $_POST['Ma_Phong'],
        'Luong'     => $_POST['Luong']
    ];

    if (updateNhanVien($data)) {
        $_SESSION['toast'] = [
            'type' => 'success',
            'message' => 'Cập nhật nhân viên thành công!'
        ];
        header("Location: ../controllers/nhanvienController.php");
        exit;
    } else {
        $_SESSION['toast'] = [
            'type' => 'danger',
            'message' => 'Cập nhật thất bại.'
        ];
        header("Location: edit.php?id=$ma_nv");
        exit;
    }
}
?>

<div class="container">
    <h3 class="text-center">Cập Nhật Nhân Viên</h3>
    <form method="POST" class="col-md-6 offset-md-3">
        <div class="mb-3">
            <label class="form-label">Mã Nhân Viên</label>
            <input type="text" value="<?= $nv['Ma_NV'] ?>" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Tên Nhân Viên</label>
            <input type="text" name="Ten_NV" class="form-control" value="<?= $nv['Ten_NV'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giới tính</label>
            <select name="Phai" class="form-select" required>
                <option value="NAM" <?= $nv['Phai'] == 'NAM' ? 'selected' : '' ?>>Nam</option>
                <option value="NU" <?= $nv['Phai'] == 'NU' ? 'selected' : '' ?>>Nữ</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Nơi Sinh</label>
            <input type="text" name="Noi_Sinh" class="form-control" value="<?= $nv['Noi_Sinh'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phòng</label>
            <select name="Ma_Phong" class="form-select" required>
                <?php foreach ($departments as $d): ?>
                    <option value="<?= $d['Ma_Phong'] ?>" <?= $nv['Ma_Phong'] == $d['Ma_Phong'] ? 'selected' : '' ?>>
                        <?= $d['Ten_Phong'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Lương</label>
            <input type="number" name="Luong" class="form-control" value="<?= $nv['Luong'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Cập Nhật</button>
        <a href="../controllers/nhanvienController.php" class="btn btn-secondary w-100 mt-2">Quay lại</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>