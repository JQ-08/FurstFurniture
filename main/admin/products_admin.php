<?php
include 'includes/connect.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'css/style.php';

$sql = "SELECT id, name, price, image1 FROM products";
$result = $conn->query($sql);
?>

<!--**********************************
            Content body start
        ***********************************-->
<!-- Add Product Form -->
<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="includes/functions.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name </label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Product Name" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" class="form-control"
                            placeholder="Enter Product Description" required>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" placeholder="Enter Product Price (RM)"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="type">Product Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="" disabled selected>Select Product Type</option>
                            <option value="chair">Chair</option>
                            <option value="table">Table</option>
                            <option value="wardrobe">Wardrobe</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Image 1</label>
                        <input type="file" name="image1" class="form-control" placeholder="Import Image Here" required>
                    </div>
                    <div class="form-group">
                        <label>Image 2</label>
                        <input type="file" name="image2" class="form-control" placeholder="Import Image Here" required>
                    </div>
                    <div class="form-group">
                        <label>Image 3</label>
                        <input type="file" name="image3" class="form-control" placeholder="Import Image Here" required>
                    </div>
                    <div class="form-group">
                        <label>Image 4</label>
                        <input type="file" name="image4" class="form-control" placeholder="Import Image Here" required>
                    </div>
                    <div class="form-group">
                        <label>Depth</label>
                        <input type="text" name="depth" class="form-control" placeholder="Enter Product Depth" required>
                    </div>
                    <div class="form-group">
                        <label>Width</label>
                        <input type="text" name="width" class="form-control" placeholder="Enter Product Width" required>
                    </div>
                    <div class="form-group">
                        <label>Height</label>
                        <input type="text" name="height" class="form-control" placeholder="Enter Product Height"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="addproductbtn" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Product Form -->
<div class="modal fade" id="editproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editProductForm" action="includes/functions.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="editProductId">
                    <div class="form-group">
                        <label>Name </label>
                        <input type="text" name="name" id="editProductName" class="form-control"
                            placeholder="Enter Product Name" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" id="editProductDesc" class="form-control"
                            placeholder="Enter Product Description" required>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" id="editProductPrice" class="form-control"
                            placeholder="Enter Product Price (RM)" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Product Type</label>
                        <select name="type" id="editProductType" class="form-control" required>
                            <option value="" disabled>Select Product Type</option>
                            <option value="chair">Chair</option>
                            <option value="table">Table</option>
                            <option value="wardrobe">Wardrobe</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Image 1</label>
                        <input type="file" name="image1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Image 2</label>
                        <input type="file" name="image2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Image 3</label>
                        <input type="file" name="image3" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Image 4</label>
                        <input type="file" name="image4" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Depth</label>
                        <input type="text" name="depth" id="editProductDepth" class="form-control"
                            placeholder="Enter Product Depth" required>
                    </div>
                    <div class="form-group">
                        <label>Width</label>
                        <input type="text" name="width" id="editProductWidth" class="form-control"
                            placeholder="Enter Product Width" required>
                    </div>
                    <div class="form-group">
                        <label>Height</label>
                        <input type="text" name="height" id="editProductHeight" class="form-control"
                            placeholder="Enter Product Height" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="editproductbtn" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="content-body">
    <div class="container-fluid">
        <div class="content-title d-flex justify-content-between align-items-center">
            <div class="header-left">
                <ul class="header-right d-flex mb-0">
                    <li class="nav-item me-2">
                        <a href="javascript:void(0);" class="btn btn-primary d-sm-inline-block d-none"
                            data-toggle="modal" data-target="#addproduct">
                            Add Product<i class="fa-solid fa-plus icon-gap"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <?php
            // Display products
            $sql = "SELECT id, name, description, price, type, image1, image2, image3, image4, depth, width, height FROM products";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $productId = $row['id'];
                    $productName = $row['name'];
                    $productDesc = isset($row['description']) ? $row['description'] : '';
                    $productPrice = $row['price'];
                    $productType = $row['type'];
                    $productImage1 = $row['image1'];
                    $productDepth = $row['depth'];
                    $productWidth = $row['width'];
                    $productHeight = $row['height'];
                    ?>
                    <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                        <div class="card-container">
                            <div class="card-flip">
                                <div class="card-front">
                                    <div class="card-body product-grid-card">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src="../../images/products/<?php echo $productImage1; ?>"
                                                    alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><?php echo htmlspecialchars($productName); ?></h4>
                                                <span class="price">RM <?php echo number_format($productPrice, 2); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-back">
                                    <div class="card-body text-center">
                                        <a href="products_details_admin.php?product_id=<?= $productId; ?>"
                                            class="btn btn-primary" style="margin: 6px;">View more</a>
                                        <!-- Edit Button -->
                                        <a href='javascript:void(0);'
                                            class='btn btn-primary shadow btn-xs sharp rounded-circle me-1 btn-edit'
                                            data-id='<?php echo $productId; ?>'
                                            data-name='<?php echo htmlspecialchars($productName); ?>'
                                            data-description='<?php echo htmlspecialchars($productDesc); ?>'
                                            data-price='<?php echo $productPrice; ?>'
                                            data-type='<?php echo htmlspecialchars($productType); ?>'
                                            data-depth='<?php echo htmlspecialchars($productDepth); ?>'
                                            data-width='<?php echo htmlspecialchars($productWidth); ?>'
                                            data-height='<?php echo htmlspecialchars($productHeight); ?>'
                                            data-image1='<?php echo htmlspecialchars($productImage1); ?>'>
                                            <i class='fa fa-pencil'></i>
                                        </a>
                                        <!-- Delete Button -->
                                        <a href='javascript:void(0);'
                                            class='btn btn-danger shadow btn-xs sharp rounded-circle btn-delete'
                                            data-id='<?php echo htmlspecialchars($row['id']); ?>'>
                                            <i class='fa fa-trash'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No products found";
            }
            $conn->close();
            ?>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>

<!-- JavaScript for handling edit and delete actions -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Edit Product Button
        const editButtons = document.querySelectorAll('.btn-edit');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                const productName = this.getAttribute('data-name');
                const productDesc = this.getAttribute('data-description');
                const productPrice = this.getAttribute('data-price');
                const productType = this.getAttribute('data-type');
                const productDepth = this.getAttribute('data-depth');
                const productWidth = this.getAttribute('data-width');
                const productHeight = this.getAttribute('data-height');
                const productImage1 = this.getAttribute('data-image1');

                document.getElementById('editProductId').value = productId;
                document.getElementById('editProductName').value = productName;
                document.getElementById('editProductDesc').value = productDesc;
                document.getElementById('editProductPrice').value = productPrice;
                document.getElementById('editProductType').value = productType;
                document.getElementById('editProductDepth').value = productDepth;
                document.getElementById('editProductWidth').value = productWidth;
                document.getElementById('editProductHeight').value = productHeight;

                $('#editproduct').modal('show');
            });
        });

        // Delete Product Button
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');

                if (confirm('Are you sure you want to delete this product?')) {
                    fetch('includes/deleteproduct.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            'product_id': productId
                        })
                    })
                        .then(response => response.text())
                        .then(data => {
                            alert(data);
                            location.reload();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            });
        });
    });
</script>
<script>
$(document).ready(function () {
    // Close modal on button click
    $('.close').on('click', function () {
        $('#editproduct').modal('hide');
    });

    // Optional: You can clear the form when the modal is hidden
    $('#editproduct').on('hidden.bs.modal', function () {
        $('#editProductForm')[0].reset();
    });
});

</script>