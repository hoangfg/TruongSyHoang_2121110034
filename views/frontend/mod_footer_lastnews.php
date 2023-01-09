<?php

use App\Models\Post;

$list_lastnew = Post::where([['status', '=', 1], ['type', '=', 'post']])
    ->orderBy('created_at', 'desc')
    ->take(3)
    ->get();
?>
<h4 class="fs-3 my-4">
    Bài viết mới
</h4>
<?php $index = 1; ?>
<?php foreach ($list_lastnew as $lastnew) : ?>
    <a href="index.php?option=post&slug=<?= $lastnew->slug; ?>">
        <div class="row">
            <div class="col-md-3 col-3">
                <img src="public/images/post/<?= $lastnew->image; ?>" alt="<?= $lastnew->image; ?>" class="img-fluid">
            </div>
            <div class="col-md-9 col-9">
                <p class="fs-7 fs-6 text-decoration-none text-bl_gr d-block"><?= $lastnew->title; ?></p>
                <h6 style="font-size: 10px;" class="text-decoration-none text-bl_gr d-block"><strong>Date: </strong><?= date_format($lastnew->created_at, "d/m/y"); ?></h6>
            </div>
        </div>
    </a>
    <?= ($index != 3) ? '<hr>' : ''; ?>
    <?php $index++ ?>
<?php endforeach; ?>