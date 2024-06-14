<?php
require_once('../includes/db.php');

$id = $_REQUEST["id"];
$ketqua = deleteCategoryByID($id);
if ($ketqua == TRUE)
    header("Location: category.php?success=Xóa thành công");

else
    header("Location: category.php?error=Xóa thất bại");

?>
<a