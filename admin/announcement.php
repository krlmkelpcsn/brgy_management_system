<?php
	ob_start(); 
	session_start(); 
	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['org_sess'])) {
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

		<title>Announcements</title>

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
 						<li><i class="ti-announcement"></i>Announcements</li>
					
					</ul>
					<select name="category" onchange="if (this.value) window.location.href=this.value">
						<option <?=(isset($_GET['c']) ? ($_GET['c']==0 ? 'selected' : '') : '');  ?>   value="announcement.php?c=0">None</option>
						<option <?=(isset($_GET['c']) ? ($_GET['c']==1 ? 'selected' : '') : '');  ?>  value="announcement.php?c=1">PWD</option>
						<option <?=(isset($_GET['c']) ? ($_GET['c']==2 ? 'selected' : '') : '');  ?>  value="announcement.php?c=2">Solo Parent</option>
						<option <?=(isset($_GET['c']) ? ($_GET['c']==3 ? 'selected' : '') : '');  ?>  value="announcement.php?c=3">Senior Citizen</option>
					</select>
				</div>  
 				
      													
														
													

				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-12 m-b30">
								
								<?php
								if(isset($_GET['c'])){
									$category = $_GET['c'];
								}else{
									$category = 0;
								}
									
									$status = 1;
									if (isset($_POST['add_announcement'])) {
										$title = $_POST['title'];
										$date = $_POST['date'];
										$date2 = $_POST['date2'];
										$category = $_POST['category'];
										$age_from = $_POST['age_from'];
										$age_to = $_POST['age_to'];
										$details = trim($_POST['details']);

										$path = '../assets/images/announcement/';
										$unique = time().uniqid(rand());
										$destination = $path . $unique . '.jpg';
										$base = basename($_FILES["image"]["name"]);
										$image = $_FILES["image"]["tmp_name"];
										move_uploaded_file($image, $destination);

										//$age_from, $age_to, 
										$model->addAnnouncement2($age_from, $age_to, $title, $details, $base, $unique, $date, $date2, $category);
 																			
										echo "<script>window.open('announcement', ,'_self');</script>";
									}

								?>
								<div align="right">
									<a href="" class="btn green radius-xl" style="background-color: <?php echo $primary_color; ?>;" data-toggle="modal" data-target="#add-announcement"><i class="ti-announcement"></i><span>&nbsp;ADD NEW ANNOUNCEMENT</span></a>&nbsp;&nbsp;<a href="archived-announcement" class="btn red radius-xl"><i class="ti-archive"></i><span>&nbsp;ARCHIVED ANNOUNCEMENTS</span></a>
								</div>
								<div style="padding: 25px;"></div>
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th width="100">Image</th>
												<th>Title</th>
												<th>Details</th>
												<th>Age</th>
												<th width="140">Start Date</th>
												<th width="140">End Date</th>
												<th width="100">Action</th>
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
												<td><?php echo $row['age_from']. ' - '.$row['age_to']; ?></td>
												<td style="font-size: 14px;"><?php echo date('M. d, Y', strtotime($row['date'])); ?></td>
												<td style="font-size: 14px;"><?php echo date('M. d, Y', strtotime($row['expiration_date'])); ?></td>
												<td>
													<center>
														<!-- <a href="" class="btn blue" style="width: 50px; height: 37px;" data-toggle="tooltip" title="Edit"><i class="ti-marker-alt" style="font-size: 12px;"></i></a> -->
														<button data-toggle="modal" data-target="#edit-<?php echo $row['id']; ?>" class="btn blue" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="Edit">
																<i class="ti-marker-alt" style="font-size: 12px;"></i>
															</div>
														</button>&nbsp;
														<button data-toggle="modal" data-target="#archive-<?php echo $row['id']; ?>" class="btn red" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="Archive">
																<i class="ti-archive" style="font-size: 12px;"></i>
															</div>
														</button>
													</center>
												</td>
											</tr>
											<div id="edit-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-md">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Edit Announcement</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="edit-id" value="<?php echo $row['id']; ?>">
																<div class="row">
																	<div class="form-group col-12">
																		<label class="col-form-label">Title</label>
																		<input class="form-control" name="title" type="text" value="<?php echo $row['title']; ?>" required>
																	</div>
																	<div class="form-group col-12">
																		<center>
																			<img id="display-img-<?php echo $row['id']; ?>" src="../assets/images/announcement/<?php echo $row['image_unique']; ?>.jpg" style="width: 500px; height: 300px; object-fit: cover;">
																		</center>
																	</div>
																	<div class="form-group col-12">
																		<center><label class="col-form-label">Image</label><br>
																		<input type="file" name="image" id="input-img-<?php echo $row['id']; ?>" onchange="readURL(this, '<?php echo $row['id']; ?>')" accept="image/*" style="border: 0px; padding: 0px;"></center>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Details</label>
																		<textarea class="form-control" name="details"  required><?php echo $row['details']; ?></textarea>
																	</div>
										
																	<div class="form-group col-12">
															<label class="col-form-label"><b>Category </b></label>
															<select class="form-control" name="category">
																<option <?=($row['category']==0 ? 'selected' : '');  ?>  value="">None</option>
																<option <?=($row['category']==1 ? 'selected' : '');  ?>  value="1">PWD</option>
																<option <?=($row['category']==2 ? 'selected' : '');  ?>  value="2">Solo Parent</option>
																<option <?=($row['category']==3 ? 'selected' : '');  ?>  value="3">Senior Citizen</option>
															</select>
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Age From</b></label>
															<input class="form-control" type="number" value="<?php echo $row['age_from']; ?>" name="age_from" required>
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Age To</b></label>
															<input class="form-control" type="number" value="<?php echo $row['age_to']; ?>"  name="age_to" required>
														</div>
														
																	<div class="form-group col-6">
																		<label class="col-form-label">Start Date</label>
																		<input class="form-control" name="date" type="datetime-local" value="<?php echo date('Y-m-d\TH:i:s', strtotime($row['date'])); ?>" required>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">End Date</label>
																		<input class="form-control" name="date2" type="datetime-local" value="<?php echo date('Y-m-d\TH:i:s', strtotime($row['expiration_date'])); ?>" required>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn green radius-xl outline" name="edit" value="Save Changes">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											<div id="archive-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
													<div class="modal-dialog modal-md">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Archive Announcement</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="archive-id" value="<?php echo $row['id']; ?>">
																<div class="row">
																	<div class="form-group col-12">
																		<label class="col-form-label">Title</label>
																		<?php echo $row['title']; ?>
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
																<input type="submit" class="btn red radius-xl outline" name="archive" onclick="return confirm('Are you sure you want to archive this information?')" value="Archive Announcement">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php 

													}
												}

												if (isset($_POST['edit'])) {
													$edit_id = $_POST['edit-id'];

													$model->editAnnouncement2($_POST['title'], $_POST['details'], $_POST['date'], $_POST['date2'], $edit_id);
 
													db_update('announcements',['category'=>$_POST['category'],'age_from'=>$_POST['age_from'],'age_to'=>$_POST['age_to']],['id'=>$edit_id]);

													if (!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {}

													else {
														$path = '../assets/images/announcement/';
														$unique = time().uniqid(rand());
														$destination = $path . $unique . '.jpg';
														$base = basename($_FILES["image"]["name"]);
														$image = $_FILES["image"]["tmp_name"];
														move_uploaded_file($image, $destination);

														$model->editImageAnnouncement($base, $unique, $edit_id);
													}

													echo "<script>window.open('announcement', '_self');</script>";
												}

												if (isset($_POST['archive'])) {
													$status = 2;
													$model->archiveAnnouncement($status, $_POST['archive-id']);
													echo "<script>window.open('announcement', '_self');</script>";
												}

											?>
										</tbody>
									</table>
								</div>
								<hr>
								<div align="right">
									<!-- <button type="button" class="btn red radius-xl" data-toggle="modal" data-target="#delete-announcement"><i class="ti-archive"></i><span>&nbsp;DELETE ALL ANNOUNCEMENTS</span></button> -->
									<!-- <a href="" class="btn green radius-xl" style="background-color: #267621;" data-toggle="modal" data-target="#add-announcement"><i class="ti-announcement"></i><span>&nbsp;ADD NEW ANNOUNCEMENT</span></a>&nbsp;&nbsp;<a href="archived-announcement" class="btn red radius-xl"><i class="ti-archive"></i><span>&nbsp;ARCHIVED ANNOUNCEMENTS</span></a> -->
								</div>

								<div id="delete-announcement" class="modal fade" role="dialog">
									<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Delete Announcements</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-12">
															<p>Are you sure you want to delete ALL Announcements?</p>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<input type="submit" class="btn green radius-xl outline" name="delete_announcements" value="Confirm">
													<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<?php

									if (isset($_POST['delete_announcements'])) {
										$model->deleteAnnouncements(1, 0);
										echo "<script>window.open('announcement', '_self');</script>";
									}

								?>

								<div id="add-announcement" class="modal fade" role="dialog">
									<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
										<div class="modal-dialog modal-md">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Add Announcement</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-12">
															<label class="col-form-label"><b>Title</b></label>
															<input class="form-control" type="text" name="title" required>
														</div>
														<div class="form-group col-12">
															<center>
																<img id="display-img-" style="width: 100%; height: 200px; object-fit: cover;">
															</center>
														</div>
														<div class="form-group col-12">
															<center><label class="col-form-label"><b>Image</b></label><br>
															<input type="file" name="image" accept="image/*" onchange="readURL(this, '')" style="border: 0px; padding: 0px;" required></center>
														</div>
														<div class="form-group col-12">
															<label class="col-form-label"><b>Details</b></label>
															<textarea class="form-control" name="details"  required></textarea>
														</div>

														<div class="form-group col-12">
															<label class="col-form-label"><b>Category </b></label>
															<select class="form-control" name="category">
																<option value="">None</option>
																<option value="1">PWD</option>
																<option value="2">Solo Parent</option>
																<option value="3">Senior Citizen</option>
															</select>
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Age From</b></label>
															<input class="form-control" type="number" name="age_from" required>
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Age To</b></label>
															<input class="form-control" type="number" name="age_to" required>
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Start Date</b></label>
															<input class="form-control" type="datetime-local" name="date" required>
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>End Date</b></label>
															<input class="form-control" type="datetime-local" name="date2" required>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<input type="submit" class="btn green radius-xl outline" name="add_announcement" value="Add Announcement">
													<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</form>
								</div>
						
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
				$('#table').DataTable();
			});

			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</body>

</html>