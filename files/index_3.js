/**
 * @name Multi-step form - WIP
 * @description Prototype for basic multi-step form
 * @deps jQuery, jQuery Validate
 */

var app = {

  init: function() {
    this.cacheDOM();
    // this.setupAria();
    this.nextButton();
    this.prevButton();
    this.validateForm();
    this.startOver();
    this.editForm();
    this.killEnterKey();
    this.handleStepClicks();
    this.clickEvent();
  },

  cacheDOM: function() {
    if ($(".multi-step-form").size() === 0) {
      return;
    }
    this.$formParent = $(".multi-step-form");
    this.$form = this.$formParent.find("form");
    this.$formStepParents = this.$form.find("fieldset"),

    this.$nextButton = this.$form.find(".btn-nxt");
    this.$prevButton = this.$form.find(".btn-prev");
    this.$editButton = this.$form.find(".btn-edit");
    this.$resetButton = this.$form.find("[type='reset']");

    this.$stepsParent = $(".steps");
    this.$steps = this.$stepsParent.find("button");
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

  clickEvent: function(){
    $("#datepicker").birthdayPicker({
      "maxAge": 80,
      "minAge": 18,
      "monthFormat": "short",
      "sizeClass": "span3",
      "dateFormat": "dd/mm/yyyy"
    });

    $(".h3-heading1").on("click", function(e){
      e.preventDefault();


      var valClick = $(this).attr("data-id");
      var currentVal = parseInt(valClick) - 1;
      // if(parseInt(valClick)!=1){
      //   currentVal = parseInt(valClick) - 1;
      // }
      
      if(formValidate($(this).parent(), currentVal)){
      
        $.each($(document).find(".h3-heading1"), function(i, v){
          if($(this).attr("data-id") == valClick){
            $(this).find("i").attr("class", "");
            $(this).find("i").attr("class", "fa fa-minus-square");
            $(this).siblings().slideDown("slow");
          }else{
            $(this).find("i").attr("class", "");
            $(this).find("i").attr("class", "fa fa-plus-square");
            $(this).siblings().slideUp("slow");
          }
        });
      }
    });

    $(".btn-next-slide").on("click", function(e) {
      e.preventDefault();

      var valClick = parseInt($(this).attr("data-id"));

      if(formValidate($(this).parent().parent().parent(), valClick)){

        var i =+ valClick + 2;

        if(valClick == 1 || valClick == 2 || valClick == 3 || valClick == 4){
          $(this).parent().parent().parent().find("h3 > i").attr("class", "");
          $(this).parent().parent().parent().find("h3 > i").attr("class", "fa fa-plus-square");
          $(this).parent().parent().slideUp("slow");

          $(document).find(".grid:eq(" + i + ")").find("h3 > i").attr("class", "");
          $(document).find(".grid:eq(" + i + ")").find("h3 > i").attr("class", "fa fa-minus-square");
          $(document).find(".grid:eq(" + i + ")").find("h3").siblings().slideDown("slow");
        } else{
          $(this).parent().parent().find("h3 > i").attr("class", "");
          $(this).parent().parent().find("h3 > i").attr("class", "fa fa-plus-square");
          $(this).parent().slideUp("slow");

          $(document).find(".grid:eq(" + i + ")").find("h3 > i").attr("class", "");
          $(document).find(".grid:eq(" + i + ")").find("h3 > i").attr("class", "fa fa-minus-square");
          $(document).find(".grid:eq(" + i + ")").find("h3").siblings().slideDown("slow");
        }
      }
    });
    
    $(".btn-back-slide").on("click", function(e) {
      e.preventDefault();

      var valClick = parseInt($(this).attr("data-id"));
      var i = 1;

      switch(valClick){
        case 2 :
          i = 1;
          break;
        default :
          i = valClick;
          break;
      }

      // if(valClick == 1){
      //   i =- valClick - 3;
      // }

      if(valClick == 1 || valClick == 2 || valClick == 3 || valClick == 4){
        $(this).parent().parent().parent().find("h3 > i").attr("class", "");
        $(this).parent().parent().parent().find("h3 > i").attr("class", "fa fa-plus-square");
        $(this).parent().parent().slideUp("slow");

        $(document).find(".grid:eq(" + i + ")").find("h3 > i").attr("class", "");
        $(document).find(".grid:eq(" + i + ")").find("h3 > i").attr("class", "fa fa-minus-square");
        $(document).find(".grid:eq(" + i + ")").find("h3").siblings().slideDown("slow");
      } else{
        $(this).parent().parent().find("h3 > i").attr("class", "");
        $(this).parent().parent().find("h3 > i").attr("class", "fa fa-plus-square");
        $(this).parent().slideUp("slow");

        $(document).find(".grid:eq(" + i + ")").find("h3 > i").attr("class", "");
        $(document).find(".grid:eq(" + i + ")").find("h3 > i").attr("class", "fa fa-minus-square");
        $(document).find(".grid:eq(" + i + ")").find("h3").siblings().slideDown("slow");
      }
    });

    var formValidate = function(selectedVal, currentVal){
      if (currentVal == 1) {
        var familyName = document.getElementById("familyName");
        var firstName = document.getElementById("first-name");
        var email = document.getElementById("email");
        var mobileNumber = document.getElementById("mobile_number");
        var tfn = document.getElementById("tfn");
        var dob = document.getElementsByClassName("birthDay")[0];

        if (!validateAlphabet(familyName.value)) {
          notify('white', "Please enter alphabets only for the Family Name.");
          familyName.focus();
          return;
        }

        if (!validateAlphabet(firstName.value)) {
          notify('white', "Please enter alphabets only for the First Name.");
          firstName.focus();
          return;
        }

        if(dob.value == ""){
          notify('white', "Please select a DOB.");
          document.getElementsByClassName("birthDate")[0].focus();
          return;
        }

        if (!validateEmail(email.value)) {
          notify('white', "Please enter a valid Email.");
          email.focus();
          return;
        }

        if(!validateNumber(mobileNumber.value, 9)){
          notify('white', "Please enter a valid Phone Number of 9 digits.");
          mobileNumber.focus();
          return;
        }

        if(!validateNumber(tfn.value, 9)){
          notify('white', "Please enter a valid Tax File Number of 9 digits.");
          tfn.focus();
          return;
        }

        return true;

      } else if(currentVal == 2){
        var bsb = document.getElementById("my-bsb");
        var accountNumber = document.getElementById("bank-account");

        if(!validateNumber(bsb.value, 6)){
          notify('white', "Please enter a valid BSB Number of 6 digits.");
          bsb.focus();
          return;
        }

        if(!validateNumber(accountNumber.value, 6)){
          notify('white', "Please enter a valid Bank Account Number of 6 digits.");
          accountNumber.focus();
          return;
        }

        return true;
      } else if(currentVal == 3){
        var academyLocation = document.getElementById("academyLocation");
        var occupation = document.getElementById("occupation");
        var rank = document.getElementById("rank");
        var squadNumber = document.getElementById("squadNumber");

        if(academyLocation.options[academyLocation.selectedIndex].value == "select"){
          notify('white', "Please select Academy Location.");
          academyLocation.focus();
          return;
        }

        if(occupation.options[occupation.selectedIndex].value == "select"){
          notify('white', "Please select Occupation.");
          occupation.focus();
          return;
        }

        if(rank.options[rank.selectedIndex].value == "select"){
          notify('white', "Please select Rank.");
          rank.focus();
          return;
        }

        if(squadNumber.value == ""){
          notify('white', "Please enter Squad Number.");
          squadNumber.focus();
          return;
        }

        return true;
      } else if(currentVal == 4){
        var stateRegistration = document.getElementById("stateofRegistration");
        var promotionalCode = document.getElementById("PromotionalCode");
        var hearAboutUs = document.getElementById("hearAboutUs");

        if(hearAboutUs.options[hearAboutUs.selectedIndex].value == "select"){
          notify('white', "Please select Hear About Us.");
          hearAboutUs.focus();
          return;
        }

        if(stateRegistration.options[stateRegistration.selectedIndex].value == "select"){
          notify('white', "Please select State of Registration.");
          stateRegistration.focus();
          return;
        }

        // if(promotionalCode.options[promotionalCode.selectedIndex].value == "select"){
        //   notify('white', "Please select Promotional Code.");
        //   promotionalCode.focus();
        //   return;
        // }

        $("#onSubmitButton").removeAttr("disabled");
        return true;
      }else{
        return true;
      }
    }

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
  },

  setupAria: function() {
    var topMostRow = document.getElementById("topMostRow");
    topMostRow.style.display = "none";
    // set first parent to visible
    this.$formStepParents.eq(0).attr("aria-hidden", false);

    // set all other parents to hidden
    this.$formStepParents.not(":first").attr("aria-hidden", true);

    // handle aria-expanded on next/prev buttons
    app.handleAriaExpanded();

  },

  nextButton: function() {
    this.$nextButton.on("click", function(e) {
      e.preventDefault();

      console.log("Validation Succesfull.");
      const form = document.getElementById('test');
      
      $(".sub-body").addClass("overlay");
      // return;
      formSubmit(form);
      alert("Submitted");
      document.getElementById("onSubmitButton").disabled = true;

    });
  },





  prevButton: function() {

    this.$prevButton.on("click", function(e) {

      e.preventDefault();
      var elem = document.getElementById("myBar");
      let current = $(this).closest("fieldset")[0]['id'].substr($(this).closest("fieldset")[0]['id'].length - 1);


      let width = ((100 / 6) * (parseFloat(current) - parseFloat(1)));

      if (width < 0) {
        width = 0;
      }
      elem.style.width = width + '%';

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
    nextParent.focus();

    // activate appropriate step
    app.handleState(nextParent.index());

    // handle aria-expanded on next/prev buttons
    app.handleAriaExpanded();

  },

  showPrevStep: function(currentParent, prevParent) {

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
    prevParent.focus();

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

    this.$steps.eq(step).prevAll().removeAttr("disabled");
    this.$steps.eq(step).addClass(app.htmlClasses.activeClass);

    // restart scenario
    if (step === 0) {
      this.$steps
        .removeClass(app.htmlClasses.activeClass)
        .attr("disabled", "disabled");
      this.$steps.eq(0).addClass(app.htmlClasses.activeClass)
    }

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

app.init();
