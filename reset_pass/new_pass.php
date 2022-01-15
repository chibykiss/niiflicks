
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
                    <?php
                        if(isset($_GET['ss']) && isset($_GET['vl'])){
                            if(!empty($_GET['ss']) && !empty($_GET['vl'])){
                                $selector = $_GET['ss'];
                                $token = $_GET['vl'];
                                if(ctype_xdigit($selector) !== false && ctype_xdigit($token) !== false){
                                ?>
                                    <form id="pms_recover_password_form" class="pms-form">
                                        <h4>New Password</h4>
                                        <p class="font-weight-bold">Please enter your new password</p>
                                        <ul class="pms-form-fields-wrapper pl-0 mb-4">
                                            <li class="pms-field">
                                                <input type="hidden" name="select" value="<?=$selector?>"/>
                                                <input type="hidden" name="validate" value="<?=$token?>"/>
                                                <input type="password" placeholder="password" name="pwd" value="">
                                            </li>
                                            <li class="pms-field">
                                                <input type="password" placeholder="repeat-password" name="rpwd"  value="">
                                            </li>
                                            <p id="showMessage"> </p>
                                        </ul>
                                        
                                        <input type="submit" name="Resetsubmit" value="Reset Password">
                                    </form>
                                <?php
                                }else{
                                    echo '<h3>invalid url tokens</h3>';
                                }
                            }else{
                                echo '<h3>we could not validate your request</h3>';
                            }
                        }else{
                            echo '<h3>not set</h3>';
                        }
                    ?>
                        
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            let resetform = document.getElementById('pms_recover_password_form');
            var output = '';
            resetform.addEventListener('submit', function(e){
                e.preventDefault();
                //alert('you submitted')
                
                
             
                formData = new FormData(resetform);
                fetch('apis/reset_password.php',{
                    method: 'POST',
                    body: formData
                })
                .then((res) => res.json())
                .then((data) => {
                    console.log(data);
                    if(data.error == false){
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your app password has been changed',
                        showConfirmButton: false,
                        timer: 1500
                        })
                        setTimeout(function(){ window.location.assign('index') }, 1500);
                    }
                    else if(data.error == true){
                        switch (data.errcode){
                            case 1:
                                output += `you did not request for a password reset`;
                                setTimeout(function(){ window.location.assign('index'); }, 1500);
                                break;
                            case 2:
                                output += `your reset link is expired`;
                                setTimeout(function(){ window.history.back(); }, 1500);
                                break;
                            case 3:
                                output +=`<span style="color:red;">your token does not match</span>`;
                                setTimeout(function(){ window.history.back(); }, 1500);
                                break;
                            case 4:
                                output +=`<span style="color:red;">your password do not match</span>`;
                                setTimeout(function(){ location.reload(); }, 1000);
                                break;
                            case 5:
                                output +=`<span style="color:red;">fill in the missing feild/s</span>`;
                                setTimeout(function(){ location.reload(); }, 1000);
                                break;
                            case 6:
                                output +=`some values were not set`;
                                setTimeout(function(){ window.location.assign('index'); }, 1500);
                                break;
                            default:
                                output +=`unkown errors occured`;
                                setTimeout(function(){ window.location.assign('index'); }, 1500);
                                break;
                        }
                        $('#showMessage').html(output);
                    }else{
                        console.log('village people error');
                    }
                   
                })
                
                // .catch(function(error){
                //     console.log(error)
                // })
                //alert(email);
            });
            
        });
    </script>

</body>

</html>