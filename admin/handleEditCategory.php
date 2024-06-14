<?php
require_once('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['name'];
    $id = $_POST['id'];

    $status = isset($_POST['status']) ? 1 : 0;
    $result = updateCategoryByID($id, $catName, $status);
    if ($result) {
        header("Location: category.php?success=Cập nhật thành công");
    } else {
        header("Location: editCategory.php?error=Cập nhật thất bại");

    }
}
