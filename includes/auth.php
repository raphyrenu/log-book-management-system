<?php
// Only start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the isLoggedIn() function is not already defined
if (!function_exists('isLoggedIn')) {
    /**
     * Check if the user is logged in.
     * 
     * @return bool True if the user is logged in, false otherwise.
     */
    function isLoggedIn() {
        return isset($_SESSION["user_id"]);
    }
}

// Check if the getCurrentUserId() function is not already defined
if (!function_exists('getCurrentUserId')) {
    /**
     * Get the current user's ID.
     * 
     * @return int The current user's ID, or 0 if the user is not logged in.
     */
    function getCurrentUserId() {
        return isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 0;
    }
}
