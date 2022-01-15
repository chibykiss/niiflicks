<?php
session_start();
if(isset($_GET['sid']) && isset($_GET['s_name']) && isset($_GET['seaid']) && isset($_GET['seano']) && isset($_GET['epid'])){
    $sid = $_GET['sid'];
    $serie_name = $_GET['s_name'];
    $seasonid = $_GET['seaid'];
    $seano = $_GET['seano'];
    $episid = $_GET['epid'];
    if(!isset($_SESSION['serie_id']) && !isset($_SESSION['user_ms']) && !isset($_SESSION['season_id']) && !isset($_SESSION['serie_name']) && !isset($_SESSION['season_num']) && !isset($_SESSION['epis_id'])){
        $_SESSION['serie_id'] = $sid;
        $_SESSION['serie_name'] = $serie_name;
        $_SESSION['season_id'] = $seasonid;
        $_SESSION['season_num'] = $seano;
        $_SESSION['epis_id'] = $episid;
    }else{
        unset($_SESSION['serie_id']);
        unset($_SESSION['serie_name']);
        unset($_SESSION['season_id']);
        unset($_SESSION['season_num']);
        unset($_SESSION['epis_id']);
        $_SESSION['serie_id'] = $sid;
        $_SESSION['serie_name'] = $serie_name;
        $_SESSION['season_id'] = $seasonid;
        $_SESSION['season_num'] = $seano;
        $_SESSION['epis_id'] = $episid;
    }

}else{
    if(isset($_SESSION['serie_id']) && isset($_SESSION['user_ms']) && isset($_SESSION['serie_name']) && isset($_SESSION['season_id']) && isset($_SESSION['season_num']) && isset($_SESSION['epis_id'])){
        $sid = $_SESSION['serie_id'];
        $serie_name = $_SESSION['serie_name'];
        $seasonid = $_SESSION['season_id'];
        $seano = $_SESSION['season_num'];
        $episid = $_SESSION['epis_id'];
        // echo $id.'<br>';
        // echo $movie_name.'<br>';
        // echo $seasonid.'<br>';
        // echo $seano.'<br>';
        // echo $episid;
      
    }else{
        header("location: index.php");
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
    <div id="gen-loading">
        <div id="gen-loading-center">
            <img src="images/niiflicks-logo.png" alt="loading">
        </div>
    </div>
    <!--=========== Loader =============-->

    <!-- Log-in  -->
    <section class="position-relative pb-0">
        <div class="gen-login-page-background" style="background-image: url('images/background/asset-54.jpg');"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <script>
                            window.onload = function(){
                                let title = '';
                                title += `Unlock <?=$serie_name?> S<?=$seano?>`;
                                document.getElementById('render_title').innerHTML = title;
                                
                                let dform = document.getElementById('pms_login');
                                dform.addEventListener('submit', function(e){
                                    e.preventDefault();
                                    var formData = new FormData();
                                    formData.append('seaid', <?=$seasonid?>); 
                                    formData.append('sid', <?=$sid?>);
                                    formData.append('epsid',"<?=$episid?>"); 
                                    formData.append('seano',<?=$seano?>);
                                    let emale = document.getElementById('email').value;
                                    formData.append('email', emale);
                                    // for (var value of formData.values()) {
                                    // console.log(value);
                                    // }
                                fetch('apis/process_series.php', {
                                    method: 'post',
                                    body: formData
                                })
                                .then((res) => res.json())
                                .then(function(data){
                                    console.log(data);
                                    if(data.message == 'aquired'){
                                        Toast.fire({
                                        icon: 'success',
                                        title: 'Redirecting...'
                                        })
                                        setTimeout(() => {
                                            location.assign('player_serie/play')}, 2000);
                                    }
                                    else if(data.message == 'not_found'){
                                        // Swal.fire({
                                        // icon: 'error',
                                        // title: 'Sorry..',
                                        // text: 'you have not paid for this movie'
                                        // })
                                        Toast.fire({
                                        icon: 'error',
                                        title: 'you have not paid for this season'
                                        })
                                    }else if(data.message == 'not_user'){
                                        // Swal.fire({
                                        // icon: 'error',
                                        // title: 'Sorry..',
                                        // text: 'Email is not Regsitered'
                                        // })
                                        Toast.fire({
                                        icon: 'error',
                                        title: 'Email is not Regsitered, Pls register'
                                        })
                                    }else{
                                        console.log('some other unkown error occured');
                                    }
                                    
                                })
                                    
                                });
                              
                                
                            }
                        </script>
                        <form name="pms_login" id="pms_login">
                           
                            <h4 id="render_title"></h4>
                            <p class="login-username">
                                <label for="user_login">Email Address</label>
                                <input type="email" id="email" class="input" value="" required>
                            </p>
                            <!-- <p class="login-password">
                                <label for="user_pass">Token</label>
                                <input type="text" id="tkn" class="input" value="" required>
                            </p> -->
                         
                            <p class="login-submit">
                                <button type="submit" name="wp-submit"  class="button button-primary">Unlock Season</button>
                                <a type="submit" href="register"  class="button button-primary">Register</a>
                            </p>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Log-in  -->

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

    <!--Sweet alert js-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
       
     </script>

    <script src="js/script.js"></script>


</body>

</html>