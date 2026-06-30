/**
 * @name Multi-step form - WIP
 * @description Prototype for basic multi-step form
 * @deps jQuery, jQuery Validate
 */

var app = {

  init: function() {
    this.cacheDOM();
    this.setupAria();
    this.nextButton();
    this.prevButton();
    this.validateForm();
    this.eventHandler();
    this.startOver();
    this.editForm();
    this.killEnterKey();
    this.handleStepClicks();
  },

  cacheDOM: function() {

    if ($(".multi-step-form").size() === 0) {
      return;
    }
    this.$formParent = $(".multi-step-form");
    this.$form = this.$formParent.find("form");
    this.$formStepParents = this.$form.find("fieldset"),

    this.$nextButton = this.$form.find(".btn-next");
    this.$prevButton = this.$form.find(".btn-prev");
    this.$editButton = this.$form.find(".btn-edit");
    this.$resetButton = this.$form.find("[type='reset']");

    this.$stepsParent = $(".steps");
    this.$steps = this.$stepsParent.find("button");
    $("body").append("<input type='hidden' id='current-nav' value='1' current-val='' />");
  },

  htmlClasses: {
    activeClass: "active",
    times: 1,
    tableNumber: 1,
    havespouse: 1,
    havevisited: 1,
    hiddenClass: "hidden",
    visibleClass: "visible",
    editFormClass: "edit-form",
    animatedVisibleClass: "animated fadeIn",
    animatedHiddenClass: "animated fadeOut",
    animatingClass: "animating"
  },

  setupAria: function() {
    // var elem = document.querySelector('.js-switch');
    // var init = new Switchery(elem);

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
      var switchery = new Switchery(html);
    });


    $("#datepicker").birthdayPicker({
      "maxAge": 80,
      "minAge": 18,
      "monthFormat": "short",
      "sizeClass": "span3",
      "dateFormat": "dd/mm/yyyy"
    });
    $("#spousedob").birthdayPicker({
      "maxAge": 80,
      "minAge": 18,
      "monthFormat": "short",
      "sizeClass": "span3",
      "dateFormat": "dd/mm/yyyy"
    });
    $("#dateSpouse").birthdayPicker({
      "maxAge": 10,
      "minAge": 0,
      "monthFormat": "short",
      "sizeClass": "span3",
      "dateFormat": "dd/mm/yyyy"
    });
    
    $("#datepicker").find("fieldset").removeClass("hidden");
    $("#dateSpouse").find("fieldset").removeClass("hidden");
    $("#spousedob").find("fieldset").removeClass("hidden");
    // set first parent to visible
    this.$formStepParents.eq(0).attr("aria-hidden", false);

    // set all other parents to hidden
    this.$formStepParents.not(":first").attr("aria-hidden", true);

    // handle aria-expanded on next/prev buttons
    app.handleAriaExpanded();

  },
  eventHandler: function(){

    //pop up extra employers
    $(".add-emp").on("click", function(e){
      e.preventDefault();
      // $("#emplyer-tbl").
      var table_row = "<tr class='" + app.htmlClasses.tableNumber + "_employer emp-data'>";
      table_row += '<td><input type="text" id="employer_' + app.htmlClasses.tableNumber + '" class="employer" value="" onclick="this.select();" autofocus/></td>';
      table_row += '<td><input type="text" id="salary_' + app.htmlClasses.tableNumber + '" oninput="javascript:addNumbers()" class="employer" value="0" onclick="this.select();" /></td>';
      table_row += '<td><input type="text" id="allow_' + app.htmlClasses.tableNumber + '" oninput="javascript:addNumbers()" class="employer" value="0" onclick="this.select();" /></td>';
      table_row += '<td><input type="text" id="payg_' + app.htmlClasses.tableNumber + '" oninput="javascript:addPayG()" class="employer" value="0" onclick="this.select();" /></td>';
      table_row += '<td><input type="text" id="resc_' + app.htmlClasses.tableNumber + '" oninput="javascript:addRESCSuper()" class="employer" value="0" onclick="this.select();" /></td>';
      table_row += '<td><input type="text" id="rfbt_' + app.htmlClasses.tableNumber + '" oninput="javascript:addRFBT()" class="employer" value="0" onclick="this.select();" /></td>';
      table_row += '<td><button class="cancel-emp" style="cursor: pointer;width: 72px;font-size: 13px;">';
      table_row += '<i class="fa fa-times-circle" style="color: #5892fc;font-size: 13px;"></i> Cancel </button></td></tr>';

      $("#emplyer-tbl").append(table_row);

      $(".cancel-emp").on("click", function(e){
        e.preventDefault();
        // console.log("hello world");
        $(this).parent().parent().remove();
        addNumbers();
      });

      app.htmlClasses.tableNumber += 1;
    });

    //pop up extra employers ok button function
    $(".btn-ok-employers").on("click", function(e){
      e.preventDefault();
      if(!app.validate("popUpEmployers")){
        return;
      }

      $(this).parent().parent().parent().parent().hide();
    });

    //pop up extra employers close button function
    $(".close-emp-data").on("click", function(e){
      e.preventDefault();
      $(this).parent().parent().hide();
      $.each($(".emp-data"), function(i, v){
        $(this).remove();
        addNumbers();
        addPayG();
        addRESCSuper();
        addRFBT();
      });
      app.htmlClasses.tableNumber = 1;
    });

    //pop up extra employers cancel button
    $(".btn-cancel-employers").on("click", function(e){
      e.preventDefault();
      $(this).parent().parent().parent().parent().hide();
      $.each($(".emp-data"), function(i, v){
        $(this).remove();
        addNumbers();
        addPayG();
        addRESCSuper();
        addRFBT();
      });
      app.htmlClasses.tableNumber = 1;
    });

    $(document).ready(function(){
      //loading all the iphone like yes no functionality using switchery
      $(".js-switch").on("change", function(e){
        e.preventDefault();
        // console.log($(this).parent().find("span").css('border-color'));
        if(app.htmlClasses.times == 2){
          if($(this).parent().find("span").css('border-color') =='rgb(223, 223, 223)'){
            $(this).parent().find("small").html("Yes");
            
            // Have spouse popup
            if($(this).parent().find("input").attr("id") == "HaveSpouse"){
              var modal = document.getElementById('myModalSpouse');
              modal.style.display = "block";
              // span.onclick = function() {
              //   modal.style.display = "none";
              // }
              $(".birthdayPicker").css("border", "0px");
              $(".spouse-data").show();
              $(".spouse-info").show();
            }else if($(this).parent().find("input").attr("id") == "q5LateTax"){
              //overdue tax 
              $("#no-of-late-years").show();
            }else if ($(this).parent().find("input").attr("id") == "Q10TaxDeduction"){
              //tax deduction question
              $(document).find(".tfn-deduction").css("display", "block");
            }
            
  
          }else{
            $(this).parent().find("small").html("No");
            if($(this).parent().find("input").attr("id") == "HaveSpouse"){
              $("#spouse-firstname").val("");
              $("#spouse-middlename").val("");
              $("#spouse-surname").val("");
              $("#QspouseForFullYear").val("select");
              $("select[name='dateSpouse_birth[month]']").val("0");
              $("select[name='dateSpouse_birth[day]']").val("0");
              $("select[name='dateSpouse_birth[year]']").val("0");
              $("input[name='dateSpouse_birthDay']").val("");
              $("#spouseWantsTaxDone").val("select");
              $("select[name='spousedob_birth[month]']").val("0");
              $("select[name='spousedob_birth[day]']").val("0");
              $("select[name='spousedob_birth[year]']").val("0");
              $("input[name='spousedob_birthDay']").val("");
              $("#no-dependants").val("select");
              $("#taxableincome").val("");
              $("#HaveSpouse").parent().parent().find("label").html("Q. Have a Spouse?");
            }
  
            if($(this).parent().find("input").attr("id") == "q5LateTax"){
              $("#no-of-late-years").hide();
            }
  
            //tax deduction question
            if($(this).parent().find("input").attr("id") == "Q10TaxDeduction"){
              $(document).find(".tfn-deduction").css("display", "none");
            }
          }
        }
        
      });
    });

    // $("#mobile-used").on("change", function(e){
    //   console.log($(this));
    //   $("#mobileWorkPurpose-data").show();
    // });

    ////pop up extra employers dynamically adding employers
    $("#add-employers").on("click", function(e){
      e.preventDefault();
      var modal = document.getElementById('myModalAddEmployers');
      modal.style.display = "block";
      
      if(app.htmlClasses.tableNumber == 1){
        var table_row = "<tr class='" + app.htmlClasses.tableNumber + "_employer emp-data'>";
        table_row += '<td><input type="text" id="employer_' + app.htmlClasses.tableNumber + '" class="employer" value="" onclick="this.select();" autofocus/></td>';
        table_row += '<td><input type="text" id="salary_' + app.htmlClasses.tableNumber + '" oninput="javascript:addNumbers()" class="employer" value="0" onclick="this.select();" /></td>';
        table_row += '<td><input type="text" id="allow_' + app.htmlClasses.tableNumber + '" oninput="javascript:addNumbers()" class="employer" value="0" onclick="this.select();" /></td>';
        table_row += '<td><input type="text" id="payg_' + app.htmlClasses.tableNumber + '" oninput="javascript:addPayG()"  class="employer" value="0" onclick="this.select();" /></td>';
        table_row += '<td><input type="text" id="resc_' + app.htmlClasses.tableNumber + '" oninput="javascript:addRESCSuper()" class="employer" value="0" onclick="this.select();" /></td>';
        table_row += '<td><input type="text" id="rfbt_' + app.htmlClasses.tableNumber + '" oninput="javascript:addRFBT()" class="employer" value="0" onclick="this.select();" /></td>';
        table_row += '<td><button class="cancel-emp" style="cursor: pointer;width: 72px;font-size: 13px;">';
        table_row += '<i class="fa fa-times-circle" style="color: #5892fc;font-size: 13px;"></i> Cancel </button></td></tr>';
  
        $("#emplyer-tbl").append(table_row);

        $(".cancel-emp").on("click", function(e){
          e.preventDefault();
          // console.log("hello world");
          $(this).parent().parent().remove();
          addNumbers();
        });
      }

      $(".employers-data").show();
      // $(".spouse-info").show();
    });

    $("#Q10TaxDeduction").on("change", function(e){
      e.preventDefault();
      if($("#Q10TaxDeduction option:selected").val() == "Yes"){
        $(".tfn-deduction").show();
      }else{
        $(".tfn-deduction").hide();
      }
    });

    $("#mobileWorkPurpose").on("change", function(e){
      e.preventDefault();
      // console.log(document.querySelector('#mobile-used').checked);
      if(document.querySelector('#mobile-used').checked == true){
        $("#mobileWorkPurpose-data").show();
      }else{
        $("#mobileWorkPurpose-data").hide();
      }
    });

    $("#internetWorkPurpose").on("change", function(e){
      e.preventDefault();
      if(document.querySelector('#internet-used').checked == true){
        $("#internetWorkPurpose-data").show();
      }else{
        $("#internetWorkPurpose-data").hide();
      }
    });

    $(".close").on("click", function(e){
      e.preventDefault();
      $(this).parent().parent().hide();
    });

    $(".close-more-deduction").on("click", function(e){
      e.preventDefault();
      $("#item26").val("0");
      $("#item27").val("0");
      $("#item28").val("0");
      $("#item29").val("0");
      $("#item30").val("0");
      $("#item31").val("0");
      $("#item32").val("0");
      $("#item33").val("0");
      $("#item34").val("0");
      $("#item35").val("0");
      $("#item36").val("0");
      $("#item37").val("0");
      $("#item38").val("0");
      $("#item39").val("0");
      $("#item40").val("0");
      $("#item41").val("0");
      $("#item42").val("0");
      $("#item43").val("0");
      $("#item44").val("0");
      $("#item45").val("0");
      $("#item46").val("0");
      $("#item47").val("0");
      $("#item48").val("0");
      $("#item49").val("0");
      $("#item50").val("0");
      $(this).parent().parent().hide();
    });

    $(".close-additional-deduction").on("click", function(e){
      e.preventDefault();
      $("#item1").val("0");
      $("#item2").val("0");
      $("#item3").val("0");
      $("#item4").val("0");
      $("#item5").val("0");
      $("#item6").val("0");
      $("#item7").val("0");
      $("#item8").val("0");
      $("#item9").val("0");
      $("#item10").val("0");
      $("#item11").val("0");
      $("#item12").val("0");
      $("#item13").val("0");
      $("#item14").val("0");
      $("#item15").val("0");
      $("#item16").val("0");
      $("#item17").val("0");
      $("#item18").val("0");
      $("#item19").val("0");
      $("#item20").val("0");
      $("#item21").val("0");
      $("#item22").val("0");
      $("#item23").val("0");
      $("#item24").val("0");
      $("#item25").val("0");
      $(this).parent().parent().hide();
    });

    //tax deduction terms and condition
    $(".agreed-btn").on("click", function(e){
      e.preventDefault();
      $(this).parent().parent().parent().hide();
    });

    $("#additional-tax-deduction").on("click", function(e){
      e.preventDefault();
      var modal = document.getElementById('myModalAdditionalDeduction');
      var span = document.getElementsByClassName("close")[0];
      $(".sub-body").append("<input type='hidden' id='tax-deduction-notice' value='1' />");

      modal.style.display = "block";
      // span.onclick = function() {
      //   modal.style.display = "none";
      // }
      $(".block1").show();

      // When the user clicks anywhere outside of the modal, close it
      // window.onclick = function(event) {
      //   if (event.target == modal) {
      //     modal.style.display = "none";
      //   }
      // }
    });

    $(".btn-edit-spouse").on("click", function(e){
      e.preventDefault();
      console.log("asdasd");
      var modal = document.getElementById('myModalSpouse');
      modal.style.display = "block";
      // span.onclick = function() {
      //   modal.style.display = "none";
      // }
      $(".birthdayPicker").css("border", "0px");
      $(".spouse-data").show();
      $(".spouse-info").show();
    });

    $(".btn-edit-visitor").on("click", function(e){
      e.preventDefault();
      var modal = document.getElementById('myModalFirstTimeVisitor');
      modal.style.display = "block";
      // span.onclick = function() {
      //   modal.style.display = "none";
      // }
      $(".birthdayPicker").css("border", "0px");
      $(".visitor-data").show();
      $("#section1h").html("1. Name");
    });

    $("#QspouseForFullYear").on("change", function(e){
      e.preventDefault();
      if($("#QspouseForFullYear option:selected").val() == "Yes"){
        $("#dateSpouse").parent().parent().show();
      }else{
        $("#dateSpouse").parent().parent().hide();
      }
    });

    $("#more-additional-tax-deduction").on("click", function(e){
      e.preventDefault();
      var modal = document.getElementById('myModalMoreAdditionalDeduction');
      var span = document.getElementsByClassName("close")[0];
      $(".sub-body").append("<input type='hidden' id='additional-tax-deduction-notice' value='1' />");

      modal.style.display = "block";
      // span.onclick = function() {
      //   modal.style.display = "none";
      // }
      $(".block2").show();

      // When the user clicks anywhere outside of the modal, close it
      // window.onclick = function(event) {
      //   if (event.target == modal) {
      //     modal.style.display = "none";
      //   }
      // }
    });
    
    $("#HereBefore").on("change", function(e){
      e.preventDefault();
      if($("#HereBefore option:selected").val() == "No"){
        
        var modal = document.getElementById('myModalFirstTimeVisitor');
        modal.style.display = "block";
        // span.onclick = function() {
        //   modal.style.display = "none";
        // }
        $(".birthdayPicker").css("border", "0px");
        $(".visitor-data").show();
        $("#section1h").html("1. Name");
        // When the user clicks anywhere outside of the modal, close it
        // window.onclick = function(event) {
        //   if (event.target == modal) {
        //     modal.style.display = "none";
        //   }
        // }
      }else{
        $("#OccupationRole").val("select");
        $("#Rank").val("select");
        $("#station_locale").val("");
        $("#years-in-job").val("");
        $("#street-no").val("");
        $("#street-address").val("");
        $("#suburb").val("");
        $("select[name='State']").val("select");
        $("#post-code").val("");
        $("#HereBefore").parent().find("label").html("Been with us before");
      }
    });

    $(".btn-cancel-visitor").on("click", function(e){
      e.preventDefault();
      $(this).parent().parent().parent().parent().hide();
      $("#OccupationRole").val("select");
      $("#Rank").val("select");
      $("#station_locale").val("");
      $("#years-in-job").val("");
      $("#street-no").val("");
      $("#street-address").val("");
      $("#suburb").val("");
      $("select[name='State']").val("select");
      $("#post-code").val("");
      $("#HereBefore").parent().find("label").html("Been with us before");
      $(".btn-edit-visitor").hide();
      // console.log(app.htmlClasses.havevisited);
      app.htmlClasses.havevisited = 1;
      // console.log(app.htmlClasses.havevisited);
      $("#HereBefore").val("Yes");
    });

    $(".btn-cancel").on("click", function(e){
      e.preventDefault();
      $("#spouse-firstname").val("");
      $("#spouse-middlename").val("");
      $("#spouse-surname").val("");
      $("#QspouseForFullYear").val("select");
      $("select[name='dateSpouse_birth[month]']").val("0");
      $("select[name='dateSpouse_birth[day]']").val("0");
      $("select[name='dateSpouse_birth[year]']").val("0");
      $("input[name='dateSpouse_birthDay']").val("");
      $("#spouseWantsTaxDone").val("select");
      $("select[name='spousedob_birth[month]']").val("0");
      $("select[name='spousedob_birth[day]']").val("0");
      $("select[name='spousedob_birth[year]']").val("0");
      $("input[name='spousedob_birthDay']").val("");
      $("#no-dependants").val("select");
      $("#taxableincome").val("");
      $("#HaveSpouse").parent().parent().find("label").html("Q. Have a Spouse?");
      app.htmlClasses.havespouse = 1;
      $(this).parent().parent().parent().parent().hide();
      var special = document.querySelector('#HaveSpouse');
	        //$(special).attr("checked", false);
	        special.checked = false;
        if (typeof Event === 'function' || !document.fireEvent) {
            var event = document.createEvent('HTMLEvents');
            event.initEvent('change', true, true);
            special.dispatchEvent(event);
        } else {
            special.fireEvent('onchange');
        }
    });

    $(".btn-ok-visitor").on("click", function(e){
      e.preventDefault();
      var modal = document.getElementById('myModalFirstTimeVisitor');
      if(!app.validate("popUpVisitor")){
        return;
      }
      $("#section1h").html("1. Name");
      if(app.htmlClasses.havevisited == 1){
        $("#HereBefore").parent().parent().append(" <input type='button' class='btn-edit-visitor' value='Edit' style='cursor:pointer;position: absolute;margin-left: 108px;margin-top: -68px;' />");
        app.htmlClasses.havevisited += 1;
      }
      // $("#HereBefore").parent().parent().append(" <input type='button' class='btn-edit-visitor' value='Edit' style='cursor:pointer;position: absolute;margin-left: 108px;margin-top: -68px;' />");
      $(this).parent().parent().parent().parent().hide();
      // window.onclick = function(event) {
      //   if (event.target == modal) {
      //     modal.style.display = "none";
      //   }
      // }

      $(".btn-edit-visitor").on("click", function(e){
        e.preventDefault();
        var modal = document.getElementById('myModalFirstTimeVisitor');
        modal.style.display = "block";
        // span.onclick = function() {
        //   modal.style.display = "none";
        // }
        $(".birthdayPicker").css("border", "0px");
        $(".visitor-data").show();
        $("#section1h").html("1. Name");
      });
    });
    
    $("#HaveSpouse").on("change", function(e){
      e.preventDefault();
      if($("#HaveSpouse option:selected").val() == "Yes"){
        
        var modal = document.getElementById('myModalSpouse');
        modal.style.display = "block";
        // span.onclick = function() {
        //   modal.style.display = "none";
        // }
        $(".birthdayPicker").css("border", "0px");
        $(".spouse-data").show();
        $(".spouse-info").show();
        // When the user clicks anywhere outside of the modal, close it
        // window.onclick = function(event) {
        //   if (event.target == modal) {
        //     modal.style.display = "none";
        //   }
        // }
      }
    });

    $(".btn-ok").on("click", function(e){
      e.preventDefault();
      var modal = document.getElementById('myModalSpouse');
      if(!app.validate("popUpSpouse")){
        return;
      }
      if(app.htmlClasses.havespouse == 1){
        $("#HaveSpouse").parent().parent().find("label").append(" <button style='cursor:pointer;' type='button' class='btn-edit-spouse'><i class='fa fa-edit'></i>Edit</button>");
        app.htmlClasses.havespouse += 1;
      }
      
      $(this).parent().parent().parent().parent().hide();
      // window.onclick = function(event) {
      //   if (event.target == modal) {
      //     modal.style.display = "none";
      //   }
      // }
      $(".btn-edit-spouse").on("click", function(e){
        e.preventDefault();
        var modal = document.getElementById('myModalSpouse');
        modal.style.display = "block";
        // span.onclick = function() {
        //   modal.style.display = "none";
        // }
        $(".birthdayPicker").css("border", "0px");
        $(".spouse-data").show();
        $(".spouse-info").show();
      });
    });

    $("#agreedOn").on("change", function(e){
      e.preventDefault();
      var modal = document.getElementById('myModal');

                  // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      var check = document.getElementById("agreedOn");

      //When user checked = true
      if (check.checked == true) {
        modal.style.display = "block";
        $("#select-termscondition").val("selected");
      } else {
        modal.style.display = "none";
        $("#select-termscondition").val("");
      }
      // When the user clicks on <span> (x), close the modal
      // span.onclick = function() {
      //   modal.style.display = "none";
      // }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }

    });

    $("#taxType").on("change", function(e){
      e.preventDefault();
      // console.log($(this).val());
      if(($(this).val() != "select")){
        $(".menu-header-right").append('<div class="mui-textfield mui-textfield--float-label textfield-with-label">      <input type="text" onclick="this.select();" name="taxable income" id="taxType_" value="' + $(this).val() + '" readonly="" class="mui--is-not-empty mui--is-untouched mui--is-pristine">      <label>Tax Type</label>    </div>');
        
        $(".header-left").find("h1").html($(this).val() + " Tax");

        $(this).parent().hide();

        if($("#taxType option:selected").val() == "Standard"){
          $("#additional-tax-deduction").show();
          $("#tax-info").val("Standard");
          $("#add-employers").hide();
          $("#add-employers").hide();
          $("#more-additional-tax-deduction").hide();
        }else if($("#taxType option:selected").val() == "Premium Plus"){
          $("#additional-tax-deduction").show();
          $("#add-employers").show();
          $("#more-additional-tax-deduction").show();
          $("#tax-info").val("Premium Plus");
        }else{
          $("#add-employers").hide();
          $("#additional-tax-deduction").hide();
          $("#more-additional-tax-deduction").hide();
        }
      }
    });


    $("button[id='tab-val']").on("click", function(e){
      e.preventDefault();

      var data = parseInt($(this).attr("data-val"));
      var val = "forward";
      if(parseInt($("#current-nav").val()) > data){
        data += 1;
        val = "backward";
      }else{
        data -= 1;
      }

      $.each($(".btn-next"), function(i, v){
        

        if(parseInt($(this).attr("data-val")) == data){
          if(val == "backward"){
            $("#current-nav").val(parseInt($(this).attr("data-val")) - 1);
            var elem = $("#myBar");
            let current = $(this).closest("fieldset")[0]['id'].substr($(this).closest("fieldset")[0]['id'].length - 1);


            let width = ((100 / 6) * (parseFloat(current) - parseFloat(1)));

            if (width < 0) {
              width = 0;
            }
            // elem.style.width = width + '%';
            elem.animate({ width: width + "%" }, 500);

            // grab current step parent and previous parent
            var $this = $(this),
              currentParent = $(this).closest("fieldset"),
              prevParent = currentParent.prev();
            //    width -= 16.33;
            //    elem.style.width = width + '%';
            // hide current step and show previous step
            // no need to validate form here
            
            currentParent.removeClass(app.htmlClasses.visibleClass);
            app.showPrevStep(currentParent, prevParent);
          }else if(val == "forward"){
            if ($(this).closest("fieldset")[0]['id'] == "step-1") {
              if(!app.validate(1)){
                return;
              }

            } else if ($(this).closest("fieldset")[0]['id'] == "step-2") {
              if(!app.validate(1)){
                return;
              }else{
                if(!app.validate(2)){
                  return;
                }
              }
              

            } else if ($(this).closest("fieldset")[0]['id'] == "step-3") {
              if(!app.validate(1)){
                return;
              }else{
                if(!app.validate(2)){
                  return;
                }else{
                  if(!app.validate(3)){
                    return;
                  }
                }
              }
              
            } else if($(this).closest("fieldset")[0]['id'] == "step-4"){

              if(!app.validate(1)){
                return;
              }else{
                if(!app.validate(2)){
                  return;
                }else{
                  if(!app.validate(3)){
                    return;
                  }else{
                    if(!app.validate(4)){
                      return;
                    }
                  }
                }
              }
            } else if($(this).closest("fieldset")[0]['id'] == "step-5"){

              if(!app.validate(1)){
                return;
              }else{
                if(!app.validate(2)){
                  return;
                }else{
                  if(!app.validate(3)){
                    return;
                  }else{
                    if(!app.validate(4)){
                      return;
                    }else{
                      if(!app.validate(5)){
                        return;
                      }
                    }
                  }
                }
              }
            }

            var $this = $(this),
              currentParent = $this.closest("fieldset"),
              nextParent = currentParent.next();

            if (app.checkForValidForm()) {
              var elem = $("#myBar");
              let current = $(this).closest("fieldset")[0]['id'].substr($(this).closest("fieldset")[0]['id'].length - 1);
              let width = ((100 / 6) * (parseFloat(current) + parseFloat(1)));

              if (width > 100) {
                width = 100;
              }
              // elem.css("width", "" + width + "%");
              elem.animate({ width: width + "%" }, 500);
              currentParent.removeClass(app.htmlClasses.visibleClass);
              app.showNextStep(currentParent, nextParent);

              $("#current-nav").val(parseInt($(this).attr("data-val")) + 1);
            }
          }
          
        }
      });
    });
  },

  nextButton: function() {

    this.$nextButton.on("click", function(e) {
      $("#current-nav").val(parseInt($(this).attr("data-val")) + 1);
      if ($(this).closest("fieldset")[0]['id'] == "step-1") {
        if(!app.validate(1)){
          return;
        }

      }

      if ($(this).closest("fieldset")[0]['id'] == "step-2") {
        if(!app.validate(1)){
          return;
        }else{
          if(!app.validate(2)){
            return;
          }
        }

      }

      if ($(this).closest("fieldset")[0]['id'] == "step-3") {
        if(!app.validate(1)){
          return;
        }else{
          if(!app.validate(2)){
            return;
          }else{
            if(!app.validate(3)){
              return;
            }
          }
        }
      }

      if($(this).closest("fieldset")[0]['id'] == "step-4"){
        if(!app.validate(1)){
          return;
        }else{
          if(!app.validate(2)){
            return;
          }else{
            if(!app.validate(3)){
              return;
            }else{
              if(!app.validate(4)){
                return;
              }
            }
          }
        }
      }

      if($(this).closest("fieldset")[0]['id'] == "step-5"){
        if(!app.validate(1)){
          return;
        }else{
          if(!app.validate(2)){
            return;
          }else{
            if(!app.validate(3)){
              return;
            }else{
              if(!app.validate(4)){
                return;
              }else{
                if(!app.validate(5)){
                  return;
                }
              }
            }
          }
        }
      }


      e.preventDefault();
      var $this = $(this),
        currentParent = $this.closest("fieldset"),
        nextParent = currentParent.next();

      if (app.checkForValidForm()) {
        var elem = $("#myBar");
        let current = $(this).closest("fieldset")[0]['id'].substr($(this).closest("fieldset")[0]['id'].length - 1);

        let width = ((100 / 6) * (parseFloat(current) + parseFloat(1)));

        if (width > 100) {
          width = 100;
        }
        // elem.css("width", "" + width + "%");
        elem.animate({ width: width + "%" }, 500);
        currentParent.removeClass(app.htmlClasses.visibleClass);
        app.showNextStep(currentParent, nextParent);
      }

    });
  },

  prevButton: function() {

    this.$prevButton.on("click", function(e) {
      $("#current-nav").val(parseInt($(this).attr("data-val")) - 1);

      e.preventDefault();
      var elem = $("#myBar");
      let current = $(this).closest("fieldset")[0]['id'].substr($(this).closest("fieldset")[0]['id'].length - 1);


      let width = ((100 / 6) * (parseFloat(current) - parseFloat(1)));

      if (width < 0) {
        width = 0;
      }
      // elem.style.width = width + '%';
      elem.animate({ width: width + "%" }, 500);

      // grab current step parent and previous parent
      var $this = $(this),
        currentParent = $(this).closest("fieldset"),
        prevParent = currentParent.prev();
      //    width -= 16.33;
      //    elem.style.width = width + '%';
      // hide current step and show previous step
      // no need to validate form here
      
      currentParent.removeClass(app.htmlClasses.visibleClass);
      app.showPrevStep(currentParent, prevParent);

    });
  },

  showNextStep: function(currentParent, nextParent) {
    $.each($("fieldset"), function(i, v){
      $(this)
      .addClass(app.htmlClasses.hiddenClass)
      .attr("aria-hidden", true);
    }); 
    
    
    $("#datepicker").find("fieldset").removeClass("hidden");
    $("#dateSpouse").find("fieldset").removeClass("hidden");
    $("#spousedob").find("fieldset").removeClass("hidden");
    // hide previous parent
    currentParent
      .addClass(app.htmlClasses.hiddenClass)
      .attr("aria-hidden", true);

    // show next parent
    nextParent
      .removeClass(app.htmlClasses.hiddenClass)
      .addClass(app.htmlClasses.visibleClass)
      .attr("aria-hidden", false);

    // focus first input on next parent
    // nextParent.focus();
    $('html,body').animate({
      scrollTop: $("div .steps").offset().top - 10
    }, 'slow');

    // activate appropriate step
    app.handleState(nextParent.index());

    // handle aria-expanded on next/prev buttons
    app.handleAriaExpanded();

  },

  showPrevStep: function(currentParent, prevParent) {
    $.each($("fieldset"), function(i, v){
      $(this)
      .addClass(app.htmlClasses.hiddenClass)
      .attr("aria-hidden", true);
    });

    
    $("#datepicker").find("fieldset").removeClass("hidden");
    $("#dateSpouse").find("fieldset").removeClass("hidden");
    $("#spousedob").find("fieldset").removeClass("hidden");

    // hide previous parent
    currentParent
      .addClass(app.htmlClasses.hiddenClass)
      .attr("aria-hidden", true);

    // show next parent
    prevParent
      .removeClass(app.htmlClasses.hiddenClass)
      .addClass(app.htmlClasses.visibleClass)
      .attr("aria-hidden", false);

    // send focus to first input on next parent
    // prevParent.focus();
    $('html,body').animate({
      scrollTop: $("div .steps").offset().top - 10
    }, 'slow');

    // activate appropriate step
    app.handleState(prevParent.index());

    // handle aria-expanded on next/prev buttons
    app.handleAriaExpanded();

  },

  handleAriaExpanded: function() {

    /*
    	Loop thru each next/prev button
    	Check to see if the parent it conrols is visible
    	Handle aria-expanded on buttons
    */
    $.each(this.$nextButton, function(idx, item) {
      var controls = $(item).attr("aria-controls");
      if ($("#" + controls).attr("aria-hidden") == "true") {
        $(item).attr("aria-expanded", false);
      } else {
        $(item).attr("aria-expanded", true);
      }
    });

    $.each(this.$prevButton, function(idx, item) {
      var controls = $(item).attr("aria-controls");
      if ($("#" + controls).attr("aria-hidden") == "true") {
        $(item).attr("aria-expanded", false);
      } else {
        $(item).attr("aria-expanded", true);
      }
    });

  },

  validate: function(step){

    var validateNumber = function(numberVal, number){
      if(isNaN(numberVal)){
        return false;
      }else{
        if(numberVal.length < number || numberVal.length > number){
          return false;
        }else{
          return true;
        }
      }
    }

    var validateDate = function(date){
      var regex = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
      return regex.test(date);
    }

    var validateEmail = function(email){
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    var validateAlphabet = function(alphabet){
      var letters = /^[A-Za-z]+$/;
      return alphabet.match(letters);
    }

    var notify = function(style, errorMessage){
      var title = "Warning";
      if(style=="white"){
        style = "error";
        title = "Error";
      }

      $.notify({
        title: title,
        text: errorMessage
      }, {
        style: 'metro',
        position:"right middle",
        className: style,
        autoHide: true,
        clickToHide: true
      });
    }

    if(step == 1){
      var familyName = document.getElementById("sur-name");
      var firstName = document.getElementById("first-name");
      var mobNumber = document.getElementById("mobile-telephone");
      var email = document.getElementById("email");
      var postCode = document.getElementById("post-code");
      var taxType = document.getElementById("taxType");
      var occupationRole = document.getElementById("OccupationRole");
      var rank = document.getElementById("Rank");
      var workLocation = document.getElementById("station_locale");
      var yearJob = document.getElementById("years-in-job");
      var streetNumber = document.getElementById("street-no");
      var streetAddress = document.getElementById("street-address");
      var suburb = document.getElementById("suburb");

      if(taxType.value == "select"){
        app.navigation(step);
        notify('white', "Please select a Tax Type.");
        taxType.focus();
        return false;
      }

      if (!validateAlphabet(firstName.value)) {
        app.navigation(step);
        notify('white', "Please enter alphabets only for the First Name.");
        firstName.focus();
        return false;
      }
      
      if (!validateAlphabet(familyName.value)) {
        app.navigation(step);
        notify('white', "Please enter alphabets only for the Surname.");
        familyName.focus();
        return false;
      } 
      
      if($("#HereBefore option:selected").val() == "No"){

        if(occupationRole.options[occupationRole.selectedIndex].value == "select"){
          app.navigation(step);
          notify('white', "Please select Occupation Role.");
          occupationRole.focus();
          return false;
        }

        if(rank.options[rank.selectedIndex].value == "select"){
          app.navigation(step);
          notify('white', "Please select Rank.");
          rank.focus();
          return false;
        }

        if(!validateAlphabet(workLocation.value)){
          app.navigation(step);
          notify('white', "Please enter Station Location.");
          workLocation.focus();
          return false;
        }

        if(isNaN(yearJob.value) || yearJob.value == "" || yearJob.value.length > 2){
          app.navigation(step);
          notify('white', "Please enter a valid Years in Job.");
          yearJob.focus();
          return false;
        }

      }

      // STAGE 1 MOBILE NUMBER validation
      if (!validateNumber(mobNumber.value, 10)) {
        app.navigation(step);
        notify("white", "Mobile number needs to be exactly 10 digits.");
        mobNumber.focus();
        return false;
      }

      if (!validateEmail(email.value)) {
        app.navigation(step);
        notify('white', "Please enter a valid Email.");
        email.focus();
        return false;
      }

      if ($("#contactBy").val() == "Select") {
        app.navigation(step);
        notify('white', "Please select contact by.");
        $("#contactBy").focus();
        return false;
      }

      if ($("#bestTime").val() == "Select") {
        app.navigation(step);
        notify('white', "Please select best time to contact you.");
        $("#bestTime").focus();
        return false;
      }

      if($("#HereBefore option:selected").val() == "No"){
        if(isNaN(streetNumber.value) || streetNumber.value == ""){
          app.navigation(step);
          notify('white', "Please enter a valid street number.");
          streetNumber.focus();
          return;
        }

        if(streetAddress.value == ""){
          app.navigation(step);
          notify('white', "Please enter a valid street address.");
          streetAddress.focus();
          return;
        }
        
        if(!validateAlphabet(suburb.value)){
          app.navigation(step);
          notify('white', "Please enter a suburb.");
          suburb.focus();
          return;
        }
        
        if($("select[name='State'] option:selected").val() == "select"){
          app.navigation(step);
          notify('white', "Please select a State.");
          $("select[name='State']").focus();
          return;
        }

        // STAGE 1 Post Code validation
        if (!validateNumber(postCode.value, 4)) {
          app.navigation(step);
          notify('white', "Post Code needs to be exactly 4 digits.");
          postCode.focus();
          return false;
        }

      }
      if(app.htmlClasses.times == 1){
        $.each($(".js-switch"), function(i, v){
          $(this).parent().find("span").css('border-color', 'rgb(223, 223, 223)');
          $(this).parent().find("small").html("");
          $(this).parent().find("small").html("No");

          if($(this).attr("id") == "mobile-used"){
            $(this).parent().find("small").html("");
            $(this).parent().find("small").html("Yes");
            var special = document.querySelector('#mobile-used');
              //$(special).attr("checked", false);
              special.checked = true;
            if (typeof Event === 'function' || !document.fireEvent) {
                var event = document.createEvent('HTMLEvents');
                event.initEvent('change', true, true);
                special.dispatchEvent(event);
            } else {
                special.fireEvent('onchange');
            }
          }

          if($(this).attr("id") == "internet-used"){
            $(this).parent().find("small").html("");
            $(this).parent().find("small").html("Yes");
            var special = document.querySelector('#internet-used');
              //$(special).attr("checked", false);
              special.checked = true;
            if (typeof Event === 'function' || !document.fireEvent) {
                var event = document.createEvent('HTMLEvents');
                event.initEvent('change', true, true);
                special.dispatchEvent(event);
            } else {
                special.fireEvent('onchange');
            }
          }
        });
      }
      app.htmlClasses.times = 2;
      return true;
    } else if(step == 2){
      var myDob = $("#datepicker").find(".birthDay");
      var mybsb = document.getElementById("my-bsb");
      var mytfn = document.getElementById("my-tfn");
      var mybankaccount = document.getElementById("bank-account");
      var spouseSurname = document.getElementById("spouse-surname");
      var spouseFirstname = document.getElementById("spouse-firstname");
      var spouseDob = $("#spousedob").find(".birthDay");
      var numberofDependents = $("#no-dependants");
      var spouseFullYears = $("#QspouseForFullYear");
      var spouseStartDate = $("#dateSpouse").find(".birthDay");
      var spouseWantsTaxDone = $("#spouseWantsTaxDone");
      var taxableIncome = document.getElementById("taxableincome");

      if($("#HaveSpouse").is(':checked')){
        
        if (!validateAlphabet(spouseFirstname.value)) {
          app.navigation(step);
          notify('white', "Please enter alphabets only for the First Name.");
          spouseFirstname.focus();
          return false;
        }

        if (!validateAlphabet(spouseSurname.value)) {
          app.navigation(step);
          notify('white', "Please enter alphabets only for the Surname.");
          spouseSurname.focus();
          return false;
        }

        if (spouseDob.val() == "") {
          app.navigation(step);
          notify('white', "Please Select Spouse Date of Birth");
          $("input[name='spousedob_birth[day]']").focus();
          // salr1.attr("aria-invalid", true); // add invalid aria
          return false;
        }

        if($("#no-dependants option:selected").val() == "select"){
          app.navigation(step);
          notify('white', "Please select Number of Dependants.");
          $("#no-dependants").focus();
          return false;
        }

        if($("#QspouseForFullYear option:selected").val() == "select"){
          app.navigation(step);
          notify('white', "Please select Full Year service for spouse.");
          $("#QspouseForFullYear").focus();
          return false;
        }

        if($("#QspouseForFullYear option:selected").val() == "Yes"){
          if (spouseStartDate.val() == "") {
            app.navigation(step);
            notify('white', "Please Select Start Date");
            $("input[name='dateSpouse_birth[day]']").focus();
            // salr1.attr("aria-invalid", true); // add invalid aria
            return false;
          }          
        }

        if($("#spouseWantsTaxDone option:selected").val() == "select"){
          app.navigation(step);
          notify('white', "Please select Tax Done.");
          $("#spouseWantsTaxDone").focus();
          return false;
        }

        if(isNaN(taxableIncome.value) || taxableIncome.value == ""){
          app.navigation(step);
          notify('white', "Please enter a valid Taxable Income.");
          taxableIncome.focus();
          return false;
        }
      }

      if (myDob.val() == "") {
        app.navigation(step);
        notify('white', "Please Select Date of Birth");
        $("input[name='datepicker_birth[day]']").focus();
        // salr1.attr("aria-invalid", true); // add invalid aria
        return false;
      }
      // TFN Number Validation
      if (!validateNumber(mytfn.value, 9)) {
        app.navigation(step);
        notify('white', "TFN number needs to be exactly 9 digits.");
        mytfn.focus();
        return false;
      }

      if (!validateNumber(mybsb.value, 6)) {
        app.navigation(step);
        notify('white', "BSB number needs to be exactly 6 digits.");
        mybsb.focus();
        return false;
      }

      // if (!validateNumber(mybankaccount.value, 6)) {
      if (isNaN(mybankaccount.value) || mybankaccount.value == "" || mybankaccount.value.length < 5 || mybankaccount.value.length > 11) {
        app.navigation(step);
        notify('white', "Please enter a valid Bank account number.");
        mybankaccount.focus();
        return false;
      }
      

      return true;
    } else if(step == 3){
      var salr1 = document.getElementById("salary1");
      var pay2g = document.getElementById("payg-tax");
      var salr2 = document.getElementById("salary2");
      var pay2g2 = document.getElementById("payg-tax2");
      var emp1 = $("#Employer1");

      if($("#Employer1 option:selected").val() == "select"){
        app.navigation(step);
        notify('white', "Please enter an Employer.");
        emp1.focus();
        return false;
      }

      if(isNaN(salr1.value) || salr1.value == "" || salr1.value <= 0 ){
        app.navigation(step);
        notify('white', "Please enter a valid Salary.");
        salr1.focus();
        salr1.select();
        return false;
      }

      if (isNaN(pay2g.value) || pay2g.value == "" || pay2g.value <= 0) {
        app.navigation(step);
        notify('white', "Please enter a valid Payg Tax.");
        pay2g.focus();
        pay2g.select();
        return false;
      }

      if($("#employer2").val() != ""){

        if(isNaN(salr2.value) || salr2.value == "" || salr2.value <= 0 ){
          // app.navigation(step);
          notify('white', "Please enter a valid second Salary.");
          salr2.focus();
          salr2.select();
          $(".btn-ok-employers").parent().parent().parent().parent().hide();
          $.each($(".emp-data"), function(i, v){
            $(this).remove();
            addNumbers();
          });
          app.htmlClasses.tableNumber = 1;
          return false;
        }
  
        if (isNaN(pay2g2.value) || pay2g2.value == "" || pay2g2.value <= 0) {
          // app.navigation(step);
          notify('white', "Please enter a valid Payg Tax for the second Employer.");
          pay2g2.focus();
          pay2g2.select();
          $(".btn-ok-employers").parent().parent().parent().parent().hide();
          $.each($(".emp-data"), function(i, v){
            $(this).remove();
            addNumbers();
          });
          app.htmlClasses.tableNumber = 1;
          return false;
        }
  
      }
      return true;
    } else if(step == 4){
      if ($('#select-termscondition').val() != "selected") {
        app.navigation(step);
        notify('white', "Please agree on the Tax deduction terms and condition");
        $('#agreedOn').focus();
        return false;
      }
      
      if($("#tax-info").val() == "Standard" || $("#tax-info").val() == "Premium Plus"){
        if($("#tax-deduction-notice").val() != "1"){
          app.navigation(step);
          notify('warning', "Please see the Additional Deduction to use the full service.");
          // $('#agreedOn').focus();
          return false;

        }
      }

      return true;
    } else if(step == 5){
      if($("#tax-info").val() == "Premium Plus"){

        if($("#additional-tax-deduction-notice").val() != "1"){
          app.navigation(step);
          notify('warning', "Please see the Extra Additional Deduction to use the full service.");
          // $('#agreedOn').focus();
          return false;

        }
      }

      return true;
    } else if(step == "popUpSpouse"){

      var myDob = $("#datepicker").find(".birthDay");
      var mybsb = document.getElementById("my-bsb");
      var mytfn = document.getElementById("my-tfn");
      var mybankaccount = document.getElementById("bank-account");
      var spouseSurname = document.getElementById("spouse-surname");
      var spouseFirstname = document.getElementById("spouse-firstname");
      var spouseDob = $("#spousedob").find(".birthDay");
      var numberofDependents = $("#no-dependants");
      var spouseFullYears = $("#QspouseForFullYear");
      var spouseStartDate = $("#dateSpouse").find(".birthDay");
      var spouseWantsTaxDone = $("#spouseWantsTaxDone");
      var taxableIncome = document.getElementById("taxableincome");

      if($("#HaveSpouse").is(':checked')){
        
        if (!validateAlphabet(spouseFirstname.value)) {
          app.navigation(step);
          notify('white', "Please enter alphabets only for the First Name.");
          spouseFirstname.focus();
          return false;
        }
        
        if (!validateAlphabet(spouseSurname.value)) {
          app.navigation(step);
          notify('white', "Please enter alphabets only for the Surname.");
          spouseSurname.focus();
          return false;
        }

        if (spouseDob.val() == "") {
          app.navigation(step);
          notify('white', "Please Select Spouse Date of Birth");
          $("input[name='spousedob_birth[day]']").focus();
          // salr1.attr("aria-invalid", true); // add invalid aria
          return false;
        }

        if($("#spouseWantsTaxDone option:selected").val() == "select"){
          app.navigation(step);
          notify('white', "Please select Tax Done.");
          $("#spouseWantsTaxDone").focus();
          return false;
        }

        if($("#no-dependants option:selected").val() == "select"){
          app.navigation(step);
          notify('white', "Please select Number of Dependants.");
          $("#no-dependants").focus();
          return false;
        }


        if(isNaN(taxableIncome.value) || taxableIncome.value == ""){
          app.navigation(step);
          notify('white', "Please enter a valid Taxable Income.");
          taxableIncome.focus();
          return false;
        }

        if($("#QspouseForFullYear option:selected").val() == "select"){
          app.navigation(step);
          notify('white', "Please select Full Year service for spouse.");
          $("#QspouseForFullYear").focus();
          return false;
        }

        if($("#QspouseForFullYear option:selected").val() == "Yes"){
          if (spouseStartDate.val() == "") {
            app.navigation(step);
            notify('white', "Please Select Start Date");
            $("input[name='dateSpouse_birth[day]']").focus();
            // salr1.attr("aria-invalid", true); // add invalid aria
            return false;
          }          
        }
        return true;
      }
    } else if(step == "popUpVisitor"){
      if($("#HereBefore option:selected").val() == "No"){
        var familyName = document.getElementById("sur-name");
        var firstName = document.getElementById("first-name");
        var mobNumber = document.getElementById("mobile-telephone");
        var email = document.getElementById("email");
        var postCode = document.getElementById("post-code");
        var taxType = document.getElementById("taxType");
        var occupationRole = document.getElementById("OccupationRole");
        var rank = document.getElementById("Rank");
        var workLocation = document.getElementById("station_locale");
        var yearJob = document.getElementById("years-in-job");
        var streetNumber = document.getElementById("street-no");
        var streetAddress = document.getElementById("street-address");
        var suburb = document.getElementById("suburb");

        if(occupationRole.options[occupationRole.selectedIndex].value == "select"){
          app.navigation(step);
          notify('white', "Please select Occupation Role.");
          occupationRole.focus();
          return false;
        }

        if(rank.options[rank.selectedIndex].value == "select"){
          app.navigation(step);
          notify('white', "Please select Rank.");
          rank.focus();
          return false;
        }

        if(!validateAlphabet(workLocation.value)){
          app.navigation(step);
          notify('white', "Please enter Station Location.");
          workLocation.focus();
          return false;
        }

        if(isNaN(yearJob.value) || yearJob.value == "" || yearJob.value.length > 2){
          app.navigation(step);
          notify('white', "Please enter a valid Years in Job.");
          yearJob.focus();
          return false;
        }

        if(isNaN(streetNumber.value) || streetNumber.value == ""){
          app.navigation(step);
          notify('white', "Please enter a valid street number.");
          streetNumber.focus();
          return;
        }

        if(streetAddress.value == ""){
          app.navigation(step);
          notify('white', "Please enter a valid street address.");
          streetAddress.focus();
          return;
        }
        
        if(!validateAlphabet(suburb.value)){
          app.navigation(step);
          notify('white', "Please enter a suburb.");
          suburb.focus();
          return;
        }
        
        if($("select[name='State'] option:selected").val() == "select"){
          app.navigation(step);
          notify('white', "Please select a State.");
          $("select[name='State']").focus();
          return;
        }

        // STAGE 1 Post Code validation
        if (!validateNumber(postCode.value, 4)) {
          app.navigation(step);
          notify('white', "Post Code needs to be exactly 4 digits.");
          postCode.focus();
          return false;
        }
        return true;
      }
    } else if(step == "popUpEmployers"){
      var valreturn = true;
      var salr1 = document.getElementById("salary1");
      var pay2g = document.getElementById("payg-tax");
      var salr2 = document.getElementById("salary2");
      var pay2g2 = document.getElementById("payg-tax2");
      var emp1 = $("#Employer1");

      if($("#Employer1 option:selected").val() == "select"){
        // app.navigation(step);
        notify('white', "Please enter an Employer.");
        emp1.focus();
        $(".btn-ok-employers").parent().parent().parent().parent().hide();
        $.each($(".emp-data"), function(i, v){
          $(this).remove();
          addNumbers();
        });
        app.htmlClasses.tableNumber = 1;
        return false;
      }

      if(isNaN(salr1.value) || salr1.value == "" || salr1.value <= 0 ){
        // app.navigation(step);
        notify('white', "Please enter a valid Salary.");
        salr1.focus();
        salr1.select();
        $(".btn-ok-employers").parent().parent().parent().parent().hide();
        $.each($(".emp-data"), function(i, v){
          $(this).remove();
          addNumbers();
        });
        app.htmlClasses.tableNumber = 1;
        return false;
      }

      if (isNaN(pay2g.value) || pay2g.value == "" || pay2g.value <= 0) {
        // app.navigation(step);
        notify('white', "Please enter a valid Payg Tax.");
        pay2g.focus();
        pay2g.select();
        $(".btn-ok-employers").parent().parent().parent().parent().hide();
        $.each($(".emp-data"), function(i, v){
          $(this).remove();
          addNumbers();
        });
        app.htmlClasses.tableNumber = 1;
        return false;
      }

      if($("#employer2").val() == ""){
        notify('white', "Please use the Employer2 field for the second employer.");
        $("#employer2").focus();
        $("#employer2").select();
        $(".btn-ok-employers").parent().parent().parent().parent().hide();
        $.each($(".emp-data"), function(i, v){
          $(this).remove();
          addNumbers();
        });
        app.htmlClasses.tableNumber = 1;
        return false;
      }

      if($("#employer2").val() != ""){

        if(isNaN(salr2.value) || salr2.value == "" || salr2.value <= 0 ){
          // app.navigation(step);
          notify('white', "Please enter a valid second Salary.");
          salr2.focus();
          salr2.select();
          $(".btn-ok-employers").parent().parent().parent().parent().hide();
          $.each($(".emp-data"), function(i, v){
            $(this).remove();
            addNumbers();
          });
          app.htmlClasses.tableNumber = 1;
          return false;
        }
  
        if (isNaN(pay2g2.value) || pay2g2.value == "" || pay2g2.value <= 0) {
          // app.navigation(step);
          notify('white', "Please enter a valid Payg Tax for the second Employer.");
          pay2g2.focus();
          pay2g2.select();
          $(".btn-ok-employers").parent().parent().parent().parent().hide();
          $.each($(".emp-data"), function(i, v){
            $(this).remove();
            addNumbers();
          });
          app.htmlClasses.tableNumber = 1;
          return false;
        }
  
      }
      
      $.each($(".emp-data"), function(i, v){
        $.each($(this).children(), function(index, value){
          if(index == 0){
            if(!validateAlphabet($(this).find("input").val())){
              notify('white', "Please enter Employer Name.");
              $(this).find("input").focus();
              $(this).find("input").select();
              valreturn = false;
            }
            return valreturn;
          }

          if(index == 1){
            if(parseInt($(this).find("input").val()) == 0 || $(this).find("input").val() == ""){
              notify('white', "Please enter Salary.");
              $(this).find("input").focus();
              $(this).find("input").select();
              valreturn = false;
            }
            return valreturn;
          }
          
          if(index == 3){
            if(parseInt($(this).find("input").val()) == 0 || $(this).find("input").val() == ""){
              notify('white', "Please enter Payg Tax.");
              $(this).find("input").focus();
              $(this).find("input").select();
              valreturn = false;
            }
            return valreturn;
            // console.log(dynamicVal);
          }
        });
      });

      return valreturn;
    }
  },

  navigation: function(val){
    var nextParent = $(document).find("fieldset[id='step-" + val + "']");
    val -=1;

    if(val > 0){
      var $this = $(document).find("fieldset[id='step-" + val + "']"),
        currentParent = $this;
  
      var elem = $("#myBar");
      let current = $this[0]['id'].substr($this[0]['id'].length - 1);
  
      let width = ((100 / 6) * (parseFloat(current) + parseFloat(1)));
  
      if (width > 100) {
        width = 100;
      }
      // elem.css("width", "" + width + "%");
      elem.animate({ width: width + "%" }, 500);
  
      app.showNextStep(currentParent, nextParent);
      $(document).find("#current-nav").val(parseInt(val) + 1);

    }
  },

  validateForm: function() {

    // jquery validate form validation
    this.$form.validate({
      ignore: ":hidden", // any children of hidden desc are ignored
      errorElement: "span", // wrap error elements in span not label
      invalidHandler: function(event, validator) { // add aria-invalid to el with error
        $.each(validator.errorList, function(idx, item) {
          if (idx === 0) {
            $(item.element).focus(); // send focus to first el with error
          }
          $(item.element).attr("aria-invalid", true); // add invalid aria
        })
      },
      submitHandler: function(form) {
        alert("Form submitted!");
        // document.getElementById("onSubmitButton").disabled = true;
        document.getElementById("onSubmitButton").disabled = true;
        // form.submit();
      }
    });
  },

  checkForValidForm: function() {
    if (this.$form.valid()) {
      return true;
    }
  },

  startOver: function() {

    var $parents = this.$formStepParents,
      $firstParent = this.$formStepParents.eq(0),
      $formParent = this.$formParent,
      $stepsParent = this.$stepsParent;

    this.$resetButton.on("click", function(e) {

      // hide all parents - show first
      $parents
        .removeClass(app.htmlClasses.visibleClass)
        .addClass(app.htmlClasses.hiddenClass)
        .eq(0).removeClass(app.htmlClasses.hiddenClass)
        .eq(0).addClass(app.htmlClasses.visibleClass);

      // remove edit state if present
      $formParent.removeClass(app.htmlClasses.editFormClass);

      // manage state - set to first item
      app.handleState(0);

      // reset stage for initial aria state
      app.setupAria();

      // send focus to first item
      setTimeout(function() {
        $firstParent.focus();
      }, 200);

    }); // click

  },

  handleState: function(step) {
    // console.log(step);
    this.$steps.eq(step).prevAll().removeAttr("disabled");
    this.$steps.eq(step).addClass(app.htmlClasses.activeClass);

    // restart scenario
    // if (step === 0) {
    //   this.$steps
    //     .removeClass(app.htmlClasses.activeClass)
    //     .attr("disabled", "disabled");
    //   this.$steps.eq(0).addClass(app.htmlClasses.activeClass)
    // }else{
      
    // }

  },

  editForm: function() {
    var $formParent = this.$formParent,
      $formStepParents = this.$formStepParents,
      $stepsParent = this.$stepsParent;

    this.$editButton.on("click", function() {
      $formParent.toggleClass(app.htmlClasses.editFormClass);
      $formStepParents.attr("aria-hidden", false);
      $formStepParents.eq(0).find("input").eq(0).focus();
      app.handleAriaExpanded();
    });
  },

  killEnterKey: function() {
    $(document).on("keypress", ":input:not(textarea,button)", function(event) {
      return event.keyCode != 13;
    });
  },

  handleStepClicks: function() {

    // var $stepTriggers = this.$steps,
    //   $stepParents = this.$formStepParents;

    // $stepTriggers.on("click", function(e) {

    //   e.preventDefault();

    //   var btnClickedIndex = $(this).index();

    //   // kill active state for items after step trigger
    //   $stepTriggers.nextAll()
    //     .removeClass(app.htmlClasses.activeClass)
    //     .attr("disabled", true);

    //   // activate button clicked
    //   $(this)
    //     .addClass(app.htmlClasses.activeClass)
    //     .attr("disabled", false)

    //   // hide all step parents
    //   $stepParents
    //     .removeClass(app.htmlClasses.visibleClass)
    //     .addClass(app.htmlClasses.hiddenClass)
    //     .attr("aria-hidden", true);

    //   // show step that matches index of button
    //   $stepParents.eq(btnClickedIndex)
    //     .removeClass(app.htmlClasses.hiddenClass)
    //     .addClass(app.htmlClasses.visibleClass)
    //     .attr("aria-hidden", false)
    //     .focus();

    // });

  }

};

function validateEmail(elementValue) {
  var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  return emailPattern.test(elementValue);
}

function depriciableItemChange(selectObject) {
  var deprecRate = document.getElementById("CapitalRate");
  if (selectObject.value == "Computers/laptops") {
    deprecRate.selectedIndex = 0;
  } else if (selectObject.value == "Desks / Chairs and Cabinets") {
    deprecRate.selectedIndex = 1;
  } else if (selectObject.value == "DesCapitals/Chairs") {
    deprecRate.selectedIndex = 2;
  } else if (selectObject.value == "Cameras >$300") {
    deprecRate.selectedIndex = 3;
  } else if (selectObject.value == "Mobile Phones >$300") {
    deprecRate.selectedIndex = 4;
  }
  MultiplyCapital();
}

app.init();
