
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân viên</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/kiemtragiuaky/">Quản lý nhân viên</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/kiemtragiuaky/nhanvien">Danh sách nhân viên</a>
                </li>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']->role_id === 1) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/kiemtragiuaky/nhanvien/add">Thêm nhân viên</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="/kiemtragiuaky/phongban">Danh sách phòng ban</a>
                </li>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']->role_id === 1) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/kiemtragiuaky/phongban/add">Thêm phòng ban</a>
                    </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <span class="navbar-text text-white mr-3">
                            Xin chào, <strong><?php echo htmlspecialchars($_SESSION['user']->fullname); ?></strong>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="/kiemtragiuaky/user/logout">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="/kiemtragiuaky/user/login">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
