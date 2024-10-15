<?php
session_start();
include 'connect.php'; // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$product_id = $data['product_id'];
$qty = $data['qty'];
$userId = $_SESSION['userId']; // Retrieve userId from session

// Update the quantity in the database
$query = "UPDATE cart SET qty = :qty WHERE product_id = :product_id AND userId = :userId";
$stmt = $conn->prepare($query);
$stmt->execute(['qty' => $qty, 'product_id' => $product_id, 'userId' => $userId]);

if ($stmt->rowCount() > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
