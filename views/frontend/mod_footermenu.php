<?php

use App\Models\Menu;

$arg_footermenu = [
    ['parent_id', '=', '0'],
    ['status', '=', '1'],
    ['position', '=', 'footermenu']
];
$list_menu = Menu::where($arg_footermenu)->orderBy('sort_order', 'desc')->get();
?>
<h4 class="fs-3 my-4">
    Về chúng tôi
</h4>
<ul>
    <?php foreach ($list_menu as $fmenu) : ?>
        <li><a href="<?= $fmenu->link; ?>" class="text-decoration-none text-bl_gr d-block"><?= $fmenu->name; ?></a></li>
    <?php endforeach; ?>
</ul>