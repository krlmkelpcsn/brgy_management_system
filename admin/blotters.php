
<?php
    use setasign\Fpdi\Fpdi;
    
    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
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
		$obj_pdf->SetTitle("BARANGAY POBLACION - BLOTTERS");   
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
				$fullname = $row['complaint_name'];
				$brgy_case = $row['brgy_case'];
				// $accusation = !empty($row['accusation']) ? htmlspecialchars($row['accusation']) : 'Unknown';
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
			        <td>'.$accusation_id.'</td>
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
						<li><i class="ti-agenda"></i>Blotters</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-12 m-b30">

								
								<div align="right">
								    <a href="" class="btn green radius-xl" style="background-color: <?php echo $primary_color; ?>;" data-toggle="modal" data-target="#add-blotters"><i class="ti-agenda"></i><span>&nbsp;ADD BLOTTERS RECORD</span></a>&nbsp;
								    
									<a href="archived-blotters" class="btn red radius-xl"><i class="ti-archive"></i><span>&nbsp;ARCHIVED BLOTTER RECORDS</span></a>
								</div>
								<div style="padding: 25px;"></div>
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
												<th width="50">Narrative</th></th>
											</tr>
										</thead>
										<tbody>
											<?php
												$blot_status = 1;
												$rows = $model->displayBlotters($blot_status);

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
														$resident_complainant_id = $row['resident_complainant_id'];
														// $fullname = $row['complaint_name'];
														$brgy_case = $row['brgy_case'];
														$accusation = !empty($row['accusation']) ? htmlspecialchars($row['accusation']) : 'Unknown';
														// $accusation_id = $row['accusation_id'];
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
														$stat1 = $row['respondents_status'];
														$stat2 = $row['complainants_status'];
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
											<center>
												<span class="badge badge-<?php echo $blotter_status2; ?>"><a href="" style="font-size: 14px;color: white;" data-toggle="modal" data-target="#status-<?php echo $row['id']; ?>"><?php echo $blotter_status; ?></a></span>
											
											</center> 
										</td>
												<td><center>
												
												<a data-toggle="modal" data-target="#edit-<?php echo $row['id']; ?>" class="btn blue" style="width: 45px; height: 37px;"><div data-toggle="tooltip" title="Edit"><i class="ti-pencil" style="font-size: 15px; margin-left:-4px;"></i></div></a>&nbsp;
													<a href="blotters-details?id=<?php echo $id; ?>" class="btn blue" style="width: 45px; height: 37px;"><div data-toggle="tooltip" title="Profile"><i class="ti-eye" style="font-size: 15px; margin-left:-4px;"></i></div></a>&nbsp;
												<a href="" class="btn red" style="width: 45px; height: 37px;" data-toggle="modal" data-target="#decline-<?php echo $id; ?>"><div data-toggle="tooltip" title="Archive"><i class="ti-archive" style="font-size: 15px; margin-left:-5px;"></i></div></a></center>
												</td>
												<td>
												   <form method="POST" target="_blank">
													<input type="hidden" name="repondent" value="<?php echo strtoupper($repondent); ?>">
													<input type="hidden" name="complainant" value="<?php echo strtoupper($complainant); ?>">
													<input type="hidden" name="date_filed" value="<?php echo strtoupper($date_filed); ?>">
													<input type="hidden" name="narrative_txt" value="<?php echo $narrative; ?>">
													<input type="hidden" name="date_happened" value="<?php echo strtoupper($date_happened); ?>">
													<input type="hidden" name="incharge" value="<?php echo strtoupper($incharge); ?>">
													<button type="submit" name="narrative" class="btn btn-block green radius-xl" style="float: right;">PRINT</button><br><br>
												    </form>
												</td>
											</tr>
											

											<div id="edit-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
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
															<div class="form-group col-6">
																<label class="col-form-label">Respondent</label>
																<input class="form-control" type="text" value="<?php echo $first_name.' '.$middle_name.' '.$last_name; ?>" readonly>
															</div>
															<div class="form-group col-6">
																<label class="col-form-label">Complainant's Fullname</label>
																<input class="form-control" type="text" value="<?php echo $fullname; ?>" readonly>
															</div>
															<div class="form-group col-6">
 																<label class="col-form-label"> Status </label>
 																<textarea class="form-control" name="respondents_status" ><?php echo $stat1; ?></textarea>
															</div>
														
															<div class="form-group col-6">
																<label class="col-form-label">Status</label>
 																<textarea class="form-control" name="complainants_status" ><?php echo $stat2; ?></textarea>
															</div>
                                                            
														</div>
													</div>
													<div class="modal-footer">
														<input type="submit" class="btn green radius-xl outline" name="editStatus" value="Update ">
														<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</form>
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
																<input class="form-control" type="text" value="<?php echo $accusation_id; ?>" readonly>
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
																		<input class="form-control" type="text" value="<?php echo $row['accusation']; ?>" readonly>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Respondent</label>
																		<input class="form-control" type="text" value="<?php echo $first_name.' '.$middle_name.' '.$last_name; ?>" readonly>
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
																		<label class="col-form-label">Birth Date</label>
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
														if (isset($_POST['editStatus'])) {
														    $model->changeBlotterStatus3($_POST['respondents_status'],$_POST['complainants_status'], $_POST['update_id']);
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
								<br>
								<hr>
								 <div align="right">
								    <form method="POST" target="_blank">
    								    <button type="submit" name="export-pdf" class="btn blue radius-xl" style="background-color: <?php echo $primary_color; ?>"><i class="ti-import"></i>&nbsp;&nbsp;EXPORT TO PDF</button>
    									<!-- <a href="import-residents" class="btn blue radius-xl" style="background-color: <?php echo $primary_color; ?>"><i class="ti-import"></i>&nbsp;&nbsp;IMPORT RESIDENTS</a> -->
    								</form>
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
															<label class="col-form-label"><b>Respondent's Name</b></label>
															<select class="form-control" id="resident_id" name="resident_id">
														        <?php
														        
														            $rows = $model->fetchResidents();
														            
														            if (!empty($rows)) {
														                foreach ($rows as $row) {
														                    echo '<option value="'.$row['id'].'">'.$row['lname'].', '.$row['fname'].' '.$row['mname'].'</option>';
														                }
														            }
														        
														        ?>
															</select>
										 				</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Witness</b></label>
															<input class="form-control" type="text" name="witness" required>
														</div>
														
														<div class="form-group col-6">
															<label class="col-form-label"><b>Accusation </b></label>
															<select class="form-control" id="accusation_id" name="accusation_id">
																<option value="">select accusation</option>
																<?php
																
																$accusations = $model->fetchAccusations();
																
																if (!empty($accusations)) {
																	foreach ($accusations as $id => $accusation) {
																		
																		$selected = (isset($accusationData) && $accusationData['accusation_id'] == $id) ? 'selected' : '';
																		echo '<option value="' . $id . '" ' . $selected . '>' . htmlspecialchars($accusation) . '</option>';
																	}
																}
																?>
																
																<option value="other">Other</option>
															</select>
														</div>

														<div class="form-group col-12">
															<div id="otherInputField" style="display: none;">
																<label for="otherInput">Please specify</label>
																<input type="text" class="form-control" id="otherInput" name="custom_accusation" placeholder="Enter new accusation">
															</div>
														</div>
														
														<div class="form-group col-12">
															<label class="col-form-label"><b>Complainant’s Full Name </b><small>(Select others if not a resident)</small></label>
															<!-- <input class="form-control" type="text" name="complaint_name" required> -->
															 
															<!-- <select class="form-control" id="resident_complainant_id" name="resident_complainant_id">
																<option value="">select</option>
																<option value="otherComplainant">others (if not a resident)</option> -->
																<select class="form-control" id="resident_complainant_id" name="resident_complainant_id">
    <option value="">Select</option>
    <option value="otherComplainant">Others (if not a resident)</option>

														        <?php
														        
														            // $complainants = $model->fetchResidents();
														            
														            // if (!empty($complainants)) {
														            //     foreach ($complainants as $complainant) {
																	// 		$selected = (isset($complainantData) && $complainantData['resident_complainant_id'] == $id) ? 'selected' : '';
														            //         echo '<option value="'.$row['id'].'">'.$row['lname'].', '.$row['fname'].' '.$row['mname'].'</option>';
														            //     }
														            // }
																	$complainants = $model->fetchResidents();

																	if (!empty($complainants)) {
																		foreach ($complainants as $complainant) {
																			// Ensure data is properly escaped for security
																			$id = htmlspecialchars($complainant['id'], ENT_QUOTES, 'UTF-8');
																			$lname = htmlspecialchars($complainant['lname'], ENT_QUOTES, 'UTF-8');
																			$fname = htmlspecialchars($complainant['fname'], ENT_QUOTES, 'UTF-8');
																			$mname = htmlspecialchars($complainant['mname'], ENT_QUOTES, 'UTF-8');
																
																			// Check if the option should be selected
																			$selected = (isset($complainantData) && $complainantData['resident_complainant_id'] == $id) ? 'selected' : '';
																
																			// Generate the option element
																			echo "<option value=\"$id\" $selected>$lname, $fname $mname</option>";
																		}
																	}
														        
														        ?>
																
</select>
															<!-- </select> -->
														</div>
														<div class="form-group col-12">
															<div id="otherInputFieldComplainant" style="display: none;">
																<label for="otherInput">Please specify</label>
																<input type="text" class="form-control" id="otherInput" name="custom_complainant" placeholder="Enter external complainant">
															</div>
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Complainant’s Address</b></label>
															<input class="form-control" type="text" name="address" required>
														</div>
														<div class="form-group col-3">
															<label class="col-form-label"><b>Birth Date</b></label>
															<input class="form-control" type="date" name="age" required>
														</div>
														<div class="form-group col-3">
															<label class="col-form-label"><b>Gender</b></label>
															<select class="form-control" name="gender" readonly>
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select>
															
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Contact Number</b></label>
															<input class="form-control" type="number" name="contact" required>
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Incident Location</b></label>
															<input class="form-control" type="text" name="happened" required>
														</div>
														<div class="form-group col-4">
															<label class="col-form-label"><b>Date Happened</b></label>
															<input class="form-control" type="date" name="date" required>
														</div>
														<div class="form-group col-4">
															<label class="col-form-label"><b>Time</b></label>
															<input class="form-control" type="time" name="time" required>
														</div>
														
														<div class="form-group col-4">
															<label class="col-form-label"><b>Date Filed</b></label>
															<input class="form-control" type="datetime-local" name="date_filed" required>
														</div>
														<div class="form-group col-12">
															<label class="col-form-label"><b>Narrative Report</b></label>
															<textarea name="narrative2" rows="1" class="form-control" required minlength="5" maxlength="" style="background-color:#FFFFFF; resize:none;box-sizing: border-box;padding: 5px; " ></textarea>
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
										$accusation = $_POST['accusation_id'];  
										
										if ($accusation === 'other') {
											$customAccusation = strtoupper(trim($_POST['custom_accusation']));
											
											if (!empty($customAccusation)) {
												
												$accusation_id = $model->addAccusation($customAccusation);
												
												if (!$accusation_id) {
													echo "<script>alert('Failed to insert custom accusation.');</script>";
													return;
												}
											} else {
												echo "<script>alert('Please specify the accusation.');</script>";
												return;
											}
										} else {
											
											$accusation_id = (int)$accusation; 
											
											if (!$model->checkAccusationExists($accusation_id)) {
												echo "<script>alert('Selected accusation does not exist.');</script>";
												return;
											}
										}
										
										$complainant = $_POST['resident_complainant_id'];  

										if ($complainant === 'otherComplainant') {
											// Handle case for non-resident complainant
											$customComplainant = strtoupper(trim($_POST['custom_complainant']));
										
											if (!empty($customComplainant)) {
												// Attempt to add non-resident complainant
												$resident_complainant_id = $model->addNonResidentComplainant($customComplainant);
										
												if (!$resident_complainant_id) {
													echo "<script>alert('Failed to add non-resident complainant.');</script>";
													return;
												}
											} else {
												echo "<script>alert('Please specify the non-resident complainant.');</script>";
												return;
											}
										} else {
											// Convert to integer to ensure valid input
											$resident_complainant_id = (int)$complainant;
										
											// Check if the selected resident complainant exists
											if (!$model->checkResidentComplainantExists($resident_complainant_id)) {
												echo "<script>alert('The selected resident complainant does not exist.');</script>";
												return;
											}
										}
										
										
										$model->addBlotters(
											$_POST['resident_id'], 'N/A', 
											// $_POST['resident_complainant_id'], 'N/A', 
											$resident_complainant_id,  
											// $_POST['complaint_name'], 
											$_POST['age'], 
											$_POST['gender'], 
											$_POST['address'], 
											$_POST['contact'], 
											$_POST['time'], 
											$_POST['date'], 
											$_POST['happened'], 
											$accusation_id,  
											$_POST['witness'], 
											$_POST['date_filed'], 
											$_POST['narrative2']);
                                        
                                            // $complaint_name = strtoupper($_POST['complaint_name']);
                                            // $accussation = strtoupper($_POST['accussation']);
                                            $witness = strtoupper($_POST['witness']);
                                            $happened = strtoupper($_POST['happened']);
                                            
                                            // $complaint_name = strtoupper($_POST['complaint_name']);
                                            // $complaint_name = strtoupper($_POST['complaint_name']);
                                            
                                            $date = date('M. d, Y', strtotime($_POST['date']));
											$time = date('g:i A', strtotime($_POST['time']));

                                            $resident_id = $_POST['resident_id'];
                                            // $resident_complainant_id = $_POST['resident_complainant_id'];
														
											$rowsn = $model->displayResidentsProfile($resident_id);
                            				if (!empty($rowsn)) {
                            					foreach ($rowsn as $rown) {
                            					    $first_name = $rown['fname'];
                            						$email = $rown['email'];
                            					}
                            				}			
														
											// $rowsnn = $model->displayResidentsProfile($resident_complainant_id);
                            				// if (!empty($rowsnn)) {
                            				// 	foreach ($rowsnn as $rown) {
                            				// 	    $first_name = $rown['fname'];
                            				// 		$email = $rown['email'];
                            				// 	}
                            				// }			
                                            require 'vendor/autoload.php';

											$mail = new PHPMailer(true);
												
											$mail->SMTPDebug = SMTP::DEBUG_SERVER;
											$mail->isSMTP();
											$mail->Host = 'smtp.gmail.com';
											$mail->SMTPAuth = true;
											$mail->Username = 'mhoinfanta2022@gmail.com';
											$mail->Password = 'pkjkgahfxctssdec';
											$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
											$mail->Port = 465;

	                                        $mail->setFrom("mhoinfanta2022@gmail.com", 'Barangay Poblacion');
											$mail->addAddress($email);

											$mail->isHTML(true);
											$mail->Subject = 'Barangay Poblacion Portal - Blotter Notification';
											$mail->Body = "Good day $first_name!
											<br><br>
											Please be informed that <b>COMPLAINANT NAME HERE</b> has reported you at the barangay for <b>$accusation_id</b> at <b>$happened</b> this <b>$date - $time.</b>
                                            <br><br>
											At your service, <br>
											Barangay Poblacion";
											
											if ($mail->send()) {
												 echo "<script>alert('Blotter has been added. An email notification has been also sent!');window.open('blotters', '_self')</script>";
											} 

											else {
												echo $mail->ErrorInfo;
											}
											
											
										echo "<script>alert('Blotter has been added. An email notification has been also sent!');window.open('blotters', '_self')</script>";
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
				
				$('#accusation_id').on('change', function() {
					if ($(this).val() === 'other') {
						$('#otherInputField').show(); 
					} else {
						$('#otherInputField').hide(); 
					}
				});
				$('#resident_complainant_id').on('change', function() {
					if ($(this).val() === 'otherComplainant') {
						$('#otherInputFieldComplainant').show(); 
					} else {
						$('#otherInputFieldComplainant').hide(); 
					}
				});
				$('#table').DataTable();
			});
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</body>

</html>