<?php

use App\Models\Product;
use App\Models\Post;
use App\Libraries\Pagination;

$keywork = isset($_REQUEST['keywork']) ? $_REQUEST['keywork'] : "";
$limit = 9;
$page = Pagination::pageCurrent();
$skip = Pagination::pageOffset($page, $limit);


$total_product = Product::where('status', '=', 1)
    ->where('name', 'like', '%' . $keywork . '%')
    ->count();
$total_post = Post::where('status', '=', 1)
    ->where('title', 'like', '%' . $keywork . '%')
    ->count();
$total = $total_product + $total_post;

$list_product = Product::where('status', '=', 1)
    ->where('name', 'like', '%' . $keywork . '%')
    ->orderBy('created_at', 'desc')
    ->skip($skip)
    ->take($limit)
    ->get();
$list_post = Post::where('status', '=', 1)
    ->where('title', 'like', '%' . $keywork . '%')
    ->orderBy('created_at', 'desc')
    ->skip($skip)
    ->take($limit)
    ->get();

$list_item = [];
foreach ($list_product as $product) {
    $item = array(
        'name' => $product->name,
        'slug' => $product->slug,
        'image' => "public/images/product/" . $product->image,
        'table' => 'product'
    );
    $list_item[] = $item;
}
foreach ($list_post as $post) {
    $item = array(
        'name' => $post->title,
        'slug' => $post->slug,
        'image' => "public/images/post/" . $post->image,
        'table' => $post->type
    );
    $list_item[] = $item;
}
$title = "Tìm kiếm thông tin";
?>

<?php require_once('views/frontend/header.php') ?>
<section class="maincontent py-5 bg-white">
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
                        <?php require_once('./views/frontend/mod_listcategory.php') ?>
                        <?php require_once('./views/frontend/mod_listbrand.php') ?>
                        <?php require_once('./views/frontend/mod_listtopic.php') ?>
                    </div>
                    <div class="col-md-9 col-12 float-md-none ">
                        <div class="row">
                            <h5>Từ khóa: <strong class="text-danger"><?= $keywork ?></strong></h5>
                        </div>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <?php foreach ($list_item as $it) : ?>

                                <div class="col-md-4 col-6">
                                    <div class="card h-100 text-center shadow-product  port">
                                        <div class="card-header position-relative">
                                            <img src='<?= $it["image"] ?>' alt="" class="card-img-top img-product img-md-product-3x">
                                        </div>
                                        <div class="card-body ">
                                            <h3 class="card-title fs-6 fs-7 text-bl_gr text-truncate"><?= $it['name'] ?></h3>
                                        </div>
                                        <div class="portfolioDisc">
                                            <a href="index.php?option=<?= $it['table'] ?>&slug=<?= $it['slug'] ?>" title="Xem" class="d-block m-auto"><i class="fs-3 btn btn-bg-green fa-solid fa-eye"></i></a>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- 2 -->


                            <!--  -->
                        </div>

                        <div class="py-5 mx-auto"><?= Pagination::pageLinks($total, $page, $limit, 'index.php?option=search'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('views/frontend/footer.php') ?>