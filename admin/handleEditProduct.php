<?php
require_once('../includes/lib.php');
require_once('../includes/db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id=$_POST['id'];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $des=$_POST['descriptions'];
    $catid=$_POST['CatID'];
    $status = isset($_POST['status']) ? 1 : 0;
}
$ketqua = updateProductByID($id,$name,$price,$des,$status,$catid);
if ($ketqua == TRUE)
    header("Location: index.php");
else
    echo "<H3>Lỗi thêm dũ liệu</h3>";
?>
<a href="DanhsachSP.php">Quay về danh sách</a>
?>