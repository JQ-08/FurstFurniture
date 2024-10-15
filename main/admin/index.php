<?php
	include 'includes/header.php';
	include 'includes/sidebar.php';
	include 'css/style.php';
	include 'includes/connect.php';
	include 'includes/total.php';
	include 'includes/dashboard.php';

	if ($totalEarningsPrevious > 0) {
		$percentageIncrease = (($totalEarningsCurrent - $totalEarningsPrevious) / $totalEarningsPrevious) * 100;
		error_log("Previous earnings: $totalEarningsPrevious, current earnings: $totalEarningsCurrent, percentage increase: $percentageIncrease%");
	} else {
		$percentageIncrease = 0; // Handle zero previous earnings
		error_log("Previous earnings are zero, cannot calculate percentage increase.");
	}
	
	$query_monthly_transactions = "
		SELECT * 
		FROM orders 
		WHERE date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) 
		ORDER BY date DESC
		LIMIT 5";

	$result_monthly_transactions = $conn->query($query_monthly_transactions);

	$query_weekly_transactions = "
		SELECT * 
		FROM orders 
		WHERE date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 
		ORDER BY date DESC
		LIMIT 5";

	$result_weekly_transactions = $conn->query($query_weekly_transactions);

	$query_today_transactions = "
		SELECT * 
		FROM orders 
		WHERE date = CURDATE()
		ORDER BY date DESC
		LIMIT 5";

	$result_today_transactions = $conn->query($query_today_transactions);
	?>

		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<!-- invoice card -->
				<div class="row invoice-card-row">
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="card bg-warning invoice-card">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg  width="33px" height="32px">
									<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
									 d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z"/>
									</svg>
									
								</div>
								<div>
									<h2 class="text-white invoice-num"><?php echo $totalUsers; ?></h2>
									<span class="text-white fs-18">Total Users</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="card bg-success invoice-card">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="35px" height="34px">
									<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
									 d="M32.482,9.730 C31.092,6.789 28.892,4.319 26.120,2.586 C22.265,0.183 17.698,-0.580 13.271,0.442 C8.843,1.458 5.074,4.140 2.668,7.990 C0.255,11.840 -0.509,16.394 0.514,20.822 C1.538,25.244 4.224,29.008 8.072,31.411 C10.785,33.104 13.896,34.000 17.080,34.000 L17.286,34.000 C20.456,33.960 23.541,33.044 26.213,31.358 C26.991,30.866 27.217,29.844 26.725,29.067 C26.234,28.291 25.210,28.065 24.432,28.556 C22.285,29.917 19.799,30.654 17.246,30.687 C14.627,30.720 12.067,29.997 9.834,28.609 C6.730,26.671 4.569,23.644 3.752,20.085 C2.934,16.527 3.546,12.863 5.486,9.763 C9.488,3.370 17.957,1.418 24.359,5.414 C26.592,6.808 28.360,8.793 29.477,11.157 C30.568,13.460 30.993,16.016 30.707,18.539 C30.607,19.448 31.259,20.271 32.177,20.371 C33.087,20.470 33.911,19.820 34.011,18.904 C34.363,15.764 33.832,12.591 32.482,9.730 L32.482,9.730 Z"/>
									<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
									 d="M22.593,11.237 L14.575,19.244 L11.604,16.277 C10.952,15.626 9.902,15.626 9.250,16.277 C8.599,16.927 8.599,17.976 9.250,18.627 L13.399,22.770 C13.725,23.095 14.150,23.254 14.575,23.254 C15.001,23.254 15.427,23.095 15.753,22.770 L24.940,13.588 C25.592,12.937 25.592,11.888 24.940,11.237 C24.289,10.593 23.238,10.593 22.593,11.237 L22.593,11.237 Z"/>
									</svg>
									
								</div>
								<div>
									<h2 class="text-white invoice-num"><?php echo $totalProducts; ?></h2>
									<span class="text-white fs-18">Total Products</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="card bg-info invoice-card">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg  width="35px" height="34px">
									<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
									 d="M33.002,9.728 C31.612,6.787 29.411,4.316 26.638,2.583 C22.781,0.179 18.219,-0.584 13.784,0.438 C9.356,1.454 5.585,4.137 3.178,7.989 C0.764,11.840 -0.000,16.396 1.023,20.825 C2.048,25.247 4.734,29.013 8.584,31.417 C11.297,33.110 14.409,34.006 17.594,34.006 L17.800,34.006 C20.973,33.967 24.058,33.050 26.731,31.363 C27.509,30.872 27.735,29.849 27.243,29.072 C26.751,28.296 25.727,28.070 24.949,28.561 C22.801,29.922 20.314,30.660 17.761,30.693 C15.141,30.726 12.581,30.002 10.346,28.614 C7.241,26.675 5.080,23.647 4.262,20.088 C3.444,16.515 4.056,12.850 5.997,9.748 C10.001,3.353 18.473,1.401 24.876,5.399 C27.110,6.793 28.879,8.779 29.996,11.143 C31.087,13.447 31.513,16.004 31.227,18.527 C31.126,19.437 31.778,20.260 32.696,20.360 C33.607,20.459 34.432,19.809 34.531,18.892 C34.884,15.765 34.352,12.591 33.002,9.728 L33.002,9.728 Z"/>
									<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
									 d="M23.380,11.236 C22.728,10.585 21.678,10.585 21.026,11.236 L17.608,14.656 L14.190,11.243 C13.539,10.592 12.488,10.592 11.836,11.243 C11.184,11.893 11.184,12.942 11.836,13.593 L15.254,17.006 L11.836,20.420 C11.184,21.071 11.184,22.120 11.836,22.770 C12.162,23.096 12.588,23.255 13.014,23.255 C13.438,23.255 13.864,23.096 14.190,22.770 L17.608,19.357 L21.026,22.770 C21.352,23.096 21.777,23.255 22.203,23.255 C22.629,23.255 23.054,23.096 23.380,22.770 C24.031,22.120 24.031,21.071 23.380,20.420 L19.962,17.000 L23.380,13.587 C24.031,12.936 24.031,11.887 23.380,11.236 L23.380,11.236 Z"/>
									</svg>
									
								</div>
								<div>
									<h2 class="text-white invoice-num"><?php echo $statusCounts['completed']; ?></h2>
									<span class="text-white fs-18">Total Orders Completed</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="card bg-secondary invoice-card">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg  width="33px" height="32px">
									<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
									 d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z"/>
									</svg>
								
								</div>
								<div>
									<h2 class="text-white invoice-num"><?php echo $statusCounts['in progress']; ?></h2>
									<span class="text-white fs-18">Total Orders In Progress</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Total Earnings & Product's Overview -->
					<div class="col-xl-9 col-xxl-12">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<!-- Total Earnings -->
									<div class="col-xl-6">
										<div class="card-bx bg-blue">
											<img class="pattern-img" src="images/pattern/pattern6.png" alt="">
											<div class="card-info text-white">
												<img src="images/pattern/circle.png" class="mb-4" alt="">
												<h2 class="text-white card-balance">RM <?php echo number_format($totalEarnings, 2); ?></h2>
												<p class="fs-16">Total Earnings</p>
												<span><?php echo number_format($percentageIncrease, 2); ?>%</span>
											</div>
											<a class="change-btn" id="changeButton">
												<i class="fa fa-caret-up up-ico"></i>Change
												<span class="reload-icon">
													<i class="fas fa-sync-alt reload active"></i>
												</span>
											</a>
										</div>
									</div>
									<!-- Product's Overview -->
									<div class="col-xl-6">
										<div class="row mt-xl-0 mt-4">
											<div class="col-md-6">
												<h4 class="card-title">Product's Overview</h4>
												<span class="fs-12">Total Products Available for Sale</span>
												<ul class="card-list mt-4">
													<li><span class="bg-pink-dashboard circle"></span>Chair<span id="chair-count"><?php echo $chairCount; ?></span></li>
													<li><span class="bg-magenta-dashboard circle"></span>Table<span id="table-count"><?php echo $tableCount; ?></span></li>
													<li><span class="bg-purple-dashboard circle"></span>Wardrobe<span id="wardrobe-count"><?php echo $wardrobeCount; ?></span></li>
												</ul>
											</div>
											<div class="col-md-6">
												<canvas id="polarChart"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Previous Transactions -->
					<div class="col-xl-6 col-xxl-12">
						<div class="card">
							<div class="card-header d-block d-sm-flex border-0">
								<div class="me-3">
									<h4 class="card-title mb-2">Previous Transactions</h4>
									<span class="fs-12">View All Recent Customer Purchases</span>
								</div>
								<div class="card-tabs mt-3 mt-sm-0">
									<ul class="nav nav-tabs" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-bs-toggle="tab" href="#monthly" role="tab">Monthly</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#Weekly" role="tab">Weekly</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#Today" role="tab">Today</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="card-body tab-content p-0">
								<div class="tab-pane active show fade" id="monthly" role="tabpanel">
									<div class="table-responsive">
										<table class="table table-responsive-md card-table transactions-table">
											<tbody>
												<?php if ($result_monthly_transactions->num_rows > 0): ?>
													<?php while ($row_monthly_transactions = $result_monthly_transactions->fetch_assoc()): 
														$status_class_monthly = ''; 

														if ($row_monthly_transactions['status'] === 'in progress') {
															$status_class_monthly = 'text-light';
														} elseif ($row_monthly_transactions['status'] === 'completed') {
															$status_class_monthly = 'text-success';
														} elseif ($row_monthly_transactions['status'] === 'canceled') {
															$status_class_monthly = 'text-danger';
														}
													?>
														<tr>
															<td>
																<svg class="bgl-danger tr-icon" width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<g><path d="M35.2219 19.0125C34.8937 19.6906 35.1836 20.5109 35.8617 20.8391C37.7484 21.7469 39.3453 23.1578 40.4828 24.9242C41.6476 26.7344 42.2656 28.8344 42.2656 31C42.2656 37.2125 37.2125 42.2656 31 42.2656C24.7875 42.2656 19.7344 37.2125 19.7344 31C19.7344 28.8344 20.3523 26.7344 21.5117 24.9187C22.6437 23.1523 24.2461 21.7414 26.1328 20.8336C26.8109 20.5055 27.1008 19.6906 26.7726 19.007C26.4445 18.3289 25.6297 18.0391 24.9461 18.3672C22.6 19.4937 20.6148 21.2437 19.2094 23.4422C17.7656 25.6953 17 28.3094 17 31C17 34.7406 18.4547 38.257 21.1015 40.8984C23.743 43.5453 27.2594 45 31 45C34.7406 45 38.257 43.5453 40.8984 40.8984C43.5453 38.2516 45 34.7406 45 31C45 28.3094 44.2344 25.6953 42.7851 23.4422C41.3742 21.2492 39.389 19.4937 37.0484 18.3672C36.3648 18.0445 35.55 18.3289 35.2219 19.0125Z" fill="#FF2E2E"></path><path d="M36.3211 30.2726C36.589 30.0047 36.7203 29.6547 36.7203 29.3047C36.7203 28.9547 36.589 28.6047 36.3211 28.3367L32.8812 24.8969C32.3781 24.3937 31.7109 24.1203 31.0055 24.1203C30.3 24.1203 29.6273 24.3992 29.1297 24.8969L25.6898 28.3367C25.1539 28.8726 25.1539 29.7367 25.6898 30.2726C26.2258 30.8086 27.0898 30.8086 27.6258 30.2726L29.6437 28.2547L29.6437 36.0258C29.6437 36.7804 30.2562 37.3929 31.0109 37.3929C31.7656 37.3929 32.3781 36.7804 32.3781 36.0258L32.3781 28.2492L34.3961 30.2672C34.9211 30.8031 35.7851 30.8031 36.3211 30.2726Z" fill="#FF2E2E"></path></g>
																</svg>
															</td>
															<td style="width: 170px;">
																<h6 class="fs-16 font-w600 mb-0"><a href="javascript:void(0);" class="text-black">
																	<?php echo $row_monthly_transactions['userId']; ?>
																</a></h6>
																<span class="fs-14"><?php echo $row_monthly_transactions['method']; ?></span>
															</td>
															<td style="width: 260px;">
																<span class="fs-16 text-black font-w600 mb-0"><?php echo date('F j, Y', strtotime($row_monthly_transactions['date'])); ?></s>
															</td>
															<td><span class="fs-16 text-black font-w600">+RM <?php echo number_format($row_monthly_transactions['price'], 2); ?></span></td>
															<td> 
																<span class="<?php echo $status_class_monthly; ?> fs-16 font-w500 text-end d-block">
																	<?php echo ucfirst($row_monthly_transactions['status']); ?>
																</span>
															</td>
														</tr>
													<?php endwhile; ?>
                								<?php else: ?>
													<tr><td colspan="5">No recent transactions found.</td></tr>
                								<?php endif; ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane" id="Weekly" role="tabpanel">
									<div class="table-responsive">
										<table class="table table-responsive-md card-table transactions-table">
											<tbody>
												<?php if ($result_weekly_transactions->num_rows > 0): ?>
													<?php while ($row_weekly_transactions = $result_weekly_transactions->fetch_assoc()): 
														$status_class_weekly = ''; 

														if ($row_weekly_transactions['status'] === 'in progress') {
															$status_class_weekly = 'text-light';
														} elseif ($row_weekly_transactions['status'] === 'completed') {
															$status_class_weekly = 'text-success';
														} elseif ($row_weekly_transactions['status'] === 'canceled') {
															$status_class_weekly = 'text-danger';
														}
													?>
														<tr>
															<td>
																<svg class="bgl-danger tr-icon" width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<g><path d="M35.2219 19.0125C34.8937 19.6906 35.1836 20.5109 35.8617 20.8391C37.7484 21.7469 39.3453 23.1578 40.4828 24.9242C41.6476 26.7344 42.2656 28.8344 42.2656 31C42.2656 37.2125 37.2125 42.2656 31 42.2656C24.7875 42.2656 19.7344 37.2125 19.7344 31C19.7344 28.8344 20.3523 26.7344 21.5117 24.9187C22.6437 23.1523 24.2461 21.7414 26.1328 20.8336C26.8109 20.5055 27.1008 19.6906 26.7726 19.007C26.4445 18.3289 25.6297 18.0391 24.9461 18.3672C22.6 19.4937 20.6148 21.2437 19.2094 23.4422C17.7656 25.6953 17 28.3094 17 31C17 34.7406 18.4547 38.257 21.1015 40.8984C23.743 43.5453 27.2594 45 31 45C34.7406 45 38.257 43.5453 40.8984 40.8984C43.5453 38.2516 45 34.7406 45 31C45 28.3094 44.2344 25.6953 42.7851 23.4422C41.3742 21.2492 39.389 19.4937 37.0484 18.3672C36.3648 18.0445 35.55 18.3289 35.2219 19.0125Z" fill="#FF2E2E"></path><path d="M36.3211 30.2726C36.589 30.0047 36.7203 29.6547 36.7203 29.3047C36.7203 28.9547 36.589 28.6047 36.3211 28.3367L32.8812 24.8969C32.3781 24.3937 31.7109 24.1203 31.0055 24.1203C30.3 24.1203 29.6273 24.3992 29.1297 24.8969L25.6898 28.3367C25.1539 28.8726 25.1539 29.7367 25.6898 30.2726C26.2258 30.8086 27.0898 30.8086 27.6258 30.2726L29.6437 28.2547L29.6437 36.0258C29.6437 36.7804 30.2562 37.3929 31.0109 37.3929C31.7656 37.3929 32.3781 36.7804 32.3781 36.0258L32.3781 28.2492L34.3961 30.2672C34.9211 30.8031 35.7851 30.8031 36.3211 30.2726Z" fill="#FF2E2E"></path></g>
																</svg>
															</td>
															<td style="width: 170px;">
																<h6 class="fs-16 font-w600 mb-0"><a href="javascript:void(0);" class="text-black">
																	<?php echo $row_weekly_transactions['userId']; ?>
																</a></h6>
																<span class="fs-14"><?php echo $row_weekly_transactions['method']; ?></span>
															</td>
															<td style="width: 260px;">
																<span class="fs-16 text-black font-w600 mb-0"><?php echo date('F j, Y', strtotime($row_weekly_transactions['date'])); ?></s>
															</td>
															<td><span class="fs-16 text-black font-w600">+RM <?php echo number_format($row_weekly_transactions['price'], 2); ?></span></td>
															<td> 
																<span class="<?php echo $status_class_weekly; ?> fs-16 font-w500 text-end d-block">
																	<?php echo ucfirst($row_weekly_transactions['status']); ?>
																</span>
															</td>
														</tr>
													<?php endwhile; ?>
                								<?php else: ?>
													<tr><td colspan="5">No recent transactions found.</td></tr>
                								<?php endif; ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane" id="Today" role="tabpanel">
									<div class="table-responsive">
										<table class="table table-responsive-md card-table transactions-table">
											<tbody>
											<?php if ($result_today_transactions->num_rows > 0): ?>
												<?php while ($row_today_transactions = $result_today_transactions->fetch_assoc()): 
													$status_class_today = ''; 

													if ($row_today_transactions['status'] === 'in progress') {
														$status_class_today = 'text-light';
													} elseif ($row_today_transactions['status'] === 'completed') {
														$status_class_today = 'text-success';
													} elseif ($row_today_transactions['status'] === 'canceled') {
														$status_class_today = 'text-danger';
													}
												?>
													<tr>
														<td>
															<svg class="bgl-danger tr-icon" width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
																<g><path d="M35.2219 19.0125C34.8937 19.6906 35.1836 20.5109 35.8617 20.8391C37.7484 21.7469 39.3453 23.1578 40.4828 24.9242C41.6476 26.7344 42.2656 28.8344 42.2656 31C42.2656 37.2125 37.2125 42.2656 31 42.2656C24.7875 42.2656 19.7344 37.2125 19.7344 31C19.7344 28.8344 20.3523 26.7344 21.5117 24.9187C22.6437 23.1523 24.2461 21.7414 26.1328 20.8336C26.8109 20.5055 27.1008 19.6906 26.7726 19.007C26.4445 18.3289 25.6297 18.0391 24.9461 18.3672C22.6 19.4937 20.6148 21.2437 19.2094 23.4422C17.7656 25.6953 17 28.3094 17 31C17 34.7406 18.4547 38.257 21.1015 40.8984C23.743 43.5453 27.2594 45 31 45C34.7406 45 38.257 43.5453 40.8984 40.8984C43.5453 38.2516 45 34.7406 45 31C45 28.3094 44.2344 25.6953 42.7851 23.4422C41.3742 21.2492 39.389 19.4937 37.0484 18.3672C36.3648 18.0445 35.55 18.3289 35.2219 19.0125Z" fill="#FF2E2E"></path><path d="M36.3211 30.2726C36.589 30.0047 36.7203 29.6547 36.7203 29.3047C36.7203 28.9547 36.589 28.6047 36.3211 28.3367L32.8812 24.8969C32.3781 24.3937 31.7109 24.1203 31.0055 24.1203C30.3 24.1203 29.6273 24.3992 29.1297 24.8969L25.6898 28.3367C25.1539 28.8726 25.1539 29.7367 25.6898 30.2726C26.2258 30.8086 27.0898 30.8086 27.6258 30.2726L29.6437 28.2547L29.6437 36.0258C29.6437 36.7804 30.2562 37.3929 31.0109 37.3929C31.7656 37.3929 32.3781 36.7804 32.3781 36.0258L32.3781 28.2492L34.3961 30.2672C34.9211 30.8031 35.7851 30.8031 36.3211 30.2726Z" fill="#FF2E2E"></path></g>
															</svg>
														</td>
														<td style="width: 170px;">
															<h6 class="fs-16 font-w600 mb-0"><a href="javascript:void(0);" class="text-black">
																<?php echo $row_today_transactions['userId']; ?>
															</a></h6>
															<span class="fs-14"><?php echo $row_today_transactions['method']; ?></span>
														</td>
														<td style="width: 260px;">
															<span class="fs-16 text-black font-w600 mb-0"><?php echo date('F j, Y', strtotime($row_today_transactions['date'])); ?></s>
														</td>
														<td><span class="fs-16 text-black font-w600">+RM <?php echo number_format($row_today_transactions['price'], 2); ?></span></td>
														<td> 
															<span class="<?php echo $status_class_today; ?> fs-16 font-w500 text-end d-block">
																<?php echo ucfirst($row_today_transactions['status']); ?>
															</span>
														</td>
													</tr>
												<?php endwhile; ?>
											<?php else: ?>
												<tr><td colspan="5">No recent transactions found.</td></tr>
											<?php endif; ?>
											</tbody>
										</table>
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