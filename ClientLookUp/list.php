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

  <title>Client List</title>
  <meta charset="utf-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">

  <link rel="stylesheet" href="./css/jquery-ui/jquery-ui.css">
  <link rel="stylesheet" href="./css/jquery-ui/jquery-ui.theme.css">
  <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="./css/bootstrap/bootstrap-theme.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/history.css">
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
        <img src="./images/policetax.png" alt="logo" />
        <span class="css-brand-text">Tax Status</span>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="nav-collapsable">
      <ul class="nav navbar-nav navbar-right">
        <li ><a href="logout.php" style="color:yellow;font-weight: bold" class="">Log out</a></li>
        <li><a href="home.php">Home</a></li>
        <li><a href="lookup.php">Client LookUp</a></li>
        <li class="active"><a href="list.php">Client List</a></li>
        <li><a href="other.php">Other&nbsp;<span class="badge css-cart-badge js-cart-badge"></span></a></li>
        <li ><a href="reset-password.php" style="color:red;font-weight: bold" class="">Reset password</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>

<!-- Content area -->
<div class="row css-contentarea">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    <h1>Client List</h1>

    <div class="clearfix"></div>

    <div class="css-divider"></div>
    
    <h4>Content add later</h4>

  </div>

</div>

<!-- remove all modal  -->
<div id="js-removeall-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Remove All</h4>
      </div>

      <div class="modal-body">

        <p>
          Are you sure you want to remove all ?
        </p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="js-removeall-confirm" type="button" class="btn btn-danger">Remove</button>
      </div>
    </div>
  </div>
</div>

<div id="noscript">
  <p>This application requires javascript which is currently disabled in your browser.</p>
</div>

<script type="text/javascript" src="./js/jquery/jquery-1.11.1.js"></script>
<script type="text/javascript" src="./js/jquery/jquery-ui.js"></script>
<script type="text/javascript" src="./js/bootstrap/bootstrap.min.js"></script>

</body>
</html>
