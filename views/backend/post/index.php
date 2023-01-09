<?php

use App\Models\Post;
//truy van du lieu trong post


$list_post = Post::join('topic', 'topic.id', '=', 'post.topic_id')
    ->where('post.status', '!=', '0')
    ->orderBy('post.created_at', 'desc')
    ->select("post.*", "topic.name as topic_name")
    ->get();
?>

<?php require_once('../views/backend/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=post&cat=process" name="form1" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>TẤT CẢ BÀI VIẾT</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Tất cả bài viết</li>
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
                                <a class="btn btn-sm btn-success" href="index.php?option=post&cat=create">
                                    <i class="fas fa-plus"></i> Thêm
                                </a>
                                <a class="btn btn-sm btn-danger" href="index.php?option=post&cat=trash">
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
                                <th class="text-center" style="width:5%">
                                    <div class="form-group select-all">
                                        <input type="checkbox">
                                    </div>
                                </th>
                                <th class="text-center" style="width:10%">Hình</th>
                                <th class="text-center" style="width:40%">Tiêu đề bài viết</th>
                                <th class="text-center" style="width:10%">Chủ đề</th>
                                <th class="text-center" style="width:15%">Ngày tạo</th>
                                <th class="text-center" style="width:15%">Chức năng</th>
                                <th class="text-center" style="width:5%">ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_post as $post) : ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <input type="checkbox" name="checkId[]" value="<?= $post->id ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <img src="../public/images/post/<?= $post['image'] ?>" class="img-fluid" alt="<?= $post['image'] ?>">
                                    </td>
                                    <td>
                                        <?= $post['title'] ?>
                                    </td>
                                    <td>
                                        <?= $post['topic_name'] ?>
                                    </td>


                                    <td class="text-center">
                                        <?= $post['created_at'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($post['status'] == 1) : ?>
                                            <a class="btn btn-sm btn-success" href="index.php?option=post&cat=status&id=<?= $post['id']; ?>">
                                                <i class="fas fa-toggle-on"></i>
                                            </a>
                                        <?php else : ?>
                                            <a class="btn btn-sm btn-danger" href="index.php?option=post&cat=status&id=<?= $post['id']; ?>">
                                                <i class="fas fa-toggle-off"></i>
                                            </a>
                                        <?php endif; ?>
                                        <a class="btn btn-sm btn-info" href="index.php?option=post&cat=show&id=<?= $post['id']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-primary" href="index.php?option=post&cat=edit&id=<?= $post['id']; ?>">
                                            <i class=" fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger" href="index.php?option=post&cat=delete&id=<?= $post['id']; ?>">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <?= $post['id'] ?>
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
                            <a class="btn btn-sm btn-danger" href="index.php?option=post&cat=trash">
                                <i class="fas fa-trash" aria-hidden="true"></i> Xóa
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-sm btn-success" href="index.php?option=post&cat=create">
                                <i class="fas fa-plus"></i> Thêm
                            </a>
                            <a class="btn btn-sm btn-danger" href="index.php?option=post&cat=trash">
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