<?php

use App\Models\Menu;
use App\Libraries\MyClass;

$id = $_REQUEST["id"];
$menu = Menu::find($id);
if ($menu == null) {
    MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
    header("location:index.php?option=menu");
}
$args_menu = [
    ['position', '=', $menu->position],
    ['level', '<', 2],
    ['status', '!=', 0],
    ['id', '!=', $id]
];
$list_menu = Menu::where($args_menu)->get();
$html_parent_id = '';
foreach ($list_menu as $item) {
    if ($item->id == $menu->parent_id) {
        $html_parent_id .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
    } else {
        $html_parent_id .= "<option  value='" . $item->id . "'>" . $item->name . "</option>";
    }
}
?>
<?php require_once('../views/backend/header.php'); ?>

<form action="index.php?option=menu&cat=process" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CẬP NHẬT MENU</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php?option=menu">Menu</a></li>
                            <li class="breadcrumb-item active">Cập nhật menu</li>
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
                                <i class="fas fa-save"></i> Save[Thêm]
                            </button>
                            <a class="btn btn-sm btn-info" href="index.php?option=menu">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php include_once('../views/backend/messageAlert.php') ?>
                    <div class="mb-3">
                        <input type="hidden" name="id" value="<?= $menu->id ?>">
                        <label for="name">Tên menu</label>
                        <input name="name" id="name" type="text" class="form-control " required value="<?= $menu->name ?>">
                    </div>
                    <div class="mb-3">
                        <label for="link">Liên kết</label>
                        <input name="link" id="link" type="text" class="form-control " required placeholder="#" value="<?= $menu->link ?>">
                    </div>
                    <div class="mb-3">
                        <label for="position">Vị trí</label>
                        <input name="position" id="position" type="text" class="form-control " required value="<?= $menu->position ?>">
                    </div>
                    <div class="mb-3">
                        <label for="parent_id">Cấp cha</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">none</option>
                            <?= $html_parent_id; ?>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" <?= ($menu->status == 1) ? 'selected' : ''; ?>>Kích hoạt
                            </option>
                            <option value="2" <?= ($menu->status == 2) ? 'selected' : ''; ?>>Chưa kích hoạt
                            </option>

                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button name="CAPNHAT" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Save[Thêm]
                            </button>
                            <a class="btn btn-sm btn-info" href="index.php?option=menu">
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

<?php require_once('../views/backend/footer.php'); ?>