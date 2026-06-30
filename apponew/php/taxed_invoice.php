<html>
<head>
    <title> Taxed Invoice</title>
</head>
<body style="font: 13px arial, helvetica, tahoma;">
    <div class="email-container" style="width: 650px; border: 1px solid #eee;">
        <div id="header" style="background-color: #3DD481; border-bottom: 4px solid #1A865F;
                height: 45px; padding: 10px 15px;">
            <strong id="logo" style="color: white; font-size: 20px;
                    text-shadow: 1px 1px 1px #8F8888; margin-top: 10px; display: inline-block">
                    $company_name - Shopping Cart Taxed Invoice for $year</strong>
        </div>

        <div id="content" style="padding: 10px 15px;">

            <h2>Appointment Details for tax </h2>
            <table id="appointment-details">
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Service</td>
                    <td style="padding: 3px;">$appointment_service</td>
                      <td class="label" style="padding: 3px;font-weight: bold;">Provider</td>
                    <td style="padding: 3px;">$appointment_provider</td>
                    
                    
                </tr>
              
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Start</td>
                    <td style="padding: 3px;">$appointment_start_date</td>
              
                    
                    
                    
                </tr>
                
                 <tr>
                
                     <td class="label" style="padding: 3px;font-weight: bold;">Duration</td>
                    <td style="padding: 3px;">$appointment_duration</td>
                    
                        <td class="label" style="padding: 3px;font-weight: bold;">Booked By</td>
                    <td style="padding: 3px;">$booked_by</td>
                    
                </tr>
              
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Total amount:</td>
                    <td style="padding: 3px;">AUD $total</td>
              
                    
                    
                    
                </tr>
            
              
            </table>

            <h2>Customer Details</h2>
            <table id="customer-details">
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Receipt Number</td>
                    <td style="padding: 3px;">$receipt_id</td>
                </tr>
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Name</td>
                    <td style="padding: 3px;">$customer_name</td>
                </tr>
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Email</td>
                    <td style="padding: 3px;">$customer_email</td>
                 
                </tr>
             
             
             
              <tr>
                   
                    <td class="label" style="padding: 3px;font-weight: bold;">Phone</td>
                    <td style="padding: 3px;">$customer_phone</td>
                </tr>
             
             
             
                <tr>
                    <td class="label" style="padding: 3px;font-weight: bold;">Address</td>
                    <td style="padding: 3px;">$customer_address</td>
                     <td class="label" style="padding: 3px;font-weight: bold;">Suburb</td>
                    <td style="padding: 3px;">$customer_suburb</td>
                </tr>
             
                <tr>
                   
                    <td class="label" style="padding: 3px;font-weight: bold;">State</td>
                    <td style="padding: 3px;">$customer_state</td>
                    <td class="label" style="padding: 3px;font-weight: bold;">Postcode</td>
                    <td style="padding: 3px;">$customer_postcode</td>
                
                
                </tr>
              
            </table>
            
            
            
            
            
            
            <style>
	.demo {
		border:1px solid #C0C0C0;
		border-collapse:collapse;
		padding:5px;
	}
	.demo th {
		border:1px solid #C0C0C0;
		padding:5px;
		background:#F0F0F0;
	}
	.demo td {
		border:1px solid #C0C0C0;
		padding:5px;
	}
</style>
    </div>
    </div>
</body>
</html>
