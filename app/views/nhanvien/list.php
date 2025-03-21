

<?php include_once __DIR__ . '/../share/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Danh sách nhân viên</h2>
    <a href="/kiemtragiuaky/nhanvien/add" class="btn btn-primary mb-3">Thêm nhân viên</a>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Mã nhân viên</th>
                <th>Tên nhân viên</th>
                <th>Phòng ban</th>
                <th>Phái</th>
                <th>Nơi Sinh</th>
                <th>Lương</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($danhsachnhanvien as $nhanvien): ?>
                <tr>
                    <td><?php echo $nhanvien->Ma_NV; ?></td>
                    <td><a href="/kiemtragiuaky/nhanvien/show/<?php echo $nhanvien->Ma_NV; ?>">
                            <?php echo htmlspecialchars($nhanvien->Ten_NV, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars($nhanvien->PhongBan_Ten ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <?php if ($nhanvien->Phai === 'NAM'): ?>
                            <img src="/kiemtragiuaky/assets/man.jpg" alt="Nam" width="50" height="50">
                        <?php elseif ($nhanvien->Phai === 'NU'): ?>
                            <img src="/kiemtragiuaky/assets/women.jpg" alt="Nữ" width="50" height="50">
                        <?php else: ?>
                            <?php echo htmlspecialchars($nhanvien->Phai, ENT_QUOTES, 'UTF-8'); ?>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($nhanvien->Noi_Sinh, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo number_format($nhanvien->Luong, 0, ',', '.'); ?> đ</td>
                    <td>
                        <a href="/kiemtragiuaky/nhanvien/edit/<?php echo $nhanvien->Ma_NV; ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="/kiemtragiuaky/nhanvien/delete/<?php echo $nhanvien->Ma_NV; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- PHÂN TRANG -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>


<?php include_once __DIR__ . '/../share/footer.php'; ?>
