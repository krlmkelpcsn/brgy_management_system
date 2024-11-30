<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	ob_start(); 
	session_start();
	
	
	include('../global/model.php');
	$model = new Model();
	include('department.php');
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
				$secondnav = 'households';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #FCFCFC;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Household Management</h4>
				
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-12 m-b30">
 							
								<div style="padding: 25px;"></div>
                               
								
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th>Household ID</th>
												<th>Member(s)</th>
												<th>Voters</th>
												<th>Head</th>
												<th>Address</th>
												<th>Contact</th>
												<th>Purok</th>
												<th width="100">Action</th>
											</tr>
										</thead>
										<tbody>
                                        <?php 
                                        $result = my_query("SELECT household_id,COUNT(*)c FROM residents WHERE household_id<>'' GROUP BY household_id ");
										for ($i = 1; $row = $result->fetch(); $i++) {
                                          ?>
                                         <tr>
                                            <td><?= $hid=$row['household_id']; ?></td>
                                            <td><?= $row['c']; ?></td>
											<td><?= db_count('residents',['household_id'=>$hid,'resident_status'=>'Yes']); ?></td>
                                            <td>
                                                <?=db_get_result('residents',"CONCAT(fname, ' ' ,lname)",['family'=>'Yes','household_id'=>$hid]);?>
                                            </td>
                                         
                                            <td> <?=db_get_result('residents',"address",['family'=>'Yes','household_id'=>$hid]);?></td>
                                            <td> <?=db_get_result('residents',"contact_number",['family'=>'Yes','household_id'=>$hid]);?></td>
                                            <td> <?='' .db_get_result('residents',"address3",['family'=>'Yes','household_id'=>$hid]);?></td>
											<td>
                                                <a href="households.php?hid=<?=$hid;?>">View</a>
                                            </td>
                                            </tr>
                                            <?php }?>
 										
										
										</tbody>
									</table>

                                    <?php if(isset($_GET['hid'])){  ?>
										<h2>Household number <?=$_GET['hid'];?></h2>
                                        <div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
                                                <th>#</th>
											    <th>Brgy ID</th>
												<th>Name</th>
												<th>Gender</th>
												<th>Purok</th>
												<th>Civil Status</th>
											</tr>
										</thead>
										<tbody>
                                        <?php 
                                         $hid=$_GET['hid'];
                                         $result = my_query("SELECT *,CONCAT(fname, ' ',mname,' ' ,lname)name FROM residents WHERE household_id='$hid'");
                                    		for ($i = 1; $row = $result->fetch(); $i++) {
                                          ?>
											<tr>
                                                <td><?=$i;?></td>
											    <td><?php echo $row['id']; ?></td>
												<td><?php echo $row['name']; ?></td>
												<!--<td><?php echo $row['age']; ?></td>-->
												<td><?php echo $row['gender']; ?></td>
												<td><?php echo $row['address3']; ?></td>
												<!--<td><?php echo $row['contact_number']; ?></td>-->
												<td><?php echo $row['civil_status']; ?></td>
												</td>
                                            </tr>
											<?php }?>
										</tbody>

									</table>
 							
                                    
                                    
                                    <?php } ?>
								</div>
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