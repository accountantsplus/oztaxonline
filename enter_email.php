
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
	<link rel="stylesheet" href="main.css">
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
            background: url("assets/img/about-us.jpg");
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
	<form action="reset-request.php" method="post">
		<h2 class="form-title">Reset password</h2>
		<!-- form validation messages -->
		<div class="form-group">
			<label>Your email address</label>
			<input type="email" class="form-control" name="email">
		</div>
		<div class="form-group">
			<button type="submit" name="reset-password" class="btn btn-primary">Submit</button>
		</div>
		</div>
		 <div id="righthalf">
    </div>
	</form>
</body>
</html>