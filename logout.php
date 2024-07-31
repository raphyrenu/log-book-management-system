<?php
// Start the session
session_start();

// Include the authentication functions
include 'includes/auth.php';

// Check if the user is logged in
if (isLoggedIn()) {
    // Destroy the session and all session data
    session_unset();
    session_destroy();
}

// Redirect the user to the login page
header("Location: login.php");
exit;
