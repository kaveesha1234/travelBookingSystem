<?php
session_start();

include 'db.php';

if (isset($_SESSION['username'])) {
    header("Location: admin_dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
           <link rel="icon" type="image/png" sizes="32x32" href="asserts/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 400px;
            animation: fadeIn 1s ease-in-out;
            position: relative;
        }
        .login-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .login-container .password-container {
            position: relative;
        }
        .login-container .password-container input {
            padding-right: 40px; /* Adjust space for the icon */
        }
        .login-container .password-container .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px; /* Adjust size for better visibility */
            color: #333; /* Match the color of the input border */
        }
        .login-container button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            background-color: #6a11cb;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container button:hover {
            background-color: #2575fc;
        }
        .login-container button .loader {
            display: none;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #fff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 0.5s linear infinite;
            margin-right: 10px;
        }
        .login-container button.loading .loader {
            display: inline-block;
        }
        .login-container button.loading .btn-text {
            visibility: visible;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 20px;
            display: block;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <h1>Admin Login</h1>
    <?php if (!empty($error)): ?>
        <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form id="loginForm" action="admin_login.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <div class="password-container">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <i class="fas fa-eye-slash eye-icon" id="togglePassword"></i>
        </div>
        <button type="submit">
            <div class="loader"></div>
            <span class="btn-text">Login</span>
        </button>
    </form>
</div>

<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});

document.getElementById('loginForm').addEventListener('submit', function() {
    const submitButton = this.querySelector('button');
    submitButton.classList.add('loading');
});
</script>

</body>
</html>
