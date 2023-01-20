<?php

use App\Models\Post;
use App\Libraries\MyClass;
use App\Libraries\Pagination;

$limit = 6;
$page = Pagination::pageCurrent();
$skip = Pagination::pageOffset($page, $limit);


$title = "Tin tức";

$list_post = Post::where([['status', '=', 1], ['type', '=', 'post']])
    ->orderBy('created_at', 'desc')
    ->skip($skip)
    ->take($limit)
    ->get();
$total = Post::where([['status', '=', 1], ['type', '=', 'post']])
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
                <div class="row">
                    <div class="col-md-3">
                        <?php require_once('./views/frontend/mod_listtopic.php') ?>
                    </div>
                    <div class="col-md-9">
                        <div class="row row-cols-2 row-cols-md-3 g-4">
                            <?php foreach ($list_post as $post) : ?>
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="public/images/post/<?= $post->image ?>" class="card-img-top" alt="<?= $post->image ?>">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="index.php?option=post&slug=<?= $post->slug ?>" class="text-bl_gr text-limit-2"><?= $post->title ?></a>
                                            </h5>
                                            <span class="text-muted text-limit-5"><?= $post->detail ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="py-5"><?= Pagination::pageLinks($total, $page, $limit, "index.php?option=post"); ?></div>

            </div>
        </div>
    </div>
</section>
<?php require_once('./views/frontend/footer.php') ?>