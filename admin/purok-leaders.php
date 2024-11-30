<?php
	ob_start(); 
	session_start(); 
	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['org_sess'])) {
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

		<meta name="description" content="" />

		<meta property="og:title" content="" />
		<meta property="og:description" content="" />
		<meta property="og:image" content="" />
		<meta name="format-detection" content="telephone=no">

		<link rel="icon" href="../assets/images/<?php echo $web_icon; ?>.png" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="../assets/images/<?php echo $web_icon; ?>.png" />

		<title>Purok Leaders</title>

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
		</style>
	</head>
	<?php include '../assets/css/color/color-1.php';  ?>
	<body class="ttr-opened-sidebar ttr-pinned-sidebar" style="background-color: #FCFCFC;">

		<?php include 'navbar.php'; ?>

		<div class="ttr-sidebar">
			<div class="ttr-sidebar-wrapper content-scroll">
				
				<?php 
			
				include 'sidebar.php';
				
				$page = 'pleaders';
				$secondnav = '';

				include 'nav.php'; 

				?>

				
			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #FCFCFC;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Manage Purok Leaders</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-user"></i>Profiles</li>
					</ul>
				</div> 
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-12 m-b30">
						<?php

							if (isset($_POST['add_structure'])) {
								$name = $_POST['name'];
								$email = $_POST['email'];
								$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
								//$password = $_POST['password'];
								$position = $_POST['position'];
								$contact_no = $_POST['contact_no'];
 								$address = $_POST['address'];
                                $purok_no = $_POST['purok_no'];
								$rendered_service = "".$_POST['position1']."-".$_POST['position2']."";

								$path = '../assets/images/org-structure/';
								$unique = time().uniqid(rand());
								$destination = $path . $unique . '.jpg';
								$base = basename($_FILES["image"]["name"]);
								$image = $_FILES["image"]["tmp_name"];
								move_uploaded_file($image, $destination);

								$model->addStructure($name, $email, $password, $position, $base, $unique, $rendered_service, 101);
								
								//include_once('config.php');
								$res = my_query('SELECT * FROM org_structure ORDER BY id DESC LIMIT 1');
								if ($row = $res->fetch()) {
									db_update('org_structure',['contact_no'=>$contact_no,'address'=>$address,'purok_no'=>$purok_no],['id'=>$row['id']]);
  									
								}

								echo "<script>window.open('purok-leaders', '_self');</script>";
							}

						?>
						<div class="row align-items d-flex">
							<div class="col-lg-3 col-md-12">
								<div class="heading-bx left">
									<h2 class="m-b10 title-head">Purok <span>Leaders</span></h2>
								</div>
								<?php 

									$rows = $model->fetchPunongBrgy(1);
									if (!empty($rows)) {
										foreach ($rows as $row) {
											$brgy_head_id = $row['id'];
											$brgy_head = $row['name'];
											$brgy_head_pic = $row['image_unique'];
										}
									}
										
								?>
								<center style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
									<a href="../assets/images/org-structure/<?php echo $brgy_head_pic; ?>.jpg" target="_blank">
										<img src="../assets/images/org-structure/<?php echo $brgy_head_pic; ?>.jpg" style="width: 80%;height: 250px; object-fit: cover;">
									</a>
									<h4><?php echo $brgy_head; ?></h4>
									<span>Barangay Captain</span><hr>
									<!--<a href="" class="btn green radius-xl" style="background-color: <?php echo $primary_color; ?>;" data-toggle="modal" data-target="#edit-head">-->
									<!--	<i class="ti-marker-alt"></i>-->
										<!--<span>&nbsp;EDIT DETAILS</span>-->
									<!--</a><br><br>-->
								</center>
							</div>
							<div id="edit-head" class="modal fade" role="dialog" >
								<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data" >
									<div class="modal-dialog modal-lg" data-backdrop="static" data-keyboard="false">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Edit Barangay Captain Details</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="form-group col-4">
														<center><a href="../assets/images/org-structure/<?php echo $brgy_head_pic; ?>.jpg" target="_blank"><img id="display-img-head" src="../assets/images/org-structure/<?php echo $brgy_head_pic; ?>.jpg" style="width: 160px;height:210px; object-fit: cover;"></a><br>
														
														</center>
													</div>
													<div class="form-group col-8">
														<label class="col-form-label"><b>Name</b></label>
														<input class="form-control" name="name-head" type="text" value="<?php echo $brgy_head; ?>" required>

														<label class="col-form-label"><b>Position</b></label>
														<br>Barangay Captain
														<br>
														<label class="col-form-label"><b>Photo</b></label>
														<input class="form-control" type="file" name="image-head" accept="image/*" style="border: 0px; padding: 0px;" onchange="readURL(this, 'head')">
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn green radius-xl outline" name="edit-head" value="Save Changes">
												<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							<?php

								if (isset($_POST['edit-head'])) {
									$model->editHead($_POST['name-head'], $brgy_head_id);

									if (!isset($_FILES['image-head']) || $_FILES['image-head']['error'] == UPLOAD_ERR_NO_FILE) {}

									else {
										$path = '../assets/images/org-structure/';
										$unique = time().uniqid(rand());
										$destination = $path . $unique . '.jpg';
										$base = basename($_FILES["image-head"]["name"]);
										$image = $_FILES["image-head"]["tmp_name"];
										move_uploaded_file($image, $destination);

										$model->editHeadImage($unique, $brgy_head_id);
									}

									echo "<script>window.open('purok-leaders', '_self');</script>";
								}

							?>
							<div class="col-lg-9 col-md-12">
								<div align="right">
									<a href="" class="btn green radius-xl" style="background-color: <?php echo $primary_color; ?>;" data-toggle="modal" data-target="#add-announcement"><i class="ti-plus"></i><span>&nbsp;ADD PUROK LEADER</span></a>&nbsp;
									<a href="archived-pleaders" class="btn red radius-xl"><i class="ti-archive"></i><span>&nbsp;ARCHIVED PUROK LEADERS</span></a><br>
								</div>
								<div style="padding: 25px;"></div>
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
                                                <th>Purok</th>
												<th width="100">Image</th>
												<th>Name</th>
												<th>Contact No.</th>
												<th>Address</th>
 											
												<th>Rendered Service</th>
												<th width="100">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$status = 101;
												$rows = $model->fetchOrgStructurePurok($status);

												if (!empty($rows)) {
													foreach ($rows as $row) {

														if ($row['position'] == 1) {
															$position = "Barangay Secretary";
														}
														else if ($row['position'] == 2) {
															$position = "Barangay Assistant Secretary";
														}
														else if ($row['position'] == 3) {
															$position = "Barangay Staff";
														}
														else if ($row['position'] == 4) {
															$position = "Purok Leader";
														}
														else {
															$position = "N/A";
														}

											?>
											<tr>
                                                <td><?php echo $row['purok_no']; ?></td>
												<td><center><a href="../assets/images/org-structure/<?php echo $row['image_unique']; ?>.jpg" target="_blank"><img src="../assets/images/org-structure/<?php echo $row['image_unique']; ?>.jpg" style="width: 100px;height: 80px; object-fit: cover;"></a></center></td>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['contact_no']; ?></td>
												<td><?php echo $row['address']; ?></td>
											
												<td><?php echo $row['rendered_service']; ?></td>
												<td>
													<center>
														<button data-toggle="modal" data-target="#edit-<?php echo $row['id']; ?>" class="btn blue" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="Edit">
																<i class="ti-marker-alt" style="font-size: 12px;"></i>
															</div>
														</button>&nbsp;
														<button data-toggle="modal" data-target="#delete-<?php echo $row['id']; ?>" class="btn red" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="Archive">
																<i class="ti-archive" style="font-size: 12px;"></i>
															</div>
														</button>
													</center>
												</td>
											</tr>
											<div id="edit-<?php echo $row['id']; ?>" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data" >
													<div class="modal-dialog modal-lg" >
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Edit Purok Leader Details</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body" >
																<input type="hidden" name="edit-id" value="<?php echo $row['id']; ?>">
																<div class="row">
																	<div class="form-group col-4">
																		
																		<center><a href="../assets/images/org-structure/<?php echo $row['image_unique']; ?>.jpg" target="_blank"><img id="display-img-<?php echo $row['id']; ?>" src="../assets/images/org-structure/<?php echo $row['image_unique']; ?>.jpg" style="width: 160px;height:210px; object-fit: cover;"></a></center>
																	</div>
																	<div class="form-group col-8">
																		<label class="col-form-label">Name</label>
																		<input class="form-control" name="name" type="text" value="<?php echo $row['name']; ?>" required>
																		
																		<label class="col-form-label"><b>Contact No</b></label>
															<input class="form-control" type="number" name="contact_no" value="<?php echo $row['contact_no']; ?>" required maxlength="11">
															
															<label class="col-form-label"><b>Address</b></label>
 															<input class="form-control" type="text" name="address"  value="<?php echo $row['address']; ?>" required>
															
														
 

																		<label class="col-form-label">Email</label>
																		<input class="form-control" name="email" type="email" value="<?php echo $row['email']; ?>" required>

																		<label class="col-form-label">Position</label>
																		<select class="form-control" name="position" required>
																			<!--<option value="1" <?php if ($row['position'] == 1) { echo 'selected'; } ?>>Barangay Secretary</option>-->
																			<!-- <option value="2" <?php if ($row['position'] == 2) { echo 'selected'; } ?>>Barangay Assistant Secretary</option>
																			<option value="3" <?php if ($row['position'] == 3) { echo 'selected'; } ?>>Barangay Staff</option> -->
																			<option value="3" <?php if ($row['position'] == 4) { echo 'selected'; } ?>>Purok Leader</option>
																		</select>

																		<label class="col-form-label"><b>Purok</b></label>
															<select class="form-control" name="purok_no">
															<option value="<?=$row['purok_no'];?>">Purok <?=$row['purok_no'];?></option>
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

																		<label class="col-form-label">Rendered Service</label>
																		<input class="form-control" name="rendered" type="text" value="<?php echo $row['rendered_service']; ?>" required>

																		<div style="padding: 5px;"></div>
																		<label class="col-form-label">Photo</label>
																		<input class="form-control" type="file" name="image" accept="image/*" style="border: 0px; padding: 0px;" id="input-img-<?php echo $row['id']; ?>" onchange="readURL(this, '<?php echo $row['id']; ?>')">
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn green radius-xl outline" name="edit" value="Save Changes">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											<div id="delete-<?php echo $row['id']; ?>" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-md">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Archive Purok Leader</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="delete-id" value="<?php echo $row['id']; ?>">
																<div class="row">
																	<div class="form-group col-4">
																		<center><a href="../assets/images/org-structure/<?php echo $row['image_unique']; ?>.jpg" target="_blank"><img src="../assets/images/org-structure/<?php echo $row['image_unique']; ?>.jpg" style="width: 160px;height:210px; object-fit: cover;"></a></center>
																	</div>
																	<div class="form-group col-8">
																		<label class="col-form-label">Name</label>
																		<br><?php echo $row['name']; ?>
																		<br>
																		<label class="col-form-label">Position</label>
																		<br><?php echo $position; ?>
																		<br>
																		<label class="col-form-label">Rendered Service</label>
																		<br><?php echo $row['rendered_service']; ?>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn red radius-xl outline" name="archive" onclick="return confirm('Are you sure you want to archive this information?')" value="Archive">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php

													}
												}

												if (isset($_POST['edit'])) {
													$edit_id = $_POST['edit-id'];

													
													db_update('org_structure',
													['contact_no'=>$_POST['contact_no'],'address'=>$_POST['address'],'purok_no'=>$_POST['purok_no']],['id'=>$edit_id]);
													  

													$model->editStructure($_POST['name'], $_POST['email'], $_POST['position'], $_POST['rendered'], $edit_id);

													
												
													
													if (!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {}

													else {
														$path = '../assets/images/org-structure/';
														$unique = time().uniqid(rand());
														$destination = $path . $unique . '.jpg';
														$base = basename($_FILES["image"]["name"]);
														$image = $_FILES["image"]["tmp_name"];
														move_uploaded_file($image, $destination);

														$model->editStructureImage($base, $unique, $edit_id);
													}
                                                    echo "<script>alert('Profile has been changed!');window.open('purok-leaders','_self');</script>";
												}

												if (isset($_POST['archive'])) {
													$status = 100;
													$model->archiveOrgStructure($status, $_POST['delete-id']);
													echo "<script>alert('Profile has been archived!');window.open('purok-leaders','_self');</script>";
												}


											?>
										</tbody>
									</table>
								</div>
								<hr>
								<div align="right">
								</div>

								<div id="add-announcement" class="modal fade" role="dialog">
									<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Add New Purok Leader</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-4">
															<center>
																<img id="display-img-" style="width: 500px; height: 300px; object-fit: cover;">
															</center>
														</div>
														<div class="form-group col-8">
															<label class="col-form-label"><b>Name of the Purok Leader</b></label>
															<input class="form-control" type="text" name="name" required maxlength="50">
																<label class="col-form-label"><b>Contact No</b></label>
															<input class="form-control" type="number" name="contact_no" required maxlength="11">
															
															<label class="col-form-label"><b>Address</b></label>
 															<input class="form-control" type="text" name="address" required>
															
															<label class="col-form-label"><b>Email</b></label>
															<input class="form-control" type="email" name="email" required maxlength="100">
															
															<label class="col-form-label"><b>Password</b> 
															<input  type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password',document.getElementById('rpass').type = this.checked ? 'text' : 'password'"    id="rememberme" class="filled-in chk-col-pink">
 															<label for="rememberme">Show  </label>
														</label>
															<input class="form-control" type="password" id="password" name="password" required>
														
														
															<label class="col-form-label"><b>Purok</b></label>
															<select class="form-control" name="purok_no">
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
 														
															<label class="col-form-label"><b>Position</b></label>
															<select class="form-control" name="position" required="">
																<!--<option value="1">Barangay Secretary</option>-->
																<!-- <option value="2">Barangay Assistant Secretary</option>
																<option value="3">Barangay Staff</option> -->
																<option value="4">Purok Leader</option>
															</select>
															<div style="padding: 3px;"></div>
															<div class="row">
																<div class="form-group col-6">
																	<label class="col-form-label"><b>Service Rendered</b></label>
																	<select class="form-control" name="position1" required="">
																		<option value="" disabled selected hidden="" >-- Please select --</option>
																		<script type="text/javascript">
																			for (var i = 2023; i >= 1970; i--) {
																				document.write("<option value='" + i +"'>" + i + "</option>");
																			}
																		</script>			
																	</select>
																</div>
																<div class="form-group col-6">
																	<label class="col-form-label" style="color: white;">d</label>
																	<select class="form-control" name="position2" required="">
																		<option value="Present" selected ="" >Present</option>
																		<script type="text/javascript">
																			for (var i = 2021; i >= 1970; i--) {
																				document.write("<option value='" + i +"'>" + i + "</option>");
																			}
																		</script>			
																	</select>
																</div>
															</div>

															<div style="padding: 5px;"></div>
															<label class="col-form-label"><b>Photo</b></label>
															<input class="form-control" type="file" name="image" accept="image/*" onchange="readURL(this, '')" style="border: 0px; padding: 0px;" required>
														
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<input type="submit" class="btn green radius-xl outline" name="add_structure" value="Add Purok Leader">
													<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
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
			function readURL(input, id) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#display-img-' + id).attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}
			}

			$(document).ready(function() {
				$('#table').DataTable();
			});

			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</body>

</html>