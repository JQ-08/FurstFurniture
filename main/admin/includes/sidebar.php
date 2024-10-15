<?php
$currentPage = basename($_SERVER['PHP_SELF']);

// Check which page is active
$isUserActive = ($currentPage == 'user_admin.php');
$isProductsActive = ($currentPage == 'products_admin.php');
$isProductsDetailsActive = ($currentPage == 'products_details_admin.php');
$isOrdersActive = ($currentPage == 'orders_admin.php');
?>

<!--**********************************
			Sidebar start
		***********************************-->
<div class="dlabnav">
	<div class="dlabnav-scroll">
		<ul class="metismenu" id="menu">
			<li class="dropdown header-profile">
				<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
					<img src="images/ion/man (1).png" width="20" alt="" />
					<div class="header-info ms-3">
						<span class="font-w600">Hi,<b> admin</b></span>
						<small class="text-end font-w400"
							onclick="if(confirm('Are you sure you want to logout?')){setTimeout(function(){ alert('You\'ve been logged out. Redirecting to home page...'); window.location.href='../user/index.php'; }, 1000); } else {event.preventDefault();}">Logout</small>
					</div>
				</a>
			</li>

			<li>
				<a href="../admin/index.php" aria-expanded="false" style="display: flex; align-items: center;">
					<span class="material-symbols-outlined">dashboard</span>
					<span class="nav-text" style="padding-left:15px;">Dashboard</span>
				</a>
			</li>

			<!-- User section -->
			<li class="<?= $isUserActive ? 'mm-active' : '' ?>">
				<a href="../admin/user_admin.php" aria-expanded="false" style="display: flex; align-items: center;">
					<span class="material-symbols-outlined">person</span>
					<span class="nav-text" style="padding-left:15px;">User</span>
				</a>
			</li>

			<!-- Products section -->
			<li class="<?= ($isProductsActive || $isProductsDetailsActive) ? 'mm-active' : '' ?>">
				<a href="../admin/products_admin.php" aria-expanded="false" style="display: flex; align-items: center;">
					<span class="material-symbols-outlined">package_2</span>
					<span class="nav-text" style="padding-left:15px;">Products</span>
				</a>
			</li>

			<!-- Orders section -->
			<li class="<?= $isOrdersActive ? 'mm-active' : '' ?>">
				<a href="../admin/orders_admin.php" aria-expanded="false" style="display: flex; align-items: center;">
					<!-- <i class="fa-solid fa-clipboard-list"></i> -->
					<span class="material-symbols-outlined">inventory</span>
					<span class="nav-text" style="padding-left:15px;">Orders</span>
				</a>
			</li>
		</ul>
	</div>
</div>
<!--**********************************
			Sidebar end
		***********************************-->