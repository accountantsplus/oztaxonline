
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Onboarding Checklist</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightblue;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            display: flex;
            background-color: white;
            width: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 50px;
        }
        .left {
            flex: 1;
            padding: 20px;
            background-color: lightblue;
        }
        .right {
            flex: 1;
            padding: 20px;
            background-color: navy;
            color: white;
            margin: 0 20px;
        }
        h1 {
            color: navy;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select, textarea {
            width: 95%;
            padding: 10px;
            border: none;
            border-radius: 4px;
        }
        .error {
          color: red;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .checkbox-group input {
            margin-right: 10px;
        }
        .footnote {
            font-size: 12px;
            margin-top: 15px;
        }
        .logo {
            margin-bottom: 20px;
        }
        .ceo-image {
            max-width: 100%;
            height: auto;
        }
        .download-link {
            color: white;
            text-decoration: none;
            background-color: darkred;
            padding: 10px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery.validate-1.19.5.min.js"></script>
    <script type="text/javascript">
      // Wait for the DOM to be ready
      $(function() {
        // Initialize form validation on the registration form.
        // It has the name attribute "registration"
        $("form[name='registration']").validate({
          // Specify validation rules
          rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            firstname: "required",
            lastname: "required",
            email: {
              required: true,
              // Specify that email should be validated
              // by the built-in "email" rule
              email: true
            },
            mobile: {
              required: true,
              minlength: 5
            },
          },
          // Specify validation error messages
          messages: {
            firstname: "Please enter your firstname",
            lastname: "Please enter your lastname",
            mobile: {
              required: "Please provide a mobile",
              minlength: "Your mobile must be at least 5 characters long"
            },
            email: "Please enter a valid email address"
          },
          // Make sure the form is submitted to the destination defined
          // in the "action" attribute of the form when valid
          submitHandler: function(form) {
            $.ajax({
                type: "POST",
                url: './ClientLookUp/php/onBoard.php',
                data: $(form).serialize(),
                success: function(data) {
                    form.submit();
                },
                error: function(xhr, desc, err) {
                    console.log('error:' + err);
                }
            });
          }
        });
      });
    </script>
</head>
<body>
    <div class="container">
        <div class="left"><br><br>
            <a href="https://policetax.com.au"><p1>Back to Police Tax website</p1></a><br><br>
            <a href="https://policetax.com.au"><img src="images/ScreenHunter 985.png" alt="Police Tax Logo" class="logo"></a>
            <h1>Client Onboarding Form & request for <br>how to get best refund for 2024</h1>
            <p1>Or call Anne Salmon 0418 327 166 for any assistance you need</p1><br><br>

            
            <figure>
<img src="images/01.jpg.png" alt="CEO Angus" class="ceo-image">
  <figcaption>Garry Angus CEO.</figcaption>
</figure>

            
        </div>
        <div class="right">
            <form name="registration" action="OnBoardFormResult.php" method="post">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="lastname" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="tel" id="mobile" name="mobile" required>
                </div>
                <div class="form-group">
                    <label for="station">Station</label>
                    <input type="text" id="station" name="station">
                </div>
                <div class="form-group">
                    <label for="rank">Rank</label>
                    <input type="text" id="rank" name="rank">
                </div>
                <div class="form-group">
                    <label for="years-in-job">Years in Job</label>
                    <input type="number" id="years-in-job" name="years_in_job">
                </div>
                <div class="form-group">
                    <label for="spouse-tax">Include Spouse Tax for 2024?</label>
                    <select id="spouse-tax" name="spouse_tax">
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="spouse_details">Spouse Full Name</label>
                    <input type="text" id="spouse_details" name="spouse_details">
                </div>
                <div class="form-group">
                    <label for="spouse_dob">Spouse Date of Birth</label>
                    <input type="text" id="spouse_dob" name="spouse_dob">
                </div>
                <div class="form-group">
                    <label for="spouse_income">Spouse Seperate Net Income Approx</label>
                    <input type="number" id="spouse_income" name="spouse_income">
                </div>
                <div class="form-group">
                    <label for="no_dependants">No Dependants</label>
                    <input type="number" id="no_dependants" name="no_dependants">
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="rental-property" name="rental_property">
                    <label for="rental-property">I have a rental property</label>
                </div>
                <a href="PoliceTax - Police Officers Tax Deductions - Free.pdf" class="download-link">Download how to get best refund for 2024</a>
                <div class="footnote">
                   For security reasons please SMS your tax file number(TFN) (seperately) to our mobile SMS service 0418 327 166<br>
                    listing your full name separately.
                </div>
                <div class="form-group"><br>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelector('.download-link').addEventListener('click', function() {
            const link = document.createElement('a');
            link.href = 'PoliceTax - Police Officers Tax Deductions - Free.pdf';
            link.download = 'PoliceTax - Police Officers Tax Deductions - Free.pdf';
            link.click();
        });
    </script>
</body>
</html>