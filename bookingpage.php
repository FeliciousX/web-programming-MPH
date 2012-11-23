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
					<?php 
						$fullDate = $_POST['dateyear'] . '-' . $_POST['datemonth'] . '-' . $_POST['dateday'];
						echo $fullDate; 
					?>
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
				<form name="bookingFormSubmit" method="post" action="postbooking.php">
					<input type="hidden" name="day" value = "<?php echo $_POST['dayinfo']; ?>" />
					<input type="hidden" name="date" value="<?php echo $fullDate; ?>" />
					<input type="hidden" name="timeinfo" value="<?php echo $_POST['timeinfo']; ?>" />
					<input name="starthour" type="hidden" value="<?php echo $_POST['starthour']; ?>"/>
					<input name="startminutes" type="hidden" value="<?php echo $_POST['startminutes']; ?>"/>
					<input name="sports" type="hidden" value="<?php echo $_POST['sports']; ?>"/>
					<div class="twocol">
						<label for="duration">Duration: </label>
					</div>
					<div class="onecol container">
						<div class="row">
							<input type="radio" name="duration" value="3">Half an Hour</input>
						</div>
						<div class="row">
							<input type="radio" name="duration" value="6" checked="true">1 Hour</input>
						</div>
						<div class="row">
							<input type="radio" name="duration" value="12">2 Hour</input>
						</div>
					</div>
					<div class="row">

					<?php
					if($_POST['sports']=="Basketball") {
						if($_POST['dayinfo']!="Sunday") {
						echo 	'<div class="twocol">
									<label for="duration">Court: </label>
								</div>
								<div class="onecol container">
									<div class="row">
										<input type="radio" name="court" value="false" checked="true">Half Court</input>
									</div>
									<div class="row">
										<input type="radio" name="court" value="true">Full Court</input>
									</div>
								</div>
								<div class="row">';
						}
						else {
						echo 	'<div class="twocol">
									<label for="duration">Court: </label>
								</div>
								<div class="onecol container">
									<div class="row">
										<input type="radio" name="court" value="false" checked="true">Half Court</input>
									</div>
								</div>
								<div class="row">';
						}
					}
					
					?>

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
