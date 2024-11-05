<!-- header.php -->

<section class="header">
    <a href="home.php" class="logo"> travel.</a>
    <nav class="navbar">
        <a href="home.php"><i class="fas fa-home nav-icon"></i> home</a>
        <a href="about.php"><i class="fas fa-info-circle nav-icon"></i> about</a>
        <a href="package.php"><i class="fas fa-suitcase-rolling nav-icon"></i> packages</a> <!-- Updated icon -->
        <a href="book.php"><i class="fas fa-calendar-check nav-icon"></i> book</a> <!-- Updated icon -->
        <a href="logout.php"><i class="fas fa-sign-out-alt nav-icon"></i> logout</a>
    </nav>
    <div id="menu-btn" class="fas fa-bars nav-icon"></div>
</section>



<!-- Add the Font Awesome CDN in the head section of your HTML document -->
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
                .header .navbar a .nav-icon {
    font-size: 24px; /* Increase the icon size */
    margin-right: 8px; /* Space between icon and text */
}

.header .logo {
    font-size: 24px; /* Increase the logo font size */
    display: flex;
    align-items: center;
}

.header .logo .nav-icon {
    font-size: 28px; /* Increase the logo icon size */
    margin-right: 8px; /* Space between icon and text */
}
                </style>
</head>
