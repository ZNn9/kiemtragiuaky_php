

<?php include_once __DIR__ . '/../share/footer.php'; ?>

<?php include __DIR__ . '/../share/header.php'; ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h4>Chỉnh sửa phòng ban</h4>
        </div>
        <div class="card-body">

            <!-- Hiển thị lỗi -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="/kiemtragiuaky/phongban/update/<?php echo $phongban->Ma_Phong; ?>">
                <input type="hidden" name="Ma_Phong" value="<?php echo $phongban->Ma_Phong; ?>">

                <div class="form-group">
                    <label for="Ten_Phong">Tên phòng ban:</label>
                    <input type="text" Ma_Phong="Ten_Phong" name="Ten_Phong" class="form-control" 
                           value="<?php echo htmlspecialchars($phongban->Ten_Phong, ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                <a href="/kiemtragiuaky/phongban/index" class="btn btn-secondary ml-2">Quay lại</a>
            </form>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../share/footer.php'; ?>
