<?php
	
	session_start();

	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['sess2'])) {
		echo "<script>window.open('../','_self');</script>";
	}

	use PHPMailer\PHPMailer\PHPMailer;

	$verification_key = random_int(100000, 999999);
	$hashed_key = password_hash($verification_key, PASSWORD_DEFAULT);

	require_once "PHPMailer/PHPMailer.php";
	require_once "PHPMailer/SMTP.php";
	require_once "PHPMailer/Exception.php";

	$mail = new PHPMailer();

	$mail->isSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = true;
	$mail->Username = "brgyvictoriareyes01@gmail.com";
	$mail->Password = "123456789QWERTY";
	$mail->Port = 465;
	$mail->SMTPSecure = "ssl";

	$mail->isHTML(true);
	$mail->setFrom("brgy_victoriareyes2021@gmail.com", 'Account Verification');
	$mail->addAddress($r_email);
	$mail->Subject = 'Brgy. Victoria Reyes - Please take action';
	$mail->Body = "Hello, $r_fname,
	<br><br>
	To finish setting up your account, we just need to verify if this email address is yours.
	<br><br>
	To verify your email address, use this code: $verification_key
	<br><br>
	or
	<br><br>
	<a href='https://brgyvictoriareyesinfosys.tech/residents/homepage?id=1' target='_blank'>Click here</a> to verify your account now.
	<br><br>
	If you didn't make this request, ignore this email. Someone else might have typed your email address by mistake.
	<br><br>
	Thank you,<br>
	Barangay Cruz
	";

	if ($mail->send()) {

	} 

	else {
		echo $mail->ErrorInfo;
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

		<meta name="description" content="" />

		<meta property="og:title" content="" />
		<meta property="og:description" content="" />
		<meta property="og:image" content="" />
		<meta name="format-detection" content="telephone=no">

		<link rel="icon" href="../assets/images/icon.png" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="../assets/images/icon.png" />

		<title>Barangay Cruz</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/vendors/calendar/fullcalendar.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/typography.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/shortcodes/shortcodes.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dashboard.css">
	</head>
	<style type="text/css">
		.btn.dropdown-toggle.btn-default:hover {
			color: #000!important;
		}

		.btn.dropdown-toggle.btn-default:focus {
			color: #000!important;
		}


		.widget-card .icon {
			position: absolute;
			top: auto;
			bottom: -20px;
			right: 5px;
			z-index: 0;
			font-size: 65px;
			color: rgba(0, 0, 0, 0.15);
		}
		.col-xs-5ths,
		.col-sm-5ths,
		.col-md-5ths,
		.col-lg-5ths {
				position: relative;
				min-height: 1px;
				padding-right: 15px;
				padding-left: 15px;
		}

		.col-xs-5ths {
				width: 20%;
				float: left;
		}

		@media (min-width: 768px) {
				.col-sm-5ths {
						width: 20%;
						float: left;
				}
		}

		@media (min-width: 992px) {
				.col-md-5ths {
						width: 20%;
						float: left;
				}
		}

		@media (min-width: 1200px) {
				.col-lg-5ths {
						width: 20%;
						float: left;
				}
		}
	</style>
	<?php include '../assets/css/color/color-1.php';  ?>
	<body class="ttr-opened-sidebar ttr-pinned-sidebar" style="background-color: #F3F3F3;">

		<?php include 'navbar.php'; ?>

		<div class="ttr-sidebar">
			<div class="ttr-sidebar-wrapper content-scroll">
				
				<?php include 'sidebar.php'; ?>

				<nav class="ttr-sidebar-navi">
					<ul>
						<li style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px; background-color: #e0e0e0; margin-top: 0px; margin-bottom: 0px;">
							<span class="ttr-label" style="color: black; font-weight: 500;">Main Navigation</span>
						</li>
						<li class="show" style="margin-top: 0px;">
							<a href="homepage" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-home"></i></span>
								<span class="ttr-label">Dashboard</span>
							</a>
						</li>
						<li>
							<a href="clearance" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-agenda"></i></span>
								<span class="ttr-label">Request Services</span>
							</a>
						</li>
			            <li>
							<a href="messages" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-envelope"></i></span>
								<span class="ttr-label">Messages</span>
							</a>
						</li>
						<li class="ttr-seperate"></li>
					</ul>
				</nav>
			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Settings</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-settings"></i>Change Password</li>
					</ul>
				</div> 
				
				<?php include 'widget.php'; ?>

				<div class="row">
							<div class="col-lg-12 m-b30">
							    <form method="POST" id="verify-form">
									<div class="row">
										<div class="col-lg-6">
											<div class="new-user-list">
												<h3><?php echo ucwords(strtolower($fname)); ?> <?php echo ucwords(strtolower($mname)); ?> <?php echo ucwords(strtolower($lname)); ?></h3>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Verification Code</label>
													<div class="col-sm-7">
														<input class="form-control" type="text" style="background-color: white;" name="code" id="code" minlength="6" maxlength="6" required>
													</div>
												</div>
											</div>
											<button type="submit" name="verify" class="btn green radius-xl"><i class="ti-unlock"></i><span>&nbsp;&nbsp;VERIFY EMAIL</span></button>
											<div style="padding: 5px;"></div>
										</div>
										<div class="col-lg-6">

										</div>
									</div>
								</form>
								<div id="message"></div>

							</div>
						</div>
			</div>
		</main>
		<script src="../dashboard/assets/js/jquery.min.js"></script>
		<script type="text/javascript">
			$('#verify-form').submit( function(e) {
				var code = $('#code').val();
				var hashed_code = '<?php echo $hashed_key; ?>';
				var account_id = '<?php echo $r_id_number; ?>';

				$.ajax({
					url: 'verification.php',
					method: 'POST',
					data: {
						code: code,
						hashed_code: hashed_code,
						account_id: account_id
					},
					success:function(data) {
						$('#message').html(data);
					}
				});

				e.preventDefault();
			});
		</script>
		<script src="../dashboard/assets/vendors/bootstrap/js/popper.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
		<script src="../dashboard/assets/vendors/magnific-popup/magnific-popup.js"></script>
		<script src="../dashboard/assets/vendors/counter/waypoints-min.js"></script>
		<script src="../dashboard/assets/vendors/counter/counterup.min.js"></script>
		<script src="../dashboard/assets/vendors/imagesloaded/imagesloaded.js"></script>
		<script src="../dashboard/assets/vendors/masonry/masonry.js"></script>
		<script src="../dashboard/assets/vendors/masonry/filter.js"></script>
		<script src="../dashboard/assets/vendors/owl-carousel/owl.carousel.js"></script>
		<script src='../dashboard/assets/vendors/scroll/scrollbar.min.js'></script>
		<script src="../dashboard/assets/js/functions.js"></script>
		<script src="../dashboard/assets/vendors/chart/chart.min.js"></script>
		<script src="../dashboard/assets/js/admin.js"></script>
		<script src='../dashboard/assets/vendors/calendar/moment.min.js'></script>
		<script src='../dashboard/assets/vendors/calendar/fullcalendar.js'></script>
		<script type="text/javascript">
			var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

			function validatePassword() {
				if(password.value != confirm_password.value) {
					confirm_password.setCustomValidity("Passwords Don't Match");
				} 

				else {
					confirm_password.setCustomValidity('');
				}
			}

			password.onchange = validatePassword;
			confirm_password.onkeyup = validatePassword;
		</script>
	</body>

</html>