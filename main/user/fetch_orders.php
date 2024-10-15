<?php
session_start();
include 'includes/connect.php';

if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

    $query = "SELECT * FROM `orders` WHERE userId = ?";
    if ($status_filter == 'completed') {
        $query .= " AND status = 'completed'";
    } elseif ($status_filter == 'in_progress') {
        $query .= " AND status != 'completed' AND status != 'canceled'";
    }
    $query .= " ORDER BY date DESC";

    $select_orders = $conn->prepare($query);
    $select_orders->execute([$userId]);

    if ($select_orders->rowCount() > 0) {
        while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
            $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_product->execute([$fetch_order['product_id']]);

            if ($select_product->rowCount() > 0) {
                while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="box" <?php if ($fetch_order['status'] == 'canceled') {
                        echo 'style="border:.2rem solid red";';
                    } ?>>
                        <a href="view_order.php?get_id=<?= $fetch_order['id']; ?>">
                            <p class="date"><i class="fa fa-calendar"></i><span><?= $fetch_order['date']; ?></span></p>
                            <img src="../../images/products/<?= $fetch_product['image1']; ?>" class="image" alt="">
                            <h3 class="name"><?= $fetch_product['name']; ?></h3>
                            <p class="price">RM <?= $fetch_order['price']; ?> x <?= $fetch_order['qty']; ?></p>
                            <p class="status" style="color:<?php if ($fetch_order['status'] == 'completed') {
                                echo 'green';
                            } elseif ($fetch_order['status'] == 'canceled') {
                                echo 'red';
                            } else {
                                echo 'orange';
                            } ?>">
                                <?= $fetch_order['status']; ?>
                            </p>
                        </a>
                    </div>
                    <?php
                }
            }
        }
    } else {
        echo '<p class="empty">No Orders Found!</p>';
    }
} else {
    echo '<p class="empty">User not logged in!</p>';
}
?>