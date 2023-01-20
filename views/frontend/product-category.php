<?php

use App\Models\Category;
use App\Models\Product;
use App\Libraries\Pagination;


$slug = $_REQUEST['cat'];
$row_cat = Category::where([['slug', '=', $slug], ['status', '=', 1]])->first();
if ($slug != "khuyen-mai") {
    $title = $row_cat['name'];
    $metakey = $row_cat['metakey'];
    $metadesc = $row_cat['metadesc'];

    $listcatid = array();
    array_push($listcatid, $row_cat['id']);
    $list_category_1 = Category::where([['parent_id', '=', $row_cat['id']], ['status', '=', 1]])
        ->orderBy('sort_order', 'asc')
        ->get();
    if (count($list_category_1) != 0) {
        foreach ($list_category_1 as $cat_1) {
            array_push($listcatid, $cat_1['id']);
            $list_category_2 = Category::where([['parent_id', '=', $cat_1['id']], ['status'], '=', 1])
                ->orderBy('sort_order', 'asc')
                ->get();
            if (count($list_category_2) != 0) {
                foreach ($list_category_2 as $cat_2) {
                    array_push($listcatid, $cat_2['id']);
                }
            }
        }
    }
    $limit = 12;
    $page = Pagination::pageCurrent();
    $skip = Pagination::pageOffset($page, $limit);
    $list_product = Product::where('status', '=', 1)
        ->whereIn('category_id', $listcatid)
        ->orderBy('created_at', 'desc')
        ->skip($skip)
        ->take($limit)
        ->get();

    $total = Product::where('status', '=', 1)->whereIn('category_id', $listcatid)->count();
} else {
    $title = 'khuyến mãi';
    $metakey = $row_cat['metakey'];
    $metadesc = $row_cat['metadesc'];
    $limit = 12;
    $page = Pagination::pageCurrent();
    $skip = Pagination::pageOffset($page, $limit);
    $list_product = Product::where([['status', '=', 1], ['price_sale', '!=', 0]])
        ->orderBy('created_at', 'DESC')
        ->skip($skip)
        ->take($limit)
        ->get();

    $total = Product::where([['status', '=', 1], ['price_sale', '!=', 0]])->count();
}


?>
<?php require_once('./views/frontend/header.php') ?>
<section class="mycontent py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-12 mx-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-bl_gr">Trang chủ</a></li>
                        <li class="breadcrumb-item active-main" aria-current="page"><?= $title ?></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">

            <div class="col-md-10 col-12 mx-auto">
                <div class="row">
                    <!-- mobile -->
                    <div class="col-md-3">
                        <nav class="navbar navbar-expand-md">
                            <div id="left-menu" class="offcanvas offcanvas-md offcanvas-start " style="max-width: 80%;">
                                <div class="offcanvas-body flex-column">
                                    <?php require_once('./views/frontend/mod_listcategory.php') ?>
                                    <?php require_once('./views/frontend/mod_listbrand.php') ?>
                                    <?php require_once('./views/frontend/mod_price.php') ?>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-9 col-12 float-md-none ">

                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <?php foreach ($list_product as $product) : ?>
                                <div class="col-md-4 col-6">
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

                        <div class="py-5"><?= Pagination::pageLinks($total, $page, $limit, "index.php?option=product&cat=$row_cat->slug"); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<?php require_once('./views/frontend/footer.php') ?>