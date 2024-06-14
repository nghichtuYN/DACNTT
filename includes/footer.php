<footer class="mt-5 py-5">
    <div class="row container mx-auto mt-5">
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <img class="logo" src="./assets/images/logos/logo.png">
            <p class="pt-3">HT Luxury store cung cấp những sản phẩm tốt nhất với giá cả phải chăng nhất</p>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Danh mục sản phẩm</h5>
            <ul class="text-uppercase">
                <?php
                require_once("./includes/db.php");
                $cat = getAllCategories(5,0);
                foreach ($cat as $c) {
                ?>
                    <li><a href="./shop.php?category=<?=$c['CatID']?>&beginPrice=&endPrice="><?= $c['CatName'] ?></a></li>
                <?php
                } ?>
            </ul>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Liên hệ</h5>
            <div>
                <h6 class="text-uppercase">address</h6>
                <p>44/1/4 Bằng B Hoàng Mai</p>
            </div>
            <div>
                <h6 class="text-uppercase">Số điện thoại</h6>
                <p>0972045499</p>
            </div>
            <div>
                <h6 class="text-uppercase">Email</h6>
                <p>hoangtroll14354@gmail.com</p>
            </div>

        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Sản phẩm</h5>
            <div class="row">
                <img src="./assets/images/quan2.jpg" class="img-fluid w-25 h-100 m-2">
                <img src="./assets/images/ao2.jpg" class="img-fluid w-25 h-100 m-2">
                <img src="./assets/images/ao21.jpg" class="img-fluid w-25 h-100 m-2">
                <img src="./assets/images/aothun1.jpg" class="img-fluid w-25 h-100 m-2">
                <img src="./assets/images/mu1.jpg" class="img-fluid w-25 h-100 m-2">
                <img src="./assets/images/ao1.jpg" class="img-fluid w-25 h-100 m-2">
            </div>
        </div>
    </div>
    <div class="copyright mt-5">
        <div class="row container mx-auto">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <img src="./assets/images/logos/logo.png" class="img-fluid w-25 h-80 m-2">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4 text-nowrap mb-2">
                <p>Đặng Việt Hoàng @ 2024 All Right Reserved</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <a href="https://www.facebook.com/nghichtuyn"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/nghichtuyn/"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>