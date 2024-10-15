<?php
session_start();
include 'css/view_product_css.php';
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

   <?php
   $select_wardrobes = $conn->prepare("SELECT * FROM products WHERE type = 'wardrobe'");
   $select_wardrobes->execute();
   if ($select_wardrobes->rowCount() > 0 && $select_wardrobes->rowCount() < 4) {
      echo "<div class='wardrobe'>";
      echo "<div class='type_wardrobe'><h1>Wardrobe</h1></div>";
      while ($wardrobe = $select_wardrobes->fetch(PDO::FETCH_ASSOC)) {
         ?>
         <div class="card">
            <img src="../../images/products/<?= $wardrobe['image1']; ?>" alt="#" class="card_img">

            <div class="card_data">
               <h1 class="card_title"><?= $wardrobe['name']; ?></h1>
               <span class="card_price">RM <?= number_format($wardrobe['price'], 0, '.', ','); ?></span>
               <p class="card_description"><?= $wardrobe['description']; ?></p>
               <div class="button_container">
                  <a href="product_details.php?product_id=<?= $wardrobe['id']; ?>" class="card_button">View More</a>
                  <form action="view_products.php" method="POST">
                     <input type="hidden" name="product_id" value=<?= $wardrobe['id']; ?>>
                     <input type="hidden" name="qty" value="1">
                     <button type="submit" name="add_to_cart" class="submit">Add To Cart</button>
                  </form>
               </div>
            </div>
         </div>
         <?php
      }
   } else if ($select_wardrobes->rowCount() >= 4) {
      echo "<div class='wardrobe'>";
      echo "<div class='type_wardrobe'><h1>Wardrobe</h1></div>";
      echo "<div class='wrapper'>";
      echo "<div class='prev'>";
      echo "<span class='slider-button material-symbols-outlined'>chevron_left</span>";
      echo "</div>";
      while ($wardrobe = $select_wardrobes->fetch(PDO::FETCH_ASSOC)) {
         ?>
            <div class="card">
               <img src="../../images/products/<?= $wardrobe['image1']; ?>" alt="#" class="card_img">

               <div class="card_data">
                  <h1 class="card_title"><?= $wardrobe['name']; ?></h1>
                  <span class="card_price">RM <?= $wardrobe['price']; ?></span>
                  <p class="card_description"><?= $wardrobe['description']; ?></p>
                  <div class="button_container">
                     <a href="product_details.php?product_id=<?= $wardrobe['id']; ?>" class="card_button">View More</a>
                     <form action="view_products.php" method="POST">
                        <input type="hidden" name="product_id" value=<?= $wardrobe['id']; ?>>
                        <input type="hidden" name="qty" value="1">
                        <button type="submit" name="add_to_cart" class="submit">Add To Cart</button>
                     </form>
                  </div>
               </div>
            </div>
         <?php
      }
      echo "<div class='next'><span class='slider-button material-symbols-outlined'>chevron_right</span></div>";
      echo "</div>";
   } else {
      echo '<p class="empty">No wardrobes found!</p>';
   }
   ?>
   </div>

   <!-------------------------------------------------------- CHAIR SECTION ------------------------------------------------------------------->
   <?php
   $select_chairs = $conn->prepare("SELECT * FROM products WHERE type = 'chair'");
   $select_chairs->execute();
   if ($select_chairs->rowCount() > 0 && $select_chairs->rowCount() < 4) {
      echo "<div class='chair reveal'>";
      echo "<div class='type_chair'><h1>Chair</h1></div>";
      while ($chair = $select_chairs->fetch(PDO::FETCH_ASSOC)) {
         ?>
   <div class="card_chair">
      <img src="../../images/products/<?= $chair['image1']; ?>" alt="#" class="card_img">

      <div class="card_data">
         <h1 class="card_title">
            <?= $chair['name']; ?>
         </h1>
         <span class="card_price">RM
            <?= $chair['price']; ?>
         </span>
         <p class="card_description">
            <?= $chair['description']; ?>
         </p>
         <div class="button_container">
            <a href="product_details.php?product_id=<?= $chair['id']; ?>" class="card_button">View More</a>
            <form action="view_products.php" method="POST">
               <input type="hidden" name="product_id" value=<?= $chair['id']; ?>>
               <input type="hidden" name="qty" value="1">
               <button type="submit" name="add_to_cart" class="submit">Add To Cart</button>
            </form>
         </div>
      </div>
   </div>
   <?php
      }
   } else if ($select_chairs->rowCount() >= 4) {
      echo "<div class='chair_slider reveal'>";
      echo "<div class='type_chair'><h1>Chair</h1></div>";
      echo "<div class='wrapper_chair'>";
      echo "<div class='prev2'>";
      echo "<span class='slider-button material-symbols-outlined'>chevron_left</span>";
      echo "</div>";
      while ($chair = $select_chairs->fetch(PDO::FETCH_ASSOC)) {
         ?>
   <div class="card_chair">
      <img src="../../images/products/<?= $chair['image1']; ?>" alt="#" class="card_img">

      <div class="card_data">
         <h1 class="card_title">
            <?= $chair['name']; ?>
         </h1>
         <span class="card_price">RM
            <?= $chair['price']; ?>
         </span>
         <p class="card_description">
            <?= $chair['description']; ?>
         </p>
         <div class="button_container">
            <a href="product_details.php?product_id=<?= $chair['id']; ?>" class="card_button">View More</a>
            <form action="view_products.php" method="POST">
               <input type="hidden" name="product_id" value=<?= $chair['id']; ?>>
               <input type="hidden" name="qty" value="1">
               <button type="submit" name="add_to_cart" class="submit">Add To Cart</button>
            </form>
         </div>
      </div>
   </div>
   <?php
      }
      echo "<div class='next2'><span class='slider-button material-symbols-outlined'>chevron_right</span></div>";
      echo "</div>";
   } else {
      echo '<p class="empty">No chairs found!</p>';
   }
   ?>
   </div>
   <!-------------------------------------------------------- TABLE SECTION ------------------------------------------------------------------->
   <?php
   $select_tables = $conn->prepare("SELECT * FROM products WHERE type = 'table'");
   $select_tables->execute();
   if ($select_tables->rowCount() > 0 && $select_tables->rowCount() < 4) {
      echo "<div class='table reveal'>";
      echo "<div class='type_table'><h1>Table</h1></div>";
      while ($table = $select_tables->fetch(PDO::FETCH_ASSOC)) {
         ?>
   <div class="card_table">
      <img src="../../images/products/<?= $table['image1']; ?>" alt="#" class="card_img">

      <div class="card_data">
         <h1 class="card_title">
            <?= $table['name']; ?>
         </h1>
         <span class="card_price">RM
            <?= $table['price']; ?>
         </span>
         <p class="card_description">
            <?= $table['description']; ?>
         </p>
         <div class="button_container">
            <a href="product_details.php?product_id=<?= $table['id']; ?>" class="card_button">View More</a>
            <form action="view_products.php" method="POST">
               <input type="hidden" name="product_id" value=<?= $table['id']; ?>>
               <input type="hidden" name="qty" value="1">
               <button type="submit" name="add_to_cart" class="submit">Add To Cart</button>
            </form>
         </div>
      </div>
   </div>
   <?php
      }
   } else if ($select_tables->rowCount() >= 4) {
      echo "<div class='table_slider reveal'>";
      echo "<div class='type_table'><h1>Table</h1></div>";
      echo "<div class='wrapper_table'>";
      echo "<div class='prev3'>";
      echo "<span class='slider-button material-symbols-outlined'>chevron_left</span>";
      echo "</div>";
      while ($table = $select_tables->fetch(PDO::FETCH_ASSOC)) {
         ?>
   <div class="card_table">
      <img src="../../images/products/<?= $table['image1']; ?>" alt="#" class="card_img">

      <div class="card_data">
         <h1 class="card_title">
            <?= $table['name']; ?>
         </h1>
         <span class="card_price">RM
            <?= $table['price']; ?>
         </span>
         <p class="card_description">
            <?= $table['description']; ?>
         </p>
         <div class="button_container">
            <a href="product_details.php?product_id=<?= $table['id']; ?>" class="card_button">View More</a>
            <form action="view_products.php" method="POST">
               <input type="hidden" name="product_id" value=<?= $table['id']; ?>>
               <input type="hidden" name="qty" value="1">
               <button type="submit" name="add_to_cart" class="submit">Add To Cart</button>
            </form>
         </div>
         </div>
      </div>
<?php
   }
   echo "<div class='next3'><span class='slider-button material-symbols-outlined'>chevron_right</span></div>";
   echo "</div>";
} else {
   echo '<p class="empty">No tables found!</p>';
}
?>
</div>
<footer class="footer">	
   <div class="copyright">
      <p>© Designed by Algorithm Avengers 2024</p>
   </div>
</footer>
</body>
</html>
<script type="text/javascript">
window.addEventListener('scroll',reveal);

      function reveal() {
         var reveals = document.querySelectorAll('.reveal');

         for (var i = 0; i < reveals.length; i++) {

            var windowheight = window.innerHeight;
            var revealtop = reveals[i].getBoundingClientRect().top;
            var revealpoint = 100;

            if (revealtop < windowheight - revealpoint) {
               reveals[i].classList.add('active');
            }
            else {
               reveals[i].classList.remove('active');
            }
         }
      }
   </script>

   <script>
      const wrapper = document.querySelector('.wrapper');
      const cards = document.querySelectorAll('.card');
      const prevButton = document.querySelector('.prev span');
      const nextButton = document.querySelector('.next span');
      let currentPage = 0;
      const cardsPerPage = 3;
      const totalPages = Math.ceil(cards.length / cardsPerPage);

      function showPage(page) {
         const start = page * cardsPerPage;
         const end = start + cardsPerPage;

         cards.forEach((card, index) => {
            if (index >= start && index < end) {
               card.style.display = 'flex';
            } else {
               card.style.display = 'none';
            }
         });

         if (page === 0) {
            prevButton.style.display = 'none';
         } else {
            prevButton.style.display = 'block';
         }

         if (page === totalPages - 1) {
            nextButton.style.display = 'none';
         } else {
            nextButton.style.display = 'block';
         }
      }

      showPage(currentPage);

      nextButton.addEventListener('click', () => {
         if (currentPage < totalPages - 1) {
            currentPage++;
            showPage(currentPage);
         }
      });

      prevButton.addEventListener('click', () => {
         if (currentPage > 0) {
            currentPage--;
            showPage(currentPage);
         }
      });

   </script>

   <script>
      const wrapperChair = document.querySelector('.wrapper_chair');
      const cardsChair = document.querySelectorAll('.card_chair');
      const prevChairButton = document.querySelector('.prev2 span');
      const nextChairButton = document.querySelector('.next2 span');
      let currentChairPage = 0;
      const chairsPerPage = 3;
      const totalChairPages = Math.ceil(cardsChair.length / chairsPerPage);

      function showChairPage(page) {
         const start = page * chairsPerPage;
         const end = start + chairsPerPage;

         cardsChair.forEach((card, index) => {
            if (index >= start && index < end) {
               card.style.display = 'flex';
            } else {
               card.style.display = 'none';
            }
         });

         if (page === 0) {
            prevChairButton.style.display = 'none';
         } else {
            prevChairButton.style.display = 'block';
         }

         if (page === totalChairPages - 1) {
            nextChairButton.style.display = 'none';
         } else {
            nextChairButton.style.display = 'block';
         }
      }

      showChairPage(currentChairPage);

      nextChairButton.addEventListener('click', () => {
         if (currentChairPage < totalChairPages - 1) {
            currentChairPage++;
            showChairPage(currentChairPage);
         }
      });

      prevChairButton.addEventListener('click', () => {
         if (currentChairPage > 0) {
            currentChairPage--;
            showChairPage(currentChairPage);
         }
      });
   </script>
   <script>
      const wrapperTable = document.querySelector('.wrapper_table');
      const cardsTable = document.querySelectorAll('.card_table');
      const prevTableButton = document.querySelector('.prev3 span');
      const nextTableButton = document.querySelector('.next3 span');
      let currentTablePage = 0;
      const tablesPerPage = 3;
      const totalTablePages = Math.ceil(cardsTable.length / tablesPerPage);

      function showTablePage(page) {
         const start = page * tablesPerPage;
         const end = start + tablesPerPage;

         cardsTable.forEach((card, index) => {
            if (index >= start && index < end) {
               card.style.display = 'flex';
            } else {
               card.style.display = 'none';
            }
         });

         if (page === 0) {
            prevTableButton.style.display = 'none';
         } else {
            prevTableButton.style.display = 'block';
         }

         if (page === totalTablePages - 1) {
            nextTableButton.style.display = 'none';
         } else {
            nextTableButton.style.display = 'block';
         }
      }

      showTablePage(currentTablePage);

      nextTableButton.addEventListener('click', () => {
         if (currentTablePage < totalTablePages - 1) {
            currentTablePage++;
            showTablePage(currentTablePage);
         }
      });

      prevTableButton.addEventListener('click', () => {
         if (currentTablePage > 0) {
            currentTablePage--;
            showTablePage(currentTablePage);
         }
      });
   </script>

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
   ?>