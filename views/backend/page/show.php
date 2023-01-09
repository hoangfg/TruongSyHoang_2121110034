<?php

use App\Models\Post;
use App\Libraries\MyClass;

$id = $_REQUEST["id"];
$page = Post::find($id);
if ($page == null) {
    MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
    header("location:index.php?option=page");
}


?>

<?php require_once('../views/backend/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=page&cat=process" name="form1" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CHI TIẾT TRANG ĐƠN</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Chi tiết trang đơn</li>
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
                            <a class="btn btn-sm btn-info" href="index.php?option=page">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="index.php?option=page&cat=edit&id=<?= $page['id']; ?>">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="index.php?option=page&cat=delete&id=<?= $page['id']; ?>">
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
                                <td><?= $page['id'] ?></td>
                            </tr>
                            <tr>
                                <th>Mã chủ đề</th>
                                <td><?= $page['topic_id'] ?></td>
                            </tr>
                            <tr>
                                <th>Tiêu đề bài viết</th>
                                <td><?= $page['title'] ?></td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td><?= $page['slug'] ?></td>
                            </tr>
                            <tr>
                                <th>Chi tiết</th>
                                <td>
                                    <?= $page['detail'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Hình ảnh</th>
                                <td class="index-img">
                                    <img src="../public/images/page/<?= $page['image'] ?>" class="index-img" alt="<?= $page['image'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Kiểu</th>
                                <td>
                                    <?= $page['type'] ?>
                                </td>
                            </tr>

                            <tr>
                                <th>Từ khóa</th>
                                <td><?= $page['metakey'] ?></td>
                            </tr>
                            <tr>
                                <th>Mô tả</th>
                                <td><?= $page['metadesc'] ?></td>
                            </tr>

                            <tr>
                                <th>Ngày tạo</th>
                                <td><?= $page['created_at'] ?></td>
                            </tr>
                            <tr>
                                <th>Người tạo</th>
                                <td><?= $page['created_by'] ?></td>
                            </tr>
                            <tr>
                                <th>Ngày sửa cuối</th>
                                <td><?= $page['updated_at'] ?></td>
                            </tr>
                            <tr>
                                <th>Người sửa cuối</th>
                                <td><?= $page['updated_by'] ?></td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td><?= $page['status'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a class="btn btn-sm btn-info" href="index.php?option=page">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="index.php?option=page&cat=edit&id=<?= $page['id']; ?>">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="index.php?option=page&cat=delete&id=<?= $page['id']; ?>">
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