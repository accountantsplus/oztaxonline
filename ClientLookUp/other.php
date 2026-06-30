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

  <title>Other</title>
  <meta charset="utf-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">

  <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="./css/bootstrap/bootstrap-theme.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/carts.css">
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
        <li><a href="home.php">Home</a></li>
        <li><a href="lookup.php">Client LookUp</a></li>
		<li><a href="calendar.php">Weekly Progress</a></li>
        <li class="active"><a href="other.php">Other&nbsp;<span class="badge css-cart-badge js-cart-badge"></span></a></li>
        <li ><a href="reset-password.php" style="color:red;font-weight: bold" class="">Reset password</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>

<!-- Content area -->
<div class="row css-contentarea">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    <h1>Other</h1>

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
        <button type="button" class="btn btn-default js-first-focus" data-dismiss="modal" href="#">Cancel</button>
        <button id="js-removeall-confirm" type="button" class="btn btn-danger">Remove</button>
      </div>
    </div>
  </div>
</div>

<!-- cost centre select modal -->
<div id="js-costcenter-modal" class="modal fade css-costcenter-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Manage Cost Centre for item</h4>
      </div>
      <div class="modal-body">

        <p class="pull-left js-costcenter-message-error text-danger"></p>

        <div class="pull-right">
          <a id="js-add-costcenter" class="btn btn-primary">Split</a>
        </div>
        <div class="clearfix"></div>

        <form id="js-add-target" class="form form-inline">

<!--
          <div class="js-costcenter-row row css-row">

            <div class="form-group col-xs-12 col-sm-3 col-md-3 col-lg-3">
              <select class="form-control">
                <option>cost center</option>
              </select>
            </div>

            <div class="form-group col-xs-12 col-sm-3 col-md-3 col-lg-3">
              <select class="form-control">
                <option>fund</option>
              </select>
            </div>

            <div class="form-group col-xs-6 col-sm-3 col-md-3 col-lg-3">
              <div class="input-group">
                <span class="input-group-addon">qty</span>
                <input type="text" class="form-control" />
              </div>
            </div>

            <div class="form-group col-xs-12 col-sm-3 col-md-3 col-lg-3">
              <a class="css-remove" href="#">remove</a>
            </div>

          </div>
-->

        </form>

      </div>
      <div class="modal-footer">
        <img class="hidden js-costcenter-loading" src="images/loading.gif" />
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="js-save-costcenter" type="button" class="btn btn-primary">Apply</button>
      </div>
    </div>
  </div>
</div>

<!-- quantity options modal -->
<div id="js-qtyoptions-modal" class="modal fade css-check-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Choose check options</h4>
      </div>
      <div class="modal-body">

        <p class="modal-title text-warning css-warning">
          The quantity you requested for the item below is above the available quantity.<br />
          Please choose a delivery option.
        </p>

        <form class="form form-inline">

          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Adjust to Available Qty&nbsp;<span class="text-info js-icon-info glyphicon glyphicon-info-sign" data-toggle="popover" data-placement="top" data-content="Process my order with the currently available quantity and cancel my request for any additional stock."></span></th>
                <th>Backorder All&nbsp;<span class="text-info js-icon-info glyphicon glyphicon-info-sign" data-toggle="popover" data-placement="top" data-content="Process my order as one order for the requested quantity. Note that the order will not be processed until the total requested quantity becomes available, e.g. additional stock arrives in the store. You will be emailed when the order is ready to collect."></span></th>
                <th>Split Delivery&nbsp;<span class="text-info js-icon-info glyphicon glyphicon-info-sign" data-toggle="popover" data-placement="bottom" data-content="Process my order with the available quantity now and place the remaining items on backorder. Note that the back order will not be processed until the total backordered quantity becomes available, e.g. additional stock arrives in the store. You will receive a second email when the additional stock is ready to collect."></span></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input type="radio" name="radio-qty" class="js-qtyoptions js-available" />
                </td>
                <td>
                  <input type="radio" name="radio-qty" class="js-qtyoptions js-requested" />
                </td>
                <td>
                  <input type="radio" name="radio-qty" class="js-qtyoptions js-split" />
                </td>
              </tr>
            </tbody>
          </table>

        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="js-save-qtyoption" type="button" class="btn btn-primary">Done</button>
      </div>
    </div>
  </div>
</div>

<!-- item removal modal -->
<div id="js-remove-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Remove Item</h4>
      </div>

      <div class="modal-body">

        <p>Are you sure you want to remove this item?</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default js-first-focus" data-dismiss="modal">Cancel</button>
        <button id="js-remove-item" type="button" class="btn btn-danger">Remove</button>
      </div>
    </div>
  </div>
</div>

<!-- item check modal (invalid case) -->
<div id="js-invalid-check-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Unable to check.</h4>
      </div>

      <div class="modal-body">

        <h4>You canot check for one of the following reasons.</h4>
        <p> - There are no items in the shopping cart</p>
        <p> - Cost centres or funds are not appropriately selected for items in the shopping cart.</p>
        <p> - Split is not done with appropriate quantity.</p>
        <p> - Split option is not selected for the item requested with more quantity than available quantity.</p>
        <h4>Please correct and press 'check' again.</h4>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary js-first-focus" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- item check modal -->
<div id="js-check-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Check</h4>
      </div>

      <div class="modal-body">

        <p>Warning</p>
        <p class="text-warning">
          Warning.
        </p>

      </div>
      <div class="modal-footer">
        <img class="hidden js-check-loading" src="images/loading.gif" />
        <button type="button" class="btn btn-default js-first-focus" data-dismiss="modal">Cancel</button>
        <button id="js-check-confirm" type="button" class="btn btn-primary">Check</button>
      </div>
    </div>
  </div>
</div>

<!-- item check message modal -->
<div id="js-check-message-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Check</h4>
      </div>

      <div class="modal-body">

        <p class="js-message"></p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary js-first-focus" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
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

<!-- item check message modal (error) -->
<div id="js-details-modal-error" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Cannot load details</h4>
      </div>

      <div class="modal-body">
        <p>Error happened while loading details. Please try again.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary js-first-focus" data-dismiss="modal">OK</button>
      </div>

    </div>
  </div>
</div>

<div id="noscript">
  <p>This application requires javascript which is currently disabled in your browser.<br />
  If you are unable to use a browser with javascript, please contact P2P Stores Staff for assistance.</p>
</div>

<script type="text/javascript" src="./js/jquery/jquery-1.11.1.js"></script>
<script type="text/javascript" src="./js/bootstrap/bootstrap.min.js"></script>

</body>
</html>
