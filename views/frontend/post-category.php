<?php

use App\Libraries\MyClass;
use App\Libraries\Pagination;
use App\Models\Post;
use App\Models\Topic;

$slug = $_REQUEST['cat'];
$topic = Topic::where('slug', '=', $slug)->first();
$limit = 2;
$page = Pagination::pageCurrent();
$skip = Pagination::pageOffset($page, $limit);
$list = Post::where([
    ['type', '=', 'post'], ['status', '=', '1'], ['topic_id', '=', $topic->id]
])->orderBy('created_at', 'desc')
    ->skip($skip)->take($limit)->get();
$total = Post::where([
    ['type', '=', 'post'],
    ['status', '=', '1'], ['topic_id', '=', $topic->id]
])->count();
?>
<?php require_once('views/frontend/header.php') ?>
<section class="post_all body container">
    <h2 class="text-center text-warning mb-2"><?= $topic->name ?></h2>

    <div class="row">
        <?php foreach ($list as $post) : ?>
            <div class="col-md-6 col-12">
                <a href="index.php?option=post&slug=<?= $post->slug ?>">
                    <div class="col-12">
                        <h5 class="text-info text-truncate"><?= $post->title ?></h5>
                    </div>
                    <div class="col-12 col-md-3"><img class="img-fluid" src="public/images/post/<?= $post->image ?>" alt="<?= $post->image ?>">
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="py-5"><?= Pagination::pageLinks($total, $page, $limit, "index.php?option=post&cat=$topic->slug"); ?>
    </div>

</section>
<?php require_once('views/frontend/footer.php') ?>