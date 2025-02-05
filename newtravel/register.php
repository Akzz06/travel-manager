<!DOCTYPE html>
<html>
<head>
    <title>Eco Friendly Travel Planner - Register</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <h1>Eco Friendly Travel Planner</h1>
    <form method="post" action="register.php">
        Username: <input type="text" name="username" required><br>
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Register">
    </form>
    <a href="login.php">Already have an account? Log in here.</a>
    
    <div class="message" id="message"></div>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $conn = new mysqli("localhost", "root", "", "travel");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check for duplicate username or email
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>
                    document.getElementById('message').style.display = 'block';
                    document.getElementById('message').innerText = 'Username or email already exists!';
                  </script>";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);

            if ($stmt->execute()) {
                echo "<script>
                        document.getElementById('message').style.display = 'block';
                        document.getElementById('message').innerText = 'Registration successful!';
                      </script>";
            } else {
                echo "<script>
                        document.getElementById('message').style.display = 'block';
                        document.getElementById('message').innerText = 'Registration failed. Please try again.';
                      </script>";
            }
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
