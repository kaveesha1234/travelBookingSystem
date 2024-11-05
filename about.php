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
        <title>about</title>
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
        <div class="heading" style="background:url(asserts/headerabout.jpeg) no-repeat">
            <h1>about us</h1>
        </div>


        <!-- about section starts -->
            <section class="about">
                <div class="image">
                    <img src="asserts/about1.jpeg" alt="">
                </div>

            <div class="content">
                <h3>why choose us?</h3>
                <p>At Sri Lanka Travel Adventures, we pride ourselves on offering unforgettable travel experiences tailored to your every desire. With our deep knowledge and love for Sri Lanka, we curate personalized journeys that showcase the island's breathtaking landscapes, rich cultural heritage, and vibrant wildlife. </p>
                <p>Our dedicated team of local experts ensures that every aspect of your trip is meticulously planned, providing you with authentic encounters and hidden gems that you won't find in any guidebook. Whether you're seeking the thrill of adventure, the tranquility of pristine beaches, or the allure of ancient temples, we promise a seamless and enriching travel experience. Choose us for our commitment to excellence, our passion for sustainable tourism, and our unwavering dedication to making your Sri Lankan getaway truly exceptional.</p>
                <div class="icons-container">
                    <div class="icons">
                        <i class="fas fa-map"></i>
                        <span>top destinations</span>
                    </div>

                    <div class="icons">
                        <i class="fas fa-hand-holding-usd"></i>
                        <span>affordable price</span>
                    </div>

                    <div class="icons">
                        <i class="fas fa-headset"></i>
                        <span>24/7 guide service</span>
                    </div>
                </div>
            </div>

            </section>

        <!-- about section ends -->

        <!-- reviews section starts -->

        <section class="reviews">

        <div class="swiper review-slider ">

        <div class="swipper-wrapper">

        <div class="swiper-slider slide" >

        <div class="starts">

        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>

        </div>

        <p>I recently booked a trip through this "Travel." web site and had an incredible experience! The website is user-friendly and offers a wide range of customizable travel packages. The team was extremely helpful and knowledgeable, providing excellent recommendations and ensuring all my needs were met. The trip itself was perfectly organized, with seamless transitions between activities and accommodations. I was able to explore hidden gems and immerse myself in the rich culture of Sri Lanka. Highly recommend this travel service for anyone looking to discover the beauty of Sri Lanka!</p>
        <h3 style="margin-top:2.8rem;">john deo</h3>
        <span>traveller</span>
        <img src="asserts/man.jpeg" alt="">
    </div>

        <div class="swiper-slider  slide">

        <div class="starts">

        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>


        </div>

        <p>Sri Lanka Travel Adventures exceeded all my expectations! From the moment I visited this website, I found it easy to navigate and full of detailed information about various destinations and activities. Booking was straightforward, and the customer service was top-notch—responsive, friendly, and knowledgeable. The itinerary they crafted for me was diverse and exciting, including stunning beaches, lush tea plantations, and historical sites. Every detail was handled with care, making my trip stress-free and unforgettable. I highly recommend Sri Lanka Travel Adventures for anyone planning to explore this beautiful island.

        </p>
        <h3 style="margin-top:5.7rem;">kamal perera</h3>
        <span>traveller</span>
        <img src="asserts/man1.jpeg" alt="">

                </div>

                
                <div class="swiper-slider slide">

        <div class="starts">

        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>


        </div>
        <p>I had an amazing trip planned by Sri Lanka Travel! The website is intuitive and full of great information, making it simple to plan my perfect vacation. The team was incredibly helpful, offering personalized suggestions and handling all the logistics smoothly. My trip included stunning natural landscapes, vibrant cultural experiences, and top-notch accommodations. Every detail was meticulously arranged, allowing me to relax and enjoy the beauty of Sri Lanka. I highly recommend Sri Lanka Travel for a seamless and unforgettable travel experience!
        </p>
        <h3>taniya fonseka</h3>
        <span>traveller</span>
        <img src="asserts/woman.jpeg" alt="">

                </div>

                <div class="swiper-slider slide">

        <div class="starts">

        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>


        </div>

        <p>My experience with Sri Lanka Travel  was absolutely fantastic! The website made it incredibly easy to browse through various travel options and find a package that suited my interests. The staff were professional and went above and beyond to customize my itinerary, ensuring I experienced the best of Sri Lanka. Highlights included breathtaking scenic spots, authentic cultural experiences, and luxurious accommodations. Everything was organized flawlessly, allowing me to fully enjoy my trip without any worries. I would highly recommend Sri Lanka Travel Adventures to anyone looking for a memorable and hassle-free journey in Sri Lanka!

        </p>
        <h3 style="margin-top:2.9rem;">peter gomas</h3>
        <span>traveller</span>
        <img src="asserts/man2.jpeg" alt="">

                </div>


                </div>

                </div>

                </section>


        <!-- reviews section ends -->















       <?php include 'footer.php'; ?>



        <!-- swiper js link -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


        <!-- custom js file link -->
      <script src="js/script.js"></script>

    </body>
</html>