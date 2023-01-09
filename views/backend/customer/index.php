<?php

use App\Models\User;

$list_customer = User::where([['status', '!=', '0'], ['roles', '=', '0']])
    ->orderBy('created_at', 'desc')->get();
?>

<?php require_once('../views/backend/header.php') ?>

<form action="index.php?option=customer&cat=process" name="form1" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>TẤT CẢ DANH MỤC</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Tất cả danh mục</li>
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
                        <div class="col-md-6 text-right">
                            <div class="text-right">
                                <a class="btn btn-sm btn-success" href="index.php?option=customer&cat=create">
                                    <i class="fas fa-plus"></i> Thêm
                                </a>
                                <a class="btn btn-sm btn-danger" href="index.php?option=customer&cat=trash">
                                    <i class="fas fa-trash"></i> Thùng rác
                                </a>
                            </div>
                        </div>
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
                                <th class="text-center" style="width:10%">Hình</th>
                                <th style="width:20%">Tên tài khoản</th>
                                <th style="width:20%">Email</th>
                                <th style="width:10%">Phone</th>
                                <th class="text-center" style="width:15%">Ngày tạo</th>
                                <th style="width:15%" class="text-center">Chức năng</th>
                                <th class="text-center" style="width:5%">ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_customer as $customer) : ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <input type="checkbox" name="checkId[]" value="<?= $customer->id ?>">
                                        </div>
                                    </td>
                                    <td class="index-img">
                                        <?php if ($customer->image == null) : ?>
                                            <?php if ($customer->gender == 0) : ?>
                                                <img src="../public/images/user/male.png" class="card-img-top index-img" alt="male">
                                            <?php else : ?>
                                                <img src="../public/images/user/female.png" class="card-img-top index-img" alt="female">

                                            <?php endif; ?>
                                        <?php else : ?>
                                            <img src="../public/images/user/<?= $customer->image ?>" class="card-img-top index-img" alt="<?= $customer->image ?>">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= $customer->name ?>
                                    </td>
                                    <td>
                                        <?= $customer->email ?>
                                    </td>
                                    <td>
                                        <?= $customer->phone ?>
                                    </td>

                                    <td class="text-center">
                                        <?= $customer->created_at ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($customer->status == 1) : ?>
                                            <a class="btn btn-sm btn-success" href="index.php?option=customer&cat=status&id=<?= $customer->id; ?>">
                                                <i class="fas fa-toggle-on"></i>
                                            </a>
                                        <?php else : ?>
                                            <a class="btn btn-sm btn-danger" href="index.php?option=customer&cat=status&id=<?= $customer->id; ?>">
                                                <i class="fas fa-toggle-off"></i>
                                            </a>
                                        <?php endif; ?>
                                        <a class="btn btn-sm btn-info" href="index.php?option=customer&cat=show&id=<?= $customer->id; ?>">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-primary" href="index.php?option=customer&cat=edit&id=<?= $customer->id; ?>">
                                            <i class=" fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger" href="index.php?option=customer&cat=delete&id=<?= $customer->id; ?>">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <?= $customer->id ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-sm btn-danger" href="index.php?option=customer&cat=trash">
                                <i class="fas fa-trash" aria-hidden="true"></i> Xóa
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-sm btn-success" href="index.php?option=customer&cat=create">
                                <i class="fas fa-plus"></i> Thêm
                            </a>
                            <a class="btn btn-sm btn-danger" href="index.php?option=customer&cat=trash">
                                <i class="fas fa-trash"></i> Thùng rác
                            </a>
                        </div>
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