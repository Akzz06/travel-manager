<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Eco Friendly Travel Planner - Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="packages.php">Packages</a>
        <a href="about.php">About</a>
        <a href="bookings.php">Bookings</a>
        <a href="logout.php">Logout</a>
        <span class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
    </div>
    <div class="main-content">
        <h1>Welcome to the Eco Friendly Travel Planner</h1>
        <p>Embark on a journey that not only takes you to breathtaking destinations but also contributes positively to the environment. Our platform curates travel experiences that are as kind to the earth as they are to your adventurous spirit.</p>
        
        <h2>Supporting Sustainable Development Goals</h2>
        <p>Our Eco Friendly Travel Planner is dedicated to <strong>Goal 12: Responsible Consumption and Production</strong>. We’re committed to promoting sustainable travel practices and supporting local communities by:</p>
        <ul>
            <li><strong>Empowering Travelers:</strong> We provide you with the information and tools needed to make mindful choices that benefit the planet and its people.</li>
            <li><strong>Promoting Green Destinations:</strong> Highlighting eco-friendly destinations that prioritize conservation and sustainable tourism.</li>
            <li><strong>Encouraging Responsible Travel:</strong> Offering green travel options to minimize your carbon footprint and support local economies.</li>
            <li><strong>Tracking Environmental Impact:</strong> Using tools like our carbon footprint calculator to help you measure and mitigate your travel impact.</li>
        </ul>
        
        <div class="image-section">
            <div class="image-container">
                <img src="img2.jpg" alt="Eco-friendly Destination 1">
                <div class="image-text">Highlighting Eco-Friendly Destinations</div>
            </div>
            <div class="image-container">
                <img src="img3.jpg" alt="Eco-friendly Destination 2">
                <div class="image-text">Offering Green Travel Options</div>
            </div>
            <div class="image-container">
                <img src="img4.jpg" alt="Eco-friendly Destination 3">
                <div class="image-text">Adding a Carbon Footprint Calculator</div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2024 Eco Friendly Travel Planner</p>
    </div>
</body>
</html>
