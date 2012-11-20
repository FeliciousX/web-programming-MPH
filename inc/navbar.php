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
			<div class="twelvecol last navbar" style="height:30px">
				<div class="threecol topmargin3px">
					<a href="index.php" class="button" style="height:27px; padding-top:4px;">Home</a>
				</div>
				<div class="threecol topmargin3px">
					<a href="aboutus.php" class="button" style="height:27px; padding-top:4px;">About Us</a>
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