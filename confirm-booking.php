<?php
session_start();
$travel_class = $_SESSION['selected_travel_class'] ?? 'Economy';

// Get submitted data
$offerId       = $_POST['offerId'] ?? null;
$selectedOffer = $_SESSION['flights'][$offerId] ?? null;

if (!$selectedOffer) {
    die("❌ Invalid flight selection.");
}

// Passenger Info
$firstNames  = $_POST['first-name'] ?? [];
$middleNames = $_POST['middle-name'] ?? [];
$lastNames   = $_POST['last-name'] ?? [];
$genders     = $_POST['gender'] ?? [];
$dob         = $_POST['dob'] ?? [];

// Billing Info
$address1 = $_POST['address1'] ?? '';
$address2 = $_POST['address2'] ?? '';
$country  = $_POST['country'] ?? '';
$state    = $_POST['state'] ?? '';
$city     = $_POST['city'] ?? '';
$zip      = $_POST['zip'] ?? '';

// Contact Info
$contact_info_phone = $_POST['phone'] ?? '';
$contact_inf_email = $_POST['email'] ?? '';

// --- Build passengers array in Amadeus format ---
$passengers = [];
for ($i = 0; $i < count($firstNames); $i++) {
    $passengers[] = [
        "id" => (string)($i+1),
        "dateOfBirth" => !empty($dob[$i]) ? date("Y-m-d", strtotime($dob[$i])) : "2000-01-01",
        "name" => [
            "firstName" => ucfirst(trim($firstNames[$i])),
            "lastName"  => ucfirst(trim($lastNames[$i]))
        ],
        "gender" => strtoupper($genders[$i] ?? "MALE"),
        "contact" => [
            "emailAddress" => $contact_inf_email,
            "phones" => [[
                "deviceType" => "MOBILE",
                "countryCallingCode" => "91", // ⚠️ adjust dynamically if needed
                "number" => $contact_info_phone
            ]]
        ],
        "documents" => [[
            "documentType"    => "PASSPORT",
            "number"          => "X1234567",       // placeholder
            "expiryDate"      => "2030-01-01",     // placeholder
            "issuanceCountry" => strtoupper($country ?: "IN"),
            "nationality"     => strtoupper($country ?: "IN"),
            "holder"          => true
        ]]
    ];
}

// Save to session for finalize-booking.php
$_SESSION['passengers'] = $passengers;
$_SESSION['billing'] = [
    "address1" => $address1,
    "address2" => $address2,
    "country"  => $country,
    "state"    => $state,
    "city"     => $city,
    "zip"      => $zip
];
$_SESSION['contact'] = [
    "phone" => $contact_info_phone,
    "email" => $contact_inf_email
];

function getCurrencySymbol($currency) {
    $symbols = [
        "USD" => "$", "EUR" => "€", "GBP" => "£", "INR" => "₹",
        "AED" => "د.إ", "JPY" => "¥", "CNY" => "¥", "CAD" => "C$",
        "AUD" => "A$", "CHF" => "CHF",
    ];
    return $symbols[$currency] ?? $currency;
}

// 🔑 Amadeus API credentials
$client_id     = "IMewQoGGzsLuxu2vR2r9ImKFeRVNbf4m";
$client_secret = "bLW0u8zhqigZYcaC";

// ✅ Get Access Token
function getAmadeusToken($client_id, $client_secret) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://test.api.amadeus.com/v1/security/oauth2/token");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        "grant_type"    => "client_credentials",
        "client_id"     => $client_id,
        "client_secret" => $client_secret
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    return $data["access_token"] ?? null;
}

$token = getAmadeusToken($client_id, $client_secret);

// ✅ Fetch Airport Full Name
function getAirportName($iataCode, $token) {
    static $airportCache = [];

    if (isset($airportCache[$iataCode])) {
        return $airportCache[$iataCode];
    }

    $url = "https://test.api.amadeus.com/v1/reference-data/locations?subType=AIRPORT&keyword=" . urlencode($iataCode);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $token"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($res, true);
    $airportName = $data["data"][0]["name"] ?? $iataCode;
    $airportCache[$iataCode] = $airportName;

    return $airportName;
}

// ✅ Fetch Airline Full Name (Amadeus Dictionary or local mapping)
function getAirlineName($carrierCode) {
    $airlines = [
        "AI" => "Air India",
        "UK" => "Vistara",
        "6E" => "IndiGo",
        "SG" => "SpiceJet",
        "G8" => "Go First",
        "EK" => "Emirates",
        "QR" => "Qatar Airways",
        "BA" => "British Airways",
        "LH" => "Lufthansa",
        // ➕ add more codes as needed
    ];
    return $airlines[$carrierCode] ?? $carrierCode;
}
?>



<?php

    // ✅ Put all `use` here at the top
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // ✅ Require files once here
    require 'mailer/PHPMailer-master/src/Exception.php';
    require 'mailer/PHPMailer-master/src/PHPMailer.php';
    require 'mailer/PHPMailer-master/src/SMTP.php';

    // Build Passenger Rows
    $passengerRows = "";
    for ($i = 0; $i < count($firstNames); $i++) {
        $passengerRows .= htmlspecialchars($firstNames[$i]) . " " 
                       . htmlspecialchars($lastNames[$i]) 
                       . " (" . strtoupper($genders[$i]) . ") - DOB: " 
                       . htmlspecialchars($dob[$i]) . "<br>";
    }

    // Build Flight Rows
    $flightRows = "";
    foreach ($selectedOffer["itineraries"] as $itinerary) {
        $segments = $itinerary["segments"];
        $firstSeg = $segments[0];
        $lastSeg  = $segments[count($segments)-1];

        $depTime = date("h:i A", strtotime($firstSeg["departure"]["at"]));
        $arrTime = date("h:i A", strtotime($lastSeg["arrival"]["at"]));

        $depAirportCode = $firstSeg["departure"]["iataCode"];
        $arrAirportCode = $lastSeg["arrival"]["iataCode"];

        $depAirportFull = getAirportName($depAirportCode, $token);
        $arrAirportFull = getAirportName($arrAirportCode, $token);

        $flightRows .= '<tr>
            <td style="border-bottom: 1px solid #ddd; border-right:1px solid #ddd; padding: 5px;"><strong>Leaving From</strong></td>
            <td style="border-bottom: 1px solid #ddd; padding: 5px 20px;"> '.$depAirportFull.' ('.$depAirportCode.') <br> '.$depTime.'</td>
          </tr>
          <tr style="background: #f9f9f9;">
            <td style="border-bottom: 1px solid #ddd; border-right:1px solid #ddd; padding: 5px;"><strong>Going To</strong></td>
            <td style="border-bottom: 1px solid #ddd; padding: 5px 20px;">'.$arrAirportFull.' ('.$arrAirportCode.') <br> '.$arrTime.'</td>
          </tr>';
    }

    // Airline Info
    $firstItinerary = $selectedOffer["itineraries"][0];
    $firstSeg  = $firstItinerary["segments"][0];
    $airlineCode = $firstSeg["carrierCode"];
    $logoUrl     = "https://static.tripcdn.com/packages/flight/airline-logo/latest/airline_logo/3x/" . strtolower($airlineCode) . ".webp";
    $airlineName = getAirlineName($airlineCode);

    // Receiver (Customer) Message
    $receiverMessage = '<table align="center" width="600" cellpadding="0" cellspacing="0" style="background:#fff; font-size:14px; border:7px double #ddd; padding:0px; font-family:Poppins,sans-serif;">
      <tr>
        <td colspan="2" style="padding:0 20px;">
          <img src="https://www.onetravelportal.com/assets/img/logo/logo.png" alt="logo" style="margin:10px auto; display:block;" width="280">
          <h2 style="text-align:center; display:block; padding:10px 0; color:green;">Booking Confirmation</h2>
          <p style="font-size:14px; color:#333;">Dear <strong>'. $firstNames[0] . " " . $lastNames[0] .'</strong>,</p>
            <p style="font-size:14px; color:#333;">
              Thank you for booking your flight with <strong>One Travel Portal</strong>. Your booking has been successfully confirmed. Below are the details of your flight:
            </p>
        </td>
      </tr>
      <tr style="border-bottom:2px solid #ee9b0f; display:flex;">
        <td width="200" style="padding-left:20px;">
          <img src="' . $logoUrl . '" width="50" alt="' . $airlineCode . '">
          <p style="margin:0; padding:0;">' . htmlspecialchars($airlineName) . '</p>
        </td>
        <td width="400" style="float:right; padding-right:20px;">
          <p style="font-size:15px; color:#333; text-align:right; padding:15px 0; margin:0;">
            <strong>Mobile Number:</strong> '.htmlspecialchars($contact_info_phone).' <br>
            <strong>Email:</strong> '. htmlspecialchars($contact_inf_email) .'
          </p>
        </td>
      </tr>
      <tr style="border-bottom:1px solid #ddd;">  
        <td colspan="2" style="padding:0px 20px;">
          <h2 style="font-weight:700; font-size:18px; margin:0; padding:10px 0 5px;">Booking Details</h2>
          <table style="width:100%; border:1px solid #ddd; font-size:13px" cellspacing="0">
            <tr>
              <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd; padding:5px;"><strong>Passenger</strong></td>
              <td style="border-bottom:1px solid #ddd; padding:5px 20px;">'.$passengerRows.'</td>
            </tr>
            <tr style="background:#f9f9f9;">
              <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd; padding:5px;"><strong>Flight Price</strong></td>
              <td style="border-bottom:1px solid #ddd; padding:5px 20px;">'. getCurrencySymbol($selectedOffer["price"]["currency"]) . " " . $selectedOffer["price"]["total"] .'</td>
            </tr>
            <tr>
              <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd; padding:5px;"><strong>Travel Class</strong></td>
              <td style="border-bottom:1px solid #ddd; padding:5px 20px;">' . htmlspecialchars($travel_class) . '</td>
            </tr>
            '.$flightRows.'
            
          </table>
        </td>
      </tr>
      <tr>
          <td colspan="3" style="padding:10px 20px 0; vertical-align: top">
            <h2 style="font-weight: 700; font-size: 15px; margin: 0; padding: 0px 0 5px;">Address Details </h2>
            <p style="font-size: 13px; margin: 0; padding-bottom: 30px;">'. htmlspecialchars($address1 . " " . $address2 . ", " . $city . ", " . $state . ", " . $country . " - " . $zip) . '  </p>
          </td>
      </tr> 
      <tr>
        <td style="padding:0px 20px;">
            <p style="font-size:14px; color:#333; margin-top:20px;">
              We look forward to serving you on your journey. If you have any questions or need assistance, our support team is available 24/7.
            </p>

            <p style="font-size:14px; color:#333;">
              <strong>Support Number:</strong> <a href="tel:+1844-6985012">+1-844-698-5012</a><br>
              <strong>Email:</strong> <a href="mailto:info@onetravelportal.com">info@onetravelportal.com</a>
            </p>

            <p style="font-size:14px; color:#333; margin-top:30px;">Safe travels,<br><strong>Team One Travel Portal</strong></p>
        </td>
      </tr>
    </table>';

    // Admin Message (short summary)
    $adminMessage = '<table align="center" width="600" cellpadding="0" cellspacing="0" style="background:#fff; font-size:14px; border:7px double #ddd; padding:0px; font-family:Poppins,sans-serif;">
      <tr>
        <td colspan="2">
          <img src="https://www.onetravelportal.com/assets/img/logo/logo.png" alt="logo" style="margin:10px auto; display:block;" width="280">
          <h2 style="text-align:center; display:block; padding:10px 0; color:green;">Booking Confirmation</h2>
        </td>
      </tr>
      <tr style="border-bottom:2px solid #ee9b0f; display:flex;">
        <td width="200" style="padding-left:20px;">
          <img src="' . $logoUrl . '" width="50" alt="' . $airlineCode . '">
          <p style="margin:0; padding:0;">' . htmlspecialchars($airlineName) . '</p>
        </td>
        <td width="400" style="float:right; padding-right:20px;">
          <p style="font-size:15px; color:#333; text-align:right; padding:15px 0; margin:0;">
            <strong>Mobile Number:</strong> '.htmlspecialchars($contact_info_phone).' <br>
            <strong>Email:</strong> '. htmlspecialchars($contact_inf_email) .'
          </p>
        </td>
      </tr>
      <tr>  
        <td colspan="2" style="padding:0px 20px;">
          <h2 style="font-weight:700; font-size:18px; margin:0; padding:10px 0 5px;">Booking Details</h2>
          <table style="width:100%; border:1px solid #ddd; font-size:13px" cellspacing="0">
            <tr>
              <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd; padding:5px;"><strong>Passenger</strong></td>
              <td style="border-bottom:1px solid #ddd; padding:5px 20px;">'.$passengerRows.'</td>
            </tr>
            <tr style="background:#f9f9f9;">
              <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd; padding:5px;"><strong>Flight Price</strong></td>
              <td style="border-bottom:1px solid #ddd; padding:5px 20px;">'. getCurrencySymbol($selectedOffer["price"]["currency"]) . " " . $selectedOffer["price"]["total"] .'</td>
            </tr>
            <tr>
              <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd; padding:5px;"><strong>Travel Class</strong></td>
              <td style="border-bottom:1px solid #ddd; padding:5px 20px;">' . htmlspecialchars($travel_class) . '</td>
            </tr>
            '.$flightRows.'
          </table>
        </td>
      </tr>
      <tr>
          <td colspan="3" style="padding:10px 20px 0; vertical-align: top">
            <h2 style="font-weight: 700; font-size: 15px; margin: 0; padding: 0px 0 5px;">Address Details </h2>
            <p style="font-size: 13px; margin: 0; padding-bottom: 30px;">'. htmlspecialchars($address1 . " " . $address2 . ", " . $city . ", " . $state . ", " . $country . " - " . $zip) . '  </p>
          </td>
      </tr> 
    </table>';

    if ($contact_inf_email != '') {

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->CharSet = "UTF-8";
            $mail->Host       = "mail.onetravelportal.com";
            $mail->SMTPAuth   = true;
            $mail->Username   = "info@onetravelportal.com";
            $mail->Password   = "SuNi-info@321#";
            $mail->SMTPSecure = "tls";
            $mail->Port       = 587;
            $mail->isHTML(true);

            $mail->setFrom("info@onetravelportal.com", "One Travel Portal");

            // 1️ Customer Email

            $mail->addAddress($contact_inf_email, $firstNames[0] . " " . $lastNames[0]);
            $mail->Subject = "✈️ " . $firstNames[0] . " " . $lastNames[0] . " Booking Confirmation - " 
                           . $selectedOffer["itineraries"][0]["segments"][0]["departure"]["iataCode"] 
                           . " to " 
                           . $selectedOffer["itineraries"][0]["segments"][count($selectedOffer["itineraries"][0]["segments"]) - 1]["arrival"]["iataCode"];
            $mail->Body    = $receiverMessage;
            $mail->send();

            // 2️ Admin Email

            $mail->ClearAllRecipients();
            $mail->addAddress("info@onetravelportal.com", "Booking Admin");
            //$mail->Subject = "🔔 New Booking from " . $firstNames[0] . " " . $lastNames[0];
            $mail->Subject = "🔔 New Booking from " . $firstNames[0] . " " . $lastNames[0] . " Booking Confirmation - " 
                           . $selectedOffer["itineraries"][0]["segments"][0]["departure"]["iataCode"] 
                           . " to " 
                           . $selectedOffer["itineraries"][0]["segments"][count($selectedOffer["itineraries"][0]["segments"]) - 1]["arrival"]["iataCode"];
            $mail->Body    = $adminMessage;
            $mail->send();

        } catch (Exception $e) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Confirmation</title>
  <?php include("header.php") ?>
  <style>
    /*body { background:#f9f9f9; }*/
    
    .confirm-heading { font-size:22px; font-weight:600; margin-bottom:15px; }
    .success-msg_web2 { font-size:20px; font-weight:600; color:#28a745; }
  </style>

<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-8">
        <div class="booking-review-card mb-3">
          <h3 class="main-subhding text-success pt-0 pb-1 mb-0">✅ Your booking details have been received!</h3>
          <P class="main-prgh mb-0">Please review your details below. We will contact you regarding your flight booking</P>
        </div>

        <!-- <input type="hidden" name="adults" value="<?= $adults ?>" id="adults">
        <input type="hidden" name="children" value="<?= $children ?>" id="children">
        <input type="hidden" name="infants" value="<?= $infants ?>" id="infants"> -->

        <!-- Passenger Info -->
        <div class="confirm-box">
            <h3 class="main-subhding pt-0 pb-3">Passenger Details</h3>
            <!--Start Desktop Design -->
            <div class="table-responsive d-none d-md-block">
                <table class="table passenger_table_web2">
                    <thead>
                        <tr>
                            <th>Passenger</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($firstNames); $i++): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= htmlspecialchars($firstNames[$i]) ?> <?= htmlspecialchars($lastNames[$i]) ?></td>
                            <td><?= htmlspecialchars(strtoupper($genders[$i])) ?></td>
                            <td><?= htmlspecialchars($dob[$i]) ?></td>
                            <td>
                                <?php 
                                if (!empty($dob[$i])) {
                                    $dobDate = new DateTime($dob[$i]);
                                    $today   = new DateTime();
                                    $age     = $today->diff($dobDate)->y;
                                    echo $age;
                                } else {
                                    echo "-";
                                }
                                ?>
                            </td>
                        </tr>
                        <?php endfor; ?>   
                    </tbody>
                </table>
            </div>
            <!--End Desktop Design -->
            
            <!--Start Mobile Design -->
            <?php for($i = 0; $i < count($firstNames); $i++): ?>
            <div class="passenger-mob-zdesign d-block d-md-none">
                <div class="row">
                    <div class="col-auto">
                        <div class="passenger-mob-num"><?= $i+1 ?></div>
                    </div>
                    <div class="col">
                        <div class="d-flex gap-3">
                            <p class="passenger-mob-name"><?= htmlspecialchars($firstNames[$i]) ?> <?= htmlspecialchars($lastNames[$i]) ?></p>
                            <p class="passenger-mob-gender">(<?= htmlspecialchars(strtoupper($genders[$i])) ?>)</p>
                        </div>    
                        <p class="passenger-mob-dob">
                            <?= htmlspecialchars($dob[$i]) ?> 
                            (<?php 
                                if (!empty($dob[$i])) {
                                    $dobDate = new DateTime($dob[$i]);
                                    $today   = new DateTime();
                                    $age     = $today->diff($dobDate)->y;
                                    echo $age;
                                } else {
                                    echo "-";
                                }
                                ?>)
                        </p>
                    </div>
                </div>
            </div>
            <?php endfor; ?>   
            <!--Start Mobile Design -->

        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                 <!-- Billing Info -->
                <div class="confirm-box h-100">
                    <h3 class="main-subhding pt-0 pb-3">Address Information</h3>
                    <p class="main-prgh pb-1 mb-0"><span class="summary-label">Address:</span> <?= htmlspecialchars($address1.' '.$address2) ?></p>
                    <p class="main-prgh pb-1 mb-0"><span class="summary-label">City:</span> <?= htmlspecialchars($city) ?>, <?= htmlspecialchars($state) ?></p>
                    <p class="main-prgh pb-1 mb-0"><span class="summary-label">Country:</span> <?= htmlspecialchars($country) ?></p>
                    <p class="main-prgh pb-1 mb-0"><span class="summary-label">Zip Code:</span> <?= htmlspecialchars($zip) ?></p>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <!-- Contact Info -->
                <div class="confirm-box h-100">
                    <h3 class="main-subhding pt-0 pb-3">Contact Information</h3>
                    <p class="main-prgh pb-1 mb-0"><span class="summary-label">Phone:</span> <?= htmlspecialchars($contact_info_phone) ?></p>
                    <p class="main-prgh pb-1 mb-0"><span class="summary-label">Email:</span> <?= htmlspecialchars($contact_inf_email) ?></p>
                </div>
            </div>
        </div>
       

        

      </div>
      <div class="col-md-12 col-lg-4">
        <div class="confirm-box">
            <h3 class="main-subhding pt-0">Flight Details</h3>
            <hr>
            <?php if ($selectedOffer): ?>
            <div class="">
                <?php foreach ($selectedOffer["itineraries"] as $itinerary): ?>
                  <?php
                    $segments  = $itinerary["segments"];
                    $firstSeg  = $segments[0];
                    $lastSeg   = $segments[count($segments)-1];

                    $depTime   = date("h:i A", strtotime($firstSeg["departure"]["at"]));
                    $arrTime   = date("h:i A", strtotime($lastSeg["arrival"]["at"]));
                    $depAirport = $firstSeg["departure"]["iataCode"];
                    $arrAirport = $lastSeg["arrival"]["iataCode"];

                    // duration
                    $depDT = strtotime($firstSeg["departure"]["at"]);
                    $arrDT = strtotime($lastSeg["arrival"]["at"]);
                    $durationMin = round(($arrDT - $depDT)/60);
                    $hrs = floor($durationMin / 60);
                    $mins = $durationMin % 60;
                    $duration = "{$hrs}h {$mins}m";

                    // airline
                    $airlineCode = $firstSeg["carrierCode"];
                    $airlineName = getAirlineName($airlineCode);

                    $depAirportCode = $firstSeg["departure"]["iataCode"];
                    $arrAirportCode = $lastSeg["arrival"]["iataCode"];

                    $depAirportFull = getAirportName($depAirportCode, $token);
                    $arrAirportFull = getAirportName($arrAirportCode, $token);

                    $logoUrl = "https://static.tripcdn.com/packages/flight/airline-logo/latest/airline_logo/3x/" . strtolower($airlineCode) . ".webp";

                    $stops = count($segments) - 1;
                  ?>
                <div class="row align-items-center mb-3 row-bot-border">
                    <div class="col-6">
                        <div class="d-flex d-md-block align-items-center gap-3 mb-2 mb-md-0">
                            <img src="<?= $logoUrl ?>" width="50" alt="<?= $airlineCode ?>">
                            <p class="flight-logo-name">
                                 <?= htmlspecialchars($airlineName) ?> 
                            </p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-end">
                            <div class="flight-result_duration_web2">
                                <?= $duration ?>
                                <div class="flight-duration_line_web2"></div>
                                <?php if ($stops > 0): ?>
                                    <small class="text-muted"><?= $stops ?> Stop<?= $stops > 1 ? "s" : "" ?></small>
                                <?php else: ?>
                                    <small class="text-muted">Non-stop</small>
                                <?php endif; ?>
                            </div> 
                        </div>    
                    </div>
                    <div class="col">
                        <div class="row text-center">
                            <div class="col-12 mb-3">
                                <h5 class="flight-time"><?= $depTime ?></h5>
                                <p class="flight-location"><?= $depAirportFull ?> (<?= $depAirportCode ?>)</p>
                            </div>
                            <div class="col-12">
                                <h5 class="flight-time"><?= $arrTime ?></h5>
                                <p class="flight-location"><?= $arrAirportFull ?> (<?= $arrAirportCode ?>)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="confirm-box">
            <h3 class="main-subhding text-center pt-0 pb-3">Call For Assistance Click to call for 24/7 Customer Service</h3>
            <a href="tel:<?php echo $phone_number_web3; ?>"><h2 class="theme-btn mx-auto d-table"><i class="fa-solid fa-phone-volume"></i> <?php echo $phone_number_web3; ?></h2></a>
            
        </div>    
      </div>
      
    </div>
  </div>
</section>


<?php include("footer.php"); ?>
