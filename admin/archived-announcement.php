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

		<title>Archived Announcements</title>

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
				
				$page = 'announcement';
				$secondnav = '';

				include 'nav.php'; 

				?>

				
			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #FCFCFC;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Manage Announcements</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-announcement"></i>Archived Announcements</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-12 m-b30">
								
								<?php
									$category = 0;
									$status = 2;

								?>
								<div align="right">
									<a href="announcement" class="btn green radius-xl" style="float: right;background-color: <?php echo $primary_color; ?>;"><i class="ti-announcement"></i><span>&nbsp;ANNOUNCEMENTS</span></a><br>
								</div>
								<div style="padding: 25px;"></div>
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th width="100">Image</th>
												<th>Title</th>
												<th>Details</th>
												<th width="140">Start Date</th>
												<th width="140">End Date</th>
												<th width="50">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php

												$rows = $model->displayAnnouncements($category, $status);

												if (!empty($rows)) {
													foreach ($rows as $row) {

											?>
											<tr>
												<td><a href="../assets/images/announcement/<?php echo $row['image_unique']; ?>.jpg" target="_blank"><img src="../assets/images/announcement/<?php echo $row['image_unique']; ?>.jpg" style="width: 120px;height: 60px; object-fit: cover;"></a></td>
												<td><?php echo $row['title']; ?></td>
												<td>
						                            <?php
						                            // Get the details from the database
						                            $details = $row['details'];

						                            // Check the length of the details
						                            if (strlen($details) > 100) {
						                                // Show the first 100 characters and add 'See More' functionality
						                                $shortText = substr($details, 0, 100);
						                                $fullText = htmlspecialchars($details, ENT_QUOTES, 'UTF-8');
						                                ?>
						                                <span class="short-text"><?php echo $shortText; ?>...</span>
						                                <span class="full-text" style="display: none;"><?php echo $fullText; ?></span>
						                                <a href="javascript:void(0);" class="toggle-text" onclick="toggleDetails(this)" style="color: #023e8b;">See More</a>
						                                <?php
						                            } else {
						                                // If the details are less than 100 characters, show the full text
						                                echo htmlspecialchars($details, ENT_QUOTES, 'UTF-8');
						                            }
						                            ?>
						                        </td>
												<td style="font-size: 14px;"><?php echo date('M. d, Y', strtotime($row['date'])); ?></td>
												<td style="font-size: 14px;"><?php echo date('M. d, Y', strtotime($row['expiration_date'])); ?></td>
												<td>
													<center>
														<!-- <a href="" class="btn blue" style="width: 50px; height: 37px;" data-toggle="tooltip" title="Edit"><i class="ti-marker-alt" style="font-size: 12px;"></i></a>&nbsp; -->
														<button data-toggle="modal" data-target="#archive-<?php echo $row['id']; ?>" class="btn green" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="Restore">
																<i class="ti-archive" style="font-size: 12px;"></i>
															</div>
														</button>
													</center>
												</td>
											</tr>
											<div id="archive-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-md">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Restore Announcement</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="archive-id" value="<?php echo $row['id']; ?>">
																<div class="row">
																	<div class="form-group col-12">
																		<label class="col-form-label">Title</label>
																		<p><?php echo $row['title']; ?></p>
																	</div>
																	<div class="form-group col-12">
																		<center>
																			<img id="display-img-<?php echo $row['id']; ?>" src="../assets/images/announcement/<?php echo $row['image_unique']; ?>.jpg" style="width: 500px; height: 300px; object-fit: cover;">
																		</center>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Details</label><br>
																		<?php echo $row['details']; ?>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Start Date</label>
																		<p><?php echo date('M. d, Y', strtotime($row['date'])); ?></p>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">End Date</label>
																		<p><?php echo date('M. d, Y', strtotime($row['expiration_date'])); ?></p>
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

													}
												}

												if (isset($_POST['archive'])) {
													$status = 1;
													$model->archiveAnnouncement($status, $_POST['archive-id']);
													echo "<script>window.open('archived-announcement', '_self');</script>";
												}

											?>
										</tbody>
									</table>
								</div>
								<hr>
								<!-- <div align="right">
									<a href="announcement" class="btn green radius-xl" style="float: right;background-color: #267621;"><i class="ti-announcement"></i><span>&nbsp;ANNOUNCEMENTS</span></a><br>
								</div> -->

					</div>
				</div>
			</div>
		</main>
		<div class="ttr-overlay"></div>

		<script src="../dashboard/assets/js/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				<?php

					$model = new Model();

					$readm = $model->displayAnnouncements($category, $status);

					if (!empty($readm)) {
						foreach ($readm as $read) {

				?>
				$('#content_<?php echo $read['id']; ?>').html("<?php echo str_replace(utf8_encode('"'), "'", substr($read['details'], 0, 150)); ?>..... <a id='read-more-<?php echo $read['id']; ?>' style='color: blue;'>Read more</a>");

				$(document).on('click', '#read-more-<?php echo $read['id']; ?>', function() {
					var content = "<?php echo str_replace(utf8_encode('"'), "'", preg_replace('/[\r\n]+/i', " ", $read['details'])); ?> <a id='show-less-<?php echo $read['id']; ?>' style='color: blue;'>Show less</a>";

					$('#content_<?php echo $read['id']; ?>').html(content);
				});

				$(document).on('click', '#show-less-<?php echo $read['id']; ?>', function() {
					$('#content_<?php echo $read['id']; ?>').html("<?php echo str_replace(utf8_encode('"'), "'", substr($read['details'], 0, 150)); ?>..... <a id='read-more-<?php echo $read['id']; ?>' style='color: blue;'>Read more</a>");
				});
				<?php

						}
					}

				?>
			});
		</script>
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
		<script>
			function toggleDetails(element) {
            var shortText = element.previousElementSibling.previousElementSibling;
            var fullText = element.previousElementSibling;

            if (fullText.style.display === "none") {
                shortText.style.display = "none";
                fullText.style.display = "inline";
                element.textContent = "See Less";
            } else {
                shortText.style.display = "inline";
                fullText.style.display = "none";
                element.textContent = "See More";
            }
        }
		</script>
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