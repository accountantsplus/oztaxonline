function init() {
	$('#step1link').click(function (e) {
		if(!valid) e.preventDefault();
	});
	$('#step2link').click(function (e) {
		if(!valid) e.preventDefault();
	});
	$('#step3link').click(function (e) {
		if(!valid) e.preventDefault();
	});
	$('#step4link').click(function (e) {
		if(!valid) e.preventDefault();
	});
}
$(function() {
	init();
});