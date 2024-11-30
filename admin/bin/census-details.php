<?php
	ob_start(); 
	session_start(); 
	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['sess'])) {
		echo "<script>window.open('../','_self');</script>";
	}

	$id = isset($_GET['id']) ? $_GET['id'] : '';
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
			ul.dropdown-menu > li {
			    border: 0px!important;
			    margin-bottom: 0px!important;
			    display: block!important;
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
						<li class="show">
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
			                		<a href="census" class="ttr-material-button"><span class="ttr-label" style="color: <?php echo $primary_color; ?>">Census</span></a>
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
						<li>
							<a href="#" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-harddrives"></i></span>
			                	<span class="ttr-label">Content Management</span>
			                	<span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
			                </a>
			                <ul>
			                	<li>
			                		<a href="content-management" class="ttr-material-button"><span class="ttr-label">Story, Logo, Vission, Mission</span></a>
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
					<h4 class="breadcrumb-title">Residents Management</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-agenda"></i>Census Details</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; 
				$rows = $model->displayCensusProfile($id);

				if (!empty($rows)) {
					foreach ($rows as $row) {
                        
                        $head_fname = $row['head_fname'];
                        $head_mname = $row['head_mname'];
                        $head_lname = $row['head_lname'];
                        $head_sname = $row['head_sname'];
                        $head_email = $row['head_email'];
                        $head_contact = $row['head_contact'];
                        $head_gender = $row['head_gender'];
                        $head_civil_status = $row['head_civil_status'];
                        $head_birthday = $row['head_birthday'];
                        $head_employed = $row['head_employed'];
                        $head_self_employed = $row['head_self_employed'];
                        $head_informal = $row['head_informal'];
                        $head_solo_parent = $row['head_solo_parent'];
                        $head_pwd = $row['head_pwd'];
                        $resident_id = $row['resident_id'];
						$census_id  = $row['census_id '];
                        $room_number = $row['room_number'];
                        $house_number = $row['house_number'];
                        $block_number= $row['block_number'];
                        $lot_number = $row['lot_number'];
                        $street = $row['street'];
                        $subdivision = $row['subdivision'];
                        $monthly_income = $row['monthly_income'];
                        
                        
                        $salary = $row['salary'];
                        $business = $row['business'];
                        $remittance = $row['remittance'];
                        $others = $row['others'];
                        
                        
                        
                        
                        
                        
						if ($head_employed == 1) { $head_employed = "Yes"; } else { $head_employed = "No"; }
                        if ($head_self_employed == 1) { $head_self_employed = "Yes"; } else { $head_self_employed = "No"; }
                        if ($head_informal == 1) { $head_informal = "Yes"; } else { $head_informal = "No"; }
                        if ($head_solo_parent == 1) { $head_solo_parent = "Yes"; } else { $head_solo_parent = "No"; }
                        if ($head_pwd == 1) { $head_pwd = "Yes"; } else { $head_pwd = "No"; }
                        
                        if ($room_number == "") { $room_number = ""; } else { $room_number = "".$room_number.""; }
                        if ($house_number == "") { $house_number = ""; } else { $house_number = "".$house_number.","; }
                        if ($block_number == "") { $block_number = ""; } else { $block_number = "Blk ".$block_number.","; }
                        if ($lot_number == "") { $lot_number = ""; } else { $lot_number = "Lot ".$lot_number.","; }
                        if ($subdivision == "") { $subdivision = ""; } else { $subdivision = "".$subdivision.","; }
                        
                        if ($salary == 1) { $salary = ""; } else { $salary = "Salary,"; }
                        if ($business == 1) { $business = ""; } else { $business = "Business,"; }
                        if ($remittance == 1) { $remittance = ""; } else { $remittance = "Remittance,"; }
                        if ($others == 1) { $others = ""; } else { $others = "".$others.""; }
                        
					}
				}


				?>

				<div class="row">
					<div class="col-lg-5 m-b30">
					    
					    
								<div class="new-user-list">
                                  <div class="heading-bx left">
                                    <h2 class="m-b10 title-head">Head <span>of the Family</span></h2>
                                  </div>
                                  <h3><?php echo strtoupper($head_fname); ?> <?php echo strtoupper($head_mname); ?> <?php echo strtoupper($head_lname); ?><br></h3>
                                  <span style="font-size: 16px;">
                                   <?php echo $room_number; ?>
                                    <?php echo $house_number; ?>
                                    <?php echo $block_number; ?>
                                    <?php echo $lot_number; ?>
                                    <?php echo $street; ?>
                                    <?php echo $subdivision; ?> Barangay Victoria Reyes, Dasmarinas, Cavite
                        <br><?php echo $head_email; ?> | <?php echo $head_contact; ?></span>
                        <hr>
                                  <div class="new-user-list">
                                    <ul>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Gender</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_gender; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Civil Status</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_civil_status; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Birthday</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_birthday; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Employed?</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_employed; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Self-employed in business?</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_self_employed; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Self-employed in informal sector?</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_informal; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Solo parent?</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_solo_parent; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">PWD?</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_pwd; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Monthly Income</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $monthly_income; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Income Sources</a>
                                        </span>
                                        <span class="new-users-btn">
                                           <?php echo $salary; ?>
                                           <?php echo $business; ?>
                                           <?php echo $remittance; ?>
                                           <?php echo $others; ?>
                                        </span>
                                      </li>
                
                                    </ul>
                                    <hr>
                                    <br><br>
                                  </div>
                                </div>



					</div>
					<div class="col-lg-7 m-b30">
								<div class="heading-bx left">
                                    <h2 class="m-b10 title-head">Household <span>Member</span></h2>
                                  </div>

											<?php
												$rows = $model->displayCensusHousehold($id);

												if (!empty($rows)) {
													foreach ($rows as $row) {
														$head_fname = $row['fname'];
                                                        $head_mname = $row['mname'];
                                                        $head_lname = $row['lname'];
                                                        $head_sname = $row['sname'];
                                                        $head_email = $row['email'];
                                                        $head_contact = $row['contact'];
                                                        $head_gender = $row['gender'];
                                                        $head_civil_status = $row['civil_status'];
                                                        $head_birthday = $row['birthday'];
                                                        
                                                        $head_employed = $row['employed'];
                                                        $head_self_employed = $row['self_employed'];
                                                        $head_informal = $row['informal'];
                                                        $head_solo_parent = $row['solo_parent'];
                                                        $head_pwd = $row['pwd'];
                                                        $head_relation = $row['head_relation'];

                                                        
                                						if ($head_employed == 1) { $head_employed = "Yes"; } else { $head_employed = "No"; }
                                                        if ($head_self_employed == 1) { $head_self_employed = "Yes"; } else { $head_self_employed = "No"; }
                                                        if ($head_informal == 1) { $head_informal = "Yes"; } else { $head_informal = "No"; }
                                                        if ($head_solo_parent == 1) { $head_solo_parent = "Yes"; } else { $head_solo_parent = "No"; }
                                                        if ($head_pwd == 1) { $head_pwd = "Yes"; } else { $head_pwd = "No"; }

											?>
								<div class="new-user-list">
                                  <h3><?php echo strtoupper($head_fname); ?> <?php echo strtoupper($head_mname); ?> <?php echo strtoupper($head_lname); ?> - <?php echo strtoupper($head_relation); ?><br></h3>
                                  <span style="font-size: 16px;"><?php echo $head_email; ?> | <?php echo $head_contact; ?></span>
                        		<hr>
                                  <div class="new-user-list">
                                    <ul>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Gender</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_gender; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Civil Status</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_civil_status; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Birthday</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_birthday; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Employed?</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_employed; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Self-employed in business?</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_self_employed; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Self-employed in informal sector?</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_informal; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">Solo parent?</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_solo_parent; ?>
                                        </span>
                                      </li>
                                      <li>
                                        <span class="new-users-text">
                                          <a href="#" class="new-users-name">PWD?</a>
                                        </span>
                                        <span class="new-users-btn">
                                          <?php echo $head_pwd; ?>
                                        </span>
                                      </li>
                
                                    </ul>
                                  </div>
                                </div>
                                <hr>

											<?php

													}
												}

											?>

								<br>
								<hr>


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