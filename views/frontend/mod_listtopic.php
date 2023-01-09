<?php

use App\Models\Topic;

$list_topic = Topic::where('status', '=', 1)
    ->get();
?>


<nav class="nav-topic my-3">
    <div class="card">
        <div class="card-header bg-orange text-center my-auto">
            <h3 class="fs-5 title m-0"><strong>Chủ đề bài viết</strong></h3>
        </div>
        <div class="card-body">
            <ul class="list-group-numbered p-0">
                <?php foreach ($list_topic as $topic1) : ?>
                    <?php
                    $list_topic_2 = Topic::where([['parent_id', '=', $topic1->id], ['status', '=', 1]])
                        ->orderBy('sort_order', 'asc')
                        ->get();
                    ?>
                    <li class="text-start my-1 border-bottom border-1"><a href="index.php?option=topic&cat=<?= $topic1->slug ?>" class="list-group-numbered  text-decoration-none text-bl_gr d-block"><?= $topic1->name ?></a></li>
                    <?php if (count($list_topic_2) != 0) : ?>
                        <ul class="sub">
                            <?php foreach ($list_topic_2 as $topic2) : ?>
                                <li><a href="index.php?option=topic&cat=<?= $topic2->slug ?>" class="text-decoration-none text-bl_gr d-block text-start my-1 border-bottom border-1"><?= $topic2->name ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</nav>