<?php
// Start the session
session_start();

// Include the database connection and functions
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/auth.php';

// Include the header file
include 'includes/header.php';

// Check if the user is logged in
if (!isLoggedIn()) {
    header("Location: login.php");
    exit;
}

// Get the logbook entry ID from the URL
$entry_id = $_GET["id"];

// Retrieve the logbook entry details
$user_id = getCurrentUserId();
$sql = "SELECT * FROM log_entries WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $entry_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$entry = $result->fetch_assoc();

// Handle form submission for updating the logbook entry
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entry_date = $_POST["entry_date"];
    $entry_time = $_POST["entry_time"];
    $days = $_POST["days"];
    $week = $_POST["week"];
    $activity_description = $_POST["activity_description"];
    $working_hour = $_POST["working_hour"];

    $sql = "UPDATE log_entries SET entry_date = ?, entry_time = ?, days = ?, week = ?, activity_description = ?, working_hour = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssissi", $entry_date, $entry_time, $days, $week, $activity_description, $working_hour, $entry_id, $user_id);
    if ($stmt->execute()) {
        echo "Logbook entry updated successfully!";
    } else {
        echo "Error updating logbook entry: " . $conn->error;
    }
}
?>

<div class="container">
    <h1>Edit Logbook Entry</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $entry_id;?>">
        Entry Date: <input type="date" name="entry_date" value="<?php echo $entry["entry_date"]; ?>" required><br>
        Entry Time: <input type="time" name="entry_time" value="<?php echo $entry["entry_time"]; ?>" required><br>
        Days: <input type="text" name="days" value="<?php echo $entry["days"]; ?>" required><br>
        Week: <input type="number" name="week" value="<?php echo $entry["week"]; ?>" required><br>
        Activity Description: <textarea name="activity_description" required><?php echo $entry["activity_description"]; ?></textarea><br>
        Working Hour: <input type="number" step="0.01" name="working_hour" value="<?php echo $entry["working_hour"]; ?>" required><br>
        <input type="submit" name="submit" value="Update Entry">
    </form>
</div>

<?php
// Include the footer file
include 'includes/footer.php';
?>
