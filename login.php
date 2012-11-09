<!DOCTYPE html>
<html lang="en">
<head>
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
<div class="container heading">
	<div class="row">
		<div class="twelvecol">
			<h1 class="centerText">Some Kind of Booking System</h1>
		</div>
	</div>
</div>
<?php include 'inc/navbar.php' ?>
<div class="container">
	<div class="row">
		<div class="fourcol">
			&nbsp;
		</div>
		<div class="threecol loginbox">
			<form method="post" action="login.php">
			<div class="row">
				<p><label for="id">Student ID:</label><input class="text" type="text" name="id" /></p>
			</div>
			<div class="row">
				<p><label for="pw">Password:</label><input class="text" type="password" name="pw" /></p>
			</div>
			<div class="row topmargin5px">
				<div class="threecol">
					<a href="lostPassword.php" class="loginbox">Forgot your password?</a> <br />
					<a href="register.php" class="loginbox">Register</a>
				</div>
				<div class="twocol last">
					<input class="submit" type="submit" value="SUBMIT"/>
				</div>
			</div>
			</form>
		</div>
		<div class="fivecol last">
			&nbsp;
		</div>
	</div>
</div>

</body>



</html>