<?php
// Initialize the session
if(!isset($_SESSION)) session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>

  <title>Homepage</title>
  <meta charset="utf-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">

  <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="./css/bootstrap/bootstrap-theme.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/home.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <noscript>
    <link rel="stylesheet" href="./css/noscript.css">
  </noscript>

</head>
<body>

<nav class="navbar css-navbar navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapsable">
        <span class="badge css-cart-badge js-cart-badge"></span>
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <img src="./images/policetax.png" alt="logo">
        <span class="css-brand-text">Tax Status</span>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="nav-collapsable">
      <ul class="nav navbar-nav navbar-right">
        <li ><a href="logout.php" style="color:yellow;font-weight: bold" class="">Log out</a></li>
        <li class="active"><a href="home.php">Home</a></li>
        <li><a href="lookup.php">Client LookUp</a></li>
		<li><a href="https://policetax.com.au/appo/index.php/backend">Back to Diary</a></li>
		<li><a href="onBoard.php">On Board</a></li>
		<!--<li><a href="amened.php">Amended</a></li>-->
        <li><a href="calendar.php">Weekly Progress</a></li>
        <li><a href="appo.php">Appointment&nbsp;<span class="badge css-cart-badge js-cart-badge"></span></a></li>
        <li ><a href="reset-password.php" style="color:red;font-weight: bold" class="">Reset password</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>

<!-- Content area - menu -->
<div class="row css-toprow css-contentarea">

  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <div class="thumbnail">
      <a href="lookup.php">
        <img class="css-top-icons" src="./images/user.png" alt="top menu">
        <div class="caption">
          <h3>Client LookUp</h3>
          <p>Find client in data</p>
        </div>
      </a>
    </div>
  </div>

  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <div class="thumbnail">
      <a href="onBoard.php">
        <img class="css-top-icons" src="./images/appo.png" alt="top menu">
        <div class="caption">
          <h3>On Board</h3>
          <p>On Board</p>
        </div>
      </a>
    </div>
  </div>

  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <div class="thumbnail">
      <a href="calendar.php">
        <img class="css-top-icons" src="./images/calendar.png" alt="top menu">
        <div class="caption">
          <h3>Weekly Progress</h3>
          <p>Weekly Diary Progress</p>
        </div>
      </a>
    </div>
  </div>

  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <div class="thumbnail">
      <a href="appo.php">
        <img class="css-top-icons" src="./images/appo.png" alt="top menu">
        <div class="caption">
          <h3>Appointment</h3>
          <p>Appointment List</p>
        </div>
      </a>
    </div>
  </div>

</div>

<!-- Stores -->
<div class="row css-contentarea css-store-area js-store-area">
</div>

<!-- To show if script is disabled -->
<div id="noscript">
  <p>This application requires javascript which is currently disabled in your browser.</p>
</div>

<!-- item check message modal -->
<div id="js-details-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Material Details</h4>
      </div>

      <div class="modal-body">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary js-first-focus" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript" src="./js/jquery/jquery-1.11.1.js"></script>
<script type="text/javascript" src="./js/bootstrap/bootstrap.min.js"></script>


</body>
</html>
