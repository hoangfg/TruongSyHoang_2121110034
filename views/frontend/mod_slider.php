<?php

use App\Models\Slider;

$list_slider = Slider::where([['position', '=', 'slideshow'], ['status', '=', 1]])->orderby('created_at', 'desc')->get();
?>
<div class="col-md-12 col-12 mx-auto">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $index = 1; ?>
            <?php foreach ($list_slider as $slider) : ?>
                <?php if ($index == 1) : ?>
                    <div class="carousel-item active ">
                        <img src="public/images/slider/<?= $slider->image ?>" alt="<?= $slider->image ?>" class="img-fluid d-block w-100">
                    </div>
                <?php else : ?>
                    <div class="carousel-item">
                        <img src="public/images/slider/<?= $slider->image ?>" alt="<?= $slider->image ?>" class="img-fluid d-block w-100">
                    </div>
                <?php endif; ?>
                <?php $index++; ?>
            <?php endforeach; ?>


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>