var valid = false;
function invalidate() {
	valid = true;
	var arr = ['workSector', 'Rank', 'branch'];
	arr.forEach((a) => {
		if($("#" + a).val() == null || $("#" + a).val().length <= 0) {
			if((a == "branch" || a == "Rank")  && $("#workSector").val() == "Other"){

			} else {
				valid = false;
			}
		}
	});

	if(valid) {
		$("#step2next").addClass("btn-primary");
		$("#step2next").removeClass("btn-secondary");
		$("#step2next").prop("disabled", false);
	} else {
		$("#step2next").addClass("btn-secondary");
		$("#step2next").removeClass("btn-primary");
		$("#step2next").prop("disabled", true);
	}
}
function retrieveData() {
	var id = $('#id').val();
	if(id != null && id.length > 0) {
		$.ajax({
			url: './php/step2db.php',
			data: {'action': 'selectuser', 'id':id},
			type: 'post',
			success: function(data, sstatus) {
				var json = JSON.parse(data);
				if(json.length > 0) {
					if($("#workSector").val().length == 0) $("#workSector").val(json[0].occupation_role).change();
					var stationValue = $("#stationValue").val();
					if(stationValue != null && stationValue.length > 0) $("#station").val(stationValue);
					else $("#station").val(json[0].station_locale);
					if($("#Rank").val().length == 0) $("#Rank").val(json[0].rank).change();
					if($("#branch").val().length == 0) $("#branch").val(json[0].branch).change();
					if($("#role").val().length == 0) $("#role").val(json[0].role);
					
                	var isAddressChange = false;
                
                	if($("input[name='addressChange']:checked").val() == "10"){
                		isAddressChange = true;
                	}
                	toggleElement(isAddressChange);
                	
                	
                   var isBankChange = false;
                
                   if($("input[name='bankChange']:checked").val() == "10"){
                	  isBankChange = true;
                   }
                   toggleElement2(isBankChange);
				}
			},
			error: function(xhr, desc, err) {
			}
		});
	} else {
		var stationValue = $("#stationValue").val();
		if(stationValue != null && stationValue.length > 0) $("#station").val(stationValue);
	}
}
function init() {
	invalidate();
	
	$("#spouseItem0").click(function() {
		$("#spouseNameDiv").hide();
	});
	$("#spouseItem1").click(function() {
		$("#spouseNameDiv").show();
	});
	
	$('#step3link').click(function (e) {
		if(!valid) e.preventDefault();
		else submit();
	});	
	$('#step4link').click(function (e) {
		e.preventDefault();
	});
	$('#workSector').change(function (e) {
		e.preventDefault();
		$("#station").val("");
		$("#rankCol").show();
		$("#roleCol").show();
		var selectedVal = $("#workSector option:selected").val();
		if(selectedVal == "PoliceOfficer"){
			$("#Rank").html("");
			$("#Rank").html(`<option value="Select">Select</option>
										<option value="Police Recruit">Police Recruit</option>
										<option value="SnrConstable">Snr Constable</option>
										<option value="1stConstable">First Constable</option>
										<option value="Constable">Constable</option>
										<option value="Leading Senior Constable">Leading Snr Constable</option>
										<option value="Sergeant">Sergeant</option>
										<option value="SnrSergeant">Snr Sergeant</option>
										<option value="Inspector">Inspector</option>
										<option value="Superintendent">Superintendent</option>
										<option value="HigherRank">Higher Rank</option>
										<option value="Rank">Rank</option>
										<option value="Other">Other</option>`);
		} else if(selectedVal == "PSO"){
			$("#Rank").html("");
			$("#Rank").html(`<option value="Select">Select</option>
										<option value="Recruit PSO"> Recruit PSO</option>
										<option value="PSO 1st Class">PSO 1st Class</option>
										<option value="PSO Senior">PSO Senior</option>
										<option value="PSO Sergent">PSO Sergent</option>
										<option value="PSO Supervisor">PSO Supervisor</option>
										<option value="PSO Snr Supervisor">PSO Snr Supervisor</option>
										<option value="Other">Other</option>`);
		} else if(selectedVal == "BorderForce"){
			$("#Rank").html("");
			$("#Rank").html(`<option value="Select">Select</option>
										<option value="Assist Officer">Assist Officer</option>
										<option value="Officer">Officer</option>
										<option value="Leading Officer">Leading Officer</option>
										<option value="Senior Officer">Senior Officer</option>
										<option value="Supervisor">Supervisor</option>
										<option value="Inspector">Inspector</option>
										<option value="Superintendent">Superintendent</option>
										<option value="Chief Superintendent">Chief Superintendent</option>
										<option value="HigherRank">Higher Rank</option>
										<option value="Commander">Commander</option>
										<option value="Other">Other</option>`);
		} else if(selectedVal == "Federal"){
			$("#Rank").html("");
			$("#Rank").html(`<option value="Select">Select</option>
										<option value="Recruit Trainee">Recruit Trainee</option>
										<option value="SnrConstable">Snr Constable</option>
										<option value="Constable">Constable</option>
										<option value="Leading Senior Constable">Leading Snr Constable</option>
										<option value="Sergeant">Sergeant</option>
										<option value="SnrSergeant">Snr Sergeant</option>
										<option value="Commander">Commander</option>
										<option value="HigherRank">Higher Rank</option>
										<option value="Other">Other</option>`);
		} else if(selectedVal == "Other") {
			$("#station").val("");
			$("#rankCol").hide();
			$("#roleCol").hide();
			$("#Rank").val("");
			$("#branch").val("");
			$("#role").val("");
			$("#Rank").html("");
			$("#Rank").html(`<option value="Select">Select</option>
										<option value="Other">Other</option>`);
		} else {
			$("#Rank").html("");
			$("#Rank").html(`<option value="Select">Select</option>`);
		}
		
	});
	$("#workSector option:selected").trigger("change");
	var currentRank = $("#idRank").val();
	if(currentRank != null && currentRank.length > 0) {
		$('#Rank').val(currentRank).prop('selected', true);
	}
	retrieveData();
}
function submit() {
	var address = $("#addressChangeItem1").prop("checked");
	var spouse = $("#spouseItem1").prop("checked");
	var bank = $("#bankChangeItem1").prop("checked");
	var spouseTax = $("#spouseTaxItem1").prop("checked");
	var workSector = $("#workSector").val();
	var station = $("#station").val();
	var Rank = $("#Rank").val();
	var branch = $("#branch").val();
	var role = $("#role").val();
	var street = $("#street").val();
	var suburb = $("#suburb").val();
	var city = $("#city").val();;
	var state = $("#state").val();
	var postcode = $("#postcode").val();
	var bsb = $("#bsb").val();
	var account = $("#account").val();
	var spouseFirstName = $("#spouseFirstName").val();
	var spouseLastName = $("#spouseLastName").val();
	var spouseDOB = $("#spouseDOB").val();
	var data = { 'action': 'session', 'address' : address ? 'checked' : '', 'spouse' : spouse ? 'checked' : '', 'bank' : bank ? 'checked' : '', 'spouseTax' : spouseTax ? 'checked' : '',  'workSector': workSector, 'station': station, 'Rank': Rank, 'branch': branch, 'role': role, 'street': street, 'suburb': suburb, 'city': city, 'state': state, 'postcode': postcode, 'bsb': bsb, 'account': account, 'spouseFirstName': spouseFirstName, 'spouseLastName': spouseLastName, 'spouseDOB': spouseDOB };
	console.log(data);
	$.ajax({
		url: './php/step2db.php',
		data: data,
		type: 'post',
		success: function(data, sstatus) {
			$('#step2form').submit();
		},
		error: function(xhr, desc, err) {
		}
	});
}
function clientDetails1Change2() {
	invalidate();
}
$(function() {
	init();
	$('#step2next').click(function (e) {
		e.preventDefault();
		submit();
	});
});

$(document).ready(function(){
	var isAddressChange = false;

	if($("input[name='addressChange']:checked").val() == "10"){
		isAddressChange = true;
	}
	toggleElement(isAddressChange);


   var isBankChange = false;

   if($("input[name='bankChange']:checked").val() == "10"){
	  isBankChange = true;
   }
   toggleElement2(isBankChange);

   $("#workSector").change(clientDetails1Change2);
   $("#station").keyup(clientDetails1Change2);
   $("#Rank").keyup(clientDetails1Change2);
   $("#branch").change(clientDetails1Change2);
});

$(document).on("change", "input[name='addressChange']", function(e){
	e.preventDefault();

	var isAddressChange = false;

	if($("input[name='addressChange']:checked").val() == "10"){
		isAddressChange = true;
	}
	toggleElement(isAddressChange);
});
function toggleElement(show) {
	var element = $("#elementToToggle");
	if (show) {
		element.removeClass("hidden");
	} else {
		element.addClass("hidden");
	}
}

$(document).on("change", "input[name='bankChange']", function(e){
   e.preventDefault();

   var isBankChange = false;

   if($("input[name='bankChange']:checked").val() == "10"){
	  isBankChange = true;
   }
   toggleElement2(isBankChange);
});
function toggleElement2(show) {
   var element = $("#elementToToggle2");
   if (show) {
	  element.removeClass("hidden");
   } else {
	  element.addClass("hidden");
   }
}