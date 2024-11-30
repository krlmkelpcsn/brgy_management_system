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

	if(isset($_GET["a"])) { 
        $a=$_GET["a"];
        $eid=$_GET['id'];
        db_insert('event_attendees',['ann_id'=>$eid,"resident_id"=>$_SESSION['sess2'] ,'status'=>$a]);

		if($a == 'Yes'){
			my_query("UPDATE announcements SET total_joined = total_joined + 1 WHERE id = $eid");
		}
         
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
				
				$page = 'events';
				$secondnav = '';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Events</h4>
					<ul class="db-breadcrumb-list">
 						<li><i class="ti-agenda"></i>List</li>
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
 			
					<div class="col-lg-12 m-b30">
					
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
												<th width="100">Joined?</th>
											</tr>
										</thead>
										<tbody>
											<?php

												$rows = $model->displayAnnouncements(0, 1);

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
													<?php 
														$re = my_query("SELECT * FROM event_attendees WHERE resident_id = ".$_SESSION['sess2']." AND ann_id = ".$row['id']);
														$re->execute();
														if ($r = $re->fetch()) {
															echo $r['status'];
															?>
 														
<?php }else { ?>  
	<center>
														<!-- <a href="" class="btn blue" style="width: 50px; height: 37px;" data-toggle="tooltip" title="Edit"><i class="ti-marker-alt" style="font-size: 12px;"></i></a> -->
 														<a href="events.php?a=Yes&id=<?php echo $row['id']; ?>" class="btn blue" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="Yes">
																<i class="ti-thumb-up" style="font-size: 12px;"></i>
															</div>
														</a>&nbsp;
                                                        <a href="events.php?a=No&id=<?php echo $row['id']; ?>" class="btn blue" style="width: 50px; height: 37px;">
															<div data-toggle="tooltip" title="No">
																<i class="ti-thumb-down" ></i>
															</div>
														</a>&nbsp;
													</center>
	<?php  }?>
	
												
												</td>
											</tr>
                        
                         
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