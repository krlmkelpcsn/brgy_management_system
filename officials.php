<?php
	include 'content/head.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="description" content="<?php echo $web_name; ?>" />
	<meta property="og:title" content="<?php echo $web_name; ?>" />
	<meta property="og:description" content="<?php echo $web_name; ?>" />
	<meta name="og:image" content="images/preview.png" align="middle"/>
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="assets/images/<?php echo $web_icon; ?>.png" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/<?php echo $web_icon; ?>.png" />
	<title><?php echo $web_name; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/css/assets.css">
	<link rel="stylesheet" type="text/css" href="assets/css/typography.css">
	<link rel="stylesheet" type="text/css" href="assets/css/shortcodes/shortcodes.css">	
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">	
</head>
<?php include 'assets/css/color/color-1.php';  ?>
<style type="text/css">
	ul {
  list-style-type: none; /* Remove bullets */
  padding: 0; /* Remove padding */
  margin: 0; /* Remove margins */
}
</style>
<body id="bg">
<div class="page-wraper">
	<?php include 'content/navigation.php'; ?>
    <div class="page-content bg-white">
        <div class="page-banner ovbl-dark" style="background-image:url(assets/images/cover.jpg);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Barangay Officials</h1>
				 </div>
            </div>
        </div>
		<div class="breadcrumb-row">
			<div class="container">
				<ul class="list-inline">
					<li><a href="index">Home</a></li>
					<li>Barangay Officials</li>
				</ul>
			</div>
		</div>
        <div class="content-block" >
			
                <div class="container" style="padding-top: 20px;">
                    <?php 

									$rows = $model->fetchPunongBrgy(1);
									if (!empty($rows)) {
										foreach ($rows as $row) {
											$brgy_head_id = $row['id'];
											$brgy_head = $row['name'];
											$brgy_head_pic = $row['image_unique'];
										}
									}
										
								?>
					 <div class="row">
						<div class="col-lg-3 col-md-4 col-sm-12 m-b30">
							<div class="profile-bx text-center"style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
								<div class="user-thumb">
									<img src="assets/images/org-structure/<?php echo $brgy_head_pic; ?>.jpg" style="width: 250px; height: 280px;">	
								</div>
								<div class="profile-info">
									<h4><?php echo $brgy_head; ?></h4>
									<span>Punong Barangay</span>
								</div>
							</div>
						</div>
						<div class="col-lg-9 col-md-8 col-sm-12 m-b30">
							<div class="profile-content-bx">
								<div class="tab-content">
									<div class="tab-pane active" id="courses">
										<div class="profile-head">
											<h3><span style="color: <?php echo $primary_color; ?>">Barangay</span> Profile</h3>
											<div class="feature-filters style1 ml-auto">
												<ul class="filters" data-toggle="buttons">
													<li data-filter="" class="btn active">
														<input type="radio">
														<a href="#"><span>All</span></a> 
													</li>
													<li data-filter="1" class="btn">
														<input type="radio">
														<a href="#"><span>Treasurer</span></a> 
													</li>
													<li data-filter="2" class="btn">
														<input type="radio">
														<a href="#"><span>Secretary</span></a> 
													</li>
													<li data-filter="3" class="btn">
														<input type="radio">
														<a href="#"><span>Kagawad</span></a> 
													</li>
													<li data-filter="4" class="btn">
														<input type="radio">
														<a href="#"><span>SK Chairperson</span></a> 
													</li>
												</ul>
											</div>
										</div>
										<div class="courses-filter">
											<div class="clearfix">
												<ul id="masonry" class="ttr-gallery-listing magnific-image row">
													<?php
													$rows = $model->fetchOrgStructure(1);

														if (!empty($rows)) {
														foreach ($rows as $row) {

														if ($row['position'] == 1) {
															$position = "Barangay Treasurer";
														}
														else if ($row['position'] == 2) {
															$position = "Barangay Secretary";
														}
														else if ($row['position'] == 3) {
															$position = "Barangay Kagawad";
														}
														else if ($row['position'] == 4) {
															$position = "SK Chairperson";
														}
														else {
															$position = "Barangay Captain";
														}
													?>
													<li class="action-card col-xl-4 col-lg-6 col-md-12 col-sm-6 <?php echo $row['position']; ?>">
														<div class="cours-bx">
															<div class="action-box">
																<img src="assets/images/org-structure/<?php echo $row['image_unique']; ?>.jpg" style="width: 250px; height: 260px;">	
															</div>
															<div class="info-bx text-center" style="height: 130px;">
																<h5><a href="#"><?php echo $row['name']; ?></a></h5>
																<span><b><?php echo $position; ?></b></span><br><span><?php echo $row['rendered_service']; ?></span>
															</div>
														</div>
													</li>
													<?php
														}
													}
													?>
												</ul>
											</div>
										</div>
									</div> 
								</div>
							</div>
						</div>
				</div>
            
        <?php include 'content/footer.php' ?>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="assets/vendors/magnific-popup/magnific-popup.js"></script>
<script src="assets/vendors/counter/waypoints-min.js"></script>
<script src="assets/vendors/counter/counterup.min.js"></script>
<script src="assets/vendors/imagesloaded/imagesloaded.js"></script>
<script src="assets/vendors/masonry/masonry.js"></script>
<script src="assets/vendors/masonry/filter.js"></script>
<script src="assets/vendors/owl-carousel/owl.carousel.js"></script>
<script src="assets/js/functions.js"></script>
<script src="assets/js/contact.js"></script>
<script src='assets/vendors/switcher/switcher.js'></script>
</body>
</html>
