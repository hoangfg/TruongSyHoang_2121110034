<?php

use App\Models\Category;
use App\Libraries\Pagination;
use App\Libraries\MyClass;
//truy van du lieu trong category


$list_category = Category::where('status',  '=', '0')

    ->orderBy('created_at', 'desc')
    ->get();

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
                        <h1>Thùng rác</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Thùng rác danh mục</li>
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
                            <button class="btn btn-sm btn-danger" type="submit" name="DESTROY_ALL">
                                <i class="fas fa-trash"></i> Xóa đã chọn
                            </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-sm btn-info" href="index.php?option=category">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
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
                                <th style="width:20%">Tên danh mục</th>
                                <th style="width:20%">Slug</th>
                                <th class="text-center" style="width:20%">Ngày tạo</th>
                                <th class="text-center" style="width:20%">Chức năng</th>
                                <th class="text-center" style="width:5%">ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_category as $category) : ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <input type="checkbox" name="checkId[]" value="<?= $category->id ?>">
                                        </div>
                                    </td>
                                    <td class="index-img">
                                        <img src="../public/images/category/<?= $category->image ?>" class="card-img-top index-img" alt="<?= $category->image ?>">
                                    </td>
                                    <td>
                                        <?= $category->name ?>
                                    </td>
                                    <td>
                                        <?= $category->slug ?>
                                    </td>

                                    <td class="text-center">
                                        <?= $category->created_at ?>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-info" href="index.php?option=category&cat=show&id=<?= $category->id; ?>">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-primary" href="index.php?option=category&cat=restore&id=<?= $category->id; ?>">
                                            <i class="fas fa-undo-alt"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger" href="index.php?option=category&cat=destroy&id=<?= $category->id; ?>">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    <td class="text-center" >
                                        <?= $category->id ?>
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
                            <a class="btn btn-sm btn-danger" href="index.php?option=category&cat=destroy">
                                <i class="fas fa-trash" aria-hidden="true"></i> Xóa
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-sm btn-info" href="index.php?option=category">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
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