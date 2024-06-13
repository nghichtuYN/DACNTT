<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<?php
require_once("../includes/db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['Status'];
    $receiveDate = $_POST['receiveDate'];
    $result = updateOrder(intval($id), intval($status), $receiveDate);
    if ($result == TRUE) {
        header("Location: index.php");
    } else {
        echo "<H3>Lỗi thêm dũ liệu</h3>";
    }
}

?>
<a name="" id="" class="btn btn-primary" href="./index.php" role="button">Quay về trang danh sách</a>