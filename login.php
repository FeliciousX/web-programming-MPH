<?php
	require_once('view/RegistrationView.php');

	$registrationView = new RegistrationView();
?>
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
<?php include 'inc/header.php' ?>
<?php include 'inc/navbar.php' ?>
<div class="container">
	<div class="row">
		<div class="fourcol"></div>
		<div class="twocol">
			<fieldset>
				<legend class="loginlegend">Login</legend>
				<?php $registrationView->validateLoginData(); ?>
					<div class="threecol">
						<form method="post" action="login.php" id="login_form">
							<div class="row loginrow">
								<p><label class="loginbox" for="Username">Student ID:</label><input class="text" type="text" name="Username" /></p>
							</div>
							<div class="row loginrow">
								<p><label class="loginbox" for="Password">Password:</label><input class="text" type="password" name="Password" /></p>
							</div>
							<div class="row loginrow">
								<div class="threecol">
									<a href="lostPassword.php" class="loginbox">Forgot your password?</a> <br />
									<a href="registration.php" class="loginbox">Register</a>
								</div>
								<div class="twocol last">
									<input class="submit" type="submit" value="SUBMIT" name="Login"/>
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