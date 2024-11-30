<?php
	
	session_start();

	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['org_sess'])) {
		echo "<script>window.open('../','_self');</script>";
	}

	if (isset($_POST['save_pass'])) {
		$model = new Model();
        
        $edit_id = $_SESSION['org_sess'];
		$model->editStructure($_POST['name'], $_POST['email'], $position_id, $_POST['rendered'], $edit_id);
		
		if (!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {}

		else {
		    $path = '../assets/images/org-structure/';
			$unique = time().uniqid(rand());
            $destination = $path . $unique . '.jpg';
			$base = basename($_FILES["image"]["name"]);
			$image = $_FILES["image"]["tmp_name"];
			move_uploaded_file($image, $destination);

			$model->editStructureImage($base, $unique, $edit_id);
	    }

	    echo "<script>alert('Profile has been changed!');window.open('settings','_self');</script>";
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

		<title><?php echo $web_name; ?></title>

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
				
				$page = 'dashboard';


				include 'nav.php'; 

				?>
				
			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Settings</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-settings"></i>My Profile</li>
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
					margin: 0!important;
				}
				</style>
				<div class="row">
					<div class="col-lg-12 m-b30">

						<div class="row">
							<div class="col-lg-12 m-b30">
								        
										<form class="edit-profile" method="POST" enctype="multipart/form-data">
										    <?php
										    
										        $rows = $model->fetchSpecifiedOrgStructure($_SESSION['org_sess']);
										        
										        if (!empty($rows)) {
										            foreach ($rows as $row) {
										    
										    ?>
										    <div class="row">
												<div class="col-sm-3">
												    <center><a href="../assets/images/org-structure/<?php echo $row['image_unique']; ?>.jpg" target="_blank"><img id="display-img" src="../assets/images/org-structure/<?php echo $row['image_unique']; ?>.jpg" style="width: 200px; height: 200px; border-radius: 50%;object-fit: cover;"></a></center>
	
													<label>Photo</label>
													<input class="form-control" type="file" name="image" accept="image/*" style="border: 0px; padding: 0px;background-color: #F3F3F3;" id="input-img" onchange="readURL(this)">
												</div>
												<div class="col-sm-7">
												    <label class="col-form-label"><b>Name</b></label>
													<input class="form-control" type="text" name="name" value="<?php echo $row['name']; ?>" required>
													<div style="height: 7px;"></div>
													
													<label class="col-form-label"><b>Email</b></label>
													<input class="form-control" type="email" name="email" value="<?php echo $row['email']; ?>" required>
													<div style="height: 7px;"></div>
													
													<label class="col-form-label"><b>Rendered Service</b></label>
													<input class="form-control" name="rendered" type="text" value="<?php echo $row['rendered_service']; ?>" required>
													<div style="height: 7px;"></div>
													
													<label class="col-form-label"><b>Position</b></label>
													<input class="form-control" type="text" value="<?php echo $position; ?>" readonly>
													<label class="col-sm-2 col-form-label" id="message"></label><br>
													<button name="save_pass" type="submit" class="btn green radius-xl" style="color: white;"><i class="ti-save"></i>&nbsp; Save changes</button>
													<a href="settings" class="btn-secondry radius-xl"><i class="ti-close"></i> &nbsp; Cancel</a>
												</div>
											</div>
    
											<?php
											
										            }
										        }
											
											?>
											
										</form>

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
		<script type="text/javascript">
		    function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#display-img').attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}
			}
		
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