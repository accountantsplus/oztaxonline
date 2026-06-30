var valid = false;
var selectedDate = null;
var selectedTime = null;
var consultantItems = [];
var serviceItems = [];
var service_id = null;
var provider_id = null;
var provider_email = null;
var service_duration = null;
var price = null;
var totalPrice = null;
var optionsFilled = false;
var isDepreciation = false;

function invalidate() {
	valid = true;
	var arr = ['howDone', 'consultant', 'taxService', 'tax-year'];
	arr.forEach((a) => {
		if($("#" + a).val() == null || $("#" + a).val().length <= 0) {
			$("#" + a).css("border", "2px solid red");
			valid = false;
		} else $("#" + a).css("border", "");
	});
	if($("#delivery").val() == null || $("#delivery").val().length <= 0) {
	    if($("#howDone").val() == 'Office') {
	        $("#delivery").css("border", "");
	        valid = true;
	    } else {
    		$("#delivery").css("border", "2px solid red");
    		valid = false;
	    }
	} else $("#consultant").css("border", "");
	if($("#consultant").val() == null || $("#consultant").val().length <= 0) {
		$("#consultant").css("border", "2px solid red");
		valid = false;
	} else $("#consultant").css("border", "");
	if(selectedDate == null || selectedTime == null) valid = false;
	if(selectedTime != null) {
		if(selectedTime.indexOf('AM') != -1) {
			$('#available-hoursAM').show();
			$('#available-hoursPM').hide();
		} else {
			$('#available-hoursAM').hide();
			$('#available-hoursPM').show();
		}
	}
	if(valid && optionsFilled) {
		$("#step3next").addClass("btn-primary");
		$("#step3next").removeClass("btn-secondary");
		$("#step3next").prop("disabled", false);
	} else {
		$("#step3next").addClass("btn-secondary");
		$("#step3next").removeClass("btn-primary");
		$("#step3next").prop("disabled", true);
	}
}
function dateOnChange(e) {
	if(e !== null && e.date !== null && e.date.isValid()) {
		selectedDate = e.date.format("DD/MM/YYYY");
		$('#selectDate').html(selectedDate);
	} else {
	    if(selectedDate !== null) {
	        $('#selectDate').html(selectedDate);
	    } else valid = false;
	}
    /*
	if(e != null && typeof(e.date) != "undefined" && selectedDate != null) {
		$('#selectDate').html(selectedDate);
	} else {
		if(e.date != null && e.date.isValid()) {
			selectedDate = e.date.format("DD/MM/YYYY");
			$('#selectDate').html(selectedDate);
		} else {
			valid = false;
		}	
	}*/
	
	var selectedTimeValue = $("#selectedTimeValue").val();
	if(selectedTimeValue != null && selectedTimeValue.length > 0) {
		selectedTime = selectedTimeValue;
		$('#selectTime').html(selectedTime);
	} else {
		if($('.available-hour').length > 0) $('.available-hour').first().trigger('click');
	}
	//after date and time selected
	invalidate();
	timeQuery();
}
class Time {
	constructor(hour, min, duration) {
		this.hour = hour;
		this.min = min;
		this.duration = duration;
	}
	print() {
		//console.log(this.hour + ":" + this.min + ":" + this.duration);
	}
	addMinute(min) {
		var newMin = this.min + min;
		if(newMin < 60) {
			return new Time(this.hour, newMin, this.duration);
		} else {
			var remain = newMin - 60;
			return new Time(this.hour + 1, remain, this.duration);
		}
	}
	compare(anotherTime) {
		if(this.hour == anotherTime.hour) {
			if(this.min == anotherTime.min) return 0;
			else if(this.min < anotherTime.min) return -1;
			else if(this.min < anotherTime.min) return 1;
		} else if(this.hour < anotherTime.hour) return -1;
		else return 1;
	}
	isBetween(prevEnd, nextStart) {
		if(prevEnd == null) prevEnd = new Time(9,0,0);
		if(nextStart == null) nextStart = new Time(17,0,0);
		if(prevEnd.compare(nextStart) >= 0) return false;
		if(this.compare(nextStart) >= 0) return false;
		if(this.compare(prevEnd) < 0) return false;
		var newTime = this.addMinute(this.duration);
		if(newTime.compare(nextStart) <= 0) return true;
		else return false;
	}
	toAMPM() {
		var hourTo = this.hour;
		var minTo = this.min;
		if(this.min == 0) minTo = "00";
		var am = "AM";
		if(this.hour == 12) am = "PM";
		if(this.hour > 12) {
			am = "PM";
			hourTo = this.hour - 12;			
		}
		return hourTo + ":" + minTo + " " + am;
	}
}

function timeQuery() {
	var dataValid = true;
	if (service_id == null) dataValid = false;
	else if (provider_id == null) dataValid = false;
	else if (selectedDate == null) dataValid = false;
	else if (service_duration == null) dataValid = false;
	if (dataValid == false) return;

	var href = 'https://www.policetax.com.au/appo/index.php/appointments/ajax_get_available_hours';
	//var href = window.location.origin + '/appo/index.php/appointments/ajax_get_available_hours';
	var postData = {
		//'csrfToken': GlobalVariables.csrfToken,
		'action': 'timeGap',
		'provider_id': provider_id,
		'selectedDate': selectedDate,
		'selectedTime': selectedTime,
		'service_duration': service_duration
	};
	
	var weekday=new Array(7);
    weekday[0]="Sunday";
    weekday[1]="Monday";
    weekday[2]="Tuesday";
    weekday[3]="Wednesday";
    weekday[4]="Thursday";
    weekday[5]="Friday";
    weekday[6]="Saturday";
    
    var arrDate = selectedDate.split("/");
	var d = new Date(`${arrDate[1]}/${arrDate[0]}/${arrDate[2]}`);
	var getWeek = weekday[d.getDay()];
	
	$('#available-hoursAM').html('');
	$('#available-hoursPM').html('');
	$('#available-hoursAM').show();
	$('#available-hoursPM').hide();
	
	
	postData.action = 'companyWorking';
	$.ajax({
		url: './php/step3db.php',
		data: postData,
		type: 'post',
		success: function(data1, sstatus1) {
		    var returnDataforCompanySetting = JSON.parse(data1);
            var companyworkinghrs = returnDataforCompanySetting[0].value;
			var companyWorkingDay = JSON.parse(companyworkinghrs);
		    var currentWorkingDaySchedule = companyWorkingDay[getWeek.toLowerCase()];
			
			var startHr = 9;
			var endHr = 18;
			
			var breakTime = [];
			if(currentWorkingDaySchedule != null){
			    var startDate = currentWorkingDaySchedule.start.split(":");
			    var endDate = currentWorkingDaySchedule.end.split(":");
        			
    			breakTime = currentWorkingDaySchedule.breaks;
    			
			    startHr = startDate[0];
			    endHr = endDate[0];
			}
			
        	var lots = [];
        	var isShow = true;
        	for(var i = startHr;i < endHr;i++) {
        		var lot1 = new Time(i, 0, service_duration);
        		var lot2 = new Time(i, 15, service_duration);
        		var lot3 = new Time(i, 30, service_duration);
        		var lot4 = new Time(i, 45, service_duration);
        		
        		lots.push(lot1);
        		lots.push(lot2);
        		lots.push(lot3);
        		lots.push(lot4);
        	}
        	
        	
            var bookingTimeOut = returnDataforCompanySetting[1];
		            
            var bookingHrs = bookingTimeOut.value / 60;
		     postData.action = 'timeGap';
            $.ajax({
        		url: './php/step3db.php',
        		data: postData,
        		type: 'post',
        		success: function(data, sstatus) {
        			var remainsAM = [];
        			var remainsPM = [];
        			var items = JSON.parse(data);
        			var user_workingPlan = items.length > 0 ? JSON.parse(items[0].working_plan) : null;
        			
        			var staffWorkingDaySchedule = user_workingPlan != null ? user_workingPlan[getWeek.toLowerCase()] : null;
        			
        			var dt = new Date();
        			var currentTimeData = `${dt.getMinutes()}`;
                    
                    if(currentTimeData.length < 2){
                        currentTimeData = "0" + currentTimeData;
                    }
                    var currentTime = dt.getHours() + ":" + currentTimeData + ":" + dt.getSeconds();
                    var monthData = `${(dt.getMonth() + 1)}`;
                    
                    if(monthData.length < 2){
                        monthData = "0" + (dt.getMonth() + 1);
                    }
                    
                    var currentDate = dt.getDate() + "/" + monthData + "/" + dt.getFullYear();
                    
                    var arrbreaks = [];
            		$.each(breakTime, function(ind, val){
            		    var breakstart = val.start.split(":");
            		    var breakend = val.end.split(":");
            		    arrbreaks.push({
                            "TIME(end_datetime)": currentTime,
                            "TIME(start_datetime)": "06:00:00",
                            ehour: breakend[0],
                            emin: breakend[1],
                            id: "5699",
                            shour: breakstart[0],
                            smin: breakstart[1]
                        });
            		});
            		
            		console.log(arrbreaks);
                                        
        			if(items.length == 0) {
        				for(var j = 0;j < lots.length;j++) {
    						var lot = lots[j];
    						var isBetweenBreak = arrbreaks.length > 0 ? lot.isBetween(new Time(arrbreaks[0].shour, arrbreaks[0].smin, 0),new Time(arrbreaks[0].ehour, arrbreaks[0].emin, 0)) : false;
        						
            		console.log(isBetweenBreak);
        					var lot = lots[j];
        					if(lot.hour < 12) {
        					    if(!isBetweenBreak)
        					        remainsAM.push(lot);
        					}
        					else{
        					    if(!isBetweenBreak)
        					        remainsPM.push(lot);
        					}
        				}
        			} else if(items.length > 0) {
        				for(var i = 0;i < items.length;i++) {
        					var lot1 = null;
        					var lot2 = null;
        					lot1 = new Time(items[i].ehour, items[i].emin, 0);
        					lot2 = i + 1 <= items.length - 1 ? new Time(items[i+1].shour, items[i+1].smin, 0) : null;
        					for(var j = 0;j < lots.length;j++) {
        						var lot = lots[j];
        						var isBetween = lot.isBetween(lot1,lot2);
        						
        						var isBetweenBreak = arrbreaks.length > 0 ? lot.isBetween(new Time(arrbreaks[0].shour, arrbreaks[0].smin, 0),new Time(arrbreaks[0].ehour, arrbreaks[0].emin, 0)) : false;
        						
        						if(lot.hour < 12) {
        							if(isBetween && !isBetweenBreak && !remainsAM.includes(lot)) remainsAM.push(lot);
        						} else {
        							if(isBetween && !isBetweenBreak && !remainsPM.includes(lot)) remainsPM.push(lot);
        						}
        					}
        				}
        			}
        			var isCurrentDateSelected = false;
        			if(selectedDate == currentDate){
                        isCurrentDateSelected = true;
        			}
        			
        			$('#available-hoursAM').html('');
        			$('#available-hoursPM').html('');
        			var div;
        			
        			if(currentWorkingDaySchedule != null || staffWorkingDaySchedule != null){
        			
            			//available-hoursAM
            			if(remainsAM.length == 0) {
            				$('#available-hoursAM').append('No available time slot. Please choose another day.');
            				selectTime = null;
            			} else {
            				div = $('<div>').addClass('col-xs-4').css('padding-left', '5px').css('padding-right', '5px');
            				for(var k = 0;k < Math.floor(remainsAM.length / 3) + 1;k++) {
            					var remain = remainsAM[k];
            					
            					if(!isCurrentDateSelected || (isCurrentDateSelected && remain.hour >= dt.getHours() + bookingHrs && remain.min >= dt.getMinutes())) {
                					if(selectedTime == null) {
                						if(k == 0) {
                							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                							div.append(span);
                						} else {
                							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                							div.append(span);
                						}
                					} else {
                						if(remain.toAMPM() == selectedTime) {
                							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                							div.append(span);
                						} else {
                							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                							div.append(span);
                						}
                					}
                					div.append($('<br>'));
        					    }
            				}
            				$('#available-hoursAM').append(div);
            				
            				
            				div = $('<div>').addClass('col-xs-4').css('padding-left', '5px').css('padding-right', '5px');
            				for(var k = Math.floor(remainsAM.length / 3) + 1;k < 2 * Math.floor(remainsAM.length / 3) + 1;k++) {
            					var remain = remainsAM[k];
            					
            					if(!isCurrentDateSelected || (isCurrentDateSelected && remain.hour >= dt.getHours() + bookingHrs && remain.min >= dt.getMinutes())){
                					if(selectedTime == null) {
                						if(k == 0) {
                							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                							div.append(span);
                						} else {
                							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                							div.append(span);
                						}
                					} else {
                						if(remain.toAMPM() == selectedTime) {
                							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                							div.append(span);
                						} else {
                							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                							div.append(span);
                						}
                					}
                					div.append($('<br>'));
            					}
            				}
            				$('#available-hoursAM').append(div);
            				
            				
            				div = $('<div>').addClass('col-xs-4').css('padding-left', '5px').css('padding-right', '5px');
            				for(var k = 2 * Math.floor(remainsAM.length / 3) + 1;k < remainsAM.length;k++) {
            					var remain = remainsAM[k];
            					
            					if(!isCurrentDateSelected || (isCurrentDateSelected && remain.hour >= dt.getHours() + bookingHrs && remain.min >= dt.getMinutes())){
                					if(selectedTime == null) {
                						if(k == 0) {
                							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                							div.append(span);
                						} else {
                							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                							div.append(span);
                						}
                					} else {
                						if(remain.toAMPM() == selectedTime) {
                							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                							div.append(span);
                						} else {
                							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                							div.append(span);
                						}
                					}
                					
                					div.append($('<br>'));
            					}
            				}
            				
            				$('#available-hoursAM').append(div);
            			}
            			
            			//available-hoursPM
            			if(remainsPM.length == 0) {
            				$('#available-hoursPM').append('No available time slot. Please choose another day.');
            				selectTime = null;
            			} else {
            				div = $('<div>').addClass('col-xs-4').css('padding-left', '5px').css('padding-right', '5px');
            				for(var k = 0;k < Math.floor(remainsPM.length / 3) + 1;k++) {
            					var remain = remainsPM[k];
            					if(!isCurrentDateSelected || (isCurrentDateSelected && remain.hour >= dt.getHours() + bookingHrs && remain.min >= dt.getMinutes())){
                					if(selectedTime == null) {
                						if(k == 0) {
                							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                							div.append(span);
                						} else {
                							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                							div.append(span);
                						}
                					} else {
                						if(remain.toAMPM() == selectedTime) {
                							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                							div.append(span);
                						} else {
                							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                							div.append(span);
                						}
                					}
                					div.append($('<br>'));
            					}
            				}
            				$('#available-hoursPM').append(div);
            				
            				
            				div = $('<div>').addClass('col-xs-4').css('padding-left', '5px').css('padding-right', '5px');
            				for(var k = Math.floor(remainsPM.length / 3) + 1;k < 2 * Math.floor(remainsPM.length / 3) + 1;k++) {
            					var remain = remainsPM[k];
            					if(!isCurrentDateSelected || (isCurrentDateSelected && remain.hour >= dt.getHours() + bookingHrs && remain.min >= dt.getMinutes())){
                					if(selectedTime == null) {
                						if(k == 0) {
                							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                							div.append(span);
                						} else {
                							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                							div.append(span);
                						}
                					} else {
                						if(remain.toAMPM() == selectedTime) {
                							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                							div.append(span);
                						} else {
                							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                							div.append(span);
                						}
                					}
                					div.append($('<br>'));
            					}
            				}
            				$('#available-hoursPM').append(div);
            				
            				
            				div = $('<div>').addClass('col-xs-4').css('padding-left', '5px').css('padding-right', '5px');
            				for(var k = 2 * Math.floor(remainsPM.length / 3) + 1;k < remainsPM.length;k++) {
            					var remain = remainsPM[k];
            					
            					if(!isCurrentDateSelected || (isCurrentDateSelected && remain.hour >= dt.getHours() + bookingHrs && remain.min >= dt.getMinutes())){
                					if(selectedTime == null) {
                						if(k == 0) {
                							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                							div.append(span);
                						} else {
                							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                							div.append(span);
                						}
                					} else {
                						if(remain.toAMPM() == selectedTime) {
                							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                							div.append(span);
                						} else {
                							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                							div.append(span);
                						}
                					}
                					div.append($('<br>'));
            					}
            				}
            				console.log(div);
            				$('#available-hoursPM').append(div);
            			}
            			changeAvailableHourClick();
            			invalidate();
        			} else {
        			    $('#available-hoursAM').append('No available time slot. Please choose another day.');
        			    $('#available-hoursPM').append('No available time slot. Please choose another day.');
        			}
        		},
        		error: function(xhr, desc, err) {
        			console.log(err);
        		}
        	});
		}
	});
}
//this function timeQuery1 was developed by someone else and there are a lot of mistakes
//if we use this timeQuery1 function available timeslots will not be returned
//and why there is 10/23/2023 hardcoded here ?
//did you seriously test what logics you have done ????? in all cases ????? 
function timeQuery1() {
	var dataValid = true;
	if (service_id == null) dataValid = false;
	else if (provider_id == null) dataValid = false;
	else if (selectedDate == null) dataValid = false;
	else if (service_duration == null) dataValid = false;
	if (dataValid == false) return;

	var href = 'https://www.policetax.com.au/appo/index.php/appointments/ajax_get_available_hours';
	//var href = window.location.origin + '/appo/index.php/appointments/ajax_get_available_hours';
	var postData = {
		//'csrfToken': GlobalVariables.csrfToken,
		'action': 'timeGap',
		'provider_id': provider_id,
		'selectedDate': selectedDate,
		'selectedTime': selectedTime,
		'service_duration': service_duration
	};
	var lots = [];
	for(var i = 9;i <= 16;i++) {
		var lot1 = new Time(i, 0, service_duration);
		var lot2 = new Time(i, 15, service_duration);
		var lot3 = new Time(i, 30, service_duration);
		var lot4 = new Time(i, 45, service_duration);
		lots.push(lot1);
		lots.push(lot2);
		lots.push(lot3);
		lots.push(lot4);
	}
	$('#available-hoursAM').html('');
	$('#available-hoursPM').html('');
	$('#available-hoursAM').show();
	$('#available-hoursPM').hide();
	
	var weekday=new Array(7);
    weekday[0]="Sunday";
    weekday[1]="Monday";
    weekday[2]="Tuesday";
    weekday[3]="Wednesday";
    weekday[4]="Thursday";
    weekday[5]="Friday";
    weekday[6]="Saturday";
    
    var arrDate = selectedDate.split("/");
	var d = new Date(`${arrDate[1]}/${arrDate[0]}/${arrDate[2]}`);
	var getWeek = weekday[d.getDay()];
	
	postData.action = 'companyWorking';
	$.ajax({
		url: './php/step3db.php',
		data: postData,
		type: 'post',
		success: function(data1, sstatus1) {
		     var companyworkinghrs = JSON.parse(data1);
		     
	        postData.action = 'bookingTimeOut';
        	$.ajax({
        		url: './php/step3db.php',
        		data: postData,
        		type: 'post',
        		success: function(dataTimeout, sstatusTimeout) {
		            var bookingTimeOut = (JSON.parse(dataTimeout));
		            
		            var bookingHrs = bookingTimeOut[0].value / 60;
        	        postData.action = 'timeGap';
        	        $.ajax({
                    		url: './php/step3db.php',
                    		data: postData,
                    		type: 'post',
                    		success: function(data, sstatus) {
                    			var remainsAM = [];
                    			var remainsPM = [];
                    			var items = JSON.parse(data);
                    			var user_workingPlan = items.length > 0 ? JSON.parse(items[0].working_plan) : null;
                    			
                    			var companyWorkingDay = JSON.parse(companyworkinghrs[0].value);
                    			
                    			var currentWorkingDaySchedule = companyWorkingDay[getWeek.toLowerCase()];
                    			var staffWorkingDaySchedule = user_workingPlan != null ? user_workingPlan[getWeek.toLowerCase()] : null;
                    			
                    			var dt = new Date();
                    			var currentTimeData = `${dt.getMinutes()}`;
                                
                                if(currentTimeData.length < 2){
                                    currentTimeData = "0" + currentTimeData;
                                }
                                var currentTime = dt.getHours() + ":" + currentTimeData + ":" + dt.getSeconds();
                                var monthData = `${(dt.getMonth() + 1)}`;
                                
                                if(monthData.length < 2){
                                    monthData = "0" + (dt.getMonth() + 1);
                                }
                                
                                var currentDate = dt.getDate() + "/" + monthData + "/" + dt.getFullYear();
                                
                                
                                console.log(dt.getHours());
                                console.log(currentTime);
                                if(selectedDate == currentDate){
                                    items.push({
                                        "TIME(end_datetime)": currentTime,
                                        "TIME(start_datetime)": "06:00:00",
                                        ehour: "12",
                                        emin: "0",
                                        id: "5699",
                                        shour: "9",
                                        smin: "30"
                                    })
                                }
                                
                    			if(items.length == 0) {
                    				for(var j = 0;j < lots.length;j++) {
                    					var lot = lots[j];
                    					if(lot.hour < 12) remainsAM.push(lot);
                    					else remainsPM.push(lot);
                    				}
                    			}
                    			else if(items.length > 0) {
                    				for(var i = 0;i < items.length;i++) {
                    					var lot1 = null;
                    					var lot2 = null;
                    					if(i == 0) lot2 = new Time(items[i].shour, items[i].smin, 0);
                    					else if(i == items.length - 1) lot1 = new Time(items[i].ehour, items[i].emin, 0);
                    					else {
                    						lot1 = new Time(items[i].ehour, items[i].emin, 0);
                    						lot2 = new Time(items[i + 1].shour, items[i + 1].smin, 0);
                    					}
                    					for(var j = 0;j < lots.length;j++) {
                    						var lot = lots[j];
                    						var isBetween = lot.isBetween(lot1,lot2);
                    						if(lot.hour < 12) {
                    							if(isBetween && !remainsAM.includes(lot)) remainsAM.push(lot);
                    						} else {
                    							if(isBetween && !remainsPM.includes(lot)) remainsPM.push(lot);
                    						}
                    					}
                    				}
                    			}
                    			//console.log(remainsAM);
                    			//console.log(remainsPM);
                    			$('#available-hoursAM').html('');
                    			$('#available-hoursPM').html('');
                    			var div;
                    			var startWorkingStartHrsCompany = new Date('10/23/2023');
                    			var startWorkingEndHrsCompany = new Date('10/23/2023');
                    			
                    			if(staffWorkingDaySchedule != null){
                    			    startWorkingStartHrsCompany = new Date('10/23/2023 ${staffWorkingDaySchedule.start}');  
                    			    startWorkingEndHrsCompany = new Date('10/23/2023 ${staffWorkingDaySchedule.end}'); 
                    			} else if(currentWorkingDaySchedule != null){
                    			    startWorkingStartHrsCompany = new Date('10/23/2023 ${currentWorkingDaySchedule.start}');
                    			    startWorkingEndHrsCompany = new Date('10/23/2023 ${currentWorkingDaySchedule.end}');  
                    			}
                    			
                    			if(currentWorkingDaySchedule != null || staffWorkingDaySchedule != null){
                    			    
                        			//available-hoursAM
                        			if(remainsAM.length == 0) {
                        				$('#available-hoursAM').append('No available time slots left today. Please choose another day.');
                        				selectTime = null;
                        			} else {
                        				div = $('<div>').addClass('col-xs-4').css('padding-left', '5px').css('padding-right', '5px');
                        				for(var k = 0;k < Math.floor(remainsAM.length / 3) + 1;k++) {
                        					var remain = remainsAM[k];
                        					
                        					if(remain.hour >= startWorkingStartHrsCompany.getHours() && remain.hour >= dt.getHours() + bookingHrs
                        					    && remain.min >= dt.getMinutes()){
                        					    
                            					if(selectedTime == null) {
                            						if(k == 0) {
                            							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                            							div.append(span);
                            						} else {
                            							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                            							div.append(span);
                            						}
                            					} else {
                            						if(remain.toAMPM() == selectedTime) {
                            							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                            							div.append(span);
                            						} else {
                            							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                            							div.append(span);
                            						}
                            					}
                            					div.append($('<br>'));
                        					}
                        				}
                        				$('#available-hoursAM').append(div);
                        				
                        				
                        				div = $('<div>').addClass('col-xs-4').css('padding-left', '5px').css('padding-right', '5px');
                        				for(var k = Math.floor(remainsAM.length / 3) + 1;k < 2 * Math.floor(remainsAM.length / 3) + 1;k++) {
                        					var remain = remainsAM[k];
                        					
                        					if(remain.hour >= startWorkingStartHrsCompany.getHours() && remain.hour >= dt.getHours() + bookingHrs
                        					    && remain.min >= dt.getMinutes()){
                            					if(selectedTime == null) {
                            						if(k == 0) {
                            							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                            							div.append(span);
                            						} else {
                            							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                            							div.append(span);
                            						}
                            					} else {
                            						if(remain.toAMPM() == selectedTime) {
                            							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                            							div.append(span);
                            						} else {
                            							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                            							div.append(span);
                            						}
                            					}
                            					div.append($('<br>'));
                        					}
                        				}
                        				$('#available-hoursAM').append(div);
                        				
                        				
                        				div = $('<div>').addClass('col-xs-4').css('padding-left', '5px').css('padding-right', '5px');
                        				for(var k = 2 * Math.floor(remainsAM.length / 3) + 1;k < remainsAM.length;k++) {
                        					var remain = remainsAM[k];
                        					
                        					if(remain.hour >= startWorkingStartHrsCompany.getHours() && remain.hour >= dt.getHours() + bookingHrs
                        					    && remain.min >= dt.getMinutes()){
                            					if(selectedTime == null) {
                            						if(k == 0) {
                            							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                            							div.append(span);
                            						} else {
                            							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                            							div.append(span);
                            						}
                            					} else {
                            						if(remain.toAMPM() == selectedTime) {
                            							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                            							div.append(span);
                            						} else {
                            							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                            							div.append(span);
                            						}
                            					}
                            					div.append($('<br>'));
                        					}
                        				}
                        				$('#available-hoursAM').append(div);
                        			}
                        			
                        			//available-hoursPM
                        			if(remainsPM.length == 0) {
                        				$('#available-hoursPM').append('No available time slot. Please choose another day.');
                        				selectTime = null;
                        			} else {
                        				div = $('<div>').addClass('col-xs-4').css('padding-left', '5px').css('padding-right', '5px');
                        				for(var k = 0;k < Math.floor(remainsPM.length / 3) + 1;k++) {
                        					var remain = remainsPM[k];
                        					
                        					if(remain.hour < startWorkingEndHrsCompany.getHours() && remain.hour >= dt.getHours() + bookingHrs
                        					    && remain.min >= dt.getMinutes()){
                            					if(selectedTime == null) {
                            						if(k == 0) {
                            							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                            							div.append(span);
                            						} else {
                            							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                            							div.append(span);
                            						}
                            					} else {
                            						if(remain.toAMPM() == selectedTime) {
                            							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                            							div.append(span);
                            						} else {
                            							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                            							div.append(span);
                            						}
                            					}
                            					div.append($('<br>'));
                        					}
                        				}
                        				$('#available-hoursPM').append(div);
                        				
                        				
                        				div = $('<div>').addClass('col-xs-4').css('padding-left', '5px').css('padding-right', '5px');
                        				for(var k = Math.floor(remainsPM.length / 3) + 1;k < 2 * Math.floor(remainsPM.length / 3) + 1;k++) {
                        					var remain = remainsPM[k];
                        					if(remain.hour < startWorkingEndHrsCompany.getHours() && remain.hour >= dt.getHours() + bookingHrs
                        					    && remain.min >= dt.getMinutes()){
                            					if(selectedTime == null) {
                            						if(k == 0) {
                            							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                            							div.append(span);
                            						} else {
                            							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                            							div.append(span);
                            						}
                            					} else {
                            						if(remain.toAMPM() == selectedTime) {
                            							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                            							div.append(span);
                            						} else {
                            							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                            							div.append(span);
                            						}
                            					}
                            					div.append($('<br>'));
                        					}
                        				}
                        				$('#available-hoursPM').append(div);
                        				
                        				
                        				div = $('<div>').addClass('col-xs-4').css('padding-left', '5px').css('padding-right', '5px');
                        				for(var k = 2 * Math.floor(remainsPM.length / 3) + 1;k < remainsPM.length;k++) {
                        					var remain = remainsPM[k];
                        					
                        					if(remain.hour < startWorkingEndHrsCompany.getHours() && remain.hour >= dt.getHours() + bookingHrs
                        					    && remain.min >= dt.getMinutes()){
                            					if(selectedTime == null) {
                            						if(k == 0) {
                            							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                            							div.append(span);
                            						} else {
                            							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                            							div.append(span);
                            						}
                            					} else {
                            						if(remain.toAMPM() == selectedTime) {
                            							var span = $('<span>').addClass('available-hour').addClass('selected-hour').html(remain.toAMPM());
                            							div.append(span);
                            						} else {
                            							var span = $('<span>').addClass('available-hour').html(remain.toAMPM());
                            							div.append(span);
                            						}
                            					}
                            					div.append($('<br>'));
                        					}
                        				}
                        				$('#available-hoursPM').append(div);
                        			}
                        			changeAvailableHourClick();
                        			invalidate();
                    			}else{
                    			    $('#available-hoursAM').append('No available time slot. Please choose another day.');
                    				selectTime = null;
                    				$('#available-hoursPM').append('No available time slot. Please choose another day.');
                    				selectTime = null;
                    			}
                    		},
                    		error: function(xhr, desc, err) {
                    			console.log(err);
                    		}
                    	});
        		}
        	});
		}
	});
}
function consultantQuery() {
	$.ajax({
		url: './php/step3db.php',
		data: {'action': 'consultantQuery'},
		type: 'post',
		success: function(data, sstatus) {
			consultantItems = JSON.parse(data);
			if(consultantItems.length > 0) {
				$.each(consultantItems, function (i, item) {
					$('#consultant').append($('<option>', {
						value: item.id_users,
						text : item.first_name + ' ' + item.last_name
					}));
				});
			}
			//console.log(consultantItems);
			var consultantValue = $("#consultantValue").val();
			if(consultantValue != null && consultantValue.length > 0) {
				$("#consultant").val(consultantValue).change();
			} else {
				//$("#consultant").val(consultantItems[0].id_users).change();
			}
		},
		error: function(xhr, desc, err) {
		}
	});
}
function consultantChange(value) {
	$('#taxService').html('');
	
	invalidate();
	if(value == null || value.length == 0) return;
	provider_id = value;
	//console.log(provider_id + ":" + value);
	if(consultantItems.length > 0) {
		$.each(consultantItems, function (i, item) {
			if(item.id_users == value) {
				provider_email = item.email;
			}
		});
	}
	if(provider_email == null) provider_email = "garry@policetax.com.au";
	var consultantName = $("#consultant option:selected").html();
	$("#consultantSum").html(consultantName);
	$.ajax({
		url: './php/step3db.php',
		data: {'action': 'consultantChange', 'id':value},
		type: 'post',
		success: function(data, sstatus) {
			serviceItems = JSON.parse(data);
			if(serviceItems.length > 0) {

				var groups = {};
				for (var i = 0; i < serviceItems.length; i++) {
					var groupName = serviceItems[i].service_category_names ;
					if (!groups[groupName]) {
						groups[groupName] = [];
					}
					groups[groupName].push(serviceItems[i].name);
				}
				var newServiceItems = [];
				for (var groupName in groups) {
					newServiceItems.push({group: groupName, name: groups[groupName]});
				}

				$.each(newServiceItems, function (i, item) {
					optgroupHtml = '<optgroup label="' + item.group + '" type="services-group">';
	
					$.each(item.name, function (index, service) {
    				    var id_index = 0;
    				    var desc_tax = "";
                        $.each(serviceItems, function(service_i, service_v){
                            if(service_v.name == service){
                              id_index = service_i;
                              desc_tax = service_v.description;
                            } 
                        });
						optgroupHtml += '<option value="' + id_index + '" attr-desc="' + desc_tax + '">' +
							service + '</option>';
					});

					$('#taxService').append(optgroupHtml);
				});
				
			}
			var taxServiceValue = $("#taxServiceValue").val();
			if(taxServiceValue != null && taxServiceValue.length > 0) {
				$("#taxService").val(taxServiceValue).change();
			} else {
				$("#taxService").val("1").change();
			}
		},
		error: function(xhr, desc, err) {
		}
	});
}

function fnLoadTaxYear(){
    
    $("#tax-year").html("");
    var htmlTaxYear = "<option>Select Tax Year</option>";
    var currentYear = (new Date).getFullYear();
    var last5years = currentYear - 5;
    
    for(var i=last5years; i <= currentYear; i++){
        var selected = "";
        if(currentYear == i){
            selected = "selected";
        }
        
        htmlTaxYear += `<option value='${i}' ${selected}>${i}</option>`;
    }
    
    $("#tax-year").append(htmlTaxYear);
}
function fnLoadOfficeLocation(){
    
    $("#office-location").removeAttr("disabled");
    $("#office-location").html("");
    var selectedAccountant = $('#consultant option:selected').html();
    var htmlLocation = "";
    var locationData = ["Preston", "Nunawading", "Hawthorn Swinburne", "Kinglake"];
    
    for(var i=0; i < locationData.length; i++){
        var selected = "";
        if(locationData[i] == "Nunawading"){
            selected = "selected";
        }
        
        htmlLocation += `<option value='${locationData[i]}' ${selected}>${locationData[i]}</option>`;
    }
    
    $("#office-location").append(htmlLocation);
    
    $("#officeLocationSum").html("Nunawading");
    
    if(selectedAccountant != "" && !(selectedAccountant.indexOf("Garry") != -1)){
        $("#office-location").attr("disabled", "disabled");
    }
}

function checkOptionsFilled() {
    optionsFilled = true;
    $('.opInput').each(function() {
        var val = $( this ).val();
        if (val <= 0) {
            optionsFilled = false;
        }
    });
    invalidate();
    if (optionsFilled) {
        var numberOfPeople = $('.opInput').first().val();
        var numberOfProperties = $('.opInput').last().val();
        totalPrice = price * numberOfPeople + 50 * numberOfProperties;
        if (isDepreciation) {
            totalPrice += 50 * numberOfPeople;
        }
        if (isNaN(totalPrice)) {
            totalPrice = price;
        }
    } else {
        totalPrice = price;
    }
    $("#price").html(totalPrice + " AUD");
}
function checkYearsFilled() {
    var activeYearsLen = $(".yearBtn.active").length;
    var notActiveYearsLen = $(".yearBtn:not(.active)").length;
    optionsFilled = (activeYearsLen > 0);
    invalidate();
    if (optionsFilled) {
        totalPrice = price * activeYearsLen;
        if (isNaN(totalPrice)) {
            totalPrice = price;
        }
    } else {
        totalPrice = price;
    }
    $("#price").html(totalPrice + " AUD");
}
function taxServiceChange(idx) {
	selectedTime = null;
	invalidate();
	if(idx == null || idx.length == 0) {
		$("#step3datetime").hide();
		return;
	} else $("#step3datetime").show();
	var service = serviceItems[idx];
	service_id = service.id_services;
	provider_id = service.id_users;
	service_duration = parseInt(service.duration) || 0;
	price = parseInt(service.price) || 0;
	totalPrice = parseInt(service.price) || 0;
	//leave it for later
	optionsFilled = false;
	isDepreciation = false;
	$('#serviceOptions').html('');
	var data = { 'action': 'getServicesOptions', 'service_id': service_id };
	$.ajax({
		url: './php/step3db.php',
		data: data,
		type: 'post',
		success: function(datas, sstatus) {
		    var servicesOptions = JSON.parse(datas);
		    if (servicesOptions.length == 0) {
            	price = parseInt(service.price) || 0;
            	totalPrice = parseInt(service.price) || 0;
		        optionsFilled = true;
		    } else {
		        optionsFilled = false;
		    }
		    console.log('taxServiceChange:' + servicesOptions.length + ":" + optionsFilled);
		    invalidate();
		    $.each(servicesOptions, function (i, item) {
		        switch (item.type) {
		            case '1':
		                //number input
		                var template = '<div class="form-group col-xs-12 col-sm-12 col-md-4 no-gutters-left"><div class="row no-gutters-right"><div class="col-xs-12"><div class="col-xs-12 col-sm-12 no-gutters-left no-gutters-right"><ato-label><label class="control-label" for="op' + item.id + '">' + item.name + ' (must be at least 1)</label></ato-label><input type="number" class="form-control opInput" id="op' + item.id + '" value="0"></div></div></div></div>';
		                $("#serviceOptions").append(template);
		                break;
		            case '2':
		                //yes/no
		                var template = '<div class="form-group col-xs-12 col-sm-12 col-md-4 no-gutters-left"><fieldset><legend class="pad-for-horizontal"><ato-label><label class="control-label">' + item.name + '</label></ato-label></legend><div class="col-xs-12 col-sm-12 no-gutters"><div><div class="row no-gutters-right fld-group"><div class="col-xs-12 col-sm-6 fld-group-item"><div class="radio"><input type="radio" name="op' + item.id + '" id="op' + item.id + 'Item0" value="5" checked><label class="justify" for="op' + item.id + 'Item0">No</label></div></div><div class="col-xs-12 col-sm-6 fld-group-item"><div class="radio"><input type="radio" name="op' + item.id + '" id="op' + item.id + 'Item1" value="10"><label class="justify" for="op' + item.id + 'Item1">Yes</label></div></div></div></div></div></fieldset></div>';
		                $("#serviceOptions").append(template);
                    	$('#op' + item.id + 'Item0').click(function() {
                    	    isDepreciation = false;
                    	    checkOptionsFilled();
                    	});
                    	$('#op' + item.id + 'Item1').click(function() {
                    	    isDepreciation = true;
                    	    checkOptionsFilled();
                    	});
		                break;
		            case '3':
		                //years
		                var prefixTemplate = '<div class="form-group col-xs-12 col-sm-12 no-gutters-left"><div class="row no-gutters-right"><div class="col-xs-12"><div class="col-xs-12 col-sm-12 no-gutters-left no-gutters-right"><ato-label><label class="control-label">Click to choose which years you want to fix tax: (each year $' + price + ' AUD, must select at least 1 year)</label></ato-label><div class="btn-group col-xs-12" id="op' + item.id + '" data-toggle="buttons">';
		                var allTemplate = prefixTemplate;
		                var currentYear = new Date().getFullYear();
		                for(var i = currentYear; i > currentYear - 10; i--) {
		                    var template = '<label class="btn btn-default yearBtn"><input type="checkbox" name="yr'+i+'" id="yr'+i+'" value="yr'+i+'">'+i+'</label>';
		                    allTemplate += template;
		                }
		                var postfixTemplate = '</div></div></div></div></div>';
		                allTemplate += postfixTemplate;
		                $("#serviceOptions").append(allTemplate);
		                break;
		        }
		    });
            //options events handled
        	$('.opInput').on( "change", function() {
        	    checkOptionsFilled();
        	});
        	$('.yearBtn').click(function (e) {
                setTimeout(() => {
            	    $(this).removeClass("focus");
            	    checkYearsFilled();
                }, 100);
        	});	
		},
		error: function(xhr, desc, err) {
		}
	});
	//leave it for later

	var taxServiceName = $("#taxService option:selected").html();
	var taxServiceDesc = $("#taxService option:selected").attr("attr-desc");
	$("#taxServiceSum").html(taxServiceName);
 	$("#taxServiceDescription").html(taxServiceDesc);
	$("#duration").html(service.duration + " minutes");
	$("#price").html(totalPrice + " AUD");
	
	var selectedTimeValue = $("#selectedTimeValue").val();
	if(selectedTimeValue != null && selectedTimeValue.length > 0) {
		selectedTime = selectedTimeValue;
		$('#selectTime').html(selectedTime);
	}

	var selectedDateValue = $("#selectedDateValue").val();
	if(selectedDateValue != null && selectedDateValue.length > 0) {
		selectedDate = selectedDateValue;
		var dt = moment(selectedDateValue, "DD/MM/YYYY");
		var dtPicker = $('#datetimepicker12').datetimepicker({
			minDate: new Date(),
			inline: true,
			sideBySide: true,
			format: 'DT',
			//daysOfWeekDisabled: [0,6],
			//daysOfWeekDisabled: [0],
			date: dt,
		}).on('dp.change', dateOnChange);
		dtPicker.data("DateTimePicker").date(dt);//will trigger dp.change
	} else {
		var dtPicker = $('#datetimepicker12').datetimepicker({
			minDate: new Date(),
			inline: true,
			sideBySide: true,
			format: 'DT',
			//daysOfWeekDisabled: [0,6]
			daysOfWeekDisabled: [0],
		}).on('dp.change', dateOnChange);
		var today = new Date();
		//if(today.getDay() == 6) today.setDate(today.getDate() + 2);//saturday, work on next Monday
		//else if(today.getDay() == 0) today.setDate(today.getDate() + 1);//sunday, work on next Monday
		if(today.getDay() == 0) today.setDate(today.getDate() + 1);//sunday, work on next Monday
		dtPicker.data("DateTimePicker").date(today);//will trigger dp.change
	}
	timeQuery();
}
function changeAvailableHourClick() {
	$('.available-hour').click(function (e) {
		//console.log('click trigger');
		$('.selected-hour').removeClass('selected-hour');
		$(this).addClass('selected-hour');
		selectedTime = $(this).html();
		$('#selectTime').html(selectedTime);
		invalidate();
	});
	var selectedTimeValue = $("#selectedTimeValue").val();
	if(selectedTimeValue != null && selectedTimeValue.length > 0) {
		selectedTime = selectedTimeValue;
		$('#selectTime').html(selectedTime);
	} else {
		if($('.available-hour').length > 0) $('.available-hour').first().trigger('click');
	}
}
function init() {
	invalidate();
	$('.yearBtn').click(function (e) {
        setTimeout(() => {
    	    $(this).removeClass("focus");
        }, 100);
	});	
	$('#step4link').click(function (e) {
		if(!valid) e.preventDefault();
		else submit();
	});	
	var selectedDateValue = $("#selectedDateValue").val();
	if(selectedDateValue != null && selectedDateValue.length > 0) {
		selectedDate = selectedDateValue;
		var dt = moment(selectedDateValue, "DD/MM/YYYY");
		var dtPicker = $('#datetimepicker12').datetimepicker({
			minDate: new Date(),
			inline: true,
			sideBySide: true,
			format: 'DT',
			//daysOfWeekDisabled: [0,6],
			//daysOfWeekDisabled: [0]
		}).on('dp.change', dateOnChange);
		dtPicker.data("DateTimePicker").date(dt);//will trigger dp.change
	} else {
		var dtPicker = $('#datetimepicker12').datetimepicker({
			minDate: new Date(),
			inline: true,
			sideBySide: true,
			format: 'DT',
			//daysOfWeekDisabled: [0,6]
			//daysOfWeekDisabled: [0],
		}).on('dp.change', dateOnChange);
		var today = new Date();
		//if(today.getDay() == 6) today.setDate(today.getDate() + 2);//saturday, work on next Monday
		//else if(today.getDay() == 0) today.setDate(today.getDate() + 1);//sunday, work on next Monday
		if(today.getDay() == 0) today.setDate(today.getDate() + 1);//sunday, work on next Monday
		dtPicker.data("DateTimePicker").date(today);//will trigger dp.change
	}
	changeAvailableHourClick();	
	$('#delivery').change(function (e) {
		e.preventDefault();
		var deliveryName = $("#delivery option:selected").html();
		$("#deliverySum").html(deliveryName);
		invalidate();
	});
	$('#consultant').change(function (e) {
		e.preventDefault();
		var selectedVal = $("#consultant option:selected").val();
		fnLoadOfficeLocation();
		consultantChange(selectedVal);
	});
	$('#taxService').change(function (e) {
		e.preventDefault();
		var selectedVal = $("#taxService option:selected").val();
		taxServiceChange(selectedVal);
		
	});
	$('#timeAM').click(function (e) {
		selectedTime = null;
		$('#available-hoursAM').show();
		$('#available-hoursPM').hide();
		$('#available-hoursAM .available-hour').first().trigger('click');
	});
	$('#timePM').click(function (e) {
		selectedTime = null;
		$('#available-hoursAM').hide();
		$('#available-hoursPM').show();
		$('#available-hoursPM .available-hour').first().trigger('click');
	});
   $("#tax-year").change(function(e){
       e.preventDefault();
       var selectedVal = $("#tax-year").val();
       $("#taxYearSum").html(selectedVal);
       invalidate();
   });
   $("#office-location").change(function(e){
       e.preventDefault();
       var selectedVal = $("#office-location").val();
       $("#officeLocationSum").html(selectedVal);
   });
	consultantQuery();	
}

$(document).on("change", "#howDone", function(e){
    e.preventDefault();
    var currentVal = $("#howDone").val();
    
    $("#deliverySum").html(currentVal);
    
    if(currentVal == "Office"){
        $(".service-delivery-data").hide();
    } else {
        $(".service-delivery-data").show();
        $("#delivery").trigger("change");
    }
});

function submit() {
	var howDone = $("#howDone").val();
	var delivery = $("#delivery").val();
	var consultant = $("#consultant").val();
	var officeLocation = $("#office-location").val();
	var consultantName = $("#consultant option:selected").html();
	var taxService = $("#taxService").val();
	var taxServiceName = $("#taxService option:selected").html();
	var taxServiceDesc = $("#taxService option:selected").attr("attr-desc");
	var spouseFirstName = $("#spouseFirstName").val();
	var spouseLastName = $("#spouseLastName").val();
	var spouseDOB = $("#spouseDOB").val();
	var taxYear = $("#tax-year").val();
	var notes = $("#notes-for-accountant").val();
	var data = { 'action': 'session', 'howDone' : howDone, 'delivery' : delivery, 'taxServiceDescription': taxServiceDesc, 'provider_id': provider_id, 'provider_email': provider_email, 'consultant' : consultant, 'consultantName': consultantName, 'service_id': service_id, 'taxService' : taxService, 'taxServiceName': taxServiceName, 'selectedDate' : selectedDate, 'selectedTime' : selectedTime, 'service_duration': service_duration, 'price': totalPrice, 'spouseDOB': spouseDOB, 'spouseFirstName': spouseFirstName, 'spouseLastName': spouseLastName, 'officeLocation': officeLocation, 'taxYear': taxYear, 'notes': notes };
	//console.log(data);
	$.ajax({
		url: './php/step3db.php',
		data: data,
		type: 'post',
		success: function(datas, sstatus) {
			$('#step3form').submit();
		},
		error: function(xhr, desc, err) {
		}
	});
}
$(function() {
	init();
	fnLoadTaxYear();
	fnLoadOfficeLocation();
	$("#tax-year").trigger("change");
	$('#step3next').click(function (e) {
		e.preventDefault();
		submit();
	});
});