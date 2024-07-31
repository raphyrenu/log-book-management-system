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

// Handle form submission for creating a new logbook entry
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entry_date = $_POST["entry_date"];
    $entry_time = $_POST["entry_time"];
    $days = $_POST["days"];
    $week = $_POST["week"];
    $activity_description = $_POST["activity_description"];
    $working_hour = $_POST["working_hour"];
    $user_id = getCurrentUserId();

    $sql = "INSERT INTO log_entries (entry_date, entry_time, days, week, activity_description, working_hour, user_id, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssissi", $entry_date, $entry_time, $days, $week, $activity_description, $working_hour, $user_id);
    if ($stmt->execute()) {
        echo "Logbook entry created successfully!";
    } else {
        echo "Error creating logbook entry: " . $conn->error;
    }
}

// Retrieve the user's logbook entries
$user_id = getCurrentUserId();
$sql = "SELECT * FROM log_entries WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Logbook Registry System - Logbook</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Logbook Management</h1>

        <div class="mb-4">
            <h2 class="mb-3">Create New Entry</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <label for="entry_date">Entry Date:</label>
                    <input type="date" class="form-control" id="entry_date" name="entry_date" required>
                </div>
                <div class="form-group">
                    <label for="entry_time">Entry Time:</label>
                    <input type="time" class="form-control" id="entry_time" name="entry_time" required>
                </div>
                <div class="form-group">
                    <label for="days">Days:</label>
                    <input type="text" class="form-control" id="days" name="days" required>
                </div>
                <div class="form-group">
                    <label for="week">Week:</label>
                    <input type="number" class="form-control" id="week" name="week" required>
                </div>
                <div class="form-group">
                    <label for="activity_description">Activity Description:</label>
                    <textarea class="form-control" id="activity_description" name="activity_description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="working_hour">Working Hour:</label>
                    <input type="number" step="0.01" class="form-control" id="working_hour" name="working_hour" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Create Entry</button>
            </form>
        </div>

        <h2 class="mb-3">Logbook Entries</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Entry Date</th>
                        <th>Entry Time</th>
                        <th>Days</th>
                        <th>Week</th>
                        <th>Activity Description</th>
                        <th>Working Hour</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["entry_date"]; ?></td>
                        <td><?php echo $row["entry_time"]; ?></td>
                        <td><?php echo $row["days"]; ?></td>
                        <td><?php echo $row["week"]; ?></td>
                        <td><?php echo $row["activity_description"]; ?></td>
                        <td><?php echo $row["working_hour"]; ?></td>
                        <td>
                            <a href="edit_logbook.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete_logbook.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>




<?php
// Include the footer file
include 'includes/footer.php';
?>
