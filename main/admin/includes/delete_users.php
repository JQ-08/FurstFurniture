<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 'On');
    ini_set('error_log', '/path/to/php_errors.log');
    include 'connect.php';

    // Read input JSON
    $data = json_decode(file_get_contents('php://input'), true);
    $userIds = $data['userIds'];

    if (!is_array($userIds) || empty($userIds)) {
        echo json_encode(['success' => false, 'error' => 'No user IDs provided']);
        exit;
    }

    // Prepare placeholders for the query
    $placeholders = implode(',', array_fill(0, count($userIds), '?'));

    // Create a SQL statement to delete the selected users
    $query = "DELETE FROM users WHERE userId IN ($placeholders)";
    $stmt = $conn->prepare($query);

    // Execute the statement
    if ($stmt->execute($userIds)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to delete users']);
    }

    $stmt->close();
    $conn->close();
?>
