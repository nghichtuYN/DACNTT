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
    require_once("./includes/nav.php")
    ?>
    <?php
    $id = $_REQUEST["product_id"];
    $catId = $_REQUEST["catid"];
    require("./includes/db.php");
    $product = getProductById($id);

    if ($product === FALSE)
        die("<h3>LỖI SQL</h3>");
    if ($product === NULL)
        die("<h3>KHÔNG TÌM THẤY SẢN PHẨM</h3>");
    $hinhanh = ($product["ProImage"] == "") ? "no-image.png" : $product["ProImage"];
    $hinhanh1 = ($product["ProImage1"] == "") ? "no-image.png" : $product["ProImage1"];
    $hinhanh2 = ($product["ProImage2"] == "") ? "no-image.png" : $product["ProImage2"];
    $hinhanh3 = ($product["ProImage3"] == "") ? "no-image.png" : $product["ProImage3"];
    $hinhanh4 = ($product["ProImage4"] == "") ? "no-image.png" : $product["ProImage4"];
    ?>

    <section class="container single-product my-5 pt-5">
        <div class="row mt-5">
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-100 pb-1" src="./assets/images/<?= $hinhanh ?>" id="main-img" />
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="./assets/images/<?= $hinhanh1 ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="./assets/images/<?= $hinhanh2 ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="./assets/images/<?= $hinhanh3 ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="./assets/images/<?= $hinhanh4 ?>" width="100%" class="small-img" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">

                <!-- <h6><?=$p['CatName']?></h6> -->
                <h3 class="py-4"><?= $product['ProName'] ?></h3>
                <h2><?= number_format($product["Price"]) . ' VND'  ?></h2>
                <form action="./cart.php" method="post">
                    <input type="hidden" name="ProImage" value="<?= $hinhanh ?>">
                    <input type="hidden" name="ProName" value="<?= $product['ProName'] ?>">
                    <input type="hidden" name="Price" value="<?= $product['Price'] ?>">
                    <input type="hidden" name="ProID" value="<?= $product['ProID'] ?>">
                    <input type="number" name="product-quantity" value="1">
                    <button class="buy-btn" type="submit" name="add_to_cart">Thêm giỏ hàng</button>
                </form>
                <h4 class="mt-5 mb-5">Chi tiết sản phẩm</h4>
                <span>
                    <?= $product['Description'] ?>
                </span>
            </div>
        </div>
    </section>
    <?php
    require_once("./includes/footer.php")
    ?>
    <script src="https://kit.fontawesome.com/58cb2257a3.js" crossorigin="anonymous"></script>
    <script>
        var mainImg = document.getElementById("main-img")
        var smallImg = document.getElementsByClassName("small-img")
        for (let index = 0; index < 4; index++) {
            smallImg[index].onclick = function() {
                mainImg.src = smallImg[index].src
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>