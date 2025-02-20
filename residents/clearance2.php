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

	if (empty($_SESSION['sess2'])) {
		echo "<script>window.open('../','_self');</script>";
	}

	if(isset($_POST["brgy_clearance"])) { 
		require_once('fpdf/fpdf.php');
		require_once('vendor/setasign/fpdi/src/autoload.php');
		$pdf = new Fpdi();
		$pdf->AddPage();
		$pdf->setSourceFile('../assets/pdf/clearance.pdf');
		$tplIdx = $pdf->importPage(1);
		$pdf->SetTitle("Barangay Clearance");  
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
		$pdf->Output('I', 'Barangay Clearance.pdf');
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

		<link rel="icon" href="../assets/images/icon.png" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="../assets/images/icon.png" />

		<title>Request Barangay Clearance</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/vendors/calendar/fullcalendar.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/typography.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/shortcodes/shortcodes.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dashboard.css">
	</head>
	<style type="text/css">
		.btn.dropdown-toggle.btn-default:hover {
			color: #000!important;
		}

		.btn.dropdown-toggle.btn-default:focus {
			color: #000!important;
		}

		tbody tr:hover {
			background-color: #d4d4d4;
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
	</style>
	<?php include '../assets/css/color/color-1.php';  ?>
	<body class="ttr-opened-sidebar ttr-pinned-sidebar" style="background-color: #F3F3F3;">

		<?php include 'navbar.php'; ?>

		<div class="ttr-sidebar">
			<div class="ttr-sidebar-wrapper content-scroll">
				
				<?php 
			
				include 'sidebar.php';
				
				$page = 'services';
				$secondnav = '';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Services</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-agenda"></i>Barangay Clearance</li>
					</ul>
				</div> 
				
				<?php include 'widget.php'; ?>

				<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
				<style type="text/css">
				.chart {
					width: 100%; 
					min-height: 500px;
				}
				.rowy {
					margin:0 !important;
				}
				</style>
				<div class="row">
					<div class="col-lg-5 m-b30">
						<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
							if (isset($_POST['post_msg'])) {
								$model->addRequest($_SESSION['sess2'], 5, $_POST['message']);

								setcookie('cancel_request_clearance', time() + (60 * 5), time() + (60 * 5), "/");
								
								
								$purpose = $_POST['message'];
								
								
								require 'vendor/autoload.php';

                				$mail = new PHPMailer(true);
                												
                				$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                				$mail->SMTPDebug=0;
                				$mail->isSMTP();
                				$mail->Host = 'smtp.gmail.com';
                				$mail->SMTPAuth = true;
                				$mail->Username = 'mhoinfanta2022@gmail.com';
								$mail->Password = 'pkjkgahfxctssdec';
                				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                				$mail->Port = 465;
                
                	            $mail->setFrom("mhoinfanta2022@gmail.com", 'Barangay Nagkaisang Nayon');
                				$mail->addAddress($r_email);
                
                				$mail->isHTML(true);
                				$mail->Subject = 'Barangay Nagkaisang Nayon Portal - Request Document';
                				$mail->Body = "Good day $r_fname!<br><br>
                				This is to inform you that your request has been received by the admin and is now under review.<br>Please be informed that the admin will respond to your request after a couple of days and will give you feedback when to pick up the requested document once approved.<br>
                				<h3>Document: Barangay Clearance</h3>
                				<h3>Purpose: $purpose</h3>
                				<br><br>
                				At your service, <br>
                				Barangay Nagkaisang Nayon";
                											
                				if ($mail->send()) {
                					echo "<script>window.open('clearance2', '_self')</script>";
                				} 
                                else {
                					echo $mail->ErrorInfo;
                				}
								echo "<script>window.open('clearance2', '_self')</script>";
							}

						?>
									<form class="contact-bx dzForm" method="post">
										<div class="dzFormMsg"></div>
										<div class="heading-bx left">
											<h2 class="title-head">Request <span>Services</span></h2>
										</div>
										<div style="padding: 5px;"></div>
										<div class="row placeani" id="sent">
											<div class="col-lg-12">
												<select class="form-control" id="switch-page">
													<option value="1">Request of Barangay Clearance (w/o pic)</option>
													<option value="2">Request Certificate of Residency (w/o pic)</option>
													<option value="3" 
													
													<?php 

												    if($income == '1') {
												        
												    }
												    
												    else {
												        echo 'disabled';
												    }
													?>
													
													>Request Certificate of Indigency (w/o pic)</option>
													<option value="4">Request Barangay Business Clearance (w/o pic)</option>
													<option value="5" selected>Request of Barangay Clearance (w/ pic)</option>
													<option value="6">Request Certificate of Residency (w/ pic)</option>
												</select>
											</div>
											<div class="col-lg-12">
												<br>
												<div class="form-group">
													<label>Name</label><div class="input-group">
														<?php echo $r_fname; ?> <?php echo $r_mname; ?> <?php echo $r_lname; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Gender</label><div class="input-group">
														<?php echo $r_gender; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Birthdate</label><div class="input-group">
														<?php echo $r_birth_date; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Purok</label><div class="input-group">
														<?php echo $r_address3; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Purpose</label><div class="input-group">
														<textarea name="message" rows="1" class="form-control" required minlength="5" maxlength="300" style="background-color:#FFFFFF; resize:none;box-sizing: border-box;padding: 5px;"></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Date Request</label><div class="input-group">
														<?php echo date("M. d, Y"); ?>
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
										</form>
											<div class="col-lg-12">
												<div id="request_button">
													<?php
													$request_type = 5;
													$rows = $model->pendingRequestChecker($_SESSION['sess2'], $request_type);
													if (!empty($rows)) {
														foreach ($rows as $row) {
														}
													?>
													<center>
														<h3 style="color: green;">YOUR REQUEST IS PENDING</h3>
														<button type="button" data-toggle="modal" data-target="#view-cancel-<?php echo $row['id']; ?>" class="btn red radius-xl" style="width: 210px;height: 50px;display: flex;align-items: center;justify-content: center;" <?php if (!isset($_COOKIE['cancel_request_clearance'])) { echo 'disabled'; } ?>><i class="ti-archive" style="font-size: 15px;"></i><span style="font-size: 15px;">&nbsp;&nbsp;CANCEL REQUEST</span></button>
													</center>
													<?php
														if (isset($_POST['cancel'])) {
															$model->updateRequestStatus(4, $_POST['cancel_hidden']);

															setcookie('cancel_request_clearance', null, -1, '/'); 

															echo "<script>window.open('clearance2', '_self');</script>";
														}
													} else { ?>
													<center><button name="post_msg" type="submit" class="btn button-md button-block">Submit Request</button></center>
													<?php } ?>
												</div>
												<p id="timer" style="text-align: center;">
														<?php

															function formatSeconds($seconds) {
				  												$t = round($seconds);
				  												return sprintf('%02d:%02d', ($t/60%60), $t%60);
															}

															if (isset($_COOKIE['cancel_request_clearance'])) { 
																$time_left = $_COOKIE['cancel_request_clearance'] - time();
																echo formatSeconds($time_left);
															} 
														?>
													</p>
											</div>
											<div id="view-cancel-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
													<form class="edit-profile m-b30" method="POST">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Request Details</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="cancel_hidden" value="<?php echo $row['id']; ?>">
																<div class="row">
																	<div class="form-group col-12">
																		<label class="col-form-label"><b>Name</b></label>
																		<br><?php echo $r_fname; ?> <?php echo $r_mname; ?> <?php echo $r_lname; ?>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label"><b>Purok</b></label>
																		<br><?php echo $r_address3; ?>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label"><b>Purpose</b></label>
																		<br><?php echo $row['purpose']; ?>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label"><b>Date Submitted</b></label>
																		<br><?php echo date('M. d, Y', strtotime($row['date_issued'])); ?>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn red radius-xl outline" name="cancel" value="Cancel Request">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
													</form>
												</div>
											<div class="col-lg-12" align="center">
											<br>
											<label style="color: green;font-weight: 540;">
											</label>
											</div>
										</div>
									

					</div>
					<div class="col-lg-7 m-b30">
						<div class="heading-bx left">
							<h2 class="title-head">Barangay Clearance<span> Request History</span></h2>
						</div>
						<div class="table-responsive">
							<table id="table" class="table hover" style="width:100%">
								<thead>
									<tr>
										<th width="50">Action</th>
										<th>Purpose</th>
										<th>Request Date</th>
										<th width="100">Status</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$rows = $model->fetchRequestsHistory2($_SESSION['sess2'], $request_type);

										if (!empty($rows)) {
											foreach ($rows as $row) {
									?>
									<tr>
										<td><center><a href="" class="btn blue" style="width: 45px; height: 37px;" data-toggle="modal" data-target="#view-<?php echo $row['id']; ?>"><div data-toggle="tooltip" title="View Details"><i class="ti-eye" style="font-size: 15px; margin-left:-5px;"></i></div></a></center></td>
										<td><?php echo $row['purpose']; ?></td>
										<td style="font-size: 14px;"><?php echo date('M. d, Y', strtotime($row['date_issued'])); ?></td>
										<td>
											<center></center> 


											<center>
												<?php
												if ($row['status'] == 1) {

												?>
												<span style="color: green;"><b><?php echo $row['status2']; ?><br><?php echo date('M. d, Y', strtotime($row['date_pickup'])); ?></b></span>
												<?php
												}
												else if ($row['status'] == 10) {

												?>
												<span style="color: green;"><b><?php echo $row['status2']; ?><br><?php echo date('M. d, Y', strtotime($row['date_pickup'])); ?></b></span>
												<?php
												}
												else if ($row['status'] == 2) {
												?>
												<span class="badge badge-primary">PENDING</span>
												<?php
												}
												else if ($row['status'] == 4) {
												?>
													<span class="badge badge-dark">CANCELLED</span>
												<?php
												}
												else {
												?>
													<span class="badge badge-danger">DECLINED</span>
												<?php
												}
												?>
											</center>
										</td>
									</tr>
									<div id="view-<?php echo $row['id']; ?>" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
										<form class="edit-profile m-b30" method="POST">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Request Details</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<input type="hidden" name="approve_hidden" value="<?php echo $id; ?>">
													<div class="row">
																	<div class="form-group col-12">
																		<label class="col-form-label">Name</label>
																		<br><?php echo $r_fname; ?> <?php echo $r_mname; ?> <?php echo $r_lname; ?>
																	</div>
																	<!--<div class="form-group col-4">
																		<label class="col-form-label">Blk</label>
																		<br><?php echo $r_address; ?>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Lot</label>
																		<br><?php echo $r_address2; ?>
																	</div>-->
																	<div class="form-group col-4">
																		<label class="col-form-label">Purok</label>
																		<br><?php echo $r_address3; ?>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Purpose</label>
																		<br><?php echo $row['purpose']; ?>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Date Submitted</label>
																		<br><?php echo date('M. d, Y', strtotime($row['date_issued'])); ?>
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
		<script type="text/javascript">
			$(document).ready(function() {
				$('#switch-page').change( function() {
					if ($(this).val() == 1) {
						window.open('clearance', '_self');
					}

					else if ($(this).val() == 2) {
						window.open('residency', '_self');
					}

					else if ($(this).val() == 3) {
						window.open('indigency', '_self');
					}
					else if ($(this).val() == 4) {
						window.open('business', '_self');
					}
					
					else if ($(this).val() == 5) {
						window.open('clearance2', '_self');
					}
					else if ($(this).val() == 6) {
						window.open('residency2', '_self');
					}
				});

				var timer = setInterval(function() {
					var timer_text = $('#timer').text();
					const timer_split = timer_text.split(':');
					var seconds = (timer_split[0] * 60) + timer_split[1];

					if (parseInt(seconds) > 0) {
						$('#timer').load(location.href + " #timer");
					}

					else {
						$('#timer').html('');
					}

					$('#request_button').load(location.href + " #request_button");
				}, 1000);
			});

			$(document).ready(function() {
				$('#table').DataTable();
			});
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
		<script type="text/javascript">
			function blockSpecialChar(evt) { 
				var charCode = (evt.which) ? evt.which : window.event.keyCode; 
				if (charCode <= 13) { 
					return true; 
				} 
				
				else { 
					var keyChar = String.fromCharCode(charCode); 
					var re = /^[A-Za-z. ]+$/ 
					return re.test(keyChar); 
				} 
			}
		</script>
	</body>
</html>