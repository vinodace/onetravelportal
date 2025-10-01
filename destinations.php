<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ======== Page title ============ -->
    <title>Destinations</title>
    
    <?php include 'header.php'; ?>

    <!-- Breadcrumb-Section Start -->
    <section class="breadcrumb-wrapper fix bg-cover"
        style="background-image: url(assets/img/breadcrumb/breadcrumb.jpg);">
        <div class="container">
            <div class="row">
                <div class="page-heading">
                    <h2>Destinations</h2>
                    <ul class="breadcrumb-list">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><i class="fa-solid fa-chevrons-right"></i></li>
                        <li class="active">Destinations</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Destination Section Start -->
    <section class="destination-section section-padding fix">
        <div class="container">
            <div class="section-title text-center">
                <span class="sub-title wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    Best Recommended Places
                </span>
                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                    Journey to the World’s Most <br> Iconic Destinations
                </h2>
            </div>
            <div class="swiper destination-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="destination-card-items">
                            <div class="destination-thumb">
                                <img src="assets/img/destinations/1.jpg" alt="">
                                <div class="ratting">
                                    <i class="fa-solid fa-star"></i>
                                    <span>4.9</span>
                                </div>
                                <div class="heart">
                                    <i class="fa-solid fa-heart"></i>
                                </div>
                            </div>
                            <div class="destination-content">
                                <h4>
                                    <a href="tour-details.php">Romantic Getaway</a>
                                </h4>
                                <span class="place"><i class="fa-solid fa-location-dot"></i>Paris, France</span>
                                <h5>$1250.00<span>/Person</span></h5>
                                <div class="booking">
                                    <span><i class="fa-solid fa-clock"></i> 5N / 6D</span>
                                    <a href="tour-details.php" class="theme-btn">Read More
                                        <img src="assets/img/icon/theme-arrow.svg" alt="img">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="destination-card-items">
                            <div class="destination-thumb">
                                <img src="assets/img/destinations/2.jpg" alt="img">
                                <div class="ratting">
                                    <i class="fa-solid fa-star"></i>
                                    <span>4.9</span>
                                </div>
                                <div class="heart">
                                    <i class="fa-solid fa-heart"></i>
                                </div>
                            </div>
                            <div class="destination-content">
                                <h4>
                                    <a href="tour-details.php">Tropical Adventure</a>
                                </h4>
                                <span class="place"><i class="fa-solid fa-location-dot"></i> Bali, Indonesia</span>
                                <h5>$1100.00<span>/Person</span></h5>
                                <div class="booking">
                                    <span><i class="fa-solid fa-clock"></i> 7N / 8D</span>
                                    <a href="tour-details.php" class="theme-btn">Read More
                                        <img src="assets/img/icon/theme-arrow.svg" alt="img">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="destination-card-items">
                            <div class="destination-thumb">
                                <img src="assets/img/destinations/3.jpg" alt="img">
                                <div class="ratting">
                                    <i class="fa-solid fa-star"></i>
                                    <span>4.9</span>
                                </div>
                                <div class="heart">
                                    <i class="fa-solid fa-heart"></i>
                                </div>
                            </div>
                            <div class="destination-content">
                                <h4>
                                    <a href="tour-details.php">City Explorer</a>
                                </h4>
                                <span class="place"><i class="fa-solid fa-location-dot"></i> New York City, USA</span>
                                <h5>$950.00<span>/Person</span></h5>
                                <div class="booking">
                                    <span><i class="fa-solid fa-clock"></i> 4N / 5D</span>
                                    <a href="tour-details.php" class="theme-btn">Read More
                                        <img src="assets/img/icon/theme-arrow.svg" alt="img">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="destination-card-items">
                            <div class="destination-thumb">
                                <img src="assets/img/destinations/4.jpg" alt="img">
                                <div class="ratting">
                                    <i class="fa-solid fa-star"></i>
                                    <span>4.9</span>
                                </div>
                                <div class="heart">
                                    <i class="fa-solid fa-heart"></i>
                                </div>
                            </div>
                            <div class="destination-content">
                                <h4>
                                    <a href="tour-details.php"> Historical Journey</a>
                                </h4>
                                <span class="place"><i class="fa-solid fa-location-dot"></i> Rome, Italy</span>
                                <h5>$1350.00<span>/Person</span></h5>
                                <div class="booking">
                                    <span><i class="fa-solid fa-clock"></i> 6N / 7D</span>
                                    <a href="tour-details.php" class="theme-btn">Read More
                                        <img src="assets/img/icon/theme-arrow.svg" alt="img">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-dot4 mt-5">
                <div class="dot"></div>
            </div>
        </div>
    </section>
 
    <?php include 'footer.php' ?>