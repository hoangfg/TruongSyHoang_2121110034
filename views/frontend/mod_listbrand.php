<?php

use App\Models\Brand;

$list_brand = Brand::where('status', '=', 1)
    ->get();
?>


<nav class="nav-brand my-3">
    <div class="card">
        <div class="card-header bg-orange text-center my-auto">
            <h3 class="fs-5 title m-0"><strong>THƯƠNG HIỆU</strong></h3>
        </div>
        <div class="card-body">
            <ul class="list-group-numbered p-0">
                <?php foreach ($list_brand as $brand1) : ?>

                    <li class="text-start my-1 border-bottom border-1"><a href="index.php?option=brand&cat=<?= $brand1->slug ?>" class="list-group-numbered  text-decoration-none text-bl_gr d-block"><?= $brand1->name ?></a></li>

                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</nav>