<?php

use App\Models\Slider;
use App\Libraries\MyClass;

$id = $_REQUEST["id"];
$slider = Slider::find($id);
//truy van du lieu trong slider
$list = Slider::where([['status',  '!=', '0'], ['id', '!=', $id]])
    ->orderBy('created_at', 'desc')->get();
$slider = Slider::find($id);
if ($slider == null) {
    MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
    header("location:index.php?option=slider");
}

$html_sort_order = "";
foreach ($list as $item) {
    if ($slider->sort_order - 1 == $item->sort_order) {
        $html_sort_order .= "<option selected value='" . $item->sort_order . "'>" . $item->name . "</option>";
    } else {
        $html_sort_order .= "<option value='" . $item->sort_order . "'>" . $item->name . "</option>";
    }
}
?>

<?php require_once('../views/backend/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=slider&cat=process" name="form1" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CẬP NHẬT SLIDER</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Cập nhật slider</li>
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
                            <a class="btn btn-sm btn-info" href="index.php?option=slider">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php include_once('../views/backend/messageAlert.php') ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="<?= $slider['id'] ?>">
                                <label for="name">Tên slider</label>
                                <input name="name" id="name" type="text" value="<?= $slider['name'] ?>" class=" form-control " required placeholder=" vd: Tiểu thuyết">
                            </div>

                            <div class="mb-3">
                                <label for="link">Link</label>
                                <input name="link" id="link" type="text" value="<?= $slider['link'] ?>" class="form-control " required placeholder="vd: http://domain.com/index.php?option=page&cat=khuyen-mai"></input>
                            </div>
                            <div class="row">

                                <div class=" col-md-6 mb-3">
                                    <label for="position">Vị trí</label>
                                    <select name="position" id="position" class="form-control">
                                        <option value="slideshow">slideshow</option>
                                    </select>
                                </div>


                                <div class=" col-md-6 mb-3">
                                    <label for="sort_order">Vị trí</label>
                                    <select name="sort_order" id="sort_order" class="form-control">
                                        <option value="0">--chon vị trí--</option>
                                        <?= $html_sort_order ?>;
                                    </select>
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="image">Hình ảnh</label>
                                    <input name="image" id="image" type="file" class="form-control btn-sm">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" <?= ($slider->status == 1) ? 'selected' : ''; ?>>Xuất bản</option>
                                        <option value="2" <?= ($slider->status == 2) ? 'selected' : ''; ?>>Chưa xuất bản</option>

                                    </select>
                                </div>
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
                            <a class="btn btn-sm btn-info" href="index.php?option=slider">
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