<?php
// Initialize the session
if(!isset($_SESSION)) session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "php/config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>

  <title>Homepage</title>
  <meta charset="utf-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">

  <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="./css/bootstrap/bootstrap-theme.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/home.css">
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
      <a class="navbar-brand" href="index.php">
        <img src="./images/policetax.png" alt="logo">
        <span class="css-brand-text">Tax Status</span>
      </a>
    </div>

  </div><!-- /.container-fluid -->
</nav>

<!-- Content area - menu -->
<div class="row css-toprow css-contentarea">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <h2>Reset Password</h2>
  <p>Please fill out this form to reset your password.</p>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
      <div class="form-group">
          <label>New Password</label>
          <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
          <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
      </div>
      <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
          <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
      </div>
      <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit">
          <a class="btn btn-link ml-2" href="index.php">Cancel</a>
      </div>
  </form>
</div>
<div class="row css-toprow css-contentarea">
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

<script type="text/javascript" src="./js/jquery/jquery-1.11.1.js"></script>
<script type="text/javascript" src="./js/bootstrap/bootstrap.min.js"></script>


</body>
</html>
