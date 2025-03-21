<?php include __DIR__ . '/../share/header.php'; ?>

<body>
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="row no-gutters">

                <!-- Thông tin nhân viên -->
                <div class="col-md-7">
                    <div class="card-body">
                        <h3 class="card-title font-weight-bold mb-3"><?php echo htmlspecialchars($nhanvien->Ten_NV, ENT_QUOTES, 'UTF-8'); ?></h3>

                        <h5 class="mb-3">Thông tin chi tiết</h5>
                        <p><strong>Lương:</strong> 
                            <span class="text-danger font-weight-bold">
                                <?php echo number_format($nhanvien->Luong, 0, ',', '.'); ?> VNĐ
                            </span>
                        </p>
                        <p><strong>Phái:</strong> 
                            <?php echo nl2br(htmlspecialchars($nhanvien->Phai, ENT_QUOTES, 'UTF-8')); ?>
                        </p>
                        <p><strong>Nơi Sinh:</strong> 
                            <?php echo nl2br(htmlspecialchars($nhanvien->Noi_Sinh, ENT_QUOTES, 'UTF-8')); ?>
                        </p>
                        <p><strong>Phòng Ban:</strong> 
                            <span class="badge badge-primary">
                                <?php echo htmlspecialchars($nhanvien->PhongBan_Ten ?? 'Chưa phân loại', ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                        </p>

                        <!-- Buttons -->
                        <div class="mt-4 d-flex">
                            <a href="/kiemtragiuaky/nhanvien/edit/<?php echo $nhanvien->Ma_NV; ?>" class="btn btn-warning mr-3">
                                ✏️ Sửa
                            </a>
                            <a href="/kiemtragiuaky/nhanvien/delete/<?php echo $nhanvien->Ma_NV; ?>" 
                               class="btn btn-danger"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này?');">
                               🗑️ Xóa
                            </a>
                        </div>

                        <div class="mt-4">
                            <a class="btn btn-secondary" href="/kiemtragiuaky">← Quay lại danh sách nhân viên</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../share/footer.php'; ?>
</body>
