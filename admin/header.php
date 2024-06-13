<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        header{
            height: 50px;
        }
    </style>
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-warning flex-md-nowrap p-0 shadow justify-content-between">
        <a class="navbar-brand col-md-3 col-lg-2 ne-0 px-3" href="#">HT luxury</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <?php if (isset($_SESSION['admin_logined_in'])) { ?>
                    <a class="nav-link px-3" href="logout.php?logout=1">Đăng xuất</a>
                <?php
                } ?>

            </div>
        </div>
    </header>
</body>
<script src="https://kit.fontawesome.com/58cb2257a3.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>