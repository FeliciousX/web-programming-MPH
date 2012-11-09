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

<?php
	echo '
	<div class="container navcontainer">
		<div class="row">
			<div class="elevencol last navbar">
				<div class="threecol">
					<a href="btn1.html" class="navbar">Button 1</a>
				</div>
				<div class="threecol">
					<a href="btn2.html" class="navbar">Button 2</a>
				</div>
				<div class="threecol">
					<a href="btn3.html" class="navbar">Button 3</a>
				</div>
				<div class="threecol last">
					<a href="login.php" class="navbar">Login</a>
				</div>
			</div>
		</div>
	</div>
		'

?>


</html>