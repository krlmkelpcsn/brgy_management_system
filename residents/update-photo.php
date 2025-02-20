<?php
	
	session_start();

	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['sess2'])) {
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

		<link rel="icon" href="../assets/images/icon.png" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="../assets/images/icon.png" />

		<title>Upload Photo</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

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


		.widget-card .icon {
			position: absolute;
			top: auto;
			bottom: -20px;
			right: 5px;
			z-index: 0;
			font-size: 65px;
			color: rgba(0, 0, 0, 0.15);
		}
		.col-xs-5ths,
		.col-sm-5ths,
		.col-md-5ths,
		.col-lg-5ths {
				position: relative;
				min-height: 1px;
				padding-right: 15px;
				padding-left: 15px;
		}

		.col-xs-5ths {
				width: 20%;
				float: left;
		}

		@media (min-width: 768px) {
				.col-sm-5ths {
						width: 20%;
						float: left;
				}
		}

		@media (min-width: 992px) {
				.col-md-5ths {
						width: 20%;
						float: left;
				}
		}

		@media (min-width: 1200px) {
				.col-lg-5ths {
						width: 20%;
						float: left;
				}
		}
	</style>
	<?php include '../assets/css/color/color-1.php';  ?>
	<body class="ttr-opened-sidebar ttr-pinned-sidebar" style="background-color: #F3F3F3;">

		<?php include 'navbar.php'; ?>

		<div class="ttr-sidebar">
			<div class="ttr-sidebar-wrapper content-scroll">
				
				<?php 
			
				include 'sidebar.php';
				
				$page = 'dashboard';
				$secondnav = '';

				include 'nav.php'; 

				?>
				
			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Dashboard</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-image"></i>Update Photo</li>
					</ul>
				</div> 
				
				<?php include 'widget.php'; ?>

				<div class="row">
				            <div class="col-lg-3 m-b30">
				                <br><br>
				                
				                <form class="contact-bx" method="POST" enctype="multipart/form-data">
				                <center><img id="display-img-head" src="../assets/images/profile-pictures/<?php echo $prof_pic; ?>.jpg" style="width: 250px; height: 250px; border-radius: 50%;object-fit: cover;" alt="User">

				                <label class="col-form-label">&nbsp;&nbsp;Select New Photo<br>&nbsp;&nbsp;&nbsp;&nbsp;File Type: PNG or JPG</label><br>
								<input class="" type="file" name="image" accept="image/*" style="border: 0px; padding: 0px;" onchange="readURL(this, 'head')" required>
								 <hr>
				                <button name="submit" type="submit" value="Submit" class="btn blue radius-xl"><i class="ti-file"></i> Save Photo</button>
				                
				                </center>
				                </form>
				                <?php
											if (isset($_POST['submit'])) {

												$filename=$_FILES['image']['name'];
													$file = basename($filename);

													if(strtolower(end(explode(".",$file))) =="mp4") {
														echo "<script>alert('Invalid file type.');window.open('update-photo', '_self');</script>";
													}
													else {
													if (!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {}
													else {

														$is_image = getimagesize($_FILES["image"]["tmp_name"]) ? true : false;

														if ($is_image) {
															$path = '../assets/images/profile-pictures/';
															$unique = time().uniqid(rand());
															$destination = $path . $unique . '.jpg';
															$base = basename($_FILES["image"]["name"]);
															$image = $_FILES["image"]["tmp_name"];
															move_uploaded_file($image, $destination);

															$model->updateResidentPhoto($unique);

															echo "<script>alert('Profile picture has been updated');window.open('update-profile', '_self');</script>";
														}
														else {
															echo "<script>alert('Profile picture has been updated');window.open('update-profile', '_self');</script>";
														}

													}
												}
											}
										?>
				            </div>
							<div class="col-lg-9 m-b30">
						</div>
			</div>
		</main>
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
		<script src='../dashboard/assets/vendors/calendar/fullcalendar.js'></script>
		<script>
			function readURL(input, id) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#display-img-' + id).attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}
			}
		</script>
	</body>

</html>