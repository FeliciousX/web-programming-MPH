<?php
    session_start();
    require_once('controller/ActivationController.php');

    $activationController = new ActivationController();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
          <meta http-equiv="content-type" content="text/html; charset=utf-8" />
          <title>About Us</title>
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
                <legend>Account Activation</legend>
            <form name="activationForm" action="activate.php" method="get">
                <?php 
                    $activationController->activateAccount();
                ?>
            <p><label for="userID">User ID: </label><input type="text" name="userID"/></p>
            <p><label for="code">Activation Code: </label><input type="text" name="code"/></p>
            
            <input type="submit" value="Activate" name="activate" class="button" />
            </p>
            </form>
            </fieldset>
        </div>
    </div>
</div>

    </body>
</html>