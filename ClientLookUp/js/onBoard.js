var clients = [];
var totalRow = 0;
var rowPerPage = 10;
var numberOfPages = 0;
var currentPageIndex = 1;
function precisionRound(number, precision) { 
  var factor = Math.pow(10, precision); 
  return Math.round(number * factor) / factor; 
}
function changePaging() {
	$(".searchItems").html("");
	if(numberOfPages <= 1) return;
	else for(var i = 1; i <= numberOfPages;i++) {
		var a = $('<a>').attr('id', i).html(i);
		var li = $('<li>').addClass('pagSearch').append(a);
		$(".searchItems").append(li);
	}
	$(".pagSearch > a").click(function() {
		currentPageIndex = parseInt($(this).attr("id"));
		printRow();
	});
}
function indexInPage(index) {
	var lastIndex = (numberOfPages - currentPageIndex) * rowPerPage;
	var lackNumber = numberOfPages * rowPerPage - totalRow;
	lastIndex = lastIndex - lackNumber - 1;
	if(index > lastIndex && index <= lastIndex + rowPerPage) return true;
	else return false;
}
function printRow() {
	var now = moment();
	var totalCient = 0;
	$('#weeklyTable > tbody').html("");
	$.each( clients, function( index, value ){
		var tRow = $('<tr>');
		var emailCell = $('<td>').html(value.email);
		tRow.append(emailCell);
		var nameCell = $('<td>').html(value.fname + ' ' + value.lname);
		tRow.append(nameCell);
		var phoneCell = $('<td>').html(value.phone);
		tRow.append(phoneCell);
		var stationCell = $('<td>').html(value.station);
		tRow.append(stationCell);
		var rankCell = $('<td>').html(value.rank);
		tRow.append(rankCell);
		var yearCell = $('<td>').html(value.year);
		tRow.append(yearCell);
		var spouseInclude = value.spouse_include == 1 ? 'Yes' : 'No';
		var spouseIncludeCell = $('<td>').html(spouseInclude);
		tRow.append(spouseIncludeCell);

		var spouseCell = $('<td>').html(value.spouse);
		tRow.append(spouseCell);

		var spouseDobCell = $('<td>').html(value.spouse_dob);
		tRow.append(spouseDobCell);

		var spouseIncomeCell = $('<td>').html(value.spouse_income);
		tRow.append(spouseIncomeCell);

		var noDependantsCell = $('<td>').html(value.no_dependants);
		tRow.append(noDependantsCell);

		var rentalProperty = value.rental_property == 1 ? 'Yes' : 'No';
		var rentalPropertyCell = $('<td>').html(rentalProperty);
		tRow.append(rentalPropertyCell);
		if(indexInPage(index)) $('#weeklyTable > tbody').append(tRow);
	});
}
function countClient() {
	$.ajax({
		url: './php/readOnBoard.php',
		data: null,
		type: 'post',
		success: function(data, sstatus) {
			clients = JSON.parse(data);
			console.log(clients)
			totalRow = clients.length;
			numberOfPages = Math.floor(totalRow / rowPerPage);
			if(totalRow % rowPerPage > 0) numberOfPages += 1;
			changePaging();
			printRow();
		},
		error: function(xhr, desc, err) {
		  console.log(xhr);
		}
	});
}
$(function() {
	countClient();
});