<?php
/**
 * Hash a password using the bcrypt algorithm.
 * 
 * @param string $password The password to be hashed.
 * @return string The hashed password.
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Verify a password against a hashed password.
 * 
 * @param string $password The password to be verified.
 * @param string $hashed_password The hashed password to compare against.
 * @return bool True if the password is valid, false otherwise.
 */
function verifyPassword($password, $hashed_password) {
    return password_verify($password, $hashed_password);
}
