<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "", "travel");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: home.php");
        exit();
    } else {
        echo "<script>
                document.getElementById('message').style.display = 'block';
                document.getElementById('message').innerText = 'Invalid username/email or password!';
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Eco Friendly Travel Planner - Login</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <h1>Eco Friendly Travel Planner</h1>
    <form method="post" action="login.php">
        Username or Email: <input type="text" name="username_or_email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <a href="forgot_password.php">Forgot Password?</a>
    
    <div class="message" id="message"></div>
</body>
</html>
