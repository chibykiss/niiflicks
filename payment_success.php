<?php
session_start();
if(!isset($_GET['trxref']) && !isset($_GET['reference']) || !isset($_SESSION['show_type'])){
          // !isset($_SESSION['movie_name']) && !isset($_SESSION['user_m']) && !isset($_SESSION['movie_id'])
        header("location: index.php");
    
  
}else{
        // echo $_GET['trxref'].'<br>';
        // echo $_GET['reference'].'<br>';
        // echo $_SESSION['show_type'].'<br>';
        $trxid = $_GET['trxref'];
        $trxref = $_GET['reference'];
        $stype = $_SESSION['show_type'];
   if($_SESSION['show_type'] == 'movie'){
        // echo $_SESSION['movie_name'].'<br>';
        // echo $_SESSION['user_m'].'<br>';
        // echo $_SESSION['movie_id'].'<br>';
        
        $show_name = $_SESSION['movie_name'];
        $user_email = $_SESSION['user_m'];
        $show_id = $_SESSION['movie_id'];
        $season_id = null;
        $season_num = null;
        $episid = null;
 }else{
    //  echo $_SESSION['serie_name'].'<br>';
    //  echo $_SESSION['user_ms'].'<br>';
    //  echo $_SESSION['serie_id'].'<br>';
    //  echo $_SESSION['season_id'];
     $show_name = $_SESSION['serie_name'];
     $user_email = $_SESSION['user_ms'];
     $show_id = $_SESSION['serie_id'];
     $season_id = $_SESSION['season_id'];
     $season_num = $_SESSION['season_num'];
     $episid = $_SESSION['epis_id'];
 }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<base href="http://localhost/niiflicks.com/" />
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
    <script>
    // var urlParams = new URLSearchParams(window.location.search);
    // const trxid  = urlParams.get('trxref');
    // const trxref = urlParams.get('reference');
  
    </script>
    
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
    include_once 'incs/header.php';
?>


    <!-- Single movie Start -->
    <section class="gen-section-padding-3 gen-single-movie">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-12">
                    <div class="gen-single-movie-wrapper style-1">
                        <div class="row">
                           
                             <div class="col-lg-12">
                               
                                
                               
                                <div  class="col-lg-12">
                                    <div class="single-video">
                                        <div class="gen-single-video-info">
                                        
                                               
                                              
                                                <div class="container container-2 gen-section-padding-2">
                                                    <div class="row">
                                                        <div id="dmessage" class="col-xl-12 col-md-12">

                                                   <script>
                                                   window.onload = function(){
                                                    var tshow = "<?=$stype?>";
                                                        let dmovie = "<?=$show_name?>";
                                                        let dmail = "<?=$user_email?>";
                                                        let mid = "<?=$show_id?>";
                                                        let output = '';
                                                        let spinnerz = '';
                                                        spinnerz += `
                                                        <div class="d-flex justify-content-center">
                                                                    <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="64px" height="64px" viewBox="0 0 128 128" xml:space="preserve">
                                                                    <g><path d="M64 128A64 64 0 0 1 18.34 19.16L21.16 22a60 60 0 1 0 52.8-17.17l.62-3.95A64 64 0 0 1 64 128z" fill="#ff0000"/>
                                                                    <animateTransform attributeName="transform" type="rotate" from="0 64 64" to="360 64 64" dur="1800ms" repeatCount="indefinite">
                                                                    </animateTransform></g>
                                                                    </svg>
                                                        </div>
                                                        `;
                                                        document.getElementById('dmessage').innerHTML = spinnerz;
                                                        

                                                         url = `apis/payment_status.php?trxid=<?=$trxid?>&trxref=<?=$trxref?>&email=${dmail}`;
                                                        
                                                        fetch(url)
                                                        .then(function (response) {
                                                        return response.json();
                                                        })
                                                        .then(function(body){
                                                            //console.log(body);
                                                        
                                                        if(body.data.status == 'success'){
                                                            var formData = new FormData();
                                                            formData.append('dmovie', dmovie);
                                                            formData.append('dmail', dmail);
                                                            formData.append('mid', mid); 
                                                            if(tshow == 'movie'){                                                   
                                                                var string = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                                            let OTP = '';
                                                            // Find the length of string
                                                            var len = string.length;
                                                            for (let i = 0; i < 6; i++ ) {
                                                            OTP += string[Math.floor(Math.random() * len)];
                                                            }
                                                            formData.append('otp',OTP);
                                                            // console.log(OTP);
                                                            let result = '';
                                                            fetch('apis/send_token.php', {
                                                            method:'POST',
                                                            
                                                                body: formData
                                                            })
                                                            .then((res) => res.json())
                                                            .then(function(result){
                                                                // console.log(result);
                                                                // console.log(result.dbstat);
                                                                
                                                                //console.log(result.data.token);
                                                                if((result.mstatus == 'sent') && (result.dbstat == 'token_inserted')){
                                                                     output += `
                                                        <div class="gen-icon-box-style-1">
                                                                
                                                                <div class="gen-icon-box-content">
                                                                    <h5 class="gen-icon-box-description"> Your Payment
                                                                        for ${dmovie} was Successful</h5>
                                                                    <p> use <strong>${OTP}</strong> to unlock this movie. The token has also been sent to your email ${dmail}</p>
                                                                </div>
                                                                 <a href="https://play.google.com/store/apps/details?id=com.ini.niiflicks" class="gen-button gen-button-flat mt-4">
                                                                <span class="text">Watch in App</span></a>
                                                                <a href="unlock" class="gen-button gen-button-flat mt-4">
                                                                <span class="text">Watch on Web</span></a> 
                                                            </div>
                                                        `;
                                                        }
                                                        else if((result.mstatus == 'failed') && (result.dbstat == 'token_inserted')){
                                                           
                                                            output += `
                                                            <div class="gen-icon-box-style-1">
                                                                
                                                                <div class="gen-icon-box-content">
                                                                    <h5 class="gen-icon-box-description"> Your Payment
                                                                        for ${dmovie} was Successful</h5>
                                                                    <p> use <strong>${OTP}</strong> to unlock this movie. The token could not be sent to your email ${dmail}</p>
                                                                </div>
                                                                 <a href="https://play.google.com/store/apps/details?id=com.ini.niiflicks" class="gen-button gen-button-flat mt-4">
                                                                <span class="text">Watch in App</span></a>
                                                                <a href="unlock" class="gen-button gen-button-flat mt-4">
                                                                <span class="text">Watch on Web</span></a> 
                                                            </div>
                                                            `;
                                                        }
                                                        else if(result.dbstat == 'token_exists'){
                                                            //   console.log(result.data.token);
                                                            output += `
                                                        <div class="gen-icon-box-style-1">
                                                                
                                                                <div class="gen-icon-box-content">
                                                                    <h5 class="gen-icon-box-description"> Use <strong>${result.data.token}</strong>  to unlock ${dmovie}</h5>
                                                                    <p>Token Already Sent to ${dmail}  </p>
                                                                </div>
                                                                <a href="https://play.google.com/store/apps/details?id=com.ini.niiflicks" target="_blank" class="gen-button gen-button-flat mt-4">
                                                                <span class="text">Watch in App</span></a>
                                                                <a href="unlock" class="gen-button gen-button-flat mt-4">
                                                                <span class="text">Watch on Web</span></a> 
                                                                
                                                            </div>
                                                        `;
                                                        }
                                                        
                                                        else{
                                                        
                                                        
                                                            }
                                                             document.getElementById('dmessage').innerHTML = output;
                                                            });
                                                            }else{
                                                                var seasonid = "<?=$season_id?>";
                                                                let seasonNo = "<?=$season_num?>";
                                                                let episid = "<?=$episid?>";
                                                                formData.append('sea_id',seasonid);
                                                                // for (var pair of formData.entries()) {
                                                                //     console.log(pair[0]+ ': ' + pair[1]); 
                                                                // }
                                                                fetch('apis/confirm_series_pay.php', {
                                                                method: 'POST', // or 'PUT'
                                                                body: formData
                                                                })
                                                                .then(response => response.json())
                                                                .then(data => {
                                                                console.log(data.message);
                                                                    if(data.message == 'purchased'){
                                                                        output += `
                                                                        <div class="gen-icon-box-style-1">
                                                                            
                                                                            <div class="gen-icon-box-content">
                                                                                <h5 class="gen-icon-box-description"> You have already
                                                                                    purchased ${dmovie} Season ${seasonNo}</h5>
                                                                            </div>
                                                                            <a href="https://play.google.com/store/apps/details?id=com.ini.niiflicks" class="gen-button gen-button-flat mt-4">
                                                                            <span class="text">Watch in App</span></a>
                                                                            <a href="unlock_serie" class="gen-button gen-button-flat mt-4">
                                                                            <span class="text">Watch on Web</span></a> 
                                                                        </div>
                                                                        `;
                                                                    }
                                                                    else if(data.message = 'inserted'){
                                                                            output += `
                                                                            <div class="gen-icon-box-style-1">
                                                                                
                                                                                <div class="gen-icon-box-content">
                                                                                    <h5 class="gen-icon-box-description"> Your Payment for
                                                                                         ${dmovie} Season ${seasonNo} was Successful</h5>
                                                                                </div>
                                                                                <a href="https://play.google.com/store/apps/details?id=com.ini.niiflicks" class="gen-button gen-button-flat mt-4">
                                                                                <span class="text">Watch in App</span></a>
                                                                                <a href="unlock_serie" class="gen-button gen-button-flat mt-4">
                                                                                <span class="text">Watch on Web</span></a> 
                                                                            </div>
                                                                            `;
                                                                    }
                                                                    document.getElementById('dmessage').innerHTML = output;
                                                                })
                                                                .catch(error => {
                                                                console.log('Error:', error);
                                                                });
                                                                
                                                            }

                                                            } else{

                                                            output += `
                                                        <div class="gen-icon-box-style-1">
                                                                
                                                                <div class="gen-icon-box-content">
                                                                    <h5 style="color:red;" class="gen-icon-box-description"> Your Payment 
                                                                        for ${dmovie} Failed</h5>
                                                                </div>
                                                                 
                                                            </div>
                                                        `;
                                                        }
                                                       
                                                        
                                                 
                                                        
                                                    })
                                                    .catch(status => {
                                                        output += `
                                                        <div class="gen-icon-box-style-1">
                                                                
                                                                <div class="gen-icon-box-content">
                                                                    <h5 style="color:red;" class="gen-icon-box-description"> Your Payment 
                                                                        for ${dmovie} Failed</h5>
                                                                </div>
                                                                 
                                                            </div>
                                                        `;
                                                    });
                                                    //document.getElementById('dmessage').innerHTML = output;
                                                   
                                                    
                                                   }
                                               
                                                </script>
                                                            <!-- <div class="gen-icon-box-style-1">
                                                                
                                                                <div class="gen-icon-box-content">
                                                                    <p class="gen-icon-box-description">On confirmation of Purchase, A token will be sent to your
                                                                        Niiflicks registered email Address. Proceed to the mobile application and use the token to unlock and watch this movie</p>
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
                </div>
            </div>
        </div>
    </section>
    <!-- Single movie End -->

   <!-- footer start -->
   <footer id="gen-footer">
    <div class="gen-footer-style-1">
        <div style="background-color:#141414;" class="gen-footer-top">
            <div class="container">
               
            </div>
        </div>
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
    <!--sweet alert-->
    
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

</body>

</html>