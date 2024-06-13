<?php
session_start();
require_once('./includes/db.php');
if (isset($_SESSION['logined_in'])) {
    header('Location: account.php');
    exit;
}
if (isset($_POST['register'])) {
    $CustName = $_POST["name"];
    $CustEmail = $_POST["email"];
    $CustPassword = $_POST["password"];
    $CustConfirmPassword = $_POST["confirm-password"];
    if ($CustConfirmPassword !== $CustPassword) {
        header("location: register.php?error= Xác nhận mật khẩu không đúng");
    } else if (strlen($CustPassword) < 6) {
        header("location: register.php?error=Mật khẩu ít nhất 6 ký tự");
    } else {
        $numRow = checkUser($CustEmail);
        if ($numRow != 0) {
            header("location: register.php?error=Tài khoản đã tồn tại !!!  $numRow");
        } else {
            registerUser($CustName, $CustEmail, $CustPassword);
        }
    }
} else {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php
    require_once("./includes/nav.php")
    ?>
    <section class=" cart my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="font-weight-bolder">Đăng ký</h2>

            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="./register.php" id="register-form" method="post">
                <p style="color :red"><?php
                                        if (isset($_GET['error'])) {
                                            echo  $_GET['error'];
                                        }
                                        ?></p>
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="name" required>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Mật khẩu" required>
                </div>
                <div class="form-group">
                    <label for="">Xác nhận lại mật khẩu</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirm-password" placeholder="Xác nhận lại mật khẩu" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Đăng ký">
                </div>
                <div class="form-group">
                    <a href="./login.php" id="login-url" class="btn">Bạn đã có tài khoản ? Đăng nhập</a>
                </div>
            </form>
        </div>
    </section>
    <?php
    require_once("./includes/footer.php")
    ?>
    <script src="https://kit.fontawesome.com/58cb2257a3.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>