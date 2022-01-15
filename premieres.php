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
    <meta http-equiv="Access-Control-Allow-Origin" content="*"></head>
</head>

<body>


<?php
require_once 'incs/header_search.php';
?>

    <!-- breadcrumb -->
    <div class="gen-breadcrumb" style="background-image: url('images/background/asset-25.jpg');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <div class="gen-breadcrumb-title">
                            <h1>
                                Niiflicks Premieres
                            </h1>
                        </div>
                        <div class="gen-breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index"><i
                                            class="fas fa-home mr-2"></i>Home</a></li>
                                <li class="breadcrumb-item active">Premieres</li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->




   
    </div>

    
    
    <section id="app-2" class="gen-section-padding-2">
        <div class="container">
            <div class="row">
                
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <h4 class="gen-heading-title">Latest Premieres</h4>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 d-none d-md-inline-block">
                    <div class="gen-movie-action">
                        <div class="gen-btn-container text-right">
                            <a href="all_premieres/latest" class="gen-button gen-button-flat">
                                <span class="text">View All</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="gen-style-2">
                        <div id="renda" class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true"
                            data-desk_num="4" data-lap_num="3" data-tab_num="2" data-mob_num="1" data-mob_sm="1"
                            data-autoplay="false" data-loop="false" data-margin="30">
                            
                            <?php
                            require_once 'incs/experiment.php';
                            $try = new premiers;
                            $try->get_premiers();
                            ?>



                      
                      


                            <!-- <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-2 movie-grid style-2">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-11.jpg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-videos.html" class="gen-button">
                                                        <i class="fa fa-credit-card"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-videos.html">Big Machine</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>&#8358; 2000</li>
                                                        <li>
                                                            <a href="traveling.html"><span>Traveling</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- owl-carousel Videos Section-1 End -->




 <!-- owl-carousel Videos Section-2 Start -->
 <section class="gen-section-padding-2 pt-0">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <h4 class="gen-heading-title">Trending</h4>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 d-none d-md-inline-block">
                <div class="gen-movie-action">
                    <div class="gen-btn-container text-right">
                        <a href="all_premieres/trending" class="gen-button gen-button-flat">
                            <span class="text">View All</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="gen-style-2">
                    <div id="trend" class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true"
                        data-desk_num="4" data-lap_num="3" data-tab_num="2" data-mob_num="1" data-mob_sm="1"
                        data-autoplay="false" data-loop="false" data-margin="30">


                      
                        <?php
                        $try->get_trending();
                        ?>




                        <!-- <div class="item">
                            <div class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                <div class="gen-carousel-movies-style-2 movie-grid style-2">
                                    <div class="gen-movie-contain">
                                        <div class="gen-movie-img">
                                            <img src="images/background/asset-10.jpg"
                                                alt="owl-carousel-video-image">
                                            <div class="gen-movie-add">
                                                <div class="wpulike wpulike-heart">
                                                    <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                        <button type="button"
                                                            class="wp_ulike_btn wp_ulike_put_image"></button>
                                                    </div>
                                                </div>
                                                <ul class="menu bottomRight">
                                                    <li class="share top">
                                                        <i class="fa fa-share-alt"></i>
                                                        <ul class="submenu">
                                                            <li><a href="#" class="facebook"><i
                                                                        class="fab fa-facebook-f"></i></a>
                                                            </li>
                                                            <li><a href="#" class="facebook"><i
                                                                        class="fab fa-instagram"></i></a>
                                                            </li>
                                                            <li><a href="#" class="facebook"><i
                                                                        class="fab fa-twitter"></i></a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <div class="movie-actions--link_add-to-playlist dropdown">
                                                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                            class="fa fa-plus"></i></a>
                                                    <div class="dropdown-menu mCustomScrollbar">
                                                        <div class="mCustomScrollBox">
                                                            <div class="mCSB_container">
                                                                <a class="login-link" href="register.html">Sign in
                                                                    to add this
                                                                    movie to a
                                                                    playlist.</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gen-movie-action">
                                                <a href="single-videos.html" class="gen-button">
                                                    <i class="fa fa-credit-card"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="gen-info-contain">
                                            <div class="gen-movie-info">
                                                <h3><a href="single-videos.html">skull’s world</a>
                                                </h3>
                                            </div>
                                            <div class="gen-movie-meta-holder">
                                                <ul>
                                                    <li>3 years</li>
                                                    <li>
                                                        <a href="horror.html"><span>Horror</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div> -->

                       


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- owl-carousel Videos Section-2 End -->



   

    <!-- footer start -->
    <footer id="gen-footer">
        <div class="gen-footer-style-1">
            
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
    <!-- vue script-->

   

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
    <script>
        $(document).ready(function(){
            let sform = document.getElementById('search_form');
            sform.addEventListener('submit',function(e){
                e.preventDefault();
                let sterm = document.getElementById('s_term').value;
                location.href=`search/${sterm}`;
            })
        });
    </script>


</body>

</html>