<?php
include 'connect.php'; 

function create_unique_id() {
    $characters = '0123456789Z';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 5; $i++) {
        $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//******************   ADDPRODUCT FUNCTIONS START  *********************//

if (isset($_POST['addproductbtn'])) {
    // Retrieve form data
    $productsName = $_POST["name"];
    $productsDesc = $_POST["description"];
    $productsPrice = $_POST["price"];
    $productsType = $_POST["type"];
    $productsDepth = $_POST["depth"];
    $productsWidth = $_POST["width"];
    $productsHeight = $_POST["height"];

    // Handle Image uploads
    $imageFiles = ['image1', 'image2', 'image3', 'image4'];
    $renamedImages = [];
    $targetDir = __DIR__ . '/../../../images/product/';

    // Create the target directory if it does not exist
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    foreach ($imageFiles as $index => $imageFile) {
        $productsImage = $_FILES[$imageFile]['name'];
        $productsImage = filter_var($productsImage, FILTER_SANITIZE_STRING);
        $ext = pathinfo($productsImage, PATHINFO_EXTENSION);
        $rename = create_unique_id() . '.' . $ext;
        $image_tmp_name = $_FILES[$imageFile]['tmp_name'];
        $targetFile = $targetDir . $rename;

        // Check file size limits
        if ($_FILES[$imageFile]['size'] > 2000000) {
            $warning_msg[] = 'One or more image files are too large!';
            exit;
        }

        // Move uploaded file
        if (move_uploaded_file($image_tmp_name, $targetFile)) {
            $renamedImages[] = $rename;
        } else {
            echo "Failed to move image " . ($index + 1) . " to: $targetFile";
            exit;
        }
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO products (name, price, type, image1, image2, image3, image4, height, width, depth, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sdsssssssss', $productsName, $productsPrice, $productsType, $renamedImages[0], $renamedImages[1], $renamedImages[2], $renamedImages[3], $productsHeight, $productsWidth, $productsDepth, $productsDesc);

    // Execute the query
    if ($stmt->execute()) {
        echo '<script>alert("Product Added."); window.location.href = "../products_admin.php";</script>';
    } else {
        echo '<script>alert("Error: ' . $conn->error . '");</script>';
    }

    $stmt->close();
}

//******************   ADDPRODUCT FUNCTIONS END  *********************//

//******************   EDITPRODUCT FUNCTIONS START  *********************//

if (isset($_POST['editproductbtn'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['name'];
    $productDesc = $_POST['description'];
    $productPrice = $_POST['price'];
    $productType = $_POST['type'];
    $productDepth = $_POST['depth'];
    $productWidth = $_POST['width'];
    $productHeight = $_POST['height'];

    // Fetch current image names
    $stmt = $conn->prepare("SELECT image1, image2, image3, image4 FROM products WHERE id = ?");
    $stmt->bind_param('s', $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentImages = $result->fetch_assoc();
    $stmt->close();

    // Define the target directory relative to this script's location
    $targetDir = __DIR__ . '/../../../images/product/';

    // Create the target directory if it does not exist
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Handle image upload
    $imageFields = ['image1', 'image2', 'image3', 'image4'];
    $imageNames = [];

    foreach ($imageFields as $field) {
        if ($_FILES[$field]['name']) {
            $image = $_FILES[$field]['name'];
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            $rename = create_unique_id() . '.' . $ext;
            $targetFile = $targetDir . $rename;

            // Move uploaded file
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $targetFile)) {
                $imageNames[$field] = $rename;
            } else {
                echo "Failed to move $field";
                exit;
            }
        } else {
            // Use current image if no new image uploaded
            $imageNames[$field] = $currentImages[$field];
        }
    }

    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, type = ?, image1 = ?, image2 = ?, image3 = ?, image4 = ?, height = ?, width = ?, depth = ?, description = ? WHERE id = ?");
    $stmt->bind_param('ssssssssssss', $productName, $productPrice, $productType, $imageNames['image1'], $imageNames['image2'], $imageNames['image3'], $imageNames['image4'], $productHeight, $productWidth, $productDepth, $productDesc, $productId);

    if ($stmt->execute()) {
        echo '<script>alert("Product Updated."); window.location.href = "../products_admin.php";</script>';
    } else {
        echo '<script>alert("Error: ' . $conn->error . '");</script>';
    }

    $stmt->close();
}

// Close the database connection only once at the end
$conn->close();


//******************   EDITPRODUCT FUNCTIONS END  *********************//

//******************   ORDERS_STATUS_ADMIN FUNCTIONS START  *********************//
include 'connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderId']) && isset($_POST['status'])) {
    $orderId = filter_var($_POST['orderId'], FILTER_VALIDATE_INT);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

    // Log the received data for debugging
    error_log("Received orderId: $orderId, status: $status");

    $response = ['success' => false];

    if ($orderId !== false && !empty($status)) {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("si", $status, $orderId);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Order status successfully updated.';
            } else {
                error_log('Update failed: ' . $stmt->error); // Log the error
                $response['error'] = 'Failed to execute query: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            $response['error'] = 'Failed to prepare statement: ' . $conn->error;
        }
    } else {
        $response['error'] = 'Invalid orderId or status.';
    }

    // Close the database connection after all operations
    $conn->close();

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
} else {
    $response = ['success' => false, 'error' => 'Invalid request method or missing parameters'];
    echo json_encode($response);
    exit();
}


//******************   ORDERS_STATUS_ADMIN FUNCTIONS END  *********************//
?>
