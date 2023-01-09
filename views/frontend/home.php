<?php

use App\Models\Category;
use App\Models\Product;

$list_category = Category::where([['status', '=', 1], ['parent_id', '=', 0]])
    ->orderBy('sort_order', 'ASC')
    ->get();
$title = "Trang chủ";
$metakey = "";
$metadesc = "";
?>
<?php require_once('views/frontend/header.php'); ?>
<!-- end menu -->
<!-- main content -->
<section class="mymaincontent bg-white">
    <?php require_once('./views/frontend/mod_slider.php') ?>
    <form action="index.php?option=cart" method="post">
        <div class="top-content py-3 bg-white">
            <div class="container">
                <?php
                $product_list = Product::where([['status', '=', 1], ['price_sale', '!=', 0]])
                    ->orderBy('created_at', 'DESC')
                    ->take(12)
                    ->get();
                ?>

                <?php if (count($product_list) > 0) : ?>
                    <div class="row py-3">
                        <div class="col-md text-center">
                            <div class="flash_sale">
                                <span>
                                    <h2 class="title bg-white d-inline-block text-bl_gr"><a class="text-decoration-none btn-tab text-bl_gr" href="index.php?option=product&cat=khuyen-mai">FLASH SALE</a></h2>

                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-auto py-3">
                        <div class="col-md-10 col-12  mx-auto">
                            <div class="large-12 columns ">
                                <div class="owl-carousel owl-theme">
                                    <?php foreach ($product_list as $product) : ?>
                                        <div class="item port">
                                            <div class="card h-100 ">

                                                <div class="card-header position-relative">
                                                    <?php if (($product->price_sale == null) || ($product->price_sale == $product->price)) $index = 0;
                                                    else $index = 1; ?>
                                                    <?php if ($index == 1) : ?>
                                                        <div style="max-height: 55px; max-width: 40px;" class="product-sale position-absolute top-0 end-0 bg-danger">
                                                            <div class="product-sale__small">off</div>
                                                            <span><strong> <?= (int)(((($product->price) - ($product->price_sale)) / ($product->price)) * 100) ?> %</strong></span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <a href="./product-detail.html"><img src="public/images/product/<?= $product->image ?>" class="rounded mx-auto d-block card-img-top img-product img-md-product-3x" alt="<?= $product->image ?>"></a>
                                                </div>
                                                <div class="card-body">
                                                    <h3 class="card-title text-truncate m-0 text-center"><a href="./product-detail.html" class="fs-6 fs-7 text-bl_gr "><?= $product->name ?></a></h3>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row">
                                                        <?php if ($product->price_sale == 0) : ?>
                                                            <div class="col-md-6 col-12 mx-auto">
                                                                <h5 class="fs-6 fs-7 text-center text-orange"><?= number_format($product->price) ?>₫</h5>
                                                            </div>
                                                        <?php else : ?>

                                                            <div class="col-md-6 col-6 mx-auto">
                                                                <h5 class="fs-6 fs-7 text-center text-orange"><?= number_format($product->price_sale) ?>₫</h5>
                                                            </div>
                                                            <div class="col-md-6 col-6 mx-auto">
                                                                <h5 class="fs-6 fs-7 text-center text-decoration-line-through text-muted "><?= number_format($product->price) ?>₫</h5>
                                                            </div>

                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="portfolioDisc">
                                                    <a href="index.php?option=cart&addcart=<?= $product->id ?>" title="Thêm vào giỏ" class=" m-auto"><i class="fs-3 btn btn-bg-green fa-solid fa-cart-plus"></i></a>
                                                    <a href="index.php?option=product&slug=<?= $product->slug ?>" title="Xem" class="d-block m-auto"><i class="fs-3 btn btn-bg-green fa-solid fa-eye"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>


                        </div>




                    </div>
                <?php endif; ?>
                <!-- end flash sale -->
                <div class="container-fluid">
                    <div class="policy">
                        <div class="row  pt-5 border-top">

                            <div class="large-12 columns mx-auto">
                                <div class="owl-carousel  owl-theme">

                                    <div class="item text-center height-carousel-icon">
                                        <div class="policy-item d-block p-3">
                                            <span></span>
                                            <span></span>
                                            <div class="row">
                                                <div class="col-md-4 mx-auto ">
                                                    <i class="fa-solid fa-truck-fast fs-2 "></i>
                                                </div>
                                            </div>
                                            <div class="row py-1">
                                                <p>Giao hàng miễn phí</p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="item text-center height-carousel-icon">
                                        <div class="policy-item d-block p-3">
                                            <span></span>
                                            <span></span>
                                            <div class="row">
                                                <div class="col-md-4 mx-auto ">
                                                    <i class="fa-solid fa-bolt fs-2 flash"></i>
                                                </div>
                                            </div>
                                            <div class="row py-1">
                                                <p>Đặt hàng nhanh chóng</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="item text-center height-carousel-icon">
                                        <div class="policy-item d-block p-3">
                                            <span></span>
                                            <span></span>
                                            <div class="row">
                                                <div class="col-md-4 mx-auto ">
                                                    <i class="fa-regular fa-square box-ani-1 fs-2"></i>
                                                    <i class="fa-regular fa-square box-ani-2 fs-2"></i>
                                                </div>
                                            </div>
                                            <div class="row py-1">
                                                <p>Giá tiêu chuẩn</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="item text-center height-carousel-icon">
                                        <div class="policy-item d-block p-3">

                                            <div class="row">
                                                <div class="col-md-4 mx-auto ">
                                                    <span></span>
                                                    <span></span>
                                                    <i class="fa-solid fa-rotate fs-2 spinner ring"></i>

                                                </div>
                                            </div>
                                            <div class="row py-1">
                                                <p>Đổi trả trong 3 ngày</p>
                                            </div>
                                        </div>


                                    </div>

                                </div>

                            </div>


                        </div>
                    </div>
                    <!-- end policy -->

                </div>
                <!-- Sách mới -->

                <div class="section_book_feature py-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-10 col-12 mx-auto text-center heading2">

                                <h2 class="title bg-white d-inline-block text-bl_gr"><a class="text-decoration-none btn-tab text-bl_gr" href="index.php?option=product">Sách mới</a></h2>
                                <p class="d-block">
                                    Trong lịch sử nhân loại, hiếm thấy ai phát biểu quan điểm này về con người. Ngày nay, quan điểm này hầu
                                    như không tồn tại. Tuy nhiên, chính quan điểm này - dù tồn tại ở các cấp độ khác nhau
                                </p>
                            </div>
                        </div>
                        <div class="swiper_slide">
                            <?php
                            $product_list = Product::where('status', '=', 1)
                                ->orderBy('created_at', 'DESC')
                                ->take(12)
                                ->get();
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="large-12 columns ">
                                        <div class="owl-carousel owl-theme d-md-block d-none">
                                            <?php foreach ($product_list as $product) : ?>
                                                <div class="item  height-carousel-product p-0 bg-none port ">
                                                    <div class="card ">
                                                        <div class="row g-0">
                                                            <div class="col-md-6 col-6">
                                                                <a href="./product-detail.html">
                                                                    <img src="public/images/product/<?= $product->image ?>" class="rounded mx-auto d-block card-img-top img-product img-fluid py-auto" alt="<?= $product->image ?>">
                                                                </a>
                                                            </div>
                                                            <div class="col-md-6 col-6">
                                                                <div class="card-body">

                                                                    <h5 class="card-title mt-0 text-limit-2 fs-7"><?= $product->name ?></h5>
                                                                    <div class="row">
                                                                        <?php if ($product->price_sale == 0) : ?>
                                                                            <div class="col-md-6 col-12 mt-2">
                                                                                <h5 class="text-orange" style="font-size: 11px;"><?= number_format($product->price) ?>₫</h5>
                                                                            </div>
                                                                        <?php else : ?>

                                                                            <div class="col-md-6 col-6 mx-auto">
                                                                                <h5 class="text-orange" style="font-size: 11px;"><?= number_format($product->price_sale) ?>₫</h5>
                                                                            </div>
                                                                            <div class="col-md-6 col-6 mx-auto">
                                                                                <h5 class="text-decoration-line-through text-muted " style="font-size: 11px;"><?= number_format($product->price) ?>₫</h5>
                                                                            </div>

                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <p class="card-text text-limit-5"><?= $product->metadesc ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="portfolioDisc">
                                                            <a href="index.php?option=cart&addcart=<?= $product->id ?>" title="Thêm vào giỏ" class=" m-auto"><i class="fs-3 btn btn-bg-green fa-solid fa-cart-plus"></i></a>
                                                            <a href="index.php?option=product&slug=<?= $product->slug ?>" title="Xem" class="d-block m-auto"><i class="fs-3 btn btn-bg-green fa-solid fa-eye"></i></a>
                                                        </div>
                                                    </div>
                                                </div>


                                            <?php endforeach; ?>
                                        </div>
                                        <div class="owl-carousel owl-theme d-md-none d-block">
                                            <?php foreach ($product_list as $product) : ?>
                                                <div class="item port">
                                                    <div class="card h-100 ">
                                                        <div class="card-header">
                                                            <a href="./product-detail.html"><img src="public/images/product/<?= $product->image ?>" class="card-img-top img-product img-md-product-3x rounded mx-auto d-block" alt="<?= $product->image ?>"></a>
                                                        </div>
                                                        <div class="card-body">
                                                            <h3 class="card-title text-truncate m-0 text-center"><a href="./product-detail.html" class="fs-6 fs-7 text-bl_gr "><?= $product->name ?></a></h3>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="row">
                                                                <?php if ($product->price_sale == 0) : ?>
                                                                    <div class="col-12 mx-auto">
                                                                        <h3 class="fs-6  text-center text-orange"><?= number_format($product->price) ?>₫</h3>
                                                                    </div>
                                                                <?php else : ?>
                                                                    <div class="col-6 mx-auto">
                                                                        <h5 class="fs-6 fs-7  text-orange"><?= number_format($product->price_sale) ?>₫</h5>
                                                                    </div>
                                                                    <div class="col-6 mx-auto">
                                                                        <h5 class="fs-6 fs-7   text-decoration-line-through text-muted "><?= number_format($product->price) ?>₫</h5>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="portfolioDisc">
                                                            <a href="index.php?option=cart&addcart=<?= $product->id ?>" title="Thêm vào giỏ" class=" m-auto"><i class="fs-3 btn btn-bg-green fa-solid fa-cart-plus"></i></a>
                                                            <a href="index.php?option=product&slug=<?= $product->slug ?>" title="Xem" class="d-block m-auto"><i class="fs-3 btn btn-bg-green fa-solid fa-eye"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end top content -->
            <div class="mid-content">
                <div class="container">
                    <?php foreach ($list_category as $cat) : ?>
                        <?php
                        $listcatid = array();
                        array_push($listcatid, $cat->id);
                        $list_category_1 = Category::where([['status', '=', '1'], ['parent_id', '=', $cat->id]])
                            ->get();
                        if (count($list_category_1) > 0) {
                            foreach ($list_category_1 as $cat1) {
                                array_push($listcatid, $cat1->id);
                                $list_category_2 = Category::where([['status', '=', '1'], ['parent_id', '=', $cat1->id]])
                                    ->get();
                                if (count($list_category_2) > 0) {
                                    foreach ($list_category_2 as $cat2) {
                                        array_push($listcatid, $cat2->id);
                                        $list_category_3 = Category::where([['status', '=', '1'], ['parent_id', '=', $cat2->id]])
                                            ->get();
                                        if (count($list_category_3) > 0) {
                                            foreach ($list_category_3 as $cat3) {
                                                array_push($listcatid, $cat3->id);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $product_list = Product::where('status', '=', 1)->whereIn('category_id', $listcatid)
                            ->orderBy('created_at', 'DESC')
                            ->take(4)
                            ->get();
                        $total = Product::where([['status', '=', 1], ['category_id', $listcatid]])->count();
                        ?>
                        <?php if ($total > 0) : ?>
                            <div class="product">
                                <div class="row my-5">
                                    <div class="col-md-10 col-12 border-bottom border-4 px-0 mx-auto">
                                        <div class="heading1 ">
                                            <h2 class="title">
                                                <span class="d-md-inline-block d-none text-warning "> | </span>
                                                <a href="index.php?option=product&cat=<?= $cat->slug ?>" class="text-decoration-none text-bl_gr"><?= $cat->name ?></a>
                                            </h2>
                                        </div>
                                        <div class="d-md-block d-none">
                                            <a class="text-decoration-none btn-tab text-bl_gr" href="index.php?option=product&cat=<?= $cat->slug ?>" title="Xem thêm">Xem thêm</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="product_slide">
                                    <div class="row mx-auto">
                                        <!--  -->
                                        <div class="col-md-10 mx-auto">
                                            <!-- 1 -->
                                            <div class="row row-cols-1 row-cols-md-3 g-4">

                                                <?php foreach ($product_list as $product) : ?>

                                                    <div class="col-md-3 col-6">
                                                        <div class="card h-100 text-center shadow-product  port">
                                                            <div class="card-header position-relative">
                                                                <?php if (($product->price_sale == null) || ($product->price_sale == $product->price)) $index = 0;
                                                                else $index = 1; ?>
                                                                <?php if ($index == 1) : ?>
                                                                    <div style="max-height: 55px; max-width: 40px;" class="product-sale position-absolute top-0 end-0 bg-danger">
                                                                        <div class="product-sale__small">off</div>
                                                                        <span><strong> <?= (int)(((($product->price) - ($product->price_sale)) / ($product->price)) * 100) ?> %</strong></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <a href="./product-detail.html"><img src="public/images/product/<?= $product->image ?>" class="card-img-top img-product img-md-product-3x" alt="<?= $product->image ?>"></a>
                                                            </div>
                                                            <div class="card-body ">

                                                                <h3 class="card-title fs-6 fs-7 text-bl_gr text-truncate"><?= $product->name ?></h3>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="row">
                                                                    <?php if ($product->price_sale == 0) : ?>
                                                                        <div class="col-md-6 col-12 mx-auto">
                                                                            <h5 class="fs-6 fs-7 text-center text-orange"><?= number_format($product->price) ?>₫</h5>
                                                                        </div>
                                                                    <?php else : ?>
                                                                        <div class="col-md-6 col-6 mx-auto">
                                                                            <h5 class="fs-6 fs-7 text-center text-orange"><?= number_format($product->price_sale) ?>₫</h5>
                                                                        </div>
                                                                        <div class="col-md-6 col-6 mx-auto">
                                                                            <h5 class="fs-6 fs-7 text-center text-decoration-line-through text-muted "><?= number_format($product->price) ?>₫</h5>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="portfolioDisc">
                                                                <a href="index.php?option=cart&addcart=<?= $product->id ?>" title="Thêm vào giỏ" class=" m-auto"><i class="fs-3 btn btn-bg-green fa-solid fa-cart-plus"></i></a>
                                                                <a href="index.php?option=product&slug=<?= $product->slug ?>" title="Xem" class="d-block m-auto"><i class="fs-3 btn btn-bg-green fa-solid fa-eye"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php endforeach; ?>

                                                <!-- 2 -->


                                                <!--  -->
                                            </div>
                                        </div>
                                        <!--  -->
                                    </div>
                                </div>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </form>

    <!-- end mid content -->
</section>
<!-- footer -->
<?php require_once('views/frontend/footer.php'); ?>