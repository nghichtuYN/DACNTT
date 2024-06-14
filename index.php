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
    <section id="home">
        <div class="container">
            <h5>HÀNG MỚI VỀ</h5>
            <h1><span>GIÁ TỐT NHẤT</span> TRONG MÙA NÀY</h1>
            <p>HT Luxury store cung cấp những sản phẩm tốt nhất với giá cả phải chăng nhất</p>
            <button>Mua ngay</button>
        </div>

    </section>
    <section id="brand" class="container">
        <div class="row">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="./assets/images/brands/adidas.png">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="./assets/images/brands/chanel.png">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="./assets/images/brands/lv.jpg">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="./assets/images/brands/nike.jpg">
        </div>
    </section>
    <section id="new" class="w-100">
        <div class="row p-0 m-0">
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="./assets/images/logos/logo.png">
                <div class="details">
                    <h2>
                        aaaaaaaa
                    </h2>
                    <button class="text-uppercase">Mua ngay</button>
                </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="./assets/images/logos/logo.png">
                <div class="details">
                    <h2>
                        aaaaaaaa
                    </h2>
                    <button class="text-uppercase">Mua ngay</button>
                </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="./assets/images/logos/logo.png">
                <div class="details">
                    <h2>
                        aaaaaaaa
                    </h2>
                    <button class="text-uppercase">Mua ngay</button>
                </div>
            </div>
        </div>
    </section>

    <?php
    require_once("./includes/feature.php")
    ?>
    <section id="banner" class="my-5">
        <div class="container">
            <h4>MID SEASON'S SALE</h4>
            <h1>Autum Collection <br>Up to 30% OFF</h1>
            <button class="text-uppercase">Mua ngay</button>
        </div>
    </section>
    <?php
    require_once("./includes/footer.php")
    ?>
    <script src="https://kit.fontawesome.com/58cb2257a3.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>