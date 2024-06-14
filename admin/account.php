<?php
require_once('./header.php')
?>
<?php
require_once('../includes/db.php');

if (!isset($_SESSION['admin_logined_in'])) {
    header('Location: login.php');
    exit;
}
if (isset($_POST['change_password'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    if ($password !== $confirmPassword) {
        header("location: account.php?error= Xác nhận mật khẩu không đúng");
    } else if (strlen($password) < 6) {
        header("location: account.php?error=Mật khẩu ít nhất 6 ký tự");
    } else {
        $result = updateUser($password, $_SESSION['adminUserID']);
        if ($result == TRUE) {
            header("Location: account.php?success=Đổi mật khẩu thành công");
        } else {
            header("location: account.php?error=Đổi mật khẩu thât bại!!");
        }
    }
}
?>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
<!-- <link rel="stylesheet" href="../assets/css/style.css">  -->
<style>
    #account-form {
        width: 50%;
        text-align: center;
    }

    #account-form input {
        margin: 5px auto;

    }
    #change-pass-btn {
        color: #fff;
        background-color: #fb774b;
    }
</style>
<div class="container-fluid">
    <div class="row" style="min-height: 1000px">
        <?php
        require_once('./sidebar.php')
        ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">

                <h1 class="h2">Tài khoản</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                    </div>
                </div>
            </div>
            <h2>Thông tin tài khoản</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <div class="row container mx-auto mt-5">
                        <div class="text-center col-lg-6 col-md-12 col-sm-12">
                            <h3 class="font-weight-bold">Thông tin tài khoản</h3>
                            <hr class="mx-auto">
                            <div class="account-info">
                                <p>Họ tên: <span><?php
                                                    if (isset($_SESSION['adminUserName'])) {
                                                        echo $_SESSION['adminUserName'];
                                                    } ?></span></p>
                                <p>Email: <span><?php if (isset($_SESSION['adminUserEmail'])) {
                                                    echo $_SESSION['adminUserEmail'];
                                                } ?></span></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 ">
                            <form id="account-form" action="./account.php" method="POST">
                                <h3>Thay đổi mật khẩu</h3>
                                <hr class="mx-auto">
                                <p style="color :red"><?php
                                                        if (isset($_GET['error'])) {
                                                            echo  $_GET['error'];
                                                        }
                                                        ?></p>
                                <p style="color :green"><?php
                                                        if (isset($_GET['success'])) {
                                                            echo  $_GET['success'];
                                                        }
                                                        ?></p>
                                <div class="form-group">
                                    <label>Mật khẩu mới</label>
                                    <input type="password" class="form-control" id="account-password" name="password" placeholder="Mật khẩu mới">
                                </div>
                                <div class="form-group">
                                    <label>Xác nhận lại mật khẩu mới</label>
                                    <input type="password" class="form-control" id="account-password-confirm" name="confirm-password" placeholder="Xác nhận lại mật khẩu mới">
                                </div>
                                <div class="form-group mt-2">
                                    <input type="submit" value="Đổi mật khẩu" class="btn" id="change-pass-btn" name="change_password">
                                </div>
                            </form>
                        </div>

                    </div>

                </table>

            </div>
        </main>
    </div>