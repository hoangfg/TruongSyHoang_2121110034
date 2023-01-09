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
                                $list_menu1 = Menu::where($arg_mainmenu2)
                                    ->orderBy('sort_order', 'asc')
                                    ->get();
                                ?>
                                <?php if (count($list_menu1) != 0) : ?>
                                    <li class="nav-item dropdown ">
                                        <a class="nav-link  dropdown-toggle text-bl_gr" href="<?= $row_menu->link ?>" role="button" aria-expanded="false" data-bs-toggle="dropdown"><?= $row_menu->name ?></a>
                                        <ul class="dropdown-menu bg-warning">
                                            <?php foreach ($list_menu1 as $row_menu1) : ?>
                                                <li><a class="dropdown-item text-bl_gr border-bottom" href="<?= $row_menu1->link ?>"><?= $row_menu1->name ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>

                                    </li>


                                <?php else : ?>
                                    <li class="nav-item "><a class="nav-link text-bl_gr" href="<?= $row_menu->link ?>"><?= $row_menu->name ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if (!isset($_SESSION['logincustomer'])) : ?>
                                <li class="nav-item  d-md-none d-block"><a class="nav-link text-bl_gr" href="index.php?option=customer-login"><i class="fa-solid fa-arrow-right-to-bracket me-2"></i>Đăng nhập</a></li>
                                <li class="nav-item d-md-none d-block"><a class="nav-link text-bl_gr" href="index.php?option=customer-signup"><i class="fa-sharp fa-solid fa-user-plus me-2"></i>Đăng ký</a></li>
                            <?php else : ?>
                                <li class="nav-item  d-md-none d-block"><a class="nav-link text-bl_gr" href="index.php?option=customer"><i class="fa-solid fa-arrow-right-to-bracket me-2"></i>Thành viên</a></li>
                                <li class="nav-item  d-md-none d-block"><a class="nav-link text-bl_gr" href="index.php?option=customer-logout"><i class="fas fa-save me-2"></i> Đăng xuất</a></li>

                            <?php endif; ?>
                        </ul>
                    </div>
                </div> <!-- container-fluid.// -->
            </nav>
        </div>
    </div>
</div>