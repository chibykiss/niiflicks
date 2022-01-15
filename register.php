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

    <!-- Log-in  -->
    <section class="position-relative pb-0">
        <div class="gen-login-page-background" style="background-image: url('images/background/asset-54.jpg');"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <script>
                            window.onload = function(){
                                
                                let form_sub = document.getElementById('pms_login');
                                
                                form_sub.addEventListener('submit', function(e){
                                    e.preventDefault();
                                    var formData = new FormData(this);
                                    fetch('apis/register.php',{
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then((res) => res.json())
                                    .then(function(data){
                                        console.log(data.message);
                                        if(data.message == 'registered'){
                                            Swal.fire({
                                            title: 'Registered Successfully',
                                           confirmButtonText: 'Ok',
                                           icon: 'success',
                                            }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.history.back();
                                            }})
                                            
                                        }
                                        else if(data.message == 'exists'){
                                            Swal.fire({
                                            title: 'You have Already Registered',
                                           confirmButtonText: 'Ok',
                                           icon: 'info',
                                            }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.history.back();
                                            }})
                                    
                                        }else{
                                            Swal.fire({
                                            title: 'Something Went Wrong',
                                           confirmButtonText: 'Ok',
                                           icon: 'info',
                                            }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.history.back();
                                            }})
                                        }
                                    })
                                    .catch(function(error){
                                        console.log(error);
                                    })
                                    // for (var value of formData.values()) {
                                    // console.log(value);
                                    // }
                                    
                                });
                            }
                        </script>
                        <form name="pms_login" id="pms_login">
                            <h4>Sign Up</h4>
                            <p class="login-username">
                                <label for="user_login">First name</label>
                                <input type="text" name="fname"  class="input" value="" size="20" required>
                            </p>
                            <p class="login-username">
                                <label for="user_login">Last name</label>
                                <input type="text" name="lname"  class="input" value="" size="20" required>
                            </p>
                            <p class="login-username">
                                <label for="user_login">Email</label>
                                <input type="email" name="email"  class="input" value="" size="20" required>
                            </p>
                            <p class="login-password">
                                <label for="user_pass">Password</label>
                                <input type="password" name="pwd"  class="input" value="" size="20" required> 
                            </p>
                            <p class="login-remember">
                                <!-- <label>
                                    <input name="rememberme" type="checkbox" value="forever"> Remember
                                    Me </label> -->
                            </p>
                            <p class="login-submit">
                                <input type="submit" name="wp-submit" class="button button-primary"
                                    value="Register">
                                <input type="hidden" name="redirect_to">
                            </p>
                            <input type="hidden" name="pms_login" value="1"><input type="hidden" name="pms_redirect">
                             <a href="reset_pass/lost_pass">Lost your password?</a>
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

    <script src="js/script.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>