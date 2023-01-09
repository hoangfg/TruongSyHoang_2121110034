<?php

use App\Libraries\MyClass;
use App\Models\Contact;

$id = $_REQUEST['id'];

$list_contact = Contact::where('status',  '!=', '0')
    ->get();
$contact = Contact::find($id);
if ($contact == null) {
    MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
    header("location:index.php?option=contact");
}
?>

<?php require_once('../views/backend/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<form action="index.php?option=contact&cat=process" name="form1" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>TRẢ LỜI LIÊN HỆ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Trả lời liên hệ</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button name="TRALOI" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-envelope-square"></i> Trả lời
                            </button>
                            <a class="btn btn-sm btn-info" href="index.php?option=contact">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php include_once('../views/backend/messageAlert.php') ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="<?= $contact->id ?>">
                                <label for="name">Tên khách hàng</label>
                                <input name="name" id="name" type="text" value="<?= $contact->name ?>" class="form-control " disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Email</label>
                                <input name="email" id="email" type="email" value="<?= $contact->email ?>" class="form-control " disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input name="phone" id="phone" type="text" value="<?= $contact->phone ?>" class="form-control " disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title">Tiêu đề</label>
                                <input name="title" id="title" type="text" value="<?= $contact->title ?>" class="form-control " disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="detail">Tiêu đề</label>
                                <textarea name="detail" id="detail" cols=" 12" rows="2" class="form-control " disabled><?= $contact->detail ?></textarea>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="replaydetail">Nội dung trả lời</label>
                                <textarea name="replaydetail" id="replaydetail" cols=" 12" rows="2" class="form-control " required><?= trim($contact->replaydetail) ?></textarea>


                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button name="TRALOI" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-envelope-square"></i> Trả lời
                            </button>
                            <a class="btn btn-sm btn-info" href="index.php?option=contact">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>

    </div>

</form>
<!-- /.content-wrapper -->
<?php require_once('../views/backend/footer.php'); ?>