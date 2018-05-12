<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>autocomplete</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>

    <form>
        <div class="form-group">
            <label for="heb_nom">Nom de votre hébergement</label>
            <input type="text" id="heb_nom" class="form-control" placeholder="Nom de votre hébergement" required>
        </div>
        <div class="form-group">
            <label for="user_input_autocomplete_address">Addresse</label>
            <input id="user_input_autocomplete_address" class="form-control" placeholder="Adresse de votre hébergement" type="text">
        </div>
        <div class="form-group">
            <label for="adresse_complement">Complément d'adresse</label>
            <input type="text" id="adresse_complement" class="form-control" placeholder="Complément d'adresse" >
        </div>
        <div class="form-group">
            <label for="batiment">Bâtiment</label>
            <input type="text" id="batiment" class="form-control" placeholder="batiment">
        </div>
        <div class="form-group">
            <label for="nombre_etage">Etage</label>
            <input type="number" id="nombre_etage" class="form-control" placeholder="Numéro d'étage (0 correspondant à rez-de-chaussée)" required>
        </div>
        <div class="form-group">
        <label>Type de logement</label>
            <select name="type_hebergement">
                <option value="appartement">Appartement</option> 
                <option value="maison">Maison</option>
                <option value="autres">Autre</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nbr_piece">Nombre de pièces composant votre hébergement</label>
            <input type="number" id="nbr_piece" name="nombre_piece" placeholder="" required>
        </div>
        <div class="form-group">
            <label for="heb_classe">Votre logement est-il classé? 
                <small>(préfecture, Gîtes de France, Clévacances, etc)</small>
            </label>
            <input type="radio" name="hebergement_classe" id="heb_classe" value="classe">
            <label for="heb_classe">Oui</label>
            <input type="radio" name="hebergement_non_classe" id="heb_non_classe" value="nonClasse">
            <label for="heb_non_classe">Non</label>
        </div>
            <input type="checkbox" id="prefecture" name="prefecture" value="">
            <label for="prefecture">Classé préfecture (Etoiles)</label>
        <div class="form-group">
            <input type="checkbox" id="clevacances" name="clevacances" value="">
            <label for="clavacances">Clévacances (Clés)</label>
        </div>
        <div class="form-group">
            <input type="checkbox" id="gitesDeFrance" name="gitesDeFrance" value="">
            <label for="gitesDeFrance">Gîtes de France (Epis)</label>
        </div>
        <div class="form-group">
            <label for="dateClassement">Quel est la date de votre classement?</label>
            <input type="date" id="dateClassement" name="dateClassement">
        </div>
        <div class="form-group">
            <label>A quelle(s) période(s) votre hébergement est loué?</label>
            <input type="checkbox" id="location_hiver" name="location_hiver" value="Hiver">
            <label for="location_hiver">Hiver</label>
            <input type="checkbox" id="location_printemps" name="location_printemps" value="Printemps">
            <label for="location_printemps">Printemps</label>
            <input type="checkbox" id="location_ete" name="location_ete" value="Eté">
            <label for="location_ete">Eté</label>
            <input type="checkbox" id="location_automne" name="location_automne" value="Automne">
            <label for="location_automne">Automne</label>
        </div>        
        <div class="form-group">
            <textarea name="textarea" maxlength="200" rows="10" cols="50" placeholder="Descriptif de votre hébergement" id="heb_descriptif"></textarea>
            <label for="heb_descriptif" name="descriptif"></label>
        </div>
        <div class="form-group">
                <input type="file" name="photo1" class="form-control-file" placeholder="Photo principale"/>
                <input type="file" name="photo2" class="form-control-file" placeholder="Photo 2"/>
                <input type="file" name="photo3" class="form-control-file" placeholder="Photo 3"/>
                <input type="file" name="photo4" class="form-control-file" placeholder="Photo 4"/>
        </div>
        <div class="form-group">
            <label>Site internet de votre hébergement</label>
            <input type="text" name="heb_site_web" placeholder="www.">
        </div>
        <div class="form-group">
                <label>Si différent, adresse du site internet pour réserver votre hébergement</label>
                <input type="text" class="form-control" name="heb_site_resa" placeholder="ex : booking, gites-de-france, etc.">
        </div>           
        <div class="form-group">
                <label>Nom de la personne ou de la structure à contacter pour réserver votre hébergement</label>
                <input type="text" class="form-control" name="heb_contact_resa">
        </div>           
        <div class="form-group">
            <label>Email de la personne ou de la structure pour réserver votre hébergement</label>
            <input type="text" class="form-control" name="heb_email_resa" placeholder="Email de contact pour réservation">
        </div>           
        <div class="form-group">
            <label>Téléphone de la personne ou de la structure pour réserver votre hébergement</label>
            <input type="text" class="form-control" name="heb_tel_resa" placeholder="Téléphone de contact pour réservation">
        </div>           
        
            <button type="submit">Envoyer le message</button>
    
    
    
    
    
    
    <label>street_number</label>
    <input id="street_number" name="street_number" disabled type="number">
    <label>route</label>
    <input id="route" name="route" type="text" disabled>
    <label>locality</label>
    <input id="locality" name="locality" type="text" disabled>
    <label>country</label>
    <input id="country" name="country" type="text" disabled>
    </form>   


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVHTurRNPGNOsAA6Nuocp_nz9jN2APhck&libraries=places"></script>
<script>
    function initializeAutocomplete(id) {
    var element = document.getElementById(id);
        if (element) {
            var autocomplete = new google.maps.places.Autocomplete(element, { types: ['geocode'] });
            google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
        }
    }

    function onPlaceChanged() {
    var place = this.getPlace();

    // console.log(place);  // Uncomment this line to view the full object returned by Google API.

        for (var i in place.address_components) {
            var component = place.address_components[i];google.maps.places.Autocomplete
            
            for (var j in component.types) {  // Some types are ["country", "political"]
            var type_element = document.getElementById(component.types[j]);
                if (type_element) {
                type_element.value = component.long_name;
                }
            }
        }
    }

    google.maps.event.addDomListener(window, 'load', function() {
    initializeAutocomplete('user_input_autocomplete_address');
    });

    </script>

</body>
</html>