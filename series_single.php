<?php
if(isset($_GET['sid']) && isset($_GET['seid']) && isset($_GET['epid'])){
    $id = $_GET['sid'];
    $seid = $_GET['seid'];
    $epid = $_GET['epid'];
    $serie_name = rawurldecode($_GET['e_name']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<base href="http://localhost/niiflicks.com/" />
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
</head>

<body>

    <!--=========== Loader =============-->
    <!-- <div id="gen-loading">
        <div id="gen-loading-center">
            <img src="images/logo-1.png" alt="loading">
        </div>
    </div> -->
    <!--=========== Loader =============-->

   <?php
    require_once 'incs/header.php';
   ?>

    <!-- Single Video Start -->
    <section class="gen-section-padding-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="gen-episode-wrapper style-1">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                include 'incs/get_episode.php';
                                $try = new seasons;
                                $try->series_trailer($id);
                                $try->episode_trailer($seid,$epid);
                                ?>
                                <!-- <div class="gen-video-holder">
                                    <video width="100%" height="500px" controls controlsList="nodownload">
                                        <source src="junk/hitwife.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div> -->
                            </div>
                            <div class="col-lg-12">
                                <div class="single-episode">
                                    <?php
                                    $try->episode_detail();
                                    ?>
                                    <!-- <div class="gen-single-tv-show-info">
                                        <h2 class="gen-title">Looking her</h2>
                                        <div class="gen-single-meta-holder">
                                            <ul>
                                                <li>40min</li>
                                                <li>2 Seasons</li>
                                                <li>Action</li>
                                                <li>
                                                    <i class="fas fa-eye">
                                                    </i>
                                                    <span>212 Views</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <p>Streamlab is a long established fact that a reader will be distracted by the
                                            readable content of a page when Streamlab at its layout. The point of using
                                            Lorem Streamlab is that it has a more-or-less normal distribution of
                                            Streamlab as opposed Streamlab.</p>


                                            <div class="gen-after-excerpt">
                                                <div class="gen-extra-data">
                                                    <ul class="nav">
                                                        <div>
                                                            <a  type="button" class="btn gen-button gen-button-flat" href="">
                                                                <span class="text">WATCH SERIES</span>
                                                            </a>
                                                            <a href="register.php" class="gen-button gen-button-flat">
                                                            <span class="text">REGISTER</span>
                                                            </a>
                                                            <input type="text" id="clink" class="input" value="" required>
                                                            <a href="#" id="to_copy" class="gen-button gen-button-flat">
                                                                <span class="text">Copy Link</span>
                                                            </a>
                                                        </div>
                                                    </ul>
                                                     <a  type="button" class="btn gen-button gen-button-flat" data-toggle="modal" data-target="#myModal1">
                                                
                                                        <span class="text">WATCH MOVIE</span>
                                                    </a>
                                                    <a href="register.php" class="gen-button gen-button-flat">
                                                        <span class="text">REGISTER</span>
                                                    </a>

                                                    
                                                    <input type="text" id="clink" class="input" value="" required>
                                                    <a href="#" id="to_copy" class="gen-button gen-button-flat">
                                                        <span class="text">Copy Link</span>
                                                    </a> 
                                                    
                                                </div>
                                            
                                                <div class="gen-socail-share mt-0">
                                                    <h4 class="align-self-center">Social Share :</h4>
                                                    <ul class="social-inner">
                                                        <li><a href="https://www.facebook.com/sharer.php?u=http://localhost/niiflicks.com/single/'.$premier['id'].'/'.$premier['title'].'" class="facebook facebook-btn"><i class="fab fa-facebook-f"></i></a>
                                                        </li>
                                                        <li><a href="#" class="facebook linkedin-btn"><i class="fab fa-instagram"></i></a>
                                                        </li>
                                                        <li><a href="#" class="facebook twitter-btn"><i class="fab fa-twitter"></i></a></li>
                                                    </ul>
                                                </div>

                                            </div> 
                                    </div> -->

                                    <div class="gen-season-holder">
                                        <ul class="nav">
                                            <?php
                                            $try->series_season($id);
                                            ?>
                                            <!-- <li class="nav-item">
                                                <a class="nav-link active show" data-toggle="tab"
                                                    href="#season_1">Season 1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#season_2">Season 2</a>
                                            </li> -->
                                            <!-- <div class="col-lg-3 col-md-6 col-sm-12"> -->
                                                <select class="accordion-dropdpwn col-lg-3 col-md-6 col-sm-12">
                                                    <?php
                                                    $try->optionz();
                                                    ?>
                                                    <!-- <option  data-sidval="season_1" data-sid="4">Season 1</option>
                                                    <option  data-sidval="season_2" data-sid="5">Season 2</option>
                                                    <option  data-sidval="season_3" data-sid="6">Season 3</option>  -->
                                                  
                                                </select>
                                            <!-- </div> -->
                                            <div>
                                                <a  type="button" class="btn gen-button gen-button-flat watch_m" data-toggle="modal" data-target="#myModal1">
                                                    <span class="text">WATCH SEASON</span>
                                                </a>
                                                <!-- <a href="register.php" class="gen-button gen-button-flat">
                                                <span class="text">REGISTER</span>
                                                </a>
                                                <input type="hidden" id="clink" class="input" value="" required>
                                                <a href="#" id="to_copy" class="gen-button gen-button-flat">
                                                    <span class="text">Copy Link</span>
                                                </a> -->
                                            </div>
                                        </ul>
                                   
                                        <div class="tab-content">
                                        <?php
                                        $try->season_click();
                                        ?>
                                            <!-- <div id="season_1" class="tab-pane active show">
                                                <div class="owl-carousel owl-loaded owl-drag" data-dots="false"
                                                    data-nav="true" data-desk_num="4" data-lap_num="3" data-tab_num="2"
                                                    data-mob_num="1" data-mob_sm="1" data-autoplay="false"
                                                    data-loop="false" data-margin="30">

                                                 
                                                    
                                                    <div class="item">
                                                        <div class="gen-episode-contain">
                                                            <div class="gen-episode-img">
                                                                <img src="images/background/asset-15.jpg"
                                                                    alt="stream-lab-image">
                                                                <div class="gen-movie-action">
                                                                    <a href="tv-shows-home.html" class="gen-button">
                                                                        <i class="fa fa-play"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="gen-info-contain">
                                                                <div class="gen-episode-info">
                                                                    <h3>
                                                                        S01E01 <span>-</span>
                                                                        <a href="#">
                                                                            Looking her
                                                                        </a>
                                                                    </h3>
                                                                </div>
                                                                <div class="gen-single-meta-holder">
                                                                    <ul>
                                                                        <li class="run-time">40min</li>
                                                                        <li class="release-date">
                                                                            Sep 10 2018
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="season_2" class="tab-pane">
                                                <div class="owl-carousel owl-loaded owl-drag" data-dots="false"
                                                    data-nav="true" data-desk_num="4" data-lap_num="3" data-tab_num="2"
                                                    data-mob_num="1" data-mob_sm="1" data-autoplay="false"
                                                    data-loop="false" data-margin="30" data-rewing="false">

                                                    
                                                    <div class="item">
                                                        <div class="gen-episode-contain">
                                                            <div class="gen-episode-img">
                                                                <img src="images/background/asset-15.jpg"
                                                                    alt="stream-lab-image">
                                                                <div class="gen-movie-action">
                                                                    <a href="tv-shows-home.html" class="gen-button">
                                                                        <i class="fa fa-play"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="gen-info-contain">
                                                                <div class="gen-episode-info">
                                                                    <h3>
                                                                        S02E01 <span>-</span>
                                                                        <a href="#">
                                                                            Looking her
                                                                        </a>
                                                                    </h3>
                                                                </div>
                                                                <div class="gen-single-meta-holder">
                                                                    <ul>
                                                                        <li class="run-time">40min</li>
                                                                        <li class="release-date">
                                                                            Sep 10 2018
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
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="pm-inner">
                                                <div class="gen-more-like">
                                                    <h5 class="gen-more-title">More Like This</h5>
                                                    <div class="row post-loadmore-wrapper">

                                                    <?php
                                                    $try->get_genre();
                                                    ?>
                                                       
                                                        <!-- <div class="col-xl-3 col-lg-4 col-md-6">
                                                            <div class="gen-carousel-movies-style-1 movie-grid style-1">
                                                                <div class="gen-movie-contain">
                                                                    <div class="gen-movie-img">
                                                                        <img src="images/background/asset-22.jpg"
                                                                            alt="streamlab-image">
                                                                        <div class="gen-movie-add">
                                                                            <div class="wpulike wpulike-heart">
                                                                                <div
                                                                                    class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                                                    <button type="button"
                                                                                        class="wp_ulike_btn wp_ulike_put_image"></button>
                                                                                </div>
                                                                            </div>
                                                                            <ul class="menu bottomRight">
                                                                                <li class="share top">
                                                                                    <i class="fa fa-share-alt"></i>
                                                                                    <ul class="submenu">
                                                                                        <li><a href="#"
                                                                                                class="facebook"><i
                                                                                                    class="fab fa-facebook-f"></i></a>
                                                                                        </li>
                                                                                        <li><a href="#"
                                                                                                class="facebook"><i
                                                                                                    class="fab fa-instagram"></i></a>
                                                                                        </li>
                                                                                        <li><a href="#"
                                                                                                class="facebook"><i
                                                                                                    class="fab fa-twitter"></i></a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </li>
                                                                            </ul>
                                                                            <div
                                                                                class="movie-actions--link_add-to-playlist dropdown">
                                                                                <a class="dropdown-toggle" href="#"
                                                                                    data-toggle="dropdown"><i
                                                                                        class="fa fa-plus"></i></a>
                                                                                <div
                                                                                    class="dropdown-menu mCustomScrollbar">
                                                                                    <div class="mCustomScrollBox">
                                                                                        <div class="mCSB_container">
                                                                                            <a class="login-link"
                                                                                                href="#">Sign in to add
                                                                                                this
                                                                                                movie to a
                                                                                                playlist.</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="gen-movie-action">
                                                                            <a href="tv-shows-home.html"
                                                                                class="gen-button">
                                                                                <i class="fa fa-play"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="gen-info-contain">
                                                                        <div class="gen-movie-info">
                                                                            <h3><a href="tv-shows-home.html">3
                                                                                    Hacker:TBG</a></h3>
                                                                        </div>
                                                                        <div class="gen-movie-meta-holder">
                                                                            <ul>
                                                                                <li>1 Season</li>
                                                                                <li>
                                                                                    <a
                                                                                        href="drama.html"><span>Drama</span></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-12">
                                            <div class="gen-movie-action">
                                                <div class="gen-btn-container">
                                                    <a href="#" class="gen-button">
                                                        <span class="text">Load More</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div> -->
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


    <!-- Modal -->
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div  class="modal-dialog modal-dialog-centered" role="document">
        <div style="background-color:#2d2d2d;" class="modal-content">
        <div class="modal-header">
        
            <h5 style="color:#ffff;" class="modal-title" id="exampleModalLongTitle">Input Registered Email Address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="see_err">
                <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
                You should check in on some of those fields below.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div> -->
        </div>
        <div class="modal-body">
                <p>Please Enter your registered email address to purchase selected season. If you have not registered, Pls click on register button.<p>
                <form>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <!-- <label for="inputEmail3">Email</label> -->
                    <input id="dmail" type="email" class="form-control" id="inputEmail3" placeholder="Input your Email Address">
                    </div>
                </div>
                    <div style="display:none;" id="response_message">
                      
                    </div>
                    <div style="width:32px; height:32px; margin: 0 auto; display:none;" id="preloadz">
                        <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="16px" height="16px" viewBox="0 0 128 128" xml:space="preserve"><g><circle cx="16" cy="64" r="16" fill="#000000"/><circle cx="16" cy="64" r="16" fill="#555555" transform="rotate(45,64,64)"/><circle cx="16" cy="64" r="16" fill="#949494" transform="rotate(90,64,64)"/><circle cx="16" cy="64" r="16" fill="#cccccc" transform="rotate(135,64,64)"/><circle cx="16" cy="64" r="16" fill="#e1e1e1" transform="rotate(180,64,64)"/><circle cx="16" cy="64" r="16" fill="#e1e1e1" transform="rotate(225,64,64)"/><circle cx="16" cy="64" r="16" fill="#e1e1e1" transform="rotate(270,64,64)"/><circle cx="16" cy="64" r="16" fill="#e1e1e1" transform="rotate(315,64,64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;315 64 64;270 64 64;225 64 64;180 64 64;135 64 64;90 64 64;45 64 64" calcMode="discrete" dur="720ms" repeatCount="indefinite"></animateTransform></g></svg>
                    </div>
            </div>
        <div style="border-top: 0 none;" class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button style="margin: 0 auto;" id="getEmail" type="button" class="btn gen-button gen-button-flat">Next</button>
        </div>
        </div>
    </div>
    </div>
    <!--modal ends-->


    <!-- Modal 2-->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div  class="modal-dialog modal-dialog-centered" role="document">
        <div style="background-color:#2d2d2d;" class="modal-content">
            <div class="modal-header">
            
            <h5 class="modal-title" id="exampleModalLongTitle">Make Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div id="see_err">
                <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
                You should check in on some of those fields below.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div> -->
        </div>
            <div class="modal-body">
                <p id="card_message"> please select<p>
                <form>
                <div class="form-group row">
                    <div id="for-card" class="col-sm-12">
                    <!-- <label for="inputEmail3">Email</label> -->
                    <!-- <input style="width:80%; color:black;" id="dmail" type="text" class="form-control" id="inputEmail3" value="Visa Card ending with *** **** **** 6574" disabled>
                    <button type="submit"><i class="fas fa-arrow-right"></i></button> -->
                    </div>
                </div>
                    <!-- <div id="response_message">
                    </div> -->
                    <div style="width:32px; height:32px; margin: 0 auto; display:none;" id="preloads">
                        <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="16px" height="16px" viewBox="0 0 128 128" xml:space="preserve"><g><circle cx="16" cy="64" r="16" fill="#000000"/><circle cx="16" cy="64" r="16" fill="#555555" transform="rotate(45,64,64)"/><circle cx="16" cy="64" r="16" fill="#949494" transform="rotate(90,64,64)"/><circle cx="16" cy="64" r="16" fill="#cccccc" transform="rotate(135,64,64)"/><circle cx="16" cy="64" r="16" fill="#e1e1e1" transform="rotate(180,64,64)"/><circle cx="16" cy="64" r="16" fill="#e1e1e1" transform="rotate(225,64,64)"/><circle cx="16" cy="64" r="16" fill="#e1e1e1" transform="rotate(270,64,64)"/><circle cx="16" cy="64" r="16" fill="#e1e1e1" transform="rotate(315,64,64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;315 64 64;270 64 64;225 64 64;180 64 64;135 64 64;90 64 64;45 64 64" calcMode="discrete" dur="720ms" repeatCount="indefinite"></animateTransform></g></svg>
                    </div>
            </div>
            <div style="border-top: 0 none;" class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <div style="margin: 0 auto;">
            <button type="button" class="btn gen-button gen-button-flat" id="gprev">Prev</button>
            <button type="button" class="btn gen-button gen-button-flat" id="buyt">New Card</button>
            <!-- <button style="margin: 0 auto;" id="getEmail" type="button" class="btn gen-button gen-button-flat">Buy Token</button> -->
            </div>
            </div>
        </div>
        </div>
    </div>
    <!--modal 2 ends-->



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
    <script>
          let hollyc = document.getElementById('hollym');
            hollyc.addEventListener('click', function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Go to app to watch free hollywood movies',
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                window.location.href="https://play.google.com/store/apps/details?id=com.ini.niiflicks";
                }
            
            })
        })
    </script>
    <script src="js/niiflicks.js"></script>
    <script>
         
      var season_id = $('.accordion-dropdpwn').find('option:selected').attr('data-sid');
      var nprice = $('.accordion-dropdpwn').find('option:selected').attr('data-nprice');
      var rprice = $('.accordion-dropdpwn').find('option:selected').attr('data-rprice');
      var season_num = $('.accordion-dropdpwn').find('option:selected').attr('data-sidval');
      $(".accordion-dropdpwn").on('change', function (e) {
         
        //   var season_num = $(this).val();
          season_num = $('.accordion-dropdpwn').find('option:selected').attr('data-sidval');
        //   dsid = $(this).attr('data-sid');
        // alert(season_num);
          season_id = $('.accordion-dropdpwn').find('option:selected').attr('data-sid');
          nprice = $('.accordion-dropdpwn').find('option:selected').attr('data-nprice');
          rprice = $('.accordion-dropdpwn').find('option:selected').attr('data-rprice');
          $target_elem = $('.nav-link').attr('href','#season_'+season_num);
        //   $target_elem = $('a[href="' + season_num + '"]');
          $target_elem.trigger('click');
      });
      $(document).ready(function(){
        $('#getEmail').click(function(){
            $('#preloadz').show();
            let mail = document.getElementById('dmail').value;
            let series_id = <?=$id?>;// the id of this movie
            let epid = <?=$epid?>;
            let series_title = $('#serietitle').val();// the title of this series
          
            //console.log(series_id,series_title,season_id,nprice,rprice,mail);
            var render='';
            $.ajax({
                method: "POST",
                url: "apis/check_user_series.php",
                data: {email: mail, serie_id: series_id, season_id:season_id, serie_name:series_title, seasonno:season_num, episid: epid}
                })
                .done(function( msg ) {
                    $('#preloadz').hide();
                    if((msg != 'exists')  && (msg != 'purchased')){
                        $.fn.addMessage(msg);
                        setTimeout(function(){ $('#response_message').hide(); }, 1000);
                   
                    }else if(msg == 'purchased'){
                 
                        Swal.fire({
                        title: 'You have already purchased This Movie',
                        icon: 'info',
                        showDenyButton: true,
                        // showCancelButton: true,
                        showCloseButton: true,
                        confirmButtonText: 'Watch on app',
                        denyButtonText: `Watch on web`,
                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.assign("https://play.google.com/store/apps/details?id=com.ini.niiflicks");
                        } else if (result.isDenied) {
                            window.location.assign("unlock_serie.php");
                        }
                        })
                    }
                    else{
                        // console.log('everything is fine');
                        var scard = '';//to see card details
                        var cardt = '';//card title
                        var cardbtn = '';//card button
                         $.ajax({
                        method: "POST",
                        url: "apis/retrieve_card.php",
                        data: {email: mail}
                        })
                        .done(function(response){
                            var json = $.parseJSON(response);
                            // console.log(json);
                            // console.log(json.message);
                            
                            if(json.message === 'card_exist'){
                                // console.log(json.data);
                                cardt +=`pls select card, or use new card to pay <strong>${nprice}</strong> for <strong>${series_title}</strong> Season ${season_num}`;
                            
                                json.data.forEach(function(card){
                                    // console.log(card.card_type);
                                    scard +=`
                                    <div class="mb-2">
                                    <input style="width:80%; color:black;" id="dmail" type="text" class="form-control" id="inputEmail3" value="${card.card_type} Card ending with ${card.card}" disabled>
                                    <a href="apis/recur_pay.php?auth=${card.auth_code}&email=${card.email}&amount=${rprice}&type=serie" style="border:none !important;" type="submit"><i class="fas fa-arrow-right"></i></a>
                                    </div>
                                    `;
                                 
                                  
                                });
                                cardbtn +=`New Card`;
                               }else if(json.message === 'no_card'){
                                scard +=`
                                    <div class="mb-2">
                                        <p style="font-size:23px; text-align:center;"> You are about to Pay <strong>${nprice}</strong> for <strong>${series_title}</strong> Season <strong>${season_num}</strong></p>
                                    </div>
                                    `;
                                    cardt +=` `;
                                    cardbtn +=`Pay Now`;

                                    
                            }
                            $('#for-card').html(scard);
                            //alert(cardt);
                            $('#card_message').html(cardt);
                            // alert(cardbtn);
                            $('#buyt').html(cardbtn);
                            
                        });
                        $('#myModal1').modal('hide');
                        $('#myModal2').modal('show');
                        $('#buyt').click(function(){
                            $('#preloads').show();
                            $.ajax({
                            method: "POST",
                            url: "apis/recieve_pay.php",
                            data: {email: mail, amount:rprice,type:'serie'}
                            })
                            .done(function(response){
                                $('#preloads').hide();
                                var json = $.parseJSON(response);
                                // console.log(json.status);
                                // console.log(json['data'].authorization_url);
                                if(json.status == true){
                                
                                    redirect_url = json['data'].authorization_url;
                                    window.location.assign(redirect_url);
                                }
                            });
                        });
                       
                    }
                       
               
                 
                });
                
            });
            $('#gprev').click(function(){
                $('#myModal1').modal('show');
                $('#myModal2').modal('hide'); 
            });
      });
    //   var dsid = $('.accordion-dropdpwn').find('option:selected').attr('data-sid');
    //   $('.watch_m').click(function(e){
    //       e.preventDefault();
    //         alert(dsid);
    //   });

  

    </script>


</body>

</html>