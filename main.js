(function($) {
    var form = $("#signup-form");
    var activeClass = "active";
    var times = 1;
    var tableNumber = 1;
    var havespouse = 1;
    var tfnTaxes = 1;
    var creditcardInfo = 1;
    var havevisited = 1;
    var hasembedded = 1;
    var checkkms = 0;
    var hiddenClass = "hidden";
    var visibleClass = "visible";
    var editFormClass = "edit-form";
    var animatedVisibleClass = "animated fadeIn";
    var animatedHiddenClass = "animated fadeOut";
    var animatingClass = "animating";
    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        },
        rules: {
            email: {
                email: true
            }
        },
        onfocusout: function(element) {
            $(element).valid();
        },
    });

    function initialLoad(){
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            stepsOrientation: "vertical",
            titleTemplate: '<div class="title"><span class="step-number">#index#</span><span class="step-text">#title#</span></div>',
            labels: {
                previous: 'Previous',
                next: 'Next',
                finish: 'Finish',
                current: ''
            },
            onStepChanging: function(event, currentIndex, newIndex) {
                //console.log(currentIndex);
                if (currentIndex === 0) {
                    if(!validate(1)){
                        return;
                    }
                    form.parent().parent().parent().append('<div class="footer footer-' + currentIndex + '"></div>');
                }
                if (currentIndex === 1) {
                    if(!validate(2)){
                        return;
                    }
                    form.parent().parent().parent().find('.footer').removeClass('footer-0').addClass('footer-' + currentIndex + '');
                }
                if (currentIndex === 2) {
                    if(!validate(3)){
                        return;
                    }
                    form.parent().parent().parent().find('.footer').removeClass('footer-1').addClass('footer-' + currentIndex + '');
                }
                if (currentIndex === 3) {
                    if(!validate(4)){
                        return;
                    }
                    form.parent().parent().parent().find('.footer').removeClass('footer-2').addClass('footer-' + currentIndex + '');
                }
                if(currentIndex === 4) {
                    if(!validate(5)){
                        return;
                    }
                    form.parent().parent().parent().find('.footer').removeClass('footer-2').addClass('footer-' + currentIndex + '');
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                alert('Submited');
            },
            onStepChanged: function(event, currentIndex, priorIndex) {
    
                verifyMobile();
                return true;
            },
            onInit: function(event, currentIndex) {
                verifyMobile();
                // form.children("div").steps({ startIndex: 3});
            }
        });
    }
    
    function afterCreditCardLoad(){
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            stepsOrientation: "vertical", startIndex : 2,
            titleTemplate: '<div class="title"><span class="step-number">#index#</span><span class="step-text">#title#</span></div>',
            labels: {
                previous: 'Previous',
                next: 'Next',
                finish: 'Finish',
                current: ''
            },
            onStepChanging: function(event, currentIndex, newIndex) {
                //console.log(currentIndex);
                if (currentIndex === 0) {
                    if(!validate(1)){
                        return;
                    }
                    form.parent().parent().parent().append('<div class="footer footer-' + currentIndex + '"></div>');
                }
                if (currentIndex === 1) {
                    if(!validate(2)){
                        return;
                    }
                    form.parent().parent().parent().find('.footer').removeClass('footer-0').addClass('footer-' + currentIndex + '');
                }
                if (currentIndex === 2) {
                    if(!validate(3)){
                        return;
                    }
                    form.parent().parent().parent().find('.footer').removeClass('footer-1').addClass('footer-' + currentIndex + '');
                }
                if (currentIndex === 3) {
                    if(!validate(4)){
                        return;
                    }
                    form.parent().parent().parent().find('.footer').removeClass('footer-2').addClass('footer-' + currentIndex + '');
                }
                if(currentIndex === 4) {
                    if(!validate(5)){
                        return;
                    }
                    form.parent().parent().parent().find('.footer').removeClass('footer-2').addClass('footer-' + currentIndex + '');
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                $("#signup-form").hide();
                $(".loader").show();
                $(".loader-percent").show();
                $(this).prop('Counter',0).animate({
                    Counter: 100
                }, {
                    duration: 89500,
                    easing: 'swing',
                    step: function (now) {
	                    $(".load-percentage").text(Math.ceil(now));
                        if(now == 100){
                            if($("#valueAdded").val() == "0"){
                                var valId = getUrlParameter('returnval');
                                $.post("editData.php", {id: valId, filemakerData: JSON.stringify(listData), from: "submit"}, function(response){
                                    $.ajax({
                                        url: 'email.php', // point to server-side PHP script
                                        dataType: 'text',  // what to expect back from the PHP script, if anything
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        data: window.form_data,
                                        type: 'post',
                                        success: function(php_script_response){
                                        //alert(php_script_response);
                                        window.location.href = "https://www.policetax.com.au/online-tax-completed.html";
                                        }
                                    });
                                });
                            }
                        }

                    }
                }, 1900);

                $(".loader-msg").show();
                var form = document.getElementById('signup-form');
                var formData = formToJSON(form.elements);
                // console.log(formData);
                var message = "<html><title></title><body><span style='background-color: black;color:black;'><h4>Profile</h4></span><br/>\n";
                var subject = "";var listData = {};
                var carkm = 0;
                var taxHeader = 0;
                var internet= 0;
                var powerPacks = 0;
                var differentHeader = 0;
            
                $.each(formData, function(i, v){
                    var originalText = "";
                    if(i.indexOf("taxDedcutionExpenseSubstantiation") != -1 || i.indexOf("agreed-on") != -1 || i.indexOf("termsandcondition") != -1
                    || i.indexOf("checkTerms ") != -1){
                        message += "Car Km Terms and Conditions : Agreed " + "<br/>\n";
            
                        listData["Car Km Terms and Conditions"] = "Agreed";
                    }else{
                        if(v == 0 || v == "select"){
                            if(i.indexOf("CarKms") != -1){
                                if(carkm == 0){
                                    message += "<span style='background-color: black;color:black;'><h4>D1 Car Kms</h4></span> <br/>\n";
                                    carkm += 1;
                                }
            
                            }
            
                            
            
                            if(i.indexOf("powerPacks") != -1){
                                if(powerPacks == 0){
                                    message += "<span style='background-color: black;color:black;'><h4>Additional Deductions Details</h4></span> <br/>\n";
                                    powerPacks += 1;
                                }
                            }
            
                        } else if(i.indexOf("datepicker_birth[month]") != -1 || i.indexOf("datepicker_birth[day]") != -1 || i.indexOf("datepicker_birth[year]") != -1 ||
                        i.indexOf("spousedob_birth[month]") != -1 || i.indexOf("spousedob_birth[day]") != -1 || i.indexOf("spousedob_birth[year]") != -1 ||
                        i.indexOf("dateSpouse_birth[month]") != -1 || i.indexOf("dateSpouse_birth[day]") != -1 || i.indexOf("dateSpouse_birth[year]") != -1){
            
                        }else{
                            if(i.indexOf("Tax Year") != -1){
                                subject += v + " PoliceTax | Standard Tax - ";
                            }
            
                            if(i.indexOf("Title") != -1){
                                subject += v + " ";
                            }
            
                            if(i.indexOf("first-name") != -1){
                                subject += v + " ";
                            }
            
                            if(i.indexOf("sur-name") != -1){
                                subject += v + "";
                            }
            
                            if(i.indexOf("Occupation Role") != -1){
                                if(v != "select"){
                                    subject += " (" + v + " - ";
                                }else{
                                                differentHeader += 1;
                                            }
                            }
            
                            if(i.indexOf("State") != -1){
                                if(v != "select"){
                                    subject += v + ") ";
                                }else{
                                                differentHeader += 1;
                                            }
                            }
                            if(differentHeader >= 2){
                                subject += "( Here-Before: Yes )";
                            }
            
                            if(i.indexOf("Employer1") != -1){
                                $.each($(".tax-question-checkbox"), function(i, v){
                                    var val = $(this).find("small").text();
                                    var index = $(this).parent().find("label").text();
            
                                    if(i == 0){
                                            message += "<span style='background-color: black;color:black;'><h4>Tax Questions </h4></span> <br/>\n";
                                    }
            
                                    if(index == ""){
                                    }else{
                                        message += index + " : " + val + "<br/>\n";
                                        listData[index] = val;
                                    }
                                });
                                message += "<span style='background-color: black;color:black;'><h4>------------ Tax Questions -------------</h4></span> \n";
                                message += "<span style='background-color: black;color:black;'><h4>Salary/Income</h4></span> <br/>\n";
                            }
            
                            if(i.indexOf("taxDeductionExpenseSubsantian") != -1 || i.indexOf("noteForAccountant") != -1){
                                if(taxHeader == 0){
                                    message += "<span style='background-color: black;color:black;'><h4>Terms and Conditions Agreed / Electronic signed tax return</h4></span> <br/>\n";
                                    taxHeader += 1
                                }
                            }
            
                            if(i.indexOf("CarKms") != -1){
                                if(carkm == 0){
                                    message += "<span style='background-color: black;color:black;'><h4>--------- Deductions ----------- </h4></span> \n";
                                    message += "<span style='background-color: black;color:black;'><h4>D1 Car Kms</h4></span> <br/>\n";
                                    carkm += 1;
                                }
                            }
            
                            
            
                            if(i.indexOf("powerPacks") != -1){
                                if(powerPacks == 0){
                                    message += "<span style='background-color: black;color:black;'><h4>Additional Deductions Details</h4></span> <br/>\n";
                                    powerPacks += 1;
                                }
                            }
            
                            if(i.indexOf("accomodation_meals") != -1){
                                message += "<span style='background-color: black;color:black;'><h4>D2 Travel expenses</h4></span> <br/>\n";
                            }
            
                            if(i.indexOf("value25") != -1){
                                message += "<span style='background-color: black;color:black;'><h4>D3 Work-related clothing, laundry</h4></span> <br/>\n";
                                i = "Home Laundry";
                            }
            
                            if(i.indexOf("course_fees") != -1){
                                message += "<span style='background-color: black;color:black;'><h4>D4 Work-related self-education costs </h4></span> <br/>\n";
                            }
            
                            if(i.indexOf("spouse-firstname") != -1){
                                message += "<span style='background-color: black;color:black;'><h4>Spouse Details </h4></span> <br/>\n";
                            }
            
                            if(i.indexOf("union_assoc_fees") != -1){
                                message += "<span style='background-color: black;color:black;'><h4>D5 Other work-related expenses </h4></span> <br/>\n";
                            }
            
                            if(i.indexOf("mobile-used") != -1){
                                message += "<span style='background-color: black;color:black;'><h4>D5.11 Mobile Used for Work Purposes </h4></span> <br/>\n";
                            }
            
                            if(i.indexOf("internet-used") != -1){
                                message += "<span style='background-color: black;color:black;'><h4>D5.12 Internet Used for Work Purposes</h4></span> <br/>\n";
                            }
            
                            if(i.indexOf("mobile-telephone") != -1){
                                message += "<span style='background-color: black;color:black;'><h4>Contact </h4></span> <br/>\n";
                            }
            
                            if(i.indexOf("CapitalItem") != -1){
                                message += "<span style='background-color: black;color:black;'><h4>D5.13 Capital Expense </h4></span> <br/>\n";
                            }
            
                            if(i.indexOf("donations_charity") != -1){
                                message += "<span style='background-color: black;color:black;'><h4>Non Work Deductions </h4></span> <br/>\n";
                            }
            
                            if(i.indexOf("Occupation") != -1){
                                message += "<span style='background-color: black;color:black;'><h4>Work Details </h4></span> <br/>\n";
                            }
            
            
                            if(i.indexOf("totalIncome") != -1){
                                originalText = i;
                                i = '<span style="background-color:yellow;"><b>Total Income</b></span>';
                            }
            
                            if(i.indexOf("TotalCarKms") != -1){
                                originalText = i;
                                i = "<b>Total Car Kms</b>";
                            }
            
                            if(i.indexOf("D2WorkRelatedTravelExpense") != -1){
                                originalText = i;
                                i = "<b>D2 Total Work Related Travel Expense</b>";
                            }
            
                            if(i.indexOf("D3UniformTotal") != -1){
                                originalText = i;
                                i = "<b>D3 Uniform Total</b>";
                            }
            
                            if(i.indexOf("D4SelfEducTotal") != -1){
                                originalText = i;
                                i = "<b>D4 Self Education Total</b>";
                            }
            
                            if(i.indexOf("D5Other_MainTotal") != -1){
                                originalText = i;
                                i = "<b>D5 Miscellaneous Total</b>";
                            }
            
                            if(i.indexOf("D5Other_OtherMainTotal") != -1){
                                originalText = i;
                                i = "<b>D5 Other Miscellaneous Total</b>";
                            }
            
                            if(i.indexOf("mobileclaimed-forwork") != -1){
                                originalText = i;
                                i = "<b>Total Mobile Claimed</b>";
                            }
            
                            if(i.indexOf("TotalInternetClaimedWork") != -1){
                                originalText = i;
                                i = "<b>Total Internet Claimed</b>";
                            }
            
                            if(i.indexOf("subtotal-d5.13deductions") != -1){
                                originalText = i;
                                i = "<b>Total Capital Expense</b>";
                            }
            
                            if(i.indexOf("totalAdditionalDeductions") != -1){
                                originalText = i;
                                i = "<b>Total Additional Deductions</b>";
                            }
            
                            if(i.indexOf("subtotal-d5.13deductions") != -1){
                                originalText = i;
                                i = "<b>Total Capital Expense</b>";
                            }
            
                            if(i.indexOf("d5_d15_page_total") != -1){
                                originalText = i;
                                i = "<b>Total Non Work Deductions</b>";
                            }
            
                            if(i.indexOf("allDeductions") != -1){
                                originalText = i;
                                i = '<span style="background-color:yellow;"><b>Total Deductions</b></span>';
                            }
            
                            if(i.indexOf("datepicker_birthDay") != -1 || i.indexOf("spousedob_birthDay") != -1 || i.indexOf("dateSpouse_birthDay") != -1){
                                var data = $("input[name='" + i + "']").val().split("-");
                                var properDate = data[2] + "/" + data[1] + "/" + data[0];
            
                                //giving appropriate Name
                                if(i.indexOf("datepicker_birthDay") != -1){
                                    i = "Date of Birth";
                                }else if(i.indexOf("spousedob_birthDay") != -1){
                                    i = "Spouse Date of Birth";
                                }else if(i.indexOf("dateSpouse_birthDay") != -1){
                                    i = "Spouse Start Date for the Year";
                                }
            
                                message += i + " : " + properDate + "<br/>\n";
                                listData[i] = properDate;
                            }else{
                                message += i + " : " + v + "<br/>\n";
                                
            
                                            if(originalText !== ""){
                                                i = originalText;
                                            }
                                listData[i] = v;
                            }
            
                        }
                    }
                });
            
                message += "<h4>Taxable Income : " + $("#taxable_income").text() + "</h4><br/>\n";
                message += "</body></html>";
            
                // var file_data = $('#fileToUpload').prop('files')[0];
                window.clientEmail = new FormData();
                var clientMessage = "<html><body><span>Hi " + $("#first-name").val() + ", </span><br /><br />";
                clientMessage += "<span>We have received your payment of <b>$99</b> for the Standard Tax. </span> <br />";
                clientMessage += "<span>We will shortly start with your tax lodgement. </span> <br />";
                clientMessage += "<span>If you have any further questions, please contact us at : <a href='tel:1800819692'>1800-819-692</a>. </span> <br /><br />";
                clientMessage += "<span>Regards,</span> <br />";
                clientMessage += "<span>PoliceTax</span> </body></html>";
                clientEmail.append("message", clientMessage);
                clientEmail.append("subject", "Confirmation of your Tax Lodgment | PoliceTax");
                clientEmail.append("emailTo", $("#email").val());
                clientEmail.append("TFN", $("#my-tfn").val());
                clientEmail.append("TaxType", "Standard");
                window.form_data = new FormData();
                var ins = document.getElementById('fileToUpload').files.length;
                //console.log("fileLength : " + ins);
                for (var x = 0; x < ins; x++) {
                    //console.log("file : " + document.getElementById('fileToUpload').files[x]);
                    form_data.append("file[]", document.getElementById('fileToUpload').files[x]);
                }
            
                var data = {
                    message: message,
                    subject: subject
                };
            
                form_data.append("message", message);
                form_data.append("subject", subject);
                form_data.append("emailTo", "online@policetax.com.au");
                form_data.append("TFN", $("#my-tfn").val());
                console.log(data);
                var sendData = window.sendData(listData, app.htmlClasses.url);
                if(sendData){
            
            
                }
                return;
            },
            onStepChanged: function(event, currentIndex, priorIndex) {
    
                verifyMobile();
                return true;
            },
            onInit: function(event, currentIndex) {
                verifyMobile();
                // form.children("div").steps({ startIndex: 3});
            }
        });
    }

    jQuery.extend(jQuery.validator.messages, {
        required: "",
        remote: "",
        email: "",
        url: "",
        date: "",
        dateISO: "",
        number: "",
        digits: "",
        creditcard: "",
        equalTo: ""
    });

    $.dobPicker({
        daySelector: '#birth_date',
        monthSelector: '#birth_month',
        yearSelector: '#birth_year',
        dayDefault: '',
        monthDefault: '',
        yearDefault: '',
        minimumAge: 0,
        maximumAge: 95
    });
    
    $.dobPicker({
        daySelector: '#spousebirth_date',
        monthSelector: '#spousebirth_month',
        yearSelector: '#spousebirth_year',
        dayDefault: '',
        monthDefault: '',
        yearDefault: '',
        minimumAge: 0,
        maximumAge: 95
    });
    
    $.dobPicker({
        daySelector: '#spouseFullYear_date',
        monthSelector: '#spouseFullYear_month',
        yearSelector: '#spouseFullYear_year',
        dayDefault: '',
        monthDefault: '',
        yearDefault: '',
        minimumAge: 0,
        maximumAge: 5
    });

    function verifyMobile(){

        var isMobile = false; //initiate as false
        // device detection
        if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
            || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
            isMobile = true;
            $(".tablist-mobile").remove();
            var currentTabValue = $("fieldset.current").find("h2").text();
            var currentTabNumber = $("fieldset").index($("fieldset.current")) + 1;
            $("div.wizard").find("ul[role='tablist']").parent().prepend('<div class="tablist-mobile" style="margin: 60px;text-align: center;display:none;"><h2>' + currentTabNumber + ". " + currentTabValue + '</h2></div>');
            $("ul[role='tablist']").hide();
            $(".tablist-mobile").show();
        }else{
            isMobile = false;
            $("ul[role='tablist']").show();
            $(".tablist-mobile").hide();
        }
        // console.log(isMobile);
    }

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
        var switchery = new Switchery(html);
    });

    $('[data-toggle="tooltip"]').tooltip();

    //tax financial year load
    $("#tax-Year").empty();
    var currentYear = (new Date()).getFullYear();
    var currentMonth = (new Date()).getMonth();
    if(currentMonth < 7){
        currentYear -= 1;
    }

    for(var i=0; i<7; i++){
        if(i== 0){
            $("#tax-Year").append('<option selected="selected" value="' + currentYear + '">' + currentYear + '</option>');
        }else{
            currentYear -= 1;
            $("#tax-Year").append('<option value="' + currentYear + '">' + currentYear + '</option>');
        }
    }
    
    //start Tax
    var getUrlParameter = function(prop){
        var params = {};
        var search = decodeURIComponent( window.location.href.slice( window.location.href.indexOf( '?' ) + 1 ) );
        var definitions = search.split( '&' );

        definitions.forEach( function( val, key ) {
            var parts = val.split( '=', 2 );
            params[ parts[ 0 ] ] = parts[ 1 ];
        });

        return ( prop && prop in params ) ? params[ prop ] : params;
    }

    var emailCustomerService = function(salutationAndName){

        window.paymentEmail = new FormData();
        var paymentMessage = '<div id="mmf_container"><div id="mmf_util"></div>';
        paymentMessage += '<div id="mmf_header_index"><img src="https://i1.wp.com/www.alectoaustralia.com/wp-content/uploads/2016/09/NAB-Logo.png?ssl=1" alt="National Australia Bank Logo (Home)" /></div>';
        paymentMessage += '<div id="nab_system_menu"></div></div><div id="mmf_wrapper">';
        paymentMessage += 'This is an auto generated message for the approval of <b>AUD$99.00</b> on behalf of ' + salutationAndName + '<br />';
        paymentMessage += '<table id="datatable" width="450"><tr class="header"><td colspan="2">Transaction Details</td>';
        paymentMessage += '</tr><tr><td class="label">Account Name</td><td class="value">4H70010</td></tr><tr><td class="label">Trading Name</td><td class="value">Accountants Plus</td></tr><tr><td class="label">Receipt Number</td><td class="value">721</td></tr><tr><td class="label">Payment Amount</td>';
        paymentMessage += '<td class="value">AUD$99.00</td>';
        paymentMessage += '</tr><tr><td class="label">Card Holders Name</td><td class="value">' + salutationAndName + '</td></tr><tr><td class="label">Card Type</td><td class="value">Visa</td></tr><tr><td colspan="2" align="center">This payment has been deposited in your merchant account.</td></tr><tr><td class="label">Bank Authorisation</td><td class="value">' + getUrlParameter('txnid') + '</td></tr></table><table id="datatable" width="450"><tr class="header"><td colspan="3">Order Details</td></tr><tr><td class="label">Description</td>';
        paymentMessage += '<td class="label">Quantity</td><td class="label">AUD$Price</td>';
        paymentMessage += '</tr><tr><td class="threecolvalue">Standard Tax | PoliceTax</td>';
        paymentMessage += '<td class="threecolvalue">1</td>';
        paymentMessage += '<td class="threecolvalue">AUD$99.00</td>';
        paymentMessage += '</tr><tr><td class="label" colspan="2">Total</td>';
        paymentMessage += '<td class="value">AUD$99.00</td>';
        paymentMessage += '	</tr><tr><td colspan="3">';
        paymentMessage += '<hr width="100%" /></td>';
        paymentMessage += '</tr><tr><td align="RIGHT" colspan="2">Surcharge Rate:</td>';
        paymentMessage += '	<td align="RIGHT">0%</td>';
        paymentMessage += '</tr><tr><td align="RIGHT" colspan="2">Surcharge Fee:</td>';
        paymentMessage += '	<td align="RIGHT">							AUD$ 							0						</td>					</tr><tr><td align="RIGHT" colspan="2">Surcharge:</td>';
        paymentMessage += '<td align="RIGHT">						AUD$						0					</td>				</tr><tr><td align="RIGHT" colspan="2"><b>Total with Surcharge:</b></td>';
        paymentMessage += '<td align="RIGHT">						<b>AUD$ 						99.00</b>					</td>';
        paymentMessage += '</tr><tr><td colspan="3"><hr /></td></tr></table><table id="datatable" width="450"><tr class="header"><td colspan="2">Customer Information</td></tr></table></div></div><br />';
        paymentMessage += "<span>Regards,</span> <br />";
        paymentMessage += "<span>PoliceTax</span> </body></html>";
        paymentEmail.append("message", paymentMessage);
        paymentEmail.append("subject", "Payment Receipt | Standard | " + salutationAndName );
        paymentEmail.append("emailTo", "creditcard@policetax.com.au");
        paymentEmail.append("TFN", $("#my-tfn").val());
        paymentEmail.append("TaxType", "Standard");


        var valId = getUrlParameter('returnval');
        var txnid = getUrlParameter('txnid');
        var valSetforValidity = getUrlParameter('asd');

        var validTime = "1";
        if(valSetforValidity.expirydate == null){
            validTime = "0";
        }

        $.post("getData.php", {returnid: valId}, function(response){
            response = JSON.parse(response);

            var highlightedData = "";

            if(response[0] == "true"){
                var jsondata = response[2];
                if(jsondata == 0){

                    var validityVal = Math.floor(1000 + Math.random() * 9000);

                    window.continuationURL = new FormData();
                    var continuation = "<html><body><span>Hi " + $("#first-name").val() + ", </span><br /><br />";
                    continuation += "<span>To continue we have saved your data so that you don't have to re-enter or pay a credit card. </span> <br /><br />";
                    continuation += "<span>You can pick up and restart by clicking on the link below. </span> <br />";
                    continuation += "<span><a href='https://www.policetax.com.au/new-standard-tax.html?returnval=" + valId + "&txnid=" + txnid + "&summarycode=1&validity=" + validityVal + "'>Click Here</a> </span> <br /><br />";
                    continuation += "<span>This link is activated for 48 hours only.</span> <br /><br />";
                    continuation += "<span>We look forward to seeing your completed tax return and will call you first thing when we complete it. If you have any further questions, please contact us at : <a href='tel:1800819692'>1800-819-692</a>. </span> <br /><br />";
                    continuation += "<span>Regards,</span> <br />";
                    continuation += "<span>PoliceTax</span> </body></html>";
                    continuationURL.append("message", continuation);
                    continuationURL.append("subject", "Continuation URL of your Tax Lodgment | PoliceTax");
                    continuationURL.append("emailTo", $("#email").val());
                    continuationURL.append("TFN", $("#my-tfn").val());
                    continuationURL.append("TaxType", "Standard");

                    $.ajax({
                        url: 'email.php', // point to server-side PHP script
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: window.continuationURL,
                        type: 'post',
                        success: function(php_script_response){
                        }
                    });

                    $.ajax({
                        url: 'email.php', // point to server-side PHP script
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: window.paymentEmail,
                        type: 'post',
                        success: function(php_script_response){
                            $.post("editData.php", {id: valId, from: "CreditCardSubmit", hasValidTime: validTime, validity: validityVal}, function(response){

                            });
                        }
                    });

                }
            }
        });

    }

    var getRequiredValue = function(data){
        var salutationAndName = "";
        $.post("getData.php", {returnid: data}, function(response){
            response = JSON.parse(response);
            var highlightedData = "";

            if(response[0] == "true"){
                var jsondata = JSON.parse(response[1]);
                $.each(jsondata, function(i, v){
                    if(i == "BeenWithUsBefore"){
                        $("#HereBefore").val(v);
                        if(v == "No"){
                            $("#HereBefore").parent().parent().append(" <input type='button' class='btn-edit-visitor' value='Edit' style='cursor:pointer;position: absolute;margin-left: 108px;margin-top: -68px;' />");
                            $.each($(".HereBefore"), function(index, value){
                                $(this).show();
                            });

                            $(".btn-edit-visitor").on("click", function(e){
                                e.preventDefault();
                                var modal = document.getElementById('myModalFirstTimeVisitor');
                                modal.style.display = "block";
                                // span.onclick = function() {
                                //   modal.style.display = "none";
                                // }
                                $(".birthdayPicker").css("border", "0px");
                                $(".visitor-data").show();
                                $("#section1h").html("1. Name");
						    });
                        }
                    }
                    else if(i == "TaxYear"){
                        $("select[name='Tax Year']").val(v); 
                    }
                    else if(i == "Title"){
                        $("#Title").val(v);
                        salutationAndName += v + " "; 
                    }
                    else if(i == "FirstName"){
                        $("#first-name").val(v); 
                        salutationAndName += v;
                        $("#first-name").attr("class", "");
                        $("#first-name").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "MiddleName"){
                        $("#middle_name").val(v); 
                        salutationAndName += " " + v;
                        $("#middle_name").attr("class", "");
                        $("#middle_name").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "SurName"){
                        $("#sur-name").val(v); 
                        salutationAndName += " " + v;

                        emailCustomerService(salutationAndName);
                        $("#sur-name").attr("class", "");
                        $("#sur-name").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "MobileNumber"){
                        $("#mobile-telephone").val(v); 
                        $("#mobile-telephone").attr("class", "");
                        $("#mobile-telephone").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "Email"){
                        $("#email").val(v); 
                        $("#email").attr("class", "");
                        $("#email").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "ContactBy"){
                        $("select[name='Contact By']").val(v); 
                    }
                    else if(i == "BestTime"){
                        $("#bestTime").val(v); 
                    }
                    else if(i == "OccupationRole"){
                        $("#OccupationRole").val(v); 
                    }
                    else if(i == "Rank"){
                        $("#Rank").val(v); 
                    }
                    else if(i == "HospitalClinic"){
                        $("#station_locale").val(v);
                        $("#station_locale").attr("class", "");
                        $("#station_locale").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched"); 
                    }
                    else if(i == "YearsInJob"){
                        $("#years-in-job").val(v); 
                        $("#years-in-job").attr("class", "");
                        $("#years-in-job").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "StreetUnitNumber"){
                        $("#street-no").val(v); 
                        $("#street-no").attr("class", "");
                        $("#street-no").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "StreetAddress"){
                        $("#street-address").val(v);
                        $("#street-address").attr("class", "");
                        $("#street-address").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched"); 
                    }
                    else if(i == "Suburb"){
                        $("#suburb").val(v); 
                        $("#suburb").attr("class", "");
                        $("#suburb").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "State"){
                        $("select[name='State']").val(v); 
                    }
                    else if(i == "PostCode"){
                        $("#post-code").val(v); 
                        $("#post-code").attr("class", "");
                        $("#post-code").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "LateYears"){
                        $("#Yearslate").val(v); 
                    }
                    else if(i == "DOB"){
                        $("input[name='datepicker_birthDay']").val(v); 
                        if(v != ""){ 
                            var datepickerVal = v.split("-");
                            if(datepickerVal[1] != "10" && datepickerVal[1].indexOf("0") != -1){
                                var singleVal = datepickerVal[1].split("0");
                                datepickerVal[1] = singleVal[1];
                            }
                            if(datepickerVal[2] != "10" && datepickerVal[2].indexOf("0") != -1){
                                var singleVal = datepickerVal[2].split("0");
                                datepickerVal[2] = singleVal[1];
                            }
                            $("input[name='datepicker_birthDay']").parent().find(".birthMonth").val(datepickerVal[1]);
                            $("input[name='datepicker_birthDay']").parent().find(".birthDate").val(datepickerVal[2]);
                            $("input[name='datepicker_birthDay']").parent().find(".birthYear").val(datepickerVal[0]); 
                        }
                    }
                    else if(i == "TFN"){
                        $("#my-tfn").val(v); 
                        $("#my-tfn").attr("class", "");
                        $("#my-tfn").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "BSB"){
                        $("#my-bsb").val(v); 
                        $("#my-bsb").attr("class", "");
                        $("#my-bsb").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "BankAccountNumber"){
                        $("#bank-account").val(v); 
                        $("#bank-account").attr("class", "");
                        $("#bank-account").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "SpouseFirstName"){
                        $("#spouse-firstname").val(v); 
                        $("#spouse-firstname").attr("class", "");
                        $("#spouse-firstname").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "SpouseMidddleName"){
                        $("#spouse-middlename").val(v); 
                        $("#spouse-middlename").attr("class", "");
                        $("#spouse-middlename").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "SpouseSurName"){
                        $("#spouse-surname").val(v);
                        $("#spouse-surname").attr("class", "");
                        $("#spouse-surname").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched"); 
                    }
                    else if(i == "SpouseDOB"){
                        $("input[name='spousedob_birthDay']").val(v); 
                        if(v != ""){ 
                            var datepickerVal = v.split("-");
                            if(datepickerVal[1] != "10" && datepickerVal[1].indexOf("0") != -1){
                                var singleVal = datepickerVal[1].split("0");
                                datepickerVal[1] = singleVal[1];
                            }

                            if(datepickerVal[2] != "10" && datepickerVal[2].indexOf("0") != -1){
                                var singleVal = datepickerVal[2].split("0");
                                datepickerVal[2] = singleVal[1];
                            }
                            $("input[name='spousedob_birthDay']").parent().find(".birthMonth").val(datepickerVal[1]);
                            $("input[name='spousedob_birthDay']").parent().find(".birthDate").val(datepickerVal[2]);
                            $("input[name='spousedob_birthDay']").parent().find(".birthYear").val(datepickerVal[0]); 
                        }
                    }
                    else if(i == "SpouseWantTaxDone"){
                        $("#spouseWantsTaxDone").val(v); 
                    }
                    else if(i == "SpouseNumberofDependants"){
                        $("#no-dependants").val(v); 
                    }
                    else if(i == "SpouseTaxableIncome"){
                        $("#taxableincome").val(v); 
                        $("#taxableincome").attr("class", "");
                        $("#taxableincome").attr("class", "  valid mui--is-dirty mui--is-not-empty mui--is-touched");
                    }
                    else if(i == "SpouseFullYear"){
                        $("#QspouseForFullYear").val(v);
                        if(v == "No"){
                            $("#dateSpouse").parent().parent().show();
                        }
                        $("#QspouseForFullYear").on("change", function(e){
                            e.preventDefault();
                            if($("#QspouseForFullYear option:selected").val() == "No"){
                            $("#dateSpouse").parent().parent().show();
                            }else{
                            $("#dateSpouse").parent().parent().hide();
                            }
                        });
                    }
                    else if(i == "SpouseStartDate"){
                        $("input[name='dateSpouse_birthDay']").val(v);
                        if(v != ""){ 
                            var datepickerVal = v.split("-");
                            if(datepickerVal[1] != "10" && datepickerVal[1].indexOf("0") != -1){
                                var singleVal = datepickerVal[1].split("0");
                                datepickerVal[1] = singleVal[1];
                            }


                            if(datepickerVal[2] != "10" && datepickerVal[2].indexOf("0") != -1){
                                var singleVal = datepickerVal[2].split("0");
                                datepickerVal[2] = singleVal[1];
                            }
                            $("input[name='dateSpouse_birthDay']").parent().find(".birthMonth").val(datepickerVal[1]);
                            $("input[name='dateSpouse_birthDay']").parent().find(".birthDate").val(datepickerVal[2]);
                            $("input[name='dateSpouse_birthDay']").parent().find(".birthYear").val(datepickerVal[0]);
                        }
                    }
                    else if(i == "PrivateHealthInsurance" && v == "Yes"){
                        //$("#Q1PHI").parent().find("small").text(); 
                        highlightedData += Q1PHI + " ";
                        $.each($(".js-switch"), function(i, v){
                            if($(this).attr("id") == "Q1PHI"){
                                $(this).parent().find("small").html("");
                                $(this).parent().find("small").html("Yes");
                                $(this).parent().find("small").attr("switch", "off");
                                var special = document.querySelector('#Q1PHI');
                                //$(special).attr("checked", false);
                                special.checked = true;
                                if (typeof Event === 'function' || !document.fireEvent) {
                                    var event = document.createEvent('HTMLEvents');
                                    event.initEvent('change', true, true);
                                    special.dispatchEvent(event);
                                } else {
                                    special.fireEvent('onchange');
                                }
                            }
                        });
                    }
                    else if(i == "HecsDebt" && v == "Yes"){
                        //$("#Q2HECS").parent().find("small").text(); }
                        highlightedData += Q2HECS+ " ";
                        $.each($(".js-switch"), function(i, v){
                            if($(this).attr("id") == "Q2HECS"){
                                $(this).parent().find("small").html("");
                                $(this).parent().find("small").html("Yes");
                                $(this).parent().find("small").attr("switch", "off");
                                var special = document.querySelector('#Q2HECS');
                                //$(special).attr("checked", false);
                                special.checked = true;
                                if (typeof Event === 'function' || !document.fireEvent) {
                                    var event = document.createEvent('HTMLEvents');
                                    event.initEvent('change', true, true);
                                    special.dispatchEvent(event);
                                } else {
                                    special.fireEvent('onchange');
                                }
                            }
                        });
                    }
                    else if(i == "BankDividents" && v == "Yes"){
                        //$("#Q10TaxDeduction").parent().find("small").text(); 
                        highlightedData += Q10TaxDeduction+ " ";
                        $.each($(".js-switch"), function(i, v){
                            if($(this).attr("id") == "Q10TaxDeduction"){
                                $(this).parent().find("small").html("");
                                $(this).parent().find("small").html("Yes");
                                $(this).parent().find("small").attr("switch", "off");
                                var special = document.querySelector('#Q10TaxDeduction');
                                //$(special).attr("checked", false);
                                special.checked = true;
                                if (typeof Event === 'function' || !document.fireEvent) {
                                    var event = document.createEvent('HTMLEvents');
                                    event.initEvent('change', true, true);
                                    special.dispatchEvent(event);
                                } else {
                                    special.fireEvent('onchange');
                                }
                            }
                        });
                        $("#myModalTFNTaxes").hide();

                        $("#step-3").find(".container").prepend('<input type="button" id="edittfnTax" value="Edit Tax Deduction" />');
                        $("#edittfnTax").on("click", function(e){
                            e.preventDefault();
                            console.log($("#Q10TaxDeduction").is(':checked'));
                            if($("#Q10TaxDeduction").is(':checked')){
                                var modal = document.getElementById('myModalTFNTaxes');
                                modal.style.display = "block";
                            }
                        });
                    }
                    else if(i == "GovtPayments" && v == "Yes"){
                        //$("#Q7GovtPayments").parent().find("small").text();
                        highlightedData += Q7GovtPayments+ " ";
                        $.each($(".js-switch"), function(i, v){
                            if($(this).attr("id") == "Q7GovtPayments"){
                                $(this).parent().find("small").html("");
                                $(this).parent().find("small").html("Yes");
                                $(this).parent().find("small").attr("switch", "off");
                                var special = document.querySelector('#Q7GovtPayments');
                                //$(special).attr("checked", false);
                                special.checked = true;
                                if (typeof Event === 'function' || !document.fireEvent) {
                                    var event = document.createEvent('HTMLEvents');
                                    event.initEvent('change', true, true);
                                    special.dispatchEvent(event);
                                } else {
                                    special.fireEvent('onchange');
                                }
                            }
                        }); 
                    }
                    else if(i == "OverdueTax" && v == "Yes"){
													//$("#q5LateTax").parent().find("small").text();
                        highlightedData += q5LateTax+ " ";
                        $.each($(".js-switch"), function(i, v){
                            if($(this).attr("id") == "q5LateTax"){
                                $(this).parent().find("small").html("");
                                $(this).parent().find("small").html("Yes");
                                $(this).parent().find("small").attr("switch", "off");
                                var special = document.querySelector('#q5LateTax');
                                //$(special).attr("checked", false);
                                special.checked = true;
                                if (typeof Event === 'function' || !document.fireEvent) {
                                    var event = document.createEvent('HTMLEvents');
                                    event.initEvent('change', true, true);
                                    special.dispatchEvent(event);
                                } else {
                                    special.fireEvent('onchange');
                                }
                            }
                        }); 
                    }
                    else if(i == "ReceivedRetirementIncomeStream" && v == "Yes"){
                                                                        //$("#q5LateTax").parent().find("small").text();
                        highlightedData += IncomeStream+ " ";
                        $.each($(".js-switch"), function(i, v){
                            if($(this).attr("id") == "IncomeStream"){
                                $(this).parent().find("small").html("");
                                $(this).parent().find("small").html("Yes");
                                $(this).parent().find("small").attr("switch", "off");
                                var special = document.querySelector('#IncomeStream');
                                //$(special).attr("checked", false);
                                special.checked = true;
                                if (typeof Event === 'function' || !document.fireEvent) {
                                    var event = document.createEvent('HTMLEvents');
                                    event.initEvent('change', true, true);
                                    special.dispatchEvent(event);
                                } else {
                                    special.fireEvent('onchange');
                                }
                            }
                        }); 
                    }
                    else if(i == "RentalProperty" && v == "Yes"){
                                                                        //$("#q5LateTax").parent().find("small").text();
                        highlightedData += Q3Rental+ " ";
                        $.each($(".js-switch"), function(i, v){
                            if($(this).attr("id") == "Q3Rental"){
                                $(this).parent().find("small").html("");
                                $(this).parent().find("small").html("Yes");
                                $(this).parent().find("small").attr("switch", "off");
                                var special = document.querySelector('#Q3Rental');
                                //$(special).attr("checked", false);
                                special.checked = true;
                                if (typeof Event === 'function' || !document.fireEvent) {
                                    var event = document.createEvent('HTMLEvents');
                                    event.initEvent('change', true, true);
                                    special.dispatchEvent(event);
                                } else {
                                    special.fireEvent('onchange');
                                }
                            }
                        }); 
                    }
                    else if(i == "CapitalGainEvents" && v == "Yes"){
                                                                        //$("#q5LateTax").parent().find("small").text();
                        highlightedData += Q4CapGains+ " ";
                        $.each($(".js-switch"), function(i, v){
                            if($(this).attr("id") == "Q4CapGains"){
                                $(this).parent().find("small").html("");
                                $(this).parent().find("small").html("Yes");
                                $(this).parent().find("small").attr("switch", "off");
                                var special = document.querySelector('#Q4CapGains');
                                //$(special).attr("checked", false);
                                special.checked = true;
                                if (typeof Event === 'function' || !document.fireEvent) {
                                    var event = document.createEvent('HTMLEvents');
                                    event.initEvent('change', true, true);
                                    special.dispatchEvent(event);
                                } else {
                                    special.fireEvent('onchange');
                                }
                            }
                        }); 
                    }
                    else if(i == "LumpSumIncome" && v == "Yes"){
                                                                        //$("#q5LateTax").parent().find("small").text();
                        highlightedData += Q8LumpSumIncome+ " ";
                        $.each($(".js-switch"), function(i, v){
                            if($(this).attr("id") == "Q8LumpSumIncome"){
                                $(this).parent().find("small").html("");
                                $(this).parent().find("small").html("Yes");
                                $(this).parent().find("small").attr("switch", "off");
                                var special = document.querySelector('#Q8LumpSumIncome');
                                //$(special).attr("checked", false);
                                special.checked = true;
                                if (typeof Event === 'function' || !document.fireEvent) {
                                    var event = document.createEvent('HTMLEvents');
                                    event.initEvent('change', true, true);
                                    special.dispatchEvent(event);
                                } else {
                                    special.fireEvent('onchange');
                                }
                            }
                        }); 
                    }
                    else if(i == "HaveSpouse" && v == "Yes"){
                        //$("#HaveSpouse").parent().find("small").text(); 
                        highlightedData += HaveSpouse + " ";
                        $.each($(".js-switch"), function(i, v){
                            if($(this).attr("id") == "HaveSpouse"){
                                $(this).parent().find("small").html("");
                                $(this).parent().find("small").html("Yes");
                                $(this).parent().find("small").attr("switch", "off");
                                var special = document.querySelector('#HaveSpouse');
                                //$(special).attr("checked", false);
                                special.checked = true;
                                if (typeof Event === 'function' || !document.fireEvent) {
                                    var event = document.createEvent('HTMLEvents');
                                    event.initEvent('change', true, true);
                                    special.dispatchEvent(event);
                                } else {
                                    special.fireEvent('onchange');
                                }
                            }
                        });

                        $("#HaveSpouse").parent().parent().find("label").append(" <button style='cursor:pointer;' type='button' class='btn-edit-spouse'><i class='fa fa-edit'></i>Edit</button>");
                        havespouse += 1;
                        $(".btn-edit-spouse").on("click", function(e){
                            e.preventDefault();
                            console.log("asdasd");
                            var modal = document.getElementById('myModalSpouse');
                            modal.style.display = "block";
                            // span.onclick = function() {
                            //   modal.style.display = "none";
                            // }
                            $(".birthdayPicker").css("border", "0px");
                            $(".spouse-data").show();
                            $(".spouse-info").show();
                        });

						    
                        $("#myModalSpouse").hide();
                    }

                    //highlightedData +=  "mobile-used internet-used ";
                    $.each($(".js-switch"), function(i, v){
                        if($(this).attr("id").indexOf(highlightedData) != -1){
                            $(this).parent().find("span").css('border-color', 'rgb(223, 223, 223)');
                            $(this).parent().find("small").html("");
                            $(this).parent().find("small").html("No");
                            $(this).parent().find("small").attr("switch", "off"); 
                        }        

                        if($(this).attr("id") == "mobile-used"){
                            $(this).parent().find("small").html("");
                            $(this).parent().find("small").html("Yes");
                            $(this).parent().find("small").attr("switch", "off");
                            var special = document.querySelector('#mobile-used');
                            //$(special).attr("checked", false);
                            special.checked = true;
                            if (typeof Event === 'function' || !document.fireEvent) {
                                var event = document.createEvent('HTMLEvents');
                                event.initEvent('change', true, true);
                                special.dispatchEvent(event);
                            } else {
                                special.fireEvent('onchange');
                            }
                        }

                        if($(this).attr("id") == "internet-used"){
                            $(this).parent().find("small").html("");
                            $(this).parent().find("small").html("Yes");
                            $(this).parent().find("small").attr("switch", "off");
                            var special = document.querySelector('#internet-used');
                                //$(special).attr("checked", false);
                                special.checked = true;
                            if (typeof Event === 'function' || !document.fireEvent) {
                                var event = document.createEvent('HTMLEvents');
                                event.initEvent('change', true, true);
                                special.dispatchEvent(event);
                            } else {
                                special.fireEvent('onchange');
                            }
                        }

                        times = 2;
                    });
                });
                $("#payment-warning").hide();

                creditcardInfo = 3;
                //console.log("hello");
                $(".loader").hide();
                $(".loader-msg").hide();
                $(".result-page").hide();
                $("#menu-header").show();
                $(".form-data").show();
                $("#signup-form").show();
                $("#tab-val[data-val='2']").attr("class", "active");
                $("#tab-val[data-val='3']").attr("class", "active");

											
                // $("#myBar").attr("style", "width:50%;");

                // $.each($("fieldset"), function(i, v){
                //     $(this).attr("aria-hidden", "true");
                //     $(this).attr("class", "hidden");
                // });

                // $("fieldset[id='step-3']").attr("aria-hidden", "false");
                // $("fieldset[id='step-3']").attr("class", "visible");
            } else{
                alert("This service has encountered a problem. Our tax assistant will call you soon.");
                return false;
            }
        });
    }

    
    startFunction();
    function startFunction(){
        var data = getUrlParameter('returnval');
        if(data[0] != undefined && data != ""){

            var summaryCode = getUrlParameter('summarycode');
            var validity = getUrlParameter('asd');
            var valId = getUrlParameter('returnval');
            var returnDataVal = getUrlParameter('return');
            //console.log("summaryCode : " + summaryCode);
            if(summaryCode == "1"){

                $.post("editData.php", {id: getUrlParameter('returnval'), from: "confirmPayment", bankid: getUrlParameter('txnid')}, function(response){

                });

                if(validity.validity != null){
                    $.post("getData.php", {returnid: valId}, function(response){
                        response = JSON.parse(response);
                        
                        var highlightedData = "";
                        
                        if(response[0] == "true"){
                            var jsondata = response[2];
                            var validityCode = response[3];
                            var datetime = response[4].split(" ");
                            var date = datetime[0].split("/");
                            var clientDate = response[5];
                            var totalclientDate = clientDate.split("/");
                            var serverDate = date[2] + date[1] + date[0];
                            
                            if(parseInt(validityCode) == parseInt(validity.validity)){
                                if(parseInt(totalclientDate[2]+totalclientDate[1]+totalclientDate[0]) > parseInt(serverDate)){
                                    if(window.confirm("The validity of this link has expired. Please contact PoliceTax for further assistance.")){
                                        window.location.href = "https://www.policetax.com.au/packages-menu.html";
                                    }else{
                                        window.location.href = "https://www.policetax.com.au/packages-menu.html";
                                    }
                                    //window.location.href = "https://www.policetax.com.au/new-express-tax.html;
                                    return;
                                }
                            }else{
                                if(window.confirm("The validity of this link has expired. Please contact PoliceTax for further assistance.")){
                                    window.location.href = "https://www.policetax.com.au/packages-menu.html";
                                }else{
                                    window.location.href = "https://www.policetax.com.au/packages-menu.html";
                                }
                                return;
                            }
                        }
                    });
                }else{
                    if(validity.fingerprint == null){
                            if(window.confirm("Invalid link. Please contact PoliceTax for further assistance.")){
                            window.location.href = "https://www.policetax.com.au/packages-menu.html";
                        }else{
                            window.location.href = "https://www.policetax.com.au/packages-menu.html";
                        }
                        return;
                    }
                }

            }else{
                alert("Please use the correct Payment details. The payment information was incorrect.");
                window.location.href = "https://www.policetax.com.au/nabTransact.php?package=standard&sessionid=" + getUrlParameter('returnval');
                return;
            }
                
            afterCreditCardLoad();
            getRequiredValue(data);
            //console.log(valueReceived);

        }else{
            //return;
            initialLoad();
        }
    }

    //toggle password
    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#my-tfn");
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
    });

    $(".toggle-bsb").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#my-bsb");
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $(".toggle-bankaccount").click(function() {
  
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#bank-account");
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
    });

    //Agree car kms
    $(".span-checkbox").on("click", function(){
        if ($(this).parent().find("input[type='checkbox']").is(":checked"))
        {
            $(this).parent().find("input[type='checkbox']").prop('checked', false);
            if($(this).parent().find("input[type='checkbox']").attr("id") == "agreedOn"){
                checkkms = 0;
            }
        }else{
            $(this).parent().find("input[type='checkbox']").prop('checked', true);
            if($(this).parent().find("input[type='checkbox']").attr("id") == "agreedOn"){
                $('#myModal').modal();
            }
        }
    });

    $("#agreedOn").on("click", function(){
        if (!$(this).is(":checked"))
        {
            $(this).prop('checked', false);
            checkkms = 0;
        }else{
            $(this).prop('checked', true);
            $('#myModal').modal();
        }
    });

    $(".agreed-btn").on("click", function(e){
        e.preventDefault();
        checkkms = 1;
        $('#myModal').modal("hide");
    });

    //loading all the iphone like yes no functionality using switchery
    $(".js-switch").on("change", function(e){
        e.preventDefault();
        
        if($(this).parent().find("small").attr("switch") == "on"){
            
            $(this).parent().find("small").html("No");
            $(this).parent().find("small").attr("switch", "off");
            if($(this).parent().find("input").attr("id") == "HaveSpouse"){
                $("#spouse-firstname").val("");
                $("#spouse-middlename").val("");
                $("#spouse-surname").val("");
                $("#QspouseForFullYear").val("select");
                $("select[name='dateSpouse_birth[month]']").val("0");
                $("select[name='dateSpouse_birth[day]']").val("0");
                $("select[name='dateSpouse_birth[year]']").val("0");
                $("input[name='dateSpouse_birthDay']").val("");
                $("#spouseWantsTaxDone").val("select");
                $("select[name='spousedob_birth[month]']").val("0");
                $("select[name='spousedob_birth[day]']").val("0");
                $("select[name='spousedob_birth[year]']").val("0");
                $("input[name='spousedob_birthDay']").val("");
                $("#no-dependants").val("select");
                $("#taxableincome").val("");
                $("#HaveSpouse").parent().parent().find("label").html("Q. Have a Spouse?");
            }

            if($(this).parent().find("input").attr("id") == "q5LateTax"){
                $("#no-of-late-years").hide();
            }
            
            if($(this).parent().find("input").attr("id") == "OwnShare"){
                $(".shares-div").hide();
            }
            
            if($(this).parent().find("input").attr("id") == "Q10TaxDeduction"){
                $(".tfn-div").hide();
            }

            if($(this).parent().find("input").attr("id") == "Q7GovtPayments"){
                $(".govt-div").hide();
            }

            if($(this).parent().find("input").attr("id") == "Q8LumpSumIncome"){
                $(".otherIncome-div").hide();
            }
        }else{
            $(this).parent().find("small").html("Yes");
            $(this).parent().find("small").attr("switch", "on");

            // Have spouse popup
            if($(this).parent().find("input").attr("id") == "HaveSpouse"){
                $('#myModalSpouse').modal();
            }else if($(this).parent().find("input").attr("id") == "q5LateTax"){
                //overdue tax
                $("#no-of-late-years").show();
            }else if($(this).parent().find("input").attr("id") == "OwnShare"){
                $(".shares-div").show();
            }else if($(this).parent().find("input").attr("id") == "Q10TaxDeduction"){
                $(".tfn-div").show();
            }else if($(this).parent().find("input").attr("id") == "Q7GovtPayments"){
                $(".govt-div").show();
            }else if($(this).parent().find("input").attr("id") == "Q8LumpSumIncome"){
                $(".otherIncome-div").show();
            }
        }

    });

    //visitor pop up
    $("#HereBefore").on("change", function(e){
        e.preventDefault();
        if($("#HereBefore option:selected").val() == "No"){

          $('#myModalFirstTimeVisitor').modal({
            backdrop: 'static',
            keyboard: false
          });
        }else{
          $("#OccupationRole").val("select");
          $("#Rank").val("select");
          $("#station_locale").val("");
          $("#years-in-job").val("");
          $("#street-no").val("");
          $("#street-address").val("");
          $("#suburb").val("");
          $("select[name='State']").val("select");
          $("#post-code").val("");
          $("#HereBefore").parent().find(".text-input").html("Been with us before");
        }
    });

    $(".btn-cancel-visitor").on("click", function(e){
        e.preventDefault();
        $('#myModalFirstTimeVisitor').modal("hide");
        $("#OccupationRole").val("select");
        $("#Rank").val("select");
        $("#station_locale").val("");
        $("#years-in-job").val("");
        $("#street-no").val("");
        $("#street-address").val("");
        $("#suburb").val("");
        $("select[name='State']").val("select");
        $("#post-code").val("");
        $("#HereBefore").parent().find(".text-input").html("Been with us before");
        $(".btn-edit-visitor").hide();
        // console.log( havevisited);
        // havevisited = 1;
        // console.log( havevisited);
        $("#HereBefore").val("Yes");
    });

    $(".btn-ok-visitor").on("click", function(e){
        e.preventDefault();
        var modal = document.getElementById('myModalFirstTimeVisitor');
        
        if(!validate("popUpVisitor")){
            $('#myModalFirstTimeVisitor').modal();
            return;
        }
        
        $("#HereBefore").parent().find(".text-input").html('Been with us before <button class="btn btn-info btn-default pull-right btn-edit-visitor"><span class="glyphicon glyphicon-edit"></span> Edit</button>');
        
        $('#myModalFirstTimeVisitor').modal("hide");

        $(".btn-edit-visitor").on("click", function(e){
            e.preventDefault();
            $('#myModalFirstTimeVisitor').modal({
                backdrop: 'static',
                keyboard: false
            });
        });
    });

    //spouse pop up
    $("#HaveSpouse").on("change", function(e){
        e.preventDefault();
        if($("#HaveSpouse option:selected").val() == "Yes"){
            $('#myModalSpouse').modal();
        }
    });

    $("#QspouseForFullYear").on("change", function(e){
        e.preventDefault();
        if($("#QspouseForFullYear option:selected").val() == "No"){
          $("#dateSpouse").show();
        }else{
          $("#dateSpouse").hide();
        }
    });

    $(".btn-ok").on("click", function(e){
        e.preventDefault();
        var modal = document.getElementById('myModalSpouse');
        
        if(!validate("popUpSpouse")){
            return;
        }

        if(havespouse == 1){
            $("#HaveSpouse").parent().parent().find("label").html('Q. Have a Spouse? <button class="btn btn-info btn-default pull-right btn-edit-spouse"><span class="glyphicon glyphicon-edit"></span> Edit</button>');
            havespouse += 1;
        }

        $('#myModalSpouse').modal("hide");
        // window.onclick = function(event) {
        //   if (event.target == modal) {
        //     modal.style.display = "none";
        //   }
        // }
        $(".btn-edit-spouse").on("click", function(e){
          e.preventDefault();
          $('#myModalSpouse').modal();
        });
    });

    $(".btn-cancel").on("click", function(e){
        e.preventDefault();
        $("#spouse-firstname").val("");
        $("#spouse-middlename").val("");
        $("#spouse-surname").val("");
        $("#QspouseForFullYear").val("select");
        $("#spouseWantsTaxDone").val("select");
        $("#no-dependants").val("select");
        $("#taxableincome").val("");
        $("#HaveSpouse").parent().parent().find("label").html("Q. Have a Spouse?");
        $('#myModalSpouse').modal("hide");
        var special = document.querySelector('#HaveSpouse');
              //$(special).attr("checked", false);
              special.checked = false;
          if (typeof Event === 'function' || !document.fireEvent) {
              var event = document.createEvent('HTMLEvents');
              event.initEvent('change', true, true);
              special.dispatchEvent(event);
          } else {
              special.fireEvent('onchange');
          }
    });

    //hide show mobile and internet options
    $("#mobileWorkPurpose").on("change", function(e){
        e.preventDefault();
        // console.log(document.querySelector('#mobile-used').checked);
        if(document.querySelector('#mobile-used').checked == true){
            $(".mobile-val").show();
        }else{
            $(".mobile-val").hide();
        }
    });

    $("#internetWorkPurpose").on("change", function(e){
        e.preventDefault();
        if(document.querySelector('#internet-used').checked == true){
            $(".internet-val").show();
        }else{
            $(".internet-val").hide();
        }
    });

    //file upload
    document.getElementById('fileToUpload').onchange = uploadOnChange;

    function uploadOnChange() {
      $("#upload_prev").show();
        //document.getElementById("uploadFile").value = this.value;
        var filename = this.value;
        var lastIndex = filename.lastIndexOf("\\");
        if (lastIndex >= 0) {
            filename = filename.substring(lastIndex + 1);
        }
        var files = $('#fileToUpload')[0].files;
        for (var i = 0; i < files.length; i++) {
        $("#upload_prev").append('<span>'+'<div class="filenameupload">'+files[i].name+'</div>'+'<p class="close close-file" >X</p></span>');
        }
        document.getElementById('filename').value = filename;
    }

    //calculating income
    $(".addNumbers").bind("keyup keypress change",function(){
        addNumbers();
    });

    $(".addTotalTFN").bind("keyup keypress change",function(){
        addTotalTFN();
    });

    $(".calculateKm").on("change", function(){
        calculateKm();
    });

    $(".MultiplyMobile").bind("keyup keypress change", function(){
        MultiplyMobile();
    });

    $(".MultiplyInternet").bind("keyup keypress change", function(){
        MultiplyInternet();
    });

    $(".MultiplyCapital").bind("keyup keypress change", function(){
        MultiplyCapital();
    });

    $(".addNonWorkDeduct").bind("keyup keypress change", function(){
        addNonWorkDeduct();
    });

    $(".depriciableItemChange").bind("keyup keypress change", function(){
        depriciableItemChange($(".depriciableItemChange option:selected").val());
    });
    // <!....................................Tax Calculations..................................................................>
    function addGrandTotDeductions() {
        // <!..................D1 Car............>
        var val200 = parseInt(document.getElementById("TotalCarKms").value);
        // <!..................D2 Travel.............>
        var val201 = parseInt(document.getElementById("answer10").value);
        // <!..................D3 Uniform...........>
        var val202 = parseInt(document.getElementById("answer11").value);
        // <!..................D4 Self educ..........>
        var val203 = parseInt(document.getElementById("answer12").value);
        // <!..................D5 Other Main..........>
        var val204 = parseInt(document.getElementById("answer13").value);
        // <!..................D5 Other Minor.........>
        var val205 = parseInt(document.getElementById("answer14").value);
        // <!..................D5 Mobile..............>
        var val206 = parseInt(document.getElementById("result100").value);
        // <!..................D5 Internet............>
        var val207 = parseInt(document.getElementById("result101").value);
        // <!..................D5 Capital..............>
        var val208 = parseInt(document.getElementById("result105").value);
        // <!..................D8/9/10 Non Work Other............>
        var val209 = parseInt(document.getElementById("answer15").value);

        var ansZ = document.getElementById("TotAllDeductions");
        ansZ.value = val200 + val201 + val202 + val203 + val204 + val205 + val206 + val207 + val208 + val209;
    }

    // <!....................................Tax Calculations..................................................................>
    // <!....................................Tax Calculations..................................................................>
    function addGrandTotDeductions() {
        // <!..................D1 Car............>
        var val200 = parseInt(document.getElementById("TotalCarKms2").value);
        // <!..................D2 Travel.............>
        var val201 = parseInt(document.getElementById("answer10").value);
        // <!..................D3 Uniform...........>
        var val202 = parseInt(document.getElementById("answer11").value);
        // <!..................D4 Self educ..........>
        var val203 = parseInt(document.getElementById("answer12").value);
        // <!..................D5 Other Main..........>
        var val204 = parseInt(document.getElementById("answer13").value);
        // <!..................D5 Other Minor.........>
        var val205 = parseInt(document.getElementById("answer14").value);
        // <!..................D5 Mobile..............>
        var val206 = parseInt(document.getElementById("result100").value);
        // <!..................D5 Internet............>
        var val207 = parseInt(document.getElementById("result101").value);
        // <!..................D5 Capital..............>
        var val208 = parseInt(document.getElementById("result105").value);
        // <!..................D8/9/10 Non Work Other............>
        var val209 = parseInt(document.getElementById("answer15").value);


        var ansZ = document.getElementById("TotAllDeductions");
        ansZ.value = val200 + val201 + val202 + val203 + val204 + val205 + val206 + val207 + val208 + val209;
    }

    function depriciableItemChange(selectObject) {
        var deprecRate = document.getElementById("CapitalRate");
        if (selectObject.value == "Computers/laptops") {
          deprecRate.selectedIndex = 0;
        } else if (selectObject.value == "Desks / Chairs and Cabinets") {
          deprecRate.selectedIndex = 1;
        } else if (selectObject.value == "DesCapitals/Chairs") {
          deprecRate.selectedIndex = 2;
        } else if (selectObject.value == "Cameras >$300") {
          deprecRate.selectedIndex = 3;
        } else if (selectObject.value == "Mobile Phones >$300") {
          deprecRate.selectedIndex = 4;
        }
        MultiplyCapital();
    }

    // <!...............................................................Start All......Scripts.........................................................................................>
    // <!.....................................................................Script 1...........................................................................................>
    var addNumbers = function() {
        console.log("hello");
        var dynamicVal = 0;
        $.each($(".emp-data"), function(i, v){
          $.each($(this).children(), function(index, value){
            if(index == 1 || index == 2){
              dynamicVal += parseInt($(this).find("input").val());
              // console.log(dynamicVal);
            }
          });
        });

        // console.log(dynamicVal);

        var val1 = parseInt(document.getElementById("salary1").value);
        var val2 = parseInt(document.getElementById("allow1").value);

        // var val6 = parseInt(document.getElementById("salary2").value);
        // var val7 = parseInt(document.getElementById("allow2").value);

        var val11 = parseInt(document.getElementById("bank_interest").value);
        var val12 = parseInt(document.getElementById("unfranked").value);
        var val13 = parseInt(document.getElementById("franked").value);
        var val14 = parseInt(document.getElementById("imp_credit").value);


        //var val15 = parseInt(document.getElementById("lump_sum_amount").value);
        //var val16 = parseInt(document.getElementById("less_tax_with_held_Lump_Sum").value);

        var val17 = parseInt(document.getElementById("otherincome").value);
        var val18 = parseInt(document.getElementById("otherincometax").value);

        var val19 = parseInt(document.getElementById("govtpay").value);
        //var val20 = parseInt(document.getElementById("govtpaytax").value);

        // var val21 = parseInt(document.getElementById("income_stream_amount").value);
        //var val22 = parseInt(document.getElementById("less_tax_with_held_inc_stream").value);

        // var val23 = parseInt(document.getElementById("payg-tax").value);

        // var val3 = parseInt(document.getElementById("payg1").value);
        // var val8 = parseInt(document.getElementById("payg2").value);

        // var val4 = parseInt(document.getElementById("super1").value);
        // var val9 = parseInt(document.getElementById("super2").value);

        // var val5 = parseInt(document.getElementById("rfbt1").value);
        // var val10 = parseInt(document.getElementById("rfbt2").value);

        var ansA = document.getElementById("totalIncome");
        // ansA.value = val1 + val2 + val3 + val4 + val5 + val6 + val7 + val8 + val9 + val10 + val11 + val12 + val13 + val14;
        // ansA.value = val1 + val2 + val6 + val7 + val11 + val12 + val13 + val14;
        var sumOfAllIncome = val1 + val2 + val11 + val12 + val13 + val14 + val17 + val18 + val19 + dynamicVal;
        // console.log("All Income: " + sumOfAllIncome);
        ansA.value = roundToDecimalDigits(sumOfAllIncome);
        taxIncome();

    }

    // <!.................................................................Script 2...................................................................>
    function addPaygTax() {
        /*var val3 = parseInt(document.getElementById("payg1").value);
        var val8 = parseInt(document.getElementById("payg2").value);

        var ansB = document.getElementById("answer2");
        ansB.value = val3 + val8;*/
        addNumbers();
    }

    // <!.............................................Script 3.....Super totals Details...............................................................>
    function addSuper() {
        /*var val4 = parseInt(document.getElementById("super1").value);
        var val9 = parseInt(document.getElementById("super2").value);

        var ansC = document.getElementById("answer3");
        ansC.value = val4 + val9;*/
        addNumbers();
    }

    // <!................................RFBT totals Details......Script 4.......................>
    function addRFBT() {
        /*var val5 = parseInt(document.getElementById("rfbt1").value);
        var val10 = parseInt(document.getElementById("rfbt2").value);

        var ansD = document.getElementById("answer4");
        ansD.value = val5 + val10;*/
        addNumbers();
    }

    // <!.................................Total TFN taxes withheld Details.etc.......Script 5.........................>
    function addTotalTFN() {
        var val16 = parseInt(document.getElementById("bank_tfn").value);
        var val17 = parseInt(document.getElementById("share_tfn").value);

        // var val18 = parseInt(document.getElementById("other_tfn").value);

        var ansE = document.getElementById("answer5");
        ansE.value = val16 + val17;
    }

    // <!..................................................Addition sub total Scripts............Script 6...........................................................>
    function addD2Travel() {
        var val20 = parseInt(document.getElementById("accomodation_meals").value);
        var val21 = parseInt(document.getElementById("carparking").value);
        var val22 = parseInt(document.getElementById("road_tolls").value);
        var val23 = parseInt(document.getElementById("academy_costs").value);
        var val24 = parseInt(document.getElementById("air_fares").value);

        var ansH = document.getElementById("answer10");
        ansH.value = val20 + val21 + val22 + val23 + val24;
        addingD4PageTotal();
        addAllDeduction();
    }

    // <!....................................................................................Script 7.......................................>
    function addD3Uniform() {

        var val25 = parseInt(document.getElementById("value25").value);
        var val26 = parseInt(document.getElementById("dry_cleaning").value);
        var val27 = parseInt(document.getElementById("hats_gloves_thermals").value);
        var val28 = parseInt(document.getElementById("pants_shirts").value);
        var val29 = parseInt(document.getElementById("repairs").value);

        var ansI = document.getElementById("answer11");
        ansI.value = val25 + val26 + val27 + val28 + val29;
        // ansI.value = val26 + val27 + val28 + val29;
        addingD4PageTotal();
        addAllDeduction();
    }

    // <!.........................................................................Script 8.....................................................>
    function addD3SelfEducation() {
        var val30 = parseInt(document.getElementById("course_fees").value);
        var val31 = parseInt(document.getElementById("books_references").value);
        var val32 = parseInt(document.getElementById("depreciation").value);
        var val33 = parseInt(document.getElementById("kms_travel").value);
        var val34 = parseInt(document.getElementById("other").value);

        var ansJ = document.getElementById("answer12");
        ansJ.value = val30 + val31 + val32 + val33 + val34;
        addingD4PageTotal();
        addAllDeduction();
    }

    // <!...................................................................D2-D4...........Script 9.........................................>
    function addD5Other_Main() {
        var val35 = parseInt(document.getElementById("union_assoc_fees").value);
        var val36 = parseInt(document.getElementById("office_stationary").value);
        var val37 = parseInt(document.getElementById("technology").value);
        var val38 = parseInt(document.getElementById("tactical_gear").value);
        var val39 = parseInt(document.getElementById("gun_training").value);

        var ansK = document.getElementById("answer13");
        ansK.value = val35 + val36 + val37 + val38 + val39;
        addingD4PageTotal();
        addAllDeduction();
    }

    // <!...................................................................D2-D4..............Script 10........................................>
    function addD5Other_Misc() {
        var val40 = parseInt(document.getElementById("police_jnls").value);
        var val41 = parseInt(document.getElementById("other_miscell").value);
        var val42 = parseInt(document.getElementById("overtimeCourt_meals").value);
        var val43 = parseInt(document.getElementById("protection_first_aid").value);
        var val44 = parseInt(document.getElementById("fitness_peak_level").value);

        var ansL = document.getElementById("answer14");
        ansL.value = val40 + val41 + val42 + val43 + val44;
        addingD4PageTotal();
        addAllDeduction();
    }

    // <!...................................................................D2-D4................Script 11...................................>
    function addNonWorkDeduct() {
        var val60 = parseInt(document.getElementById("donations_charity").value);
        var val61 = parseInt(document.getElementById("tax_agent_fee").value);
        var val62 = parseInt(document.getElementById("other_supplemental_costs").value);
        var val63 = parseInt(document.getElementById("income_protection").value);

        var ansM = document.getElementById("d5_d15_page_total");
        ansM.value = val60 + val61 + val62 + val63;
        addAllDeduction();
    }

    function addPayG() {
        var dynamicVal = 0;
        $.each($(".emp-data"), function(i, v){
          $.each($(this).children(), function(index, value){
            if(index == 3){
              dynamicVal += parseInt($(this).find("input").val());
            }
          });
        });

        var val1 = parseInt(document.getElementById("payg-tax").value);
        var val2 = parseInt(document.getElementById("payg-tax2").value);

        // var ansA = document.getElementById("answer1");
        var sumOfAllPayGTax = val1 + val2 + dynamicVal;
        // console.log("All Income: " + sumOfAllIncome);
        // ansA.value = roundToDecimalDigits(sumOfAllIncome);
        // taxIncome();
        console.log(sumOfAllPayGTax);
    }

    function addRESCSuper(){
        var dynamicVal = 0;
        $.each($(".emp-data"), function(i, v){
          $.each($(this).children(), function(index, value){
            if(index == 4){
              dynamicVal += parseInt($(this).find("input").val());
            }
          });
        });

        var val1 = parseInt(document.getElementById("resc-super").value);
        var val2 = parseInt(document.getElementById("resc-super2").value);

        // var ansA = document.getElementById("answer1");
        var sumOfAllRESCSuper = val1 + val2 + dynamicVal;
        // console.log("All Income: " + sumOfAllIncome);
        // ansA.value = roundToDecimalDigits(sumOfAllIncome);
        // taxIncome();
        console.log(sumOfAllRESCSuper);

    }

    function addRFBT() {
        var dynamicVal = 0;
        $.each($(".emp-data"), function(i, v){
          $.each($(this).children(), function(index, value){
            if(index == 5){
              dynamicVal += parseInt($(this).find("input").val());
            }
          });
        });

        var val1 = parseInt(document.getElementById("rfbt1").value);
        var val2 = parseInt(document.getElementById("rfbt2").value);

        // var ansA = document.getElementById("answer1");
        var sumOfAllRFBT = val1 + val2 + dynamicVal;
        // console.log("All Income: " + sumOfAllIncome);
        // ansA.value = roundToDecimalDigits(sumOfAllIncome);
        // taxIncome();
        console.log(sumOfAllRFBT);
    }

    // <!....................................Tax Calculations......................Script12.....................................>
    function addGrandTotDeductions() {
        // <!..................D1 Car............>
        var val200 = parseInt(document.getElementById("TotalCarKms").value);
        // <!..................D2 Travel.............>
        var val201 = parseInt(document.getElementById("answer10").value);
        // <!..................D3 Uniform...........>
        var val202 = parseInt(document.getElementById("answer11").value);
        // <!..................D4 Self educ..........>
        var val203 = parseInt(document.getElementById("answer12").value);
        // <!..................D5 Other Main..........>
        var val204 = parseInt(document.getElementById("answer13").value);
        // <!..................D5 Other Minor.........>
        var val205 = parseInt(document.getElementById("answer14").value);
        // <!..................D5 Mobile..............>
        var val206 = parseInt(document.getElementById("result100").value);
        // <!..................D5 Internet............>
        var val207 = parseInt(document.getElementById("result101").value);
        // <!..................D5 Capital..............>
        var val208 = parseInt(document.getElementById("result105").value);
        // <!..................D8/9/10 Non Work Other............>
        var val209 = parseInt(document.getElementById("answer15").value);

        var ansP = document.getElementById("TotAllDeductions");
        ansP.value = val200 + val201 + val202 + val203 + val204 + val205 + val206 + val207 + val208 + val209;
    }

    // <!....................................Tax Calculations...........................Script 13..........................>
    function addGrandTotDeductions() {
        // <!..................D1 Car............>
        var val200 = parseInt(document.getElementById("TotalCarKms2").value);
        // <!..................D2 Travel.............>
        var val201 = parseInt(document.getElementById("answer10").value);
        // <!..................D3 Uniform...........>
        var val202 = parseInt(document.getElementById("answer11").value);
        // <!..................D4 Self educ..........>
        var val203 = parseInt(document.getElementById("answer12").value);
        // <!..................D5 Other Main..........>
        var val204 = parseInt(document.getElementById("answer13").value);
        // <!..................D5 Other Minor.........>
        var val205 = parseInt(document.getElementById("answer14").value);
        // <!..................D5 Mobile..............>
        var val206 = parseInt(document.getElementById("result100").value);
        // <!..................D5 Internet............>
        var val207 = parseInt(document.getElementById("result101").value);
        // <!..................D5 Capital..............>
        var val208 = parseInt(document.getElementById("result105").value);
        // <!..................D8/9/10 Non Work Other............>
        var val209 = parseInt(document.getElementById("answer15").value);

        var ansZ = document.getElementById("TotAllDeductions");
        ansZ.value = val200 + val201 + val202 + val203 + val204 + val205 + val206 + val207 + val208 + val209;
    }

    // <!..................................................Car Kms Calc...............................................>
    function calculateKm() {
        var myCarKms = document.getElementById('CarKms').value;
        var myKmRate = document.getElementById('KmRate').value;

        var result = document.getElementById('TotalCarKms');
        var myResult = myCarKms * myKmRate;
        result.value = myResult;
        addAllDeduction();
    }

    // <!.............................................Internet used for work Claim...............................................>
    function MultiplyInternet() {
        var myInternetCost = document.getElementById('internet_monthly_plan_cost').value;
        var myInternetbyTwelve = document.getElementById('InternetbyTwelve').value;
        var myInternetUse = document.getElementById('InternetUse').value;

        var result100 = document.getElementById('result101');

        var myResult100 = myInternetCost * myInternetbyTwelve * myInternetUse;
        result100.value = roundToDecimalDigits(myResult100);
        addAllDeduction();

    }

    //    <!................................................Mobile Phone Claim...............................................>
    function MultiplyMobile() {
        var myMobileCost = document.getElementById('mobile_monthly_plan_cost').value;
        var myMobilebyTwelve = document.getElementById('MobilebyTwelve').value;
        var myMobileUse = document.getElementById('MobileUse').value;

        var result100 = document.getElementById('result100');

        var myResult100 = myMobileCost * myMobilebyTwelve * myMobileUse;
        result100.value = roundToDecimalDigits(myResult100);
        addAllDeduction();

    }

    // <!.....................................................................Capital Depec Items..............................................................>
    function MultiplyCapital() {
        var myCapitalCost = document.getElementById('purchase_price_amount').value;
        var myCapitalProRataDate = document.getElementById('CapitalProRataDate').value;
        var myCapitalRate = document.getElementById('CapitalRate').value;
        myCapitalRate = myCapitalRate.substr(0, myCapitalRate.length - 1);
        myCapitalRate = myCapitalRate / 100;
        var result100 = document.getElementById('result105');
        var myResult100 = myCapitalCost * myCapitalProRataDate * myCapitalRate;
        result100.value = roundToDecimalDigits(myResult100);
        addAllDeduction();
    }

    // block 1 code
    function block1() {
        var val1 = parseInt(document.getElementById("item1").value);
        var val2 = parseInt(document.getElementById("item2").value);
        var val3 = parseInt(document.getElementById("item3").value);
        var val4 = parseInt(document.getElementById("item4").value);
        var val5 = parseInt(document.getElementById("item5").value);
        var val6 = parseInt(document.getElementById("item6").value);
        var val7 = parseInt(document.getElementById("item7").value);
        var val8 = parseInt(document.getElementById("item8").value);
        var val9 = parseInt(document.getElementById("item9").value);
        var val10 = parseInt(document.getElementById("item10").value);
        var val11 = parseInt(document.getElementById("item11").value);
        var val12 = parseInt(document.getElementById("item12").value);
        var val13 = parseInt(document.getElementById("item13").value);
        var val14 = parseInt(document.getElementById("item14").value);
        var val15 = parseInt(document.getElementById("item15").value);
        var val16 = parseInt(document.getElementById("item16").value);
        var val17 = parseInt(document.getElementById("item17").value);
        var val18 = parseInt(document.getElementById("item18").value);
        var val19 = parseInt(document.getElementById("item19").value);
        var val20 = parseInt(document.getElementById("item20").value);
        var val21 = parseInt(document.getElementById("item21").value);
        var val22 = parseInt(document.getElementById("item22").value);
        var val23 = parseInt(document.getElementById("item23").value);
        var val24 = parseInt(document.getElementById("item24").value);
        var val25 = parseInt(document.getElementById("item25").value);

        // var ansL = document.getElementById("block1answer");
        // ansL.value = val1 + val2 + val3 + val4 + val5 + val6 + val7 + val8 + val9 + val10 + val11 + val12 + val13 +
        //   val14 +
        //   val15 + val16 + val17 + val18 + val19 + val20 + val21 + val22 + val23 + val24 + val25;
        //   ansl.value = roundToDecimalDigits(ansl.value);
        addAllDeduction();

    }

    // block 2 code
    function block2() {
        var val1 = parseInt(document.getElementById("item26").value);
        var val2 = parseInt(document.getElementById("item27").value);
        var val3 = parseInt(document.getElementById("item28").value);
        var val4 = parseInt(document.getElementById("item29").value);
        var val5 = parseInt(document.getElementById("item30").value);
        var val6 = parseInt(document.getElementById("item31").value);
        var val7 = parseInt(document.getElementById("item32").value);
        var val8 = parseInt(document.getElementById("item33").value);
        var val9 = parseInt(document.getElementById("item34").value);
        var val10 = parseInt(document.getElementById("item35").value);
        var val11 = parseInt(document.getElementById("item36").value);
        var val12 = parseInt(document.getElementById("item37").value);
        var val13 = parseInt(document.getElementById("item38").value);
        var val14 = parseInt(document.getElementById("item39").value);
        var val15 = parseInt(document.getElementById("item40").value);
        var val16 = parseInt(document.getElementById("item41").value);
        var val17 = parseInt(document.getElementById("item42").value);
        var val18 = parseInt(document.getElementById("item43").value);
        var val19 = parseInt(document.getElementById("item44").value);
        var val20 = parseInt(document.getElementById("item45").value);
        var val21 = parseInt(document.getElementById("item46").value);
        var val22 = parseInt(document.getElementById("item47").value);
        var val23 = parseInt(document.getElementById("item48").value);
        var val24 = parseInt(document.getElementById("item49").value);
        var val25 = parseInt(document.getElementById("item50").value);

        var ansL = document.getElementById("block2answer");
        ansL.value = val1 + val2 + val3 + val4 + val5 + val6 + val7 + val8 + val9 + val10 + val11 + val12 + val13 +
          val14 +
          val15 + val16 + val17 + val18 + val19 + val20 + val21 + val22 + val23 + val24 + val25;
          ansL.value = roundToDecimalDigits(ansl.value);
        addAllDeduction();

    }

    // D4 page total
    function addingD4PageTotal() {
        // TotalCarKms d1 answer10 d2 answer11 d3 answer12 d4
        var d1 = document.getElementById('TotalCarKms').value;
        var d2 = document.getElementById('answer10').value;
        var d3 = document.getElementById('answer11').value;
        var d4 = document.getElementById('answer12').value;

        var resultD1toD4 = document.getElementById('d1tod4');

        var myresultd1tod4 = parseFloat(d1) + parseFloat(d2) + parseFloat(d3) + parseFloat(d4);
        resultD1toD4.value = roundToDecimalDigits(myresultd1tod4);
        addAllDeduction();

    }

    function addAllDeduction() {
        var d1 = parseFloat(document.getElementById('TotalCarKms').value);
        var d2 = parseFloat(document.getElementById('answer10').value);
        var d3 = parseFloat(document.getElementById('answer11').value);
        var d4 = parseFloat(document.getElementById('answer12').value);
        var d5 = parseFloat(document.getElementById('answer13').value);
        var d6 = parseFloat(document.getElementById('answer14').value);
        var d7 = parseFloat(document.getElementById('result100').value);
        var d8 = parseFloat(document.getElementById('result101').value);
        var d9 = parseFloat(document.getElementById('result105').value);
        var d10 = parseFloat(document.getElementById('d5_d15_page_total').value);
        // var d11 = parseFloat(document.getElementById('block1answer').value);
        // var d12 = parseFloat(document.getElementById('block2answer').value);
        var val25 = parseInt(document.getElementById("value25").value);

        var resultAll = document.getElementById('allDeductions');

        var myresultAll = d1 + val25 + d2 + d3 + d4 + d5 + d6 + d7 + d8 + d9 + d10 ;

        resultAll.value = roundToDecimalDigits(myresultAll);
        // console.log("All Deduction: " + myresultAll);
        taxIncome();
    }

    function taxIncome() {
        var totalIncome = parseFloat(document.getElementById('totalIncome').value);
        var totalAllDeduction = parseFloat(document.getElementById('allDeductions').value);
        var resultAll = document.getElementById('taxable_income');
          var additionalDeductionTotal = parseFloat(0);


          $.each($(".additional-deductions"), function(i, v){
              additionalDeductionTotal += parseFloat($(this).val());
          });

          $("#totalAdditionalDeductions").val(additionalDeductionTotal);

        if (totalIncome > 150) {
          resultAll.value = totalIncome - totalAllDeduction;
          resultAll.innerHTML = totalIncome - totalAllDeduction;
        } else {
          resultAll.value = 0;
          resultAll.innerHTML = 0;
        }
    }

    function roundToDecimalDigits(x) {
        return Number.parseFloat(x).toFixed(2);
    }

    //deduction calculation
    $(".deduction-data").keypress(function(){
        var deductionVal = 0;
        $.each($(".deduction-data"), function(i, v){
            if($(this).val() === null || $(this).val() == ""){
                deductionVal += 0;
            }else{
                deductionVal += parseFloat($(this).val());
            }
        });
        $.each($(".deduction-data-change"), function(i, v){
            if($(this).parent().parent().find(".deduction-data-val").val() === null || $(this).parent().parent().find(".deduction-data-val").val() == ""){
                deductionVal += 0;
            }else{
                deductionVal += parseFloat($(this).parent().parent().find(".deduction-data-val").val());
            }
        });
        if(deductionVal == ""){
            deductionVal = 0;
        }

        console.log(deductionVal);

        $("#allDeductions").val(deductionVal);
        taxIncome();
    });

    $(".deduction-data-change").bind("keyup keypress change",function(){
        // alert("changed");
        var deductionVal = 0;
        $.each($(".deduction-data-change"), function(i, v){
            if($(this).parent().parent().find(".deduction-data-val").val() === null || $(this).parent().parent().find(".deduction-data-val").val() == ""){
                deductionVal += 0;
            }else{
                deductionVal += parseFloat($(this).parent().parent().find(".deduction-data-val").val());
            }
        });
        $.each($(".deduction-data"), function(i, v){
            if($(this).val() === null || $(this).val() == ""){
                deductionVal += 0;
            }else{
                deductionVal += parseFloat($(this).val());
            }
        });
        if(deductionVal == ""){
            deductionVal = 0;
        }
                    console.log(deductionVal);
        $("#allDeductions").val(deductionVal);
        taxIncome();
    });

    $(".deduction-data").keyup(function(){
        var deductionVal = 0;
        $.each($(".deduction-data"), function(i, v){
            if($(this).val() === null || $(this).val() == ""){
                deductionVal += 0;
            }else{
                deductionVal += parseFloat($(this).val());
            }
        });
        $.each($(".deduction-data-change"), function(i, v){
            if($(this).parent().parent().find(".deduction-data-val").val() === null || $(this).parent().parent().find(".deduction-data-val").val() == ""){
                deductionVal += 0;
            }else{
                deductionVal += parseFloat($(this).parent().parent().find(".deduction-data-val").val());
            }
        });
        if(deductionVal == ""){
            deductionVal = 0;
        }
        console.log(deductionVal);
        $("#allDeductions").val(deductionVal);
        taxIncome();
    });

    //validate
    const isValidElement = element => {
        return element.name && element.value && element.name != 'stage';
    };

    /**
     * Checks if an element’s value can be saved (e.g. not an unselected checkbox).
     * @param  {Element} element  the element to check
     * @return {Boolean}          true if the value should be added, false if not
     */
    const isValidValue = element => {
        return (!['checkbox', 'radio'].includes(element.type) || element.checked);
    };
 
    const isCheckbox = element => element.type === 'checkbox';
    
    const isMultiSelect = element => element.options && element.multiple;
 
    const formToJSON = elements => [].reduce.call(elements, (data, element) => {
        // Make sure the element has the required properties and should be added.
        if (isValidElement(element) && isValidValue(element)) {

            /*
            * Some fields allow for more than one value, so we need to check if this
            * is one of those fields and, if so, store the values as an array.
            */
            if (isCheckbox(element)) {
                data[element.name] = (data[element.name] || []).concat(element.value);
            } else if (isMultiSelect(element)) {
                data[element.name] = getSelectValues(element);
            } else {
                data[element.name] = element.value;
            }
        }

        return data;
    }, {});
    
    var validate = function(modals){
        if(modals == "popUpVisitor"){
            if($("#HereBefore option:selected").val() == "No"){
                var familyName = document.getElementById("sur-name");
                var firstName = document.getElementById("first-name");
                var mobNumber = document.getElementById("mobile-telephone");
                var email = document.getElementById("email");
                var postCode = document.getElementById("post-code");
                var taxType = document.getElementById("taxType");
                var occupationRole = document.getElementById("OccupationRole");
                var rank = document.getElementById("Rank");
                var workLocation = document.getElementById("station_locale");
                var yearJob = document.getElementById("years-in-job");
                var streetNumber = document.getElementById("street-no");
                var streetAddress = document.getElementById("street-address");
                var suburb = document.getElementById("suburb");

                if(occupationRole.options[occupationRole.selectedIndex].value == ""){
                  notify('white', "Please select Occupation Role.");
                  occupationRole.focus();
                  return false;
                }

                if(rank.options[rank.selectedIndex].value == ""){
                  notify('white', "Please select Rank.");
                  rank.focus();
                  return false;
                }

                if(!validateAlphabet(workLocation.value)){
                  notify('white', "Please enter Station Location.");
                  workLocation.focus();
                  return false;
                }

                if(isNaN(yearJob.value) || yearJob.value == "" || yearJob.value.length > 2){
                  notify('white', "Please enter a valid Years in Job.");
                  yearJob.focus();
                  return false;
                }

                if(isNaN(streetNumber.value) || streetNumber.value == ""){
                  notify('white', "Please enter a valid street number.");
                  streetNumber.focus();
                  return;
                }

                if(streetAddress.value == ""){
                  notify('white', "Please enter a valid street address.");
                  streetAddress.focus();
                  return;
                }

                if(!validateAlphabet(suburb.value)){
                  notify('white', "Please enter a suburb.");
                  suburb.focus();
                  return;
                }

                // STAGE 1 Post Code validation
                if (!validateNumber(postCode.value, 4)) {
                  notify('white', "Post Code needs to be exactly 4 digits.");
                  postCode.focus();
                  return false;
                }
                return true;
            }
        } else if(modals == "popUpSpouse"){

            var myDob = $("#datepicker").find(".birthDay");
            var mybsb = document.getElementById("my-bsb");
            var mytfn = document.getElementById("my-tfn");
            var mybankaccount = document.getElementById("bank-account");
            var spouseSurname = document.getElementById("spouse-surname");
            var spouseFirstname = document.getElementById("spouse-firstname");
            var spouseDob = $("#spousedob").find(".birthDay");
            var numberofDependents = $("#no-dependants");
            var spouseFullYears = $("#QspouseForFullYear");
            var spouseStartDate = $("#dateSpouse").find(".birthDay");
            var spouseWantsTaxDone = $("#spouseWantsTaxDone");
            var taxableIncome = document.getElementById("taxableincome");

            if($("#HaveSpouse").is(':checked')){

              if (!validateAlphabet(spouseFirstname.value)) {
                    
                notify('white', "Please enter alphabets only for the First Name.");
                spouseFirstname.focus();
                return false;
              }

              if (!validateAlphabet(spouseSurname.value)) {
                    
                notify('white', "Please enter alphabets only for the Surname.");
                spouseSurname.focus();
                return false;
              }

              if (spouseDob.val() == "") {
                    
                notify('white', "Please Select Spouse Date of Birth");
                $("input[name='spousedob_birth[day]']").focus();
                // salr1.attr("aria-invalid", true); // add invalid aria
                return false;
              }

              if($("#spouseWantsTaxDone option:selected").val() == ""){
                    
                notify('white', "Please select Tax Done.");
                $("#spouseWantsTaxDone").focus();
                return false;
              }

              if($("#no-dependants option:selected").val() == ""){
                    
                notify('white', "Please select Number of Dependants.");
                $("#no-dependants").focus();
                return false;
              }


              if(isNaN(taxableIncome.value) || taxableIncome.value == ""){
                    
                notify('white', "Please enter a valid Taxable Income.");
                taxableIncome.focus();
                return false;
              }

              if($("#QspouseForFullYear option:selected").val() == ""){
                    
                notify('white', "Please select Full Year service for spouse.");
                $("#QspouseForFullYear").focus();
                return false;
              }

              if($("#QspouseForFullYear option:selected").val() == "No"){
                if (spouseStartDate.val() == "") {
                      
                  notify('white', "Please Select Start Date");
                  $("input[name='dateSpouse_birth[day]']").focus();
                  // salr1.attr("aria-invalid", true); // add invalid aria
                  return false;
                }
              }
              return true;
            }
        } else if(modals == 1){
            var familyName = document.getElementById("sur-name");
            var firstName = document.getElementById("first-name");
            var mobNumber = document.getElementById("mobile-telephone");
            var email = document.getElementById("email");
            var postCode = document.getElementById("post-code");
            var taxType = document.getElementById("taxType");
            var occupationRole = document.getElementById("OccupationRole");
            var rank = document.getElementById("Rank");
            var workLocation = document.getElementById("station_locale");
            var yearJob = document.getElementById("years-in-job");
            var streetNumber = document.getElementById("street-no");
            var streetAddress = document.getElementById("street-address");
            var suburb = document.getElementById("suburb");
            var myDob_date = $("#birth_date option:selected").val();
            var myDob_month = $("#birth_month option:selected").val();
            var myDob_year = $("#birth_year option:selected").val();
            var myDob = myDob_date + "/" + myDob_month + "/" + myDob_year; 

            // if(taxType.value == "select"){
                 
            //   notify('white', "Please select a Tax Type.");
            //   taxType.focus();
            //   return false;
            // }

            if (!validateAlphabet(firstName.value)) {
                 
              notify('white', "Please enter alphabets only for the First Name.");
              firstName.focus();
              return false;
            }

            if (!validateAlphabet(familyName.value)) {
                 
              notify('white', "Please enter alphabets only for the Surname.");
              familyName.focus();
              return false;
            }

            if($("#HereBefore option:selected").val() == "No"){

              if(occupationRole.options[occupationRole.selectedIndex].value == ""){
   
                notify('white', "Please select Occupation Role.");
                occupationRole.focus();
                return false;
              }

              if(rank.options[rank.selectedIndex].value == ""){
   
                notify('white', "Please select Rank.");
                rank.focus();
                return false;
              }

              if(!validateAlphabet(workLocation.value)){
   
                notify('white', "Please enter Station Location.");
                workLocation.focus();
                return false;
              }

              if(isNaN(yearJob.value) || yearJob.value == "" || yearJob.value.length > 2){
   
                notify('white', "Please enter a valid Years in Job.");
                yearJob.focus();
                return false;
              }

            }

            if (!validateEmail(email.value)) {
                 
              notify('white', "Please enter a valid Email.");
              email.focus();
              return false;
            }

            if (!validateNumber(mobNumber.value, 10)) {
                 
              notify("white", "Mobile number needs to be exactly 10 digits.");
              mobNumber.focus();
              return false;
            }
    
            if (myDob_date == "" || myDob_month == "" || myDob_year == "") {
                    
                notify('white', "Please Select Date of Birth");
                myDob_date.focus();
                // salr1.attr("aria-invalid", true); // add invalid aria
                return false;
            }

            if ($("#contactBy").val() == "") {
                 
              notify('white', "Please select contact by.");
              $("#contactBy").focus();
              return false;
            }

            if ($("#bestTime").val() == "") {
                 
              notify('white', "Please select best time to contact you.");
              $("#bestTime").focus();
              return false;
            }

            if($("#HereBefore option:selected").val() == "No"){
              if(isNaN(streetNumber.value) || streetNumber.value == ""){
   
                notify('white', "Please enter a valid street number.");
                streetNumber.focus();
                return;
              }

              if(streetAddress.value == ""){
   
                notify('white', "Please enter a valid street address.");
                streetAddress.focus();
                return;
              }

              if(!validateAlphabet(suburb.value)){
   
                notify('white', "Please enter a suburb.");
                suburb.focus();
                return;
              }

              // STAGE 1 Post Code validation
              if (!validateNumber(postCode.value, 4)) {
   
                notify('white', "Post Code needs to be exactly 4 digits.");
                postCode.focus();
                return false;
              }

            }

            if(times == 1){
                $.each($(".js-switch"), function(i, v){
                    $(this).parent().find("span").css('border-color', 'rgb(223, 223, 223)');
                    $(this).parent().find("small").html("");
                    $(this).parent().find("small").html("No");
                    $(this).parent().find("small").attr("switch", "off");

                    if($(this).attr("id") == "mobile-used"){
                        // $(this).parent().find("small").html("");
                        // $(this).parent().find("small").html("Yes");
                        // $(this).parent().find("small").attr("switch", "on");
                        var special = document.querySelector('#mobile-used');
                        //$(special).attr("checked", false);
                        special.checked = true;
                        if (typeof Event === 'function' || !document.fireEvent) {
                            var event = document.createEvent('HTMLEvents');
                            event.initEvent('change', true, true);
                            special.dispatchEvent(event);
                        } else {
                            special.fireEvent('onchange');
                        }
                    }

                    if($(this).attr("id") == "internet-used"){
                        // $(this).parent().find("small").html("");
                        // $(this).parent().find("small").html("Yes");
                        // $(this).parent().find("small").attr("switch", "on");
                        var special = document.querySelector('#internet-used');
                        //$(special).attr("checked", false);
                        special.checked = true;
                        if (typeof Event === 'function' || !document.fireEvent) {
                            var event = document.createEvent('HTMLEvents');
                            event.initEvent('change', true, true);
                            special.dispatchEvent(event);
                        } else {
                            special.fireEvent('onchange');
                        }
                    }
                });
            }
            times = 2;
            return true;
        } else if(modals == 2){
        var mybsb = document.getElementById("my-bsb");
        var mytfn = document.getElementById("my-tfn");
        var mybankaccount = document.getElementById("bank-account");
        var spouseSurname = document.getElementById("spouse-surname");
        var spouseFirstname = document.getElementById("spouse-firstname");
        var spouseDob = $("#spousedob").find(".birthDay");
        var numberofDependents = $("#no-dependants");
        var spouseFullYears = $("#QspouseForFullYear");
        var spouseStartDate = $("#dateSpouse").find(".birthDay");
        var spouseWantsTaxDone = $("#spouseWantsTaxDone");
        var taxableIncome = document.getElementById("taxableincome");

        if($("#HaveSpouse").is(':checked')){

            if (!validateAlphabet(spouseFirstname.value)) {
                    
                notify('white', "Please enter alphabets only for the First Name.");
                spouseFirstname.focus();
                return false;
            }

            if (!validateAlphabet(spouseSurname.value)) {
                    
                notify('white', "Please enter alphabets only for the Surname.");
                spouseSurname.focus();
                return false;
            }

            if (spouseDob.val() == "") {
                    
                notify('white', "Please Select Spouse Date of Birth");
                $("input[name='spousedob_birth[day]']").focus();
                // salr1.attr("aria-invalid", true); // add invalid aria
                return false;
            }

            if($("#no-dependants option:selected").val() == ""){
                    
                notify('white', "Please select Number of Dependants.");
                $("#no-dependants").focus();
                return false;
            }

            if($("#QspouseForFullYear option:selected").val() == ""){
                    
                notify('white', "Please select Full Year service for spouse.");
                $("#QspouseForFullYear").focus();
                return false;
            }

            if($("#QspouseForFullYear option:selected").val() == "No"){
                if (spouseStartDate.val() == "") {
                    
                notify('white', "Please Select Start Date");
                $("input[name='dateSpouse_birth[day]']").focus();
                // salr1.attr("aria-invalid", true); // add invalid aria
                return false;
                }
            }

            if($("#spouseWantsTaxDone option:selected").val() == ""){
                    
                notify('white', "Please select Tax Done.");
                $("#spouseWantsTaxDone").focus();
                return false;
            }

            if(isNaN(taxableIncome.value) || taxableIncome.value == ""){
                    
                notify('white', "Please enter a valid Taxable Income.");
                taxableIncome.focus();
                return false;
            }
        }

        // TFN Number Validation
        if (!validateNumber(mytfn.value, 9)) {
                
            notify('white', "TFN number needs to be exactly 9 digits.");
            mytfn.focus();
            return false;
        }

        if (!validateNumber(mybsb.value, 6)) {
                
            notify('white', "BSB number needs to be exactly 6 digits.");
            mybsb.focus();
            return false;
        }

        // if (!validateNumber(mybankaccount.value, 6)) {
        if (isNaN(mybankaccount.value) || mybankaccount.value == "" || mybankaccount.value.length < 5 || mybankaccount.value.length > 11) {
                
            notify('white', "Please enter a valid Bank account number.");
            mybankaccount.focus();
            return false;
        }

        if(creditcardInfo == 1){
            creditcardInfo += 1;

            var jsonData = {
                BeenWithUsBefore: $("#HereBefore option:selected").val(),
                Package: $("#packageName").val(),
                TaxYear: $("select[name='Tax Year'] option:selected").val(),
                Title: $("#Title").val(),
                FirstName: $("#first-name").val(),
                MiddleName: $("#middle_name").val(),
                SurName: $("#sur-name").val(),
                MobileNumber: $("#mobile-telephone").val(),
                Email: $("#email").val(),
                ContactBy: $("select[name='Contact By'] option:selected").val(),
                BestTime: $("#bestTime option:selected").val(),
                OccupationRole: $("#OccupationRole option:selected").val(),
                Rank: $("#Rank option:selected").val(),
                HospitalClinic: $("#station_locale").val(),
                YearsInJob: $("#years-in-job").val(),
                StreetUnitNumber: $("#street-no").val(),
                StreetAddress: $("#street-address").val(),
                Suburb: $("#suburb").val(),
                State: $("select[name='State'] option:selected").val(),
                PostCode: $("#post-code").val(),
                LateYears: $("#Yearslate option:selected").val(),
                DOB: $("input[name='datepicker_birthDay']").val(),
                TFN: $("#my-tfn").val(),
                BSB: $("#my-bsb").val(),
                BankAccountNumber: $("#bank-account").val(),
                SpouseFirstName: $("#spouse-firstname").val(),
                SpouseMidddleName: $("#spouse-middlename").val(),
                SpouseSurName: $("#spouse-surname").val(),
                SpouseDOB: $("input[name='spousedob_birthDay']").val(),
                SpouseWantTaxDone: $("#spouseWantsTaxDone option:selected").val(),
                SpouseNumberofDependants: $("#no-dependants option:selected").val(),
                SpouseTaxableIncome: $("#taxableincome").val(),
                SpouseFullYear: $("#QspouseForFullYear option:selected").val(),
                SpouseStartDate: $("input[name='dateSpouse_birthDay']").val(),
                PrivateHealthInsurance: $("#Q1PHI").parent().find("small").text(),
                HecsDebt: $("#Q2HECS").parent().find("small").text(),
                BankDividents: $("#Q10TaxDeduction").parent().find("small").text(),
                GovtPayments: $("#Q7GovtPayments").parent().find("small").text(),
                OverdueTax: $("#q5LateTax").parent().find("small").text(),
                HaveSpouse: $("#HaveSpouse").parent().find("small").text(),
                ReceivedRetirementIncomeStream: $("#IncomeStream").parent().find("small").text(),
                RentalProperty: $("#Q3Rental").parent().find("small").text(),
                CapitalGainEvents: $("#Q4CapGains").parent().find("small").text(),
                LumpSumIncome: $("#Q8LumpSumIncome").parent().find("small").text()
            };
            console.log(jsonData);

            $.post("test_db.php", {userdata: JSON.stringify(jsonData)}, function(response){
                response = JSON.parse(response);
                if(response[0] == "true"){
                    var id = response[1];
                    window.location.href = "nabTransact.php?package=standard&sessionid=" + id;
                }
            });
            return;
        }

        return true;
        } else if(modals == 3){
        var salr1 = document.getElementById("salary1");
        var pay2g = document.getElementById("payg-tax");
        var salr2 = document.getElementById("salary2");
        var pay2g2 = document.getElementById("payg-tax2");
        var emp1 = $("#Employer1");

        if($("#Employer1 option:selected").val() == ""){
                
            notify('white', "Please enter an Employer.");
            emp1.focus();
            return false;
        }

        if(isNaN(salr1.value) || salr1.value == "" || salr1.value <= 0 ){
                
            notify('white', "Please enter a valid Salary.");
            salr1.focus();
            salr1.select();
            return false;
        }

        if (isNaN(pay2g.value) || pay2g.value == "" || pay2g.value <= 0) {
                
            notify('white', "Please enter a valid Payg Tax.");
            pay2g.focus();
            pay2g.select();
            return false;
        }
    
        var valId = getUrlParameter('returnval');
        $.post("editData.php", {id: valId, from: "ExpenseSubmit"}, function(response){

        });
        return true;
        } else if(modals == 4){
            if (checkkms == 0) {
                    
                notify('white', "Please agree on the Tax deduction terms and condition");
                $('#agreedOn').focus();
                return false;
            }

            if($("#tax-info").val() == "Standard" || $("#tax-info").val() == "Premium Plus"){
                if($("#tax-deduction-notice").val() != "1"){
                    
                notify('warning', "Please see the Additional Deduction to use the full service.");
                // $('#agreedOn').focus();
                return false;

                }
            }

            return true;
        } else if(modals == 5){
            var form = document.getElementById('signup-form');
            var formData = formToJSON(form.elements);
            // console.log(formData);
            var message = "<html><title></title><body><span style='background-color: black;color:black;'><h4>Profile</h4></span><br/>\n";
            var subject = "";var listData = {};
            var carkm = 0;
            var taxHeader = 0;
            var differentHeader = 0;
            var powerPacks = 0;

            $.each(formData, function(i, v){
                var originalText = "";
                if(i.indexOf("taxDedcutionExpenseSubstantiation") != -1 || i.indexOf("agreed-on") != -1 || i.indexOf("termsandcondition") != -1
                    || i.indexOf("checkTerms ") != -1){
                    message += "Car Km Terms and Conditions : Agreed " + "<br/>\n";
                    listData["Car Km Terms and Conditions"] = "Agreed";
                }else{
                    if(v == 0 || v == "select"){
                        if(i.indexOf("CarKms") != -1){
                            if(carkm == 0){
                                message += "<span style='background-color: black;color:black;'><h4>D1 Car Kms</h4></span> <br/>\n";
                                carkm += 1;
                            }

                        }
                    } else if(i.indexOf("datepicker_birth[month]") != -1 || i.indexOf("datepicker_birth[day]") != -1 || i.indexOf("datepicker_birth[year]") != -1 ||
                        i.indexOf("spousedob_birth[month]") != -1 || i.indexOf("spousedob_birth[day]") != -1 || i.indexOf("spousedob_birth[year]") != -1 ||
                        i.indexOf("dateSpouse_birth[month]") != -1 || i.indexOf("dateSpouse_birth[day]") != -1 || i.indexOf("dateSpouse_birth[year]") != -1){

                    }else{

                        if(i.indexOf("Tax Year") != -1){
                            subject += v + " PoliceTax | Budget Tax - ";
                        }

                        if(i.indexOf("Title") != -1){
                            subject += v + " ";
                        }

                        if(i.indexOf("first-name") != -1){
                            subject += v + " ";
                        }

                        if(i.indexOf("sur-name") != -1){
                            subject += v + "";
                        }

                        if(i.indexOf("Occupation Role") != -1){
                            if(v != "select"){
                                subject += " (" + v + " - ";
                            }else{
                                differentHeader += 1;
                            }
                        }

                        if(i.indexOf("State") != -1){
                            if(v != "select"){
                                subject += v + ") ";
                            }else{
                                differentHeader += 1;
                            }
                        }
                        if(differentHeader >= 2){
                            subject += "( Here-Before: Yes )";
                        }

                        if(i.indexOf("Employer1") != -1){
                            $.each($(".tax-question-checkbox"), function(i, v){
                                var val = $(this).find("small").text();
                                var index = $(this).parent().find("label").text();

                                if(i == 0){
                                    message += "<span style='background-color: black;color:black;'><h4>Tax Questions </h4></span> <br/>\n";
                                }

                                message += index + " : " + val + "<br/>\n";
                                listData[index] = val;
                            });
                            message += "<span style='background-color: black;color:black;'><h4>------------ Tax Questions -------------</h4></span> \n";
                            message += "<span style='background-color: black;color:white;'><h4>Salary/Income</h4></span> <br/>\n";
                        }

                        if(i.indexOf("taxDeductionExpenseSubsantian") != -1 || i.indexOf("noteForAccountant") != -1){
                            if(taxHeader == 0){
                                message += "<span style='background-color: black;color:black;'><h4>Terms and Conditions Agreed / Electronic signed tax return</h4></span> <br/>\n";
                                taxHeader += 1
                            }
                        }

                        if(i.indexOf("CarKms") != -1){
                            if(carkm == 0){
                                message += "<span style='background-color: black;color:black;'><h4>D1 Car Kms</h4></span> <br/>\n";
                                carkm += 1;
                            }
                        }

                        if(i.indexOf("workRelatedTravelExpenses") != -1){
                            message += "<span style='background-color: black;color:black;'><h4>D2 Travel expenses</h4></span> <br/>\n";
                        }

                        if(i.indexOf("workRelatedClothingLaundry") != -1){
                            message += "<span style='background-color: black;color:black;'><h4>D3 Work-related clothing, laundry</h4></span> <br/>\n";
                        }

                        if(i.indexOf("workRelatedSelfEducationCosts") != -1){
                            message += "<span style='background-color: black;color:black;'><h4>D4 Work-related self-education costs </h4></span> <br/>\n";
                        }

                        if(i.indexOf("spouse-firstname") != -1){
                            message += "<span style='background-color: black;color:black;'><h4>Spouse Details </h4></span> <br/>\n";
                        }

                        if(i.indexOf("otherWorkRelatedExpenses") != -1){
                            message += "<span style='background-color: black;color:black;'><h4>D5 Other work-related expenses </h4></span> <br/>\n";
                        }

                        if(i.indexOf("allDeductions") != -1){
                            message += "<span style='color:black;'><h4>--------- Deductions ----------- </h4></span> <br/>\n";
                        }

                        if(i.indexOf("mobile-telephone") != -1){
                            message += "<span style='color:black;'><h4>Contact </h4></span> <br/>\n";
                        }

                        if(i.indexOf("donations_charity") != -1){
                            message += "<span style='color:black;'><h4>Non Work Deductions </h4></span> <br/>\n";
                        }

                        if(i.indexOf("Occupation") != -1){
                            message += "<span style='background-color: black;color:black;'><h4>Work Details </h4></span> <br/>\n";
                        }

                        if(i.indexOf("totalIncome") != -1){
                            originalText = i;
                            i = '<span style="background-color:yellow;"><b>Total Income</b></span>';
                        }

                        if(i.indexOf("TotalCarKms") != -1){
                            originalText = i;
                            i = "<b>Total Car Kms</b>";
                        }

                        if(i.indexOf("D2WorkRelatedTravelExpense") != -1){
                            originalText = i;
                            i = "<b>D2 Total Work Related Travel Expense</b>";
                        }

                        if(i.indexOf("D3UniformTotal") != -1){
                            originalText = i;
                            i = "<b>D3 Uniform Total</b>";
                        }

                        if(i.indexOf("D4SelfEducTotal") != -1){
                            originalText = i;
                            i = "<b>D4 Self Education Total</b>";
                        }

                        if(i.indexOf("D5Other_MainTotal") != -1){
                            originalText = i;
                            i = "<b>D5 Miscellaneous Total</b>";
                        }

                        if(i.indexOf("D5Other_OtherMainTotal") != -1){
                            originalText = i;
                            i = "<b>D5 Other Miscellaneous Total</b>";
                        }

                        if(i.indexOf("mobileclaimed-forwork") != -1){
                            originalText = i;
                            i = "<b>Total Mobile Claimed</b>";
                        }

                        if(i.indexOf("TotalInternetClaimedWork") != -1){
                            originalText = i;
                            i = "<b>Total Internet Claimed</b>";
                        }

                        if(i.indexOf("subtotal-d5.13deductions") != -1){
                            originalText = i;
                            i = "<b>Total Capital Expense</b>";
                        }

                        if(i.indexOf("totalAdditionalDeductions") != -1){
                            originalText = i;
                            i = "<b>Total Additional Deductions</b>";
                        }

                        if(i.indexOf("subtotal-d5.13deductions") != -1){
                            originalText = i;
                            i = "<b>Total Capital Expense</b>";
                        }

                        if(i.indexOf("d5_d15_page_total") != -1){
                            originalText = i;
                            i = "<b>Total Non Work Deductions</b>";
                        }

                        if(i.indexOf("allDeductions") != -1){
                            originalText = i;
                            i = '<span style="background-color:yellow;"><b>Total Deductions</b></span>';
                        }

                        if(i.indexOf("datepicker_birthDay") != -1 || i.indexOf("spousedob_birthDay") != -1 || i.indexOf("dateSpouse_birthDay") != -1){
                            var data = $("input[name='" + i + "']").val().split("-");
                            var properDate = data[2] + "/" + data[1] + "/" + data[0];

                            //giving appropriate Name
                            if(i.indexOf("datepicker_birthDay") != -1){
                                i = "Date of Birth";
                            }else if(i.indexOf("spousedob_birthDay") != -1){
                                i = "Spouse Date of Birth";
                            }else if(i.indexOf("dateSpouse_birthDay") != -1){
                                i = "Spouse Start Date for the Year";
                            }

                            message += i + " : " + properDate + "<br/>\n";
                            listData[i] = properDate;
                        }else{
                            message += i + " : " + v + "<br/>\n";
                            

                            if(originalText !== ""){
                                i = originalText;
                            }
                            listData[i] = v;
                        }

                    }
                }
            });

            var valId= getUrlParameter('returnval');
            //var data = window.formDataSave();
            $.post("editData.php", {id: valId, filemakerData: JSON.stringify(listData), from: "submit"}, function(response){
            
            });
            if($("#tax-info").val() == "Premium Plus"){

                if($("#additional-tax-deduction-notice").val() != "1"){
                    
                notify('warning', "Please see the Extra Additional Deduction to use the full service.");
                // $('#agreedOn').focus();
                return false;

                }
            }

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

    var notify = function(heading, msg){
        $.notify({
            title: '<strong> Error!</strong>',
            message: msg
        },{
            type: 'error',
            offset: {
                x: 50,
                y: 100
            }
        });
    }

    var marginSlider = document.getElementById('slider-margin');

    if (marginSlider != undefined) {
        noUiSlider.create(marginSlider, {
              start: [1100],
              step: 100,
              connect: [true, false],
              tooltips: [true],
              range: {
                  'min': 100,
                  'max': 2000
              },
              pips: {
                    mode: 'values',
                    values: [100, 2000],
                    density: 4
                    },
                format: wNumb({
                    decimals: 0,
                    thousand: '',
                    prefix: '$ ',
                })
        });
        
        var marginMin = document.getElementById('value-lower'),
	    marginMax = document.getElementById('value-upper');

        marginSlider.noUiSlider.on('update', function ( values, handle ) {
            if ( handle ) {
                marginMax.innerHTML = values[handle];
            } else {
                marginMin.innerHTML = values[handle];
            }
        });
    }
})(jQuery);