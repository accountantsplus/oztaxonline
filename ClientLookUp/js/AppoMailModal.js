/** @module AppoMailModal */

/**
* @namespace AppoMailModal
* @description triggers modal and populate details as modal content
*/
/*
Object.prototype.isNullOrEmpty = function(value){
	if(!value) return ' ';
	else return value;
    //return (!value);
}*/
//Object.prototype.isNullOrEmpty = function() { alert(this) }
function valueOrBlank(value) {
    return (!value || value == undefined || value == "" || value.length == 0);
}
function isNullOrEmpty(value) {
	if(!(typeof value === "string" && value.trim().length > 0)) return '&nbsp;';
	else return value;
}
AppoMailModal = {
	queryData: [],
	/**  
	* @member {object} trigger
	* @description link or button that triggers the modal to be displayed
	*/
	trigger: $('.js-sendmail-modal-trigger'),
	/**  
	* @member {object} target
	* @description modal element
	*/
	target: $('#js-sendmail-modal'),
	/**  
	* @member {object} targetError
	* @description modal element (to be displayed on error)
	*/
	targetError: $('#js-details-modal-error'),
	/**  
	* @member {object} labels
	* @description array of labels to be displayed 
	*/
	labels: {
		//StoreCode: "Store",
		MaterialCode: "Material Code",
		Description: "Description",
		UnitOfMeasure: "Unit Of Measure"
	},
	getTemplate: function() {
		var result = '<div class="row css-items-list">' 
			+ '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">' 
        + '  <table class="table table-bordered table-striped table-responsive">'
        + '    <thead>'
        + '      <tr>'
        + '        <th width="15%">Name</th>'
        + '        <td class="detail-name" width="35%"></th>'
        + '        <th width="15%">Ref</th>'
		+ '        <td class="detail-ref" width="35%"></th>'
        + '      </tr>'
        + '    </thead>'
        + '    <tbody>'
        + '      <tr>'
        + '        <th width="15%">Name</th>'
        + '        <td class="detail-name" width="35%"></th>'
        + '        <th width="15%">Ref</th>'
		+ '        <td class="detail-ref" width="35%"></th>'
        + '      </tr>'
        + '      <tr>'
        + '        <td>Test</td>'
        + '        <td>Test</td>'
        + '        <td>10</td>'
        + '      </tr>'
        + '      <tr>'
        + '        <td>Test</td>'
        + '        <td>Test</td>'
        + '        <td>10</td>'
        + '      </tr>'
        + '    </tbody>'
        + '  </table>'

		  + '</div>' 
		+ '</div>';

		 return $(result);
	},
	/**  
	* @function getListItemTemplate
	* @description get html template for an item to be displayed in the list
	*/
	getListItemTemplate: function(label, value) {

		var result = '<dt><h4>' + label + '</h4></dt>' 
		           + '<dd><p>' + value + '</p></dd>';

		return $(result);

	},
	emailClick: false,
	/**  
	* @callback populateContent
	* @description append html element to 
	*/
	populateContent1: function(e) {
		var target = $(e.target).parent();
		var index = target.data('index');
		var data = AppoMailModal.queryData[index];
		var id = data.id;
		var field = 'is_done';
		var field_value = true;
		var iduser = target.data('iduser');		
		var rank = $("#rank" + id).val();
		var station = $("#station" + id).val();
		var years = $("#years" + id).val();
		var estimate = $("#estimate" + id).val();
		var hecs = $("#hecs" + id).val();
	},
	populateContent: function(e) {
		e.preventDefault();
		var target = $(e.target).parent();
		var index = target.data('index');
		var data = AppoMailModal.queryData[index];
		var id = data.id;
		//var estimate = $("#estimate" + id).val();
		//var hecs = $("#hecs" + id).val();
		var field = 'is_done';
		var field_value = true;
		var iduser = target.data('iduser');		
		var rank = $("#rank" + id).val();
		var station = $("#station" + id).val();
		var years = $("#years" + id).val();
		var estimate = $("#estimate" + id).val();
		var hecs = $("#hecs" + id).val();
		
		var body = AppoMailModal.target.find('.modal-body');
		var content = "<b>Completion of your tax return</b><br><br>";
		if(!valueOrBlank(data.first_name)) content = content  + "Hi " + data.first_name + ",<br><br>";
		else content = content  + "Hi " + data.last_name + ",<br><br>";
		content = content  + "Good speaking with you today on your tax.<br><br>";
		content = content  + "We have calculated your estimated refund to be $" + estimate + ".<br><br>";
		content = content  + "Please find attached your tax return as discussed. If you are happy with the contents of the tax return please sign digitally and date or scan and return the one only signing and declaration page to this office at your earliest convenience" + ".<br><br>";
		content = content  + "<h3>(A) Options for signing</h3><br>";
		content = content  + "Your tax return (1 signing page only) for lodgement are as follows" + ":<br><br>";
		
		content = content  + '<div class="checkbox" id=opA' + data.id + '><label class="checkbox-inline checkbox-bootstrap checkbox-lg"><input type="checkbox" checked><span class="checkbox-placeholder"></span>Digital signature (Further ID needed)</label></div>';
		content = content  + '<div class="checkbox" id=opB' + data.id + '><label class="checkbox-inline checkbox-bootstrap checkbox-lg"><input type="checkbox" checked><span class="checkbox-placeholder"></span>Manual signature/upload sign form or</label></div>';
		content = content  + '<div class="checkbox" id=opC' + data.id + '><label class="checkbox-inline checkbox-bootstrap checkbox-lg"><input type="checkbox" checked><span class="checkbox-placeholder"></span>Advise of any corrections or amendments</label></div><br>';
		
		content = content  + 'Use the following link to advise us <a href="https://www.policetax.com.au/SignElectronic.php" target="blank">https://www.policetax.com.au/SignElectronic.php</a>' + '<br><br>';
		content = content  + 'Or alternatively you can make a direct payment into our ANZ bank account detail below:<br>';
		content = content  + '<b>Accountant Plus</b><br>';
		content = content  + 'BSB: 013-344<br>';
		content = content  + 'Acc: 499-083-481<br><br>';
		content = content  + "<h3>(B)Payment for services may be required</h3><br>";
		content = content  + "If you have not already done so, please make a payment for your tax services<br>";
		content = content  + "By Clicking on the link to avoid delays in lodgement of your tax refund<br><br>";
		content = content  + 'Use the following link to advise us <a href="https://www.policetax.com.au/nab_payment.html?package=random&amount=225.00" target="blank">https://www.policetax.com.au/nab_payment.html?package=random&amount=225.00 </a>' + '<br><br>';
		content = content  + "<h3>(C)Templates for next year</h3><br>";
		content = content  + "1. Some checklists/templates for future use<br>";
		content = content  + "2. Pls consider the phone log scorecard template attached for next year<br>";
		if(!valueOrBlank(data.station_locale)) content = content  + "3. Station flyer for your muster room " + data.station_locale + " Police Station<br>";
		else content = content  + "3. Station flyer for your tea room<br>";
		content = content  + "4. Pass the word on to your other work/squad mates we will look after them<br><br>";
		content = content  + "<h3>(D) Some further advice:</h3><br>";
		
		content = content  + '<div class="checkbox WillBeRemoved" id=opD' + data.id + '><label class="checkbox-inline checkbox-bootstrap checkbox-lg"><input type="checkbox"><span class="checkbox-placeholder" ></span>Your HECS debt is now $' + hecs + ' approx.</label></div>';
		content = content  + '<div class="checkbox WillBeRemoved" id=opE' + data.id + '><label class="checkbox-inline checkbox-bootstrap checkbox-lg"><input type="checkbox"><span class="checkbox-placeholder" ></span>You have incurred the Medicare levy surcharge(MLS) because you have  no hospital cover.</label></div>';
		content = content  + '<div class="checkbox WillBeRemoved" id=opF' + data.id + '><label class="checkbox-inline checkbox-bootstrap checkbox-lg"><input type="checkbox"><span class="checkbox-placeholder" ></span>Watch out for the Medicare levy surcharge if no hospital cover is in place.</label></div>';
		content = content  + '<div class="checkbox WillBeRemoved" id=opG' + data.id + '><label class="checkbox-inline checkbox-bootstrap checkbox-lg"><input type="checkbox"><span class="checkbox-placeholder" ></span>You have a negative clawback of Private health rebate and need to discuss your income levels with your health insurance provider.</label></div>';
		content = content  + '<div class="checkbox" id=opH' + data.id + '><label class="checkbox-inline checkbox-bootstrap checkbox-lg"><input type="checkbox" checked><span class="checkbox-placeholder"></span>Keep your tax records and receipts for 5 years please.</label></div><br>'
		
		content = content  + "<b>Any changes to your tax return</b> required please let me know<br><br>";
		content = content  + "if you don't get your refund within 14 days, please call 0447 530 629<br><br>";
		content = content  + "Garry Angus<br><br>";
		content = content  + "Police Tax<br><br>";
		content = content  + "Attachments below:";
		$("#mailContent").Editor('setText', content);
		$("#sendAppoEmail").attr('data-index', index);
		$("#uploadFile").val('');
		$("#uploadFile2").val('');
		$("#err").html('');
		
		//$('input[type=checkbox]:checked')		
		$('input[type=checkbox]').click(function() {
			if(!this.checked) $(this).parent().parent().addClass("WillBeRemoved");
			else $(this).parent().parent().removeClass("WillBeRemoved");
		});
		
		$("#attachFile").click(function() {
		});
		$("#uploadFile").on('change',(function(e) {
			// append file input to form data
			var fileInput = document.getElementById('uploadFile');
			var file = fileInput.files[0];
			var formData = new FormData();
			formData.append('file', file);

			$.ajax({
				url: "appo/appoupload.php",
				type: "POST",
				data: formData,
				contentType: false,
				cache: false,
				processData:false,
				success: function(data) {
					$("#err").html(data).fadeIn();
				},
				error: function(e) {
					$("#err").html(e).fadeIn();
				}
			});
		}));
		$("#uploadFile2").on('change',(function(e) {
			// append file input to form data
			var fileInput = document.getElementById('uploadFile2');
			var file = fileInput.files[0];
			var formData = new FormData();
			formData.append('file', file);

			$.ajax({
				url: "appo/appoupload.php",
				type: "POST",
				data: formData,
				contentType: false,
				cache: false,
				processData:false,
				success: function(data) {
					$("#err").html(data).fadeIn();
				},
				error: function(e) {
					$("#err").html(e).fadeIn();
				}
			});
		}));
		
		if(!AppoMailModal.emailClick) {
			AppoMailModal.emailClick = true;
			$("#sendAppoEmail").click(function() {
				var index = $(this).data('index');
				var clientData = AppoMailModal.queryData[index];
				var id = clientData.id;
				$('.WillBeRemoved').remove();
				var sendData = {};
				sendData.data = AppoMailModal.queryData[index];
				$(".Editor-editor").find('input[type=checkbox]').prop('checked', true);
				$(".Editor-editor").find('input[type=checkbox]').attr('checked','checked');
				var cnt = $("#mailContent").Editor('getText') + "";
				sendData.content = cnt;
				$("#sendAppoEmail").removeClass("btn-success").addClass("btn-warning");
				$("#sendAppoEmail").html('<span class="glyphicon glyphicon-refresh spinning"></span> Loading...');
				if($("#uploadFile").val() != null && $("#uploadFile").val().length > 0) {
					var filename = $("#uploadFile").val().split('\\').pop();
					sendData.uploadFile = filename;
				}
				if($("#uploadFile2").val() != null && $("#uploadFile2").val().length > 0) {
					var filename = $("#uploadFile2").val().split('\\').pop();
					sendData.uploadFile2 = filename;
				}
				$.ajax({
					url: './appo/sendEmailAppo.php',
					data: sendData,
					type: 'post',
					success: function(receiveData, sstatus) {
						
						$.ajax({
							url: './appo/doneAppo.php',
							data: { 'field': field, 'field_value': field_value, 'id': id, 'iduser': iduser, 'rank': rank, 'station': station, 'years': years, 'estimate' : estimate, 'hecs' : hecs },
							type: 'post',
							success: function(data2, sstatus2) {
								//if(currentPageIndex == numberOfPages && numberOfPages > 1) currentPageIndex = currentPageIndex - 1;
								readAppo();
							},
							error: function(xhr, desc, err) {
							  console.log(xhr);
							}
						});

						$("#sendAppoEmail").removeClass("btn-warning").addClass("btn-success");
						$("#sendAppoEmail").html('Send Email');
						if(receiveData == "Success") $('#noticeBody').html('The email is sent successfully to the client.');
						else $('#noticeBody').html('The email is failed to sent to the client. ' + receiveData);
						$('#js-notice-modal').modal('show');
						//if(send success) AppoMailModal.target.modal('hide');
						AppoMailModal.target.modal('hide');
						if(receiveData == "Success") setTimeout(() => {  location.reload(); }, 2000);
					},
					error: function(xhr, desc, err) {
						$("#sendAppoEmail").removeClass("btn-warning").addClass("btn-success");
						$("#sendAppoEmail").html('Send Email');
						$('#noticeBody').html('The email is failed to sent to the client. ' + err);
						$('#js-notice-modal').modal('show');
						//if(send success) AppoMailModal.target.modal('hide');
						AppoMailModal.target.modal('hide');
					}
				});
			});
		}

		
		/*
		
		body.find('#detail-start').html(isNullOrEmpty(formatDate(data.start_datetime)));
		body.find('#detail-end').html(isNullOrEmpty(formatDate(data.end_datetime)));
		var duration = data.minutes + " mins";
		var hours = parseInt(data.hours) || 0;
		if(hours > 0) duration = hours + " hours " + duration;
		body.find('#detail-duration').html(isNullOrEmpty(duration));
		body.find('#detail-client').html(isNullOrEmpty(data.first_name + ' ' + data.last_name));
		body.find('#detail-email').html(isNullOrEmpty('<a href="mailto:' + data.email + '">' + data.email + '</a>'));
		body.find('#detail-phone').html(isNullOrEmpty('<a href="tel:' + data.phone_number + '">' + data.phone_number + '</a>'));
		var address = '';
		var idxes = ['address','suburb','city'];
		$.each( idxes, function( index, value ) {
			address = address + (data[value] != null ? data[value] : '') + ' ';
		});
		body.find('#detail-address').html(isNullOrEmpty(address));
		body.find('#detail-service').html(isNullOrEmpty(data.service_name));
		//body.find('#detail-text').html(isNullOrEmpty(data.Text));
		//body.find('#detail-text').html(isNullOrEmpty(data.Text));
		//body.find('#detail-text').html(isNullOrEmpty(data.Text));
		//body.find('#detail-info-notice').html(isNullOrEmpty(data.WaitOnInfoSent == 1 ? 'Yes' : ''));*/
		AppoMailModal.target.modal('show');


	},
	/**  
	* @callback removeContent
	* @description remove the content of the modal
	*/
	removeContent: function() {
		AppoMailModal.target.find('.modal-body').empty();
	},
}

AppoMailModal.trigger.on('click', AppoMailModal.populateContent);
//AppoMailModal.target.on('hidden.bs.modal', AppoMailModal.removeContent);