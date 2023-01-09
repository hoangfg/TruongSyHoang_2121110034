<?php

use App\Models\Category;

$listcategory1 = Category::where([['parent_id', '=', 0], ['status', '=', 1]])
    ->orderBy('sort_order', 'asc')
    ->get();
?>

<nav class="nav-category my-3">
    <div class="card">
        <div class="card-header bg-orange text-center my-auto">
            <h3 class="fs-5 title m-0"><strong>Danh mục</strong></h3>
        </div>
        <div class="card-body">
            <ul class="navcat list-group-numbered p-0">
                <li><a href="index.php?option=product" class="text-decoration-none text-bl_gr d-block text-start my-1 border-bottom border-1">Tất cả sản phẩm</a></li>
                <?php foreach ($listcategory1 as $rowcat1) : ?>
                    <?php
                    $listcategory2 = Category::where([['parent_id', '=', $rowcat1->id], ['status', '=', 1]])
                        ->orderBy('sort_order', 'asc')
                        ->get();
                    ?>
                    <li><a href="index.php?option=product&cat=<?= $rowcat1->slug ?>" class="text-decoration-none text-bl_gr d-block text-decoration-none text-bl_gr d-block text-start my-1 border-bottom border-1"><?= $rowcat1->name ?></a></li>
                    <?php if (count($listcategory2) != 0) : ?>
                        <ul class="sub">
                            <?php foreach ($listcategory2 as $rowcat2) : ?>
                                <li><a href="index.php?option=product&cat=<?= $rowcat2->slug ?>" class="text-decoration-none text-bl_gr d-block text-start my-1 border-bottom border-1"><?= $rowcat2->name ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</nav>