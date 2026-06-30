<!DOCTYPE html>
<html lang="en">


<head>
<title>Sign Tax Success</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="assets/js/jquery.min.js"></script><!-- Popper Min JS -->
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script src="assets/js/popper.min.js"></script><!-- Bootstrap Min JS -->
        <script src="assets/js/bootstrap.min.js"></script><!-- Owl Carousel JS -->
        <script src="assets/js/owl.carousel.min.js"></script><!-- Counterup Min JS -->
        <script src="assets/js/jquery.counterup.min.js"></script><!-- Magnific Min JS -->
        <script src="assets/js/jquery.magnific-popup.min.js"></script><!-- Waypoints Min JS -->
        <script src="assets/js/waypoints.min.js"></script><!-- Form Validator Min JS -->
        <script src="assets/js/form-validator.min.js"></script><!-- Contact Form Min JS -->
        <script src="assets/js/contact-form-script.js"></script><!-- ajaxChimp Min JS -->
        <script src="assets/js/jquery.ajaxchimp.min.js"></script><!-- Fox Map JS FILE -->
        <script src="assets/js/axolot-map.js"></script><!-- Main JS -->
         <script src="assets/js/date.js"></script>
       <script src="assets/js/moment.js"></script>
        <script src="assets/js/main.js"></script>




</head>


<body>



 <div class="wrapper">
  <div></div>
 
 
  <div>  
      <div class="container">
       <h3>Signed tax return received confirmation</h3>
            <div class="alert-box">
           <div class="alert alert-success">
          <div class="alert-icon text-center">
        <i class="fa fa-check-square-o  fa-3x" aria-hidden="true"> </i> <strong><h3> Success!</h3></strong>
      </div>
      
    <img src="assets/img/PngItem_2475683.png" 
   style="position:fixed; left:600px; top:150px; width:130px; height:100px; border:none;"alt=""title="We Got it" />   
      
      

      <div class="alert-message text-center"><br>
       Your signed tax return has been received by our office for lodgement on: 
 

<div id="clock">
  <div id="date">

</div>

<hr>

<br><br>You should receive your tax refund into your nominated bank account in 14 days subject to ATO Processing.

<br><br>  Your tax refund tracking receipt number is:&nbsp;&nbsp;<span id="Random1"></span><br><br>

<hr>

<h1>Your estimated tax refund should be due back from the ATO on the   &rarr;  <span  id="m-date"></span></h1>

<p>If you do not receive you refund in 14 days call our office on 1800 819 692 with your tracking receipt number handy.<br>Cheers the Police Tax Team</p></div>



</div>



  
<!----------------------------------------------------------------------->


<style>
    .slides { width: 33%; }
     .slides { height: 50%; }
    .slides-hidden { display : none; }
</style>

<script>
    addEventListener("load",() => { // "load" is safe but "DOMContentLoaded" starts earlier
        var index = 0;
        const slides = document.querySelectorAll(".slides");
        const classHide = "slides-hidden", count = slides.length;
        nextSlide();
        function nextSlide() {
            slides[(index ++) % count].classList.add(classHide);
            slides[index % count].classList.remove(classHide);
            setTimeout(nextSlide, 30000);
        }
    });
</script>

<section>
    <img class="slides slides-hidden"   src="assets/img/Police in bullet proof vest.jpg" style="position:fixed; right:300px; bottom:300px; alt=""title="xx">
    
    
     <img class="slides slides-hidden"  src="assets/img/car2.jpg" style="position:fixed; right:300px; bottom:300px; alt=""title="xx">
      <img class="slides slides-hidden" src="assets/img/car.jpg" style="position:fixed; right:300px; bottom:300px; alt=""title="xx" >

</section>






<script> 


document.getElementById("demo5").innerHTML


 = new Date();
date.setDate(date.getDate() + 14);


</script>


<script>
    
    //Estimated Refund date

var today = new Date();
var dd = String(today.getDate()).padStart(2, "0"); // get the date padStart => 01
var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
var yyyy = today.getFullYear();
var fullDate = dd + "." + mm + "." + yyyy;

var someDate = new Date();
var numberOfDaysToAdd = 14;
someDate.setDate(someDate.getDate() + numberOfDaysToAdd);

var dd = String(someDate.getDate()).padStart(2, "0");
var mm = String(someDate.getMonth() + 1).padStart(2, "0");
var y = someDate.getFullYear();

var someFormattedDate = dd + "." + mm + "." + y;

today =  someFormattedDate;

document.getElementById("m-date").innerHTML = today;
</script>



<script>
document.getElementById("Random1").innerHTML =
Math.floor(Math.random() * 30000) + 100+ "/20";
</script>

<script>
    
    
    var d = new Date();
console.log(d);
d.setHours(0);
console.log(d);
</script>


<script>
    
    $(document).ready(() => {
  let month = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December"
    ],
    day = [
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday"
    ],
    date = new Date();
  date.setDate(date.getDate());
  $("#date").html(
    `${day[date.getDay()]}-${
      month[date.getMonth()]
    } ${date.getDate()}, ${date.getFullYear()}`
  );

  setInterval(() => {
    let mins = new Date().getMinutes();
    $("#mins").html(`${mins < 10 ? "0" : ""}${mins}`);
  }, 1000);
  setInterval(() => {
    let hours = new Date().getHours();
    $("#hours").html(`${hours < 10 ? "0" : ""}${hours}`);
  }, 1000);
});
</script>



<!------------------------------CSS--------------------------------->
<style>  
.wrapper {
  display: grid;
  grid-template-columns: 200px 600px 100px 100px 100px;
}





 .alert-box
  {
    max-width : 600px;
    min-height : 350px;
      color: green;
    text-shadow: 1px 1px 1px #ccc;
    font-size: 1.5em;
      text-align: left;
    border: 3px solid green;
     border-radius: 25px;
  padding: 50px;
  margin: 20px;
   
    
    .alert-icon
    {
        padding-bottom: 20px;
          color: black;
   
    }
  } 
  
  
  
  .alert-message   {
       
     color: black;
       font-size: 0.75em;
         text-align: left;
           padding-bottom: 5px;
    }
    
    




#clock {
  color: navy;


}

#date {
  font-size: 1.6em;
}

ul {
  list-style: none;
  font-size: 2em;
}


ul li {
  display: inline;
}

h1 {
font-size: 25px;
 color: red;

}

h2 {
font-size: 25px;
 color: red;

}

h3 {
font-size: 25px;
 color: navy;

}

</style>

       
        </body>

</html>
