/** @module AppoModal */

/**
* @namespace AppoModal
* @description triggers modal and populate details as modal content
*/
/*
Object.prototype.isNullOrEmpty = function(value){
	if(!value) return ' ';
	else return value;
    //return (!value);
}*/
//Object.prototype.isNullOrEmpty = function() { alert(this) }
/*
Object.prototype.valueOrBlank = function (value) {
	if(this.isNullOrEmpty()) {
		return ' ';
	} else return value;
    //return (!value || value == undefined || value == "" || value.length == 0);
}*/

function isNullOrEmpty(value) {
	if(!(typeof value === "string" && value.trim().length > 0)) return '&nbsp;';
	else return value;
}
let formatDate = (date) => {
	if(!(typeof date === "string" && date.trim().length > 0)) return "";
	var dt = moment(date, "YYYY-MM-DD HH:mm:ss");
	if(dt.isValid()) return dt.format("DD-MM-YYYY hh:mm:ss A");
	else return "";
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
AppoModal = {
	queryData: [],
	/**  
	* @member {object} trigger
	* @description link or button that triggers the modal to be displayed
	*/
	trigger: $('.js-details-modal-trigger'),
	/**  
	* @member {object} target
	* @description modal element
	*/
	target: $('#js-details-modal'),
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
	/**  
	* @callback populateContent
	* @description append html element to 
	*/
	populateContent: function(e) {
		e.preventDefault();
		var target = $(e.target);
		var index = target.data('index');
		var data = AppoModal.queryData[index];
		var body = AppoModal.target.find('.modal-body');
		
		body.find('#detail-start').html(isNullOrEmpty(formatDate(data.start_datetime)));
		body.find('#detail-end').html(isNullOrEmpty(formatDate(data.end_datetime)));
		var duration = data.minutes + " mins";
		var hours = parseInt(data.hours) || 0;
		if(hours > 0) duration = hours + " hours " + duration;
		body.find('#detail-duration').html(isNullOrEmpty(duration));
		body.find('#detail-method').html(data.delivery);
		body.find('#detail-mobile').html(data.phone_number);
		body.find('#detail-client').html(isNullOrEmpty(data.first_name + ' ' + data.last_name));
		body.find('#detail-email').html(isNullOrEmpty('<a href="mailto:' + data.email + '">' + data.email + '</a>'));
		body.find('#detail-phone').html(isNullOrEmpty('<a href="tel:' + data.phone_number + '">' + formatLocalPhone(data.phone_number) + '</a>'));
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
		//body.find('#detail-info-notice').html(isNullOrEmpty(data.WaitOnInfoSent == 1 ? 'Yes' : ''));
		AppoModal.target.modal('show');


	},
	/**  
	* @callback removeContent
	* @description remove the content of the modal
	*/
	removeContent: function() {
		AppoModal.target.find('.modal-body').empty();
	},
}

AppoModal.trigger.on('click', AppoModal.populateContent);
//AppoModal.target.on('hidden.bs.modal', AppoModal.removeContent);