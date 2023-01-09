<?php

use App\Models\Menu;

$arg_mainmenu1 = [
    ['parent_id', '=', 0],
    ['status', '=', 1],
    ['position', '=', 'mainmenu']
];
$list_menu = Menu::where($arg_mainmenu1)
    ->orderBy('sort_order', 'asc')
    ->get();
?>

<div class="row ">
    <div class="col-md-10 col-12 mx-md-auto bg-warning main-md-menu fs-6">

        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark ">
                <button data-bs-target="#navbar_main" data-bs-toggle="offcanvas" class="d-lg-none btn btn-warning navbar-toggler ms-auto" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbar_main" class="offcanvas offcanvas-md offcanvas-start ">

                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">
                            <a class="navbar-brand text-orange " href="#">
                                <img src="public/images/logo.jpg" alt="logo" class="img-fluid img-logo">
                            </a>
                        </h5>
                        <button class="btn-close float-end" data-bs-dismiss="offcanvas"></button>
                    </div>

                    <div class="offcanvas-body">
                        <ul class="navbar-nav">
                            <?php foreach ($list_menu as $row_menu) : ?>
                                <?php
                                $arg_mainmenu2 = [
                                    ['parent_id', '=', $row_menu->id],
                                    ['status', '=', 1],
                                    ['position', '=', 'mainmenu']
                                ];
                                $list_menu1 = Menu::where($arg_mainmenu2)->orderBy('sort_order', 'asc')->get();
                                if (count($list_menu1) != 0) : ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <li class="nav-item active "> <a class="nav-link text-bl_gr active-main" href="#"> Trang chủ </a> </li>
                            <li class="nav-item "><a class="nav-link text-bl_gr" href="#"> Giới thiệu </a></li>

                            <li class="nav-item dropdown ">
                                <a class="nav-link  dropdown-toggle text-bl_gr" href="#" data-bs-toggle="dropdown"> Sản phẩm </a>

                                <?php require_once('views/frontend/menu/category-menu-item.php'); ?>

                            </li>
                            <li class="nav-item "><a class="nav-link text-bl_gr" href="#"> Tin tức </a></li>
                            <li class="nav-item "><a class="nav-link text-bl_gr" href="#"> Liên hệ </a></li>
                        </ul>
                    </div>
                </div> <!-- container-fluid.// -->
            </nav>
        </div>
    </div>
</div>