<?php
require_once('../includes/lib.php');
require_once('../includes/db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $image = UploadFile($_FILES, "../assets/images");
    $catId = $_POST["CatID"];
    $des = $_POST['descriptions'];
    $status = isset($_POST['status']) ? 1 : 0;
}

$ketqua = createProduct($name, $image[0], $image[1], $image[2], $image[3], $image[4], $price, $des, $status, $catId);
if ($ketqua == TRUE)
    header("Location: product.php");
else
    header("Location: addProduct.php?error=Thêm sản phẩm thất bại");

?>
<a href="DanhsachSP.php">Quay về danh sách</a>