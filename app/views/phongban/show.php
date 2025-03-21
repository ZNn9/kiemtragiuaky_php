<?php include_once __DIR__ . '/../share/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Chi tiết phòng ban</h2>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?= $phongban->Ma_Phong ?></td>
        </tr>
        <tr>
            <th>Tên phòng ban</th>
            <td><?= htmlspecialchars($phongban->Ten_Phong) ?></td>
        </tr>
    </table>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']->role_id === 1) : ?>
        <a href="/kiemtragiuaky/phongban/edit/<?= $phongban->Ma_Phong ?>" class="btn btn-warning"<?= $phongban->Ma_Phong ?>>Sửa</a>
        <a href="/kiemtragiuaky/phongban/delete/<?= $phongban->Ma_Phong ?>" onclick="return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger">Xóa</a>
        
    <?php endif; ?>
    <a href="/kiemtragiuaky/phongban/index" class="btn btn-secondary">Quay lại</a>
    
</div>

<?php include_once __DIR__ . '/../share/footer.php'; ?>
