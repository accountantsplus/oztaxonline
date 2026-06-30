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
		var week = parseInt(value.Week);
		var currentWeek = (week > 26) ? (week - 26) : week + 26;
		var weekNumber = value.Year + "/" + value.Week;
		var tRow = $('<tr>');
		var weekNumberCell = $('<td>').html(weekNumber);
		tRow.append(weekNumberCell);
		var currentWeekCell = $('<td>').html(currentWeek);
		tRow.append(currentWeekCell);
		var currentCount = parseInt(value.Count);
		var totalCustomerCell = $('<td>').html(value.Count);
		tRow.append(totalCustomerCell);
		totalCient += currentCount;
		var cumTotalCustomerCell = $('<td>').html(totalCient);
		tRow.append(cumTotalCustomerCell);
		var revenue = precisionRound(currentCount * 204.54, 2);
		var RevenueCell = $('<td>').html(revenue);
		tRow.append(RevenueCell);
		var totalRevenue = precisionRound(totalCient * 204.54, 2);
		var cumRevenueCell = $('<td>').html(totalRevenue);
		tRow.append(cumRevenueCell);
		var weekEnding = moment(value.WeekEnding, 'YYYY-MM-DD').format('DD-MM-YYYY');
		var weekEndCell = $('<td>').html(weekEnding);
		tRow.append(weekEndCell);
		if(indexInPage(index)) $('#weeklyTable > tbody').append(tRow);
	});
}
function countClient() {
	$.ajax({
		url: './php/readCalendar.php',
		data: null,
		type: 'post',
		success: function(data, sstatus) {
			clients = JSON.parse(data);
			console.log(clients);
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