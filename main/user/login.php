<?php
    include 'css/login_css.php';

    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo '<script>alert("Fill in all fields!");</script>';
        } else if ($_GET["error"] == "invalidname") {
            echo '<script>alert("Choose a proper name!");</script>';
        } else if ($_GET["error"] == "invalidemail") {
            echo '<script>alert("Choose a proper email!");</script>';
        } else if ($_GET["error"] == "passwordsdontmatch") {
            echo '<script>alert("Passwords does not match!");</script>';
        } else if ($_GET["error"] == "stmtfailed") {
            echo '<script>alert("Something went wrong, try again!");</script>';
        } else if ($_GET["error"] == "usernametaken") {
            echo '<script>alert("Username already taken!");</script>';
        } else if ($_GET["error"] == "none") {
            echo '<script>alert("You Are Signed Up!");</script>';
        } else if ($_GET["error"] == "wronglogin") {
            echo '<script>alert("Incorrect Login Information!");</script>';
        }
    }
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fürst | Login & Register</title>

    <!-- BOX ICON -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="form-container">
    <a class="back-to-index" href="index.php">
        <i class='bx bx-left-arrow-alt'></i>
    </a>
        <div class="col col-1">
            <div class="image-layer">
                <img src="../../images/login/white-outline.png" class="form-image-main">
                <img src="../../images/login/dots.png" class="form-image dots">
                <img src="../../images/login/coin.png" class="form-image coin">
                <img src="../../images/login/spring.png" class="form-image spring">
                <img src="../../images/login/rocket.png" class="form-image rocket">
                <img src="../../images/login/cloud.png" class="form-image cloud">
                <img src="../../images/login/stars.png" class="form-image stars">
            </div>
            <p class="featured-words">Find Your Favourite Furniture with <span>Fürst</span></p>
        </div>

        <div class="col col-2">
            <div class="btn-box">
                <button class="btn btn-1" id="login">Sign In</button>
                <button class="btn btn-2" id="register">Sign Up</button>
            </div>
            
            <form action="includes/functions.inc.php" method="post">
                <div class="login-form">
                    <div class="form-title">
                        <span>Sign In</span>
                    </div>
                    <div class="form-inputs">
                        <div class="input-box">
                            <input type="text" class="input-field" placeholder="Username" name="name" required>
                            <i class="bx bx-user icon"></i>
                        </div>
                        <div class="input-box">
                            <input type="password" class="input-field" placeholder="Password" id="logPwd" name="pwd" required>
                            <div class="lock-box" onclick="myLogPassword()">
                                <i class="bx bx bxs-lock-alt icon" id="lock"></i>
                                <i class='bx bx-lock-open-alt icon' id="lock-open"></i>      
                            </div>              
                        </div>
                        <div class="input-box">
                            <button type="submit" class="input-submit" name="submit_login">
                                <span>Sign In</span>
                                <i class="bx bx-right-arrow-alt"></i>
                            </button>
                        </div>
                        <div class="forgotpwd">
                            <?php
                                if (isset($_GET["newpwd"])) {
                                    if ($_GET["newpwd"] == "passwordupdated") {
                                        echo '<p class="signupsuccess">Your password has been reset</p>';
                                    }
                                }
                            ?>
                            <a href="reset-password.php">Forgot password?</a>
                        </div>
                    </div>
                </div>
            </form>
            <form action="includes/functions.inc.php" method="post">
                <div class="register-form">
                    <div class="form-title">
                        <span>Create Account</span>
                    </div>
                    <div class="form-inputs">
                        <div class="input-box">
                            <input type="text" class="input-field" placeholder="Email" name="email" required>
                            <i class="bx bx-envelope icon"></i>
                        </div>
                        <div class="input-box">
                            <input type="text" class="input-field" placeholder="Username" name="name" required>
                            <i class="bx bx-user icon"></i>
                        </div>
                        <div class="input-box">
                            <input type="password" class="input-field" placeholder="Password" id="regPwd" name="pwd" required>
                            <div class="lock-box" onclick="myRegPassword()">
                                <i class="bx bx bxs-lock-alt icon" id="lock2"></i>
                                <i class='bx bx-lock-open-alt icon' id="lock-open2"></i>      
                            </div>                      
                        </div>
                        <div class="input-box">
                            <input type="password" class="input-field" placeholder="Confirm Password" id="regPwd2" name="pwdrepeat" required>
                            <div class="lock-box" onclick="myRegPassword2()">
                                <i class="bx bx bxs-lock-alt icon" id="lock3"></i>
                                <i class='bx bx-lock-open-alt icon' id="lock-open3"></i>      
                            </div>                      
                        </div>
                        <div class="input-box">
                            <button class="input-submit" name="submit_register">
                                <span>Sign Up</span>
                                <i class="bx bx-right-arrow-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer class="footer">	
        <div class="copyright">
            <p>© Designed by Algorithm Avengers 2024</p>
        </div>
    </footer>
</body>
</html>

<?php
    include 'js/login_js.php';
?>
