<?php
require_once('./db.php');
// require_once('../includes/lib.php');

if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];
    $product = getProductById($productId);
    if ($product) {
        echo $product['Price'];
    } else {
        echo "Error: Product not found";
    }
} else {
    echo "Error: No product ID provided";
}
?>
