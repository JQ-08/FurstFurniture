<?php
session_start();
include 'connect.php'; // Ensure you have your database connection

if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['product_id'])) {
        $productId = $data['product_id'];
        
        // Prepare the SQL statement to remove the item from the cart
        $query = "DELETE FROM cart WHERE userId = :userId AND product_id = :product_id";
        $stmt = $conn->prepare($query);
        
        // Execute the statement
        if ($stmt->execute(['userId' => $userId, 'product_id' => $productId])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Product ID not provided']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
}
?>
