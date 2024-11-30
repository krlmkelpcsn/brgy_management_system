<?php

	session_start();
	include('../global/model.php');

	$model = new Model();
	$rows = $model->website_details();

	if (!empty($rows)) {
		foreach ($rows as $row) {
			$web_name = $row['web_name'];
			$web_code = strtoupper($row['web_code']);
			$web_header = $row['web_header'];
			$primary_color = $row['primary_color'];
			$secondary_color = $row['secondary_color'];
			$web_icon = $row['web_icon'];
		}
	}
	
	include('department.php');

	if (empty($_SESSION['sess2'])) {
		echo "<script>window.open('../','_self');</script>";
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="" />
		<meta name="author" content="" />
		<meta name="robots" content="" />
		<meta name="format-detection" content="telephone=no">
		
		<link rel="icon" href="../assets/images/<?php echo $web_icon; ?>.png" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="../assets/images/<?php echo $web_icon; ?>.png" />
		<title><?php echo $web_name; ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="../styles/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="../styles/assets/css/typography.css">
		<link rel="stylesheet" type="text/css" href="../styles/assets/css/shortcodes/shortcodes.css">
		<link rel="stylesheet" type="text/css" href="../styles/assets/css/style.css">
		<style type="text/css">
			.red-hover:hover {
				background-color: #8d0e2b!important
			}

			.btn.dropdown-toggle:hover, .btn.dropdown-toggle:focus {
				color: black;
			}
		</style>
	</head>
	<?php include '../assets/css/color/color-1.php'; ?>
	<body id="bg">
		<div class="page-wraper">
			<div id="loading-icon-bx"></div>
			<div class="account-form">
				<div class="account-head" style="background-image:url(../assets/images/bg2.png);"></div>
				<div class="account-form-inner">
					<div class="account-container">
						<div class="heading-bx left">
							<h2 class="title-head">Account <span>Verification</span></h2>
							<span>Verify now before you can login.</span>
						</div>	
						<form class="contact-bx" method="POST">
							<div class="row placeani">
								<div class="col-lg-12">
									<div class="form-group">
										<span style="font-size: 22px;color: black;"><?php echo ucwords(strtolower($r_fname)); ?> <?php echo ucwords(strtolower($r_mname)); ?> <?php echo ucwords(strtolower($r_lname)); ?></span>
										<span style="font-size: 18px;color: black;"><?php echo $r_email; ?></span>
									</div>
								</div>
								<div class="col-lg-12 m-b30">
									<a href="verify-now" class="red-hover btn button-md" style="background-color: #267621!important;"><i class="ti-unlock"></i><span>&nbsp;&nbsp;Verify Now</a>
								</div>
								<div class="col-lg-12 m-b30"><a href="logout.php">Back to Login Page</a></div>
								<div class="col-lg-12 m-b30">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script src="../styles/assets/js/jquery.min.js"></script>
		<script src="../styles/assets/vendors/bootstrap/js/popper.min.js"></script>
		<script src="../styles/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="../styles/assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../styles/assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
		<script src="../styles/assets/vendors/magnific-popup/magnific-popup.js"></script>
		<script src="../styles/assets/vendors/counter/waypoints-min.js"></script>
		<script src="../styles/assets/vendors/counter/counterup.min.js"></script>
		<script src="../styles/assets/vendors/imagesloaded/imagesloaded.js"></script>
		<script src="../styles/assets/vendors/masonry/masonry.js"></script>
		<script src="../styles/assets/vendors/masonry/filter.js"></script>
		<script src="../styles/assets/vendors/owl-carousel/owl.carousel.js"></script>
		<script src="../styles/assets/js/functions.js"></script>
		<script src="../styles/assets/js/contact.js"></script>
	</body>
</html>
