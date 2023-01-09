<?php

use App\Models\Product;

$content_cart = null;
if (isset($_SESSION['contentcart'])) {
    $content_cart = $_SESSION['contentcart'];
}
?>

<?php require_once('views/frontend/header.php') ?>
<form action="index.php?option=cart" method="post">

    <section class="mycontent">
        <div class="container">
            <div class="col-md-10 mx-auto">
                <h1 class="text-center py-3 text-bl_gr">
                    Giỏ hàng của bạn
                </h1>
                <?php if ($content_cart != null) : ?>
                    <table class="table table-bordered ">
                        <tr class="bg-orange">
                            <th class="text-center" style="width:5%">ID</th>
                            <th class="text-center" style="width:10%">Hình</th>
                            <th class="text-center" style="width:25%">Tên sản phẩm</th>
                            <th class="text-center" style="width:15%">Giá</th>
                            <th class="text-center" style="width:10%">Số lượng</th>
                            <th class="text-center" style="width:20%">Thành tiền</th>
                            <th class="text-center" style="width:15%">Chức năng</th>

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
                                    <input type="number" name="qty[<?= $cart['id']; ?>]" value="<?= $cart['qty']; ?>" style="width:50px" min="1">
                                </td>
                                <td><?= number_format($cart['amount']); ?>₫</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-danger " href="index.php?option=cart&delcart=<?= $cart['id']; ?>">
                                        <i class="fas fa-trash "></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $total_money += $cart['amount']; ?>
                        <?php endforeach; ?>
                        <tr>
                            <th colspan="4">
                                <a class="btn btn-sm btn-danger " href="index.php?option=cart&delcart=all">
                                    Xóa tất cả
                                </a>
                                <input class="btn btn-sm  btn-success" type="submit" name="updateCart" value="Cập nhật"></input>
                                <a class="btn btn-sm  btn-info" href="index.php?option=cart&checkout=true">Thanh toán</a>
                            </th>
                            <th colspan="3" class="text-end text-danger"><strong>Tổng tiền: <?= number_format($total_money); ?>₫</strong></th>
                        </tr>
                    </table>
                <?php else : ?>
                    <h3 class="text-center text-danger py-2">Chưa có sản phẩm</h3>
                <?php endif; ?>
            </div>
        </div>
    </section>

</form>
<?php require_once('views/frontend/footer.php') ?>