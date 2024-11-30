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
	.responsive-iframe {
	  position: absolute;
	  top: 0;
	  left: 0;
	  bottom: 0;
	  right: 0;
	  width: 100%;
	  height: 100%;
	  border: none;
	}
	.container2 {
	  position: relative;
	  width: 100%;
	  overflow: hidden;
	  padding-top: 56.25%; /* 16:9 Aspect Ratio */
	}
</style>
<body id="bg">
<div class="page-wraper">
	<?php include 'content/navigation.php'; ?>
    <div class="page-content bg-white">
        <div class="page-banner ovbl-dark" style="background-image:url(assets/images/cover.jpg);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Contact Us</h1>
				 </div>
            </div>
        </div>
		<div class="breadcrumb-row">
			<div class="container">
				<ul class="list-inline">
					<li><a href="index">Home</a></li>
					<li>Contact Us</li>
				</ul>
			</div>
		</div>
		<div class="content-block">
			<div class="content-block">
            <div class="section-area section-sp1">
                <div class="container">
					<div class="row">
						<div class="col-lg-7 col-md-12">
							<div class="heading-bx left">
								<h2 class="m-b10 title-head">Contact <span> Us</span></h2>
							</div>
								<a href="<?php echo $fb_link; ?>" style="font-size: 20px; color: black;"><i class="fa fa-facebook" style="font-size: 25px;"></i> Victoria Reyes Page</a><br>
								<?php

									$contacts = $model->fetchContactNumbers();

									if (!empty($contacts)) {

								?>
								<a style="font-size: 20px; color: black;"><i class="fa fa-phone" style="font-size: 25px;"></i>
								<?php

										foreach ($contacts as $key => $contact) {
											reset($contacts);
                                            if ($key === key($contacts)) {
        										echo ' '.$contact['contact_num'].'<br>';
    										}

    										else {
    											echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$contact['contact_num'].'<br>';
    										}
										}

									}

								?>
								</a>
								<br>
							<div class="container2">
								<iframe src="<?php echo $iframe; ?>" class="responsive-iframe" loading="lazy"></iframe>
							</div>
						</div>
						<div class="col-lg-5 col-md-12">
							<form action="contact#sent" class="contact-bx dzForm" method="post" >
							<div class="dzFormMsg"></div>
								<div class="heading-bx left">
									<h2 class="title-head">Inquiries <span></span></h2>
								</div>
								<div class="row placeani" id="sent">
									<h3><center>We've received your message inquiry. Please wait for our response as soon as we see your message. Thank you!<br><br><img src="assets/images/<?php echo $web_icon; ?>.png"></center>


									</h3>
								</div>
							</form>
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
