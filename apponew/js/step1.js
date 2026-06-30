var valid = false;
function invalidate() {
	valid = true;
	var arr = ['fname', 'lname', 'dob', 'email', 'mob'];
	arr.forEach((a) => {
		if($("#" + a).val() == null || $("#" + a).val().length <= 0) {
			valid = false;
		}
	});

	var dob = $("#dob").val();	
	if(dob != null && dob.length > 0) {
		var dobdt = moment(dob, "YYYY/MM/DD");
		if(!dobdt.isValid()) {
			valid = false;
			$("#doberror").show();
		} else $("#doberror").hide();
	} else $("#doberror").hide();

	var email = $("#email").val();	
	if(email != null && email.length > 0) {
		if(!validateEmail(email)) {
			valid = false;
			$("#emailerror").show();
		} else $("#emailerror").hide();
	} else $("#emailerror").hide();

	if(valid) {
		$("#step1next").addClass("btn-primary");
		$("#step1next").removeClass("btn-secondary");
		$("#step1next").prop("disabled", false);
	} else {
		$("#step1next").addClass("btn-secondary");
		$("#step1next").removeClass("btn-primary");
		$("#step1next").prop("disabled", true);
	}
}
function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
function clientDetails1Change1() {
	var goProcess = true;
	var arr = ['fname', 'lname', 'dob'];
	arr.forEach((a) => {
		if($("#" + a).val() == null || $("#" + a).val().length <= 0) {
			goProcess = false;
		}
	});
	if(!goProcess) return;
	var existClient = $("#existClient").prop("checked");
	if(existClient) {
		var fname = $("#fname").val();
		var lname = $("#lname").val();
		var dob = $("#dob").val();
		var data = {'action': 'selectuser', 'fname' : fname, 'lname': lname, 'dob': dob};
		$.ajax({
			url: './php/step1db.php',
			data: data,
			type: 'post',
			success: function(data, sstatus) {
				var json = JSON.parse(data);
				if(json.length > 0) {
					$("#id").val(json[0].id);
					$("#fname").val(json[0].first_name);
					$("#lname").val(json[0].last_name);
					$("#email").val(json[0].email);
					$("#mob").val(json[0].phone_number != null ? json[0].phone_number : json[0].mobile_number);
					$("#tfn").val(json[0].tfn);
					
					$("#street").val(json[0].address);
					$("#suburb").val(json[0].suburb);
					$("#city").val(json[0].city);
					$("#state").val(json[0].state);
					$("#postcode").val(json[0].zip_code);
					$("#bsb").val(json[0].tfn);
					$("#account").val(json[0].bank_account);
				}
				invalidate();
			},
			error: function(xhr, desc, err) {
				valid = false;
				$("#step1next").addClass("btn-secondary");
				$("#step1next").removeClass("btn-primary");
				$("#step1next").prop("disabled", true);
			}
		});
	}
	invalidate();
}
function clientDetails1Change2() {
	invalidate();
}
function init() {
	//$('#dob').datepicker({autoclose: true, format: 'dd/mm/yyyy', disableTouchKeyboard: true, change: clientDetails1Change1});
	$("#dob").mask("00/00/0000", {placeholder: "dd/mm/yyyy"});
	invalidate();
	
	$("#existClient").click(function() {
		$("#clientDetails").show();
		$("#clientDetails2").hide();
		//$("#clientDetails2").show();
	});
	$("#newClient").click(function() {
		$("#clientDetails").show();
		$("#clientDetails2").show();
	});
	$('#step2link').click(function (e) {
		if(!valid) e.preventDefault();
		else submit();
	});
	$('#step3link').click(function (e) {
		if(!valid) e.preventDefault();
		else submit();
	});
	$('#step4link').click(function (e) {
		e.preventDefault();
	});
	$('#step1cancel').click(function (e) {
		$("#fname").val('');
		$("#lname").val('');
		$("#dob").val('');
		$("#email").val('');
		$("#mob").val('');
		$("#tfn").val('');
		$("#street").val('');
		$("#suburb").val('');
		$("#city").val('');
		$("#state").val('');
		$("#postcode").val('');
		$("#bsb").val('');
		$("#account").val('');
	});
}
function submit() {
	var id = $("#id").val();
	var fname = $("#fname").val();
	var lname = $("#lname").val();
	var dob = $("#dob").val();
	var dobdt = moment(dob, "YYYY/MM/DD");
	if(!dobdt.isValid()) {
		return;
	}
	var email = $("#email").val();
	var mob = $("#mob").val();
	var tfn = $("#tfn").val();
	var street = $("#street").val();
	var suburb = $("#suburb").val();
	var city = $("#city").val();;
	var state = $("#state").val();
	var postcode = $("#postcode").val();
	var bsb = $("#bsb").val();
	var account = $("#account").val();
	var existClient = $("#existClient").prop("checked");
	var newClient = $("#newClient").prop("checked");
	var data = { 'action': 'session', 'exist' : existClient ? 'checked' : '', 'new' : newClient ? 'checked' : '', 'id' : id, 'fname' : fname, 'lname': lname, 'dob': dob, 'email': email, 'mob': mob, 'tfn': tfn, 'street': street, 'suburb': suburb, 'city': city, 'state': state, 'postcode': postcode, 'bsb': bsb, 'account': account };
	$.ajax({
		url: './php/step1db.php',
		data: data,
		type: 'post',
		success: function(data, sstatus) {
			$('#step1form').submit();
		},
		error: function(xhr, desc, err) {
		}
	});
}
$(function() {
	init();
	$('#step1next').click(function (e) {
		e.preventDefault();
		submit();
	});
	$("#fname").keyup(clientDetails1Change1);
	$("#lname").keyup(clientDetails1Change1);
	$("#dob").keyup(clientDetails1Change1);
	$("#dob").change(clientDetails1Change1);
	$("#email").keyup(clientDetails1Change2);
	$("#mob").keyup(clientDetails1Change2);
	$("#tfn").keyup(clientDetails1Change2);
	
	$("#street").keyup(clientDetails1Change2);
	$("#suburb").keyup(clientDetails1Change2);
	$("#city").keyup(clientDetails1Change2);
	$("#state").keyup(clientDetails1Change2);
	$("#postcode").keyup(clientDetails1Change2);
	$("#bsb").keyup(clientDetails1Change2);
	$("#account").keyup(clientDetails1Change2);
});