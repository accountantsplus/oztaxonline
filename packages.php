<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="favicon.png" type="image/png">
        <title>Police Tax</title>

        <!-- Icon css link -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">
    
        <link href="css/animate.css" rel="stylesheet">
        <!-- Main css -->
        <link rel="stylesheet" href="css/css/style.css">

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


        <link rel="stylesheet" type="text/css" href="files/switchery.min_2.1.css" media="screen, print" />
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <link href="css/responsive.css" rel="stylesheet">
        <!-- <link href="css/test.css" rel="stylesheet"> -->

        <style>
        body{
            background: white;min-height: 100%;
        }

        input{
            font-family: inherit;
            font-size: 16px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            box-sizing: border-box !important;
            padding: 0 10px !important;
            /* font-family: 'Roboto Slab' !important; */
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1600px;
            }
        }

        .overlay {
            background-color:#EFEFEF;
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 1000;
            top: 0px;
            left: 0px;
            opacity: .5; /* in FireFox */
            filter: alpha(opacity=50); /* in IE */
        }

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

        .container-test{
            margin-top: 145px !important;
        }

        .main_menu_area{
            top: -137px;
            z-index: 500;
        }

        small{
            text-align: center;
        }

        input, textarea, select {
            -webkit-transition: all 0.30s ease-in-out;
            -moz-transition: all 0.30s ease-in-out;
            -ms-transition: all 0.30s ease-in-out;
            -o-transition: all 0.30s ease-in-out;
            outline: none;
            padding: 3px 0px 3px 3px;
            margin: 5px 1px 3px 0px;
            border: 1px solid #DDDDDD;
        }
        
        input:focus, textarea:focus, select:focus {
            box-shadow: 0 0 5px rgba(81, 203, 238, 1);
            padding: 3px 0px 3px 3px;
            margin: 5px 1px 3px 0px;
            border: 1px solid rgba(81, 203, 238, 1);
        }

        @media (max-width: 991px){
            .banner-section {
                margin-left: 0px !important;
                /* background: #fff; */
            }
        }

        select{
            width: 100%;
            display: block;
            border: 1px solid #ebebeb;
            height: 50px;
            font-size: 16px;
            box-sizing: border-box;
            padding: 0 20px;
            color: #222;
            box-sizing: border-box !important;
            padding: 0 10px !important;
            /* font-weight: bold; */
            /* font-family: 'Roboto Slab'; */
        }

        .form-row{
            margin-left: 2px;
        }

        .modal-header, h4, .close {
            background-color: #4966B1;
            color:white !important;
            text-align: center;
            font-size: 30px;
        }

        .modal-footer {
            background-color: #f9f9f9;
        }

        .modal-dialog{
            margin-top: 13%;
        }
        .content-val{
            min-height: calc(100vh - 85px) !important;
        }
        </style>
    </head>
    <body>
        <input type="hidden" id="select-termscondition" value="" />
        <input type="hidden" id="tax-info" value="" />
        <input type='hidden' id='valueAdded' value='0' />
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
                        <li class="active"><a href="packages-menu">Basic Packages</a></li>
                        <li><a href="compare-us">Compare Us</a></li>
                        <li>
                            <a href="other-tax-solutions-menu">Other Tax Solutions</a>
                        </li>
                        <li>
                            <a href="#assistanceMenu" aria-expanded="false">Assistance <i class="fa fa-chevron-circle-down logo-side-menu" aria-hidden="true"></i></a>
                            <ul class="collapse list-unstyled" id="assistanceMenu">
                                <li><a href="download-centre">Downloads</a></li>
                    
                                <li><a href="about-us-online">About Us</a></li>
                                <li><a href="frequently-asked-questions">FAQ</a></li>
                                <!--<li><a href="#">Help Levels</a></li>
                                <li><a href="#">Free Tax Assists</a></li>
                                <li><a href="#">CPA Contact</a></li>-->
                            </ul>
                        </li>
                    </ul>
                </div>
                

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 30%;">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="https://www.policetax.com.au" class="hvr">Home</a></li>
                        <li class="nav-item active"><a href="packages-menu" class="hvr">Basic Packages</a></li>
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
        <!--================Slider Area =================-->
        <section class="banner-section" style="margin-top: -160px; margin-left: -380px;">
            <div class="container">
                <div class="title_center">
                    <h1><p style="font-size: 35px;color:#0000FF !important;"></p></h1>
                    <p style="margin-top: -20px;color:red !important;">Follow the six easy steps</p>
                </div>
            </div>
        </section>
        <section class="slider_area form-data">
            <div class="container container-test">
                
                <form method="POST" id="signup-form" class="signup-form" action="#">
                    <div>
                        <h3>Basic Details</h3>
                        <fieldset>
                            <h2>Basic Details</h2>
                            <p class="desc"> </p>
                            <div class="fieldset-content">
                                <div class="form-row">
                                    <label class="form-label">Info</label>
                                    <div class="form-group col-sm-6">
                                        <select name="here-before" id="HereBefore">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        <span class="text-input">Been with us before?<span style="color:red">*</span> </span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <select id="tax-Year" name="Tax Year">
                                        </select>
                                        <span class="text-input">Tax Year</span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label">Name <span style="color:red">*</span></label>
                                    <div class="form-group col-sm-4">
                                        <input type="text" name="first-name" id="first-name" required/>
                                        <span class="text-input">First</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="text" name="middle-name" id="middle-name"/>
                                        <span class="text-input">Middle</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="text" name="sur-name" id="sur-name" required/>
                                        <span class="text-input">Last</span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label">Contact Detail <span style="color:red">*</span></label>
                                    <div class="form-group col-sm-6">
                                        <input type="email" name="email" id="email" required/>
                                        <span for="email" class="text-input">Email</span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input type="number" name="mobile-telephone" id="mobile-telephone" required/>
                                        <span for="mobile-telephone" class="text-input">Phone</span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label for="birth_date" class="form-label">Birth Date <span style="color:red">*</span></label>
                                    <div class="form-group col-sm-4 user-birthdate">
                                        <select id="birth_date" name="birth_date" required></select>
                                        <span class="text-input">DD</span>
                                    </div>
                                    <div class="form-group col-sm-4 user-birthdate">
                                        <select id="birth_month" name="birth_month" required></select>
                                        <span class="text-input">MM</span>
                                    </div>
                                    <div class="form-group col-sm-4 user-birthdate">
                                        <select id="birth_year" name="birth_year" required></select>
                                        <span class="text-input">YYYY</span>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <label class="form-label">Contact Method <span style="color:red">*</span></label>
                                    <div class="form-group col-sm-4">
                                        <select name="ContactBy" id="contactBy" class="required">
                                            <option value="">Select</option>
                                            <option value="Mobile">Mobile</option>
                                            <option value="SMS">SMS</option>
                                            <option value="Email">Email</option>
                                            <option value="Skype">Skype</option>
                                        </select>
                                        <span class="text-input">Contact By</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <select name="BestTime" id="bestTime" required>
                                            <option value="">Select</option>
                                            <option value="Morning">Morning</option>
                                            <option value="AfterNoon">Afternoon</option>
                                            <option value="AfterHours">After Hours</option>
                                        </select>
                                        <span class="text-input">Best Time </span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
    
                        <h3>Tax Questions</h3>
                        <fieldset>
                            <h2>Tax Questions</h2>
                            <p class="desc"> </p>
                            <div class="fieldset-content">
                                <div class="form-row">
                                    <label class="form-label">Required Tax Questions</label>
                                    <div class="form-group col-sm-6">
                                        <label>Q. Private Health Insurance? </label><a href="#" data-toggle="tooltip" data-placement="right" title="If you have entered yes to Private Health Insurance, we will enter the required information supplied to us by the ATO." class="tooltip-label" style="margin-left: 5px;"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <div class="tax-question-checkbox pull-right"><input type="checkbox" name="Q1PHI" id="Q1PHI" class="js-switch" /></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Q. Hecs Debt? </label><a href="#" data-toggle="tooltip" data-placement="right" title="If you have entered yes to HECS Debt, we will retrieve your exact HECS Debt from the ATO and will calculate your repayment accordingly." class="tooltip-label" style="margin-left: 5px;"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <div class="tax-question-checkbox pull-right"><input type="checkbox" name="Q2HECS" id="Q2HECS" class="js-switch" /></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Q. Have a Spouse?
                                        </label>
                                        <div class="tax-question-checkbox pull-right"><input type="checkbox" name="HaveSpouse" id="HaveSpouse" class="js-switch" /></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Q. Late Overdue Tax? </label>
                                        <div class="tax-question-checkbox pull-right"><input type="checkbox" name="q5LateTax" id="q5LateTax" class="js-switch" /></div>
                                    </div>
                                    <div id="no-of-late-years" class="form-group col-sm-6" style="display:none;">
                                        <select name="Yearslate" id="Yearslate">
                                            <option value="select" selected>Select</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="10+">More than 10 years</option>
                                        </select>
                                        <span class="text-input">Number of Late Years</span>
                                    </div>
                                </div><br/>
                                <div class="form-row">
                                    <label class="form-label">Other Income Questions</label>
                                    <div class="form-group col-sm-6">
                                        <label>Q. Received any Retirement Income Stream? </label>
                                        <div class="tax-question-checkbox pull-right"><input type="checkbox" name="IncomeStream" id="IncomeStream" class="js-switch" /></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Q. Rental Property? </label>
                                        <div class="tax-question-checkbox pull-right"><input type="checkbox" name="Q3Rental" id="Q3Rental" class="js-switch" /></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Q. Any Capital Gain Events? </label>
                                        <div class="tax-question-checkbox pull-right"><input type="checkbox" name="Q4CapGains" id="Q4CapGains" class="js-switch" /></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Q. Received Govt Payments? </label>
                                        <div class="tax-question-checkbox pull-right"><input type="checkbox" name="Q7GovtPayments" id="Q7GovtPayments" class="js-switch" /></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Q. Has tax been subtracted from bank or dividends? </label>
                                        <div class="tax-question-checkbox pull-right"><input type="checkbox" name="TaxDeduction" id="Q10TaxDeduction" class="js-switch" /></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Q. Received Lump sum income? </label>
                                        <div class="tax-question-checkbox pull-right"><input type="checkbox" name="Q8LumpSumIncome" id="Q8LumpSumIncome" class="js-switch" /></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Q. Own any shares? </label>
                                        <div class="tax-question-checkbox pull-right"><input type="checkbox" name="OwnShare" id="OwnShare" class="js-switch" /></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Q. Any managed funds? </label>
                                        <div class="tax-question-checkbox pull-right"><input type="checkbox" name="ManagedFunds" id="ManagedFunds" class="js-switch" /></div>
                                    </div>
                                </div><br/>
                                <div class="form-row">
                                    <label class="form-label">My Other Tax Information</label>
                                    <div class="form-group col-sm-4">
                                        <input type="password" id="my-tfn" name="my-tfn" required>
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password pull-right"></span>
                                        <span class="text-input">TFN Number <span style="color:red">*</span></span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="password" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="my-bsb" name="my-bsb" required><span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-bsb pull-right"></span>
                                        <span class="text-input">BSB Number <span style="color:red">*</span></span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                            <input type="password" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" required id="bank-account" name="bank-account"><span toggle="#password-field" class="fa fa-fw fa-eye pull-right field-icon toggle-bankaccount"></span>
                                        <span class="text-input">Bank Account Number <span style="color:red">*</span></span>
                                    </div>
                                </div>
                        </fieldset>
    
                        <h3>Income</h3>
                        <fieldset>
                            <h2>Income</h2>
                            <p class="desc"> </p>
                            <div class="fieldset-content">
                                <div class="form-row">
                                    <label class="form-label">Wages & Salaries &nbsp; &nbsp;
                                        <span>
                                            <button id="add-employers" class="" style="cursor: pointer;width: 157px;font-size: 12px;" >
                                                <i class="fa fa-plus" style="color: #5892fc;font-size: 13px;"></i> Add More Employers
                                            </button>
                                        </span>
                                    </label>
                                    <div class="form-group col-sm-4">
                                        <select name="Employer1" id="Employer1" required>
                                            <option value="">Select Employer</option>
                                            <option value="VicPolice">Victoria Police Appropriation</option>
                                            <option value="NSWPolice">NSW Police Force</option>
                                            <option value="QldPolice">Queensland Police Service</option>
                                            <option value="NTPolice">NT Police Force</option>
                                            <option value="WAPolice">WA Police Service</option>
                                            <option value="SAPolice">SA Police Force</option>
                                            <option value="TASPolice">Tasmania Police Force</option>
                                            <option value="ACTPolice">ACT Police Force</option>
                                            <option value="FedPolice">Australian Federal Police Force</option>
                                            <option value="BorderPolice">Australian Border Force</option>
                                        </select>
                                        <span class="text-input">Employer <span style="color:red">*</span></span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" id="salary1" name="salary1" class="addNumbers" value="0" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" required>
                                        <span for="salary1">Salary <span style="color:red">*</span></span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" class="addNumbers" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="allow1" name="allow1" value="0">
                                        <span for="allow1">Allowance</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" required onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="addNumbers" id="payg-tax" name="payg-tax" value="0" required>
                                        <span for="payg-tax">PAYG Tax Withheld <span style="color:red">*</span></span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" class="addNumbers" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="resc-super" name="resc-super" value="0">
                                        <span for="resc-super">RESC Super</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" class="addNumbers" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="rfbt1" name="rfbt1" value="0">
                                        <span for="rfbt1">RFBT</span>
                                    </div>
                                </div><br/>
                                <div class="form-row">
                                    <label class="form-label">Bank Interest</label>
                                    <div class="form-group col-sm-4">
                                        <input type="number" class="addNumbers" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="bank_interest" name="bank_interest" value="0">
                                        <span for="bank_interest">Bank Interest</span>
                                    </div>
                                    <div class="form-group col-sm-4 tfn-div" style="display:none;">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="addTotalTFN" id="bank_tfn" name="bank_tfn" value="0">
                                        <span for="bank_tfn">Bank TFN</span>
                                    </div>
                                    <!-- <div class="form-group col-sm-4">
                                        <input type="number" class="addNumbers" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="tfnTaxDeduction" name="tfnTaxDeduction" value="0">
                                        <span for="tfnTaxDeduction">Bank TFN Tax Deduction</span>
                                    </div> --><br/>
                                </div>
                                <div class="form-row shares-div" style="display:none;">
                                    <label class="form-label">ASX Shares</label>
                                    <div class="form-group col-sm-4">
                                        <input type="number" class="addNumbers" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="unfranked" name="unfranked" value="0">
                                        <span for="unfranked">Unfranked Dividend</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" class="addNumbers" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="franked" name="franked" value="0">
                                        <span for="franked">Franked Dividend</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" class="addNumbers" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="imp_credit" name="imp_credit" value="0">
                                        <span for="imp_credit">Imputation Credit</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="addTotalTFN" id="share_tfn" name="share_tfn" value="0">
                                        <span for="share_tfn">Share TFN</span>
                                    </div><br/>
                                </div>
                                <div class="form-row otherIncome-div" style="display:none;">
                                    <label class="form-label">Other Income Types</label>
                                    <div class="form-group col-sm-4">
                                        <select name="otherincometype" id="otherincometype">
                                            <option value="Lump Sum A">Lump Sum A</option>
                                            <option value="Lump Sum B">Lump Sum B</option>
                                            <option value="Supplemental Income">Supplemental Income</option>
                                            <option value="Other Income">Other Income</option>
                                        </select>
                                        <span>Other Income</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" class="addNumbers" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="otherincome" name="otherincome" value="0">
                                        <span for="otherincome">Other Income Received</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" class="addNumbers" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="otherincometax" name="otherincometax" value="0">
                                        <span for="otherincometax">Tax Deducted Other Income</span>
                                    </div>
                                </div>
                                <div class="form-row govt-div" style="display:none;">
                                    <div class="form-group col-sm-4">
                                        <select name="govtpaytype" id="govtpaytype">
                                            <option value="Newstart">Newstart</option>
                                            <option value="Youth Allowance">Youth Allowance</option>
                                            <option value="Austudy">Austudy</option>
                                            <option value="ABstudy">ABstudy</option>
                                            <option value="Partner Allowance">Partner Allowance</option>
                                            <option value="Dad & Partner Payment">Dad & Partner Payment</option>
                                            <option value="Carer Payment">Carer Payment</option>
                                            <option value="Disability Pension">Disability Pension</option>
                                            <option value="Carer's Allowance">Carer's Allowance</option>
                                        </select>
                                        <span>Govt Pay Type</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" class="addNumbers" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="govtpay" name="govtpay" value="0">
                                        <span for="govtpay">Govt Pay received</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" class="addNumbers" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="govtpaytax" name="govtpaytax" value="0">
                                        <span for="govtpaytax">Tax Deducted GovtPay</span>
                                    </div>
                                </div>
                                <input type="hidden" class="" id="answer5" name="answer5" value="0" readonly>
                                <input type="hidden" onclick="this.select();" class="    " id="totalIncome" name="totalIncome" value="0" readonly>
                            </div>
                        </fieldset>
    
                        <h3>Tax Deductions</h3>
                        <fieldset>
                            <h2>Tax Deductions</h2>
                            <p class="desc"> </p>
                            <div class="fieldset-content">
                                <div class="form-row">
                                    <span>
                                        <button id="additional-tax-deduction" class="" style="cursor: pointer;width: 157px;font-size: 12px;" >
                                            <i class="fa fa-plus" style="color: #5892fc;font-size: 13px;"></i> Add Deduction
                                        </button>
                                    </span><br/><br/>
                                </div>
                                <div class="form-row">
                                    <label class="form-label">D1-ATO Set Rate Per km (up to 5,000 kms) <i class="fa fa-car" style="font-size: 18px;"></i> <a href="#" data-toggle="tooltip" data-placement="right" title="There are two methods of calculating this expense. Cents per kilometer, (car km x $0.66 per kilometer) and Log book method. Due to the complexity of log book methods, we recommend our clients to use cents per kilometer method. However, if you still want to claim a logbook method please enquire our office." class=""><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                                    <div class="form-group col-sm-4">
                                        <select name="CarKms" id="CarKms" class="deduction-data-change calculateKm">
                                            <option value="0">0</option>
                                            <option value="250">250</option>
                                            <option value="500">500</option>
                                            <option value="750">750</option>
                                            <option value="1000">1000</option>
                                            <option value="1250">1250</option>
                                            <option value="1500">1500</option>
                                            <option value="1750">1750</option>
                                            <option value="2000">2000</option>
                                            <option value="2250">2250</option>
                                            <option value="2500">2500</option>
                                            <option value="2750">2750</option>
                                            <option value="3000">3000</option>
                                            <option value="3250">3250</option>
                                            <option value="3500">3500</option>
                                            <option value="3750">3750</option>
                                            <option value="4000">4000</option>
                                            <option value="4250">4250</option>
                                            <option value="4500">4500</option>
                                            <option value="4750">4750</option>
                                            <option value="5000">5000</option>
                                        </select>
                                        <span>Total Work Kms</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="" id="KmRate" oninput="javascript:calculateKm()" name="KmRate" value="0.72" readonly>
                                        <span for="KmRate">ATO Set Rate/km</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data-val" id="TotalCarKms" name="TotalCarKms" value="0" readonly>
                                        <span for="TotalCarKms">Total Car Kms</span>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <span class="span-checkbox" for="agreed-on">Agreed that I have records that show how I worked out my work kilometres</span>
                                        <input required name="agreed-on" id="agreedOn" type="checkbox" value="Agreed that I have records that show how I worked out my work car kilometres" style="display:inline;width: 22px;margin-top: -12px;position: absolute;margin-left: 14px; ">
                                    </div>
                                </div><br/>
                                <div class="form-row">
                                    <label class="form-label">D2 Work-related travel expenses <i class="fa fa-briefcase" style="font-size: 18px;"></i></label>
                                    <div class="form-group col-sm-4">
                                        <input type="number" oninput="addD2Travel()" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="accomodation_meals" name="accomodation_meals" value="0">
                                        <span for="accomodation_meals">D2.1 Accomodation Meals</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" oninput="addD2Travel()" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="carparking" name="carparking" value="0">
                                        <span for="carparking">D2.2 Carparking</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" oninput="addD2Travel()" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="road_tolls" name="road_tolls" value="0">
                                        <span for="road_tolls">D2.3 Road Tolls</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" oninput="addD2Travel()" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="academy_costs" name="academy_costs" value="0">
                                        <span for="academy_costs">D2.4 Academy Costs</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" oninput="addD2Travel()" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="air_fares" name="air_fares" value="0" >
                                        <span for="air_fares">D2.5 Air Fares</span>
                                    </div>
                                    <input type="hidden" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="    " id="answer10" name="D2WorkRelatedTravelExpense" value="0" readonly>
                                </div><br/>
                                <div class="form-row">
                                    <label class="form-label">D3 Work-related clothing, laundry <i class="fa fa-male" style="font-size: 18px;"></i></label>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="value25" name="value25" value="150" readonly>
                                        <span for="value25">D3.1 Home Laundry</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="dry_cleaning" name="dry_cleaning" value="0">
                                        <span for="dry_cleaning">D3.2 Drycleaning</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="hats_gloves_thermals" name="hats_gloves_thermals" value="0">
                                        <span for="hats_gloves_thermals">D3.3 Hats/Gloves Thermals</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="pants_shirts" name="pants_shirts" value="0">
                                        <span for="pants_shirts">D3.4 Pants/Shirts</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="repairs" name="repairs" value="0">
                                        <span for="repairs">D3.5 Repairs</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="bootsSocks" name="bootsSocks" value="0">
                                        <span for="bootsSocks">D3.6 Boots/Socks</span>
                                    </div>
                                </div><br/>
                                <div class="form-row">
                                    <label class="form-label">D4 Work-related self-education costs <i class="fa fa-graduation-cap" style="font-size: 18px;"></i></label>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="course_fees" name="course_fees" value="0">
                                        <span for="course_fees">D4.1 Course Fees</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="books_references" name="books_references" value="0">
                                        <span for="books_references">D4.2 Books/References</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="depreciation" name="depreciation" value="0">
                                        <span for="depreciation">D4.3 Depreciation</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="kms_travel" name="kms_travel" value="0">
                                        <span for="kms_travel">D4.4 Kms Travel</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="other" name="other" value="0">
                                        <span for="other">D4.5 Other</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="Stationary" name="Stationary" value="0">
                                        <span for="Stationary">D4.6 Stationary</span>
                                    </div>
                                </div><br/>
                                <div class="form-row">
                                    <label class="form-label">D5 Other work-related expenses <i class="fa fa-building" style="font-size: 18px;"></i></label>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="union_assoc_fees" name="union_assoc_fees" value="0">
                                        <span for="union_assoc_fees">D5.1 Union/Assoc Fees</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="homeOffice" name="homeOffice" value="0">
                                        <span for="homeOffice">D5.2 Home Office <a href="#" data-toggle="tooltip" style="" data-placement="right" title="Generally, you can claim $0.45 per hour or you can claim reasonable amount of Low (around $150-$200), Medium ($250-$350), High ($350-$500) depending upon the usage." class="tooltip-label"><i class="fa fa-question-circle" aria-hidden="true"></i></a></span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="technology" name="technology" value="0">
                                        <span for="technology">D5.3 Technology</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="tactical_gear" name="tactical_gear" value="0">
                                        <span for="tactical_gear">D5.4 Tactical Gear</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="gun_training" name="gun_training" value="0">
                                        <span for="gun_training">D5.5 Gun Training</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="police_jnls" name="police_jnls" value="0">
                                        <span for="police_jnls">D5.6 Police Jnls</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="other_miscell" name="other_miscell" value="0">
                                        <span for="other_miscell">D5.7 Other/Miscell</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="overtimeCourt_meals" name="overtimeCourt_meals" value="0">
                                        <span for="overtimeCourt_meals">D5.8 overtime/Court Meals</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="protection_first_aid" name="protection_first_aid" value="0">
                                        <span for="protection_first_aid">D5.9 Protection/First Aid</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="fitness_peak_level" name="fitness_peak_level" value="0">
                                        <span for="fitness_peak_level">D5.10 Fitness Peak Level</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="sunscreen" name="sunscreen" value="0">
                                        <span for="sunscreen">D5.11 Sunscreen</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data" id="handSanitiser" name="handSanitiser" value="0">
                                        <span for="handSanitiser">D5.12 Hand Sanitiser</span>
                                    </div>
                                </div><br/>
                                <input type="hidden" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="    " id="answer11" name="D3UniformTotal" value="0" readonly>
                                <input type="hidden" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="    " id="answer12" name="D4SelfEducTotal" value="0" readonly>
                                <input type="hidden" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="    " id="d1tod4" name="D1_D4PageTotal" onblur="javascript:addingD4PageTotal()" value="0" readonly>
                                <input type="hidden" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="    " id="answer13" name="D5Other_MainTotal" value="0" readonly>
                                <input type="hidden" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="    " id="answer14" name="D5Other_OtherMainTotal" value="0" readonly>
                            </div>
                        </fieldset>
    
                        <h3>More Tax Deductions</h3>
                        <fieldset>
                            <h2>More Tax Deductions</h2>
                            <p class="desc"> </p>
                            <div class="fieldset-content">
                                <div class="form-row">
                                    <span>
                                        <button id="more-additional-tax-deduction" class="" style="cursor: pointer;width: 157px;font-size: 12px;" >
                                            <i class="fa fa-plus" style="color: #5892fc;font-size: 13px;"></i> More Deduction
                                        </button>
                                    </span><br/><br/>
                                </div>
                                <div class="form-row">
                                    <span>
                                        <button id="rental-tax-deduction" class="" style="cursor: pointer;width: 157px;font-size: 12px;" >
                                            <i class="fa fa-plus" style="color: #5892fc;font-size: 13px;"></i> Rental Plus
                                        </button>
                                    </span><br/><br/>
                                </div>
                                <div class="form-row">
                                    <span>
                                        <button id="soleTrader-tax-deduction" class="" style="cursor: pointer;width: 157px;font-size: 12px;" >
                                            <i class="fa fa-plus" style="color: #5892fc;font-size: 13px;"></i> Sole Trader
                                        </button>
                                    </span><br/><br/>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-12" style="margin-left: -21px;">
                                        <div class="col-sm-6">
                                            <label class="form-label">D5.11 Mobile Used for Work Purposes <i class="fa fa-mobile" style="font-size: 18px;"></i> <a href="#" data-toggle="tooltip" data-placement="right" title="To calculate the mobile expense, multiply your mobile cost by the business usage percentage. However, you should be aware that you are not able to claim private usage and you should always keep record." class=""><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                                            <div id="mobileWorkPurpose" class="tax-question-checkbox pull-right" style="margin-top: -38px;"><input type="checkbox" name="mobile-used" id="mobile-used" class="js-switch" /></div>
                                        </div>
                                    </div><br/>
                                    <div class="mobile-val" style="display:none;">
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data-change MultiplyMobile" id="mobile_monthly_plan_cost" name="mobile_monthly_plan_cost" value="0">
                                            <span for="mobile_monthly_plan_cost">Mobile Monthly Plan Cost</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" class="MultiplyMobile" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" id="MobilebyTwelve" name="MobilebyTwelve" value="12" readonly>
                                            <span for="MobilebyTwelve">x 12 Months</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <select id="MobileUse" name="MobileUsage" class="MultiplyMobile">
                                                <option>.10</option>
                                                <option>.15</option>
                                                <option>.20</option>
                                                <option>.25</option>
                                                <option>.30</option>
                                                <option>.40</option>
                                                <option>.45</option>
                                                <option>.50</option>
                                                <option>.55</option>
                                                <option>.60</option>
                                                <option>.65</option>
                                                <option>.70</option>
                                                <option>.75</option>
                                                <option>.80</option>
                                            </select>
                                            <span>Mobile Usage %</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data-val" id="result100" name="mobileclaimed-forwork" value="0" readonly>
                                            <span for="mobileclaimed-forwork">Mobile Claimed For Work</span>
                                        </div>
                                    </div>
                                </div><br/>
                                <div class="form-row">
                                    <div class="col-sm-12" style="margin-left: -21px;">
                                        <div class="col-sm-6">
                                            <label class="form-label">D5.12 Internet Used for Work Purposes <i class="fa fa-laptop" style="font-size: 18px;"></i> <a href="#" data-toggle="tooltip" data-placement="right" title="To calculate the home internet expense, multiply the cost of your home internet plan by your business usage percentage. However, you should be aware that you are not able to claim private usage and you should always keep record." class=""><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                                            <div id="internetWorkPurpose" class="tax-question-checkbox pull-right" style="margin-top: -38px;"><input type="checkbox" name="internet-used" id="internet-used" class="js-switch" /></div>
                                        </div>
                                    </div><br/>
                                    <div class="internet-val" style="display:none;">
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data-change MultiplyInternet" id="internet_monthly_plan_cost" name="internet_monthly_plan_cost" value="0">
                                            <span for="internet_monthly_plan_cost">Internet Monthly Plan Cost</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="MultiplyInternet" id="InternetbyTwelve" name="InternetbyTwelve" value="12" readonly>
                                            <span for="InternetbyTwelve">x 12 Months</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <select id="InternetUse" class="MultiplyInternet" name="InternetUsage" >
                                                <option>.10</option>
                                                <option>.15</option>
                                                <option>.20</option>
                                                <option>.25</option>
                                                <option>.30</option>
                                                <option>.40</option>
                                                <option>.45</option>
                                                <option>.50</option>
                                                <option>.55</option>
                                                <option>.60</option>
                                                <option>.65</option>
                                                <option>.70</option>
                                                <option>.75</option>
                                                <option>.80</option>
                                            </select>
                                            <span>Internet Usage %</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data-val" id="result101" name="TotalInternetClaimedWork" value="0" readonly>
                                            <span for="result101">Internet Claimed For Work</span>
                                        </div>
                                    </div>
                                </div><br/>
                                <div class="form-row">
                                    <label class="form-label">D5.13 Capital Expense <i class="fa fa-bolt" style="font-size: 18px;"></i></label>
                                    <div class="form-group col-sm-4">
                                        <select id="CapitalItem" class="depriciableItemChange" name="CapitalItem">
                                            <option>Computers/laptops</option>
                                            <option>Desks / Chairs and Cabinets</option>
                                            <option>Cameras >$300</option>
                                            <option>Mobile Phones >$300</option>
                                        </select>
                                        <span>Greater than $300</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data-change MultiplyCapital" id="purchase_price_amount" name="purchase_price_amount" value="0">
                                        <span for="purchase_price_amount">Purchase Price Amount</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <select id="CapitalProRataDate" name="CapitalProRataDate" class="MultiplyCapital">
                                            <option value="1">1</option>
                                            <option value="0.083">1/12</option>
                                            <option value="0.166">2/12</option>
                                            <option value="0.25">3/12</option>
                                            <option value="0.333">4/12</option>
                                            <option value="0.416">5/12</option>
                                            <option value="0.5">6/12</option>
                                            <option value="0.583">7/12</option>
                                            <option value="0.666">8/12</option>
                                            <option value="0.75">9/12</option>
                                            <option value="0.833">10/12</option>
                                            <option value="0.916">11/12</option>
                                            <option value="1">12/12</option>
                                        </select>
                                        <span>Pro rata Part Year</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <select disabled id="CapitalRate" name="CapitalRate" class="MultiplyCapital">
                                            <option value="25%">25%</option>
                                            <option value="50%">50%</option>
                                            <option value="5%">5%</option>
                                            <option value="20%">20%</option>
                                            <option value="33.33%">33.33%</option>
                                        </select>
                                        <span>Deprec Rate % Applied</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data-val" id="result105" name="subtotal-d5.13deductions" value="0" oninput="javascript:MultiplyCapital()" readonly>
                                        <span for="result105">Sub Total D5.13 Deductions</span>
                                    </div>
                                </div><br/>
                                <div class="form-row">
                                    <label class="form-label">Non Work Deductions <i class="fa fa-cogs" style="font-size: 18px;"></i></label>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data addNonWorkDeduct" id="donations_charity" name="donations_charity" value="0">
                                        <span for="donations_charity">D9 Donations/Charity</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data addNonWorkDeduct" id="tax_agent_fee" name="tax_agent_fee" value="0">
                                        <span for="tax_agent_fee">D10 Tax Agent Fee</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data addNonWorkDeduct" id="other_supplemental_costs" name="other_supplemental_costs" value="0">
                                        <span for="other_supplemental_costs">D15 Other Supplemented Costs</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="deduction-data addNonWorkDeduct" id="income_protection" name="income_protection" value="0" >
                                        <span for="income_protection">D15 Income Protection</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="" id="d5_d15_page_total" name="d5_d15_page_total" value="0" onblur="javascript:addAllDeduction()" readonly>
                                        <span for="d5_d15_page_total">Sub Total D9/D10/D15 Deductions</span>
                                    </div>
                                </div><br/>
                            </div>
                            <input type="hidden" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="    " id="allDeductions" name="allDeductions" value="0" readonly>
                        </fieldset>
    
                        <h3>Submit Tax</h3>
                        <fieldset>
                            <h2>Submit Tax</h2>
                            <p class="desc"> </p>
                            <div class="fieldset-content">
                                <div class="form-row">
                                    <div class="form-group col-sm-12" style="margin-left: -16px;">
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Total Taxable Income: </label>
                                            <div id="taxable_income" class="tax-question-checkbox pull-right" style="margin-top: -35px;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label class="form-label">Upload any relevant documents <i class="fa fa-cloud-upload" style="font-size: 18px;"></i></label>
                                        <span class="btn btn-default btn-file" style="width: 75%;"><input type="file" name="fileToUpload" id="fileToUpload" multiple>
                                        <!-- <span class="text-input">Example  :<span>  Jeff@gmail.com</span></span> -->
                                        <div id="upload_prev" style="height: 60px;overflow-y:scroll;margin-top: 8px;"></div>
                                    </div>
                                </div>

                                <div class="form-row">
                                        <label class="form-label">Note to accountant <i class="fa fa-pencil-square-o" style="font-size: 18px;"></i> </label>
                                        <div class="form-group col-sm-9">
                                            <textarea style="border-top:1px solid #dadada; text-align:left; color:#929292; width: 100%;display:inline;margin-top: 8px;" rows="5" name="taxDedcutionExpenseSubstantiation" class="flexTable-value flexTable-value--omega" value="" placeholder=" Type Here">
                                                   
                                            </textarea>
                                        </div>
                                    </div><br/>
                                
                                <div class="form-row">
                                    <div class="col-sm-12" style="margin-left: -16px;">
                                        <div class="col-sm-6">
                                            <label class="form-label span-checkbox">Tax Deduction Expense Substantiation </label>
                                            <div class="tax-question-checkbox pull-right" style="margin-top: -35px;"><input required name="taxDeductionExpenseSubsantian" id="tax-deduction-express" type="checkbox" type="checkbox" value="Agreed that I have records that show how I worked out my work car kilometres" style="display:inline;width: 22px;margin-top: -12px;position: absolute;margin-left: 14px; "></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-9">
                                        <textarea style="border-top:1px solid #dadada; text-align:left; color:#929292; width: 100%;display:inline;margin-top: 8px;" rows="5" name="taxDedcutionExpenseSubstantiation" class="flexTable-value flexTable-value--omega" value="" placeholder="" readonly>I agreed as follows: That I have kept all the necessary records to support all the claimsthat I have made in this tax return. The deductions that I have claimed are all work related claims and are to do with the performing the job role of my occupation. If requested by the ATO I will be able to make available all the necessary evidence such as:
                                            1. Invoices and/or receipts
                                            2. Group certificates from my employer
                                            3. Diary Evidence & calculations
                                            4. Allowances Received proof
                                            5. ATO Rulings /Guidelines e.g. for home laundry
                                            6. Actual recorded cost
                                            7. Log book for car if kms exceed 5,000 kms 
                                            8. Other evidence & calculations as required 
                                            
                                            I understand that I need to keep such records for 5 years.
                                        </textarea>
                                    </div>
                                </div><br/>
                                
                                <div class="form-row">
                                    <div class="col-sm-12" style="margin-left: -16px;">
                                        <div class="col-sm-6">
                                            <label class="form-label span-checkbox">Terms & Conditions </label>
                                            <div class="tax-question-checkbox pull-right" style="margin-top: -35px;"><input required name="checkTerms" id="terms-condition" type="checkbox" type="checkbox" value="Agreed that I have records that show how I worked out my work car kilometres" style="display:inline;width: 22px;margin-top: -12px;position: absolute;margin-left: 14px; "></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-9">
                                            <textarea style="border-top: 1px solid #dadada; text-align:left; color: #929292; width: 100%;display:inline;" rows="5" name="termsandcondition" class="flexTable-value flexTable-value--omega" value="" placeholder="" readonly>
                                                Terms & Conditions agreed as follows: 
                                                PART A- This declaration is to be completed where a taxpayer elects to use the Electronic Lodgement Service. It is the responsibility of the taxpayer to retain this declaration for a period of five years after the declaration is made, penalties may apply for failure to do so. PRIVACY: -ATO is authorised by the Taxation Administration Act 1953 to request your tax file number (TFN). We will use your TFN to identify you in our records. However, you cannot lodge your income tax form electronically if you do not quote your TFN. Taxation law authorises the ATO to collect information and to disclose it to other government agencies. For information about your privacy go to ato.gov.au/privacy DECLARATION: I declare that: -the information provided to my registered tax agent for the preparation of this tax return, including any applicable schedules is true and correct, and -the agent is authorised to lodge this tax return. IMPORTANT: The tax law imposes heavy penalties for giving false or misleading information. AMENDMENTS TO TAX RETURNS in the event that Police Tax (A member of the Accountants Plus Group) finds that changes need to be made to the tax return to correct information recorded by the ATO Portal that I hereby authorise them to do so. By submitting this tax return electronically, I hereby agree to all the terms & conditions and declarations made by me as being true and correct. I acknowledge that I will be liable for all fees and charges for submission of this tax return and subsequent lodgement to the ATO for assessment.</textarea>
                                    </div>
                                </div><br/>
                                
                                <div id="html_element"></div>
                            </div>
                        </fieldset>
                    </div>

                    <!--Modals-->
                    <div id="myModal" class="modal fade" role="dialog" style="display:none;">
                        <div class="modal-dialog modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header" style="padding:35px 50px;">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <h4><span class="glyphicon glyphicon-lock"></span> Car Kms</h4>
                                </div>
                                <div class="modal-body" style="padding:40px 50px;">
                                    <div class="form-row">
                                        <label class="form-label">Important Notice:</label>
                                        <div class="form-flex">
                                            <div class="form-group col-sm-12">
                                                <p style="text-align: left;
                                                                    font-weight: 500;margin:0; padding:0;">
                                                Please pay particular attention to recording your Car Kms used for Police Business. This is the single most important area of your tax information which drives the size of your potential tax refund.
                                                </p>
                                                <p class="notice" style="margin-left: 6%;">Don't forget your personal use of your car for:</p>
                                                <p class="notice" style="margin-left: 8%;">&#8226;&nbsp;Travel for Court Hearings</p>
                                                <p class="notice" style="margin-left: 8%;">&#8226;&nbsp;Visits to the Police Academy</p>
                                                <p class="notice" style="margin-left: 8%;">&#8226;&nbsp;Gun/Tactical/Other Specific Training</p>
                                                <p class="notice" style="margin-left: 8%;">&#8226;&nbsp;Secondments away from usual Station</p>
                    
                                                <p class="notice" style="margin-left: 8%;">&#8226;&nbsp;Travel for promotions or upgrades</p>
                    
                                                <p class="notice" style="margin-left: 8%;">&#8226;&nbsp;Car Kms for visiting draft country stations</p>
                                                <p class="notice" style="margin-left: 8%;">&#8226;&nbsp;Any Other Relevant Car Kms relevant to your Police work</p><br />
                                                <p class="notice">ATO Tax rulings mean you do not need written evidence to show how many kilometres you have travelled, but they may ask you to show how you worked out your business kilometres.
                                                </p><br />
                                                <p class="notice">
                                                <span style="font-weight: 300">Hint:</span> there is plenty of scope or flexibility in this tax deduction area. The rate approved by the ATO is set at 66 cents per kilometre.</p>
                                                <br />
                                                <p id="forMore">For more detailed information click below:
                                                <br>
                                                <a target="+6" style="font-weight: 700; color:blue" href="https://www.ato.gov.au/Business/Income-and-deductions-for-business/Deductions/Motor-vehicle-expenses/Claiming-motor-vehicle-expenses-as-a-sole-trader/Cents-per-kilometre-method/">ATO Set Rate Car Kms Ruling </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info btn-default pull-left agreed-btn"><span class="glyphicon glyphicon-check"></span> Agree</button>
                                </div>
                            </div>
                        
                        </div>

                    </div>

                    <div class="modal fade" id="myModalFirstTimeVisitor" role="dialog" style="display:none;">
                        <div class="modal-dialog modal-lg">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header" style="padding:35px 50px;">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <h4><span class="glyphicon glyphicon-lock"></span> Personal Information</h4>
                                </div>
                                <div class="modal-body" style="padding:40px 50px;">
                                    <div class="form-row">
                                        <label class="form-label">Job Details</label>
                                        <div class="form-flex occupation-police">
                                            <div class="form-group">
                                                <select name="Occupation Role" id="OccupationRole" required>
                                                    <option value="">Select</option>
                                                    <option value="PoliceOfficer">Police Officer</option>
                                                    <option value="PSO">PSO</option>
                                                    <option value="Custody">Custody Officer</option>
                                                    <option value="Federal">Federal Police</option>
                                                    <option value="BorderForce">Border Force Officer</option>
                                                </select>
                                                <span class="text-input">Occupation Role <span style="color:red">*</span></span>
                                            </div>
                                            <div class="form-group">
                                                    <select name="rank" id="Rank" required>
                                                        <option value="">Select</option>
                                                        <option value="Constable">Constable</option>
                                                        <option value="1stConstable">1st Constable</option>
                                                        <option value="SnrConstable">Snr Constable</option>
                                                        <option value="Sergerant">Sergerant</option>
                                                        <option value="SnrSergerant">Snr Sergerant</option>
                                                        <option value="Higher">Higher Rank</option>
                                                        <option value="Higher">Other Rank</option>
                                                    </select>
                                                <span class="text-input">Rank <span style="color:red">*</span></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="station-locale" id="station_locale" required/>
                                                <span class="text-input">Station Locale <span style="color:red">*</span></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="years-in-job" id="years-in-job" required />
                                                <span class="text-input">Years in Job <span style="color:red">*</span></span>
                                            </div>
                                        </div>
                                        <div class="form-flex occupation-normal" style="display:none;">
                                            <div class="form-group">
                                                <input type="text" name="OccupationRole" id="OccupationRole" required/>
                                                <span class="text-input">Occupation Role <span style="color:red">*</span></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="years-in-job" id="years-in-job" required />
                                                <span class="text-input">Years in Job <span style="color:red">*</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label class="form-label">Residential Address</label>
                                        <div class="form-flex">
                                            <div class="form-group">
                                                <input type="text" name="street-no" id="street-no" required />
                                                <span class="text-input">Street/Unit No <span style="color:red">*</span></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="street-address" id="street-address" required />
                                                <span class="text-input">Street Address <span style="color:red">*</span></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="suburb" id="suburb" required />
                                                <span class="text-input">Suburb <span style="color:red">*</span></span>
                                            </div>
                                            <div class="form-group">
                                                <select name="State" required>
                                                    <option value="">Select</option>
                                                    <option value="VIC">VIC</option>
                                                    <option value="NSW">NSW</option>
                                                    <option value="QLD">QLD</option>
                                                    <option value="NT">NT</option>
                                                    <option value="WA">WA</option>
                                                    <option value="SA">SA</option>
                                                    <option value="TAS">TAS</option>
                                                    <option value="ACT">ACT</option>
                                                </select>
                                                <span class="text-input">State <span style="color:red">*</span></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="post-code" id="post-code" required />
                                                <span class="text-input">Post Code <span style="color:red">*</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info btn-default pull-left btn-ok-visitor"><span class="glyphicon glyphicon-check"></span> Ok</button>
                                    <button class="btn btn-danger btn-default pull-left btn-cancel-visitor" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                </div>
                            </div>
                        
                        </div>
                    </div>

                    <div id="myModalSpouse" class="modal fade" role="dialog" style="display:none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header" style="padding:35px 50px;">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <h4><span class="glyphicon glyphicon-lock"></span> Spouse Information</h4>
                                </div>
                                <div class="modal-body" style="padding:40px 50px;">
                                    <label class="form-label">Spouse details are complusory if you do not have private health insurance</label>
                                    <div class="form-row">
                                        <label class="form-label">Name <span style="color:red">*</span></label>
                                        <div class="form-group col-sm-4">
                                            <input type="text" id="spouse-firstname" name="spouse-firstname" required>
                                            <span class="text-input">First</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="text" id="spouse-surname" name="spouse-surname" required>
                                            <span class="text-input">Last</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label class="form-label">Date of Birth <span style="color:red">*</span></label>
                                        <div class="form-group col-sm-4 spouse-birthdate">
                                            <select id="spousebirth_date" name="spousebirth_date" required></select>
                                            <span class="text-input">DD</span>
                                        </div>
                                        <div class="form-group col-sm-4 spouse-birthdate">
                                            <select id="spousebirth_month" name="spousebirth_month" required></select>
                                            <span class="text-input">MM</span>
                                        </div>
                                        <div class="form-group col-sm-4 spouse-birthdate">
                                            <select id="spousebirth_year" name="spousebirth_year" required></select>
                                            <span class="text-input">YYYY</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label class="form-label">More Information</label>
                                        <div class="form-group col-sm-4">
                                            <select name="spouseWantsTaxDone" id="spouseWantsTaxDone" required>
                                                <option value="">Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <span class="text-input">Want a tax done? <span style="color:red">*</span></span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <select name="no-dependants" id="no-dependants" required>
                                                <option value="" >Select</option>
                                                <option value="0">None</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5+">More than 5</option>
                                            </select>
                                            <span class="text-input">No. of dependants <span style="color:red">*</span></span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="text" id="taxableincome" name="taxableincome" required>
                                            <span class="text-input" for="taxableincome">Taxable Income <span style="color:red">*</span></span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <select name="spouseForFullYear" id="QspouseForFullYear" required>
                                                <option value="">Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <span class="text-input">Spouse for full year ? <span style="color:red">*</span></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row" id="dateSpouse" style="display:none;">
                                        <label class="form-label">Start Date <span style="color:red">*</span></label>
                                        <div class="form-group col-sm-4 spouse-fullyeardate">
                                            <select id="spouseFullYear_date" name="spouseFullYear_date" required></select>
                                            <span class="text-input">DD</span>
                                        </div>
                                        <div class="form-group col-sm-4 spouse-fullyeardate">
                                            <select id="spouseFullYear_month" name="spouseFullYear_month" required></select>
                                            <span class="text-input">MM</span>
                                        </div>
                                        <div class="form-group col-sm-4 spouse-fullyeardate">
                                            <select id="spouseFullYear_year" name="spouseFullYear_year" required></select>
                                            <span class="text-input">YYYY</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button class="btn btn-info btn-default pull-left btn-ok"><span class="glyphicon glyphicon-check"></span> Ok</button>
                                    <button class="btn btn-danger btn-default pull-left btn-cancel" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="myModalAddEmployers" class="modal fade" role="dialog" style="display:none;">
                        <div class="modal-dialog modal-lg">
                    
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header" style="padding:35px 50px;">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <h4><span class="glyphicon glyphicon-lock"></span> Add Employers</h4>
                                </div>
                                <div class="modal-body" style="padding:40px 50px;">
                                    <div>
                                        <button class="add-emp" style="cursor: pointer;width: 65px;font-size: 13px;" >
                                            <i class="fa fa-plus" style="color: #5892fc;font-size: 13px;"></i> Add
                                        </button>
                                    </div>
                                    <div class="form-row">
                                        <table id="emplyer-tbl" style="width:100%;">
                                            <tr>
                                                <th style="width:15%;">Employer</th>
                                                <th style="width:15%;">Salary</th>
                                                <th style="width:15%;">Allowances</th>
                                                <th style="width:15%;">Payg Tax</th>
                                                <th style="width:13%;">RESC Super</th>
                                                <th style="width:13%;">RFBT</th>
                                                <th style="width:13%;"></th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info btn-default pull-left btn-ok-employers"><span class="glyphicon glyphicon-check"></span> Ok</button>
                                    <button class="btn btn-danger btn-default pull-left btn-cancel-employers" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                </div>
                            </div>
                        
                        </div>
                    </div>

                    <div id="myModalAdditionalDeduction" class="modal fade" role="dialog" style="display:none;">
                        <div class="modal-dialog modal-lg">
                
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header" style="padding:35px 50px;">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <h4><span class="glyphicon glyphicon-lock"></span> Additional Deductions</h4>
                                </div>
                                <div class="modal-body" style="padding:40px 50px;">
                                    <div class="form-row">
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="powerPacks" name="powerPacks" value="0"  >
                                            <span for="powerPacks">Power Packs</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="charges" name="chargers" value="0"  >
                                            <span for="charges">Chargers</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="vestWatches" name="vestWatches" value="0" >
                                            <span for="vestWatches">Vest Watches</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="medalHolders" name="medalHolders" value="0" >
                                            <span for="medalHolders">Medal Holders</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="idHolders" name="idHolders" value="0" >
                                            <span for="idHolders">Id Holders</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="woodenCoatHangers" name="woodenCoatHangers" value="0"  >
                                            <span for="woodenCoatHangers">Wooden Coat Hangers</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="firstAidKitReplenishment" name="firstAidKitReplenishment" value="0"   >
                                            <span for="firstAidKitReplenishment">First Aid Kit Replenishment</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="nameTags" name="nameTags" value="0"   >
                                            <span for="nameTags">Name Tags</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="sdCamera" name="sdCamera" value="0"   >
                                            <span for="sdCamera">SD Camera</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="dvdCd" name="dvdCd" value="0"  >
                                            <span for="dvdCd">DVD/CDs</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="usbHardDrives" name="usbHardDrives" value="0"  >
                                            <span for="usbHardDrives">USB/Hard Drives</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="cameraPens" name="cameraPens" value="0"  >
                                            <span for="cameraPens">Camera Pens</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="bodyCameras" name="bodyCameras" value="0"  >
                                            <span for="bodyCameras">Body Cameras</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="goPros" name="goPros" value="0"   >
                                            <span for="goPros">Go Pros</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="resuscitationMask" name="resuscitationMask" value="0"  >
                                            <span for="resuscitationMask">Resuscitation Mask</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="crimeMagazines" name="crimeMagazines" value="0"  >
                                            <span for="crimeMagazines">Crime Magazines</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="bootlaces" name="bootlaces" value="0"  >
                                            <span for="bootlaces">Bootlaces</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="educationProRataFoxtel" name="educationProRataFoxtel" value="0"  >
                                            <span for="educationProRataFoxtel">Education Pro Rata Foxtel</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="crimeFolders" name="crimeFolders" value="0"   >
                                            <span for="crimeFolders">Crime Folders</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="dicCompendiums" name="dicCompendiums" value="0"  >
                                            <span for="dicCompendiums">DIC Compendiums</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="evidenceMarkers" name="evidenceMarkers" value="0"  >
                                            <span for="evidenceMarkers">Evidence Markers</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="pensStationary" name="pensStationary" value="0"  >
                                            <span for="pensStationary">Pens & Stationary</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="courtMealExpenses" name="courtMealExpenses" value="0"  >
                                            <span for="courtMealExpenses">Court Meal Expenses</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="form-control deduction-data additional-deductions" id="nightShiftMealsAllowExpense" name="nightShiftMealsAllowExpense" value="0" >
                                            <span for="nightShiftMealsAllowExpense">Night Shift Meals Allow Expense</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info btn-default pull-left agreed-btn"><span class="glyphicon glyphicon-check"></span> Ok</button>
                                </div>
                            </div>
                        
                        </div>
                    </div>

                    <div id="myModalMoreAdditionalDeduction" class="modal fade" role="dialog" style="display:none;">
                        <div class="modal-dialog modal-lg">
                
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header" style="padding:35px 50px;">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <h4><span class="glyphicon glyphicon-lock"></span> More Deductions</h4>
                                </div>
                                <div class="modal-body" style="padding:40px 50px;">
                                    <div class="form-row">
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).select();" class="form-control deduction-data more-deductions" id="higherRankHomeOfficeLoading" name="higherRankHomeOfficeLoading" value="0">
                                            <span for="higherRankHomeOfficeLoading">Higher Rank Home Office Loading</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="filingCabinets" name="filingCabinets" value="0">
                                            <span for="filingCabinets">Filing Cabinets</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="officeChairs" name="officeChairs" value="0">
                                            <span for="officeChairs">Office Chairs</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="desks" name="desks" value="0">
                                            <span for="desks">Desks</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="lockableSafes" name="lockableSafes" value="0">
                                            <span for="lockableSafes">Lockable Safes</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="binoculars" name="binoculars" value="0" >
                                            <span for="binoculars">Binoculars</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="audioRecordingDevices" name="audioRecordingDevices" value="0" >
                                            <span for="audioRecordingDevices">Audio Recording Devices</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="kitBagsDuffleBags" name="kitBagsDuffleBags" value="0" >
                                            <span for="kitBagsDuffleBags">Kit Bags/Duffle Bags</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="goBagContents" name="goBagContents" value="0" >
                                            <span for="goBagContents">Go Bag Contents</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="campingEquipSleeping" name="campingEquipSleeping" value="0" >
                                            <span for="campingEquipSleeping">Camping Equip/Sleeping</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="backpacks" name="backpacks" value="0">
                                            <span for="backpacks">Backpacks</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="clipsAndCarabiners" name="clipsAndCarabiners" value="0" >
                                            <span for="clipsAndCarabiners">Clips & Carabiners</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="highPowerTorches" name="highPowerTorches" value="0" >
                                            <span for="highPowerTorches">High Power Torches</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="penLights" name="penLights" value="0" >
                                            <span for="penLights">Penlights</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="pouchesLegAndVest" name="pouchesLegAndVest" value="0" >
                                            <span for="pouchesLegAndVest">Pouches leg & Vest</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="safetyGlasses" name="safetyGlasses" value="0" >
                                            <span for="safetyGlasses">Safety Glasses</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="earPieces" name="earPieces" value="0">
                                            <span for="earPieces">Earpieces</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="handSanitiser" name="handSanitiser" value="0" >
                                            <span for="handSanitiser">Handsanitiser</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="sunScreen" name="sunScreen" value="0" >
                                            <span for="sunScreen">Sunscreen</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="waterPoliceCosts" name="waterPoliceCosts" value="0" >
                                            <span for="waterPoliceCosts">Water Police Costs</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="mountedHorseDivison" name="mountedHorseDivison" value="0" >
                                            <span for="mountedHorseDivison">Mounted Horse Divison</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="airWingCosts" name="airWingCosts" value="0" >
                                            <span for="airWingCosts">Air wing Costs</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="higherFitnessCosts" name="higherFitnessCosts" value="0" >
                                            <span for="higherFitnessCosts">Higher Fitness Costs/Tactical</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="newRecruitExamCosts" name="newRecruitExamCosts" value="0" >
                                            <span for="newRecruitExamCosts">New Recruit Exam costs</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control deduction-data more-deductions" id="newRecruitMedicalCosts" name="newRecruitMedicalCosts" value="0">
                                            <span for="newRecruitMedicalCosts">New Recruit Medical costs</span>
                                        </div>
                                        <input type="number" style="display:none;" onclick="$(this).focus(); $(this).select();$(this).get(0).setSelectionRange(0,9999);" class="form-control" id="totalMoreDeduction" name="totalMoreDeduction" value="0" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info btn-default pull-left more-agreed-btn"><span class="glyphicon glyphicon-check"></span> Ok</button>
                                </div>
                            </div>
                        
                        </div>
                    </div>

                    <div id="myModalRentalPlusDeduction" class="modal fade" role="dialog" style="display:none;">
                        <div class="modal-dialog modal-lg">
                
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header" style="padding:35px 50px;">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <h4><span class="glyphicon glyphicon-lock"></span> Rental Plus Information</h4>
                                </div>
                                <div class="modal-body" style="padding:40px 50px;">
                                    <label class="form-label">Rental Property Schedule</label>
                                    <div class="form-row">
                                        <div class="form-group col-sm-12">
                                            <input type="text" onclick="this.select();" class="" id="addressRentalProperty" name="addressRentalProperty" value="" />
                                            <span for="addressRentalProperty">Address of Rental Property</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <span class="form-label">Date property first earned rental income </span>
                                        <div class="form-group col-sm-4 spouse-birthdate">
                                            <select id="rental_date" name="rental_date" required></select>
                                            <span class="text-input">DD</span>
                                        </div>
                                        <div class="form-group col-sm-4 spouse-birthdate">
                                            <select id="rental_month" name="rental_month" required></select>
                                            <span class="text-input">MM</span>
                                        </div>
                                        <div class="form-group col-sm-4 spouse-birthdate">
                                            <select id="rental_year" name="rental_year" required></select>
                                            <span class="text-input">YYYY</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-sm-6">
                                            <input type="number" onclick="this.select();" class="" id="numberofWeeksPropertyRented" name="numberofWeeksPropertyRented" value="" />
                                            <span for="numberofWeeksPropertyRented">Number of weeks property was rented this year</span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <input type="number" onclick="this.select();" class="" id="privateUsePercentage" name="privateUsePercentage" value="" />
                                            <span for="privateUsePercentage">Private Use %</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label class="form-label">Ownership </label>
                                        <div class="form-group col-sm-4">
                                            <input type="text" onclick="this.select();" class="" id="ownershipFirstName" name="ownershipFirstName" value="" />
                                            <span for="ownershipFirstName">First Name</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="text" onclick="this.select();" class="" id="ownershipFamilyName" name="ownershipFamilyName" value="" />
                                            <span for="ownershipFamilyName">Family Name</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="" id="ownershipOwnedPercent" name="ownershipOwnedPercent" value="" />
                                            <span for="ownershipOwnedPercent">% owned</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label class="form-label">Income </label>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="income-data" id="grossRentalIncome" name="grossRentalIncome" value="0" oninput="block2()">
                                            <span for="grossRentalIncome">Gross rental income</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="income-data" id="otherrentRelatedIncome" name="otherrentRelatedIncome" value="0" oninput="block2()">
                                            <span for="otherrentRelatedIncome">Other rent related income</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="" id="grossrentIncome" name="grossrentIncome" value="0" disabled oninput="block2()">
                                            <span for="grossrentIncome">Gross Rent</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label class="form-label">Expenses </label>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item26_advertisingForTenants" name="item26_advertisingForTenants" value="0" oninput="block2()">
                                            <span for="item26_advertisingForTenants">Advertising for tenants</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item27_bodyCorporateFees" name="item27_bodyCorporateFees" value="0" oninput="block2()">
                                            <span for="item27_bodyCorporateFees">Body corporate fees</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item28_borrowingExpenses" name="item28_borrowingExpenses" value="0" oninput="block2()">
                                            <span for="item28_borrowingExpenses">Borrowing expenses</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item29_cleaning" name="item29_cleaning" value="0" oninput="block2()">
                                            <span for="item29_cleaning">Cleaning</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item30_councilRates" name="item30_councilRates" value="0" oninput="block2()">
                                            <span for="item30_councilRates">Council Rates</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item31_capitalAllowances" name="item31_capitalAllowances" value="0" oninput="block2()">
                                            <span for="item31_capitalAllowances">Capital allowances (depreciation)</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item32_gardening" name="item32_gardening" value="0" oninput="block2()">
                                            <span for="item32_gardening">Gardening / lawn mowing</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item33_insurance" name="item33_insurance" value="0" oninput="block2()">
                                            <span for="item33_insurance">Insurance</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item34_interestOnloans" name="item34_interestOnloans" value="0" oninput="block2()">
                                            <span for="item34_interestOnloans">Interest on loans</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item35_LandTax" name="item35_LandTax" value="0" oninput="block2()">
                                            <span for="item35_LandTax">Land Tax</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item36_legalFees" name="item36_legalFees" value="0" oninput="block2()">
                                            <span for="item36_legalFees">Legal Fees</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item37_pestControl" name="item37_pestControl" value="0" oninput="block2()">
                                            <span for="item37_pestControl">Pest Control</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item38_propertyAgentFees" name="item38_propertyAgentFees" value="0" oninput="block2()">
                                            <span for="item38_propertyAgentFees">Property agent fees / commission</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item39_repairsAndMaintenance" name="item39_repairsAndMaintenance" value="0" oninput="block2()">
                                            <span for="item39_repairsAndMaintenance">Repairs and maintenance</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item40_capitalWorksSpecialBuild" name="item40_capitalWorksSpecialBuild" value="0" oninput="block2()">
                                            <span for="item40_capitalWorksSpecialBuild">Capital works-special build w/off</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item41_travelExpenses" name="item41_travelExpenses" value="0" oninput="block2()">
                                            <span for="item41_travelExpenses">Travel Expenses</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item42_stationaryTelephonePostage" name="item42_stationaryTelephonePostage" value="0" oninput="block2()">
                                            <span for="item42_stationaryTelephonePostage">Stationery, telephone and postage</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item43_waterCharges" name="item43_waterCharges" value="0" oninput="block2()">
                                            <span for="item43_waterCharges">Water Charges</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data" id="item44_sundryRentalExpenses" name="item44_sundryRentalExpenses" value="0" oninput="block2()">
                                            <span for="item44_sundryRentalExpenses">Sundry rental expenses</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="" id="item46_totalExpense" name="item46_totalExpense" disabled value="0" oninput="block2()">
                                            <span for="item46_totalExpense">Total Expense</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label class="form-label">Net Rent </label>
                                        <div class="form-group col-sm-6">
                                            <input type="number" onclick="this.select();" class="" id="item49_NetRent" name="item49_NetRent" value="0" disabled oninput="block2()">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info btn-default pull-left rental-agreed-btn"><span class="glyphicon glyphicon-check"></span> Ok</button>
                                </div>
                            </div>
                        
                        </div>
                    </div>

                    <div id="myModalSoleTraderDeduction" class="modal fade" role="dialog" style="display:none;">
                        <div class="modal-dialog modal-lg">
                
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header" style="padding:35px 50px;">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <h4><span class="glyphicon glyphicon-lock"></span> Sole Trader Information</h4>
                                </div>
                                <div class="modal-body" style="padding:40px 50px;">
                                    <div class="form-row">
                                        <label class="form-label">Business Worksheet </label>
                                        <div class="form-group col-sm-6">
                                            <input type="text" onclick="this.select();" class="" id="businessName" name="businessName" value="" />
                                            <span for="businessName">Business Name</span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <input type="text" onclick="this.select();" class="" id="businessActivity" name="businessActivity" value="" />
                                            <span for="businessActivity">Business Activity</span>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <input type="text" onclick="this.select();" class="" id="businessPlace" name="businessPlace" value="" />
                                            <span for="businessPlace">Place of Business</span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <span>Ceased Business during Year </span>
                                            <div class="ceasedBusinessYear-checkbox"><input type="checkbox" name="ceasedBusinessDuringYear" id="ceasedBusinessDuringYear" class="js-switch" /></div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <span>Commenced business during year </span>
                                            <div class="ceasedBusinessYear-checkbox commencedyear-chckbx"><input type="checkbox" name="commencedBusinessDuringYear" id="commencedBusinessDuringYear" class="js-switch" /></div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <select id="businessActivities" name="businessActivities">
                                                <option value="select">Select</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">more than 5</option>
                                            </select>
                                            <span>Number of Business Activities</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label class="form-label">Income </label>
                                        <div class="form-group col-sm-6">
                                            <input type="text" onclick="this.select();" class="" id="incomeDescription" name="incomeDescription" value="" />
                                            <span for="incomeDescription">Description</span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <input type="number" onclick="this.select();" class="income-data-soleTrader" id="income-sales" name="income-sales" value="" />
                                            <span for="income-sales">Sales</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label class="form-label">Expenses </label>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item26_accounting" name="item26_accounting" value="0" oninput="block2()">
                                            <span for="item26_accounting">Accounting</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item27_advertandPromotion" name="item27_advertandPromotion" value="0" oninput="block2()">
                                            <span for="item27_advertandPromotion">Advertising and Promotion</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item28_badDebtsWrittenOff" name="item28_badDebtsWrittenOff" value="0" oninput="block2()">
                                            <span for="item28_badDebtsWrittenOff">Bad debts written off</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item29_bankFeesCharges" name="item29_bankFeesCharges" value="0" oninput="block2()">
                                            <span for="item29_bankFeesCharges">Bank fees and charges</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item30_cartageAndFreight" name="item30_cartageAndFreight" value="0" oninput="block2()">
                                            <span for="item30_cartageAndFreight">Cartage and Freight</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item31_cleaningRubbishRemoval" name="item31_cleaningRubbishRemoval" value="0" oninput="block2()">
                                            <span for="item31_cleaningRubbishRemoval">Cleaning and Rubbish Removal</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item32_commission" name="item32_commission" value="0" oninput="block2()">
                                            <span for="item32_commission">Commission</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item33_contractPayments" name="item33_contractPayments" value="0" oninput="block2()">
                                            <span for="item33_contractPayments">Contract Payments</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item34_donations" name="item34_donations" value="0" oninput="block2()">
                                            <span for="item34_donations">Donations</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item35_electricity" name="item35_electricity" value="0" oninput="block2()">
                                            <span for="item35_electricity">Electricity</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item36_homeOffice" name="item36_homeOffice" value="0" oninput="block2()">
                                            <span for="item36_homeOffice">Home Office</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item37_insurancePremiums" name="item37_insurancePremiums" value="0" oninput="block2()">
                                            <span for="item37_insurancePremiums">Insurance Premiums</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item38_interestAustralian" name="item38_interestAustralian" value="0" oninput="block2()">
                                            <span for="item38_interestAustralian">Interest (Australian)</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item39_leasePayments" name="item39_leasePayments" value="0" oninput="block2()">
                                            <span for="item39_leasePayments">Lease payments</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item40_maintenance" name="item40_maintenance" value="0" oninput="block2()">
                                            <span for="item40_maintenance">Maintenance</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item41_materialsAndSupplies" name="item41_materialsAndSupplies" value="0" oninput="block2()">
                                            <span for="item41_materialsAndSupplies">Materials and supplies</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item42_motor" name="item42_motor" value="0" oninput="block2()">
                                            <span for="item42_motor">Motor (set rate)</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item43_PrintingStationery" name="item43_PrintingStationery" value="0" oninput="block2()">
                                            <span for="item43_PrintingStationery">Printing and stationery</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item44_salariesWages" name="item44_salariesWages" value="0" oninput="block2()">
                                            <span for="item44_salariesWages">Salaries, wages - ordinary</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="expense-data-soleTrader" id="item45_Telephone" name="item45_Telephone" value="0" oninput="block2()">
                                            <span for="item45_Telephone">Telephone</span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="number" onclick="this.select();" class="" id="item46_lessExpense" name="item46_lessExpense" value="0" disabled oninput="block2()">
                                            <span for="item46_lessExpense">Less expenses</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label class="form-label">Total Busines Income/Loss </label>
                                        <div class="form-group col-sm-6">
                                            <input type="number" onclick="this.select();" class="" id="item49_TotalBusinessIncomeLoss" disabled name="item49_TotalBusinessIncomeLoss" value="0" oninput="block2()">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info btn-default pull-left soleTrader-agreed-btn"><span class="glyphicon glyphicon-check"></span> Ok</button>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section class="result-page" style="background: white;display:none;">
            <h1 style="color: blue;  font-size: 240%; margin-top: 140px; font-family:'Times New Roman', Times, serif; padding-left:25px; text-align: center;">Tax Results Summary</h1>
            <div class="container">
                <!-- <button type="button" id="edit-tax" style="float: right; background-color: blue; color:white; padding: 5px;">Back to Edit My Tax</button> -->

                <button type="submit" class="btn btn-primary edit-tax" style="height: 36px;font-size: 14px;width: 86px;margin-left: 84%;margin-bottom: 6px;">Edit Tax</button>&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary final-submit-tax" style="height: 36px;font-size: 14px;width: 110px;margin-left: 0%;margin-bottom: 6px;">Submit Tax</button>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary" style="border-color: white !important;">
                            <div class="panel-heading">Basic Details</div>
                            <div class="panel-body">
                                <div class="form-group" style="margin-bottom: 36px;">
                                    <label class="col-md-2 control-label" for="firstName">First Name</label>
                                    <div class="col-md-4">
                                        <input id="firstName" name="firstName" type="text" placeholder="First Name" class="    " disabled>
                                    </div>
                                    <label class="col-md-2 control-label" for="familyName">Family Name</label>
                                    <div class="col-md-4">
                                        <input id="familyName" name="familyName" type="text" placeholder="Family Name" class="    " disabled>
                                    </div>
                                </div><br/>
                                <div class="form-group" style="margin-bottom: 51px;">
                                    <label class="col-md-2 control-label" for="taxYear">Tax Year</label>
                                    <div class="col-md-4">
                                        <input id="taxYear" name="taxYear" type="text" placeholder="Tax Year" class="    " disabled>
                                    </div>
                                    <label class="col-md-2 control-label" for="tfn">TFN</label>
                                    <div class="col-md-4">
                                        <input id="tfn" name="tfn" type="text" placeholder="TFN" class="    " disabled>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 30px;">
                                    <label class="col-md-2 control-label" for="taxRefund">Tax Refund</label>
                                    <div class="col-md-4">
                                        <input id="taxRefund" style="border-color: #F2F3F2;
background-color: #F2F3F2;
color: #337AB7;
font-weight: bold;" name="taxRefund" type="text" placeholder="Tax Refund" class="    " disabled>
                                    </div>
                                    <label class="col-md-2 control-label" for="packageName">Package Name</label>
                                    <div class="col-md-4">
                                        <input id="packageName" name="packageName" type="text" placeholder="Package Name" value="Standard Tax" class="    " disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="height: 420px;">
                    <div class="col-md-12">
                        <div class="panel panel-primary" style="border-color: white !important;">
                            <div class="panel-heading">Tax Particulars & Calculations</div>
                            <div class="panel-body">
                                <div class="panel-body tabs">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab1" data-toggle="tab" style="font-weight: bold;">Job Particulars</a></li>
                                        <li><a href="#tab2" data-toggle="tab" style="font-weight: bold;">Tax Position</a></li>
                                        <li><a href="#tab3" data-toggle="tab" style="font-weight: bold;">Tax Calculations</a></li>
                                        <li><a href="#tab4" data-toggle="tab" style="font-weight: bold;">Refund Components</a></li>
                                    </ul>
                                    <div class="tab-content" style="    height: 260px;">
                                        <div class="tab-pane fade in active" id="tab1">
                                            <div class="form-group" style="margin-bottom: 30px;">
                                                <label class="col-md-2 control-label" for="occupationCode">Occupation Code</label>
                                                <div class="col-md-4">
                                                    <input id="occupationCode" name="occupationCode" type="text" placeholder="Occupation Code" class="    " disabled>
                                                </div>
                                                <label class="col-md-2 control-label" for="jobNumber">Job Number</label>
                                                <div class="col-md-4">
                                                    <input id="jobNumber" name="jobNumber" type="text" placeholder="Job Number" class="    " disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab2">
                                            <div class="form-group" style="margin-bottom: 30px;">
                                                <div>
                                                    <label class="col-md-2 control-label" for="incomeSourceTotal">Income Source Total</label>
                                                    <div class="col-md-4">
                                                        <input id="incomeSourceTotal" name="incomeSourceTotal" type="text" placeholder="Income Source Total" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label" for="taxDeductions">Tax Deductions</label>
                                                    <div class="col-md-4">
                                                        <input id="taxDeductions" name="taxDeductions" type="text" placeholder="Tax Deductions" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label" style="    padding-top: 5px;" for="taxableIncome">Taxable Income</label>
                                                    <div class="col-md-4" style="    padding-top: 5px;">
                                                        <input id="taxableIncome" name="taxableIncome" type="text" placeholder="Taxable Income" class="    " disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab3">
                                            <div class="form-group" style="margin-bottom: 30px;">

                                                <div>
                                                    <label class="col-md-2 control-label" for="rawTaxCalc">Raw Tax Calculated</label>
                                                    <div class="col-md-4">
                                                        <input id="rawTaxCalc" name="rawTaxCalc" type="text" placeholder="Raw Tax Calculated" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label" for="medicareLevy">Plus Std Medicare Levy</label>
                                                    <div class="col-md-4">
                                                        <input id="medicareLevy" name="medicareLevy" type="text" placeholder="Plus Std Medicare Levy" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label"  style="    padding-top: 5px;"for="medicareLevySurcharge">Plus Medicare Levy Surcharge</label>
                                                    <div class="col-md-4" style="    padding-top: 5px;">
                                                        <input id="medicareLevySurcharge" name="medicareLevySurcharge" type="text" placeholder="Plus Medicare Levy Surcharge" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label"  style="    padding-top: 5px;"for="helpDebt">Plus Hecs or Help Debt</label>
                                                    <div class="col-md-4" style="    padding-top: 5px;">
                                                        <input id="helpDebt" name="helpDebt" type="text" placeholder="Plus Hecs or Help Debt" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label" style="    padding-top: 5px;" for="lessLowIncomeRebates">Less Low Income Rebates</label>
                                                    <div class="col-md-4" style="    padding-top: 5px;">
                                                        <input id="lessLowIncomeRebates" name="lessLowIncomeRebates" type="text" placeholder="Less Low Income Rebates" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label" style="    padding-top: 5px;" for="taxPayable">Potential Tax Payable</label>
                                                    <div class="col-md-4" style="    padding-top: 5px;">
                                                        <input id="taxPayable" name="taxPayable" type="text" placeholder="Potential Tax Payable" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label" style="    padding-top: 5px;" for="PHInsuranceRebates">+ or - PHInsurance Rebates</label>
                                                    <div class="col-md-4" style="    padding-top: 5px;">
                                                        <input id="PHInsuranceRebates" name="PHInsuranceRebates" type="text" placeholder="+ or - PHInsurance Rebates" class="    " disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab4">
                                            <div class="form-group" style="margin-bottom: 30px;">

                                                <div>
                                                    <label class="col-md-2 control-label" for="witheldSalaries">Less Tax Witheld from Salaries</label>
                                                    <div class="col-md-4">
                                                        <input id="witheldSalaries" name="witheldSalaries" type="text" placeholder="Less Tax Witheld from Salaries" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label" for="tfnTaxInterestDividend">Less TFN Tax interest/Dividend</label>
                                                    <div class="col-md-4">
                                                        <input id="tfnTaxInterestDividend" name="tfnTaxInterestDividend" type="text" placeholder="Less TFN Tax interest/Dividend" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label" style="    padding-top: 5px;" for="imputationCredits">Less Imputation Credits</label>
                                                    <div class="col-md-4" style="    padding-top: 5px;">
                                                        <input id="imputationCredits" name="imputationCredits" type="text" placeholder="Less Imputation Credits" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label" style="    padding-top: 5px;" for="arrearsTaxWithheld">Less Arrears Tax Witheld</label>
                                                    <div class="col-md-4" style="    padding-top: 5px;">
                                                        <input id="arrearsTaxWithheld" name="arrearsTaxWithheld" type="text" placeholder="Less Arrears Tax Witheld" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label" style="    padding-top: 5px;" for="taxRefundable">My Tax Refund</label>
                                                    <div class="col-md-4" style="    padding-top: 5px;">
                                                        <input id="taxRefundable" name="taxRefundable" type="text" placeholder="My Tax Refund" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label" style="    padding-top: 5px;" for="quarterPAYGTaxInstall">Less Quarter PAYG Tax Install</label>
                                                    <div class="col-md-4" style="    padding-top: 5px;">
                                                        <input id="quarterPAYGTaxInstall" name="quarterPAYGTaxInstall" type="text" placeholder="Less Quarter PAYG Tax Install" class="    " disabled>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="col-md-2 control-label" style="    padding-top: 5px;" for="lessOtherRefundableCredits">Less Other Refundable credits</label>
                                                    <div class="col-md-4" style="    padding-top: 5px;">
                                                        <input id="lessOtherRefundableCredits" name="lessOtherRefundableCredits" type="text" placeholder="Less Other Refundable credits" class="    " disabled>
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
                <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary" style="border-color: white !important;">
                                <!-- <div class="panel-heading">Basic Details</div> -->
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label" for="taxDeclarationandCondition">Tax Declaration & Conditions confirmed</label>
                                            <div class="col-md-6">
                                                <input type="checkbox" style="width: 7%;margin-top: -11px;" name="taxDeclarationandCondition" value="true" checked>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-4 control-label" for="finalInstruction">My Final Instructions</label>
                                            <div class="col-md-8">
                                                <textarea class="    " style="width: 100%;" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <button type="submit" class="btn btn-primary final-submit-tax" style="width: 15%;height: 47px;font-size: 16px;margin-left: 40%;margin-bottom: 6px;">Submit Tax</button>
            </div>
            <div class="alert alert-warning alert-dismissible fade in" style="position: absolute;top: 72px;left: 26%;" >
                <a href="#" class="close-alert" data-dismiss="alert" aria-label="close">&times;</a>
                <i><strong>Info!</strong> Please confirm this Tax Summary by clicking on the Submit Tax button.</i>
            </div>
        </section>
        <section class="content-val" style="display:none;">
            <div id="rotator" class="loader" style="height:300px;width:300px;display:none;margin-left: 40%;"></div>
            <span class="loader-msg" style="margin-left: 32%;margin-top: 68px;display:none;font-size: 20px;">Please don't leave this page while we process your tax...</span>
        </section>
        <!--================End Latest News Area =================-->
        <footer>
            <div class="copy_right_area">
                <div class="container" style="background: #04081D;">
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
        <script src="js/bootstrap-notify.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Extra plugin css -->
        <script src="dist/jquery.flipster.min.js"></script>
        <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/js/rotator.js"></script>
        <!-- <script src="js/test.js"></script> -->

        <script src="js/theme.js"></script>
        <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="vendor/jquery-validation/dist/additional-methods.min.js"></script>
        <script src="vendor/jquery-steps/jquery.steps.min.js"></script>
        <script src="vendor/minimalist-picker/dobpicker.js"></script>
        <script src="vendor/nouislider/nouislider.min.js"></script>
        <script src="vendor/wnumb/wNumb.js"></script>
		<script type="text/javascript" src="files/switchery.min_2.1.js"></script>
        <script src="js/js/main.js"></script>
		<script type="text/javascript" src="js/common.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
        
        <script src="https://www.google.com/recaptcha/enterprise.js?render=6LeIoUMnAAAAAP8JiDM_bnNARH2KXbLxCTlF3Jdu"
            async defer>
        </script>
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

                
                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                elems.forEach(function(html) {
                    var switchery = new Switchery(html);
                });

                $('[data-toggle="tooltip"]').tooltip();
                
                
                msieversion();
            });
            
            
    
            function msieversion() {
        
                var ua = window.navigator.userAgent;
                var msie = ua.indexOf("MSIE ");
            
                if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))  // If Internet Explorer, return version number
                {
                    alert("This website doesn't support IE browsers. To have better experience please use modern browsers such as Google Chrome or Mozilla Firefox.");
                    window.location.href = "https://www.policetax.com.au/packages-menu";
                    //alert(parseInt(ua.substring(msie + 5, ua.indexOf(".", msie))));
                }else{
                    //alert("Great");
                }
                
            }
            
            var coverflow = $("#coverflow").flipster({
                style: 'carousel',
                spacing: -0.15,
                buttons: true,
                start: 2,
                scrollwheel: false,
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

                console.log($(document).height());
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
