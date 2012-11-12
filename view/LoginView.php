<?php

require_once('controller/SessionManager.php');


class LoginView {

	public function validateSession() {
        $sessionManager = new SessionManager();
        
        if (isset($_SESSION['ID']) && !empty($_SESSION['ID'])) {
            if (isset($_SESSION['Admin']) && $_SESSION['Admin']) {
                echo '<a href="logout.php">Admin: Logout</a>';
            } else {
                echo '<a href="logout.php">User: Logout</a>';
            }
        }
        else
        {
        	echo '<a href="login.php" class="navbar">Login</a>';
        }
    }


}