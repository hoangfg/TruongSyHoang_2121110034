<?php

use App\Models\Product;
//truy van du lieu trong product
use App\Libraries\MyClass;

$list_product = Product::join('category', 'product.category_id', '=', 'category.id')
    ->join('brand', 'product.brand_id', '=', 'brand.id')
    ->where('product.status', '!=', '0')
    ->orderBy('product.created_at', 'desc')
    ->select("product.*", "category.name as category_name", "brand.name as brand_name")
    ->get();



?>

<?php require_once('../views/backend/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=product&cat=process" name="form1" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>TẤT CẢ SẢN PHẨM</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Tất cả sản phẩm</li>
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
                                <a class="btn btn-sm btn-success" href="index.php?option=product&cat=create">
                                    <i class="fas fa-plus"></i> Thêm
                                </a>
                                <a class="btn btn-sm btn-danger" href="index.php?option=product&cat=trash">
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
                                <th class="text-center" style="width: 5%">
                                    <div class="form-group select-all">
                                        <input type="checkbox">
                                    </div>
                                </th>
                                <th class="text-center" style="width:10%">Hình</th>
                                <th class="text-center" style="width:20%">Tên sản phẩm</th>
                                <th class="text-center" style="width:10%">Danh mục</th>
                                <th class="text-center" style="width:15%">Thương hiệu</th>
                                <th class="text-center" style="width:15%">Ngày tạo</th>
                                <th class="text-center" style="width:20%">Chức năng</th>
                                <th class="text-center" style="width:5%">ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_product as $product) : ?>
                                <tr>
                                    <td class="text-center" style="width:20px">
                                        <div class="form-group">
                                            <input type="checkbox" name="checkId[]" value="<?= $product->id ?>" id="productCheck<?= $product->id ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <img src="../public/images/product/<?= $product['image'] ?>" class="img-fluid" alt="<?= $product['image'] ?>">
                                    </td>
                                    <td>
                                        <?= $product['name'] ?>
                                    </td>
                                    <td>
                                        <?= $product['category_name'] ?>
                                    </td>
                                    <td>
                                        <?= $product['brand_name'] ?>
                                    </td>

                                    <td class="text-center">
                                        <?= $product['created_at'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($product['status'] == 1) : ?>
                                            <a class="btn btn-sm btn-success" href="index.php?option=product&cat=status&id=<?= $product['id']; ?>">
                                                <i class="fas fa-toggle-on"></i>
                                            </a>
                                        <?php else : ?>
                                            <a class="btn btn-sm btn-danger" href="index.php?option=product&cat=status&id=<?= $product['id']; ?>">
                                                <i class="fas fa-toggle-off"></i>
                                            </a>
                                        <?php endif; ?>
                                        <a class="btn btn-sm btn-info" href="index.php?option=product&cat=show&id=<?= $product['id']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-primary" href="index.php?option=product&cat=edit&id=<?= $product['id']; ?>">
                                            <i class=" fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger" href="index.php?option=product&cat=delete&id=<?= $product['id']; ?>">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    <td class="text-center" >
                                        <?= $product['id'] ?>
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
                            <a class="btn btn-sm btn-danger" href="index.php?option=product&cat=trash">
                                <i class="fas fa-trash" aria-hidden="true"></i> Xóa
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-sm btn-success" href="index.php?option=product&cat=create">
                                <i class="fas fa-plus"></i> Thêm
                            </a>
                            <a class="btn btn-sm btn-danger" href="index.php?option=product&cat=trash">
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