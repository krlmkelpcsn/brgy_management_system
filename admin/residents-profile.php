<?php
	ob_start(); 
	session_start(); 
	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['org_sess'])) {
		echo "<script>window.open('../','_self');</script>";
	}

	$id = isset($_GET['id']) ? $_GET['id'] : '';
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

		<link rel="icon" href="../assets/images/<?php echo $web_icon; ?>.png" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="../assets/images/<?php echo $web_icon; ?>.png" />

		<title>Resident Profile</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/vendors/calendar/fullcalendar.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/typography.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/shortcodes/shortcodes.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dashboard.css">

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
			tbody tr:hover {
				background-color: #d4d4d4;
			}
			ul.dropdown-menu > li {
			    border: 0px!important;
			    margin-bottom: 0px!important;
			    display: block!important;
			}
		</style>
	</head>
	<?php include '../assets/css/color/color-1.php';  ?>
	<body class="ttr-opened-sidebar ttr-pinned-sidebar" style="background-color: #FCFCFC;">

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
		<main class="ttr-wrapper" style="background-color: #FCFCFC;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Residents Management</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-agenda"></i>Resident Profile</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; 
				$rows = $model->displayResidentsProfile($id);

				if (!empty($rows)) {
					foreach ($rows as $row) {
						$id = $row['id'];
						$id_number = $row['id'];
						$first_name = $row['fname'];
						$middle_name = $row['mname'];
						$last_name = $row['lname'];
						$email = $row['email'];
						$contact = $row['contact_number'];
						$address = $row['address'];
						$address2 = $row['address2'];
						$address3 = $row['address3'];
						$date_added = $row['date_registered'];
						$bplace = $row['birth_place'];
						$occupation = $row['occupation'];
						$ext = $row['ext'];
						$civil_status = $row['civil_status'];
						$bd = date('M. d, Y', strtotime($row['birth_date']));
						$bdt = date('Y', strtotime($row['birth_date']));
						$dttt = date("Y");
						$age = $dttt - $bdt;
						$gender = $row['gender'];
						$status = $row['status'];
						$resident_since = $row['resident_since'];
						$mortality_status = $row['mortality'];
						
						$income = $row['income'];
						$family = $row['family'];
					}
					
					if ($status == '5') {
						$id_number = '<span style="color: blue;"><b>PENDING</b></span>';
					}
				}


				?>

				<div class="row">
					<div class="col-lg-5 m-b30">
								<div class="new-user-list">
									<h3><?php echo strtoupper($first_name); ?> <?php echo strtoupper($middle_name); ?> <?php echo strtoupper($last_name); ?> <?php echo strtoupper($ext); ?><br> <small><b>Brgy ID</b>: <?php echo $id_number; ?></small></h3><br>
									<div class="new-user-list">
										<ul>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Email</a>
												</span>
												<span class="new-users-btn">
													<?php echo $email; ?>
												</span>
											</li>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Contact</a>
												</span>
												<span class="new-users-btn">
													<?php echo $contact; ?>
												</span>
											</li>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Gender</a>
												</span>
												<span class="new-users-btn">
													<?php echo $gender; ?>
												</span>
											</li>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Civil Status</a>
												</span>
												<span class="new-users-btn">
													<?php echo $civil_status; ?>
												</span>
											</li>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Occupation</a>
												</span>
												<span class="new-users-btn">
													<?php echo $occupation; ?>
												</span>
											</li>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Birth Date & Age</a>
												</span>
												<span class="new-users-btn">
													<?php echo $bd; ?> - <?php echo $age; ?>yrs old
												</span>
											</li>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Birth Place</a>
												</span>
												<span class="new-users-btn">
													<?php echo $bplace; ?>
												</span>
											</li>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Address</a>
												</span>
												<span class="new-users-btn">
													<?php echo $address; ?>
												</span>
											</li>
											<!--<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Lot</a>
												</span>
												<span class="new-users-btn">
													<?php echo $address2; ?>
												</span>
											</li>-->
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Purok</a>
												</span>
												<span class="new-users-btn">
													<?php echo $address3; ?>
												</span>
											</li>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Resident Since</a>
												</span>
												<span class="new-users-btn">
													<?php echo $resident_since; ?>
												</span>
											</li>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Voter Status</a>
												</span>
												<span class="new-users-btn">
													<?php echo $row['resident_status']; ?>
												</span>
											</li>
											<?php
											    
											    if($row['resident_status'] == "Yes") {
											?>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Precinct No.</a>
												</span>
												<span class="new-users-btn">
													<?php echo $row['precinct']; ?>
												</span>
											</li>
											<?php } ?>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Personal Income</a>
												</span>
												<span class="new-users-btn">
												    <?php 
												    if($income == '1') {
												        echo $income_txt = 'Below PHP 11,000';
												    }
												    else if($income == '2') {
												        echo $income_txt = 'PHP 11,000 to PHP 22,000';
												    }
												    else if($income == '3') {
												        echo $income_txt = 'PHP 22,000 to PHP 44,000';
												    }
												    else if($income == '4') {
												        echo $income_txt = 'PHP 44,000 to PHP 77,000';
												    }
												    else if($income == '5') {
												        echo $income_txt = 'PHP 77,001 to PHP 131,000';
												    }
												    else if($income == '6') {
												        echo $income_txt = 'PHP 131,001 to PHP 220,000';
												    }
												    else if($income == '7') {
												        echo $income_txt = 'Above 220,000';
												    }
												    else {
												        echo $income_txt = '----';
												    }

                                                    ?>      
												</span>
											</li>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Family Head</a>
												</span>
												<span class="new-users-btn">
													<?php 
													
													if($family == '') {
												        echo 'No';
												    }
												    else {
												        echo $family;
												    }
													
													
													?>
												</span>
											</li>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Resident Status</a>
												</span>
												<span class="new-users-btn">
													<?php 
													
													if($row['special_status'] == '') {
												        echo 'No';
												    }
												    else if($row['special_status'] == '1') {
												        echo 'PWD';
												    }
												    else if($row['special_status'] == '2') {
												        echo 'Solo Parent';
												    }
												    else if($row['special_status'] == '3') {
												        echo 'Senior Citizen';
												    }
													
													
													?>
												</span>
											</li>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Mortality</a>
												</span>
												<span class="new-users-btn" style="float: right!important;">
												    
													<?php
													if ($mortality_status == '') {
														echo '<a data-toggle="modal" data-target="#update-mortality"style="color: green;float: right;"><span><b>ALIVE</b></span></a>';
													}
													else {
														echo '<a data-toggle="modal" data-target="#update-mortality"><span style="color: red;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DECEASED</b></span></a><br>';
														
														echo "<span style='font-size: 12px;'>".date('M. d, Y g:i A', strtotime($mortality_status))."</span>";
													}

													?>
													<?php  ?>
												</span>
											</li>
											<li>
												<span class="new-users-text">
													<a href="#" class="new-users-name">Account Status</a>
												</span>
												<span class="new-users-btn">
													<?php
													if ($status == '0') {
														echo '<span style="color: red;"><b>ARCHIVED</b></span>';
													}
													elseif ($status == '1') {
														echo '<span style="color: green;"><b>ACTIVE</b></span>';
													}
													elseif ($status == '5') {
														echo '<span style="color: blue;"><b>PENDING</b></span>';
													}
													elseif ($status == '3') {
														echo '<span style="color: red;"><b>ARCHIVED</b></span>';
													}
													else {
														echo $status;
													}

													?>
												</span>
											</li>
											 <li>
												<span class="new-users-btn">
													<div class="row">
														<div class="col-lg-12">
															<a href=">" class="btn blue radius-xl" style="width: 180px;height: 45px;" data-toggle="modal" data-target="#reset-pw"><i class="ti-lock" style="font-size: 15px;"></i><span style="font-size: 15px;">&nbsp;&nbsp;Reset Password</span></a>
														    &nbsp;
															<a href="update-resident-profile?id=<?php echo $_GET['id']; ?>" class="btn green radius-xl" style="width: 180px;height: 45px;"><i class="ti-marker-alt" style="font-size: 15px;"></i><span style="font-size: 15px;">&nbsp;&nbsp;Update Profile</span></a>
														</div>
													</div>
												</span>
											</li> 
											<div id="reset-pw" class="modal fade" role="dialog">
									<form class="edit-profile m-b30" method="POST">
										<div class="modal-dialog modal-md">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Reset Password</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-12">
															<label class="col-form-label">New Password</label>
															<input class="form-control" type="text" name="new_pw" required maxlength="15">
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<input type="submit" class="btn green radius-xl outline" name="reset-pword" value="Save Changes">
													<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</form>
								</div>
								
								<div id="update-mortality" class="modal fade" role="dialog">
									<form class="edit-profile m-b30" method="POST">
										<div class="modal-dialog modal-md">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Mortality Status</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-12">
															<label class="col-form-label">Status</label>
															<select class="form-control" name="status">
															    <option value="">Alive</option>
															    <option value="1" <?php if ($mortality_status == '') {
														
													}
													else {
														echo 'selected';
													} ?> >Deceased</option></option>
															</select>
															
															
														</div>
														<div class="form-group col-12">
															<label class="col-form-label">Deceased Date</label>
															<input class="form-control" name="d_date" type="datetime-local" value="<?php echo date('Y-m-d\TH:i', strtotime($mortality_status)) ?>" required>

															
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<input type="submit" class="btn green radius-xl outline" name="status-update" value="Save Changes">
													<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<?php 
								
								if (isset($_POST['reset-pword'])) {
                        		    $hashed_password = password_hash($_POST['new_pw'], PASSWORD_DEFAULT);
                        		    $model->verifiedChangePassword($id, $hashed_password);
                        		    
                        		   echo "<script>alert('Password has been reset!');window.open('residents-profile?id=".$id."','_self');</script>";
                        	    }
                        	    
                        	    if (isset($_POST['status-update'])) {
                        	        
                        	        if ($_POST['status'] == '1') {
                        	            $_POST['status'] = $_POST['d_date'];
                        	        }
                        	        else {
                        	            
                        	        }
                        	        
                        		    $model->updateResidentStatus($_POST['status'], $_GET['id']);
                        		    
                        		   echo "<script>alert('Status has been updated!');window.open('residents-profile?id=".$id."','_self');</script>";
                        	    }
								?>
										</ul>
										<hr>
										<br><br>
									</div>
								</div>



					</div>
					<div class="col-lg-7 m-b30">
								<center><h3>Blotter History of Resident</h3><br><br></center> 
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th>Case Number</th>
												<th>Accussation</th>
												<th>Date Filed</th>
												<th width="50">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$status = 1;
												$blot_status = 1;
												$rows = $model->displayResidentsProfileBlotter($id, $blot_status);

												if (!empty($rows)) {
													foreach ($rows as $row) {
														$brgy_case = $row['brgy_case'];
														$accussation = $row['accussation'];
														$date_filed = $row['date_filed'];
														$id = $row['id'];
														
														$row['date'] = date('M. d, Y', strtotime($row['date']));
														$row['time'] = date('g:i A', strtotime($row['time']));
														$row['date_filed'] = date('M. d, Y g:i A', strtotime($row['date_filed']));

											?>
											<tr>
												<td><?php echo $id; ?></td>
												<td><?php echo $accussation; ?></td>
												<td><?php echo date('M. d, Y g:i A', strtotime($date_filed)); ?></td>
												<td>
													<center><a href="" class="btn blue" style="width: 50px; height: 37px;" data-toggle="modal" data-target="#archive-<?php echo $id; ?>"><div data-toggle="tooltip" title="View"><i class="ti-eye" style="font-size: 12px;"></i></div></a></center>
											</tr>
											<div id="archive-<?php echo $id; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Update Blotter</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="approve_hidden" value="<?php echo $id; ?>">
																<div class="row">
																    <div class="form-group col-12">
																		<label class="col-form-label">Respondent</label>
																		<input class="form-control" type="text" value="<?php echo $first_name; ?> <?php echo $middle_name; ?> <?php echo $last_name; ?>" readonly>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Case Number</label>
																		<input class="form-control" type="text" value="<?php echo $row['id']; ?>" readonly>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Accusation</label>
																		<input class="form-control" type="text" value="<?php echo $row['accussation']; ?>" readonly>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Complainant’s Full Name</label>
																		<input class="form-control" type="text" value="<?php echo $row['complaint_name']; ?>" readonly>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Complainant’s Address</label>
																		<input class="form-control" type="text" value="<?php echo $row['address']; ?>" readonly>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Age</label>
																		<input class="form-control" type="text" value="<?php echo $row['age']; ?>" readonly>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Gender</label>
																		<input class="form-control" type="text" value="<?php echo $row['gender']; ?>" readonly>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Contact Number</label>
																		<input class="form-control" type="text" value="<?php echo $row['contact']; ?>" readonly>
																	</div>
																	<div class="form-group col-3">
																		<label class="col-form-label">Date Happened</label>
																		<input class="form-control" type="text" value="<?php echo $row['date']; ?>" readonly>
																	</div>
																	<div class="form-group col-3">
																		<label class="col-form-label">Time</label>
																		<input class="form-control" type="text" value="<?php echo $row['time']; ?>" readonly>
																	</div>
																	<div class="form-group col-3">
																		<label class="col-form-label">Incident Location</label>
																		<input class="form-control" type="text" value="<?php echo $row['happened']; ?>" readonly>
																	</div>
																	<div class="form-group col-3">
																		<label class="col-form-label">Date Filed</label>
																		<input class="form-control" type="text" value="<?php echo $row['date_filed']; ?>" readonly>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Narrative Report</label>
																	
																		<textarea name="narrative" readonly rows="1" class="form-control" required minlength="5" maxlength=""  style="background-color:#FFFFFF; resize:none;box-sizing: border-box;padding: 5px; " ><?php echo $row['narrative']; ?></textarea>
																	</div>
																</div>
															<a href=""> <p style="text-decoration:underline;color:green;">+ Add New Narrative Report</p></a>
															</div>
															
															<div class="modal-footer">
															    <input type="submit" class="btn green radius-xl outline" name="add-confirm-personal" value="Update Blotter" method="POST">
																
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php

														if (isset($_POST['archive'])) {
															$approve_id = $_POST['approve_hidden'];
															$model->changeResidentStatus($approve_id, 3);
															echo "<script>window.open('residents', '_self');</script>";
														}
													}
												}

											?>
										</tbody>
									</table>
								</div>
								<br>
								<hr>
								<div align="right">
									<!--<a href="" class="btn green radius-xl" style="float: right;background-color: #267621;" data-toggle="modal" data-target="#add-blotters"><i class="ti-agenda"></i><span>&nbsp;ADD BLOTTERS RECORD</span></a><br>-->
								</div>
								<div id="add-blotters" class="modal fade" role="dialog">
									<form class="edit-profile m-b30" method="POST">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Add Blotter Record</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-12">
															<label class="col-form-label"><b>Respondent</b></label>
															<input class="form-control" type="text" value="<?php echo $first_name; ?> <?php echo $middle_name; ?> <?php echo $last_name; ?>" readonly>
																	</div>
														<div class="form-group col-12">
															<label class="col-form-label"><b>Accusation</b></label>
															<input class="form-control" type="text" name="accussation" required>
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Complainant’s Full Name</b></label>
															<input class="form-control" type="text" name="complaint_name" required>
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Complainant’s Address</b></label>
															<input class="form-control" type="text" name="address" required>
														</div>
														<div class="form-group col-4">
															<label class="col-form-label"><b>Age</b></label>
															<input class="form-control" type="number" name="age" required>
														</div>
														<div class="form-group col-4">
															<label class="col-form-label"><b>Gender</b></label>
															<select class="form-control" name="gender" readonly>
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select>
															
														</div>
														<div class="form-group col-4">
															<label class="col-form-label"><b>Contact Number</b></label>
															<input class="form-control" type="number" name="contact" required>
														</div>
														<div class="form-group col-3">
															<label class="col-form-label"><b>Date Happened</b></label>
															<input class="form-control" type="date" name="date" required>
														</div>
														<div class="form-group col-3">
															<label class="col-form-label"><b>Time</b></label>
															<input class="form-control" type="time" name="time" required>
														</div>
														<div class="form-group col-3">
															<label class="col-form-label"><b>Incident Location</b></label>
															<input class="form-control" type="text" name="happened" required>
														</div>
														<div class="form-group col-3">
															<label class="col-form-label"><b>Date Filed</b></label>
															<input class="form-control" type="datetime-local" name="date_filed" required>
														</div>
														<div class="form-group col-12">
															<label class="col-form-label"><b>Narrative Report</b></label>
															<textarea name="narrative" rows="1" class="form-control" required minlength="5" maxlength="" style="background-color:#FFFFFF; resize:none;box-sizing: border-box;padding: 5px;" ></textarea>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<input type="submit" class="btn green radius-xl outline" name="add-confirm" value="Add Record">
													<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</form>
								</div>

								<?php

									if (isset($_POST['add-confirm'])) {
										$model->addBlotters($id, 'N/A', $_POST['complaint_name'], $_POST['age'], $_POST['gender'], $_POST['address'], $_POST['contact'], $_POST['time'], $_POST['date'], $_POST['happened'], $_POST['accussation'], $_POST['date_filed'], $_POST['narrative']);

										echo "<script>window.open('residents-profile?id=".$id."', '_self');</script>";
									}

								?>
								<?php

									if (isset($_POST['add-confirm-personal'])) {
										$model->addBlotters($id, $_POST['narrative']);

										echo "<script>window.open('residents-profile?id=".$id."', '_self');</script>";
									}

								?>

					</div>
				</div>
			</div>
		</main>
		<div class="ttr-overlay"></div>

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
		<script src="../dashboard/assets/js/jquery.dataTables.min.js"></script>
		<script src="../dashboard/assets/js/dataTables.bootstrap4.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('#table').DataTable();
			});
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</body>

</html>