<?php
	session_start();
	require_once('controller/BookingController.php');
	$bookingController = new BookingController();
	
?>

<html>
<html lang="en">
<head>
	<title>SSFO | Cancel Booking Page</title>
	<!-- 1140px Grid styles for IE -->
	<!--[if lte IE 9]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" /><![endif]-->

	<!-- The 1140px Grid - http://cssgrid.net/ -->
	<link rel="stylesheet" href="css/1140.css" type="text/css" media="screen" />
	
	<!-- Your styles -->
	<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
	
	<!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->
	<script type="text/javascript" src="js/css3-mediaqueries.js"></script>
</head>

<body>
<?php include 'inc/header.php' ?>
<?php include 'inc/navbar.php' ?>

<div class="container">
<div class="row">
	<div class="fourcol"></div>

	<div class="threecol container">
		<fieldset style="max-width:400px;">
			<legend class="centerObjects">Booking Status</legend>
			<div class="row">
				<div class="twocol"></div>
				<div class="fourcol">
					<?php 
						if($bookingController->deleteBooking($_SESSION['ID'], $_POST['date']))
							echo '<p style="color:green;">Successfully cancelled booking!</p>';
						else
							echo '<p style="color:red;">Failed to cancel booking. <br/> Please contact an administrator.</p>';
					?>
				</div>
				<div class="threecol last"></div>
			</div>
		</fieldset>
	</div>
</div>
</body>