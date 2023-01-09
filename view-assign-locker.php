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
	<!-- about -->
	<div class="about" id="about">
		<div class="container">


			<h1>Locker Details</h1>
			<div class="w3-agileits-about-grids">

				<div class="col-md-12 agile-about-left">
					<?php
					$ltid = intval($_GET['ltid']);
					$query = mysqli_query($con, " select tbllockertype.ID as blid,tbllockertype.SizeofLocker,tbllockertype.Priceoflocker,tblassignlocker.* from tblassignlocker join tbllockertype on tbllockertype.ID=tblassignlocker.LockerSize where tblassignlocker.ID='$ltid'");
					$cnt = 1;
					while ($result = mysqli_fetch_array($query)) {
					?>
						<table id="example1" class="table table-bordered table-striped">
							<tr align="center">
								<td colspan="4" style="font-size:20px;color:blue">
									Locker Details</td>
							</tr>

							<tr>
								<th>Full Name</th>
								<td><?php echo $result['FullName'] ?></td>
								<th>Email</th>
								<td><?php echo $result['Email'] ?></td>
							</tr>
							<tr>
								<th>Mobile Number</th>
								<td><?php echo $result['MobileNumber'] ?></td>
								<th>Complete Address</th>
								<td><?php echo $result['CompleteAddress'] ?></td>
							</tr>
							<tr>
								<th>Occupation</th>
								<td><?php echo $result['Occupation'] ?></td>
								<th>Type of Locker</th>
								<td><?php echo $result['SizeofLocker'] ?></td>
							</tr>
							<tr>
								<th>Locker Number</th>
								<td><?php echo $result['LockerNumber'] ?></td>
								<th>Key Number</th>
								<td><?php echo $result['KeyNumber'] ?></td>
							</tr>
							<tr>
								<th>Instruction(if any)</th>
								<td><?php echo $result['Instructions'] ?></td>
								<th>Name of Nominee</th>
								<td><?php echo $result['NomineeName'] ?></td>
							</tr>
							<tr>
								<th>Relation with Nominee</th>
								<td><?php echo $result['Relationwithnominee'] ?></td>
								<th>Valuable Details</th>
								<td><?php echo $result['ValuableDetails'] ?></td>
							</tr>
							<tr>
								<th>ID Proof</th>
								<td><?php echo $result['IDcard'] ?></td>
								<th>View ID Proof</th>
								<td><a href="Main/addressproof/<?php echo $result['IDproof'] ?>" width="100" height="100" target="_blank"> <strong style="color: red">View</strong></a></td>
							</tr>
							<tr>
								<th>View Pic</th>
								<td><img src="Main/photo/<?php echo $result['Photo']; ?>" width="100" height="100" value="<?php echo $result['Photo']; ?>>"></td>
								<th>Status</th>
								<?php if ($result['Status'] == "1") { ?>

									<td><?php echo "Active"; ?></td>
								<?php } else { ?> <td><?php echo "Inactive"; ?>
									</td>
								<?php } ?>
							</tr>
						</table><?php } ?>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //about -->

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