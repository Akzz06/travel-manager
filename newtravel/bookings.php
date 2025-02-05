<?php
session_start();
error_reporting(0);
try {
    $dbh = new PDO("mysql:host=localhost;dbname=travel", "root", "");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch user bookings
$sql = "SELECT b.BookingId, b.PackageId, p.PackageName, b.FromDate, b.ToDate, p.PackagePrice 
        FROM booking b 
        JOIN packages p ON b.PackageId = p.PackageId 
        WHERE b.Username = :username";
$query = $dbh->prepare($sql);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eco Friendly Travel Planner | My Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style4.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="packages.php">Packages</a>
        <a href="about.php">About</a>
        <a href="bookings.php">Bookings</a>
        <a href="logout.php">Logout</a>
        <span class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
    </div>
    <!-- Main content -->
    <div class="main-content">
        <h1>My Bookings</h1>
        <div class="bookings">
            <table>
                <thead>
                    <tr>
                        <th>Package ID</th>
                        <th>Package Name</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Fare</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $totalFare = 0;
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) { ?>
                        <tr>
                            <td><?php echo htmlentities($result->PackageId); ?></td>
                            <td><?php echo htmlentities($result->PackageName); ?></td>
                            <td><?php echo htmlentities($result->FromDate); ?></td>
                            <td><?php echo htmlentities($result->ToDate); ?></td>
                            <td>₹<?php echo htmlentities($result->PackagePrice); ?></td>
                        </tr>
                    <?php $totalFare += $result->PackagePrice; }
                } ?>
                <tr>
                    <td colspan="4" style="text-align: right;"><strong>Grand Total</strong></td>
                    <td><strong>₹<?php echo $totalFare; ?></strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Eco Friendly Travel Planner. All Rights Reserved.</p>
    </div>
</body>
</html>
