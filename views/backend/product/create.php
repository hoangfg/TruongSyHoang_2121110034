<?php

use App\Models\Category;
use App\Models\Brand;
use App\Libraries\MyClass;
//truy van du lieu trong product
$list_brand = Brand::where('status',  '!=', '0')
    ->get();
$list_category = Category::where('status',  '!=', '0')
    ->get();
$html_category_id = "";
$html_brand_id = "";

foreach ($list_category as $category) {
    $html_category_id .= "<option value='" . $category->id . "'>" . $category->name . "</option>";
}
foreach ($list_brand as $brand) {
    $html_brand_id .= "<option value='" . $brand->id . "'>" . $brand->name . "</option>";
}
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
                        <h1>Thêm sản phẩm</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Thêm sản phẩm</li>
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
                            <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Save[Thêm]
                            </button>
                            <a class="btn btn-sm btn-info" href="index.php?option=product">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    if (MyClass::exists_flash('message')) {
                        $message = MyClass::get_flash('message');
                        echo " <div class='alert alert-" . $message['type'] . "'>";
                        echo $message['msg'];
                        echo "</div>";
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name">Tên sản phẩm</label>
                                <input name="name" id="name" type="text" class="form-control " required placeholder="vd: Harry Potter">
                            </div>
                            <div class="mb-3">
                                <label for="detail">Chi tiết</label>
                                <textarea name="detail" id="detail" cols="10" rows="2" class="form-control " required placeholder="Chi tiết"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metadesc">Mô tả (SEO)</label>
                                <textarea name="metadesc" id="metadesc" cols="10" rows="2" class="form-control " required placeholder="vd: "></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metakey">Từ khóa (SEO)</label>
                                <textarea name="metakey" id="metakey" cols="10" rows="2" class="form-control " required placeholder="vd: "></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="mb-3">
                                <label for="category_id">Danh mục</label>
                                <select name="category_id" id="category_id" required class="form-control">
                                    <option value="">--chon danh mục--</option>
                                    <?= $html_category_id ?>;
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" id="brand_id" required class="form-control">
                                    <option value="">--chon thương hiệu--</option>
                                    <?= $html_brand_id ?>;
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="qty">Số lượng </label>
                                <input name="qty" id="qty" type="number" class="form-control " value="1" min="1">
                            </div>
                            <div class="mb-3">
                                <label for="price">Giá</label>
                                <input name="price" id="price" type="number" class="form-control" value="1000" min="1000" step="500">
                            </div>
                            <div class=" mb-3">
                                <label for="price_sale">Giá khuyến mãi</label>
                                <input name="price_sale" id="price_sale" type="number" class="form-control ">
                            </div>
                            <div class="mb-3">
                                <label for="image">Hình ảnh</label>
                                <input name="image" id="image" type="file" required class="form-control btn-sm">
                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Xuất bản</option>
                                    <option value="2">Chưa xuất bản</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Save[Thêm]
                            </button>
                            <a class="btn btn-sm btn-info" href="index.php?option=product">
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
<script>
    CKEDITOR.replace('detail')
</script>
<?php require_once('../views/backend/footer.php'); ?>