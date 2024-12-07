<?php
    use setasign\Fpdi\Fpdi;
    
    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	$idddd = isset($_GET['id']) ? $_GET['id'] : '';
	
	ob_start(); 
	session_start(); 
	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['org_sess'])) {
		echo "<script>window.open('../','_self');</script>";
	}
	
		if(isset($_POST["narrative"])) {
		require_once('fpdf/fpdf.php');
		require_once('vendor/setasign/fpdi/src/autoload.php');
		$pdf = new Fpdi();
		$pdf->AddPage();
		$pdf->setSourceFile('../assets/pdf/narrative.pdf');
		$tplIdx = $pdf->importPage(1);
		$pdf->SetTitle("BARANGAY POBLACION");  
		$pdf->useTemplate($tplIdx, 0, 0, 200, 290);
		$pdf->SetFont('Times', 'B', 12);
		$pdf->SetTextColor(0, 0, 0);
		
		$pdf->SetXY(64.4, 61);
		$pdf->Write(0, strtoupper($_POST['complainant']));
		
        $pdf->SetXY(64.4, 69.5);
		$pdf->Write(0, strtoupper($_POST['repondent']));
        
        $pdf->SetXY(64.4, 78.3);
		$pdf->Write(0, strtoupper($_POST['date_filed']));
		
		$pdf->SetXY(64.4, 87);
		$pdf->Write(0, strtoupper($_POST['date_happened']));
		
		$pdf->SetXY(25, 113);
		$pdf->Write(7, $_POST['narrative_txt']);
		
		$pdf->SetXY(16.7, 240);
		$pdf->Write(0, strtoupper($_POST['incharge']));

		ob_end_clean();
 		$pdf->Output('I', 'Blotter Report.pdf');
	}
	
	if(isset($_POST["export-pdf"])) { 
		require_once('../tcpdf/tcpdf.php');  
		$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
		$obj_pdf->SetCreator(PDF_CREATOR);  
		$obj_pdf->SetTitle("BARANGAY CRUZ - BLOTTERS");   
		$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
		$obj_pdf->SetDefaultMonospacedFont('helvetica');  
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
		$obj_pdf->setPrintHeader(false);  
		$obj_pdf->setPrintFooter(false);  
		$obj_pdf->SetAutoPageBreak(TRUE, 10);  
		$obj_pdf->SetFont('helvetica', '', 12);  
		$obj_pdf->AddPage(); 
		//ob_start(); 
		$content = '';  
		$content .= '
		<div align="center">
			<img src="header.jpg" height="115" width="470">
			<h2 style="color: black;">BLOTTERS INFORMATION</h2>
		</div>
		<font size="9" face="Courier New">
		<table border="1" cellspacing="0" cellpadding="5">
        	<thead>
        		<tr>
        			<th><b>Case ID</b></th>
				    <th><b>Respondent</b></th>
			        <th><b>Complainant</b></th>
				    <th><b>Subject</b></th>
				    <th><b>Date Filed</b></th>
					<th><b>Status</b></th>
        		</tr>
        	</thead>
        	<tbody>';
        $status = 1;
        $rows = $model->displayBlotters($status);
        if (!empty($rows)) {
			foreach ($rows as $row) {
			    $id = $row['id'];
				$blotter_id = $row['blotter_id'];
				$first_name = $row['fname'];
				$middle_name = $row['mname'];
				$last_name = $row['lname'];
				$email = $row['email'];
				$contact = $row['contact'];
				$address = $row['address'];
				$date_added = $row['date_registered'];
				$fullname = $row['external_complaint_name'];
				$brgy_case = $row['brgy_case'];
				$accusation = !empty($row['accusation']) ? htmlspecialchars($row['accusation']) : 'Unknown';
				$date_filed = $row['date_filed'];
				$blotter_status = !empty($row['blotter_status']) ? $row['blotter_status'] : "Active";
				if ($blotter_status == "Settled") {
				    $blotter_status2 = "warning";
				}
				else {
			        $blotter_status2 = "success";
				}
				$date_filed = date('M. d, Y g:i A', strtotime($date_filed));
				$content .= '<tr>
				
										
					<td>'.$id.'</td>				
			        <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
			        <td>'.$fullname.'</td>
			        <td>'.$accusation .'</td>
			        <td>'.$date_filed.'</td>
			        <td>'.$blotter_status.'</td>
		        </tr>';
			}
        }
        	
		$content .= '</tbody></table></font>';  
		$content = utf8_encode($content);
		$obj_pdf->writeHTML($content); 
		ob_end_clean();
		$obj_pdf->Output('Blotters.pdf', 'I');  
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

		<title>Blotter Records</title>

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
				
				$page = 'records';
				$secondnav = 'blotters';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #FCFCFC;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Hearing/Summoning</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-agenda"></i>Blotter Details</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>
				
				<div align="right">
					<a href="" class="btn green radius-xl" style="background-color: #0000CD;" data-toggle="modal" data-target="#add-hearing"><i class="ti-agenda"></i><span>&nbsp;SCHEDULE HEARING</span></a>&nbsp;
				</div>
				
				<div id="add-hearing" class="modal fade" role="dialog">
					<form class="edit-profile m-b30" method="POST">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Schedule Hearings</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<!-- <input type="hidden" name="case_id" value="<?php echo $id; ?>"> -->
										<div class="form-group col-12">
											<label for="hearing_dates">Hearing Dates & Times (Up to 7)</label>
											<div id="hearing-schedule-container">
												<!-- JS will append input fields here -->
											</div>
											<button type="button" id="add-hearing-btn" class="btn green">Add Hearing</button>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<input type="submit" class="btn green radius-xl outline" name="add-hearing-confirm" value="Save Hearings">
									<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
				<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

				<script>
					document.addEventListener('DOMContentLoaded', function () {
						const maxHearings = 7;
						const hearingContainer = document.getElementById('hearing-schedule-container');
						const addHearingBtn = document.getElementById('add-hearing-btn');
						
						addHearingBtn.addEventListener('click', function () {
							const currentCount = hearingContainer.querySelectorAll('.hearing-input').length;

							if (currentCount < maxHearings) {
								const hearingInput = document.createElement('div');
								hearingInput.classList.add('form-group');
								hearingInput.innerHTML = `
									<label>Hearing ${currentCount + 1}:</label>
									<input type="datetime-local" name="hearings[]" class="form-control hearing-input" required>
								`;
								hearingContainer.appendChild(hearingInput);
								flatpickr(hearingInput.querySelector('input'), {
									enableTime: true, // Enable time picker
									dateFormat: "Y-m-d h:i K", // Format for date and time with AM/PM indicator
									time_24hr: false, // Use 12-hour format for time with AM/PM
								});

							} else {
								alert('You can only schedule up to 7 hearings.');
							}
						});
					});
				</script>
				<?php
				
				if (isset($_POST['add-hearing-confirm'])) {
					$case_id = $idddd;
					$hearings = $_POST['hearings']; // Array of hearing dates/times

					if (count($hearings) <= 7) {
						foreach ($hearings as $hearing) {
							$model->addHearing($case_id, $hearing); // Save each hearing in the database
						}
						// Notify user and redirect
						echo "<script>alert('Hearing schedules saved successfully!');</script>";
						// echo "<script>window.location.href = 'blotters?id=" . $case_id . "';</script>"; 
						echo "<script>window.location.href = 'blotters-details?id=" . $idddd . "';</script>"; 
						exit;
					} else {
						echo "<script>alert('You can only save up to 7 hearings.');</script>";
					}
				}
				
				// Ensure $case_id is defined
				if (isset($_GET['id'])) {
					$case_id = $_GET['id']; // Retrieve case ID from the URL
				} else {
					die("Case ID is missing."); // Stop execution if not found
				}

				// Fetch hearing schedules
				try {
					$schedules = $model->getHearingSchedules($case_id); // Updated method
				} catch (Exception $e) {
					die("Error fetching schedules: " . $e->getMessage());
				}
				?>
				
				<div class="row">
					<div class="col-lg-12 m-b30">
						<h3>Blotter Details</h3>
					</div>
					<div class="col-lg-12 m-b30">
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th>Case ID</th>
												<th>Respondent's Name</th>
												<th>Complainant's Name</th>
												<th>Subject</th>
												<th>Date Filed</th>
												<th>Status</th>
												<th width="100">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$blot_status = 1;
												$rows = $model->displayBlotterDetails($idddd, $blot_status);
												
												if (!empty($rows)) {
													foreach ($rows as $row) {
														$id = $row['id'];
														$resident_id = $row['resident_id'];
														$blotter_id = $row['blotter_id'];
														$first_name = $row['fname'];
														$middle_name = $row['mname'];
														$last_name = $row['lname'];
														$email = $row['email'];
														$contact = $row['contact'];
														$address = $row['address'];
														$date_added = $row['date_registered'];
														
														// $fullname = array_key_exists('external_complainant_name', $row) ? $row['external_complainant_name'] : 'N/A';
														$brgy_case = $row['brgy_case'];
														$accusation = !empty($row['accusation']) ? htmlspecialchars($row['accusation']) : 'Unknown';
														$res_complainant = $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'];
														$fullname = !empty($row['external_complainant_name']) 
															? htmlspecialchars($row['external_complainant_name']) 
															: htmlspecialchars($res_complainant);
														$brgy_case = $row['brgy_case'];
														// $accussation = $row['accussation'];
														$date_filed = $row['date_filed'];
														$blotter_status = !empty($row['blotter_status']) ? $row['blotter_status'] : "Active";
														if ($blotter_status == "Settled") {
														    $blotter_status2 = "warning";
														}
														else {
														    $blotter_status2 = "success";
														}
														$row['date'] = date('M. d, Y', strtotime($row['date']));
														$row['time'] = date('g:i A', strtotime($row['time']));
														$row['date_filed'] = date('M. d, Y g:i A', strtotime($row['date_filed']));
														
														$repondent = $first_name.' '.$middle_name.' '.$last_name;
														$complainant = $fullname;
														$date_filed = date('M. d, Y g:i A', strtotime($date_filed));
														$narrative = $row['narrative'];
														$date_happened = date('M. d, Y', strtotime($row['date']));
														$incharge = $nm;
											?>
											<tr>
												<td><?php echo $id; ?></td>
												<td><?php echo $first_name.' '.$middle_name.' '.$last_name; ?></td>
											
												<td><?php echo $fullname; ?></td>
												<td><?php echo $accusation; ?></td>
										
												<td style="font-size: 14px;"><?php echo date('M. d, Y g:i A', strtotime($date_filed)); ?></td>
												<td>
											<center><span class="badge badge-<?php echo $blotter_status2; ?>"><a href="" style="font-size: 14px;color: white;" data-toggle="modal" data-target="#status-<?php echo $row['id']; ?>"><?php echo $blotter_status; ?></a></span></center> 
										</td>
										<td>
											<center>
												
											<!-- <a href="hearing-management?id=<?php echo $resident_id; ?>" class="btn blue" style="width: 45px; height: 37px;"><div data-toggle="tooltip" title="Hearings"><i class="ti-eye" style="font-size: 15px; margin-left:-4px;"></i></div></a>&nbsp; -->
												
												<a href="#" class="btn yellow" style="width: 45px; height: 37px;" data-toggle="modal" data-target="#view-hearings-modal">
													<div data-toggle="tooltip" title="View Hearings">
														<i class="ti-agenda" style="font-size: 15px; margin-left: -4px;"></i>
													</div>
												</a>&nbsp;
											<a href="residents-profile?id=<?php echo $resident_id; ?>" class="btn blue" style="width: 45px; height: 37px;"><div data-toggle="tooltip" title="Profile"><i class="ti-eye" style="font-size: 15px; margin-left:-4px;"></i></div></a>&nbsp;
												<a href="" class="btn red" style="width: 45px; height: 37px;" data-toggle="modal" data-target="#decline-<?php echo $id; ?>"><div data-toggle="tooltip" title="Archive"><i class="ti-archive" style="font-size: 15px; margin-left:-5px;"></i></div></a></center>
												</td>
											</tr>
											
											
											<div id="view-hearings-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewHearingsModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title" id="viewHearingsModalLabel">Hearing Schedules</h4>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
														<?php
															if (isset($_POST['update_status'])) {
																$hearing_id = $_POST['hearing_id'] ?? null; 
																$case_id = $_POST['case_id'] ?? null; 
																$complainant_status = $_POST['complainant_status'] ?? null;
																$respondent_status = $_POST['respondent_status'] ?? null;
																
																$model->updateHearingStatus($hearing_id, $case_id, $complainant_status, $respondent_status);
																
																echo "<script>alert('Hearing status has been added');window.open('blotters-details?id=".$idddd."', '_self')</script>";
															}
															
															if (isset($case_id)) {
																$hearings = $model->getHearingSchedules($case_id);
																if (!empty($hearings)) {
																	echo "<ul class='list-group'>";
																	foreach ($hearings as $hearing) {
																		echo "<li class='list-group-item'>";
																		echo "<strong>Date & Time:</strong> " . date("F d, Y h:i A", strtotime($hearing['hearing_date']));
																		echo "<form method='POST' style='margin-top: 10px;'>";
																		echo "<input type='hidden' name='case_id' value='" . $case_id . "'>";
																		echo "<input type='hidden' name='hearing_id' value='" . $hearing['id'] . "'>";
																		echo "<select name='complainant_status' class='form-select form-select-sm' required>";
																		echo "<option value='' disabled selected>Complainant Status</option>";
																		echo "<option value='No Show'>No Show</option>";
																		echo "<option value='Show'>Show</option>";
																		echo "</select>";
																		echo "<select name='respondent_status' class='form-select form-select-sm' required>";
																		echo "<option value='' disabled selected>Respondent Status</option>";
																		echo "<option value='No Show'>No Show</option>";
																		echo "<option value='Show'>Show</option>";
																		echo "</select>";
																		echo "<div style='display: flex; justify-content: flex-end; gap: 10px;'>";
																		echo "<button type='submit' name='update_status' class='btn yellow radius-xl outline'>Update Status</button>";
																		echo "<button type='button' name='btn' class='btn red outline radius-xl'>Delete</button>";
																		echo "</div>";
																		echo "</form>";
																		echo "</li>";
																	}
																	echo "</ul>";
																} else {
																	echo "<p>No hearings scheduled for this case.</p>";
																}
															} else {
																echo "<p>Case ID is missing.</p>";
															}
															?>


														</div>
														<div class="modal-footer">
															<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
											
											<div id="status-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
										<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Update Blotter Status</h4>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body">
														<div class="row">
															<input class="form-control" type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
															<div class="form-group col-12">
																<label class="col-form-label">Respondent</label>
																<input class="form-control" type="text" value="<?php echo $first_name.' '.$middle_name.' '.$last_name; ?>" readonly>
															</div>
															<div class="form-group col-12">
																<label class="col-form-label">Complainant's Fullname</label>
																<input class="form-control" type="text" value="<?php echo $fullname; ?>" readonly>
															</div>
                                                            <div class="form-group col-12">
																<label class="col-form-label">Accusation</label>
																<input class="form-control" type="text" value="<?php echo $accusation ; ?>" readonly>
															</div>
															<div class="form-group col-12">
																<label class="col-form-label">Status</label>
																<select class="form-control" name="blotter_status">
																	<option value="Active"<?php if ($blotter_status == "Active") { echo "selected"; } else {} ?>>Active</option>
																	<option value="Settled"<?php if ($blotter_status == "Settled") { echo "selected"; } else {} ?>>Settled</option>
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

											<div id="decline-<?php echo $id; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Archive Blotter Record</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="decline_hidden" value="<?php echo $blotter_id; ?>">
																<div class="row">
																	<div class="form-group col-6">
																		<label class="col-form-label">Case ID</label>
																		<input class="form-control" type="text" value="<?php echo $row['id']; ?>" readonly>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Accusation</label>
																		<input class="form-control" type="text" value="<?php echo $row['accusation ']; ?>" readonly>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Respondent</label>
																		<input class="form-control" type="text" value="<?php echo $first_name.' '.$middle_name.' '.$last_name; ?>" readonly>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Complainant’s Full Name</label>
																		<input class="form-control" type="text" value="<?php echo $row['external_complaint_name']; ?>" readonly>
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
																</div>
															</div>
															
															<div class="modal-footer">
															    
																<input type="submit" class="btn red radius-xl outline" name="archive" onclick="return confirm('Are you sure you want to archive this information?')" value="Archive Case">
																
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php


														if (isset($_POST['archive'])) {
															$decline_hidden = $_POST['decline_hidden'];
															$model->changeBlotterStatus(2, $decline_hidden);
															echo "<script>window.open('blotters', '_self');</script>";
														}
														
														if (isset($_POST['status'])) {
														    $model->changeBlotterStatus2($_POST['blotter_status'], $_POST['update_id']);
														    echo "<script>window.open('blotters', '_self');</script>";
														}
													}
												}

											?>
											
										</tbody>
									</table>
								</div>
								<hr>
								
								<div id="add-blotters" class="modal fade" role="dialog">
									<form class="edit-profile m-b30" method="POST">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Add Narrative Report</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-12">
															<label class="col-form-label"><b>Narrative Report</b></label>
															<textarea name="narrative2x" rows="1" class="form-control" required minlength="5" maxlength="" style="background-color:#FFFFFF; resize:none;box-sizing: border-box;padding: 5px; " ></textarea>
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
									    
									    $date = date("Y-m-d H:i:s");
										$model->addNarrative($idddd, $_POST['narrative2x'], $date);
										
										echo "<script>alert('Narrative Report has been added');window.open('blotters-details?id=".$idddd."', '_self')</script>";
									}

								?>
								
								
								<div class="row">
									<div class="col-lg-6 m-b30">
										<h3>Narrative Reports</h3>
									</div>
									<div class="col-lg-6 m-b30">
										<div align="right">
										    <a href="" class="btn green radius-xl" style="background-color: #0000CD;" data-toggle="modal" data-target="#add-blotters"><i class="ti-agenda"></i><span>&nbsp;ADD NARRATIVE DETAILS</span></a>&nbsp;
										</div>
									</div>
									<div class="col-lg-12 m-b30">
									<div class="table-responsive">
									<table id="table1" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th>Narrative</th>
												<th width="160">Date Filed</th>
												<th width="100">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?php echo $narrative; ?></td>
												<td><?php echo $date_filed; ?></td>
												<td><form method="POST" target="_blank">
													<input type="hidden" name="repondent" value="<?php echo strtoupper($repondent); ?>">
													<input type="hidden" name="complainant" value="<?php echo strtoupper($complainant); ?>">
													<input type="hidden" name="date_filed" value="<?php echo strtoupper($date_filed); ?>">
													<input type="hidden" name="narrative_txt" value="<?php echo $narrative; ?>">
													<input type="hidden" name="date_happened" value="<?php echo strtoupper($date_happened); ?>">
													<input type="hidden" name="incharge" value="<?php echo strtoupper($incharge); ?>">
													<button type="submit" name="narrative" class="btn btn-block green radius-xl" style="float: right;">PRINT</button><br><br></form></td>
											</tr>
												<?php 
											    $rowsf = $model->displayNarrativeDetails($idddd, $blot_status);

											    if (!empty($rowsf)) {
											        foreach ($rowsf as $rowf) {
													    $narrative2= $rowf['narrative'];
													    $date_filed = date('M. d, Y g:i A', strtotime($rowf['date_added']));
											    ?>
											    <tr>
													<td><?php echo $narrative2; ?></td>
													<td><?php echo $date_filed; ?></td>
													<td><form method="POST" target="_blank">
													<input type="hidden" name="repondent" value="<?php echo strtoupper($rowf['narrative']); ?>">
													<input type="hidden" name="complainant" value="<?php echo strtoupper($rowf['narrative']); ?>">
													<input type="hidden" name="date_filed" value="<?php echo strtoupper($date_filed); ?>">
													<input type="hidden" name="narrative_txt" value="<?php echo $narrative; ?>">
													<input type="hidden" name="date_happened" value="<?php echo strtoupper($date_happened); ?>">
													<input type="hidden" name="incharge" value="<?php echo strtoupper($incharge); ?>">
													<button type="submit" name="narrative" class="btn btn-block green radius-xl" style="float: right;">PRINT</button><br><br></form></td>
												</tr>
			                                    <?php 
											        }
											    }
			                                    ?>
										</tbody>
										</table>
									</div>  
								</div>
							</div>

							

							<div class="row">
									<div class="col-lg-6 m-b30">
										<h3>Documents</h3>
									</div>
									<div class="col-lg-6 m-b30">
										<div align="right">
										    <a href="" class="btn green radius-xl" style="background-color: #0000CD;" data-toggle="modal" data-target="#add-docu"><i class="ti-agenda"></i><span>&nbsp;ADD DOCUMENT</span></a>&nbsp;
										</div>


										<div id="add-docu" class="modal fade" role="dialog">
											<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Add Document</h4>
															<button type="button" class="close" data-dismiss="modal">&times;</button>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="form-group col-12">
																	<label class="col-form-label"><b>Document</b></label>
																	<input type="file" name="document">
																</div>
																<div class="form-group col-12">
																	<label class="col-form-label"><b>Description</b></label>
																	<textarea name="narrative2x" rows="1" class="form-control" required minlength="5" maxlength="" style="background-color:#FFFFFF; resize:none;box-sizing: border-box;padding: 5px; " ></textarea>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<input type="submit" class="btn green radius-xl outline" name="add-confirm2" value="Add Document">
															<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</form>
										</div>

										<?php

											if (isset($_POST['add-confirm2'])) {
											    $description = $_POST['narrative2x'];
											    $date = date("Y-m-d H:i:s");

											    // Check if file was uploaded
											    if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
											        $file_tmp = $_FILES['document']['tmp_name'];
											        $file_name = $_FILES['document']['name'];
											        $file_size = $_FILES['document']['size'];
											        
											        // Generate a unique filename to avoid conflicts
											        $file_unique = uniqid() . "_" . basename($file_name);
											        $target_dir = "../assets/documents/";
											        $target_file = $target_dir . $file_unique;

											        // Move file to the target directory
											        if (move_uploaded_file($file_tmp, $target_file)) {
											            // Add document to database
											            $model->addDocument($idddd, $file_name, $file_size, $file_unique, $description, $date);

											            echo "<script>alert('Narrative Report has been added'); window.open('blotters-details?id=".$idddd."', '_self');</script>";
											        } else {
											            echo "<script>alert('Failed to upload the document');</script>";
											        }
											    } else {
											        echo "<script>alert('No file uploaded or there was an upload error');</script>";
											    }
											}

										?>



									</div>
									<div class="col-lg-12 m-b30">
									<div class="table-responsive">
									<table id="table2" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th>File Name</th>
												<!-- <th width="160">File Size</th> -->
												<th>Description</th>
												<th width="200">Date Added</th>
											</tr>
										</thead>
										<tbody>
												<?php 
											    $rowsf = $model->displayDocumentDetails($idddd, $blot_status);

											    if (!empty($rowsf)) {
											        foreach ($rowsf as $rowf) {
													    $narrative2= $rowf['narrative'];
													    $date_filed = date('M. d, Y g:i A', strtotime($rowf['date_added']));
											    ?>
											    <tr>
													<td><a href="../assets/documents/<?php echo $rowf['file_unique']; ?>" style="color: #023e8b;" target="_blank"><?php echo $rowf['file_name']; ?></a></td>
													<!-- <td><?php echo $rowf['file_size']; ?></td> -->
													<td><?php echo $narrative2; ?></td>
													<td><?php echo $date_filed; ?></td>
												</tr>
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
			$(document).ready(function() {
				$('#table1').DataTable();
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