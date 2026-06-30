
<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $(function () {
        var getValue = function(){
            var data = [];
            $.post("sendSMSBookingData", function(response){
                response = JSON.parse(response);
            	var highlightedData = "";
            	$.each(response.aaData, function(index, value){
            	    var phone = value.phone_number;
                    var newPhone = phone.replace(/^0/, '+61');
    			    var currentDataJSON = { 'FirstName': value.first_name, 'LastName': value.last_name, 'Email': value.email, 'PhoneNumber': newPhone, 'AppointmentDate': value.start_datetime, 'Id': value.id };
    			    
    			    var dateData = value.start_datetime.split(" ");
    			    var dateOnlyData = dateData[0].split('-');
    			    var correctDate = dateOnlyData[2] + "/" + dateOnlyData[1] + "/" + dateOnlyData[0];
    			    var correctTime = dateData[1];
                    
                    var dataSend = {
                      content: `Hi ${value.first_name}. Your appointment is scheduled on ${correctDate} at ${correctTime} with PoliceTax. Please reply with YES to confirm, NO to cancel.`,
                      number: newPhone
                    };
                    
                    $.post("https://www.policetax.com.au/sms/sendMessage", dataSend, function(response){
                        if(response.messages.length > 0){
                            $.each(response.messages, function(ind, val){
                                var smsDataSave = {
                                    Id: parseInt(currentDataJSON.Id),
                                    Content: dataSend.content,
                                    MessageId: val.message_id
                                };
                                
                                console.log(smsDataSave);
                                
                                $.post("sendSMSsave", smsDataSave, function(responseSMS){
                                    
                                });
                            });
                        }
                    });
            	});
            });
        }
        syncMessageReply();
        getValue();
    });
    
    var syncMessageReply = function(){   
        $.get("https://www.policetax.com.au/sms/getMessage", function(response){
            if(response.replies.length > 0){
                $.each(response.replies, function(ind, val){
                    var smsDataSave = {
                        SMSReply: val.content,
                        MessageId: val.message_id
                    };
                    
                    $.post("updateSMSReply", smsDataSave, function(responseSMS){
                        
                    });
                });
            }
        });
    }
</script>