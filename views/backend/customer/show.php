<?php

use App\Models\User;
use App\Libraries\MyClass;

$id = $_REQUEST["id"];

$customer = User::find($id);
if ($customer == null) {
    MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
    header("location:index.php?option=customer");
}
?>

<?php require_once('../views/backend/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=customer&cat=process" name="form1" method="post" enctype="multipart/form-data">
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
                            <a class="btn btn-sm btn-info" href="index.php?option=customer">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="index.php?option=customer&cat=edit&id=<?= $customer->id; ?>">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="index.php?option=customer&cat=delete&id=<?= $customer->id; ?>">
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
                                <td><?= $customer->id ?></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td><?= $customer->name ?></td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td><?= $customer->slug ?></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td><?= $customer->username ?></td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td><?= $customer->password ?></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td><?= $customer->gender ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?= $customer->phone ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= $customer->email ?></td>
                            </tr>
                            <tr>
                                <th>Avatar</th>
                                <td class="index-img">
                                    <img src="../public/images/user/<?= $customer->image ?>" class="card-img-top index-img" alt="<?= $customer->image ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Roles</th>
                                <td><?= $customer->roles ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td><?= $customer->address ?></td>
                            </tr>
                            <tr>
                                <th>Ngày tạo</th>
                                <td><?= $customer->created_at ?></td>
                            </tr>
                            <tr>
                                <th>Người tạo</th>
                                <td><?= $customer->created_by ?></td>
                            </tr>
                            <tr>
                                <th>Ngày sửa cuối</th>
                                <td><?= $customer->updated_at ?></td>
                            </tr>
                            <tr>
                                <th>Người sửa cuối</th>
                                <td><?= $customer->updated_by ?></td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td><?= $customer->status ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a class="btn btn-sm btn-info" href="index.php?option=customer">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="index.php?option=customer&cat=edit&id=<?= $customer->id; ?>">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="index.php?option=customer&cat=delete&id=<?= $customer->id; ?>">
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