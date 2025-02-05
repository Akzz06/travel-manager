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

// Admin logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin_login.php");
    exit();
}

// Fetching the total counts
$totalUsersQuery = "SELECT COUNT(*) AS totalUsers FROM users";
$totalUsersResult = mysqli_query($conn, $totalUsersQuery);
$totalUsers = mysqli_fetch_assoc($totalUsersResult)['totalUsers'];

$totalPackagesQuery = "SELECT COUNT(*) AS totalPackages FROM packages";
$totalPackagesResult = mysqli_query($conn, $totalPackagesQuery);
$totalPackages = mysqli_fetch_assoc($totalPackagesResult)['totalPackages'];

$totalBookingsQuery = "SELECT COUNT(*) AS totalBookings FROM booking";
$totalBookingsResult = mysqli_query($conn, $totalBookingsQuery);
$totalBookings = mysqli_fetch_assoc($totalBookingsResult)['totalBookings'];

mysqli_close($conn);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eco Friendly Travel Planner | Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <!-- Main Content -->
    <div class="main-content">
        <h1>Admin Dashboard</h1>
        <p>Welcome to the admin dashboard. Use the links below to manage different sections:</p>
        
        <!-- Links to Management Pages -->
        <ul>
            <li><a href="admin_packages.php">Manage Packages</a></li>
            <li><a href="admin_bookings.php">Manage Bookings</a></li>
            <li><a href="admin_users.php">Manage Users</a></li>
        </ul>

        <!-- Statistics Section -->
        <div class="statistics">
            <h2>Website Statistics</h2>
            <table border="1">
                <tr>
                    <th>Total Users</th>
                    <td><?php echo $totalUsers; ?></td>
                </tr>
                <tr>
                    <th>Total Packages</th>
                    <td><?php echo $totalPackages; ?></td>
                </tr>
                <tr>
                    <th>Total Bookings</th>
                    <td><?php echo $totalBookings; ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
