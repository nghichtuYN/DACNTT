<?php
session_start();
if (!empty($_SESSION["cart"]) && isset($_POST['checkout'])) {
    $totalProduct = count($_SESSION['cart']);
    $listProduct = $_SESSION['cart'];
} else {
    header("Location :./index.php");
    exit;
}

function getTotalPrice()
{
    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $product) {
        $totalPrice += $product['Price'];
    }
    return $totalPrice;
}

?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mẫu thanh toán</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="backtocart">
        <a name="btn-return" id="" class="btn btn-primary" href="./cart.php" role="button">
            << Quay lại giỏ hàng</a>
    </div>
    <h2>Mẫu thanh toán</h2>

    <div class="row">
        <div class="col-75">
            <div class="container">
                <form action="./includes/place_order.php" method="post">

                    <div class="row">
                        <div class="col-50">
                            <h3>Địa chỉ thanh toán</h3>
                            <div class="form-group row">
                                <label for="custName" class="col-sm-2 col-form-label">Họ tên:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="custName" name="custName" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="custAddress" class="col-sm-2 col-form-label">Địa chỉ:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="custAddress" name="custAddress" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="custPhone" class="col-sm-2 col-form-label">Điện thoại:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="custPhone" name="custPhone" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="custEmail" class="col-sm-2 col-form-label">Email:</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="custEmail" name="custEmail" required>
                                </div>
                            </div>

                            <input type="hidden" name="OrdCost" id="" value="<?= getTotalPrice() ?>">
                        </div>

                        <div class="col-50">
                            <h3>Phương thức thanh toán</h3>

                            <label for="payment-method">Chọn hình thức thanh toán:</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Chọn hình thức thanh toán</option>
                                <option value="1">Thanh toán khi nhận hàng</option>
                            </select>
                        </div>

                    </div>
                    <input type="submit" value="Đặt hàng" name="place_order" class="btn">
                </form>
            </div>
        </div>
        <div class="col-25">
            <div class="container">
                <h4>Giỏ hàng <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?= $totalProduct ?></b></span></h4>
                <?php
                foreach ($listProduct as $p) {
                ?>
                    <p><a href="single_product.php?product_id=<?= $p["ProID"] ?>"><?= $p["ProName"] ?></a> <span class="price"><?= number_format($p["Price"]) . 'VND' ?></span></p>
                <?php
                } ?>

                <hr>
                <p>Tổng <span class="price" style="color:black"><b><?= number_format(getTotalPrice()) . 'VND' ?></b></span></p>
            </div>
        </div>
    </div>
</body>

</html>