<?php
require_once('inc/config.php');
require_once('view/RegistrationView.php');
require_once('securimage/securimage.php');


$registrationView = new RegistrationView();
$registrationView->validateSession();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <!-- 1140px Grid styles for IE -->
        <!--[if lte IE 9]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" /><![endif]-->
    
        <!-- The 1140px Grid - http://cssgrid.net/ -->
        <link rel="stylesheet" href="css/1140.css" type="text/css" media="screen" />
        
        <!-- Your styles -->
        <link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
        
        <!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->
        <script type="text/javascript" src="js/css3-mediaqueries.js"></script>
        <title>Register | Swinburne MPH Booking </title>

    </head>
    <body>
    <?php include 'inc/header.php' ?>
    <?php include 'inc/navbar.php' ?>
        <div class="container">
            <div class="row">
                <div class="twocol">
                </div>
                <div class="sixcol">
                    <form action="registration.php" method="post">
                        <fieldset>
                            <legend>Registration Form</legend>
                            <?php 
                            if(isset($_POST['ss']))
                            {
        
                            if($_POST['ss'] == "student")
                                {$registrationView->validateStudentRegistrationData();}
                                
                            else if($_POST['ss'] = "staff")
                                {$registrationView->validateStaffRegistrationData();} 
                            }
                          
                            ?>
                            <div class="row registration">
                                <div class="fourcol">
                                    <label for="ss">Account Type
                                        <span>Specify Student or Staff</span>
                                    </label>
                                </div>
                                <div class="fourcol last">
                                    <p><input type="radio" name="ss" value="student" checked = "true">Student Registration</p>
                                    <p><input type="radio" name="ss" value="staff">Staff Registration</p>
                                </div>
                            </div>
                            <div class="row registration">
                                <div class="fourcol">
                                    <label for="Username">Username
                                        <span>User ID</span>
                                    </label>
                                </div>
                                <div class="fourcol last">
                                    <input type="text" name="Username" id="Username" maxlength="15"/>
                                </div>
                            </div>
                            <div class="row registration">
                                <div class="fourcol">
                                    <label for="FirstName">First Name
                                        <span>Given Name</span>
                                    </label>
                                </div>
                                <div class="fourcol last">
                                    <input type="text" name="FirstName" id="FirstName" maxlength="35"/>
                                </div>
                            </div>
                            <div class="row registration">
                                <div class="fourcol">
                                    <label for="LastName">Last Name
                                        <span>Surname/Family Name</span>
                                    </label>
                                </div>
                                <div class="fourcol last">
                                    <input type="text" name="LastName" id="LastName" maxlength="35"/>
                                </div>
                            </div>
                            <div class="row registration">
                                <div class="fourcol">
                                    <label for="Password">Password
                                        <span>Minimum 6 characters</span>
                                    </label>
                                </div>
                                <div class="fourcol last">
                                    <input type="password" name="Password" id="Password" maxlength="35"/>
                                </div>
                            </div>
                            <div class="row registration">
                                <div class="fourcol">
                                    <label for="RepeatPassword">Re-enter Password
                                    </label>
                                </div>
                                <div class="fourcol last">
                                    <input  type="password" name="RepeatPassword" id="RepeatPassword" maxlength="35"/>
                                </div>
                            </div>
                            <div class="row registration">
                                <div class="fourcol">
                                    <label for="siimage">Word Verification:
                                        <span><a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="securimage/images/refresh.png" alt="Reload Image" onclick="this.blur()" /></a>
                                            <object type="application/x-shockwave-flash" data="securimage/securimage_play.swf?audio_file=securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="32" width="32">
                                                <param name="movie" value="securimage/securimage_play.swf?audio_file=securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000"></param>
                                            </object></span>
                                    </label>
                                </div>
                                <div class="fourcol last">
                                    <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" />
                                </div>
                            </div>
                            <div class="row registration">
                                <div class="fourcol">
                                    <label for ="Captcha">Captcha:</label>
                                </div>
                                <div class="fourcol last">
                                    <input type="text" name="Captcha" id="Captcha" />
                                </div>
                            </div>
                            <div class="row centerObjects">
                                <input type="submit" name="Register" value="Proceed" class="button" />
                                <input type="reset" name="Clear" value="Clear" class="button" />
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
                  
            <?php include('footer.php'); ?>
        
    </body>
</html>