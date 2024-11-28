<?php
session_start();
include 'includes/connect.php';
include 'css/view_order_css.php';

if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
} else {
    $userId = null;
}

// Fetch order ID from URL
if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    header('location: orders.php');
    exit;
}

// Fetch order details
$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ? LIMIT 1");
$select_orders->execute([$get_id]);

// Initialize variables
$grand_total = 0;
$order_details = [];

if ($select_orders->rowCount() > 0) {
    $fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC);
    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
    $select_product->execute([$fetch_order['product_id']]);

    if ($select_product->rowCount() > 0) {
        $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);
        $sub_total = ($fetch_order['price'] * $fetch_order['qty']);
        $grand_total += $sub_total;

        // Store order details for display
        $order_details = [
            'id' => $fetch_order['id'],
            'date' => $fetch_order['date'],
            'image' => "../../images/products/" . $fetch_product['image1'],
            'product_name' => $fetch_product['name'],
            'price' => $fetch_order['price'],
            'qty' => $fetch_order['qty'],
            'grand_total' => $grand_total,
            'name' => $fetch_order['name'],
            'number' => $fetch_order['number'],
            'email' => $fetch_order['email'],
            'address' => $fetch_order['address'],
            'status' => $fetch_order['status']
        ];
    }
}

if (isset($_POST['cancel'])) {
    $update_orders = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
    $update_orders->execute(['canceled', $get_id]);

    echo '<script>
                alert("Your order has been canceled. You will receive a full refund of your purchase shortly.");
                window.location.href = "orders.php";
            </script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../../images/furst_logo_circle.png" />
    <title>Fürst</title>

    <!-- Alert Messages -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <!-- Google Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    
<header>
    <a href='./index.php'>
        <div class="logo">
            <img src="../../images/furst.png" alt="Logo">
        </div>
    </a>
    <nav>
        <a href="view_products.php">Products</a>
        <a href="orders.php">Orders</a>
        <?php
            if (isset($_SESSION["username"])) {
                echo "<a href='profile.php'>" . $_SESSION["username"] . "</a>";
                echo "<a href='#' onclick=\"if(confirm('Are you sure you want to logout?')) { setTimeout(function(){ alert('You\'ve been logged out. Redirecting to home page...'); window.location.href='includes/logout.inc.php'; }, 1000); } else { event.preventDefault(); }\">Logout</a>";
            } else {
                echo "<a href='login.php'>Login</a>";
            }
            ?>
            <a href="shopping_cart.php"><span class="material-symbols-outlined" alt="cart icon">shopping_cart</span></a>
        </nav>
    </header>

<div class="main">
    <div class="back-btn">
        <a href="orders.php"><span class="material-symbols-outlined">chevron_left</span></a>
    </div>
    <div class="title">
        <h1 class="tittle">Order Details</h1>
        <div class="tags">
            <p class="order-id">Order ID: #<?= htmlspecialchars($order_details['id'] ?? 'Unknown'); ?></p>
            <p class="status <?= htmlspecialchars(str_replace(' ', '_', $order_details['status'] ?? 'unknown')); ?>">
                Status: <?= htmlspecialchars($order_details['status'] ?? 'Unknown'); ?>
            </p>      
            <?php if ($fetch_order['status'] != 'canceled' && $fetch_order['status'] != 'completed') { ?>
                <form action="" method="POST" style="display: inline;">
                    <input type="submit" value="Cancel Order" name="cancel" class="cancel-order" onclick="return confirm('Cancel this Order?');" >
                </form>
            <?php } else { ?>
                <a href="orderagain.php?get_id=<?= $fetch_product['id']; ?>&qty=<?= $fetch_order['qty']; ?>" class="order-again">Order Again</a>
            <?php } ?>
        </div>
    </div>

        <div class="content">
            <div class="content-left">
                <div class="receipt">
                    <div class="product-img">
                        <img src="<?= htmlspecialchars($order_details['image'] ?? '../../images/default.png'); ?>"
                            alt="product-img">
                    </div>
                    <div class="title-summary">
                        <h2>Order Receipt</h2>
                    </div>
                    <div class="summary">
                        <div class="product">
                            <span>Products x <?= htmlspecialchars($order_details['qty'] ?? 0); ?></span>
                            <div class="products">
                                <span><?= htmlspecialchars($order_details['product_name'] ?? 'Product not found'); ?></span><br>
                            </div>
                        </div>
                        <div class="price-summary">
                            <span>Price</span>
                            <span>RM
                                <?= number_format(htmlspecialchars($order_details['price'] ?? '0.00'), 2); ?></span>
                        </div>
                        <div class="delivery">
                            <span>Delivery fees</span>
                            <span>Free</span>
                        </div>
                        <div class="subtotal">
                            <span class="subtotal-t">Total</span>
                            <span class="subtotal-p">RM
                                <?= number_format(htmlspecialchars($order_details['grand_total'] ?? '0.00'), 2); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-right">
                <div class="progress-bar">
                    <ul>
                        <li>
                            <div class="progress one">
                                <span class="material-symbols-outlined">order_approve</span>
                            </div>
                            <p class="text">Order Placed</p>
                        </li>
                        <li>
                            <div class="progress two">
                                <span class="material-symbols-outlined">local_shipping</span>
                            </div>
                            <p class="text">Order Processing</p>
                        </li>
                        <li>
                            <div class="progress three">
                                <span class="material-symbols-outlined">star</span>
                            </div>
                            <p class="text">Order Completed</p>
                        </li>
                    </ul>
                </div>
                <div class="delivery-address">
                    <h2 class="delivery-title">Delivery Address</h2>
                    <div class="info-line">
                        <p class="label">Name:</p>
                        <p class="value"><?= htmlspecialchars($order_details['name'] ?? 'Unknown'); ?></p>
                    </div>
                    <div class="info-line">
                        <p class="label">Phone Number:</p>
                        <p class="value"><?= htmlspecialchars($order_details['number'] ?? 'Unknown'); ?></p>
                    </div>
                    <div class="info-line">
                        <p class="label">Email:</p>
                        <p class="value"><?= htmlspecialchars($order_details['email'] ?? 'Unknown'); ?></p>
                    </div>
                    <div class="info-line">
                        <p class="label">Address:</p>
                        <p class="value">
                            <?= nl2br(htmlspecialchars($order_details['address'] ?? 'Unknown')); ?>
                        </p>
                    </div>
                    <div class="info-line">
                        <p class="label">Order Placed Date:</p>
                        <p class="value">
                            <?php
                            $dateString = $order_details['date'] ?? 'Unknown';
                            $date = new DateTime($dateString);
                            $formattedDate = $date ? $date->format('d F Y') : 'Unknown';
                            ?>
                            <?= htmlspecialchars(string: $formattedDate); ?>
                        </p>
                    </div>
                    <div class="info-line">
                        <p class="label">Estimated Arrival Date:</p>
                        <p class="value">
                            <?php
                            if ($date) {
                                $estimatedArrivalDate = clone $date;
                                $estimatedArrivalDate->modify('+14 days');
                                $formattedEstimatedArrivalDate = $estimatedArrivalDate->format('d F Y');
                            } else {
                                $formattedEstimatedArrivalDate = 'Unknown';
                            }
                            ?>
                            <?= htmlspecialchars($formattedEstimatedArrivalDate); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="copyright">
            <p>© Designed by Algorithm Avengers 2024</p>
        </div>
</footer>
</body>

</html>

<script>
    const orderStatus = '<?php echo $order_details['status']; ?>';

    const one = document.querySelector(".one");
    const two = document.querySelector(".two");
    const three = document.querySelector(".three");

    if (orderStatus === 'in progress') {
        one.classList.add("active");
        two.classList.add("active");
    } else if (orderStatus === 'completed') {
        one.classList.add("active");
        two.classList.add("active");
        three.classList.add("active");
    } else if (orderStatus === 'canceled') {
        one.classList.add("active");
        two.classList.add("active");
        three.classList.add("active");

        one.classList.add("canceled");
        two.classList.add("canceled");
        three.classList.add("canceled");
    }
</script>