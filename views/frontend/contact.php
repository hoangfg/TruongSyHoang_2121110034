<?php

use App\Models\Contact;

$title = 'Liên hệ';
if (isset($_POST['GUI'])) {
    $contact = new Contact();
    $contact->name = $_POST['name'] ?? null;
    $contact->email = $_POST['email'];
    $contact->phone = $_POST['phone'];
    $contact->title = $_POST['title'];
    $contact->detail = $_POST['detail'];
    $contact->status = 1;
    $contact->save();
}
?>
<?php require_once('./views/frontend/header.php') ?>
<section class="mycontent py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-12 mx-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-bl_gr">Trang chủ</a></li>
                        <li class="breadcrumb-item active-main" aria-current="page"><?= $title ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- 0 -->
        <div class="row">
            <div class="col-md-10 col-12 mx-auto">
                <div class="row">
                    <div class="col-md-6 col-12 mx-auto">
                        <div class="page-title text-center">
                            <h1 class="title-head">
                                <span><?= $title ?></a>
                            </h1>
                            <ul class="contact p-0 list-unstyled-1">
                                <li><a href="tel:+0918146697" class="fs-3 text-orange text-bl_gr">0918146697</a></li>
                                <li><span class="text-muted">Làm việc từ Thứ 2 - Thứ 6 hàng tuần</span></li>
                                <h5><span class="text-center">Bạn cần trợ giúp, hãy gửi lời nhắn cho chúng tôi</span></h5>
                            </ul>
                        </div>
                        <div class="content-page ">

                            <form action="index.php?option=contact" name="form1" method="post" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name">Họ và tên</label>
                                        <input name="name" id="name" type="text" class="form-control " required placeholder="vd: Trương Sỹ Hoàng">
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name">Email</label>
                                        <input name="email" id="email" type="email" class="form-control " required placeholder="vd: h0918146697@gmail.com">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        <input name="phone" id="phone" type="text" class="form-control " required placeholder="vd: 0918146697">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="title">Tiêu đề</label>
                                        <input name="title" id="title" type="text" class="form-control " required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="detail">Nội dung</label>
                                        <textarea name="detail" id="detail" cols=" 12" rows="2" class="form-control " required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button name="GUI" type="submit" class="btn btn-md btn-success ">
                                        <i class="fas fa-save "></i> Gửi liên hệ
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 mx-auto">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7837.459060368095!2d106.77436119999999!3d10.831998400000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752701a34a5d5f%3A0x30056b2fdf668565!2zVHLGsOG7nW5nIENhbyDEkOG6s25nIEPDtG5nIFRoxrDGoW5nIFRQLkhDTQ!5e0!3m2!1svi!2s!4v1671374374967!5m2!1svi!2s" class="w-100 h-100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('./views/frontend/footer.php') ?>