<?php
session_start();

?>
<nav class="navbar navbar-expand-lg navbar-light  bg-white fixed-top py-3">
    <div class="container-fluid">
        <img class="logo" src="./assets/images/logos/logo.png">
        <h4 class="brand">Thời trang Luxury</h4>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./shop.php">Cửa hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tin tức</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Liên hệ</a>
                </li>
                <li class="nav-item">
                    <div class="d-flex justify-content-center align-items-center">
                        <a class="nav-link" href="./account.php">
                            <i class="fa-solid fa-user "></i>

                        </a>



                        <a class="nav-link position-relative" href="./cart.php">
                            <i class="fa-solid fa-cart-shopping "></i>
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $totalCart = count($_SESSION['cart']);
                                if ($totalCart > 0) {
                            ?>
                                    <span class="position-absolute top-30 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?= $totalCart ?>
                                    </span>
                            <?php
                                }
                            }
                            ?>
                        </a>

                    </div>
                </li>
                <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> -->
                <!-- <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li> -->
            </ul>
            <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
        </div>
    </div>
</nav>