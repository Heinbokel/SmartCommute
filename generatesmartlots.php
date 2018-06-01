<!DOCTYPE html>
<html>
<head>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
<h3>Smart Lot Locations:</h3>
<div id="map"></div>
<script>
    function initMap() {
        var petoskey = {lat: 45.391862, lng: -84.918852};
        var bearRiver = {lat:45.364791 , lng:-84.962198};
        var harbor = {lat:45.427690 , lng:-84.913011};
        var eastPark ={lat:45.369330 , lng:-85.003738};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            center: petoskey
        });
        var markerPetoskey = new google.maps.Marker({
            position: petoskey,
            map: map
        });
        var markerBearRiver = new google.maps.Marker({
            position: bearRiver,
            map: map
        });
        var markerHarbor = new google.maps.Marker({
            position: harbor,
            map: map
        });
        var markerEastPark = new google.maps.Marker({
            position: eastPark,
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBROwPng2i6c46iA9Sk3ST120IYiLn6Mtw&callback=initMap">
</script>
</body>
</html>