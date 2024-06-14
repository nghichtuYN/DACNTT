<?php
require_once('../includes/db.php');

$id = $_REQUEST["id"];
$product = getProductById($id);
for ($i = 0; $i < 5; $i++) {
    if ($i == 0) {
        $imagekey = 'ProImage';
        unlink('../assets/images/' . $product[$imagekey]);
        continue;
    }
    $imagekey = 'ProImage'.$i;
    unlink('../assets/images/' . $product[$imagekey]);
}
$ketqua = deleteProductByID($id);

if ($ketqua == TRUE)
    header("Location: product.php?success=Xóa thành công");
else
    header("Location: product.php?error=Xóa thất bại");
