<?php

use App\Models\Post;

$slug = $_REQUEST['slug'];
$post = Post::where([['status', '=', 1], ['type', '=', 'post'], ['slug', '=', $slug]])->first();
$list_post = Post::where([['status', '=', 1], ['type', '=', 'post'], ['slug', '!=', $slug]])
    ->orderBy('created_at', 'desc')
    ->take(10)
    ->get();
$title = $post['title'];
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
                <div class="page-title">
                    <h2 class="title-head">
                        <a href="#" class="text-bl_gr"><?= $title ?></a>
                    </h2>
                </div>
            </div>
        </div>
        <div class="row py-5 ">
            <div class="col-md-10 col-12 mx-auto bg-white">
                <div class="row">
                    <!-- -------------------------- -->
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header mx-auto">
                                <a href="./list_post-detail.html"><img src="public/images/post/<?= $post->image ?>" class="ư-100 card-img-top img-product img-md-product-3x" alt="<?= $post->image ?>"></a>
                            </div>
                            <div class=" row card-body">
                                <h3 class="card-title fs-3 text-bl_gr m-0 text-center"><?= $post->title ?></h3>
                                <div class="col-md-12 border-end border-1">
                                    <div class="row">
                                        <p class="text-muted "><?= $post->detail ?></p>
                                    </div>
                                    <div class="row">
                                        <p class="card-text mb-0">Nội dung: </p>
                                        <p class="card-text m-0"><small class="text-muted">Thông tin sách đang được cập nhật</small></p>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end list_post-detail -->
            <div class="row my-5">
                <div class="col-md-12 col-12 border-bottom border-4 px-0">
                    <div class="heading1 ">
                        <h2 class="title">
                            <span class="d-md-inline-block d-none text-warning "> | </span>
                            <a href="index.php?option=post" class="text-decoration-none text-bl_gr">TIN TỨC KHÁC</a>
                        </h2>
                    </div>
                    <div class="d-md-block d-none">
                        <a class="text-decoration-none btn-tab text-bl_gr" href="index.php?option=post" title="Xem thêm">Xem thêm</a>
                    </div>
                </div>
            </div>
            <!-- end top SÁCH CÙNG LOẠI -->
            <div class="post_slide">
                <div class="row mx-auto">
                    <!--  -->

                    <div class="col-md-12 mx-auto">
                        <!-- 1 -->
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <?php foreach ($list_post as $list_post) : ?>
                                <div class="col-md-2 col-6">
                                    <div class="card h-100 text-center shadow-product  port">
                                        <img src="public/images/post/<?= $list_post->image ?>" class="card-img-top" alt="<?= $list_post->image ?>">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="index.php?option=post&slug=<?= $list_post->slug ?>" class="text-bl_gr text-limit-2"><?= $list_post->title ?></a>
                                            </h5>
                                            <span class="text-muted text-limit-5"><?= $list_post->detail ?></span>
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

        </div>
</section>
<?php require_once('./views/frontend/footer.php') ?>