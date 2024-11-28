<?php
session_start();
include 'connect.php';

// Check if user is logged in
if (!isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];

// Get form data
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Prepare the SQL update query
try {
    if (!empty($password)) {
        // Update the password as plain text (not recommended for production)
        $updateQuery = $conn->prepare("UPDATE users SET usersName = :name, usersEmail = :email, usersPwd = :password WHERE userId = :userId");
        $updateQuery->bindParam(':password', $password, PDO::PARAM_STR);
    } else {
        // Don't update the password if it's empty
        $updateQuery = $conn->prepare("UPDATE users SET usersName = :name, usersEmail = :email WHERE userId = :userId");
    }

    $updateQuery->bindParam(':name', $name, PDO::PARAM_STR);
    $updateQuery->bindParam(':email', $email, PDO::PARAM_STR);
    $updateQuery->bindParam(':userId', $userId, PDO::PARAM_STR);

    $updateQuery->execute();

    echo "<script>alert('Profile updated successfully!'); window.location.href='../profile.php';</script>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
