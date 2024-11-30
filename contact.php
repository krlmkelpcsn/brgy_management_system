<?php

use PHPMailer\PHPMailer\PHPMailer;
	
include 'content/head.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<!-- META ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="description" content="<?php echo $web_name; ?>" />
	
	<!-- OG -->
	<meta property="og:title" content="<?php echo $web_name; ?>" />
	<meta property="og:description" content="<?php echo $web_name; ?>" />
	<meta name="og:image" content="images/preview.png" align="middle"/>
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="assets/images/<?php echo $web_icon; ?>.png" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="assets/images/<?php echo $web_icon; ?>.png" />
		<title><?php echo $web_name; ?></title>
	
	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	
	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/assets.css">
	
	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/typography.css">
	
	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/shortcodes/shortcodes.css">
	
	<!-- STYLESHEETS ============================================= -->
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

    <!-- Inner Content Box ==== -->
    <div class="page-content bg-white">
        <!-- Page Heading Box ==== -->
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
		<!-- Page Heading Box END ==== -->
        <!-- Page Content Box ==== -->
		<div class="content-block">


			<div class="content-block">
            <!-- Your Faq -->
            <div class="section-area section-sp1">
                <div class="container">
					<div class="row">
						<div class="col-lg-7 col-md-12">
							<div class="container2">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8023038.333451463!2d118.28990245795394!3d10.92561439900852!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32fc19fcb3100001%3A0x390ee23160ab4296!2sBarangay%20Hall%20of%20Brgy.%20Poblacion!5e0!3m2!1sen!2sph!4v1731454650715!5m2!1sen!2sph" class="responsive-iframe" loading="lazy"></iframe>
							</div>
						</div>
						<div class="col-lg-5 col-md-12">
							<form action="contact#sent" class="contact-bx dzForm" method="post" >
							<div class="dzFormMsg"></div>
								<div class="heading-bx left">
									<h2 class="title-head">Inquiries <span></span></h2>
									<p>Send a message to us!</p>
								</div>
								<div class="row placeani" id="sent">
								    <!-- <div class="col-lg-12">
										<div class="form-group">
											<div class="input-group">
												<center><h3>If you have any concerns you may contact us <a href="https://mail.google.com/" target="_blank" style="color: #9EC80D;">dc.dentalcare@gmail.com</a></h3>
												<hr>
												<a href="https://www.facebook.com/guibandentalclinic" style="font-size: 20px; color: black;"><i class="fa fa-facebook" style="font-size: 25px;"></i> DC Dental Care</a><br>
								                <a href="https://www.facebook.com/guibandentalclinic" style="font-size: 20px; color: black;"><i class="fa fa-phone" style="font-size: 25px;"></i> 0945 124 5233<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(02) 8267 7935</a><br><br>
												
												</center>
											</div>
										</div>
									</div> -->
									<div class="col-lg-6 ">
										<div class="form-group">
											<div class="input-group">
												<label>Your Name</label>
												<input name="user_id" type="hidden" >
												<input name="name" type="text" required class="form-control" minlength="3" maxlength="25">
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<div class="input-group"> 
												<label>Your Email Address</label>
												<input name="email" type="email" class="form-control" required minlength="5" maxlength="35">
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<div class="input-group">
												<label>Subject</label>
												<input name="subject" type="text" required class="form-control" minlength="3" maxlength="25">
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<div class="input-group">
												<label>Type Message</label>
												<textarea name="message" rows="4" class="form-control" required minlength="5" maxlength="300" ></textarea>
											</div>
										</div>
									</div>
									<div class="col-lg-12" align="center">
										<button name="post_msg" type="submit" value="Submit" class="btn button-md button-block">Send Message</button>
									</div>
									<div class="col-lg-12" align="center">
									<br>
									<label style="color: green;font-weight: 540;">
									<?php
									if(isset($_POST['post_msg'])){
                                        
		                                $user_id = $_POST['user_id'];
		                                $name = $_POST['name'];
		                                $email = $_POST['email'];
		                                $subject = $_POST['subject'];
		                                $message = $_POST['message'];
		                                $date = date("Y-m-d H:i:s");

		                                $model = new Model();
		                               	$new = $model->post_message($user_id , $name, $email, $subject, $message, $date);

		                                if ($new) {
		                                    echo "MESSAGE SENT!";
		                                }                       
		                            }
									?>
									</label>
									</div>
								</div>
							</form>
						</div>
					</div>
					
                </div>
            </div>
            <br><br><br>
            <!-- Your Faq End -->

            <?php include 'content/footer.php' ?>

</div>
<!-- External JavaScripts -->
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
