<?php

use App\Models\Product;
use App\Models\User;
use App\Models\Order;


$content_cart = null;
if (isset($_SESSION['contentcart'])) {
    $content_cart = $_SESSION['contentcart'];
}
?>
<?php if (!isset($_SESSION['logincustomer'])) : ?>
    <?php header('location:index.php?option=customer-login'); ?>
<?php else : ?>

    <?php require_once('views/frontend/header.php') ?>
    <form action="index.php?option=cart&checkoutcart=true" method="post">

        <section class="mycontent">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="row">
                            <div class="col-md-3 mx-auto ">
                                <div class="card ">
                                    <h5 class="text-center text-bl_gr py-3  border-bottom border-2 border-info ">THÔNG TIN NGƯỜI NHẬN</h5>

                                    <div class="card-body">
                                        <div class="mb-3">

                                            <label for="deliveryname">Tên khách hàng</label>
                                            <input name="deliveryname" id="deliveryname" type="text" placeholder="Họ và tên" class="form-control ">
                                        </div>
                                        <div class="mb-3">

                                            <label for="deliveryemail">Email</label>
                                            <input name="deliveryemail" id="deliveryemail" type="email" placeholder="email" class="form-control ">
                                        </div>
                                        <div class="mb-3">

                                            <label for="deliveryphone">Phone</label>
                                            <input name="deliveryphone" id="deliveryphone" type="text" placeholder="phone" class="form-control " >
                                        </div>
                                        <div class="mb-3">

                                            <label for="deliveryaddress">Địa chỉ</label>
                                            <input name="deliveryaddress" id="deliveryaddress" type="text" placeholder="address" class="form-control " >
                                        </div>
                                        <div class="mb-3 text-center">
                                            <button type="submit" class="btn btn-success btn-md ">Thanh toán</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 mx-auto">
                                <div class="card">
                                    <h5 class="text-center py-3 text-bl_gr  border-bottom border-2 border-info ">
                                        GIỎ HÀNG CỦA BẠN
                                    </h5>
                                    <?php if ($content_cart != null) : ?>
                                        <table class="table table-bordered ">
                                            <tr class="bg-orange">
                                                <th class="text-center" style="width:5%">ID</th>
                                                <th class="text-center" style="width:10%">Hình</th>
                                                <th class="text-center" style="width:40%">Tên sản phẩm</th>
                                                <th class="text-center" style="width:15%">Giá</th>
                                                <th class="text-center" style="width:15%">Số lượng</th>
                                                <th class="text-center" style="width:15%">Thành tiền</th>

                                            </tr>
                                            <?php $total_money = 0 ?>
                                            <?php foreach ($content_cart as $cart) : ?>
                                                <?php
                                                $product = Product::find($cart['id']);
                                                ?>
                                                <tr>
                                                    <td><?= $cart['id']; ?></td>
                                                    <td>
                                                        <img src="public/images/product/<?= $product->image ?>" class="img-fluid" alt="<?= $product->image ?>">
                                                    </td>
                                                    <td><?= $product->name; ?></td>
                                                    <td><?= number_format($cart['price']); ?>₫</td>
                                                    <td>
                                                        <?= $cart['qty']; ?>
                                                    </td>
                                                    <td><?= number_format($cart['amount']); ?>₫</td>

                                                </tr>
                                                <?php $total_money += $cart['amount']; ?>
                                            <?php endforeach; ?>

                                        </table>
                                    <?php else : ?>
                                        <h3 class="text-center text-danger py-2">Chưa có sản phẩm</h3>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </form>
    <?php require_once('views/frontend/footer.php') ?>
<?php endif; ?>