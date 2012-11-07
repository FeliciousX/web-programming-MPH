<?php
session_start();

require_once('config.php');
require_once('View/RegistrationView.php');
require_once('securimage/securimage.php');


$registrationView = new RegistrationView();
$registrationView->validateSession();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Register | Swinburne MPH Booking </title>

    </head>
    <body>
    
                <h2>Registration Form</h2>
        
                    <h2>
                        Login
                   
                        <form action="registration.php" method="post">
                            <fieldset>
                                <legend>Login</legend>
                                <?php $registrationView->validateLoginData(); ?>
                                <p>Already have an account? Log in here !</p>
                                <p>
                                    <label>Student ID: </label>
                                    <input type="text" name="Username" />
                                </p>
                                <p>
                                    <label>Password: </label>
                                    <input type="password" name="Password" />
                                </p>
                                <input type="submit" name="Login" value="Login" />
                                <p><a href="forget_password.php">Forget Password</a></p>
                            </fieldset>
                        </form>					
                   
                    <h2>
                        Registration Form
                    </h2>
                    
                        <form action="registration.php" method="post">
                            <fieldset>
                                <legend>Login Information</legend>
                                <?php $registrationView->validateRegistrationData(); ?>
                                

                                    <label for="Username">Username
                                        <span>Student ID</span>
                                    </label>
                                    <input type="text" name="Username" id="Username" maxlength="15"/>

                                    <label for="FirstName">First Name
                                        <span>Given Name</span>
                                    </label>
                                    <input type="text" name="FirstName" id="FirstName" maxlength="35"/>

                                    <label for="LastName">Last Name
                                        <span>Surname/Family Name</span>
                                    </label>
                                    <input type="text" name="LastName" id="LastName" maxlength="35"/>

                                    <label for="Password">Password
                                        <span>Minimum 8 characters</span>
                                    </label>
                                    <input type="password" name="Password" id="Password" maxlength="35"/>

                                    <label for="RepeatPassword">Re-enter Password</label>
                                    <input  type="password" name="RepeatPassword" id="RepeatPassword" maxlength="35"/>

                                    <label for="siimage">Word Verification:
                                        <br /><span><a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="securimage/images/refresh.png" alt="Reload Image" onclick="this.blur()" /></a></span>
                                        <span><object type="application/x-shockwave-flash" data="securimage/securimage_play.swf?audio_file=securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="32" width="32">
                                                <param name="movie" value="securimage/securimage_play.swf?audio_file=securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000"></param>
                                            </object></span>
                                    </label>

                                    <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" />

                                    <label for ="Captcha">Captcha:</label>

                                    <input type="text" name="Captcha" id="Captcha" />
                                
                                <input type="submit" name="Register" value="Proceed" />
                                <input type="reset" name="Clear" value="Clear" />
                            </fieldset>
                        </form>

                  
            <?php include('footer.php'); ?>
        
    </body>
</html>