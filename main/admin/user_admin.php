<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ini_set('log_errors', 'On');
	ini_set('error_log', '/path/to/php_errors.log');
	include 'includes/connect.php';
	include 'includes/header.php';
	include 'includes/sidebar.php';
	include 'css/style.php';
	include 'includes/functions.inc.php';

	// if (isset($_GET['page']) && isset($_GET['ajax']) && $_GET['ajax'] == 1) {
	// 	header('Content-Type: application/json');
	// 	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	
	// 	$userData = fetchUserData($page);
	
	// 	echo json_encode($userData);
	// 	exit; 
	// }

	$query = "SELECT * FROM users";  
    $result = $conn->query($query);
?>

        <!--**********************************
            Content body start
        ***********************************-->
		<!-- Add User Form -->
        <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="includes/functions.inc.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name </label>
                                <input type="text" name="usersName" class="form-control" placeholder="Enter Username" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="usersEmail" class="form-control" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group">
                                <div class="eye-area">
                                    <div class="eye-box" onclick="myRegPassword()">
                                        <i class="material-icons" id="eye-2">visibility</i>          
                                        <i class="material-icons" id="eye-slash-2">visibility_off</i>                  
                                    </div>
                                </div>
                                <label>Password</label>
                                <input type="password" name="usersPwd" class="form-control" placeholder="Enter Password"
                                    required>
                            </div>
                            <div class="form-group">
                                <div class="eye-area">
                                    <div class="eye-box" onclick="myRegPassword_2()">
                                        <i class="material-icons" id="eye-3">visibility</i>          
                                        <i class="material-icons" id="eye-slash-3">visibility_off</i>                   
                                    </div>
                                </div>
                                <label>Confirm Password</label>
                                <input type="password" name="usersConfirmPassword" class="form-control" placeholder="Re-enter Password"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

		<!-- Update User Form -->
		<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Update User</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="includes/functions.inc.php" method="POST">
						<div class="modal-body">
							<input type="hidden" name="editUserId" id="editUserId">
							<div class="form-group">
								<label>Name</label>
								<input type="text" name="editUsersName" id="editUsersName" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="editUsersEmail" id="editUsersEmail" class="form-control" required>
							</div>
							<div class="form-group">
								<div class="eye-area">
									<div class="eye-box" onclick="myEditUserPassword()">
										<i class="material-icons" id="eye-4">visibility</i>          
										<i class="material-icons" id="eye-slash-4">visibility_off</i>                  
									</div>
								</div>
								<label>Password</label>
								<input type="password" name="editUsersPwd" id="editUsersPwd" class="form-control" required>
							</div>
							<div class="form-group">
								<div class="eye-area">
									<div class="eye-box" onclick="myEditUserPassword_2()">
										<i class="material-icons" id="eye-5">visibility</i>          
										<i class="material-icons" id="eye-slash-5">visibility_off</i>                  
									</div>
								</div>
								<label>Confirm Password</label>
								<input type="password" name="editUsersConfirmPassword" id="editUsersConfirmPassword" class="form-control" required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" name="updateUserBtn" class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="content-body">
			<div class="container-fluid">
				<!-- Row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="filter cm-content-box box-primary">
							<div class="content-title d-flex justify-content-between align-items-center">
								<div class="header-left">
									<div class="cpa">
										<i class="fa-solid fa-file-lines me-1"></i>User List
									</div>
								</div>
								<ul class="header-right d-flex mb-0">
									<li class="nav-item">
										<button id="delete-selected" class="btn btn-danger" style="display: none;">Delete Selected</button>
									</li>
									<li class="nav-item me-2">
										<a href="javascript:void(0);" class="btn btn-primary d-sm-inline-block d-none" data-toggle="modal" data-target="#adduser">
											Add User<i class="fa-solid fa-user-plus icon-gap"></i>
										</a>
									</li>
								</ul>
							</div>
							<?php
								$recordsPerPage = 10;
								$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
								$offset = ($page - 1) * $recordsPerPage;
								$totalRecordsResult = $conn->query("SELECT COUNT(*) AS total FROM users");
								$totalRecords = $totalRecordsResult->fetch_assoc()['total'];
								$sql = "SELECT * FROM users LIMIT $recordsPerPage OFFSET $offset";
								$result = $conn->query($sql);
							?>

							<div class="cm-content-body form excerpt">
								<div class="card-body pt-2">
									<div class="table-responsive">
										<table class="table table-responsive-sm mb-0">
											<thead>
												<tr>
													<th style="">
														<div class="form-check">
															<input class="form-check-input delete-checkbox" type="checkbox" value="" id="checkAll">
															<label class="form-check-label" for="checkAll"></label>
														</div>
													</th>
													<th><strong>ID</strong></th>
													<th><strong>Name</strong></th>
													<th><strong>Email</strong></th>
													<th><strong>Password</strong></th>
													<th style="width:85px;"><strong>Actions</strong></th>
												</tr>
											</thead>
											<tbody>
											<?php
												if ($result->num_rows > 0) {
													while ($row = $result->fetch_assoc()) {
														echo "<tr>";
														echo "<td>
																<div class='form-check'>
																	<input class='form-check-input delete-checkbox' type='checkbox' value='" . htmlspecialchars($row['userId']) . "' id='flexCheckDefault-" . $row['userId'] . "'>
																	<label class='form-check-label' for='flexCheckDefault-" . $row['userId'] . "'></label>
																</div>
															</td>";
														echo "<td><b>" . htmlspecialchars($row['userId']) . "</b></td>";
														echo "<td>" . htmlspecialchars($row['usersName']) . "</td>";
														echo "<td>" . htmlspecialchars($row['usersEmail']) . "</td>";
														echo "<td>" . htmlspecialchars($row['usersPwd']) . "</td>";  
														echo "<td>
																<!-- Edit Button -->
																<a href='javascript:void(0);'
																class='btn btn-primary shadow btn-xs sharp rounded-circle me-1 btn-edit'
																data-id='" . htmlspecialchars($row['userId']) . "'
																data-name='" . htmlspecialchars($row['usersName']) . "'
																data-email='" . htmlspecialchars($row['usersEmail']) . "'
																data-toggle='modal' data-target='#edituser'>
																	<i class='fa fa-pencil'></i>
																</a>
																<!-- Delete Button -->
																<a href='javascript:void(0);' class='btn btn-danger shadow btn-xs sharp rounded-circle btn-delete'
																data-id='" . htmlspecialchars($row['userId']) . "'>
																	<i class='fa fa-trash'></i>
																</a>
															</td>";                                                        
														echo "</tr>";
													}
												} else {
													echo "<tr><td colspan='6'>No records found</td></tr>";
												}
											?>
										</tbody>
									</table>
								</div>
								
								<!-- Pagination Controls -->
								<?php
									$totalPages = ceil($totalRecords / $recordsPerPage);

									echo "<div class='d-flex align-items-center justify-content-xl-between flex-wrap justify-content-center mt-3'>";
									echo "<small class='pgstyle mb-xl-0 mb-2'>Page {$page} of {$totalPages}, showing {$result->num_rows} records out of {$totalRecords} total</small>";
									echo "<nav aria-label='Page navigation example'>";
									echo "<ul class='pagination mb-2 mb-sm-0'>";

									if ($page > 1) {
										echo "<li class='page-item'><a class='page-link' href='?page=" . ($page - 1) . "'><i class='fa-solid fa-angle-left'></i></a></li>";
									} else {
										echo "<li class='page-item disabled'><a class='page-link' href='javascript:void(0);'><i class='fa-solid fa-angle-left'></i></a></li>";
									}

									for ($i = 1; $i <= $totalPages; $i++) {
										$active = ($i == $page) ? "active" : "";
										echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
									}

									if ($page < $totalPages) {
										echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "'><i class='fa-solid fa-angle-right'></i></a></li>";
									} else {
										echo "<li class='page-item disabled'><a class='page-link' href='javascript:void(0);'><i class='fa-solid fa-angle-right'></i></a></li>";
									}

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

<?php
    include 'js/user_admin_js.php';
    include 'includes/footer.php';
	include 'includes/scripts.php';
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteSelectedBtn = document.getElementById('delete-selected');
    const checkAll = document.getElementById('checkAll');
	const checkboxes = document.querySelectorAll('.form-check-input');

    // Function to update the visibility of the "Delete Selected" button
    function updateDeleteButtonVisibility() {
        const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        deleteSelectedBtn.style.display = anyChecked ? 'block' : 'none';
    }

    // Handle "Select All" checkbox functionality
    checkAll.addEventListener('change', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = checkAll.checked;
        });
        updateDeleteButtonVisibility();
    });

    // Update button visibility when individual checkboxes are clicked
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateDeleteButtonVisibility();
            // Uncheck "Select All" if not all are checked
            if (!checkbox.checked) {
                checkAll.checked = false;
            } else {
                // Check "Select All" if all checkboxes are checked
                const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                if (allChecked) {
                    checkAll.checked = true;
                }
            }
        });
    });

    // Handle the "Delete Selected" button click event
    deleteSelectedBtn.addEventListener('click', function() {
        const selectedIds = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        console.log('Selected IDs:', selectedIds);  // Debugging line

        if (selectedIds.length > 0) {
            if (confirm('Are you sure you want to delete the selected users?')) {
                // Send AJAX request to delete users
                fetch('includes/delete_users.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ userIds: selectedIds }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Selected users have been deleted.');
                        location.reload(); // Refresh the page to update the user list
                    } else {
                        alert('Failed to delete users: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while trying to delete the users.');
                });
            }
        } else {
            alert('No users selected.');
        }
    });
});

</script>

<!-- Refund  -->