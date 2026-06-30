$(function(){
    var currentStep = 1;
    var data = getUrlVars();
    if (data.type == "newRecruit") {
        $(".newRecruit").show();
        $(".policeOfficersPSO").hide();
        $(".skype").hide();
        $(".earlyBird").hide();
        $(".policeMain").show();
        $(".nonNewRecruit").hide();
        $(".jobYears").hide();
        $(".nonPolice").hide();
        $(".familyMember").hide();
        $(".smartfixMultiFix").hide();
        $(".rentals").hide();
        $("#subject").val("New Recruitment Registration");
    } else if (data.type == "policeOfficersPSO") {
        $(".newRecruit").hide();
        $(".policeOfficersPSO").show();
        $(".skype").hide();
        $(".earlyBird").hide();
        $(".familyMember").hide();
        $(".smartfixMultiFix").hide();
        $(".rentals").hide();
        $(".policeMain").show();
        $(".nonNewRecruit").show();
        $(".jobYears").show();
        $(".nonPolice").hide();
        $("#subject").val("Police Officer/PSO Registration");
    } else if (data.type == "skype") {
        $(".newRecruit").hide();
        $(".policeOfficersPSO").hide();
        $(".skype").show();
        $(".earlyBird").hide();
        $(".familyMember").hide();
        $(".smartfixMultiFix").hide();
        $(".rentals").hide();
        $(".policeMain").show();
        $(".nonNewRecruit").show();
        $(".jobYears").show();
        $(".nonPolice").hide();
        $("#subject").val("Skype Registration");
    } else if (data.type == "earlyBird") {
        $(".newRecruit").hide();
        $(".policeOfficersPSO").hide();
        $(".skype").hide();
        $(".earlyBird").show();
        $(".familyMember").hide();
        $(".smartfixMultiFix").hide();
        $(".rentals").hide();
        $(".policeMain").show();
        $(".nonNewRecruit").show();
        $(".jobYears").show();
        $(".nonPolice").hide();
        $("#subject").val("Early Bird Registration");
    } else if (data.type == "familyMember") {
        $(".newRecruit").hide();
        $(".policeOfficersPSO").hide();
        $(".skype").hide();
        $(".earlyBird").hide();
        $(".familyMember").show();
        $(".smartfixMultiFix").hide();
        $(".rentals").hide();
        $(".policeMain").hide();
        $(".nonNewRecruit").hide();
        $(".jobYears").show();
        $(".nonPolice").show();
        $("#subject").val("Family Member Registration");
    } else if (data.type == "smartfixMultiFix") {
        $(".newRecruit").hide();
        $(".policeOfficersPSO").hide();
        $(".skype").hide();
        $(".earlyBird").hide();
        $(".familyMember").hide();
        $(".smartfixMultiFix").show();
        $(".rentals").hide();
        $(".policeMain").hide();
        $(".nonNewRecruit").hide();
        $(".jobYears").show();
        $(".nonPolice").show();
        $("#subject").val("Smart Fix/Multi Fix Registration");
    } else if (data.type == "rentals") {
        $(".newRecruit").hide();
        $(".policeOfficersPSO").hide();
        $(".skype").hide();
        $(".earlyBird").hide();
        $(".familyMember").hide();
        $(".smartfixMultiFix").hide();
        $(".rentals").show();
        $(".policeMain").hide();
        $(".nonNewRecruit").hide();
        $(".jobYears").show();
        $(".nonPolice").show();
        $("#subject").val("Landlord/Rental Registration");
    }

	$("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: false,
        transitionEffectSpeed: 500,
        labels: {
            finish: "Submit",
            next: "Forward",
            previous: "Backward"
        },
        onStepChanging: function(event, currentIndex, newIndex) {
            $(".content").animate({ scrollTop: "0px" });

            if (currentIndex === 0) {
                if(!formValidate($(this), 1)){
                    return;
                }
            }
            if (currentIndex === 1) {
                if(!formValidate($(this), 2)){
                    return;
                }
            }
            
            if (currentIndex === 2) {
                
                if(!formValidate($(this), 3)){
                    return;
                }
            }
            if (currentIndex === 3) {
                
                if(!formValidate($(this), 4)){
                    return;
                }
            }
            if(currentIndex === 4) {
                
                
                if(!formValidate($(this), 5)){
                    return;
                }
            }
            return $("#wizard").valid();
        },
        onFinished: function(event, currentIndex) {
            formSubmit($("#wizard"));
        },
    });
    $('.wizard > .steps li a').click(function(){
    	$(this).parent().addClass('checked');
		$(this).parent().prevAll().addClass('checked');
		$(this).parent().nextAll().removeClass('checked');
    });
    // Custome Jquery Step Button
    $('.forward').click(function(){
        $("#wizard").steps('next');
    })
    $('.backward').click(function(){
        $("#wizard").steps('previous');
        currentStep -= 1;
    })
    // Select Dropdown
    $('html').click(function() {
        $('.select .dropdown').hide(); 
    });
    $('.select').click(function(event){
        event.stopPropagation();
    });
    $('.select .select-control').click(function(){
        $(this).parent().next().toggle();
    })    
    $('.select .dropdown li').click(function(){
        $(this).parent().toggle();
        var text = $(this).attr('rel');
        $(this).parent().prev().find('div').text(text);
    })
});

function getUrlVars() {
    var vars = [],
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

var formValidate = function(selectedVal, currentVal){
						
    if (currentVal == 1) {

      var familyName = document.getElementById("familyName");

      var firstName = document.getElementById("firstName");

      var email = document.getElementById("email");

      var mobileNumber = document.getElementById("mobile_number");

      var tfn = document.getElementById("tfn");

      var dob = document.getElementsByClassName("birthDay")[0];



      if (!validateAlphabet(firstName.value)) {

        notify('white', "Please enter alphabets for the First Name.");

        firstName.focus();

        return;

      }


      if (!validateAlphabet(familyName.value)) {

        notify('white', "Please enter alphabets for the Family Name.");

        familyName.focus();

        return;

      }



      if (!validateEmail(email.value)) {

        notify('white', "Please enter a valid Email.");

        email.focus();

        return;

      }



      if(!validateNumber(mobileNumber.value, 10)){

        notify('white', "Please enter a valid Phone Number of 10 digits.");

        mobileNumber.focus();

        return;

      }



      if(dob.value == ""){

        notify('white', "Please select a DOB.");

        document.getElementsByClassName("birthDate")[0].focus();

        return;

      }



      if(!validateNumber(tfn.value, 9)){

        notify('white', "Please enter a valid Tax File Number of 9 digits.");

        tfn.focus();

        return;

      }



      return true;



    } else if(currentVal == 2){

      var bsb = document.getElementById("my-bsb");
      var spouseQuestion = document.getElementById("selectControlSpouse");
      var rentalQuestion = document.getElementById("selectControlRental");
      var accountNumber = document.getElementById("bank-account");

      if($("#selectControlSpouse").html().indexOf("span") != -1){

        notify('white', "Please select an answer to Spouse question.");

        spouseQuestion.focus();

        return;

      }

      if($("#selectControlRental").html().indexOf("span") != -1){

        notify('white', "Please select an answer to Rental question.");

        rentalQuestion.focus();

        return;

      }

      if(!validateNumber(bsb.value, 6)){

        notify('white', "Please enter a valid BSB Number of 6 digits.");

        bsb.focus();

        return;

      }



      if(isNaN(accountNumber.value) || !(accountNumber.value.length <= 10 && accountNumber.value.length >= 4)){

        notify('white', "Please enter a valid Bank Account Number.");

        accountNumber.focus();

        return;

      }



      return true;

    } else if(currentVal == 3){

      var academyLocation = document.getElementById("academyLocation");

      var occupation = document.getElementById("occupation");

      var rank = document.getElementById("rank");
      
      var policeStation = document.getElementById("policeStation");
      var yearsinJob = document.getElementById("yearsinJob");

      var workLocation = document.getElementById("workLocation");
      var occupation = document.getElementById("occupation");
      var squadNumber = document.getElementById("squadNumber");

      var academyStartDate = document.getElementById("academyStartDate");
      
      var data = getUrlVars();
      
    if (data.type == "newRecruit" || data.type == "policeOfficersPSO" || data.type == "skype" || data.type == "earlyBird"){
      if($("#selectControlOccupationRole").html().indexOf("span") != -1){

        notify('white', "Please select an Occupation Role.");

        $("#selectControlOccupationRole").focus();

        return;

      }

      if($("#selectControlRank").html().indexOf("span") != -1){

        notify('white', "Please select a Rank.");

        $("#selectControlRank").focus();

        return;

      }
    }
    
    if (data.type == "policeOfficersPSO" || data.type == "skype" || data.type == "earlyBird"){

      if(policeStation.value == ""){

        notify('white', "Please enter Police Station.");

        policeStation.focus();

        return;

      }
      
      if(isNaN(yearsinJob.value) || yearsinJob.value == "" || yearsinJob.value.length > 2){

        notify('white', "Please enter valid Service Years.");

        yearsinJob.focus();

        return;

      }
    } 
    
    if (data.type == "familyMember" || data.type == "smartfixMultiFix" || data.type == "rentals"){

      
      if(occupation.value == ""){

        notify('white', "Please enter Occupation.");

        occupation.focus();

        return;

      }
      
      if(workLocation.value == ""){

        notify('white', "Please enter Work Location.");

        workLocation.focus();

        return;

      }
      
      if(isNaN(yearsinJob.value) || yearsinJob.value == "" || yearsinJob.value.length > 2){

        notify('white', "Please enter valid Service Years.");

        yearsinJob.focus();

        return;

      }
    }
    
    if (data.type == "smartfixMultiFix"){

      if($("#selectSmartFixMultiFix").html().indexOf("span") != -1){

        notify('white', "Please select a Registration Type.");

        $("#selectSmartFixMultiFix").focus();

        return;

      }
    } 
    
    if (data.type == "newRecruit"){
      if($("#selectControlAcademyLocation").html().indexOf("span") != -1){

        notify('white', "Please select a Police Academy Location.");

        $("#selectControlAcademyLocation").focus();

        return;

      }
      
      if(squadNumber.value == ""){

        notify('white', "Please enter Squad Number.");

        squadNumber.focus();

        return;

      }

      if(academyStartDate.value == "Academy Start Date" || academyStartDate.value == ""){

        notify('white', "Please enter Academy Start Date.");

        academyStartDate.focus();

        return;

      }
    }

      return true;

    } else if(currentVal == 4){

      var stateRegistration = document.getElementById("stateofRegistration");

      var promotionalCode = document.getElementById("PromotionalCode");
      var appointmentDate = document.getElementById("appointmentDate");

      var hearAboutUs = document.getElementById("hearAboutUs");
      
      var data = getUrlVars();

      if($("#selectControlHearAboutUs").html().indexOf("span") != -1){

        notify('white', "Please select Hear About Us.");

        $("#selectControlHearAboutUs").focus();

        return;

      }

      if($("#selectControlStateRegistration").html().indexOf("span") != -1){

        notify('white', "Please select State of Registration.");

        $("#selectControlStateRegistration").focus();

        return;

      }
    
    if (data.type == "skype"){

      
      if(appointmentDate.value == ""){

        notify('white', "Please enter Appointment Date.");

        occupation.focus();

        return;

      }

      if($("#selectAppointmentTime").html().indexOf("span") != -1){

        notify('white', "Please select Appointment Time.");

        $("#selectAppointmentTime").focus();

        return;

      }
    }   


      $("#onSubmitButton").removeAttr("disabled");

      return true;

    }else{

      return true;

    }

}



  var validateNumber = function(numberVal, number){

    if(isNaN(numberVal)){

      return false;

    }else{

      if(numberVal.length < number || numberVal.length > number){

        return false;

      }else{

        return true;

      }

    }

  }



  var validateDate = function(date){

    var regex = /^\d{1,2}\/\d{1,2}\/\d{4}$/;

    return regex.test(date);

  }



  var validateEmail = function(email){

    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    return re.test(email);

  }

  

  var validateAlphabet = function(alphabet){

    var letters = /^[A-Za-z]+$/;

    return alphabet.match(letters);

  }

  

var notify = function(style, errorMessage){

    $.notify({

      title: 'Error',

      text: errorMessage

    }, {

      style: 'metro',

      position:"right top",

      className: "error",

      autoHide: true,

      clickToHide: true

    });

}

formSubmit = form => {
    var formData = form.serializeArray();
    
    var data = {};
    $(formData).each(function(index, obj){
        data[obj.name] = obj.value;
    });
    
    var dataMore = {
        Spouse: $("#selectControlSpouse").html(),
        Rental: $("#selectControlRental").html(),
        OccupationRole: $("#selectControlOccupationRole").html(),
        AcademyLocation: $("#selectControlAcademyLocation").html(),
        Rank: $("#selectControlRank").html(),
        HearAboutUs: $("#selectControlHearAboutUs").html(),
        State: $("#selectControlStateRegistration").html(),
        AppointmentTime: $("#selectAppointmentTime").html(),
        RegistrationType: $("#selectSmartFixMultiFix").html(),
    }
    $.each(dataMore, function(index, obj){
        data[index] = obj;
    });
    
    const dataContainer = document.getElementById('jsonInput');

    $(".sub-body").addClass("overlay");

    $(".loader").show();

    var message = "";

    var lastname = "";

    var firstname = "";
    var email = "";

    var title = "";

    var description = "";

    var desc = ""; var listData = {};
    //console.log(data);
    description = data.subject + " - New Client Registration [Police] - ";

    desc += " (" + dataMore.State + " - ";
    desc += dataMore.OccupationRole + ") ";

    $.each(data, function(i, v){
        if(i.indexOf("firstName") != -1){

            firstname = v;

        }


        if(i.indexOf("FamilyName") != -1){

            lastname = v;

        }


        if(i.indexOf("Email") != -1){

            email = v;

        }

        if(i.indexOf("datepicker_birthDay") != -1){

            var data = $("input[name='" + i + "']").val().split("-");

            var properDate = data[2] + "/" + data[1] + "/" + data[0];

            //giving appropriate Name

            if(i.indexOf("datepicker_birthDay") != -1){

                i = "Date of Birth";

            }

            message += i + " : " + properDate + "<br/>\n";

            listData[i] = properDate;

        }

        message += i + " : " + v + "<br/>\n";

        listData[i] = v;

    });

    var subject = description + title + firstname + " " + lastname + " " + desc;

    var dataVal = {

        message: message,

        subject: subject,
        
        fromName: "CRM Requests",

        emailTo: "register@policetax.com.au"

    };
            
    var continuationURL = new FormData();
    var continuation = "<html><body><span>Hi Registration Admin, </span><br /><br />";
    continuation += "<span>" + subject + " has been requested by " + firstname + " " + lastname + ". </span> <br /><br />";
    continuation += "<span>More details: </span> <br />";
    continuation += message;
    continuation += "<span>Regards,</span> <br />";
    continuation += "<span>PoliceTax online</span> </body></html>";
    continuationURL.append("message", continuation);
    continuationURL.append("subject", subject);
    continuationURL.append("fromName", "Registration Requests");
    continuationURL.append("emailTo", "register@policetax.com.au");
    
    $.ajax({
        url: 'email', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: continuationURL,
        type: 'post',
        success: function(php_script_response){
            setTimeout(function () {
                var html = '<section id="wizard-p-0" role="tabpanel" aria-labelledby="wizard-h-0" class="body current" aria-hidden="false"><div class="inner">';
                html += '<div class="image-holder"></div><div class="form-content"><div class="form-header"><h3>Registration</h3>';
                html += '</div><p>Thank you for registration.</p></div></div></section>';
                $("#wizard").find(".content").html("");
                $("#wizard").find(".steps").html("");
                $("#wizard").find(".actions").html("");
                $("#wizard").find(".content").html(html);

            }, 2500);
        }
    });

    $.ajax({

        url: 'https://policetaxssl.com:81/newclient',

        type: 'post',

        data: listData,

        headers: {

        "Access-Control-Allow-Origin": 'http://www.itechsol.com.au'

        },

        dataType: 'json',

        success: function(data) {
            
            

            return;

        },
        fail: function(a, b, c) {

        }


    });
    
    return;
    
}
    