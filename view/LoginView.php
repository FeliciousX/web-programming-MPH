<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/animatedcollapse.js"></script>
<script type="text/javascript" src="js/collapsible.js"></script>

<?php

class LoginView {

    public function validateShowBookingButton() {
        if (isset($_SESSION['Admin']) && $_SESSION['Admin']) {
                echo '<a class="button" href="showallbooking.php" style="height:27px; padding-top:4px;">Show All Booking</a>';
            } else {
                echo '<a href="aboutus.php" class="button" style="height:27px; padding-top:4px;">About Us</a>';
            }
    }

    public function validatePrivilegeButton() {
        
        if (isset($_SESSION['ID']) && !empty($_SESSION['ID'])) {
            if (isset($_SESSION['Admin']) && $_SESSION['Admin']) {
                echo '  <p class="topmargin3px"><a class="btnManage" href="javascript:animatedcollapse.toggle(\'isaac\')" style="text-decoration:none;">Manage Accounts</a></p>
                        <div class="threecol"></div>
                        <div class="threecol"></div>
                          <div class="twelvecol" id="isaac" style="display:none; max-height:30px;">   
                              <p style="position:absolute; z-index:50;"><a href="manage_staff.php" class="button topmargin5px">Manage Admins</a> <a href="manage_acc.php" class="button topmargin5px">Manage Users</a></p>
                          </div>
                        ';
            } else {
                echo '<a href="changepassword.php" class="button" style="height:27px; padding-top:4px;">Change Password</a>';
            }
        }
        else
        {
            echo '<a href="registration.php" class="button" style="height:27px; padding-top:4px;">Register</a>';
        }
    }

	public function validateLoginButton() {
        
        if (isset($_SESSION['ID']) && !empty($_SESSION['ID'])) {
            if (isset($_SESSION['Admin']) && $_SESSION['Admin']) {
                echo '<a href="logout.php" class="navbutton">Admin ' . $_SESSION['ID'] . ' - Logout</a>';
            } else {
                echo '<a href="logout.php" class="navbutton">ID ' . $_SESSION['ID'] . ' - Logout</a>';
            }
        }
        else
        {
        	echo '<a href="login.php" class="button" style="height:27px; padding-top:4px;">Login</a>';
        }
    }

}
?>
