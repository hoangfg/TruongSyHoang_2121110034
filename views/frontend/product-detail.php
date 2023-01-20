<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

$slug = $_REQUEST['slug'];
$row_pro = Product::where([
    ['slug', '=', $slug],
    ['status', '=', '1']
])->first();

$title = $row_pro->name;
$metakey = $row_pro->metakey;
$metadesc = $row_pro->metadesc;

$brand = Brand::where([['id', '=', $row_pro['brand_id']], ['status', '=', '1']])->first();
$listcatid = array();
array_push($listcatid, $row_pro->category_id);
$list_category1 = Category::where([['parent_id', '=', $row_pro->category_id], ['status', '=', '1']])->orderBy('sort_order', 'asc')->get();
if (count($list_category1) != 0) {
    foreach ($list_category1 as $cat1) {
        array_push($listcatid, $cat1->id);
        $list_category2 = Category::where([['parent_id', '=', $cat1->id], ['status', '=', '1']])->orderBy('sort_order', 'asc')->get();
        if (count($list_category2) != 0) {
            foreach ($list_category2 as $cat2) {
                array_push($listcatid, $cat2->id);
            }
        }
    }
}
$list_product = Product::where('status', '=', '1')
    ->whereIn('category_id', $listcatid)
    ->where('id', '!=', $row_pro->id)
    ->orderBy('created_at', 'desc')
    ->take(6)->get();
$list_product_b = Product::where('status', '=', 1)
    ->where('brand_id', '!=', $brand->id)
    ->orderBy('created_at', 'desc')
    ->take(6)
    ->get();
$product_list_f = Product::where([['status', '=', 1], ['price_sale', '!=', 0]])
    ->orderBy('created_at', 'DESC')
    ->take(12)
    ->get();
?>


<?php require_once('./views/frontend/header.php') ?>
<section class="maincontent">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-12 mx-auto mt-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-bl_gr">Trang chủ</a></li>
                        <li class="breadcrumb-item active-main" aria-current="page"><?= $title ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row py-5 ">
            <div class="col-md-10 col-12 mx-auto bg-white">
                <div class="row">
                    <div class="col-md-3 col-8 mx-auto p-3">
                        <a href="./product-detail.html"><img src="public/images/product/<?= $row_pro->image ?>" class="card-img-top img-product img-md-product-3x" alt="<?= $row_pro->image ?>"></a>
                        <!-- -------------------------- -->
                    </div>
                    <div class="col-md-9 col-12">
                        <div class="card">
                            <div class="card-header">

                                <h3 class="card-title fs-3 text-bl_gr m-0"><?= $row_pro->name ?></h3>
                                <!-- <div class="row ">
                                    <div class="col-md-12">
                                        <div class="product-rating ">
                                            <i class="fa-solid fa-star product-rating__star--gold"></i>
                                            <i class="fa-solid fa-star product-rating__star--gold"></i>
                                            <i class="fa-solid fa-star product-rating__star--gold"></i>
                                            <i class="fa-solid fa-star product-rating__star--gold"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <span class="d-md-inline-block d-none text-warning "> | </span>
                                            <span>Đã bán: 95</span>
                                        </div>

                                    </div>

                                </div> -->
                                <div class="row my-2">
                                    <?php if ($row_pro->qty > 0) : ?>
                                        <span class="d-block text-success">Còn hàng</span>
                                    <?php else : ?>
                                        <span class="d-block text-danger">Hết hàng</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class=" row card-body">
                                <div class="col-md-6 border-end border-1">
                                    <div class="row">
                                        <?php if ($row_pro->price_sale == 0) : ?>
                                            <div class="col-md-6 col-12 mt-2">
                                                <h5 class="text-orange"><?= number_format($row_pro->price) ?>₫</h5>
                                            </div>
                                        <?php else : ?>
                                            <div class="row mt-2">
                                                <div class="col-md-6 col-6 mx-auto">
                                                    <h5 class="text-orange"><?= number_format($row_pro->price_sale) ?>₫</h5>
                                                </div>
                                                <div class="col-md-6 col-6 mx-auto">
                                                    <h5 class="text-decoration-line-through text-muted "><?= number_format($row_pro->price) ?>₫</h5>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="row">
                                        <p class="card-text mb-0">Nội dung: </p>
                                        <p class="card-text m-0"><small class="text-muted">Thông tin sách đang được cập nhật</small></p>
                                    </div>
                                    <div class="row py-3">
                                        <div class="col-md-6 col-6">
                                            <div class="buttons_added bg-header">

                                                <input class="text-center" max="<?= $row_pro->qty ?>" min="1" name="" type="number" value="1">


                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="button_actions">

                                                <a href="index.php?option=cart&addcart=<?= $row_pro->id ?>" title="Thêm vào giỏ" class="btn bt-md btn-success m-auto">Thêm vào giỏ</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="call-phone-buy">
                                        <div class="row">
                                            <p class="m-0">
                                                <span>Hotline đặt hàng: </span>
                                                <a href="#" class="text-bl_gr">0918146697</a>
                                            </p>
                                            <span class="text-muted">(Miễn phí, 8-21h cả T7,CN)</span>
                                        </div>
                                        <div class="row">
                                            <p class="m-0">
                                                <span>Email: </span>
                                                <a href="mailto:h0918146697@gmail.com" class="text-bl_gr">h0918146697@gmail.com</a>
                                            </p>
                                        </div>
                                        <div class="row">
                                            <span>Khuyến mãi:</span>
                                            <p class="text-muted">Hoàn tiền cho thành viên (tối đa 100k/tháng), 1% (450đ)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end product-detail -->
        <div class="row">
            <div class="Featured-products row bg-product-item mt-3">
                <div class="col-md-6  mt-2">
                    <div class="row">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                                    <h2 class="fs-5">MÔ TẢ SẢN PHẨM</h2>
                                </button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                                    <h2 class="fs-5">Thông Tin</h2>
                                </button>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="col-md-12 col-12">
                    <div class="row tab-content " id="nav-tabContent">
                        <div class="tab-pane fade show active  " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                            <div class="card card-body">
                                <h1><?= $row_pro->name ?></h1>
                                <p><?= $row_pro->metadesc ?></p>
                            </div>
                        </div>
                        <!-- end-MÔ TẢ SẢN PHẨM -->
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">

                            <div class="card card-body col-md-6">
                                <p><?= $row_pro->detail ?></p>
                            </div>
                        </div>
                        <!-- end Thông Tin Chi Tiết-->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-12">
                <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="100%" data-numposts="5"></div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-12 col-12 border-bottom border-4 px-0">
                <div class="heading1 ">
                    <h2 class="title">
                        <span class="d-md-inline-block d-none text-warning "> | </span>
                        <a href="#" class="text-decoration-none text-bl_gr">SÁCH CÙNG LOẠI</a>
                    </h2>
                </div>
                <div class="d-md-block d-none">
                    <a class="text-decoration-none btn-tab text-bl_gr" href="#" title="Xem thêm">Xem thêm</a>
                </div>
            </div>
        </div>
        <!-- end top SÁCH CÙNG LOẠI -->
        <div class="product_slide">
            <div class="row mx-auto">
                <!--  -->

                <div class="col-md-12 mx-auto">
                    <!-- 1 -->
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php foreach ($list_product as $product) : ?>
                            <div class="col-md-2 col-6">
                                <div class="card h-100 text-center shadow-product port">
                                    <div class="card-header">
                                        <img src="public/images/product/<?= $product->image ?>" class="card-img-top img-product img-md-product-2x img-fluid rounded mx-auto d-block" alt="<?= $product->image ?>">
                                    </div>
                                    <div class="card-body ">
                                        <h3 class="card-title fs-6 fs-7"><?= $product->name ?></h3>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <?php if ($product->price_sale == 0) : ?>
                                                <div class="col-md-6 col-12 mx-auto">
                                                    <h5 class="fs-6 fs-7 text-center text-orange"><?= number_format($product->price) ?>₫</h5>
                                                </div>
                                            <?php else : ?>
                                                <div class="col-md-6 col-6 mx-auto">
                                                    <h6 class="fs-6 fs-7 text-center text-orange"><?= number_format($product->price_sale) ?>₫</h6>
                                                </div>
                                                <div class="col-md-6 col-6 mx-auto">
                                                    <h6 class="fs-6 fs-7 text-center text-decoration-line-through text-muted "><?= number_format($product->price) ?>₫</h6>
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
                        <!--  -->
                    </div>
                </div>
                <!-- end Sách văn học -->


            </div>

        </div>
        <div class="row my-5">
            <div class="col-md-12 col-12 border-bottom border-4 px-0">
                <div class="heading1 ">
                    <h2 class="title">
                        <span class="d-md-inline-block d-none text-warning "> | </span>
                        <a href="#" class="text-decoration-none text-bl_gr">SÁCH CÙNG THƯƠNG HIỆU</a>
                    </h2>
                </div>
                <div class="d-md-block d-none">
                    <a class="text-decoration-none btn-tab text-bl_gr" href="#" title="Xem thêm">Xem thêm</a>
                </div>
            </div>
        </div>
        <!-- end top SÁCH CÙNG LOẠI -->
        <div class="product_slide">
            <div class="row mx-auto">
                <!--  -->

                <div class="col-md-12 mx-auto">
                    <!-- 1 -->
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php foreach ($list_product_b as $product) : ?>
                            <div class="col-md-2 col-6 ">
                                <div class="card text-center shadow-product port">
                                    <div class="card-header">
                                        <img src="public/images/product/<?= $product->image ?>" class="card-img-top img-product img-md-product-2x img-fluid rounded mx-auto d-block" alt="<?= $product->image ?>">
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
                                                    <h6 class="fs-6 fs-7 text-center text-orange"><?= number_format($product->price_sale) ?>₫</h6>
                                                </div>
                                                <div class="col-md-6 col-6 mx-auto">
                                                    <h6 class="fs-6 fs-7 text-center text-decoration-line-through text-muted "><?= number_format($product->price) ?>₫</h6>
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
                        <!--  -->
                    </div>
                </div>
                <!-- end Sách văn học -->


            </div>

        </div>
        <!-- end SÁCH CÙNG LOẠI  -->
        <?php if (count($product_list_f) > 0) : ?>
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
                            <?php foreach ($product_list_f as $product) : ?>
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



    </div>

</section>
<?php require_once('./views/frontend/footer.php') ?>