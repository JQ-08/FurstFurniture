<?php
include 'includes/connect.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'css/style.php';
include 'includes/functions.inc.php';

$query = "SELECT * FROM orders";
$result = $conn->query($query);

if (!$result) {
	die("Query failed: " . $conn->error);
}

?>

		<!--**********************************
			Content body start
		***********************************-->
		<div class="content-body" >
			<div class="container-fluid">
				<!-- Row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="filter cm-content-box box-primary">
							<div class="content-title d-flex justify-content-between align-items-center">
								<div class="header-left">
									<div class="cpa">
										<i class="fa-solid fa-file-lines me-1"></i>Orders List
									</div>
								</div>
								<ul class="header-right d-flex mb-0">
									<li class="nav-item">
										<button id="delete-selected" class="btn btn-danger" style="display: none;">Delete Selected</button>
									</li>
									<li class="nav-item">
										<a href="javascript:void(0);" class="btn btn-primary d-sm-inline-block d-none">Generate Report<i class="fa-solid fa-file-invoice icon-gap"></i></a>
									</li>
								</ul>
							</div>
							<div class="cm-content-body form excerpt">
								<div class="card-body pt-2">
									<div class="table-responsive">
									<table class="table table-responsive-sm mb-0">
										<thead>
											<tr>
												<th style="">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="" id="checkAll">
														<label class="form-check-label" for="checkAll"></label>
													</div>
												</th>
												<th><strong>Order ID</strong></th>
												<th><strong>User ID</strong></th>
												<th><strong>Status</strong></th>
												<th><strong>Ship To</strong></th>
												<th><strong>Payment</strong></th>
												<th><strong>Contact</strong></th>
												<th><strong>Product ID</strong></th>
												<th><strong>Quantity</strong></th>
												<th><strong>Price</strong></th>
												<th><strong>Action</strong></th>
											</tr>
										</thead>
										<tbody>
											<script>
											document.addEventListener('DOMContentLoaded', function() {
												document.querySelectorAll('.dropdown-item').forEach(button => {
													button.addEventListener('click', function() {
														const orderId = this.getAttribute('data-order-id');
														const status = this.getAttribute('data-status');

														if (this.textContent.trim().toLowerCase() === 'delete') {
															if (!orderId) {
																alert('Order ID is missing for deletion.');
																return;
															}
														}
														if (!orderId || !status) {
															if (this.textContent.trim().toLowerCase() === 'delete') {
																exit();
															}
															else{
																alert('Order ID or status is missing.');
																return;
															}
														}

														if (confirm(`Are you sure you want to change the status to ${status}? Order ID: ${orderId}`)) {
															fetch('includes/functions.php', {
																method: 'POST',
																headers: {
																	'Content-Type': 'application/x-www-form-urlencoded'
																},
																body: new URLSearchParams({
																	'orderId': orderId,
																	'status': status
																})
															})
															.then(response => {
																if (!response.ok) {
																	throw new Error('Network response was not ok');
																}
																return response.json();
															})
															.then(data => {
																console.log('Response received:', data);

																if (data.success) {
																	alert('Status updated successfully!');
																	location.reload();  // Reload the page to show updated status
																} else {
																	alert('Failed to update status: ' + (data.error || 'Unknown error'));
																}
															})
															.catch(error => {
																console.error('Error:', error);
																alert('An error occurred while updating the status.');
															});
														}
													});
												});
											});



											function getStatusClass(status) {
												switch (status) {
													case 'completed':
														return 'badge badge-primary';
													case 'in progress':
														return 'badge badge-in-progress';
													case 'canceled':
														return 'badge badge-warning';
													default:
														return 'badge badge-secondary';
												}
											}
											</script>
											<?php
											$query = "SELECT COUNT(*) AS total FROM orders";
											$result = $conn->query($query);
											$row = $result->fetch_assoc();
											$totalRecords = (int)$row['total'];

											$recordsPerPage = 10;
											$totalPgs = ceil($totalRecords / $recordsPerPage);

											$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
											$page = max(1, min($page, $totalPgs));
											$offset = ($page - 1) * $recordsPerPage;

											$query = "
												SELECT o.id, o.userId, o.date, o.number, o.address, o.method, o.product_id, o.status, o.price, o.qty 
												FROM orders o
												JOIN products p ON o.product_id = p.id
												LIMIT $recordsPerPage OFFSET $offset
											";
											$orders = $conn->query($query);

											if (!$orders) {
												die("Query failed: " . $conn->error);
											}

											function getStatusClass($status)
											{
												switch ($status) {
													case 'completed':
														return 'badge badge-success';
													case 'in progress':
														return 'badge badge-in-progress';
													case 'canceled':
														return 'badge badge-canceled';
													default:
														return 'badge badge-secondary';
												}
											}
											while ($row = $orders->fetch_assoc()) {

												echo "<tr>";
												echo "<td>";
												echo "<div class='form-check'>";
												echo "<input class='form-check-input order-checkbox' type='checkbox' value='' id='flexCheckDefault-{$row['id']}'>";
												echo "<label class='form-check-label' for='flexCheckDefault-{$row['id']}'></label>";
												echo "</div>";
												echo "</td>";
												echo "<td>";
												echo "<a href='#'><strong>#{$row['id']}</strong></a>";
												echo "</td>";
												echo "<td>";
												echo "<a href='#'><strong>#{$row['userId']}</strong></a>";
												echo "</td>";
												echo "<td>";
												echo "<span class='" . getStatusClass($row['status']) . "'>";
												echo htmlspecialchars($row['status']);
												echo "<span class='ms-1 fa fa-check'></span>";
												echo "</span>";
												echo "</td>";
												echo "<td>" . htmlspecialchars($row['address']) . "</td>";
												echo "<td>" . htmlspecialchars($row['method']) . "</td>";
												echo "<td>" . htmlspecialchars($row['number']) . "</td>";
												echo "<td>";
												echo "<a href='#'><strong>#{$row['product_id']}</strong></a>";
												echo "</td>";
												echo "<td>" . htmlspecialchars($row['qty']) . "</td>";
												echo "<td>";
												echo "<a href='#'><strong>RM {$row['price']}</strong></a>";
												echo "</td>";
												echo "<td>";
												echo "<div class='dropdown text-sans-serif'>";
												echo "<button class='btn btn-primary tp-btn-light sharp' type='button' id='order-dropdown-{$row['id']}' data-bs-toggle='dropdown' data-boundary='viewport' aria-haspopup='true' aria-expanded='false'>";
												echo "<span>";
												echo "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='18px' height='18px' viewBox='0 0 24 24' version='1.1'>";
												echo "<g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>";
												echo "<rect x='0' y='0' width='24' height='24'></rect>";
												echo "<circle fill='#000000' cx='5' cy='12' r='2'></circle>";
												echo "<circle fill='#000000' cx='12' cy='12' r='2'></circle>";
												echo "<circle fill='#000000' cx='19' cy='12' r='2'></circle>";
												echo "</g>";
												echo "</svg>";
												echo "</span>";
												echo "</button>";
												echo "<div class='dropdown-menu dropdown-menu-end border py-0' aria-labelledby='order-dropdown-{$row['id']}'>";
												echo "<div class='py-2'>";
												echo "<a class='dropdown-item' href='javascript:void(0);' data-order-id='{$row['id']}' data-status='completed'>completed</a>";
												echo "<a class='dropdown-item' href='javascript:void(0);' data-order-id='{$row['id']}' data-status='in progress'>in progress</a>";
												echo "<a class='dropdown-item' href='javascript:void(0);' data-order-id='{$row['id']}' data-status='canceled'>canceled</a>";
												echo "<div class='dropdown-divider'></div>";
												echo "<a class='dropdown-item text-danger' href='javascript:void(0);' data-order-id='{$row['id']}' onclick='deleteOrder({$row['id']})'>Delete</a>";
												echo "</div>";
												echo "</div>";
												echo "</div>";
												echo "</td>";
												echo "</tr>";
											}
											?>
										</tbody>
									</table>
									</div>

									<!-- Pagination Controls -->
									<?php
									// Calculate how many orders are being shown
									$showingRecords = min($recordsPerPage, $totalRecords - $offset);

									echo "<div class='d-flex align-items-center justify-content-xl-between flex-wrap justify-content-center mt-3'>";
									echo "<small class='pgstyle mb-xl-0 mb-2'>";
									echo "Page <span id='current-page'>{$page}</span> ";
									echo "of <span id='total-pages'>{$totalPgs}</span>, showing ";
									echo "<span id='showing-records'>{$showingRecords}</span> ";
									echo "records out of <span id='total-records'>{$totalRecords}</span> total";
									echo "</small>";

									echo "<nav aria-label='Page navigation example'>";
									echo "<ul class='pagination mb-2 mb-sm-0'>";

									// Previous Button
									$prevDisabled = ($page <= 1) ? 'disabled' : '';
									$prevPage = ($page > 1) ? ($page - 1) : 1;
									echo "<li class='page-item {$prevDisabled}' id='prev-page'>";
									echo "<a class='page-link' href='?page={$prevPage}'>";
									echo "<i class='fa-solid fa-angle-left'></i>";
									echo "</a>";
									echo "</li>";

									// Dynamically Generate Page Numbers
									for ($i = 1; $i <= $totalPgs; $i++) {
										$activeClass = ($i == $page) ? 'active' : '';
										echo "<li class='page-item {$activeClass}'>";
										echo "<a class='page-link' href='?page={$i}'>{$i}</a>";
										echo "</li>";
									}

									// Next Button
									$nextDisabled = ($page >= $totalPgs) ? 'disabled' : '';
									$nextPage = ($page < $totalPgs) ? ($page + 1) : $totalPgs;
									echo "<li class='page-item {$nextDisabled}' id='next-page'>";
									echo "<a class='page-link' href='?page={$nextPage}'>";
									echo "<i class='fa-solid fa-angle-right'></i>";
									echo "</a>";
									echo "</li>";

									echo "</ul>";
									echo "</nav>";
									echo "</div>";
									?>
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
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			const checkAll = document.getElementById('checkAll');
			const deleteButton = document.getElementById('delete-selected');
			const checkboxes = document.querySelectorAll('.order-checkbox');

			// Function to toggle delete button visibility
			function toggleDeleteButton() {
				const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
				deleteButton.style.display = anyChecked ? 'inline-block' : 'none';
			}

			// Toggle all checkboxes when the "Check All" checkbox is clicked
			checkAll.addEventListener('change', function() {
				checkboxes.forEach(checkbox => {
					checkbox.checked = this.checked;
				});
				toggleDeleteButton();
			});

			// Toggle the delete button based on individual checkbox changes
			checkboxes.forEach(checkbox => {
				checkbox.addEventListener('change', toggleDeleteButton);
			});
		});
		</script>
		<script>
		document.getElementById('delete-selected').addEventListener('click', function() {
			const selectedOrderIds = Array.from(document.querySelectorAll('.order-checkbox:checked'))
				.map(checkbox => checkbox.id.replace('flexCheckDefault-', ''));

			if (selectedOrderIds.length === 0) {
				alert('No orders selected for deletion.');
				return;
			}

			if (confirm('Are you sure you want to delete the selected orders?')) {
				fetch('includes/delete.php', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json'
					},
					body: JSON.stringify({ orderIds: selectedOrderIds })
				})
				.then(response => response.json())
				.then(data => {
					if (data.success) {
						alert('Selected orders deleted successfully!');
						location.reload(); // Refresh the page to reflect changes
					} else {
						alert('Failed to delete orders: ' + (data.error || 'Unknown error'));
					}
				})
				.catch(error => {
					console.error('Error:', error);
					alert('An error occurred while deleting the orders.');
				});
			}
		});

		</script>
		<script>
			function deleteOrder(orderId) {
				if (confirm('Are you sure you want to delete this order?')) {
					fetch('includes/delete_orders.php', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json'
						},
						body: JSON.stringify({ orderId: orderId })
					})
					.then(response => response.json())
					.then(data => {
						if (data.success) {
							alert('Order deleted successfully!');
							location.reload();  // Refresh the page to reflect changes
						} else {
							alert('Failed to delete order: ' + (data.error || 'Unknown error'));
						}
					})
					.catch(error => {
						console.error('Error:', error);
						alert('An error occurred while deleting the order.');
					});
				}
			}
		</script>


<?php
include 'js/user_admin_js.php';
include 'includes/footer.php';
include 'includes/scripts.php';
?>
