<?php

use App\Models\Post;

$slug = $_REQUEST['slug'];
$page = Post::where([['status', '=', 1], ['type', '=', 'page'], ['slug', '=', $slug]])->first();
$list_page = Post::where([['status', '=', 1], ['type', '=', 'page'], ['slug', '!=', $slug]])
    ->orderBy('created_at', 'desc')
    ->take(10)
    ->get();
$title = $page->title;
?>

<?php require_once('./views/frontend/header.php') ?>
<section class="mycontent py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-12 mx-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./index.html" class="text-bl_gr">Trang chủ</a></li>
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
                                <a href="./list_page-detail.html"><img src="public/images/post/<?= $page->image ?>" class="ư-100 card-img-top img-product img-md-product-3x" alt="<?= $page->image ?>"></a>
                            </div>
                            <div class=" row card-body">
                                <h3 class="card-title fs-3 text-bl_gr m-0 text-center"><?= $page->title ?></h3>
                                <div class="col-md-12 border-end border-1">
                                    <div class="row">
                                        <p class="text-muted "><?= $page->detail ?></p>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end list_page-detail -->
            <div class="row my-5">
                <div class="col-md-12 col-12 border-bottom border-4 px-0">
                    <div class="heading1 ">
                        <h2 class="title">
                            <span class="d-md-inline-block d-none text-warning "> | </span>
                            <a href="index.php?option=post" class="text-decoration-none text-bl_gr">TIN TỨC KHÁC</a>
                        </h2>
                    </div>
                    <div class="d-md-block d-none">
                        <a class="text-decoration-none btn-tab text-bl_gr" href="index.php?option=page&cat=gioi-thieu" title="Xem thêm">Xem thêm</a>
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
                            <?php foreach ($list_page as $page_1) : ?>
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
                            <!--  -->
                        </div>
                    </div>
                    <!-- end Sách văn học -->


                </div>

            </div>

        </div>
</section>
<?php require_once('./views/frontend/footer.php') ?>