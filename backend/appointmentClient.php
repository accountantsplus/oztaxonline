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
  <title>Client Lookup | AccountantsPlus</title>
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
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION</li>
        
        <li class=""><a href="dataAnalyticsDashboard"></i> <span>---INCOME TAX RETURN ACTIVITY----</span></a></li>
        <li class=""><a href="home"><i class="fa fa-table"></i> <span>Online ITRs</span></a></li>
        <li class=""><a href="weeklyProgress"><i class="fa fa-calendar"></i> <span>Weekly Progress Online ITRs</span></a></li>
              <li class=""><a href="https://policetax.com.au/appo/index.php/backend"><i class="fa fa-tachometer"></i> <span>Cloud Diary Appoint ITR</span></a></li>
        <li class=""><a href="weeklyProgress"><i class="fa fa-calendar"></i> <span>Weekly Progress Appoint ITR*</span></a></li>
              <li class=""><a href="weeklyProgress"><i class="fa fa-calendar"></i> <span>ITR Consol. Weekly Progress*</span></a></li>
            <li class=""><a href="weeklyProgress"><i class="fa fa-calendar"></i> <span>ITR Lodgement status*</span></a></li>
        
          <li class=""><a href="dataAnalyticsDashboard"></i> <span>----MARKETING ACTIVITY-----</span></a></li>
        <li class=""><a href="setting"><i class="fa fa-cog"></i> <span>Pricing</span></a></li>
                <li class=""><a href="dataAnalyticsDashboard"><i class="fa fa-tachometer"></i> <span>Graphs_DataAnalytics</span></a></li>
        <li class=""><a href="requestCallBack"><i class="fa fa-mobile-phone"></i> <span>Marketing/CRM Enquiries</span></a></li>
         <li class=""><a href="dataAnalyticsDashboard"></i> <span>-----ADMINISTRATION------</span></a></li>
        <li class="active"><a href="#"><i class="fa fa-calendar"></i> <span>Client Lookup*</span></a></li>
      
         <li class=""><a href="weeklyProgress"><i class="fa fa-calendar"></i> <span>Timesheets Module*</span></a></li>
          <li class=""><a href="weeklyProgress"><i class="fa fa-calendar"></i> <span>Group Emailing*</span></a></li>
              <li class=""><a href="weeklyProgress"> <span> </span></a></li>
          <li class=""><a href="weeklyProgress"></i> <span>Under Construction*</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Client Lookup
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Client Lookup</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-default">
        
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
                              <th>Full Name</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Address</th>
                              <th>DOB</th>
                              <th>Has Spouse?</th>
                              <th>Tax Year</th>
                              <th>TFN</th>
                              <th>Occupation</th>
                              <th>Station</th>
                              <th>Staff Responsible</th>
                              <th>Action</th>
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
            $.post("appointmentData", function(response){
                response = JSON.parse(response);
                console.log(response);
            	var highlightedData = "";
            	$.each(response.aaData, function(index, value){
    		        var salutationAndName = "";
    				var address = "";
    				var mobile = "";
    				var email = "";
    				var tfn = "";
    				var beenWithUsBefore = "";
    				var bankAccount = "";
    				var payment = "Yes";
    				var date = "";
    				var occupation = "";
    				var rank = "";
    				var dob = "";
    				var taxYear = "";
    				var finalSubmit = "Yes";
    				var packages = "";0
    				var expenses = "Yes";
    				var isProcessed = "Yes";
                    
                    if(value.first_name != ""){
    					salutationAndName += value.first_name;
    				}
    				
    				if(value.last_name != ""){
    					salutationAndName += " " + value.last_name;
    				}
    				
    				if(value.address != "" && value.address != null){
    					address += value.address + " ";
    				}
    				
    				if(value.suburb != "" && value.suburb != null){
    					address += value.suburb + ", ";
    				}
    				
    				if(value.zip_code != "" && value.zip_code != null){
    					address += value.zip_code + ",  ";
    				}
    				
    				if(value.state != "" && value.state != null){
    					address += value.state;
    				}
    				
    				var occupation = $(".occupation-data option:selected").text();
        			    data.push([salutationAndName, value.email, value.phone_number, address, value.dob, value.spouse_yes_no, value.tax_year, value.tfn, value.occupation_role, value.station_locale, value.StaffResponsible, value.id]);
                    
            	});
            	
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
                                        { title: "Full Name" },
                                        { title: "Email" },
                                        { title: "Mobile" },
                                        { title: "Address" },
                                        { title: "DOB" },
                                        { title: "Has Spouse ?" },
                                        { title: "Tax Year" },
                                        { title: "TFN" },
                                        { title: "Occupation" },
                                        { title: "Station" },
                                        { title: "Staff Responsible" },
                                        {"mRender": function ( data, type, row ) {
                                                return "<button id='edit-link' class='edit-link' val-id='" + data + "' full-name='" + row[0] + "' data-phone='" + row[2] + "'  data-tfn='" + row[7] + "' data-dob='" + row[4] + "' email-address='" + row[1] + "' ><i class='fa fa-edit '></i> Edit</button><br/><button id='delete-data' class='delete-data' val-id='" + data + "'  ><i class='fa fa-trash '></i> Delete</button>";
                                            }
                                        }
                                    ]
                });
                
               
            });
        }
        
        getValue();
        
        
                
                
        $(document).on('click', '.edit-link', function (e) {
            e.preventDefault();
            var valId = $(this).attr("val-id");
            var fullName = $(this).attr("full-name");
            var phone = $(this).attr("data-phone");
            var tfn = $(this).attr("data-tfn");
            var dob = $(this).attr("data-dob");
            var email = $(this).attr("email-address");
            console.log(valId);
            console.log(fullName);
            console.log(phone);
            console.log(tfn);
            console.log(dob);
            console.log(email);
        });
        
        $(document).on('click', ".delete-data", function(e){
           e.preventDefault();
            var valId = $(this).attr("val-id");

            if(confirm("Are you sure you want to delete this client?")){
                
                $.post("deleteClient", {id: valId}, function(response){
                    alert("Client has been deleted.");
                    getValue();
                });
            }else{

            }
           
        });
    });
</script>
</body>
</html>
