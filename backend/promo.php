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
  <title>Promo Code | AccountantsPlus</title>
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
        Promo Code
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Promo Code</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="pull-right" style="margin-right:20px;">
              <button id='btnAdd' ><i class='fa fa-plus'></i> Add</button>
            </div>
        </div><br/>
      <div class="box box-default">
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
                              <th>Occupation Name</th>
                              <th>Name</th>
                              <th>Code</th>
                              <th>Discount % / Price</th>
                              <th>Total Number</th>
                              <th>Total Applied Count</th>
                              <th>Applied Date</th>
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
          <h4 class="modal-title">Setting</h4>
        </div>
        <form role="form" id="settingForm">
            <input type="hidden" id="packageId" />
            <div class="modal-body">
                <div class="form-group">
                  <label for="occupationName">Occupation Name</label>
                  <select id="occupationName" name="occupationName" class="form-control" >
                    <option>Select</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="fieldName">Field Name</label>
                  <input type="text" name="fieldName" class="form-control" id="fieldName" required placeholder="Enter Field Name" value="" />
                </div>
                <div class="form-group">
                  <label for="fieldPrice">Discount %</label>
                  <input type="number" name="fieldPrice" class="form-control" required id="fieldPrice" placeholder="Enter Price" value="" />
                </div>
                <div class="form-group">
                  <label for="fieldCode">Code</label>
                  <input type="text" name="fieldCode" class="form-control" required id="fieldCode" placeholder="Enter Code" value="" />
                </div>
                <div class="form-group">
                  <label for="fieldTotalNumber">Total Number</label>
                  <input type="number" name="fieldTotalNumber" class="form-control" required id="fieldTotalNumber" placeholder="Enter Total Number" value="" />
                </div>
                <div class="form-group">
                  <label for="fieldAppliedDate">Applied Date</label>
                  <input type="text" name="fieldAppliedDate" class="form-control" required id="fieldAppliedDate" placeholder="Enter Applied Date" value="" />
                </div>
                <div class="form-group">
                  <label for="fieldExpiryDate">Expiry Date</label>
                  <input type="text" name="fieldExpiryDate" class="form-control" id="fieldExpiryDate" placeholder="Enter Expiry Date" value="" />
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary btn-save">Save</button>
            </div>
        </form>
      </div>
      
    </div>
</div>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
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
<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
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
        
        
        jQuery.validator.setDefaults({
          debug: true,
          success: "valid"
        });
        
        
        $("#settingForm").validate({
          rules: {
            fieldName: {
              required: true
            },
            fieldPrice: {
              required: true
            },
            fieldCode: {
              required: true
            },
            fieldTotalNumber: {
              required: true
            },
            fieldAppliedDate: {
              required: true
            }
          }
        });
    //   $('#myModal').modal('show');
    });
    $(function () {
        var getValue = function(){
            var data = [];
            $('#example1').dataTable().fnClearTable();
            $('#example1').dataTable().fnDestroy();
        
            var filterVal = $(".filter-data option:selected").val();
            var occVal = $(".occupation-data option:selected").val();
            $.post("promoCode", function(response){
                response = JSON.parse(response);
            	var highlightedData = "";
            	$.each(response.aaData, function(index, value){
    			    
    			 //   console.log(salutationAndName, beenWithUsBefore, dob, address, mobile, email, tfn, payment, finalSubmit, value.ModifiedDate);
    			 //console.log(value.TotalCount);
    			    if(value.TotalCount == "" || value.TotalCount == null){
    			        value.TotalCount = 0;
    			    }
    			    data.push([value.OccupationName, value.Name, value.Code, value.Price, value.TotalNumber, value.TotalCount, value.AppliedDate, value.Id]);
                    //console.log(data);
            	});
            	//console.log(data);
            	$('#example1').dataTable({
                    data:           data,
                    deferRender:    true,
                    scrollY:        400,
                    scrollX:        "100%",
                    scrollX:        true,
                    scrollCollapse: true,
                    scroller:       true,
                    columns:        [
                                        { title: "Occupation Name" },
                                        { title: "Name" },
                                        { title: "Code" },
                                        { title: "Discount %" },
                                        { title: "Total Number" },
                                        { title: "Total Applied Number" },
                                        { title: "Applied Date" },
                                        {"mRender": function ( data, type, row ) {
                                                
                                            return "<button class='btnEdit' val-id='" + row[7] + "' ><i class='fa fa-edit'></i> Edit</button>&nbsp;&nbsp; <button class='btnDelete' val-id='" + row[7] + "' ><i class='fa fa-trash'></i> Delete</button>";
                                            }
                                        }
                                    ]
                });
                
                
                
                    
                $.post("getSettingOccupation", function(response){
                    response = JSON.parse(response);
                	var highlightedData = "";
                	
                	$('#occupationName')
                        .find('option')
                        .remove()
                        .end().append('<option value="select" selected>Select</option>');
                        
                	$.each(response.result, function(index, value){
                	    $('#occupationName').append($("<option />").val(value.Id).text(value.Name));
                	});
                });
        
                $(document).on("click", ".btnEdit", function(e){
                    e.preventDefault();
                    var settingId = $(this).attr("val-id");
                    $("#myModal").find("#fieldName").val("");
                    $("#myModal").find("#fieldCode").val("");
                    $("#myModal").find("#fieldPrice").val("");
                    $("#myModal").find("#fieldTotalNumber").val("");
                    $("#myModal").find("#fieldAppliedDate").val("");
                    $("#myModal").find("#fieldExpiryDate").val("");
                    
                    
                    $.post("getPromoCode", {id: settingId}, function(response){
                        response = JSON.parse(response);
                    	$.each(response.result, function(index, value){
                    	    $("#myModal").find("#packageId").val(value.Id);
                    	    $("#myModal").find("#fieldName").val(value.Name);
                    	    $("#myModal").find("#fieldCode").val(value.Code);
                    	    $("#myModal").find("#fieldPrice").val(value.Price);
                    	    $("#myModal").find("#fieldTotalNumber").val(value.TotalNumber);
                    	    $("#myModal").find("#fieldAppliedDate").val(value.AppliedDate);
                    	    $("#myModal").find("#occupationName").val(value.OccupationId);
                    	    $("#myModal").find("#fieldExpiryDate").val(value.ExpiryDate);

                          
                        $('#fieldAppliedDate').datetimepicker({
                            format: 'YYYY-MM-DD'
                        });
                        $('#fieldExpiryDate').datetimepicker({
                            format: 'YYYY-MM-DD'
                        });
                    	});
                    });
                    
                    $("#myModal").find(".modal-title").html("Edit Promo Code");
                    $("#myModal").modal();
                });
                
                $(document).find(".btnDelete").on("click", function(e){
                    e.preventDefault();
                    var settingId = $(this).attr("val-id");
                    if(confirm("Are you sure you want to delete this Promo Code?")){
                        $.post("deletePromoCode", {id: settingId}, function(response){
                            response = JSON.parse(response);
                            if(response[0] == "true"){
                                alert("Successfully Deleted!");
                                getValue();
                            }
                        });
                    }
                });
               
            });
        }
        
        getValue();
        
        $("#btnAdd").on("click", function(e){
            e.preventDefault();
            $("#myModal").find("#fieldName").val("");
            $("#myModal").find("#fieldCode").val("");
            $("#myModal").find("#fieldPrice").val("");
            $("#myModal").find("#fieldTotalNumber").val("");
            $("#myModal").find("#fieldAppliedDate").val("");
            $("#myModal").find("#packageId").val("");
            $("#myModal").find("#fieldExpiryDate").val("");

            
            $('#fieldAppliedDate').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            
            $('#fieldExpiryDate').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            
            $.post("getSettingOccupation", function(response){
                response = JSON.parse(response);
            	var highlightedData = "";
            	
            	$('#occupationName')
                    .find('option')
                    .remove()
                    .end().append('<option value="select" selected>Select</option>');
                    
            	$.each(response.result, function(index, value){
            	    $('#occupationName').append($("<option />").val(value.Id).text(value.Name));
            	});
            });
            $("#myModal").find(".modal-title").html("Add Promo Code");
            $("#myModal").modal();
        });
        
        $(".btn-save").on("click", function(e){
            e.preventDefault();
            
            if($("#settingForm").valid()){
                
                
                var data = {
                  id: $("#packageId").val(),
                  occupationId: $("#occupationName option:selected").val(),
                  fieldName: $("#fieldName").val(),
                  fieldPrice: $("#fieldPrice").val(),
                  fieldCode: $("#fieldCode").val(),
                  fieldTotalNumber: $("#fieldTotalNumber").val(),
                  fieldAppliedDate: $("#fieldAppliedDate").val(),
                  fieldExpiryDate: $("#fieldExpiryDate").val()
                };
                
                $.post("savePromoCode", data, function(response){
                    response = JSON.parse(response);
                    if(response[0] == "true"){
                        $("#myModal").modal('hide');
                        getValue();
                    }
                });
            }
        });
        
        $(document).find(".occupation-data").on("change", function(e){
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
