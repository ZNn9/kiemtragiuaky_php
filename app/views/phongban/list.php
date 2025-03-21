<?php include_once __DIR__ . '/../share/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Danh sách phòng ban</h2>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']->role_id === 1) : ?>
        <a href="/kiemtragiuaky/phongban/add" class="btn btn-primary mb-3">Thêm phòng ban</a>
    <?php endif; ?>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Mã Phòng</th>
                <th>Tên phòng ban</th>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']->role_id === 1) : ?>
                    <th>
                        Hành động
                    </th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($danhsachphongban as $phongban): ?>
                <tr>
                <td>
                    <a href="/kiemtragiuaky/phongban/show/<?php echo $phongban->Ma_Phong; ?>">
                        <?php echo htmlspecialchars($phongban->Ma_Phong, ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </td>
                <td>
                    <a>
                        <?php echo htmlspecialchars($phongban->Ten_Phong, ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </td>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']->role_id === 1) : ?>
                    <td>
                        <a href="/kiemtragiuaky/phongban/edit/<?= $phongban->Ma_Phong ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="/kiemtragiuaky/phongban/delete/<?= $phongban->Ma_Phong ?>" onclick="return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </th>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once __DIR__ . '/../share/footer.php'; ?>
