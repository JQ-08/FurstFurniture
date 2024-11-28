<?php
session_start();
include 'css/profile_css.php';
include 'includes/connect.php';

// Check if userId is in the session
if (!isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$userId = $_SESSION['userId']; // e.g., Z0002

try {
    // Use a parameterized query with userId treated as a string
    $profile = $conn->prepare("SELECT usersName, usersEmail, usersPwd FROM users WHERE userId = :userId");
    $profile->bindParam(':userId', $userId, PDO::PARAM_STR);
    $profile->execute();

    $user = $profile->fetch(PDO::FETCH_ASSOC);

    // Check if user exists
    if (!$user) {
        echo "Error: No user found with userId = $userId.";
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
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
        <!-- SweetAlert 2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert 2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div class="profile">
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
    
    <div class="content">
        <div class="title">
            <p>User Profile</p>
            <img src="../../images/profile1.png" alt="User image">
        </div>
        <div class="details">
            <div class="name">
                <p><?php echo $user['usersName']; ?></p>
            </div>
            <div class="id">
                <span>User Id :</span>
                <p><?php echo $userId; ?></p>
            </div>
            <div class="email">
                <span>User Email :</span>
                <p><?php echo $user['usersEmail']; ?></p>
            </div>
            <div class="pwd">
                <span>User Password :</span>
                <p><?php echo $user['usersPwd']; ?></p>
            </div>
            <div class="edit">
                <button type='submit' name='editprofile'>Edit Profile</button>
            </div>
        </div>
    </div>

</div>

</body>
</html>

<script>
    document.querySelector('.edit button').addEventListener('click', function() {
        // Create a form template as a string
        const formHtml = `
            <form id="editProfileForm" action="includes/update_profile.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['usersName']); ?>" required><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['usersEmail']); ?>" required><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Leave blank to keep current password"><br>
            </form>
        `;

        // Show SweetAlert with the form inside
        Swal.fire({
            title: 'Edit Profile',
            html: formHtml,
            showCancelButton: true,
            confirmButtonText: 'Update',
            preConfirm: () => {
                // Form will be submitted by the SweetAlert confirmation button
                document.getElementById('editProfileForm').submit();
            }
        });
    });
</script>

