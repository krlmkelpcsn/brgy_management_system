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

		<title>Lost Equipments</title>

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
				$secondnav = 'reports';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Manage Reported Equipments</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-clipboard"></i>Report Equipment</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-12 m-b30">

								<div class="heading-bx left">
									<h2 class="m-b10 title-head">Reported <span>Equipments</span></h2>
								</div>
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th width="100">Action</th>
												<th width="100">Image</th>
												<th>Equipment</th>
												<th>Items Lost</th>
												<th>Type</th>
												<th>Name</th>
												<!-- <th>College</th> -->
												<th>Date Lost</th>
												<th>Category</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$rows = $model->displayReports();

												if (!empty($rows)) {
													foreach ($rows as $row) {


													

											?>
											<tr>
												<td>
													<center>
														<button data-toggle="modal" data-target="#view-<?php echo $row['bid']; ?>" class="btn blue" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="View">
																<i class="ti-search" style="font-size: 12px;"></i>
															</div>
														</button>


														<?php 

														if ($row['report_category'] == "Replaced") {
														$colorr = "success";
														}

														else {
															$colorr = "danger";

														?>
														&nbsp;<button data-toggle="modal" data-target="#replace-<?php echo $row['bid']; ?>" class="btn green" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="Replace">
																<i class="ti-angle-double-up" style="font-size: 12px;"></i>
															</div>
														</button>
														<?php
														}

														?>
														
													</center>
												</td>
												<td><a href="../assets/images/equipments/<?php echo $row['photo']; ?>.jpg" target="_blank"><img src="../assets/images/equipments/<?php echo $row['photo']; ?>.jpg" style="width: 120px;height: 60px; object-fit: cover;"></a></td>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['item_lost']; ?></td>
												<td><?php echo $row['type']; ?></td>
												<td><?php echo $row['report_name']; ?></td>
												<!-- <td><?php echo $row['course']; ?></td> -->
												<td style="font-size: 14px;"><?php echo date('M. d, Y', strtotime($row['date_lost'])); ?></td>
												<td><center><span class='badge badge-<?php echo $colorr; ?>'><?php echo $row['report_category']; ?></span></center></td>
											</tr>
											<div id="view-<?php echo $row['bid']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Report Details</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="archive-id" value="<?php echo $row['id']; ?>">
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
																		<input class="form-control" type="text" name="item_lost" value="<?php echo $row['item_lost']; ?>" style="background-color: white;" readonly>

																		<label class="col-form-label">Type</label>
																		<input class="form-control" type="text" name="type" value="<?php echo $row['type']; ?>"style="background-color: white;" readonly> 

																		<label class="col-form-label">Name</label>
																		<input class="form-control" type="text" name="name" value="<?php echo $row['report_name']; ?>" style="background-color: white;" readonly> 

																		<label class="col-form-label">Address</label>
																		<input class="form-control" type="text" name="course" value="<?php echo $row['address']; ?>" style="background-color: white;" readonly> 

																		<label class="col-form-label">Contact</label>
																		<input class="form-control" type="text" name="course" value="<?php echo $row['contact']; ?>" style="background-color: white;" readonly> 

																		<label class="col-form-label">Category</label>
																		<input class="form-control" type="text" name="course" value="<?php echo $row['report_category']; ?>" style="background-color: white;" readonly> 

																		<label class="col-form-label">Date Lost</label>
																		<input class="form-control" type="text" name="date_lost" value="<?php echo date('M. d, Y', strtotime($row['date_lost'])); ?>" style="background-color: white;" readonly>

																		<label class="col-form-label">Reason</label>
																		<textarea class="form-control" type="text" name="reason" style="background-color: white;" readonly><?php echo $row['reason']; ?></textarea>
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

											<div id="replace-<?php echo $row['bid']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Replace Equipment</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="aid" value="<?php echo $row['aid']; ?>">
																<input type="hidden" name="bid" value="<?php echo $row['bid']; ?>">
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
																		<input class="form-control" type="text" name="item_lost" value="<?php echo $row['item_lost']; ?>" style="background-color: white;" readonly>

																		<label class="col-form-label">Type</label>
																		<input class="form-control" type="text" name="type" value="<?php echo $row['type']; ?>"style="background-color: white;" readonly> 

																		<label class="col-form-label">Name</label>
																		<input class="form-control" type="text" name="name" value="<?php echo $row['report_name']; ?>" style="background-color: white;" readonly> 

																		<label class="col-form-label">Address</label>
																		<input class="form-control" type="text" name="course" value="<?php echo $row['address']; ?>" style="background-color: white;" readonly> 

																		<label class="col-form-label">Contact</label>
																		<input class="form-control" type="text" name="course" value="<?php echo $row['contact']; ?>" style="background-color: white;" readonly> 

																		<label class="col-form-label">Category</label>
																		<input class="form-control" type="text" name="course" value="<?php echo $row['report_category']; ?>" style="background-color: white;" readonly> 

																		<label class="col-form-label">Date Lost</label>
																		<input class="form-control" type="text" name="date_lost" value="<?php echo date('M. d, Y', strtotime($row['date_lost'])); ?>" style="background-color: white;" readonly>

																		<label class="col-form-label">Reason</label>
																		<textarea class="form-control" type="text" name="reason" style="background-color: white;" readonly><?php echo $row['reason']; ?></textarea>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn yellow radius-xl outline" name="replace" value="Replace">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php 

													}
												}

												if (isset($_POST['replace'])) {


													$equipment_id = $_POST['aid'];
													$qty = $_POST['qty'];
													$item_lost = $_POST['item_lost'];
													$date_reported = date("Y-m-d H:i:s");
													$new_qty = $qty + $item_lost;

													$reportid = $_POST['bid'];


													$model->updateReportStatus("Replaced", $reportid);
													
													$model->updateEquipmentQty($new_qty, $date_reported, $equipment_id);
													echo "<script>window.open('reports2', '_self');</script>";
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

			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</body>

</html>