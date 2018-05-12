<!DOCTYPE html>
<html>

<head>
  <title>Place Autocomplete</title>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <style>
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */

    #map {
      height: 100%;
    }

    /* Optional: Makes the sample page fill the window. */

    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
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

    #pac-input {
      background-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 12px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 300px;
    }

    #pac-input:focus {
      border-color: #4d90fe;
    }

    .pac-container {
      font-family: Roboto;
    }

    #type-selector {
      color: #fff;
      background-color: #4d90fe;
      padding: 5px 11px 0px 11px;
    }

    #type-selector label {
      font-family: Roboto;
      font-size: 13px;
      font-weight: 300;
    }
  </style>
</head>

<body>
  <input id="hebergement_heb_adresse" placeholder="Enter your address" type="text"></input>

  <label for="voie">Numéro de voie</label>
  <input type="text" name="nulVoie" id="street_number" disabled="true"></input>

  <label for="voie">Voie</label>
  <input type="text" class="voie" id="route" disabled="true"></input>

  <label for="zipcode">Zip code</label>
  <input type="text" name="zipcode" id="postal_code" disabled="true"></input>

  <label for="commune">Commune</label>
  <input type="text" name "commune" id="locality" disabled="true"></input>

  <label for="pays">France</label>
  <input type="text" name="pays" id="country" disabled="true"></input>

  <label for="latitude">Latitude</label>
  <input type="text" id="hebergement_heb_lat" name="latitude" value=""></input>

  <label for="longitude">Longitude</label>
  <input type="text" id="hebergement_heb_long" name="longitude" value=""></input>

  <div id="map">Carte</div>

  <div id="map" style="height:250px;"></div>

  <script>

    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 46.3333, lng: 2.6 },
        zoom: 4
      });
      var input = (document.getElementById('hebergement_heb_adresse'));

      var options = { componentRestrictions: { country: "fr" } };

      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      var autocomplete = new google.maps.places.Autocomplete(input, options);
      autocomplete.bindTo('bounds', map);

      var infowindow = new google.maps.InfoWindow();
      var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
      });


      autocomplete.addListener('place_changed', function () {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
          window.alert("No details available for input: '" + place.name + "'");
          return;
        }

        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        var placeId = place.place_id;

        document.getElementById("hebergement_heb_lat").value = lat;
        document.getElementById("hebergement_heb_long").value = lng;

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }

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
            (place.address_components[6] && place.address_components[6].short_name || ''),
            (place.address_components[2] && place.address_components[2].short_name || '')
          ].join(' ');
        }

        infowindow.setContent('<div><strong>' + address + '</strong><br>');
        infowindow.open(map, marker);
      });

      function setupClickListener(id, types) {
        var radioButton = document.getElementById(id);
        radioButton.addEventListener('click', function () {
          autocomplete.setTypes(types);
        });
      }

    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4ryzwJCu-r-gIFduP2Nb5hmu75Iix2Dg&libraries=places&callback=initMap"
    async defer></script>
</body>

</html>