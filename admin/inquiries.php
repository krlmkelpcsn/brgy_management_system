<?php
	
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

		<title><?php echo $web_name; ?></title>

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
	<body class="ttr-opened-sidebar ttr-pinned-sidebar" style="background-color: #FBFBFB;">

		<?php include 'navbar.php'; ?>

		<div class="ttr-sidebar">
			<div class="ttr-sidebar-wrapper content-scroll">
				
				<?php 
			
				include 'sidebar.php';
				
				$page = 'inquries';


				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #FBFBFB;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Manage Inquiries</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-help"></i>Inquiries</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-12 m-b30">

								<br>
								<div class="heading-bx left">
									<h2 class="m-b10 title-head">Inquiries <span></span></h2>
								</div>
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th width="5">Action</th>
												<th>Type</th>
												<th>Name</th>
												<th>Email</th>
												<th>Subject</th>
												<th>Message</th>
												<th>Date Sent</th>
											</tr>
										</thead>
										<tbody>
											<?php

												$rows = $model->fetchInquiries();

												if (!empty($rows)) {
													foreach ($rows as $row) {
														$name = $row['name'];
														$email = $row['email'];
														$subject = $row['subject'];
														$message = $row['message'];
														$date_sent = $row['date_sent'];

											?>
											<tr>
  											
												<td>
													<center>
														<div data-toggle="tooltip" title="Delete">
															<button data-toggle="modal" data-target="#delete-<?php echo $row['id']; ?>" class="btn red" style="width: 50px; height: 37px;">
																<i class="ti-archive" style="font-size: 12px;"></i>
															</button>
														</div>
													</center>
												</td>
												<td><?php if (($row['resident_id']==0)) { echo 'Random'; }else{ echo 'Resident';  }  ?></td>
												
												<td><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo $name; if ($row['read_unread'] == 0) { echo '</b>'; }  ?></td>
												<td><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo $email; if ($row['read_unread'] == 0) { echo '</b>'; } ?></td>
												<td><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo $subject; if ($row['read_unread'] == 0) { echo '</b>'; } ?></td>
												<td><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo $message; if ($row['read_unread'] == 0) { echo '</b>'; } ?></td>
												<td style="font-size: 14px;"><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo date('M. d, Y g:i A', strtotime($date_sent)); if ($row['read_unread'] == 0) { echo '</b>'; } ?></td>
											</tr>
											<div id="delete-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-md">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Delete Inquiry</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="delete-id" value="<?php echo $row['id']; ?>">
																<div class="row">
																	<div class="form-group col-12">
																		<label class="col-form-label">Name</label>
																		<input class="form-control" type="text" value="<?php echo $name; ?>" readonly>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Email</label>
																		<input class="form-control" type="text" value="<?php echo $email; ?>" readonly>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Subject</label>
																		<input class="form-control" type="text" value="<?php echo $subject; ?>" readonly>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Message</label>
																		<textarea class="form-control" readonly><?php echo $message; ?></textarea>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Date Sent</label>
																		<input class="form-control" type="text" value="<?php echo date('M. d, Y g:i A', strtotime($date_sent)); ?>" readonly>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn red radius-xl outline" name="delete" value="Delete">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php

													}
												}

												if (isset($_POST['delete'])) {
													$model->deleteInquiry($_POST['delete-id']);
												}

											?>
										</tbody>
									</table>
								</div>
								<br>

					</div>
				</div>
			</div>
		</main>
		<div class="ttr-overlay"></div>

		<?php $model->readInquiries(); ?>

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