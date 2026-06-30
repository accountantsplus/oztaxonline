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
  <title>Home | AccountantsPlus</title>
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
/* Center the loader */
    .overlay {
        position: fixed;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background: rgba(51,51,51,0.7);
        z-index: 10;
}
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
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
     <div id="mainDiv">
         
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Online
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Online</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-default" id="myDiv">
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
                <label>Filter</label>
                <select class="form-control select2 filter-data" style="width: 100%;">
                  <option selected="selected">Select a Criteria</option>
                  <option value="All" selected>All</option>
                  <option value="TaxProcessed">ELS Lodged</option>
                  <option value="TaxNotProcessed">ELS Not Lodged</option>
                  <option value="PotentialClient">Left Abruptly</option>
                  <option value="SubmitError">Submit Error</option>
                  <option value="Complete">Completed</option>
                </select>
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
                              <th>Date</th>
                              <th>Week</th>
                              <th>Occupation</th>
                              <th>ELS Lodged</th>
                              <th>Full Name</th>
                              <th>Existing Customer</th>
                              <th>DOB</th>
                              <th>Address</th>
                              <th>Mobile</th>
                              <th>Email</th>
                              <th>Tax Year</th>
                              <th>TFN</th>
                              <th>Payment</th>
                              <th>Income</th>
                              <th>Final Submit</th>
                              <th>Continuation Link Generate</th>
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
  </section>
     </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!--<div class="pull-right hidden-xs">-->
    <!--  <b>Version</b> 2.4.0-->
    <!--</div>-->
    <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="https://www.aussietaxonline.com.au/" style="color:black;">AccountantsPlus Pty</a>.</strong> All rights
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

    <div class="overlay ">
        <div id="loader"></div> 
    </div>

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
          <h4 class="modal-title">Tax Detail</h4>
        </div>
        <div class="modal-body">
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
    $(function () {
        var tableName = "tblFormValuePoliceTax";
	    var sendBy = "";
	    
	    var getAppropriateData = function(){
	        $.each($(".occupation-data").find("option"), function(i, v){
                var occVal = $(this).val();
                var occTex = $(this).text();
                var currentOption = $(this);
                if(occVal != "" && occVal != undefined && occVal != "Select an Occupation"){
        	        $.post("totalData", {occupation: occVal}, function(response){
                        response = JSON.parse(response);
        	            var changeText = occTex + " | " + response.aaData[0].Total;
        	            currentOption.text(changeText);
        	        });   
                }
	        });
	        
	    }
	    
        var getValue = function(){
            
            $(".overlay").show();
            var data = [];
            $('#example1').dataTable().fnClearTable();
            $('#example1').dataTable().fnDestroy();
        
            var filterVal = $(".filter-data option:selected").val();
            var occVal = $(".occupation-data option:selected").val();
            $.post("server_processing", {occupation: occVal, filter: filterVal}, function(response){
                //console.log(response);
                response = JSON.parse(response);
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
                    //console.log(value);
                    //console.log(value);
                    if(value.JsonValue != ""){
                        var jsondata = JSON.parse(value.JsonValue);
        			    $.each(jsondata, function(i, v){
            				if(i == "BeenWithUsBefore"){
            					beenWithUsBefore = v;
            				}else if(i == "TaxYear"){
            					taxYear = v;
            				}else if(i == "Package"){
            				    packages = v;
            				}
            				else if(i == "Title"){
            					salutationAndName += v + " ";
            				}
            				else if(i == "FirstName"){
            					salutationAndName += v;
            				}
            				else if(i == "MiddleName"){
            					salutationAndName += " " + v;
            				}
            				else if(i == "SurName"){
            					$("#sur-name").val(v); 
            					salutationAndName += " " + v;
            				}
            				else if(i == "MobileNumber"){
            					mobile = v;
            				}
            				else if(i == "Email"){
            					email = v;
            				}
            				else if(i == "OccupationRole"){
            					occupation = v;
            				}
            				else if(i == "Rank"){
            					mobile += " | Rank: " + v; 
            				}
            				else if(i == "YearsInJob"){
            				    if(v != ""){
            					    mobile += " | Years in Job: " + v; 
            				    }
            				}
            				else if(i == "StreetUnitNumber"){
            					address += v + " ";
            				}
            				else if(i == "StreetAddress"){
            					address += v + ", ";
            				}							
            				else if(i == "Suburb"){
            					address += v + ", ";
            				}
            				else if(i == "State"){
            					address += v + "  ";
            				}
            				else if(i == "PostCode"){
            					address += v;
            				}
            				else if(i == "DOB"){
            					if(v != ""){ 
                                    var datepickerVal = v.split("-");
                                    
                                    if(datepickerVal[0].indexOf("/") != -1){
                                        datepickerVal = v.split("/");
                                        dob = datepickerVal[2] + "-" + datepickerVal[1] + "-" + datepickerVal[0];
                                    }else{
                                        if(datepickerVal[1] != "10" && datepickerVal[1] != "20" && datepickerVal[1] != "30" && datepickerVal[1].indexOf("0") != -1){
                                            var singleVal = datepickerVal[1].split("0");
                                            datepickerVal[1] = singleVal[1];
                                        }
                
                
                                        if(datepickerVal[2] != "10" && datepickerVal[2] != "20" && datepickerVal[2] != "30" && datepickerVal[2].indexOf("0") != -1){
                                            var singleVal = datepickerVal[2].split("0");
                                            datepickerVal[2] = singleVal[1];
                                        }
                
                                        dob = datepickerVal[2] + "/" + datepickerVal[1] + "/" + datepickerVal[0];
                                        dob = datepickerVal[0] + "-" + datepickerVal[1] + "-" + datepickerVal[2];
                                    }
            					}
            				}
            				else if(i == "TFN"){
            					tfn = v;
            				}
        			    });
    			    
        			    var link = "";
        			    
        			    //console.log("hey");
        			    if(value.HasPaymentDone == "0"){
        			        payment = "No";
        			    }else{
        			        if(occVal == "AirlineTax"){
            			        link += "http://airlineindustrytaxonline.com.au/";
            			        sendBy = "AirlineTax";
            			        tableName= "tblFormValueAirlineTax";
            			    }else if(occVal == "DefenceForceTax"){
            			        link += "http://defenceforcestaxonline.com.au/";
            			        sendBy = "DefenceTax";
            			        tableName= "tblFormValueDefenceTax";
            			    }else if(occVal == "NurseTax"){
            			        link += "https://nursestaxonline.com.au/";
            			        sendBy = "NurseTax";
            			        tableName= "tblFormValue";
            			    }else if(occVal == "AussieTax"){
            			        link += "https://aussietaxonline.com.au/";
            			        sendBy = "AussieTax";
            			        tableName= "tblFormValueAussieTax";
            			    }else if(occVal == "PoliceTax"){
            			        link += "https://www.policetax.com.au/";
            			        sendBy = "PoliceTax";
            			        tableName= "tblFormValuePoliceTax";
            			    }else if(occVal == "TeachersTax"){
            			        link += "https://teacherstaxonline.com.au/";
            			        sendBy = "TeachersTax";
            			        tableName= "tblFormValueTeachersTax";
            			    }else if(occVal == "TradiesTax"){
            			        link += "http://tradiestaxonline.com.au/";
            			        sendBy = "TradiesTax";
            			        tableName= "tblFormValueTradiesTax";
            			    }
                            
            			    if(packages.toLowerCase().indexOf("budget") != -1){
            			        link += "new-budget-tax.html?returnval=" + value.Id + "&txnid=" + value.BankAuthorization + "&summarycode=1";
            			    }else if(packages.toLowerCase().indexOf("express") != -1){
            			        link += "packages.html?packageName=express&returnval=" + value.Id + "&txnid=" + value.BankAuthorization + "&summarycode=1";
            			    }else if(packages.toLowerCase().indexOf("standard") != -1){
            			        link += "packages.html?packageName=standard&returnval=" + value.Id + "&txnid=" + value.BankAuthorization + "&summarycode=1";
            			    }else if(packages.toLowerCase().indexOf("premium") != -1){
            			        link += "packages.html?packageName=premium&returnval=" + value.Id + "&txnid=" + value.BankAuthorization + "&summarycode=1";
            			    }else if(packages.toLowerCase().indexOf("rental") != -1){
            			        link += "packages.html?packageName=rental&returnval=" + value.Id + "&txnid=" + value.BankAuthorization + "&summarycode=1";
            			    }else if(packages.toLowerCase().indexOf("sole") != -1){
            			        link += "packages.html?packageName=soleTrader&returnval=" + value.Id + "&txnid=" + value.BankAuthorization + "&summarycode=1";
            			    }else if(packages.toLowerCase().indexOf("kids") != -1){
            			        link += "packages.html?packageName=kids&returnval=" + value.Id + "&txnid=" + value.BankAuthorization + "&summarycode=1";
            			    }else if(packages.toLowerCase().indexOf("spouse") != -1){
            			        link += "packages.html?packageName=spouse&returnval=" + value.Id + "&txnid=" + value.BankAuthorization + "&summarycode=1";
            			    }else if(packages.toLowerCase().indexOf("recruit") != -1){
            			        link += "packages.html?packageName=newRecruit&returnval=" + value.Id + "&txnid=" + value.BankAuthorization + "&summarycode=1";
            			    }else if(packages.toLowerCase().indexOf("multi") != -1){
            			        link += "npackages.html?packageName=multiFix&returnval=" + value.Id + "&txnid=" + value.BankAuthorization + "&summarycode=1";
            			    }else{
            			        link = "";
            			    }
        			    }
        			    
        			    if(value.HasFinalSubmit == "0"){
        			        finalSubmit = "No";
        			    }else{
        			        link = "";
        			    }
        			    
        			    if(address.indexOf("select") != -1){
        			        address = "";
        			    }
        			    
        			    if(value.BankAuthorization == ""){
        			        link = "";
        			    }
        			    
        			    if(value.HasExpenses == "0"){
        			        expenses = "No";
                        }
        			    
        			    if(value.HasProcessed == null || value.HasProcessed == "0"){
        			        isProcessed = "No";
                        }
                        
                        var modDateVal = value.ModDate.split("-");
                        var timeVal = modDateVal[2].split(" ");
                        var modifiedDateVal = Date.parse(timeVal[0] + "/" + modDateVal[1] + "/" + modDateVal[0] + " " + timeVal[1]);
                        
                        var editBtn = "<a href='#' val-id='" + value.Id + "' ><i class='fas fa-pen-square'></i></a>";
                        //console.log(editBtn);
        			    
        			 //   console.log(salutationAndName, beenWithUsBefore, dob, address, mobile, email, tfn, payment, finalSubmit, value.ModifiedDate);
        			    var occupation = $(".occupation-data option:selected").text();
        			    
        			    var rawDataValue = "";
        			    
        			    if(value.FileMakerData != null){
        			        rawDataValue = value.FileMakerData.replace(/\s+/g, " ").replace(/^\s|\s$/g, "");
        			    }
        			    
        			    data.push([value.ModDate, value.Week, occupation, isProcessed,  salutationAndName, beenWithUsBefore, dob, address, mobile, email, taxYear, tfn, payment, expenses, finalSubmit, value.Id, value.BankAuthorization, link, rawDataValue]);
                        //console.log(data);
                    }
                    
            	});
            
                $(".overlay").hide();
            	//console.log(data);
            	$('#example1').dataTable({
                    data:           data,
                    order:          [[ 0, "desc" ]],
                    deferRender:    true,
                    scrollY:        400,
                    scrollX:        "100%",
                    scrollX:        true,
                    scrollCollapse: true,
                    scroller:       true,
                    columns:        [
                                        { title: "Date" },
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
                                        { title: "Occupation" },
                                        {"mRender": function ( data, type, row ) {
                                                //console.log(row[13]);
                                                if(row[12] == "Yes" && row[14] == "No"){
                                                    if(row[3] == "No") {
                                                        return row[3] + "<br/> <button id='process-tax' class='process-tax' val-id='" + row[15] + "' url-length='" + row[17] + "' full-name='" + row[4] + "' email-address='" + row[9] + "' ><i class='fa fa-check '></i> Process Tax</button>";
                                                    }else{
                                                        return row[3];
                                                    }
                                                } else {
                                                    return row[3];
                                                }
                                            }
                                        },
                                        { title: "Full Name" },
                                        { title: "Existing Customer" },
                                        { title: "DOB" },
                                        { title: "Address" },
                                        { title: "Mobile" },
                                        { title: "Email" },
                                        { title: "Tax Year" },
                                        { title: "TFN" },
                                        { title: "Payment" },
                                        { title: "Income" },
                                        { title: "Final Submit" },
                                        {"mRender": function ( data, type, row ) {
                                                //console.log(row[13]);
                                                if(row[12] == "Yes" && row[14] == "No"){
                                                    if(row[3] == "No") {
                                                        return "<button id='generate-link' class='generate-link' val-id='" + data + "' url-length='" + row[17] + "' full-name='" + row[4] + "' email-address='" + row[9] + "' ><i class='fa fa-gears '></i> Generate</button><br/><button id='process-tax' class='process-tax' val-id='" + data + "' url-length='" + row[17] + "' full-name='" + row[4] + "' email-address='" + row[9] + "' ><i class='fa fa-check '></i> Process Tax</button><br/><button id='show-detail-tax' class='show-detail-tax' val-id='" + row[15] + "' url-length='" + row[17] + "' full-name='" + row[4] + "' data-address='" + row[18] + "' ><i class='fa fa-eye '></i> Show Detail</button>";
                                                    }else{
                                                        return "<button id='generate-link' class='generate-link' val-id='" + data + "' url-length='" + row[17] + "' full-name='" + row[4] + "' email-address='" + row[9] + "' ><i class='fa fa-gears '></i> Generate</button><br/><button id='show-detail-tax' class='show-detail-tax' val-id='" + row[15] + "' url-length='" + row[17] + "' full-name='" + row[4] + "' data-address='" + row[18] + "' ><i class='fa fa-eye '></i> Show Detail</button>";    
                                                    }
                                                } else {
                                                    return "";
                                                }
                                            }
                                        }
                                    ]
                });
                
               
            });
        }
        
        getAppropriateData();
        getValue();
        
        
                
                
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
                $(".overlay").show();
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
                        url: 'https://www.policetax.com.au/email', // point to server-side PHP script
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: window.continuationURL,
                        type: 'post',
                        success: function(php_script_response){
                            alert("The new continuation URL has been generated and sent to the client.");
                            
                            $(".overlay").hide();
                        }
                    });
                });
            }else{

            }
        });
        $(".filter-data").on("change", function(e){
            e.preventDefault();
            if($(".filter-data option:selected").text() != "Select a Criteria" && $(".occupation-data option:selected").text() != "Select an Occupation"){
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
                
                $(".overlay").show();
                $.post("editData", {id: valId, table: tableName, from: "CreditCardSubmit", processed: "true"}, function(response){
                    alert("Tax for " + fullName + " has been marked as Processed.");
                    
                    $(".overlay").hide();
                    getValue();
                });
            }else{

            }
           
        });
        
        $(document).on("click", ".show-detail-tax", function(e){
            e.preventDefault();
            var jsonData = $(this).attr("data-address").replace("C:\\fakepath\\", "");
            var response = JSON.parse(jsonData);
            var data = "";
            
        	$.each(response, function(index, value){
        	    if(index == "CarKms"){
        	        data += `<p><b>Car Kms and Travel</b></p>`;
        	    }else if(index == "hats_gloves_thermals" || index == "Home Laundry"){
        	        data += `<p><b>Clothing</b></p>`;
        	    }else if(index == "books_references " || index == "Stationary" || index == "union_assoc_fees "){
        	        data += `<p><b>Other Work Related Information</b></p>`;
        	    }else if(index.indexOf("mobile-used") != -1){
        	        data += `<p><b>Mobile + Internet</b></p>`;
        	    }else if(index.indexOf("CapitalItem") != -1){
        	        data += `<p><b>Computer Purchases</b></p>`;
        	    } else if(index == "Employer1"){
    	            data += `<p><b>Income</b></p>`;
    	        } else if (index == "TotalCarKms"){
    	            index = "Total Car deduction Amount($)";
    	        }
    	        
        	    
        	    if(index != "mobile-used" && index != "mobile_monthly_plan_cost" && index != "MobilebyTwelve" && index != "MobileUsage" && index != "internet-used" && index != "internet_monthly_plan_cost" && index != "InternetbyTwelve" && index != "InternetUsage")
        	        data += `<p>${index} : ${value}</p>`;
        	        
    	        if(index == "subtotal-d5.13deductions"){
    	            data += `<p><b>Other</b></p>`;
    	        } else if(index == "BestTime"){
    	            data += `<p><b>More Information</b></p>`;
    	        } else if(index == "bank-account"){
    	            data += `<p><b>Tax Question</b></p>`;
    	        }
        	});
        	
    	    $("#myModal").find(".modal-body").html(data);
            $("#myModal").modal();
        });
        
        $(".occupation-data").on("change", function(e){
            e.preventDefault();
            if($(".occupation-data option:selected").text() != "Select an Occupation" && $(".filter-data option:selected").text() != "Select a Criteria"){
                getValue();
            }else{
                alert("Please select a valid value");
            }
        });
    });
</script>
</body>
</html>
