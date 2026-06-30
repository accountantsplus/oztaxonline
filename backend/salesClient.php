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
  <title>Sales Client | AccountantsPlus</title>
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
    
    img{
        object-fit: cover;
  width: 100px;
  height: 100px;
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
        Prospect
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Prospect</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="pull-right" style="margin-right:20px;">
              <button id='btnAdd' ><i class='fa fa-plus'></i> Add</button>
            </div>
        </div><br/>
      <div class="box box-default"><div class="box-header with-border">
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
                <label>Search</label>
                <input type="text" class="form-control client-data" placeholder="Client Name / CEO's Name">
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Potential Business</label>
                <select class="form-control select2 filter-data" style="width: 100%;">
                  <option value="">Select...</option>
                  <option value="1">All</option>
                  <option value="2">Yes</option>
                  <option value="3">No</option>
                </select>
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-2">
              <div class="form-group" style="margin-top: 25px;">
                <a href="#" class="search-btn btn btn-primary" title="Search" style="color:black;"><i class="fa fa-search"></i></a>
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
                              <th>CEO's Name</th>
                              <th>Client Name</th>
                              <th>Address</th>
                              <th>Suburb</th>
                              <th>State</th>
                              <th>Industry</th>
                              <th>Potential Business</th>
                              <th>Notes</th>
                              <th>Created Date</th>
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
          <h4 class="modal-title">Sales Client</h4>
        </div>
        <form role="form" id="settingForm">
            <input type="hidden" id="packageId" />
            <div class="modal-body">
                <div class="form-group">
                  <label for="name">CEO's Name</label>
                  <input type="text" name="name" class="form-control" id="name" required placeholder="Enter Name" value="" />
                </div>
                <div class="form-group">
                  <label for="companyName">Company Name</label>
                  <input type="text" name="companyName" class="form-control" id="companyName" required placeholder="Enter Company Name" value="" />
                </div>
                <div class="form-group">
                  <label for="companyLogo">Company Logo</label>
                  <input type="file" class="form-control" name="companyLogo" id="companyLogo">
                </div>
                
                <div class="form-group">
                  <label></label>
                  <img src="" id="companyLogoImg" />
                </div>
                <div class="form-group">
                  <label for="ceoPicture">CEO's picture</label>
                  <input type="file" class="form-control" name="ceoPicture" id="ceoPicture">
                </div>
                
                <div class="form-group">
                  <label></label>
                  <img src="" id="ceoPictureImg" />
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" value="" />
                </div>
                <div class="form-group">
                  <label for="suburb">Suburb</label>
                  <input type="text" name="suburb" class="form-control" id="suburb" placeholder="Enter Suburb" value="" />
                </div>
                <div class="form-group">
                  <label for="postCode">Post Code</label>
                  <input type="number" name="postCode" class="form-control" id="postCode" placeholder="Enter Post Code" value="" />
                </div>
                <div class="form-group">
                  <label for="state">State</label>
                  <input type="text" name="state" class="form-control" id="state" placeholder="Enter State" value="" />
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" value="" />
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="number" name="phone" class="form-control" id="phone" placeholder="Enter Phone" value="" />
                </div>
                <div class="form-group">
                  <label for="industry">Industry</label>
                  <input type="text" name="industry" class="form-control" id="industry" placeholder="Enter Industry" value="" />
                </div>
                <div class="form-group">
                  <label for="potentialBusiness">Potential Business</label>
                  <select name="potentialBusiness" class="form-control" id="potentialBusiness">
                      <option value="1">All</option>
                      <option value="2" selected>Yes</option>
                      <option value="3">No</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="isSendEmail">Is Send Email</label>
                  <input type="checkbox" name="isSendEmail" id="isSendEmail" />
                </div>
                <div class="form-group">
                  <label for="communicationPreference">Communication Preference</label>
                  <select name="communicationPreference" class="form-control" id="communicationPreference">
                      <option value="1">Email</option>
                      <option value="2" selected>Phone</option>
                      <option value="3">SMS</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="notes">Notes</label>
                  <textarea name="notes" class="form-control" id="notes"></textarea>
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
            name: {
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
            var clientVal = $(".client-data").val();
            $.post("getAllSalesClient", {clientSearch: clientVal, filter: filterVal}, function(response){
                response = JSON.parse(response);
            	var highlightedData = "";
            	$.each(response.aaData, function(index, value){
    			    
    			 //   console.log(salutationAndName, beenWithUsBefore, dob, address, mobile, email, tfn, payment, finalSubmit, value.ModifiedDate);
    			 //console.log(value.TotalCount);
    			    if(value.TotalCount == "" || value.TotalCount == null){
    			        value.TotalCount = 0;
    			    }
    			    var potentialBusiness = '';
    			    
    			    if(value.PotentialBusiness == "1"){
    			        potentialBusiness = 'All';
    			    }else if(value.PotentialBusiness == "2"){
    			        potentialBusiness = 'Yes';
    			    }else if(value.PotentialBusiness == "3"){
    			        potentialBusiness = 'No';
    			    }
    			    data.push([value.Name, value.CompanyName, value.Address, value.Suburb, value.State, value.Industry, potentialBusiness, value.Notes, value.CreatedDate, value.Id]);
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
                                        { title: "CEO's Name" },
                                        { title: "Company Name" },
                                        { title: "Address" },
                                        { title: "Suburb" },
                                        { title: "State" },
                                        { title: "Industry" },
                                        { title: "Potential Business" },
                                        {"mRender": function ( data, type, row ) {
                                                
                                            return "<a href='#' style='color:black;' title='" + row[7] + "'><i class='fa fa-info-circle'></i> </a>";
                                            }
                                        },
                                        { title: "Updated Date" },
                                        {"mRender": function ( data, type, row ) {
                                                
                                            return "<button class='btnEdit' val-id='" + row[9] + "' ><i class='fa fa-edit'></i> Edit</button>&nbsp;&nbsp; <button class='btnDelete' val-id='" + row[9] + "' ><i class='fa fa-trash'></i> Delete</button>";
                                            }
                                        }
                                    ]
                });
                
                
        
                $(document).on("click", ".btnEdit", function(e){
                    e.preventDefault();
                    var settingId = $(this).attr("val-id");
                    $("#myModal").find("#packageId").val("");
                    $("#myModal").find("#name").val("");
                    $("#myModal").find("#companyName").val("");
                    $("#myModal").find("#address").val("");
                    $("#myModal").find("#suburb").val("");
                    $("#myModal").find("#postCode").val("");
                    $("#myModal").find("#state").val("");
                    $("#myModal").find("#country").val("");
                    $("#myModal").find("#phone").val("");
                    $("#myModal").find("#email").val("");
                    $("#myModal").find("#industry").val("");
                    $("#myModal").find("#notes").val("");
                    $("#myModal").find("#companyLogo").val("");
                    $("#myModal").find("#ceoPicture").val("");
                    $("#myModal").find("#potentialBusiness").val("");
                    $("#myModal").find("#companyLogoImg").attr("src", "");
                    $("#myModal").find("#ceoPictureImg").attr("src", "");
                    $("#myModal").find("#isSendEmail").prop("checked", false);
                    $("#myModal").find("#communicationPreference").val("");
                    
                    
                    $.post("getSalesClient", {id: settingId}, function(response){
                        response = JSON.parse(response);
                    	$.each(response.result, function(index, value){
                            $("#myModal").find("#packageId").val(value.Id);
                            $("#myModal").find("#name").val(value.Name);
                            $("#myModal").find("#companyName").val(value.CompanyName);
                            $("#myModal").find("#address").val(value.Address);
                            $("#myModal").find("#suburb").val(value.Suburb);
                            $("#myModal").find("#postCode").val(value.Postcode);
                            $("#myModal").find("#state").val(value.State);
                            $("#myModal").find("#country").val(value.Country);
                            $("#myModal").find("#phone").val(value.Phone);
                            $("#myModal").find("#email").val(value.Email);
                            $("#myModal").find("#potentialBusiness").val(value.PotentialBusiness);
                            $("#myModal").find("#industry").val(value.Industry);
                            $("#myModal").find("#notes").val(value.Notes);
                            $("#myModal").find("#companyLogoImg").attr("src", value.CompanyLogo);
                            $("#myModal").find("#ceoPictureImg").attr("src", value.CEOPicture);
                            //$("#myModal").find("#isSendEmail").val(value.IsSendEmail);
                            
                            if(value.IsSendEmail == "1"){
                                
                                $("#myModal").find("#isSendEmail").prop("checked", true);
                            }
                            
                            $("#myModal").find("#communicationPreference").val(value.CommunicationPreference);

                          
                    	});
                    });
                    
                    $("#myModal").find(".modal-title").html("Edit Sales Client");
                    $("#myModal").modal();
                });
                
                $(document).find(".btnDelete").on("click", function(e){
                    e.preventDefault();
                    var settingId = $(this).attr("val-id");
                    if(confirm("Are you sure you want to delete this Sales Client?")){
                        $.post("deleteSalesClient", {id: settingId}, function(response){
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
        $(".search-btn").on("click", function(e){
            e.preventDefault();
            if($(".filter-data option:selected").val() != "" || $(".client-data").val() != ""){
                
            } 
            getValue();
        });
        
        $("#btnAdd").on("click", function(e){
            e.preventDefault();
            $("#myModal").find("#packageId").val("");
            $("#myModal").find("#name").val("");
            $("#myModal").find("#companyName").val("");
            $("#myModal").find("#address").val("");
            $("#myModal").find("#suburb").val("");
            $("#myModal").find("#postCode").val("");
            $("#myModal").find("#state").val("");
            $("#myModal").find("#country").val("");
            $("#myModal").find("#phone").val("");
            $("#myModal").find("#email").val("");
            $("#myModal").find("#industry").val("");
            $("#myModal").find("#potentialBusiness").val("");
            $("#myModal").find("#notes").val("");
            $("#myModal").find("#companyLogo").val("");
            $("#myModal").find("#companyLogoImg").attr("src", "");
            $("#myModal").find("#ceoPictureImg").attr("src", "");
            $("#myModal").find("#ceoPicture").val("");
            $("#myModal").find("#isSendEmail").prop("checked", false);
            
            $("#myModal").find("#communicationPreference").val("");

            $("#myModal").find(".modal-title").html("Add Sales Client");
            $("#myModal").modal();
        });
        
        $(".btn-save").on("click", function(e){
            e.preventDefault();
            
            if($("#settingForm").valid()){
                
                var isSendEmail = 0;
                if($("#isSendEmail").is(":checked")){
                    isSendEmail = 1;
                }
                
                var data = {
                  id: $("#packageId").val(),
                  name: $("#name").val(),
                  address: $("#address").val(),
                  email: $("#email").val(),
                  phone: $("#phone").val(),
                  suburb: $("#suburb").val(),
                  postCode: $("#postCode").val(),
                  state: $("#state").val(),
                  country: $("#country").val(),
                  industry: $("#industry").val(),
                  companyName: $("#companyName").val(),
                  potentialBusiness: $("#potentialBusiness").val(),
                  notes: $("#notes").val(),
                  isSendEmail: isSendEmail,
                  communicationPreference: $("#communicationPreference").val()
                };
                
                var file_data = $('#companyLogo').prop('files')[0]; 
                var file_dataceoPicture = $('#ceoPicture').prop('files')[0];  
                var form_data = new FormData();                  
                form_data.append('id', data.id);           
                form_data.append('name', data.name);           
                form_data.append('address', data.address);           
                form_data.append('email', data.email);           
                form_data.append('phone', data.phone);           
                form_data.append('suburb', data.suburb);           
                form_data.append('postCode', data.postCode);           
                form_data.append('state', data.state);           
                form_data.append('country', data.country);           
                form_data.append('industry', data.industry);           
                form_data.append('companyName', data.companyName);           
                form_data.append('potentialBusiness', data.potentialBusiness);           
                form_data.append('notes', data.notes);           
                form_data.append('isSendEmail', data.isSendEmail);           
                form_data.append('communicationPreference', data.communicationPreference);           
                form_data.append('file', file_data);          
                form_data.append('ceoPicture', file_dataceoPicture);         
                form_data.append('fileName', $("#myModal").find("#companyLogoImg").attr("src"));          
                form_data.append('ceoPictureName', $("#myModal").find("#ceoPictureImg").attr("src"));
                
                $.ajax({
                    url: 'saveSalesClient', // <-- point to server-side PHP script 
                    dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,                         
                    type: 'post',
                    success: function(response){
                        response = JSON.parse(response);
                        if(response[0] == "true"){
                            $("#myModal").modal('hide');
                            getValue();
                        }
                    }
                });
                
                
            }
        });
    });
</script>
</body>
</html>
