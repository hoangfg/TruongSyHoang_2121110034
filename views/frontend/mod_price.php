<!-- <?php
        $list_price = [
            ['min' => '0', 'max' => '1000'],
            ['min' => '1000', 'max' => '2000']
        ];
        ?>


<nav class="nav-topic my-3">
    <div class="card">
        <div class="card-header bg-orange text-center my-auto">
            <h3 class="fs-5 title m-0"><strong>Gia</strong></h3>
        </div>
        <div class="card-body">
            <ul class="list-group-numbered p-0">
                <?php foreach ($list_price as $key => $price) : ?>
                    <li class="text-start my-1 border-bottom border-1">
                        <input type='radio' name="filter_price" data-min="<?= $price['min'] ?>" data-max="<?= $price['max'] ?>">
                        <label><?= $price['min'] . "-" . $price['max'] ?></label>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</nav> -->