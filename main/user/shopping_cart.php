<?php
session_start();
include 'css/shopping_cart_css.php';
include 'includes/connect.php';

if (!isset($_SESSION['userId'])) {
    echo '<script>
       alert("You need to log in to your account!");
       window.location.href = "login.php";
   </script>';
    exit();
}

$userId = $_SESSION['userId'];

$success_msg = [];
$warning_msg = [];

// Query to get cart items for the logged-in user
$query = "SELECT c.product_id, c.qty, p.name, CONCAT(p.depth, ' x ', p.width, ' x ', p.height) AS volume, p.price, p.image1 
          FROM cart AS c 
          JOIN products AS p ON c.product_id = p.id 
          WHERE c.userId = :userId";

$stmt = $conn->prepare($query); // Use $conn instead of $pdo
$stmt->execute(['userId' => $userId]);

$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate total price
$totalPrice = 0;

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
                echo "<a href='profile.php'>Hi, " . $_SESSION["username"] . "</a>";
                echo "<a href='#' onclick=\"if(confirm('Are you sure you want to logout?')) { setTimeout(function(){ alert('You\'ve been logged out. Redirecting to home page...'); window.location.href='includes/logout.inc.php'; }, 1000); } else { event.preventDefault(); }\">Logout</a>";
            } else {
                echo "<a href='login.php'>Login</a>";
            }
            ?>
            <a href="shopping_cart.php"><span class="material-symbols-outlined" alt="cart icon">shopping_cart</span></a>
        </nav>
    </header>

    <div class="main">
        <div class="title">
            <h1 class="tittle">Shopping Cart</h1>
        </div>
        <div class="col col-1">
            <div class="item-qty">
                <p><?php echo count($cartItems); ?> items in total</p>
            </div>
            <div class="vertical-slider">
            <?php if (empty($cartItems)): ?>
                <div class="no-products">
                    <p>No products in your shopping cart.</p>
                </div>
            <?php else: ?>
                <?php foreach ($cartItems as $item): ?>
                    <div class="container">
                        <div class="product-img">
                            <img src="../../images/products/<?php echo $item['image1']; ?>" alt="#">
                        </div>
                        <div class="details">
                            <div class="item-name">
                                <a href="#"><?php echo $item['name']; ?></a>
                            </div>
                            <br>
                            <div class="volume">
                                <?php echo $item['volume']; ?>
                            </div>
                            <br>
                            <div class="price-per-unit">
                                Price per unit: RM <?php echo number_format($item['price'], 2); ?>
                            </div>
                            <br>
                            <div class="item-qty">
                                <div class="counter">
                                    <button class="minus" data-product-id="<?php echo $item['product_id']; ?>">
                                        <svg width="12" height="4" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <defs>
                                                <path
                                                    d="M11.357 3.332A.641.641 0 0 0 12 2.69V.643A.641.641 0 0 0 11.357 0H.643A.641.641 0 0 0 0 .643v2.046c0 .357.287.643.643.643h10.714Z"
                                                    id="a" />
                                            </defs>
                                            <use fill="black" fill-rule="nonzero" xlink:href="#a" />
                                        </svg>
                                    </button>
                                    <input class="count" type="number" id="quantity-<?php echo $item['product_id']; ?>"
                                        value="<?php echo $item['qty']; ?>" min="1" />
                                    <button class="plus" data-product-id="<?php echo $item['product_id']; ?>">
                                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <defs>
                                                <path
                                                    d="M12 7.023V4.977a.641.641 0 0 0-.643-.643h-3.69V.643A.641.641 0 0 0 7.022 0H4.977a.641.641 0 0 0-.643.643v3.69H.643A.641.641 0 0 0 0 4.978v2.046c0 .356.287.643.643.643h3.69v3.691c0 .356.288.643.644.643h2.046a.641.641 0 0 0 .643-.643v-3.69h3.691A.641.641 0 0 0 12 7.022Z"
                                                    id="b" />
                                            </defs>
                                            <use fill="black" fill-rule="nonzero" xlink:href="#b" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="rmv-item" data-product-id="<?php echo $item['product_id']; ?>">
                                    <span>Remove Item</span>
                                </div>
                            </div>
                        </div>
                        <div class="total-price">
                            <span class="total-price">
                                Total Price: RM <?php echo number_format($item['price'] * $item['qty'], 2); ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        </div>
        <div class="col col-2">
            <div class="title-summary">
                <h2>Cart Summary</h2>
            </div>
            <div class="summary">
                <div class="product">
                    <span>Products(<?php echo count($cartItems); ?>)</span>
                    <div class="products">
                        <?php foreach ($cartItems as $item): ?>
                            <span><?php echo $item['name']; ?> x <?php echo $item['qty']; ?></span><br>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="price-summary">
                    <span>Price</span>
                    <span>RM <?php
                    foreach ($cartItems as $item) {
                        $totalPrice += $item['price'] * $item['qty'];
                    }
                    echo number_format($totalPrice, 2);
                    ?></span>
                </div>
                <div class="delivery">
                    <span>Delivery fees</span>
                    <span>Free</span>
                </div>
                <div class="subtotal">
                    <span class="subtotal-t">Total</span>
                    <span class="subtotal-p">RM <?php echo number_format($totalPrice, 2); ?></span>
                </div>
            </div>
            <form action="checkout.php">
                <div class="btn-checkout">
                    <button class="checkout"><a href="checkout.php">Checkout</a></button>
                </div>
            </form>
            <div class="payment-method">
                <img src="../../images/visa.png" alt="Visa">
                <img src="../../images/master_card.jpg" alt="Master Card">
            </div>
        </div>
    </div>
</body>
<footer class="footer">
    <div class="copyright">
        <p>© Designed by Algorithm Avengers 2024</p>
    </div>
</footer>

</html>

<script>
    document.querySelector('.vertical-slider').addEventListener('wheel', (event) => {
        event.preventDefault();

        const slider = event.currentTarget;
        const scrollAmount = event.deltaY * 3; // Adjust the scroll speed by multiplying deltaY

        slider.scrollBy({
            top: scrollAmount,
            behavior: 'smooth'
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateQuantity = (productId, quantity) => {
            fetch('./includes/update_qty.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ product_id: productId, qty: quantity })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`quantity-${productId}`).value = quantity;
                        alert("Product Quantity in Cart Updated!");
                        window.location.href = "shopping_cart.php";

                    } else {
                        alert('Error updating quantity');
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        };

        const handleInputChange = (event) => {
            const productId = event.target.id.split('-')[1];
            const qty = parseInt(event.target.value);
            if (qty >= 1) {
                updateQuantity(productId, qty);
            }
        };

        document.querySelectorAll('.minus').forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-product-id');
                const quantityInput = document.getElementById(`quantity-${productId}`);
                let qty = parseInt(quantityInput.value);
                if (qty > 1) {
                    qty--;
                    quantityInput.value = qty;
                    updateQuantity(productId, qty);
                }
            });
        });

        document.querySelectorAll('.plus').forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-product-id');
                const quantityInput = document.getElementById(`quantity-${productId}`);
                let qty = parseInt(quantityInput.value);
                qty++;
                quantityInput.value = qty;
                updateQuantity(productId, qty);
            });
        });

        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('change', handleInputChange);
        });

        const removeItem = (productId) => {
            fetch('./includes/remove_item.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ product_id: productId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Item removed from cart!");
                        window.location.href = "shopping_cart.php"; // Refresh the cart page
                    } else {
                        alert('Error removing item: ' + data.message);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        };

        // Add event listener for the "Remove Item" button
        document.querySelectorAll('.rmv-item').forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-product-id');
                if (confirm('Are you sure you want to remove this item?')) {
                    removeItem(productId);
                }
            });
        });
    });


</script>