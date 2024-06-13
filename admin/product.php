<?php
require_once('./header.php')
?>
<?php
require_once('../includes/db.php');
require_once('../includes/lib.php');

if (!isset($_SESSION['admin_logined_in'])) {
    header('Location: login.php');
    exit;
}
$page_no = isset($_GET['page_no']) && $_GET['page_no'] != "" ? $_GET['page_no'] : 1;
$limit = 8;
$offset = ($page_no - 1) * $limit;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$search_params = "";
$category = 0;
$begin = 1;
$end = 1;
$tukhoa = "";
$totalProduct = getCountProduct();
$total_page = ceil($totalProduct / $limit);
if (isset($_GET['search'])) {
    $category = $_GET['category'];
    $tukhoa = $_GET['key'];
    $totalProduct = getCountProduct($category, 0, 0, $tukhoa);
    $total_page = ceil($totalProduct / $limit);
    $products = getALlProducts($category, null, null, $limit, $offset, $tukhoa);
    $search_params = "category=$category&key=$tukhoa" ;
} else {
    if (isset($_GET['category']) || isset($_GET['key'])) {
      
        $category = $_GET['category'] ? $_GET['category'] : 0;
        $tukhoa = $_GET['key'] ?  $_GET['key'] : "";
        $totalProduct = getCountProduct($category, null, null, $tukhoa);
        $total_page = ceil($totalProduct / $limit);
        $products = getALlProducts($category, null, null, $limit, $offset, $tukhoa);
        $search_params = "category=$category&key=$tukhoa";
    } else {
        $products = getALlProducts(null, null, null, $limit, $offset, null);
    }
}
?>


<style>
    .limited-description {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .limited-name {
        max-width: 50px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    thead th {
        font-weight: bold;
       
    }
</style>
<div class="container-fluid">
    <div class="row" style="min-height: 1000px">
        <?php
        require_once('./sidebar.php')
        ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">

                <h1 class="h2">Quản lý sản phẩm</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                    </div>
                </div>
            </div>
            <h2>Danh sách sản phẩm</h2>
            <div class="d-flex flex-row-reverse">
                <form name="f1" id="f1" action="" method="get" class="d-flex flex-end justify-content-center align-items-center">
                    <label>
                        Tìm kiếm:
                    </label>
                    <select name="category" id="CatID">
                        <option value="0">Tất cả nhóm SP</option>
                        <?php
                        $rows = getAllCategories();
                        ShowOption($rows, "CatID", "CatName", $CatID);
                        ?>
                    </select>
                    <label>
                        Từ khóa:
                    </label>
                    <input type="text" name="key" value="<?= $tukhoa ?>">
                    <button class="btn btn-primary" name="search" type="submit">Tìm kiếm</button>

                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <td scope="col">Id</td>
                            <td scope="col">Tên sản phẩm</td>
                            <td scope="col">Hình ảnh</td>
                            <td scope="col">Giá sản phẩm</td>
                            <td scope="col">Mô tả</td>
                            <td scope="col">Danh mục</td>
                            <td scope="col">Tình trạng</td>
                            <td scope="col">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products as $p) {
                            $hinhanh = ($p["ProImage"] == "") ? "no-image.png" : $p["ProImage"];
                        ?>
                            <tr>
                                <td><?= $p["ProID"] ?></td>
                                <td class="limited-name"><?= $p["ProName"] ?></td>
                                <td align="center"><img src="../assets/images/<?= $hinhanh ?>" width="100"></td>
                                <td align="center"><?= number_format($p["Price"]) . ' VND'  ?></td>
                                <td class="limited-description"><?= $p["Description"] ?></td>
                                <td align="center"><?= $p["CatName"] ?></td>
                                <td><?= $p['Status'] ? '<span class="badge bg-success">Hoạt động</span>' : '<span class="badge bg-danger">Ẩn</span>' ?></td>
                                <td>
                                    <a class="btn btn-primary" href="editProduct.php?id=<?= $p["ProID"] ?>">Sửa</a>
                                    <a class="btn btn-danger" href="deleteProduct.php?id=<?= $p["ProID"] ?>" onclick="return confirm('Chắc chắn xóa?');">Xóa</a>
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