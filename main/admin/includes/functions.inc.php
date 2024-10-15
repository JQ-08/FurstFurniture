<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');
include 'connect.php';

function generateUserId($LastId)
{
    $numericPart = intval(substr($LastId, 1));

    $nextNumericPart = $numericPart + 1;

    $newUserId = "Z" . str_pad($nextNumericPart, 4, "0", STR_PAD_LEFT);

    return $newUserId;
}
$newUserId = generateUserId($LastId);
function createUser($conn, $name, $email, $pwd, $newUserId)
{

    $sql = "INSERT INTO users (usersName, usersEmail, usersPwd, userId) VALUES (?, ?, ?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user_admin.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $pwd, $newUserId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_close($stmt);
    if ($result) {
        echo '<script>
        alert("User Added!");
        window.location.href = "../user_admin.php?error=none";
        </script>';
    }
    exit();
}

function nameExists($conn, $name, $email)
{
    $sql = "SELECT * FROM users WHERE usersEmail = ? OR usersEmail= ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user_admin.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function invalidemail($email)
{
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

if (isset($_POST['registerbtn'])) {
    $usersName = $_POST["usersName"];
    $usersEmail = $_POST["usersEmail"];
    $usersPwd = $_POST["usersPwd"];
    $usersConfirmPassword = $_POST["usersConfirmPassword"];
    $lastuserId = "";

    if ($usersPwd !== $usersConfirmPassword) {
        echo '<script>alert("Passwords do not match!"); window.location.href = "../user_admin.php?error=none";</script>';
        exit;
    }

    if (nameExists($conn, $usersName, $usersEmail) !== false) {
        echo '<script>
        alert("Email Already Taken. Please Try Another one.");
        window.location.href = "../user_admin.php?error=emailexist";
        </script>';
        exit();
    }
    if (invalidemail($usersEmail) !== false) {
        echo '<script>
        alert("Email Invalid. Please Try Another one.");
        window.location.href = "../user_admin.php?error=wrongemail";
        </script>';
        exit();
    }

    createUser($conn, $usersName, $usersEmail, $usersPwd, $newUserId);
}

if (isset($_POST['updateUserBtn'])) {
    $userId = $_POST['editUserId'];
    $usersName = $_POST['editUsersName'];
    $usersEmail = $_POST['editUsersEmail'];
    $usersPwd = $_POST['editUsersPwd'];
    $usersConfirmPassword = $_POST['editUsersConfirmPassword'];

    if ($usersPwd !== $usersConfirmPassword) {
        echo '<script>alert("Passwords do not match!"); window.location.href = "../user_admin.php";</script>';
        exit;
    }

    $stmt = $conn->prepare("UPDATE users SET usersName=?, usersEmail=?, usersPwd=? WHERE userId=?");

    if ($stmt) {
        $stmt->bind_param('ssss', $usersName, $usersEmail, $usersPwd, $userId);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo '<script>
                alert("User Updated!");
                window.location.href = "../user_admin.php";
                </script>';
            exit;
        } else {
            echo '<script>
                alert("No changes made or update failed.");
                window.location.href = "../user_admin.php?error=update_failed";
                </script>';
            exit;
        }

        $stmt->close();
    } else {
        echo '<script>
            alert("Failed to prepare the SQL statement.");
            window.location.href = "../user_admin.php?error=sql_error";
            </script>';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    $sql = "DELETE FROM users WHERE userId = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $userId);

        if ($stmt->execute()) {
            $message = 'User successfully deleted.';
        } else {
            $message = 'Error deleting user: ' . $conn->error;
        }

        $stmt->close();
    } else {
        $message = 'Error preparing statement: ' . $conn->error;
    }

    $conn->close();

    echo $message;
    exit();
}

//**************** USER: PAGINATION ****************//

function fetchUserData($page = 1, $recordsPerPage = 10)
{
    global $conn;

    $offset = ($page - 1) * $recordsPerPage;

    $sql = "SELECT COUNT(*) as total FROM users";
    $result = $conn->query($sql);
    $totalRecords = $result->fetch_assoc()['total'];

    $sql = "SELECT * FROM users LIMIT ? OFFSET ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ii", $recordsPerPage, $offset);

        // Debugging: Log the query and parameters
        error_log("Executing query: $sql with LIMIT $recordsPerPage and OFFSET $offset");

        $stmt->execute();
        $result = $stmt->get_result();

        $records = [];
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }

        $stmt->close();
    }

    return [
        'showingRecords' => count($records),
        'totalRecords' => $totalRecords,
        'data' => $records,
    ];
}

function deleteRecords($ids)
{
    global $conn;

    $response = ['success' => false];

    if (!is_array($ids) || empty($ids)) {
        return $response;
    }

    $ids = array_map([$conn, 'real_escape_string'], $ids);
    $idsList = "'" . implode("','", $ids) . "'";
    $sql = "DELETE FROM users WHERE userId IN ($idsList)";

    if ($conn->query($sql) === TRUE) {
        $response['success'] = true;
    }

    $conn->close();
    return $response;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    echo json_encode(deleteRecords($data['ids'] ?? []));
    exit();
}

if (isset($_POST['addproductbtn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $depth = mysqli_real_escape_string($conn, $_POST['depth']);
    $width = mysqli_real_escape_string($conn, $_POST['width']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);

    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];
    $image4 = $_FILES['image4']['name'];

    $target_dir = "../../images/products/";

    if (!is_dir($target_dir) || !is_writable($target_dir)) {
        echo json_encode(["success" => false, "message" => "The target directory is either not a directory or not writable."]);
        exit();
    }

    $uploads = [
        'image1' => $image1,
        'image2' => $image2,
        'image3' => $image3,
        'image4' => $image4,
    ];

    foreach ($uploads as $key => $filename) {
        if ($_FILES[$key]['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(["success" => false, "message" => "Error uploading $key"]);
            exit();
        }

        if (!move_uploaded_file($_FILES[$key]['tmp_name'], $target_dir . basename($filename))) {
            echo json_encode(["success" => false, "message" => "Error moving $key"]);
            exit();
        }
    }

    $sql = "INSERT INTO products (name, description, price, type, image1, image2, image3, image4, depth, width, height) 
            VALUES ('$name', '$description', '$price', '$type', '$image1', '$image2', '$image3', '$image4', '$depth', '$width', '$height')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin/products_admin.php?success=ProductAdded");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        error_log("MySQL error: " . mysqli_error($conn));
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderId']) && isset($_POST['status'])) {
    $orderId = $_POST['orderId'];
    $status = $_POST['status'];

    // Simple debugging to check the received data
    error_log("Received orderId: $orderId, status: $status");

    $response = ['success' => false];

    // Prepare and execute the SQL statement
    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $status, $orderId);  // Assuming orderId is an integer (change 'i' to 's' if it's a string)

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Order status successfully updated.';
        } else {
            $response['error'] = 'Failed to update order: ' . $conn->error;
        }

        $stmt->close();
    } else {
        $response['error'] = 'Failed to prepare statement: ' . $conn->error;
    }

    $conn->close();

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}



?>