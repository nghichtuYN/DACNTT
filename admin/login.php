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
        $_SESSION['adminUserID'] = $result['UserID'];
        $_SESSION['adminUserName'] = $result['UserName'];
        $_SESSION['adminUserEmail'] = $result['UserEmail'];
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
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 800px;
            padding: 15px;
            margin: auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 900px;
        }

        .login-header {
            margin-bottom: 20px;
        }

        .login-form {
            width: 100%;
        }

        .login-form input {
            margin-bottom: 10px;
        }

        .login-form .btn {
            width: 100%;
        }

        .login-error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <section class="d-flex justify-content-center align-items-center vh-100">
        <div class="login-container">
            <div class="text-center login-header">
                <h2 class="font-weight-bolder">Đăng nhập</h2>
                <hr>
            </div>
            <div class="login-form">
                <form action="login.php" id="login-form" method="POST">
                    <p class="login-error">
                        <?php
                        if (isset($_GET['error'])) {
                            echo  $_GET['error'];
                        }
                        ?>
                    </p>
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="login-password">Mật khẩu</label>
                        <input type="password" class="form-control" id="login-password" name="password" placeholder="Mật khẩu" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="login" id="login-btn" value="Đăng nhập">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/58cb2257a3.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
