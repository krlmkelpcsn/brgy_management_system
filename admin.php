<?php

	session_start();
	include('global/model.php');

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

	if (isset($_SESSION['org_sess'])) {
		echo "<script>window.open('admin/index.php','_self');</script>";
	}

	if (isset($_POST['submit'])) {
		if (!isset($_COOKIE['orlimited'])) {
			$uname = $_POST['username'];
			$pword = $_POST['password'];
			$position = $_POST['position'];
            
            $model = new Model();
            
            if ($position == '0'){
                $model->orgStructureSignIn($uname, $pword, $position);
            }
            else {
                
                $model->orgStaffSignIn($uname, $pword);
                
            }
		}

		else {
			echo "<script>alert('Wait before trying again!')</script>";
		}
	}

?>
<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="" />
		<meta name="author" content="" />
		<meta name="robots" content="" />
		<meta name="format-detection" content="telephone=no">
		
		<link rel="icon" href="assets/images/<?php echo $web_icon; ?>.png" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="assets/images/<?php echo $web_icon; ?>.png" />
		<title><?php echo $web_name; ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="styles/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="styles/assets/css/typography.css">
		<link rel="stylesheet" type="text/css" href="styles/assets/css/shortcodes/shortcodes.css">
		<link rel="stylesheet" type="text/css" href="styles/assets/css/style.css">
		<style type="text/css">
			.red-hover:hover {
				background-color: #e7be13!important
			}
			.account-heads {
				position: sticky;
				left:0;
				top:0;
				z-index: 1;
				width: 500px;
				min-width: 500px;
				height: 100vh;
				background-position: center;
				text-align: center;
				align-items: center;
				display: flex;
				vertical-align: middle;
			}
			.account-heads a{
				display:block;
				width:100%;
			}
			.account-heads:after{
				opacity:0.9;
				content:"";
				position:absolute;
				left:0;
				top:0;
				z-index:-1;
				width:100%;
				height:100%;
				background: transparent;
			}

			@media only screen and (max-width: 1200px) {
				.account-heads{
					width: 350px;
					min-width: 350px;
				}

			}

			@media only screen and (max-width: 991px) {
				.account-heads {
					width: 100%;
					min-width: 100%;
					height: 200px;
				}
			}
			
            .btn:active, .btn:hover, .btn:focus {
			    color: black!important;
			}
			.qq:hover {
				color: white!important;
			}
		</style>
	</head>
	<?php include 'assets/css/color/color-1.php';  ?>
	<body id="bg">
		<div class="page-wraper">
			<!--<div id="loading-icon-bx"></div>-->
			<div class="account-form">
				<div class="account-heads" style="background-image:url(assets/images/bg2.png);"></div>
				<div class="account-form-inner">
					<div class="account-container">
						<div class="heading-bx left">
							<h2 class="title-head">Admin<span> Access</span></h2>
						</div>	
 				
						<form class="contact-bx" method="POST">
							<div class="row placeani">
								<div class="col-lg-12">
									<div class="form-group">
										<div class="input-group">
											<label>Your Email</label>
											<input name="username" type="email" class="form-control" onfocus="this.value=''" autocomplete="off" required>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<div class="input-group"> 
											<label>Your Password</label>
  											<input name="password" id ="password" type="password" class="form-control" title="Wrong Password" 
 											 onfocus="this.value=''" required>
											
 											

                  
										</div>
									</div>
								</div>

								<div class="col-12">
									<div class="form-group">
  										<div >  
										<input  type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'"    id="rememberme" class="filled-in chk-col-pink">
										<label for="rememberme">Show password</label>
                
										</div>
										</div>
										</div>

								<div class="col-lg-12">
								    <div class="form-group">
								        <select class="form-control" name="position" required="">
								            <option value="0">Barangay Admin</option>
								            <option value="1">Barangay Staff</option>
								            
											<!--<option value="1">Barangay Secretary</option>-->
											<!--<option value="2">Barangay Treasurer</option>-->
											<!--<option value="3">Barangay Kagawad</option>-->
											<!--<option value="4">SK Chairperson</option>-->
											<!--<option value="5">Chief Tanod</option>-->
										</select>
								    </div>
								</div>
								<div class="col-sm-12">
									<div class="form-group form-forget">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
											<label class="custom-control-label" for="customControlAutosizing">Remember me</label>
										</div>
										<a href="residents.php" class="ml-auto">Resident Login</a>
									</div>
								</div>
								<div class="col-lg-12 m-b30" align="">
									<button name="submit" type="submit" value="Submit" class="red-hover btn btn-block qq">Login</button>
								</div>
							</div>
							<center>
								Back to <a href="index.php">Homepage</a>
							</center>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script src="styles/assets/js/jquery.min.js"></script>
		<script src="styles/assets/vendors/bootstrap/js/popper.min.js"></script>
		<script src="styles/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="styles/assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="styles/assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
		<script src="styles/assets/vendors/magnific-popup/magnific-popup.js"></script>
		<script src="styles/assets/vendors/counter/waypoints-min.js"></script>
		<script src="styles/assets/vendors/counter/counterup.min.js"></script>
		<script src="styles/assets/vendors/imagesloaded/imagesloaded.js"></script>
		<script src="styles/assets/vendors/masonry/masonry.js"></script>
		<script src="styles/assets/vendors/masonry/filter.js"></script>
		<script src="styles/assets/vendors/owl-carousel/owl.carousel.js"></script>
		<script src="styles/assets/js/functions.js"></script>
		<script src="styles/assets/js/contact.js"></script>
	</body>
</html>
