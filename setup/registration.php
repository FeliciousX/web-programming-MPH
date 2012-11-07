<?php
session_start();

require_once('../config.php');
require_once('../controller/AdminController.php');
require_once('../model/AdminModel.php');
require_once('../securimage/securimage.php');

/**
 * registration.php
 * 
 * @author Auwal Sagir
 * @author Churchill Lee
 * @author Isaac Yong
 * @author Benedict Khoo
 * @version 2012-05-28
 */
function registerAdmin() {
    if (isset($_POST['Register'])) {
        try {
            $staffID = $_POST['Username'];
            $name = $_POST['FirstName'] . ' ' . $_POST['LastName'];
            $password = $_POST['Password'];
            $repeatPassword = $_POST['RepeatPassword'];
            $captcha = stripslashes($_POST['Captcha']);

            $securImage = new Securimage();

            if (!$securImage->check($captcha)) {
                throw new Exception('Wrong captcha.');
            }

            $adminController = new AdminController();
            $adminController->addAdmin($staffID, $password, $repeatPassword, $name);

            $adminController->promoteToSuperAdmin($staffID);
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
        <title>Super Admin Account Setting | Swinburne Library Discussion Room Booking </title>
        <link rel="stylesheet" type="text/css" href="../css/reset.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../css/text.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../css/grid.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../css/layout.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../css/nav.css" media="screen" />
        <link rel="icon" href="../img/favicon.ico" type="image/x-icon" /> 
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" /> 
        <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
        <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <script type="text/javascript" src="../js/jquery-fluid16.js"></script>
    </head>
    <body>
        <div class="container_12">
            <div class="grid_12">
                <h1 id="branding">
                    Swinburne Library Discussion Room Booking
                </h1>
                <div class="clear"></div>

                <div class="grid_12">
                    <h2 id="page-heading">Registration Form</h2>
                    <div class="grid_7">
                        <div class="block" id="forms">
                            <?php registerAdmin(); ?>
                            <form action="registration.php" method="post">
                                <fieldset class="login">
                                    <legend>Login Information</legend>
                                    <div id="stylized" class="myform">

                                        <label for="Username">Username
                                            <span class="small">Login ID</span>
                                        </label>
                                        <input class="input" type="text" name="Username" id="Username" maxlength="15"/>

                                        <label for="FirstName">First Name
                                            <span class="small">Given Name</span>
                                        </label>
                                        <input class="input" type="text" name="FirstName" id="FirstName" maxlength="35"/>

                                        <label for="LastName">Last Name
                                            <span class="small">Surname/Family Name</span>
                                        </label>
                                        <input class="input" type="text" name="LastName" id="LastName" maxlength="35"/>

                                        <label for="Password">Password
                                            <span class="small">Minimum 8 characters</span>
                                        </label>
                                        <input class="input" type="password" name="Password" id="Password" maxlength="35"/>

                                        <label for="RepeatPassword">Re-enter Password</label>
                                        <input class="input" type="password" name="RepeatPassword" id="RepeatPassword" maxlength="35"/>

                                        <label class="captcha" for="siimage">Word Verification:
                                            <br /><span class="img_link" align="center"><a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '../securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="../securimage/images/refresh.png" alt="Reload Image" onclick="this.blur()" align="bottom" border="0" /></a></span>
                                            <span class="img_link"><object type="application/x-shockwave-flash" data="securimage/securimage_play.swf?audio_file=securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="32" width="32">
                                                    <param name="movie" value="securimage/securimage_play.swf?audio_file=securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000">
                                                </object></span>
                                        </label>
                                        <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="../securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />

                                        <label for ="Captcha">Captcha:</label>
                                        <input class="input" type="text" name="Captcha" id="Captcha" />
                                    </div>
                                    <div class="clear"></div>
                                    <input class="register" type="submit" name="Register" value="Proceed" />
                                    <input class="clear" type="reset" name="Clear" value="Clear" />
                                </fieldset>
                            </form>

                        </div>
                    </div>
                </div>
                <?php include('../footer.php'); ?>
            </div>
        </div>
    </body>
</html>