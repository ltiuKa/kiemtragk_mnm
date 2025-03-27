<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login_form.php");
    exit;
}
include '../includes/header.php';
include_once '../models/NhanVien.php';



$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5;
$listNV = getNhanVienByPage($page, $limit);
$totalPages = ceil(getTotalNhanVien() / $limit);
?>

<h3 class="text-center mb-4">THÔNG TIN NHÂN VIÊN</h3>
<?php if ($_SESSION['role'] == 'admin'): ?>
    <div class="text-end mb-3">
        <a href="../views/add.php" class="btn btn-success">Thêm Nhân Viên</a>
    </div>
<?php endif; ?>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-danger text-center">
        <tr>
            <th>Mã Nhân Viên</th>
            <th>Tên Nhân Viên</th>
            <th>Giới tính</th>
            <th>Nơi Sinh</th>
            <th>Tên Phòng</th>
            <th>Lương</th>
            <?php if ($_SESSION['role'] == 'admin'): ?>
            <th>Hành động</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listNV as $nv): ?>
            <tr>
                <td><?= htmlspecialchars($nv['Ma_NV']) ?></td>
                <td><?= htmlspecialchars($nv['Ten_NV']) ?></td>
                <td class="text-center">
                    <img src="../assets/img/<?= strtolower($nv['Phai']) == 'nu' ? 'woman' : 'man' ?>.png" width="40">
                </td>
                <td><?= htmlspecialchars($nv['Noi_Sinh']) ?></td>
                <td><?= htmlspecialchars($nv['Ten_Phong']) ?></td>
                <td><?= number_format($nv['Luong']) ?></td>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                <td>
                    <a href="../views/edit.php?id=<?= $nv['Ma_NV'] ?>" class="btn btn-sm btn-primary">Sửa</a>
                    <a href="../views/delete.php?id=<?= $nv['Ma_NV'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xoá?')">Xoá</a>
                </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Pagination -->
<nav>
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<div class="text-center mt-3">
    <a href="../auth/logout.php" class="btn btn-warning">Đăng Xuất</a>
</div>

<?php include '../includes/footer.php'; ?>
