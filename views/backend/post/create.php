<?php

use App\Models\Topic;
use App\Libraries\MyClass;
//truy van du lieu trong post
$list_topic = Topic::where('status',  '!=', '0')
    ->get();
$html_topic_id = "";

foreach ($list_topic as $topic) {
    $html_topic_id .= "<option value='" . $topic->id . "'>" . $topic->name . "</option>";
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
                        <h1>THÊM BÀI VIẾT</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Thêm bài viết</li>
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
                            <a class="btn btn-sm btn-info" href="index.php?option=post">
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
                                <label for="title">Tiêu đề bài viết</label>
                                <input name="title" id="title" type="text" class="form-control " required placeholder="vd: Harry Potter">
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
    CKEDITOR.replace('detail')
</script>
<?php require_once('../views/backend/footer.php'); ?>