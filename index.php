<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ======== Page title ============ -->
    <title>Tour Booking</title>
    
    <?php include 'header.php'; ?>

    <!-- Hero-Section Start -->
    <section class="hero-section bg-cover" style="background-image: url(assets/img/hero/slider-1.jpg);">
        <div class="shape float-bob-x">
            <img src="assets/img/shape/plane-1.png" alt="">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-10">
                    <div class="hero-wrapper">
                        <div class="section-title">
                            <span class="sub-title wow fadeInUp">
                                Experience Unforgettable Journeys With Us.
                            </span>
                            <h1 class="text-white wow fadeInUp" data-wow-delay=".3s">
                                Discover the World, <br> One Journey at a Time
                            </h1>
                        </div>
                        <div class="hero-button wow fadeInUp" data-wow-delay=".7s">
                            <a href="contact-us.php" class="theme-btn">Let's Get Started
                                <img src="assets/img/icon/white-arrow.svg" alt="img">
                            </a>
                            <a href="destinations.php" class="theme-btn style-2">Discover More
                                <img src="assets/img/icon/white-arrow.svg" alt="img">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-bottom">
                <form id="flightForm" class="flight-searc-box_web2" action="flight-search.php"  method="GET">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="flight-search_bg_web2">
                          <div class="row">
                            <div class="col-sm-12 mb-3">
                              <div class="form-group">
                                  <label><input type="radio" class="choose-trip-type" name="tripType" value="oneway" checked> One Way</label>
                                  <label><input type="radio" class="choose-trip-type" name="tripType" value="roundtrip"> Round Trip</label>
                              </div>    
                            </div>
                            <div class="col-md-5">
                              <div class="row">
                                <div class="col-sm-6 col-md-6 pe-md-0">
                                  <div class="form-group" id="citySection">
                                    <label class="flight-search-lbl">Leaving</label>
                                    <input type="text" class="flight-search-field flight-search-field-first" id="fromAirport" placeholder="From" required>
                                    <input type="hidden" id="fromAirportCode" name="origin" value="">    <!-- IATA Code -->
                                    <input type="hidden" id="fromAirportName" name="origin_name" value="">   <!-- Full Name -->
                                  </div> 
                                </div>
                                <div class="col-sm-6 col-md-6 px-md-0">
                                  <div class="form-group" id="citySection">
                                    <label class="flight-search-lbl">Going</label>
                                    <input type="text" class="flight-search-field" id="toAirport" placeholder="To" required>
                                    <input type="hidden" id="toAirportCode" name="destination" value=""> <!-- IATA Code -->
                                    <input type="hidden" id="toAirportName" name="destination_name" value> <!-- Full Name -->
                                  </div>
                                </div>    
                              </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-2 px-md-0">
                              <div class="form-group">
                                 <label class="flight-search-lbl">Departure</label>
                                  <input type="text" class="flight-search-field field-radius-0_web2 depdate" id="departDate" name="departure_date" placeholder="Select date" required>

                              </div>
                            </div>
                            <div class="col-sm-6 col-md-2 px-md-0">
                              <div class="form-group">   
                                  <label class="flight-search-lbl">Return</label> 
                                  <input type="text" class="flight-search-field field-radius-0_web2" name="return_date" id="returnDate" placeholder="Select date">
                              </div>
                            </div>
                            <div class="col-sm-6 col-md-3 mb-3 ps-md-0">
                              <div class="form-group">
                                <label class="flight-search-lbl">Passenger & Class</label>
                                <div class="flight-search-field flight-search-field-last" id="passengerClassDisplay">1 Adult - Economy</div>
                                <input type="hidden" name="passenger" id="passenger" value="1 Adult - Economy"> 

                                <div class="dropdown-panel" id="passengerDropdown">
                                  <div class="traveller-row_web2">
                                      <input type="hidden" name="adults" id="adults" value="1">
                                      <span>Adults <span>(12y +)</span></span>
                                      <div>
                                          <button type="button" class="count-btn" onclick="changeCount('adult', -1)">-</button>
                                          <span class="passenger-count-output" id="adultCount">1</span>
                                          <button type="button" class="count-btn" onclick="changeCount('adult', 1)">+</button>
                                      </div>
                                  </div>
                                  <div class="traveller-row_web2">
                                      <input type="hidden" name="children" id="children" value="0">
                                      <span>Children <span>(2y - 12y)</span></span>
                                      <div>
                                          <button type="button" class="count-btn" onclick="changeCount('child', -1)">-</button>
                                          <span class="passenger-count-output" id="childCount">0</span>
                                          <button type="button" class="count-btn" onclick="changeCount('child', 1)">+</button>
                                      </div>
                                  </div>
                                  <div class="traveller-row_web2">
                                      <input type="hidden" name="infants" id="infants" value="0">
                                      <span>Infants <span>(Below 2y)</span></span>
                                      <div>
                                          <button type="button" class="count-btn" onclick="changeCount('infant', -1)">-</button>
                                          <span class="passenger-count-output" id="infantCount">0</span>
                                          <button type="button" class="count-btn" onclick="changeCount('infant', 1)">+</button>
                                      </div>
                                  </div>

                                  <div class="form-group mt-3">
                                      <label class="travel-class-lbl">Choose Travel Class</label>
                                      <select class="form-control" id="travelClass">
                                          <option value="Economy">Economy</option>
                                          <option value="Business">Business</option>
                                          <option value="First">First Class</option>
                                      </select>
                                      <input type="hidden" name="travel_class"  id="cabin_class" value="ECONOMY">
                                  </div>

                                  <div class="mt-3 text-end">
                                      <button type="button" class="btn btn-success btn-sm" onclick="confirmPassengers()">Confirm</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                              <div class="d-flex justify-content-md-end">
                                <button type="submit" name="submit" class="theme-btn wrap-comman-btn"><i class="fa-solid fa-magnifying-glass"></i> Search Flights</button>
                              </div>  
                            </div>
                          </div>
                        </div>
                      </div>  
                    </div>
                  </form>
                  <script>
                      tripTypeRadios.forEach(radio => {
                          radio.addEventListener('change', () => {
                              if (radio.value === 'roundtrip') {
                                  returnDateInput.readOnly = false; 
                              } else {
                                  returnDateInput.readOnly = true;  
                                  returnDateInput.value = '';       
                              }
                          });
                      });

                      // Initial state
                      if (document.querySelector('input[name="tripType"]:checked').value !== 'roundtrip') {
                          returnDateInput.readOnly = true;
                      }
                      
                  </script>
                <!-- <form>
                    <div class="booking-list-area section-bg">
                        <div class="booking-list style-2">
                            <div class="icon">
                                <i class="fa-solid fa-location-dot"></i>
                                <h6>Location</h6>
                            </div>
                            <div class="form">
                                <input type="text" name="destination" placeholder="Where are you going?">
                            </div>
                        </div>
                        <div class="booking-list">
                            <div class="icon">
                                <i class="fa-light fa-calendar-days"></i>
                                <h6>Check in</h6>
                            </div>
                            <div class="form">
                                <div class="box">
                                    <input type="date" id="calendar" name="Add Date">
                                </div>
                            </div>
                        </div>
                        <div class="booking-list">
                            <div class="icon">
                                <i class="fa-light fa-calendar-days"></i>
                                <h6>Check Out</h6>
                            </div>
                            <div class="form">
                                <div class="box">
                                    <input type="date" id="calendar2" name="Add Date">
                                </div>
                            </div>
                        </div>
                        <div class="booking-list">
                            <div class="icon">
                                <i class="fa-light fa-user"></i>
                                <h6>Guests</h6>
                            </div>
                            <div class="form">
                                <select>
                                    <option>Select</option>
                                    <option value="london">01</option>
                                    <option value="Munich">02</option>
                                    <option value="Berlin">03</option>
                                    <option value="Maldives">04</option>
                                </select>
                            </div>
                        </div>
                        <button class="theme-btn" type="submit">Search</button>
                    </div>
                </form> -->
            </div>
        </div>
    </section>

    <!-- About-Section Start -->
    <section class="about-section section-padding fix">
        <div class="container">
            <div class="about-wrapper">
                <div class="row g-4">
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="about-left-image">
                            <img src="assets/img/about/about-1.jpg" alt="img" class="wow img-custom-anim-left">
                            <div class="about-image-2">
                                <img src="assets/img/about/about-2.jpg" alt="img" class="wow img-custom-anim-left">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="about-content">
                            <div class="section-title">
                                <span class="sub-title wow fadeInUp">
                                    Travel Designed for Your Happiness
                                </span>
                                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                    Connecting You to the World of Exploration
                                </h2>
                            </div>
                            <p class="mt-4 mt-md-0 wow fadeInUp px-md-5" data-wow-delay=".5s">
                                At Express Travel, we believe in the life-changing power of exploration. As passionate travelers ourselves, we understand the longing to discover new experiences, create lasting connections, and embrace the beauty of every journey.
                            </p>
                            <div class="about-button wow fadeInUp" data-wow-delay=".7s">
                                <a href="about-us.php" class="theme-btn">Read More
                                    <img src="assets/img/icon/white-arrow.svg" alt="img">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="about-right-image">
                            <img src="assets/img/about/about-3.jpg" alt="img" class="wow img-custom-anim-right">
                            <div class="about-image-2">
                                <img src="assets/img/about/about-4.jpg" alt="img" class="wow img-custom-anim-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service-Section Start -->
    <section class="service-section section-padding section-bg fix">
        <div class="shape float-bob-y">
            <img src="assets/img/shape/plane-2.png" alt="">
        </div>
        <div class="container">
            <div class="service-wrapper">
                <div class="row g-4">
                    <div class="col-xl-4">
                        <div class="service-content">
                            <div class="section-title">
                                <span class="sub-title wow fadeInUp">
                                    Our Best Activities
                                </span>
                                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                    Discover Unmatched Travel Advantages
                                </h2>
                            </div>
                            <p class="wow fadeInUp" data-wow-delay=".5s">
                                Enjoy exclusive perks, seamless bookings, and unforgettable experiences tailored just for you.
                            </p>
                            <div class="service-button">
                                <div class="array-button">
                                    <button class="array-prev">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
                                    <button class="array-next">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="swiper service-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="service-box-item">
                                        <div class="icon">
                                            <img src="assets/img/icon/01.svg" alt="img">
                                        </div>
                                        <div class="content">
                                            <h3>
                                                <a href="#">Exclusive Deals & Offers</a>
                                            </h3>
                                            <p>
                                                Unlock special discounts, seasonal promotions, and personalized travel packages designed to make your journeys more affordable and enjoyable.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="service-box-item">
                                        <div class="icon">
                                            <img src="assets/img/icon/02.svg" alt="img">
                                        </div>
                                        <div class="content">
                                            <h3>
                                                <a href="#">Seamless Travel Experience</a>
                                            </h3>
                                            <p>
                                                From easy bookings to 24/7 Assistance, we ensure your travel is smooth, stress-free, and fully hassle-free from start to finish.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="service-box-item">
                                        <div class="icon">
                                            <img src="assets/img/icon/03.svg" alt="img">
                                        </div>
                                        <div class="content">
                                            <h3>
                                                <a href="#">Memorable Journeys</a>
                                            </h3>
                                            <p>
                                                Curated experiences, local insights, and unique adventures help you create lasting memories wherever you go.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <!-- Top-destination-section Start -->
    <section class="top-destination-section section-padding fix">
        <div class="container">
            <div class="section-title text-center">
                <span class="sub-title wow fadeInUp">Top Destination</span>
                <h2 class="wow fadeInUp wow" data-wow-delay=".3s">
                    Most Popular Destinations
                </h2>
            </div>
            <div class="new-top-destination-wrapper">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="new-top-desti-thumb">
                                    <img src="assets/img/destination/new/05.jpg" alt="img">
                                    <a href="assets/img/destination/new/05.jpg" class="icon img-popup2">
                                        <i class="fa-regular fa-plus"></i>
                                    </a>
                                    <div class="content">
                                        <h4><a href="#">New York</a></h4>
                                        <p>174,688 Travelers</p>
                                    </div>
                                </div>
                                <div class="new-top-desti-thumb">
                                    <img src="assets/img/destination/new/06.jpg" alt="img">
                                    <a href="assets/img/destination/new/06.jpg" class="icon img-popup2">
                                        <i class="fa-regular fa-plus"></i>
                                    </a>
                                    <div class="content">
                                        <h4><a href="#">London</a></h4>
                                        <p>161,688 Travelers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="new-top-desti-thumb">
                                    <img src="assets/img/destination/new/07.jpg" alt="img">
                                    <a href="assets/img/destination/new/07.jpg" class="icon img-popup2">
                                        <i class="fa-regular fa-plus"></i>
                                    </a>
                                    <div class="content">
                                        <h4><a href="#">Paris</a></h4>
                                        <p>314,284 Travelers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="new-top-desti-thumb">
                                    <img src="assets/img/destination/new/08.jpg" alt="img">
                                    <a href="assets/img/destination/new/08.jpg" class="icon img-popup2">
                                        <i class="fa-regular fa-plus"></i>
                                    </a>
                                    <div class="content">
                                        <h4><a href="#">Dubai</a></h4>
                                        <p>174,688 Travelers</p>
                                    </div>
                                </div>
                                <div class="new-top-desti-thumb">
                                    <img src="assets/img/destination/new/09.jpg" alt="img">
                                    <a href="assets/img/destination/new/09.jpg" class="icon img-popup2">
                                        <i class="fa-regular fa-plus"></i>
                                    </a>
                                    <div class="content">
                                        <h4><a href="#">Singapore</a></h4>
                                        <p>224,188 Travelers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="new-top-desti-thumb">
                                    <img src="assets/img/destination/new/10.jpg" alt="img">
                                    <a href="assets/img/destination/new/10.jpg" class="icon img-popup2">
                                        <i class="fa-regular fa-plus"></i>
                                    </a>
                                    <div class="content">
                                        <h4><a href="#">Bangkok</a></h4>
                                        <p>164,110 Travelers</p>
                                    </div>
                                </div>
                                <div class="new-top-desti-thumb">
                                    <img src="assets/img/destination/new/11.jpg" alt="img">
                                    <a href="assets/img/destination/new/11.jpg" class="icon img-popup2">
                                        <i class="fa-regular fa-plus"></i>
                                    </a>
                                    <div class="content">
                                        <h4><a href="#">Sydney</a></h4>
                                        <p>128,188 Travelers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Choose-us Section Start -->
    <section class="choose-us-section section-padding fix section-bg">
        <div class="left-shape float-bob-x">
            <img src="assets/img/shape/plane-3.png" alt="img">
        </div>
        <div class="dot-shape">
            <img src="assets/img/shape/dot-1.png" alt="img">
        </div>
        <div class="right-shape">
            <img src="assets/img/choose-us/shape1.png" alt="img">
        </div>
        <div class="container">
            <div class="choose-us-wrapper">
                <div class="row g-4">
                    <div class="col-xl-7 col-lg-6">
                        <div class="chose-us-image">
                            <img src="assets/img/choose-us/choose-1.jpg" alt="img" class="wow img-custom-anim-left">
                            <div class="chose-us-image2">
                                <img src="assets/img/choose-us/choose-2.jpg" alt="">
                            </div>
                            <div class="chose-us-image3">
                                <img src="assets/img/choose-us/choose-3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="choose-us-content">
                            <div class="section-title mb-0">
                                <span class="sub-title wow fadeInUp">
                                    Why Choose Us
                                </span>
                                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                    Experience Travel Like Never Before
                                </h2>
                            </div>
                            <div class="choose-us-area">
                                <div class="line-image">
                                    <img src="assets/img/shape/line-shape.png" alt="">
                                </div>
                                <div class="choose-us-items wow fadeInUp" data-wow-delay=".2s">
                                    <h3 class="number">01</h3>
                                    <div class="content">
                                        <h4>Trusted Expertise</h4>
                                        <p>Years of experience and local knowledge ensure your trips are safe, seamless, and unforgettable.
                                        </p>
                                    </div>
                                </div>
                                <div class="choose-us-items wow fadeInUp" data-wow-delay=".3s">
                                    <h3 class="number">02</h3>
                                    <div class="content">
                                        <h4>Personalized Service</h4>
                                        <p>We tailor every journey to match your preferences, making each adventure uniquely yours.
                                        </p>
                                    </div>
                                </div>
                                <div class="choose-us-items wow fadeInUp mb-0" data-wow-delay=".5s">
                                    <h3 class="number">03</h3>
                                    <div class="content">
                                        <h4>Exceptional Value</h4>
                                        <p>Competitive pricing and exclusive deals help you get the most out of every travel experience.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <a href="#">Romantic Getaway</a>
                                </h4>
                                <span class="place"><i class="fa-solid fa-location-dot"></i>Paris, France</span>
                                <h5>$1250.00<span>/Person</span></h5>
                                <div class="booking">
                                    <span><i class="fa-solid fa-clock"></i> 5N / 6D</span>
                                    <a href="tel:<?php echo $phone_number_web3; ?>" class="theme-btn">Read More
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
                                    <a href="#">Tropical Adventure</a>
                                </h4>
                                <span class="place"><i class="fa-solid fa-location-dot"></i> Bali, Indonesia</span>
                                <h5>$1100.00<span>/Person</span></h5>
                                <div class="booking">
                                    <span><i class="fa-solid fa-clock"></i> 7N / 8D</span>
                                    <a href="tel:<?php echo $phone_number_web3; ?>" class="theme-btn">Read More
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
                                    <a href="#">City Explorer</a>
                                </h4>
                                <span class="place"><i class="fa-solid fa-location-dot"></i> New York City, USA</span>
                                <h5>$950.00<span>/Person</span></h5>
                                <div class="booking">
                                    <span><i class="fa-solid fa-clock"></i> 4N / 5D</span>
                                    <a href="tel:<?php echo $phone_number_web3; ?>" class="theme-btn">Read More
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
                                    <a href="#"> Historical Journey</a>
                                </h4>
                                <span class="place"><i class="fa-solid fa-location-dot"></i> Rome, Italy</span>
                                <h5>$1350.00<span>/Person</span></h5>
                                <div class="booking">
                                    <span><i class="fa-solid fa-clock"></i> 6N / 7D</span>
                                    <a href="tel:<?php echo $phone_number_web3; ?>" class="theme-btn">Read More
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

    <!-- Achievement Section Start -->
    <section class="achievement-section section-padding fix pb-0">
        <div class="shape-top">
            <img src="assets/img/shape/random-top.png" alt="img">
        </div>
        <div class="shape-bottom">
            <img src="assets/img/shape/random-bottom.png" alt="img">
        </div>
        <div class="container">
            <div class="section-title-area">
                <div class="section-title mb-0">
                    <span class="sub-title wow fadeInUp text-white">
                        Achievement
                    </span>
                    <h2 class=" text-white wow fadeInUp" data-wow-delay=".3s">
                        See the Wonders You’ve <br> Always Dreamed Of
                    </h2>
                </div>
                <div class="achievement-button wow fadeInUp" data-wow-delay=".7s">
                    <a href="tel:<?php echo $phone_number_web3; ?>" class="theme-btn">Read More
                        <img src="assets/img/icon/white-arrow.svg" alt="img">
                    </a>
                </div>
            </div>
            <div class="achievement-wrapper">
                <div class="row">
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                        <div class="achievement-items">
                            <div class="content">
                                <div class="icon">
                                    <img src="assets/img/icon/traveller.svg" alt="img">
                                </div>
                                <h3 class="number">
                                    <span class="count">7684</span>
                                </h3>
                                <h5>Happy Traveller</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                        <div class="achievement-items">
                            <div class="content">
                                <div class="icon">
                                    <img src="assets/img/icon/complete.svg" alt="img">
                                </div>
                                <h3 class="number"><span class="count">269</span>+</h3>
                                <h5>Tour Completed</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                        <div class="achievement-items">
                            <div class="content">
                                <div class="icon">
                                    <img src="assets/img/icon/reviews.svg" alt="img">
                                </div>
                                <h3 class="number"><span class="count">99</span>%</h3>
                                <h5>Total Reviews</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                        <div class="achievement-items">
                            <div class="content">
                                <div class="icon">
                                    <img src="assets/img/icon/award.svg" alt="img">
                                </div>
                                <h3 class="number">
                                    <span class="count">2368</span>
                                </h3>
                                <h5>Awards & honors</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Cta-bg-Section Start -->
    <section class="cta-bg-section bg-cover fix mt-5" style="background-image: url(assets/img/cta/bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="cta-wrapper text-center">
                    <div class="section-title ">
                        <span class="sub-title wow fadeInUp">
                            Explore The World
                        </span>
                        <h2 class="wow fadeInUp" data-wow-delay=".3s">
                            Find your next destination and create unforgettable memories. Plan. Travel. Experience. The world is waiting for you.
                        </h2>
                    </div>
                    <div class="cta-button wow fadeInUp" data-wow-delay=".7s">
                        <a href="tel:<?php echo $phone_number_web3; ?>" class="theme-btn">Call Us : <?php echo $phone_number_web3; ?>
                            <img src="assets/img/icon/white-arrow.svg" alt="img">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section Start -->
    <section class="testimonial-section section-padding fix">
        <div class="container">
            <div class="section-title-area">
                <div class="section-title">
                    <span class="sub-title wow fadeInUp">
                        Testimonial
                    </span>
                    <h2 class="wow fadeInUp" data-wow-delay=".3s">
                        What Our Clients Say
                    </h2>
                </div>
                <div class="about-button wow fadeInUp" data-wow-delay=".7s">
                    <a href="contact-us.php" class="theme-btn">Read More
                        <img src="assets/img/icon/white-arrow.svg" alt="img">
                    </a>
                </div>
            </div>
            <div class="swiper testimonial-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial-main-item">
                            <div class="top-shape">
                                <img src="assets/img/testimonial/shape1.png" alt="img">
                            </div>
                            <div class="testimonial-card-item">
                                <div class="polygon-shape">
                                    <img src="assets/img/testimonial/shape2.png" alt="img">
                                </div>
                                <div class="testimonial-content">
                                    <div class="star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p>
                                        "I’ve traveled with many agencies, but Express Travel truly stands out. The team’s attention to detail and commitment to creating memorable trips is exceptional."
                                    </p>
                                    <div class="info-item">
                                        <div class="content">
                                            <h4>Emily T., UK</h4>
                                        </div>
                                        <div class="icon">
                                            <img src="assets/img/icon/qoute.svg" alt="img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-main-item">
                            <div class="top-shape">
                                <img src="assets/img/testimonial/shape1.png" alt="img">
                            </div>
                            <div class="testimonial-card-item">
                                <div class="polygon-shape">
                                    <img src="assets/img/testimonial/shape2.png" alt="img">
                                </div>
                                <div class="testimonial-content">
                                    <div class="star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p>
                                        "The personalized itinerary they created for us was amazing. From local experiences to luxury stays, every detail exceeded our expectations."
                                    </p>
                                    <div class="info-item">
                                        <div class="content">
                                            <h4>Rajesh K., India</h4>
                                        </div>
                                        <div class="icon">
                                            <img src="assets/img/icon/qoute.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-main-item">
                            <div class="top-shape">
                                <img src="assets/img/testimonial/shape1.png" alt="img">
                            </div>
                            <div class="testimonial-card-item">
                                <div class="polygon-shape">
                                    <img src="assets/img/testimonial/shape2.png" alt="img">
                                </div>
                                <div class="testimonial-content">
                                    <div class="star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p>
                                        "Booking with Express Travel made our family vacation unforgettable. Everything was perfectly organized, and we enjoyed every moment without any stress!
                                    </p>
                                    <div class="info-item">
                                        <div class="content">
                                            <h4>Sarah M., USA</h4>
                                        </div>
                                        <div class="icon">
                                            <img src="assets/img/icon/qoute.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <?php include 'footer.php' ?>


<!-- show total passenger value and fetch value in another page  -->
<script>
  const displayBox = document.getElementById('passengerClassDisplay');
  const dropdownPanel = document.getElementById('passengerDropdown');
  const counts = { adult: 1, child: 0, infant: 0 };

  // Toggle dropdown
  displayBox.addEventListener('click', () => {
      dropdownPanel.style.display = dropdownPanel.style.display === 'block' ? 'none' : 'block';
  });

  // Update count
  function changeCount(type, delta) {
      if (counts[type] + delta >= 0) {
          counts[type] += delta;
          document.getElementById(type + 'Count').textContent = counts[type];
      }
  }

  // Build summary + update hidden fields
  function updateDisplay() {
      const travelClass = document.getElementById('travelClass').value;
      const totalPassengers = counts.adult + counts.child + counts.infant;
      const passengerLabel = totalPassengers === 1 ? 'Passenger' : 'Passengers';

      // Display box
      displayBox.textContent = `${totalPassengers} ${passengerLabel} - ${travelClass}`;

      // Hidden inputs
      document.getElementById('adults').value      = counts.adult;
      document.getElementById('children').value    = counts.child;
      document.getElementById('infants').value     = counts.infant;
      document.getElementById('cabin_class').value = travelClass;
      document.getElementById('passenger').value = 
          `${counts.adult} Adult${counts.adult > 1 ? 's' : ''}`
          + (counts.child > 0 ? `, ${counts.child} Child${counts.child > 1 ? 'ren' : ''}` : '')
          + (counts.infant > 0 ? `, ${counts.infant} Infant${counts.infant > 1 ? 's' : ''}` : '')
          + ` - ${travelClass}`;
  }

  // Confirm button action
  function confirmPassengers() {
      updateDisplay();
      dropdownPanel.style.display = 'none';
      buildTravellerRows();
  }

  // Build traveller rows dynamically
  function buildTravellerRows() {
      const tbody = document.querySelector("#traveller-table tbody");
      if (!tbody) return;

      tbody.innerHTML = "";
      for (let i = 1; i <= counts.adult; i++) tbody.appendChild(createTravellerRow(`Adult ${i}`));
      for (let i = 1; i <= counts.child; i++) tbody.appendChild(createTravellerRow(`Child ${i}`));
      for (let i = 1; i <= counts.infant; i++) tbody.appendChild(createTravellerRow(`Infant ${i}`));
  }

  // Create single traveller row
  function createTravellerRow(label) {
      const tr = document.createElement("tr");
      tr.innerHTML = `
          <td>${label}</td>
          <td><label>First Name</label><input type="text" name="first-name[]" required></td>
          <td><label>Middle Name</label><input type="text" name="middle-name[]"></td>
          <td><label>Last Name</label><input type="text" name="last-name[]" required></td>
          <td><label>Gender</label>
              <select name="gender[]"><option>Male</option><option>Female</option></select>
          </td>
          <td><label>DOB</label><input type="text" name="dob[]" class="dob_datepicker" required></td>
      `;
      return tr;
  }

  // Close dropdown if clicking outside
  document.addEventListener('click', function(e) {
      if (!e.target.closest('#passengerDropdown') && !e.target.closest('#passengerClassDisplay')) {
          dropdownPanel.style.display = 'none';
      }
  });

  // --- KEY FIX ---
  // Update hidden fields before any form submission
  document.querySelector("form").addEventListener("submit", function() {
      updateDisplay();
  });

document.addEventListener('DOMContentLoaded', () => {
    // Preserve initial values from hidden inputs (useful when coming back from flight-result.php)
    counts.adult = parseInt(document.getElementById('adults').value) || 1;
    counts.child = parseInt(document.getElementById('children').value) || 0;
    counts.infant = parseInt(document.getElementById('infants').value) || 0;

    // Initialize display
    updateDisplay();

    // Attach confirm button
    document.getElementById('confirmPassengerBtn').addEventListener('click', confirmPassengers);

    // Ensure form submission updates hidden fields
    document.querySelector("form").addEventListener("submit", function() {
        updateDisplay();
    });
});


</script>

<!-- <script>
  let airportData = [];

  // Load airport list from JSON file
  fetch("assets/js/airport.json")
    .then(res => res.json())
    .then(data => {
      // Convert JSON list to autocomplete objects
      airportData = data.map(item => {
        const parts = item.split("-");
        const code = parts[0]; // first part (IATA code)
        const name = parts.slice(1).join(" - "); // rest of string (name, city, country)
        return {
          label: `${name.trim()} (${code.trim()})`,
          value: `${name.trim()} (${code.trim()})`,
          code: code.trim(),
          name: name.trim()
        };
      });

      // Initialize autocomplete once data is ready
      setupAutocomplete("fromAirport", "fromAirportCode", "fromAirportName");
      setupAutocomplete("toAirport", "toAirportCode", "toAirportName");
    });

  // Autocomplete setup function
  function setupAutocomplete(inputId, hiddenCodeId, hiddenNameId) {
    $("#" + inputId).autocomplete({
      minLength: 2,
      source: airportData,
      select: function(event, ui) {
        $("#" + inputId).val(ui.item.value);
        $("#" + hiddenCodeId).val(ui.item.code);
        $("#" + hiddenNameId).val(ui.item.name);
        return false;
      }
    });
  }
</script> -->
<!-- Flight airport list autocomplete -->
<script>
  // 🔑 Amadeus API credentials
  const client_id = "IMewQoGGzsLuxu2vR2r9ImKFeRVNbf4m";
  const client_secret = "bLW0u8zhqigZYcaC";

  // Get Amadeus access token
  async function getAccessToken() {
   const res = await fetch("https://test.api.amadeus.com/v1/security/oauth2/token", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({
        grant_type: "client_credentials",
        client_id: client_id,
        client_secret: client_secret
      })
    });
    const data = await res.json();
    return data.access_token;
  }

  // Setup autocomplete
  function setupAutocomplete(inputId, hiddenCodeId, hiddenNameId) {
    getAccessToken().then(token => {
      $("#" + inputId).autocomplete({
        minLength: 2, // user can start typing earlier
        source: function(request, response) {
          //fetch(`https://test.api.amadeus.com/v1/reference-data/airlines?subType=AIRPORT,CITY&keyword=${request.term}&page[limit]=20`, {
          fetch(`https://test.api.amadeus.com/v1/reference-data/locations?subType=AIRPORT&keyword=${request.term}&page[limit]=20`, {
            headers: { "Authorization": "Bearer " + token }
          })
          .then(res => res.json())
          .then(data => {
            if (!data.data) return response([]);
            response(data.data.map(airport => {
              const city = airport.address?.cityName || airport.name;
              return {
                label: `${airport.name} (${airport.iataCode}) - ${city}, ${airport.address?.countryName || ""}`,
                //label: `${airport.name} (${airport.iataCode}) - ${airport.address?.cityName || ""}`,
                value: `${airport.name} (${airport.iataCode})`, // show nice text in input
                code: airport.iataCode,   // store IATA in hidden field
                name: airport.name        // store airport name in hidden field
              };
            }));
          })
          .catch(() => response([]));
        },
        select: function(event, ui) {
          $("#" + inputId).val(ui.item.value);      // show full name in input
          $("#" + hiddenCodeId).val(ui.item.code);  // save IATA code
          $("#" + hiddenNameId).val(ui.item.name);  // save airport name
          return false;
        }
      });
    });
  }

  // Apply autocomplete
  $(document).ready(function() {
    setupAutocomplete("fromAirport", "fromAirportCode", "fromAirportName");
    setupAutocomplete("toAirport", "toAirportCode", "toAirportName");
  });
</script>


<script>
  $(function() {
      // Departure date picker
      $("#departDate").datepicker({
          dateFormat: "yy-mm-dd",
          minDate: 0,
          numberOfMonths: 2,
          onSelect: function(selectedDate) {
              // Set minimum return date
              $("#returnDate").datepicker("option", "minDate", selectedDate);

              // If round trip, open the return date calendar automatically
              if ($('input[name="tripType"]:checked').val() === 'roundtrip') {
                  setTimeout(function() {
                      $("#returnDate").datepicker("show");
                  }, 200); // small delay so it feels smooth
              }
          }
      });

      // Return date picker
      $("#returnDate").datepicker({
          dateFormat: "yy-mm-dd",
          minDate: 0,
          numberOfMonths: 2
      });

      // Trip type change handling
      $('input[name="tripType"]').on('change', function() {
          if ($(this).val() === 'roundtrip') {
              $("#returnDate").prop('disabled', false);
          } else {
              $("#returnDate").prop('disabled', true).val('');
          }
      });

      // Initial disable if not round trip
      if ($('input[name="tripType"]:checked').val() !== 'roundtrip') {
          $("#returnDate").prop('disabled', true);
      }
  });

</script>