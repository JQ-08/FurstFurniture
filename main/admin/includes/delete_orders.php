<?php
include 'connect.php';  // Include database connection

// Fetch data from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Check if orderIds are provided
if (isset($data['orderIds']) && is_array($data['orderIds'])) {
    // Handle multiple deletions
    $orderIds = $data['orderIds'];
    $ids = implode(',', array_map('intval', $orderIds)); // Sanitize and create a string of IDs
    $stmt = $conn->prepare("DELETE FROM orders WHERE id IN ($ids)");

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    
} elseif (isset($data['orderId'])) {
    // Handle single deletion
    $orderId = intval($data['orderId']); // Sanitize the input
    $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");

    // Bind the orderId to the statement
    $stmt->bind_param('i', $orderId);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}

$stmt->close();
?>
