<?php
    use setasign\Fpdi\Fpdi;

	ob_start(); 
	session_start(); 
	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['org_sess'])) {
		echo "<script>window.open('../','_self');</script>";
	}
	
		if(isset($_POST["brgy_clearance"])) { 
		require_once('fpdf/fpdf.php');
		require_once('vendor/setasign/fpdi/src/autoload.php');
		$pdf = new Fpdi();
		$pdf->AddPage();
		$pdf->setSourceFile('../assets/pdf/clearance.pdf');
		$tplIdx = $pdf->importPage(1);
		$pdf->SetTitle("BARANGAY CLEARANCE");  
		$pdf->useTemplate($tplIdx, 0, 0, 200, 290);
		$pdf->SetFont('Times');
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetXY(118, 87);
		$pdf->Write(0, $_POST['name']);
		$pdf->SetXY(132, 97);
		$pdf->Write(0, $_POST['address']);
		$pdf->SetXY(153, 97);
		$pdf->Write(0, $_POST['address2']);
		$pdf->SetXY(118, 122);
		$pdf->Write(0, $_POST['purpose']);
		$pdf->SetXY(118, 138);
		$pdf->Write(0, date('M. d, Y', strtotime($_POST['date_issued'])));
		ob_end_clean();
		$pdf->Output('I', 'BARANGAYCLEARANCE.pdf');
	}

	if(isset($_POST["residency"])) { 
		require_once('fpdf/fpdf.php');
		require_once('vendor/setasign/fpdi/src/autoload.php');
		$pdf = new Fpdi();
		$pdf->AddPage();
		$pdf->setSourceFile('../assets/pdf/residency.pdf');
		$tplIdx = $pdf->importPage(1);
		$pdf->SetTitle("CERTIFICATE OF RESIDENCY");  
		$pdf->useTemplate($tplIdx, 0, 0, 200, 290);
		$pdf->SetFont('Times');
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetXY(84, 92);
		$pdf->Write(0, date('M. d, Y', strtotime($_POST['date_issued'])));
		$pdf->SetXY(112, 137);
		$pdf->Write(0, $_POST['name']);
		$pdf->SetXY(142, 142);
		$pdf->Write(0, $_POST['address']);
		$pdf->SetXY(155, 142);
		$pdf->Write(0, $_POST['address2']);
		$pdf->SetXY(136, 147);
		$pdf->Write(0, $_POST['resident_since']);
		$pdf->SetXY(93, 157);
		$pdf->Write(0, date('j', strtotime($_POST['date_issued'])));
		$pdf->SetXY(113, 157);
		$pdf->Write(0, date('F', strtotime($_POST['date_issued'])));
		ob_end_clean();
		$pdf->Output('I', 'BARANGAYRESIDENCY.pdf');
	}

	if(isset($_POST["indigency"])) { 
		require_once('fpdf/fpdf.php');
		require_once('vendor/setasign/fpdi/src/autoload.php');
		$pdf = new Fpdi();
		$pdf->AddPage();
		$pdf->setSourceFile('../assets/pdf/indigency.pdf');
		$tplIdx = $pdf->importPage(1);
		$pdf->SetTitle("CERTIFICATE OF INDIGENCY");  
		$pdf->useTemplate($tplIdx, 0, 0, 200, 290);
		$pdf->SetFont('Times');
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetXY(73, 98);
		$pdf->Write(0, date('M. d, Y', strtotime($_POST['date_issued'])));
		$pdf->SetXY(107, 133);
		$pdf->Write(0, $_POST['name']);
		$pdf->SetXY(177, 133);
		$pdf->Write(0, strtolower($_POST['civil_status']));
		$pdf->SetXY(156, 138);
		$pdf->Write(0, $_POST['address']);
		$pdf->SetXY(169, 138);
		$pdf->Write(0, $_POST['address2']);
		$pdf->SetXY(168, 143);
		$pdf->Write(0, $_POST['resident_since']);
		$pdf->SetXY(91, 153);
		$pdf->Write(0, date('j', strtotime($_POST['date_issued'])));
		$pdf->SetXY(107, 153);
		$pdf->Write(0, date('F Y', strtotime($_POST['date_issued'])));
		$pdf->SetXY(91, 158);
		$pdf->Write(0, $_POST['purpose']);
		ob_end_clean();
		$pdf->Output('I', 'BARANGAYINDIGENCY.pdf');
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

		<title>Barangay Cruz</title>

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
				
				$page = 'request';
				$secondnav = 'walk-in';

				include 'nav.php'; 

				?>
				
			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #FCFCFC;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Monitoring of Request</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-server"></i>Walk-In Request</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-4 m-b30">
						<form class="contact-bx dzForm" method="post">
							<div class="dzFormMsg"></div>
							<div class="heading-bx left">
								<h2 class="title-head">Request <span>Services</span></h2>
							</div>
							<div style="padding: 5px;"></div>
							<div class="row placeani" id="sent">
								<div class="col-lg-12">
								    <br>
								    <label>Requestor Name</label>
								    <select class="form-control" id="residents">
								        <?php
								        
								            $rows = $model->fetchResidents();
								            
								            if (!empty($rows)) {
								                foreach ($rows as $row) {
								                    echo '<option value="'.$row['id'].'">'.$row['fname'].' '.$row['mname'].' '.$row['$lname'].'</option>';
								                }
								            }
								        
								        ?>
									</select>
									<!--<input type="text" class="form-control" id="resident-id" placeholder="Enter Brgy ID">-->
									<!--<input type="hidden" name="hidden-id" id="hidden-id">-->
								</div>
								<div class="col-lg-12">
								    <br>
								    <label>Certificate Type</label>
									<select class="form-control" name="type">
										<option value="1" selected>Request of Barangay Clearance</option>
										<option value="2">Request Certificate of Residency</option>
										<option value="3">Request Certificate of Indigency</option>
									</select>
								</div>
								`<!--<div class="col-lg-12">
									<br>
									<div class="form-group">
										<label>Name</label>
										<div class="input-group" id="name"></div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Block</label>
										<div class="input-group" id="block"></div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Lot</label>
										<div class="input-group" id="lot"></div>
									</div>
								</div>-->
								<div class="col-lg-12">
									<div class="form-group">
										<label>Purpose</label>
										<div class="input-group">
											<textarea name="message" rows="1" class="form-control" required minlength="5" maxlength="300" style="background-color:white;" ></textarea>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label>Date Requested</label>
										<div class="input-group">
											<?php echo date("F d, Y"); ?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
							    <div id="button_request"></div>
							</div>
						</form>
					</div>
					<?php

						if (isset($_POST['post_msg'])) {
							$model->addWalkInRequest($_POST['hidden-id'], $_POST['type'], $_POST['message']);
							echo "<script>window.open('walk-in-request', '_self')</script>";
						}

					?>
					<div class="col-lg-8 m-b30">
					    <div class="heading-bx left">
							<h2 class="title-head">Walk-In <span>Requests</span></h2>
						</div>
					    <div class="table-responsive">
							<table id="table" class="table hover" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Certificate Type</th>
										<th>Date Sent</th>
										<!--<th>Pickup Date</th>-->
										<th width="80">Status</th>
										<th width="80">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php

										$rows = $model->fetchRequestsHistory(10);

										if (!empty($rows)) {
											foreach ($rows as $row) {
												switch ($row['request_type']) {
													case 1:
														$type = 'Brgy. Clearance';
														break;
													case 2:
														$type = 'Certif. of Residency';
														break;
													case 3:
														$type = 'Certif. of Indigency';
														break;
													default:
														$type = 'N/A';
														break;
												}

												$name = trim($row['fname']).' '.trim($row['mname']).' '.trim($row['lname']);
												
												if ($row['status2'] == "Processing") {
												    $status2 = "warning";
												}
												else { 
												    $status2 = "success";
												}

									?>
									<tr>
										<td><a href="residents-profile?id=<?php echo $row['resident_id']; ?>" style="color: black;"><?php echo $name; ?></a></td>
										<td><?php echo $type; ?></td>
										<td style="font-size: 14px;"><?php echo date('M. d, Y g:i A', strtotime($row['date_issued'])); ?></td>
										<!--<td>-->
										<!--	<?php echo date('M. d, Y', strtotime($row['date_pickup'])); ?>-->
										<!--</td>-->
										<td>
											<center><span class="badge badge-<?php echo $status2; ?>"><a href="" style="font-size: 14px;color: white;" data-toggle="modal" data-target="#status-<?php echo $row['id']; ?>"><?php echo $row['status2']; ?></a></span></center> 
										</td>
										<td>
											<center>
												<?php
												if ($row['status'] == 10) {
													if ($row['request_type'] == 1){
												?>
												<form method="POST" target="_blank">
													<input type="hidden" name="name" value="<?php echo $name; ?>">
													<input type="hidden" name="address" value="<?php echo $row['address']; ?>">
													<input type="hidden" name="address2" value="<?php echo $row['address2']; ?>">
													<input type="hidden" name="purpose" value="<?php echo $row['purpose']; ?>">
													<input type="hidden" name="date_issued" value="<?php echo $row['date_issued']; ?>">
													<button type="submit" name="brgy_clearance" class="btn btn-block green radius-xl" style="float: right;">PRINT</button><br><br>
												</form>
												<?php	
													}
													else if ($row['request_type'] == 2){
												?>
												<form method="POST" target="_blank">
													<input type="hidden" name="name" value="<?php echo $name; ?>">
													<input type="hidden" name="address" value="<?php echo $row['address']; ?>">
													<input type="hidden" name="address2" value="<?php echo $row['address2']; ?>">
													<input type="hidden" name="purpose" value="<?php echo $row['purpose']; ?>">
													<input type="hidden" name="resident_since" value="<?php echo $row['resident_since']; ?>">
													<input type="hidden" name="date_issued" value="<?php echo $row['date_issued']; ?>">
													<button type="submit" name="residency" class="btn btn-block green radius-xl" style="float: right;">PRINT</button><br><br>
												</form>
												<?php
													}
													else if ($row['request_type'] == 3){
												?>
												<form method="POST" target="_blank">
													<input type="hidden" name="name" value="<?php echo $name; ?>">
													<input type="hidden" name="address" value="<?php echo $row['address']; ?>">
													<input type="hidden" name="address2" value="<?php echo $row['address2']; ?>">
													<input type="hidden" name="purpose" value="<?php echo $row['purpose']; ?>">
													<input type="hidden" name="resident_since" value="<?php echo $row['resident_since']; ?>">
													<input type="hidden" name="civil_status" value="<?php echo $row['civil_status']; ?>">
													<input type="hidden" name="date_issued" value="<?php echo $row['date_issued']; ?>">
													<button type="submit" name="indigency" class="btn btn-block green radius-xl" style="float: right;">PRINT</button><br><br>
												</form>
												<?php
													}
													else {
														echo "<span style='color: red;'><b>ERROR</b></span>";
													}
												}
												else if ($row['status'] == 4) {
												?>
													<span style="color: red;"><b>CANCELLED</b></span>
												<?php
												}
												else {
												?>
													<span style="color: red;"><b>DECLINED</b></span>
												<?php
												}
												?>
											</center>
										</td>
									</tr>
									<div id="status-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
										<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Update Request Status</h4>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body">
														<div class="row">
															<input class="form-control" type="hidden" name="approve_id" value="<?php echo $row['id']; ?>">
															<div class="form-group col-12">
																<label class="col-form-label">Certificate Type</label>
																<input class="form-control" type="text" value="<?php echo $type; ?>" readonly>
															</div>
															<div class="form-group col-12">
																<label class="col-form-label">Purpose</label>
																<input class="form-control" type="text" value="<?php echo $row['purpose']; ?>" readonly>
															</div>
															<div class="form-group col-12">
																<label class="col-form-label">Date Request</label>
																<input class="form-control" type="text" value="<?php echo date('M. d, Y g:i A', strtotime($row['date_issued'])); ?>" readonly>
															</div>
															<div class="form-group col-12">
																<label class="col-form-label">Pickup Date</label>
																<input class="form-control" type="text" value="<?php echo date('M. d, Y', strtotime($row['date_pickup'])); ?>" readonly>
															</div>
															<div class="form-group col-12">
																<label class="col-form-label">Status</label>
																<select class="form-control" name="status2">
																	<option value="Processing"<?php if ($row['status2'] == "Processing") { echo "selected"; } else {} ?>>Processing</option>
																	<option value="For Pick Up"<?php if ($row['status2'] == "For Pick Up") { echo "selected"; } else {} ?>>For Pick Up</option>
																	<option value="Picked Up"<?php if ($row['status2'] == "Picked Up") { echo "selected"; } else {} ?>>Picked Up</option>
																</select>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<input type="submit" class="btn green radius-xl outline" name="status" value="Update Status">
														<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</form>
									</div>
									<?php

										}
									}

									if (isset($_POST['status'])) {
										$model->changeRequestStatus($_POST['status2'], $_POST['approve_id']);
										echo "<script>window.open('approved-request', '_self');</script>";
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

		<script type="text/javascript">
			$(document).ready(function() {
			    var resident_library = [<?php $rows = $model->fetchResidents(); if (!empty($rows)) { foreach ($rows as $row) { echo '['.$row['id'].', ["'.$row['address'].'", "'.$row['address2'].'"]],'; }}?>];
			    
			    $('#residents').change( function() {
	                var resident_id = $(this).val();
			        
	                resident_library.forEach(function(item) {
	                    if (item[0] == resident_id) {
	                        $('#block').html(item[1][0]);
	                        $('#lot').html(item[1][1]);
	                    }
	                });
			    });
			    
				$('#resident-id').keyup( function() {
					var resident_id = $('#resident-id').val();

					$.ajax({
						url:'fetch-resident.php',
						method:'POST',
						data: {
							resident_id : resident_id
						},
						dataType:"json",
						success:function(data) {
							$('#name').html(data[0]+' '+data[1]+' '+data[2]);
							$('#block').html(data[3]);
							$('#lot').html(data[4]);
							$('#hidden-id').attr('value', data[5]);
							
							if (data[0] != '') {
							    $('#button_request').html('<center><button name="post_msg" type="submit" class="btn button-md button-block">Submit Request</button></center>');
							}
							
							else {
							    $('#button_request').html('');
							}
						}
					});
				});

				$('#table').DataTable();
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</body>

</html>