/*==============================================================*/
// Axolot Contact Form  JS
/*==============================================================*/
(function ($) {
    "use strict"; // Start of use strict
    $("#contactForm").validator().on("submit", function (event) {
            
        if($("#HereBefore option:selected").val() == ""){
            $("#HereBefore").parent().find(".help-block").html('<ul class="list-unstyled"><li>Please select an option</li></ul>');
            return;
        }else{
            $("#HereBefore").parent().find(".help-block").html("");
        }
        
        if($("#postcode").val().length > 4 || $("#postcode").val().length < 4){
            $("#postcode").parent().find(".help-block").html('<ul class="list-unstyled"><li>Please enter a valid Postcode</li></ul>');
            return;
        }else{
            $("#postcode").parent().find(".help-block").html("");
        }
        
        if (event.isDefaultPrevented()) {
            // handle the invalid form...
            formError();
            submitMSG(false, "Did you fill in the form properly?");
        } else {
            // everything looks good!
            event.preventDefault();
            submitForm();
        }
    });


    function submitForm(){
        // Initiate Variables With Form Content
        var name = $("#name").val();
        var email = $("#email").val();
        var msg_subject = $("#msg_subject").val() + " | " + $("#HereBefore option:selected").val() + " | " + $("#postcode").val();
        var message = $("#message").val();
        
        var form_data = new FormData();
        form_data.append("name", name);
        form_data.append("emailFrom", email);
        form_data.append("subject", msg_subject);
        form_data.append("message", message);
        
        $.ajax({
            type: "POST",
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            url: "../form-process",
            data: form_data,
            success : function(text){
                formSuccess();
            }
        });
    }

    function formSuccess(){
        $("#contactForm")[0].reset();
        submitMSG(true, "Message Submitted!")
    }

    function formError(){
        $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(this).removeClass();
        });
    }

    function submitMSG(valid, msg){
        if(valid){
            var msgClasses = "h4 text-left tada animated text-success";
        } else {
            var msgClasses = "h4 text-left text-danger";
        }
        $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
    }
}(jQuery)); // End of use strict