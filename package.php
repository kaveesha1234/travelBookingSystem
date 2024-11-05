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
        <title>packages</title>
     <link rel="icon" type="image/png" sizes="32x32" href="asserts/logo.png">
            
    </head>
    

        <!-- swiper css link -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

        <!-- font awesome cdn link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css ">

        <!-- custom css file link -->
        <link rel="stylesheet" href="css/style.css">
       

    <body>
    
   <?php include 'header.php'; ?>
        <div class="heading" style="background:url(asserts/headerPackage.jpeg) no-repeat">
            <h1>packages</h1>
        </div>


        <!-- package section starts -->
        
        <section class="packages">

        <h1 class="heading-title">top destinations</h1>

       <div class="box-container">
        <div class="box">
            <div class="image">
                <img src="asserts/package1.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Arugam Bay</h3>
                <p>Surf the waves at Arugam Bay, a world-renowned surf destination in Sri Lanka. Enjoy the beautiful beaches and vibrant nightlife.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="asserts/package2.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Trinco</h3>
                <p>Discover the serene beaches and historical sites of Trincomalee. Visit the Koneswaram Temple and relax on Nilaveli Beach.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="asserts/package3.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Bandarawela</h3>
                <p>Explore the charming town of Bandarawela, surrounded by lush tea plantations and scenic mountain views.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="asserts/package4.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Yala</h3>
                <p>Experience a thrilling safari in Yala National Park, home to a diverse range of wildlife including elephants and leopards.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="asserts/package5.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Kosgoda</h3>
                <p>Visit the turtle hatchery in Kosgoda and witness the conservation efforts to protect these majestic creatures.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="asserts/package6.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Ella</h3>
                <p>Hike through the picturesque tea plantations of Ella and visit the famous Nine Arches Bridge and Ella Rock.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="asserts/package7.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Meemure</h3>
                <p>Explore the remote village of Meemure, nestled in the Knuckles Mountain Range, and experience traditional Sri Lankan village life.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="asserts/package8.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Jaffna</h3>
                <p>Discover the rich cultural heritage of Jaffna, with its unique blend of Tamil traditions, colonial architecture, and vibrant festivals.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="asserts/package9.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Polonnaruwa</h3>
                <p>Explore the ancient city of Polonnaruwa, a UNESCO World Heritage site, and marvel at its well-preserved ruins and statues.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="asserts/package10.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Anuradhapura</h3>
                <p>Visit the sacred city of Anuradhapura, one of the oldest continuously inhabited cities in the world, and explore its ancient temples and stupas.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="asserts/package11.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Nilaveli</h3>
                <p>Relax on the pristine beaches of Nilaveli, known for its crystal-clear waters and excellent snorkeling and diving spots.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="asserts/package12.jpeg" alt="">
            </div>
            <div class="content">
                <h3>Kataragama</h3>
                <p>Experience the spiritual ambiance of Kataragama, a pilgrimage site for Buddhists, Hindus, and Muslims, known for its vibrant festivals.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>
    </div>

        <div class="load-more">

        </div>
            <span class="load-more-btn btn">load more</span>
        </section>



        <!-- package section ends -->















       <?php include 'footer.php'; ?>



        <!-- swiper js link -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


        <!-- custom js file link -->
      <script src="js/script.js"></script>

    </body>
</html>