<?php

use App\Models\Menu;
use App\Libraries\MyClass;

$id = $_REQUEST["id"];

$menu = Menu::find($id);
if ($menu == null) {
    MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
    header("location:index.php?option=menu");
}
?>

<?php require_once('../views/backend/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=menu&cat=process" name="form1" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Chi tiết menu</h1>
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
                            <a class="btn btn-sm btn-info" href="index.php?option=menu">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="index.php?option=menu&cat=edit&id=<?= $menu->id; ?>">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="index.php?option=menu&cat=delete&id=<?= $menu->id; ?>">
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
                                <td><?= $menu->id ?></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td><?= $menu->name ?></td>
                            </tr>
                            <tr>
                                <th>Link</th>
                                <td><?= $menu->link ?></td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td><?= $menu->type ?></td>
                            </tr>
                            <tr>
                                <th>Table Id</th>
                                <td><?= $menu->table_id ?></td>
                            </tr>
                            <tr>
                                <th>Vị trí</th>
                                <td><?= $menu->position ?></td>
                            </tr>
                            <tr>
                                <th>Mức</th>
                                <td><?= $menu->level ?></td>
                            </tr>
                            <tr>
                                <th>Mã cấp cha</th>
                                <td><?= $menu->parent_id ?></td>
                            </tr>
                    
                            <tr>
                                <th>Ngày tạo</th>
                                <td><?= $menu->created_by ?></td>
                            </tr>
                            <tr>
                                <th>Người tạo</th>
                                <td><?= $menu->created_by ?></td>
                            </tr>
                            <tr>
                                <th>Ngày sửa cuối</th>
                                <td><?= $menu->updated_at ?></td>
                            </tr>
                            <tr>
                                <th>Người sửa cuối</th>
                                <td><?= $menu->updated_by ?></td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td><?= $menu->status ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a class="btn btn-sm btn-info" href="index.php?option=menu">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="index.php?option=menu&cat=edit&id=<?= $menu->id; ?>">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="index.php?option=menu&cat=delete&id=<?= $menu->id; ?>">
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