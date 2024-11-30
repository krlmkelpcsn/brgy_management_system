<?php
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
		<link rel="stylesheet" href="froala/css/froala_editor.css">
		<link rel="stylesheet" href="froala/css/froala_style.css">
		<link rel="stylesheet" href="froala/css/plugins/code_view.css">
		<link rel="stylesheet" href="froala/css/plugins/colors.css">
		<link rel="stylesheet" href="froala/css/plugins/emoticons.css">
		<link rel="stylesheet" href="froala/css/plugins/image_manager.css">
		<link rel="stylesheet" href="froala/css/plugins/image.css">
		<link rel="stylesheet" href="froala/css/plugins/line_breaker.css">
		<link rel="stylesheet" href="froala/css/plugins/table.css">
		<link rel="stylesheet" href="froala/css/plugins/char_counter.css">
		<link rel="stylesheet" href="froala/css/plugins/video.css">
		<link rel="stylesheet" href="froala/css/plugins/fullscreen.css">
		<link rel="stylesheet" href="froala/css/plugins/file.css">
		<link rel="stylesheet" href="froala/css/plugins/quick_insert.css">
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
						<li>
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
						<li class="show">
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
									<a href="contact" class="ttr-material-button" style="color: <?php echo $primary_color; ?>"><span class="ttr-label">Contacts</span></a>
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
					<h4 class="breadcrumb-title">Content Management</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-harddrives"></i>Contacts</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-3 m-b30">
							<div class="heading-bx left">
								<h2 class="m-b10 title-head">Facebook<span> Link</span></h2>
							</div>
						<center>
							<span><?php echo $fb_link; ?></span><hr>
							<button type="button" class="btn green radius-xl" style="background-color: #267621;" data-toggle="modal" data-target="#edit-link">
								<i class="ti-marker-alt"></i>
								<span>&nbsp;EDIT LINK</span>
							</button>
						</center><br>
							<br>
							<br>
							<div class="heading-bx left">
								<h2 class="m-b10 title-head">Google <span>Map</span></h2>
							</div>
						<center>
							<span style="word-wrap: break-word;"><?php echo $iframe; ?></span><hr>
							<button type="button" class="btn green radius-xl" style="background-color: #267621;" data-toggle="modal" data-target="#edit-iframe">
								<i class="ti-marker-alt"></i>
								<span>&nbsp;EDIT IFRAME</span>
							</button>
						</center>
						<div id="edit-link" class="modal fade" role="dialog">
							<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Update Facebook Link</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="form-group col-12">
													<label class="col-form-label">Link</label>
													<input class="form-control" type="text" name="fb-link" value="<?php echo $fb_link; ?>" required>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<input type="submit" class="btn green radius-xl outline" name="update-fblink" value="Update">
											<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div id="edit-iframe" class="modal fade" role="dialog">
							<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Update Link</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="form-group col-12">
													<label class="col-form-label">Link</label>
													<input class="form-control" type="text" name="iframe" value="<?php echo $iframe; ?>" required>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<input type="submit" class="btn green radius-xl outline" name="update-iframe" value="Update">
											<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<?php

							if (isset($_POST['update-fblink'])) {
								$model->editContent('fb_link', $_POST['fb-link']);

								echo "<script>window.open('contact', '_self');</script>";
							}

							if (isset($_POST['update-iframe'])) {
								$model->editContent('iframe', $_POST['iframe']);

								echo "<script>window.open('contact', '_self');</script>";
							}

						?>
					</div>
					<div class="col-lg-9 m-b30"><div class="heading-bx left">
								<h2 class="m-b10 title-head">Contact <span>Numbers</span></h2>
							</div>
						<div class="table-responsive">
							<table id="table" class="table table-bordered hover" style="width:100%">
								<thead>
									<tr>
										<th>Contact Number</th>
										<th width="60">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php

										$rows = $model->fetchContactNumbers();

										if (!empty($rows)) {
											foreach ($rows as $row) {

									?>
									<tr>
										<td><?php echo $row['contact_num']; ?></td>
										<td>
											<center>
												<div data-toggle="tooltip" title="Delete">
													<button type="button" class="btn red" style="width: 50px; height: 37px;" data-toggle="modal" data-target="#delete-contact-<?php echo $row['id']; ?>">
														<i class="ti-trash" style="font-size: 12px;"></i>
													</button>
												</div>
											</center>
										</td>
									</tr>
									<div id="delete-contact-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
										<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Delete Contact Number</h4>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body">
														<input type="hidden" name="delete-contact-id" value="<?php echo $row['id']; ?>">
														<div class="row">
															<div class="form-group col-12">
																<label class="col-form-label">Contact</label>
																<input class="form-control" type="text" value="<?php echo $row['contact_num']; ?>" readonly>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<input type="submit" class="btn red radius-xl outline" name="delete-contact" value="Delete">
														<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</form>
									</div>
									<?php

											}
										}

										if (isset($_POST['delete-contact'])) {
											$model->deleteContactNumber($_POST['delete-contact-id']);

											echo "<script>window.open('contact', '_self');</script>";
										}

									?>
								</tbody>
							</table>
						</div>
						<hr>
						<form method="POST">
							<div id="dynamic_field">
								<div class="row">
									<div class="form-group col-5">
										<input class="form-control" type="text" name="contact-number[]" placeholder="Contact Number" required>
									</div>
									<div class="form-group col-1">
										<button type="button" class="btn green" style="width: 50px; height: 37px;" id="add">
											<div data-toggle="tooltip" title="Add">
												<i class="ti-plus" style="font-size: 12px;"></i>
											</div>
										</button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-6">
									<input type="submit" class="btn green radius-xl outline" name="insert-contacts" value="Insert">
								</div>
							</div>
						</form>
						<?php

							if (isset($_POST['insert-contacts'])) {
								for ($i = 0; $i < count($_POST['contact-number']); $i++) { 
									$model->insertContactNumber($_POST['contact-number'][$i]);
								}

								echo "<script>window.open('contact', '_self');</script>";
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
		<script type="text/javascript" src="froala/js/froala_editor.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/align.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/char_counter.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/code_beautifier.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/code_view.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/colors.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/draggable.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/emoticons.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/entities.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/file.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/font_size.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/font_family.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/fullscreen.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/image.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/image_manager.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/line_breaker.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/inline_style.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/link.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/lists.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/paragraph_format.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/paragraph_style.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/quick_insert.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/quote.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/table.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/save.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/url.min.js"></script>
		<script type="text/javascript" src="froala/js/plugins/video.min.js"></script>
		<script>
			(function () {
				new FroalaEditor("#edit", {
					toolbarButtons: {
						moreText: {
							buttons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting'],
							align: 'left',
							buttonsVisible: 3
						},
						moreParagraph: {
							buttons: ['alignLeft', 'alignCenter', 'formatOLSimple'],
							align: 'left',
							buttonsVisible: 3
						},
						moreMisc: {
							buttons: ['undo', 'redo'],
							align: 'right'
						}
					},
					toolbarButtonsXS: [['undo', 'redo'], ['bold', 'italic', 'underline']]
				})
			})()
		</script>
		<script type="text/javascript">
			function readURL(input, id) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#display-img-' + id).attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}
			}

			$(document).ready(function() {
				var i = 1;

				$('#add').click(function() {
					i++;

					$('#dynamic_field').append('<div class="row" id="row'+i+'"><div class="form-group col-5"><input class="form-control" type="text" name="contact-number[]" placeholder="Contact Number" required></div><div class="form-group col-1"><button type="button" class="btn red remove" style="width: 50px; height: 37px;" id="'+i+'"><div data-toggle="tooltip" title="Remove"><i class="ti-close" style="font-size: 12px;"></i></div></button></div></div>');
				});

				$(document).on('click', '.remove', function() {
					var button_id = $(this).attr("id");

					$('#row'+button_id+'').remove();
				});

				$('[data-toggle="tooltip"]').tooltip();
				$('#table').DataTable();
			});
		</script>
	</body>

</html>