<?php
	
	session_start();

	include('../global/model.php');
	$model = new Model();
	include('department.php');

	
	$id = isset($_GET['id']) ? $_GET['id'] : '';
	
	        $rows = $model->displayDepartment2($id);

			if (!empty($rows)) {
			foreach ($rows as $dep) {
			    
			$r_id_number = $dep['id_number'];
			$r_fname = $dep['fname'];
			$r_mname = $dep['mname'];
			$r_lname = $dep['lname'];
			$r_ext = $dep['ext'];
			$r_gender = $dep['gender'];
			$r_email = $dep['email'];
			$r_contact = $dep['contact_number'];
			$r_occupation = $dep['occupation'];
			$r_civil_status = $dep['civil_status'];
			$r_birth_date = $dep['birth_date'];
			$r_birth_place = $dep['birth_place'];
			$r_address = $dep['address'];
			$r_address2 = $dep['address2'];
			$r_address3 = $dep['address3'];
			$r_resident_since = $dep['resident_since'];
			$r_password = $dep['password'];
			$email_verif = $dep['email_verif'];
			$prof_pic = $dep['prof_pic'];
			
			$income = $dep['income'];
			$family = $dep['family'];
			
			$lgbtq = $dep['lgbtq'];
			$pwd = $dep['pwd'];
			$pwd_specify = $dep['pwd_specify'];
			$senior = $dep['senior'];
					}
				}

				
				if($prof_pic == "") {
				    $prof_pic = "default";
				}
				else {
				    
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

		<title>Update Profile</title>

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
				
				<?php 
			
				include 'sidebar.php';
				
				$page = 'records';
				$secondnav = 'residents';

				include 'nav.php'; 

				?>
				
			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Dashboard</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-user"></i>Update Profile</li>
					</ul>
				</div> 
				
				<?php include 'widget.php'; ?>

				<div class="row">
				            <div class="col-lg-3 m-b30">
				                <br><br>
				                <center><img src="../assets/images/profile-pictures/<?php echo $prof_pic; ?>.jpg" style="width: 250px; height: 250px; border-radius: 50%;object-fit: cover;" alt="User">
				                <hr>

				                
				                </center>
				                
				            </div>
							<div class="col-lg-9 m-b30">
								
										<form class="edit-profile" method="POST">
											<div class="">
											    <div class="form-group row">
													<label class="col-sm-2 col-form-label">Brgy ID Number</label>
													<div class="col-sm-7">
														<input class="form-control" type="text" value="<?php echo $r_id_number; ?>" readonly>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Name</label>
													<div class="col-sm-7">
														<input class="form-control" type="text" value="<?php echo $r_fname.' '.$r_mname.' '.$r_lname.' '.$r_ext; ?>" readonly>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Occupation</label>
													<div class="col-sm-7">
														<input class="form-control" type="text" name="occupation" value="<?php echo $r_occupation; ?>" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Birth Date</label>
													<div class="col-sm-7">
														<input class="form-control" type="date" name="birth-date" value="<?php echo $r_birth_date; ?>" readonly>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Birth Place</label>
													<div class="col-sm-7">
														<input class="form-control" type="text" name="birth-place" value="<?php echo $r_birth_place; ?>" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Gender</label>
													<div class="col-sm-7">
														<select class="form-control" name="gender" required>
															<option value="Male" <?php if ($r_gender == 'Male') { echo 'selected'; } ?>>Male</option>
															<option value="Female" <?php if ($r_gender == 'Female') { echo 'selected'; } ?>>Female</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Civil Status</label>
													<div class="col-sm-7">
														<select class="form-control" name="civil_status" required>
															<option value="Single" <?php if ($r_civil_status == 'Single') { 
															echo 'selected'; } ?>>Single</option>
															<option value="Married" <?php if ($r_civil_status == 'Married') { echo 'selected'; } ?>>Married</option>
															<option value="Separated" <?php if ($r_civil_status == 'Separated') { echo 'selected'; } ?>>Separated</option>
															<option value="Widowed" <?php if ($r_civil_status == 'Widowed') { echo 'selected'; } ?>>Widowed</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Contact Number</label>
													<div class="col-sm-7">
														<input class="form-control" type="text" name="contact-number" value="<?php echo $r_contact; ?>" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Email</label>
													<div class="col-sm-7">
														<input class="form-control" type="text" name="email" value="<?php echo $r_email; ?>" required>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Purok </label>
													<div class="col-sm-7">
													    <select class="form-control" name="purok">
														<option value="<?=$r_address3;?>">Purok <?=$r_address3;?></option>
																<option value="01">Purok 01</option>
                                                                <option value="02">Purok 02</option>
                                                                <option value="03">Purok 03</option>
                                                                <option value="04">Purok 04</option>
                                                                <option value="05">Purok 05</option>
                                                                <option value="06">Purok 06</option>
                                                                <option value="07">Purok 07</option>
                                                                <option value="08">Purok 08</option>
                                                                <option value="09">Purok 09</option>
                                                                <option value="10">Purok 10</option>
                                                                <option value="11">Purok 11</option>
                                                                <option value="12">Purok 12</option>
                                                                <option value="13">Purok 13</option>
                                                                <option value="14">Purok 14</option>
                                                                <option value="15">Purok 15</option>
															
														</select>
													</div>
												</div>

												
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Are you a Senior Citizen?</label>
													<div class="col-sm-7">
														<select class="form-control" name="senior" required>
															<option value="Yes" <?php if ($senior == 'Yes') { echo 'selected'; } ?>>Yes</option>
															<option value="No" <?php if ($senior == 'No') { echo 'selected'; } ?>>No</option>
														</select>
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Resident Since</label>
													<div class="col-sm-7">
														<input class="form-control" type="number" name="resident-since" value="<?php echo $r_resident_since; ?>" max="2023"required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-2">
												</div>
												<div class="col-sm-7">
													<label class="col-sm-2 col-form-label" id="message"></label><br>
													<button name="save_pass" type="submit" class="btn blue radius-xl" style="color: white;"><i class="ti-save"></i> &nbsp; Save changes</button>
													<a href="residents-profile?id=<?php echo $id; ?>" class="btn-secondry radius-xl"><i class="ti-close"></i> &nbsp;  Cancel</a>
												</div>
											</div>
										</form>

										<?php
                                            
                                            if (isset($_POST['save_pass'])) {
												$model->verifyResident($_POST['address3'], $_POST['birth-place'], 
 												$_POST['occupation'],  $_POST['address'],  $r_fname, $r_mname, $r_lname, $_POST['gender'], $_POST['civil_status'],  $_POST['email'],
												 $_POST['contact-number'],  $_POST['birth-date'], $_POST['resident-since'],
												$_SESSION['sess2']);

												echo "<script>alert('Profile has been changed!');window.open('residents-profile?id=".$id."','_self');</script>";
											}


										?>

							</div>
						</div>
			</div>
		</main>
		<script src="../dashboard/assets/js/jquery.min.js"></script>
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
	</body>

</html>