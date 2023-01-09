<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/all.min.css">
    <link rel="stylesheet" href="../public/css/login.css">
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
require_once('../vendor/autoload.php');
require_once('../config/database.php');
session_start();
if (isset($_SESSION['useradmin'])) {
    header('location:index.php');
}

use App\Models\User;

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $args = [
            ['email', '=', $username],
            ['roles', '=', 1],
            ['status', '=', 1]
        ];
    } else {
        $args = [
            ['username', '=', $username],
            ['roles', '=', 1],
            ['status', '=', 1]
        ];
    }
    $row = User::where($args)->first();
    if ($row != null) {
        if ($row->password == $password) {
            $_SESSION['useradmin'] = sha1($username);
            $_SESSION['name'] = $row->name;
            $_SESSION['user_id'] = $row->id;
            $_SESSION['image'] = isset($row->image) ? $row->image : 'user.jpg';
            header('location:index.php');
        } else {
            $error_login = "Mật khẩu không chính xác";
        }
    } else {
        $error_login = "Tên đăng nhập không tồn tại";
    }
}
?>

<body>
    <div class="card p-2 rounded-4">
        <div class="box-login fw-semibold">
            <h3 class="text-center color-login ">
                <i class="fa-solid fa-user-tie"></i>
                <br>
                Login
            </h3>
            <form action="login.php" method="post">
                <div class=" my-3 group">
                    <input type="text" id="username" name="username" placeholder="username" required>
                    <i class="fas fa-user"></i>
                </div>
                <div class="my-3 group">
                    <input type="password" id="password" name="password" placeholder="password" required>
                    <i class="far fa-eye" onclick="myFunction()"></i>
                </div>
                <div class="d-grid gap-2 my-3 group">
                    <button name="login"><i class="fa-regular fa-paper-plane"></i> Login</button>
                </div>

                <?php if (isset($error_login)) : ?>
                    <div class="my-3">
                        <div class="text-danger text-center">
                            <?= $error_login; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </form>
        </div>

    </div>
    <script src="public/js/bootstrap.bundle.min.js"></script>
</body>

</html>