<?php require_once('views/frontend/header.php') ?>
<?php

use App\Models\User;
use App\Libraries\MyClass;
use App\Libraries\Upload;

if (isset($_POST['DANGXUAT'])) {
    if (isset($_SESSION['user_id'])) {
        unset($_SESSION['logincustomer']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_id']);
        //      header('location:index.php');

    }
}
if (isset($_SESSION['logincustomer'])) {
    $id = $_SESSION['user_id'];
    $customer = User::find($id);
    if (isset($_POST['CAPNHAT'])) {
        $customer->name = $_POST['name'];
        $customer->phone = $_POST['phone'];
        $customer->email = $_POST['email'];
        $customer->gender = $_POST['gender'];
        $customer->address = $_POST['address'];
        $customer->save();
    }
}
?>
<section class="mycontent">
    <div class="container">
        <div class="row mt-3">

            <div class="card col-md-10 mx-auto">
                <form action="index.php?option=customer" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">
                                <?php if ($customer->image == '') : ?>
                                    <?php if ($customer->gender == 0) : ?>
                                        <img src="public/images/user/male.png" class="card-img-top index-img" alt="male">
                                    <?php else : ?>
                                        <img src="public/images/user/female.png" class="card-img-top index-img" alt="female">

                                    <?php endif; ?>
                                <?php else : ?>
                                    <img src="public/images/user/<?= $customer->image ?>" class="card-img-top index-img" alt="<?= $customer->image ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 mx-auto">

                            <div class="my-3">
                                <input type="hidden" name="id" value="<?= $customer->id ?>">
                                <label for="name"><strong>Tên tài khoản</strong></label>
                                <input name="name" id="name" type="text" class="form-control mt-1" required placeholder="vd: t3wahSetyeT4" value="<?= $customer->name ?>">
                            </div>
                            <div class="mb-3">
                                <label for="phone"><strong>Điện thoại</strong></label>
                                <input name="phone" id="phone" type="text" class="form-control  mt-1" required placeholder="vd: t3wahSetyeT4" value="<?= $customer->phone ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email"><strong>Email</strong></label>
                                <input name="email" id="email" type="email" class="form-control  mt-1" required placeholder="vd: t3wahSetyeT4" value="<?= $customer->email ?>">
                            </div>
                            <div class="mb-3">
                                <label for="gender"><strong>Giới tính</strong></label><br>
                                <input type="radio" name="gender" id="gender" value="0" <?= ($customer->gender == 0) ? 'checked' : ''; ?>><label for="0">Nam</label>
                                <input type="radio" name="gender" id="gender" value="1" <?= ($customer->gender == 1) ? 'checked' : ''; ?>><label for="1">Nữ</label>
                            </div>
                            <div class="mb-3">
                                <label for="address"><strong>Dại chỉ</strong></label>
                                <input name="address" id="address" type="text" class="form-control  mt-1" required value="<?= $customer->address; ?>"></input>
                            </div>
                            <div class="mb-3">
                                <label for="created_at"><strong>Bạn đã tham gia với chúng tôi từ: </strong></label>
                                <input name="created_at" id="created_at" type="text" class="form-control  mt-1" disabled placeholder="vd: abc123xyz@gmail.com" value="<?= $customer->created_at ?>">
                            </div>

                            <button class="btn btn-md btn-success mt-1" name="CAPNHAT" type="submit">Lưu thông tin</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<?php require_once('views/frontend/footer.php') ?>