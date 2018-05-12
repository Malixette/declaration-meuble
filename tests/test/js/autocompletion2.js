var options = {
    types: ['(cities)'],
    componentRestrictions: {country: 'ca'}
 };
 var input = document.getElementById('where');
 autocomplete = new google.maps.places.Autocomplete(input, options);
 