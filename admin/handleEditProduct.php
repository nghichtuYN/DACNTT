<?php
require_once('../includes/lib.php');
require_once('../includes/db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $des = $_POST['descriptions'];
    $catid = $_POST['CatID'];
    $status = isset($_POST['status']) ? 1 : 0;
}
$ketqua = updateProductByID($id, $name, $price, $des, $status, $catid);
if ($ketqua == TRUE)
    header("Location: product.php");
else
    header("Location: editProduct.php?error= Thêm sản phẩm thất bại");

?>
<a href="DanhsachSP.php">Quay về danh sách</a>
?>