<?php
	session_start();
	require_once('view/ShowAllBookingView.php');
	if (!(isset($_SESSION['Admin'])))
		header("Location:index.php?sportsType=Basketball");

	$showAllBookingView = new ShowAllBookingView();


?>

<html>
<html lang="en">
<head>
	<title>SSFO | Show All Booking: Admin Page</title>
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
<?php 
	$showAllBookingView->cancelBooking();
	$showAllBookingView->showAllBooking(); 
?>
</div>
</body>