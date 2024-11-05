<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit;
}

if (time() > $_SESSION['expire']) {
    session_destroy();
    header("Location: admin_login.php?timeout=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" sizes="32x32" href="asserts/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .dashboard-container {
            padding: 20px;
        }
        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .dashboard-content {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .dashboard-card {
            width: 250px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            background-color: white;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .dashboard-card h2 {
            margin-bottom: 10px;
            font-size: 20px;
            color: #333;
        }
        .dashboard-card p {
            margin-bottom: 20px;
            color: #777;
        }
        .dashboard-card a.btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #6a11cb;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .dashboard-card a.btn:hover {
            background-color: #2575fc;
        }
    </style>
</head>
<body>

<?php include 'admin_navbar.php'; ?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Welcome to Admin Dashboard</h1>
        <p>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    </div>
    <div class="dashboard-content">
        <div class="dashboard-card">
            <h2>Bookings</h2>
            <p>View and manage all bookings</p>
            <a href="bookings.php" class="btn">Go to Bookings</a>
        </div>
        <div class="dashboard-card">
            <h2>Reports</h2>
            <p>Generate and view reports</p>
            <a href="reports.php" class="btn">Go to Reports</a>
        </div>
    </div>
</div>

</body>
</html>
