<?php
// Include config file
require_once "Config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a email address.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM Loginform WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO Loginform (username, password) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: Login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>


    <meta name="robots" content="index,follow">
    <link href="../favicon.png" rel="icon" type="image/png" /><!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" /><!-- Animate Min CSS -->
    <link href="assets/css/animate.css" rel="stylesheet" /><!-- IcoFont CSS -->
    <link href="assets/css/icofont.min.css" rel="stylesheet" /><!-- Owl Carousel CSS -->
    <link href="assets/css/owl.carousel.css" rel="stylesheet" /><!-- Owl Theme Default CSS -->
    <link href="assets/css/owl.theme.default.min.css" rel="stylesheet" /><!-- Magnific Popup CSS -->
    <link href="assets/css/magnific-popup.css" rel="stylesheet" /><!-- Style CSS -->
    <link href="assets/css/style.css" rel="stylesheet" /><!-- Style CSS -->
    <link href="assets/css/main.css" rel="stylesheet" /><!-- Responsive CSS -->
    <link href="assets/css/responsive.css" rel="stylesheet" /><!-- Default Color CSS -->
    <link href="assets/css/color/color-default.css" rel="stylesheet" /><!-- Color Switcher CSS -->
    <link href="assets/dist/color-switcher.css" rel="stylesheet" /><!-- custom style  CSS -->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link rel=”canonical” href=”https://policetax.com.au/” />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style type="text/css">
        .container {
            display: flex;
            position: absolute;
            top: 32%;
            left: 10%;
        }

        #righthalf {
            background: url("assets/img/faq.jpg");
            background-size: cover;
            width: 50%;
            position: absolute;
            left: 0px;
            height: 100%;
        }

        #lefthalf {

            width: 25%;
            position: absolute;
            right: 0px;
            /*height: 100%;*/
            top: 50%;
        }

        .wrapper {
            width: 400px;
            position: absolute;
            top: 0px;
            transform: translate(-50%, -50%);
            padding: 20px;
            /*background-image: url("assets/img/login.jpg")*/
            /*background-color: #4296d6;*/
            border-radius: 15px;

        }

        .image {
            width: 50%;
            position: absolute;
            left: 35%;
            top: 0px;
            height: 100%;
        }

        .fa {
            color: #000;
            font-size: 20px;
            margin-left: 8px;
        }

        #validation-txt {
            color: red;
            font-size: 18px;
            width: 300px;
        }

        #password-3 {
            -webkit-text-security: disc;
            -moz-text-security: circle;
            text-security: circle;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .pwd {

            position: relative;
            margin: -35px 5px;
            float: right;
        }

        a.right {
            float: right;
        }
    </style>
</head>

<body>

    <div id="lefthalf" class="wrapper">
        <h2>Sign Up</h2>
        <p style="color:black;">Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label style="color:white;">Username</label>
                <input type="text" name="username" placeholder="Enter the Email address" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label style="color:white;">Password</label>
                <input type="password" name="password" placeholder="Enter the Password" class="form-control" id="password-field" value="<?php echo $password; ?>">
                <span class="pwd">
                    <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
                </span>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label style="color:white;">Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Re-enter the password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <!--<input type="reset" class="btn btn-default" value="Reset"> -->
            </div>
            <p style="color:black;">Already have an account? <a href="Login.php">Login here</a></p>

            </script>

            <script>
                function viewPassword() {
                    var passwordInput = document.getElementById('password-field');
                    var passStatus = document.getElementById('pass-status');

                    if (passwordInput.type == 'password') {
                        passwordInput.type = 'text';
                        passStatus.className = 'fa fa-eye-slash';

                    } else {
                        passwordInput.type = 'password';
                        passStatus.className = 'fa fa-eye';
                    }
                }
            </script>
        </form>
    </div>
    <div id="righthalf">
    </div>
</body>

</html>