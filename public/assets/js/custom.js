
 // You may required to change this file to fit your need based on your server-side application

$(function() {
  //
  // Dropzone
  //
  // Visit http://www.dropzonejs.com/ for more options and see how you can handle uploaded files
  Dropzone.autoDiscover = false;
  $(".dropzone").dropzone({
    url: "target.php",
    dictDefaultMessage: '<span class="dropzone-file-icon"></span>Drag and drop a file here or click'
  });


});


//
// Like button doesn't work in modals because of Ajax content loading
//
function initModalLike() {
  $('.modal .like').on('click', function() {
    // Resolve shot ID and send an ajax request to update number of likes in database
    $(this).children('.fa').toggleClass('fa-heart-o fa-heart');
  });
}

function initGallery() {

  var gallery = $('.image-gallery').lightSlider({
    gallery: true,
    item: 1,
    thumbItem: 5,
    slideMargin: 0,
    enableDrag: true,
    currentPagerPosition: 'left',
    onSliderLoad: function(el) {
      el.lightGallery({
        selector: '.image-gallery .lslide'
      });
    },
  });
}

//
// Draw map in page-contact
//
function initMap() {
  var mapDiv = document.getElementById('contact-map');
  var map = new google.maps.Map(mapDiv, {
    center: {lat: 44.540, lng: -78.546},
    zoom: 14
  });

  var marker = new google.maps.Marker({
    position: {lat: 44.540, lng: -78.546},
    icon: "assets/img/app/marker.png",
    map: map
  });

  map.set('styles', [{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]);
}
