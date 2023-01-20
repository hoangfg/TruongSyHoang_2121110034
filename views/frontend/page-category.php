<?php

use App\Models\Post;
use App\Libraries\Pagination;

$slug = $_REQUEST['cat'];
$limit = 4;
$page = Pagination::pageCurrent();
$skip = Pagination::pageOffset($page, $limit);
$page_a = Post::where([['status', '=', 1], ['type', '=', 'page'], ['slug', '=', $slug]])->first();
$title = "Giới thiệu";
$list_page_other = Post::where([['status', '=', 1], ['type', '=', 'page']])
    ->orderBy('created_at', 'desc')
    ->skip($skip)
    ->take($limit)
    ->get();
$total = Post::where([['status', '=', 1], ['type', '=', 'page']])
    ->count();

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
        <!-- 0 -->

        <div class="row">
            <div class="col-md-10 col-12 mx-auto">
                <div class="row row-cols-2 row-cols-md-3 g-4">
                    <?php foreach ($list_page_other as $page_1) : ?>
                        <div class="col-md-3 col-6">
                            <div class="card h-100 text-center shadow-product  port">
                                <div class="card-header">
                                    <img src="public/images/post/<?= $page_1->image ?>" class="card-img-top img-product img-md-product-2x " alt="<?= $page_1->image ?>">
                                </div>
                                <div class="card-body ">
                                    <h5 class="card-title">
                                        <a href="index.php?option=page&slug=<?= $page_1->slug ?>" class="text-bl_gr text-limit-2"><?= $page_1->title ?></a>
                                    </h5>
                                    <span class="text-muted text-limit-5"><?= $page_1->detail ?></span>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="py-5"><?= Pagination::pageLinks($total, $page, $limit, "index.php?option=page&cat"); ?></div>

            </div>
        </div>
    </div>
</section>
<?php require_once('./views/frontend/footer.php') ?>