<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Thông tin đơn hàng</title>
</head>

<body>
    <a name="" id="" class="btn btn-outline-primary" href="index.php" role="button">
        << Quay lại danh sách</a>
            <div class="container mt-5">
                <form method="post" action="handleUpdate.php">
                    <?php
                    include_once('../includes/db.php');
                    $id = $_REQUEST["id"];
                    $orderDetailResult = getOrderDetail($id);
                    ?>
                    <h1 class="mb-4">Thông tin khách hàng</h1>
                    <input type="hidden" name="id" value="<?= $orderDetailResult["order"]["OrdID"] ?>">

                    <div class="form-group row">
                        <label for="custName" class="col-sm-2 col-form-label">Tên khách hàng:</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="custName" name="custName" value="<?= $orderDetailResult["order"]["CustName"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="custAddress" class="col-sm-2 col-form-label">Địa chỉ:</label>
                        <div class="col-sm-10">
                            <textarea readonly class="form-control" id="custAddress" name="custAddress"><?= $orderDetailResult["order"]["CustAddress"] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="custPhone" class="col-sm-2 col-form-label">Điện thoại:</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="custPhone" name="custPhone" value="<?= $orderDetailResult["order"]["CustPhone"] ?>">
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="custEmail" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" readonly class="form-control" id="custEmail" name="custEmail" value="<?= $orderDetailResult["order"]["CustEmail"] ?>">
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="receiveDate" class="col-sm-2 col-form-label">Ngày đặt:</label>
                        <div class="col-sm-10">
                            <input type="date" readonly class="form-control" id="receiveDate" name="receiveDate" value="<?= $orderDetailResult["order"]["OrderDate"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="receiveDate" class="col-sm-2 col-form-label">Ngày nhận:</label>
                        <div class="col-sm-10">
                            <input type="date"  class="form-control" id="receiveDate" name="receiveDate" value="<?= $orderDetailResult["order"]["ReceiveDate"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="totalPrice" class="col-sm-2 col-form-label">Tổng tiền:</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="totalPrice" name="totalPrice" value="<?=number_format($orderDetailResult["order"]["TotalPrice"]).' VND'  ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Status" class="col-sm-2 col-form-label">Tình trạng:</label>
                        <div class="col-sm-10">
                            <select name="Status" class="form-select" aria-label="Default select example">
                                <option selected>--Chọn tình trạng hóa đơn--</option>
                                <option value="0">Hóa đơn mới</option>
                                <option value="1">Hóa đơn đã thanh toán</option>
                                <option value="2">Hóa đơn hủy</option>
                            </select>
                        </div>
                    </div>
                    <h3 class="mb-4">Thông tin sản phẩm:</h3>
                    <div id="productTables" name="productTables">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ảnh</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderDetailResult["orderDetail"] as $item) {
                                    $hinhanh = ($item["ProImage"] == "") ? "no-image.png" : $item["ProImage"];
                                ?>
                                    <tr>
                                        <td><?= $item["ProID"] ?></td>
                                        <td><?= $item["ProName"] ?></td>
                                        <td><img src="../assets/images/<?=  $hinhanh ?>" alt="Product Image" style="width: 50px;"></td>
                                        <td><?= number_format($item["Price"] ).' VND'?></td>
                                        <td><?= $item["Quantity"] ?></td>
                                        <td><?= number_format($item["TotalPrice"]).' VND' ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <input type="submit" value="Cập nhật" class="btn btn-primary mt-3">
                </form>
            </div>
</body>

</html>