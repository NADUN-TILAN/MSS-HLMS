<?php
include('Main/includes/config.php');
session_start();
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>HLMS | Home</title>
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--// Meta tag Keywords -->
	<!-- css files -->
	<link rel="icon" type="image/jpg" sizes="16x16" href="http://localhost/lock/images1/favicon.jpg">

	<link href="css1/bootstrap.css" rel="stylesheet" type="text/css" media="all" /> <!-- Bootstrap-Core-CSS -->
	<link href="css1/style.css" rel="stylesheet" type="text/css" media="all" /> <!-- Style-CSS -->
	<link rel="stylesheet" href="css1/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
	<link rel="stylesheet" href="css1/flexslider.css" type="text/css" media="all" /> <!-- Banner-Slider-CSS -->
	<!-- //css files -->
	<link rel="stylesheet" type="text/css" href="css1/demo.css" />
	<!-- online-fonts -->
	<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Ubuntu+Condensed&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
	<!-- //online-fonts -->
</head>

<body>

	<?php include_once("includes/header.php"); ?>


	<!-- //banner section -->
	<!-- about -->
	<div class="about" id="about">
		<div class="container">
			<h3 class="w3l-title"><span>About</span> Us</h3>
			<div class="w3-agileits-about-grids">
				<div class="col-md-5 agile-about-right">
					<img src="images1/3.png" alt="" />
				</div>
				<div class="col-md-7 agile-about-left">
					<?php

					$ret = mysqli_query($con, "select * from tblpage where PageType='aboutus' ");
					$cnt = 1;
					while ($row = mysqli_fetch_array($ret)) {

					?>
						<h3 class="w3l-sub">Offering the most </h3>
						<p class="sub-p">competitive rates and fees</p>
						<p class="sub-p2"><?php echo $row['PageDescription']; ?></p>
					<?php } ?>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //about -->


	<!--stats-->
	<div data-vide-bg="video/coins">
		<div class="stats center-container" id="stats">
			<div class="container">
				<div class="stats-info">
					<div class="col-md-4 col-xs-4 stats-grid slideanim">
						<i class="fa fa-user-o" aria-hidden="true"></i>
						<div class="agile-one">
							<h4 class="stats-info">Employees</h4>
							<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='1000' data-delay='.5' data-increment="1">100</div>
						</div>
					</div>
					<div class="col-md-4 col-xs-4 stats-grid slideanim">
						<i class="fa fa-globe" aria-hidden="true"></i>
						<div class="agile-one">
							<h4 class="stats-info">Locations</h4>
							<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='1200' data-delay='.5' data-increment="1">120</div>
						</div>
					</div>
					<div class="col-md-4 col-xs-4 stats-grid slideanim">
						<i class="fa fa-diamond" aria-hidden="true"></i>
						<div class="agile-one">
							<h4 class="stats-info">Awards Winning</h4>
							<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='1050' data-delay='.5' data-increment="1">105</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!--//stats-->
	<!-- team -->


	<!-- mail -->
	<div class="mail" id="contact">
		<div class="container">
			<br>
			<h3 class="w3l-title"><span>Contact</span> Us</h3></br>
			<div class="mail-w3l-agile">
				<div class="col-md-6 col-sm-6 contact-left-w3ls">
					<?php

					$ret = mysqli_query($con, "select * from tblpage where PageType='contactus' ");
					$cnt = 1;
					while ($row = mysqli_fetch_array($ret)) {

					?>
						<div class="w3l-cont-mk">
							<img src="images1/img2.jpg">
						</div>
						<h3>Contact Info</h3>
						<div class="visit">
							<div class="col-md-2 col-sm-2 col-xs-2 contact-icon-wthree">
								<i class="fa fa-home" aria-hidden="true"></i>
							</div>
							<div class="col-md-10 col-sm-10 col-xs-10 contact-text-agileinf0">
								<h4>Visit us</h4>
								<p><?php echo $row['PageDescription']; ?></p>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="mail-w3">
							<div class="col-md-2 col-sm-2 col-xs-2 contact-icon-wthree">
								<i class="fa fa-envelope-o" aria-hidden="true"></i>
							</div>
							<div class="col-md-10 col-sm-10 col-xs-10 contact-text-agileinf0">
								<h4>Mail us</h4>
								<p><a href="mailto:hlmsinfo@example.com"><?php echo $row['Email']; ?></a></p>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="call">
							<div class="col-md-2 col-sm-2 col-xs-2 contact-icon-wthree">
								<i class="fa fa-phone" aria-hidden="true"></i>
							</div>
							<div class="col-md-10 col-sm-10 col-xs-10 contact-text-agileinf0">
								<h4>Call us</h4>
								<p>+<?php echo $row['MobileNumber']; ?></p>
							</div>
							<div class="clearfix"></div>
						</div>
				</div><?php } ?>
			<div class="col-md-6 col-sm-6 agileinfo_mail_grid_right">
				<h3>Product Search</h3>
				<form name="bwdatesreportds" action="search-locker-details.php" method="post">
					<div class="wthree_contact_left_grid">
						<input type="text" id="searchinput" name="searchinput" placeholder="Search Locker Details by Locker Number/ Key Number" required="">

					</div>
					<br>
					<button type="submit" class="btn btn-primary" name="submit" id="submit">Search</button>
				</form>
			</div>
			<div class="clearfix"> </div>
			</div>
		</div>
	</div>

	<!-- //mail -->
	<!-- footer -->
	<?php include_once("includes/footer.php"); ?>

	<!-- js files -->
	<!-- js -->
	<script type="text/javascript" src="js1/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js1/bootstrap.js"></script> <!-- Necessary-JavaScript-File-For-Bootstrap -->
	<!-- //js -->
	<!-- js for banner -->
	<!-- responsiveslider -->
	<script src="js1/responsiveslides.min.js"></script>
	<script>
		// You can also use "$(window).load(function() {"
		$(function() {
			// Slideshow 4
			$("#slider3").responsiveSlides({
				auto: true,
				pager: true,
				nav: false,
				speed: 500,
				namespace: "callbacks",
				before: function() {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function() {
					$('.events').append("<li>after event fired.</li>");
				}
			});

		});
	</script>
	<!-- //responsiveslider -->
	<!-- stats -->
	<script type="text/javascript" src="js1/numscroller-1.0.js"></script>
	<!-- //stats -->
	<!-- /js for banner -->
	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="js1/move-top.js"></script>
	<script type="text/javascript" src="js1/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->
	<!-- smooth scrolling -->
	<script src="js1/SmoothScroll.min.js"></script>
	<!-- //smooth scrolling -->
	<!-- smooth-scrolling-of-move-up -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/

			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->
	<!-- video-js -->
	<script src="js1/jquery.vide.min.js"></script>
	<!-- //video-js -->
	<!--gallery-js -->
	<script src="js1/jquery.picEyes.js"></script>
	<script>
		$(function() {
			//picturesEyes($('.demo li'));
			$('.demo li').picEyes();
		});
	</script>
	<!--//gallery-js -->
	<!-- //js files -->

</body>

</html>