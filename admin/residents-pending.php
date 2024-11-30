<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	ob_start(); 
	session_start();
	
	include('../global/model.php');
	$model = new Model();
	include('department.php');
    
	if(isset($_POST["export-pdf"])) { 
		require_once('../tcpdf/tcpdf.php');  
		$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
		$obj_pdf->SetCreator(PDF_CREATOR);  
		$obj_pdf->SetTitle("BARANGAY POBLACION PORTAL- RESIDENTS");   
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
			<h2 style="color: black;">PENDING RESIDENTS</h2>
		</div>
		<font size="9" face="Courier New">
		<table border="1" cellspacing="0" cellpadding="5">
        	<thead>
        		<tr>
        			<th><b>Name</b></th>
        			<th><b>Gender</b></th>
        			<th><b>Birthdate</b></th>
        			<th><b>Birthplace</b></th>
        			<th><b>Contact</b></th>
        			<th><b>Civil Status</b></th>
        			<th><b>Occupation</b></th>
        			<th><b>Voter Status</b></th>
        			<th><b>Email Address</b></th>
        		</tr>
        	</thead>
        	<tbody>';
        $status = 1;
        $checkStatus = $_SESSION['get'];
        //if ($_SESSION['get'] != 0) {
        if ($checkStatus != 0 || $checkStatus != "") {
            
	        $rows = $model->displayResidents(5);
		}
		else{
		    $rows = $model->displayResidents(5);
		}
        
        //$rows = $model-> $model->displayResidents($status);
        if (!empty($rows)) {
			foreach ($rows as $row) {
			    $id = $row['id'];
				$id_number = $row['id'];
				$first_name = $row['fname'];
				$middle_name = $row['mname'];
				$last_name = $row['lname'];
				$email = $row['email'];
				$contact = $row['contact_number'];
				$gender = $row['gender'];
				$civil_status = $row['civil_status'];
				$address = $row['address'];
				$address2 = $row['address2'];
				$resident_since = $row['resident_since'];
				$date_added = $row['date_registered'];
				$verified = $row['verified'];
				
				$content .= '<tr>
			        <td>'.$last_name.', '.$middle_name.' '.$first_name.'</td>
			        <td>'.$gender.'</td>
			        <td>'.$row['birth_date'].'</td>
			        <td>'.$row['birth_place'].'</td>

			        <td>'.$row['contact_number'].'</td>
			        <td>'.$row['civil_status'].'</td>
			        <td>'.$row['occupation'].'</td>
			        <td>'.$row['resident_status'].'</td>
			        <td>'.$row['email'].'</td>
		        </tr>';
			}
        }
        	
		$content .= '</tbody></table></font>';  
		$content = utf8_encode($content);
		$obj_pdf->writeHTML($content); 
		ob_end_clean();
		$obj_pdf->Output('Residents.pdf', 'I');  
	}

	if (empty($_SESSION['org_sess'])) {
		echo "<script>window.open('../','_self');</script>";
	}



// 	$digits = 7;
// 	$digits_main = rand(pow(10, $digits-1), pow(10, $digits)-1);
?>
<?php
 
                                                            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                                             
                                                            function generate_string($input, $strength = 16) {
                                                                $input_length = strlen($input);
                                                                $random_string = '';
                                                                for($i = 0; $i < $strength; $i++) {
                                                                    $random_character = $input[mt_rand(0, $input_length - 1)];
                                                                    $random_string .= $random_character;
                                                                }
                                                             
                                                                return $random_string;
                                                            }
                                                            $digits_main = generate_string($permitted_chars, 8);
                                                            
                                                             
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

		<title>Resident Management</title>

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
				$secondnav = 'pending';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #FCFCFC;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Residents Management</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-agenda"></i>Pending Residents</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-12 m-b30">

								<div style="padding: 25px;"></div>
                                
                                <center><h2>PENDING RESIDENTS</h2></center>
								
								
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th>Profile</th>
												<th>Name</th>
												<th>Age</th>
												<th>Gender</th>
												<th>Purok</th>
												<th>Civil Status</th>
												<th>Valid IDs</th>
												<th width="80">Status</th>
												<th width="150">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$status = 5;
												$rows = $model->displayResidents($status);
												
												if (isset($_POST['filter'])) {
												    $_SESSION['get'] = 1;
												    $_SESSION['purok'] = $_POST['purok'];
                                                    $_SESSION['gender'] = $_POST['gender'];
                                                    $_SESSION['civil_status'] = $_POST['civil_status'];
                                                    
												    if ($_POST['purok'] == "All" && $_POST['gender'] == "All" && $_POST['civil_status'] == "All") {
												        $_SESSION['get'] = 0;
												        $rows = $model->displayResidents($status);
												    }
												    else {
												        if ($_POST['purok'] != "All") {
												            $purok = "address3 = '".$_POST['purok']."' AND ";
												        }
												        
												        else {
												            $purok = "";
												        }
												        
												        if ($_POST['gender'] != "All") {
												            $gender = "gender = '".$_POST['gender']."' AND ";
												        }
												        
												        else {
												            $gender = "";
												        }
												        
												        if ($_POST['civil_status'] != "All") {
												            $civil_status = "civil_status = '".$_POST['civil_status']."' AND ";
												        }
												        
												        else {
												            $civil_status = "";
												        }
												        
												        if($_POST['voterStatus'] != "All"){
												            $voterStatus = "resident_status = '".$_POST['voterStatus']."' AND ";
												        }
												        else{
												            $voterStatus = "";
												        }
												        
												        $_SESSION['purok'] = $purok;
												        $_SESSION['civil_status'] = $civil_status;
												        $_SESSION['gender'] = $gender;
												        $_SESSION['voterStatus'] = $voterStatus;
												        
												        $rows = $model->displayResidentsFiltered($purok, $gender, $civil_status, $voterStatus, $status);
												    }
												}
											

												if (!empty($rows)) {
													foreach ($rows as $row) {
														$id = $row['id'];
														$id_number = $row['id'];
														$first_name = $row['fname'];
														$middle_name = $row['mname'];
														$last_name = $row['lname'];
														$email = $row['email'];
														$contact = $row['contact_number'];
														$gender = $row['gender'];
														$civil_status = $row['civil_status'];
														$address = $row['address'];
														$address2 = $row['address2'];
														$address3 = $row['address3'];
														$resident_since = $row['resident_since'];
														$date_added = $row['date_registered'];
														$verified = $row['verified'];
														
														$bdt = date('Y', strtotime($row['birth_date']));
														$dttt = date("Y");
														$age = $dttt - $bdt;

														if ($verified == 1) {
															if ($row['email_verif'] == 1) {
															    $verified = 'Registered';
															    $verified2 = 'success';
    														}
    														else {
    															$verified = 'Registered';
    															$verified2 = 'success';
    														}
														}
														else {
															$verified = '<span style="font-size: 12px;">Unregistered</span>';
															$verified2 = 'danger';
														}
											?>
											<tr>
												
											<td><center><a href="../assets/images/resident-picture/<?php echo $row['prof_pic']; ?>" target="_blank">
												<img src="../assets/images/resident-picture/<?php echo $row['prof_pic']; ?>" 
											style="width: 100px;height: 80px; object-fit: cover;"></a>
											
										</center></td>
											<td><a href="residents-profile?id=<?php echo $id; ?>" style="color: #1E89EE;"><?php echo ucwords(strtolower($first_name.' '.$middle_name.' '.$last_name)); ?></a></td>
												<td><?php echo $age; ?></td>
												<td><?php echo $gender; ?></td>
												<td><?php echo $address3; ?></td>
												<td><?php echo $civil_status; ?></td>
												<td><center><a href="../assets/images/resident-picture/<?php echo $row['id1']; ?>" target="_blank">
												<img src="../assets/images/resident-picture/<?php echo $row['id1']; ?>" 
											style="width: 100px;height: 80px; object-fit: cover;"></a>
											<a href="../assets/images/resident-picture/<?php echo $row['id2']; ?>" target="_blank">
												<img src="../assets/images/resident-picture/<?php echo $row['id2']; ?>" 
											style="width: 100px;height: 80px; object-fit: cover;"></a>
										</center></td>
 											<td style="font-size: 12px;"><center><span class="badge badge-primary"><a href="" style="font-size: 14px;color: white;" data-toggle="modal" data-target="#status-<?php echo $row['id']; ?>">Pending</a></span></center> 
												    
										
												</td>
												
												
												<!-- <td style="font-size: 14px;"><?php echo date('M. d, Y g:i A', strtotime($date_added)); ?></td> -->
												<td>
													<center>
													    
													    <!--<a href="residents-profile?id=<?php echo $id; ?>" class="btn blue" style="width: 45px; height: 37px;"><div data-toggle="tooltip" title="Profile"><i class="ti-eye" style="font-size: 15px; margin-left:-5px;"></i></div></a>&nbsp;-->
													
													<a href="" class="btn green" style="width: 45px; height: 37px;" data-toggle="modal" data-target="#approve-<?php echo $id; ?>"><div data-toggle="tooltip" title="Approve"><i class="ti-check" style="font-size: 15px; margin-left:-5px;"></i></div></a>
													
													&nbsp;
													<a href="" class="btn red" style="width: 45px; height: 37px;" data-toggle="modal" data-target="#decline-<?php echo $id; ?>"><div data-toggle="tooltip" title="Decline"><i class="ti-archive" style="font-size: 15px; margin-left:-5px;"></i></div></a>
													
													
													
													</center>
											</tr>
											<div id="decline-<?php echo $id; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST">
													<div class="modal-dialog modal-md">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Decline Resident</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="approve_hidden" value="<?php echo $id; ?>">
																<div class="row">
																	<div class="form-group col-8">
																		<label class="col-form-label">Name</label>
																		<br><?php echo $first_name.' '.$middle_name.' '.$last_name; ?>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Gender</label>
																		<br><?php echo $gender; ?>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Email</label>
																		<br><?php echo $email; ?>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Contact</label>
																		<br><?php echo $contact; ?>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Purok</label>
																		<br><?php echo $address3; ?>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Resident Since</label>
																		<br><?php echo $resident_since; ?>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Date registered</label>
																		<br><?php echo date('M. d, Y g:i A', strtotime($date_added)); ?>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Reason </label>
 																		<textarea name="remarks"></textarea>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn red radius-xl outline" name="archive" onclick="return confirm('Are you sure you want to decline this information?')" value="Decline">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											
											
											<div id="approve-<?php echo $id; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST">
													<div class="modal-dialog modal-md">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Approve Resident</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="approve_hidden" value="<?php echo $id; ?>">
																<div class="row">
																	<div class="form-group col-8">
																		<label class="col-form-label">Name</label>
																		<br><?php echo $first_name.' '.$middle_name.' '.$last_name; ?>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Gender</label>
																		<br><?php echo $gender; ?>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Email</label>
																		<br><?php echo $email; ?>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Contact</label>
																		<br><?php echo $contact; ?>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Purok</label>
																		<br><?php echo $address3; ?>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Resident Since</label>
																		<br><?php echo $resident_since; ?>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Date registered</label>
																		<br><?php echo date('M. d, Y g:i A', strtotime($date_added)); ?>
																	</div>
																	<!-- <div class="form-group col-12">
            															<label class="col-form-label">Barangay ID Number of Resident</label>
            															<input class="form-control" type="text" name="r_id" required maxlength="15" placeholder="Enter Barangay ID of Resident">
            														</div> -->
																	
																</div>
															</div>
															<div class="modal-footer">
															    <input type="submit" class="btn green radius-xl outline" name="approveee" onclick="return confirm('Are you sure you want to approve this information?')" value="Approve">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php
                                                        
                                                        if (isset($_POST['approveee'])) {
															$approve_id = $_POST['approve_hidden'];
															$model->changeApproveResidentStatus($approve_id, 1);
															echo "<script>window.open('residents-pending', '_self');</script>";
															
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
                											$mail->Subject = 'Welcome to Barangay Poblacion Portal - Registration Approved';
                											$mail->Body = "Good day $first_name!<br><br>
                											This is to inform you that your account registration at Barangay Poblacion Portal is Approved.<br>
                											<h3>Barangay ID: $approve_id<br></h3>
                											If you forgot your password, click <a href='#'>here</a> to reset your account.

                											<br><br>

                											At your service, <br>
                											Barangay Poblacion";
                											
                											if ($mail->send()) {
                												 echo "<script>window.open('residents-pending', '_self');</script>";
                											} 
                
                											else {
                												echo $mail->ErrorInfo;
                											}
											
											
															echo "<script>window.open('residents-pending', '_self');</script>";
														}
														
														
														if (isset($_POST['archive'])) {
															$approve_id = $_POST['approve_hidden'];
															$remarks = $_POST['remarks'];
															$model->changeResidentStatus($approve_id, $remarks, 3);
															
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
                											$mail->Subject = 'Welcome to Barangay Poblacion Portal - Registration Declined';
                											$mail->Body = "Good day $first_name!<br><br>
                											This is to inform you that your account registration at Barangay Poblacion Portal is Declined. $remarks<br><br>
                											

                											At your service, <br>
                											Barangay Poblacion";
                											
                											if ($mail->send()) {
                												 echo "<script>window.open('residents-pending', '_self');</script>";
                											} 
                
                											else {
                												echo $mail->ErrorInfo;
                											}
											
											
															echo "<script>window.open('residents-pending', '_self');</script>";
														}
													}
												}

											?>
										</tbody>
									</table>
								</div>
								<br>
								<hr>
								<!-- <div align="right">
									<a href="" class="btn green radius-xl" style="background-color: #267621;" data-toggle="modal" data-target="#add-announcement"><i class="ti-agenda"></i><span>&nbsp;ADD NEW RESIDENT</span></a>&nbsp;
									<a href="pending-residents" class="btn green radius-xl" style="background-color: #267621;"><i class="ti-agenda"></i><span>&nbsp;PENDING RESIDENTS (<?php echo $pending; ?>)</span></a>&nbsp;
									<a href="archived-residents" class="btn red radius-xl"><i class="ti-agenda"></i><span>&nbsp;ARCHIVED RESIDENTS</span></a><br>
								</div> -->
								<div align="right">
								    <form method="POST" target="_blank">
    								    <button type="submit" name="export-pdf" class="btn blue radius-xl" style="background-color: <?php echo $primary_color; ?>"><i class="ti-import"></i>&nbsp;&nbsp;EXPORT TO PDF</button>
    									<!-- <a href="import-residents" class="btn blue radius-xl" style="background-color: <?php echo $primary_color; ?>"><i class="ti-import"></i>&nbsp;&nbsp;IMPORT RESIDENTS</a> -->
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