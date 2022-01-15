<?php
session_start();
if(isset($_GET['id']) && isset($_GET['m_name'])){
    $id = $_GET['id'];
    $title = rawurldecode($_GET['m_name']);
    // echo $title;
    if(isset($_SESSION['trailer']) && isset($_SESSION['poster']) && isset($_SESSION['desc'])){
        $trailer = $_SESSION['trailer'];
        $poster = $_SESSION['poster'];
        $desc = $_SESSION['desc'];
    }
    
}else{
    //echo 'it wasnt set';
     header('location: index.php');
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
    <meta property="og:url"    content="https://niiflicks.com/single/<?=$id?>/<?=$title?>" />
    <meta property="og:title"   content="<?=$title?>" />
    <meta property="og:description"  content="stuff" />
    <meta property="og:image"        content="noda_stuff" >
    <script>
        var trailer = sessionStorage.getItem("trailer");
        var poster = sessionStorage.getItem("poster");
        var desc = sessionStorage.getItem("desc");
        document.querySelector('meta[property="og:description"]').setAttribute("content", desc);
        document.querySelector('meta[property="og:image"]').setAttribute("content", poster);
        //console.log(poster);
    </script>

    <!-- <meta property="og:image"        content="localhost/niiflicks.com/niiflicks/directors" /> -->
    
    
    <title><?=$title?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.png">
    <!-- CSS bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!--  Style -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"/>
    <link rel="stylesheet" href="css/all.min.css"/> -->
    <!--  Responsive -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet"> -->
</head>

<body>

    <!--=========== Loader =============-->
    <!-- <div id="gen-loading">
        <div id="gen-loading-center">
            <img src="images/niiflicks-logo.png" alt="loading">
        </div>
    </div> -->
    <!--=========== Loader =============-->

  <?php
    require_once 'incs/header.php';
?>

    <!-- Single Video Start -->
    <section class="gen-section-padding-3 gen-single-video">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-12">
                    <div class="row">
                        <?php
                        require_once 'incs/getsingle.php';
                        $use = new single_premier;
                        $use->get_single($id);
                        ?>
                        <!-- <div class="col-lg-12">
                            <div class="gen-video-holder">
                                <iframe width="100%" height="550px" src="https://www.youtube.com/embed/LXb3EKWsInQ"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="single-video">
                                <div class="gen-single-video-info">
                                    <h2 class="gen-title">robot war</h2>
                                    <div class="gen-single-meta-holder">
                                        <ul>
                                            <li class="gen-sen-rating">TV-PG</li>
                                            <li>
                                                <i class="fas fa-eye">
                                                </i>
                                                <span>237 Views</span>
                                            </li>
                                            
                                            <li>English</li>
                                            <li>&#8358; 2000</li>
                                        </ul>
                                    </div>
                                    <p>Streamlab is a long established fact that a reader will be distracted by the
                                        readable
                                        content of a page when Streamlab at its layout. The point of using Lorem
                                        Streamlab
                                        is that it has a more-or-less normal distribution of Streamlab as opposed
                                        Streamlab.
                                    </p>
                                    <div class="gen-after-excerpt">
                                        <div class="gen-extra-data">
                                            <ul>
                                            
                                                <li><span>Genre :</span>
                                                    <span>
                                                        <a href="action.html">
                                                            Action, </a>
                                                    </span>
                                                </li>
                                                <li><span>Run Time :</span>
                                                    <span>1hr 24 mins</span>
                                                </li>
                                                <li>
                                                    <span>Release Date :</span>
                                                    <span>14 Aug,2018</span>
                                                </li>
                                            </ul>
                                            <a href="#" id="mainpop" class="gen-button gen-button-flat">
                                                <span class="text">WATCH MOVIE</span>
                                            </a>
                                            <a href="register.php" class="gen-button gen-button-flat">
                                                <span class="text">REGISTER</span>
                                            </a>
                                            <p style="color: rgb(189, 1, 1);">
                                               
                                        </div>
                                       
                                        <div class="gen-socail-share mt-0">
                                          
                                            <h4 class="align-self-center">Social Share :</h4>
                                            <ul class="social-inner">
                                                <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                                </li>
                                                <li><a href="#" class="facebook"><i class="fab fa-instagram"></i></a>
                                                </li>
                                                <li><a href="#" class="facebook"><i class="fab fa-twitter"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                     
        
    
                                   
                                        
                                   
                                 
                                        
                                    </div>
                                    
                                       
                                </div>
                            </div>
                        </div> -->

                        <div class="col-lg-12">
                            <div class="pm-inner">
                                <div class="gen-more-like">
                                    <h5 class="gen-more-title">More Like This</h5>
                                    <div class="row post-loadmore-wrapper">

                                    <?php
                                        $use->morelike();
                                    ?>
                                        <!-- <div class="col-xl-3 col-lg-4 col-md-6">
                                            <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                                <div class="gen-movie-contain">
                                                    <div class="gen-movie-img">
                                                        <img src="images/background/asset-41.jpg"
                                                            alt="single-video-image">
                                                        <div class="gen-movie-add">
                                                            <div class="wpulike wpulike-heart">
                                                                <div class="wp_ulike_general_class">
                                                                    <a href="#" class="sl-button text-white"><i
                                                                            class="far fa-heart"></i></a>
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
                                                            <div class="video-actions--link_add-to-playlist dropdown">
                                                                <a class="dropdown-toggle" href="#"
                                                                    data-toggle="dropdown"><i
                                                                        class="fa fa-plus"></i></a>
                                                                <div class="dropdown-menu">
                                                                    <a class="login-link" href="#">Sign in to add
                                                                        this video to a playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="gen-movie-action">
                                                            <a href="video-home.html" class="gen-button">
                                                                <i class="fa fa-play"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="gen-info-contain">
                                                        <div class="gen-movie-info">
                                                            <h3><a href="video-home.html">sefozie world</a></h3>
                                                        </div>
                                                        <div class="gen-movie-meta-holder">
                                                            <ul>
                                                                <li>2 weeks</li>
                                                                <li>
                                                                    <a href="adventure.html"><span>Adventure</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                                       
                                       
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-lg-12">
                                            <div class="gen-load-more-button">
                                                <div class="gen-btn-container">
                                                    <a class="gen-button gen-button-loadmore" href="#">
                                                        <span class="button-text">Load More</span>
                                                        <span class="loadmore-icon" style="display: none;"><i
                                                                class="fa fa-spinner fa-spin"></i></span>
                                                    </a>
                                                </div>
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
            <p>On successful Purchase, A token will be sent to your supplied email address to unlock this movie<p>
            <form>
            <div class="form-group row">
                <div class="col-sm-12">
                <!-- <label for="inputEmail3">Email</label> -->
                <input id="dmail" type="email" class="form-control" id="inputEmail3" placeholder="Input your Email Address">
                </div>
            </div>
                <div style="display:none;" id="response_message">
                    <!-- <div style="width:100%; height:30px; background-color:#444242;">
                        <div style="width: 70%; height:30px; margin: 0 auto;">
                            <i style="color:#ff8282; padding-left:20px;" class="fa fa-info-circle"></i>
                            <span style="color:#ff8282;">${msg}</span>
                        </div>
                    </div>-->
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
    <script>
        // $(document).ready(function() {
        //     var trailer = $('#trail').val();
        //     var pics = $('#pics').val();
        //     var dexc = $('#dexc').val();
        //     console.log(pics);
        //     $('meta[property="og:image"]').remove();
        //     $('meta[property="og:description"]').remove();
        //     //$('meta[property="og:url"]').remove();
        //     $("head").append(`<meta property="og:image" content="${pics}">`);
        //     $("head").append(`<meta property="og:description" content="${dexc}">`);
        //     //$("head").append('<meta property="og:url" content="blubb3">');
        // });
        </script>

    <script src="js/niiflicks.js"> </script>
    <script>
       $(document).ready(function(){
        $('#getEmail').click(function(){
            $('#preloadz').show();
            let mail = document.getElementById('dmail').value;
            var namount = $('#rel_amount').val();//real amount of this movie to be passed to payment gateway
            var nomalp = $('#normalamt').html();//normal amount of this movie
            let id = <?=$id?>;// the id of this movie
            let movie_name = "<?=$title?>";// the title of this movie
            let user_ip = $('#user_ip').val();//get users location
            var render='';
            $.ajax({
                method: "POST",
                url: "apis/check_user.php",
                data: {email: mail, mov_id: id,mov_name: movie_name}
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
                            window.location.assign("unlock");
                        }
                        })
                    }
                    else{
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
                            console.log(json.message);
                            
                            if(json.message === 'card_exist'){
                                console.log(json.data);
                                cardt +=`pls select card to pay or use new card`;
                            
                                json.data.forEach(function(card){
                                    console.log(card.card_type);
                                    scard +=`
                                    <div class="mb-2">
                                    <input style="width:80%; color:black;" id="dmail" type="text" class="form-control" id="inputEmail3" value="${card.card_type} Card ending with ${card.card}" disabled>
                                    <a href="apis/recur_pay.php?auth=${card.auth_code}&email=${card.email}&amount=${namount}&type=movie" style="border:none !important;" type="submit"><i class="fas fa-arrow-right"></i></a>
                                    </div>
                                    `;
                                 
                                  
                                });
                                cardbtn +=`New Card`;
                               }else if(json.message === 'no_card'){
                                scard +=`
                                    <div class="mb-2">
                                        <p style="font-size:23px; text-align:center;"> You are about to Pay <strong>${nomalp}</strong> for <strong>${movie_name}</strong> </p>
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
                            data: {email: mail, amount:namount, type:'movie'}
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
    </script>


</body>

</html>


