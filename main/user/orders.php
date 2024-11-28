<?php
session_start();
include 'includes/connect.php';
include 'css/orders_css.php';

if (!isset($_SESSION['userId'])) {
    echo '<script>
       alert("You need to log in to your account!");
       window.location.href = "login.php";
   </script>';
    exit();
}

$userId = $_SESSION['userId'];

// Get all orders to display on page load
$query = "SELECT * FROM `orders` WHERE userId = ? ORDER BY date DESC";
$select_orders = $conn->prepare($query);
$select_orders->execute([$userId]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../../images/furst_logo_circle.png" />
    <title>Fürst - Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        /* Your CSS styles will be included here */
    </style>
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

<section class="orders">
    <h1 class="heading">My Orders</h1>
    
    <div class="order-filter">
        <button onclick="filterOrders('all', event)" class="active">All</button>
        <button onclick="filterOrders('completed', event)">Completed</button>
        <button onclick="filterOrders('in progress', event)">In Progress</button>
        <button onclick="filterOrders('canceled', event)">Canceled</button> <!-- Corrected button text -->
    </div>

        <div class="box-container" id="order-container">
            <?php
            if ($select_orders->rowCount() > 0) {
                while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                    $select_product->execute([$fetch_order['product_id']]);

                    if ($select_product->rowCount() > 0) {
                        while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="box" <?php if ($fetch_order['status'] == 'canceled') {
                                echo 'style="border:.2rem solid red";';
                            } ?>>
                                <a href="view_order.php?get_id=<?= $fetch_order['id']; ?>">
                                    <p class="date"><i class="fa fa-calendar"></i><span><?= $fetch_order['date']; ?></span></p>
                                    <img src="../../images/products/<?= $fetch_product['image1']; ?>" class="image" alt="">
                                    <h3 class="name"><?= $fetch_product['name']; ?></h3>
                                    <p class="price">RM <?= $fetch_order['price']; ?> x <?= $fetch_order['qty']; ?></p>
                                    <p class="status" style="color:<?php if ($fetch_order['status'] == 'completed') {
                                        echo 'green';
                                    } elseif ($fetch_order['status'] == 'canceled') {
                                        echo 'red';
                                    } else {
                                        echo 'orange';
                                    } ?>">
                                        <?= $fetch_order['status']; ?>
                                    </p>
                                </a>
                            </div>
                            <?php
                        }
                    }
                }
            } else {
                echo '<p class="empty">No Orders Found!</p>';
            }
            ?>
        </div>
    </section>

<script>
    function filterOrders(status, event) {
        console.log("Filtering orders for status: " + status); // Debug log
        const buttons = document.querySelectorAll('.order-filter button');
        buttons.forEach(button => button.classList.remove('active'));
        event.target.classList.add('active'); // Highlight selected button

        // Using AJAX to fetch orders
        const xhr = new XMLHttpRequest();
        xhr.open('GET', './includes/fetch_orders.php?status=' + status, true);
        xhr.onload = function () {
            if (this.status == 200) {
                document.getElementById('order-container').innerHTML = this.responseText;
            } else {
                document.getElementById('order-container').innerHTML = '<p class="empty">Error loading orders!</p>';
            }
        };
        xhr.send();
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<footer class="footer">
        <div class="copyright">
            <p>© Designed by Algorithm Avengers 2024</p>
        </div>
</footer>
</body>
</html>

<?php
include 'includes/functions.inc.php';
?>
