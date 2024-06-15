<?php
require_once('../includes/db.php');

$id = $_REQUEST["id"];
$products=getProductByIdAdnCatID($id);
var_dump($products);
foreach($products as $p){
    $return=updateProductByID($p['ProID'],$p['ProName'],$p['Price'],$p['Description'],0,NULL);
}
$ketqua = deleteCategoryByID($id);
if ($ketqua == TRUE)
    header("Location: category.php?success=Xóa thành công");

else
    header("Location: category.php?error=Xóa thất bại");

?>
