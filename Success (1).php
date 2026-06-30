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

<style>
    


    .img src { width: 33%; }
     .imageArray { height: 50%; }


    
    .wrapper {
  display: grid;
  grid-template-columns: 200px 200px 10px;
}
</style>

</head>


<body>
    
    <div class="wrapper">
  <div> 
  <div id="date"> </div>

 </div>
  <div>2</div>
 
  <div>Three  <script type="text/javascript"><!--
    var imlocation = "assets/img/";
     function ImageArray (n) {
       this.length = n;
       for (var i =1; i <= n; i++) {
         this[i] = ' '
       }
     }
    image = new ImageArray(7);
    image[0] = 'About.jpg';  //sunday
    image[1] = 'Amex.png';  //Mon
    image[2] = 'garry.jpg';  //Tues
    image[3] = 'garry1.jpg';  //Wed
    image[4] = 'melbourne-city.jpg'; //Thurs
    image[5] = 'car.jpg';  //Friday
    image[6] = 'Police in bullet proof vest.jpg';//saturday
    
    

    var currentdate = new Date();
    var imagenumber = currentdate.getDay();
    document.write('<img src="' + imlocation + image[imagenumber] + '">');
    //--></script></div>
  <div> 4  
    
    </div>
  <div>Five</div>
  
    <div>
 
    
    
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

 

     
        </body>

</html>
