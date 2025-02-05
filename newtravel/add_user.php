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

// Handle form submission for adding a user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $insertQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    
    if (mysqli_query($conn, $insertQuery)) {
        header("Location: admin_users.php");
        exit();
    } else {
        echo "Error adding user.";
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
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

    <!-- Main Content for Adding a User -->
    <div class="main-content">
        <h1>Add New User</h1>
        <form method="post">
            <label>Username:</label>
            <input type="text" name="username" required><br>

            <label>Email:</label>
            <input type="email" name="email" required><br>

            <label>Password:</label>
            <input type="password" name="password" required><br>

            <input type="submit" value="Add User">
        </form>
    </div>
</body>
</html>
