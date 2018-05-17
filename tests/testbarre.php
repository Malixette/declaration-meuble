<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Slider - Range with fixed maximum</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  
</head>
<body>
 
<p>
  <label for="amount">Minimum number of bedrooms:</label>
  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
</p>
<div id="slider-prefecture"></div>
<div id="slider-giteDeFrance"></div>
<div id="slider-clevacances"></div>

 
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  
  $( function() {
    $( "#slider-prefecture" ).slider({
      range: "max",
      min: 0,
      max: 5,
      value: 0,
      slide: function( event, ui ) {
        $( "#amount1" ).val( ui.value );
      }
    });
    $( "#amount1" ).val( $( "#slider-prefecture" ).slider( "value" ) );
  } );
  
$( function() {
$( "#slider-giteDeFrance" ).slider({
  range: "max",
  min: 0,
  max: 5,
  value: 0,
  slide: function( event, ui ) {
    $( "#amount2" ).val( ui.value );
  }
});
$( "#amount2" ).val( $( "#slider-giteDeFrance" ).slider( "value" ) );
} );
  
 $( function() {
    $( "#slider-clevacances" ).slider({
      range: "max",
      min: 0,
      max: 5,
      value: 0,
      slide: function( event, ui ) {
        $( "#amount3" ).val( ui.value );
      }
    });
    $( "#amount3" ).val( $( "#slider-clevacances" ).slider( "value" ) );
  } );
  
  
  </script>
</body>
</html>