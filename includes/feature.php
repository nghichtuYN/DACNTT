<section id="featured">
    <?php
    require_once("./includes/db.php");
    $categories = getAllCategories();
    foreach ($categories as $cat) {
    ?>
        <div class="container text-center mt-5 py-5">
            <h3><?= $cat['CatName'] ?></h3>
            <hr class="mx-auto">
        </div>
        <div class="row mx-auto container-fluid">
            <?php
            require_once("./includes/db.php");
            $products = getALlProducts($cat['CatID']);
            foreach ($products as $p) {
                $hinhanh = ($p["ProImage"] == "") ? "no-image.png" : $p["ProImage"];
            ?>
                <div onclick="window.location.href='single_product.php?product_id=<?= $p["ProID"] ?>&catid=<?= $cat["CatID"] ?>'" class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid" src="./assets/images/<?= $hinhanh ?>">
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h5 class="p-name"><?= $p["ProName"] ?></h5>
                    <h4 class="p-price"><?= number_format($p["Price"]) . " VND" ?></h4>
                    <a href="./single_product.php?product_id=<?= $p["ProID"] ?>"><button class="but-btn">Mua ngay</button></a>
                </div>
            <?php
            } ?>
        </div>
    <?php
    } ?>
</section>