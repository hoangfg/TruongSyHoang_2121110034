<?php

use App\Models\Order;

$list_order = Order::join('orderdetail', 'orderdetail.order_id', '=', 'order.id')
    ->join('user', 'user.id', '=', 'order.user_id')
    ->OrderBy('order.created_at', 'desc')
    ->select('user.name as user_name', 'user.email as user_email', 'user.phone as user_phone', 'order.*')
    ->distinct()
    ->get();

$list_status = [
    ['type' => 'secondary', 'text' => 'Đơn hàng mới'],
    ['type' => 'primary', 'text' => 'Đã xác nhận'],
    ['type' => 'info', 'text' => 'Đóng gói'],
    ['type' => 'warning', 'text' => 'Vận chuyển'],
    ['type' => 'success', 'text' => 'Đã giao'],
    ['type' => 'danger', 'text' => 'Đã hủy'],
];
?>

<?php require_once('../views/backend/header.php') ?>

<form action="index.php?option=order&cat=process" name="form1" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>TẤT CẢ ĐƠN HÀNG</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Tất cả đơn hàng</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-sm btn-danger" type="submit" name="DELETE_ALL">
                                <i class="fas fa-trash"></i> Xóa đã chọn
                            </button>
                        </div>
                        <!-- <div class="col-md-6 text-right">
                        <div class="text-right">
                            <a class="btn btn-sm btn-success" href="index.php?option=order&cat=create">
                                <i class="fas fa-plus"></i> Thêm
                            </a>

                        </div>
                    </div> -->
                    </div>
                </div>
                <div class="card-body">
                    <?php include_once('../views/backend/messageAlert.php') ?>

                    <table class="table table-bordered" id="myTable">
                        <thead class="bg-orange">
                            <tr>
                                <th class="text-center" style="width:5%">
                                    <div class="form-group select-all">
                                        <input type="checkbox">
                                    </div>
                                </th>
                                <th style="width:20%">Khách hàng</th>
                                <th style="width:20%">Email</th>
                                <th style="width:10%">Điện thoai</th>
                                <th class="text-center" style="width:15%">Ngày tạo</th>
                                <th class="text-center" style="width:15%">Trạng thái</th>
                                <th class="text-center" style="width:10%">Chức năng</th>
                                <th class="text-center" style="width:5%">ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_order as $order) : ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <input type="checkbox" name="checkId[]" value="<?= $order->id ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <?= $order['user_name'] ?>
                                    </td>
                                    <td>
                                        <?= $order['user_email'] ?>
                                    </td>
                                    <td>
                                        <?= $order['user_phone'] ?>
                                    </td>

                                    <td class="text-center">
                                        <?= $order['created_at'] ?>
                                    </td>
                                    <td>
                                        <span class='btn btn-sm btn-<?= $list_status[$order['status']]['type'] ?>'><?= $list_status[$order['status']]['text'] ?></span>
                                    </td>
                                    <td class=" text-center">

                                        <a class="btn btn-sm btn-info" href="index.php?option=order&cat=show&id=<?= $order['id']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a class="btn btn-sm btn-danger" href="index.php?option=order&cat=delete&id=<?= $order['id']; ?>">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <?= $order['id'] ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="col-md-6">
                        <button class="btn btn-sm btn-danger" type="submit" name="DELETE_ALL">
                            <i class="fas fa-trash"></i> Xóa đã chọn
                        </button>
                    </div>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</form>

<?php require_once('../views/backend/footer.php') ?>
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