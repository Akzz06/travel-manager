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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['PackageName'];
    $type = $_POST['PackageType'];
    $location = $_POST['PackageLocation'];
    $price = $_POST['PackagePrice'];
    $features = $_POST['PackageFeatures'];
    $details = $_POST['PackageDetails'];
    $image = $_POST['PackageImage'];
    $greenCity = $_POST['GreenCity'];
    $greenTravel = $_POST['GreenTravelOptions'];

    $insertQuery = "INSERT INTO packages (PackageName, PackageType, PackageLocation, PackagePrice, PackageFeatures, PackageDetails, PackageImage, GreenCity, GreenTravelOptions) 
                    VALUES ('$name', '$type', '$location', '$price', '$features', '$details', '$image', '$greenCity', '$greenTravel')";

    if (mysqli_query($conn, $insertQuery)) {
        header("Location: admin_packages.php");
        exit();
    } else {
        echo "Error adding package.";
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Package</title>
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

    <!-- Main Content for Adding Packages -->
    <div class="main-content">
        <h1>Add New Package</h1>
        <form method="post">
            <label>Package Name:</label>
            <input type="text" name="PackageName" required><br>

            <label>Package Type:</label>
            <input type="text" name="PackageType" required><br>

            <label>Location:</label>
            <input type="text" name="PackageLocation" required><br>

            <label>Price:</label>
            <input type="number" name="PackagePrice" required><br>

            <label>Features:</label>
            <input type="text" name="PackageFeatures"><br>

            <label>Details:</label>
            <textarea name="PackageDetails"></textarea><br>

            <label>Image URL:</label>
            <input type="text" name="PackageImage"><br>

            <label>Green City:</label>
            <select name="GreenCity">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select><br>

            <label>Green Travel Options:</label>
            <select name="GreenTravelOptions">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select><br>

            <input type="submit" value="Add Package">
        </form>
    </div>
</body>
</html>
