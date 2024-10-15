<?php

$db_name = 'mysql:host=localhost;dbname=shop_db';
$db_user_name = 'root';
$db_user_pass = '';

try {
    $conn = new PDO($db_name, $db_user_name, $db_user_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (!function_exists('create_unique_id')) {
    function create_unique_id() {
        $characters = '0123456789Z';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $lastuserid = "SELECT userId FROM users ORDER BY userId DESC LIMIT 1";
    $stmt = $conn->query($lastuserid);
    $last_userId = $stmt->fetch(PDO::FETCH_ASSOC); 

    $LastId = $last_userId['userId'] ?? "Z0000";
}

?>
