<?php

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Libraries\MyClass;
//truy van du lieu trong product
$id = $_REQUEST["id"];
$product = Product::where([['status', '!=', 0], ['id', '=', $id]])->first();
if ($product == null) {
    MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
    header("location:index.php?option=product");
}
$list_brand = Brand::where('status',  '!=', '0')
    ->get();
$list_category = Category::where('status',  '!=', '0')
    ->get();

$str_option_cat = "";
$str_option_brand = "";
foreach ($list_category as $category) {
    if ($product->category_id == $category->id) {
        $str_option_cat .= "<option selected value='" . $category->id . "'>" . $category->name . "</option>";
    } else {
        $str_option_cat .= "<option value='" . $category->id . "'>" . $category->name . "</option>";
    }
}
foreach ($list_brand as $brand) {
    if ($product->brand_id == $brand->id) {
        $str_option_brand  .= "<option selected value='" . $brand->id . "'>" . $brand->name . "</option>";
    } else {
        $str_option_brand  .= "<option value='" . $brand->id . "'>" . $brand->name . "</option>";
    }
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
                        <h1>Cập nhật sản phẩm</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Cập nhật sản phẩm</li>
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
                            <button name="CAPNHAT" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Save[Cập nhật]
                            </button>
                            <a class="btn btn-sm btn-info" href="index.php?option=product">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <?php include_once('../views/backend/messageAlert.php') ?>
                    <div class="row">
                        <div class="col-md-8">
                            <input type="hidden" name="id" value="<?= $product['id']; ?>">
                            <div class="mb-3">
                                <label for="name">Tên sản phẩm</label>
                                <input name="name" id="name" type="text" class="form-control " required placeholder="vd: Harry Potter" value="<?= $product['name']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="detail">Chi tiết</label>
                                <textarea name="detail" id="detail" cols="10" rows="2" class="form-control " required placeholder="Chi tiết"><?= $product['detail']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metadesc">Mô tả (SEO)</label>
                                <textarea name="metadesc" id="metadesc" cols=" 10" rows="2" class="form-control " required placeholder="vd: là một thể loại văn xuôi có hư cấu, thông qua nhân vật, hoàn cảnh, sự việc để phản ánh bức tranh xã hội"><?= $product['metadesc'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metakey">Từ khóa (SEO)</label>
                                <textarea name="metakey" id="metakey " cols="10" rows="2" class="form-control " required placeholder="vd: Tiểu thuyết"><?= $product['metakey'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="mb-3">
                                <label for="category_id">Danh mục</label>
                                <select name="category_id" id="category_id" required class="form-control">
                                    <option value="">--chon danh mục--</option>
                                    <?= $str_option_cat ?>;
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" id="brand_id" required class="form-control">
                                    <option value="">--chon thương hiệu--</option>
                                    <?= $str_option_brand ?>;
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="qty">Số lượng </label>
                                <input name="qty" id="qty" type="number" class="form-control " value="<?= $product['qty']; ?>" min="1">
                            </div>
                            <div class="mb-3">
                                <label for="price">Giá</label>
                                <input name="price" id="price" type="number" class="form-control" value="<?= $product['price']; ?>" min="1000" step="500">
                            </div>
                            <div class=" mb-3">
                                <label for="price_sale">Giá khuyến mãi</label>
                                <input name="price_sale" id="price_sale" type="number" class="form-control " value="<?= $product['price_sale']; ?>" min="0" step="500">
                            </div>
                            <div class="mb-3">
                                <label for="image">Hình ảnh</label>
                                <input name="image" id="image" type="file" class="form-control btn-sm">
                            </div>
                            <div class=" mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" <?= ($product->status == 1) ? 'selected' : ''; ?>>Xuất bản</option>
                                    <option value="2" <?= ($product->status == 2) ? 'selected' : ''; ?>>Chưa xuất bản</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button name="CAPNHAT" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Save[Cập nhật]
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