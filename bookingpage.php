<?php
session_start();
if (!isset($_POST['timeinfo'])||!isset($_POST['dayinfo']))
{
	header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>SSFO | Booking Page</title>
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
			<legend class="centerObjects">Booking Details</legend>
			<div class="row">  </div>
			<div class="row">
				<div class="twocol">Date: </div>
				<div class="twocol container">
					<?php echo $_POST['dateday'] . '-' . $_POST['datemonth'] . '-' . $_POST['dateyear']; ?>
				</div>
			</div>
			<div class="row">
				<div class="twocol">Day: </div>
				<div class="twocol container">
					<?php echo $_POST['dayinfo']; ?>
				</div>
			</div>
			<div class="row">
				<div class="twocol">Start Time: </div>
				<div class="twocol container">
					<?php echo $_POST['timeinfo']; ?>
				</div>
			</div>
			<div class="row">
				<form name="bookingFormSubmit" method="post" action="bookingsuccess.php">
					<input type="hidden" name="dayinfo" value="<?php echo $_POST['dayinfo']; ?>" />
					<input type="hidden" name="timeinfo" value="<?php echo $_POST['timeinfo']; ?>" />
					<div class="twocol">
						<label for="duration">Duration: </label>
					</div>
					<div class="onecol container">
						<div class="row">
							<input type="radio" name="duration" value="1 Hour" checked="true">1 Hour</input>
						</div>
						<div class="row">
							<input type="radio" name="duration" value="2 Hours">2 Hour</input>
						</div>
					</div>
					<div class="row">
						<div class="twocol"></div>
						<div class="threecol container">
							<input type="submit" value="Confirm Booking" class="button" />
						</div>
					</div>
				</form>
			</div>
		</fieldset>
	</div>
</div>
</div>	

</body>

</html>
