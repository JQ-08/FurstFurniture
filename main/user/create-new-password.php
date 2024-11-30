<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'css/createPwd_css.php';

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
    
    <?php
    if (isset($_GET['selector']) && isset($_GET['validator'])) {
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];

        if (empty($selector) || empty($validator)) {
            echo "Could not validate your request!";
        } else {
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
    ?>
    <div class="content">
        <div class="word">
            <p>Please enter your new password...</p>
        </div>
        <div class="form">
            <form action="includes/reset-password.inc.php" method="post">
                <input type="hidden" name="selector" value="<?php echo $_GET["selector"]; ?>">
                <input type="hidden" name="validator" value="<?php echo $_GET["validator"]; ?>">
                <div class="eye-area">
                    <div class="eye-box" onclick="Reset()">
                        <i class="material-icons" id="eye">visibility</i>          
                        <i class="material-icons" id="eye-slash">visibility_off</i>                  
                    </div>
                </div>
                <input type="password" name="pwd" placeholder="                                  Enter a new password...">
                <br>
                <div class="eye-area">
                    <div class="eye-box" onclick="Reset_2()">
                        <i class="material-icons" id="eye-2">visibility</i>          
                        <i class="material-icons" id="eye-slash-2">visibility_off</i>                  
                    </div>
                </div>
                <input type="password" name="pwd-repeat" placeholder="                                  Repeat new password...">
                <br>
                <button type="submit" name="reset-password-submit">Reset password</button>
            </form>
        </div>
    </div>

    <?php
            }
        }
    }
    ?>

</body>
<footer class="footer">
    <div class="copyright">
        <p>© Designed by Algorithm Avengers 2024</p>
    </div>
</footer>

</html>

<script>
    function Reset() {
    var eye = document.getElementById('eye');
    var eyeSlash = document.getElementById('eye-slash');
    var passwordField = document.querySelector('input[name="pwd"]');

    if (eye.style.opacity === '1') {
        eye.style.opacity = '0';
        eyeSlash.style.opacity = '1';
        passwordField.type = 'text';  
    } else {
        eye.style.opacity = '1';
        eyeSlash.style.opacity = '0';
        passwordField.type = 'password';  
    }
}

function Reset_2() {
    var eye = document.getElementById('eye-2');
    var eyeSlash = document.getElementById('eye-slash-2');
    var passwordField = document.querySelector('input[name="pwd-repeat"]');

    if (eye.style.opacity === '1') {
        eye.style.opacity = '0';
        eyeSlash.style.opacity = '1';
        passwordField.type = 'text'; 
    } else {
        eye.style.opacity = '1';
        eyeSlash.style.opacity = '0';
        passwordField.type = 'password';  
    }
}
</script>