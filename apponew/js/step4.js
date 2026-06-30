var valid = false;
var useCreditCard = true;
function invalidate() {
	valid = true;
	var arr = ['name', 'number', 'exp', 'cvv'];
	arr.forEach((a) => {
		if($("#" + a).val() == null || $("#" + a).val().length <= 0) {
			valid = false;
		}
	});
	if (!useCreditCard) {
	    valid = true;
	}
	if(valid) {
		$("#step4next").addClass("btn-primary");
		$("#step4next").removeClass("btn-secondary");
		$("#step4next").prop("disabled", false);
	} else {
		$("#step4next").addClass("btn-secondary");
		$("#step4next").removeClass("btn-primary");
		$("#step4next").prop("disabled", true);
	}
}
function init() {
	$("#exp").mask("00/00", {placeholder: "mm/yy"});
	$("#number").mask("0000 0000 0000 0000");
	
	$("#creditCardMethod").click(function() {
	    useCreditCard = true;
		$("#creditCardDetails").show();
		invalidate();
	});
	$("#paypalMethod").click(function() {
	    useCreditCard = false;
		$("#creditCardDetails").hide();
		invalidate();
	});
}
function processPayment() {
	$('#js-spinner-modal').modal('show');
	var amount = $('#priceValue').val();
	var cardNumber = $('#number').val().replace(/\s+/g, '');
	var cvv = $('#cvv').val();
	var expiryDate = $('#exp').val();
	var cardHolderName = $('#name').val();
	var sendData = { 'action':'sendPayment', 'amount': amount, 'cardNumber': cardNumber, 'cvv': cvv, 'expiryDate': expiryDate, 'cardHolderName': cardHolderName  };	
	if(typeof(grecaptcha) == "undefined") {
	    $('#js-spinner-modal').modal('hide');
		$('#noticeBody').html('Please check your network and try again.');
		$('#js-notice-modal .js-first-focus').removeClass('btn-success');
		$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
		$('#js-notice-modal .js-first-focus').addClass('btn-success');
		$('#js-notice-modal').modal('show');
		return;
	}
    grecaptcha.ready(function() {
        grecaptcha.execute('6Ld-ODkfAAAAAGvOlu7s5LolENGPaFoT_axSv1ii', {action: 'submit'}).then(function(token) {
            sendData.token = token;
        	$.ajax({
        		url: './php/sendp.php',
        		data: sendData,
        		type: 'POST',
        		success: function(data, sstatus) {
        			$('#js-spinner-modal').modal('hide');
        			if(sstatus == 404) {
        				$('#noticeBody').html('The payment failed. Please check your network and try again.');
        				$('#js-notice-modal .js-first-focus').removeClass('btn-success');
        				$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
        				$('#js-notice-modal .js-first-focus').addClass('btn-success');
        				$('#js-notice-modal').modal('show');
        				return;
        			}
        			if(data == '0') {
        				$('#noticeBody').html('The payment failed. Please try again with another credit card or contact your bank.');
        				$('#js-notice-modal .js-first-focus').removeClass('btn-success');
        				$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
        				$('#js-notice-modal .js-first-focus').addClass('btn-danger');
        				$('#js-notice-modal').modal('show');
        			} else {
        				var json = {};
        				try {
        					json = JSON.parse(data);
        				} catch (err) {
        					$('#noticeBody').html('There is some unknown error. Please try again.');
        					$('#js-notice-modal .js-first-focus').removeClass('btn-success');
        					$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
        					$('#js-notice-modal .js-first-focus').addClass('btn-success');
        					$('#js-notice-modal').modal('show');
        					return;
        				}
        				var error = false;
        				var errorMessage = null;
        				if(json.error == null || json.error == true) error = true;
        				else {
        					var status = json.message.Status;
        					if(status == null) error = true;
        					else {
        						var statusCode = status.statusCode;
        						if(statusCode != "000") {
        							error = true;
        							errorMessage = status.statusDescription;
        						}
        						
        					}
        				}
        				if(error) {
        					if(errorMessage != null) $('#noticeBody').html('There is error: ' + errorMessage + '. Please try again.');
        					else $('#noticeBody').html('There is unknown error. Please try again.');
        					$('#js-notice-modal .js-first-focus').removeClass('btn-success');
        					$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
        					$('#js-notice-modal .js-first-focus').addClass('btn-danger');
        					$('#js-notice-modal').modal('show');
        				} else {
        					var payment = json.message.Payment;
        					if(payment != null) {
        						var txnList = payment.TxnList;
        						if(txnList != null) {
        							var Txn = txnList.Txn;
        							if(Txn != null && Txn.approved == "No") {
        								error = true;
        								$('#noticeBody').html('There is error: ' + Txn.responseText + '. Please try again.');
        								$('#js-notice-modal .js-first-focus').removeClass('btn-success');
        								$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
        								$('#js-notice-modal .js-first-focus').addClass('btn-danger');
        								$('#js-notice-modal').modal('show');
        								return;
        							} else if (Txn != null && Txn.approved == "Yes") {
        								var responseCode = Txn.responseCode;
        								if(responseCode == "08") processEmail(Txn);
        								else {
        									error = true;
        									$('#noticeBody').html('There is error: ' + Txn.responseText + '. Please try again.');
        									$('#js-notice-modal .js-first-focus').removeClass('btn-success');
        									$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
        									$('#js-notice-modal .js-first-focus').addClass('btn-danger');
        									$('#js-notice-modal').modal('show');
        									return;
        								}
        							}
        						} else {
        							$('#noticeBody').html('There is some unknown error. Please try again.');
        							$('#js-notice-modal .js-first-focus').removeClass('btn-success');
        							$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
        							$('#js-notice-modal .js-first-focus').addClass('btn-success');
        							$('#js-notice-modal').modal('show');
        						}
        					} else {
        						$('#noticeBody').html('There is some unknown error. Please try again.');
        						$('#js-notice-modal .js-first-focus').removeClass('btn-success');
        						$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
        						$('#js-notice-modal .js-first-focus').addClass('btn-success');
        						$('#js-notice-modal').modal('show');
        					}
        				}
        			}
        		},
        		error: function(xhr, desc, err) {
        		    $('#js-spinner-modal').modal('hide');
        			$('#noticeBody').html('There is some unknown error. Please try again.');
        			$('#js-notice-modal .js-first-focus').removeClass('btn-success');
        			$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
        			$('#js-notice-modal .js-first-focus').addClass('btn-success');
        			$('#js-notice-modal').modal('show');
        		}
        	});

        });
    });
}
function processPaymentPaypal(ReceiptID, PaypalUserId) {
    var Txn = { 'txnID': ReceiptID, 'PaypalUserId': PaypalUserId };
    processEmail(Txn);
}
function processEmail(Txn) {
	$('#js-spinner-modal').modal('show');
	var ReceiptId = Txn.txnID;
	var sendData = { 'action':'processEmail', 'ReceiptId': ReceiptId };
	$.ajax({
		url: './php/sendp.php',
		data: sendData,
		type: 'post',
		success: function(data, sstatus) {
		    processTaxedEmail(Txn);
			var emailSent = (data == "Success") ? '1' : '0';
			var emailError = (data == "Success") ? null : data;
			processSaving(Txn, emailSent, emailError);
		},
		error: function(xhr, desc, err) {
			processSaving(Txn, '0');
		}
	});
}
function processTaxedEmail(Txn) {
	var ReceiptId = Txn.txnID;
	var sendData = { 'action':'processTaxedEmail', 'ReceiptId': ReceiptId };
	$.ajax({
		url: './php/sendp.php',
		data: sendData,
		type: 'post',
		success: function(data, sstatus) {
		},
		error: function(xhr, desc, err) {
		}
	});
}
function promocodeQuery() {
	$.ajax({
		url: './php/step4db.php',
		data: {'action': 'promocode', 'promo_code': $("#promo-code").val()},
		type: 'post',
		success: function(data, sstatus) {
			var promoCodeData = JSON.parse(data);
			if(promoCodeData.length > 0) {
				$.each(promoCodeData, function (i, item) {
					var percentage = parseFloat(item.Price);
					var percentageAmount = (parseFloat($("#initialpriceValue").val()) * percentage)/100;
					var discountedAmount = (parseFloat($("#initialpriceValue").val()) - percentageAmount) - parseFloat($("#discountAmountValue").val());
					console.log(discountedAmount);
					$("#price").val(`$${discountedAmount.toFixed(2)} AUD`);
					$("#priceValue").val(`${discountedAmount.toFixed(2)}`);
					$("#promocodeAmount").val(`$${percentageAmount.toFixed(2)} AUD`);
					$("#promo-code").attr("disabled", "disabled");
					$("#submit-promo").attr("disabled", "disabled");
					$(".promo-data").show();
				});
			}else{
			    alert("Invalid Promo code");
				$(".promo-data").hide();
				$("#promo-code").removeAttr("disabled");
				$("#submit-promo").removeAttr("disabled");
			}
		},
		error: function(xhr, desc, err) {
		}
	});
}
function processSaving(Txn, emailSent, emailError) {
	$('#js-spinner-modal').modal('show');
	var CreditCardNumber = "";
	if (typeof(Txn.CreditCardInfo) == "undefined") {
	    CreditCardNumber = Txn.PaypalUserId;
	} else {
    	var pan = Txn.CreditCardInfo.pan;
    	CreditCardNumber = pan.substr(pan.length - 3);
	}
	var ReceiptId = Txn.txnID;
	var sendData = { 'action':'processSaving', 'CreditCardNumber': CreditCardNumber, 'ReceiptId': ReceiptId, 'emailSent': emailSent };	
	$.ajax({
		url: './php/sendp.php',
		data: sendData,
		type: 'post',
		success: function(data, sstatus) {
			$('#js-spinner-modal').modal('hide');
			$('#noticeBody').html('The appointment is booked successfully with receipt number ' + ReceiptId);
			//if(emailError != null) $('#noticeBody').html('The appointment is booked successfully with receipt number ' + ReceiptId + ' but email can not be sent with error ' + emailError);
			$('#js-notice-modal .js-first-focus').removeClass('btn-success');
			$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
			$('#js-notice-modal .js-first-focus').addClass('btn-success');
			$('#js-notice-modal').modal('show');
			$('#js-notice-modal').on('hidden.bs.modal', function (e) {
			    $('#step4form').attr('action', 'step5.php');
				$('#step4form').submit();
			});
		},
		error: function(xhr, desc, err) {
			$('#js-spinner-modal').modal('hide');
			$('#noticeBody').html('The appointment is booked successfully with receipt number ' + ReceiptId);
			$('#js-notice-modal .js-first-focus').removeClass('btn-success');
			$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
			$('#js-notice-modal .js-first-focus').addClass('btn-success');
			$('#js-notice-modal').modal('show');
			$('#js-notice-modal').on('hidden.bs.modal', function (e) {
			    $('#step4form').attr('action', 'step5.php');
				$('#step4form').submit();
			});
		}
	});
}
function showError(message) {
    $(function() {
		$('#noticeBody').html(message);
		$('#js-notice-modal .js-first-focus').removeClass('btn-success');
		$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
		$('#js-notice-modal .js-first-focus').addClass('btn-danger');
		$('#js-notice-modal').modal('show');
    });
}
function showSuccess(message) {
    $(function() {
		$('#noticeBody').html(message);
		$('#js-notice-modal .js-first-focus').removeClass('btn-success');
		$('#js-notice-modal .js-first-focus').removeClass('btn-danger');
		$('#js-notice-modal .js-first-focus').addClass('btn-success');
		$('#js-notice-modal').modal('show');
    });
}
$(function() {
	init();
	invalidate();
	$('#step4next').click(function (e) {
		if (useCreditCard) {
    		e.preventDefault();
		    processPayment();
		} else {
		    $('#paypal').val('yes');
		}
		//processEmail({'CreditCardInfo': {'pan': '34235'}, 'txnID': '123' });
		//processSaving({'CreditCardInfo': {'pan': '34235'}, 'txnID': '123' }, '1', null);
	});
	
    $("#submit-promo").click(function(e){
        e.preventDefault();
        promocodeQuery();
    });
	$("#name").keyup(invalidate);
	$("#number").keyup(invalidate);
	$("#exp").keyup(invalidate);
	$("#cvv").keydown(invalidate);
	$("#cvv").keyup(invalidate);
});