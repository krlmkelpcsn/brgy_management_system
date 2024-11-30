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

	if(isset($_POST["inquires"])) { 
		
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

 		<title>Inquiries</title>

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
				
				$page = 'inquiries';
				$secondnav = '';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Inquiries</h4>
					
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
						
                     <form class="contact-bx dzForm" method="post" >
 										<div class="dzFormMsg"></div>
 										<div class="heading-bx left">
  											<h2 class="title-head"> <span>Inquiries</span></h2>
 										</div>
 										<div style="padding: 5px;"></div>
 										<div class="row placeani" id="sent">
 											<div class="col-lg-12">
 												
									<div class="col-lg-6 ">
										<div class="form-group">
                                        <label>Your Name</label>
											<div class="input-group">
                                                
                                                 <input name="user_id" type="hidden" value="<?=$uid=$_SESSION['sess2'];?>">
												<input name="name" type="text" value="<?=db_get_result('residents',"CONCAT(fname,' ' ,lname)",['id'=>$uid]);?>" required class="form-control" minlength="3" maxlength="25">
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
                                        <label>Your Email Address</label>
											<div class="input-group"> 
												<input name="email" type="email" value="<?=db_get_result('residents',"email",['id'=>$uid]);?>"class="form-control" required minlength="5" maxlength="35">
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<div class="input-group">
												<label>Subject</label>
												<input name="subject" type="text" required class="form-control" minlength="3" maxlength="25">
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<div class="input-group">
												<label>Type Message</label>
												<textarea name="message" rows="4" class="form-control" required minlength="5" maxlength="300" ></textarea>
											</div>
										</div>
									</div>
									<div class="col-lg-12" align="center">
										<button name="post_msg" type="submit" value="Submit" class="btn button-md button-block">Send Message</button>
									</div>
									<div class="col-lg-12" align="center">
									<br>
									<label style="color: green;font-weight: 540;">
									<?php
									if(isset($_POST['post_msg'])){
                                        
 		                                $user_id = $_POST['user_id'];
		                                $name = $_POST['name'];
		                                $email = $_POST['email'];
		                                $subject = $_POST['subject'];
		                                $message = $_POST['message'];
		                                $date = date("Y-m-d H:i:s");

		                                $model = new Model();
		                               	$new = $model->post_message($user_id, $name, $email, $subject, $message, $date);

		                                if ($new) {
		                                    echo  $msg ="MESSAGE SENT!";
                                            
echo "<script type='text/javascript'>alert('$msg');window.location.href='inquiries.php';</script>";
		                                }       

		                            }
									?>
									</label>

                                    </div>

 											</div>
 											
 										</form>
 

											<div class="col-lg-12">
												<div id="request_button">
													<?php
													$request_type = 1;
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

															echo "<script>window.open('clearance', '_self');</script>";
														}
													} else { ?>
 													
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
							<h2 class="title-head"> Inquiries<span>  History</span></h2>
						</div>
						<div class="table-responsive">
							
                        <table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
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

 $result = my_query("SELECT *  FROM inquiries WHERE resident_id=   ".$_SESSION['sess2']);
for ($i = 1; $row = $result->fetch(); $i++) {
    $id = $row['id']; 
														$name = $row['name'];
														$email = $row['email'];
														$subject = $row['subject'];
														$message = $row['message'];
														$date_sent = $row['date_sent'];

											?>
											<tr>
  											
											
												<td><?php if (($row['resident_id']==0)) { echo 'Random'; }else{ echo 'Resident';  }  ?></td>
												
												<td><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo $name; if ($row['read_unread'] == 0) { echo '</b>'; }  ?></td>
												<td><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo $email; if ($row['read_unread'] == 0) { echo '</b>'; } ?></td>
												<td><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo $subject; if ($row['read_unread'] == 0) { echo '</b>'; } ?></td>
												<td><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo $message; if ($row['read_unread'] == 0) { echo '</b>'; } ?></td>
												<td style="font-size: 14px;"><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo date('M. d, Y g:i A', strtotime($date_sent)); if ($row['read_unread'] == 0) { echo '</b>'; } ?></td>
											</tr>
                                            <?php  }?>
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