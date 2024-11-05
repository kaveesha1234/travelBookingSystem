<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if (time() > $_SESSION['expire']) {
    session_destroy();
    header("Location: logout.php?timeout=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="icon" type="image/png" sizes="32x32" href="asserts/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }
        .inputBox {
            position: relative;
            width: calc(50% - 10px);
            margin: 10px 0;
        }
        .inputBox span {
            display: block;
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }
        .inputBox input,
        .inputBox select {
            width: 100%;
            padding: 13px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            color: #333;
            margin-top: 15px;
        }
        .inputBox small {
            position: static;
            margin-top: 5px;
            color: red;
        }
        .flex {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
        }
        .fullWidth {
            width: 100%;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="heading" style="background:url(asserts/headerbook.jpeg) no-repeat">
    <h1>book now</h1>
</div>

<!-- booking section starts -->
<section class="booking">
    <h1 class="heading-title">book your trip!</h1>
    
    <?php if (isset($_GET['emessage'])) { echo "<p class='error-message'>" . htmlspecialchars($_GET['emessage']) . "</p>"; } ?>
    <?php if (isset($_GET['smessage'])) { echo "<p class='success-message'>" . htmlspecialchars($_GET['smessage']) . "</p>"; } ?>

    <form action="book_form.php" method="post" class="book_form" id="bookingForm">
        <div class="flex">
            <div class="inputBox">
                <span>name :</span>
                <input type="text" placeholder="enter your name" name="name" required>
                <small class="error-message" id="nameError"></small>
            </div>
            <div class="inputBox">
                <span>email :</span>
                <input type="email" placeholder="enter your email" name="email" required>
                <small class="error-message" id="emailError"></small>
            </div>
            <div class="inputBox">
                <span>phone :</span>
                <input type="text" placeholder="enter your number" name="phone" required>
                <small class="error-message" id="phoneError"></small>
            </div>
            <div class="inputBox">
                <span>address :</span>
                <input type="text" placeholder="enter your address" name="address" required>
                <small class="error-message" id="addressError"></small>
            </div>
            <div class="inputBox">
                <span>select Package:</span>
                <select name="location" required>
                    <option value="">Select a Package</option>
                    <option value="Meemure">Meemure</option>
                    <option value="Kithulgala">Kithulgala</option>
                    <option value="Hikkaduwa">Hikkaduwa</option>
                    <option value="Arugam Bay">Arugam Bay</option>
                    <option value="Trinco">Trinco</option>
                       <option value="Bandarawela">Bandarawela</option>
                    <option value="Yala">Yala</option>  
                         <option value="Kosgoda">Kosgoda</option>
                    <option value="Ella">Ella</option> 
                         <option value="Jaffna">Jaffna</option>
                    <option value="Polonnaruwa">Polonnaruwa</option> 
                        <option value="Anuradhapura">Anuradhapura</option> 
                        <option value="Nilaweli">Nilaweli</option> 
                        <option value="kataragama">kataragama</option> 
                </select>
                <small class="error-message" id="locationError"></small>
            </div>
            <div class="inputBox">
                <span>how many :</span>
                <input type="number" placeholder="number of guests" name="guests" required>
                <small class="error-message" id="guestsError"></small>
            </div>
            <div class="inputBox">
                <span>arrivals :</span>
                <input type="date" name="arrivals" id="arrivals" required>
                <small class="error-message" id="arrivalsError"></small>
            </div>
            <div class="inputBox">
                <span>leaving :</span>
                <input type="date" name="leaving" id="leaving" required>
                <small class="error-message" id="leavingError"></small>
            </div>
        </div>
        <input type="submit" value="submit" class="btn fullWidth" name="send" onclick="return validateForm()">
    </form>
</section>
<!-- booking section ends -->

<?php include 'footer.php'; ?>

<!-- swiper js link -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- custom js file link -->
<script src="js/script.js"></script>

<script>
function validateField(field) {
    const input = document.getElementsByName(field)[0];
    const errorMessage = document.getElementById(field + 'Error');
    if (!input || !input.value.trim() || input.value.trim().length < 3) {
        errorMessage.textContent = field.charAt(0).toUpperCase() + field.slice(1) + ' must be at least 3 characters';
        return false;
    } else {
        errorMessage.textContent = '';
        return true;
    }
}

function validateEmail() {
    const email = document.getElementsByName('email')[0].value;
    const emailError = document.getElementById('emailError');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        emailError.textContent = 'Invalid email format';
        return false;
    } else {
        emailError.textContent = '';
        return true;
    }
}

function validatePhone() {
    const phone = document.getElementsByName('phone')[0].value;
    const phoneError = document.getElementById('phoneError');
    const phoneRegex = /^[0-9]{10}$/;
    if (!phoneRegex.test(phone)) {
        phoneError.textContent = 'Invalid phone number';
        return false;
    } else {
        phoneError.textContent = '';
        return true;
    }
}

function validateGuests() {
    const guests = document.getElementsByName('guests')[0].value;
    const guestsError = document.getElementById('guestsError');
    if (guests < 1) {
        guestsError.textContent = 'Number of guests must be at least 1';
        return false;
    } else {
        guestsError.textContent = '';
        return true;
    }
}

function validateLocation() {
    const location = document.getElementsByName('location')[0].value;
    const locationError = document.getElementById('locationError');
    if (!location) {
        locationError.textContent = 'Please select a location';
        return false;
    } else {
        locationError.textContent = '';
        return true;
    }
}

function validateDates() {
    const arrivals = document.getElementById('arrivals').value;
    const leaving = document.getElementById('leaving').value;
    const arrivalsError = document.getElementById('arrivalsError');
    const leavingError = document.getElementById('leavingError');
    
    let isValid = true;

    const today = new Date().setHours(0, 0, 0, 0); // Reset hours to avoid time comparison issues

    if (!arrivals) {
        arrivalsError.textContent = 'Arrival date is required';
        isValid = false;
    } else if (new Date(arrivals).setHours(0, 0, 0, 0) < today) {
        arrivalsError.textContent = 'Arrival should not be a past date';
        isValid = false;
    } else {
        arrivalsError.textContent = '';
    }

    if (!leaving) {
        leavingError.textContent = 'Leaving date is required';
        isValid = false;
    } else if (arrivals && new Date(leaving) < new Date(arrivals)) {
        leavingError.textContent = 'Leaving date cannot be earlier than arrival date';
        isValid = false;
    } else {
        leavingError.textContent = '';
    }

    return isValid;
}

function validateForm() {
    let isValid = true;
    const requiredFields = ['name', 'address'];

    requiredFields.forEach(function(field) {
        if (!validateField(field)) {
            isValid = false;
        }
    });

    if (!validateEmail()) isValid = false;
    if (!validatePhone()) isValid = false;
    if (!validateGuests()) isValid = false;
    if (!validateLocation()) isValid = false;
    if (!validateDates()) isValid = false;

    return isValid;
}
</script>

</body>
</html>
