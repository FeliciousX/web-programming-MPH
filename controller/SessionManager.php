<?php

/**
 * Description of SessionManager
 *
 * @author 
 * @version 2012-11-09
 * @package controller
 */
class SessionManager {

    private $USERPATH = "/user";
    private $ADMINPATH = "/";


    private static function regenerateSession() {
        // If this session is obsolete it means there already is a new id
        if (isset($_SESSION['OBSOLETE']) || $_SESSION['OBSOLETE'] == true) {
            return;
        }

        // Set current session to expire in 10 seconds
        $_SESSION['OBSOLETE'] = true;
        $_SESSION['EXPIRES'] = time() + 10;

        // Create new session without destroying the old one
        session_regenerate_id(false);

        // Grab current session ID and close both sessions to allow other scripts to use them
        $newSession = session_id();
        session_write_close();

        // Set session ID to the new one, and start it back up again
        session_id($newSession);
        session_start();

        // Now we unset the obsolete and expiration values for the session we want to keep
        unset($_SESSION['OBSOLETE']);
        unset($_SESSION['EXPIRES']);
    }

    public function validateSession() {
        if (!isset($_SESSION['OBSOLETE']) && !isset($_SESSION['EXPIRES'])) {
            return FALSE;
        }

        if (!isset($_SESSION['EXPIRES']) && $_SESSION['EXPIRES'] < time()) {
            return FALSE;
        }

        return TRUE;
    }

    private function createUserSession($studentID) {
        $_SESSION['ID'] = $studentID;
    }

    private function createAdminSession($staffID, $superAdminStatus) {
        $_SESSION['ID'] = $staffID;
        $_SESSION['Admin'] = TRUE;
        $_SESSION['SuperAdmin'] = $superAdminStatus;
    }

    public function startSession($name, $userType, $id, $superAdminStatus, $domain = null, $secureHttp = false, $http = false) {

        session_start();

        (($userType == 0) ? $this->createUserSession($id) : $this->createAdminSession($id, $superAdminStatus));


    }

    public function authenticateSession() {
        if (isset($_SESSION['ID']) && !empty($_SESSION['ID'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function authenticateReservationSession() {
        if (isset($_SESSION['RESERVE_TODAY']) && $_SESSION['RESERVE_TODAY']) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function authenticateAdminSession() {
        if (isset($_SESSION['Admin']) && !empty($_SESSION['Admin'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function authenticateSuperAdminSession() {
        if (isset($_SESSION['SuperAdmin']) && !empty($_SESSION['SuperAdmin'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function destroySession() {
        $_SESSION = array();
        session_unset();
        session_destroy();
    }

}

?>
