<?php
session_start();
include 'css/index_css.php';
include 'includes/connect.php';

if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
} else {
    $userId = null;
}
$success_msg = [];
$warning_msg = [];

if (isset($_POST['add_to_cart'])) {

    $id = create_unique_id();
    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);

    if ($userId !== null) {
        $verify_cart = $conn->prepare("SELECT * FROM cart WHERE userId = ? AND product_id = ?");
        $verify_cart->execute([$userId, $product_id]);

        $max_cart_items = $conn->prepare("SELECT * FROM cart WHERE userId = ?");
        $max_cart_items->execute([$userId]);

        if ($verify_cart->rowCount() > 0) {
            $warning_msg[] = 'Already added to cart!';
        } elseif ($max_cart_items->rowCount() == 10) {
            $warning_msg[] = 'Cart is full!';
        } else {

            $select_price = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

            $insert_cart = $conn->prepare("INSERT INTO cart(id, userId, product_id, price, qty) VALUES(?,?,?,?,?)");
            $insert_cart->execute([$id, $userId, $product_id, $fetch_price['price'], $qty]);
            $success_msg[] = 'Added to cart!';
        }
    } else {
        echo '<script>
       alert("You need to login your account!");
       window.location.href = "login.php";
       </script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../../images/furst_logo_circle.png" />
    <title>Fürst</title>

    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- Include SweetAlert JavaScript -->
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
    <div class="carousel">
        <div class="list">
            <div class="item">
                <img src="../../images/table_removebg.png">
                <div class="introduce">
                    <div class="title">NEW TABLE</div>
                    <div class="topic">TROTTEN</div>
                    <div class="des">
                        <!-- 20 lorem -->
                        Desk, beige/white, 120x70 cm
                    </div>
                    <button class="seeMore">SEE MORE &#8599</button>
                </div>
                <div class="detail">
                    <div class="title">TROTTEN</div>
                    <div class="des">
                        <!-- lorem 50 -->
                        Small desk that fits in every space – at your office or at home. The A shape of the legs is a
                        smart
                        design feature that allows you to use all the space under the desk for your office chair and
                        storage.
                    </div>
                    <div class="specifications">
                        <div>
                            <p>Depth</p>
                            <p>70 cm</p>
                        </div>
                        <div>
                            <p>Height</p>
                            <p>75 cm</p>
                        </div>
                        <div>
                            <p>Max. load</p>
                            <p>50 kg</p>
                        </div>
                        <div>
                            <p>Width</p>
                            <p>120 cm</p>
                        </div>
                    </div>
                    <div class="checkout">
                        <form action="index.php" method="POST">
                            <input type="hidden" name="product_id" value="756">
                            <input type="hidden" name="qty" value="1">
                            <button type="submit" name="add_to_cart">ADD TO CART</button>
                            <div class="arrow">
                                <button id="back1" type="button"><span
                                        class="material-symbols-outlined">keyboard_backspace</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="item">
                <img src="../../images/products/65986.png">
                <div class="introduce">
                    <div class="title">NEW CHAIR</div>
                    <div class="topic">GRUPPSPEL</div>
                    <div class="des">
                        <!-- 20 lorem -->
                        Gaming chair, Gunnared beige
                    </div>
                    <button class="seeMore">SEE MORE &#8599</button>
                </div>
                <div class="detail">
                    <div class="title">GRUPPSPEL</div>
                    <div class="des">
                        <!-- lorem 50 -->
                        The GRUPPSPEL chair is a modern, ergonomic seating solution designed for comfort and style in
                        both residential and commercial spaces. Featuring a sleek, minimalist design, it offers
                        customizable color options and sustainable materials. The chair is stackable for convenient
                        storage and built to support users up to 300 lbs, making it ideal for social and collaborative
                        environments.
                    </div>
                    <div class="specifications">
                        <div>
                            <p>Depth</p>
                            <p>64 cm</p>
                        </div>
                        <div>
                            <p>Height</p>
                            <p>124 cm</p>
                        </div>
                        <div>
                            <p>Width</p>
                            <p>160 cm</p>
                        </div>
                    </div>
                    <div class="checkout">
                        <form action="index.php" method="POST">
                            <input type="hidden" name="product_id" value="771">
                            <input type="hidden" name="qty" value="1">
                            <button type="submit" name="add_to_cart">ADD TO CART</button>
                            <div class="arrow">
                                <button id="back2" type="button"><span
                                        class="material-symbols-outlined">keyboard_backspace</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

                <div class="item">
                    <img src="../../images/wardrobe_removebg.png">
                    <div class="introduce">
                        <div class="title">NEW WARDROBE</div>
                        <div class="topic">PAX</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            Wardrobe, white, 175x58x201 cm
                        </div>
                        <button class="seeMore">SEE MORE &#8599</button>
                    </div>
                    <div class="detail">
                        <div class="title">PAX</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Keep it simple. Here's a basic solution to get you started, and space for more interiors if you want
                            to upgrade.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Width</p>
                                <p>175.0 cm</p>
                            </div>
                            <div>
                                <p>Depth</p>
                                <p>58.0 cm</p>
                            </div>
                            <div>
                                <p>Height</p>
                                <p>201.2 cm</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <form action="index.php" method="POST">
                                <input type="hidden" name="product_id" value="753">
                                <input type="hidden" name="qty" value="1">
                                <button type="submit" name="add_to_cart">ADD TO CART</button>
                                <div class="arrow">
                                    <button id="back3" type="button"><span class="material-symbols-outlined">keyboard_backspace</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="arrows">
                <button id="prev"><</button>
                <button id="next">></button>
            </div>
        </div>
        <footer class="footer">	
            <div class="copyright">
                <p>© Designed &amp; by Algorithm Avengers 2024</p>
            </div>
        </footer>
    </body>
</html>

<?php
if (isset($success_msg)) {
    foreach ($success_msg as $success_msg) {
        echo '<script>swal("' . $success_msg . '", "" ,"success");</script>';
    }
}

if (isset($warning_msg)) {
    foreach ($warning_msg as $warning_msg) {
        echo '<script>swal("' . $warning_msg . '", "" ,"warning");</script>';
    }
}
include 'js/index_js.php';
?>