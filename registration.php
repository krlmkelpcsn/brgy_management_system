<?php
	include 'content/head.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="description" content="<?php echo $web_name; ?>" />
	<meta property="og:title" content="<?php echo $web_name; ?>" />
	<meta property="og:description" content="<?php echo $web_name; ?>" />
	<meta name="og:image" content="images/preview.png" align="middle"/>
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="assets/images/<?php echo $web_icon; ?>.png" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/<?php echo $web_icon; ?>.png" />
	<title><?php echo $web_name; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/css/assets.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/calendar/fullcalendar.css">
	<link rel="stylesheet" type="text/css" href="assets/css/typography.css">
	<link rel="stylesheet" type="text/css" href="assets/css/shortcodes/shortcodes.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
</head>
<?php include 'assets/css/color/color-1.php';  ?>
<style type="text/css">
	ul {
	  list-style-type: none; /* Remove bullets */
	  padding: 0; /* Remove padding */
	  margin: 0; /* Remove margins */
	}
	.btn:active, .btn:hover, .btn:focus {
		color: black!important;
	}
</style>
<body id="bg">
<div class="page-wraper">
	<?php include 'content/navigation.php'; ?>
    <div class="page-content bg-white">
        <div class="page-banner ovbl-dark" style="background-image:url(assets/images/cover.jpg);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Resident Registration</h1>
				 </div>
            </div>
        </div>
		<div class="breadcrumb-row">
			<div class="container">
				<ul class="list-inline">
					<li><a href="index">Home</a></li>
					<li>Registration</li>
				</ul>
			</div>
		</div>
		<div class="content-block" style="margin-top:-40px;">
           <div class="section-area section-sp2">
                <div class="container">
					 <div class="pricingtable-row">
						<div class="row justify-content-center">
						    <h2>FILL OUT THE REGISTRATION FORM</h2>
						    <form class="" method="POST" enctype="multipart/form-data">
	                                <div class="row">
														<?php

															$id_counter = $model->fetchIdCounter();

															if ($id_counter == false) {
																$id_counter = 1;
																$checker = 0;
															}

															else {
																$checker = 1;
															}

														?>
														<input class="form-control" type="hidden" name="r_id" value="<?php echo 'BC-'.date("Y").'-'.str_pad($id_counter + 1, 4, "0", STR_PAD_LEFT); ?>" readonly>
														<div class="form-group col-4">
															<label class="col-form-label">First Name</label>
															<input class="form-control" type="text" name="fname" required maxlength="30">
														</div>
														<div class="form-group col-4">
															<label class="col-form-label">Middle Name</label>
															<input class="form-control" type="text" name="mname" maxlength="30">
														</div>
														<div class="form-group col-4">
															<label class="col-form-label">Last Name</label>
															<input class="form-control" type="text" name="lname" required maxlength="30">
														</div>
														<div class="form-group col-4">
															<label class="col-form-label">Gender</label>
															<select class="form-control" name="gender" readonly>
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select>
														</div>
														<div class="form-group col-4">
															<label class="col-form-label">Birth Date</label>
															<input class="form-control" type="date" name="bdate" required>
														</div>
														<div class="form-group col-4">
															<label class="col-form-label">Birth Place</label>
															<input class="form-control" type="text" name="bplace" required maxlength="30">
														</div>

														<div class="form-group col-4">
															<label class="col-form-label">Contact</label>
															<input class="form-control" type="text" name="contact" maxlength="12" placeholder="09XX-XXX-XXXX" value="N/A">
														</div>
														<div class="form-group col-4">
															<label class="col-form-label">Civil Status</label>
															<select class="form-control" name="civil_status">
																<option value="Single">Single</option>
																<option value="Married">Married</option>
																<option value="Separated">Separated</option>
																<option value="Widowed">Widowed</option>
															</select>
														</div>

													
														<div class="form-group col-4">
															<label class="col-form-label">Occupation</label>
															<input class="form-control" type="text" name="occupation"  maxlength="30" value="N/A">
														</div>
														<div class="form-group col-3">
															<label class="col-form-label">Voter Status</label>
															<select class="form-control" name="resident_status">
																<option value="No">No</option>
																<option value="Yes">Yes</option>
															</select>
														</div>
														<div class="form-group col-3">
															<label class="col-form-label">Precinct No. (If Voter)</label>
															<input class="form-control" type="text" name="precinct"  maxlength="30" value="">
														</div>
														<div class="form-group col-3">
															<label class="col-form-label">Purok</label>
															<select class="form-control" name="address3">
																<option value="01">Sitio 01</option>
                                                                <option value="02">Sitio 02</option>
                                                                <option value="03">Sitio 03</option>
                                                                <option value="04">Sitio 04</option>
                                                                <option value="05">Sitio 05</option>
                                                                <option value="06">Sitio 06</option>
                                                                <option value="07">Sitio 07</option>
                                                                <option value="08">Sitio 08</option>
                                                                <option value="09">Sitio 09</option>
                                                                <option value="10">Sitio 10</option>
															</select>
														</div>
														<div class="form-group col-3">
															<label class="col-form-label">Resident Since</label>
															<input class="form-control" type="number" name="res_since" required maxlength="4">
														</div>
														<div class="form-group col-6">
															<label class="col-form-label">Email</label>
															<input class="form-control" type="email" name="email" maxlength="40" required>
														</div>
														<div class="form-group col-6">

															<label class="col-form-label">Password 	<input  type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'"    id="rememberme" class="filled-in chk-col-pink">
 															<label for="rememberme">Show </label></label>
															<input id="password"  class="form-control" type="password" name="password"
															pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain one number and one uppercase and lowercase letter, and at least 8 or more characters" 
															 required>
														</div>
														
														<div class="form-group col-7">
															<label class="col-form-label">Personal Income</label>
															<select class="form-control" name="income">
															    <option value="1">Below PHP 11,000</option>
                                                                <option value="2">PHP 11,000 to PHP 22,000</option>
                                                                <option value="3">PHP 22,000 to PHP 44,000</option>
                                                                <option value="4">PHP 44,000 to PHP 77,000</option>
                                                                <option value="5">PHP 77,001 to PHP 131,000</option>
                                                                <option value="6">PHP 131,001 to PHP 220,000</option>
                                                                <option value="7">Above 220,000</option>
															</select>
														</div>
														<div class="form-group col-5">
															<label class="col-form-label">Family Head</label>
															<select class="form-control" name="family">
																<option value="No">No</option>
																<option value="Yes">Yes</option>
															    
															</select>
														</div>
														<div class="form-group col-12">
															<label class="col-form-label">Resident Status</label>
															<div class="form-check">
                                                              <input class="form-check-input" type="radio" name="special_status" id="radio1" checked value="">
                                                              <label class="form-check-label" for="radio1">
                                                                None
                                                              </label>
                                                            </div>
                                                            
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="radio" name="special_status" id="radio2" value="1">
                                                              <label class="form-check-label" for="radio2">
                                                                PWD
                                                              </label>
                                                            </div>
                                                            
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="radio" name="special_status" id="radio3" value="2">
                                                              <label class="form-check-label" for="radio3">
                                                                Solo Parent
                                                              </label>
                                                            </div>
                                                            
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="radio" name="special_status" id="radio4" value="3">
                                                              <label class="form-check-label" for="radio4">
                                                                Senior Citizen
                                                              </label>
                                                            </div>
														</div>

														<div class="form-group col-12">
															<center>
																<img id="display-img-" style="width: 300px; height: 180px; object-fit: cover;">
															</center>
														</div>

														<div class="form-group col-12">
															<center><label class="col-form-label">Attach 2x2 Pic</label><br>
															<input type="file" name="profile" accept="image/*" onchange="readURL(this, '')" style="border: 0px; padding: 0px;" required></center>
														</div>

														<div class="form-group col-12">
															<center>
																<label class="col-form-label">Attach Valid ID1</label><br>
																<input 
																	type="file" 
																	name="id1" 
																	accept="image/*" 
																	onchange="readURL(this, '')" 
																	style="border: 0px; padding: 0px;" 
																	multiple 
																	required>
															</center>
														</div>
														<div class="form-group col-12">
															<center>
																<label class="col-form-label">Attach Valid ID2</label><br>
																<input 
																	type="file" 
																	name="id2" 
																	accept="image/*" 
																	onchange="readURL(this, '')" 
																	style="border: 0px; padding: 0px;" 
																	multiple 
																	required>
															</center>
														</div>
														
														<div class="form-group col-10">
														    <i>
															Please be informed that your registration to Barangay Poblacion portal will be reviewed. We will notify you via email regarding your account status.</i>
														</div>
														<div class="form-group col-2">
															<input type="submit" class="btn btn-block green radius-xl" name="add_resident" value="REGISTER NOW">
														</div>
														<div class="form-group col-12">
														    <br><br>
														    <center><a href='residents.php'>Back to Login</a></center>
														    
														</div>

								</div>
													</div>
													</form>
													
													
													<?php
									$category = 0;
									$status = 1;
									if (isset($_POST['add_resident'])) {
										$r_id = $_POST['r_id'];
										$fname = $_POST['fname'];
										$mname = isset($_POST['mname']) ? $_POST['mname'] : "N/A";
										$lname = $_POST['lname'];
										$time = strtotime($_POST['bdate']);
										$bdate = date('Y-m-d', $time);
										$gender = $_POST['gender'];
										$civil_status = $_POST['civil_status'];
										$resident_status = $_POST['resident_status'];
										$address1 = "";
										$address2 = "";
										$address3 = $_POST['address3'];
										$bplace = $_POST['bplace'];
										$occupation = $_POST['occupation'];
										//$ext = $_POST['ext'];
										$res_since = $_POST['res_since'];
										$date = date("Y-m-d H:i:s");
										$contact = isset($_POST['contact']) ? $_POST['contact'] : "N/A";
										
										$income = $_POST['income'];
										$family = $_POST['family'];
										
										$precinct = $_POST['precinct'];
										$special_status = $_POST['special_status'];
										
										$path = 'assets/images/resident-picture/';
										$temp = $_FILES["profile"]["tmp_name"];
										$base = $_FILES["profile"]["name"];
										move_uploaded_file($temp, $path . $base);

										$temp = $_FILES["id1"]["tmp_name"];
										$base1 = $_FILES["id1"]["name"];
 										move_uploaded_file($temp, $path . $base1);
 										
										 $temp = $_FILES["id2"]["tmp_name"];
										 $base2 = $_FILES["id2"]["name"];
										 move_uploaded_file($temp, $path . $base2);

                                        

										$email = $_POST['email'];
										$digits_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);


											$result = $model->addResidentRegister($address3, $bplace, $occupation, $fname, $mname, $lname, $bdate, $gender, $civil_status, $address1, $address2, $res_since, $date, $resident_status, $contact, $email, $digits_hash, $income, $family, $precinct, $special_status, $unique);

											$res = my_query('SELECT * FROM residents ORDER BY id DESC LIMIT 1');
											if ($row = $res->fetch()) {
												$bdate =$row['birth_date'];
												$age = date('d/m/Y', strtotime(str_replace('-', '/', $bdate)));
												$age= dob($age);
 												db_update('residents',['prof_pic'=>$base,'id1'=>$base1,'id2'=>$base2,'age'=>$age],['id'=>$row['id']]);
											}

											if ($checker == 0 && $result == true) {
												$model->updateIdCounter();
												$model->updateIdCounter();
											}

											else if ($checker == 1 && $result == true) {
												$model->updateIdCounter();
											}
											
											echo "<script>window.open('registration-success', '_self')</script>";

										
									}

								?>
						</div>
					</div>
				</div>
            </div>
			<?php include 'content/footer.php' ?>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="assets/vendors/magnific-popup/magnific-popup.js"></script>
<script src="assets/vendors/counter/waypoints-min.js"></script>
<script src="assets/vendors/counter/counterup.min.js"></script>
<script src="assets/vendors/imagesloaded/imagesloaded.js"></script>
<script src="assets/vendors/masonry/masonry.js"></script>
<script src="assets/vendors/masonry/filter.js"></script>
<script src="assets/vendors/owl-carousel/owl.carousel.js"></script>
<script src='assets/vendors/scroll/scrollbar.min.js'></script>
<script src="assets/js/functions.js"></script>
<script src="assets/vendors/chart/chart.min.js"></script>
<script src="assets/js/admin.js"></script>
<script src='assets/vendors/calendar/moment.min.js'></script>
<script src='assets/vendors/calendar/fullcalendar.js'></script>
<script src='assets/vendors/switcher/switcher.js'></script>
<script type="text/javascript">
			function readURL(input, id) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#display-img-' + id).attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}
			}
		</script>
</body>
</html>
