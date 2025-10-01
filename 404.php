<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ======== Page title ============ -->
    <title>404 Page Not Found</title>
    
    <?php include 'header.php'; ?>

    <!-- Breadcrumb-Section Start -->
    <section class="breadcrumb-wrapper fix bg-cover"
        style="background-image: url(assets/img/breadcrumb/breadcrumb.jpg);">
        <div class="container">
            <div class="row">
                <div class="page-heading">
                    <h2>Page Not Found</h2>
                    <ul class="breadcrumb-list">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><i class="fa-solid fa-chevrons-right"></i></li>
                        <li class="active">Error</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

   
    <!-- not found section -->
    <section class="found-section section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="found-item">
                        <div class="shape">
                            <img src="assets/img/shape/error.png" alt="">
                        </div>
                        <div class="shape2">
                            <img src="assets/img/shape/error2.png" alt="">
                        </div>
                        <div class="shape3">
                            <img src="assets/img/shape/error3.png" alt="">
                        </div>
                        <div class="error">
                            4<span>0</span>4
                        </div>
                        <h2>Oops! Somethings Went Wrong <br>
                            Please Try Again Later
                        </h2>
                        <p>Sorry about that, but the page you looking is not available now</p>
                        <a href="./" class="theme-btn">Back To Home
                            <img src="assets/img/icon/white-arrow.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <?php include 'footer.php' ?>