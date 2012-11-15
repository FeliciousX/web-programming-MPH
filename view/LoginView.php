<?php

require_once('controller/SessionManager.php');


class LoginView {

    public function validatePrivilegeButton() {
        $sessionManager = new SessionManager();
        
        if (isset($_SESSION['ID']) && !empty($_SESSION['ID'])) {
            if (isset($_SESSION['Admin']) && $_SESSION['Admin']) {
                echo '<a href="admin/manage_staff.php">Manage Accounts</a>';
            } else {
                echo '<a href="user_profile.php">View Profile</a>';
            }
        }
        else
        {
            echo '<a href="registration.php" class="navbar">Register</a>';
        }
    }

	public function validateLoginButton() {
        $sessionManager = new SessionManager();
        
        if (isset($_SESSION['ID']) && !empty($_SESSION['ID'])) {
            if (isset($_SESSION['Admin']) && $_SESSION['Admin']) {
                echo '<a href="logout.php">Admin ' . $_SESSION['ID'] . ': Logout</a>';
            } else {
                echo '<a href="logout.php">ID ' . $_SESSION['ID'] . ': Logout</a>';
            }
        }
        else
        {
        	echo '<a href="login.php" class="navbar">Login</a>';
        }
    }


}