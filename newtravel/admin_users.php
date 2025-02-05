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

// Delete a user if requested
if (isset($_GET['delete_id'])) {
    $userId = intval($_GET['delete_id']);
    $deleteQuery = "DELETE FROM users WHERE id = $userId";
    mysqli_query($conn, $deleteQuery);
    header("Location: admin_users.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
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

    <!-- Main Content for Managing Users -->
    <div class="main-content">
        <h1>Manage Users</h1>
        <a href="add_user.php" class="button">Add New User</a>
        <table border="1">
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Registration Date</th>
                <th>Actions</th>
            </tr>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM users");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['registration_date']}</td>
                        <td>
                            <a href='admin_users.php?delete_id={$row['id']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                        </td>
                    </tr>";
            }
            mysqli_close($conn);
            ?>
        </table>
    </div>
</body>
</html>
