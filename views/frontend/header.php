<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TruongSyHoang-2121110034</title>
    <link rel="icon" href="public/images/logo.jpg">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="public/assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="public/assets/owlcarousel/assets/owl.theme.default.min.css">
    
    <!-- javascript -->
    
    <script src="public/assets/vendors/jquery.min.js"></script>
    
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/assets/owlcarousel/owl.carousel.js"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="AHIeceBH"></script>
    <link rel="stylesheet" href="public/css/layoutsite.css">
</head>

<body>
    <section class="top-banner">
        <div class="container-fluid">
            <div class="row d-md-block d-none ">
                <div class="col-md-12">
                    <img src="public/images/bg_banner_top.jpg" alt="header banner" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <form action="index.php" method="get">
        <input type="hidden" value='search' name='option'>
        <section class="header bg-white">
            <div class="container ">
                <div class="row">
                    <div class="col-md-10 col-10 mx-auto">
                        <div class="row">
                            <div class="col-md-5 d-md-block d-none  my-2">
                                <span class="well_come_text">Chào mừng bạn đến với thế giới sách Iz Books !</span>
                            </div>
                            <div class="col-md-7 d-md-block d-none pe-0">
                                <div class="float-end ">
                                    <ul class="nav ">
                                        <li class="nav-item">
                                            <a class="nav-link text-bl_gr" href="#">Thẻ quà tặng</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-bl_gr" href="#">Thành viên cửa hàng & Sự kiện</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-bl_gr" href="#">Trợ giúp</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row py-2">
                            <!-- logo -->
                            <div class="col-md-2 col-3 my-auto p-0 ">
                                <img src="public/images/logo.jpg" alt="logo" class="img-fluid">
                            </div>
                            <div class="col-md-6 d-md-block d-none my-auto">
                                <div class="row">
                                    <div class="float-start ">
                                        <ul class="nav">
                                            <li class="nav-item">
                                                <a class="nav-link ps-0 text-bl_gr" href="#">Ưu đãi đối tác</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-bl_gr" href="#">Phiếu quà tặng</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-bl_gr" href="#">Khuyến mãi hot</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="header-search col-md-12">
                                        <div class="input-group mb-3">

                                            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2" name="keywork">
                                            <button class="input-group-text btn" id="basic-addon2" href="index.php?option=search">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4 col-6 m-auto pe-0 me-0 my-auto">
                                <div class="row mt-md-2 ">
                                    <?php if (!isset($_SESSION['logincustomer'])) : ?>
                                        <div class="col-md-9 mt-3 mx-auto d-md-block d-none text-center">
                                            <div class="btn-group row py-2">
                                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                                    Tài khoản
                                                </button>
                                                <ul class="dropdown-menu row ">
                                                    <li class=" my-2 "><a class="dropdown-item  bg-wh_gr " href="index.php?option=customer-login"><i class="fa-solid fa-arrow-right-to-bracket me-2"></i>Đăng nhập</a></li>
                                                    <li class=" my-2"><a class="dropdown-item  bg-wh_gr" href="index.php?option=customer-signup"><i class="fa-sharp fa-solid fa-user-plus me-2"></i>Đăng ký</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="col-md-9 mt-3 mx-auto d-md-block d-none text-center">
                                            <div class="btn-group row py-2">
                                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                                    Tài khoản
                                                </button>
                                                <ul class="dropdown-menu row ">
                                                    <li class=" my-2 "><a class="dropdown-item  bg-wh_gr " href="index.php?option=customer"><i class="fa-solid fa-arrow-right-to-bracket me-2"></i>Thành viên</a></li>
                                                    <li class=" my-2 "><a class="dropdown-item  bg-wh_gr " href="index.php?option=customer-logout"><i class="fas fa-save me-2"></i>Đăng xuất</a></li>


                                                </ul>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-3 p-0 ">
                                        <div class="btn-group float-end me-3 py-1" role="group" aria-label="Basic outlined example">
                                            <button type="button" class="btn mt-md-2">
                                                <a href="index.php?option=cart-content" title="Thêm vào giỏ" class=" m-auto"><i class="fs-3 btn btn-bg-green fa-solid fa-cart-plus"></i></a>
                                                

                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <!-- main menu -->
    <section class="mymainmenu bg-white ">
        <div class="container">
            <!-- menu mobile -->


            <!-- menu pc -->
            <?php require_once('views/frontend/mod-mainmenu.php'); ?>

        </div>

    </section>