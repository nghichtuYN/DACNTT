<?php
require_once('./db.php');
session_start();
if (isset($_POST["place_order"])) {
    $customerName = $_POST['custName'];
    $customerAddress = $_POST['custAddress'];
    $customerPhone = $_POST['custPhone'];
    $customerEmail = $_POST['custEmail'];
    $OrdCost = $_POST['OrdCost'];
    $userID = $_SESSION["UserID"];
    $OrdID = createOrder($userID, $customerName, $customerAddress, $customerPhone, $OrdCost);
    if (isset($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $p) {
            createOrderDetail($OrdID, $p["ProID"], $p["Quantity"], $p["Price"]);
        }
        unset($_SESSION['cart']);
    } else {
    }
    header("Location: ../account.php");
}
