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
		$pdf->SetTitle("BARANGAY CRUZ");  
		$pdf->useTemplate($tplIdx, 0, 0, 200, 290);
		$pdf->SetFont('Times', 'B', 11);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetXY(116, 92);
		$pdf->Write(0, $_POST['name']);

		$pdf->SetXY(142, 102);
		$pdf->Write(0, substr($_POST['address3'], -1));

		$pdf->SetXY(91, 165);
		$pdf->Write(0, date('jS', strtotime($_POST['date_issued'])));

		$pdf->SetXY(122, 165);
		$pdf->Write(0, strtoupper(date('F', strtotime($_POST['date_issued']))));

		ob_end_clean();
 		$pdf->Output('I', ''.$_POST['name'].' - Brgy. Clearance.pdf');
	}

	if(isset($_POST["residency"])) { 
		require_once('fpdf/fpdf.php');
		require_once('vendor/setasign/fpdi/src/autoload.php');
		$pdf = new Fpdi();
		$pdf->AddPage();
		$pdf->setSourceFile('../assets/pdf/residency.pdf');
		$tplIdx = $pdf->importPage(1);
		$pdf->SetTitle("BARANGAY CRUZ"); 
		$pdf->useTemplate($tplIdx, 0, 0, 200, 290);
		$pdf->SetFont('Times', 'B', 11);
		$pdf->SetTextColor(0, 0, 0);

		$pdf->SetXY(116, 92);
		$pdf->Write(0, $_POST['name']);

		$pdf->SetXY(77, 134);
		$pdf->Write(0, substr($_POST['address3'], -1));

		$pdf->SetXY(151, 134);
		$pdf->Write(0, $_POST['resident_since']);

		$pdf->SetXY(92, 165);
		$pdf->Write(0, date('jS', strtotime($_POST['date_issued'])));

		$pdf->SetXY(123, 165);
		$pdf->Write(0, strtoupper(date('F', strtotime($_POST['date_issued']))));
		ob_end_clean();
		$pdf->Output('I', ''.$_POST['name'].' - Certificate of Residency.pdf');
	}

	if(isset($_POST["indigency"])) { 
		require_once('fpdf/fpdf.php');
		require_once('vendor/setasign/fpdi/src/autoload.php');
		$pdf = new Fpdi();
		$pdf->AddPage();
		$pdf->setSourceFile('../assets/pdf/indigency.pdf');
		$tplIdx = $pdf->importPage(1);
		$pdf->SetTitle("BARANGAY CRUZ");  
		$pdf->useTemplate($tplIdx, 0, 0, 200, 290);
		$pdf->SetFont('Times', 'B', 11);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetXY(59, 102);
		$pdf->Write(0, $_POST['name']);

		$pdf->SetXY(59, 133);
		$pdf->Write(0, $_POST['name']);

		$pdf->SetXY(93, 155);
		$pdf->Write(0, $_POST['purpose']);

		$pdf->SetXY(90, 165);
		$pdf->Write(0, date('jS', strtotime($_POST['date_issued'])));

		$pdf->SetXY(119, 165);
		$pdf->Write(0, strtoupper(date('F', strtotime($_POST['date_issued']))));
		ob_end_clean();
		$pdf->Output('I', ''.$_POST['name'].' - Certificate of Indigency.pdf');
	}
	
	if(isset($_POST["business"])) { 
		require_once('fpdf/fpdf.php');
		require_once('vendor/setasign/fpdi/src/autoload.php');
		$pdf = new Fpdi();
		$pdf->AddPage();
		$pdf->setSourceFile('../assets/pdf/business.pdf');
		$tplIdx = $pdf->importPage(1);
		$pdf->SetTitle("BARANGAY CRUZ");  
		$pdf->useTemplate($tplIdx, 0, 0, 200, 290);
		$pdf->SetFont('Times', 'B', 11);
		$pdf->SetTextColor(0, 0, 0);

		$pdf->SetXY(131, 103);
		$pdf->Write(0, $_POST['name']);
        
        $pdf->SetXY(81, 113);
		$pdf->Write(0, $_POST['address']);
		
		$pdf->SetXY(94, 123.9);
		$pdf->Write(0, $_POST['business_name']);
		
		$pdf->SetXY(83, 134.7);
		$pdf->Write(0, $_POST['purpose']);

		$pdf->SetXY(93.5, 176);
		$pdf->Write(0, date('jS', strtotime($_POST['date_issued'])));

		$pdf->SetXY(131.5, 176);
		$pdf->Write(0, strtoupper(date('F', strtotime($_POST['date_issued']))));
		
		$pdf->SetXY(112, 186);
		$pdf->Write(0, strtoupper(date('F d', strtotime($_POST['date_issued']))));
		
		
		ob_end_clean();
		$pdf->Output('I', ''.$_POST['name'].' - Barangay Business Clearance.pdf');
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

		<title>Monitoring Requests</title>

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
						<li><i class="ti-file"></i>All Requests</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-4 m-b30">
						<form class="contact-bx dzForm" method="post">
							<div class="dzFormMsg"></div>
							<div class="heading-bx left">
								<h2 class="title-head">Walk-In <span>Requests</span></h2>
							</div>
							<div style="padding: 5px;"></div>
							<div class="row placeani" id="sent">
								<div class="col-lg-12">
								    <br>
								    <label>Requestor Name</label>
								    <select class="form-control" id="residents" name="hidden-id">
								        <?php
								        
								            $rows = $model->fetchResidents();
								            
								            if (!empty($rows)) {
								                foreach ($rows as $row) {
								                    echo '<option value="'.$row['id'].'">'.$row['lname'].', '.$row['fname'].' '.$row['mname'].'</option>';
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
									<select class="form-control" name="type" id="switch-page">
										<option value="1">Request of Barangay Clearance (w/o pic)</option>
										<option value="2">Request Certificate of Residency (w/o pic)</option>
										<option value="3">Request Certificate of Indigency (w/o pic)</option>
										<option value="4">Request Business Clearance (w/o pic)</option>
										
										<option value="5">Request of Barangay Clearance (w/ pic)</option>
										<option value="6">Request Certificate of Residency (w/ pic)</option>
										<option value="7">Request Business Clearance (w/ pic)</option>
									</select>
								</div>
								<div class="col-lg-12">
								    <br>
												<div class="form-group">
													<label>Business Name</label><div class="input-group">
													    <input class="form-control" type="text" name="business_name" required maxlength="80" style="background-color:#FFFFFF; resize:none;padding: 5px;">
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Business Address</label><div class="input-group">
														<textarea name="message" rows="1" class="form-control" required minlength="5" maxlength="100" style="background-color:#FFFFFF; resize:none;box-sizing: border-box;padding: 5px;"></textarea>
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
								<div class="col-lg-6">
												<div class="form-group">
													<label>Price</label><div class="input-group">
														₱20.00
													</div>
												</div>
											</div>
							</div>
							<div class="col-lg-12">
							    <center><button name="post_msg" type="submit" class="btn button-md button-block">Submit Request</button></center>
							    
							    
							    <!--<div id="button_request"></div>-->
							</div>
						</form>
					</div>
					<?php

						if (isset($_POST['post_msg'])) {
							$model->addWalkInRequest2($_POST['hidden-id'], 4, $_POST['business_name'], $_POST['message']);
							echo "<script>window.open('business', '_self')</script>";
						}

					?>
					<div class="col-lg-8 m-b30">
					    <div class="heading-bx left">
							<h2 class="title-head">Pending <span> Requests</span></h2>
						</div>
					    <div class="table-responsive">
							<table id="table" class="table hover" style="width:100%">
								<thead>
									<tr style="text-align:center;">
										<th>Name</th>
										<th>Certificate Type</th>
										<th>Date Sent</th>
										<!--<th>Pickup Date</th>-->
										<th width="80">Status</th>
										<th width="100">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php

										$rows = $model->fetchPendingHistory(10);

										if (!empty($rows)) {
											foreach ($rows as $row) {
												switch ($row['request_type']) {
													case 1:
														$type = 'Brgy. Clearance';
														break;
													case 2:
														$type = 'Certif, of Residency';
														break;
													case 3:
														$type = 'Certif, of Indigency';
														break;
													case 4:
														$type = 'Business Clearance';
														break;
													default:
														$type = 'N/A';
														break;
												}

												$name = trim($row['fname']).' '.trim($row['lname']);
												
												if ($row['status2'] == "Processing") {
												    $status2 = "success";
												}
												else { 
												    $status2 = "success";
												}
												if ($row['request_status'] == "2") {
												    $status2 = "primary";
												    $row['status2'] = "Pending";
												}
												if ($row['request_status'] == "3") {
												    $status2 = "danger";
												    $row['status2'] = "Declined";
												}
												
												if ($row['request_status'] == 4) {
												    $status2 = "danger";
												    $row['status2'] = "Cancelled";
												}
												
												$address = $row['address3'];

									?>
									<tr>
										<td><a href="residents-profile?id=<?php echo $row['resident_id']; ?>" style="color: black;"><?php echo $name; ?></a></td>
										<td><?php echo $type; ?></td>
										<td style="font-size: 14px;"><?php echo date('M. d, Y g:i A', strtotime($row['date_issued'])); ?></td>
										<!--<td>-->
										<!--	<?php echo date('M. d, Y', strtotime($row['date_pickup'])); ?>-->
										<!--</td>-->
										<td>
										    <?php 
										    if ($row['request_status'] == "2" || $row['request_status'] == "3" || $row['request_status'] == "4") {
												    
										    ?>
										    <center><span class="badge badge-<?php echo $status2; ?>"><a href="" style="font-size: 14px;color: white;" ><?php echo $row['status2']; ?></a></span></center> 
										    
										    <?php
											}
										    else {
										    
										    ?>
										    <center><span class="badge badge-<?php echo $status2; ?>"><a href="" style="font-size: 14px;color: white;" data-toggle="modal" data-target="#status-<?php echo $row['id']; ?>"><?php echo $row['status2']; ?></a></span></center> 
										    <?php  
										    }
										    
										    ?>
											
										</td>
										<td>
											<center>
											    
											<?php 
										    if ($row['request_status'] == "2") {
												    
										    ?>
										    <a href="" class="btn green" style="width: 45px; height: 37px;" data-toggle="modal" data-target="#approve-<?php echo $row['id']; ?>">
													<div data-toggle="tooltip" title="Approve">
														<i class="ti-check" style="font-size: 15px; margin-left:-5px;"></i>
													</div>
											</a>&nbsp;
											<a href="" class="btn red" style="width: 45px; height: 37px;" data-toggle="modal" data-target="#decline-<?php echo $row['id']; ?>">
													<div data-toggle="tooltip" title="Decline">
														<i class="ti-close" style="font-size: 15px; margin-left:-5px;"></i>
													</div>
											</a>
										    <?php
											}
										    else {
										    
										    ?>
										    <?php
												if ($row['status'] == 10) {
													if ($row['request_type'] == 1){
												?>
												<form method="POST" target="_blank">
													<input type="hidden" name="name" value="<?php echo strtoupper($name); ?>">
													<input type="hidden" name="address3" value="<?php echo strtoupper($row['address3']); ?>">
													<input type="hidden" name="date_issued" value="<?php echo strtoupper($row['date_issued']); ?>">
													<button type="submit" name="brgy_clearance" class="btn btn-block green radius-xl" style="float: right;">PRINT</button><br><br>
												</form>
												<?php	
													}
													else if ($row['request_type'] == 2){
												?>
												<form method="POST" target="_blank">
													<input type="hidden" name="name" value="<?php echo strtoupper($name); ?>">
													<input type="hidden" name="address3" value="<?php echo strtoupper($row['address3']); ?>">
													<input type="hidden" name="resident_since" value="<?php echo strtoupper($since); ?>">
													<input type="hidden" name="date_issued" value="<?php echo strtoupper($row['date_issued']); ?>">
													<button type="submit" name="residency" class="btn btn-block green radius-xl" style="float: right;">PRINT</button><br><br>
												</form>
												<?php
													}
													else if ($row['request_type'] == 3){
												?>
												<form method="POST" target="_blank">
													<input type="hidden" name="name" value="<?php echo strtoupper($name); ?>">
													<input type="hidden" name="address" value="<?php echo strtoupper($row['address']); ?>">
													<input type="hidden" name="address2" value="<?php echo strtoupper($row['address2']); ?>">
													<input type="hidden" name="purpose"  value="<?php echo strtoupper($row['purpose']); ?>">
													<input type="hidden" name="resident_since" value="<?php echo strtoupper($row['resident_since']); ?>">
													<input type="hidden" name="civil_status" value="<?php echo strtoupper($row['civil_status']); ?>">
													<input type="hidden" name="date_issued" value="<?php echo strtoupper($row['date_issued']); ?>">
													<button type="submit" name="indigency" class="btn btn-block green radius-xl" style="float: right;">PRINT</button><br><br>
												</form>
												<?php
													}
													else if ($row['request_type'] == 4){
												?>
												<form method="POST" target="_blank">
													<input type="hidden" name="name" value="<?php echo strtoupper($name); ?>">
													<input type="hidden" name="address" value="<?php echo strtoupper($address); ?>">
													<input type="hidden" name="business_name"  value="<?php echo strtoupper($row['business_name']); ?>">
													<input type="hidden" name="purpose"  value="<?php echo strtoupper($row['purpose']); ?>">
													<input type="hidden" name="resident_since" value="<?php echo strtoupper($row['resident_since']); ?>">
													<input type="hidden" name="civil_status" value="<?php echo strtoupper($row['civil_status']); ?>">
													<input type="hidden" name="date_issued" value="<?php echo strtoupper($row['date_issued']); ?>">
													<button type="submit" name="business" class="btn btn-block green radius-xl" style="float: right;">PRINT</button><br><br>
												</form>
												<?php
													}
													else {
														echo "<span style='color: red;'><b>ERROR</b></span>";
													}
												}
												else if ($row['status'] == 4) {
												?>
													<span><b>N/A</b></span>
												<?php
												}
												else {
												?>
													<span style=""><b>N/A</b></span>
												<?php
												}
												?>
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
																<label class="col-form-label">Name</label>
																<input class="form-control" type="text" value="<?php echo $name; ?>" readonly>
															</div>
															<?php 
															if ($row['request_type'] == 4) {
															?>
															
															<div class="form-group col-12">
																<label class="col-form-label">Business Name</label>
																<input class="form-control" type="text" value="<?php echo $row['business_name']; ?>" readonly>
															</div>
															
															<div class="form-group col-12">
																<label class="col-form-label">Business Address</label>
																<input class="form-control" type="text" value="<?php echo $row['purpose']; ?>" readonly>
															</div>
															<?php
															}
															else {
															?>
															<div class="form-group col-12">
																<label class="col-form-label">Purpose</label>
																<input class="form-control" type="text" value="<?php echo $row['purpose']; ?>" readonly>
															</div>
															<?php
															}
															?>
															
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
									
									
									<div id="approve-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
										<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Approve Request</h4>
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
																<label class="col-form-label">Name</label>
																<input class="form-control" type="text" value="<?php echo $name; ?>" readonly>
															</div>
															<?php 
															if ($row['request_type'] == 4) {
															?>
															<div class="form-group col-12">
																<label class="col-form-label">Business Name</label>
																<input class="form-control" type="text" value="<?php echo $row['business_name']; ?>" readonly>
															</div>
															
															<div class="form-group col-12">
																<label class="col-form-label">Business Address</label>
																<input class="form-control" type="text" value="<?php echo $row['purpose']; ?>" readonly>
															</div>
															<?php
															}
															else {
															?>
															<div class="form-group col-12">
																<label class="col-form-label">Purpose</label>
																<input class="form-control" type="text" value="<?php echo $row['purpose']; ?>" readonly>
															</div>
															<?php
															}
															?>
															<div class="form-group col-12">
																<label class="col-form-label">Date Request</label>
																<input class="form-control" type="text" value="<?php echo date('M. d, Y g:i A', strtotime($row['date_issued'])); ?>" readonly>
															</div>
															<div class="form-group col-12">
																<label class="col-form-label">Pickup Date</label>
																<input class="form-control" type="date" name="pickup-date" min="<?php echo date('Y-m-d', strtotime("+1 day", strtotime($row['date_issued']))); ?>" required>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<input type="submit" class="btn green radius-xl outline" name="approve" value="Approve">
														<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</form>
									</div>
									<div id="decline-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
										<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Decline Request</h4>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body">
														<div class="row">
															<input class="form-control" type="hidden" name="decline_id" value="<?php echo $row['id']; ?>">
															<div class="form-group col-12">
																<label class="col-form-label">Certificate Type</label>
																<input class="form-control" type="text" value="<?php echo $type; ?>" readonly>
															</div>
															<div class="form-group col-12">
																<label class="col-form-label">Name</label>
																<input class="form-control" type="text" value="<?php echo $name; ?>" readonly>
															</div>
															<?php 
															if ($row['request_type'] == 4) {
															?>
															<div class="form-group col-12">
																<label class="col-form-label">Business Name</label>
																<input class="form-control" type="text" value="<?php echo $row['business_name']; ?>" readonly>
															</div>
															
															<div class="form-group col-12">
																<label class="col-form-label">Business Address</label>
																<input class="form-control" type="text" value="<?php echo $row['purpose']; ?>" readonly>
															</div>
															<?php
															}
															else {
															?>
															<div class="form-group col-12">
																<label class="col-form-label">Purpose</label>
																<input class="form-control" type="text" value="<?php echo $row['purpose']; ?>" readonly>
															</div>
															<?php
															}
															?>
															<div class="form-group col-12">
																<label class="col-form-label">Date Request</label>
																<input class="form-control" type="text" value="<?php echo date('M. d, Y g:i A', strtotime($row['date_issued'])); ?>" readonly>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<input type="submit" class="btn red radius-xl outline" name="decline" value="Decline">
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
										echo "<script>window.open('request-monitoring', '_self');</script>";
									}
									
									    if (isset($_POST['approve'])) {
											$model->approveRequest($_POST['pickup-date'], 10, $_POST['approve_id']);

											echo "<script>window.open('request-monitoring', '_self');</script>";
										}

										if (isset($_POST['decline'])) {
											$model->updateRequestStatus(3, $_POST['decline_id']);

											echo "<script>window.open('request-monitoring', '_self');</script>";
										}

									?>
								</tbody>
							</table>
						</div>
						<center><a href="all-request-monitoring">View All Requests History</a> </center>
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
		    $('#table').dataTable({
  ordering: false
});
		</script>
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
		<script type="text/javascript">
			$(document).ready(function() {
				$('#switch-page').change( function() {
					if ($(this).val() == 1) {
						window.open('request-monitoring?id=1', '_self');
					}

					else if ($(this).val() == 2) {
						window.open('request-monitoring?id=2', '_self');
					}

					else if ($(this).val() == 3) {
						window.open('request-monitoring?id=3', '_self');
					}
					else if ($(this).val() == 4) {
						window.open('', '_self');
					}
					else if ($(this).val() == 5) {
						window.open('request-monitoring?id=5', '_self');
					}
					else if ($(this).val() == 6) {
						window.open('request-monitoring?id=6', '_self');
					}
					else if ($(this).val() == 7) {
						window.open('business2', '_self');
					}
				});
			});

		</script>

	</body>

</html>