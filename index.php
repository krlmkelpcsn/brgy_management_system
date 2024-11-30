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
	<meta name="theme-color" content="#810725" />
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
	<link rel="stylesheet" type="text/css" href="assets/vendors/revolution/css/layers.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/revolution/css/settings.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/revolution/css/navigation.css">	
</head>
<?php include 'assets/css/color/color-1.php';  ?>
<body id="bg" oncontextmenu="return true;">
<div class="page-wraper">
<style type="text/css">
	#loading-icon-bx {
		background-size: 150px!important;
	}
	.menu-links .nav > li:hover > a:after {
			display: none!important;
		}
</style>
<!--<div id="loading-icon-bx"></div>-->
    <header class="header rs-nav header-transparent">
		<div class="sticky-header navbar-expand-lg">
            <div class="menu-bar clearfix">
                <div class="container clearfix">
					<div class="menu-logo">
						<a href="index"><img src="assets/images/logo-white.png" alt=""></a>
					</div>
                    <button class="navbar-toggler collapsed menuicon justify-content-end" type="button" data-toggle="collapse" data-target="#menuDropdown" aria-controls="menuDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>
                    <div class="secondary-menu">
                        <div class="secondary-inner">
                            <?php 
                            if (empty($_SESSION['sess2'])) {
                            ?>
                            <a href="residents.php" style="color: white;">LOGIN</a>
                            <?php 
                            }
                            else {
                            ?>
                            <a href="residents.php" style="color: white;"><img src="assets/images/profile-pictures/<?php echo $prof_pic; ?>" style="width: 23px; height: 23px; border-radius: 50%;object-fit: cover;" alt="User">
                            <?php echo $r_fname; ?></a>
                            <?php 
                            }
                            ?>
                            
						</div>
                    </div>
                    <style type="text/css">
                    	.noHover{
    pointer-events: none;
}
                    </style>
                    <div class="menu-links navbar-collapse collapse justify-content-start" id="menuDropdown">
						<div class="menu-logo">
							<img src="assets/images/logo.png" alt="">
						</div>
                        <ul class="nav navbar-nav">	
							<li><a href="index">Home</a></li>
							<li><a href="all-announcements">Announcements</a></li>
							<li><a href="officials">Officials</a></li>
							<li><a href="services">Issuance</a></li>
							<li><a href="contact">Contact</a></li>
							<li><a href="about-us">About Us</a></li>
							<li><a href="calendar">Calendar</a></li>
						</ul>
						<div class="nav-social-link">
							
						</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="page-content bg-white">
        <div class="rev-slider">
			<div id="rev_slider_486_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="news-gallery36" data-source="gallery" style="margin:0px auto;background-color:#ffffff;padding:0px;margin-top:0px;margin-bottom:0px;">
				<div id="rev_slider_486_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.3.0.2">
					<ul>	<!-- SLIDE  -->
						<li data-index="rs-100" 
						data-transition="parallaxvertical" 
						data-slotamount="default" 
						data-hideafterloop="0" 
						data-hideslideonmobile="off" 
						data-easein="default" 
						data-easeout="default" 
						data-masterspeed="default" 
						data-thumb="error-404.html" 
						data-rotate="0" 
						data-fstransition="fade" 
						data-fsmasterspeed="1500" 
						data-fsslotamount="7" 
						data-saveperformance="off" 
						data-title="A STUDY ON HAPPINESS" 
						data-param1="" data-param2="" 
						data-param3="" data-param4="" 
						data-param5="" data-param6="" 
						data-param7="" data-param8="" 
						data-param9="" data-param10="" 
						data-description="Science says that Women are generally happier">
							<!-- MAIN IMAGE -->
							<img src="assets/images/slider/<?php echo $img1; ?>.jpg" alt="" 
								data-bgposition="center center" 
								data-bgfit="cover" 
								data-bgrepeat="no-repeat" 
								data-bgparallax="10" 
								class="rev-slidebg" 
								data-no-retina />
								
							<!-- LAYER NR. 1 -->
							<div class="tp-caption tp-shape tp-shapewrapper " 
								id="slide-100-layer-1" 
								data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
								data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
								data-width="full"
								data-height="full"
								data-whitespace="nowrap"
								data-type="shape" 
								data-basealign="slide" 
								data-responsive_offset="off" 
								data-responsive="off"
								data-frames='[{"from":"opacity:0;","speed":1,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"delay":"wait","speed":1,"to":"opacity:0;","ease":"Power4.easeOut"}]'
								data-textAlign="['left','left','left','left']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[0,0,0,0]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 5;background-color:rgba(2, 0, 11, 0.80);border-color:rgba(0, 0, 0, 0);border-width:0px;"> </div>	
							<!-- LAYER NR. 2 -->
							<div class="mainText tp-caption Newspaper-Title   tp-resizeme" 
								id="slide-100-layer-2" 
								data-x="['center','center','center','center']" 
								data-hoffset="['0','0','0','0']" 
								data-y="['top','top','top','top']" 
								data-voffset="['250','250','250','240']" 
								data-fontsize="['50','50','50','30']"
								data-lineheight="['55','55','55','35']"
								data-width="full"
								data-height="none"
								data-whitespace="normal"
								data-type="text" 
								data-responsive_offset="on" 
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
								data-textAlign="['center','center','center','center']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[10,10,10,10]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 6; font-family:rubik; font-weight:700; text-align:center; white-space: normal;">
									BRGY. <span style="color: <?php echo $primary_color; ?>">POBLACION</span>
							</div>

							<!-- LAYER NR. 3 -->
							<div class="tp-caption Newspaper-Subtitle   tp-resizeme" 
								id="slide-100-layer-3" 
								data-x="['center','center','center','center']" 
								data-hoffset="['0','0','0','0']" 
								data-y="['top','top','top','top']" 
								data-voffset="['210','210','210','210']" 
								data-width="none"
								data-height="none"
								data-whitespace="nowrap"
								data-type="text" 
								data-responsive_offset="on"
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
								data-textAlign="['left','left','left','left']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[0,0,0,0]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 7; white-space: nowrap; color:#fff; font-family:rubik; font-size:18px; font-weight:400;">
									WELCOME TO
							</div>
							
							<!-- LAYER NR. 3 -->
							<div class="tp-caption Newspaper-Subtitle   tp-resizeme" 
								id="slide-100-layer-4" 
								data-x="['center','center','center','center']" 
								data-hoffset="['0','0','0','0']" 
								data-y="['top','top','top','top']" 
								data-voffset="['320','320','320','290']" 
								data-width="['800','800','700','420']"
								data-height="['100','100','100','120']"
								data-whitespace="unset"
								data-type="text" 
								data-responsive_offset="on"
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
								data-textAlign="['center','center','center','center']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[0,0,0,0]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 7; text-transform:capitalize; white-space: unset; color:#fff; font-family:rubik; font-size:18px; line-height:28px; font-weight:400;">
									 COMPOSTELA, DAVAO DE ORO
							</div>
							<!-- LAYER NR. 4 -->
							<a href="residents.php"><div class="tp-caption Newspaper-Button rev-btn " 
								id="slide-200-layer-5" 
								data-x="['center','center','center','center']" 
								data-hoffset="['90','80','75','90']" 
								data-y="['top','top','top','top']" 
								data-voffset="['400','400','400','420']" 
								data-width="none"
								data-height="none"
								data-whitespace="nowrap"
								data-type="button" 
								data-responsive_offset="on" 
								data-responsive="off"
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"300","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0, 0, 0, 1.00);bg:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);bw:1px 1px 1px 1px;"}]'
								data-textAlign="['center','center','center','center']"
								data-paddingtop="[12,12,12,12]"
								data-paddingright="[30,35,35,15]"
								data-paddingbottom="[12,12,12,12]"
								data-paddingleft="[30,35,35,15]"
								style="z-index: 8; white-space: nowrap; outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer; background-color:var(--primary) !important; border:0; border-radius:30px; margin-right:5px;"><?php 
                            if (empty($_SESSION['sess2'])) {
                            ?>
                            LOGIN NOW
                            <?php 
                            }
                            else {
                            ?>
                            <?php echo strtoupper($r_fname); ?>
                            <?php 
                            }
                            ?></div></a>
							<a class="tp-caption Newspaper-Button rev-btn" 
								id="slide-100-layer-6" 
								data-x="['center','center','center','center']" 
								data-hoffset="['-90','-80','-75','-90']" 
								data-y="['top','top','top','top']" 
								data-voffset="['400','400','400','420']" 
								data-width="none"
								data-height="none"
								data-whitespace="nowrap"
								data-type="button" 
								data-responsive_offset="on" 
								data-responsive="off"
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"300","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0, 0, 0, 1.00);bg:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);bw:1px 1px 1px 1px;"}]'
								data-textAlign="['center','center','center','center']"
								data-paddingtop="[12,12,12,12]"
								data-paddingright="[30,35,35,15]"
								data-paddingbottom="[12,12,12,12]"
								data-paddingleft="[30,35,35,15]"
								style="z-index: 8; white-space: nowrap; outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer; border-radius:30px;" href="contact">CONTACT US</a>
						</li>
						<li data-index="rs-200" 
						data-transition="parallaxvertical" 
						data-slotamount="default" 
						data-hideafterloop="0" 
						data-hideslideonmobile="off" 
						data-easein="default" 
						data-easeout="default" 
						data-masterspeed="default" 
						data-thumb="assets/images/slider/<?php echo $img1; ?>.jpg" 
						data-rotate="0" 
						data-fstransition="fade" 
						data-fsmasterspeed="1500" 
						data-fsslotamount="7" 
						data-saveperformance="off" 
						data-title="A STUDY ON HAPPINESS" 
						data-param1="" data-param2="" 
						data-param3="" data-param4="" 
						data-param5="" data-param6="" 
						data-param7="" data-param8="" 
						data-param9="" data-param10="" 
						data-description="Science says that Women are generally happier">
							<!-- MAIN IMAGE -->
							<img src="assets/images/slider/<?php echo $img2; ?>.jpg" alt="" 
								data-bgposition="center center" 
								data-bgfit="cover" 
								data-bgrepeat="no-repeat" 
								data-bgparallax="10" 
								class="rev-slidebg" 
								data-no-retina />
								
							<!-- LAYER NR. 1 -->
							<div class="tp-caption tp-shape tp-shapewrapper " 
								id="slide-200-layer-1" 
								data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
								data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
								data-width="full"
								data-height="full"
								data-whitespace="nowrap"
								data-type="shape" 
								data-basealign="slide" 
								data-responsive_offset="off" 
								data-responsive="off"
								data-frames='[{"from":"opacity:0;","speed":1,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"opacity:1;","ease":"Power4.easeOut"}]'
								data-textAlign="['left','left','left','left']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[0,0,0,0]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 5;background-color:rgba(2, 0, 11, 0.80);border-color:rgba(0, 0, 0, 0);border-width:0px;"> 
							</div>

							<!-- LAYER NR. 2 -->
							<div class="tp-caption Newspaper-Title   tp-resizeme" 
								id="slide-200-layer-2" 
								data-x="['center','center','center','center']" 
								data-hoffset="['0','0','0','0']" 
								data-y="['top','top','top','top']" 
								data-voffset="['250','250','250','240']" 
								data-fontsize="['50','50','50','30']"
								data-lineheight="['55','55','55','35']"
								data-width="full"
								data-height="none"
								data-whitespace="normal"
								data-type="text" 
								data-responsive_offset="on" 
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
								data-textAlign="['center','center','center','center']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[10,10,10,10]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 6; font-family:rubik; font-weight:700; text-align:center; white-space: normal;text-transform:uppercase;">
									BRGY. <span style="color: <?php echo $primary_color; ?>">POBLACION</span>
							</div>

							<!-- LAYER NR. 3 -->
							<div class="tp-caption Newspaper-Subtitle   tp-resizeme" 
								id="slide-200-layer-3" 
								data-x="['center','center','center','center']" 
								data-hoffset="['0','0','0','0']" 
								data-y="['top','top','top','top']" 
								data-voffset="['210','210','210','210']" 
								data-width="none"
								data-height="none"
								data-whitespace="nowrap"
								data-type="text" 
								data-responsive_offset="on"
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
								data-textAlign="['left','left','left','left']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[0,0,0,0]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 7; white-space: nowrap;text-transform:uppercase; color:#fff; font-family:rubik; font-size:18px; font-weight:400;">
									<span style="font-size: 23px;">MAUNLAD NA DAVAO DE ORO</span> 
							</div>
							
							<!-- LAYER NR. 3 -->
							<div class="tp-caption Newspaper-Subtitle   tp-resizeme" 
								id="slide-200-layer-4" 
								data-x="['center','center','center','center']" 
								data-hoffset="['0','0','0','0']" 
								data-y="['top','top','top','top']" 
								data-voffset="['320','320','320','290']" 
								data-width="['800','800','700','420']"
								data-height="['100','100','100','120']"
								data-whitespace="unset"
								data-type="text" 
								data-responsive_offset="on"
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
								data-textAlign="['center','center','center','center']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[0,0,0,0]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 7; text-transform:capitalize; white-space: unset; color:#fff; font-family:rubik; font-size:18px; line-height:28px; font-weight:400;">
									MAGKAROON NG MAS MAGANDANG KALIDAD NG BUHAY
							</div>
							<!-- LAYER NR. 4 -->
							<a href="residents.php"><div class="tp-caption Newspaper-Button rev-btn " 
								id="slide-200-layer-5" 
								data-x="['center','center','center','center']" 
								data-hoffset="['90','80','75','90']" 
								data-y="['top','top','top','top']" 
								data-voffset="['400','400','400','420']" 
								data-width="none"
								data-height="none"
								data-whitespace="nowrap"
								data-type="button" 
								data-responsive_offset="on" 
								data-responsive="off"
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"300","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0, 0, 0, 1.00);bg:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);bw:1px 1px 1px 1px;"}]'
								data-textAlign="['center','center','center','center']"
								data-paddingtop="[12,12,12,12]"
								data-paddingright="[30,35,35,15]"
								data-paddingbottom="[12,12,12,12]"
								data-paddingleft="[30,35,35,15]"
								style="z-index: 8; white-space: nowrap; outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer; background-color:var(--primary) !important; border:0; border-radius:30px; margin-right:5px;">
								
								<?php 
                            if (empty($_SESSION['sess2'])) {
                            ?>
                            LOGIN NOW
                            <?php 
                            }
                            else {
                            ?>
                            <?php echo strtoupper($r_fname); ?>
                            <?php 
                            }
                            ?>
								
								
								</div></a>
							<a class="tp-caption Newspaper-Button rev-btn" 
								id="slide-200-layer-6" 
								data-x="['center','center','center','center']" 
								data-hoffset="['-90','-80','-75','-90']" 
								data-y="['top','top','top','top']" 
								data-voffset="['400','400','400','420']" 
								data-width="none"
								data-height="none"
								data-whitespace="nowrap"
								data-type="button" 
								data-responsive_offset="on" 
								data-responsive="off"
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"300","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0, 0, 0, 1.00);bg:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);bw:1px 1px 1px 1px;"}]'
								data-textAlign="['center','center','center','center']"
								data-paddingtop="[12,12,12,12]"
								data-paddingright="[30,35,35,15]"
								data-paddingbottom="[12,12,12,12]"
								data-paddingleft="[30,35,35,15]"
								style="z-index: 8; white-space: nowrap; outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer; border-radius:30px;" href="contact">CONTACT US</a>
						</li>
						<!-- SLIDE  -->
					</ul>
				</div><!-- END REVOLUTION SLIDER -->  
			</div>  
		</div>  
        <!-- Main Slider -->
		<div class="content-block">
            
			<!-- Our Services -->
			<div class="section-area content-inner service-info-bx">
                <div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12">
							<div class="service-bx">
								<div class="action-box">
									<img src="assets/images/our-services/pic1.jpg" alt="">
								</div>
								<div class="info-bx text-center">
									<div class="feature-box-sm radius bg-white">
										<i class="fa fa-bank text-primary"></i>
									</div>
									<h4><a href="officials">Barangay Officials</a></h4>
									<a href="officials" class="btn radius-xl">Learn More</a>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="service-bx">
								<div class="action-box">
									<img src="assets/images/our-services/pic2.jpg" alt="">
								</div>
								<div class="info-bx text-center">
									<div class="feature-box-sm radius bg-white">
										<i class="fa fa-envelope-open text-primary"></i>
									</div>
									<h4><a href="all-announcements">Announcements</a></h4>
									<a href="all-announcements" class="btn radius-xl">Learn More</a>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="service-bx m-b0">
								<div class="action-box">
									<img src="assets/images/our-services/pic3.jpg" alt="">
								</div>
								<div class="info-bx text-center">
									<div class="feature-box-sm radius bg-white">
										<i class="fa fa-book text-primary"></i>
									</div>
									<h4><a href="services">Issuance</a></h4>
									<a href="services" class="btn radius-xl">Learn More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
            <!-- Our Services END -->
			
			<!-- Popular Courses -->
			<div class="section-area section-sp2">
				<div class="container">
					<div class="row">
						<div class="col-md-12 heading-bx left">
							<h2 style="font-weight: normal;" class="title-head">Recent <b>Announcements</b></h2>
							<p>Check out the latest news, events and announcements here.</p>
						</div>
					</div>	
					<div class="row">
					<div class="upcoming-event-carousel owl-carousel owl-btn-center-lr owl-btn-1 col-12 p-lr0  m-b30 ">
						<?php
							$category = 0;
							$status = 1;
							$rows = $model->displayRecentAnnouncements($category, $status);

							if (!empty($rows)) {
								foreach ($rows as $row) {

									$class = date('M. d, Y', strtotime($row['date']));
									$class_today = date('M. d, Y');

						?>
						<div class="item">
							<div class="event-bx">
								<div class="action-box">
									<img src="assets/images/announcement/<?php echo $row['image_unique']; ?>.jpg" style="height: 250px;object-fit: cover;" alt="">
								</div>
								<div class="info-bx d-flex">
									<div>
										<div class="event-time">
											<div class="event-date"><?php echo date('d', strtotime($row['date'])); ?></div>
											<div class="event-month"><?php echo date('F', strtotime($row['date'])); ?></div>
										</div>
									</div>
									<div class="event-info">
										<h4 class="event-title"><a href="announcement-details?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h4>
										<ul class="media-post">
											<li><a href="#"><i class="fa fa-clock-o"></i> <?php echo date('M. d, Y', strtotime($row['date'])); ?> - <?php echo date('M. d, Y', strtotime($row['expiration_date'])); ?></a></li>
										</ul>
										<p><?php echo substr($row['details'], 0, 150); ?><a href="announcement-details?id=<?php echo $row['id']; ?>" style="color: blue;">.... See More</a></p>
									</div>
								</div>
							</div>
						</div>
						<?php 
							}
						}
						?>
					</div>
					</div>
					<div class="text-center">
						<a href="all-announcements" class="btn">View All Announcements</a>
					</div>
				</div>
			</div>
			<style type="text/css">
				ul {
			  list-style-type: none; /* Remove bullets */
			  padding: 0; /* Remove padding */
			  margin: 0; /* Remove margins */
			}
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
			</style>
			<div class="section-area section-sp2" style="margin-top:-100px;">
				<div class="container">
					<div class="row">
						<div class="col-md-12 heading-bx left">
							<h2 style="font-weight: normal; " class="title-head">Barangay <b>Officials</b></h2>
							<p>Officials of Barangay Poblacion.</p>
						</div>
					</div>	
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
						<div class="col-lg-3 col-md-4 col-sm-12 m-b30" >
							<div class="profile-bx text-center" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
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
															$position = "N/A";
														}
													?>
													<li class="action-card col-xl-4 col-lg-6 col-md-12 col-sm-6 <?php echo $row['position']; ?>">
														<div class="cours-bx text-center">
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
            </div>
			</div>

			<div class="section-area section-sp2" style="margin-top:-100px;">
                <div class="container">
					<div class="row">
						<div class="heading-bx left">
							<h2 class="title-head">Issuance <span></span></h2>
							<span>Barangay Poblacion can generate different kinds of certificate that can be seen below.</span>
						</div>
					</div>	
					 <div class="pricingtable-row">
						<div class="row justify-content-center">
							<?php
								$category = '3';
								$status = '1';

								$rows = $model->displayAnnouncements($category, $status);
								if (!empty($rows)) {
									foreach ($rows as $row) {

							?>
							<div class="col-sm-12 col-md-6 col-lg-3 m-b40">
								<div class="pricingtable-wrapper">
									<div class="pricingtable-inner">
										<div class="pricingtable-main"> 
											<div class="pricingtable-price"> 
												<img src="assets/images/announcement/<?php echo $row['image_unique']; ?>.png" style="width: 100%;" alt="">
											</div>
											<div class="pricingtable-title">
												<h2><?php echo $row['title']; ?></h2>
												
											</div>
										</div>
										<ul class="pricingtable-features">
											<li><?php echo $row['details']; ?></li>
											<li>Price: ₱<?php echo $row['price']; ?></li>
										</ul>
										
										<div class="pricingtable-footer"> 
											<a href="residents.php" class="btn radius-xl">Request Now</a>
										</div>
									</div>
								</div>
							</div>
							<?php
									}
								}
							?>
						</div>
					</div>
				</div>
            </div>

			<style type="text/css">
			.container2 {
			  position: relative;
			  width: 100%;
			  overflow: hidden;
			  padding-top: 56.25%; /* 16:9 Aspect Ratio */
			}
			</style>
			<div class="section-area section-sp1" style="margin-top:-100px;">
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
                                        
		                                $name = $_POST['name'];
		                                $email = $_POST['email'];
		                                $subject = $_POST['subject'];
		                                $message = $_POST['message'];
		                                $date = date("Y-m-d H:i:s");

		                                $model = new Model();
		                               	$new = $model->post_message($name, $email, $subject, $message, $date);

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
					<br>
                </div>
            </div>



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
<!-- Revolution JavaScripts Files -->
<script src="assets/vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="assets/vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
<!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="assets/vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("img").mousedown(function(){
	return false;
	});
    
	var ttrevapi;
	var tpj =jQuery;
	if(tpj("#rev_slider_486_1").revolution == undefined){
		revslider_showDoubleJqueryError("#rev_slider_486_1");
	}else{
		ttrevapi = tpj("#rev_slider_486_1").show().revolution({
			sliderType:"standard",
			jsFileLocation:"assets/vendors/revolution/js/",
			sliderLayout:"fullwidth",
			dottedOverlay:"none",
			delay:9000,
			navigation: {
				keyboardNavigation:"on",
				keyboard_direction: "horizontal",
				mouseScrollNavigation:"off",
				mouseScrollReverse:"default",
				onHoverStop:"on",
				touch:{
					touchenabled:"on",
					swipe_threshold: 75,
					swipe_min_touches: 1,
					swipe_direction: "horizontal",
					drag_block_vertical: false
				}
				,
				arrows: {
					style: "uranus",
					enable: true,
					hide_onmobile: false,
					hide_onleave: false,
					tmp: '',
					left: {
						h_align: "left",
						v_align: "center",
						h_offset: 10,
						v_offset: 0
					},
					right: {
						h_align: "right",
						v_align: "center",
						h_offset: 10,
						v_offset: 0
					}
				},
				
			},
			viewPort: {
				enable:true,
				outof:"pause",
				visible_area:"80%",
				presize:false
			},
			responsiveLevels:[1240,1024,778,480],
			visibilityLevels:[1240,1024,778,480],
			gridwidth:[1240,1024,778,480],
			gridheight:[768,600,600,600],
			lazyType:"none",
			parallax: {
				type:"scroll",
				origo:"enterpoint",
				speed:400,
				levels:[5,10,15,20,25,30,35,40,45,50,46,47,48,49,50,55],
				type:"scroll",
			},
			shadow:0,
			spinner:"off",
			stopLoop:"off",
			stopAfterLoops:-1,
			stopAtSlide:-1,
			shuffle:"off",
			autoHeight:"off",
			hideThumbsOnMobile:"off",
			hideSliderAtLimit:0,
			hideCaptionAtLimit:0,
			hideAllCaptionAtLilmit:0,
			debugMode:false,
			fallbacks: {
				simplifyAll:"off",
				nextSlideOnWindowFocus:"off",
				disableFocusListener:false,
			}
		});
	}
});	
</script>
<script type="text/javascript">
	window.oncontextmenu = true;

	var elements = document.getElementsByTagName("*");
for(var id = 0; id < elements.length; ++id) { elements[id].oncontextmenu = true; }
</script>
</body>

</html>
