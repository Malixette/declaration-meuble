console.log("mapsOK");

function initMap() {
  var ville = {lat: -25.363, lng: 131.044};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: uluru
  });
  var marker = new google.maps.Marker({
    position: martigues,
    map: map
  });
}