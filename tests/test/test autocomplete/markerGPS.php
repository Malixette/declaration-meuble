 

Recherche personnalisée

 
ACCÈS MEMBRE
VENDREDI 04 MAI 2018 14:58
ACCUEIL
API GOOGLE MAPS
API GOOGLE
WEB SERVICE GOOGLE
GOOGLE LIBRARIES
KML DÉPARTEMENTS
Cartographie & Webmapping Google Maps API V3 Marqueur Marker Afficher les coordonnées du marqueur
26 Avril 2016
Afficher les coordonnées du marqueur en utilisant la propriété title
Marqueur Marker exemples et tutoriels en Français
API Google Maps JavaScript version 3

 
Afficher les latitude et longitude dans le titre du marqueur déplaçable
Carte : afficher les latitude et longitude dans le titre du marqueur déplaçable
Code : afficher les latitude et longitude dans le titre du marqueur déplaçable
Afficher les latitude et longitude d'un marqueur déplaçable en utilisant position_changed
Carte : afficher les latitude, longitude d'un marqueur déplaçable en utilisant position_changed
Code : afficher les latitude, longitude d'un marqueur déplaçable en utilisant position_changed
Qu'elle est la différencea entre les événements dragend et position_changed
dragend
position_changed
Afficher les latitude et longitude dans le titre du marqueur déplaçable
Ce tutoriel vous explique comment afficher les coordonnées d'un marqueur mobile lorsque celui-ci est survolé par le curseur de votre souris.
Reprenons le code du tutoriel, intitulé Comment créer et afficher un marqueur déplaçable ?.
On ajoute aux options du marqueur optionsMarqueur la propriété title qui affichera, par défaut, les coordonnées (Latitude, Longitude) du centre de la carte :

var optionsMarqueur = {
	map: maCarte,
	position: new google.maps.LatLng( 47.389982, 0.688877 ),
	title: "Lat : "+maCarte.getCenter().lat+" - Lng"+maCarte.getCenter().lng,
	draggable: true
};
var marqueur = new google.maps.Marker( optionsMarqueur );
Pour afficher les nouvelles coordonnées du marqueur à la fin de son déplacement sous son emplacement, il faut créer un nouvel observateur d'événement sur le marker nommé marqueur, chargé d'observer l'événement dragend
L'événement dragend sera déclenché lorsque vous cesserez de déplacer le marqueur mobile.
A cet instant précis, un objet evenement, contenant diverses informations dont le nouvel emplacement du marqueur, est transmis à la fonction chargée du traitement :

google.maps.event.addListener( marqueur, "dragend"; function( evenement ) {
	...
});
Enfin, la fonction chargée du traitement de l'événement dragend va :

extraire les nouvelles coordonnées du marqueur :
var lat = evenement.latLng.lat(),
	lng = evenement.latLng.lng();
puis les afficher dans le titre du marqueur :
this.setTitle( "Lat : "+maCarte.getCenter().lat()+" - Lng : "+maCarte.getCenter().lng() );
Au final on obtient donc le code suivant :

var optionsMarqueur = {
	map: maCarte,
	position: new google.maps.LatLng( 47.389982, 0.688877 ),
	title: "Lat : "+maCarte.getCenter().lat()+" - Lng : "+maCarte.getCenter().lng(),
	draggable: true
};
var marqueur = new google.maps.Marker( optionsMarqueur );
google.maps.event.addListener( marqueur, "dragend", function( evenement ) {
	var lat = evenement.latLng.lat(),
		lng = evenement.latLng.lng();
	this.setTitle( "Lat : "+lat+" - Lng"+lng );
});
Carte : afficher les latitude et longitude dans le titre du marqueur déplaçable

Déplacez le marqueur. A l'issue du déplacement, les nouvelles latitude et longitude du marqueur s'affichent sous celui-ci.
Code : afficher les latitude et longitude dans le titre du marqueur déplaçable
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
		<meta charset="UTF-8" />
		<title>Titre de votre page</title>
		<style>
			html, body {
				height: 100%;
				margin: 0;
				padding: 0
			}
			#EmplacementDeMaCarte {
				height: 100%
			}
		</style>
	</head>

	<body>
		<div id="EmplacementDeMaCarte"></div>
		<noscript>
			<p>Attention : </p>
			<p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
			<p>Or, il semble que JavaScript est désactivé ou qu'il ne soit pas supporté par votre navigateur.</p>
			<p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
		</noscript>
		<script>
			function initialisation() {
				var optionsCarte = {
					zoom: 8,
					center: { lat: 47.389982, lng: 0.688877 }
				};
				var maCarte = new google.maps.Map( document.getElementById("EmplacementDeMaCarte"), optionsCarte );

				var optionsMarqueur = {
					map: maCarte,
					position: maCarte.getCenter(),
					title: "Lat : "+maCarte.getCenter().lat()+" - Lng"+maCarte.getCenter().lng(),
					draggable: true
				};
				var marqueur = new google.maps.Marker( optionsMarqueur );

				google.maps.event.addListener( marqueur, "dragend", function( evenement ) {
					var lat = evenement.latLng.lat(),
						lng = evenement.latLng.lng();
					this.setTitle( "Lat : "+lat+" - Lng"+lng );
				});
			 }
		</script>
		<script async defer  src="https://maps.googleapis.com/maps/api/js?key=InsérezVotreCleAPIGoogleMapsIci&callback=initialisation"></script>
	</body>
</html>
Afficher les latitude et longitude d'un marqueur déplaçable en utilisant dragend
Pour afficher les coordonnées d'un marqueur à la fin de son déplacement, il faut créer un nouvel observateur d'événement sur le marker nommémarqueur, chargé d'observer l'événement dragend
L'événement dragend sera déclenché lorsque vous cesserez de déplacer le marqueur mobile.
A cet instant précis, un objet evenement, contenant diverses informations dont le nouvel emplacement du marqueur, est transmis à la fonction chargée du traitement :

google.maps.event.addListener( marqueur, "dragend"; function( evenement ) {
	...
});
Enfin, la fonction chargée du traitement de l'événement dragend va :

extraire les nouvelles coordonnées du marqueur :
var lat = evenement.latLng.lat(),
	lng = evenement.latLng.lng();
puis les afficher dans des balises <span/> ayant pour identifiant id="positionMarkerLatitude" et id="positionMarkerLongitude" :
document.getElementById( "positionMarkerLatitude" ).innerHTML = lat;
document.getElementById( "positionMarkerLongitude" ).innerHTML = lng;
Au final on obtient donc le code suivant :

var optionsMarqueur = {
	map: maCarte,
	position: new google.maps.LatLng( 47.389982, 0.688877 ),
	draggable: true
};
var marqueur = new google.maps.Marker( optionsMarqueur );
google.maps.event.addListener( marqueur, "dragend", function( evenement ) {
	var lat = evenement.latLng.lat(),
		lng = evenement.latLng.lng();
	document.getElementById( "positionMarkerLatitude" ).innerHTML = lat;
	document.getElementById( "positionMarkerLongitude" ).innerHTML = lng;
});
Carte : afficher les latitude, longitude d'un marqueur déplaçable en utilisant dragend

Latitude : 
Longitude :
Les latitude et longitude du marqueur s'affichent sous la carte une fois que vous avez fini de faire glisser le marqueur.
Code : afficher les latitude, longitude d'un marqueur déplaçable en utilisant dragend
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
		<meta charset="UTF-8" />
		<title>Titre de votre page</title>
		<style>
			html, body {
				height: 100%;
				margin: 0;
				padding: 0
			}
			#EmplacementDeMaCarte {
				height: 90%
			}
			#positionMarker {
				height: 10%
			}
		</style>
	</head>

	<body>
		<div id="EmplacementDeMaCarte"></div>
		<div id="positionMarker">Latitude <span id="positionMarkerLatitude"></span> - Longitude <span id="positionMarkerLongitude"></span></div>
		<noscript>
			<p>Attention : </p>
			<p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
			<p>Or, il semble que JavaScript est désactivé ou qu'il ne soit pas supporté par votre navigateur.</p>
			<p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
		</noscript>
		<script>
			function initialisation() {
				var optionsCarte = {
					zoom: 8,
					center: { lat: 47.389982, lng: 0.688877 }
				};
				var maCarte = new google.maps.Map( document.getElementById("EmplacementDeMaCarte"), optionsCarte );
				var optionsMarqueur = {
					map: maCarte,
					position: maCarte.getCenter(),
					draggable: true
				};
				var marqueur = new google.maps.Marker( optionsMarqueur );
				google.maps.event.addListener( marqueur, "dragend", function( evenement ) {
					var lat = evenement.latLng.lat(),
						lng = evenement.latLng.lng();
					document.getElementById( "positionMarkerLatitude" ).innerHTML = lat;
					document.getElementById( "positionMarkerLongitude" ).innerHTML = lng;
				});
			 }
		</script>
		<script async defer  src="https://maps.googleapis.com/maps/api/js?key=InsérezVotreCleAPIGoogleMapsIci&callback=initialisation"></script>
	</body>
</html>
Afficher les latitude et longitude d'un marqueur déplaçable en utilisant position_changed
La classe Marker héritant de la classe MVCObject, une autre solution consiste à observer les notifications de changement d'état caractéristiques des objets MVCObject.
Ainsi, l'API va déclencher un événement position_changed sur le marqueur chaque fois que celui-ci voit changer sa position et donc sa propriété position.
Il suffit donc de créer un nouvel observateur d'événement sur le marqueur nommé marqueur, chargé d'observer l'événement position_changed :

google.maps.event.addListener( marqueur, "position_changed", function() {
	...
});
Et lorsque l'événement position_changed est détecté sur le marqueur :
on récupère l'objet LatLng du marqueur avec la méthode getPosition ensuite, avec les méthodes lat() et lng, on extrait ses latitude et longitude :

	var lat = this.getPosition.lat(),
		lng = this.getPosition.lng();
Au final on obtient donc le code suivant :

var optionsMarqueur = {
	map: maCarte,
	position: new google.maps.LatLng( 47.389982, 0.688877 )
	draggable: true
};
var marqueur = new google.maps.Marker( optionsMarqueur );
google.maps.event.addListener( marqueur, "position_changed" function() {
	var lat = this.getPosition().lat(),
		lng = this.getPosition().lng();
	document.getElementById( "positionMarkerLatitude" ).innerHTML = lat;
	document.getElementById( "positionMarkerLongitude" ).innerHTML = lng;
});
Autre écriture possible la classe Marker héritant de la classe MVCObject :

var optionsMarqueur = {
	map: maCarte,
	position: new google.maps.LatLng( 47.389982, 0.688877 ),
	draggable: true
};
var marqueur = new google.maps.Marker( optionsMarqueur );
google.maps.event.addListener( marqueur, "position_changed", function() {
	var lat = this.get("position").lat(),
		lng = this.get("position").lng();
	document.getElementById( "positionMarkerLatitude" ).innerHTML = lat;
	document.getElementById( "positionMarkerLongitude" ).innerHTML = lng;
});
Carte : afficher les latitude, longitude d'un marqueur déplaçable en utilisant position_changed

Latitude : 
Longitude :
Durant toute la durée du déplacement du marqueur ses latitude et longitude s'affichent en temps réel sous la carte.
Code : afficher les latitude, longitude d'un marqueur déplaçable en utilisant position_changed
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
		<meta charset="UTF-8" />
		<title>Titre de votre page</title>
		<style>
			html, body {
				height: 100%;
				margin: 0;
				padding: 0
			}
			#EmplacementDeMaCarte {
				height: 90%
			}
			#positionMarker {
				height: 10%
			}
		</style>
	</head>

	<body>
		<div id="EmplacementDeMaCarte"></div>
		<div id="positionMarker">Latitude <span id="positionMarkerLatitude"></span> - Longitude <span id="positionMarkerLongitude"></span></div>
		<noscript>
			<p>Attention : </p>
			<p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
			<p>Or, il semble que JavaScript est désactivé ou qu'il ne soit pas supporté par votre navigateur.</p>
			<p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
		</noscript>
		<script>
			function initialisation() {
				var optionsCarte = {
					zoom: 8,
					center: { lat: 47.389982, lng: 0.688877 }
				};
				var maCarte = new google.maps.Map( document.getElementById("EmplacementDeMaCarte"), optionsCarte );
				var optionsMarqueur = {
					map: maCarte,
					position: maCarte.getCenter(),
					draggable: true
				};
				var marqueur = new google.maps.Marker( optionsMarqueur );
				google.maps.event.addListener( marqueur, "position_changed", function() {
					var lat = this.getPosition().lat(),
						lng = this.getPosition().lng();
					document.getElementById( "positionMarkerLatitude" ).innerHTML = lat;
					document.getElementById( "positionMarkerLongitude" ).innerHTML = lng;
				});
			 }
		</script>
		<script async defer  src="https://maps.googleapis.com/maps/api/js?key=InsérezVotreCleAPIGoogleMapsIci&callback=initialisation"></script>
	</body>
</html>
Qu'elles sont les différences entre dragend et position_changed
Si le résultat apparent de ces deux codes est identique, il existe une énorme différence au niveau des événements eux même et de leur gestion.

dragend
dragend est un événement utilisateur : un objet evenement, contenant diverses informations, est transmis à la fonction chargée du traitement.
La mise à jour de la propriété title n'intervient qu'une fois le déplacement du marqueur terminé.

position_changed
position_changed est un changement d'état MVC : aucun objet evenement n'est transmis à la fonction chargée du traitement.
Pour analyser la propriété ayant changé, il faut appeler la méthode getNomPropriete() ou pour un objet MVC get( "NomPropriete").
La mise à jour de la propriété title intervient tout au long du déplacement du marqueur.

Pour plus d'information sur les événements et leur gestion lisez : Gestion des événements event dans l'API Google Maps JavaScript V3.


 
Les articles figurant sur le site https://www.touraineverte.fr sont protégés par le droit d'auteur.

Il est interdit de copier et/ou diffuser tout ou partie de ces articles hors du site www.touraineverte.fr sans l'accord de l'auteur.

Le droit d’auteur s’acquiert sans formalités, du fait même de la création de l’oeuvre. La création est donc protégée à partir du jour où l'auteur l'a réalisée.
GOOGLE API
Google Maps API V3 • Google Directions API • Google Distance Matrix API • Google Elevation API • Google Geocoding API • Google Time Zone API • Google Places API • Google Static Maps API V2 • Street View Image • Google Maps Tracks API • Google Maps Coordinate API • Google Maps Android API
RÉFÉRENCE GOOGLE MAPS JAVASCRIPT API V3
Reference Google Maps API • MVCObject • MVCArray • Map • MapOptions • Marker • MarkerOptions • InfoWindow • InfoWindowOptions • Polyline • PolylineOptions • Polygon • PolygonOptions • GroundOverlay • GroundOverlayOptions • Geocoder • BicyclingLayer • FusionTablesLayer • TrafficLayer • KmlLayer • TransitLayer • StreetViewPanorama • LatLng • LatLngBounds • Point • Size
LIBRARIES GOOGLE
Drawing Library Google Maps • Geometry Library Google Maps • Places Library Google Maps • Visualization Library Google Maps •
NOUS SUIVRE
Vincent Touraineverte (Google+) • TouraineVerte (Page Google+) • Facebook • Twitter • Youtube
INFOS
Vincent © 2018 TouraineVerte • Mentions légales • Plan du site • Flux RSS • Mail • Haut de page
