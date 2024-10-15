<?php
include 'connect.php';

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Prepare a SQL statement to delete the product
    $sql = "DELETE FROM products WHERE id = ?";

    // Initialize a prepared statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the product ID to the statement
        $stmt->bind_param("i", $productId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Product deleted successfully!";
        } else {
            echo "Error deleting product: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    echo "No product ID provided!";
}
