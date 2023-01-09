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

if (isset($_POST['login'])) {
    $message_alert = "";
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $args = [
            ['email', '=', $username],
            ['password', '=', $password],
            ['status', '=', 1]
        ];
    } else {
        $args = [
            ['username', '=', $username],
            ['password', '=', $password],
            ['status', '=', 1]
        ];
    }
    $row = User::where($args)->first();
    if ($row != null) {
        $_SESSION['logincustomer'] = $username;
        $_SESSION['user_id'] = $row->id;
        $message_alert = 'Đăng nhập thành công';
    } else {
        $message_alert = "Tài khoản không chính xác";
    }
}
?>

<body>
    <?php if (!isset($_SESSION['logincustomer'])) : ?>
        <div class="card p-2 rounded-4">
            <div class="box-login fw-semibold">
                <h3 class="text-center color-login ">
                    <i class="fa-solid fa-user-tie"></i>
                    <br>
                    Login
                </h3>
                <form action="index.php?option=customer-login" method="post">
                    <div class=" my-3 group">
                        <input type="text" id="username" name="username" placeholder="username" required>
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="my-3 group">
                        <input type="password" id="password" name="password" placeholder="password" required>
                        <i class="far fa-eye" onclick="myFunction()"></i>
                    </div>
                    <div class="d-grid gap-2 my-3 group">
                        <button name="login"><i class="fa-regular fa-paper-plane"></i>Login</button>
                    </div>
                    <p class="text-center">Forgot <a href="#" class="color-login">password</a> ? </p>
                    <p class="text-center">don't have an account ?<a href="index.php?option=customer-signup" class="color-login"> Signup</a> ? </p>
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
    <?php else : ?>
        <?php header('location:index.php?option=customer'); ?>
    <?php endif; ?>
    <script src="public/js/bootstrap.bundle.min.js"></script>
</body>

</html>