<?php
session_start();
session_destroy();

if (isset($_GET['timeout'])) {
    $message = "Session timed out. Please login again.";
} else {
    $message = "You have been logged out.";
}

header("Location: admin_login.php?message=" . urlencode($message));
exit;
?>
