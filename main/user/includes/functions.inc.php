<?php
include 'dbh.inc.php';

//******************   LOGIN & REGISTER FUNCTIONS START  *********************//

function emptyInputSignup($name, $email, $pwd, $pwdRepeat)
{
    $result;
    if (empty($name) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidname($name)
{
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidemail($email)
{
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
    $result;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function nameExists($conn, $name, $email)
{
    $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail= ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function generateUserId($LastId)
{
    $numericPart = intval(substr($LastId, 1));

    $nextNumericPart = $numericPart + 1;

    $newUserId = "Z" . str_pad($nextNumericPart, 4, "0", STR_PAD_LEFT);

    return $newUserId;
}
$newUserId = generateUserId($LastId);
function createUser($conn, $name, $email, $pwd, $newUserId)
{

    $sql = "INSERT INTO users (usersName, usersEmail, usersPwd, userId) VALUES (?, ?, ?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $pwd, $newUserId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "<script>window.location.href = '../login.php?error=none'; </script>";
    exit();
}

function emptyInputLogin($name, $pwd)
{
    $result;
    if (empty($name) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $name, $pwd)
{
    $check = nameExists($conn, $name, $name);

    if ($name !== $check['usersName']) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    if ($name === "admin" && $pwd === "12345") {
        header("location: ../../admin/index.php");
        exit();
    } else if ($pwd === $check['usersPwd']) {
        session_start();
        $_SESSION["userId"] = $check["userId"];
        $_SESSION["username"] = $check["usersName"];
        header("location: ../index.php");
        exit();
    } else {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

}

//******************   LOGIN & REGISTER FUNCTIONS END  *********************//

//******************   PRODUCT_DETAILS GET PRODUCT_ID FUNCTIONS START  *********************//
function getProductDetails($conn, $id) {
    $sql = "SELECT name, description, price, image1, image2, image3, image4, depth, width, height, type FROM products WHERE id = ?";

    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Statement preparation failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row; 
    } else {
        return null; 
    }

    $stmt->close();
}


//******************   PRODUCT_DETAILS GET PRODUCT_ID FUNCTIONS END  *********************//

//******************   ALERT MESSAGES FUNCTIONS START  *********************//

if(isset($success_msg)){
    foreach($success_msg as $success_msg){
       echo '<script>swal("'.$success_msg.'", "" ,"success");</script>';
    }
 }
 
if(isset($warning_msg)){
    foreach($warning_msg as $warning_msg){
       echo '<script>swal("'.$warning_msg.'", "" ,"warning");</script>';      
    }
}
function isLoggedIn() {
   return false; 
}
 
if(isset($info_msg)){
    foreach($info_msg as $success_msg){
       echo '<script>swal("'.$info_msg.'", "" ,"info");</script>';
    }
}
 
if(isset($error_msg)){
    foreach($error_msg as $error_msg){
       echo '<script>swal("'.$error_msg.'", "" ,"error");</script>';
    }
}

//******************   ALERT MESSAGES FUNCTIONS END  *********************//

//******************   LOGIN AFTER SUBMIT FUNCTIONS START  *********************//

if (isset($_POST["submit_login"])) {
    $name = $_POST["name"];
    $pwd = $_POST["pwd"];

    include 'dbh.inc.php';

    loginUser($conn, $name, $pwd);

    if (emptyInputLogin($name, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $name, $pwd);
}
//******************   LOGIN AFTER SUBMIT FUNCTIONS END  *********************//

if (isset($_POST["submit_register"])) {
    ob_start();

    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $lastuserId = "";

    if (emptyInputSignup($name, $email, $pwd, $pwdRepeat) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    if (invalidname($name) !== false) {
        header("location: ../login.php?error=invalidname");
        exit();
    }
    if (invalidemail($email) !== false) {
        header("location: ../login.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../login.php?error=passwordsdontmatch");
        exit();
    }
    if (nameExists($conn, $name, $email) !== false) {
        header("location: ../login.php?error=usernametaken");
        exit();
    }
    $newUserId = generateUserId($LastId);
    createUser($conn, $name, $email, $pwd, $newUserId);

}

//******************   REGISTER AFTER SUBMIT FUNCTIONS END  *********************//

?>