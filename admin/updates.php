<?php
require_once('./header.php')
?>
<?php
require_once('../includes/db.php');

if (!isset($_SESSION['admin_logined_in'])) {
    header('Location: login.php');
    exit;
}
?>
<div class="container-fluid">
    <div class="row" style="min-height: 1000px">
        <?php
        require_once('./sidebar.php')
        ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h2>Chi tiết đơn hàng</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
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
                            <div class="form-group row">
                                <label for="receiveDate" class="col-sm-2 col-form-label">Ngày đặt:</label>
                                <div class="col-sm-10">
                                    <input type="date" readonly class="form-control" id="receiveDate" name="receiveDate" value="<?= $orderDetailResult["order"]["OrderDate"] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="receiveDate" class="col-sm-2 col-form-label">Ngày nhận:</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="receiveDate" name="receiveDate" value="<?= $orderDetailResult["order"]["ReceiveDate"] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="totalPrice" class="col-sm-2 col-form-label">Tổng tiền:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" id="totalPrice" name="totalPrice" value="<?= number_format($orderDetailResult["order"]["TotalPrice"]) . ' VND'  ?>">
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
                                                <td><img src="../assets/images/<?= $hinhanh ?>" alt="Product Image" style="width: 50px;"></td>
                                                <td><?= number_format($item["Price"]) . ' VND' ?></td>
                                                <td><?= $item["Quantity"] ?></td>
                                                <td><?= number_format($item["TotalPrice"]) . ' VND' ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <input type="submit" value="Cập nhật" class="btn btn-primary mt-3">
                        </form>
                    </div>
                </table>
            </div>
        </main>
    </div>