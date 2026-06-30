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
  <title>Sales Appointment | AccountantsPlus</title>
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
        Sales Appointment
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales Appointment</li>
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
                              <th>Client Name</th>
                              <th>Address</th>
                              <th>Name</th>
                              <th>Appointment Date</th>
                              <th>Appointment Status</th>
                              <th>Followup Required</th>
                              <th>Call Status</th>
                              <th>Updated Date</th>
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
          <h4 class="modal-title">Sales Appointment</h4>
        </div>
        <form role="form" id="settingForm">
            <input type="hidden" id="packageId" />
            <div class="modal-body">
                <div class="form-group">
                  <label for="clientName">Client</label>
                  <select id="clientName" name="clientName" class="form-control" >
                    <option>Select</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="firstName">First Name</label>
                  <input type="text" name="firstName" class="form-control" id="firstName" required placeholder="Enter First Name" value="" />
                </div>
                <div class="form-group">
                  <label for="lastName">Last Name</label>
                  <input type="text" name="lastName" class="form-control" id="lastName" required placeholder="Enter Last Name" value="" />
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" name="email" class="form-control" id="email" required placeholder="Enter Email" value="" />
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="number" name="phone" class="form-control" id="phone" required placeholder="Enter Phone" value="" />
                </div>
                <div class="form-group">
                  <label for="leadSource">Lead Source</label>
                  <select name="leadSource" class="form-control" id="leadSource">
                      <option value="1" selected>Website</option>
                      <option value="2" >Referral</option>
                      <option value="3">Cold call</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="leadStatus">Lead Status</label>
                  <select name="leadStatus" class="form-control" id="leadStatus">
                      <option value="1" selected>New</option>
                      <option value="2" >Contacted</option>
                      <option value="3">Qualified</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="meetingNotes">Meeting Notes</label>
                  <textarea name="meetingNotes" class="form-control" id="meetingNotes"></textarea>
                </div>
                <div class="form-group">
                  <label for="callStatus">Call Status</label>
                  <select name="callStatus" class="form-control" id="callStatus">
                      <option value="1" selected>Attempted</option>
                      <option value="2" >Connected</option>
                      <option value="3">Left Voicemail</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="appointmentStatus">Appointment Status</label>
                  
                  <select name="appointmentStatus" class="form-control" id="appointmentStatus">
                      <option value="1" selected>Scheduled</option>
                      <option value="2" >Rescheduled</option>
                      <option value="3">Completed</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="appointmentDate">Appointment Date</label>
                  <input type="text" name="appointmentDate" class="form-control" id="appointmentDate" placeholder="Enter Appointment Date" value="" />
                </div>
                <div class="form-group">
                  <label for="followupNotes">Follow up Notes</label>
                  <textarea name="followupNotes" class="form-control" id="followupNotes"></textarea>
                </div>
                <div class="form-group">
                  <label for="isFollowUpRequired">Follow Up Required</label>
                  <input type="checkbox" name="isFollowUpRequired" id="isFollowUpRequired" />
                </div>
                <div class="form-group">
                  <label for="followupDate">Followup Date</label>
                  <input type="text" name="followupDate" class="form-control" id="followupDate" placeholder="Enter FollowUp Date" value="" />
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
            firstName: {
              required: true
            },
            lastName: {
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
            $.post("getAllSales", function(response){
                response = JSON.parse(response);
            	var highlightedData = "";
            	$.each(response.aaData, function(index, value){
    			    
    			 //   console.log(salutationAndName, beenWithUsBefore, dob, address, mobile, email, tfn, payment, finalSubmit, value.ModifiedDate);
    			 //console.log(value.TotalCount);
    			    if(value.TotalCount == "" || value.TotalCount == null){
    			        value.TotalCount = 0;
    			    }
    			    
    			    var fullName = value.FirstName + " " + value.LastName;
    			    
    			    var isFollowUp = 'No';
    			    
    			    if(value.IsFollowUpRequired == 1){
    			        isFollowUp = 'Yes';
    			    }
    			    var appointmentStatus = '';
    			    
    			    if(value.AppointmentStatus == "1"){
    			        appointmentStatus = 'Scheduled';
    			    }else if(value.AppointmentStatus == "2"){
    			        appointmentStatus = 'Rescheduled';
    			    }else if(value.AppointmentStatus == "3"){
    			        appointmentStatus = 'Completed';
    			    }
    			    var callStatus = '';
    			    
    			    if(value.CallStatus == "1"){
    			        callStatus = 'Attempted';
    			    }else if(value.CallStatus == "2"){
    			        callStatus = 'Connected';
    			    }else if(value.CallStatus == "3"){
    			        callStatus = 'Left Voicemail';
    			    }
    			    data.push([value.ClientName, value.Address, fullName, value.AppointmentDate, appointmentStatus, isFollowUp, callStatus, value.UpdatedDate, value.Id]);
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
                                        { title: "Client Name" },
                                        { title: "Address" },
                                        { title: "Name" },
                                        { title: "Appointment Date" },
                                        { title: "Appointment Status" },
                                        { title: "Followup Required" },
                                        { title: "Call Status" },
                                        { title: "Updated Date" },
                                        {"mRender": function ( data, type, row ) {
                                                
                                            return "<button class='btnEdit' val-id='" + row[8] + "' ><i class='fa fa-edit'></i> Edit</button>&nbsp;&nbsp; <button class='btnDelete' val-id='" + row[8] + "' ><i class='fa fa-trash'></i> Delete</button>";
                                            }
                                        }
                                    ]
                });
                
                
                
                    
                $.post("getAllSalesClient", function(response){
                    response = JSON.parse(response);
                	var highlightedData = "";
                	
                	$('#clientName')
                        .find('option')
                        .remove()
                        .end().append('<option value="select" selected>Select</option>');
                        
                	$.each(response.aaData, function(index, value){
                	    $('#clientName').append($("<option />").val(value.Id).text(value.CompanyName));
                	});
                });
        
                $(document).on("click", ".btnEdit", function(e){
                    e.preventDefault();
                    var settingId = $(this).attr("val-id");
                    $("#myModal").find("#packageId").val("");
                    $("#myModal").find("#firstName").val("");
                    $("#myModal").find("#lastName").val("");
                    $("#myModal").find("#email").val("");
                    $("#myModal").find("#phone").val("");
                    $("#myModal").find("#leadSource").val("");
                    $("#myModal").find("#leadStatus").val("");
                    $("#myModal").find("#meetingNotes").val("");
                    $("#myModal").find("#callStatus").val("");
                    $("#myModal").find("#appointmentStatus").val("");
                    $("#myModal").find("#followupNotes").val("");
                    $("#myModal").find("#isFollowUpRequired").prop("checked", false);
                    $("#myModal").find("#communicationPreference").val("");
                    $("#myModal").find("#appointmentDate").val("");
                    $("#myModal").find("#notes").val("");
            	    $("#myModal").find("#followupDate").val("");
                    
                    
                    $.post("getSales", {id: settingId}, function(response){
                        response = JSON.parse(response);
                    	$.each(response.result, function(index, value){
                            $("#myModal").find("#packageId").val(value.Id);
                            $("#myModal").find("#clientName").val(value.SalesClientId);
                            $("#myModal").find("#firstName").val(value.FirstName);
                            $("#myModal").find("#lastName").val(value.LastName);
                            $("#myModal").find("#email").val(value.Email);
                            $("#myModal").find("#phone").val(value.Phone);
                            $("#myModal").find("#leadSource").val(value.LeadSource);
                            $("#myModal").find("#leadStatus").val(value.LeadStatus);
                            $("#myModal").find("#meetingNotes").val(value.MeetingNotes);
                            $("#myModal").find("#callStatus").val(value.CallStatus);
                            $("#myModal").find("#appointmentStatus").val(value.AppointmentStatus);
                            $("#myModal").find("#followupNotes").val(value.FollowupNotes);
                            
                            if(value.IsFollowUpRequired == "1"){
                                
                                $("#myModal").find("#isFollowUpRequired").prop("checked", true);
                            }
                            $("#myModal").find("#communicationPreference").val(value.CommunicationPreference);
                            $("#myModal").find("#appointmentDate").val(value.AppointmentDate);
                            $("#myModal").find("#notes").val(value.Notes);
                    	    $("#myModal").find("#followupDate").val(value.FollowUpDate);

                          
                            $('#appointmentDate').datetimepicker({
                                format: 'YYYY-MM-DD'
                            });
                            $('#followupDate').datetimepicker({
                                format: 'YYYY-MM-DD'
                            });
                    	});
                    });
                    
                    $("#myModal").find(".modal-title").html("Edit Sales Appointment");
                    $("#myModal").modal();
                });
                
                $(document).find(".btnDelete").on("click", function(e){
                    e.preventDefault();
                    var settingId = $(this).attr("val-id");
                    if(confirm("Are you sure you want to delete this Sales Appointment?")){
                        $.post("deleteSales", {id: settingId}, function(response){
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
            $("#myModal").find("#packageId").val("");
            $("#myModal").find("#firstName").val("");
            $("#myModal").find("#lastName").val("");
            $("#myModal").find("#email").val("");
            $("#myModal").find("#phone").val("");
            $("#myModal").find("#leadSource").val("");
            $("#myModal").find("#leadStatus").val("");
            $("#myModal").find("#meetingNotes").val("");
            $("#myModal").find("#callStatus").val("");
            $("#myModal").find("#appointmentStatus").val("");
            $("#myModal").find("#followupNotes").val("");
            $("#myModal").find("#isFollowUpRequired").prop("checked", false);
            $("#myModal").find("#communicationPreference").val("");
            $("#myModal").find("#appointmentDate").val("");
            $("#myModal").find("#notes").val("");
    	    $("#myModal").find("#followupDate").val("");

            
            $('#appointmentDate').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#followupDate').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            
            $.post("getAllSalesClient", function(response){
                response = JSON.parse(response);
            	var highlightedData = "";
            	
            	$('#clientName')
                    .find('option')
                    .remove()
                    .end().append('<option value="select" selected>Select</option>');
                    
            	$.each(response.aaData, function(index, value){
            	    $('#clientName').append($("<option />").val(value.Id).text(value.CompanyName));
            	});
            });
            $("#myModal").find(".modal-title").html("Add Sales Appointment");
            $("#myModal").modal();
        });
        
        $(".btn-save").on("click", function(e){
            e.preventDefault();
            
            if($("#settingForm").valid()){
                
                var isFollowUpRequired = 0;
                if($("#isFollowUpRequired").is(":checked")){
                    isFollowUpRequired = 1;
                }
                
                var data = {
                  id: $("#packageId").val(),
                  salesClientId: $("#clientName option:selected").val(),
                  firstName: $("#firstName").val(),
                  lastName: $("#lastName").val(),
                  email: $("#email").val(),
                  phone: $("#phone").val(),
                  leadSource: $("#leadSource").val(),
                  leadStatus: $("#leadStatus").val(),
                  meetingNotes: $("#meetingNotes").val(),
                  callStatus: $("#callStatus").val(),
                  appointmentStatus: $("#appointmentStatus").val(),
                  followupNotes: $("#followupNotes").val(),
                  isFollowUpRequired: isFollowUpRequired,
                  communicationPreference: $("#communicationPreference").val(),
                  appointmentDate: $("#appointmentDate").val(),
                  notes: $("#notes").val(),
                  followupDate: $("#followupDate").val()
                };
                
                $.post("saveSales", data, function(response){
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
