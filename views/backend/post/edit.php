<?php

use App\Models\Topic;
use App\Models\Post;
use App\Libraries\MyClass;
//truy van du lieu trong post
$id = $_REQUEST["id"];
$post = Post::where([['status', '!=', 0], ['id', '=', $id]])->first();
if ($post == null) {
    MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
    header("location:index.php?option=post");
}
$list_topic = Topic::where('status', '!=', 0)->get();
$html_topic_id = "";
foreach ($list_topic as $topic) {
    if ($post->topic_id == $topic->id) {
        $html_topic_id .= "<option selected value='" . $topic->id . "'>" . $topic->name . "</option>";
    } else {
        $html_topic_id .= "<option value='" . $topic->id . "'>" . $topic->name . "</option>";
    }
}

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
                        <h1>CẬP NHẬT BÀI VIẾT</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Cập nhật bài viết</li>
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
                            <a class="btn btn-sm btn-info" href="index.php?option=post">
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
                                <input type="hidden" name="id" value="<?= $post->id ?>">
                                <label for="title">Tiêu đề bài viết</label>
                                <input name="title" id="title" type="text" class="form-control " required placeholder="vd: Harry Potter" value="<?= $post->title; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="detail">Chi tiết</label>
                                <textarea name="detail" id="detail" cols="10" rows="2" class="form-control " required placeholder="Chi tiết"><?= $post->detail; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metadesc">Mô tả (SEO)</label>
                                <textarea name="metadesc" id="metadesc" cols="10" rows="2" class="form-control " required placeholder="vd: "><?= $post->metadesc; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metakey">Từ khóa (SEO)</label>
                                <textarea name="metakey" id="metakey" cols="10" rows="2" class="form-control " required placeholder="vd: "><?= $post->metakey; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="topic_id">Topic</label>
                                <select name="topic_id" id="topic_id" required class="form-control">
                                    <option value="">--chon chủ đề--</option>
                                    <?= $html_topic_id ?>;
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image">Hình ảnh</label>
                                <input name="image" id="image" type="file" class="form-control btn-sm">
                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" <?= ($post->status == 1) ? 'selected' : ''; ?>>Xuất bản</option>
                                    <option value="2" <?= ($post->status == 2) ? 'selected' : ''; ?>>Chưa xuất bản</option>

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
                            <a class="btn btn-sm btn-info" href="index.php?option=post">
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
    CKEDITOR.replace('detail');
</script>
<?php require_once('../views/backend/footer.php'); ?>