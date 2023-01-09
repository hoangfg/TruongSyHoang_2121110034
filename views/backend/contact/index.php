<?php

use App\Libraries\MyClass;
use App\Models\Contact;
//truy van du lieu trong contact


$list_contact = Contact::where('status',  '!=', '0')

    ->orderBy('created_at', 'desc')
    ->get();
?>

<?php require_once('../views/backend/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=contact&cat=process" name="form1" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>TẤT CẢ LIÊN HỆ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Tất cả liên hệ</li>
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

                                <a class="btn btn-sm btn-danger" href="index.php?option=contact&cat=trash">
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
                                <th style="width:20%">Họ & Tên</th>
                                <th style="width:15%">Email</th>
                                <th style="width:10%">Điện thoai</th>
                                <th class="text-center" style="width:15%">Trạng thái</th>
                                <th class="text-center" style="width:15%">Ngày tạo</th>
                                <th class="text-center" style="width:15%">Chức năng</th>
                                <th class="text-center" style="width:5%">ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_contact as $contact) : ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <input type="checkbox" name="checkId[]" value="<?= $contact->id ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <?= $contact->name ?>
                                    </td>
                                    <td>
                                        <?= $contact->email ?>
                                    </td>
                                    <td>
                                        <?= $contact->phone ?>
                                    </td>
                                    <td>
                                        <?php if (empty(trim($contact->replaydetail))) : ?>
                                            <a class="btn btn-sm btn-danger">
                                                Liên hệ mới
                                            </a>
                                        <?php else : ?>
                                            <a class="btn btn-sm btn-success">
                                                Đã trả lời
                                            </a>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center">
                                        <?= $contact->created_at ?>
                                    </td>
                                    <td class="text-center">

                                        <a class="btn btn-sm btn-info" href="index.php?option=contact&cat=show&id=<?= $contact->id; ?>">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-primary" href="index.php?option=contact&cat=replay&id=<?= $contact->id; ?>">
                                            <i class=" fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger" href="index.php?option=contact&cat=delete&id=<?= $contact->id; ?>">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <?= $contact->id ?>
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
                            <a class="btn btn-sm btn-danger" href="index.php?option=contact&cat=trash">
                                <i class="fas fa-trash" aria-hidden="true"></i> Xóa
                            </a>
                        </div>
                        <div class="col-md-6 text-right">

                            <a class="btn btn-sm btn-danger" href="index.php?option=contact&cat=trash">
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