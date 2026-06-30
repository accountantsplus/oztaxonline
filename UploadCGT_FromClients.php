
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Property Expense Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .illustration {
            margin-bottom: 20px;
        }
        .form-container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
        }
        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .form-group label {
            flex: 1;
            margin-right: 10px;
        }
        .form-group input,
        .form-group select {
            flex: 2;
        }
        .form-group input[type="file"] {
            flex: 2;
            margin-right: 0;
        }
        .form-group input[type="number"] {
            width: 50%;
        }
        .form-group input[type="submit"] {
            flex: 1;
            margin: 0 auto;
            display: block;
            width: 100px;
            background-color: blue;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .tooltip {
            border-bottom: 1px dotted black;
            cursor: help;
        }
        @media (max-width: 768px) {
            body {
                align-items: center;
            }
            .form-group {
                flex-direction: column;
                align-items: flex-start;
            }
            .form-group input[type="number"] {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="illustration">
        <img src="rental_property_drawing.jpg" alt="Rental Property Illustration" style="max-width: 100%;">
    </div>
    <div class="form-container">
        <h1>CGT( Capital Gains Tax) Calculation proforma worksheet( for office use only)</h1>
        <img src="images/rental.jpg" alt="Rental Property Example" style="width: 22%; max-width: 600px;">
       <p>Fill in the form below <B>ABOUT YOUR CAPITAL GAINS TAX(CGT) INFORMATION </B> to tell us about your CGT situation  you may well incuured on the sale of property( including vacant land) and 
       /or ASX share or cypto currency  trades for the 2024 tax year. We will enter it into our tax system 
        and a tax accountant will discuss the results with you shortly for your appointment. <br><br>If you have any other relevant information, please upload it here.</p>
        
        <form action="Rental_From_Clients.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="property_image">Upload any files here:</label>
                <input type="file" id="property_image" name="property_image" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="client_name">Client's Full Name:</label>
                <input type="text" id="client_name" name="client_name" required>
            </div>

            <div class="form-group">
                <label for="percentage_owned">Percentage Owned:</label>
                <input type="number" id="percentage_owned" name="percentage_owned" required>
            </div>

            <div class="form-group">
                <label for="full_address">Full Address:</label>
                <input type="text" id="full_address" name="full_address" required>
            </div>

            <div class="form-group">
                <label for="street_address">Street Address:</label>
                <input type="text" id="street_address" name="street_address" required>
            </div>

            <div class="form-group">
                <label for="postcode">Postcode:</label>
                <input type="text" id="postcode" name="postcode" required>
            </div>

            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" id="state" name="state" required>
            </div>

            <div class="form-group">
                <label for="approx_area">Approx. Area (sq ft):</label>
                <input type="number" id="approx_area" name="approx_area" required>
            </div>
            
            <div class="form-group">
                <label for="weeks_rented">Number of Weeks Rented:</label>
                <input type="number" id="weeks_rented" name="weeks_rented" required>
            </div>

            <div class="form-group">
                <label for="property_type">Property Type:</label>
                <select id="property_type" name="property_type" required>
                    <option value="apartment">Apartment</option>
                    <option value="house">House</option>
                     <option value="house">Beach House</option>
                    <option value="commercial">Commercial</option>
                </select>
            </div><br>
            
            <h1>Revenue Collected</h1>
            
            <div class="form-group">
                <label for="Rent_Recieved">Rent Received:</label>
                <input type="number" id="Rent_Recieved" name="Rent_Recieved" required>
            </div>

            <h1>Less Expenses Incurred</h1>
            
            <div class="form-group">
                <label for="accounting_fees" class="tooltip" title="Costs associated with accounting services">Accounting Fees:</label>
                <input type="number" id="accounting_fees" name="accounting_fees" required>
            </div>

            <div class="form-group">
                <label for="advertising" class="tooltip" title="Expenses for advertising the property">Advertising:</label>
                <input type="number" id="advertising" name="advertising" required>
            </div>

            <div class="form-group">
                <label for="hoa_fees" class="tooltip" title="Body Corporate/Strata Plan fees">BCSP Fees:</label>
                <input type="number" id="hoa_fees" name="hoa_fees" required>
            </div>

            <div class="form-group">
                <label for="insurance" class="tooltip" title="Insurance costs for the property">Insurance:</label>
                <input type="number" id="insurance" name="insurance" required>
            </div>

            <div class="form-group">
                <label for="legal_fees" class="tooltip" title="Legal expenses related to the property">Legal Fees:</label>
                <input type="number" id="legal_fees" name="legal_fees" required>
            </div>

            <div class="form-group">
                <label for="maintenance" class="tooltip" title="Maintenance expenses for the property">Maintenance:</label>
                <input type="number" id="maintenance" name="maintenance" required>
            </div>

            <div class="form-group">
                <label for="management_fees" class="tooltip" title="Fees paid for property management services">Management Fees:</label>
                <input type="number" id="management_fees" name="management_fees" required>
            </div>

            <div class="form-group">
                <label for="property_tax" class="tooltip" title="Land tax paid for the property">Land Tax:</label>
                <input type="number" id="property_tax" name="property_tax" required>
            </div>

            <div class="form-group">
                <label for="repairs" class="tooltip" title="Repair costs for the property">Repairs:</label>
                <input type="number" id="repairs" name="repairs" required>
            </div>

            <div class="form-group">
                <label for="interest_paid" class="tooltip" title="Interest paid on loans for the property">Interest Paid:</label>
                <input type="number" id="interest_paid" name="interest_paid" required>
            </div>

            <div class="form-group">
                <label for="smoke_alarms" class="tooltip" title="Expenses for smoke alarm installation and maintenance">Smoke Alarms:</label>
                <input type="number" id="smoke_alarms" name="smoke_alarms" required>
            </div>

            <div class="form-group">
                <label for="electrical_gas_inspection" class="tooltip" title="Costs for electrical and gas inspections">Electrical/Gas Inspection:</label>
                <input type="number" id="electrical_gas_inspection" name="electrical_gas_inspection" required>
            </div>

            <div class="form-group">
                <label for="council_rates" class="tooltip" title="Council rates paid for the property">Council Rates:</label>
                <input type="number" id="council_rates" name="council_rates" required>
            </div>

            <div class="form-group">
                <label for="water_rates" class="tooltip" title="Water rates paid for the property">Water Rates:</label

>
                <input type="number" id="water_rates" name="water_rates" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
```

### PHP Script (Rental_From_Clients.php)

```php
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_name = $_POST['client_name'];
    $percentage_owned = $_POST['percentage_owned'];
    $full_address = $_POST['full_address'];
    $street_address = $_POST['street_address'];
    $postcode = $_POST['postcode'];
    $state = $_POST['state'];
    $approx_area = $_POST['approx_area'];
    $weeks_rented = $_POST['weeks_rented'];
    $property_type = $_POST['property_type'];
    $rent_received = $_POST['Rent_Recieved'];
    $accounting_fees = $_POST['accounting_fees'];
    $advertising = $_POST['advertising'];
    $hoa_fees = $_POST['hoa_fees'];
    $insurance = $_POST['insurance'];
    $legal_fees = $_POST['legal_fees'];
    $maintenance = $_POST['maintenance'];
    $management_fees = $_POST['management_fees'];
    $property_tax = $_POST['property_tax'];
    $repairs = $_POST['repairs'];
    $interest_paid = $_POST['interest_paid'];
    $smoke_alarms = $_POST['smoke_alarms'];
    $electrical_gas_inspection = $_POST['electrical_gas_inspection'];
    $council_rates = $_POST['council_rates'];
    $water_rates = $_POST['water_rates'];
    $property_image = $_FILES['property_image'];

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your_email@example.com'; // SMTP username
        $mail->Password   = 'your_password'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('from_email@example.com', 'Rental Property Form');
        $mail->addAddress('recipient@example.com');

        // Attachments
        if (is_uploaded_file($property_image['tmp_name'])) {
            $mail->addAttachment($property_image['tmp_name'], $property_image['name']);
        }

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Rental Property Expense Form Submission';
        $mail->Body    = "
            <h1>Rental Property Expense Form Submission</h1>
            <p><strong>Client's Full Name:</strong> $client_name</p>
            <p><strong>Percentage Owned:</strong> $percentage_owned%</p>
            <p><strong>Full Address:</strong> $full_address</p>
            <p><strong>Street Address:</strong> $street_address</p>
            <p><strong>Postcode:</strong> $postcode</p>
            <p><strong>State:</strong> $state</p>
            <p><strong>Approx. Area:</strong> $approx_area sq ft</p>
            <p><strong>Number of Weeks Rented:</strong> $weeks_rented</p>
            <p><strong>Property Type:</strong> $property_type</p>
            <p><strong>Rent Received:</strong> $$rent_received</p>
            <p><strong>Accounting Fees:</strong> $$accounting_fees</p>
            <p><strong>Advertising:</strong> $$advertising</p>
            <p><strong>BCSP Fees:</strong> $$hoa_fees</p>
            <p><strong>Insurance:</strong> $$insurance</p>
            <p><strong>Legal Fees:</strong> $$legal_fees</p>
            <p><strong>Maintenance:</strong> $$maintenance</p>
            <p><strong>Management Fees:</strong> $$management_fees</p>
            <p><strong>Land Tax:</strong> $$property_tax</p>
            <p><strong>Repairs:</strong> $$repairs</p>
            <p><strong>Interest Paid:</strong> $$interest_paid</p>
            <p><strong>Smoke Alarms:</strong> $$smoke_alarms</p>
            <p><strong>Electrical/Gas Inspection:</strong> $$electrical_gas_inspection</p>
            <p><strong>Council Rates:</strong> $$council_rates</p>
            <p><strong>Water Rates:</strong> $$water_rates</p>
        ";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


