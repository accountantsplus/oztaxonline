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
        <li><a href="https://policetax.com.au/appo/index.php/backend">Back to Diary</a></li>
		<li class="active"><a href="onBoard.php">On Board</a></li>
		<!--<li><a href="amened.php">Amended</a></li>-->
        <li><a href="calendar.php">Weekly Progress</a></li>
        <li><a href="appo.php">Appointment&nbsp;<span class="badge css-cart-badge js-cart-badge"></span></a></li>
        <li ><a href="reset-password.php" style="color:red;font-weight: bold" class="">Reset password</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>

<!-- Content area -->
<div class="row css-contentarea">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    <h1>On Board</h1>

    <div class="clearfix"></div>

    <!--<div class="css-divider"></div>-->
    
<div class="row">
   <div class="col-sm-12">
      <div class="dataTables_scroll">
         <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%;">
            <table id="weeklyTable" class="table table-bordered table-striped no-footer dataTable" role="grid" aria-describedby="example1_info" style="width: 1640px;">
               <thead>
                  <tr role="row">
					<th>Email</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Station</th>
					<th>Rank</th>
					<th>Years In Job</th>
					<th>Spouse Include</th>
					<th>Spouse Name</th>
					<th>Spouse DOB</th>
					<th>Spouse Income</th>
					<th>No Dependants</th>
					<th>Rental property</th>
					<th></th>
                  </tr>
               </thead>
			   <tbody>
			   <!--
                  <tr role="row">
                     <td>2021/26</td>
                     <td>1</td>
                     <td>15</td>
                     <td>15</td>
                     <td>2021-07-03</td>
                  </tr>
                  <tr role="row">
                     <td>2021/27</td>
                     <td>2</td>
                     <td>61</td>
                     <td>76</td>
                     <td>2021-07-10</td>
                  </tr>
                  <tr role="row">
                     <td>2021/28</td>
                     <td>3</td>
                     <td>97</td>
                     <td>173</td>
                     <td>2021-07-17</td>
                  </tr>
                  <tr role="row">
                     <td>2021/29</td>
                     <td>4</td>
                     <td>94</td>
                     <td>267</td>
                     <td>2021-07-24</td>
                  </tr>
                  <tr role="row">
                     <td>2021/30</td>
                     <td>5</td>
                     <td>97</td>
                     <td>364</td>
                     <td>2021-07-31</td>
                  </tr>
                  <tr role="row">
                     <td>2021/31</td>
                     <td>6</td>
                     <td>47</td>
                     <td>411</td>
                     <td>2021-08-07</td>
                  </tr>
                  <tr role="row">
                     <td>2021/32</td>
                     <td>7</td>
                     <td>48</td>
                     <td>459</td>
                     <td>2021-08-14</td>
                  </tr>
                  <tr role="row">
                     <td>2021/33</td>
                     <td>8</td>
                     <td>59</td>
                     <td>518</td>
                     <td>2021-08-21</td>
                  </tr>
                  <tr role="row">
                     <td>2021/34</td>
                     <td>9</td>
                     <td>13</td>
                     <td>531</td>
                     <td>2021-08-28</td>
                  </tr>
                  <tr role="row">
                     <td>2021/35</td>
                     <td>10</td>
                     <td>1</td>
                     <td>532</td>
                     <td>2021-09-04</td>
                  </tr>-->
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<div class="css-right-to-center css-pagination">
	<ul class="pagination searchItems">
		<!--
		<li class="pagSearch"><a id="1" >1</a></li>
		<li class="pagSearch"><a id="2" >2</a></li>
		<li class="pagSearch"><a id="3" >3</a></li>
		<li class="pagSearch"><a id="4" >4</a></li>
		<li class="pagSearch"><a id="5" >5</a></li>-->
	</ul>
</div>

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
<script type="text/javascript" src="./js/moment.min.js"></script>
<script type="text/javascript" src="./js/onBoard.js"></script>

</body>
</html>
