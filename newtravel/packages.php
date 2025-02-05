<?php
session_start();
error_reporting(0);
try {
    $dbh = new PDO("mysql:host=localhost;dbname=travel", "root", "");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Eco Friendly Travel Planner | Packages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style2.css" rel='stylesheet' type='text/css' />
</head>
<body>
    <!-- Consistent Navbar -->
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="packages.php">Packages</a>
        <a href="about.php">About</a>
        <a href="bookings.php">Bookings</a>
        <a href="logout.php">Logout</a>
        <span class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
    </div>
    <!-- Main content with banner -->
    <div class="main-content">
        <h1>Packages</h1>
        <div class="rooms">
            <div class="container">
                <div class="room-bottom">
                    <h3>Our Travel Packages</h3>
                    <?php
                    $sql = "SELECT * FROM packages";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) { ?>
                            <div class="rom-btm">
                                <div class="room-left">
                                    <img src="<?php echo htmlentities($result->PackageImage); ?>" class="img-responsive" alt="" width="300" height="200">
                                </div>
                                <div class="room-midle">
                                    <div class="package-name-price">
                                        <h4><?php echo htmlentities($result->PackageName); ?></h4>
                                        <span class="package-price">₹<?php echo htmlentities($result->PackagePrice); ?></span>
                                    </div>
                                    <p><b>Location:</b> <?php echo htmlentities($result->PackageLocation); ?></p>
                                    <p><?php echo htmlentities($result->PackageDetails); ?></p>
                                    <p><b>Green City:</b> <?php echo $result->GreenCity == 'yes' ? '✔️' : '❌'; ?></p>
                                    <p><b>Green Travel Options:</b> <?php echo $result->GreenTravelOptions == 'yes' ? '✔️' : '❌'; ?></p>
                                    <a href="package-detail.php?pkgid=<?php echo htmlentities($result->PackageId); ?>" class="book-now">Book Now</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Eco Friendly Travel Planner. All Rights Reserved.</p>
    </div>
</body>
</html>
