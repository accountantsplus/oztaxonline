<?php
// Include config file
require_once "php/config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
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
  <h2>Sign Up</h2>
  <p>Please fill this form to create an account.</p>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
          <span class="invalid-feedback"><?php echo $username_err; ?></span>
      </div>    
      <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
          <span class="invalid-feedback"><?php echo $password_err; ?></span>
      </div>
      <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
          <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
      </div>
      <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit">
          <input type="reset" class="btn btn-secondary ml-2" value="Reset">
      </div>
      <p>Already have an account? <a href="index.php">Login here</a>.</p>
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
