<?php
    use PHPMailer\PHPMailer\PHPMailer;
    
	ob_start(); 
	session_start(); 
	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['sess'])) {
		echo "<script>window.open('../','_self');</script>";
	}

	$depart = "1";
	$status = "1";
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

		<title>Brgy. Victoria Reyes</title>

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
	<body class="ttr-opened-sidebar ttr-pinned-sidebar" style="background-color: #F3F3F3;">

		<?php include 'navbar.php'; ?>

		<div class="ttr-sidebar">
			<div class="ttr-sidebar-wrapper content-scroll">
				
				<?php include 'sidebar.php'; ?>

				<nav class="ttr-sidebar-navi">
					<ul>
						<li style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px; background-color: #e0e0e0; margin-top: 0px; margin-bottom: 0px;">
							<span class="ttr-label" style="color: black; font-weight: 500;">Main Navigation</span>
						</li>
						<li style="margin-top: 0px;">
							<a href="index" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-home"></i></span>
								<span class="ttr-label">Dashboard</span>
							</a>
						</li>
						<li>
							<a href="#" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-agenda"></i></span>
			                	<span class="ttr-label">Records</span>
			                	<span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
			                </a>
			                <ul>
			                	<li>
			                		<a href="blotters" class="ttr-material-button"><span class="ttr-label">Blotters</span></a>
			                	</li>
			                	<li>
			                		<a href="residents" class="ttr-material-button"><span class="ttr-label">Residents</span></a>
			                	</li>
			                	<li>
			                		<a href="census" class="ttr-material-button"><span class="ttr-label">Census</span></a>
			                	</li>
			                </ul>
			            </li>
						<li>
							<a href="reports" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-stats-up"></i></span>
								<span class="ttr-label">Reports</span>
							</a>
						</li>
						<li>
							<a href="activities" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-menu"></i></span>
								<span class="ttr-label">Programs</span>
							</a>
						</li>
						<li class="show">
							<a href="inquiries" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-help"></i></span>
								<span class="ttr-label">Inquiries (<?php echo $unread; ?>)</span>
							</a>
						</li>
						<li>
							<a href="chat" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-envelope"></i></span>
								<span class="ttr-label">Messages</span>
							</a>
						</li>
						<li>
							<a href="#" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-harddrives"></i></span>
			                	<span class="ttr-label">Content Management</span>
			                	<span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
			                </a>
			                <ul>
			                	<li>
			                		<a href="content-management" class="ttr-material-button"><span class="ttr-label">Story, Logo, Vision, Mission</span></a>
			                	</li>
			                	<li>
			                		<a href="org-structure" class="ttr-material-button"><span class="ttr-label">Org. Structure</span></a>
			                	</li>
			                	<li>
			                		<a href="guidelines" class="ttr-material-button"><span class="ttr-label">Guidelines</span></a>
			                	</li>
			                	<li>
			                		<a href="instructions" class="ttr-material-button"><span class="ttr-label">Services</span></a>
			                	</li>
			                	<li>
			                		<a href="contact" class="ttr-material-button"><span class="ttr-label">Contacts</span></a>
			                	</li>
			                </ul>
			            </li>
						<li>
							<a href="announcement" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-announcement"></i></span>
								<span class="ttr-label">Announcement</span>
							</a>
						</li>
						<li>
							<a href="#" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-server"></i></span>
			                	<span class="ttr-label">Monitoring of Request</span>
			                	<span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
			                </a>
			                <ul>
			                    <li>
			                		<a href="walk-in-request" class="ttr-material-button"><span class="ttr-label">Walk-In Request</span></a>
			                	</li>
			                	<li>
			                		<a href="monitoring-of-request" class="ttr-material-button"><span class="ttr-label">Pending Request (<?php echo $cpending; ?>)</span></a>
			                	</li>
			                	<li>
			                		<a href="approved-request" class="ttr-material-button"><span class="ttr-label">Approved Request (<?php echo $capproved; ?>)</span></a>
			                	</li>
			                	<li>
			                		<a href="declined-request" class="ttr-material-button"><span class="ttr-label">Declined Request (<?php echo $cdeclined; ?>)</span></a>
			                	</li>
			                </ul>
			            </li>
						<li>
							<a href="settings" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-settings"></i></span>
								<span class="ttr-label">Settings</span>
							</a>
						</li>
						<li class="ttr-seperate"></li>
					</ul>
				</nav>
			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Inquiries Management</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-help"></i>Inquiries</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-12 m-b30">

								<div style="padding: 25px;"></div>
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												
												<th width="135">Name</th>
												<th width="135">Subject</th>
												<th>Message</th>
												<th width="135">Date Sent</th>
												<th>Replied</th>
												<th width="100">Action</th>
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
												<td><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo $name; if ($row['read_unread'] == 0) { echo '</b>'; }  ?></td>
												<td><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo $subject; if ($row['read_unread'] == 0) { echo '</b>'; } ?></td>
												<td><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo $message; if ($row['read_unread'] == 0) { echo '</b>'; } ?></td>
												<td style="font-size: 14px;"><?php if ($row['read_unread'] == 0) { echo '<b>'; } echo date('M. d, Y g:i A', strtotime($date_sent)); if ($row['read_unread'] == 0) { echo '</b>'; } ?></td>
												<td><center><b><?php if (empty($row['replied'])) { echo '<span class="badge badge-danger">No Reply</span>'; } else { echo '<span class="badge badge-success"><a href="" data-toggle="modal" data-target="#reply-view-'.$row['id'].'" style="color: white;">Replied</a></span>'; }?></b></center></td>
												<td>
													<center>
														<button data-toggle="modal" data-target="#reply-<?php echo $row['id']; ?>" class="btn green" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="Reply">
																<i class="ti-comment" style="font-size: 12px;"></i>
															</div>
														</button>
														<button data-toggle="modal" data-target="#delete-<?php echo $row['id']; ?>" class="btn red" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="Delete">
																<i class="ti-archive" style="font-size: 12px;"></i>
															</div>
														</button>
													</center>
												</td>
											</tr>
											<div id="delete-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-lg">
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
											<div id="reply-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Reply to Inquiry</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="reply-id" value="<?php echo $row['id']; ?>">
																<input type="hidden" name="name" value="<?php echo $name; ?>">
																<input type="hidden" name="email" value="<?php echo $email; ?>">
																<input type="hidden" name="subject" value="<?php echo $subject; ?>">
																<div class="row">
																	<div class="form-group col-12">
																		<label class="col-form-label">Message</label>
																		<textarea class="form-control" name="message" required></textarea>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn green radius-xl outline" name="reply" value="Reply">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php
											
											    $reply_views = $model->fetchReplyDetails($row['id']);
											    
											    if (!empty($reply_views)) {
											        foreach ($reply_views as $reply_view) {
											
											?>
											<div id="reply-view-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Reply to Inquiry</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<div class="row">
																	<div class="form-group col-12">
																		<label class="col-form-label">Message</label>
																		<textarea class="form-control" readonly><?php echo $reply_view['reply']; ?></textarea>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Date Sent</label>
																		<input type="text" class="form-control" value="<?php echo $reply_view['date_sent']; ?>" readonly>
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

													}
												}

												if (isset($_POST['delete'])) {
													$model->deleteInquiry($_POST['delete-id']);
												}
												
												if (isset($_POST['reply'])) {
													$name = $_POST['name'];
													$email = $_POST['email'];
													$subject = $_POST['subject'];
													$message = $_POST['message'];
													
													$model->insertReply($_POST['reply-id'], $message);
                                                    $model->updateRepliedStatus($_POST['reply-id']);
                                                    
														require_once "PHPMailer/PHPMailer.php";
														require_once "PHPMailer/SMTP.php";
														require_once "PHPMailer/Exception.php";

														$mail = new PHPMailer();

														$mail->isSMTP();
														$mail->Host = "smtp.gmail.com";
														$mail->SMTPAuth = true;
														$mail->Username = "brgyvictoriareyes01@gmail.com";
														$mail->Password = "123456789QWERTY";
														$mail->Port = 465;
														$mail->SMTPSecure = "ssl";
														$mail->isHTML(true);
														$mail->setFrom("brgyvictoriareyes01@gmail.com", 'Inquiry');
														$mail->addAddress($email);
														$mail->Subject = $subject;
														$mail->Body = "$message";

														if ($mail->send()) {
															echo "<script>window.open('inquiries','_self');</script>";
														} 

														else {
															echo $mail->ErrorInfo;
														}
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