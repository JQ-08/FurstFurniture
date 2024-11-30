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
                    echo "<a href='profile.php'>Hi, " . $_SESSION["username"] . "</a>";
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
                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#000000">
                    <path d="M560-440h200v-80H560v80Zm0-120h200v-80H560v80ZM200-320h320v-22q0-45-44-71.5T360-440q-72 0-116 26.5T200-342v22Zm160-160q33 0 56.5-23.5T440-560q0-33-23.5-56.5T360-640q-33 0-56.5 23.5T280-560q0 33 23.5 56.5T360-480ZM160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm0-80h640v-480H160v480Zm0 0v-480 480Z"/>
                </svg>                
                <p><?php echo $userId; ?></p>
            </div>
            <div class="email">
                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#000000">
                    <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/>
                </svg>
                <p><?php echo $user['usersEmail']; ?></p>
            </div>
            <div class="pwd">
                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#000000">
                    <path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z"/>
                </svg>                
                <p><?php echo $user['usersPwd']; ?></p>
            </div>
            <div class="edit">
                <button type='submit' name='editprofile'>Edit Profile</button>
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

