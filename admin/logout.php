<?php
session_start();
if (isset($_GET['logout']) && $_GET['logout']==1) {
    echo 'chạy vào đây';
    var_dump($_SESSION);
    if (isset($_SESSION['admin_logined_in'])) {
        unset($_SESSION['UserID']);
        unset($_SESSION['UserName']);
        unset($_SESSION['UserEmail']);
        unset($_SESSION['admin_logined_in']);
        session_destroy();  
        header('Location: login.php');
        exit;
    }
}
