<?php
require_once('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['name'];
    $status = isset($_POST['status']) ? 1 : 0;
    $result = createCategory($catName, $status);
    if ($result) {
        header("Location: category.php?success=Thêm thành công");

    } else {
        header("Location: addCategory.php?error=Thêm thất bại");

    }
}
?>