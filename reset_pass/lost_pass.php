<!DOCTYPE html>
<html lang="en">

<head>
<base href="http://localhost/niiflicks.com/reset_pass" />
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
    <!-- <div id="gen-loading">
        <div id="gen-loading-center">
            <img src="images/logo-1.png" alt="loading">
        </div>
    </div> -->
    <!--=========== Loader =============-->

    <!-- Recover-Password -->
    <section class="position-relative pb-0">
        <div class="recover-password-page-background" style="background-image:url('images/background/asset-75.jpg');">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <form id="pms_recover_password_form" class="pms-form">
                            <h4>Recover Password</h4>
                            <p class="font-weight-bold">Please enter email address.<br>You will receive
                                a link to create a new
                                password via email.</p>
                            <ul class="pms-form-fields-wrapper pl-0 mb-4">
                                <li class="pms-field">
                                    <input id="pms_username_email" placeholder="enter your email" name="email" type="email" value="">
                                </li>
                                <p id="showMessage"> </p>
                            </ul>
                            
                            <input type="submit" name="Resetsubmit" value="Get Link">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Recover-Password -->

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
    
    <script>
        $(document).ready(function(){
            let resetform = document.getElementById('pms_recover_password_form');
            var output = '';
            resetform.addEventListener('submit', function(e){
                e.preventDefault();
                // let email = document.getElementById('pms_username_email').value;
                
                
                // alert(msg);
                formData = new FormData(resetform);
                // formData = new FormData();
                // formData.append('email',email);
                fetch('apis/reset_request.php',{
                    method: 'POST',
                    body: formData
                })
                .then((res) => res.json())
                .then((data) => {
                     console.log(data)
                    // console.log(data.err_code);
                    if(data.error == false){
                        output += `<span style="color:green;">reset link successfully sent to your email address</span>`;
                        // setTimeout(function(){ window.history.back(); }, 3000);
                    }else{
                        if(data.err_code == 1){
                        output += `<span style="color:red;">you are not a registred user</span>`;
                        setTimeout(function(){ location.reload(); }, 1500);
                        }
                        else if(data.err_code == 2){
                            output += `<span style="color:red;">Email sending failed</span>`;
                            setTimeout(function(){ location.reload(); }, 1000);
                        }
                        else if(data.err_code == 3){
                            output += `<span style="color:red;">Email feild cannot be empty</span>`;
                            setTimeout(function(){ location.reload(); }, 1000);
                        }else{
                            output += `Unkown error occured`; 
                        }
                        
                    }
                   
                    // document.getElementById('showMessage').innerHTML = output;
                    $('#showMessage').html(output);
                })
                .catch(function(error){
                    console.log(error)
                })
            });
            
        });
    </script>

</body>

</html>