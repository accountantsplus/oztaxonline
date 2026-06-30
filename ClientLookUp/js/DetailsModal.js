/** @module DetailsModal */

/**
* @namespace DetailsModal
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
	var dt = moment(date, "YYYY-MM-DD");
	if(dt.isValid()) return dt.format("DD-MM-YYYY");
	else return "";
};
DetailsModal = {
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
		var data = DetailsModal.queryData[index];
		var body = DetailsModal.target.find('.modal-body');
		var status = '';
		switch(parseInt(data.Status)) {
			case 0: status = 'Not started';break;
			case 1: status = 'Appointment';break;
			case 2: status = 'Interviewed';break;
			case 3: status = 'Wait on Info';break;
			case 4: status = 'Wait on Sign';break;
			case 5: status = 'Ready to lodge';break;
			case 6: status = 'Lodged';break;
			case 10: status = 'ATO prefill';break;
			case 12: status = 'Lost client';break;
			default: status = '';break;
		}
		body.find('#detail-name').html(isNullOrEmpty(data.FirstName + ' ' + data.LastName));
		body.find('#detail-dob').html(isNullOrEmpty(formatDate(data.DOB)));
		body.find('#detail-occupation').html(isNullOrEmpty(data.OccDescription));
		body.find('#detail-date-added').html(isNullOrEmpty(formatDate(data.DateAdded)));
		body.find('#detail-mobile').html(isNullOrEmpty(data.MobileNo));
		body.find('#detail-phone').html(isNullOrEmpty(data.PhoneNo));
		body.find('#detail-status').html(isNullOrEmpty(status));
		body.find('#detail-lodged-date').html(isNullOrEmpty(formatDate(data.LodgeDate)));
		var address = '';
		var idxes = ['Street','Suburb','PostCode','State'];
		$.each( idxes, function( index, value ) {
			address = address + data[value] + ' ';
		});
		body.find('#detail-address').html(isNullOrEmpty(address));
		body.find('#detail-text').html(isNullOrEmpty(data.Text));
		
		body.find('#detail-info-notice').html(isNullOrEmpty(data.WaitOnInfoSent == 1 ? 'Yes' : ''));
		body.find('#detail-sign-notice').html(isNullOrEmpty(data.WaitOnSignSent == 1 ? 'Yes' : ''));
		body.find('#detail-lodged-notice').html(isNullOrEmpty(data.LodgedSent == 1 ? 'Yes' : ''));
		

		DetailsModal.target.modal('show');


	},
	/**  
	* @callback removeContent
	* @description remove the content of the modal
	*/
	removeContent: function() {
		DetailsModal.target.find('.modal-body').empty();
	},
}

DetailsModal.trigger.on('click', DetailsModal.populateContent);
//DetailsModal.target.on('hidden.bs.modal', DetailsModal.removeContent);