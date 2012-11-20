<?php
	session_start();
	require_once('view/IndexView.php');
	$indexView = new IndexView();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SSFO | Home</title>
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
	<div class="row selection">
		<div class="twelvecol last centerObjects">
			<fieldset>
				<legend>Sports Type</legend>
			<form name="sportsForm" action="index.php" method="post">
			<p>
			<select name="sportsType">
			    <option value="Basketball">Basketball</option>
			    <option value="Badminton">Badminton</option>
			    <option value="Table Tennis">Table Tennis</option>
			    <option value="Squash">Squash</option>
			    <option value="Multistorey Carpark">Multistorey Carpark (Futsal & Tennis)</option>
			</select>
			<input type="submit" value="Submit" class="button" />
			</p>
			</form>
			</fieldset>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="twelvecol last">
			<fieldset class="schedule">
				<legend class="centerObjects">Schedule of the Week</legend>
				<?php $indexView->displayTable(); ?>
			</fieldset>
		</div>
	</div>
</div>

</body>

</html>