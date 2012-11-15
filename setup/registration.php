<?php
session_start();

require_once('../inc/config.php');
require_once('../controller/staffcontroller.php');
require_once('../model/staffmodel.php');
require_once('../controller/studentcontroller.php');
require_once('../model/studentmodel.php');
require_once('../securimage/securimage.php');

/**
 * registration.php
 * 
 * @author Churchill Lee
 * @author Isaac Yong
 * @author Liew Kit Loong
 * @version 2012-11-09
 */
function registerAdmin() {
    if (isset($_POST['Register'])) {
        try {
            $staffID = $_POST['Username'];
            $firstname = $_POST['FirstName'];
            $lastname = $_POST['LastName'];
            $password = $_POST['Password'];
            $repeatPassword = $_POST['RepeatPassword'];
            $captcha = stripslashes($_POST['Captcha']);

            $securImage = new Securimage();

            if (!$securImage->check($captcha)) {
                throw new Exception('Wrong captcha.');
            }

            $staffController = new StaffController();
            $staffController->addAdmin($staffID, $password, $repeatPassword, $firstname,$lastname);

            $staffController->promoteToSuperAdmin($staffID);
            header('Location: ../index.php');
        } catch (Exception $e) {
            echo '<p class="error_message">' . $e->getMessage() . '</p>';
        }
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title> Admin Account Setting | Swinburne MPH Booking </title>
      
    </head>
    <body>
        
                <h1>
                    Swinburne MPH Booking
                </h1>
               
                            <?php registerAdmin(); ?>
                            <form action="registration.php" method="post">
                                <fieldset>
                                    <legend>Login Information</legend>
                                  

                                        <label for="Username">Username
                                            <span>Login ID</span>
                                        </label>
                                        <input class="input" type="text" name="Username" id="Username" maxlength="15"/>

                                        <label for="FirstName">First Name
                                            <span>Given Name</span>
                                        </label>
                                        <input class="input" type="text" name="FirstName" id="FirstName" maxlength="35"/>

                                        <label for="LastName">Last Name
                                            <span>Surname/Family Name</span>
                                        </label>
                                        <input class="input" type="text" name="LastName" id="LastName" maxlength="35"/>

                                        <label for="Password">Password
                                            <span>Minimum 6 characters</span>
                                        </label>
                                        <input class="input" type="password" name="Password" id="Password" maxlength="35"/>

                                        <label for="RepeatPassword">Re-enter Password</label>
                                        <input class="input" type="password" name="RepeatPassword" id="RepeatPassword" maxlength="35"/>

                                        <label class="captcha" for="siimage">Word Verification:
                                            <br /><span><a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '../securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="../securimage/images/refresh.png" alt="Reload Image" onclick="this.blur()" align="bottom" border="0" /></a></span>
                                            <span><object type="application/x-shockwave-flash" data="securimage/securimage_play.swf?audio_file=securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="32" width="32">
                                                    <param name="movie" value="securimage/securimage_play.swf?audio_file=securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000">
                                                </object></span>
                                        </label>
                                        <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="../securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />

                                        <label for ="Captcha">Captcha:</label>
                                        <input class="input" type="text" name="Captcha" id="Captcha" />
                                    
                                   
                                    <input class="register" type="submit" name="Register" value="Proceed" />
                                    <input class="clear" type="reset" name="Clear" value="Clear" />
                                </fieldset>
                            </form>

                  
                </div>
                <?php include('../footer.php'); ?>
            </div>
        </div>
    </body>
</html>