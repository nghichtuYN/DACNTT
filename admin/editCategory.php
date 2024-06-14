<?php
require_once('./header.php')
?>
<?php
require_once('../includes/db.php');
require_once('../includes/lib.php');
if (isset($_GET['id'])) {
    $category = getCategoryByID($_GET['id']);
    if ($category === FALSE)
        die("<h3>LỖI SQL</h3>");
    if ($category === NULL)
        die("<h3>KHÔNG TÌM THẤY SẢN PHẨM</h3>");
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
<meta charset="UTF-8">
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
            <h2>Cập nhật</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <div class="mx-auto container">
                        <form id="edit-form" method="post" action="handleEditCategory.php" enctype="multipart/form-data">
                            <p style="color :red"><?php
                                                    if (isset($_GET['error'])) {
                                                        echo  $_GET['error'];
                                                    }
                                                    ?></p>
                            <input type="hidden" name="id" value="<?= $category["CatID"] ?>">

                            <div class="form-group mt-2">

                                <label for="">Tên danh mục</label>
                                <input type="text" name="name" class="form-control" value="<?= $category["CatName"] ?>">
                            </div>
                            <div class="form-group mt-2">
                                <input class="form-check-input" name="status" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kích hoạt
                                </label>
                            </div>
                            <div class="form-group mt-2">
                                <input class="btn btn-primary" type="submit" value="Cập nhật" name="edit_category">
                            </div>

                        </form>
                    </div>
                </table>
            </div>
        </main>
    </div>