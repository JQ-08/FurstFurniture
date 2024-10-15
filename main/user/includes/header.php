<?php
session_start();
include 'css/style.php';
include 'js/index_js.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" sizes="32x32" href="../../images/logo_index.png" />
  <title>Fürst</title>

  <!-- Google Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
  <div class="container">
    <header>
      <nav class="navbar">
        <section class="nav-first">
          <a href='./index.php'>
            <div class="logo">
              <img src="../../images/logo_new.png" alt="logo" />
            </div>
          </a>
          <div class="nav-links">
            <a href="view_products.php">Products</a>
            <a href="#">About Us</a>

            <?php
            if (isset($_SESSION["username"])) {
              echo "<a href='#' onclick=\"if(confirm('Are you sure you want to logout?')) { setTimeout(function(){ alert('You\'ve been logged out. Redirecting to home page...'); window.location.href='includes/logout.inc.php'; }, 1000); } else { event.preventDefault(); }\">Logout</a>";
            } else {
              echo "<a href='login.php'>Login</a>";
            }
            ?>
          </div>
        </section>
        <section class="nav-second">
          <!-- <div class="search">
            <link rel="stylesheet"
              href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <form action="">
              <input type="search" placeholder="Search here ...">
              <i class="fa fa-search"></i>
            </form>
          </div> -->
          <div class="cart">
            <a href="shopping_cart.php">
              <span class="material-symbols-outlined" alt="cart icon">shopping_cart</span>
            </a>
          </div>
        </section>
      </nav>
    </header>