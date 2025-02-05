<!DOCTYPE html>
<html>
<head>
    <title>Eco Friendly Travel Planner - Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <h1>Eco Friendly Travel Planner</h1>
    <form method="post" action="forgot_password.php">
        Email or Username: <input type="text" name="username_or_email" required><br>
        Old Password: <input type="password" name="old_password" required><br>
        New Password: <input type="password" name="new_password" required><br>
        <input type="submit" value="Reset Password">
    </form>
    <a href="login.php">Remembered your password? Log in here.</a>
    
    <div class="message" id="message"></div>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username_or_email = $_POST['username_or_email'];
        $old_password = $_POST['old_password'];
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        $conn = new mysqli("localhost", "root", "", "travel");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username_or_email, $username_or_email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($old_password, $user['password'])) {
            $stmt = $conn->prepare("UPDATE users SET password=? WHERE username=? OR email=?");
            $stmt->bind_param("sss", $new_password, $username_or_email, $username_or_email);

            if ($stmt->execute()) {
                echo "<script>
                        document.getElementById('message').style.display = 'block';
                        document.getElementById('message').innerText = 'Password reset successful!';
                      </script>";
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "<script>
                    document.getElementById('message').style.display = 'block';
                    document.getElementById('message').innerText = 'Invalid username/email or old password!';
                  </script>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
