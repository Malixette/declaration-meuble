<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
</head>
<body>
    <h3>Test Carte</h3>
        <div id="map"></div>
        <script>
        var ville;
            
        function initMap() {
            var ville = {lat: 43.404811, lng: 5.053728};
            var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: ville
            });

            var contentString = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<h1 id="firstHeading" class="firstHeading">Nom hébergement</h1>'+
                'Lat = '+
                'Longitude = '
                '</div>'+
                '</div>';

            console.log(contentString);

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            

            var marker = new google.maps.Marker({
            position: ville,
            map: map,
            draggable: true,
            title: 'Nom de l\'hébergement'
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });

        }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVHTurRNPGNOsAA6Nuocp_nz9jN2APhck&callback=initMap">
    </script> 

  </body>
</html>