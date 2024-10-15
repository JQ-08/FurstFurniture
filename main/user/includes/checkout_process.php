<?php
session_start();
include 'includes/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId']; // Get userId from POST data
    $name = $_SESSION['userName'];
    $email = $_SESSION['userEmail'];
    $number = $_SESSION['userNumber'];
    $address = $_SESSION['userAddress'];
    $method = $_POST['method'];
    $cartItems = json_decode($_SESSION['cartItems'], true); // Decode JSON string

    // Prepare SQL statement to insert order details
    $query = "INSERT INTO orders (userId, name, email, number, address, method) VALUES (:userId, :name, :email, :number, :address, :method)";
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':number', $number);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':method', $method);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Optionally insert each cart item into order items table here
        echo '<script>
            alert("Order placed successfully!");
            window.location.href = "order_confirmation.php";
        </script>';
    } else {
        echo '<script>
            alert("Failed to place order. Please try again.");
            window.location.href = "checkout.php";
        </script>';
    }
}
?>
