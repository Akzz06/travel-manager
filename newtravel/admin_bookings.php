<?php
session_start();
error_reporting(0);

// Database connection
$conn = mysqli_connect("localhost", "root", "", "travel");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the admin is logged in
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings</title>
    <link href="style2.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="admin_packages.php">Manage Packages</a>
        <a href="admin_bookings.php">Manage Bookings</a>
        <a href="admin_users.php">Manage Users</a>
        <a href="admin_dashboard.php?logout=true">Logout</a>
    </div>

    <!-- Main Content for Managing Bookings -->
    <div class="main-content">
        <h1>Manage Bookings</h1>
        <table border="1">
            <tr>
                <th>Booking ID</th>
                <th>Package Name</th>
                <th>Username</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Actions</th>
            </tr>
            <?php
            // Fetch all bookings with package details using the correct table name
            $query = "
                SELECT b.bookingId, b.packageId, b.username, b.fromDate, b.toDate, p.PackageName 
                FROM booking b 
                INNER JOIN packages p ON b.packageId = p.PackageId
            ";
            $result = mysqli_query($conn, $query);

            // Display each booking
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['bookingId']}</td>
                        <td>{$row['PackageName']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['fromDate']}</td>
                        <td>{$row['toDate']}</td>
                        <td><a href='admin_bookings.php?delete_id={$row['bookingId']}' onclick='return confirm(\"Are you sure?\");'>Delete</a></td>
                    </tr>";
            }

            // Delete booking if requested
            if (isset($_GET['delete_id'])) {
                $bookingId = intval($_GET['delete_id']);
                $deleteQuery = "DELETE FROM booking WHERE bookingId = $bookingId";
                mysqli_query($conn, $deleteQuery);
                header("Location: admin_bookings.php");
                exit();
            }
            
            mysqli_close($conn);
            ?>
        </table>
    </div>
</body>
</html>
