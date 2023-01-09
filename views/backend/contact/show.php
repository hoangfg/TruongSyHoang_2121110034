<?php

use App\Models\Contact;
use App\Libraries\MyClass;

$id = $_REQUEST["id"];

$contact = Contact::find($id);
if ($contact == null) {
    MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
    header("location:index.php?option=contact");
}
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
                        <h1>Chi tiết danh mục</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Cập nhật danh mục</li>
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
                        <div class="col-md-12 text-right">
                            <a class="btn btn-sm btn-info" href="index.php?option=contact">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="index.php?option=contact&cat=edit&id=<?= $contact->id; ?>">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="index.php?option=contact&cat=delete&id=<?= $contact->id; ?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php include_once('../views/backend/messageAlert.php') ?>
                    <table class="table table-bordered border-primary table-hover ">
                        <thead class="bg-orange">
                            <tr class="fs-1">
                                <th width="30%">
                                    Tên trường
                                </th>
                                <th>
                                    Giá trị
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Id</th>
                                <td><?= $contact->id ?></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td><?= $contact->name ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= $contact->email ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?= $contact->phone ?></td>
                            </tr>
                            <tr>
                                <th>Title (tiêu đề)</th>
                                <td><?= $contact->title ?></td>
                            </tr>
                            <tr>
                                <th>detail (Nội dung câu hỏi) </th>
                                <td><?= $contact->detail ?></td>
                            </tr>
                            <tr>
                                <th>replaydetail (Nội dung câu trả lời)</th>
                                <td><?= $contact->replaydetail ?></td>
                            </tr>
                            <tr>
                                <th>Ngày tạo</th>
                                <td><?= $contact->created_at ?></td>
                            </tr>
                            <tr>
                                <th>Người tạo</th>
                                <td><?= $contact->created_by ?></td>
                            </tr>
                            <tr>
                                <th>Ngày sửa cuối</th>
                                <td><?= $contact->updated_at ?></td>
                            </tr>
                            <tr>
                                <th>Người sửa cuối</th>
                                <td><?= $contact->updated_by ?></td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td><?= $contact->status ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a class="btn btn-sm btn-info" href="index.php?option=contact">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="index.php?option=contact&cat=edit&id=<?= $contact->id; ?>">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="index.php?option=contact&cat=delete&id=<?= $contact->id; ?>">
                                <i class="fas fa-trash"></i>
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