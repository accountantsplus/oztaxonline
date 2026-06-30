
/**
   * Checks that an element has a non-empty `name` and `value` property.
   * @param  {Element} element  the element to check
   * @return {Bool}             true if the element is an input, false if not
   */
  const isValidElement = element => {
    return element.name && element.value && element.name != 'stage';
  };

  /**
   * Checks if an element’s value can be saved (e.g. not an unselected checkbox).
   * @param  {Element} element  the element to check
   * @return {Boolean}          true if the value should be added, false if not
   */
  const isValidValue = element => {
    return (!['checkbox', 'radio'].includes(element.type) || element.checked);
  };

  /**
   * Checks if an input is a checkbox, because checkboxes allow multiple values.
   * @param  {Element} element  the element to check
   * @return {Boolean}          true if the element is a checkbox, false if not
   */
  const isCheckbox = element => element.type === 'checkbox';

  /**
   * Checks if an input is a `select` with the `multiple` attribute.
   * @param  {Element} element  the element to check
   * @return {Boolean}          true if the element is a multiselect, false if not
   */
  const isMultiSelect = element => element.options && element.multiple;

  /**
   * Retrieves the selected options from a multi-select as an array.
   * @param  {HTMLOptionsCollection} options  the options for the select
   * @return {Array}                          an array of selected option values
   */
  const getSelectValues = options => [].reduce.call(options, (values, option) => {
    return option.selected ? values.concat(option.value) : values;
  }, []);

  /**
   * A more verbose implementation of `formToJSON()` to explain how it works.
   *
   * NOTE: This function is unused, and is only here for the purpose of explaining how
   * reducing form elements works.
   *
   * @param  {HTMLFormControlsCollection} elements  the form elements
   * @return {Object}                               form data as an object literal
   */
  const formToJSON_deconstructed = elements => {

    // This is the function that is called on each element of the array.
    const reducerFunction = (data, element) => {

      // Add the current field to the object.
      data[element.name] = element.value;

      // For the demo only: show each step in the reducer’s progress.
      // console.log(JSON.stringify(data));

      return data;
    };

    // This is used as the initial value of `data` in `reducerFunction()`.
    const reducerInitialValue = {};

    // To help visualize what happens, log the inital value, which we know is `{}`.
    // console.log('Initial `data` value:', JSON.stringify(reducerInitialValue));

    // Now we reduce by `call`-ing `Array.prototype.reduce()` on `elements`.
    const formData = [].reduce.call(elements, reducerFunction, reducerInitialValue);

    // The result is then returned for use elsewhere.
    return formData;
  };

  /**
   * Retrieves input data from a form and returns it as a JSON object.
   * @param  {HTMLFormControlsCollection} elements  the form elements
   * @return {Object}                               form data as an object literal
   */
  const formToJSON = elements => [].reduce.call(elements, (data, element) => {

    // Make sure the element has the required properties and should be added.
    if (isValidElement(element) && isValidValue(element)) {

      /*
       * Some fields allow for more than one value, so we need to check if this
       * is one of those fields and, if so, store the values as an array.
       */
      if (isCheckbox(element)) {
        data[element.name] = (data[element.name] || []).concat(element.value);
      } else if (isMultiSelect(element)) {
        data[element.name] = getSelectValues(element);
      } else {
        data[element.name] = element.value;
      }
    }

    return data;
  }, {});

  /**
   * A handler function to prevent default submission and run our custom script.
   * @param  {Event} event  the submit event triggered by the user
   * @return {void}
   */
  formSubmit = form =>{
// Call our function to get the form data.
const data = formToJSON(form.elements);

// Demo only: print the form data onscreen as a formatted JSON object.
const dataContainer = document.getElementById('jsonInput');

// Use `JSON.stringify()` to make the output valid, human-readable JSON.
// dataContainer.value = JSON.stringify(data, null, "  ");

// ...this is where we’d actually do something with the form data...
console.log(data);
return;
$.ajax({
  url: 'http://121.213.241.197:81/newclient',
  type: 'post',
  data: data,
  headers: {
    "Access-Control-Allow-Origin": 'http://www.itechsol.com.au'
  },
  dataType: 'json',
  success: function(data) {
    $('#jsonOutput').val(data.data[0].fieldData.Json_WriteBackToServer);
    console.info(data);
    window.location.href = window.location.href.replace("newclient", "taxreturn/index.html?recordId=" + data.data[0]
      .recordId);
  },
  fail: function(a, b, c) {
    // console.log(a);
  }




});
  }
  const handleFormSubmit = event => {

    // Stop the form from submitting since we’re handling that with AJAX.
    event.preventDefault();
    formSubmit(form);
    
  };

document.addEventListener("DOMContentLoaded", function() {
  // addAllDeduction();
  // $('#Q7GovtPayments').on('change', function () {
  // 	if ($(this).val() == 'No')
  // 		$('#govtpayoption').css('display', 'none');
  // 	else
  // 		$('#govtpayoption').css('display', 'initial');
  // });
  // $('#Q7GovtPayments').trigger('change');

  $('#HaveSpouse').on('change', function() {
    if ($(this).val() == 'No') {
      $('.HaveSpouse').css('display', 'none');
      // document.getElementById('spouse_surname').required = false;
      // document.getElementById('spouse_firstName').required = false;
      // document.getElementById('spouse_middleName').required = false;
      // document.getElementById('no_dependants').required = false;
      // document.getElementById('stage2_taxable_income').required = false;
    } else {
      $('.HaveSpouse').css('display', 'initial');
      // document.getElementById('spouse_surname').required = true;
      // document.getElementById('spouse_firstName').required = true;
      // document.getElementById('spouse_middleName').required = true;
      // document.getElementById('no_dependants').required = true;
      // document.getElementById('stage2_taxable_income').required = true;
    }

  });
  $('#HaveSpouse').trigger('change');

  $('#HereBefore').on('change', function() {
    if ($(this).val() == 'No') {
      $('#section1h').text("1. Name & Job Details");
      // $('#middle_name').removeAttr('required');
      // document.getElementById('stationLocale').required = true;
      // document.getElementById('yearsInJob').required = true;
      // document.getElementById('street_unit_no').required = true;
      // document.getElementById('street_address').required = true;
      // document.getElementById('suburb').required = true;
      // document.getElementById('post_code').required = true;
      $('.HereBefore').css('display', '');

    } else if ($(this).val() == 'Yes') {
      $('#section1h').text("1. Name");
      $('.HereBefore').css('display', 'none');
      // $('#middle_name').removeAttr('required');
    } else {

      // document.getElementById('stationLocale').required = false;
      // document.getElementById('yearsInJob').required = false;
      // document.getElementById('street_unit_no').required = false;
      // document.getElementById('street_address').required = false;
      // document.getElementById('suburb').required = false;
      // document.getElementById('post_code').required = false;
      // document.getElementById('rank').removeAttribute("required");
      // document.getElementById('occupation').removeAttribute("required");
    }
  });
  $('#HereBefore').trigger('change');

  // $('#Q8LumpSumIncome').on('change', function () {
  // 	if ($(this).val() == 'No')
  // 		$('.Q8LumpSumIncome').css('display', 'none');
  // 	else
  // 		$('.Q8LumpSumIncome').css('display', 'initial');
  // });
  // $('#Q8LumpSumIncome').trigger('change');
  $('#q5LateTax').on('change', function() {
    if ($(this).val() == 'No')
      $('.q5LateTax').css('display', 'none');
    else
      $('.q5LateTax').css('display', 'initial');
  });
  $('#q5LateTax').trigger('change');

  $('#QspouseForFullYear').on('change', function() {
    if ($(this).val() == 'Yes')
      $('.QspouseForFullYear').css('display', 'none');
    else
      $('.QspouseForFullYear').css('display', 'initial');
  });
  $('#QspouseForFullYear').trigger('change');


  $('#taxType').on('change', function() {
    if ($(this).val() == 'Express') {
      $('.taxType').css('display', 'none');
      $('.block1').css('display', 'none');
      $('.block2').css('display', 'none');

      $('#Q7GovtPayments').on('change', function() {
        if ($(this).val() == 'No')
          $('#govtpayoption').css('display', 'none');
        else
          $('#govtpayoption').css('display', 'none');
      });
      $('#Q7GovtPayments').trigger('change');

      $('#Q8LumpSumIncome').on('change', function() {
        if ($(this).val() == 'No')
          $('.Q8LumpSumIncome').css('display', 'none');
        else
          $('.Q8LumpSumIncome').css('display', 'none');
      });
      $('#Q8LumpSumIncome').trigger('change');

      $('#Q9IncomeStream').on('change', function() {
        if ($(this).val() == 'No')
          $('.Q9IncomeStream').css('display', 'none');
        else
          $('.Q9IncomeStream').css('display', 'none');
      });
      $('#Q9IncomeStream').trigger('change');
    } else if ($(this).val() == 'Standard') {
      $('.taxType').css('display', 'initial');
      $('.block1').css('display', 'none');
      $('.block2').css('display', 'initial');


      $('#Q7GovtPayments').on('change', function() {
        if ($(this).val() == 'No')
          $('#govtpayoption').css('display', 'none');
        else
          $('#govtpayoption').css('display', 'initial');
      });
      $('#Q7GovtPayments').trigger('change');

      $('#Q8LumpSumIncome').on('change', function() {
        if ($(this).val() == 'No')
          $('.Q8LumpSumIncome').css('display', 'none');
        else
          $('.Q8LumpSumIncome').css('display', 'initial');
      });
      $('#Q8LumpSumIncome').trigger('change');

      $('#Q9IncomeStream').on('change', function() {
        if ($(this).val() == 'No')
          $('.Q9IncomeStream').css('display', 'none');
        else
          $('.Q9IncomeStream').css('display', 'none');
      });
      $('#Q9IncomeStream').trigger('change');
    } else {
      $('.taxType').css('display', 'initial');
      $('.block1').css('display', 'initial');
      $('.block2').css('display', 'initial');

      $('#Q7GovtPayments').on('change', function() {
        if ($(this).val() == 'No')
          $('#govtpayoption').css('display', 'none');
        else
          $('#govtpayoption').css('display', 'initial');
      });
      $('#Q7GovtPayments').trigger('change');

      $('#Q8LumpSumIncome').on('change', function() {
        if ($(this).val() == 'No')
          $('.Q8LumpSumIncome').css('display', 'none');
        else
          $('.Q8LumpSumIncome').css('display', 'initial');
      });
      $('#Q8LumpSumIncome').trigger('change');

      $('#Q9IncomeStream').on('change', function() {
        if ($(this).val() == 'No')
          $('.Q9IncomeStream').css('display', 'none');
        else
          $('.Q9IncomeStream').css('display', 'initial');
      });
      $('#Q9IncomeStream').trigger('change');
    }
  });
  $('#taxType').trigger('change');

  
  /*
   * This is where things actually get started. We find the form element using
   * its class name, then attach the `handleFormSubmit()` function to the
   * `submit` event.
   */
  const form = document.getElementById('test');
  form.addEventListener('submit', handleFormSubmit);
});
// function move1() {
//     var elem = document.getElementById("myBar");
//     var width = 1;
//     var id = setInterval(frame, 10);
//
//     function frame() {
//         if (width >= 16) {
//             clearInterval(id);
//         } else {
//             width++;
//             elem.style.width = width + '%';
//         }
//     }
// }

// function move2() {
//     var elem = document.getElementById("myBar");
//     var width = 16;
//     var id = setInterval(frame, 10);
//
//     function frame() {
//         if (width >= 32) {
//             clearInterval(id);
//         } else {
//             width++;
//             elem.style.width = width + '%';
//         }
//     }
// }

// function move3() {
//     var elem = document.getElementById("myBar");
//     var width = 32;
//     var id = setInterval(frame, 10);
//
//     function frame() {
//         if (width >= 48) {
//             clearInterval(id);
//         } else {
//             width++;
//             elem.style.width = width + '%';
//         }
//     }
// }
//
// function move4() {
//     var elem = document.getElementById("myBar");
//     var width = 48;
//     var id = setInterval(frame, 10);
//
//     function frame() {
//         if (width >= 64) {
//             clearInterval(id);
//         } else {
//             width++;
//             elem.style.width = width + '%';
//         }
//     }
// }
//
// function move5() {
//     var elem = document.getElementById("myBar");
//     var width = 64;
//     var id = setInterval(frame, 10);
//
//     function frame() {
//         if (width >= 80) {
//             clearInterval(id);
//         } else {
//             width++;
//             elem.style.width = width + '%';
//         }
//     }
// }
//
// function move6() {
//     var elem = document.getElementById("myBar");
//     var width = 84;
//     var id = setInterval(frame, 10);
//
//     function frame() {
//         if (width >= 100) {
//             clearInterval(id);
//         } else {
//             width++;
//             elem.style.width = width + '%';
//         }
//     }
// }

var divs = ["Menu1", "Menu2", "Menu3", "Menu4", "Menu5", "Menu6"];
var visibleDivId = null;

function toggleVisibility(divId) {
  if (visibleDivId === divId) {
    //visibleDivId = null;
  } else {
    visibleDivId = divId;
  }
  hideNonVisibleDivs();
}

function hideNonVisibleDivs() {
  var i, divId, div;
  for (i = 0; i < divs.length; i++) {
    divId = divs[i];
    div = document.getElementById(divId);
    if (visibleDivId === divId) {
      div.style.display = "block";
    } else {
      div.style.display = "none";
    }
  }
}





// <!....................................Tax Calculations..................................................................>
function addGrandTotDeductions() {
  // <!..................D1 Car............>
  var val200 = parseInt(document.getElementById("TotalCarKms").value);
  // <!..................D2 Travel.............>
  var val201 = parseInt(document.getElementById("answer10").value);
  // <!..................D3 Uniform...........>
  var val202 = parseInt(document.getElementById("answer11").value);
  // <!..................D4 Self educ..........>
  var val203 = parseInt(document.getElementById("answer12").value);
  // <!..................D5 Other Main..........>
  var val204 = parseInt(document.getElementById("answer13").value);
  // <!..................D5 Other Minor.........>
  var val205 = parseInt(document.getElementById("answer14").value);
  // <!..................D5 Mobile..............>
  var val206 = parseInt(document.getElementById("result100").value);
  // <!..................D5 Internet............>
  var val207 = parseInt(document.getElementById("result101").value);
  // <!..................D5 Capital..............>
  var val208 = parseInt(document.getElementById("result105").value);
  // <!..................D8/9/10 Non Work Other............>
  var val209 = parseInt(document.getElementById("answer15").value);

  var ansZ = document.getElementById("TotAllDeductions");
  ansZ.value = val200 + val201 + val202 + val203 + val204 + val205 + val206 + val207 + val208 + val209;
}

// <!....................................Tax Calculations..................................................................>
// <!....................................Tax Calculations..................................................................>
function addGrandTotDeductions() {
  // <!..................D1 Car............>
  var val200 = parseInt(document.getElementById("TotalCarKms2").value);
  // <!..................D2 Travel.............>
  var val201 = parseInt(document.getElementById("answer10").value);
  // <!..................D3 Uniform...........>
  var val202 = parseInt(document.getElementById("answer11").value);
  // <!..................D4 Self educ..........>
  var val203 = parseInt(document.getElementById("answer12").value);
  // <!..................D5 Other Main..........>
  var val204 = parseInt(document.getElementById("answer13").value);
  // <!..................D5 Other Minor.........>
  var val205 = parseInt(document.getElementById("answer14").value);
  // <!..................D5 Mobile..............>
  var val206 = parseInt(document.getElementById("result100").value);
  // <!..................D5 Internet............>
  var val207 = parseInt(document.getElementById("result101").value);
  // <!..................D5 Capital..............>
  var val208 = parseInt(document.getElementById("result105").value);
  // <!..................D8/9/10 Non Work Other............>
  var val209 = parseInt(document.getElementById("answer15").value);


  var ansZ = document.getElementById("TotAllDeductions");
  ansZ.value = val200 + val201 + val202 + val203 + val204 + val205 + val206 + val207 + val208 + val209;
}

// <!...............................................................Start All......Scripts.........................................................................................>
// <!.....................................................................Script 1...........................................................................................>
function addNumbers() {
  var val1 = parseInt(document.getElementById("salary1").value);
  var val2 = parseInt(document.getElementById("allow1").value);

  var val6 = parseInt(document.getElementById("salary2").value);
  var val7 = parseInt(document.getElementById("allow2").value);

  var val11 = parseInt(document.getElementById("bank_interest").value);
  var val12 = parseInt(document.getElementById("unfranked").value);
  var val13 = parseInt(document.getElementById("franked").value);
  var val14 = parseInt(document.getElementById("imp_credit").value);


  var val15 = parseInt(document.getElementById("lump_sum_amount").value);
  var val16 = parseInt(document.getElementById("less_tax_with_held_Lump_Sum").value);

  var val17 = parseInt(document.getElementById("otherincome").value);
  var val18 = parseInt(document.getElementById("otherincometax").value);

  var val19 = parseInt(document.getElementById("govtpay").value);
  var val20 = parseInt(document.getElementById("govtpaytax").value);

  var val21 = parseInt(document.getElementById("income_stream_amount").value);
  var val22 = parseInt(document.getElementById("less_tax_with_held_inc_stream").value);

  // var val23 = parseInt(document.getElementById("payg-tax").value);

  // var val3 = parseInt(document.getElementById("payg1").value);
  // var val8 = parseInt(document.getElementById("payg2").value);

  // var val4 = parseInt(document.getElementById("super1").value);
  // var val9 = parseInt(document.getElementById("super2").value);

  // var val5 = parseInt(document.getElementById("rfbt1").value);
  // var val10 = parseInt(document.getElementById("rfbt2").value);

  var ansA = document.getElementById("answer1");
  // ansA.value = val1 + val2 + val3 + val4 + val5 + val6 + val7 + val8 + val9 + val10 + val11 + val12 + val13 + val14;
  // ansA.value = val1 + val2 + val6 + val7 + val11 + val12 + val13 + val14;
  var sumOfAllIncome = val1 + val2 + val6 + val7 + val11 + val12 + val13 + val14 + val15 + val16 + val17 + val18 + val19 + val20 + val21 + val22 ;
  // console.log("All Income: " + sumOfAllIncome);
  ansA.value = sumOfAllIncome;
  taxIncome();

}

// <!.................................................................Script 2...................................................................>
function addPaygTax() {
  /*var val3 = parseInt(document.getElementById("payg1").value);
  var val8 = parseInt(document.getElementById("payg2").value);

  var ansB = document.getElementById("answer2");
  ansB.value = val3 + val8;*/
  addNumbers();
}

// <!.............................................Script 3.....Super totals Details...............................................................>
function addSuper() {
  /*var val4 = parseInt(document.getElementById("super1").value);
  var val9 = parseInt(document.getElementById("super2").value);

  var ansC = document.getElementById("answer3");
  ansC.value = val4 + val9;*/
  addNumbers();
}

// <!................................RFBT totals Details......Script 4.......................>
function addRFBT() {
  /*var val5 = parseInt(document.getElementById("rfbt1").value);
  var val10 = parseInt(document.getElementById("rfbt2").value);

  var ansD = document.getElementById("answer4");
  ansD.value = val5 + val10;*/
  addNumbers();
}

// <!.................................Total TFN taxes withheld Details.etc.......Script 5.........................>
function addTotalTFN() {
  var val16 = parseInt(document.getElementById("bank_tfn").value);
  var val17 = parseInt(document.getElementById("share_tfn").value);

  // var val18 = parseInt(document.getElementById("other_tfn").value);

  var ansE = document.getElementById("answer5");
  ansE.value = val16 + val17;
}

// <!..................................................Addition sub total Scripts............Script 6...........................................................>
function addD2Travel() {
  var val20 = parseInt(document.getElementById("accomodation_meals").value);
  var val21 = parseInt(document.getElementById("carparking").value);
  var val22 = parseInt(document.getElementById("road_tolls").value);
  var val23 = parseInt(document.getElementById("academy_costs").value);
  var val24 = parseInt(document.getElementById("air_fares").value);

  var ansH = document.getElementById("answer10");
  ansH.value = val20 + val21 + val22 + val23 + val24;
  addingD4PageTotal();
  addAllDeduction();
}

// <!....................................................................................Script 7.......................................>
function addD3Uniform() {

  var val25 = parseInt(document.getElementById("value25").value);
  var val26 = parseInt(document.getElementById("dry_cleaning").value);
  var val27 = parseInt(document.getElementById("hats_gloves_thermals").value);
  var val28 = parseInt(document.getElementById("pants_shirts").value);
  var val29 = parseInt(document.getElementById("repairs").value);

  var ansI = document.getElementById("answer11");
  ansI.value = val25 + val26 + val27 + val28 + val29;
  // ansI.value = val26 + val27 + val28 + val29;
  addingD4PageTotal();
  addAllDeduction();
}

// <!.........................................................................Script 8.....................................................>
function addD3SelfEducation() {
  var val30 = parseInt(document.getElementById("course_fees").value);
  var val31 = parseInt(document.getElementById("books_references").value);
  var val32 = parseInt(document.getElementById("depreciation").value);
  var val33 = parseInt(document.getElementById("kms_travel").value);
  var val34 = parseInt(document.getElementById("other").value);

  var ansJ = document.getElementById("answer12");
  ansJ.value = val30 + val31 + val32 + val33 + val34;
  addingD4PageTotal();
  addAllDeduction();
}

// <!...................................................................D2-D4...........Script 9.........................................>
function addD5Other_Main() {
  var val35 = parseInt(document.getElementById("union_assoc_fees").value);
  var val36 = parseInt(document.getElementById("office_stationary").value);
  var val37 = parseInt(document.getElementById("technology").value);
  var val38 = parseInt(document.getElementById("tactical_gear").value);
  var val39 = parseInt(document.getElementById("gun_training").value);

  var ansK = document.getElementById("answer13");
  ansK.value = val35 + val36 + val37 + val38 + val39;
  addingD4PageTotal();
  addAllDeduction();
}

// <!...................................................................D2-D4..............Script 10........................................>
function addD5Other_Misc() {
  var val40 = parseInt(document.getElementById("police_jnls").value);
  var val41 = parseInt(document.getElementById("other_miscell").value);
  var val42 = parseInt(document.getElementById("overtimeCourt_meals").value);
  var val43 = parseInt(document.getElementById("protection_first_aid").value);
  var val44 = parseInt(document.getElementById("fitness_peak_level").value);

  var ansL = document.getElementById("answer14");
  ansL.value = val40 + val41 + val42 + val43 + val44;
  addingD4PageTotal();
  addAllDeduction();
}

// <!...................................................................D2-D4................Script 11...................................>
function addNonWorkDeduct() {
  var val60 = parseInt(document.getElementById("donations_charity").value);
  var val61 = parseInt(document.getElementById("tax_agent_fee").value);
  var val62 = parseInt(document.getElementById("other_supplemental_costs").value);
  var val63 = parseInt(document.getElementById("income_protection").value);

  var ansM = document.getElementById("d5_d15_page_total");
  ansM.value = val60 + val61 + val62 + val63;
  addAllDeduction();
}

// <!....................................Tax Calculations......................Script12.....................................>
function addGrandTotDeductions() {
  // <!..................D1 Car............>
  var val200 = parseInt(document.getElementById("TotalCarKms").value);
  // <!..................D2 Travel.............>
  var val201 = parseInt(document.getElementById("answer10").value);
  // <!..................D3 Uniform...........>
  var val202 = parseInt(document.getElementById("answer11").value);
  // <!..................D4 Self educ..........>
  var val203 = parseInt(document.getElementById("answer12").value);
  // <!..................D5 Other Main..........>
  var val204 = parseInt(document.getElementById("answer13").value);
  // <!..................D5 Other Minor.........>
  var val205 = parseInt(document.getElementById("answer14").value);
  // <!..................D5 Mobile..............>
  var val206 = parseInt(document.getElementById("result100").value);
  // <!..................D5 Internet............>
  var val207 = parseInt(document.getElementById("result101").value);
  // <!..................D5 Capital..............>
  var val208 = parseInt(document.getElementById("result105").value);
  // <!..................D8/9/10 Non Work Other............>
  var val209 = parseInt(document.getElementById("answer15").value);

  var ansP = document.getElementById("TotAllDeductions");
  ansP.value = val200 + val201 + val202 + val203 + val204 + val205 + val206 + val207 + val208 + val209;
}

// <!....................................Tax Calculations...........................Script 13..........................>
function addGrandTotDeductions() {
  // <!..................D1 Car............>
  var val200 = parseInt(document.getElementById("TotalCarKms2").value);
  // <!..................D2 Travel.............>
  var val201 = parseInt(document.getElementById("answer10").value);
  // <!..................D3 Uniform...........>
  var val202 = parseInt(document.getElementById("answer11").value);
  // <!..................D4 Self educ..........>
  var val203 = parseInt(document.getElementById("answer12").value);
  // <!..................D5 Other Main..........>
  var val204 = parseInt(document.getElementById("answer13").value);
  // <!..................D5 Other Minor.........>
  var val205 = parseInt(document.getElementById("answer14").value);
  // <!..................D5 Mobile..............>
  var val206 = parseInt(document.getElementById("result100").value);
  // <!..................D5 Internet............>
  var val207 = parseInt(document.getElementById("result101").value);
  // <!..................D5 Capital..............>
  var val208 = parseInt(document.getElementById("result105").value);
  // <!..................D8/9/10 Non Work Other............>
  var val209 = parseInt(document.getElementById("answer15").value);

  var ansZ = document.getElementById("TotAllDeductions");
  ansZ.value = val200 + val201 + val202 + val203 + val204 + val205 + val206 + val207 + val208 + val209;
}

// <!..................................................Car Kms Calc...............................................>
function calculateKm() {
  var myCarKms = document.getElementById('CarKms').value;
  var myKmRate = document.getElementById('KmRate').value;

  var result = document.getElementById('TotalCarKms');
  var myResult = myCarKms * myKmRate;
  result.value = myResult;
  addAllDeduction();
}

// <!.............................................Internet used for work Claim...............................................>
function MultiplyInternet() {
  var myInternetCost = document.getElementById('internet_monthly_plan_cost').value;
  var myInternetbyTwelve = document.getElementById('InternetbyTwelve').value;
  var myInternetUse = document.getElementById('InternetUse').value;

  var result100 = document.getElementById('result101');

  var myResult100 = myInternetCost * myInternetbyTwelve * myInternetUse;
  result100.value = myResult100;
  addAllDeduction();

}

//    <!................................................Mobile Phone Claim...............................................>
function MultiplyMobile() {
  var myMobileCost = document.getElementById('mobile_monthly_plan_cost').value;
  var myMobilebyTwelve = document.getElementById('MobilebyTwelve').value;
  var myMobileUse = document.getElementById('MobileUse').value;

  var result100 = document.getElementById('result100');

  var myResult100 = myMobileCost * myMobilebyTwelve * myMobileUse;
  result100.value = myResult100;
  addAllDeduction();

}

// <!.....................................................................Capital Depec Items..............................................................>
function MultiplyCapital() {
  var myCapitalCost = document.getElementById('purchase_price_amount').value;
  var myCapitalProRataDate = document.getElementById('CapitalProRataDate').value;
  var myCapitalRate = document.getElementById('CapitalRate').value;

  var result100 = document.getElementById('result105');

  var myResult100 = myCapitalCost * myCapitalProRataDate * myCapitalRate;
  result100.value = myResult100;
  addAllDeduction();
}

// block 1 code
function block1() {
  var val1 = parseInt(document.getElementById("item1").value);
  var val2 = parseInt(document.getElementById("item2").value);
  var val3 = parseInt(document.getElementById("item3").value);
  var val4 = parseInt(document.getElementById("item4").value);
  var val5 = parseInt(document.getElementById("item5").value);
  var val6 = parseInt(document.getElementById("item6").value);
  var val7 = parseInt(document.getElementById("item7").value);
  var val8 = parseInt(document.getElementById("item8").value);
  var val9 = parseInt(document.getElementById("item9").value);
  var val10 = parseInt(document.getElementById("item10").value);
  var val11 = parseInt(document.getElementById("item11").value);
  var val12 = parseInt(document.getElementById("item12").value);
  var val13 = parseInt(document.getElementById("item13").value);
  var val14 = parseInt(document.getElementById("item14").value);
  var val15 = parseInt(document.getElementById("item15").value);
  var val16 = parseInt(document.getElementById("item16").value);
  var val17 = parseInt(document.getElementById("item17").value);
  var val18 = parseInt(document.getElementById("item18").value);
  var val19 = parseInt(document.getElementById("item19").value);
  var val20 = parseInt(document.getElementById("item20").value);
  var val21 = parseInt(document.getElementById("item21").value);
  var val22 = parseInt(document.getElementById("item22").value);
  var val23 = parseInt(document.getElementById("item23").value);
  var val24 = parseInt(document.getElementById("item24").value);
  var val25 = parseInt(document.getElementById("item25").value);

  var ansL = document.getElementById("block1answer");
  ansL.value = val1 + val2 + val3 + val4 + val5 + val6 + val7 + val8 + val9 + val10 + val11 + val12 + val13 +
    val14 +
    val15 + val16 + val17 + val18 + val19 + val20 + val21 + val22 + val23 + val24 + val25;
  addAllDeduction();

}

// block 2 code
function block2() {
  var val1 = parseInt(document.getElementById("item26").value);
  var val2 = parseInt(document.getElementById("item27").value);
  var val3 = parseInt(document.getElementById("item28").value);
  var val4 = parseInt(document.getElementById("item29").value);
  var val5 = parseInt(document.getElementById("item30").value);
  var val6 = parseInt(document.getElementById("item31").value);
  var val7 = parseInt(document.getElementById("item32").value);
  var val8 = parseInt(document.getElementById("item33").value);
  var val9 = parseInt(document.getElementById("item34").value);
  var val10 = parseInt(document.getElementById("item35").value);
  var val11 = parseInt(document.getElementById("item36").value);
  var val12 = parseInt(document.getElementById("item37").value);
  var val13 = parseInt(document.getElementById("item38").value);
  var val14 = parseInt(document.getElementById("item39").value);
  var val15 = parseInt(document.getElementById("item40").value);
  var val16 = parseInt(document.getElementById("item41").value);
  var val17 = parseInt(document.getElementById("item42").value);
  var val18 = parseInt(document.getElementById("item43").value);
  var val19 = parseInt(document.getElementById("item44").value);
  var val20 = parseInt(document.getElementById("item45").value);
  var val21 = parseInt(document.getElementById("item46").value);
  var val22 = parseInt(document.getElementById("item47").value);
  var val23 = parseInt(document.getElementById("item48").value);
  var val24 = parseInt(document.getElementById("item49").value);
  var val25 = parseInt(document.getElementById("item50").value);

  var ansL = document.getElementById("block2answer");
  ansL.value = val1 + val2 + val3 + val4 + val5 + val6 + val7 + val8 + val9 + val10 + val11 + val12 + val13 +
    val14 +
    val15 + val16 + val17 + val18 + val19 + val20 + val21 + val22 + val23 + val24 + val25;
  addAllDeduction();

}

// D4 page total

function addingD4PageTotal() {
  // TotalCarKms d1 answer10 d2 answer11 d3 answer12 d4
  var d1 = document.getElementById('TotalCarKms').value;
  var d2 = document.getElementById('answer10').value;
  var d3 = document.getElementById('answer11').value;
  var d4 = document.getElementById('answer12').value;

  var resultD1toD4 = document.getElementById('d1tod4');

  var myresultd1tod4 = parseFloat(d1) + parseFloat(d2) + parseFloat(d3) + parseFloat(d4);
  resultD1toD4.value = myresultd1tod4;
  addAllDeduction();

}

function addAllDeduction() {
  var d1 = parseFloat(document.getElementById('TotalCarKms').value);
  var d2 = parseFloat(document.getElementById('answer10').value);
  var d3 = parseFloat(document.getElementById('answer11').value);
  var d4 = parseFloat(document.getElementById('answer12').value);
  var d5 = parseFloat(document.getElementById('answer13').value);
  var d6 = parseFloat(document.getElementById('answer14').value);
  var d7 = parseFloat(document.getElementById('result100').value);
  var d8 = parseFloat(document.getElementById('result101').value);
  var d9 = parseFloat(document.getElementById('result105').value);
  var d10 = parseFloat(document.getElementById('d5_d15_page_total').value);
  var d11 = parseFloat(document.getElementById('block1answer').value);
  var d12 = parseFloat(document.getElementById('block2answer').value);
  var val25 = parseInt(document.getElementById("value25").value);

  var resultAll = document.getElementById('allDeductions');

  var myresultAll = d1 + val25 + d2 + d3 + d4 + d5 + d6 + d7 + d8 + d9 + d10 + d11 + d12;

  resultAll.value = myresultAll;
  // console.log("All Deduction: " + myresultAll);
  taxIncome();
}

function taxIncome() {
  var totalIncome = parseFloat(document.getElementById('answer1').value);
  var totalAllDeduction = parseInt(document.getElementById('allDeductions').value);
  var resultAll = document.getElementById('taxable_income');
  if (totalIncome > 150) {
    resultAll.value = totalIncome - totalAllDeduction;
  } else {
    resultAll.value = 0;
  }
}
