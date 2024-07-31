<?php
// Database connection details
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "log_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/**
 * Execute a SQL query and return the result set.
 * 
 * @param string $sql The SQL query to be executed.
 * @param array $params (optional) The parameters to be bound to the query.
 * @return mysqli_result The result set of the query.
 */
function executeQuery($sql, $params = []) {
    global $conn;
    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    return $stmt->get_result();
}
