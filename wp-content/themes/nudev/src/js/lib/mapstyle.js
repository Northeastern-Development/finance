
function initMap() {
  // Styles a map in night mode.
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 42.4786476, lng: -71.1920583},
    zoom: 14,
    
  });
  var marker = new google.maps.Marker({
    position: {lat: 42.4786476, lng: -71.1920583},
    map: map
  });

}
