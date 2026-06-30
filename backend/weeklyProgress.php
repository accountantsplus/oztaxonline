<?php
    session_start();
    if (empty($_SESSION["user"]))
    {
        header('Location: login');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Weekly Progress | AccountantsPlus</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <style>
    .overlay {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0, 0.9);
        overflow-x: hidden;
        transition: 0.5s;
    }
    svg{
        margin: 20px;
        display:inline-block;
        width: 100%;
        height: 24%;
        position: absolute;
        margin-top: 14%;
        left: 5%;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>AU</b>T</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Aussie</b>Tax</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu sign-out">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">Sign out</span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--<li>-->
          <!--  <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
          <!--</li>-->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Welcome, <?php echo $_SESSION['user'] ?></p>
        </div>
      </div>
      <!-- search form -->
      <!--<form action="#" method="get" class="sidebar-form">-->
      <!--  <div class="input-group">-->
      <!--    <input type="text" name="q" class="form-control" placeholder="Search...">-->
      <!--    <span class="input-group-btn">-->
      <!--          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>-->
      <!--          </button>-->
      <!--        </span>-->
      <!--  </div>-->
      <!--</form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
          <?php include('sidebar.php'); ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Weekly Progress
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Weekly Progress</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Filters</h3>

          <div class="box-tools pull-right">
            <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Occupation</label>
                <select class="form-control select2 occupation-data" style="width: 100%;">
                  <option selected="selected">Select an Occupation</option>
                  <option value="AirlineTax">Airline</option>
                  <option value="DefenceForceTax">DefenceForce</option>
                  <option value="NurseTax">Nurse</option>
                  <option value="AussieTax">Other</option>
                  <option value="PoliceTax" selected>Police</option>
                  <option value="TeachersTax">Teachers</option>
                  <option value="TradiesTax">Tradies</option>
                </select>
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Year</label>
                <select class="form-control select2 year-data" style="width: 100%;">
                  <option selected="selected">Select a Year</option>
                </select>
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Total <span class="customer-number"></span> customers</label>
              </div>
              <!-- /.form-group -->
            </div>
        </div>
      </div>
      
        <div class="row">
            <div class="col-xs-12">
                
                <div class="box">
                <div class="box-header">
                  <!--<h3 class="box-title">Data Table With Full Features</h3>-->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                              <th>Actual Year/Week</th>
                              <th>Week</th>
                              <th>Total</th>
                              <th>Cummulative Total</th>
                              <th>Week Ending Date</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                    </div>
                <!-- /.box-body -->
                </div>
            </div>
        <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!--<div class="pull-right hidden-xs">-->
    <!--  <b>Version</b> 2.4.0-->
    <!--</div>-->
    <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="https://www.aussietaxonline.com.au/">AccountantsPlus Pty</a>.</strong> All rights
    reserved.
    <div class="box-tools pull-right">
        <a class="btn btn-primary" href="https://www.policetax.com.au/ClientLookUp/index.php" target="blank" role="button">Client Look Up</a>
    </div>
  </footer>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<div id="loadingDiv" class="overlay">

<svg version="1.1" id="L4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
  viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
  <circle fill="#fff" stroke="none" cx="6" cy="50" r="6">
    <animate
      attributeName="opacity"
      dur="1s"
      values="0;1;0"
      repeatCount="indefinite"
      begin="0.1"/>    
  </circle>
  <circle fill="#fff" stroke="none" cx="26" cy="50" r="6">
    <animate
      attributeName="opacity"
      dur="1s"
      values="0;1;0"
      repeatCount="indefinite" 
      begin="0.2"/>       
  </circle>
  <circle fill="#fff" stroke="none" cx="46" cy="50" r="6">
    <animate
      attributeName="opacity"
      dur="1s"
      values="0;1;0"
      repeatCount="indefinite" 
      begin="0.3"/>     
  </circle>
</svg>

</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Select Occupation</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="dist/js/pages/dashboard.js"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/dev.js"></script>
<script>
    $(document).ready(function(){
        $('#loadingDiv')
        .hide()  // Hide it initially
        .ajaxStart(function() {
            $(this).show();
            document.getElementById("loadingDiv").style.width = "100%";
        })
        .ajaxStop(function() {
            $(this).hide();
            document.getElementById("loadingDiv").style.width = "0%";
        });
    //   $('#myModal').modal('show');
    });
    $(function () {
        var tableName = "tblFormValuePoliceTax";
	    var sendBy = "";
        var getValue = function(){
            var data = [];
            $('#example1').dataTable().fnClearTable();
            $('#example1').dataTable().fnDestroy();
        
            var filterVal = $(".filter-data option:selected").val();
            var occVal = $(".occupation-data option:selected").val();
            $.post("weekData", {occupation: occVal, filter: filterVal, years: parseInt($(".year-data :selected").val())}, function(response){
                response = JSON.parse(response);
            	var highlightedData = "";
            	var grandTotal = 0;
            	$.each(response.aaData, function(index, value){
    				grandTotal += parseInt(value.Total);
    			    data.push([value.YearWeek, value.Week, value.Total, grandTotal, value.EndingDate]);
                    
            	});
            	$(".customer-number").html(grandTotal);
            	
            	//console.log(data);
            	$('#example1').dataTable({
                    data:           data,
                    order:          [[ 0, "asc" ]],
                    deferRender:    true,
                    scrollY:        400,
                    scrollX:        "100%",
                    scrollX:        true,
                    scrollCollapse: true,
                    scroller:       true,
                    columns:        [
                                        { title: "Actual Year/Week" },
                                        {"mRender": function ( data, type, row ) {
                                                //console.log(row[13]);
                                                if(row[1] != ""){
                                                    var week = parseInt(row[1]) - 26;
                                                    week += 1;
                                                    return week;
                                                } else {
                                                    return '';
                                                }
                                            }
                                        },
                                        { title: "Total Customer" },
                                        { title: "Cummulative Total" },
                                        { title: "Week Ending Date" }
                                    ]
                });
                
               
            });
        }
        
        getValue();
        
        fnLoadYears();
                
                
        $(document).on('click', '.generate-link', function (e) {
            e.preventDefault();
            var valId = $(this).attr("val-id");
            var fullName = $(this).attr("full-name");
            var email = $(this).attr("email-address");
            var urlVal = $(this).attr("url-length");
            //console.log(valId);
            //console.log(txnid);
            var validityVal = Math.floor(1000 + Math.random() * 9000);
            var validTime = "1";

            if(confirm("Are you sure you want to generate a new Continuation URL for this client?")){
                 window.continuationURL = new FormData();
                var continuation = "<html><body><span>Hi " + fullName + ", </span><br /><br />";
                continuation += "<span>To continue we have saved your data so that you don't have to re-enter or pay a credit card. </span> <br /><br />";
                continuation += "<span>You can pick up and restart by clicking on the link below. </span> <br />";
                continuation += "<span><a href='" + urlVal + "&validity=" + validityVal + "'>Click Here</a> </span> <br /><br />";
                continuation += "<span>This link is activated for 48 hours only.</span> <br /><br />";
                continuation += "<span>We look forward to seeing your completed tax return and will call you first thing when we complete it. If you have any further questions, please contact us at : <a href='tel:1800819692'>1800-819-692</a>. </span> <br /><br />";
                continuation += "<span>Regards,</span> <br />";
                continuation += "<span>" + sendBy + "</span> </body></html>";
                continuationURL.append("message", continuation);
                continuationURL.append("subject", "Continuation URL of your Tax Lodgment | " + sendBy);
                continuationURL.append("emailTo", email);
                
                $.post("editData", {id: valId, table: tableName, from: "CreditCardSubmit", hasValidTime: validTime, validity: validityVal}, function(response){
                    $.ajax({
                        url: '../email', // point to server-side PHP script
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: window.continuationURL,
                        type: 'post',
                        success: function(php_script_response){
                            alert("The new continuation URL has been generated and sent to the client.");
                        }
                    });
                });
            }else{

            }
        });
        $(".filter-data").on("change", function(e){
            e.preventDefault();
            if($(".occupation-data option:selected").text() != "Select an Occupation"
                 && $(".year-data option:selected").text() != "Select a Year"){
                getValue();
            }else{
                alert("Please select a valid value");
            }
        });
        
        $(document).on('click', ".process-tax", function(e){
           e.preventDefault();
            var valId = $(this).attr("val-id");
            var fullName = $(this).attr("full-name");
            var email = $(this).attr("email-address");
            var urlVal = $(this).attr("url-length");
            //console.log(valId);
            //console.log(txnid);
            var validityVal = Math.floor(1000 + Math.random() * 9000);
            var validTime = "1";

            if(confirm("Are you sure you want to mark this as processed?")){
                
                $.post("editData", {id: valId, table: tableName, from: "CreditCardSubmit", processed: "true"}, function(response){
                    alert("Tax for " + fullName + " has been marked as Processed.");
                    getValue();
                });
            }else{

            }
           
        });
        
        $(".occupation-data").on("change", function(e){
            e.preventDefault();
            if($(".occupation-data option:selected").text() != "Select an Occupation"){
                getValue();
            }else{
                alert("Please select a valid value");
            }
        });
        
        $(".year-data").on("change", function(e){
            e.preventDefault();
            if($(".year-data option:selected").text() != "Select a Year"){
                getValue();
            }else{
                alert("Please select a valid value");
            }
        });
    });
        
    function fnLoadYears(){
        $(".year-data").html("");
        var currentYear = (new Date).getFullYear();
        var data = `<option>Select a Year</option>`;
        for(var i = 0; i <= 9; i++){
            if(i ==0) {
                data += `<option value="${currentYear}" selected>${currentYear}</option>`;   
            } else {
                data += `<option value="${currentYear}">${currentYear}</option>`;   
            }
            
            currentYear -= 1;
        }
        
        $(".year-data").html(data);
    }
</script>
</body>
</html>
