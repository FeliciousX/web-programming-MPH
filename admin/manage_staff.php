<?php
session_start();
require_once('../view/ManageStaffView.php');

$manageStaffView = new ManageStaffView();
$manageStaffView-> validateSession();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Manage Admin</title>
</head>
<body>
	<h2>Manage Admin</h2>

    <h2>List of Admins</h2>
      	<?php
      	if (isset($_SESSION['SuperAdmin']) && $_SESSION['SuperAdmin']) {
      		$manageStaffView->upgradeStaff();
      		$manageStaffView->downgradeStaff();
      		$manageStaffView->removeStaff();
      	}

      	$manageStaffView->showAllStaff();
      	?>
    </body>
</html> 