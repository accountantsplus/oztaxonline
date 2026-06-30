var currentPageIndex = 1;
var numberOfClients = 0;
var numberOfPages = 0;
var order = null;
var desc = false;
function eventHandler() {
  $(".pagFirst > a").click(function() {
  	currentPageIndex = 1;
	  readClient();
  });
  $(".pagPrev > a").click(function() {
  	if( currentPageIndex == 1 ) currentPageIndex = 1;
  	else currentPageIndex -= 1;
	  readClient();
  });
  $(".pagSearch > a").click(function() {
  	currentPageIndex = parseInt($(this).attr("id"));
	  readClient();
  });
  $(".pagNext > a").click(function() {
  	currentPageIndex += 1;
	  readClient();
  });
  $(".pagLast > a").click(function() {
  	currentPageIndex = numberOfPages;
	  readClient();
  });
}
function orderHandler() {
  $("#FirstName").click(function() {order = "FirstName";desc = false;readClient();});
  $("#FirstNamedesc").click(function() {order = "FirstName";desc = true;readClient();});
  $("#LastName").click(function() {order = "LastName";desc = false;readClient();});
  $("#LastNamedesc").click(function() {order = "LastName";desc = true;readClient();});
  $("#DOB").click(function() {order = "DOB";desc = false;readClient();});
  $("#DOBdesc").click(function() {order = "DOB";desc = true;readClient();});
  $(".TFN").click(function() {order = "TFN";desc = false;readClient();});
  $(".TFNdesc").click(function() {order = "TFN";desc = true;readClient();});
  $("#Occupation").click(function() {order = "OccDescription";desc = false;readClient();});
  $("#Occupationdesc").click(function() {order = "OccDescription";desc = true;readClient();});
  $(".Phone").click(function() {order = "MobileNo";desc = false;readClient();});
  $(".Phonedesc").click(function() {order = "MobileNo";desc = true;readClient();});
  $(".EMail").click(function() {order = "EMail";desc = false;readClient();});
  $(".EMaildesc").click(function() {order = "EMail";desc = true;readClient();});
  $("#DateAdded").click(function() {order = "DateAdded";desc = false;readClient();});
  $("#DateAddeddesc").click(function() {order = "DateAdded";desc = true;readClient();});
  $("#Refund").click(function() {order = "Refund";desc = false;readClient();});
  $("#Refunddesc").click(function() {order = "Refund";desc = true;readClient();});
  $("#TaxIncome").click(function() {order = "TaxIncome";desc = false;readClient();});
  $("#TaxIncomedesc").click(function() {order = "TaxIncome";desc = true;readClient();});
  $("#Estimate").click(function() {order = "Estimate";desc = false;readClient();});
  $("#Estimatedesc").click(function() {order = "Estimate";desc = true;readClient();});
  $(".Status").click(function() {order = "Status";desc = false;readClient();});
  $(".Statusdesc").click(function() {order = "Status";desc = true;readClient();});
  $("#LodgedDate").click(function() {order = "LodgeDate";desc = false;readClient();});
  $("#LodgedDatedesc").click(function() {order = "LodgeDate";desc = true;readClient();});
  $("#Name").click(function() {order = "FirstName";desc = false;readClient();});
  $("#Namedesc").click(function() {order = "FirstName";desc = true;readClient();});
}
function changePaging() {
	$(".searchItems").html("");
	if(numberOfPages <= 1) return;
	else if(numberOfPages <= 3) {
		for(var i = 1; i <= numberOfPages;i++) {
			var a = $('<a>').attr('id', i).html(i);
			var li = $('<li>').addClass('pagSearch').append(a);
			$(".searchItems").append(li);
		}
	}
	else if(numberOfPages > 3) {
		if(currentPageIndex > 1) {
			var first = $('<a>').attr('id', 'first').html('&laquo;');
			var liFirst = $('<li>').addClass('pagFirst').append(first);
			$(".searchItems").append(liFirst);
			var prev = $('<a>').attr('id', 'prev').html('&lt;');
			var liPrev = $('<li>').addClass('pagPrev').append(prev);
			$(".searchItems").append(liPrev);
			var a = $('<a>').attr('id', currentPageIndex - 1).html(currentPageIndex - 1);
			var li = $('<li>').addClass('pagSearch').append(a);
			$(".searchItems").append(li);
		}

		var a = $('<a>').attr('id', currentPageIndex).html(currentPageIndex);
		var li = $('<li>').addClass('pagSearch').append(a);
		$(".searchItems").append(li);

		if(currentPageIndex < numberOfPages) {
			var a = $('<a>').attr('id', currentPageIndex + 1).html(currentPageIndex + 1);
			var li = $('<li>').addClass('pagSearch').append(a);
			$(".searchItems").append(li);
			var next = $('<a>').attr('id', 'next').html('&gt;');
			var liNext = $('<li>').addClass('pagNext').append(next);
			$(".searchItems").append(liNext);
			var last = $('<a>').attr('id', 'last').html('&raquo;');
			var liLast = $('<li>').addClass('pagLast').append(last);
			$(".searchItems").append(liLast);
		}
	}
	eventHandler();
}
function countClient() {
	var notStartedCount = 0;
	var atoPrefillCount = 0;
	var appointmentCount = 0;
	var interviewedCount = 0;
	var waitOnInfoCount = 0;
	var waitOnSignCount = 0;
	var readyToLodgeCount = 0;
	var lodgedCount = 0;
	var lostCount = 0;
	var companyCount = 0;
  $.ajax({
    url: './php/countClient.php',
    data: null,
    type: 'post',
    success: function(data, sstatus) {
		var newClientsCount = 0
		var json = JSON.parse(data);
		$.each( json, function( index, value ){
			switch(parseInt(value.Status)) {
				case 0:notStartedCount++;break;
		  		case 1:appointmentCount++;break;
		  		case 2:interviewedCount++;break;
		  		case 3:waitOnInfoCount++;break;
		  		case 4:waitOnSignCount++;break;
		  		case 5:readyToLodgeCount++;break;
		  		case 6:lodgedCount++;break;
		  		case 10:atoPrefillCount++;break;
				case 12:lostCount++;break;
				case 13:companyCount++;break;
		  		default:break;
			}
			var date = value.DateAdded;
			var dt = moment(date, "YYYY-MM-DD");
			var dt2 = moment().month("July").date(1);
			var now = moment();
			if(now > dt2) {
				var dif = dt.diff(dt2, 'days');
				if(dif >= 0) newClientsCount++;
			}
			//var dif = dt.diff(dt2, 'days');
			//if(dif >= 0) newClientsCount++;
		});
		$("#newClientsNumbers").text(newClientsCount);
	  	var opts = $("#status-list > option");
		  if(notStartedCount > 0) $(opts[1]).text($(opts[1]).text() + " | " + notStartedCount);
		  if(atoPrefillCount > 0) $(opts[2]).text($(opts[2]).text() + " | " + atoPrefillCount);
		  if(appointmentCount > 0) $(opts[3]).text($(opts[3]).text() + " | " + appointmentCount);
		  if(interviewedCount > 0) $(opts[4]).text($(opts[4]).text() + " | " + interviewedCount);
		  if(waitOnInfoCount > 0) $(opts[5]).text($(opts[5]).text() + " | " + waitOnInfoCount);
		  if(waitOnSignCount > 0) $(opts[6]).text($(opts[6]).text() + " | " + waitOnSignCount);
		  if(readyToLodgeCount > 0) $(opts[7]).text($(opts[7]).text() + " | " + readyToLodgeCount);
		  if(lodgedCount > 0) $(opts[8]).text($(opts[8]).text() + " | " + lodgedCount);
		  if(lostCount > 0) $(opts[9]).text($(opts[9]).text() + " | " + lostCount);
		  if(companyCount > 0) $(opts[10]).text($(opts[10]).text() + " | " + companyCount);
		  $(opts[11]).text($(opts[11]).text() + " | " + json.length);
    },
    error: function(xhr, desc, err) {
      console.log(xhr);
    }
  });
}
function readClient() {
	var status = $("#status-list").val();
	var clientName = $("#clientName").val();
	var phoneNumber = $("#phoneNumber").val();
	var clientEmail = $("#clientEmail").val();
	var clientPostcode = $("#clientPostcode").val();
	var limit = parseInt($("#pagingSearch").val());
	var offset = (currentPageIndex - 1) * limit;
	$("#searchTable > tbody").html("");
	$("#searchSection > tbody").html("");
	var data = {"limit": limit, "offset": offset};
	if(status.length > 0) data.status = status;
	if(clientName.length > 0) data.clientName = clientName;
	if(phoneNumber.length > 0) data.phoneNumber = phoneNumber;
	if(clientEmail.length > 0) data.clientEmail = clientEmail;
	if(clientPostcode.length > 0) data.clientPostcode = clientPostcode;
	if(order != null) data.order = order;
	if(desc == true) data.desc = true;
	$.ajax({
		url: './php/readClient.php',
		data: data,
		type: 'post',
		success: function(data, sstatus) {
			var json = JSON.parse(data);
			if(json.length > 0) numberOfClients = parseInt(json[0].full_count) || 0;
			else numberOfClients = 0;
			numberOfPages = Math.floor(numberOfClients / limit);
			if(numberOfClients % limit > 0) numberOfPages += 1;
			changePaging();
			$.each( json, function( index, value ){
				addtr(index, value);
				addtrmob(index, value);
			});
			DetailsModal.queryData = json;
			$('#searchTable > tbody').find('.js-details-modal-trigger').on('click', DetailsModal.populateContent);
			$('#searchSection > tbody').find('.js-details-modal-trigger').on('click', DetailsModal.populateContent);
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
		}
	});
}
let formatFullDate = (date) => {
	if(!(typeof date === "string" && date.trim().length > 0)) return "";
	var dt = moment(date, "YYYY-MM-DD HH:mm:ss");
	if(dt.isValid()) return dt.format("DD-MM-YYYY HH:mm:ss");
	else return "";
};
function readClientUpdate() {
  $.ajax({
    url: './php/readClientUpdate.php',
    type: 'get',
    success: function(data, sstatus) {
		var json = JSON.parse(data);
    	$("#lastUpdateClients").text(formatFullDate(json[0].last_clients));
		$("#lastUpdateTaxForms").text(formatFullDate(json[0].last_taxforms));
		$("#lastUpdateAddresses").text(formatFullDate(json[0].last_addresses));
		$("#lastUpdateNumbers").text(formatFullDate(json[0].last_numbers));
    },
    error: function(xhr, desc, err) {
      console.log(xhr);
    }
  });
}
let capitalizeString = (string) => {
    if(string == null) return "";
	if(string.toLowerCase() == "police officer") return "Police Officer";
	else return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
};
let formatMobilePhone = (str) => {
  let cleaned = ('' + str).replace(/\D/g, '');
  let match = cleaned.match(/^(\d{4})(\d{3})(\d{3})$/);
  if (match) return match[1] + ' ' + match[2] + ' ' + match[3];
  else if(str == null) return '';
  else return str;
};
let formatLocalPhone = (str) => {
  let cleaned = ('' + str).replace(/\D/g, '');
  let match = cleaned.match(/^(\d{4})(\d{4})$/);
  if (match) return match[1] + ' ' + match[2];
  else return formatMobilePhone(str);
};
function addtr(idx, data) {
  var idxes = ['FirstName','LastName','DOB','TFN','OccDescription','MobileNo','EMail','DateAdded','Refund','TaxIncome','Estimate','Status','LodgeDate'];
  var tRow = $('<tr>');
  $.each( idxes, function( index, value ) {
		var content = data[value];
		if(value == "FirstName" || value == "LastName") content = '<a class="js-details-modal-trigger" data-toggle="modal" href="#" data-index="'+idx+'">'+content+'</a>';
		else if(value == "DOB") {
			var dt = moment(content, "YYYY-MM-DD");
			if(dt.isValid()) {
				var age = new Date().getFullYear() - dt.year();
				content = dt.format("DD-MM-YYYY") + "<br>(" + age + ")";
			} else content = "";
		}
		else if(value == "DateAdded" || value == "LodgeDate") {
			content = formatDate(content);
		}
		else if(value == "OccDescription") {
			content = capitalizeString(content).substr(0, 16);
		}
		else if(value == "MobileNo" && value.length > 0) {
			content = '<a href="tel:' + data[value] + '">' + formatMobilePhone(data[value]) + '</a>';
			if(data["PhoneNo"] != null) content += '<br><a href="tel:' + data["PhoneNo"] + '">' + formatLocalPhone(data["PhoneNo"]) + '</a>';
		}
		else if(value == "EMail" && value.length > 0) content = '<a href="mailto:' + data[value] + '">' + data[value] + '</a>';
		else if(value == "Status") {
			switch(parseInt(data[value])) {
				case 0: content = 'Not started';break;
				case 1: content = 'Appointment';break;
				case 2: content = 'Interviewed';break;
				case 3: content = 'Wait on Info';break;
				case 4: content = 'Wait on Sign';break;
				case 5: content = 'Ready to lodge';break;
				case 6: content = 'Lodged';break;
				case 10: content = 'ATO prefill';break;
				case 12: content = 'Lost client';break;
				default: content = '';break;
			}
		}
		var tCell = $('<td>').html(content);
		tRow.append(tCell);
  });
  $('#searchTable > tbody').append(tRow);
}
function addtrmob(idx, data) {
  var idxes = ['Name','TFN','MobileNo','EMail','Status'];
  var tRow = $('<tr>');
  $.each( idxes, function( index, value ) {
		var content = data[value];
		if(value == "Name") content = '<a class="js-details-modal-trigger" data-toggle="modal" href="#" data-index="'+idx+'">'+data.FirstName + " " + data.LastName+'</a>';
		else if(value == "MobileNo" && data[value] != null && value.length > 0) {
			content = '<a href="tel:' + data[value] + '">' + data[value] + '</a>';
			if(data["PhoneNo"] != null) content += '<br><a href="tel:' + data["PhoneNo"] + '">' + data["PhoneNo"] + '</a>';
		}
		else if(value == "MobileNo" && (data[value] == null || value.length == 0)) {
			content = '';
			if(data["PhoneNo"] != null) content += '<br><a href="tel:' + data["PhoneNo"] + '">' + data["PhoneNo"] + '</a>';
		}
		else if(value == "EMail" && value.length > 0) content = '<a href="mailto:' + data[value] + '">' + data[value] + '</a>';
		else if(value == "Status") {
			switch(parseInt(data[value])) {
				case 0: content = 'Not started';break;
				case 1: content = 'Appointment';break;
				case 2: content = 'Interviewed';break;
				case 3: content = 'Wait on Info';break;
				case 4: content = 'Wait on Sign';break;
				case 5: content = 'Ready to lodge';break;
				case 6: content = 'Lodged';break;
				case 10: content = 'ATO prefill';break;
				case 12: content = 'Lost client';break;
				default: content = '';break;
			}
		}
		var tCell = $('<td>').html(content);
		tRow.append(tCell);
  });
  $("#searchSection > tbody").append(tRow);
}
$(function() {
  $("#pagingSearch").change(function() {
  	currentPageIndex = 1;
	  readClient();
  });
  $("#searchButton").click(function() {
  	currentPageIndex = 1;
	  readClient();
  });
  orderHandler();
  countClient();
  readClient();
  readClientUpdate();
});