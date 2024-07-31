<?php
// Start the session
session_start();

// Include the database connection and functions
include 'includes/config.php';
include 'includes/functions.php';

// Include the header file
include 'includes/header.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Retrieve the user from the database
    $sql = "SELECT id, password FROM user_student WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        // Verify the password
        if (verifyPassword($password, $hashed_password)) {
            // Start the session and store the user ID
            $_SESSION["user_id"] = $row["id"];
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }
}
?>

<div class="container">
    <h1>Login</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" name="submit" value="Login">
    </form>
</div>

<?php
// Include the footer file
include 'includes/footer.php';
?>
