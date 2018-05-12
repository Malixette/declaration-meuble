<!DOCTYPE html>
<html>
  <head>
    <title>Place Autocomplete</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
.controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}
 
#autocomplete {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 300px;
}
 
#autocomplete:focus {
  border-color: #4d90fe;
}
 
.pac-container {
  font-family: Roboto;
}
 
#input_autocomplete {
  color: #fff;
  background-color: #4d90fe;
  padding: 5px 11px 0px 11px;
}
 
#input_autocomplete label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}
 
    </style>
  </head>
  <body>
    <input id="autocomplete" class="changetype-address" type="text"
        placeholder="Enter a location">
    <div id="input_autocomplete" class="controls">

      <input type="text" name="type" id="postal_code">
      <label for="hebergement_heb_code_postal">Code postal</label>
 
      <input type="ratextdio" name="hebergement[heb_commune]" id="locality">
      <label for="hebergement_heb_commune">Commune</label>
 
      <input type="text" name="street_number" id="hebergement_heb_num_voie">
      <label for="hebergement_heb_num_voie">N° de voie</label>

      <input type="text" id="longitude" name="longitude" />
      <label for="longitude">Longitude</label>
  
      <input type="text" id="latitude" name="latitude" />
      <label for="latitude">Latitude</label>
    </div>
    <div id="map"></div>
 
<script>

function initMap() {
    var options = { componentRestrictions: {country: "fr"} };
    
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 46.3333, lng: 2.6},
        zoom: 4
    });
    
    var input = /** @type {!HTMLInputElement} */(
      document.getElementById('autocomplete'));
 
 
// // #####################RECUP AUTOCOMPLETE###################
    var placeSearch = new google.maps.places.Autocomplete(input, options);
    autocomplete.bindTo('bounds', map);
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
        var val = place.address_components[i][componentForm[addressType]];
        document.getElementById(addressType).value = val;
        }
    }
  }
  function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// //################## FIN AUTOCOMPLETE  ####################################


  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    draggable: true,
    anchorPoint: new google.maps.Point(0, -29)
  });
 
  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }
 

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17); 
    }
    marker.setIcon(/** @type {google.maps.Icon} */({
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }
    infowindow.setContent(address);
    infowindow.open(map, marker);



  });
 























































//   // Sets a listener on a radio button to change the filter type on Places
//   // Autocomplete.
//   function setupClickListener(id, types) {
//     var radioButton = document.getElementById(id);
//     radioButton.addEventListener('click', function() {
//       autocomplete.setTypes(types);
//     });
//   }
 
//   setupClickListener('changetype-all', []);
//   setupClickListener('changetype-address', ['address']);
//   setupClickListener('changetype-establishment', ['establishment']);
//   setupClickListener('changetype-geocode', ['geocode']);
}

// <script>
//  var placeSearch, autocomplete;
//       var componentForm = {
//         street_number: 'short_name',
//         route: 'long_name',
//         locality: 'long_name',
//         country: 'long_name',
//         postal_code: 'short_name'
//       };

//       function initAutocomplete() {
//         // Create the autocomplete object, restricting the search to geographical
//         // location types.
//         autocomplete = new google.maps.places.Autocomplete(
//             /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
//             {types: ['geocode']});

//         // When the user selects an address from the dropdown, populate the address
//         // fields in the form.
//         autocomplete.addListener('place_changed', fillInAddress);
//       }

//       function fillInAddress() {
//         // Get the place details from the autocomplete object.
//         var place = autocomplete.getPlace();

//         for (var component in componentForm) {
//           document.getElementById(component).value = '';
//           document.getElementById(component).disabled = false;
//         }

//         // Get each component of the address from the place details
//         // and fill the corresponding field on the form.
//         for (var i = 0; i < place.address_components.length; i++) {
//           var addressType = place.address_components[i].types[0];
//           if (componentForm[addressType]) {
//             var val = place.address_components[i][componentForm[addressType]];
//             document.getElementById(addressType).value = val;
//           }
//         }
//       }

//       // Bias the autocomplete object to the user's geographical location,
//       // as supplied by the browser's 'navigator.geolocation' object.
//       function geolocate() {
//         if (navigator.geolocation) {
//           navigator.geolocation.getCurrentPosition(function(position) {
//             var geolocation = {
//               lat: position.coords.latitude,
//               lng: position.coords.longitude
//             };
//             var circle = new google.maps.Circle({
//               center: geolocation,
//               radius: position.coords.accuracy
//             });
//             autocomplete.setBounds(circle.getBounds());
//           });
//         }
//       }
      
//       // var zipCode
//       //   zipCode = document.getElementById("postal_code").value;
//       //       alert(zipCode);
//     </script>
  


</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4ryzwJCu-r-gIFduP2Nb5hmu75Iix2Dg&signed_in=true&libraries=places&callback=initMap"
        async defer>
</script>

  </body>
</html>