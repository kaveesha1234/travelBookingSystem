<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Server-side validation is now limited to non-password matching checks.
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registration successful, please log in.";
        $_SESSION['message_type'] = "success";
        header("Location: index.php");
        exit;
    } else {
        if ($conn->errno === 1062) {
            $_SESSION['message'] = "Username already exists. Please choose a different username.";
            $_SESSION['message_type'] = "error";
        } else {
            $_SESSION['message'] = "An error occurred. Please try again later.";
            $_SESSION['message_type'] = "error";
        }
    }
    $stmt->close();
}

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : '';
unset($_SESSION['message']);
unset($_SESSION['message_type']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
     <link rel="icon" type="image/png" sizes="32x32" href="asserts/logo.png">
        
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if (!empty($message)) { ?>
            <div class="alert alert-<?php echo $message_type; ?>">
                <?php echo $message; ?>
                <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        <?php } ?>
        <form action="" method="post" id="registerForm">
            <div class="input-container">
                <input type="text" name="username" id="username" placeholder="Username" required>

                <small class="error-message" id="usernameError"></small>
            </div>
            <div class="input-container">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('password')"></i>
                <small class="error-message" id="passwordError"></small>
            </div>
            <div class="input-container">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('confirm_password')"></i>
                <small class="error-message" id="confirmPasswordError"></small>
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="index.php">Login</a></p>
        <div class="password-requirements">
            <p>Password must have:</p>
            <ul>
                <li id="minLength" class="requirement"><i class="fas fa-times-circle"></i> At least 6 characters</li>
                <li id="capitalLetter" class="requirement"><i class="fas fa-times-circle"></i> At least one capital letter</li>
                <li id="number" class="requirement"><i class="fas fa-times-circle"></i> At least one number</li>
                <li id="specialChar" class="requirement"><i class="fas fa-times-circle"></i> At least one special character</li>
            </ul>
        </div>
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

    function validateUsername() {
        var username = document.getElementById('username').value;
        var usernameTick = document.getElementById('usernameTick');
        var usernameError = document.getElementById('usernameError');
        if (username.length >= 3) {
            usernameTick.style.color = 'green';
            usernameError.textContent = '';
        } else {
            usernameTick.style.color = 'red';
            usernameError.textContent = 'Username must be at least 3 characters long';
        }
    }

    function validatePassword() {
        var password = document.getElementById('password').value;
        var minLength = document.getElementById('minLength');
        var capitalLetter = document.getElementById('capitalLetter');
        var number = document.getElementById('number');
        var specialChar = document.getElementById('specialChar');
        var passwordError = document.getElementById('passwordError');

        var minLengthValid = password.length >= 6;
        var capitalLetterValid = /[A-Z]/.test(password);
        var numberValid = /\d/.test(password);
        var specialCharValid = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        setRequirementStyle(minLength, minLengthValid);
        setRequirementStyle(capitalLetter, capitalLetterValid);
        setRequirementStyle(number, numberValid);
        setRequirementStyle(specialChar, specialCharValid);

        if (minLengthValid && capitalLetterValid && numberValid && specialCharValid) {
            passwordError.textContent = '';
        } else {
            passwordError.textContent = 'Password must meet all requirements';
        }

        validateConfirmPassword();
    }

    function setRequirementStyle(element, isValid) {
        var icon = element.querySelector('i');
        if (isValid) {
            element.classList.add('valid');
            element.classList.remove('invalid');
            icon.classList.add('fa-check-circle');
            icon.classList.remove('fa-times-circle');
        } else {
            element.classList.add('invalid');
            element.classList.remove('valid');
            icon.classList.add('fa-times-circle');
            icon.classList.remove('fa-check-circle');
        }
    }

    function validateConfirmPassword() {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm_password').value;
        var confirmPasswordTick = document.getElementById('confirmPasswordTick');
        var confirmPasswordError = document.getElementById('confirmPasswordError');
        if (confirmPassword === password && confirmPassword.length >= 6) {
            confirmPasswordTick.style.color = 'green';
            confirmPasswordError.textContent = '';
        } else {
            confirmPasswordTick.style.color = 'red';
            confirmPasswordError.textContent = 'Passwords do not match';
        }
    }

    document.getElementById('username').addEventListener('input', validateUsername);
    document.getElementById('password').addEventListener('input', validatePassword);
    document.getElementById('confirm_password').addEventListener('input', validateConfirmPassword);

    document.getElementById('registerForm').addEventListener('submit', function(event) {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm_password').value;
        var confirmPasswordError = document.getElementById('confirmPasswordError');

        if (confirmPassword !== password) {
            event.preventDefault();
            confirmPasswordError.textContent = 'Passwords do not match';
        } else {
            var button = this.querySelector('button');
            button.disabled = true;
            button.classList.add('loading');
        }
    });
    </script>
</body>
</html>
