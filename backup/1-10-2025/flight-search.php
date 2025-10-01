<?php
// Check if form data was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $leaving_from = htmlspecialchars($_POST['from']);
    $going_to = htmlspecialchars($_POST['to']);
    $departure_date = htmlspecialchars($_POST['departDate']);
    //$return_date = htmlspecialchars($_POST['returndate']);
    $return_date = isset($_POST['returnDate']) ? htmlspecialchars($_POST['returnDate']) : '';
    $passenger = htmlspecialchars($_POST['passenger']   ?? ''); // "3 Passengers - Economy"

    // Optional: get structured values too
    $adults        = (int)($_POST['adults']      ?? 1);
    $children      = (int)($_POST['children']    ?? 0);
    $infants       = (int)($_POST['infants']     ?? 0);
    $cabin_class   = htmlspecialchars($_POST['travel_class'] ?? 'Economy');

} else {
    // Redirect back if page is accessed directly
    //header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ======== Page title ============ -->
    <title>Flight Search</title>
    
    <?php include 'header.php'; ?>

    <!-- Breadcrumb-Section Start -->
    <section class="breadcrumb-wrapper fix bg-cover"
        style="background-image: url(assets/img/breadcrumb/breadcrumb.jpg);">
        <div class="container">
            <div class="row">
                <div class="page-heading">
                    <h2>Flight Search</h2>
                    <ul class="breadcrumb-list">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><i class="fa-solid fa-chevrons-right"></i></li>
                        <li class="active">Flight Search</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

   
   <!--  <section class="destination-details-section section-padding fix">
        <div class="container">
            <div class="row justify-content-center g-4">
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="flightsidebar_filter-box_web2 pb-2 sticky-sidebar">
                      <div class="flightsidebar_padding_web2">
                        <h3 class="wrap_subhding_web2 pt-0">Airlines</h3>
                        <ul class="flightsidebar_checklist_web2">
                            <li>No airlines available.</li>
                        </ul>

                        
                        <hr>

                        <h3 class="wrap_subhding_web2 pt-0">Recommended</h3>
                        <ul class="flightsidebar_checklist_web2">
                          <li><label for="checked_baggage_included">Checked baggage included</label></li>
                          <li><label for="hide_budget_airlines">Hide budget airlines</label></li>
                          <li><label for="carry-on_baggage_included">Carry-on baggage included</label></li>
                          <li><label for="hide_codeshare_flights">Hide codeshare flights</label></li>
                        </ul>
                        <hr>

                        <h3 class="wrap_subhding_web2 pt-0">Stop</h3>
                        <ul class="flightsidebar_checklist_web2">
                          <li><label for="nonstop">Nonstop</label></li>
                          <li><label for="1_stop">1 Stop or fewer</label></li>
                          <li><label for="2_stop">2 Stop or fewer</label></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                <div class="col-lg-8">
                    <div class="search-formbox_web2">
                      <div class="d-flex justify-content-center align-items-center gap-4 pb-4">
                        <div class="w-50">
                          <p class="search-form_title_web2 text-center">Leaving From</p>
                          <h1 class="search-form_name_web2 text-center"><?= htmlspecialchars($origin_name) ?></h1>
                          <p class="wrap_prgh_web2 text-center text-info"><?= htmlspecialchars($origin) ?></p>
                        </div>
                        <h1 class="search-form_to_web2 text-center"> TO</h1>
                        <div class="w-50">
                          <p class="search-form_title_web2 text-center">Going To</p>
                          <h1 class="search-form_name_web2 text-center"><?= htmlspecialchars($destination_name) ?></h1>
                          <p class="wrap_prgh_web2 text-center text-info"><?= htmlspecialchars($destination) ?></p>
                        </div>
                      </div>
                      <ul class="search-form_list_web2">
                        <li>Departure Date: <?= htmlspecialchars($departure_date) ?></li>
                        <?php if (!empty($return_date)) { echo "<li>Return Date: " . htmlspecialchars($return_date) . "</li>"; } ?>
                      </ul>
                      <p class="wrap_prgh_web2 text-center pt-2">Prices shown are per guest, inclusive of taxes and port fees. Additional baggage fees may apply.</p>
                      <h2 class="wait_hding_web2 pt-4">Please Wait...</h2>
                      <p class="wrap_prgh_web2 text-center fw-bold">We are Searching Airline Fares For You From Over 450 + Airlines</p>

                      <img src="images/loader.gif" alt="loader" class="search-form_loader_web2">
                      <p class="wrap_prgh_web2 text-center">Still searching... Have questions? Our experts are just a call away</p>
                      <a href="tel:<?= htmlspecialchars($phone_number_web2 ?? '') ?>" class="search-form_callbtn_web2"><i class="fa-solid fa-phone-volume"></i> Call Us <?= htmlspecialchars($phone_number_web2 ?? '') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    
    <!-- Flight search result with waiting loader modal -->
<section class="flight-search-result-bg py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-3 d-none d-lg-block">
        <div class="flightsidebar_filter-box_web2 pb-2 sticky-sidebar">
          <div class="flightsidebar_padding_web2">
            <h3 class="wrap_subhding_web2 pt-0">Airlines</h3>
            <ul class="flightsidebar_checklist_web2">
                <li>No airlines available.</li>
            </ul>

            
            <hr>

            <h3 class="wrap_subhding_web2 pt-0">Recommended</h3>
            <ul class="flightsidebar_checklist_web2">
              <li><label for="checked_baggage_included">Checked baggage included</label></li>
              <li><label for="hide_budget_airlines">Hide budget airlines</label></li>
              <li><label for="carry-on_baggage_included">Carry-on baggage included</label></li>
              <li><label for="hide_codeshare_flights">Hide codeshare flights</label></li>
            </ul>
            <hr>

            <h3 class="wrap_subhding_web2 pt-0">Stop</h3>
            <ul class="flightsidebar_checklist_web2">
              <li><label for="nonstop">Nonstop</label></li>
              <li><label for="1_stop">1 Stop or fewer</label></li>
              <li><label for="2_stop">2 Stop or fewer</label></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
          <!-- Start waiting loader modal-->
          <div id="waiting-loader">
            <div class="search-form-box">
              <div class="d-flex justify-content-center align-items-center gap-4 pb-4">
                <div class="w-50">
                  <p class="search-form-title text-center">Leaving From</p>
                  <h1 class="search-form-name text-center"><?php echo $leaving_from; ?></h1>
                </div>  
                <h1 class="search-form-to text-center"><i class="fa-solid fa-plane"></i></h1>
                <div class="w-50">
                  <p class="search-form-title text-center">Going To</p>
                  <h1 class="search-form-name text-center"><?php echo $going_to; ?></h1>
                </div>  
              </div>
              <!-- <h2 class="search-form-hding"><?php //echo $passenger; ?></h2> -->
              <ul class="search-form-list">
                <li>Departure Date: <?php echo $departure_date; ?></li>
                <?php 
                  if (!empty($return_date)) {
                      echo "<li>Return Date: {$return_date}</li>";
                  }
                ?>
                <!-- <li>Return Date: <?php echo $return_date; ?></li> -->
              </ul>
              <p class="wrap-prgh text-center pt-2">Prices shown are per guest, inclusive of taxes and port fees. Additional baggage fees may apply.</p>
              <h2 class="wait-hding pt-4">Please Wait...</h2>
              <p class="wrap-prgh text-center fw-bold">We are Searching Airline Fares For You From Over 450 + Airlines</p>

              <img src="assets/img/loader.gif" alt="loader" class="search-form-loader">
              <p class="wrap-prgh text-center">Still searching... Have questions? Our experts are just a call away</p>
              <a href="tel:<?php echo $phone_number_web3; ?>" class="search-form-callbtn"><i class="fa-solid fa-phone-volume"></i> Call Us <?php echo $phone_number_web3; ?></a>
            </div>
            
          </div>
      </div>
    </div>
  </div>
</section>


<div class="modal fade airline-modal-design" id="airline-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <a href="tel:<?php echo $phone_number_web3; ?>" class="modal-close">&times;</a>  
        <h1 class="modal-header-hding">Airline Sales Price </h1>
        <p class="modal-header-subhding">Due to Airline Policies, This Deal is Call-Only. <br> Hurry, offer ends in</p>
      </div>
      <div class="modal-body">
        <div class="modal-end-timer">End In <span id="countdown"></span></div>
        <h2 class="modal-offer-text">Call Now & Save up to <span>25% Off</span> on Exclusive Deals</h2>
        <div class="d-flex justify-content-center align-items-md-center gap-4 pb-3">
          <div class="w-50">
            <h1 class="modal-search-form-name text-center"><?php echo $leaving_from; ?></h1>
          </div>  
          <h1 class="modal-search-form-icon text-center"> <i class="fa-solid fa-arrow-right-long"></i></h1>
          <div class="w-50">
            <h1 class="modal-search-form-name text-center"><?php echo $going_to; ?></h1>
          </div>  
        </div>
        <div class="modal-deal-box">
          <div class="row">
            <div class="col-md-8">
              <h3 class="modal-deal-name"><?php echo $going_to; ?></h3>
              <p class="modal-deal-text"><?php echo $passenger; ?></p>
              <ul class="modal-search-form-list">
                <li>Adults: <?php echo $adults; ?></li>
                <li>Child: <?php echo $children; ?></li>
                <li>infants: <?php echo $infants; ?></li>
              </ul>
              <ul class="modal-search-form-list">
                <li>Departure Date: <?php echo $departure_date; ?></li>
              </ul>
            </div>
            <div class="col-md-4">
              <div class="modal-price-deal">
                <p class="modal-deal-text">Phone Deal Only*</p>
                <h1 class="wrap-hding pt-1 main-color">$260</h1>
                <p class="modal-price-per-person">Price Per Adult</p>
              </div>
            </div>
          </div>
        </div>
        <a href="tel:<?php echo $phone_number_web3; ?>" class="modal-call-btn"><i class="fa-solid fa-phone-volume"></i> Call Us <?php echo $phone_number_web3; ?></a>
        <p class="modal-note">*Note: All displayed prices are based on searches made in the last 24 hours and are subject to change. <br> Fares are not guaranteed until the ticket is issued.</p>
      </div>
    </div>
  </div>
</div>

    <?php include 'footer.php' ?>

 <script>
  // countdown timer

  let timeLeft = 5 * 60; // 5 minutes in seconds

  const timerElement = document.getElementById('countdown'); // where you show time

  const countdown = setInterval(function() {
      let minutes = Math.floor(timeLeft / 60);
      let seconds = timeLeft % 60;
      seconds = seconds < 10 ? '0' + seconds : seconds;
      timerElement.textContent = `${minutes}:${seconds}`;
      
      if (timeLeft <= 0) {
          clearInterval(countdown);
          // custom modal hide
          //document.getElementById('airline-modal').style.display = 'none'; 

          // Bootstrap modal hide
          $('#airline-modal').modal('hide'); 
          
      }
      timeLeft--;
  }, 1000);

    // modal show after 5 mint
  setTimeout(function() {
      // document.getElementById('airline-modal').style.display = 'none';
      $('#airline-modal').modal('show'); 
  }, 5000); // 5 Second


 </script>