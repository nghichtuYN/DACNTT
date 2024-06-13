<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    <style>
        .navbar-nav .nav-item {
            margin-left: -10px;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .nav-link.active {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>

    <nav id="sidebarMenu" class="navbar navbar-expand-lg navbar-light col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex flex-column" id="navbarNavDropdown">
            <ul class="navbar-nav d-flex flex-column">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./index.php">
                        Quản lý đơn hàng
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">
                        Quản lý sản phẩm
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="category.php">
                        Quản lý danh mục
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="account.php">
                        Tài khoản
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var navLinks = document.querySelectorAll('.navbar-nav .nav-link');

            navLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    navLinks.forEach(function(nav) {
                        nav.classList.remove('active');
                    });

        
                    this.classList.add('active');
                });
            });
        });
    </script>

</body>

</html>