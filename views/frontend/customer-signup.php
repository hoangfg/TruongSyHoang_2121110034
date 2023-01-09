<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/all.min.css">
    <link rel="stylesheet" href="public/css/login.css">
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</head>

<?php

require_once("vendor/autoload.php");
require_once("config/database.php");
if (isset($_SESSION['username'])) {
    header('location:index.php');
}

use App\Models\User;
use App\Libraries\MyClass;

if (isset($_POST['THEM'])) {
    $user = new User();
    $user->name = $_POST['name'];
    $user->username = $_POST['username'];
    $user->slug = MyClass::str_slug($_POST['name']);
    $user->password = sha1($_POST['password']);
    $user->email = $_POST['email'];
    $user->roles = 0;
    $user->status = 1;
    if ($_POST['password'] != $_POST['password_re']) {
        $message_alert = 'Vui lòng nhập lại mật khẩu.';
    } else {
        $message_alert = "Tài khoản đã tạo thành công";
        $user->save();
        header('location:index.php?option=customer-login');
    }
}
?>

<body>

    <div class="card p-2 rounded-4 ">
        <div class="box-login fw-semibold">
            <h3 class="text-center color-login ">

                Sign up
            </h3>
            <form action="index.php?option=customer-signup" method="post">
                <div class=" my-3 group">
                    <input type="text" id="name" name="name" placeholder="name" required>
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <div class=" my-3 group">
                    <input type="text" id="username" name="username" placeholder="username" required>
                    <i class="fas fa-user"></i>
                </div>
                <div class="my-3 group">
                    <input type="password" id="password" name="password" placeholder="password" required>
                    <i class="far fa-eye" onclick="myFunction()"></i>
                </div>
                <div class="my-3 group">
                    <input type="text" id="password_re" name="password_re" placeholder="password" required>
                    <i class="fa-solid fa-blender"></i>
                </div>
                <div class="my-3 group">
                    <input type="email" id="email" name="email" placeholder="email" required>
                    <i class="fa-solid fa-at"></i>
                </div>
                <div class="my-3 group">
                    <input type="text" id="phone" name="phone" placeholder="phone" required>
                    <i class="fa-regular fa-address-card"></i>
                </div>

                <div class="d-grid gap-2 my-3 group">
                    <button name="THEM"><i class="fa-regular fa-paper-plane"></i>Sign up</button>
                </div>
                <p class="text-center">alrealy have an account ?<a href="index.php?option=customer-login" class="color-login"> Sign in</a> ? </p>
                <p class="text-center"><a href="index.php" class="color-login">Return to home page.</a> ? </p>
                <?php if (isset($message_alert)) : ?>
                    <div class="my-3">
                        <div class="text-success text-center">
                            <?= $message_alert; ?>
                        </div>
                    </div>

                <?php endif; ?>
            </form>
        </div>

    </div>

    <script src="public/js/bootstrap.bundle.min.js"></script>
</body>

</html>