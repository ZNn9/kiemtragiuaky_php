

<?php include __DIR__ . '/../share/header.php'; ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Thêm phòng ban mới</h4>
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

            <form method="POST" action="/kiemtragiuaky/phongban/save">
                <div class="form-group">
                    <label for="Ma_Phong">Mã phòng ban:</label>
                    <input type="text" id="Ma_Phong" name="Ma_Phong" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="Ten_Phong">Tên phòng ban:</label>
                    <input type="text" id="Ten_Phong" name="Ten_Phong" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Lưu phòng ban</button>
                <a href="/kiemtragiuaky/phongban/index" class="btn btn-secondary ml-2">Quay lại</a>
            </form>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../share/footer.php'; ?>
