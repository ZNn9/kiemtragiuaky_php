<?php include_once __DIR__ . '/../share/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Danh sách phòng ban</h2>
    <a href="/kiemtragiuaky/phongban/add" class="btn btn-primary mb-3">Thêm phòng ban</a>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Mã Phòng</th>
                <th>Tên phòng ban</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($danhsachphongban as $phongban): ?>
                <tr>
                <td><?php echo $phongban->Ma_Phong; ?></td>
                    <td><a href="/kiemtragiuaky/phongban/show/<?php echo $phongban->Ma_Phong; ?>">
                            <?php echo htmlspecialchars($phongban->Ten_Phong, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </td>
                    <td>
                        <a href="/kiemtragiuaky/phongban/edit/<?= $phongban->Ma_Phong ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="/kiemtragiuaky/phongban/delete/<?= $phongban->Ma_Phong ?>" onclick="return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once __DIR__ . '/../share/footer.php'; ?>
