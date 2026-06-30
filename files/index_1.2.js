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
    hiddenClass: "hidden",
    visibleClass: "visible",
    editFormClass: "edit-form",
    animatedVisibleClass: "animated fadeIn",
    animatedHiddenClass: "animated fadeOut",
    animatingClass: "animating"
  },

  setupAria: function() {
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
      "maxAge": 80,
      "minAge": 18,
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
      if($("#mobileWorkPurpose option:selected").val() == "Yes"){
        $("#mobileWorkPurpose-data").show();
      }else{
        $("#mobileWorkPurpose-data").hide();
      }
    });

    $("#internetWorkPurpose").on("change", function(e){
      e.preventDefault();
      if($("#internetWorkPurpose option:selected").val() == "Yes"){
        $("#internetWorkPurpose-data").show();
      }else{
        $("#internetWorkPurpose-data").hide();
      }
    });

    $(".close").on("click", function(e){
      e.preventDefault();
      $(this).parent().parent().hide();
    })

    $("#additional-tax-deduction").on("click", function(e){
      e.preventDefault();
      var modal = document.getElementById('myModalAdditionalDeduction');
      var span = document.getElementsByClassName("close")[0];

      modal.style.display = "block";
      // span.onclick = function() {
      //   modal.style.display = "none";
      // }
      $(".block1").show();

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    });

    $("#more-additional-tax-deduction").on("click", function(e){
      e.preventDefault();
      var modal = document.getElementById('myModalMoreAdditionalDeduction');
      var span = document.getElementsByClassName("close")[0];

      modal.style.display = "block";
      // span.onclick = function() {
      //   modal.style.display = "none";
      // }
      $(".block2").show();

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
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
        }else if($("#taxType option:selected").val() == "Premium Plus"){
          $("#additional-tax-deduction").show();
          $("#more-additional-tax-deduction").show();
        }else{
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
              var myDob = document.getElementById("datepicker");
              var taxType = document.getElementById("taxType");
              var mobNumber = document.getElementById("mobile-telephone");
              var email = document.getElementById("email");
              var postCode = document.getElementById("post-code");

              if(taxType.value == "select"){
                alert("Please select a Tax Type.");
                taxType.focus();
                return;
              }

              // STAGE 1 Post Code validation
              if (postCode.value != '' && (postCode.value.length < 4 || postCode.value.length > 4)) {
                alert("Post Code needs to be exactly 4 digits.");
                postCode.focus();
                return;
              }
              // STAGE 1 MOBILE NUMBER validation
              if (mobNumber.value != '' && (mobNumber.value.length < 10 || mobNumber.value.length > 10)) {
                alert("Mobile number needs to be exactly 10 digits.");
                mobNumber.focus();
                return;
              }
              // STAGE 1 MOBILE NUMBER validation

              var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
              // return ;

              if (email.value != '' && !validateEmail(email.value)) {
                alert("invalid EmailId");
                email.focus();
                return;
              }


              if ((myDob.value == "dd/mm/yy")) {
                myDob.focus();
                alert("Please Select Date of Birth");
                // salr1.attr("aria-invalid", true); // add invalid aria
                return;
              }
              // TFN Number Validation
              var mytfn = document.getElementById("my-tfn");
              if (mytfn.value != '' && (mytfn.value.length < 9 || mytfn.value.length > 9)) {
                alert("TFN number needs to be exactly 9 digits.");
                mytfn.focus();
                return;
              }

              var mybsb = document.getElementById("my-bsb");
              if (mybsb.value != '' && (mybsb.value.length < 6 || mybsb.value.length > 6)) {
                alert("BSB number needs to be exactly 6 digits.");
                mybsb.focus();
                return;
              }

            } else if ($(this).closest("fieldset")[0]['id'] == "step-3") {
              var salr1 = document.getElementById("salary1");
              var pay2g = document.getElementById("payg-tax");
              var emp1 = document.getElementById("Employer1");
              var myDob = document.getElementById("datepicker");
              var taxType = document.getElementById("taxType");
              var mobNumber = document.getElementById("mobile-telephone");
              var email = document.getElementById("email");
              var postCode = document.getElementById("post-code");

              if(taxType.value == "select"){
                alert("Please select a Tax Type.");
                taxType.focus();
                return;
              }

              // STAGE 1 Post Code validation
              if (postCode.value != '' && (postCode.value.length < 4 || postCode.value.length > 4)) {
                alert("Post Code needs to be exactly 4 digits.");
                postCode.focus();
                return;
              }
              // STAGE 1 MOBILE NUMBER validation
              if (mobNumber.value != '' && (mobNumber.value.length < 10 || mobNumber.value.length > 10)) {
                alert("Mobile number needs to be exactly 10 digits.");
                mobNumber.focus();
                return;
              }
              // STAGE 1 MOBILE NUMBER validation

              var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
              // return ;

              if (email.value != '' && !validateEmail(email.value)) {
                alert("invalid EmailId");
                email.focus();
                return;
              }


              if ((myDob.value == "dd/mm/yy")) {
                myDob.focus();
                alert("Please Select Date of Birth");
                // salr1.attr("aria-invalid", true); // add invalid aria
                return;
              }
              // TFN Number Validation
              var mytfn = document.getElementById("my-tfn");
              if (mytfn.value != '' && (mytfn.value.length < 9 || mytfn.value.length > 9)) {
                alert("TFN number needs to be exactly 9 digits.");
                mytfn.focus();
                return;
              }

              var mybsb = document.getElementById("my-bsb");
              if (mybsb.value != '' && (mybsb.value.length < 6 || mybsb.value.length > 6)) {
                alert("BSB number needs to be exactly 6 digits.");
                mybsb.focus();
                return;
              }

              if ((emp1.value == "selectEmp")) {
                emp1.focus();
                alert("Please Select an Employer");
                // salr1.attr("aria-invalid", true); // add invalid aria
                return;
              }

              if ((salr1.value == 0) || (salr1.value == null) || (salr1.value == '')) {
                salr1.focus();
                alert("Salary1 cannot be 0");
                // salr1.attr("aria-invalid", true); // add invalid aria
                return;
              }


              if (pay2g.value == 0 || pay2g.value == null || pay2g.value == '') {
                pay2g.focus();
                alert("Payg Tax with held1 cannot be 0");
                return;
              }
            } else if($(this).closest("fieldset")[0]['id'] == "step-4" || $(this).closest("fieldset")[0]['id'] == "step-5"){

              var salr1 = document.getElementById("salary1");
              var pay2g = document.getElementById("payg-tax");
              var emp1 = document.getElementById("Employer1");
              var myDob = document.getElementById("datepicker");
              var taxType = document.getElementById("taxType");
              var mobNumber = document.getElementById("mobile-telephone");
              var email = document.getElementById("email");
              var postCode = document.getElementById("post-code");

              if(taxType.value == "select"){
                alert("Please select a Tax Type.");
                taxType.focus();
                return;
              }

              // STAGE 1 Post Code validation
              if (postCode.value != '' && (postCode.value.length < 4 || postCode.value.length > 4)) {
                alert("Post Code needs to be exactly 4 digits.");
                postCode.focus();
                return;
              }
              // STAGE 1 MOBILE NUMBER validation
              if (mobNumber.value != '' && (mobNumber.value.length < 10 || mobNumber.value.length > 10)) {
                alert("Mobile number needs to be exactly 10 digits.");
                mobNumber.focus();
                return;
              }
              // STAGE 1 MOBILE NUMBER validation

              var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
              // return ;

              if (email.value != '' && !validateEmail(email.value)) {
                alert("invalid EmailId");
                email.focus();
                return;
              }


              if ((myDob.value == "dd/mm/yy")) {
                myDob.focus();
                alert("Please Select Date of Birth");
                // salr1.attr("aria-invalid", true); // add invalid aria
                return;
              }
              // TFN Number Validation
              var mytfn = document.getElementById("my-tfn");
              if (mytfn.value != '' && (mytfn.value.length < 9 || mytfn.value.length > 9)) {
                alert("TFN number needs to be exactly 9 digits.");
                mytfn.focus();
                return;
              }

              var mybsb = document.getElementById("my-bsb");
              if (mybsb.value != '' && (mybsb.value.length < 6 || mybsb.value.length > 6)) {
                alert("BSB number needs to be exactly 6 digits.");
                mybsb.focus();
                return;
              }

              if ((emp1.value == "selectEmp")) {
                emp1.focus();
                alert("Please Select an Employer");
                // salr1.attr("aria-invalid", true); // add invalid aria
                return;
              }

              if ((salr1.value == 0) || (salr1.value == null) || (salr1.value == '')) {
                salr1.focus();
                alert("Salary1 cannot be 0");
                // salr1.attr("aria-invalid", true); // add invalid aria
                return;
              }


              if (pay2g.value == 0 || pay2g.value == null || pay2g.value == '') {
                pay2g.focus();
                alert("Payg Tax with held1 cannot be 0");
                return;
              }

              if ($('#select-termscondition').val() != "selected") {
                $('#agreedOn').focus();
                alert("Please agree on the Tax deduction terms and condition");
                return;
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
        var myDob = document.getElementById("datepicker");


        if ((myDob.value == "dd/mm/yy")) {
          myDob.focus();
          alert("Please Select Date of Birth");
          // salr1.attr("aria-invalid", true); // add invalid aria
          return;
        }
        // TFN Number Validation
        var mytfn = document.getElementById("my-tfn");
        if (mytfn.value != '' && (mytfn.value.length < 9 || mytfn.value.length > 9)) {
          alert("TFN number needs to be exactly 9 digits.");
          mytfn.focus();
          return;
        }

        var mybsb = document.getElementById("my-bsb");
        if (mybsb.value != '' && (mybsb.value.length < 6 || mybsb.value.length > 6)) {
          alert("BSB number needs to be exactly 6 digits.");
          mybsb.focus();
          return;
        }

      }

      if ($(this).closest("fieldset")[0]['id'] == "step-3") {
        var salr1 = document.getElementById("salary1");
        var pay2g = document.getElementById("payg-tax");
        var emp1 = document.getElementById("Employer1");

        if ((emp1.value == "selectEmp")) {
          emp1.focus();
          alert("Please Select an Employer");
          // salr1.attr("aria-invalid", true); // add invalid aria
          return;
        }

        if ((salr1.value == 0) || (salr1.value == null) || (salr1.value == '')) {
          salr1.focus();
          alert("Salary1 cannot be 0");
          // salr1.attr("aria-invalid", true); // add invalid aria
          return;
        }


        if (pay2g.value == 0 || pay2g.value == null || pay2g.value == '') {
          pay2g.focus();
          alert("Payg Tax with held1 cannot be 0");
          return;
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
      $.notify({
        title: 'Error',
        text: errorMessage
      }, {
        style: 'metro',
        position:"right middle",
        className: "error",
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
        notify('white', "Please select a Tax Type.");
        taxType.focus();
        return false;
      }

      if (!validateAlphabet(firstName.value)) {
        notify('white', "Please enter alphabets only for the First Name.");
        firstName.focus();
        return false;
      }
      
      if (!validateAlphabet(familyName.value)) {
        notify('white', "Please enter alphabets only for the Surname.");
        familyName.focus();
        return false;
      } 
      
      if($("#HereBefore option:selected").val() == "No"){

        if(occupationRole.options[occupationRole.selectedIndex].value == "select"){
          notify('white', "Please select Occupation Role.");
          occupationRole.focus();
          return;
        }

        if(rank.options[rank.selectedIndex].value == "select"){
          notify('white', "Please select Rank.");
          rank.focus();
          return;
        }

        if(!validateAlphabet(workLocation.value)){
          notify('white', "Please enter Station Location.");
          workLocation.focus();
          return;
        }

        if(isNaN(yearJob.value) || yearJob.value == "" || yearJob.value.length > 2){
          notify('white', "Please enter a valid Years in Job.");
          yearJob.focus();
          return;
        }

      }

      // STAGE 1 MOBILE NUMBER validation
      if (!validateNumber(mobNumber.value, 10)) {
        notify("white", "Mobile number needs to be exactly 10 digits.");
        mobNumber.focus();
        return false;
      }

      if (!validateEmail(email.value)) {
        notify('white', "Please enter a valid Email.");
        email.focus();
        return false;
      }

      if($("#HereBefore option:selected").val() == "No"){
        if(isNaN(streetNumber.value) || streetNumber.value == ""){
          notify('white', "Please enter a valid street number.");
          streetNumber.focus();
          return;
        }

        if(streetAddress.value == ""){
          notify('white', "Please enter a valid street address.");
          streetAddress.focus();
          return;
        }
        
        if(!validateAlphabet(suburb.value)){
          notify('white', "Please enter a suburb.");
          suburb.focus();
          return;
        }

        // STAGE 1 Post Code validation
        if (!validateNumber(postCode.value, 4)) {
          notify('white', "Post Code needs to be exactly 4 digits.");
          postCode.focus();
          return false;
        }

      }
      return true;
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
