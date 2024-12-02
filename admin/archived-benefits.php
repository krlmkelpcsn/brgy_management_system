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

		<title>Archived Blotters</title>

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
				
				$page = 'benefits';
				$secondnav = 'benefits';

				include 'nav.php'; 

				?>
				
			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #FCFCFC;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Benefits Management</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-agenda"></i>Archived Benefits</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-12 m-b30">

								
								<div align="right">
									<a href="benefits-management" class="btn green radius-xl" style="background-color: <?php echo $primary_color; ?>;"><i class="ti-agenda"></i><span>&nbsp;Active Benefits Record</span></a>
								</div>
								<div style="padding: 25px;"></div>
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
                    <tr>
												<th>ID</th>
												<th>Name</th>
												<th>Type</th>
												<th>Description</th>
												<th>Eligibility</th>
												<th>Start Date</th>
												<th>End Date</th>
												<!-- <th>Status</th> -->
												<th width="100">Action</th>
												<!-- <th width="50">Narrative</th></th> -->
											</tr>
										</thead>
										<tbody>
                    <?php
												$benefit_status = 2;
												$rows = $model->getAllBenefits($benefit_status);

												if (!empty($rows)) {
													foreach ($rows as $row) {
														$id = $row['id'];
														$benefit_name = $row['benefit_name'];
														$description = $row['description'];
														$type = $row['type'];
														$eligibility_criteria = $row['eligibility_criteria'];
														$start_date = $row['start_date'];
														$end_date = $row['end_date'];												
											?>
									    <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo ($benefit_name);?></td>
            <td><?php echo ($type); ?></td>
            <td style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;" title="<?php echo htmlspecialchars($description); ?>"><?php echo ($description); ?></td>
						<td style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;" title="<?php echo htmlspecialchars($eligibility_criteria); ?>"><?php echo ($eligibility_criteria); ?></td>
            <td style="font-size: 14px;"><?php echo date('M. d, Y / h:i A', strtotime($start_date)); ?></td>
            <td style="font-size: 14px;"><?php echo date('M. d, Y / h:i A ', strtotime($end_date)); ?></td>
						<!-- <td>
											<center>
												<span class="badge badge-<?php echo $benefit_status2; ?>"><a href="" style="font-size: 14px;color: white;" data-toggle="modal" data-target="#status-<?php echo $row['id']; ?>"><?php echo $benefit_status; ?></a></span>
											
											</center> 
										</td> -->
										
                    <td><center></a>&nbsp;<a href="" class="btn green" style="width: 50px; height: 37px;" data-toggle="modal" data-target="#decline-<?php echo htmlspecialchars($row['id'] ?? ''); ?>"><div data-toggle="tooltip" title="Restore"><i class="ti-archive" style="font-size: 12px;"></i></div></a></center>

<div id="decline-<?php echo htmlspecialchars($row['id'] ?? ''); ?>" class="modal fade" role="dialog">
    <form class="edit-profile m-b30" method="POST">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <img src="../assets/images/<?php echo htmlspecialchars($web_icon); ?>.png" style="width: 30px; height: 30px;">
                        &nbsp;Archive Benefits Record
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="decline_hidden" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="col-form-label"><b>Benefit ID</b></label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['id']); ?>" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label class="col-form-label"><b>Benefit Name</b></label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['benefit_name']); ?>" readonly>
                        </div> 
												 <div class="form-group col-6">
                            <label class="col-form-label"><b>Benefit Type</b></label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['type']); ?>" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label class="col-form-label"><b>Description</b></label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['description']); ?>" readonly>
                        </div>
												<div class="form-group col-6">
														<label class="col-form-label"><b>Eligibility</b></label>
														<input class="form-control" type="text" value="<?php echo htmlspecialchars($row['eligibility_criteria']); ?>" readonly>
												</div>
                      
                        <div class="form-group col-6">
                            <label class="col-form-label"><b>Start Date</b></label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['start_date']); ?>" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label class="col-form-label"><b>End Date</b></label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['end_date']); ?>" readonly>
                        </div>
                    </div>
                </div>
									<div class="modal-footer">
																<input type="submit" class="btn green radius-xl outline" name="archive" value="Restore">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
							</div>
					</div>
			</form>
	</div>
											<?php


														if (isset($_POST['archive'])) {
															$decline_hidden = $_POST['decline_hidden'];
															$model->archiveBenefit(1, $decline_hidden);
															echo "<script>window.open('archived-benefits', '_self');</script>";
														}
												
													}}
											?>
										</tbody>
									</table>
								</div>
								<br>
								<hr>
								<!-- <div align="right">
									<a href="" class="btn green radius-xl" style="float: right;background-color: #267621;" data-toggle="modal" data-target="#add-blotters"><i class="ti-agenda"></i><span>&nbsp;ADD NEW BLOTTERS</span></a><br>
								</div> -->
								
							<!-- Add Data - Modal -->
								<div id="add-benefits" class="modal fade" role="dialog">
									<form class="edit-profile m-b30" method="POST">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Add Benefits</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-12">
														</div>
														<div class="form-group col-6">
															<label class="col-form-label">Benefit Name</label>
															<input class="form-control" type="text" name="benefit_name" required>
														</div>

														<div class="form-group col-6">
															<label class="col-form-label">Benefit Type</label>
															<input class="form-control" type="text" name="type" required>
														</div>

														<div class="form-group col-6">
															<label class="col-form-label">Description</label>
															<textarea class="form-control h-0" type="text" name="description" required></textarea>
														</div>
											
														<div class="form-group col-6">
															<label class="col-form-label">Eligibility</label>
															<textarea class="form-control" type="text" name="eligibility_criteria" required></textarea>
														</div>
													
														<div class="form-group col-6">
															<label class="col-form-label">Start Date & Time</label>
															<input class="form-control" type="datetime-local" name="start_date" required>
														</div>
												
														
														<div class="form-group col-6">
															<label class="col-form-label">End Date & Time</label>
															<input class="form-control" type="datetime-local" name="end_date" required>
														</div>
													
													</div>
												</div>
											
												<div class="modal-footer">
													<input type="submit" class="btn green radius-xl outline" name="add-confirm" value="Add">
													<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</form>
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
			$(document).ready(function() {
				$('#table').DataTable();
			});
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</body>

</html>