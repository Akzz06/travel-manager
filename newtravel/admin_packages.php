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

// Delete a package if requested
if (isset($_GET['delete_id'])) {
    $packageId = intval($_GET['delete_id']);
    $deleteQuery = "DELETE FROM packages WHERE PackageId = $packageId";
    mysqli_query($conn, $deleteQuery);
    header("Location: admin_packages.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Packages</title>
    <link href="style2.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="navbar">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="admin_packages.php">Manage Packages</a>
        <a href="admin_bookings.php">Manage Bookings</a>
        <a href="admin_users.php">Manage Users</a>
        <a href="admin_dashboard.php?logout=true">Logout</a>
    </div>

    <div class="main-content">
        <h1>Manage Packages</h1>
        <a href="add_package.php" class="button">Add New Package</a>
        <table border="1">
            <tr>
                <th>Package ID</th>
                <th>Package Name</th>
                <th>Type</th>
                <th>Location</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM packages");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['PackageId']}</td>
                        <td>{$row['PackageName']}</td>
                        <td>{$row['PackageType']}</td>
                        <td>{$row['PackageLocation']}</td>
                        <td>{$row['PackagePrice']}</td>
                        <td>
                            <a href='admin_packages.php?delete_id={$row['PackageId']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                        </td>
                    </tr>";
            }
            mysqli_close($conn);
            ?>
        </table>
    </div>
</body>
</html>
