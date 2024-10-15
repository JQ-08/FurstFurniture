<?php

// Fetch total number of orders
$query = "SELECT COUNT(*) AS total FROM users";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $totalUsers = $row['total'];
} else {
    echo "Error: " . $conn->error;
}

$statuses = ['completed', 'in progress'];
$statusCounts = [];

foreach ($statuses as $status) {
    $query = $conn->prepare("SELECT COUNT(*) AS total FROM orders WHERE status = ?");
    $query->bind_param('s', $status);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();
    $statusCounts[$status] = (int)$row['total'];
}

// Query to get orders with pagination
$recordsPerPage = 10;
$query = "SELECT COUNT(*) AS total FROM orders";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$totalRecords = (int)$row['total'];

$totalPgs = ceil($totalRecords / $recordsPerPage);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, min($page, $totalPgs));
$offset = ($page - 1) * $recordsPerPage;

$query = "
    SELECT o.id, o.userId, o.date, o.number, o.address, o.method, o.product_id, o.status, o.price, o.qty 
    FROM orders o
    JOIN products p ON o.product_id = p.id
    LIMIT $recordsPerPage OFFSET $offset
";
$orders = $conn->query($query);

if (!$orders) {
    die("Query failed: " . $conn->error);
}

function getStatusClass($status)
{
    switch ($status) {
        case 'completed':
            return 'badge badge-success';
        case 'in progress':
            return 'badge badge-primary';
        default:
            return 'badge badge-secondary';
    }
}

while ($row = $orders->fetch_assoc()) {
    static $first = true;
    if ($first) {
        echo $row['id'];
        $first = false;
    }
}

$query = "SELECT COUNT(*) AS total FROM products"; // Adjust table name if necessary
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row) { // Check if $row is not null
        $totalProducts = $row['total'];
    } else {
        echo "No data found for Products.";
    }
} else {
    echo "Error: " . $conn->error;
}

$query = "SELECT SUM(price) AS total FROM orders";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $totalEarnings = (float)$row['total'];
    echo "Total Earnings: " . $totalEarnings;
} else {
    echo "Error: " . $conn->error;
}

$query = "SELECT SUM(price) AS total FROM orders WHERE date >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $totalEarningsCurrent = (float)$row['total'];
    echo "Total Earnings Current: " .$totalEarningsCurrent;
} else {
    echo "Error: " . $conn->error;
}

// Fetch total earnings for the previous period
$query = "SELECT SUM(price) AS total FROM orders WHERE date >= DATE_SUB(NOW(), INTERVAL 2 WEEK) AND date < DATE_SUB(NOW(), INTERVAL 1 WEEK)";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $totalEarningsPrevious = (float)$row['total'];
    echo "Total Earnings Previous: " .$totalEarningsPrevious;
} else {
    echo "Error: " . $conn->error;
}

?>