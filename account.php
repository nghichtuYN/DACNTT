<?php
session_start();
require_once('./includes/db.php');
if (!isset($_SESSION['logined_in'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logined_in'])) {
        unset($_SESSION['UserID']);
        unset($_SESSION['UserName']);
        unset($_SESSION['UserEmail']);
        unset($_SESSION['logined_in']);
        session_destroy();
        header('Location: login.php');
        exit;
    }
}
if (isset($_POST['change_password'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    if ($password !== $confirmPassword) {
        header("location: account.php?error= Xác nhận mật khẩu không đúng");
    } else if (strlen($password) < 6) {
        header("location: account.php?error=Mật khẩu ít nhất 6 ký tự");
    } else {
        $result = updateUser($password, $_SESSION['UserID']);
        if ($result == TRUE) {
            header("Location: account.php?success=Đổi mật khẩu thành công");
        } else {
            header("location: account.php?error=Đổi mật khẩu thât bại!!");
        }
    }
}
if (isset($_SESSION['logined_in'])) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php
    require_once("./includes/nav.php")
    ?>
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                <h3 class="font-weight-bold">Thông tin tài khoản</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Họ tên: <span><?php
                                        if (isset($_SESSION['UserName'])) {
                                            echo $_SESSION['UserName'];
                                        } ?></span></p>
                    <p>Email: <span><?php if (isset($_SESSION['UserEmail'])) {
                                        echo $_SESSION['UserEmail'];
                                    } ?></span></p>
                    <a name="logout-btn" id="logout-btn" class="btn btn-primary" href="./account.php?logout=1" role="button">Đăng xuất</a>

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
                    <div class="form-group">
                        <input type="submit" value="Đổi mật khẩu" class="btn" id="change-pass-btn" name="change_password">
                    </div>
                </form>
            </div>
        </div>

    </section>
    <section class="container orders">
        <div class="container mt-5">
            <h2 class="font-weight-bolder text-center">Đơn hàng của bạn</h2>
            <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5 productTable">
            <tr>
                <th>ID</th>
                <th>Tổng tiền đơn hàng</th>
                <th>Trạng thái</th>
                <th>Ngày mua</th>
                <th>Ngày nhận hàng</th>
                <th>Chi tiết đơn hàng</th>
            </tr>
            <?php
            require_once('./includes/db.php');
            $orders = getUserOrderById($_SESSION['UserID']);
            foreach ($orders as $ord) {
            ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <p class="mt-3"><?= $ord['OrdID'] ?></p>
                        </div>
                    </td>
                    <td>
                        <span><?= number_format($ord['OrdCost']) . 'VND' ?></span>
                    </td>
                    <td>
                        <span><?= $ord['Status'] == 0 ? "Đang chờ duyệt " : ($ord['Status'] == 1 ? "Đã giao hàng" : "Hóa đơn hủy") ?></span>
                    </td>
                    <td>
                        <span><?= $ord['OrderDate'] ?></span>
                    </td>
                    <td>
                        <span><?= $ord['ReceiveDate'] ?></span>
                    </td>
                    <td>
                        <form action="">
                            <a name="btn-detail" id="btn-detail" class="btn btn-primary" href="./orderDetail.php?id=<?= $ord["OrdID"] ?>" role="button">Chi tiết</a>
                        </form>
                    </td>
                </tr>
            <?php
            } ?>
        </table>

    </section>
    <?php
    require_once("./includes/footer.php")
    ?>
    <script src="https://kit.fontawesome.com/58cb2257a3.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>