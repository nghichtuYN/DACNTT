<?php
require_once('./includes/db.php');

$page_no = isset($_GET['page_no']) && $_GET['page_no'] != "" ? $_GET['page_no'] : 1;
$limit = 8;
$offset = ($page_no - 1) * $limit;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$search_params = "";
$category = 0;
$begin = 1;
$end = 1;
$totalProduct = getCountProduct();
$total_page = ceil($totalProduct / $limit);
if (isset($_GET['search'])) {
    $category = $_GET['category'];
    $begin = $_GET['beginPrice'];
    $end = $_GET['endPrice'];
    $totalProduct = getCountProduct($category, $begin, $end);
    $total_page = ceil($totalProduct / $limit);

    $products = getALlProducts($category, $begin, $end, $limit, $offset);
    $search_params = "search=&category=$category&beginPrice=$begin&endPrice=$end";
} else {
    if (isset($_GET['category']) || isset($_GET['beginPrice']) || isset($_GET['endPrice'])) {
        $category = $_GET['category'];
        $begin = $_GET['beginPrice'];
        $end = $_GET['endPrice'];
        $totalProduct = getCountProduct($category, $begin, $end);
        $total_page = ceil($totalProduct / $limit);
        $products = getALlProducts($category, $begin, $end, $limit, $offset);
        $search_params = "category=$category&beginPrice=$begin&endPrice=$end";
    } else {
        $products = getALlProducts(0, 0, 0, $limit, $offset);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <style>
        .product img {
            width: 100%;
            height: 350px;
            box-sizing: border-box;
            object-fit: cover;
        }

        .pagination a {
            color: coral
        }

        .pagination li:hover a {
            color: #fff;
            background-color: coral;
        }
    </style>
</head>

<body>
    <?php
    require_once("./includes/nav.php")
    ?>
    <div class="row">
        <section id="search" class="col-lg-2 col-md-4 col-sm-6 my-5 py-5 ms-2">
            <div class="container mt-5 py-5">
                <p>Tìm kiếm sản phẩm</p>
                <hr>
            </div>
            <form action="./shop.php" method="get">
                <div class="row mx-auto container">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p>Tất cả anh mục</p>
                        <?php
                        $categories = getAllCategories();

                        foreach ($categories as $c) {
                            if($c['Status']==0)
                                continue
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="<?= $c['CatID'] ?>" name="category" id="category_one" <?= $category == $c['CatID'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    <?= $c['CatName'] ?>
                                </label>
                            </div>
                        <?php
                        } ?>
                    </div>

                </div>
                <div class="row mx-auto container mt-5">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p>Khoảng giá</p>
                        <div class="price d-flex justify-content-center align-items-center">
                            <input type="number" min="1" name="beginPrice" placeholder="Từ">
                            <p>-</p>
                            <input type="number" min="1" name="endPrice" placeholder="Đến" >
                        </div>
                    </div>
                </div>
                <div class="form-group my-3 mx-3">
                    <input type="submit" name="search" value="Tìm kiếm" class="btn btn-primary">
                </div>
            </form>
        </section>
        <section id="shop" class=" col-lg-9 col-md-7 col-sm-6 my-5 py-5">
            <div class="container mt-5 py-5">
                <h3>Danh sách sản phẩm</h3>
                <hr>
            </div>
            <div class="row mx-auto container-fluid">
                <?php
                foreach ($products as $p) {
                    if($p['Status']==0)
                        continue;
                    $hinhanh = ($p["ProImage"] == "") ? "no-image.png" : $p["ProImage"];
                ?>
                    <div onclick="window.location.href='single_product.php?product_id=<?= $p["ProID"] ?>'" class="product text-center col-lg-3 col-md-4 col-sm-12">
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
        </section>
    </div>
    <div class="d-flex flex-row-reverse">

        <nav class="me-5" aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item <?php if ($page_no <= 1) {
                                            echo 'disabled';
                                        } ?>">
                    <a class="page-link" href="<?php if ($page_no <= 1) {
                                                    echo "#";
                                                } else {
                                                    echo "?page_no=" . ($page_no - 1) . "&$search_params";
                                                } ?>">Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $total_page; $i++) {
                ?>
                    <li class="page-item <?php if ($page_no == $i) {
                                                echo 'active';
                                            } ?>">
                        <a class="page-link" href="?page_no=<?= $i ?>&<?= $search_params ?>"><?= $i ?></a>
                    </li>
                <?php
                }
                ?>
                <li class="page-item <?php if ($page_no >= $total_page) {
                                            echo 'disabled';
                                        } ?>">
                    <a class="page-link" href="<?php if ($page_no >= $total_page) {
                                                    echo "#";
                                                } else {
                                                    echo "?page_no=" . ($page_no + 1) . "&$search_params";
                                                } ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <?php
    require_once("./includes/footer.php")
    ?>
    <script src="https://kit.fontawesome.com/58cb2257a3.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>