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
  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/editor.css">
  <link rel="stylesheet" href="./css/large_checkbox.css">
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
         <li><a href="https://policetax.com.au/appo/index.php/backend">Go to Diary</a></li>
        
		<li><a href="onBoard.php">On Board</a></li>
		<!--<li><a href="amened.php">Amended</a></li>-->
        <li><a href="calendar.php">Weekly Progress</a></li>
        <li class="active"><a href="appo.php">Appointment&nbsp;<span class="badge css-cart-badge js-cart-badge"></span></a></li>
        
        <li ><a href="reset-password.php" style="color:red;font-weight: bold" class="">Reset password</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>

<!-- Content area -->
<div class="row css-contentarea">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h1>Appointment</h1>


        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form form-inline">
            <div class="css-search-standard">
              <div class="form-group">
                <select class="form-control" id="accountant-list">
                  <option value="">All accountant</option>
                  <option value="0">Garry Angus</option>
                </select>
              </div>
            </div>
            <div class="form-group" bis_skin_checked="1">
                <a class="btn btn-primary" id="filterButton">Filter by accountant</a>
                <img class="hidden js-loading" src="images/loading.gif">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 form form-inline">
            <div class="checkbox" bis_skin_checked="1">
                <a href="#" data-index="0" data-iduser="999" data-id="999&quot;">
                    <label class="checkbox-inline checkbox-bootstrap checkbox-lg text-info font-weight-bold js-allow-delete-trigger" data-index="0" data-iduser="999">
                        <input type="checkbox">
                        <span class="checkbox-placeholder" data-index="0" data-iduser="999" data-field="allow_delete" id="999"></span>
                        Allow delete data
                    </label>
                </a>
            </div>
        </div>
        <div class="css-search-toggle col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 pull-right">
          <div class="btn-group">
            <button type="button" class="btn btn-default active js-today">Today</button>
			<button type="button" class="btn btn-default js-tomorrow">Tomorrow</button>
            <button type="button" class="btn btn-default js-week">This week</button>
			<button type="button" class="btn btn-default js-month">This month</button>
			<button type="button" class="btn btn-default js-new">New appo</button>
          </div>
        </div>

    <div class="clearfix"></div>

    <div class="css-divider"></div>
    
<div class="row">
   <div class="col-sm-12">
      <div class="dataTables_scroll">
         <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%;">
            <table id="monthlyTable" class="table table-bordered table-striped no-footer dataTable" role="grid" aria-describedby="example1_info" style="width: 1640px;">
               <thead>
                  <tr role="row">
					<th>Slot</th>
					<th>Start Time</th>
					<th>Duration</th>
					<th>Method</th>
					<th>Mobile</th>
					<th>Client Name</th>
					<th>Service</th>
					<th>Return Estimate</th>
					<th>Number</th>
					<th>Done</th>
                  </tr>
               </thead>
			   <tbody>
                  <tr role="row">
                     <td><span>1</span></td>
                     <td><span>10.00 AM</span></td>
                     <td><span>15</span></td>
                     <td><span></span></td>
                     <td><span></span></td>
                     <td><span>Peter Chimney</span></td>
                     <td><span>1</span></td>
					 <td><span>Standard Tax</span></td>
					 <td><span>Facetime</span></td>
					 <td>
						<div class="checkbox">
							<label class="checkbox-inline checkbox-bootstrap checkbox-lg">
							  <input type="checkbox" checked>
							  <span class="checkbox-placeholder"></span>
							  Done
							</label>
						</div>
					 </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

    <div class="css-right-to-center css-pagination">
      <ul class="pagination searchItems">
		    <li class="pagFirst"><a id="first">&laquo;</a></li>
        <li class="pagPrev"><a id="prev">&lt;</a></li>
        <li class="pagSearch"><a id="1" >1</a></li>
        <li class="pagSearch"><a id="2" >2</a></li>
        <li class="pagSearch"><a id="3" >3</a></li>
        <li class="pagNext"><a id="next">&gt;</a></li>
		    <li class="pagLast"><a id="first">&raquo;</a></li>
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


<!-- item check message modal -->
<div id="js-details-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Details</h4>
      </div>

      <div class="modal-body">
		<div class="container">
		  <div class="row">
			<div class="border-container alert-info col-xs-4 col-sm-4 col-md-2 col-lg-1 css-content-left"><h5>Start</h5></div>
			<div class="border-container col-xs-8 col-sm-8 col-md-4 col-lg-3 css-content-left"><h5 id="detail-start">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-4 col-sm-4 col-md-2 col-lg-1 css-content-left"><h5>End</h5></div>
			<div class="border-container col-xs-8 col-sm-8 col-md-4 col-lg-3 css-content-left"><h5 id="detail-end">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-4 col-sm-4 col-md-2 col-lg-1 css-content-left"><h5>Duration</h5></div>
			<div class="border-container col-xs-8 col-sm-8 col-md-4 col-lg-3 css-content-left"><h5 id="detail-duration">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-4 col-sm-4 col-md-2 col-lg-1 css-content-left"><h5>Method</h5></div>
			<div class="border-container col-xs-8 col-sm-8 col-md-4 col-lg-3 css-content-left"><h5 id="detail-method">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-4 col-sm-4 col-md-2 col-lg-1 css-content-left"><h5>Mobile</h5></div>
			<div class="border-container col-xs-8 col-sm-8 col-md-4 col-lg-3 css-content-left"><h5 id="detail-mobile">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-4 col-sm-4 col-md-2 col-lg-1 css-content-left"><h5>Client</h5></div>
			<div class="border-container col-xs-8 col-sm-8 col-md-4 col-lg-3 css-content-left"><h5 id="detail-client">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-4 col-sm-4 col-md-2 col-lg-1 css-content-left"><h5>Email</h5></div>
			<div class="border-container col-xs-8 col-sm-8 col-md-4 col-lg-3 css-content-left"><h5 id="detail-email">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-4 col-sm-4 col-md-2 col-lg-1 css-content-left"><h5>Phone</h5></div>
			<div class="border-container col-xs-8 col-sm-8 col-md-4 col-lg-3 css-content-left"><h5 id="detail-phone">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-3 col-sm-3 col-md-3 col-lg-1 css-content-left"><h5>Address</h5></div>
			<div class="border-container col-xs-9 col-sm-9 col-md-9 col-lg-11 css-content-left"><h5 id="detail-address">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-3 col-sm-3 col-md-3 col-lg-1 css-content-left"><h5>Service</h5></div>
			<div class="border-container col-xs-9 col-sm-9 col-md-9 col-lg-11 css-content-left"><h5 id="detail-service">&nbsp;</h5></div>
		  </div>
		</div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary js-first-focus" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- done email send modal -->
<div id="js-sendmail-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Send Email To Client</h4>
      </div>

      <div class="modal-body">
		<div class="container">
		  <div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<textarea class="form-control" id="mailContent" rows="20"></textarea>
			</div>
		  </div>
		</div>
      </div>

      <div class="modal-footer">
		<div class="pull-left">
			<form id="form" action="appo/appoupload.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
        		  <div class="row">
        			<div class="col-xs-6">
        			    Client Tax Report: 
        			</div>
        			<div class="col-xs-6">
    				  <input id="uploadFile" type="file" accept="*/*" name="uploadFile">
        			</div>
        		  </div>
        		  <div class="row">
        			<div class="col-xs-6">
        			    Spouse Tax Report: 
        			</div>
        			<div class="col-xs-6">
    				  <input id="uploadFile2" type="file" accept="*/*" name="uploadFile2">
        			</div>
        		  </div>
				  <label id="err" for="uploadFile"></label>
				</div>
			</form>
		</div>
		<button type="button" class="btn btn-success" id="sendAppoEmail">Send Email</button>
        <button type="button" class="btn btn-danger js-first-focus" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div id="js-notice-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Notice</h4>
      </div>
      <div class="modal-body">
        <p id="noticeBody">
          The email is sent successfully to the client.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger js-first-focus" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="js-confirm-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Confirm</h4>
      </div>
      <div class="modal-body">
        <p id="noticeBody">
            (to be developed)
          Everytime you upload data from HandiTax, this record will reappear again. So you must delete this record from handiTax as well if you want to delete it completely. Do you want to delete this record now ? 
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger js-first-focus" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success js-first-focus deleteConfirmBtn" data-dismiss="modal">Confirm</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="./js/jquery/jquery-1.11.1.js"></script>
<script type="text/javascript" src="./js/jquery/jquery-ui.js"></script>
<script type="text/javascript" src="./js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/editor.js"></script>
<script type="text/javascript" src="./js/moment.min.js"></script>
<script type="text/javascript" src="./js/AppoMailModal.js"></script>
<script type="text/javascript" src="./js/AppoModal.js"></script>
<script type="text/javascript" src="./js/appo.js"></script>

</body>
</html>