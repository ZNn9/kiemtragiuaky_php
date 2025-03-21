<?php include __DIR__ . '/../share/header.php'; ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h4>Chỉnh sửa nhân viên</h4>
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

            <form method="POST" action="/kiemtragiuaky/nhanvien/update/<?php echo $nhanvien->Ma_NV; ?>">
                <input type="hidden" name="Ma_NV" value="<?php echo $nhanvien->Ma_NV; ?>">

                <div class="form-group">
                    <label for="Ten_NV">Tên nhân viên:</label>
                    <input type="text" id="Ten_NV" name="Ten_NV" class="form-control" 
                            value="<?php echo htmlspecialchars($nhanvien->Ten_NV, ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="Phai">Phái:</label>
                    <select id="Phai" name="Phai" class="form-control" required>
                        <option value="">-- Chọn phái --</option>
                        <option value="NAM">NAM</option>
                        <option value="NU">NU</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Noi_Sinh">Nơi Sinh:</label>
                    <input type="text" id="Noi_Sinh" name="Noi_Sinh" class="form-control" 
                            value="<?php echo htmlspecialchars($nhanvien->Noi_Sinh, ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <div class="form-group">
                    <label for="Luong">Lương:</label>
                    <input type="number" id="Luong" name="Luong" class="form-control" step="0.01"
                           value="<?php echo number_format($nhanvien->Luong, 0, ',', '.'); ?>" required>
                </div>

                <!-- <div class="form-group">
                    <label for="Ma_Phong">Phòng Ban:</label>
                    <select id="Ma_Phong" name="Ma_Phong" class="form-control" required>
                        <option value="">-- Chọn phòng ban --</option>
                        <?php foreach ($danhsachphongban as $phongban): ?>
                            <option value="<?php echo $phongban->Ma_Phong; ?>" 
                                <?php echo $phongban->Ma_Phong == $nhanvien->Ma_Phong ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($phongban->Ten_Phong, ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div> -->
                <div class="form-group">
                    <label for="Ma_Phong">Phòng Ban:</label>
                    <select id="Ma_Phong" name="Ma_Phong" class="form-control" required>
                        <option value="">-- Chọn phòng ban --</option>
                        <?php foreach ($danhsachphongban as $phongban): ?>
                            <option value="<?php echo $phongban->Ma_Phong; ?>">
                                <?php echo htmlspecialchars($phongban->Ten_Phong, ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                <a href="/kiemtragiuaky/nhanvien/index" class="btn btn-secondary ml-2">Quay lại</a>
            </form>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../share/footer.php'; ?>
