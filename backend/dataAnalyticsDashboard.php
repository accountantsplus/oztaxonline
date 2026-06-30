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
  <title>Settings | AccountantsPlus</title>
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
        Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!--<div class="row">-->
        <!--    <div class="pull-right" style="margin-right:20px;">-->
        <!--      <button id='btnAdd' ><i class='fa fa-plus'></i> Add</button>-->
        <!--    </div>-->
        <!--</div><br/>-->
      <div class="box box-default">
        <div class="row">
            <div class="col-xs-12">
                
                <div class="box">
                <div class="box-header">
                  <!--<h3 class="box-title">Data Table With Full Features</h3>-->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                   <div class="col-md-6" style="width:100%">
                    <div class="panel with-nav-tabs panel-primary">
                        <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                    <!--<li class="active"><a href="#tab1primary" data-toggle="tab">Historical</a></li> -->
                                    <!--<li class="active"><a href="#tab1primary" data-toggle="tab">Revenue, Expenses & Profit</a></li> -->
                                    
                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown">Historical<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                         
                                            <li><a href="#tab1primary" data-toggle="tab">Financial Data</a></li>
                                            <ul class="dropdown-submenu" role="submenu">
                                                <li><a href="#tab9primary" data-toggle="tab">Revenue</a></li>
                                                <li><a href="#tab10primary" data-toggle="tab">Expense</a></li>
                                                <li><a href="#tab11primary" data-toggle="tab">Profit</a></li>
                                            </ul>
                                            
                                            <li><a href="#tab12primary" data-toggle="tab">ITR Services Used</a></li>
                                            <ul class="dropdown-submenu" role="submenu">
                                                <li><a href="#tab14primary" data-toggle="tab">Yearly qty ITR</a></li>
                                                <li><a href="#tab15primary" data-toggle="tab">Yearly ITR Fees Generated</a></li>
                                            </ul>
                                            
                                        </ul>
                                    </li>
                                    
                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown">Current 2019 Financial Year<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#tab4primary" data-toggle="tab">Current Week</a></li>
                                            <li><a href="#tab5primary" data-toggle="tab">Cummul. Weekly ytd</a></li>
                                        </ul>
                                    </li>
                                    
                                    <li><a href="#tab3primary" data-toggle="tab">Clients Across Australia</a></li>
                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown">Other Reports<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#tab4primary" data-toggle="tab">Online Tax Lodgements</a></li>
                                            <li><a href="#tab5primary" data-toggle="tab">Daily, Weekly & Monthly Reports</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown">Projects & Models<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#tab6primary" data-toggle="tab">CRM Funnel</a></li>
                                            <li><a href="#tab7primary" data-toggle="tab">Sales Target</a></li>
                                            <li><a href="#tab8primary" data-toggle="tab">Budget 2020</a></li>
                                            <li><a href="#tab9primary" data-toggle="tab">APG - Staff/ IT Resources Evolution</a></li>
                                            <li><a href="#tab10primary" data-toggle="tab">APG - Client Evolution</a></li>
                                        </ul>
                                    </li>
                                </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1primary" style="text-align:center">
                                    <iframe height="850" src="https://datastudio.google.com/embed/reporting/1lYtVyJbvHinLF_ebdY7RMrUxAxDh-gox/page/CeCt" frameborder="0" allowfullscreen="" style="width:70%; border: 0; left: 0; top:0"></iframe>
                                </div>
                                <div class="tab-pane fade" id="tab2primary" style="text-align:center">
                                    <iframe width="70%" height="850" src="https://datastudio.google.com/embed/reporting/1F2beKNbdQ-j3sReenRschlHa85C_vMMQ/page/ls5s" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                                <div class="tab-pane fade" id="tab3primary">
                                    <div class='tableauPlaceholder' id='viz1561505162339' style='position: relative'><noscript><a href='#'><img alt=' ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;67&#47;67BJM4CJ2&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='path' value='shared&#47;67BJM4CJ2' /> <param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;67&#47;67BJM4CJ2&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1561505162339');                    var vizElement = divElement.getElementsByTagName('object')[0];                    if ( divElement.offsetWidth > 800 ) { vizElement.style.width='1000px';vizElement.style.height='827px';} else if ( divElement.offsetWidth > 500 ) { vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';} else { vizElement.style.width='100%';vizElement.style.height='1327px';}                     var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
                                </div>
                                <div class="tab-pane fade" id="tab4primary">Coming soon...</div>
                                <div class="tab-pane fade" id="tab5primary">Coming soon...</div>
                                <div class="tab-pane fade" id="tab6primary" style="text-align:center">
                                    <img src="images/CRM Funnel Horizontal.jpg" alt="CRM Funnel Diagram" allowfullscreen="" style="width:100%; border: 0; left: 0; top:0"/>
                                </div>
                                <div class="tab-pane fade" id="tab7primary" style="text-align:center">
                                    <img src="images/Forecast.png" alt="Sales target for the fiscal year 2020" allowfullscreen="" style="width:70%; border: 0; left: 0; top:0"/>
                                </div>
                                <div class="tab-pane fade" id="tab8primary" style="text-align:center">
                                    <img src="images/Budget2020.jpg" alt="Budget for the fiscal year 2020" allowfullscreen="" style="width:70%; border: 0; left: 0; top:0"/>
                                </div>
                                <div class="tab-pane fade" id="tab9primary" style="text-align:center">Coming Soon...</div>
                                <div class="tab-pane fade" id="tab10primary" style="text-align:center">
                                    <img src="images/ClientGrowth.jpg" alt="Client Growth" allowfullscreen="" style="width:90%; border: 0; left: 0; top:0"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    });

</script>
</body>
</html>
