<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="Niiflicks, streaming, movies, live footbal, streaming" />
    <meta name="description" content="Niiflicks - Stream your favourite movies, listen to your favourite songs and get live sports" />
    <meta name="author" content="vibetek" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Niiflicks - Watch Movies Online</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.png">
    <!-- CSS bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!--  Style -->
    <link rel="stylesheet" href="css/style.css" />
    <!--  Responsive -->
    <link rel="stylesheet" href="css/responsive.css" />
</head>

<body>

    <!--=========== Loader =============-->
    <div id="gen-loading">
        <div id="gen-loading-center">
            <img src="images/niiflicks-logo.png" alt="loading">
        </div>
    </div>
    <!--=========== Loader =============-->

    <?php
    include_once 'incs/header.php';
    ?>
    <!-- breadcrumb -->
    <div class="gen-breadcrumb" style="background-image: url('images/background/asset-25.jpg');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <div class="gen-breadcrumb-title">
                            <h1>
                                Adverts
                            </h1>
                        </div>
                        <div class="gen-breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i
                                            class="fas fa-home mr-2"></i>Home</a></li>
                                <li class="breadcrumb-item active">Adverts</li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

        <!-- register -->
         <section class="position-relative pb-0">
            <!--<div class="gen-register-page-background" style="background-image: url('images/background/asset-3.jpg');">
            </div> -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <form id="pms_register-form" class="pms-form" method="POST">
                                <h4>Advertise with Us here</h4>
                                <input type="hidden" id="pmstkn" name="pmstkn" value="59b502f483"><input type="hidden"
                                    name="_wp_http_referer" value="/register/">
                                <ul class="pms-form-fields-wrapper pl-0">
                                    <li class="pms-field pms-user-login-field ">
                                        <label for="pms_user_login">Upload video *</label>
                                        <input id="pms_user_login" name="user_login" type="file" value="">
                                    </li>
                                    <li class="pms-field pms-user-email-field ">
                                        <label for="pms_user_email">Callback Url *</label>
                                        <input id="pms_user_email" name="user_email" type="text" value="">
                                        <p style="color: red;">Note: When Ad is clicked, add url to direct the user</p>
                                    </li>
                                    <li class="pms-field pms-first-name-field ">
                                        <label for="pms_first_name">Email Address *</label>
                                        <input id="pms_first_name" name="first_name" type="email" value="">
                                    </li>

                                    <!--<li class="pms-field pms-last-name-field ">
                                        <label for="pms_last_name">Last Name</label>
                                        <input id="pms_last_name" name="last_name" type="text" value="">
                                    </li>
                                    <li class="pms-field pms-pass1-field">
                                        <label for="pms_pass1">Password *</label>
                                        <input id="pms_pass1" name="pass1" type="password">
                                    </li>
                                    <li class="pms-field pms-pass2-field">
                                        <label for="pms_pass2">Repeat Password *</label>
                                        <input id="pms_pass2" name="pass2" type="password">
                                    </li> -->
                                    <label>Impressions:</label>
                                    <li class="pms-field pms-field-subscriptions ">
                                        <div class="pms-subscription-plan"><label><input type="radio"
                                                    name="subscription_plans" data-price="199" data-duration="1"
                                                    value="2.50" checked="checked" data-default-selected="true"><span
                                                    class="pms-subscription-plan-name">100 - 500 views</span><span
                                                    class="pms-subscription-plan-price"><span class="pms-divider"> -
                                                    </span><span class="pms-subscription-plan-price-value">2.50</span><span
                                                        class="pms-subscription-plan-currency">&#8358;</span><span
                                                        class="pms-divider"> / </span>Per View</span><span
                                                    class="pms-subscription-plan-trial"></span><span
                                                    class="pms-subscription-plan-sign-up-fee"></span></label></div>
                                        <div class="pms-subscription-plan"><label><input type="radio"
                                                    name="subscription_plans" data-price="99" data-duration="1" value="7329"
                                                    data-default-checked="false"><span
                                                    class="pms-subscription-plan-name">1,000 - 10,000 Views</span><span
                                                    class="pms-subscription-plan-price"><span class="pms-divider"> -
                                                    </span><span class="pms-subscription-plan-price-value">2.25</span><span
                                                        class="pms-subscription-plan-currency">&#8358;</span><span
                                                        class="pms-divider"> / </span>Per view</span><span
                                                    class="pms-subscription-plan-trial"></span><span
                                                    class="pms-subscription-plan-sign-up-fee"></span></label></div>
                                        <div class="pms-subscription-plan"><label><input type="radio"
                                                    name="subscription_plans" data-price="29" data-duration="1" value="7328"
                                                    data-default-checked="false"><span
                                                    class="pms-subscription-plan-name">10,000 - 100,000 Views</span><span
                                                    class="pms-subscription-plan-price"><span class="pms-divider"> -
                                                    </span><span class="pms-subscription-plan-price-value">2.00</span><span
                                                        class="pms-subscription-plan-currency">&#8358;</span><span
                                                        class="pms-divider"> / </span>Per View</span><span
                                                    class="pms-subscription-plan-trial"></span><span
                                                    class="pms-subscription-plan-sign-up-fee"></span></label></div>
                                     <div class="pms-subscription-plan"><label><input type="radio"
                                                        name="subscription_plans" data-price="29" data-duration="1" value="7328"
                                                        data-default-checked="false"><span
                                                        class="pms-subscription-plan-name">100,000 - 1,000,000 Views</span><span
                                                        class="pms-subscription-plan-price"><span class="pms-divider"> -
                                                        </span><span class="pms-subscription-plan-price-value">1.95</span><span
                                                            class="pms-subscription-plan-currency">&#8358;</span><span
                                                            class="pms-divider"> / </span>Per View</span><span
                                                        class="pms-subscription-plan-trial"></span><span
                                                        class="pms-subscription-plan-sign-up-fee"></span></label></div>    
                                
                                     <div class="pms-subscription-plan"><label><input type="radio"
                                                            name="subscription_plans" data-price="29" data-duration="1" value="7328"
                                                            data-default-checked="false"><span
                                                            class="pms-subscription-plan-name">1,000,000 - Above Views</span><span
                                                            class="pms-subscription-plan-price"><span class="pms-divider"> -
                                                            </span><span class="pms-subscription-plan-price-value">1.90</span><span
                                                                class="pms-subscription-plan-currency">&#8358;</span><span
                                                                class="pms-divider"> / </span>Per View</span><span
                                                            class="pms-subscription-plan-trial"></span><span
                                                            class="pms-subscription-plan-sign-up-fee"></span></label></div> 
                                        <div id="pms-paygates-wrapper"><input type="hidden" class="pms_pay_gate"
                                                name="pay_gate" value="paypal_standard"></div>
                                    </li>
                                </ul>
                                <span id="pms-submit-button-loading-placeholder-text" class="d-none">Processing. Please
                                    wait...</span>
                                <input name="pms_register" type="submit" value="Pay"><br>
                                
                            </form>
                            <p style="color: red;">* Pls make sure everything is correct before paying for the advert</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- register -->

   

 <!-- footer start -->
 <footer id="gen-footer">
    <div class="gen-footer-style-1">
        <!-- <div class="gen-footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="widget">
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="images/niiflicks-logo.png" class="gen-footer-logo" alt="gen-footer-logo">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    </p>
                                    <ul class="social-link">
                                        <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#" class="facebook"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#" class="facebook"><i class="fab fa-skype"></i></a></li>
                                        <li><a href="#" class="facebook"><i class="fab fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <!-- <div class="widget">
                            <h4 class="footer-title">Explore</h4>
                            <div class="menu-explore-container">
                                <ul class="menu">
                                    <li class="menu-item">
                                        <a href="index.html" aria-current="page">Home</a>
                                    </li>
                                    <li class="menu-item"><a href="movies-pagination.html">Movies</a></li>
                                    <li class="menu-item"><a href="tv-shows-pagination.html">Tv Shows</a></li>
                                    <li class="menu-item"><a href="video-pagination.html">Videos</a></li>
                                    <li class="menu-item"><a href="#">Actors</a></li>
                                    <li class="menu-item"><a href="#">Basketball</a></li>
                                    <li class="menu-item"><a href="#">Celebrity</a></li>
                                    <li class="menu-item"><a href="#">Cross</a></li>
                                </ul>
                            </div>
                        </div> 
                    </div>
                    <!-- <div class="col-xl-3 col-md-6">
                        <div class="widget">
                            <h4 class="footer-title">Company</h4>
                            <div class="menu-about-container">
                                <ul class="menu">
                                    <li class="menu-item"><a href="contact-us.html">Company</a>
                                    </li>
                                    <li class="menu-item"><a href="contact-us.html">Privacy
                                            Policy</a></li>
                                    <li class="menu-item"><a href="contact-us.html">Terms Of
                                            Use</a></li>
                                    <li class="menu-item"><a href="contact-us.html">Help
                                            Center</a></li>
                                    <li class="menu-item"><a href="contact-us.html">contact us</a></li>
                                    <li class="menu-item"><a href="pricing-style-1.html">Subscribe</a></li>
                                    <li class="menu-item"><a href="#">Our Team</a></li>
                                    <li class="menu-item"><a href="contact-us.html">Faq</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> 
                    <div class="col-xl-3  col-md-6">
                        <div class="widget">
                            <h4 class="footer-title">Downlaod our App</h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>Download Niiflicks mobile application from google play store.
                                    </p>
                                    <a href="#">
                                        <img src="images/asset-35.png" class="gen-playstore-logo" alt="playstore">
                                    </a>
                                    <!-- <a href="#">
                                        <img src="images/asset-36.png" class="gen-appstore-logo" alt="appstore">
                                    </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="gen-copyright-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 align-self-center">
                        <span class="gen-copyright"><a target="_blank" href="#"> Copyright 2021 Niiflicks All Rights
                                Reserved.</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer End -->

    <!-- Back-to-Top start -->
    <div id="back-to-top">
        <a class="top" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
    </div>
    <!-- Back-to-Top end -->

    <!-- js-min -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/asyncloader.min.js"></script>
    <!-- JS bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- owl-carousel -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- counter-js -->
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <!-- popper-js -->
    <script src="js/popper.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <!-- Iscotop -->
    <script src="js/isotope.pkgd.min.js"></script>

    <script src="js/jquery.magnific-popup.min.js"></script>

    <script src="js/slick.min.js"></script>

    <script src="js/streamlab-core.js"></script>

    <script src="js/script.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/hollywood.js"></script>


</body>

</html>