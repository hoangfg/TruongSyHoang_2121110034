<?php

use App\Models\Category;
use App\Libraries\MyClass;

$id = $_REQUEST["id"];

$category = Category::find($id);
if ($category == null) {
    MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
    header("location:index.php?option=category");
}
?>

<?php require_once('../views/backend/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=category&cat=process" name="form1" method="post" enctype="multipart/form-data">
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
                            <a class="btn btn-sm btn-info" href="index.php?option=category">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="index.php?option=category&cat=edit&id=<?= $category->id; ?>">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="index.php?option=category&cat=delete&id=<?= $category->id; ?>">
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
                                <td><?= $category->id ?></td>
                            </tr>
                            <tr>
                                <th>Tên danh mục</th>
                                <td><?= $category->name ?></td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td><?= $category->slug ?></td>
                            </tr>
                            <tr>
                                <th>Mã cấp cha</th>
                                <td><?= $category->parent_id ?></td>
                            </tr>
                            <tr>
                                <th>Sắp xếp</th>
                                <td><?= $category->sort_order ?></td>
                            </tr>
                            <tr>
                                <th>Hình đại diện</th>
                                <td class="index-img">
                                    <img src="../public/images/category/<?= $category->image ?>" class="card-img-top index-img" alt="<?= $category->image ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Từ khóa tìm kiếm</th>
                                <td><?= $category->metakey ?></td>
                            </tr>
                            <tr>
                                <th>Mô tả</th>
                                <td><?= $category->metadesc ?></td>
                            </tr>
                            <tr>
                                <th>Ngày tạo</th>
                                <td><?= $category->created_at ?></td>
                            </tr>
                            <tr>
                                <th>Người tạo</th>
                                <td><?= $category->created_by ?></td>
                            </tr>
                            <tr>
                                <th>Ngày sửa cuối</th>
                                <td><?= $category->updated_at ?></td>
                            </tr>
                            <tr>
                                <th>Người sửa cuối</th>
                                <td><?= $category->updated_by ?></td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td><?= $category->status ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a class="btn btn-sm btn-info" href="index.php?option=category">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="index.php?option=category&cat=edit&id=<?= $category->id; ?>">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="index.php?option=category&cat=delete&id=<?= $category->id; ?>">
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