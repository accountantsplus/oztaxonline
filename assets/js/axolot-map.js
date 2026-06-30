/*==============================================================*/
// Axolot Map  JS
/*==============================================================*/
(function($) {
    "use strict"; // Start of use strict
    var marker;

    window.initMap = function() {
        var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 18,
        center: {lat: -37.8175169, lng: 145.1923118}
        });

        marker = new google.maps.Marker({
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP,
        position: {lat: -37.8175173, lng: 145.1923108}
        });
        marker.addListener('click', toggleBounce);
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
        } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
}(jQuery)); // End of use strict