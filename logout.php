<?php
session_start();

require_once('controller/SessionManager.php');

$sessionManager = new SessionManager();

if (!$sessionManager->authenticateSession()) {
} else {
    $sessionManager->destroySession();
}

header('Location: index.php');
exit;
?>
