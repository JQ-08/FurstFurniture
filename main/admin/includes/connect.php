<?php
    $serverName = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "shop_db";

    $conn = new mysqli($serverName, $dBUsername, $dBPassword, $dBName);

    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $lastuserid = "SELECT userId FROM users ORDER BY userId DESC LIMIT 1";
    $fetch_userid = mysqli_query($conn, $lastuserid);    
    $last_userId = mysqli_fetch_assoc($fetch_userid); 
    $LastId = $last_userId['userId'];
    if ($LastId == null){
        $LastId = "Z0000";
    }
?>