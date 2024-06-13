<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php
    require_once("./includes/nav.php")
    ?>
    <section class="container cart my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolder">Chi tiết đơn hàng</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5 productTable">
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
            <?php
            require_once("./includes/db.php");
            if (isset($_GET['id'])) {
                $products = getOrderDetailByID($_GET['id']);
                foreach ($products as $product) {
            ?>
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="./assets/images/<?= $product['ProImage'] ?>" />
                                <div>
                                    <p><?= $product["ProName"] ?></p>
                                    <small><?= $product["Price"] ?><span>VND</span></small>
                                    <br>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span><?= $product["Quantity"] ?></span>
                            <!-- <a class="edit-btn" href="#">Edit</a> -->
                        </td>
                        <td>
                            <span class="product-price"><?= number_format($product["TotalPrice"]) . 'VND' ?></span>
                        </td>
                    </tr>
                <?php
                } ?>
            <?php
            }
            ?>
        </table>
    </section>
    <?php
    require_once("./includes/footer.php")
    ?>
    <script src="https://kit.fontawesome.com/58cb2257a3.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>