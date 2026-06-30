<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="favicon.png" type="image/png">
        <title>Police Tax</title>

        <!-- Icon css link -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Extra plugin css -->
        <link href="dist/jquery.flipster.min.css" rel="stylesheet">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121181267-1"></script>
        <script>
            //location.reload(true);
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-121181267-1');
        </script>


        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <link href="css/responsive.css" rel="stylesheet">

        <style>
        .price{
            color: #7CC144;
        }
        .tollFree-number{
            color: #3A00A4;
            position: absolute;
            right: 5%;
            top: 94px;
            z-index: 1;
        }

        #logo-comodo{
            position: absolute;
            right: 79px;
            margin-top: -108px;
        }

        .learn-more{
            text-decoration:none;
        }

        .learn-more:hover, .learn-more:focus{
            color:#3A00A4;
        }

        .btn-close{
            font-size: 24px;
            position: absolute;
            margin-top: 65px;
            right: 145px;
            cursor: pointer;
            z-index: 40000;
        }

        .btn-close:hover{
            color: red;
        }

        .more-info-btn {
            color: white;
            background: #4C8FFB;
            border: 1px #3079ED solid;
            box-shadow: inset 0 1px 0 #80B0FB;
        }

        .more-info-btn:active {
            box-shadow: inset 0 2px 5px #2370FE;
        }

        .more-info-btn:hover {
            border: 1px #2F5BB7 solid;
            box-shadow: 0 1px 1px #EAEAEA, inset 0 1px 0 #5A94F1;
            background: #3F83F1;
        }
        </style>
    </head>
    <body>
        <!--================Header Menu Area =================-->
        <header class="main_menu_area">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="https://www.policetax.com.au"><img src="img/logo.png" alt="" width="44%"></a>
                <span class="navbar-toggler">
                    <i class="fa fa-bars" aria-hidden="true" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"></i>
                    
                </span>
                <div id="mySidenav" class="sidenav" style="display:none;">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <ul>
                        <li><a href="https://www.policetax.com.au">Home</a></li>
                        <li class="active"><a href="#">Basic Packages</a></li>
                        <li><a href="compare-us">Compare Us</a></li>
                        <li>
                            <a href="other-tax-solutions-menu">Other Tax Solutions</a>
                        </li>
                        <li>
                            <a href="#assistanceMenu" aria-expanded="false">Assistance <i class="fa fa-chevron-circle-down logo-side-menu" aria-hidden="true"></i></a>
                            <ul class="collapse list-unstyled" id="assistanceMenu">
                                <li><a href="download-centre.php">Downloads</a></li>
                    
                                <li><a href="about-us-online">About Us</a></li>
                                <li><a href="frequently-asked-questions">FAQ</a></li>
                                <!--<li><a href="#">Help Levels</a></li>
                                <li><a href="#">Free Tax Assists</a></li>
                                <li><a href="#">CPA Contact</a></li>-->
                            </ul>
                        </li>
                    </ul>
                </div>
                

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="https://www.policetax.com.au" class="hvr">Home</a></li>
                        <li class="nav-item active"><a href="#" class="hvr">Basic Packages</a></li>
                        <li class="nav-item"><a href="compare-us">Compare Us</a></li>
                        <li class="nav-item parent">
                            <a href="other-tax-solutions-menu" class="hvr">Other Tax Solutions</a>
                            <!-- <ul class="child">
                                <li><a href="#">Spouse/Family</a></li>
                    
                                <li><a href="#">Past Poor Refund</a></li>
                                <li><a href="#">Multi years Late</a></li>
                                <li><a href="#">Skype Tax</a></li>
                            </ul> -->
                        </li>
                        <li class="nav-item parent">
                            <a href="#">Assistance</a>
                            <ul class="child">
                                <li><a href="download-centre">Downloads</a></li>
                                <li style="width:200px;"><a href="about-us-online">About Us </a></li>
                                <li><a href="frequently-asked-questions">FAQ</a></li>
                                <!--<li><a href="#">Help Levels</a></li>
                                <li><a href="#">Free Tax Assists</a></li>
                                <li><a href="#">CPA Contact</a></li>-->
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!--================End Header Menu Area =================-->
        <div>
            <span class="click-to-call-sticky"><i class="fa fa-phone-square" aria-hidden="true"></i> Click to call</span>
        </div>
        <!--================Slider Area =================-->
        <section class="banner-section">
            <div class="container">
                <div class="title_center">
                    <p style="    font-size: 20px;">Find the right tax package for you</p>
                </div>
            </div>
        </section>
<span class="tollFree-number">Call our tax assist team on : 1800-819-692</span>
        <section class="slider_area">
            <div class="container">
                <div id="coverflow">
                    <ul class="flip-items">
                        <!--<li data-flip-title="BudgetTax" class="flip-item">
                            <div class="flip-content">
                                <span id="budget-price" class="price"></span>
                                <img src="img/logos/Budget.png">
                                <span class="description">
                                    <!-- <p>test</p> -->
<!--<h6 style="    color: #c64d4d;margin-bottom: 3px;">Best suited for the budget conscious</h6>
<p>Allows for one wage simple deductions.</p>
<p>Interest, dividends & govt payments.</p>
<p>5 total deduction categories (totals only).</p>
<p>No limit to total value of tax claims.</p>
<p>All tax offsets available.</p>
<p>Help limited to tax checklists only.</p>

                                    <span class="inner-description">
                                        <!-- <b><p>Simple deductions, Income from Salary and Wages + Up to 5 deductions only + Basic Assistance that includes tax tool tips.</p></b> -->
                                    <!--</span>
                                    <input type="button" value="Start" class="start-tax-btn" redirect-url="https://www.policetax.com.au/new-budget-tax" />

                                </span>
                            </div>
                        </li>-->
                        <li data-flip-title="ExpressTax" class="flip-item">
                            <div class="flip-content">
                                <span id="express-price" class="price"></span>
                                <img src="img/logos/EXPRESS.png" width="500px" height="500px">
                                <span class="description">
                                    <!-- <p>test</p> -->
<h6 style="   color: #c64d4d; margin-bottom: 3px;">Fast and easy to use-minimum fuss</h6>
<p>Allows for two wages & 35 specific claims.</p>
<p>Interest, dividends & govt payments.</p>
<p>35 of our most used occupation tax claims. </p>
<p>No limit to total value of tax claims. </p>
<p>All tax offsets available. </p>
<p>Help-includes access to tax assist hotline. </p>

                                    <span class="inner-description">
                                        <!-- <b><p>Easy and Fast Tax returns in 15 minutes+ Income from Salary
                                            and Wages+ Up to 30 tax deductions+ and medium assistance (Free worksheets+ tax
                                            checklists+ Tax Assistance team+ live chat)</p></b> -->
                                    </span>
                                    <input type="button" value="Start" class="start-tax-btn" redirect-url="https://www.policetax.com.au/packages?packageName=express" />

                                </span>
                            </div>
                        </li>
                        <li data-flip-title="StandardTax" class="flip-item">
                            <div class="flip-content">
                                <span id="standard-price" class="price"></span>
                                <img src="img/logos/STANDARD.png">
                                <span class="description">
                                    <!-- <p>test</p> -->
<h6 style="    color: #c64d4d;margin-bottom: 3px;">Multiple incomes & deductions</h6>
<p>Allows two job incomes (no upper limit).</p>
<p>Interest, dividends & govt payments.</p>
<p>60 occupation specific deductions.</p>
<p>Use our claims list to boost your refund.</p>
<p>All tax offsets available. </p>
<p>Help-Tax assist hotline checklist available.</p>


                                    <span class="inner-description">
                                        <!-- <b><p>Complex deductions + Income from Salary and Wages+ Up to 45 tax
                                            deductions+ full assistance (free worksheets+taxlists+ 24x7 tax assistance+ live chat)</p></b> -->
                                    </span>
                                    <input type="button" value="Start" class="start-tax-btn" redirect-url="https://www.policetax.com.au/packages?packageName=standard" />


                                </span>
                            </div>
                        </li>
                        <li data-flip-title="Premium Range" class="flip-item">
                            <div class="flip-content">
                                <span class="price"></span>
                                <img src="img/logos/PremiumRange.png">
                                <span class="description">
                                    <!-- <p>test</p> -->
<h6 style="    color: #c64d4d;text-align: center; margin-bottom: 3px;">Premium Range Services</h6>
<p>Premium Plus</p>
<p>Rental Plus</p>
<p>Sole Trader</p>
<p>New Recruits</p>
<p>Skype Tax Services</p>

                                    <span class="inner-description">
                                        <!-- <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
                                    </span>
<input type="button" value="More Info" class="more-info-btn" />
<!-- <span style="margin-left: 50px;color: #3A00A4;"><h3>Coming Soon..</h3></span> -->
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
           
        </section>
        

        <section class="slider_area2" style="display:none;">
            <span class="btn-close"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
            <div class="container">
                <div id="coverflow2" style="height: 630px !important;margin-top: -50px;">
                    <ul class="flip-items">
                        <li data-flip-title="PremiumPlusTax" class="flip-item">
                            <div class="flip-content">
                                <span id="premium-price" class="price"></span>
                                <img src="img/logos/Premium Tax Logo.png">
                                <span class="description">
                                    <!-- <p>test</p> -->
<h6 style="    color: #c64d4d; margin-bottom: 3px;">The tax system with the lot</h6>
<p>Unlimited job income certificates.</p>
<p>Interest, dividends & all govt payments.</p>
<p>85 occupation specific deductions.</p>
<p>Most comprehensive deductions available.</p>
<p>All tax offsets available. </p>
<p>Help-Extensive options plus live chat.</p>

                                    <span class="inner-description">
                                        <!-- <b><p>Multiple Tax deductions+ Income from Salary and Wages+ Upto 55
                                            tax deductions+ Full Assistance (Free checklists+ 24x7 tax assistance+ call back service+ free
                                            audit insurance)</p></b> -->
                                    </span>
                                    <input type="button" value="Start" class="start-tax-btn" redirect-url="https://www.policetax.com.au/packages?packageName=premium" />
                                </span>
                            </div>
                        </li>
                        <li data-flip-title="RentalTax" class="flip-item">
                            <div class="flip-content">
                                <span id="rental-price" class="price"></span>
                                <img src="img/logos/rental plus.png">
                                <span class="description">
                                    <!-- <p>test</p> -->
<h6 style="    color: #c64d4d; margin-bottom: 3px;">Tax service with the lot + one rental</h6>
<p>Unlimited job income plus 1 rental property.</p>
<p>Rental schedule with all landlord claims.</p>
<p>60 most used occupation specific claims.</p>
<p>Boost your refund using our tax claims list.</p>
<p>All tax offsets available. </p>
<p>Help-Extensive options plus live chat.</p>

                                    <span class="inner-description">
                                        <!-- <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
                                    </span>
<input type="button" value="Start" class="start-tax-btn" redirect-url="https://www.policetax.com.au/packages?packageName=rental" />
<!-- <span style="margin-left: 50px;color: #3A00A4;"><h3>Coming Soon..</h3></span> -->
                                </span>
                            </div>
                        </li>
                        <li data-flip-title="SoleTraderTax" class="flip-item">
                            <div class="flip-content">
                                <span id="soleTrader-price" class="price"></span>
                                <img src="img/logos/smallBusiness.png">
                                <span class="description">
                                    <!-- <p>test</p> -->
<h6 style="    color: #c64d4d; margin-bottom: 3px;">Sole business owner plus salaried jobs</h6>
<p>Unlimited job income plus 1 small business.</p>
<p>Business schedule with all business claims.</p>
<p>60 most used occupation specific claims.</p>
<p>Boost your refund using our tax claims list.</p>
<p>All tax offsets available. </p>
<p>Help-Extensive options plus live chat.</p>

                                    <span class="inner-description">
                                        <!-- <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
                                    </span>
                                    <input type="button" value="Start" class="start-tax-btn" redirect-url="https://www.policetax.com.au/packages?packageName=soleTrader" />
<!-- <span style="margin-left: 50px;color: #3A00A4;"><h3>Coming Soon..</h3></span> -->

                                </span>
                            </div>
                        </li>
                        <li data-flip-title="NewRecruitsTax" class="flip-item">
                            <div class="flip-content">
                                <span id="newrecruit-price"  class="price"></span>
                                <img src="img/logos/new-recruit.png">
                                <span class="description" style="top:71% !important;">
                                    <!-- <p>test</p> -->
<h6 style="        font-size: 20px; text-align: center;color: #c64d4d; margin-bottom: 3px;">New Recruits tax service</h6>
<p>New Recruits at the Police Academy. </p>
<p>Allows for two wages & 35 specific claims.</p>
<p>Interest, dividends & govt payments.</p>
<p>35 of our most used occupation tax claims. </p>
<p>All tax offsets available. </p>

                                    <span class="inner-description">
                                        <!-- <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
                                    </span>
<input type="button" value="Start" class="start-tax-btn" redirect-url="https://www.policetax.com.au/packages?packageName=newRecruit" />
                                    <!-- <input type="button" value="Start" class="start-tax-btn" redirect-url="https://www.policetax.com.au/new-recruits-tax" />
<span style="margin-left: 50px;color: #3A00A4;"><h3>Coming Soon..</h3></span> -->

                                </span>
                            </div>
                        </li>
                        <li data-flip-title="SkypeTax" class="flip-item">
                            <div class="flip-content">
                                <span id="skype-price"  class="price"></span>
                                <img src="img/logos/SkypeTax.png">
                                <span class="description" style="top:71% !important;">
                                    <!-- <p>test</p> -->

<h6 style="        font-size: 20px; text-align: center;color: #c64d4d; margin-bottom: 3px;">Skype tax service</h6>
<p>Unlimited job income certificates.</p>
<p>Interest, dividends & all govt payments.</p>
<p>85 occupation specific deductions.</p>
<p>Most comprehensive deductions available.</p>
<p>All tax offsets available. </p>
<p>Help-with direct assistance from expert. </p>


                                    <span class="inner-description">
                                        <!-- <b><p>Complex deductions + Income from Salary and Wages+ Up to 45 tax
                                            deductions+ full assistance (free worksheets+taxlists+ 24x7 tax assistance+ live chat)</p></b> -->
                                    </span>
                                    <input type="button" value="Start" class="start-tax-btn" redirect-url="https://www.policetax.com.au/skype-tax-registration-1" />
<!-- <span style="margin-left: 50px;color: #3A00A4;"><h3>Coming Soon..</h3></span> -->

                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
           
        </section>
        <!--================End Slider Area =================-->

        <!--================ Steps Area=================-->
        <section class="declaration-banner-section"> 
            <div class="container">
                <div class="b_center_title">
                    <h3>Australia's leading occupation specific online tax solutions.</h3>
                    <!-- <p>We Are A Creative Digital Agency. Focused on Growing Brands Online</p> -->
                </div>
                <span id="logo-comodo"><img src="img/imgs-form/comodo_logo.png" style="height: 60px;" /></span>
            </div>
        </section>
        <section class="latest_news_area p_80">
            <div class="container">
                <div class="b_center_title">
                    <h2>Why Trust us?</h2>
                    <!-- <p><b>Why Trust us?</b></p> -->
                </div>
                <div class="l_news_inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="l_news_item">
                                <div class="l_news_img"><a href="#"><img class="img-fluid" src="img/blog/b-news/1.jpg" alt=""></a></div>
                                <div class="l_news_content">
                                    <a href="#"><h4>Tax Results</h4></a>
                                    <p>We will call you to discuss your tax results as soon as we have received it.</p><br/><br/>
                                    <!-- <a class="more_btn" href="#">Learn More</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="l_news_item">
                                <div class="l_news_img"><a href="#"><img class="img-fluid" src="img/blog/b-news/2.png" alt=""></a></div>
                                <div class="l_news_content">
                                    <a href="#"><h4>Skype Service</h4></a>
                                    <p>If you change your mind part way through our online we have an easy upgrade path.</p>
                                    <a class="more_btn learn-more" href="https://www.policetax.com.au/skype-tax-registration-1">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="l_news_item">
                                <div class="l_news_img"><a href="#"><img class="img-fluid" src="img/blog/b-news/3.jpg" alt=""></a></div>
                                <div class="l_news_content">
                                    <a href="#"><h4>Service Guarantee</h4></a>
                                    <p>We take care of our invaluable customers and provide a quality service.</p><br/>
                                    <a class="more_btn learn-more" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="l_news_item">
                                <div class="l_news_img"><a href="#"><img class="img-fluid" src="img/blog/b-news/4.jpg" alt=""></a></div>
                                <div class="l_news_content">
                                    <a href="#"><h4>Easy Payment</h4></a>
                                    <p>We do not deduct our fee from clients ATO refund. Your refund gets to you a lot quicker.</p><br/>
                                    <!-- <a class="more_btn" href="#">Learn More</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="latest_news_area p_80" style="margin-top: 55px;">
            <div class="container">
                <div class="b_center_title">
                    <!-- <h2>Latest News</h2> -->
                    <p><b>4X easy steps to complete your tax for 2018 year</b></p>
                </div>
                <div class="l_news_inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="l_news_item">
                                <div class="l_news_img"><a href="#"><img class="img-fluid" src="img/blog/l-news/l-news-1.jpg" alt=""></a></div>
                                <div class="l_news_content">
                                    <a href="#"><h4>Step 1</h4></a>
                                    <p>Enter your personal details and answer some basic tax questions.</p>
                                    <!-- <a class="more_btn" href="#">Learn More</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="l_news_item">
                                <div class="l_news_img"><a href="#"><img class="img-fluid" src="img/blog/l-news/l-news-2.jpg" alt=""></a></div>
                                <div class="l_news_content">
                                    <a href="#"><h4>Step 2</h4></a>
                                    <p>Key in your income from your job/salary and any interest or other income.</p>
                                    <!-- <a class="more_btn" href="#">Learn More</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="l_news_item">
                                <div class="l_news_img"><a href="#"><img class="img-fluid" src="img/blog/l-news/l-news-3.jpg" alt=""></a></div>
                                <div class="l_news_content">
                                    <a href="#"><h4>Step 3</h4></a>
                                    <p >Record your tax deductions which are listed specifically for your occupation.</p>
                                    <!-- <a class="more_btn" href="#">Learn More</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="l_news_item">
                                <div class="l_news_img"><a href="#"><img class="img-fluid" src="https://agilemanagementoffice.com/wp-content/uploads/2017/10/computer-laptop-work-office.jpg" alt=""></a></div>
                                <div class="l_news_content">
                                    <a href="#"><h4>Step 4</h4></a>
                                    <p>We do the rest for you and your tax refund back within 14 days, hassle free.</p>
                                    <!-- <a class="more_btn" href="#">Learn More</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section style="padding-top: 12px;"> 
            <div class="container">
                <div class="b_center_title">
                    <p style="color: red;">Don't be fooled by cheaper online solutions which have many restrictions which wont maximise your tax refund amount.</p>
                    <p style="color: #3a00a4;font-size: 15px;">You want the best possible tax refund don't you? Imagine what you can do with an excellent tax refund cheque deposited straight into your bank account.</p>
                    <!-- <p>We Are A Creative Digital Agency. Focused on Growing Brands Online</p> -->
                </div>
            </div>
        </section>
        <!--================End Latest News Area =================-->
            <div class="copy_right_area">
                <div class="container">
                    <div class="float-md-left">
                        <h5>Copyright &copy; <script>document.write(new Date().getFullYear());</script></h5>
                    </div>
                    <div class="float-md-right">
                        <ul class="nav">
                            <!--<li class="nav-item">
                                <a class="nav-link" href="#">Contact us</a>
                            </li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!--================End Footer Area =================-->
        
        <div class="overlay"></div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Extra plugin css -->
        <script src="dist/jquery.flipster.min.js"></script>

        <script src="js/theme.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
        <script>
            $(document).ready(function(){
                $("a[aria-expanded='false']").on("click", function(e){
                    e.preventDefault();
                    if( $(this).parent().find("ul").hasClass("collapse")){
                        $(this).parent().find("ul").removeClass("collapse").fadeIn(1000);
                    }
                    else{
                        $(this).parent().find("ul").addClass("collapse").fadeOut(1000);
                    }
                });
                
                $.get("price", function(response){
                    response = JSON.parse(response);
                    if(response.success){
                        $.each(response.aaData, function(i, v){
                            if(v.FieldName.toLowerCase().indexOf("budget") != -1){
                                $("#budget-price").html("$" + v.FieldValues);
                            } else if(v.FieldName.toLowerCase().indexOf("budget") != -1){
                                $("#budget-price").html("$" + v.FieldValues);
                            } else if(v.FieldName.toLowerCase().indexOf("express") != -1){
                                $("#express-price").html("$" + v.FieldValues);
                            } else if(v.FieldName.toLowerCase().indexOf("standard") != -1){
                                $("#standard-price").html("$" + v.FieldValues);
                            } else if(v.FieldName.toLowerCase().indexOf("premium") != -1){
                                $("#premium-price").html("$" + v.FieldValues);
                            } else if(v.FieldName.toLowerCase().indexOf("rental") != -1){
                                $("#rental-price").html("$" + v.FieldValues);
                            } else if(v.FieldName.toLowerCase().indexOf("soletrader") != -1){
                                $("#soleTrader-price").html("$" + v.FieldValues);
                            } else if(v.FieldName.toLowerCase().indexOf("newrecruit") != -1){
                                $("#newrecruit-price").html("$" + v.FieldValues);
                            } else if(v.FieldName.toLowerCase().indexOf("skype") != -1){
                                $("#skype-price").html("$" + v.FieldValues);
                            } 
                        });
                    }
                });
            });
            var coverflow = $("#coverflow").flipster({
                style: 'carousel',
                spacing: -0.15,
                buttons: true,
                start: 2,
                scrollwheel: false,
            });
            
            var coverflow2 = $("#coverflow2").flipster({
                style: 'carousel',
                spacing: -0.15,
                buttons: true,
                start: 0,
                scrollwheel: false,
            });

            $(document).on("click", ".more-info-btn", function(e){
                e.preventDefault();
                $(".slider_area2").show();
                
                $('html, body').animate({
                    scrollTop: $(".slider_area2").offset().top
                }, 2000);
            });

            $(document).on("click", ".btn-close", function(e){
                e.preventDefault();
                
                $('html, body').animate({
                    scrollTop: $(".slider_area").offset().top
                }, 2000);
                $(this).parent().hide();
            });

            $(".start-tax-btn").on("click", function(e){
                e.preventDefault();
                var val = $(this).attr("redirect-url");
                document.location.href = val;
            });

            $(".navbar-toggler").on("click", function(e){
                e.preventDefault();
                $(".sidenav").show();
                $(".overlay").show();
                $(".navbar-toggler").hide();
                var height = $(document).height();
                document.getElementById("mySidenav").style.width = "235px";
                document.getElementById("mySidenav").style.height = "2700px";

            });

            $("a [aria-expanded='false']").on("click", function(e){
                e.preventDefault();
                $(this).parent().find("ul").removeClass("collapse");
            });

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                $(".overlay").hide();

                setTimeout(function(){ $(".sidenav").hide(); $(".navbar-toggler").show(); }, 400);

                $.each($("a[aria-expanded='false']"), function(i, v){
                    $(this).parent().find("ul").addClass("collapse");
                });
            }
        </script>
    </body>
</html>
