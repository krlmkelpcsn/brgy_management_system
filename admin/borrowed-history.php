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

		<title>Borrowed History</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/vendors/calendar/fullcalendar.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/typography.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/shortcodes/shortcodes.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dashboard.css">
		<link rel="stylesheet" href="froala/css/froala_editor.css">
		<link rel="stylesheet" href="froala/css/froala_style.css">
		<link rel="stylesheet" href="froala/css/plugins/code_view.css">
		<link rel="stylesheet" href="froala/css/plugins/colors.css">
		<link rel="stylesheet" href="froala/css/plugins/emoticons.css">
		<link rel="stylesheet" href="froala/css/plugins/image_manager.css">
		<link rel="stylesheet" href="froala/css/plugins/image.css">
		<link rel="stylesheet" href="froala/css/plugins/line_breaker.css">
		<link rel="stylesheet" href="froala/css/plugins/table.css">
		<link rel="stylesheet" href="froala/css/plugins/char_counter.css">
		<link rel="stylesheet" href="froala/css/plugins/video.css">
		<link rel="stylesheet" href="froala/css/plugins/fullscreen.css">
		<link rel="stylesheet" href="froala/css/plugins/file.css">
		<link rel="stylesheet" href="froala/css/plugins/quick_insert.css">
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
	<body class="ttr-opened-sidebar ttr-pinned-sidebar" style="background-color: #F3F3F3;">

		<?php include 'navbar.php'; ?>

		<div class="ttr-sidebar">
			<div class="ttr-sidebar-wrapper content-scroll">
				
				<?php 
			
				include 'sidebar.php';
				
				$page = 'inventory';
				$secondnav = 'borrowed';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Manage Borrowed Equipments</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-bookmark-alt"></i>Borrowed Equipments</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-6">
								<div class="heading-bx left">
									<h2 class="m-b10 title-head">Not Returned <span>Equipments</span></h2>
								</div>
					</div>
					<div class="col-lg-6" align="right">
						<a href="borrowed" class="btn red radius-xl" style="background-color: <?php echo $primary_color; ?>"><i class="ti-bookmark-alt"></i><span>&nbsp; BORROW EQUIPMENT</span></a>
					</div>
					<div class="col-lg-12 m-b30">
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th width="100">Action</th>
												<th width="100">Image</th>
												<th>Equipment</th>
												<th>Qty</th>
												<th>Type</th>
												<th>Name</th>
												<!-- <th>College</th> -->
												<th>Date Borrowed</th>
												<th width="50">Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$rows = $model->displayBorrow();

												if (!empty($rows)) {
													foreach ($rows as $row) {

													if ($row['borrow_status'] == 1) {
														$status = '<span class="badge badge-danger">NOT RETURNED</span>';
													}
													else {
														$status = '<span class="badge badge-success">RETURNED</span>';
													}

											?>
											<tr>
												<td>
													<center>
														<?php
														if ($row['borrow_status'] == 1) {
														?>
														<button data-toggle="modal" data-target="#return-<?php echo $row['id']; ?>" class="btn green" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="Return">
																<i class="ti-bookmark-alt" style="font-size: 12px;"></i>
															</div>
														</button>

														&nbsp;


														<button data-toggle="modal" data-target="#report-<?php echo $row['id']; ?>" class="btn yellow" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="Report">
																<i class="ti-clipboard" style="font-size: 12px;"></i>
															</div>
														</button>
														<?php
														}
														else {
														?>
														<button data-toggle="modal" data-target="#view-<?php echo $row['id']; ?>" class="btn blue" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="View">
																<i class="ti-search" style="font-size: 12px;"></i>
															</div>
														</button>
														<?php
														}
														?>
													</center>
												</td>
												<td><a href="../assets/images/equipments/<?php echo $row['photo']; ?>.jpg" target="_blank"><img src="../assets/images/equipments/<?php echo $row['photo']; ?>.jpg" style="width: 120px;height: 60px; object-fit: cover;"></a></td>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['qty']; ?></td>
												<td><?php echo $row['type']; ?></td>
												<td><?php echo $row['borrow_name']; ?></td>
												<!-- <td><?php echo $row['course']; ?></td> -->
												<td style="font-size: 12px;"><?php echo date('M. d, Y h:i A', strtotime($row['date'])); ?></td>
												<td style="font-size: 14px;"><center><b><?php echo $status; ?></b></center></td>

											</tr>

											<div id="return-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Return Equipment</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="borrow-id" value="<?php echo $row['borrow_id']; ?>">
																<input type="hidden" name="equipment_id" value="<?php echo $row['equipment_id']; ?>">
																<div class="row">
																	<div class="form-group col-5">
																		<center>
																			<img id="display-img-<?php echo $row['id']; ?>" src="../assets/images/equipments/<?php echo $row['photo']; ?>.jpg" style="width: 300px; height: 200px; object-fit: cover;">
																		</center>
																		<label class="col-form-label">Equipment</label>
																		<input class="form-control" type="text" name="name" value="<?php echo $row['name']; ?>" readonly style="background-color: white;">

																		<label class="col-form-label">Brand</label>
																		<input class="form-control" type="text" name="brand" value="<?php echo $row['brand']; ?>" readonly style="background-color: white;">

																		<label class="col-form-label">Quantity</label>
																		<input class="form-control" type="text" name="qty" value="<?php echo $row['quantity']; ?>" readonly style="background-color: white;">

																		<label class="col-form-label">Borrowed Qty</label>
																		<input class="form-control" type="text" name="item_borrowed" value="<?php echo $row['qty']; ?>" style="background-color: white;" readonly>
																	</div>
																	<div class="form-group col-7">

																		<label class="col-form-label">Type</label>
																		<input class="form-control" type="text" name="type" value="<?php echo $row['type']; ?>"style="background-color: white;" readonly> 

																		<label class="col-form-label">Name</label>
																		<input class="form-control" type="text" name="name" value="<?php echo $row['borrow_name']; ?>" style="background-color: white;" readonly>

																		<label class="col-form-label">Purpose</label>
																		<input class="form-control" type="text" name="b_year_section" value="<?php echo $row['purpose']; ?>" style="background-color: white;" readonly>

																		<label class="col-form-label">Address</label>
																		<input class="form-control" type="text" name="b_year_section" value="<?php echo $row['address']; ?>" style="background-color: white;" readonly>

																		<label class="col-form-label">Contact</label>
																		<input class="form-control" type="text" name="b_year_section" value="<?php echo $row['contact']; ?>" style="background-color: white;" readonly> 
																		<label class="col-form-label">Reason</label>
																		<textarea class="form-control" type="text" name="reason" style="background-color: white;" disabled><?php echo $row['purpose']; ?></textarea>

																		<label class="col-form-label">Date Borrowed</label>
																		<input class="form-control" type="text" name="date_lost" value="<?php echo date('M. d, Y h:i A', strtotime($row['date'])); ?>" style="background-color: white;" readonly>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn green radius-xl outline" name="return" value="Return">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>


											<div id="report-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Report Equipment</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="report-id" value="<?php echo $row['equipment_id']; ?>">

																<input type="hidden" name="borrow-id2" value="<?php echo $row['borrow_id']; ?>">
																<div class="row">
																	<div class="form-group col-5">
																		<center>
																			<img id="display-img-<?php echo $row['id']; ?>" src="../assets/images/equipments/<?php echo $row['photo']; ?>.jpg" style="width: 300px; height: 200px; object-fit: cover;">
																		</center>
																		<label class="col-form-label">Name</label>
																		<input class="form-control" type="text" name="name" value="<?php echo $row['name']; ?>" readonly style="background-color: white;">

																		<label class="col-form-label">Brand</label>
																		<input class="form-control" type="text" name="brand" value="<?php echo $row['brand']; ?>" readonly style="background-color: white;">

																		<label class="col-form-label">Quantity</label>
																		<input class="form-control" type="text" name="qty" value="<?php echo $row['quantity']; ?>" readonly style="background-color: white;">
																	</div>
																	<div class="form-group col-7">

																		<label class="col-form-label">No. of Items Lost</label>
																		<input class="form-control" type="text" name="item_lost" min="" max="" value="<?php echo $row['qty']; ?>" style="background-color: white;" readonly>

																	
																		<label class="col-form-label">Type</label>
																		<input class="form-control" type="text" name="type" style="background-color: white;" readonly value="<?php echo $row['type']; ?>">

																		<label class="col-form-label">Name</label>
																		<input class="form-control" type="text" name="name" style="background-color: white;" value="<?php echo $row['borrow_name']; ?>" readonly> 

																		<label class="col-form-label">Address</label>
																		<input class="form-control" type="text" name="r_address" value="<?php echo $row['address']; ?>" style="background-color: white;" readonly>

																		<label class="col-form-label">Contact</label>
																		<input class="form-control" type="text" name="r_contact" value="<?php echo $row['contact']; ?>" style="background-color: white;" readonly>

																		<label class="col-form-label">Category</label>
																		<select class="form-control" name="category" id="type" required style="color: black!important;">
																			<option value="" disabled selected hidden="">-- Please select --</option>
																			<option value="Damaged">Damaged</option>
																			<option value="Lost">Lost</option>
																		</select>

																		<label class="col-form-label">Reason</label>
																		<textarea class="form-control" type="text" name="reason" style="background-color: white;" required></textarea>



																		<label class="col-form-label">Date Lost</label>
																		<input class="form-control" type="date" name="date_lost" style="background-color: white;" required value="<?php echo $month = date("Y-m-d"); ?>">

																		
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn yellow radius-xl outline" name="report" value="Report">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php 

													}
												}


												if (isset($_POST['report'])) {
													$borrow_id = $_POST['borrow-id2'];
													$equipment_id = $_POST['report-id'];
													$qty = $_POST['qty'];
													$item_lost = $_POST['item_lost'];
													$type = $_POST['type'];
													$name = $_POST['name'];
													$category = $_POST['category'];
													$r_address = $_POST['r_address'];
													$r_contact = $_POST['r_contact'];

													$date_lost = $_POST['date_lost'];
													$reason = $_POST['reason'];
										
													$date_reported = date("Y-m-d H:i:s");
													$new_qty = $qty - $item_lost;

													$model->addReport($equipment_id, $item_lost, $type, $name, $date_lost, $reason, $date_reported, $category, $r_address, $r_contact);
													$model->updateEquipmentQty($new_qty, $date_reported, $equipment_id);

													$model->updateBorrowStatus(20, $date_lost, $date_lost, $borrow_id);

													echo "<script>window.open('reports2', '_self');</script>";
												}


												if (isset($_POST['return'])) {
													$borrow_id = $_POST['borrow-id'];
													$qty = $_POST['qty'];
													$item_borrowed = $_POST['item_borrowed'];
													$date_borrowed = date("Y-m-d H:i:s");
													$date_borrowed2 = date("Y-m-d");
													$new_qty = $qty + $item_borrowed;

													$model->updateEquipmentQty($new_qty, $date_borrowed, $_POST['equipment_id']);
													$model->updateBorrowStatus(2, $date_borrowed, $date_borrowed2, $borrow_id);

													echo "<script>window.open('borrowed-history', '_self');</script>";
												}

											?>
										</tbody>
									</table>
								</div>
								<hr>
								<div class="heading-bx left">
									<h2 class="m-b10 title-head">Returned <span>Equipments</span></h2>
								</div>
								<div class="table-responsive">
									<table id="table2" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th width="50">Action</th>
												<th width="100">Image</th>
												<th>Equipment</th>
												<th>Qty</th>
												<th>Type</th>
												<th>Name</th>
												<!-- <th>College</th> -->
												<th>Date Borrowed</th>
												<th>Date Returned</th>
												<th width="50">Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$rows = $model->displayBorrow2();

												if (!empty($rows)) {
													foreach ($rows as $row) {

													if ($row['borrow_status'] == 1) {
														$status = '<span class="badge badge-danger">NOT RETURNED</span>';
													}
													else {
														$status = '<span class="badge badge-success">RETURNED</span>';
													}

											?>
											<tr>
												<td>
													<center>
														<?php
														if ($row['borrow_status'] == 1) {
														?>
														<button data-toggle="modal" data-target="#return-<?php echo $row['id']; ?>" class="btn green" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="Return">
																<i class="ti-bookmark-alt" style="font-size: 12px;"></i>
															</div>
														</button>
														<?php
														}
														else {
														?>
														<button data-toggle="modal" data-target="#view-<?php echo $row['id']; ?>" class="btn blue" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="View">
																<i class="ti-search" style="font-size: 12px;"></i>
															</div>
														</button>
														<?php
														}
														?>
													</center>
												</td>
												<td><a href="../assets/images/equipments/<?php echo $row['photo']; ?>.jpg" target="_blank"><img src="../assets/images/equipments/<?php echo $row['photo']; ?>.jpg" style="width: 120px;height: 60px; object-fit: cover;"></a></td>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['qty']; ?></td>
												<td><?php echo $row['type']; ?></td>
												<td><?php echo $row['borrow_name']; ?></td>
												<!-- <td><?php echo $row['course']; ?></td> -->
												<td style="font-size: 12px;"><?php echo date('M. d, Y h:i A', strtotime($row['date'])); ?></td>
												<td style="font-size: 12px;"><?php echo date('M. d, Y h:i A', strtotime($row['date_returned'])); ?></td>
												<td style="font-size: 14px;"><center><b><?php echo $status; ?></b></center></td>

											</tr>
											<div id="view-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Equipment Details</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="archive-id" value="<?php echo $row['id']; ?>">
																<div class="row">
																	<div class="form-group col-5">
																		<center>
																			<img id="display-img-<?php echo $row['id']; ?>" src="../assets/images/equipments/<?php echo $row['photo']; ?>.jpg" style="width: 300px; height: 200px; object-fit: cover;">
																		</center>
																		<label class="col-form-label">Equipment</label>
																		<input class="form-control" type="text" name="name" value="<?php echo $row['name']; ?>" readonly style="background-color: white;">

																		<label class="col-form-label">Brand</label>
																		<input class="form-control" type="text" name="brand" value="<?php echo $row['brand']; ?>" readonly style="background-color: white;">

																		<label class="col-form-label">Quantity</label>
																		<input class="form-control" type="text" name="qty" value="<?php echo $row['quantity']; ?>" readonly style="background-color: white;">

																
																		<label class="col-form-label">Borrowed Qty</label>
																		<input class="form-control" type="text" name="item_lost" value="<?php echo $row['qty']; ?>" style="background-color: white;" readonly>															
																	</div>
																	<div class="form-group col-7">

																		<label class="col-form-label">Type</label>
																		<input class="form-control" type="text" name="type" value="<?php echo $row['type']; ?>"style="background-color: white;" readonly> 

																		<label class="col-form-label">Name</label>
																		<input class="form-control" type="text" name="name" value="<?php echo $row['borrow_name']; ?>" style="background-color: white;" readonly> 
																		<label class="col-form-label">Purpose</label>
																		<input class="form-control" type="text" name="b_year_section" value="<?php echo $row['purpose']; ?>" style="background-color: white;" readonly>

																		<label class="col-form-label">Address</label>
																		<input class="form-control" type="text" name="b_year_section" value="<?php echo $row['address']; ?>" style="background-color: white;" readonly>

																		<label class="col-form-label">Contact</label>
																		<input class="form-control" type="text" name="b_year_section" value="<?php echo $row['contact']; ?>" style="background-color: white;" readonly> 

																		<label class="col-form-label">Date Borrowed</label>
																		<input class="form-control" type="text" name="date_lost" value="<?php echo date('M. d, Y h:i A', strtotime($row['date'])); ?>" style="background-color: white;" readonly>

																		<label class="col-form-label">Date Returned</label>
																		<input class="form-control" type="text" name="date_lost" value="<?php echo date('M. d, Y h:i A', strtotime($row['date_returned'])); ?>" style="background-color: white;" readonly>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>

											<?php 

													}
												}

											?>
										</tbody>
									</table>
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
		<script type="text/javascript" src="froala/js/froala_editor.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/align.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/char_counter.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/code_beautifier.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/code_view.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/colors.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/draggable.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/emoticons.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/entities.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/file.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/font_size.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/font_family.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/fullscreen.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/image.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/image_manager.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/line_breaker.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/inline_style.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/link.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/lists.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/paragraph_format.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/paragraph_style.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/quick_insert.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/quote.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/table.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/save.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/url.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/video.min.js"></script>
		<script>
			(function () {
				new FroalaEditor("#edit", {
					toolbarButtons: {
						moreText: {
							buttons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting'],
							align: 'left',
							buttonsVisible: 3
						},
						moreParagraph: {
							buttons: ['alignLeft', 'alignCenter', 'formatOLSimple'],
							align: 'left',
							buttonsVisible: 3
						},
						moreMisc: {
							buttons: ['undo', 'redo'],
							align: 'right'
						}
					},
					toolbarButtonsXS: [['undo', 'redo'], ['bold', 'italic', 'underline']]
				})
			})()
		</script>
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

			$(document).ready(function() {
				$('#table2').DataTable();
			});

			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</body>

</html>