var getUrlParameter = function(prop){
var params = {};
    var search = decodeURIComponent( window.location.href.slice( window.location.href.indexOf( '?' ) + 1 ) );
    var definitions = search.split( '&' );

    definitions.forEach( function( val, key ) {
        var parts = val.split( '=', 2 );
        params[ parts[ 0 ] ] = parts[ 1 ];
    } );

    return ( prop && prop in params ) ? params[ prop ] : params;
}

window.sendData = function(listData, url){
  listData["OccupationCode"] = "441312";
  listData["WhereFrom"] = "Online";

  var myvar = null;

  url = "https://policetaxssl.com:81/tax";

  var valId= getUrlParameter('returnval');

  $.ajax({
    url: 'email.php', // point to server-side PHP script
    dataType: 'text',  // what to expect back from the PHP script, if anything
    cache: false,
    contentType: false,
    processData: false,
    data: window.clientEmail,
    type: 'post',
    success: function(php_script_response){
      //alert(php_script_response);
      //window.location.href = "https://www.policetax.com.au/online-tax-completed.html";
    }
  });

  $.post("editData.php", {id: valId, filemakerData: JSON.stringify(listData), from: "submit"}, function(response){
  });

  $.ajax({
    url: url,
    type: 'post',
    data: listData,
    headers: {
      "Access-Control-Allow-Origin": 'http://www.itechsol.com.au'
    },
    dataType: 'json',
    success: function(data) {
      returnData = JSON.parse(data.response.data[0].fieldData.Json_ReSend_EditSummary);
      //console.log(returnData);
      var interestAndDividend = 0;
      var basicDetails = "<html><body><div>";
      basicDetails += "<span style='background-color: black;color:black;'><h4>------------ File Maker Result -------------</h4></span> \n";
      
      basicDetails += "<span style='background-color: black;color:black;'><h4>Basic Details</h4></span> \n";
      
      var taxParticularsAndCalculations = "<span style='background-color: black;color:black;'><h4>Tax Particulars & Calculations</h4></span> \n";
        
      var taxCalc = "<span style='background-color: black;color:black;'><h4>Tax Calculations</h4></span> \n";
      
      var refundCalc = "<span style='background-color: black;color:black;'><h4>Refund Calculations</h4></span> \n";
      var calculationDataList = {};var clientDetails = {};
      $.each(returnData, function(i, v){
        if(i.indexOf("FirstName") != -1){
          $(".result-page").find("#firstName").val(v);
          $(".modalMessage").find("#firstName").val(v);

          if(v != parseInt(0)){
            basicDetails += "FirstName : " + v + " <br/>\n";
            clientDetails[1] = "FirstName : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Surname") != -1){
          $(".result-page").find("#familyName").val(v);
          $(".modalMessage").find("#familyName").val(v);
          if(v != parseInt(0)){
            basicDetails += "Surname : " + v + " <br/>\n";
            clientDetails[2] = "Surname : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("TFN") != -1){
          $(".result-page").find("#tfn").val(v);
          $(".modalMessage").find("#tfn").val(v);

          if(v != parseInt(0)){
            basicDetails += "TFN : " + v + " <br/>\n";
            clientDetails[3] = "TFN : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Tax Year") != -1){
          $(".result-page").find("#taxYear").val(v);
          $(".modalMessage").find("#taxYear").val(v);

          if(v != parseInt(0)){
            basicDetails += "Tax Year : " + v + " <br/>\n";
            clientDetails[4] = "Tax Year : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("My Tax Refund") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#taxRefundable").parent().parent().hide();
          }
          $(".result-page").find("#taxRefund").val(v);
          $(".modalMessage").find("#taxRefund").val(v);
          $(".result-page").find("#taxRefundable").val(v);

          if(v != parseInt(0)){
            basicDetails += "Tax Refund : " + v + " <br/>\n";
            calculationDataList["10"] = "<b>Tax Refund : </b> " + v + " <br/>\n";
            clientDetails[5] = "Tax Refund : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Occupation_Code") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#occupationCode").parent().parent().hide();
          }
          $(".result-page").find("#occupationCode").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Occupation Code : " + v + " <br/>\n";
            calculationDataList["1"] = "Occupation Code : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Job No") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#jobNumber").parent().parent().hide();
          }
          $(".result-page").find("#jobNumber").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Job No : " + v + " <br/>\n";
            basicDetails += "<span><b> Job No </b>: " + v + "</span> <br/>\n";
            clientDetails[0] = "<span><b> Job No </b>: " + v + "</span> <br/>\n";
          }
        }
        if(i.indexOf("Taxable Income") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#taxableIncome").parent().parent().hide();
          }
          $(".result-page").find("#taxableIncome").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Taxable Income : " + v + " <br/>\n";
            calculationDataList["4"] = "Taxable Income : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Less Imputation Credits") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#imputationCredits").parent().parent().hide();
          }
          $(".result-page").find("#imputationCredits").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Less Imputation Credits : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Potential Tax payable") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#taxPayable").parent().parent().hide();
          }
          $(".result-page").find("#taxPayable").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Potential Tax payable : " + v + " <br/>\n";
            calculationDataList["8"] = "Potential Tax payable : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Less Tax Withheld from Salaries") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#witheldSalaries").parent().parent().hide();
          }
          $(".result-page").find("#witheldSalaries").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Less Tax Withheld from Salaries : " + v + " <br/>\n";
            calculationDataList["9"] = "Less Tax Withheld from Salaries : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Raw Tax Calculated") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#rawTaxCalc").parent().parent().hide();
          }
          $(".result-page").find("#rawTaxCalc").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Raw Tax Calculated : " + v + " <br/>\n";
            calculationDataList["5"] = "Raw Tax Calculated : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Total Income") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#incomeSourceTotal").parent().parent().hide();
          }
          $(".result-page").find("#incomeSourceTotal").val(v);
          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Total Income : " + v + " <br/>\n";
            calculationDataList["2"] = "Total Income : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Less All Tax Deductions") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#taxDeductions").parent().parent().hide();
          }
          $(".result-page").find("#taxDeductions").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Less All Tax Deductions : " + v + " <br/>\n";
          }
            calculationDataList["3"] = "Less All Tax Deductions : " + v + " <br/>\n";
        }

        if(i.indexOf("Add  Medicare Levy Standard") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#medicareLevy").parent().parent().hide();
          }
          $(".result-page").find("#medicareLevy").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Add Medicare Levy Standard : " + v + " <br/>\n";
            calculationDataList["6"] = "Add Medicare Levy Standard : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Add Medicare Levy Surcharge") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#medicareLevySurcharge").parent().parent().hide();
          }
          $(".result-page").find("#medicareLevySurcharge").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Add Medicare Levy Surcharge : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Add Hecs/Help Debt Repay") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#helpDebt").parent().parent().hide();
          }
          $(".result-page").find("#helpDebt").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Add Hecs/Help Debt Repay : " + v + " <br/>\n";
          }
            calculationDataList["7"] = "Hecs Debt : " + v + " <br/>\n";
        }
        if(i.indexOf("Less Arrears Tax Withheld") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#arrearsTaxWithheld").parent().parent().hide();
          }
          $(".result-page").find("#arrearsTaxWithheld").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Less Arrears Tax Withheld : " + v + " <br/>\n";
          }
        }

        if(i.indexOf("Less Dividend TFN tax Withheld") != -1){
          interestAndDividend += parseInt(v);
        }

        if(i.indexOf("Less Interest TFN tax Withheld ") != -1){
          interestAndDividend += parseInt(v);
            if(interestAndDividend == parseInt(0)){
              $(".result-page").find("#tfnTaxInterestDividend").parent().parent().hide();
            }
          $(".result-page").find("#tfnTaxInterestDividend").val(interestAndDividend);

          if(interestAndDividend != parseInt(0)){
            taxParticularsAndCalculations += "Less Interest TFN tax Withheld : " + interestAndDividend + " <br/>\n";
          }
        }
        if(i.indexOf("Less Low Income Rebates") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#lessLowIncomeRebates").parent().parent().hide();
          }
          $(".result-page").find("#lessLowIncomeRebates").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Less Low Income Rebates : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("PH Insurance Rebate+ or - ") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#PHInsuranceRebates").parent().parent().hide();
          }
          $(".result-page").find("#PHInsuranceRebates").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "PH Insurance Rebate+ or - : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Less Other Refundable Credits") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#lessOtherRefundableCredits").parent().parent().hide();
          }
          $(".result-page").find("#lessOtherRefundableCredits").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Less Other Refundable Credits : " + v + " <br/>\n";
          }
        }
        if(i.indexOf("Less Quarterly PAYG Installments") != -1){
          if(v == parseInt(0)){
            $(".result-page").find("#quarterPAYGTaxInstall").parent().parent().hide();
          }
          $(".result-page").find("#quarterPAYGTaxInstall").val(v);

          if(v != parseInt(0)){
            taxParticularsAndCalculations += "Less Quarterly PAYG Installments : " + v + " <br/>\n";
          }
        }

      });
        
      basicDetails = "<html><body><div>";
      basicDetails += "<span style='background-color: black;color:black;'><h4>------------ File Maker Result -------------</h4></span> \n";
      
      basicDetails += "<span style='background-color: black;color:black;'><h4>Basic Details</h4></span> \n";
      
      basicDetails += clientDetails[0] + clientDetails[1] + clientDetails[2] + calculationDataList["1"] + clientDetails[3] + clientDetails[4] + clientDetails[5];

      taxParticularsAndCalculations = "<span style='background-color: black;color:black;'><h4>Tax Particulars & Calculations</h4></span> \n";
      taxParticularsAndCalculations += calculationDataList["2"] + calculationDataList["3"];
      taxParticularsAndCalculations += calculationDataList["4"] + taxCalc + calculationDataList["5"] + calculationDataList["6"];
      taxParticularsAndCalculations += calculationDataList["7"] + refundCalc + calculationDataList["8"] + calculationDataList["9"] + calculationDataList["10"];
      basicDetails += taxParticularsAndCalculations + "</div></body></html>";
      window.form_data.append("TaxResult", basicDetails);
      //console.log(basicDetails);
      //console.log(window.form_data);
      $("#menu-header").hide();
      $("#banner-section").hide();
      $(".form-data").hide();
      $(".content-val").hide();
      $(".loader").hide();
      $(".loader-msg").hide();
      $("#rotator").rotator();

      $("#valueAdded").val("1");

      $(document).find("#imCell_1").attr("style", "min-height:1045px !important;");
      $(".result-page").show();
      $(".modalMessage").modal();
      myvar = setInterval(function() {
          
      $(".modalMessage").modal();
      }, 12000);

      $(window).unload(function() {
        var answer=confirm("Are you sure you want to leave?");
        if(answer){
          $.ajax({
              url: 'email.php', // point to server-side PHP script
              dataType: 'text',  // what to expect back from the PHP script, if anything
              cache: false,
              contentType: false,
              processData: false,
              data: window.form_data,
              type: 'post',
              success: function(php_script_response){
                //alert(php_script_response);
                window.location.href = "https://www.policetax.com.au/online-tax-completed.html";
              }
          });
        }
      });

      return true;


        // console.log(data.data[0].recordId);
        // var recordId = data.data[0].recordId;
        // $.get("http://10.0.0.157:81/taxget/" + recordId, function(res){
        // 	console.log(res.data[0].fieldData.Json_ReSend_EditSummary);
        // 	// $("#menu-header").hide();
        // 	// $(".form-data").hide();
        // 	// $(".result-page").show();
        // 	return;
        // 	//$("#footer").val(res.data[0].fieldData.Json_ReSend_EditSummary);
        // });
    },
    fail: function(a, b, c) {
      // console.log(a);
      //console.log("failed miserably");
      return false;
    }

  });

  
}

$(document).ready(function(){
  $(".edit-tax").on("click", function(){
    $(".loader").hide();
    $(".loader-msg").hide();
    $(".result-page").hide();
    $("#menu-header").show();
    $(".form-data").show();

    $("#valueAdded").val("0");
    $("#signup-form").show();
    $("#banner-section").show();
    $(".modalMessage").modal('hide');
  });


  $(".final-submit-tax").on("click", function(){
 //console.log(window.form_data);

  var valId= getUrlParameter('returnval');
    $.ajax({
      url: 'email.php', // point to server-side PHP script
      dataType: 'text',  // what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: window.form_data,
      type: 'post',
      success: function(php_script_response){
        //alert(php_script_response);

        $.post("editData.php", {id: valId, from: "finalSubmit"}, function(response){
                  window.location.href = "https://www.policetax.com.au/online-tax-completed.html";
        });
      }
    });
  });
});
