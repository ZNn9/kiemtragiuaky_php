<?php include __DIR__ . '/../share/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h4><i class="fas fa-user-lock mr-2"></i>Login</h4>
                </div>
                <div class="card-body p-4">
                    <!-- Hiển thị lỗi -->
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Oops!</strong> <?php echo $error; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="form-group mb-3">
                            <label for="username"><i class="fas fa-user mr-2"></i>Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter username..." required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password"><i class="fas fa-lock mr-2"></i>Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password..." required>
                        </div>

                        <button type="submit" name="login" class="btn btn-primary btn-block">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">© <?php echo date('Y'); ?> Your Company</small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../share/footer.php'; ?>
