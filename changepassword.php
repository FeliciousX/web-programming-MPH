<?php
session_start();
require_once('inc/config.php');
require_once('view/ChangePasswordView.php');

$changePasswordView = new ChangePasswordView();
$changePasswordView->validateSession();

/**
 * changepassword.php
 * 
 * @author Liew Kit Loong
 * @version 2012-11-18
 * 
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>SSFO | Change Password</title>
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
            <div class="container centerObjects">
            <div class="row">
            <fieldset>
                <legend class="centerObjects">Change Password</legend>
                <form action="changepassword.php" method="post">
                    <?php 
                        $changePasswordView->changeUserPassword();
                    ?>
                    <div class="row">
                        <div class="fourcol"></div>
                        <div class="twocol"><label for = "Password">Current Password: </label></div>
                        <div class="twocol"><input type="text" name="Password" /></div>
                    </div>
                    <div class="row">
                        <div class="fourcol"></div>
                        <div class="twocol"><label for = "NewPassword">New Password: </label></div>
                        <div class="twocol"><input type="password" name="NewPassword" /></div>
                    </div>
                    <div class="row">
                        <div class="fourcol"></div>
                        <div class="twocol"><label for = "RepeatNewPassword">Repeat New Password: </label></div>
                        <div class="twocol"><input type="password" name="RepeatNewPassword" /></div>
                    </div>
                    <div class="row">
                        <div class="fourcol"></div>
                        <div class="twocol"></div>
                        <div class="twocol">
                            <input type="submit" name="Submit" value="Change Password" />
                        </div>
                    </div>		
                </form>
            </fieldset> 
            </div>
            </div>
                   
            <?php include('footer.php'); ?>
        
    </body>
</html>