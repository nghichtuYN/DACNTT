<?php
session_start();

if (isset($_POST['ProID']) && isset($_POST['Quantity']) && isset($_POST["Price"])) {
    $ProID = $_POST['ProID'];
    $Quantity = $_POST['Quantity'];
    $Price=$_POST['Price'];
    if (isset($_SESSION['cart'][$ProID])) {
        $_SESSION['cart'][$ProID]['Quantity'] = $Quantity;
        $_SESSION['cart'][$ProID]['Price']= $Price;
        echo 'success';
    } else {
        echo 'Product not found in cart';
    }
} else {
    echo 'Invalid request';
}
?>
