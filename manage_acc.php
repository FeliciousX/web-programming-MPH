<?php
  session_start();

  require_once('view/ManageAccView.php');
  $ManageAccView = new ManageAccView();
  $ManageAccView->validateSession();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Manage User Accounts</title>
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
 	<legend class="centerObjects"><h2>Search Users</h2></legend>
 	 	<form action="ManageAcc.php" method="post" class="centerObjects">
            <label for="searchItem">Search:</label>
            <input type="text" name="searchItem" />
            <select name="type">
    	       	<option value="StudentID" selected="selected">Student ID</option>
    	        <option value="StudentFirstName">First Name</option>
    	        <option value="StudentLastName">Last Name</option>
	        </select>
            <input class="form" type="submit" name="showAll" value="Show All" />
            <input class="form" type="submit" name="search" value="Search" />
        </form>
    </fieldset> 
    <fieldset>
 	      <legend class="centerObjects">Account</legend>
 	      <?php
            $ManageAccView->activate();
            $ManageAccView->deactivate();
            $ManageAccView->delete();
            if (isset($_POST['search'])) {
                $ManageAccView->search();
            } else {
             	$ManageAccView->showStudent();
          	}
         ?>
    </fieldset>

</body>
</html> 

