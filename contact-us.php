<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ======== Page title ============ -->
    <title>Contact Us</title>
    
    <?php include 'header.php'; ?>

    <!-- Breadcrumb-Section Start -->
    <section class="breadcrumb-wrapper fix bg-cover"
        style="background-image: url(assets/img/breadcrumb/breadcrumb.jpg);">
        <div class="container">
            <div class="row">
                <div class="page-heading">
                    <h2>Contact Us</h2>
                    <ul class="breadcrumb-list">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><i class="fa-solid fa-chevrons-right"></i></li>
                        <li class="active">Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

     <!-- contact-info-section start -->
    <section class="contact-info-section section-padding fix">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="info-items">
                        <div class="icon">
                            <img src="assets/img/icon/19.svg" alt="">
                        </div>
                        <h3>Office Address</h3>
                        <p>1433 1st Ave N, Texas City, TX 77590</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="info-items">
                        <div class="icon">
                            <img src="assets/img/icon/20.svg" alt="">
                        </div>
                        <h3>Call Us For Help</h3>
                        <p><?php echo $phone_number_web3; ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="info-items">
                        <div class="icon">
                            <img src="assets/img/icon/21.svg" alt="">
                        </div>
                        <h3>Email Us Anytime:</h3>
                        <p><?php echo $email_address_web3; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact-Section Start -->
    <section class="contact-section section-padding fix section-bg bg-cover"
        style="background-image: url(assets/img/contact/bg.png);">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="contact-wrapper">
                        <div class="section-title">
                            <span class="sub-title wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                Contact Us
                            </span>
                            <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                Connect With Our Travel Experts
                            </h2>
                        </div>
                        <div class="contact-thumb">
                            <img src="assets/img/contact/1.jpg" class="ex" alt="img">
                            <h4><img src="assets/img/icon/phone.svg" alt="img"> <?php echo $phone_number_web3; ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form style-2">
                        <h3>Fill The Contact Form</h3>
                        <p>Feel free to contact with us, we don't spam your email</p>
                        <form action="enquiry.php" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-clt">
                                        <input type="text" name="name" id="name" placeholder="Your name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-clt">
                                        <input type="tel" name="phone" id="phone" placeholder="Phone number">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-clt">
                                        <input type="email" name="email" id="email" placeholder="Email address">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-clt">
                                        <textarea name="message" id="message"
                                            placeholder="Write your message"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="submit" class="theme-btn style-2">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- map section start -->
    <div class="map-section">
        <div class="map-items">
            <div class="googpemap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3476.4779605941058!2d-94.91875892534806!3d29.385570975261924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x863f79b788219303%3A0x9f0bab9f4acfa081!2s1433%201st%20Ave%20N%2C%20Texas%20City%2C%20TX%2077590%2C%20USA!5e0!3m2!1sen!2sin!4v1758210504560!5m2!1sen!2sin" style="border:0; width:100%; height: 450px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
 
    <?php include 'footer.php' ?>