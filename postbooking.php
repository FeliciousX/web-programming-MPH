<?php
session_start();

require_once('controller/BookingController.php');
require_once('controller/SportsController.php');

$bookingController = new BookingController();
$sportsController = new SportsController();

if($_POST['duration']==12)
{
	$afterMinutes = $_POST['startminutes'];
	$afterHour = $_POST['starthour'] + 2;
}
else if($_POST['duration']==6)
{
	$afterMinutes = $_POST['startminutes'];
	$afterHour = $_POST['starthour'] + 1;
}
else if($_POST['startminutes'] + $_POST['duration'] == 6) //half hour
{
	$afterMinutes = $_POST['startminutes'];
	$afterHour = $_POST['starthour'] + 1;
}
else
{
	$afterMinutes = $_POST['startminutes'];
	$afterHour = $_POST['starthour'];
}

$startTime = $_POST['starthour']  . $_POST['startminutes'] . '000';
$afterTime = $afterHour  . $afterMinutes . '000';
$sports = $_POST['sports'];

if($sports=="Basketball") {
	$courtID = 6;
}
else if($sports=="Badminton") {
	$courtID = 1;
}
else if($sports=="TableTennis" || $sports=="Squash") {
	$courtID = 8;
}
else if($sports=="MultistoreyCarpark") {
	$courtID = 10;
}


?>

<html>
<html lang="en">
<head>
	<title>SSFO | Post Booking Page</title>
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
				<div class="twocol"> </div>
				<div class="fourcol">
				<?php
				if($afterTime<=230000) {
					if($sportsController->checkRoomStatus($_POST['date'], $startTime, $afterTime, $sports, $_POST['day'])) {
						if($sports=="Basketball") {
							if($_POST['court'] == "true") {
								if(!($bookingController->getBooking($_POST['date'], $startTime, $afterTime, 5)))
									$courtID = 5;
							}
							else {
								if($_POST['day']=="Sunday")
									$courtID = 7;
								else {
									if($bookingController->getBooking($_POST['date'], $startTime, $afterTime, 6))
										$courtID = 7;
								}
							}
						}
						else if($sports=="Badminton") {
							do {
								if(!($bookingController->getBooking($_POST['date'], $startTime, $afterTime, 1)))
									break;
								else if($bookingController->getBooking($_POST['date'], $startTime, $afterTime, $courtID))
								{
									$courtID++;
									break;
								}
							} while ($courtID<=4);
						}
						else if($sports=="TableTennis" || $sports=="Squash") {
							if($bookingController->getBooking($_POST['date'], $startTime, $afterTime, 8))
								$courtID = 9;
						}
						else if($sports=="MultistoreyCarpark") {
							$courtID = 10;
						}

						if($bookingController->bookCourt($_SESSION['ID'], $_POST['date'], $startTime, $afterTime, $sports, $courtID))
							echo '<p style="color:green;">Successfully booked!</p>';
						else
							echo '<p style="color:red;">Failed to book timeslot!</p><p>You probably have another facility <br /> booked at this day!</p>';
					}
					else
						echo '<p style="color:red;>Failed to book timeslot.</p> <p>Either the selected duration cannot be met, <br/> or someone has booked it a few moments before you.</p>';
				}
				else {
					echo '<p style="color:red;>Failed to book timeslot.</p> <p>You cannot book past 2300!</p>';
				}
				?>
				</div>
				<div class="threecol last"></div>
			</div>
		</fieldset>
	</div>
</div>

</body>