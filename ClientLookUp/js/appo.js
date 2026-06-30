var clients = [];
var currentPageIndex = 1;
var numberOfClients = 0;
var numberOfPages = 0;

function eventHandler() {
  $(".pagFirst > a").click(function() {
  	currentPageIndex = 1;
	if($('.js-new').hasClass("active")) readNewAppo();
	else readAppo();
  });
  $(".pagPrev > a").click(function() {
  	if( currentPageIndex == 1 ) currentPageIndex = 1;
  	else currentPageIndex -= 1;
	if($('.js-new').hasClass("active")) readNewAppo();
	else readAppo();
  });
  $(".pagSearch > a").click(function() {
  	currentPageIndex = parseInt($(this).attr("id"));
	if($('.js-new').hasClass("active")) readNewAppo();
	else readAppo();
  });
  $(".pagNext > a").click(function() {
  	currentPageIndex += 1;
	if($('.js-new').hasClass("active")) readNewAppo();
	else readAppo();
  });
  $(".pagLast > a").click(function() {
  	currentPageIndex = numberOfPages;
	if($('.js-new').hasClass("active")) readNewAppo();
	else readAppo();
  });
}
function precisionRound(number, precision) { 
  var factor = Math.pow(10, precision); 
  return Math.round(number * factor) / factor; 
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
function compareClients( a, b ) {
    var aStartDt = moment(a.start_datetime, "YYYY-MM-DD HH:mm:ss");
    var bStartDt = moment(b.start_datetime, "YYYY-MM-DD HH:mm:ss");
    return aStartDt >= bStartDt;
}
function readAppo() {
	var limit = 10;
	var offset = (currentPageIndex - 1) * limit;
	$("#monthlyTable > tbody").html("");
	var period = 'today';
	if($('.js-today').hasClass("active")) period = 'today';
	else if($('.js-tomorrow').hasClass("active")) period = 'tomorrow';
	else if($('.js-week').hasClass("active")) period = 'week';
	else if($('.js-month').hasClass("active")) period = 'month';
	var data = {"limit": limit, "offset": offset, 'period' : period };
	$.ajax({
		url: './appo/readAppo.php',
		data: data,
		type: 'post',
		success: function(data, sstatus) {
			clients = JSON.parse(data);
			clients.sort(compareClients);
			if(clients.length > 0) numberOfClients = parseInt(clients[0].full_count) || 0;
			else numberOfClients = 0;
			numberOfPages = Math.floor(numberOfClients / limit);
			if(numberOfClients % limit > 0) numberOfPages += 1;
			printRow(period);
			AppoModal.queryData = clients;
			AppoMailModal.queryData = clients;
			$('#monthlyTable > tbody').find('.js-details-modal-trigger').on('click', AppoModal.populateContent);
			$('#monthlyTable > tbody').find('.js-sendmail-modal-trigger').on('click', AppoMailModal.populateContent);
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
function printRow(period) {
	changePaging();
	$('#monthlyTable > thead').html("");
	var hRow = $('<tr>');
	var idxes = ['Slot', 'Start Time', 'Duration', 'Method', 'Mobile', 'Client Name', 'Service', 'Rental', 'Rank', 'Station', 'Years', 'Estimate', 'HECS', 'Number', 'Done', 'Delete' ];
	$.each( idxes, function( index, value ) {
		var cell = $('<th>').html(value);
		hRow.append(cell);
	});
	$('#monthlyTable > thead').append(hRow);

	$('#monthlyTable > tbody').html("");
	$.each(clients, function( index, value ){
		var tRow = $('<tr>');
		var slotCell = $('<td>').html('<span>' + ((index + 1) + (currentPageIndex - 1) * 10)  + '</span>');
		tRow.append(slotCell);
		var startDt = moment(value.start_datetime, "YYYY-MM-DD HH:mm:ss");
		var startVal = startDt.format("DD-MM-YYYY hh:mm:ss A");
		var startCell = $('<td>').html('<span>' + startVal + '</span>');
		tRow.append(startCell);
		var duration = value.minutes + " mins";
		var hours = parseInt(value.hours) || 0;
		if(hours > 0) duration = hours + " hours " + duration;
		var durationCell = $('<td>').html('<span>' + duration + '</span>');
		tRow.append(durationCell);
		var methodCell = $('<td>').html('<span><a class="js-details-modal-trigger" data-toggle="modal" href="#" data-index="'+index+'">'+value.delivery+'</a></span>');
		tRow.append(methodCell);
		var mobileCell = $('<td>').html('<span><a class="js-details-modal-trigger" data-toggle="modal" href="#" data-index="'+index+'">'+value.phone_number+'</a></span>');
		tRow.append(mobileCell);
		var name = value.first_name + ' ' + value.last_name;
		var nameCell = $('<td>').html('<span><a class="js-details-modal-trigger" data-toggle="modal" href="#" data-index="'+index+'">'+name+'</a></span>');
		tRow.append(nameCell);
		var serviceCell = $('<td>').html('<span>' + value.service_name + '</span>');
		tRow.append(serviceCell);
		var rental = value.rental_property;
		if(value.service_name != null && value.service_name.indexOf('Landlord') != -1) rental = 'Yes';
		var rentalCell = $('<td>').html('<span>' + rental + '</span>');
		tRow.append(rentalCell);
		
		var rankOption = '<select class="form-control" id="rank'+value.id+'">' +
			'<option value=""></option>' +
			'<option value="Police Recruit">Police Recruit</option>' +
			'<option value="SnrConstable">Snr Constable</option>' +
			'<option value="Constable">Constable</option>' +
			'<option value="Leading Senior Constable">Leading Snr Constable</option>' +
			'<option value="Sergeant">Sergeant</option>' +
			'<option value="SnrSergeant">Snr Sergeant</option>' +
			'<option value="Inspector">Inspector</option>' +
			'<option value="Superintendent">Superintendent</option>' +
			'<option value="HigherRank">Higher Rank</option>' +
			'<option value="Rank">Rank</option>' +

			'<option value="Recruit PSO"> Recruit PSO</option>' +
			'<option value="PSO 1st Class">PSO 1st Class</option>' +
			'<option value="PSO Senior">PSO Senior</option>' +
			'<option value="PSO Supervisor">PSO Supervisor</option>' +
			'<option value="PSO Snr Supervisor">PSO Snr Supervisor</option>' +

			'<option value="Assist Officer">Assist Officer</option>' +
			'<option value="Officer">Officer</option>' +
			'<option value="Leading Officer">Leading Officer</option>' +
			'<option value="Senior Officer">Senior Officer</option>' +
			'<option value="Supervisor">Supervisor</option>' +
			'<option value="Inspector">Inspector</option>' +
			'<option value="Superintendent">Superintendent</option>' +
			'<option value="Chief Superintendent">Chief Superintendent</option>' +
			'<option value="HigherRank">Higher Rank</option>' +
			'<option value="Commander">Commander</option>' +

			'<option value="Recruit Trainee">Recruit Trainee</option>' +
			'<option value="SnrConstable">Snr Constable</option>' +
			'<option value="Constable">Constable</option>' +
			'<option value="Leading Senior Constable">Leading Snr Constable</option>' +
			'<option value="Sergeant">Sergeant</option>' +
			'<option value="SnrSergeant">Snr Sergeant</option>' +
			'<option value="Commander">Commander</option>' +
			'<option value="HigherRank">Higher Rank</option>' +
												
			'<option value="Other">Other</option>' +
			'</select>';
		var rankCell = $('<td>').html('<span>' + rankOption + '</span>');
		tRow.append(rankCell);
		
		var stationCell = $('<td>').html('<div style="width:180px"><textarea class="form-control" id="station'+value.id+'" rows="2" style="resize: vertical">' + value.station_locale + '</textarea></div>');
		tRow.append(stationCell);
		var yearsCell = $('<td>').html('<span><div style="width:45px"><input type="text" class="form-control" id="years'+value.id+'" value=' + value.years_in_job + '></div></span>');
		tRow.append(yearsCell);
		
		var estimateCell = $('<td>').html('<span><div style="width:90px"><input type="text" class="form-control" id="estimate'+value.id+'" value=' + value.estimate + '></div></span>');
		tRow.append(estimateCell);
		
		var hecsCell = $('<td>').html('<span><div style="width:90px"><input type="text" class="form-control" id="hecs'+value.id+'" value=' + value.hecs + '></div></span>');
		tRow.append(hecsCell);
		
		var attCell = $('<td>').html('<span>' + value.attendants_number + '</span>');
		tRow.append(attCell);
		var checked = (value.is_done == '1' || value.is_done == 1) ? 'checked' : '';
		var doneCell = $('<td>').html('<div class="checkbox"><a data-toggle="modal" href="#" data-index="'+index+'" data-iduser="'+value.id_users_customer+'" data-id=' + value.id + '"><label class="checkbox-inline checkbox-bootstrap checkbox-lg js-sendmail-modal-trigger" data-index="'+index+'" data-iduser="'+value.id_users_customer+'"><input type="checkbox" ' + checked + '><span class="checkbox-placeholder" data-index="'+index+'" data-iduser="'+value.id_users_customer+'" data-field="is_done" id=' + value.id + '></span>Email</label></a></div>');
		//if(period == 'week' || period == 'month') doneCell = $('<td>').html('<div class="checkbox"><label class="checkbox-inline checkbox-bootstrap checkbox-lg" data-index="'+index+'" data-iduser="'+value.id_users_customer+'"><input type="checkbox" ' + checked + ' disabled><span class="checkbox-placeholder" data-iduser="'+value.id_users_customer+'" data-field="is_done" id=' + value.id + '></span>Done</label></div>');
		if (value.is_done == '1' || value.is_done == 1) {
		    doneCell = $('<td>').html('<div class="checkbox"><label class="checkbox-inline checkbox-bootstrap checkbox-lg" data-index="'+index+'" data-iduser="'+value.id_users_customer+'"><input type="checkbox" ' + checked + ' disabled><span class="checkbox-placeholder" data-iduser="'+value.id_users_customer+'" data-field="is_done" id=' + value.id + '></span>Done</label></div>');
		}
		tRow.append(doneCell);
		
		var deleteChecked = !$(".js-allow-delete-trigger .checkbox-placeholder").first().prev().prop('checked');
		var checkChecked = "";
		var classChecked = "btn-dark";
		if (deleteChecked) {
		    checkChecked = 'disabled';
    		classChecked = "btn-dark";
		} else {
		    checkChecked = '';
    		classChecked = "btn-danger";
		}
		var deleteCell = $('<td>').html('<button type="button" class="btn ' + classChecked + ' deleteBtn" ' + checkChecked + ' data-index="'+index+'" data-iduser="'+value.id_users_customer+'" data-id=' + value.id + '">Delete</button>');
		tRow.append(deleteCell);

		$('#monthlyTable > tbody').append(tRow);
		$("#rank" + value.id).val(value.rank).change();
	});
	$(".deleteBtn").on('click', function(e) {
		e.preventDefault();
		var target = $(e.target);
		var id = target.data('id');
		console.log(id);
		//var id = data.id;
		$('.deleteConfirmBtn').data('id', id);
	});
	$('#js-confirm-modal').on('show.bs.modal', function(e) {
	    var id = $('.deleteConfirmBtn').data('id');
	    console.log('id:' + id);
	    /*
	    var data = $(e.relatedTarget).data();
	    $('.title', this).text(data.recordTitle);
	    $('.btn-ok', this).data('recordId', data.recordId);
	    */
	});
	$(".deleteBtn").click(function() {
		var id = $(this).data('id');
		var index = $(this).data('index');
		var iduser = $(this).data('iduser');
	    console.log(id + ":" + iduser + ":" + index);
		$('#js-confirm-modal').modal('show');
	});
	//do this in send appo email button
	/*
	$(".checkbox-placeholder").click(function() {
		var field = $(this).data('field');
		var field_value = !$(this).prev().prop('checked');
		
		var id = $(this).attr("id");
		var iduser = $(this).data('iduser');
		
		var rank = $("#rank" + id).val();
		var station = $("#station" + id).val();
		var years = $("#years" + id).val();
		var estimate = $("#estimate" + id).val();
		var hecs = $("#hecs" + id).val();
		
		$.ajax({
			url: './appo/doneAppo.php',
			data: { 'field': field, 'field_value': field_value, 'id': id, 'iduser': iduser, 'rank': rank, 'station': station, 'years': years, 'estimate' : estimate, 'hecs' : hecs },
			type: 'post',
			success: function(data2, sstatus) {
				//if(currentPageIndex == numberOfPages && numberOfPages > 1) currentPageIndex = currentPageIndex - 1;
				readAppo();
			},
			error: function(xhr, desc, err) {
			  console.log(xhr);
			}
		});
	});*/
}
function printRowNewAppo() {
	changePaging();
	$('#monthlyTable > thead').html("");
	var hRow = $('<tr>');
	var idxes = ['Book Time', 'Start Time', 'Duration', 'Client Name', 'Service', 'Rank', 'Station', 'Years', 'Promo', 'WRE', 'PF', 'BSB' ];
	$.each( idxes, function( index, value ) {
		var cell = $('<th>').html(value);
		hRow.append(cell);
	});
	$('#monthlyTable > thead').append(hRow);

	$('#monthlyTable > tbody').html("");
	$.each( clients, function( index, value ){
		var tRow = $('<tr>');
		var bookDt = moment(value.book_datetime, "YYYY-MM-DD HH:mm:ss");
		var bookVal = bookDt.format("DD-MM-YYYY hh:mm:ss A");
		var bookCell = $('<td>').html('<span>' + bookVal + '</span>');
		tRow.append(bookCell);
		
		var startDt = moment(value.start_datetime, "YYYY-MM-DD HH:mm:ss");
		var startVal = startDt.format("DD-MM-YYYY hh:mm:ss A");
		var startCell = $('<td>').html('<span>' + startVal + '</span>');
		tRow.append(startCell);
		
		var duration = value.minutes + " mins";
		var hours = parseInt(value.hours) || 0;
		if(hours > 0) duration = hours + " hours " + duration;
		var durationCell = $('<td>').html('<span>' + duration + '</span>');
		tRow.append(durationCell);
		
		var name = value.first_name + ' ' + value.last_name;
		var nameCell = $('<td>').html('<span><a class="js-details-modal-trigger" data-toggle="modal" href="#" data-index="'+index+'">'+name+'</a></span>');
		tRow.append(nameCell);
		var serviceCell = $('<td>').html('<span>' + value.service_name + '</span>');
		tRow.append(serviceCell);
		
		var rankCell = $('<td>').html('<span>' + value.rank + '</span>');
		tRow.append(rankCell);
		var stationCell = $('<td>').html('<span>' + value.station_locale + '</span>');
		tRow.append(stationCell);
		var yearsCell = $('<td>').html('<span>' + value.years_in_job + '</span>');
		tRow.append(yearsCell);
		
		var promo = (value.promo == '1') ? 'checked' : '';
		var promoCell = $('<td>').html('<div class="checkbox"><label class="checkbox-inline checkbox-bootstrap checkbox-lg js-new-appo-trigger"><input type="checkbox" ' + promo + '><span class="checkbox-placeholder" data-field="promo" id=' + value.id + '></span>Promo</label></div>');
		tRow.append(promoCell);
		var wre = (value.wre == '1') ? 'checked' : '';
		var wreCell = $('<td>').html('<div class="checkbox"><label class="checkbox-inline checkbox-bootstrap checkbox-lg js-new-appo-trigger"><input type="checkbox" ' + wre + '><span class="checkbox-placeholder" data-field="wre" id=' + value.id + '></span>WRE</label></div>');
		tRow.append(wreCell);
		var pf = (value.pf == '1') ? 'checked' : '';
		var pfCell = $('<td>').html('<div class="checkbox"><label class="checkbox-inline checkbox-bootstrap checkbox-lg js-new-appo-trigger"><input type="checkbox" ' + pf + '><span class="checkbox-placeholder"  data-field="pf" id=' + value.id + '></span>PF</label></div>');		
		tRow.append(pfCell);
		var bsb = (value.bsb == '1') ? 'checked' : '';
		var bsbCell = $('<td>').html('<div class="checkbox"><label class="checkbox-inline checkbox-bootstrap checkbox-lg js-new-appo-trigger"><input type="checkbox" ' + bsb + '><span class="checkbox-placeholder"  data-field="bsb" id=' + value.id + '></span>BSB</label></div>');
		tRow.append(bsbCell);
		
		$('#monthlyTable > tbody').append(tRow);
	});
	$(".js-new-appo-trigger .checkbox-placeholder").click(function() {
		var field = $(this).data('field');
		var field_value = !$(this).prev().prop('checked');
		var id = $(this).attr("id");
		$.ajax({
			url: './appo/doneAppo.php',
			data: { 'field': field, 'field_value': field_value, 'id': id },
			type: 'post',
			success: function(data2, sstatus) {
				//if(currentPageIndex == numberOfPages && numberOfPages > 1) currentPageIndex = currentPageIndex - 1;
				readNewAppo();
			},
			error: function(xhr, desc, err) {
			  console.log(xhr);
			}
		});
	});
}
function countAppo() {
	var idxes = ['today', 'tomorrow', 'week', 'month', 'new'];
	$.each( idxes, function( index, period ) {
		var data = {'period' : period };
		$.ajax({
			url: './appo/countAppo.php',
			data: data,
			type: 'post',
			success: function(data, sstatus) {
				switch(period) {
					case 'today':$('.js-today').html('Today ' + data);break;
					case 'tomorrow':$('.js-tomorrow').html('Tomorrow ' + data);break;
					case 'week':$('.js-week').html('This week ' + data);break;
					case 'month':$('.js-month').html('This month ' + data);break;
					case 'new':$('.js-new').html('New appo ' + data);break;
				}
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
			}
		});
	});
}
function readNewAppo() {
	var limit = 10;
	var offset = (currentPageIndex - 1) * limit;
	$("#monthlyTable > tbody").html("");
	var period = 'today';
	var data = {"limit": limit, "offset": offset, 'period' : 'new' };
	$.ajax({
		url: './appo/readAppo.php',
		data: data,
		type: 'post',
		success: function(data, sstatus) {
			clients = JSON.parse(data);
			clients.sort(compareClients);
			if(clients.length > 0) numberOfClients = parseInt(clients[0].full_count) || 0;
			else numberOfClients = 0;
			numberOfPages = Math.floor(numberOfClients / limit);
			if(numberOfClients % limit > 0) numberOfPages += 1;
			printRowNewAppo();
			AppoModal.queryData = clients;
			$('#monthlyTable > tbody').find('.js-details-modal-trigger').on('click', AppoModal.populateContent);
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
		}
	});
}
$(function() {
	$('.js-today').click(function() {
		$('.js-today').addClass("active");
		$('.js-tomorrow').removeClass("active");
		$('.js-week').removeClass("active");
		$('.js-month').removeClass("active");
		$('.js-new').removeClass("active");
		currentPageIndex = 1;
		readAppo();
	});
	$('.js-tomorrow').click(function() {
		$('.js-today').removeClass("active");
		$('.js-tomorrow').addClass("active");
		$('.js-week').removeClass("active");
		$('.js-month').removeClass("active");
		$('.js-new').removeClass("active");
		currentPageIndex = 1;
		readAppo();
	});
	$('.js-week').click(function() {
		$('.js-today').removeClass("active");
		$('.js-tomorrow').removeClass("active");
		$('.js-week').addClass("active");
		$('.js-month').removeClass("active");
		$('.js-new').removeClass("active");
		currentPageIndex = 1;
		readAppo();
	});
	$('.js-month').click(function() {
		$('.js-today').removeClass("active");
		$('.js-tomorrow').removeClass("active");
		$('.js-week').removeClass("active");
		$('.js-month').addClass("active");
		$('.js-new').removeClass("active");
		currentPageIndex = 1;
		readAppo();
	});
	$('.js-new').click(function() {
		$('.js-today').removeClass("active");
		$('.js-tomorrow').removeClass("active");
		$('.js-week').removeClass("active");
		$('.js-month').removeClass("active");
		$('.js-new').addClass("active");
		currentPageIndex = 1;
		readNewAppo();
	});
	$("#mailContent").Editor();
	$(".js-allow-delete-trigger .checkbox-placeholder").click(function() {
		var field_value = !$(this).prev().prop('checked');
		if (field_value) {
    		$('.deleteBtn').removeClass("btn-dark");
    		$('.deleteBtn').addClass("btn-danger");
    		$('.deleteBtn').prop('disabled', false);
		} else {
    		$('.deleteBtn').removeClass("btn-danger");
    		$('.deleteBtn').addClass("btn-dark");
    		$('.deleteBtn').prop('disabled', true);
		}
	});
	$('.deleteConfirmBtn').click(function() {
	    var id = $(this).data('id');
		var id = $(this).attr("id");
		$.ajax({
			url: './appo/doneAppo.php',
			data: { 'delete': '1', 'id': id },
			type: 'post',
			success: function(data2, sstatus) {
				//if(currentPageIndex == numberOfPages && numberOfPages > 1) currentPageIndex = currentPageIndex - 1;
				readAppo();
			},
			error: function(xhr, desc, err) {
			  console.log(xhr);
			}
		});
	});
	countAppo();
	readAppo();
	var interval = setInterval(function(){
		if($('.js-new').hasClass("active")) readNewAppo();
	}, 1000 * 60 * 15);
});