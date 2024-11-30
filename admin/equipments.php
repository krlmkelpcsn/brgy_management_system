<?php
error_reporting(0);
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

		<title>Equipments</title>

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
				$secondnav = 'equipments';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Manage Equipments</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-menu-alt"></i>Equipments</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-6">
								<div class="heading-bx left">
									<h2 class="m-b10 title-head">Equipment</h2>
								</div>
					</div>
					<div class="col-lg-6" align="right">
						<a href="" class="btn green radius-xl" data-toggle="modal" data-target="#add-equipment"><i class="ti-menu-alt"></i><span>&nbsp;ADD NEW EQUIPMENT</span></a><!-- &nbsp;&nbsp;<a href="archived-equipments" class="btn red radius-xl"><i class="ti-archive"></i><span>&nbsp;ARCHIVED EQUIPMENTS</span></a> -->
					</div>
					<div class="col-lg-12 m-b30">
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th width="50">Action</th>
												<th width="100">Image</th>
												<th>ID</th>
												<th>Equipment</th>
												<th>Brand</th>
												<th>Qty</th>
												<!-- <th>Condition</th> -->
												<th>Service</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$status = 1;
												$rows = $model->displayEquipments($status);

												if (!empty($rows)) {
													foreach ($rows as $row) {

													$qty = $row['quantity'];
													if ($qty > 0) {
														$qty = "<span style='color: black;'>".$row['quantity']."</span>";
														$service = "<span class='badge badge-success'>Available</span>";
														$service2 = 'Available';
													}
													else {
														$qty = "<span style='color: red;'>".$row['quantity']."</span>";
														$service = "<span class='badge badge-danger'>Not Available</span>";
														$service2 = 'Not Available';
													}
											?>	
											<tr>
												<td>
													<center>
														<button data-toggle="modal" data-target="#edit-<?php echo $row['id']; ?>" class="btn blue" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="Update">
																<i class="ti-marker-alt" style="font-size: 12px;"></i>
															</div>
														</button>
													</center>
												</td>
												<td><a href="../assets/images/equipments/<?php echo $row['photo']; ?>.jpg" target="_blank"><img src="../assets/images/equipments/<?php echo $row['photo']; ?>.jpg" style="width: 120px;height: 60px; object-fit: cover;"></a></td>
												<td><?php echo $row['id']; ?></td>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['brand']; ?></td>
												<td><center><?php echo $qty; ?><br><span style="font-size: 1px;"><?php echo $row['keywords']; ?></span></center></td>
												<td><center><?php echo $service; ?></center></td>
											</tr>
											<div id="edit-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Update Equipment</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="edit-id" value="<?php echo $row['id']; ?>">
																<div class="row">
																	<div class="form-group col-4">
																		<center>
																			<img id="display-img-<?php echo $row['id']; ?>" src="../assets/images/equipments/<?php echo $row['photo']; ?>.jpg" style="width: 300px; height: 200px; object-fit: cover;">
																			<label class="col-form-label">Image</label>
																			<input class="form-control" type="file" name="image" id="input-img-<?php echo $row['id']; ?>" onchange="readURL(this, '<?php echo $row['id']; ?>')" accept="image/*" style="border: 0px; padding: 0px;">
																		</center>

																		<label class="col-form-label">Service</label>
																		<input class="form-control" type="text" name="new_name" value="<?php echo $service2; ?>" style="background-color: white;" readonly>
																	</div>
																	<div class="form-group col-8">
																		<label class="col-form-label">Name</label>
																		<input class="form-control" type="text" name="new_name" value="<?php echo $row['name']; ?>" style="background-color: white;">

																		<label class="col-form-label">Brand</label>
																		<input class="form-control" type="text" name="new_brand" value="<?php echo $row['brand']; ?>" style="background-color: white;">

																		<label class="col-form-label">Quantity</label>
																		<input class="form-control" type="number" name="new_qty" value="<?php echo $row['quantity']; ?>" min="0" max="999" style="background-color: white;">

																		

																		<label class="col-form-label">Search Tag</label>
																		<input class="form-control" type="text" name="new_keywords" value="<?php echo $row['keywords']; ?>" required>

																		<label class="col-form-label">Date Arrived</label>
																		<input class="form-control" type="date" name="new_date_arrived" value="<?php echo $row['date_arrived']; ?>" style="background-color: white;">
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
											<div id="archive-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Archive Equipment</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="archive-id" value="<?php echo $row['id']; ?>">
																<div class="row">
																	<div class="form-group col-4">
																		<center>
																			<img id="display-img-<?php echo $row['id']; ?>" src="../assets/images/equipments/<?php echo $row['photo']; ?>.jpg" style="width: 300px; height: 200px; object-fit: cover;">
																		</center>

																		<!-- <label class="col-form-label">Condition</label>
																		<input class="form-control" type="text" name="" value="<?php echo $row['cond']; ?>" readonly style="background-color: white;"> -->

																		<label class="col-form-label">Service</label>
																		<input class="form-control" type="text" name="new_name" value="<?php echo $service2; ?>" style="background-color: white;" readonly>
																	</div>
																	<div class="form-group col-8">
																		<label class="col-form-label">Name</label>
																		<input class="form-control" type="text" name="name" value="<?php echo $row['name']; ?>" readonly style="background-color: white;">

																		<label class="col-form-label">Brand</label>
																		<input class="form-control" type="text" name="brand" value="<?php echo $row['brand']; ?>" readonly style="background-color: white;">

																		<label class="col-form-label">Quantity</label>
																		<input class="form-control" type="text" name="qty" value="<?php echo $row['quantity']; ?>" readonly style="background-color: white;">


																		<label class="col-form-label">Search Tag</label>
																		<input class="form-control" type="text" name="" value="<?php echo $row['keywords']; ?>" readonly style="background-color: white;">

																		<label class="col-form-label">Date Arrived</label>
																		<input class="form-control" type="text" name="date_arrived" value="<?php echo date('M. d, Y', strtotime($row['date_arrived'])); ?>" readonly style="background-color: white;">
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn red radius-xl outline" name="archive" value="Archive Equipment">
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

													$filename=$_FILES['image']['name'];
													$file = basename($filename);

													if(strtolower(end(explode(".",$file))) =="mp4") {
														echo "<script>alert('Invalid file type.');window.open('equipments', '_self');</script>";
													}
													else {

													$edit_id = $_POST['edit-id'];
													$date_added = date("Y-m-d H:i:s");
													$cat = "Available";
													$model->updateEquipment($_POST['new_name'], $_POST['new_brand'], $_POST['new_qty'], "", $_POST['new_date_arrived'], $date_added, "none", 'N/A', $_POST['new_keywords'], $edit_id);

													if (!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {}

													else {
														$is_image = getimagesize($_FILES["image"]["tmp_name"]) ? true : false;

														if ($is_image) {
															$path = '../assets/images/equipments/';
															$unique = time().uniqid(rand());
															$destination = $path . $unique . '.jpg';
															$base = basename($_FILES["image"]["name"]);
															$image = $_FILES["image"]["tmp_name"];
															move_uploaded_file($image, $destination);
															$model->updateEquipmentPhoto($unique, $edit_id);
														}
														else {
															echo "<script>alert('Invalid file type.')</script>";
														}
													}

													echo "<script>window.open('equipments', '_self');</script>";


														
													}

													
												}

												if (isset($_POST['archive'])) {
													$status = 2;
													$model->updateEquipmentStatus($status, $_POST['archive-id']);
													echo "<script>window.open('equipments', '_self');</script>";
												}
											?>
										</tbody>
									</table>
								</div>


								<div id="add-equipment" class="modal fade" role="dialog">
									<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Add Equipment</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-4">
															<center>
																<img id="display-img-" style="width: 100%; object-fit: cover;">
															</center>
															<label class="col-form-label">Image</label>
															<input class="form-control" type="file" name="image" accept="image/*" onchange="readURL(this, '')" style="border: 0px; padding: 0px;" required>

															<!-- <label class="col-form-label">Condition</label>
															<select class="form-control" name="cond" id="type" required style="color: black!important;">
																<option value="" disabled selected hidden="">-- Please select --</option>
																<option value="Good">Good</option>
																<option value="Excellent">Excellent</option>
																<option value="Fair">Fair</option>
															</select> -->
														</div>
														<div class="form-group col-8">
															<label class="col-form-label">Name</label>
															<input class="form-control" type="text" name="name" required>

															<label class="col-form-label">Brand</label>
															<input class="form-control" type="text" name="brand" required>

															<label class="col-form-label">Quantity</label>
															<input class="form-control" type="number" name="qty" min="1" max="999" required>

													

															<label class="col-form-label">Search Tag</label>
															<input class="form-control" type="text" name="keywords" required>


															<label class="col-form-label">Date Arrived</label>
															<input class="form-control" type="date" name="date_arrived" required>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<input type="submit" class="btn green radius-xl outline" name="add_equipment" value="Add Equipment">
													<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</form>
								</div>

								<?php
									$status = 1;
									if (isset($_POST['add_equipment'])) {

										$filename=$_FILES['image']['name'];
										$file = basename($filename);

										if(strtolower(end(explode(".",$file))) =="mp4")
										{
										echo "<script>alert('Invalid file type.')</script>";
										}
										else {
											$is_image = getimagesize($_FILES["image"]["tmp_name"]) ? true : false;

											if ($is_image) {
												$name = $_POST['name'];
												$brand = $_POST['brand'];
												$qty = $_POST['qty'];
												$cond = "";
												$date_arrived = $_POST['date_arrived'];
												$date_added = date("Y-m-d H:i:s");

												$service = 'N/A2';
												$category = "none";
												$keywords = $_POST['keywords'];

												$path = '../assets/images/equipments/';
												$unique = time().uniqid(rand());
												$destination = $path . $unique . '.jpg';
												$base = basename($_FILES["image"]["name"]);
												$image = $_FILES["image"]["tmp_name"];
												move_uploaded_file($image, $destination);
												$status = 1;


												$model->addEquipment($unique, $name, $qty, $brand, $date_arrived, $cond, $date_added, $status, "2", $service, $category, $keywords);
												echo "<script>window.open('equipments', '_self');</script>";
											}

											else {
												echo "<script>alert('Invalid file type.')</script>";
											}
										}





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

			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</body>

</html>