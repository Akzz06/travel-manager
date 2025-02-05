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

$packageId = intval($_GET['pkgid']);

// Booking form submission handling
if (isset($_POST['book'])) {
    $username = $_SESSION['username'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    // Validate dates
    if ($toDate < $fromDate) {
        echo "<script>alert('End date must be later than start date.');</script>";
    } else {
        // Insert booking details
        $sql = "INSERT INTO booking (packageId, username, fromDate, toDate) VALUES (:packageId, :username, :fromDate, :toDate)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':packageId', $packageId, PDO::PARAM_INT);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':fromDate', $fromDate, PDO::PARAM_STR);
        $query->bindParam(':toDate', $toDate, PDO::PARAM_STR);
        if ($query->execute()) {
            echo "<script>alert('Package booked successfully!');</script>";
        } else {
            echo "<script>alert('Error: Unable to book the package. Please try again later.');</script>";
        }
    }
}

// Fetch package details
$sql = "SELECT * FROM packages WHERE PackageId = :packageId";
$query = $dbh->prepare($sql);
$query->bindParam(':packageId', $packageId, PDO::PARAM_INT);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eco Friendly Travel Planner | Package Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style3.css" rel="stylesheet" type="text/css" />
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
    <!-- Main Content -->
    <div class="main-content">
        <h1><?php echo htmlentities($result->PackageName); ?></h1>
        <div class="package-details">
            <img src="<?php echo htmlentities($result->PackageImage); ?>" alt="Package Image" class="package-image">
            <div class="package-info">
                <p><b>Location:</b> <?php echo htmlentities($result->PackageLocation); ?></p>
                <p><b>Price:</b> ₹<?php echo htmlentities($result->PackagePrice); ?></p>
                <p><b>Features:</b> <?php echo htmlentities($result->PackageFeatures); ?></p>
                <p><?php echo htmlentities($result->PackageDetails); ?></p>
                <p><b>Green City:</b> <?php echo $result->GreenCity == 'yes' ? '✔️' : '❌'; ?></p>
                <p><b>Green Travel Options:</b> <?php echo $result->GreenTravelOptions == 'yes' ? '✔️' : '❌'; ?></p>
            </div>
        </div>
        <!-- Booking Form -->
        <div class="booking-form">
            <h2>Book This Package</h2>
            <form method="post">
                <label for="fromDate">From Date:</label><br>
                <input type="date" id="fromDate" name="fromDate" required><br>
                <label for="toDate">To Date:</label><br>
                <input type="date" id="toDate" name="toDate" required><br>
                <input type="submit" name="book" value="Book Now">
            </form>
        </div>
    </div>
    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Eco Friendly Travel Planner. All Rights Reserved.</p>
    </div>
</body>
</html>
