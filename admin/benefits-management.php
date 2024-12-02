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

		<title>Benefits Management</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/vendors/calendar/fullcalendar.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/typography.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/shortcodes/shortcodes.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dashboard.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

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
				
				$page = 'benefits';
				$secondnav = 'benefits';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #FCFCFC;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Benefits Management</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-agenda"></i>Bene</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-12 m-b30">

								
								<div align="right">
								    <a href="" class="btn green radius-xl" style="background-color: <?php echo $primary_color; ?>;" data-toggle="modal" data-target="#add-benefits"><i class="ti-agenda"></i><span>&nbsp;ADD NEW BENEFITS</span></a>&nbsp;
								    
									<a href="archived-benefits" class="btn red radius-xl"><i class="ti-archive"></i><span>&nbsp;ARCHIVED</span></a>
								</div>
								<div style="padding: 25px;"></div>
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Type</th>
												<th>Description</th>
												<th>Eligibility</th>
												<th>Start Date</th>
												<th>End Date</th>
												<th>Status</th>
												<th width="100">Action</th>
												<!-- <th width="50">Narrative</th></th> -->
											</tr>
										</thead>
										<tbody>




										<?php
												$benefit_status = 1;
												$rows = $model->getAllBenefits($benefit_status);

												if (!empty($rows)) {
													foreach ($rows as $row) {
														$id = $row['id'];
														$benefit_name = $row['benefit_name'];
														$description = $row['description'];
														$type = $row['type'];
														$eligibility_criteria = $row['eligibility_criteria'];
														$start_date = $row['start_date'];
														$end_date = $row['end_date'];
													
														
														$benefit_status = !empty($row['benefit_status']) ? $row['benefit_status'] : "Not Started";
														// Determine the class based on the benefit status
														$benefit_status2 = "";
														if ($benefit_status == "Not Started") {
																$benefit_status2 = "danger";  // Red badge for "Not Started"
														} elseif ($benefit_status == "In Progress") {
																$benefit_status2 = "info";    // Blue badge for "In Progress"
														} elseif ($benefit_status == "Completed") {
																$benefit_status2 = "success"; // Green badge for "Completed"
														}
											?>
									
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo htmlspecialchars($benefit_name);?></td>
            <td><?php echo htmlspecialchars($type); ?></td>
						<td style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;" title="<?php echo htmlspecialchars($description); ?>"><?php echo htmlspecialchars($description); ?></td>
						<td style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;" title="<?php echo htmlspecialchars($eligibility_criteria); ?>"><?php echo htmlspecialchars($eligibility_criteria); ?></td>
            <td style="font-size: 14px;"><?php echo date('M. d, Y / h:i A ', strtotime($start_date)); ?></td>
            <td style="font-size: 14px;"><?php echo date('M. d, Y / h:i A ', strtotime($end_date)); ?></td>
						<td>
											<center>
												<span class="badge badge-<?php echo $benefit_status2; ?>"><a href="" style="font-size: 14px;color: white;" data-toggle="modal" data-target="#status-<?php echo $row['id']; ?>"><?php echo $benefit_status; ?></a></span>
											
											</center> 
										</td>
										
            <td>
                <center>
                    <a data-toggle="modal" data-target="#edit-<?php echo $id; ?>" class="btn blue" style="width: 45px; height: 37px;">
                        <div data-toggle="tooltip" title="Edit">
                            <i class="ti-pencil" style="font-size: 15px; margin-left:-4px;"></i>
                        </div>
                    </a>
										
										<a href="" class="btn red" style="width: 45px; height: 37px;" data-toggle="modal" data-target="#decline-<?php echo htmlspecialchars($row['id'] ?? ''); ?>">
											<div data-toggle="tooltip" title="Archive">
												<i class="ti-archive" style="font-size: 15px; margin-left:-5px;"></i>
											</div>
										</a>
                </center>
            </td>
            <td>
                <form method="POST">
                    <input type="hidden" name="benefit_name" value="<?php echo htmlspecialchars($benefit_name); ?>">
                    <input type="hidden" name="description" value="<?php echo htmlspecialchars($description); ?>">
										<input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
                    <input type="hidden" name="eligibility_criteria" value="<?php echo htmlspecialchars($eligibility_criteria); ?>">
                    <input type="hidden" name="start_date" value="<?php echo htmlspecialchars(date('M. d, Y', strtotime($start_date))); ?>">
                    <input type="hidden" name="end_date" value="<?php echo htmlspecialchars(date('M. d, Y', strtotime($end_date))); ?>">
                    <!-- <button type="submit" name="print" class="btn btn-block green radius-xl" style="float: right;">PRINT</button> -->
                </form>
            </td>
        </tr>


		

<!-- Archive Modal -->
<!-- <div id="decline-<?php echo htmlspecialchars($row['id'] ?? ''); ?>" class="modal fade" role="dialog">
    <form class="edit-profile m-b30" method="POST">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <img src="../assets/images/<?php echo htmlspecialchars($web_icon); ?>.png" style="width: 30px; height: 30px;">
                        &nbsp;Archive Benefits Record
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="decline_hidden" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="col-form-label">Benefit ID</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['id']); ?>" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label class="col-form-label">Benefit Name</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['benefit_name']); ?>" readonly>
                        </div>
                        <div class="form-group col-12">
                            <label class="col-form-label">Description</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['description']); ?>" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label class="col-form-label">Benefit Type</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['type']); ?>" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label class="col-form-label">Eligibility</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['eligibility_criteria']); ?>" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label class="col-form-label">Start Date</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['start_date']); ?>" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label class="col-form-label">End Date</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['end_date']); ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn red radius-xl outline" name="archive" onclick="return confirm('Are you sure you want to archive this information?')">Archive Benefits</button>
                    <button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
 -->


	<!-- Archive Modal -->
<div id="decline-<?php echo htmlspecialchars($row['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="modal fade" role="dialog">
    <form class="edit-profile m-b30" method="POST" action="benefits-management">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <img src="../assets/images/<?php echo htmlspecialchars($web_icon, ENT_QUOTES, 'UTF-8'); ?>.png" style="width: 30px; height: 30px;">
                        &nbsp;Archive Benefits Record
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
								<input type="hidden" name="decline_hidden" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <div class="row">
          
                        <div class="form-group col-6">
                            <label class="col-form-label">Benefit ID</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>
            
                        <div class="form-group col-6">
                            <label class="col-form-label">Benefit Name</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['benefit_name'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>
  											<div class="form-group col-6">
                            <label class="col-form-label">Benefit Type</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['type'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label class="col-form-label">Description</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label class="col-form-label">Eligibility</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['eligibility_criteria'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>

                        <div class="form-group col-6">
                            <label class="col-form-label">Start Date</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['start_date'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>

                        <div class="form-group col-6">
                            <label class="col-form-label">End Date</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['end_date'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn red radius-xl outline" name="archive" onclick="return confirm('Are you sure you want to archive this benefit? ')">Archive Benefits</button>
                    <button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>



<!-- Edit Data - Modal -->
<div id="edit-<?php echo htmlspecialchars($row['id'] ?? ''); ?>" class="modal fade" role="dialog">
    <form class="edit-profile m-b30" method="POST">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <img src="../assets/images/<?php echo htmlspecialchars($web_icon); ?>.png" style="width: 30px; height: 30px;">
                        &nbsp;Edit Benefits
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="edit-id" value="<?php echo htmlspecialchars($row['id']); ?>" required>

                        <div class="form-group col-6">
                            <label class="col-form-label">Benefit Name</label>
                            <input class="form-control" type="text" name="benefit_name" value="<?php echo htmlspecialchars($row['benefit_name']); ?>" required>
                        </div>

                        <div class="form-group col-6">
                            <label class="col-form-label">Benefit Type</label>
                            <input class="form-control" type="text" name="type" value="<?php echo htmlspecialchars($row['type']); ?>" required>
                        </div>

                        <div class="form-group col-6">
                            <label class="col-form-label">Description</label>
                            <textarea class="form-control" name="description" required><?php echo htmlspecialchars($row['description']); ?></textarea>
                        </div>

                        <div class="form-group col-6">
                            <label class="col-form-label">Eligibility</label>
                            <textarea class="form-control" name="eligibility_criteria" required><?php echo htmlspecialchars($row['eligibility_criteria']); ?></textarea>
                        </div>

                        <div class="form-group col-6">
                            <label class="col-form-label">Start Date & Time</label>
                            <input class="form-control" type="datetime-local" name="start_date"
                                value="<?php echo date('Y-m-d\TH:i', strtotime($row['start_date'])); ?>" required>
                        </div>

                        <div class="form-group col-6">
                            <label class="col-form-label">End Date & Time</label>
                            <input class="form-control" type="datetime-local" name="end_date"
                                value="<?php echo date('Y-m-d\TH:i', strtotime($row['end_date'])); ?>" required>
                        </div>
												<!-- <div class="form-group col-12">
																<label class="col-form-label">Status</label>
																<select class="form-control" name="benefit_status">
																	<option value="Active"<?php if ($benefit_status == "Active") { echo "selected"; } else {} ?>>Active</option>
																	<option value="Settled"<?php if ($benefit_status == "Settled") { echo "selected"; } else {} ?>>Settled</option>
																</select>
															</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn green radius-xl outline" name="edit">Update Benefits</button>
                    <button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- status modal -->
<div id="status-<?php echo htmlspecialchars($row['id'] ?? ''); ?>" class="modal fade" role="dialog">
    <form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <img src="../assets/images/<?php echo htmlspecialchars($web_icon ?? 'default-icon'); ?>.png" style="width: 30px; height: 30px;">&nbsp;Update Blotter Status
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input class="form-control" type="hidden" name="update_id" value="<?php echo htmlspecialchars($row['id'] ?? ''); ?>">
                        <div class="form-group col-12">
                            <label class="col-form-label">Status</label>
																<select class="form-control" name="benefit_status" id="benefit-status-dropdown">
				<option value="Not Started" <?php echo ($row['benefit_status'] ?? '') == 'Not Started' ? 'selected' : ''; ?>>Not Started</option>
				<option value="In Progress" <?php echo ($row['benefit_status'] ?? '') == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
				<option value="Completed" <?php echo ($row['benefit_status'] ?? '') == 'Completed' ? 'selected' : ''; ?>>Completed</option>
		</select>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn green radius-xl outline" name="status" value="Update Status">
                    <button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>





									<?php 
if (isset($_POST['status'])) {
    // Ensure both status and id are set before updating
    if (isset($_POST['benefit_status']) && isset($_POST['update_id'])) {
        $status = $_POST['benefit_status'];
        $id = $_POST['update_id'];
        
        // Call the function to update the benefit status
        $model->changeBenefitStatus2($status, $id);
        
        // Redirect after updating
				echo "<script>alert('Status updated successfully.');window.open('benefits-management', '_self');</script>";;
    } else {
        // Handle the error (if necessary)
        echo "<script>alert('Error: Missing status or id');</script>";
    }
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit'])) {
        $edit_id = $_POST['edit-id'];
        $benefit_name = $_POST['benefit_name'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $eligibility_criteria = $_POST['eligibility_criteria'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        if ($model->editBenefits($benefit_name, $description, $type, $eligibility_criteria, $start_date, $end_date, $edit_id)) {
            echo "<script>alert('Benefits updated successfully!'); window.open('benefits-management', '_self');</script>";
        } else {
            echo "<script>alert('Failed to update benefits.'); window.history.back();</script>";
        }
    }

		
		// if (isset($_POST['archive'])) {
		// 	$decline_hidden = $_POST['decline_hidden'];
		// 	$model->archiveBenefit(2, $decline_hidden);
		// 	echo "<script>window.open('benefits-management', '_self');</script>";
		// } else {
		// 			echo "<script>alert('Failed to archive benefit.'); window.history.back();</script>";
		// 	}
    // }

		if (isset($_POST['archive'])) {
			$decline_hidden = $_POST['decline_hidden'];
	
			if (!empty($decline_hidden)) {
					$result = $model->archiveBenefit(2, $decline_hidden);
	
					if ($result) {
							header("Location: benefits-management");
							exit();
					} else {
							echo "<script>alert('Failed to archive the benefit. Please try again later.'); window.history.back();</script>";
					}
			} else {
					echo "<script>alert('Invalid request.'); window.history.back();</script>";
			}
	}
	
}}}
?>
</tbody>
</table>
							<!-- Add Data - Modal -->
							<div id="add-benefits" class="modal fade" role="dialog">
									<form class="edit-profile m-b30" method="POST">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Add Benefits</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-12">
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Benefit Name</b></label>
															<input class="form-control" type="text" name="benefit_name" required>
														</div>

														<div class="form-group col-6">
															<label class="col-form-label"><b>Benefit Type</b></label>
															<input class="form-control" type="text" name="type" required>
														</div>

														<div class="form-group col-6">
															<label class="col-form-label"><b>Description</b></label>
															<textarea class="form-control h-0" type="text" name="description" required></textarea>
														</div>
											
														<div class="form-group col-6">
															<label class="col-form-label"><b>Eligibility</b></label>
															<textarea class="form-control" type="text" name="eligibility_criteria" required></textarea>
														</div>
													
														<div class="form-group col-6">
															<label class="col-form-label"><b>Start Date & Time</b></label>
															<input class="form-control" type="datetime-local" name="start_date" required>
														</div>
												
														
														<div class="form-group col-6">
															<label class="col-form-label"><b>End Date & Time</b></label>
															<input class="form-control" type="datetime-local" name="end_date" required>
														</div>
													
													</div>
												</div>
												<div class="modal-footer">
													<input type="submit" class="btn green radius-xl outline" name="add-confirm" value="Add Record">
													<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</form>
								</div>
		

									<?php

											if (isset($_POST['add-confirm'])) {
												$model->addBenefits( $_POST['benefit_name'], $_POST['description'], $_POST['type'], $_POST['eligibility_criteria'], $_POST['start_date'], $_POST['end_date']);
																						
													$benefit_name = strtoupper($_POST['benefit_name']);
													$description = strtoupper($_POST['description']);
													$type = strtoupper($_POST['type']);
													$eligibility_criteria = strtoupper($_POST['eligibility_criteria']);
													$start_date = date('M. d, Y', strtotime($_POST['start_date']));
													$end_date = date('M. d, Y', strtotime($_POST['end_date']));

													echo "<script>alert('Benefits has been added.');window.open('benefits-management', '_self');</script>";
												}
												
										?>

					</div>
				</div>
			</div>
		</main>
		<div class="ttr-overlay"></div>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

			document.getElementById("show-dropdown-btn").addEventListener("click", function() {
        // Get the dropdown element by its ID
        var dropdown = document.getElementById("benefit-status-dropdown");
        
        // If the dropdown is hidden, show it
        if (dropdown.style.display === "none" || dropdown.style.display === "") {
            dropdown.style.display = "block"; // Show dropdown
        } else {
            dropdown.style.display = "none"; // Hide dropdown (if you want to toggle visibility)
        }
    });
		</script>
	</body>

</html>