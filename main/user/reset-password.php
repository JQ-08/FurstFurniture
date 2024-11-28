<?php

session_start();
include 'css/reset-pwd_css.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../../images/furst_logo_circle.png" />
    <title>Fürst</title>

    <!-- Alert Messages -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <!-- Google Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>

    <header>
        <a href='./index.php'>
            <div class="logo">
                <img src="../../images/furst.png" alt="Logo">
            </div>
        </a>
        <nav>
            <a href="view_products.php">Products</a>
            <a href="orders.php">Orders</a>
            <?php
            if (isset($_SESSION["username"])) {
                echo "<a href='profile.php'>" . $_SESSION["username"] . "</a>";
                echo "<a href='#' onclick=\"if(confirm('Are you sure you want to logout?')) { setTimeout(function(){ alert('You\'ve been logged out. Redirecting to home page...'); window.location.href='includes/logout.inc.php'; }, 1000); } else { event.preventDefault(); }\">Logout</a>";
            } else {
                echo "<a href='login.php'>Login</a>";
            }
            ?>
            <a href="shopping_cart.php"><span class="material-symbols-outlined" alt="cart icon">shopping_cart</span></a>
        </nav>
    </header>

    <div class="box">
        <div class="title">
            <h1>Reset your password</h1>
        </div>
        <div class="content">
            <p>An e-mail will be send to you with instructions on how to reset your password.</p>
            <form action="includes/reset-request.inc.php" method="post">
                <input type="text" name="email" placeholder="                                Enter your e-mail address...">
                <br>
                <button type="submit" name="reset-request-submit">Receive new password by e-mail</button>
            </form>
            <?php
                if (isset($_GET["reset"])) {
                    if ($_GET["reset"] == "success") {
                        echo '<p class="signupsuccess">Check your e-mail</p>';
                    }
                }
            ?>
        </div>
    </div>
</body>
<footer class="footer">
    <div class="copyright">
        <p>© Designed by Algorithm Avengers 2024</p>
    </div>
</footer>

</html>