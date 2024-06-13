<?php
require_once('./header.php');
?>
<?php
require_once('../includes/db.php');
if (isset($_SESSION['admin_logined_in'])) {
    header('Location: ./index.php');
    exit;
}
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST['password'];
    $result = loginUser($email, $password);
    if ($result['isAdmin'] == 1) {
        $_SESSION['admin_logined_in'] = true;
        $_SESSION['UserID'] = $result['UserID'];
        $_SESSION['UserName'] = $result['UserName'];
        $_SESSION['UserEmail'] = $result['UserEmail'];
        header('Location: index.php');
    } else {
        header('Location: login.php?error= Tài khoản hoặc mật khẩu không chính xác');
    }
} else
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <section class=" cart my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="font-weight-bolder">Đăng nhập</h2>

            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="login.php" id="login-form" method="POST">
                <p style="color :red"><?php

                                    if (isset($_GET['error'])) {
                                        echo  $_GET['error'];
                                    }
                                        ?></p>
                <label for="">Email</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
                </div>
                <label for="">Mật khẩu</label>
                <div class="form-group">
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Mật khẩu" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" name="login" id="login-btn" value="Đăng nhập">
                </div>
                <!-- <div class="form-group">
                    <a href="./register.php" id="register-url" class="btn">Bạn chưa có tài khoản ? Đăng ký</a>
                </div> -->
            </form>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/58cb2257a3.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>