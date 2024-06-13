<?php
require_once('../includes/db.php');

$page_no = isset($_GET['page_no']) && $_GET['page_no'] != "" ? $_GET['page_no'] : 1;
$limit = 10;
$offset = ($page_no - 1) * $limit;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$search_params = "";
$category = 0;
$begin = 1;
$end = 1;
$totalCat = getCountCategory();
$total_page = ceil($totalCat / $limit);

if (isset($_GET['search'])) {
    $category = $_GET['category'];
    $begin = $_GET['beginPrice'];
    $end = $_GET['endPrice'];
    $totalCat = getCountCategory();

    $total_page = ceil($totalCat / $limit);

    $categories = getAllCategories($limit, $offset);
    $search_params = "search=&category=$category&beginPrice=$begin&endPrice=$end";
} else {
    if (isset($_GET['category']) && isset($_GET['beginPrice']) && isset($_GET['endPrice'])) {
        $category = $_GET['category'];
        $begin = $_GET['beginPrice'];
        $end = $_GET['endPrice'];
        $totalCat = getCountCategory();
        $total_page = ceil($totalCat / $limit);

        $categories = getAllCategories($limit, $offset);

        $search_params = "category=$category&beginPrice=$begin&endPrice=$end";
    } else {
        $categories = getAllCategories($limit, $offset);
    }
}
?>

<?php
require_once('./header.php')
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
                                    <a class="btn btn-primary" href="edit.php?id=<?= $c['CatID'] ?>">Sửa</a>
                                    <a class="btn btn-danger" onclick="return confirm('Chắc chắn xóa?');" href="delete.php?id=<?= $c['CatID'] ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>