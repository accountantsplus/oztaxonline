
<!DOCTYPE html>
<html>

<head>
    <?php
    header("Access-Control-Allow-Origin: *");
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#35A768">

    <title><?= lang('page_title') . ' ' .  $company_name ?></title>

    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/ext/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/ext/jquery-ui/jquery-ui.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/ext/jquery-qtip/jquery.qtip.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/ext/cookieconsent/cookieconsent.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/css/frontend.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/css/general.css') ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <link rel="icon" type="image/x-icon" href="<?= asset_url('assets/img/favicon.ico') ?>">
    <link rel="icon" sizes="192x192" href="<?= asset_url('assets/img/logo.png') ?>">
    <style>
        .alert-custom{
            background: rgba(0, 0, 0, 0.2);
            margin-top: 5px;
            color: black;
        }
        .img-custom{
            margin-left: 5px;
        }

        .tooltip {
            position: absolute;
            display: inline-block;
            opacity: 100;
            margin-top: 15px;
            margin-left: 18px;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 320px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            
            /* Position the tooltip */
            position: absolute;
            z-index: 1;
            top: 0px;
            left: 105%;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }
        .wrapper{ 
            width: 350px;
            padding: 20px; 
            
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-default nav-height">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <img alt="Cloud Diary" src="../../assets/img/logo.png" class="custom-img">   
                </a>
            </div>
            <!-- <center>
                <h4 style="color: #002080">Welcome To Our Friendly Appointment Scheduling System</h4>
            </center>
            <center>
                <h6 style="color: #002080">Australias' No. 1 &amp; Most Desired Police Tax Services.</h6>
            </center> -->
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="https://policetax.com.au"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-play-circle"></span> Services</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-star-empty"></span> Testimonials</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-list"></span> FAQs</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-phone-alt"></span> Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar nav-custom sticky-top">
        <div class="container-fluid">
            <div class="navbar-header" style=" margin-top: 5px !important;">
                <a class="nav-link" href="tel:1800 819 692" style="color: white !important; font-size: 1.5rem;"><i class="fa fa-phone fa-rotate-90"></i> Call us now :1800 819 692</a>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="">
                <ul class="navbar-nav custom-nav navbar-right" style="list-style-type: none !important; margin-right:30px; margin-top: 5px; ">
                    <li><span> <?php echo date('D d M Y'); ?></span></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="main" class="container">
        <div class="wrapper row">
            <div class="col-md-1 col-lg-1" style=""></div>
            <div id="login-frame" class=" col-md-11 frame-container">
                <div class="alert alert-custom">
                    <strong>Please Note!</strong> Payment details are required as you proceed. Please keep your payment details handy. 
                    <img class="img-custom" src="<?= asset_url('assets/img/mastercard.png') ?> " width="28" alt="">
                    <img class="img-custom" src="<?= asset_url('assets/img/paypal.png') ?> " width="28" alt="">
                    <img class="img-custom" src="<?= asset_url('assets/img/visa.png') ?> " width="28" alt="">
                    <img class="img-custom" src="<?= asset_url('assets/img/card.png') ?> " width="28" alt="">
                </div>
                <div class="alert hidden"></div>
                <div class="wrapper">
                    
    <h2>Appointment Login</h2>
    <p>Please fill in your credentials to login.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>Don't have an account? <a href="/appo/index.php/appointments/signin">Sign up now</a>.</p>
    </form>
</div>
                
            </div>
        </div>
    </div>

    -- <div class="container-fluid" style="padding: 15px 15px;">
        <div class="container">
            <div class="row">
                <!\\-- <div class="col-md-8">
                    <h5>
                        Using our online appointment scheduling for the first time in 2019?
                    </h5>
                </div> --
                <div class="col-md-4">
                </div>
                <div>  --
         
              
                     
                !-- <div class="col-md-4">
                     <div class="row">
                         <div class="col-md-2">
                                <img src="../../../../images/PoliceLogo.jpg" alt="Police Logo Video Bookings" height="84" width="84" style="margin-left:-50px;"> 
                         </div>
                         
                         <div class="col-md-2">
                            <button style="margin-top: 5px;width: 300px;font-size: 20px;" id="login" class="btn btn-success" style="margin-left:150px;">
                            Remote Video Tax Bookings
                        </button>
                         </a>
                         </div>
                     </div> 
                       
                    

                    <div class="tooltip"><i class="fa fa-question-circle fa-3x" aria-hidden="true"></i>
                        <span class="tooltiptext">We are moving to a new database system in order to provide more services to our valued customers. Please click on the 'Appointments Register' button to use our appointment scheduling system and book an appointment for yourself online.</span>
                    </div> --

                </div>
            </div>
        </div>
    </div>

     <div class="container-fluid">
        <div class="container" style="background: #e8e8e8;margin-top:15px;">
            <span>
                <span style="position: absolute;margin-top: 11px;">
                    Authority to Act-by registering an appointment here you agree for PoliceTax which is a domain name member<br> owned by Accountants Plus Pty Ltd
                
                    Reg.Tax Agent No 55961005 to access my ATO Portal records to begin my<br> 2020 Tax( or Late years if Required) further T & C Apply inside.
                    
                </span><br><br>
                <a href="#" class="showmore" style="right: 216px;position: absolute;margin-top: 11px;">+ Show More</a>
            </span>
            <br/><br/>
            <div class="info-checklist" style="display:none;">
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <div class="text-center"><img src="../../assets/img/clock.png" alt="" width="98"></div>
                    <p>Access to our portal 24/7 wherever, whenever, and however. </p>
                </div>
                <div class="col-md-2">
                    <div class="text-center"><img src="../../assets/img/card.png" alt="" width="98"></div>
                    <p>PrePay when you book. We accept range of cards and payment methods.</p>
                </div>
                <div class="col-md-2">
                    <div class="text-center"><img src="../../assets/img/checklist.png" alt="" width="98"></div>
                    <p>Free tax checklist to relieve your tax stress and gain more tax refund.</p>
                </div>
                <div class="col-md-2">
                    <div class="text-center"><img src="../../assets/img/lock.png" alt="" width="98"></div>
                    <p>Don't worry! you are in safe hands. We encrypt all your data.</p>
                </div>
                <div class="col-md-2">
                    <div class="text-center"><img src="../../assets/img/app.png" alt="" width="98"></div>
                    <p>An App just for you. Book, Lodge, and Save at your finger tips.</p>
                </div>

            </div>
        </div>

    </div> --

    <a href="#" class="float">
        <i class="fa fa-phone fa-rotate-90 my-float"></i>
    </a>

    <!-- Footer -->
    <footer class="page-footer footer pt-4">

        <!-- Footer Links -->
        <div class="container">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-3 mt-md-0 mt-3">

                    <!-- Content -->
                    <h5 class="text-uppercase">PoliceTax</h5>
                    <p>Want the best possible tax refund you have ever had? Consider using our Police tax specialised service. Over 3,500 other Police officers can't be wrong.</p>

                </div>
                <!-- Grid column -->


                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Yes, We have Apps</h5>
                    <h6 class="text-uppercase">Get it now!</h6>
                    <img src="../../assets/img/googleplay.png" alt="Google Play Store" width="170" />
                    <img src="../../assets/img/applestore.png" alt="Apple App Store" width="150" style="margin-left:10px;" />
                    </ul>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">
                    <h5 class="text-uppercase"> Payment Options</h5>

                    <ul class="list-unstyled">

                        <span class="fab fa-cc-mastercard custom-icon-colored"></span>
                        <span class="fab fa-cc-visa custom-icon-colored"></span>
                        <span class="fab fa-paypal custom-icon-colored"></span>
                        <span class="far fa-credit-card custom-icon-colored"></span>
                        <!-- <strong><em>Step 4</em></strong> Requires your payment info. -->
                    </ul>

                    <!-- Links -->
                    <h5 class="text-uppercase">You are in safe hands</h5>
                    <img src="../../assets/img/comodo_logo.png" alt="Comodo Secured" width="100" />

                </div>
                <!-- Grid column -->

                <div class="col-md-3 mb-md-0 mb-3">
                    <h5 class="text-uppercase">Refer a friend</h5>
                    <button class="btn btn-lg btn-info">Let's Share</button>

                </div>

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <hr style="border-color: #fffff;" width="60%">

        <section class="footer-areaMain" id="assistance" style="text-align: center; padding-bottom: 10px;">
            <div class="container" style="padding-top: 5px;">
                <div class="row">
                    <div class="col-md-12"><span class="footer-note"><a href="https://www.policetax.com.au/appo/">Book Appointments</a></span> <span class="footer-note">
                            <a href="#">Online Tax</a></span> <span class="footer-note">
                            <a href="#">Send to a friend</a></span> <span class="footer-note"><a href="#">Skype Appointments</a></span>
                        <span class="footer-note"><a href="https://www.policetax.com.au/sports/">Our TaxBlog</a></span>
                        <span class="footer-note"><a href="https://www.policetax.com.au/Prod/contact.php">Contact Us</a></span></div>
                </div>
            </div>

            <div class="container" style="padding-top: 11px;font-size:12px;color:white;"><span class="footer-note">Copyright © <script>
                        document.write(new Date().getFullYear());
                    </script></span> <span class="footer-note"><a href="#">Members Login</a></span> <span class="footer-note">
                    <span class="footer-note"><a href="#">Sitemap</a></span> <span class="footer-note">
                        <a href="https://www.policetax.com.au/Prod/PrivacyPolicy.php">Privacy Policy</a></span> <span class="footer-note">

                        <a href="https://www.policetax.com.au/Prod/TermsConditions.php">Terms and Conditions</a></span></span></div>

        </section>

    </footer>
    <!-- Footer -->
    <!---------- Client Details -------------->
    </div>

    <?php if ($display_cookie_notice === '1') : ?>
        <?php require 'cookie_notice_modal.php' ?>
    <?php endif ?>

    <?php if ($display_spouse_details == '1') : ?>
        <?php require 'spouse_details_modal.php' ?>
    <?php endif ?>

    <?php if ($display_terms_and_conditions === '1') : ?>
        <?php require 'terms_and_conditions_modal.php' ?>
    <?php endif ?>

    <?php if ($display_privacy_policy === '1') : ?>
        <?php require 'privacy_policy_modal.php' ?>
    <?php endif ?>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5b30358deba8cd3125e3211a/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();

        $("#tawkchat-chat-bubble-close").hide();
        $(".agentInfoNoImage").find("b").text("Customer Service");
    </script>
    <!--End of Tawk.to Script-->
    <script>
        var GlobalVariables = {
            availableServices: <?= json_encode($available_services) ?>,
            availableProviders: <?= json_encode($available_providers) ?>,
            baseUrl: <?= json_encode(config('base_url')) ?>,
            manageMode: <?= $manage_mode ? 'true' : 'false' ?>,
            customerToken: <?= json_encode($customer_token) ?>,
            dateFormat: <?= json_encode($date_format) ?>,
            timeFormat: <?= json_encode($time_format) ?>,
            displayCookieNotice: <?= json_encode($display_cookie_notice === '1') ?>,
            appointmentData: <?= json_encode($appointment_data) ?>,
            providerData: <?= json_encode($provider_data) ?>,
            customerData: <?= json_encode($customer_data) ?>,
            csrfToken: <?= json_encode($this->security->get_csrf_hash()) ?>,
            AJAX_SUCCESS: 'SUCCESS'
        };

        var EALang = <?= json_encode($this->lang->language) ?>;
        var availableLanguages = <?= json_encode($this->config->item('available_languages')) ?>;
    </script>

    <script src="<?= asset_url('assets/js/general_functions.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/jquery/jquery.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/jquery-ui/jquery-ui.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/jquery-qtip/jquery.qtip.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/cookieconsent/cookieconsent.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/datejs/date.js') ?>"></script>
    <script src="<?= asset_url('assets/js/frontend_book_api.js') ?>"></script>
    <script src="<?= asset_url('assets/js/frontend_book.js') ?>"></script>

    <script>
        var count = 0;
        $(document).ready(function() {
            FrontendBook.initialize(true, GlobalVariables.manageMode);
            GeneralFunctions.enableLanguageSelection($('#select-language'));

            $(".showmore").on("click", function(e){
                e.preventDefault();
                if(count == 0){
                    $(".info-checklist").show();
                    $(this).html("- Show Less");
                    count = 1;
                } else if(count == 1){
                    $(".info-checklist").hide();
                    $(this).html("+ Show More");
                    count = 0;
                }
            });

            $('#login-forms').submit(function(event) {
                event.preventDefault();
                console.log("Hi there")

                var postUrl = GlobalVariables.baseUrl + '/index.php/appointments/ajax_simple_check_login';
                var postData = {
                    'csrfToken': GlobalVariables.csrfToken,
                    'username': $('#username').val(),
                    'password': $('#password').val()
                };

                $.post(postUrl, postData, function(response) {
                    if (!GeneralFunctions.handleAjaxExceptions(response)) {
                        return;
                    }

                    if (response == GlobalVariables.AJAX_SUCCESS) {
                        window.location.href = GlobalVariables.baseUrl;
                    } else {
                        $('.alert').text(EALang['login_failed']);
                        $('.alert')
                            .removeClass('hidden alert-danger alert-success')
                            .addClass('alert-danger');
                    }
                }, 'json');
            });


        });
    </script>

    <?php google_analytics_script(); ?>
</body>

</html>