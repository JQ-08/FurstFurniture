<?php
session_start();
include 'css/a.php';
include 'includes/connect.php';


if (isset($_SESSION['userId'])) {
   $userId = $_SESSION['userId'];
} else {
   $userId = null;
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


   <?php
   $select_wardrobes = $conn->prepare("SELECT * FROM products WHERE type = 'wardrobe'");
   $select_wardrobes->execute();
   echo "Wardrobes found: " . $select_wardrobes->rowCount();
   if ($select_wardrobes->rowCount() > 0 && $select_wardrobes->rowCount() < 4) {
      echo "<div class='wardrobe'>";
      echo "<div class='type_wardrobe'><h1>Wardrobe</h1></div>";
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
                  <a href="add_to_cart.php?product_id=<?= $wardrobe['id']; ?>&qty=1" class="card_button">Add To Cart</a>
               </div>
            </div>
         </div>
         <?php
      }
   } else if ($select_wardrobes->rowCount() >= 4) {
      echo "<div class='wardrobe_slider'>";
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
                     <a href="add_to_cart.php?product_id=<?= $wardrobe['id']; ?>&qty=1" class="card_button">Add To Cart</a>
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



   <script type="text/javascript">
      window.addEventListener('scroll', reveal);

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

      // Function to show the current set of cards and manage button visibility
      function showPage(page) {
         const start = page * cardsPerPage;
         const end = start + cardsPerPage;

         cards.forEach((card, index) => {
            if (index >= start && index < end) {
               card.style.display = 'flex'; // Show cards for current page
            } else {
               card.style.display = 'none'; // Hide other cards
            }
         });

         // Manage arrow visibility
         if (page === 0) {
            prevButton.style.display = 'none'; // Hide "prev" if on the first page
         } else {
            prevButton.style.display = 'block'; // Show "prev" otherwise
         }

         if (page === totalPages - 1) {
            nextButton.style.display = 'none'; // Hide "next" if on the last page
         } else {
            nextButton.style.display = 'block'; // Show "next" otherwise
         }
      }

      // Initial display
      showPage(currentPage);

      // Add event listeners to the buttons
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
   <?php
   include 'includes/footer.php';
   ?>