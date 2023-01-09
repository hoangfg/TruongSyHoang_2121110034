<?php

use App\Models\Order;
use App\Models\Orderdetail;
use App\Libraries\MyClass;
use App\Models\Product;

$id = $_REQUEST['id'];

$order = Order::join('user', 'user.id', '=', 'order.user_id')
    ->where('order.id', '=', $id)->first();

$list_orderdetail = Product::join('Orderdetail', 'product.id', '=', 'orderdetail.product_id')
    ->select('*', 'product.price as product_price', 'product.qty as product_qty')
    ->where('orderdetail.order_id', '=', $id)
    ->get();


if ($order == null) {
    MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
    header("location:index.php?option=order");
}

$tong = 0;
?>

<?php require_once('../views/backend/header.php'); ?>
<!-- Content Wrapper. Contains order content -->
<form action="index.php?option=order&cat=status" name="form1" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CHI TIẾT ĐƠN HÀNG</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12 text-right">
                        <a class="btn btn-sm btn-primary" href="index.php?option=order&cat=status&type=xacnhan&id=<?= $id; ?>">Xác nhận</a>
                        <a class="btn btn-sm btn-info" href="index.php?option=order&cat=status&type=donggoi&id=<?= $id; ?>">Đóng gói</a>
                        <a class="btn btn-sm btn-warning" href="index.php?option=order&cat=status&type=vanchuyen&id=<?= $id; ?>">Vận chuyển</a>
                        <a class="btn btn-sm btn-success" href="index.php?option=order&cat=status&type=dagiao&id=<?= $id; ?>">Đã giao</a>
                        <a class="btn btn-sm btn-danger" href="index.php?option=order&cat=status&type=huy&id=<?= $id; ?>">Hủy</a>
                        <a class="btn btn-sm btn-info " href="index.php?option=order">
                            <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <h5 class="text-center text-info my-1 pt-2">THÔNG TIN KHÁCH HÀNG</h5>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <input type="hidden" name="id" value="<?= $order->id ?>">
                                        <label for="deliveryname">Tên người nhận</label>
                                        <input name="deliveryname" id="deliveryname" type="text" value="<?= $order->deliveryname ?>" class="form-control " disabled>
                                    </div>
                                    <div class="mb-3">

                                        <label for="deliveryemail">Email</label>
                                        <input name="deliveryemail" id="deliveryemail" type="email" value="<?= $order->deliveryemail ?>" class="form-control " disabled>
                                    </div>
                                    <div class="mb-3">

                                        <label for="deliveryphone">Phone</label>
                                        <input name="deliveryphone" id="deliveryphone" type="text" value="<?= $order->deliveryphone ?>" class="form-control " disabled>
                                    </div>
                                    <div class="mb-3">

                                        <label for="deliveryaddress">Địa chỉ</label>
                                        <input name="deliveryaddress" id="deliveryaddress" type="text" value="<?= $order->deliveryaddress ?>" class="form-control " disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <h5 class="text-center text-info my-1 pt-2">CHI TIẾT HÓA ĐƠN</h5>
                                <div class="card-body">
                                    <table class="table table-bordered" id="myTable">
                                        <thead class="bg-orange">
                                            <tr>
                                                <th class="text-center" style="width:2%"><input type="checkbox"></th>
                                                <th class="text-center" style="width:15%">Hình</th>
                                                <th class="text-center" style="width:25%">Tên danh mục</th>
                                                <th class="text-center" style="width:15%">Giá</th>

                                                <th class="text-center" style="width:15%px">Số lượng</th>
                                                <th class="text-center" style="width:15%px">Thành tiền</th>
                                                <th class="text-center" style="width:10%px">ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php foreach ($list_orderdetail as $orderdetail) : ?>
                                                <tr>
                                                    <td class="text-center" style="width:20px">
                                                        <input type="checkbox">
                                                    </td>
                                                    <td class="index-img">
                                                        <img src="../public/images/product/<?= $orderdetail->image ?>" class="card-img-top index-img" alt="<?= $orderdetail->image ?>">
                                                    </td>
                                                    <td>
                                                        <?= $orderdetail->name ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($orderdetail->price) ?>₫
                                                    </td>
                                                    <td>
                                                        <?= $orderdetail->qty ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($orderdetail->amount) ?>₫

                                                    </td>
                                                    <td class="text-center" style="width:20px">
                                                        <?= $orderdetail->id ?>
                                                    </td>
                                                </tr>
                                                <?php

                                                $tong += $orderdetail->amount;
                                                ?>
                                            <?php endforeach; ?>

                                        </tbody>


                                    </table>
                                    <div class="text-danger">
                                        <h5><strong>Tổng tiền:<?= number_format($tong); ?>₫</strong></h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="col-md-12 text-right">
                        <a class="btn btn-sm btn-primary" href="index.php?option=order&cat=status&type=xacnhan&id=<?= $id; ?>">Xác nhận</a>
                        <a class="btn btn-sm btn-info" href="index.php?option=order&cat=status&type=donggoi&id=<?= $id; ?>">Đóng gói</a>
                        <a class="btn btn-sm btn-warning" href="index.php?option=order&cat=status&type=vanchuyen&id=<?= $id; ?>">Vận chuyển</a>
                        <a class="btn btn-sm btn-success" href="index.php?option=order&cat=status&type=dagiao&id=<?= $id; ?>">Đã giao</a>
                        <a class="btn btn-sm btn-danger" href="index.php?option=order&cat=status&type=huy&id=<?= $id; ?>">Hủy</a>
                        <a class="btn btn-sm btn-info " href="index.php?option=order">
                            <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

</form>
<!-- /.content-wrapper -->
<?php require_once('../views/backend/footer.php'); ?>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [7, 9, 11, -1],
                [7, 9, 11, "ALL"],
            ],
            responsive: true
        });
    });
</script>