<?php
// Start the session
session_start();

// Include the database connection and functions
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/auth.php';

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

// Handle the deletion of the logbook entry
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM log_entries WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $entry_id, $user_id);
    if ($stmt->execute()) {
        header("Location: logbook.php");
        exit;
    } else {
        echo "Error deleting logbook entry: " . $conn->error;
    }
}
?>

<div class="container">
    <h1>Delete Logbook Entry</h1>
    <p>Are you sure you want to delete the following logbook entry?</p>
    <table>
        <tr>
            <th>Entry Date</th>
            <td><?php echo $entry["entry_date"]; ?></td>
        </tr>
        <tr>
            <th>Entry Time</th>
            <td><?php echo $entry["entry_time"]; ?></td>
        </tr>
        <tr>
            <th>Days</th>
            <td><?php echo $entry["days"]; ?></td>
        </tr>
        <tr>
            <th>Week</th>
            <td><?php echo $entry["week"]; ?></td>
        </tr>
        <tr>
            <th>Activity Description</th>
            <td><?php echo $entry["activity_description"]; ?></td>
        </tr>
        <tr>
            <th>Working Hour</th>
            <td><?php echo $entry["working_hour"]; ?></td>
        </tr>
    </table>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $entry_id;?>">
        <input type="submit" name="submit" value="Delete" class="btn btn-danger">
    </form>
</div>
