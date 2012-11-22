<?php
session_start();
require_once('view/ManageStaffView.php');

$manageStaffView = new ManageStaffView();
$manageStaffView-> validateSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Manage Admin Accounts</title>
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
  <fieldset>
    <legend class="centerObjects">List of Admins</legend>
      	<?php
      	if (isset($_SESSION['SuperAdmin']) && $_SESSION['SuperAdmin']) {
      		$manageStaffView->upgradeStaff();
      		$manageStaffView->downgradeStaff();
      		$manageStaffView->removeStaff();
      	}

      	$manageStaffView->showAllStaff();
      	?>
  </fieldset>
</body>
</html> 