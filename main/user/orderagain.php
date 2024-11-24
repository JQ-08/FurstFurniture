<?php
session_start();
include 'css/checkout_css.php';
include 'includes/connect.php';

$product_id = $_GET['get_id'] ?? null; // or use a defined value
$qty = $_GET['qty'] ?? 1; // or use a defined value

if (!isset($_SESSION['userId'])) {
    echo '<script>
       alert("You need to log in to your account!");
       window.location.href = "login.php";
   </script>';
    exit();
}

$userId = $_SESSION['userId'];

if (isset($_GET['back_to_billing'])) {
    unset($_SESSION['address_step']); // Reset to billing details step
}


if ($userId !== null) {
    if (isset($_POST['continue'])) {
        $_SESSION['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $_SESSION['number'] = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
        $_SESSION['email'] = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $_SESSION['address_step'] = true;
    }

    if (isset($_POST['place_order'])) {
        $address = filter_var($_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code'], FILTER_SANITIZE_STRING);
        $method = filter_var($_POST['method'], FILTER_SANITIZE_STRING);

        // Check if email is valid
        if (!filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)) {
            echo '<script>
            alert("Please enter a valid email address.");
            window.location.href = "orderagain.php?get_id=' . $product_id . '&qty=' . $qty . '";
            </script>';
            exit();
        }

        // Verify cart existence
        $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE userId = ?");
        $verify_cart->execute([$userId]);

        // Check if a single product ID is being purchased
        if (isset($_GET['get_id'])) {
            $get_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
            $get_product->execute([$_GET['get_id']]);

            if ($get_product->rowCount() > 0) {
                $fetch_p = $get_product->fetch(PDO::FETCH_ASSOC);
                $insert_order = $conn->prepare("INSERT INTO `orders`(userId, name, number, email, address, method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?)");
                $insert_order->execute([$userId, $_SESSION['name'], $_SESSION['number'], $_SESSION['email'], $address, $method, $fetch_p['id'], $fetch_p['price'], $qty]);


                echo '<script>
                alert("Order Successful!");
                window.location.href = "orders.php";
                </script>';
                exit();
            } else {
                $warning_msg[] = 'Product not found!';
            }

        } elseif ($verify_cart->rowCount() > 0) {
            while ($f_cart = $verify_cart->fetch(PDO::FETCH_ASSOC)) {
                $insert_order = $conn->prepare("INSERT INTO `orders`(userId, name, number, email, address, method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?)");
                $insert_order->execute([$userId, $_SESSION['name'], $_SESSION['number'], $_SESSION['email'], $address, $method, $f_cart['product_id'], $f_cart['price'], $f_cart['qty']]);
            }

            // Clear cart after placing order
            $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE userId = ?");
            $delete_cart_id->execute([$userId]);
            
            echo '<script>
                alert("Order Successful!");
                window.location.href = "orders.php";
                </script>';
            exit();

        } else {
            $warning_msg[] = 'Your cart is empty!';
        }
    }
} else {
    echo '<script>
   alert("You need to log in to your account!");
   window.location.href = "login.php";
   </script>';
}

$grand_total = 0;

if (isset($_GET['get_id']) && isset($_GET['qty'])) {
    $product_id = $_GET['get_id'];  // Change this line
    $qty = $_GET['qty'];
    // Fetch product details
    $get_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
    $get_product->execute([$product_id]);

    if ($get_product->rowCount() > 0) {
        $fetch_p = $get_product->fetch(PDO::FETCH_ASSOC);
        $sub_total = ($qty * $fetch_p['price']);
        $grand_total += $sub_total;
        $cart_items[] = [
            'name' => htmlspecialchars($fetch_p['name']),
            'image' => $fetch_p['image1'],
            'price' => number_format($fetch_p['price'], 2),
            'qty' => $qty
        ];
    }
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../../images/furst_logo_circle.png" />
    <title>Checkout</title>

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
                echo "<a href='#' onclick=\"if(confirm('Are you sure you want to logout?')) { setTimeout(function(){ alert('You\'ve been logged out. Redirecting to home page...'); window.location.href='includes/logout.inc.php'; }, 1000); } else { event.preventDefault(); }\">Logout</a>";
            } else {
                echo "<a href='login.php'>Login</a>";
            }
            ?>
            <a href="shopping_cart.php"><span class="material-symbols-outlined" alt="cart icon">shopping_cart</span></a>
        </nav>
    </header>

    <div class="main">
        <h1 class="heading">Checkout</h1>

        <div class="row">
            <form action="" method="POST">
                <?php if (!isset($_SESSION['address_step'])): ?>
                    <h3 class="title">Billing Details</h3>
                    <div class="flex">
                        <div class="box">
                            <p>Name</p>
                            <input type="text" name="name" required maxlength="50" placeholder="Enter your name"
                                class="input">
                            <p>Phone Number</p>
                            <input type="number" name="number" required maxlength="10" placeholder="Enter your phone number"
                                class="input" min="0" max="9999999999">
                            <p>Email</p>
                            <input type="email" name="email" required maxlength="50" placeholder="Enter your email"
                                class="input">
                        </div>
                    </div>
                    <input type="submit" value="Continue" name="continue" class="continue-btn">
                    <a href="shopping_cart.php" class="continue-btn" style="margin-top: 10px; text-decoration: none;">Back to Shopping Cart</a>
                <?php else: ?>
                    <h3 class="title">Shipping Details</h3>
                    <div class="flex">
                        <div class="box">
                            <p>Delivery Address</p>
                            <input type="text" name="flat" required placeholder="Flat/House No." class="address">
                            <input type="text" name="street" required placeholder="Street" class="address">
                            <input type="text" name="city" required placeholder="City" class="address">
                            <input type="text" name="country" required placeholder="Country" class="address">
                            <p>Postal Code</p>
                            <input type="text" name="pin_code" required placeholder="Postal Code" class="address">
                            <p>Payment Method</p>
                            <select name="method" class="input" required>
                                <option value="credit card">Credit Card</option>
                                <option value="cash on delivery">Cash on Delivery</option>
                            </select>
                        </div>
                    </div>
                    <a href="orderagain.php?back_to_billing=true&get_id=<?= $product_id ?>&qty=<?= $qty ?>" class="back-btn">Back to Billing Details</a>
                    <input type="submit" value="Place Order" name="place_order" class="place-order-btn">
                <?php endif; ?>
            </form>

            <div class="summary">
                <h3 class="title">Cart Items</h3>
                <?php if (!empty($cart_items)): ?>
                    <?php foreach ($cart_items as $item): ?>
                        <div class="flex cart-item">
                            <img src="../../images/products/<?= $item['image']; ?>" class="image" alt="">
                            <div>
                                <h3 class="name"><?= $item['name']; ?></h3>
                                <p class="price">RM <?= $item['price']; ?> x <?= $item['qty']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="empty">Your Cart is Empty.</p>
                <?php endif; ?>
                <div class="grand-total">
                    <p>Grand Total :</p>
                    <p>RM <?= number_format($grand_total, 2); ?></p>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="copyright">
            <p>© Designed &amp; by Algorithm Avengers 2024</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</body>

</html>

<?php
include 'includes/functions.inc.php';
?>
