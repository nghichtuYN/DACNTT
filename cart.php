<?php
session_start();
if (!isset($_SESSION['logined_in']) || !$_SESSION['logined_in']) {
    header('Location: login.php'); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit;
}

if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['cart'])) {
        $product_array_ids = array_column($_SESSION['cart'], "ProID");
        if (!in_array($_POST['ProID'], $product_array_ids)) {
            echo "Đã vào zô";
            echo !in_array($_POST['ProID'], $product_array_ids);
            $product_array = array(
                'ProID' => $_POST['ProID'],
                'ProName' => $_POST['ProName'],
                'Price' => $_POST['Price'],
                'ProImage' => $_POST['ProImage'],
                'Quantity' => $_POST['product-quantity']
            );
            $_SESSION['cart'][$_POST['ProID']] = $product_array;
        } else {
            echo '<script>alert("Đã tồn tại")</script>';
            // echo '<script>window.location.href="single_product.php";</script>';
        }
    } else {
        $ProID = $_POST['ProID'];
        $ProName = $_POST['ProName'];
        $Price = $_POST['Price'];
        $Quantity = $_POST['product-quantity'];
        $ProImage = $_POST['ProImage'];
        $product_array = array(
            'ProID' => $ProID,
            'ProName' => $ProName,
            'Price' => $Price,
            'ProImage' => $ProImage,
            'Quantity' => $Quantity
        );
        $_SESSION['cart'][$ProID] = $product_array;
    }
} else if (isset($_POST["remove_product"])) {
    unset($_SESSION['cart'][$_POST['ProID']]);
} else {
    // header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>


<body>
    <?php
    require_once('./includes/nav.php')
    ?>>
    <section class="container cart my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolder">Giỏ hàng</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5 productTable">
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
            <?php
            if (isset($_SESSION['cart'])) {

                foreach ($_SESSION['cart'] as $products) {
            ?>
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="./assets/images/<?= $products['ProImage'] ?>" />
                                <div>
                                    <p><?= $products["ProName"] ?></p>
                                    <small><?= $products["Price"] ?><span>VND</span></small>
                                    <br>
                                    <form action="./cart.php" method="post">
                                        <input type="hidden" class="ProID" name="ProID" value="<?= $products["ProID"] ?>">
                                        <input type="submit" name="remove_product" class="remove-btn" href="#" value=" remove" />
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td>
                            <input type="number" class="quantity" min="1" name="products[<?= $products["ProID"] ?>][quantity]" value="<?= $products["Quantity"] ?>" />
                            <!-- <a class="edit-btn" href="#">Edit</a> -->
                        </td>
                        <td>
                            <span class="product-price"><?= number_format($products["Price"] * $products["Quantity"]) . 'VND' ?></span>
                        </td>
                    </tr>
                <?php
                } ?>
            <?php
            }
            ?>
        </table>
        <div class="cart-total">
            <table>
                <tr>
                    <td>Tổng</td>
                    <td id="totalPrice"></td>
                </tr>
            </table>
        </div>
        <div class="check-out-container">
            <form action="./checkout.php" method="post">
                <input type="hidden" value="totalPrice">
                <input <?php if (empty($_SESSION["cart"])) echo 'disabled'; ?> class="btn check-out-btn" value="Thanh toán" name="checkout" type="submit">
            </form>
        </div>
    </section>
    <?php
    require_once("./includes/footer.php")
    ?>
    <script src="https://kit.fontawesome.com/58cb2257a3.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '.quantity', function() {
                var quantity = parseInt($(this).val());
                var productId = $(this).closest('tr').find('.ProID').val();

                if (isNaN(quantity) || quantity < 0) {
                    return;
                }
                var priceFinal = $(this).closest('tr').find('.product-price');

                $.ajax({
                    url: './includes/getPrice.php',
                    method: 'GET',
                    data: {
                        productId: productId
                    },
                    success: function(response) {
                        var price = parseFloat(response);
                        var total = quantity * price;
                        priceFinal.text(formatCurrency(total));
                        updateCart(productId, quantity, total);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            function updateCart(productId, quantity, total) {
                $.ajax({
                    url: './includes/updateCart.php',
                    method: 'POST',
                    data: {
                        ProID: productId,
                        Quantity: quantity,
                        Price: total
                    },
                    success: function(response) {
                        if (response === 'success') {
                            var totalPrice = calculateTotalPrice();
                            $('#totalPrice').text(formatCurrency(totalPrice));
                        } else {
                            console.error('Error updating cart: ' + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            function calculateTotalPrice() {
                var totalPrice = 0;
                $('.product-price').each(function() {
                    var price = parseFloat($(this).text());
                    var price = parseFloat($(this).text().replace(/[^0-9]/g, ''));
                    if (!isNaN(price) && price >= 0) {
                        totalPrice += price;
                    }
                });
                return totalPrice;
            }

            function formatCurrency(amount) {
                return amount.toLocaleString('vi-VN') + ' VND';
            }
            var initialTotalPrice = calculateTotalPrice();
            $('#totalPrice').text(formatCurrency(initialTotalPrice));
        });
    </script>
</body>

</html>