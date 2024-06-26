<?php
require_once('./header.php')
?>
<?php
require_once('../includes/db.php');
require_once('../includes/lib.php');

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
            <h2>Thêm sản phẩm mới</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <div class="mx-auto container">
                        <form id="edit-form" method="post" action="handleAddProduct.php" enctype="multipart/form-data">
                            <p style="color :red"><?php
                                                    if (isset($_GET['error'])) {
                                                        echo  $_GET['error'];
                                                    }
                                                    ?></p>
                            <div class="form-group mt-2">
                                <label for="">Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Mô tả</label>
                                <textarea type="text" name="descriptions" class="form-control"></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Giá</label>
                                <input type="number" class="form-control" name="price">
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Ảnh sản phẩm (tối đa 4 ảnh)</label><br>
                                <input type="file" name="files[]" multiple  class="form-control">
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Danh mục</label>
                                <select class="form-select form-select-lg mb-3" name="CatID" aria-label=".form-select-lg example">
                                    <option value="0">--Tất cả danh mục--</option>
                                    <?php
                                    $rows = getAllCategories();
                                    ShowOption($rows, "CatID", "CatName", $CatID);
                                    ?>
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <input class="form-check-input" name="status" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kích hoạt
                                </label>
                            </div>
                            <div class="form-group mt-2">
                                <input class="btn btn-primary" type="submit" value="Thêm sản phẩm" name="add_product">
                            </div>

                        </form>
                    </div>
                </table>
            </div>
        </main>
    </div>