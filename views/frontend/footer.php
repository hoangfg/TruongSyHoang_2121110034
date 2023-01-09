<?php

use App\Models\Brand;
?>

<section class="myfooter bg-white py-5">
    <div class="container">
        <div class="top-footer my-5">
            <div class="row">
                <div class="col-md-8 col-12 text-center mx-auto">
                    <div class="letter-left heading">
                        <h3>Nhập email của bạn</h3>
                        <p>
                            Bạn vui lòng điền thông tin email của bạn gửi tới chúng tôi để nhận được những thông báo ưu đã , thông tin khuyến mãi từ dịch vụ của chúng tôi!
                        </p>
                    </div>
                    <div class="input-group mb-3 py-3 w-75 m-auto">
                        <input type="text" class="form-control" placeholder="Nhập email của bạn..." aria-label="Nhập email của bạn..." aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-footer my-5">
            <?php
            $brand_list = Brand::where('status', '=', 1)
                ->orderBy('created_at', 'ASC')
                ->get();
            ?>
            <div class="row py-3">
                <div class="col-md-10 col-12 m-auto">

                    <div class="owl-carousel owl-theme border-top border-bottom border-3 py-1">
                        <?php foreach ($brand_list as $brand) : ?>
                            <div class="item port mx-auto" style="height: 100px; width: 100px;">
                                <div class="card h-100 ">
                                    <img src="public/images/brand/<?= $brand->image ?>" class="img-fluid m-auto" alt="<?= $brand->image ?>">

                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>

                </div>


            </div>

        </div>
        <div class="bottom-footer py-5">
            <div class="row ">
                <div class="col-md-6 col-12 mx-auto">
                    <div class="card shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-5">
                                    <img src="public/images/logo.jpg" alt="logo" class="img-fluid">
                                </div>
                            </div>
                            <div class="row">
                                <div class="hotline_footer">
                                    <ul class="contact p-0 list-unstyled">
                                        <li class="footer_h">
                                            <span class="txt_contact">
                                                <span class="mb-3 ">
                                                    Địa chỉ:
                                                </span>
                                                <br />
                                                <p class="text-success m-0">20 Đường Tăng Nhơn Phú, Phước Long B, Thủ Đức, Thành phố Hồ Chí Minh</p>
                                            </span>
                                        </li>
                                        <li class="footer_h">
                                            <span class="txt_contact">
                                                <span class="hotline">Hotline: </span><a href="0918146697" class="text-bl_gr">0918146697</a>
                                            </span>
                                            <span class="line"> | </span>
                                            <span class="txt_contact">
                                                <span class="Email">Email: </span><a href="mailto:h0918146697@gmail.com" class="text-bl_gr">h0918146697@gmail.com</a>
                                            </span>

                                        </li>
                                        <li class="footer_h">
                                            <span>Web: <a href="http://localhost:81/TruongSyHoang_2121110034/index.php" class="text-decoration-none text-bl_gr ">BookStore</a></span>
                                        </li>
                                        <li class="footer_h">
                                            <span>Theo dõi chúng tôi: </span>
                                            <div class="social_footer">
                                                <ul class="nav fs-3">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" aria-current="page" href="#"><i class="fab fa-facebook-f text-bl_gr"></i></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#"><i class="fab fa-twitter text-bl_gr"></i></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#"><i class="fab fa-instagram text-bl_gr"></i></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link "><i class="fab fa-youtube text-bl_gr"></i></a>
                                                    </li>
                                                </ul>

                                            </div>
                                        </li>
                                        <li class="footer_h">
                                            <div class="row">
                                                <div class="col-md-3 col-4">
                                                    <a href="#"><img src="public/images/Get-It-On-Google-Play-PNG-Clipart.png" alt="chplay" class="img-fluid img-down"></a>
                                                </div>
                                                <div class="col-md-3 col-4">
                                                    <a href="#"><img src="public/images/App-Store-1024x354.png" alt="app_store" class="img-fluid img-down"></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 mx-auto">
                    <div class="card shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">

                                    <!-- <ul class="list-menu list-unstyled ">
                                        <li class="item-menu ">
                                            <a href="#" class="text-decoration-none text-bl_gr d-block">Trang chủ</a>
                                        </li>
                                        <li class="item-menu">
                                            <a href="#" class="text-decoration-none text-bl_gr d-block">Giới thiệu</a>
                                        </li>
                                        <li class="item-menu">
                                            <a href="#" class="text-decoration-none text-bl_gr d-block">Sản phẩm</a>
                                        </li>
                                        <li class="item-menu">
                                            <a href="#" class="text-decoration-none text-bl_gr d-block">Tin tức</a>
                                        </li>
                                        <li class="item-menu ">
                                            <a href="#" class="text-decoration-none text-bl_gr d-block">Liên hệ</a>
                                        </li>
                                    </ul> -->
                                    <?php require_once('./views/frontend/mod_footermenu.php') ?>
                                </div>
                                <div class="col-md-6 col-12">
                                    <!-- <h4 class="fs-3 my-4">
                                        Chính sách
                                    </h4>
                                    <ul class="list-menu list-unstyled ">
                                        <li class="item-menu ">
                                            <a href="#" class="text-decoration-none text-bl_gr d-block">Trang chủ</a>
                                        </li>
                                        <li class="item-menu">
                                            <a href="#" class="text-decoration-none text-bl_gr d-block">Giới thiệu</a>
                                        </li>
                                        <li class="item-menu">
                                            <a href="#" class="text-decoration-none text-bl_gr d-block">Sản phẩm</a>
                                        </li>
                                        <li class="item-menu">
                                            <a href="#" class="text-decoration-none text-bl_gr d-block">Tin tức</a>
                                        </li>
                                        <li class="item-menu ">
                                            <a href="#" class="text-decoration-none text-bl_gr d-block">Liên hệ</a>
                                        </li>
                                    </ul> -->
                                    <?php require_once('./views/frontend/mod_footer_lastnews.php') ?>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

</section>
<section class="copyright">
    <div class="container">

        <div class="row">
            <div class="col-md-5 col-12 text-center my-auto" id="copyright">
                <span>
                    Người thực hiện: <b>Trương Sỹ Hoàng</b>
                    <span class="d-md-inline-block d-none"> | </span>
                </span>
                <span>Nguồn: <a href="https://template-iz-books.mysapo.net/" class="text-decoration-none text-bl_gr"><b>MySabo.Net</b></a></span>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5 col-10 mx-auto circleBehind">
                <ul class="nav mt-3 mt-md-0">
                    <li class="nav-item mx-auto">
                        <a class="nav-link active text-bl_gr circleBehind-item" aria-current="page" href="#">Trang chủ </a>
                    </li>
                    <li class="nav-item mx-auto">
                        <a class="nav-link text-bl_gr circleBehind-item" href="#">Giới thiệu</a>
                    </li>
                    <li class="nav-item mx-auto">
                        <a class="nav-link text-bl_gr circleBehind-item" href="#">Sản phẩm</a>
                    </li>
                    <li class="nav-item mx-auto">
                        <a class="nav-link text-bl_gr circleBehind-item" href="#">Tin tức</a>
                    </li>
                    <li class="nav-item mx-auto">
                        <a class="nav-link text-bl_gr circleBehind-item" href="#">Liên hệ</a>
                    </li>
                </ul>

            </div>

        </div>


    </div>
    <ul class="list-fixed brand-sale position-fixed ">
        <li>
            <a data-bs-target="#left-menu" data-bs-toggle="offcanvas" type='button' class='btn btn-circle list-fixed-btn bg-warning d-lg-none'><span class='fa-solid fa-bars'></span></a>
        </li>
        <li>

            <a class='btn btn-circle list-fixed-btn' href="tel:0918146697"><img src="http://t0338.store.nhanh.vn/tp/T0338/img/widget_icon_click_to_call.svg" alt="callnow"></a>
        </li>
        <li>
            <a class='btn btn-circle list-fixed-btn' href="https://m.me/100028898976693"><img src="http://t0338.store.nhanh.vn/tp/T0338/img/widget_icon_messenger.svg" alt="callnow"></a>
        </li>
        <li>
            <a class='btn btn-circle list-fixed-btn' href="http://zaloapp.com/qr/p/1n5wagejj7bjj"><img src="http://t0338.store.nhanh.vn/tp/T0338/img/widget_icon_zalo.svg" alt="callnow"></a>
        </li>
    </ul>
</section>




<script>
    $('.owl-carousel').owlCarousel({
        margin: 10,
        nav: false,
        loop: true,
        // tắt chấm tròn dưới carousel
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false,
                loop: false
            },
            600: {
                items: 2,
                nav: false,
                loop: false
            },
            1000: {
                items: 4,
                nav: false,
                loop: false
            }
        }
    })
</script>

<!-- vendors -->
<script src="public/assets/vendors/highlight.js"></script>
<script src="public/assets/js/app.js"></script>

</body>

</html>