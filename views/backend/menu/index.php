<?php

use App\Models\Menu;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Topic;
use App\Models\Post;

$list_menu = Menu::where('status', '!=', '0')
    ->orderBy('position', 'asc')
    ->orderBy('sort_order', 'asc')
    ->get();
$list_category = Category::where('status', '!=', '0')
    ->orderBy('created_at', 'desc')
    ->get();
$list_brand = Brand::where('status', '!=', '0')
    ->orderBy('created_at', 'desc')
    ->get();
$list_topic = Topic::where('status', '!=', '0')
    ->orderBy('created_at', 'desc')
    ->get();
$list_page = Post::where([['status', '!=', '0'], ['type', '=', 'page']])
    ->orderBy('created_at', 'desc')
    ->get();
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
                        <h1>Blank Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
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
                                <button name="update_sort_order" type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-save"></i> Lưu sắp xếp
                                </button>
                                <a class="btn btn-sm btn-danger" href="index.php?option=menu&cat=trash">
                                    <i class="fas fa-trash" aria-hidden="true"></i> Thùng rác
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php include_once('../views/backend/messageAlert.php') ?>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="accordion" id="accordionExample">
                                <div class="card Position">
                                    <div class="card-body">
                                        <label>Vị trí</label>
                                        <select name="position" id="" class="form-control">
                                            <option value="mainmenu">Main Menu</option>
                                            <option value="footermenu">Footer Menu</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end card Position -->
                                <div class="card">
                                    <div class="card-header" id="headingCategory">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                                                DANH MỤC SẢN PHẨM
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <?php foreach ($list_category as $category) : ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="categoryId[]" type="checkbox" value="<?= $category->id ?>" id="categoryCheck<?= $category->id ?>">
                                                    <label class="form-check-label" for="categoryCheck<?= $category->id ?>">
                                                        <?= $category->name ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="mt-3">
                                                <input type="submit" name="AddCategory" value="thêm menu" class="btn btn-sm btn-success form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card category -->
                                <div class="card">
                                    <div class="card-header" id="headingBrand">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseBrand" aria-expanded="false" aria-controls="collapseBrand">
                                                THƯƠNG HIỆU
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseBrand" class="collapse" aria-labelledby="headingBrand" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <?php foreach ($list_brand as $brand) : ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="brandId[]" type="checkbox" value="<?= $brand->id ?>" id="brandCheck<?= $brand->id ?>">
                                                    <label class="form-check-label" for="brandCheck<?= $brand->id ?>">
                                                        <?= $brand->name ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="mt-3">
                                                <input type="submit" name="AddBrand" value="thêm menu" class="btn btn-sm btn-success form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card brand -->
                                <div class="card">
                                    <div class="card-header" id="headingTopic">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTopic" aria-expanded="false" aria-controls="collapseTopic">
                                                CHỦ ĐỀ BÀI VIẾT
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTopic" class="collapse" aria-labelledby="headingTopic" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <?php foreach ($list_topic as $topic) : ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="topicId[]" type="checkbox" value="<?= $topic->id ?>" id="topicCheck<?= $topic->id ?>">
                                                    <label class="form-check-label" for="topicCheck<?= $topic->id ?>">
                                                        <?= $topic->name ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="mt-3">
                                                <input type="submit" name="AddTopic" value="thêm menu" class="btn btn-sm btn-success form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card topic -->
                                <div class="card">
                                    <div class="card-header" id="headingPage">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapsePage" aria-expanded="false" aria-controls="collapsePage">
                                                TRANG ĐƠN
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <?php foreach ($list_page as $page) : ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="pageId[]" type="checkbox" value="<?= $page->id ?>" id="pageCheck<?= $page->id ?>">
                                                    <label class="form-check-label" for="pageCheck<?= $page->id ?>">
                                                        <?= $page->title ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="mt-3">
                                                <input type="submit" name="AddPage" value="thêm menu" class="btn btn-sm btn-success form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card page -->
                                <div class="card">
                                    <div class="card-header" id="headingCustom">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseCustom" aria-expanded="false" aria-controls="collapseCustom">
                                                TÙY BIẾN LIÊN KẾT
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseCustom" class="collapse" aria-labelledby="headingCustom" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label>Tên menu</label>
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Link</label>
                                                <input type="text" name="link" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <input type="submit" name="AddCustom" value="thêm menu" class="btn btn-sm btn-success form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card custom -->
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-body">

                                    <table class="table table-bordered" id="myTable">
                                        <thead class="bg-orange">
                                            <tr>
                                                <th class="text-center" style="width:5%">
                                                    <div class="form-group select-all">
                                                        <input type="checkbox">
                                                    </div>
                                                </th>

                                                <th class="text-center" style="width:50%">Tên menu/Liên kết</th>
                                                <th class="text-center" style="width:10%">Vị trí</th>
                                                <th class="text-center" style="width:10%">Sắp xếp</th>
                                                <th class="text-center" style="width:20%">Chức năng</th>
                                                <th class="text-center" style="width:5%">ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list_menu as $menu) : ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="form-group">
                                                            <input type="checkbox" name="checkId[]" value="<?= $menu->id ?>">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <strong><?= $menu->name ?></strong>
                                                        </br>
                                                        <?= $menu->link ?>
                                                    </td>
                                                    <td>
                                                        <?= $menu->position ?>
                                                    </td>

                                                    <td class="text-center">
                                                        <input type="hidden" name="id[<?= $menu->id ?>]" value="<?= $menu->id ?>">
                                                        <input name="sort_order[<?= $menu->id ?>]" id="sort_order" type="number" min="0" class="form-control " value="<?= $menu->sort_order ?>">

                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($menu->status == 1) : ?>
                                                            <a class="btn btn-sm btn-success" href="index.php?option=menu&cat=status&id=<?= $menu->id; ?>">
                                                                <i class="fas fa-toggle-on"></i>
                                                            </a>
                                                        <?php else : ?>
                                                            <a class="btn btn-sm btn-danger" href="index.php?option=menu&cat=status&id=<?= $menu->id; ?>">
                                                                <i class="fas fa-toggle-off"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                        <a class="btn btn-sm btn-info" href="index.php?option=menu&cat=show&id=<?= $menu->id; ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-primary" href="index.php?option=menu&cat=edit&id=<?= $menu->id; ?>">
                                                            <i class=" fas fa-edit"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-danger" href="index.php?option=menu&cat=delete&id=<?= $menu->id; ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center" >
                                                        <?= $menu->id ?>
                                                    </td>
                                                </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                        
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">

                        <div class="col-md-6">
                            <a class="btn btn-sm btn-danger" href="index.php?option=menu&cat=trash">
                                <i class="fas fa-trash" aria-hidden="true"></i> Xóa
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="text-right">
                                <button name="update_sort_order" type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-save"></i> Lưu sắp xếp
                                </button>
                                <a class="btn btn-sm btn-danger" href="index.php?option=menu&cat=trash">
                                    <i class="fas fa-trash" aria-hidden="true"></i> Thùng rác
                                </a>
                            </div>

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
                [10, 15, 20, -1],
                [10, 15, 20, "ALL"],
            ],
            responsive: true

        });
    });
</script>