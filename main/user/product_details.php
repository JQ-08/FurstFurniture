<?php
session_start();
include 'includes/connect.php';
include 'css/product_details_css.php';
include 'includes/functions.inc.php';

if (isset($_SESSION['userId'])) {
  $userId = $_SESSION['userId'];
} else {
  $userId = null;
}

if (isset($_GET['product_id'])) {
  $product_id = intval($_GET['product_id']);
  $product = getProductDetails($conn, $product_id);

  if (!$product) {
    die('Product not found.');
  }
} else if (isset($_POST['product_id'])) {
  // echo "Product ID: " . htmlspecialchars($_POST['product_id']);
  $product_id = intval($_POST['product_id']);
  $product = getProductDetails($conn, $product_id);

} else {
  die('No product ID specified.');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="32x32" href="../../images/furst_logo_circle.png" />
  <title>Fürst</title>

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
  <div class="back-btn">
    <a href="view_products.php"><span class="material-symbols-outlined">chevron_left</span></a>
  </div>
  <div class="main">
    <div class="col col-1">
      <div class="default gallery">
        <?php
        $image1 = htmlspecialchars($product['image1'] ?? '');
        $image2 = htmlspecialchars($product['image2'] ?? '');
        $image3 = htmlspecialchars($product['image3'] ?? '');
        $image4 = htmlspecialchars($product['image4'] ?? '');
        ?>
        <div class="main-img">
          <img class="active" src="../../images/products/<?php echo $image1; ?>" alt="product-img" />
          <img src="../../images/products/<?php echo $image2; ?>" alt="product-img" />
          <img src="../../images/products/<?php echo $image3; ?>" alt="product-img" />
          <img src="../../images/products/<?php echo $image4; ?>" alt="product-img" />
        </div>

        <div class="thumb-list">
          <div class="active">
            <img src="../../images/products/<?php echo $image1; ?>" alt="product-img" />
          </div>
          <div>
            <img src="../../images/products/<?php echo $image2; ?>" alt="product-img" />
          </div>
          <div>
            <img src="../../images/products/<?php echo $image3; ?>" alt="product-img" />
          </div>
          <div>
            <img src="../../images/products/<?php echo $image4; ?>" alt="product-img" />
          </div>
        </div>
      </div>
    </div>
    <div class="lightbox">
      <div class="gallery">
        <div class="main-img">
          <!-- icons -->
          <span class="icon-close">
            <svg width="14" height="15" xmlns="http://www.w3.org/2000/svg">
              <path
                d="m11.596.782 2.122 2.122L9.12 7.499l4.597 4.597-2.122 2.122L7 9.62l-4.595 4.597-2.122-2.122L4.878 7.5.282 2.904 2.404.782l4.595 4.596L11.596.782Z"
                fill="#69707D" fill-rule="evenodd" />
            </svg>
          </span>
          <span class="icon-prev">
            <svg width="12" height="18" xmlns="http://www.w3.org/2000/svg">
              <path d="M11 1 3 9l8 8" stroke="#1D2026" stroke-width="3" fill="none" fill-rule="evenodd" />
            </svg>
          </span>
          <span class="icon-next">
            <svg width="13" height="18" xmlns="http://www.w3.org/2000/svg">
              <path d="m2 1 8 8-8 8" stroke="#1D2026" stroke-width="3" fill="none" fill-rule="evenodd" />
            </svg>
          </span>

          <!-- main images -->
          <img class="active" src="../../images/products/<?php echo $image1; ?>" alt="product-img" />
          <img src="../../images/products/<?php echo $image2; ?>" alt="product-img" />
          <img src="../../images/products/<?php echo $image3; ?>" alt="product-img" />
          <img src="../../images/products/<?php echo $image4; ?>" alt="product-img" />
        </div>
        <div class="thumb-list">
          <div class="active">
            <img src="../../images/products/<?php echo $image1; ?>" alt="product-img" />
          </div>
          <div>
            <img src="../../images/products/<?php echo $image2; ?>" alt="product-img" />
          </div>
          <div>
            <img src="../../images/products/<?php echo $image3; ?>" alt="product-img" />
          </div>
          <div>
            <img src="../../images/products/<?php echo $image4; ?>" alt="product-img" />
          </div>
        </div>
      </div>
    </div>

    <div class="col col-2">
      <div class="content">
        <h3><?php echo htmlspecialchars(strtoupper($product['type'] ?? 'N/A')); ?></h3>
        <h2 class="product-name">
          <?php echo htmlspecialchars($product['name'] ?? 'No Name'); ?>
        </h2>
        <p class="product-desc">
          <?php echo htmlspecialchars($product['description'] ?? 'No Description Available'); ?>
        </p>
        <div class="specifications">
          <div>
            <p>Depth</p>
            <p><?php echo htmlspecialchars($product['depth'] ?? 'N/A'); ?></p>
          </div>
          <div>
            <p>Width</p>
            <p><?php echo htmlspecialchars($product['width'] ?? 'N/A'); ?></p>
          </div>
          <div>
            <p>Height</p>
            <p><?php echo htmlspecialchars($product['height'] ?? 'N/A'); ?></p>
          </div>
        </div>
        <div class="price-info">
          <div class="price">
            <span class="current-price">RM <?php echo htmlspecialchars($product['price'] ?? '0.00'); ?></span>
          </div>
        </div>
        <div class="add-to-cart-container">
          <div class="counter">
            <button class="minus">
              <svg width="12" height="4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                  <path
                    d="M11.357 3.332A.641.641 0 0 0 12 2.69V.643A.641.641 0 0 0 11.357 0H.643A.641.641 0 0 0 0 .643v2.046c0 .357.287.643.643.643h10.714Z"
                    id="a" />
                </defs>
                <use fill="black" fill-rule="nonzero" xlink:href="#a" />
              </svg>
            </button>
            <span class="count">1</span>
            <button class="plus">
              <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                  <path
                    d="M12 7.023V4.977a.641.641 0 0 0-.643-.643h-3.69V.643A.641.641 0 0 0 7.022 0H4.977a.641.641 0 0 0-.643.643v3.69H.643A.641.641 0 0 0 0 4.978v2.046c0 .356.287.643.643.643h3.69v3.691c0 .356.288.643.644.643h2.046a.641.641 0 0 0 .643-.643v-3.69h3.691A.641.641 0 0 0 12 7.022Z"
                    id="b" />
                </defs>
                <use fill="black" fill-rule="nonzero" xlink:href="#b" />
              </svg>
            </button>
          </div>

          <form action="product_details.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
            <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price'] ?? ''); ?>">
            <input type="hidden" name="qty" value="1" id="qty-input">
            <button type="submit" name="add_to_cart" class="add-to-cart">
              <span>
                <svg width="22" height="20" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M20.925 3.641H3.863L3.61.816A.896.896 0 0 0 2.717 0H.897a.896.896 0 1 0 0 1.792h1l1.031 11.483c.073.828.52 1.726 1.291 2.336C2.83 17.385 4.099 20 6.359 20c1.875 0 3.197-1.87 2.554-3.642h4.905c-.642 1.77.677 3.642 2.555 3.642a2.72 2.72 0 0 0 2.717-2.717 2.72 2.72 0 0 0-2.717-2.717H6.365c-.681 0-1.274-.41-1.53-1.009l14.321-.842a.896.896 0 0 0 .817-.677l1.821-7.283a.897.897 0 0 0-.87-1.114ZM6.358 18.208a.926.926 0 0 1 0-1.85.926.926 0 0 1 0 1.85Zm10.015 0a.926.926 0 0 1 0-1.85.926.926 0 0 1 0 1.85Zm2.021-7.243-13.8.81-.57-6.341h15.753l-1.383 5.53Z"
                    fill="#69707D" fill-rule="nonzero" />
                </svg>
              </span>
              <span style="color: black;">Add to cart</span>
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="copyright">
      <p>© Designed by Algorithm Avengers
        2024</p>
    </div>

    <?php
    include 'js/product_details_js.php';
    ?>