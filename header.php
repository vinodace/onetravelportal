<?php 
    $phone_number_web3 = "+1-844-698-5012";
    $email_address_web3 = "info@onetravelportal.com";
    $domainurl_web3 ="onetravelportal.com";
    $domain_name_web3 = "One Travel Portal";

?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<< Favcion >>-->
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <!--<< Bootstrap min.css >>-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--<< All Min Css >>-->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!--<< Animate.css >>-->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!--<< Magnific Popup.css >>-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!--<< MeanMenu.css >>-->
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <!--<< Swiper Bundle.css >>-->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <!--<< Nice Select.css >>-->
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <!--<< Color.css >>-->
    <link rel="stylesheet" href="assets/css/color.css">
    <!--<< flacticon.css >>-->
    <link rel="stylesheet" href="assets/css/flacticon.css">
    <!--<< Main.css >>-->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/css/flight-search-form.css">
    <!--<< Jqueryui >>-->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body>
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
    <!--<< Back-Top Start >>-->
    <button id="back-top" class="back-to-top">
        <i class="fa-regular fa-arrow-up"></i>
    </button>
    <!-- Offcanvas Area Start -->
    <div class="fix-area">
        <div class="offcanvas__info">
            <div class="offcanvas__wrapper">
                <div class="offcanvas__content">
                    <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                        <div class="offcanvas__logo">
                            <a href="./">
                                <img src="assets/img/logo/logo.png" alt="logo-img">
                            </a>
                        </div>
                        <div class="offcanvas__close">
                            <button>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mobile-menu fix mb-3"></div>
                    <div class="offcanvas__contact">
                        <h4>Contact Info</h4>
                        <ul>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon">
                                    <i class="fal fa-map-marker-alt"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a target="_blank" href="#">Main Street, Melbourne, Australia</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="mailto:<?php echo $email_address_web3; ?>"><span ><?php echo $email_address_web3; ?></span></a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="far fa-phone"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="tel:<?php echo $phone_number_web3; ?>"><?php echo $phone_number_web3; ?></a>
                                </div>
                            </li>
                        </ul>
                        
                        <div class="social-icon d-flex align-items-center">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas__overlay"></div>
    
    
    <!-- header-main -->
    <div id="header-sticky" class="header-1">
        <div class="container">
            <div class="mega-menu-wrapper">
                <div class="header-main">
                    <div class="logo">
                        <a href="./" class="header-logo">
                            <img src="assets/img/logo/logo.png" alt="logo-img">
                        </a>
                    </div>
                    <div class="header-right d-flex justify-content-end align-items-center">
                        <div class="mean__menu-wrapper">
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li class="active">
                                            <a href="./">
                                                Home
                                            </a>
                                        </li>
                                        <li>
                                            <a href="about-us.php">About Us</a>
                                        </li>
                                        <li>
                                            <a href="destinations.php">
                                                Destinations
                                            </a>
                                        </li>
                                        <li>
                                            <a href="contact-us.php">Contact Us</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="header__hamburger my-auto d-block d-lg-none">
                            <div class="sidebar__toggle">
                                <img src="assets/img/icon/bars.svg" alt="img">
                            </div>
                        </div>
                        <a href="tel:<?php echo $phone_number_web3; ?>" class="theme-btn">Call Us : <?php echo $phone_number_web3; ?>
                            <img src="assets/img/icon/white-arrow.svg" alt="img">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
