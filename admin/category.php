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
$totalCat = getCountCategory();
$total_page = ceil($totalCat / $limit);
$categories = getAllCategories($limit, $offset);
?>


<div class="container-fluid">
    <div class="row" style="min-height: 1000px">
        <?php
        require_once('./sidebar.php')
        ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">

                <h1 class="h2">Quản lý danh mục</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                    </div>
                </div>
            </div>
            <h2>Danh sách danh mục</h2>
            <div class="d-flex justify-content-between mt-3 mb-3">
                <a name="" id="" class="btn btn-primary" href="addCategory.php" role="button">Thêm danh mục</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col">Tình trạng</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($categories as $c) {
                        ?>
                            <tr>
                                <td><?= $c['CatID'] ?></td>
                                <td><?= $c['CatName'] ?></td>
                                <td><?= $c['Status'] ? '<span class="badge bg-success">Hoạt động</span>' : '<span class="badge bg-danger">Ẩn</span>' ?></td>
                                <td>
                                    <a class="btn btn-primary" href="editCategory.php?id=<?= $c['CatID'] ?>">Sửa</a>
                                    <a class="btn btn-danger" onclick="return confirm('Chắc chắn xóa?');" href="deleteCategory.php?id=<?= $c['CatID'] ?>">Xóa</a>
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