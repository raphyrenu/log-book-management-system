<?php
// Start the session
session_start();

// Include the database connection and functions
include 'includes/config.php';
include 'includes/functions.php';

// Include the header file
include 'includes/header.php';

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Retrieve the user's information
$user_id = $_SESSION["user_id"];
$sql = "SELECT username FROM user_student WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<div class="container">
    <h1>Welcome, <?php echo $user["username"]; ?>!</h1>
    <p>You can manage your logbook entries from here.</p>
    <a href="logbook.php" class="btn btn-primary">Manage Logbook</a>
    <a href="includes/auth.php?logout=1" class="btn btn-secondary">Logout</a>
</div>
<!DOCTYPE html>
<html>
<head>
    <title>Online Logbook Registry System - Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="mb-0">Recent Entries</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Activity</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                ?>
                                <tr>
                                    <td>2023-05-30</td>
                                    <td>10:00 AM</td>
                                    <td>Meeting with team</td>
                                    <td>1 hour</td>
                                </tr>
                                <tr>
                                    <td>2023-05-29</td>
                                    <td>2:30 PM</td>
                                    <td>Completed project report</td>
                                    <td>2 hours</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="mb-0">Weekly Summary</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>Total Hours</h5>
                                <h4>40 hours</h4>
                            </div>
                            <div class="col-sm-6">
                                <h5>Total Activities</h5>
                                <h4>15</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="mb-0">Monthly Summary</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>Total Hours</h5>
                                <h4>160 hours</h4>
                            </div>
                            <div class="col-sm-6">
                                <h5>Total Activities</h5>
                                <h4>60</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>

<?php
// Include the footer file
include 'includes/footer.php';
?>
