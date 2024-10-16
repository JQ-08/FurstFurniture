<?php
include 'includes/connect.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'css/style.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');

var_dump($_GET);
$productId = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
echo "Product ID: " . $productId;

if ($productId <= 0) {
    echo "Invalid product ID";
    exit;
}

$sql = "SELECT id, name, description, price, type, image1, image2, image3, image4, depth, width, height 
            FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    $productId = $product['id'];
    $productName = htmlspecialchars($product['name']);
    $productDescription = htmlspecialchars($product['description']);
    $productPrice = number_format($product['price'], 2);
    $productType = htmlspecialchars($product['type']);
    $productImage1 = htmlspecialchars($product['image1']);
    $productImage2 = htmlspecialchars($product['image2']);
    $productImage3 = htmlspecialchars($product['image3']);
    $productImage4 = htmlspecialchars($product['image4']);
    $productDepth = htmlspecialchars($product['depth']);
    $productWidth = htmlspecialchars($product['width']);
    $productHeight = htmlspecialchars($product['height']);
} else {
    echo "Product not found";
    exit;
}
?>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <!-- Back Button Start -->
        <div class="d-flex justify-content-start mb-3">
            <a href="products_admin.php" class="btn btn-primary d-sm-inline-block d-none">
                <i class="fa fa-arrow-left"></i> Back to Products
            </a>
        </div>
        <!-- Back Button End -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-6 col-xxl-5">
                                <!-- Tab panes -->
                                <div class="tab-content" id="myTabContent">
                                    <?php if (!empty($productImage1)): ?>
                                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                            aria-labelledby="home-tab" tabindex="0">
                                            <img class="img-fluid" src="../../images/products/<?php echo $productImage1; ?>"
                                                alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($productImage2)): ?>
                                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                            aria-labelledby="profile-tab" tabindex="0">
                                            <img class="img-fluid" src="../../images/products/<?php echo $productImage2; ?>"
                                                alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($productImage3)): ?>
                                        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel"
                                            aria-labelledby="contact-tab" tabindex="0">
                                            <img class="img-fluid" src="../../images/products/<?php echo $productImage3; ?>"
                                                alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($productImage4)): ?>
                                        <div class="tab-pane fade" id="end-tab-pane" role="tabpanel"
                                            aria-labelledby="end-tab" tabindex="0">
                                            <img class="img-fluid" src="../../images/products/<?php echo $productImage4; ?>"
                                                alt="">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <ul class="nav nav-tabs slide-item-list mt-3" id="myTab" role="tablist">
                                    <?php if (!empty($productImage1)): ?>
                                        <li class="nav-item" role="presentation">
                                            <a href="#home-tab-pane" class="nav-link active" id="home-tab"
                                                data-bs-toggle="tab" role="tab" aria-controls="home-tab-pane"
                                                aria-selected="true">
                                                <img class="img-fluid me-2"
                                                    src="../../images/products/<?php echo $productImage1; ?>" alt=""
                                                    width="80">
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (!empty($productImage2)): ?>
                                        <li class="nav-item" role="presentation">
                                            <a href="#profile-tab-pane" class="nav-link" id="profile-tab"
                                                data-bs-toggle="tab" role="tab" aria-controls="profile-tab-pane"
                                                aria-selected="false">
                                                <img class="img-fluid me-2"
                                                    src="../../images/products/<?php echo $productImage2; ?>" alt=""
                                                    width="80">
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (!empty($productImage3)): ?>
                                        <li class="nav-item" role="presentation">
                                            <a href="#contact-tab-pane" class="nav-link" id="contact-tab"
                                                data-bs-toggle="tab" role="tab" aria-controls="contact-tab-pane"
                                                aria-selected="false">
                                                <img class="img-fluid me-2"
                                                    src="../../images/products/<?php echo $productImage3; ?>" alt=""
                                                    width="80">
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (!empty($productImage4)): ?>
                                        <li class="nav-item" role="presentation">
                                            <a href="#end-tab-pane" class="nav-link" id="end-tab" data-bs-toggle="tab"
                                                role="tab" aria-controls="end-tab-pane" aria-selected="false">
                                                <img class="img-fluid"
                                                    src="../../images/products/<?php echo $productImage4; ?>" alt=""
                                                    width="80">
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <!--Tab slider End-->
                            <div class="col-xl-9 col-lg-6 col-md-6 col-xxl-7 col-sm-12">
                                <div class="product-detail-content">
                                    <!--Product details-->
                                    <div class="new-arrival-content pr mt-md-0 mt-3">
                                        <h4><?php echo $productName; ?></h4>
                                        <div class="d-table mb-2">
                                            <p class="price float-start d-block">RM <?php echo $productPrice; ?></p>
                                        </div>
                                        <p class="product-para">Product ID: <span
                                                class="item"><?php echo $productId; ?></span></p>
                                        <p class="product-para">Type: <span
                                                class="item"><?php echo $productType; ?></span></p>
                                        <p class="product-para">Depth: <span
                                                class="item"><?php echo $productDepth; ?></span></p>
                                        <p class="product-para">Width: <span
                                                class="item"><?php echo $productWidth; ?></span></p>
                                        <p class="product-para">Height: <span
                                                class="item"><?php echo $productHeight; ?></span></p>
                                        <p class="text-content"><?php echo nl2br($productDescription); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
            Content body end
        ***********************************-->

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>
