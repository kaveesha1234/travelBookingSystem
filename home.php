
<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
	    <link rel="icon" type="image/png" sizes="32x32" href="asserts/logo.png">
    <!-- swiper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>


<!-- home section starts -->

<section class="home">
    <div class="swiper home-slider">

<div class="swiper-wrapper">

<div class="swiper-slide slide" style="background:url(asserts/home-slide-1.jpeg) no-repeat">

<div class="content">
        <span>explore, discover, travel</span>
        <h3>travel arround the Sri Lanka</h3>
        <a href="package.php" class="btn">discover more</a>
</div>
</div>


<div class="swiper-slide slide" style="background:url(asserts/home-slide-2.jpeg) no-repeat">

<div class="content">
        <span>explore, discover, travel</span>
        <h3>discover the new places</h3>
        <a href="package.php" class="btn">discover more</a>
</div>
</div>

<div class="swiper-slide slide" style="background:url(asserts/home-slide-3.jpeg) no-repeat">

<div class="content">
        <span>explore, discover, travel</span>
        <h3>make your tour</h3>
        <a href="package.php" class="btn">discover more</a>
</div>
</div>

</div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

    </div>
</section>














<!-- home section ends -->







<!-- service section starts -->
<section class="services">
    <h1 class="heading-title">our services</h1>
    <div class="box-container">
        <div class="box">
            <img src="asserts/adventure.png" alt="">
            <h3>adventure</h3>
        </div>
        <div class="box">
            <img src="asserts/guide.png" alt="">
            <h3>Tour guide</h3>
        </div>
        <div class="box">
            <img src="asserts/trikking.png" alt="">
            <h3>trekking</h3>
        </div>
        <div class="box">
            <img src="asserts/campingfire.png" alt="">
            <h3>camp fire</h3>
        </div>
        <div class="box">
            <img src="asserts/offroad.png" alt="">
            <h3>off road</h3>
        </div>
        <div class="box">
            <img src="asserts/camping.png" alt="">
            <h3>camping</h3>
        </div>
    </div>
</section>


<!-- service section ends -->



<!-- home about section starts -->

    <section class="home-about">

    <div class="image">
        <img src="asserts/about.jpeg" alt="">
    </div>

    <div class="content">
        <h3>about us</h3>
        <p>Welcome to Sri Lanka Travel web site, your gateway to exploring the stunning beauty and diverse landscapes of Sri Lanka. We offer meticulously curated travel packages for every type of traveler, from thrilling adventures and serene camping trips to off-road excursions. Our options make planning effortless, ensuring you discover Sri Lanka's hidden gems. Embrace activities like trekking, remote trail exploration, and cozy campfires under the stars. With Sri Lanka Travels, every journey is a memorable story of discovery, excitement, and relaxation. Join us to create lasting memories as you explore the wonders of Sri Lanka.</p>
        <a href="about.php" class="btn">read more</a>
    </div>

    </section>




<!-- home about section ends -->

<!-- home offer section starts -->


<!-- home offer section starts -->

<section class="home-offer">
    <div class="content">
        <h3>upto 50% off</h3>
        <p>offer is here</p>
        <a href="book.php" class="btn">book now</a>
    </div>
</section>



<!-- home packages section starts -->

<section class="home-packages">
<h1 class="heading-title">our packages</h1>

<div class="box-container">

        <div class="box">
            <div class="image">
                <img src="asserts/adventure.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Kithulgala</h3>
                <p>Discover the beauty and excitement of Sri Lanka with our exclusive travel packages, meticulously designed to offer the perfect blend of adventure and relaxation. Kithulgala is famous for its white-water rafting, lush jungles, and scenic beauty. Explore the Belilena Cave, trek through rainforests, and enjoy the picturesque landscapes. Our packages ensure a mix of thrilling activities and serene moments in this beautiful location.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="asserts/camp.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Meemure</h3>
                <p>Experience the remote beauty of Meemure, a village hidden in the Knuckles Mountain Range. Our travel packages offer guided treks through misty mountains, visits to traditional Sri Lankan villages, and opportunities to immerse yourself in the local culture. Meemure is the perfect destination for those seeking tranquility and adventure amidst untouched nature.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="asserts/underwater.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Hikkaduwa</h3>
                <p>Hikkaduwa is renowned for its vibrant coral reefs and stunning beaches. Dive into an underwater paradise, explore the marine sanctuary, and relax on golden sands. Our packages include snorkeling, scuba diving, and visits to local attractions. Whether you're an adventure lover or seeking a beach getaway, Hikkaduwa offers a perfect blend of excitement and relaxation.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

    </div>

<div class="load-more"><a href="package.php" class="btn">load more</a></div>
</section>




<!-- home packages section ends -->



<?php include 'footer.php'; ?>


<!-- swiper js link -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- custom js file link -->
<script src="js/script.js"></script>

</body>
</html>
