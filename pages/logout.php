<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
if (session_id()) {
    session_destroy();
}

// Redirect to login page
header('Location: login.html');
exit;
?>
