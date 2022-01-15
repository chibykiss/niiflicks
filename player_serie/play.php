<?php
    session_start();
    if(isset($_GET['srid']) && isset($_GET['senid']) && isset($_GET['epdid']) && isset($_GET['seno']) && isset($_SESSION['s_id'])){
        $thisserie = $_GET['srid'];
        $thisseason = $_GET['senid'];
        $thisepisode = $_GET['epdid'];
        $thisseano = $_GET['seno'];
        $thisuser = $_SESSION['uml'];
    }
    else{
        if(isset($_SESSION['s_id']) && isset($_SESSION['sea_id']) && isset($_SESSION['uml']) && isset($_SESSION['epz_id']) && isset($_SESSION['uml'])){
            $thisserie = $_SESSION['s_id'];
            $thisseason = $_SESSION['sea_id'];
            $thisepisode = $_SESSION['epz_id'];
            $thisuser = $_SESSION['uml'];
            $thisseano = $_SESSION['ses_no'];
            //echo $thisepisode;
        }else{
            header("location: ../index.php");
        }
    }
        
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
<base href="http://localhost/niiflicks.com/player_serie" />
    <meta charset="utf-8">
    <meta name="keywords" content="Niiflicks, streaming, movies, live footbal, streaming" />
    <meta name="description" content="Niiflicks - Stream your favourite movies, listen to your favourite songs and get live sports" />
    <meta name="author" content="Vibetek" />
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
    <!--plyr css import-->
    <link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/vjs.css"/>
    <link rel="stylesheet" href="css/videojscss.css"/>
</head>

<body>

    <!--=========== Loader =============-->
    <!-- <div id="gen-loading">
        <div id="gen-loading-center">
            <img src="../images/niiflicks-logo.png" alt="loading">
        </div>
    </div> -->
    <!--=========== Loader =============-->

    <?php
        require_once '../incs/header.php';
    ?>

    <!-- Single Video Start -->
    <section class="gen-section-padding-3 gen-single-video">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-12">
                    <div class="row">

                        <?php
                            require_once 'get_seriez.php';
                            $newserie = new getit;
                            $newserie->mySerie($thisserie,$thisseason,$thisepisode,$thisseano);
                        ?>
                          <input id="user" type="hidden" value="<?=$thisuser?>"/>
                          <input id="siid" type="hidden" value="<?=$thisserie?>"/>
                          <input id="seen" type="hidden" value="<?=$thisseason?>"/>
                          <input id="seno" type="hidden" value="<?=$thisseano?>"/>
                          

                                        <!-- <div class="gen-library container"> 
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form>
                                                        <div class="gen-register-form">
                                                            <h2>App Registered Email Here</h2>
                                                            <label>Email address *</label>
                                                            <input type="email" name="email" value="">
                                                            <div class="form-button">
                                                                <button type="submit" name="register" value="Register">Buy Token</button>
                                                            </div>
                                                        </div>
                                                        <div class="gen-recover-password">
                                                            
                                                            <a href="recover-password.html">Please note that you can only use your niiflicks mobile application registered email address.</a>
                                                            <a style="color: rgb(255, 255, 255);" href="">Get App</a>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div> -->
        
  
                                    
                                        <!-- <a href="tv-shows-pagination.html" class="gen-button gen-button-flat">
                                            <span class="text">More Videos</span>
                                        </a> -->
                                   
                                    <!--<div class="gen-socail-share mt-0">
                                             <h4 class="align-self-center">Social Share :</h4>
                                            <ul class="social-inner">
                                                <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#" class="facebook"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#" class="facebook"><i class="fab fa-twitter"></i></a></li>
                                            </ul> 
                                        
                                    </div>-
                                    
                                       
                                </div>
                            </div>
                        </div> -->
            
                        <div class="col-lg-12">
                            <div class="pm-inner">
                                <div class="gen-more-like">
                                    <h5 class="gen-more-title">More Episodes</h5>
                                    <div class="row post-loadmore-wrapper">
                                        <?php
                                        $newserie->moreEpisodes()
                                        ?>
                                               
                                   
                                       
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="gen-load-more-button">
                                                <!-- <div class="gen-btn-container">
                                                    <a class="gen-button gen-button-loadmore" href="#">
                                                        <span class="button-text">Load More</span>
                                                        <span class="loadmore-icon" style="display: none;"><i
                                                                class="fa fa-spinner fa-spin"></i></span>
                                                    </a>
                                                </div> -->
                                            </div>
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
    <!-- Single Video End -->

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
    <script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
    <script src="https://cdn.sc.gl/videojs-hotkeys/0.2/videojs.hotkeys.min.js"></script>
    <script src="js/videojswatermark.js"></script>
    <script src="js/videojs_serie.js"></script>

</body>

</html>