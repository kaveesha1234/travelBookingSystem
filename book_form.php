<?php

$connection = mysqli_connect('fdb1029.awardspace.net', '4503303_demo', 'qz{hK}3J3WW!lL73', '4503303_demo');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $guests = $_POST['guests'];
    $arrivals = $_POST['arrivals'];
    $leaving = $_POST['leaving'];

    // Using prepared statements to prevent SQL injection
    $stmt = $connection->prepare("INSERT INTO book_form (name, email, phone, address, location, guests, arrivals, leaving) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $email, $phone, $address, $location, $guests, $arrivals, $leaving);

    if ($stmt->execute()) {
        header('Location: book.php?smessage=Successfully Booked! We will notify');
    } else {
        echo "Error: " . $stmt->error;
        header('Location: book.php?emessage=Failed to Book your Booking');
    }

    $stmt->close();
} else {
    echo 'Something went wrong, please try again.';
}


?>


