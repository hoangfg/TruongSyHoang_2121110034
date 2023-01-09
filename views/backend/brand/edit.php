<?php

use App\Models\Brand;
use App\Libraries\MyClass;

$id = $_REQUEST["id"];
//truy van du lieu trong brand
$list = Brand::where([['status',  '!=', '0'], ['id', '!=', $id]])
    ->orderBy('created_at', 'desc')->get();
$brand = Brand::find($id);
if ($brand == null) {
    MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
    header("location:index.php?option=brand");
}

$html_sort_order = "";
foreach ($list as $item) {
    if($brand->sort_order - 1 == $item ->sort_order) {
        $html_sort_order .= "<option selected value='" .$item->sort_order ."'>Sau: " .$item->name ."</option>";
    } else {
        $html_sort_order .= "<option value='" . $item->sort_order . "'>Sau: " . $item->name . "</option>";

    }
}
?>

<?php require_once('../views/backend/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=brand&cat=process" name="form1" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cập nhật danh mục</h1>
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
                            <button name="CAPNHAT" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Save[Cập nhật]
                            </button>
                            <a class="btn btn-sm btn-info" href="index.php?option=brand">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php include_once('../views/backend/messageAlert.php') ?>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="<?= $brand->id ?>">
                                <label for="name">Tên thương hiệu</label>
                                <input name="name" id="name" type="text" value="<?= $brand->name ?>" class="form-control " required>
                            </div>
                            <div class="mb-3">
                                <label for="metadesc">Mô tả (SEO)</label>
                                <textarea name="metadesc" id="metadesc" cols=" 10" rows="2" class="form-control " required placeholder="vd: là một thể loại văn xuôi có hư cấu, thông qua nhân vật, hoàn cảnh, sự việc để phản ánh bức tranh xã hội"><?= $brand->metadesc ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metakey">Từ khóa (SEO)</label>
                                <textarea name="metakey" id="metakey" cols="10" rows="2" class="form-control " required placeholder="vd: Tiểu thuyết"><?= $brand->metakey ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            
                            <div class="mb-3">
                                <label for="sort_order">Vị trí</label>
                                <select name="sort_order" id="sort_order" class="form-control">
                                    <option value="0">--chon vị trí--</option>
                                    <?= $html_sort_order; ?>;
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image">Hình ảnh</label>
                                <input name="image" id="image" type="file" class="form-control btn-sm">

                            </div>
                            <div class=" mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" <?= ($brand->status == 1) ? 'selected' : ''; ?>>Xuất bản</option>
                                    <option value="2" <?= ($brand->status == 2) ? 'selected' : ''; ?>>Chưa xuất bản</option>

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
                            <a class="btn btn-sm btn-info" href="index.php?option=brand">
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