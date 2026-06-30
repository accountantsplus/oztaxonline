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

  <title>Client LookUp</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">

  <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="./css/bootstrap/bootstrap-theme.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/orders.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <noscript>
    <link rel="stylesheet" href="./css/noscript.css">
  </noscript>
  <style>
@media screen and (min-width: 1120px) {
    #myModal .modal-dialog {
        width: 80%;
        margin-left: 10%;
        margin-right: 10%;
    }
}
@media screen and (max-width: 1119px) {
    #myModal .modal-dialog {
        width: 96%;
        margin-left: 2%;
        margin-right: 2%;
    }
}
  </style>
</head>
<body>

<nav class="navbar css-navbar navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapsable">
        <span class="badge css-cart-badge"></span>
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

    <div class="collapse navbar-collapse" id="nav-collapsable">
      <ul class="nav navbar-nav navbar-right">
        <li ><a href="logout.php" style="color:yellow;font-weight: bold" class="">Log out</a></li>
        <li><a href="home.php">Home</a></li>
        <li class="active"><a href="lookup.php">Client LookUp</a></li>
		<li><a href="onBoard.php">On Board</a></li>
		<!--<li><a href="amened.php">Amended</a></li>-->
		<li><a href="calendar.php">Weekly Progress</a></li>
        <li><a href="appo.php">Appointment&nbsp;<span class="badge css-cart-badge js-cart-badge"></span></a></li>
        <li ><a href="reset-password.php" style="color:red;font-weight: bold" class="">Reset password</a></li>
      </ul>
    </div>

  </div>
</nav>

<!-- Content area -->
<div class="row css-contentarea">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 css-content-left">

    <h1>Client LookUp</h1>
    <div class="css-divider"></div>

    <!-- Client list - table(data) -->
    <div class="row js-swap-list">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 css-content-left">
			<h4>Latest Update Clients: <b id="lastUpdateClients"></b></h4>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 css-content-left">
			<h4>Latest Update Tax Forms: <b id="lastUpdateTaxForms"></b></h4>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 css-content-left">
			<h4>Latest Update Addresses: <b id="lastUpdateAddresses"></b></h4>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 css-content-left">
			<h4>Latest Update Numbers: <b id="lastUpdateNumbers"></b></h4>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 css-content-left">
			<h4>New clients: <b id="newClientsNumbers"></b></h4>
		</div>

      <!-- Search form -->
      <div class="row css-searchform">


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 form form-inline">
          <form class="form form-inline" role="form">
            <fieldset>

            <div class="css-search-standard">

              <div class="form-group">
                <select class="form-control" id="status-list">
                  <option value="">Select by status level</option>
                  <option value="0">Not started</option>
                  <option value="10">ATO prefill</option>
                  <option value="1">Appointment</option>
                  <option value="2">Interviewed</option>
                  <option value="3">Wait on Info</option>
                  <option value="4">Wait on Sign</option>
                  <option value="5">Ready to lodge</option>
                  <option value="6">Lodged</option>
				  <option value="12">Lost clients</option>
				  <option value="13">Company</option>
				  <option value="">All clients</option>
                </select>
              </div>
				
              <div class="form-group">
                <input type="text" class="form-control" id="clientName" placeholder="Search By Client Name">
              </div>

              <div class="form-group">
                <input type="text" class="form-control" id="phoneNumber" placeholder="Search By Phone Number">
              </div>
				
              <div class="form-group">
                <input type="text" class="form-control" id="clientEmail" placeholder="Search By Client Email">
              </div>
				
              <div class="form-group">
                <input type="text" class="form-control" id="clientPostcode" placeholder="Search By Postcode">
              </div>

            </div>
			
			<!--
            <div class="js-swap-searchstandard"></div>

            <div class="css-search-advanced js-swap-searchadvanced">

              <div class="form-group">
                <select class="form-control" id="refund-list">
                  <option value="">Select by tax refund</option>
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" id="form-search-sapnum" placeholder="Search By Address">
              </div>

            </div>-->

            <div class="css-search-submit">

              <div class="form-group">
                <a class="btn btn-primary" id="searchButton">Search</a>
                <img class="hidden js-loading" src="images/loading.gif" />
              </div>

            </div>

            </fieldset>
            <!--<input type="submit"/>-->
          </form>
        </div>
		<!--
        <div class="css-search-toggle col-xs-12 col-sm-12 col-md-12 col-lg-3 pull-right">
          <div class="btn-group">
            <button type="button" class="btn btn-default active js-swapbutton-searchstandard">Standard</button>
            <button type="button" class="btn btn-default js-swapbutton-searchadvanced">Advanced</button>
          </div>
        </div>-->

      </div>
	  <!--
      <div class="css-divider"></div>

      <div class="text-center">
        <h3>Results from: <span id="searchName">Any searches</span></h3>
      </div>-->

      <table class="hidden-xs table table-bordered table-striped" id="searchTable" width="100%">
        <thead>
          <tr>
            <th width="7%">
              FirstName<br />
              <a class="js-sort" href="#" title="Sort FirstName by Ascending"><span id="FirstName" class="glyphicon glyphicon-circle-arrow-up css-sort css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort FirstName by Descending"><span id="FirstNamedesc" class="glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="10%">
              LastName<br />
              <a class="js-sort" href="#" title="Sort LastName by Ascending"><span id="LastName" class="glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort LastName by Descending"><span id="LastNamedesc" class="glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="7%">
              DOB<br />
              <a class="js-sort" href="#" title="Sort DOB by Ascending"><span id="DOB" class="glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort DOB by Descending"><span id="DOBdesc" class="glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="8%">
              TFN<br />
              <a class="js-sort" href="#" title="Sort TFN by Ascending"><span id="TFN" class="TFN glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort TFN by Descending"><span id="TFNdesc" class="TFNdesc glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="8%">
              Occupation<br />
              <a class="js-sort" href="#" title="Sort Occupation by Ascending"><span id="Occupation" class="glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort Occupation by Descending"><span id="Occupationdesc" class="glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="7%">
              Phone<br />
              <a class="js-sort" href="#" title="Sort Phone by Ascending"><span id="Phone" class="Phone glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort Phone by Descending"><span id="Phonedesc" class="Phonedesc glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="15%">
              EMail<br />
              <a class="js-sort" href="#" title="Sort EMail by Ascending"><span id="EMail" class="EMail glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort EMail by Descending"><span id="EMaildesc" class="EMaildesc glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="7%">
              Date Added<br />
              <a class="js-sort" href="#" title="Sort Date Added by Ascending"><span id="DateAdded" class="glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort Date Added by Descending"><span id="DateAddeddesc" class="glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="4%">
              Refund<br />
              <a class="js-sort" href="#" title="Sort Refund by Ascending"><span id="Refund" class="glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort Refund by Descending"><span id="Refunddesc" class="glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="6%">
              Tax Income<br />
              <a class="js-sort" href="#" title="Sort Tax Income by Ascending"><span id="TaxIncome" class="glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort Tax Income by Descending"><span id="TaxIncomedesc" class="glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="6%">
              Estimate<br />
              <a class="js-sort" href="#" title="Sort Estimate by Ascending"><span id="Estimate" class="glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort Estimate by Descending"><span id="Estimatedesc" class="glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="8%">
              Status<br />
              <a class="js-sort" href="#" title="Sort Status by Ascending"><span id="Status" class="Status glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort Status by Descending"><span id="Statusdesc" class="Statusdesc glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="8%">
              Lodged Date<br />
              <a class="js-sort" href="#" title="Sort Lodged Date by Ascending"><span id="LodgedDate" class="glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort LodgedDate by Descending"><span id="LodgedDatedesc" class="glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Trent</td>
            <td>ASQUITH</td>
            <td>19-06-88</td>
            <td>0</td>
            <td>Police officer</td>
			<td>3122 6789</td>
            <td>tlasquith88@gmail.com</td>
            <td>20-07-17</td>
            <td>Y</td>
            <td>71662</td>
            <td>227.51</td>
            <td>0</td>
            <td>19-07-19</td>
          </tr>
          <tr>
            <td>JARRYD</td>
            <td>RUTHERFORD</td>
            <td>03-10-91</td>
            <td>0</td>
            <td>Police Officer</td>
 			<td>8888 5643</td>
            <td>jarryd.rutherford@gmail.com</td>
            <td>15-08-19</td>
            <td>Y</td>
            <td>60783</td>
            <td>3667.13</td>
            <td>0</td>
            <td>22-08-19</td>
          </tr>
        </tbody>
      </table>

      <div class="visible-xs row css-items-list">
        <table  class="table table-bordered table-striped" id="searchSection" width="100%">
        <thead>
          <tr>
            <th width="10%">
              Name<br />
              <a class="js-sort" href="#" title="Sort Name by Ascending"><span id="Name" class="glyphicon glyphicon-circle-arrow-up css-sort css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort Name by Descending"><span id="Namedesc" class="glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="9%">
              TFN<br />
              <a class="js-sort" href="#" title="Sort TFN by Ascending"><span id="TFN" class="TFN glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort TFN by Descending"><span id="TFNdesc" class="TFNdesc glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="13%">
              Phone<br />
              <a class="js-sort" href="#" title="Sort Phone by Ascending"><span id="Phone" class="Phone glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort Phone by Descending"><span id="Phonedesc" class="Phonedesc glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="10%">
              EMail<br />
              <a class="js-sort" href="#" title="Sort EMail by Ascending"><span id="EMail" class="EMail glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort EMail by Descending"><span id="EMaildesc" class="EMaildesc glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
            <th width="8%">
              Status<br />
              <a class="js-sort" href="#" title="Sort Status by Ascending"><span id="Status" class="Status glyphicon glyphicon-circle-arrow-up css-sort"></span></a>
              <a class="js-sort" href="#" title="Sort Status by Descending"><span id="Statusdesc" class="Statusdesc glyphicon glyphicon-circle-arrow-down css-sort"></span></a>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Trent</td>
            <td>ASQUITH</td>
			<td>1234</td>
            <td>0</td>
            <td>19-07-19</td>
          </tr>
          <tr>
            <td>JARRYD</td>
            <td>RUTHERFORD</td>
			<td>1234</td>
            <td>0</td>
            <td>22-08-19</td>
          </tr>
        </tbody>

        </table>
      </div>
    <!-- Pagination search -->
    <label for="pagingSearch">Number of items per page</label>
    <div class="css-right-to-center css-pagination">
      <select class="form-control" id="pagingSearch" style="width: 120px">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
      </select>
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
        <h4 class="modal-title">Details</h4>
      </div>

      <div class="modal-body">
		<div class="container">
		  <div class="row">
			<div class="border-container alert-info col-xs-3 col-sm-3 col-md-2 col-lg-2 css-content-left"><h5 class="nowrap">Name</b></div>
			<div class="border-container col-xs-9 col-sm-9 col-md-4 col-lg-6 css-content-left"><h5 id="detail-name">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-3 col-sm-3 col-md-2 col-lg-1 css-content-left"><h5>DOB</h5></div>
			<div class="border-container col-xs-9 col-sm-9 col-md-4 col-lg-3 css-content-left"><h5 id="detail-dob">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-4 col-sm-4 col-md-2 col-lg-1 css-content-left"><h5>Occupation</h5></div>
			<div class="border-container col-xs-8 col-sm-8 col-md-4 col-lg-3 css-content-left"><h5 id="detail-occupation">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-4 col-sm-4 col-md-2 col-lg-1 css-content-left"><h5 class="nowrap">Date Added</b></div>
			<div class="border-container col-xs-8 col-sm-8 col-md-4 col-lg-3 css-content-left"><h5 id="detail-date-added">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-3 col-sm-3 col-md-2 col-lg-1 css-content-left"><h5>Mobile</h5></div>
			<div class="border-container col-xs-9 col-sm-9 col-md-4 col-lg-3 css-content-left"><h5 id="detail-mobile">&nbsp;</h5></div>
			<div class="border-container alert-danger col-xs-3 col-sm-3 col-md-2 col-lg-1 css-content-left"><h5>Status</h5></div>
			<div class="border-container col-xs-9 col-sm-9 col-md-4 col-lg-3 css-content-left"><h5 id="detail-status">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-3 col-sm-3 col-md-2 col-lg-1 css-content-left"><h5>Phone</h5></div>
			<div class="border-container col-xs-9 col-sm-9 col-md-4 col-lg-2 css-content-left"><h5 id="detail-phone">&nbsp;</h5></div>
			<div class="border-container alert-danger col-xs-4 col-sm-4 col-md-2 col-lg-2 css-content-left"><h5 class="nowrap">Lodged Date</b></div>
			<div class="border-container col-xs-8 col-sm-8 col-md-4 col-lg-3 css-content-left"><h5 id="detail-lodged-date">&nbsp;</h5></div>
		  </div>
		  <div class="row">
			<div class="border-container alert-info col-xs-3 col-sm-3 col-md-3 col-lg-1 css-content-left"><h5>Address</h5></div>
			<div class="border-container col-xs-9 col-sm-9 col-md-9 col-lg-11 css-content-left"><h5 id="detail-address">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-3 col-sm-3 col-md-3 col-lg-1 css-content-left"><h5>Text</h5></div>
			<div class="border-container col-xs-9 col-sm-9 col-md-9 col-lg-11 css-content-left"><h5 id="detail-text">&nbsp;</h5></div>
		  </div>
		  <div class="row">
			<div class="border-container alert-info col-xs-9 col-sm-9 col-md-4 col-lg-3 css-content-left"><h5>Wait On Info Notice Sent</h5></div>
			<div class="border-container col-xs-3 col-sm-3 col-md-2 col-lg-1 css-content-left"><h5 id="detail-info-notice">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-9 col-sm-9 col-md-4 col-lg-3 css-content-left"><h5>Wait On Sign Notice Sent</h5></div>
			<div class="border-container col-xs-3 col-sm-3 col-md-2 col-lg-1 css-content-left"><h5 id="detail-sign-notice">&nbsp;</h5></div>
			<div class="border-container alert-info col-xs-9 col-sm-9 col-md-4 col-lg-3 css-content-left"><h5>Lodged Notice Sent</h5></div>
			<div class="border-container col-xs-3 col-sm-3 col-md-2 col-lg-1 css-content-left"><h5 id="detail-lodged-notice">&nbsp;</h5></div>
		  </div>
		</div>
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


<script type="text/javascript" src="./js/jquery/jquery-1.11.1.js"></script>
<script type="text/javascript" src="./js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/moment.min.js"></script>
<script type="text/javascript" src="./js/DetailsModal.js"></script>
<script type="text/javascript" src="./js/lookup.js"></script>

</body>
</html>
