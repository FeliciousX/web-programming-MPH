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
        <title>Account Setting | Swinburne MPH Booking </title>
       
    </head>
    <body>
       
       
                <h2>Change User Password</h2>
           
                    <h2>
                        Change Password
                    </h2>
                    
                        <form action="changepassword.php" method="post">
                            <fieldset>
                                <p>Change your password.</p>
                            <?php 
                            /**if(isset($_POST['ss']))
                            {
        
                            if($_POST['ss'] == "student")
                                {$changePasswordView->changeStudentPassword();}
                                
                            else if($_POST['ss'] = "staff")
                                {$changePasswordView->changeStaffPassword();} 
                            }**/
                          $changePasswordView->changeUserPassword();
                            ?>
                                
                                    <label>Current Password: </label>
                                    <input type="text" name="Password" />
                                </p>
                                <p>
                                    <label>New Password: </label>
                                    <input type="password" name="NewPassword" />
                                </p>
                                <p>
                                    <label>Repeat New Password: </label>
                                    <input type="password" name="RepeatNewPassword" />
                                </p>
                                <input type="submit" name="Submit" value="Change Password" />
                            </fieldset>					
                        </form>
                   
            <?php include('footer.php'); ?>
        
    </body>
</html>