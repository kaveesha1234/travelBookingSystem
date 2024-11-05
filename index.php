<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (4 * 60); // 4 minute
        header("Location: home.php");
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <link rel="icon" type="image/png" sizes="32x32" href="asserts/logo.png">
        
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($error)) { echo "<div class='alert alert-error'>$error <span class='close-btn' onclick='this.parentElement.style.display=\"none\";'>&times;</span></div>"; } ?>
        <?php if (isset($_GET['message'])) { echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['message']) . "<span class='close-btn' onclick='this.parentElement.style.display=\"none\";'>&times;</span></div>"; } ?>
        <form action="" method="post" id="loginForm">
            <div class="input-container">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <small class="error-message" id="usernameError"></small>
            </div>
            <div class="input-container">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('password')"></i>
                <small class="error-message" id="passwordError"></small>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
    <script>
    function togglePasswordVisibility(id) {
        var passwordField = document.getElementById(id);
        var eyeIcon = passwordField.nextElementSibling;
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }

    document.querySelector('form').addEventListener('submit', function(event) {
        var button = this.querySelector('button');
        button.disabled = true;
        button.classList.add('loading');
    });
    </script>
</body>
</html>
