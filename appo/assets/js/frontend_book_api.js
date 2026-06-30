/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, Alex Tselegidis
 * @license     http://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        http://easyappointments.org
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

window.FrontendBookApi = window.FrontendBookApi || {};

/**
 * Frontend Book API
 *
 * This module serves as the API consumer for the booking wizard of the app.
 *
 * @module FrontendBookApi
 */
(function (exports) {

    'use strict';

    var unavailableDatesBackup;
    var selectedDateStringBackup;
    var processingUnavailabilities = false;

    /**
     * Get Available Hours
     *
     * This function makes an AJAX call and returns the available hours for the selected service,
     * provider and date.
     *
     * @param {String} selDate The selected date of which the available hours we need to receive.
     */
    exports.getAvailableHours = function (selDate) {
        $('#available-hours').empty();

        // Find the selected service duration (it is going to be send within the "postData" object).
        var selServiceDuration = 15; // Default value of duration (in minutes).
        $.each(GlobalVariables.availableServices, function (index, service) {
            if (service.id == $('#select-service').val()) {
                selServiceDuration = service.duration;
            }
        });

        // If the manage mode is true then the appointment's start date should return as available too.
        var appointmentId = FrontendBook.manageMode ? GlobalVariables.appointmentData.id : undefined;

        // Make ajax post request and get the available hours.
        var postUrl = window.location.origin + '/appo/index.php/appointments/ajax_get_available_hours';
        var postData = {
            csrfToken: GlobalVariables.csrfToken,
            service_id: $('#select-service').val(),
            provider_id: $('#select-provider').val(),
            selected_date: selDate,
            service_duration: selServiceDuration,
            manage_mode: FrontendBook.manageMode,
            appointment_id: appointmentId
        };

        $.post(postUrl, postData, function (response) {
            if (!GeneralFunctions.handleAjaxExceptions(response)) {
                return;
            }

            // The response contains the available hours for the selected provider and
            // service. Fill the available hours div with response data.
            if (response.length > 0) {
                var currColumn = 1;
                $('#available-hours').html('<div style="width:80px; float:left;"></div>');

                var timeFormat = GlobalVariables.timeFormat === 'regular' ? 'h:mm tt' : 'HH:mm';

                $.each(response, function (index, availableHour) {
                    if ((currColumn * 10) < (index + 1)) {
                        currColumn++;
                        $('#available-hours').append('<div style="width:80px; float:left;"></div>');
                    }

                    $('#available-hours div:eq(' + (currColumn - 1) + ')').append(
                        '<span class="available-hour">' + Date.parse(availableHour).toString(timeFormat) + '</span><br/>');
                });

                if (FrontendBook.manageMode) {
                    // Set the appointment's start time as the default selection.
                    $('.available-hour').removeClass('selected-hour');
                    $('.available-hour').filter(function () {
                        return $(this).text() === Date.parseExact(
                            GlobalVariables.appointmentData.start_datetime,
                            'yyyy-MM-dd HH:mm:ss').toString(timeFormat);
                    }).addClass('selected-hour');
                } else {
                    // Set the first available hour as the default selection.
                    $('.available-hour:eq(0)').addClass('selected-hour');
                }
                
                if($("#selectedTime").val() != ""){
                    $.each($('.available-hour'), function(i, v){
                        var currentHour = $(this);
                        if(currentHour.text() == $("#selectedTime").val()){
                            currentHour.addClass('selected-hour');
                        } else{
                            currentHour.removeClass('selected-hour');
                        }
                    });
                }

                FrontendBook.updateConfirmFrame();

            } else {
                $('#available-hours').text(EALang.no_available_hours);
            }
        }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
    };

    /**
     * Register an appointment to the database.
     *
     * This method will make an ajax call to the appointments controller that will register
     * the appointment to the database.
     */
    exports.registerAppointment = function () {
        var $captchaText = $('.captcha-text');

        if ($captchaText.length > 0) {
            $captchaText.closest('.form-group').removeClass('has-error');
            if ($captchaText.val() === '') {
                $captchaText.closest('.form-group').addClass('has-error');
                return;
            }
        }

        var formData = jQuery.parseJSON($('input[name="post_data"]').val());
        var postData = {
            csrfToken: GlobalVariables.csrfToken,
            post_data: formData
        };

        if ($captchaText.length > 0) {
            postData.captcha = $captchaText.val();
        }

        if (GlobalVariables.manageMode) {
            postData.exclude_appointment_id = GlobalVariables.appointmentData.id;
        }

        var postUrl = window.location.origin + '/appo/index.php/appointments/ajax_register_appointment';
        var $layer = $('<div/>');

        $.ajax({
            url: postUrl,
            method: 'post',
            data: postData,
            dataType: 'json',
            beforeSend: function (jqxhr, settings) {
                $layer
                    .appendTo('body')
                    .css({
                        background: 'white',
                        position: 'fixed',
                        top: '0',
                        left: '0',
                        height: '100vh',
                        width: '100vw',
                        opacity: '0.5'
                    });
            }
        })
            .done(function (response) {
                if (!GeneralFunctions.handleAjaxExceptions(response)) {
                    $('.captcha-title small').trigger('click');
                    return false;
                }

                //if (response.captcha_verification === false) {
                  //  $('#captcha-hint')
                    //    .text(EALang.captcha_is_wrong)
                      //  .fadeTo(400, 1);

                    //setTimeout(function () {
                      //  $('#captcha-hint').fadeTo(400, 0);
                    //}, 3000);

                    ///$('.captcha-title small').trigger('click');

                    //$captchaText.closest('.form-group').addClass('has-error');

                    //return false;
                //}

                var redirectUrl = window.location.origin + '/appo/index.php/appointments/book_success/' + response.appointment_id;
                
                 //$("#redirectForm").append('<input type="hidden" name="url" value="' + redirectUrl + '" >');

                 //$('#redirectForm').submit();
                 
                 window.location.href = redirectUrl;
            })
            .fail(function (jqxhr, textStatus, errorThrown) {
                $('.captcha-title small').trigger('click');
                GeneralFunctions.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
            })
            .always(function () {
                $layer.remove();
            });
    };

    exports.registerTempAppointment = function () {
        var $captchaText = $('.captcha-text');
    console.log("here");
        if ($captchaText.length > 0) {
            $captchaText.closest('.form-group').removeClass('has-error');
            if ($captchaText.val() === '') {
                $captchaText.closest('.form-group').addClass('has-error');
                return;
            }
        }

        var formData = $('#tempdata').val();
        var postData = {
            csrfToken: GlobalVariables.csrfToken,
            post_data: formData
        };

        if ($captchaText.length > 0) {
            postData.captcha = $captchaText.val();
        }

        var postUrl = window.location.origin + '/appo/index.php/appointments/ajax_add_tempappointment';
        var $layer = $('<div/>');

        $.ajax({
            url: postUrl,
            method: 'post',
            data: postData,
            dataType: 'json',
            beforeSend: function (jqxhr, settings) {
                $layer
                    .appendTo('body')
                    .css({
                        background: 'white',
                        position: 'fixed',
                        top: '0',
                        left: '0',
                        height: '100vh',
                        width: '100vw',
                        opacity: '0.5'
                    });
            }
        })
            .done(function (response) {
                    if(response.appointment_id != ""){
                     
                        //$.removeCookie("ea_booking");
                        //$.cookie("ea_booking", response.appointment_id , { expires: 7 });
                        //window.location.href = '/appo/index.php/appointments/payment';
                        var priceData = parseFloat($("#redirectForm").find("input[name='price']").val()).toFixed(2);
                        //priceData = priceData * parseInt($("#number-years").val());
                        $("#redirectForm").find("input[name='price']").val(priceData);
                        var data = $("#redirectForm").attr("action");
                        data += "?book=" + response.appointment_id;
                        $("#redirectForm").attr("action", data);
                        $("#redirectForm").submit();   
                    }
            })
            .fail(function (jqxhr, textStatus, errorThrown) {
                $('.captcha-title small').trigger('click');
                GeneralFunctions.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
            })
            .always(function () {
                $layer.remove();
            });
    };
    /**
     * Get the unavailable dates of a provider.
     *
     * This method will fetch the unavailable dates of the selected provider and service and then it will
     * select the first available date (if any). It uses the "FrontendBookApi.getAvailableHours" method to
     * fetch the appointment* hours of the selected date.
     *
     * @param {Number} providerId The selected provider ID.
     * @param {Number} serviceId The selected service ID.
     * @param {String} selectedDateString Y-m-d value of the selected date.
     */
    exports.getUnavailableDates = function (providerId, serviceId, selectedDateString) {
        if (processingUnavailabilities) {
            return;
        }
        
        //console.log(providerId);
        var appointmentId = FrontendBook.manageMode ? GlobalVariables.appointmentData.id : 0;
        
        var serviceIdData = 1;
        var providerIdData = 1;
        if(serviceId != "" && serviceId != null){
            serviceIdData = parseInt(serviceId);
        }
        if(providerId != "" && providerId != null){
            providerIdData = parseInt(providerId);
        }

        var url = window.location.origin + '/appo/index.php/appointments/ajax_get_unavailable_dates';
        var data = {
            provider_id: providerIdData,
            service_id: serviceIdData,
            selected_date: encodeURIComponent(selectedDateString),
            csrfToken: GlobalVariables.csrfToken,
            manage_mode: FrontendBook.manageMode,
            appointment_id: appointmentId
        };
        
        //console.log(url);
        //console.log(data);
        //console.log(providerIdData);
        //console.log(serviceIdData);
        //console.log(selectedDateString);
        $.ajax({
            url: url,
            type: 'GET',
            data: data,
            dataType: 'json'
        })
            .done(function (response) {
                unavailableDatesBackup = response;
                selectedDateStringBackup = selectedDateString;
                _applyUnavailableDates(response, selectedDateString, true);
            })
            .fail(GeneralFunctions.ajaxFailureHandler);
    };

    exports.applyPreviousUnavailableDates = function () {
        _applyUnavailableDates(unavailableDatesBackup, selectedDateStringBackup);
    };
        
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
exports.getTempData = function (serviceId) {
        var url = window.location.origin + '/appo/index.php/appointments/ajax_get_tempappointment';
        var data = {
            id: serviceId,
            csrfToken: GlobalVariables.csrfToken,
        };

        $.ajax({
            url: url,
            type: 'GET',
            data: data,
            dataType: 'json'
        })
            .done(function (response) {
                //console.log(response);
                var customer = JSON.parse(response.data);
                        
                //console.log(customer.email);
                var data = getUrlVars();
                
                        $('#select-date').datepicker('setDate', customer.SelectedDate);
                
                                //console.log("entered");
                        FrontendBookApi.getAvailableHours($('#select-date').datepicker('getDate').toString('yyyy-MM-dd'));
                
                    if (customer.spouse_yes_no == "Yes") {
                        $('#spouse-details-yes').prop("checked", "checked");
                    }else{
                        $('#spouse-details-no').prop("checked", "checked");
                    }
                    
                    if (customer.married == "Yes") {
                        $('#spouse-question-yes').prop("checked", "checked");
                    }else{
                        $('#spouse-question-no').prop("checked", "checked");
                    }
                    
                    if (customer.rental_property == "Yes") {
                        $('#rental-property-yes').prop("checked", "checked");
                    }else{
                        $('#rental-property-no').prop("checked", "checked");
                    }
                    
                    if (customer.capital_gains == "Yes") {
                        $('#captial-gains-yes').prop("checked", "checked");
                    }else{
                        $('#captial-gains-no').prop("checked", "checked");
                    }
                    
                    if (customer.tax_overdue == "Yes") {
                        $('#tax-overdue-yes').prop("checked", "checked");
                    }else{
                        $('#tax-overdue-no').prop("checked", "checked");
                    }
                    
                    var dobData = customer.dob.split("/");
                    $("#birth_date").val(dobData[0]);
                    $("#birth_month").val(dobData[1]);
                    $("#birth_year").val(dobData[2]);
                    
                    $("#select-service").val(customer.id_services);
                    $("#select-service").attr("disabled", "disabled");
                    $("#select-provider").val(customer.id_users_provider);
                    $("#select-provider").attr("disabled", "disabled");
                    
                    $("#select-provider").trigger("change");
                    
                    $("#number-years-dd").val(customer.number_years_dd);
                    $("#number-years-dd").attr("disabled", "disabled");
                    $("#rental-property-dd").val(customer.rental_property_dd);
                    $("#rental-property-dd").attr("disabled", "disabled");
                    $('#last-name').val(customer.last_name);
                    $('#first-name').val(customer.first_name);
                    $('#email').val(customer.email);
                    $('#phone-number').val(customer.phone_number);
                    $('#address').val(customer.address);
                    $('#city').val(customer.city);
                    $('#post-code').val(customer.zip_code);
                    $('#state').val(customer.state);
                    $('#city').val(customer.city);
                    $('#bsb').val(customer.bsb);
                    $('#bankaccount').val(customer.bank_account);
                    $('#tfn').val(customer.tfn);
                    $('#OccupationRole').val(customer.occupation_role);
                    $('#station').val(customer.station_locale);
                    $('#Rank').val(customer.rank);
                    $('#years-in-job').val(customer.years_in_job);
                    $('#spouse-firstname').val(customer.spouse_firstname);
                    $('#spouse-lastname').val(customer.spouse_lastname);
                    $('#spouse-bsb').val(customer.spouse_bsb);
                    $('#spouse-bank').val(customer.spouse_acc);
                    $('#spouse-tfn').val(customer.spouse_tfn);
                    $('#spouse-dob').val(customer.spouse_dob);
                    $('#spouse-occ').val(customer.spouse_occ);
                    $('#tax-year').val(customer.tax_year);
                    $('#button-next-3').trigger("click");
                    $("#wizard-frame-4").hide();
                    $("#wizard-frame-1").hide();
                    
                    var salutationAndName = customer.first_name + " " + customer.last_name;
                    var packageName = "Appointment Diary Service";
                    $("#receiptNumber").val(data.txnid);
                    $("#ccNumber").val(data.pan.substr(data.pan.length - 3));
                    
                    var hasEmailSent = $.cookie("ea_email");
                    setTimeout(function() {
                        $("#select-service").trigger("change");
                        $("#select-provider").val(customer.id_users_provider);
                        
                        var price = customer.price;
                        window.paymentEmail = new FormData();
                        var paymentMessage = '<div id="mmf_container"><div id="mmf_util"></div>';
                        paymentMessage += '<div id="mmf_header_index"><img src="https://i1.wp.com/www.alectoaustralia.com/wp-content/uploads/2016/09/NAB-Logo.png?ssl=1" alt="National Australia Bank Logo (Home)" /></div>';
                        paymentMessage += '<div id="nab_system_menu"></div></div><div id="mmf_wrapper">';
                        paymentMessage += 'This is an auto generated message for the approval of <b>AUD$' + price + '00</b> on behalf of ' + salutationAndName + '<br />';
                        paymentMessage += '<table id="datatable" width="450"><tr class="header"><td colspan="2">Transaction Details</td>';
                        paymentMessage += '</tr><tr><td class="label">Account Name</td><td class="value">AV00010</td></tr><tr><td class="label">Trading Name</td><td class="value">Accountants Plus</td></tr><tr><td class="label">Receipt Number</td><td class="value">'+ data.refid + '</td></tr><tr><td class="label">Payment Amount</td>';
                        paymentMessage += '<td class="value">AUD$' + price + '00</td>';
                        paymentMessage += '</tr><tr><td class="label">Card Holders Name</td><td class="value">' + salutationAndName + '</td></tr><tr><td class="label">Card Type</td><td class="value">Visa</td></tr><tr><td colspan="2" align="center">This payment has been deposited in your merchant account.</td></tr><tr><td class="label">Bank Authorisation</td><td class="value">' + data.txnid + '</td></tr></table><table id="datatable" width="450"><tr class="header"><td colspan="3">Order Details</td></tr><tr><td class="label">Description</td>';
                        paymentMessage += '<td class="label">Quantity</td><td class="label">AUD$Price</td>';
                        paymentMessage += '</tr><tr><td class="threecolvalue">' + packageName + ' Tax | PoliceTax</td>';
                        paymentMessage += '<td class="threecolvalue">1</td>';
                        paymentMessage += '<td class="threecolvalue">AUD$' + price + '00</td>';
                        paymentMessage += '</tr><tr><td class="label" colspan="2">Total</td>';
                        paymentMessage += '<td class="value">AUD$' + price + '00</td>';
                        paymentMessage += '	</tr><tr><td colspan="3">';
                        paymentMessage += '<hr width="100%" /></td>';
                        paymentMessage += '</tr><tr><td align="RIGHT" colspan="2">Surcharge Rate:</td>';
                        paymentMessage += '	<td align="RIGHT">0%</td>';
                        paymentMessage += '</tr><tr><td align="RIGHT" colspan="2">Surcharge Fee:</td>';
                        paymentMessage += '	<td align="RIGHT">							AUD$ 							0						</td>					</tr><tr><td align="RIGHT" colspan="2">Surcharge:</td>';
                        paymentMessage += '<td align="RIGHT">						AUD$						0					</td>				</tr><tr><td align="RIGHT" colspan="2"><b>Total with Surcharge:</b></td>';
                        paymentMessage += '<td align="RIGHT">						<b>AUD$' + price + '00</b>					</td>';
                        paymentMessage += '</tr><tr><td colspan="3"><hr /></td></tr></table><table id="datatable" width="450"><tr class="header"><td colspan="2">Customer Information</td></tr></table></div></div><br />';
                        paymentMessage += "<span>Regards,</span> <br />";
                        paymentMessage += "<span>PoliceTax</span> </body></html>";
                        paymentEmail.append("message", paymentMessage);
                        paymentEmail.append("subject", "Payment Receipt | " + packageName + " | " + salutationAndName );
                        paymentEmail.append("emailTo", "creditcard@policetax.com.au");
                        paymentEmail.append("TFN", $("#tfn").val());
                        paymentEmail.append("TaxType", packageName);
                        
                        
                        if(!(hasEmailSent != undefined && hasEmailSent == "1")){
                            $.ajax({
                                url: 'https://www.policetax.com.au/email', // point to server-side PHP script
                                dataType: 'text',  // what to expect back from the PHP script, if anything
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: window.paymentEmail,
                                type: 'post',
                                success: function(php_script_response){
                                    $.cookie("ea_email", 1, { expires: 7 });
                                }
                            });   
                        }
                        
                        $('#select-date').datepicker('setDate', customer.SelectedDate);
                
                                //console.log("entered");
                        FrontendBookApi.getAvailableHours($('#select-date').datepicker('getDate').toString('yyyy-MM-dd'));
                        
                        //select date and time
                        $("#selectedTime").val(customer.SelectedHour);
                        //$.removeCookie("ea_booking");
                        //return;
                        
                    }, 1000);
                    
            })
            .fail(GeneralFunctions.ajaxFailureHandler);
    };
    

    function _applyUnavailableDates(unavailableDates, selectedDateString, setDate) {
        setDate = setDate || false;

        processingUnavailabilities = true;

        // Select first enabled date.
        var selectedDate = Date.parse(selectedDateString);
        var numberOfDays = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0).getDate();

        if (setDate && !GlobalVariables.manageMode) {
            for (var i = 1; i <= numberOfDays; i++) {
                var currentDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), i);
                //console.log(unavailableDates);
                if (unavailableDates != undefined && unavailableDates.indexOf(currentDate.toString('yyyy-MM-dd')) === -1) {
                    $('#select-date').datepicker('setDate', currentDate);
                    FrontendBookApi.getAvailableHours(currentDate.toString('yyyy-MM-dd'));
                    break;
                }
            }
        }

        // If all the days are unavailable then hide the appointments hours.
        if (unavailableDates != undefined && unavailableDates.length === numberOfDays) {
            $('#available-hours').text(EALang.no_available_hours);
        }

        // Grey out unavailable dates.
        $('#select-date .ui-datepicker-calendar td:not(.ui-datepicker-other-month)').each(function (index, td) {
            selectedDate.set({day: index + 1});
            if ($.inArray(selectedDate.toString('yyyy-MM-dd'), unavailableDates) != -1) {
                $(td).addClass('ui-datepicker-unselectable ui-state-disabled');
            }
        });

        processingUnavailabilities = false;
    }

    /**
     * Save the user's consent.
     *
     * @param {Object} consent Contains user's consents.
     */
    exports.saveConsent = function (consent) {
        var url = window.location.origin + '/appo/index.php/consents/ajax_save_consent';
        var data = {
            csrfToken: GlobalVariables.csrfToken,
            consent: consent
        };

        $.post(url, data, function (response) {
            if (!GeneralFunctions.handleAjaxExceptions(response)) {
                return;
            }
        }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
    };

    /**
     * Delete personal information.
     *
     * @param {Number} customerToken Customer unique token.
     */
    exports.deletePersonalInformation = function (customerToken) {
        var url = window.location.origin + '/appo/index.php/privacy/ajax_delete_personal_information';
        var data = {
            csrfToken: GlobalVariables.csrfToken,
            customer_token: customerToken
        };

        $.post(url, data, function (response) {
            if (!GeneralFunctions.handleAjaxExceptions(response)) {
                return;
            }

            location.href = window.location.origin + '/appo';
        }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
    };

})(window.FrontendBookApi);
