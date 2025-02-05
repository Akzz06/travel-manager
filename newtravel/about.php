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
    <title>Eco Friendly Travel Planner - About</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
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
        <h1>Why Choose Eco-Friendly Destinations and Green Travel Options?</h1>
        
        <h2>Eco-Friendly Destinations</h2>
        <p>Eco-friendly destinations prioritize environmental conservation, protecting local ecosystems and wildlife. Visiting these locations supports responsible tourism, which helps to preserve natural habitats and promotes sustainable practices that benefit local communities.</p>
        <div class="image-section">
            <div class="image-container">
                <img src="img2.jpg" alt="Eco-friendly Destination">
                <div class="image-text">Supporting Conservation Efforts</div>
            </div>
        </div>

        <h2>Green Travel Options</h2>
        <p>Choosing green travel options such as public transport, cycling, or walking minimizes your carbon footprint. Many eco-friendly destinations offer low-emission transportation, making it easy to explore without harming the environment.</p>
        <div class="image-section">
            <div class="image-container">
                <img src="img3.jpg" alt="Green Travel Options">
                <div class="image-text">Promoting Low-Emission Transportation</div>
            </div>
        </div>
        
        <h2>Responsible Travel Benefits Everyone</h2>
        <p>Eco-friendly travel encourages mindfulness, sustainability, and respect for the planet. By opting for green travel options, travelers can enjoy unique experiences while ensuring that future generations can do the same.</p>
        <div class="image-section">
            <div class="image-container">
                <img src="img4.jpg" alt="Responsible Travel">
                <div class="image-text">Creating Sustainable Experiences for All</div>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>&copy; 2024 Eco Friendly Travel Planner</p>
    </div>
</body>
</html>
