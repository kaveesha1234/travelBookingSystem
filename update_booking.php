<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit;
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $status = $_POST['status'];

    if ($status === 'Cancelled') {
        // Remove booking from book_form and add notification
        $deleteSql = "DELETE FROM book_form WHERE id = ?";
        $stmt = $conn->prepare($deleteSql);
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();

        // Add notification
        $notificationMessage = "Booking ID $booking_id has been cancelled.";
        $notificationSql = "INSERT INTO notifications (booking_id, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($notificationSql);
        $message = $notificationMessage;
        $stmt->bind_param("iss", $booking_id, $email, $message);
        $stmt->execute();
    } else {
        // Update status
        $updateSql = "UPDATE book_form SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("si", $status, $booking_id);
        $stmt->execute();

        // Add notification for status change
        $notificationMessage = "Booking ID $booking_id status changed to $status.";
        $notificationSql = "INSERT INTO notifications (booking_id, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($notificationSql);
        $stmt->bind_param("iss", $booking_id, $email, $notificationMessage);
        $stmt->execute();
    }

    $conn->close();
    header("Location: bookings.php");
    exit;
}
?>
