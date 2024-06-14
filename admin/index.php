<?php
require_once('./header.php')
?>
<?php
require_once('../includes/db.php');

if (!isset($_SESSION['admin_logined_in'])) {
    header('Location: login.php');
    exit;
}
$page_no = isset($_GET['page_no']) && $_GET['page_no'] != "" ? $_GET['page_no'] : 1;
$limit = 5;
$offset = ($page_no - 1) * $limit;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$search_params = "";
$totalOrder = getCountOrder();
$total_page = ceil($totalOrder / $limit);
$orders = getAllOrders($limit, $offset);
?>


<div class="container-fluid">
    <div class="row" style="min-height: 1000px">
        <?php
        require_once('./sidebar.php')
        ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">

                <h1 class="h2">Quản lý đơn hàng</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                    </div>
                </div>
            </div>
            <h2>Danh sách đơn hàng</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tình trạng</th>
                            <th scope="col">Mã Khách Hàng</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($orders as $o) {
                        ?>
                            <tr>
                                <td><?= $o['OrdID'] ?></td>

                                <td><?= $o['Status'] == 0 ? "Hóa đơn mới" : ($o['Status'] == 1 ? "Hóa đơn đã thanh toán" : "Hóa đơn hủy") ?></td>
                                <td><?= $o['UserID'] ?></td>
                                <td><?= $o['OrderDate'] ?></td>
                                <td><?= $o['CustPhone'] ?></td>
                                <td><?= $o['CustAddress'] ?></td>
                                <td><?= number_format($o['OrdCost']) . ' VND' ?></td>
                                <td>
                                    <a class="btn btn-primary" href="updates.php?id=<?= $o['OrdID'] ?>">Chi tiết</a>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
                <div class="d-flex flex-row-reverse">

                    <nav class="me-5" aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item <?php if ($page_no <= 1) {
                                                        echo 'disabled';
                                                    } ?>">
                                <a class="page-link" href="<?php if ($page_no <= 1) {
                                                                echo "#";
                                                            } else {
                                                                echo "?page_no=" . ($page_no - 1) . "&$search_params";
                                                            } ?>">Previous</a>
                            </li>
                            <?php
                            for ($i = 1; $i <= $total_page; $i++) {
                            ?>
                                <li class="page-item <?php if ($page_no == $i) {
                                                            echo 'active';
                                                        } ?>">
                                    <a class="page-link" href="?page_no=<?= $i ?>&<?= $search_params ?>"><?= $i ?></a>
                                </li>
                            <?php
                            }
                            ?>
                            <li class="page-item <?php if ($page_no >= $total_page) {
                                                        echo 'disabled';
                                                    } ?>">
                                <a class="page-link" href="<?php if ($page_no >= $total_page) {
                                                                echo "#";
                                                            } else {
                                                                echo "?page_no=" . ($page_no + 1) . "&$search_params";
                                                            } ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </main>
    </div>