<?php
require_once('view/LoginView.php');
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

<?php
	$loginView = new LoginView();
	echo '
	<div class="container navcontainer">
		<div class="row">
			<div class="twelvecol last navbar">
				<div class="threecol">
					<a href="index.php" class="navbar">Home</a>
				</div>
				<div class="threecol">
					<a href="aboutus.php" class="navbar">About Us</a>
				</div>
				<div class="threecol">'; 
					$loginView->validatePrivilegeButton(); 
	echo '		</div>
				<div class="threecol last">';
					$loginView->validateLoginButton();
	echo '		</div>
			</div>
		</div>
	</div>';

?>


</html>