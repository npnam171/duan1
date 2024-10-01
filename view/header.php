<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DND Food</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: white;
            /* Màu nền trắng */
        }

        .navbar-light {
            background-color: black;
            /* Thanh điều hướng màu đen */
        }

        .navbar-light .navbar-nav .nav-link {
            color: white;
            /* Màu chữ trắng cho các liên kết trong thanh điều hướng */
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #f8b400;
            /* Màu vàng khi hover */
        }

        .header-bg {
            background-color: #f8b400;
            /* Màu vàng cho header */
        }

        .btn-primary {
            background-color: #f8b400;
            /* Màu vàng cho nút primary */
            border-color: #f8b400;
        }

        .btn-outline-primary {
            color: black;
            border-color: black;
        }

        .btn-outline-primary:hover {
            background-color: black;
            color: white;
        }

        a {
            text-decoration: none;
        }


        .btn-danger {
            background-color: #f8b400;
            /* Màu vàng cho nút tìm kiếm */
            border-color: #f8b400;
        }

        .card-img {
            height: 180px;
            object-fit: cover;
        }

        .logo {
            max-width: 50px;
            height: auto;
        }

        .search-bar {
            width: 100%;
            max-width: 300px;
        }

        #btn:hover {
            background-color: red;
            color: white;
        }

        .top10-container {
            max-height: 400px;
            overflow-y: scroll;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .bg-light {
            --bs-bg-opacity: 0;
        }
    </style>
</head>
    <div class="container-fluid header-bg py-2">
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="index.php?act=/"><img src="./view/image/z5616452484832_1f9b08fd997f2e5c540174a3ca08a95a.jpg" class="img-fluid rounded-circle logo" alt="logo"></a>
            </div>
            <div class="col">
                <span class="text-danger">DND Food</span>
            </div>
            <!-- Tìm Kiếm -->
            <div class="col-md-4">
                <form method="post" action="index.php?act=searchPro" class="d-flex">
                    <input type="text" class="form-control search-bar " aria-label="Search" name="search" placeholder="Tìm kiếm">
                    <button class="btn btn-dark" type="submit" name="btn" id="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <!-- Đăng Ký đăng nhập -->
            <div class="col d-flex justify-content-end">
                <?php if (isset($_SESSION['user'])) : ?>
                    <nav class="navbar navbar-expand-lg navbar-light bg-light d-none d-md-block">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mb-3 mb-lg-0">
                                    <li class="nav-item mt-2">
                                        <!-- <a class="nav-link" href="#"><i class="fas fa-bell me-1"></i> Thông báo</a> -->
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <!-- <img src="<?= $imgPath . $avatar_url ?>" alt="User" width="40" height="40" class="rounded-circle me-1">  -->
                                            <span class="me-3">Chào, <?php echo htmlspecialchars($_SESSION['user']['full_name']); ?></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <?php if ($_SESSION['user']['role'] == 1) : // Check if user is admin 
                                            ?>
                                                <li><a class="dropdown-item" href="./controller/index.php">Trang Quản Trị</a></li>
                                            <?php endif; ?>
                                            <li><a class="dropdown-item" href="index.php?act=myBill">Đơn hàng của tôi</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                                <a href="index.php?act=logout" class="btn">Đăng Xuất</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                <?php else : ?>
                    <a href="index.php?act=accountLogin" class="btn btn-outline-primary me-md-3">Đăng Nhập</a>
                    <a href="index.php?act=accountSignUp" class="btn btn-primary">Đăng Ký</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100">
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#"><i class="fa-solid fa-list-ul"></i> DANH MỤC</a>
                    </li>
                    <div class="d-flex justify-content-center flex-grow-1">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="index.php">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="index.php?act=listProducts">Sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="index.php?act=news">Tin tức</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="index.php?act=introduce">Giới Thiệu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="index.php?act=contect">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                    <!-- giỏ hàng -->
                    <div class="col-auto mt-1">
                        <a href="index.php?act=viewCart" class="d-flex align-items-center text-decoration-none">
                            <div class="ms-3">
                                <i class="fa-solid fa-cart-shopping fs-4"></i>
                                <span class="ms-2 fs-5">Giỏ hàng</span>
                            </div>
                            <div class="ms-4">
                                <?php
                                $totalQuantity = 0;
                                if (isset($_SESSION['myCart']) && is_array($_SESSION['myCart'])) {
                                    foreach ($_SESSION['myCart'] as $cart) {
                                        $totalQuantity += $cart[3]; // Giả sử số lượng sản phẩm nằm ở vị trí thứ 4 trong mảng $cart
                                    }
                                }
                                ?>
                                <span class="badge bg-primary"><?= $totalQuantity ?></span>
                            </div>
                        </a>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</head>