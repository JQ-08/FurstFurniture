<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "shop_db";

$conn = new mysqli($serverName, $dBUsername, $dBPassword, $dBName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$lastuserid = "SELECT userId FROM users ORDER BY userId DESC LIMIT 1";
$fetch_userid = mysqli_query($conn, $lastuserid);

if ($fetch_userid) {
    $last_userId = mysqli_fetch_assoc($fetch_userid);
    $LastId = $last_userId['userId'] ?? "Z0000";
} else {
    $LastId = "Z0000"; 
}


?>
