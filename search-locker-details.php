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

			<?php $searchby = $_POST['searchinput'];

			?>

			<h1 align="center">Search Locker Details againt keyword "<?php echo $searchby; ?>"</h1>
			<hr />
			<div class="w3-agileits-about-grids">

				<div class="col-md-12 agile-about-left">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Locker Number</th>
								<th>Key Number</th>
								<th>Locker Name</th>
								<th>Mobile Number</th>
								<th>Email</th>
								<th>Status</th>
								<th>Locker Assign Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $query = mysqli_query($con, "select * from tblassignlocker where LockerNumber='$searchby' || KeyNumber='$searchby'");
							$cnt = 1;
							$count = mysqli_num_rows($query);
							if ($count > 0) {
								while ($result = mysqli_fetch_array($query)) {
							?>

									<tr>
										<td><?php echo $cnt; ?></td>
										<td><?php echo $result['LockerNumber'] ?></td>
										<td><?php echo $result['KeyNumber'] ?></td>
										<td><?php echo $result['FullName'] ?></td>
										<td><?php echo $result['MobileNumber'] ?></td>
										<td><?php echo $result['Email'] ?></td>
										<?php if ($result['Status'] == "1") { ?>

											<td><?php echo "Active"; ?></td>
										<?php } else { ?> <td><?php echo "Inactive"; ?>
											</td>
										<?php } ?>
										<td><?php echo $result['LockerAssigndate'] ?></td>

										<th>
											<a href="view-assign-locker.php?ltid=<?php echo $result['ID']; ?>" class="btn btn-primary"> View Details </a>

										</th>
									</tr>
								<?php
									$cnt++;
								}
							} else { ?>
								<tr>
									<th colspan="7" style="color:red; font-size:20px; text-align:center;">No Record Found</th>
								</tr>
							<?php } ?>



						</tbody>

					</table>
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