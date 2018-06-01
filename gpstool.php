<!doctype html>
<html class="no-js">
<head>
    <link rel="icon" href="images/SmartCommuteLogo.jpg">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Michigan Trails Council smart commute rewards program.">
    <meta name="keywords" content="Michigan, bike, trails, run, smart commute, commute">
    <meta name="author" content="Robert Heinbokel">
    <title>Michigan Trails Smart Commute: GPS Entry</title>

    <script src="http://cdn.pubnub.com/pubnub-3.7.1.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <style>
        html, body, #map-canvas {
            height: 300px;
            margin: 0px;
            padding: 0px
        }
    </style>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBROwPng2i6c46iA9Sk3ST120IYiLn6Mtw"></script>

</head>
<body>
<div class="container">
    <h2>GPS Commute Status:</h2>
    <p>This will work once site is live. Requires security certificate.</p>
</div>
<div id="map-canvas"></div>

<!-- Map Configuration and data -->
<script>
    var map;
    var map_marker;
    var lat = null;
    var lng = null;
    var lineCoordinatesArray = [];

    // sets your location as default
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
                var locationMarker = null;
                if (locationMarker){
                    // return if there is a locationMarker bug
                    return;
                }

                lat = position.coords["latitude"];
                lng = position.coords["longitude"];

                // calls PubNub
                pubs();

                // initialize google maps
                google.maps.event.addDomListener(window, 'load', initialize());

            },
            function(error) {
                console.log("Error: ", error);
            },
            {
                enableHighAccuracy: true
            }
        );
    }


    function initialize() {
        console.log("Google Maps Initialized")
        map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 15,
            center: {lat: lat, lng : lng, alt: 0}
        });

        map_marker = new google.maps.Marker({position: {lat: lat, lng: lng}, map: map});
        map_marker.setMap(map);
        document.getElementById("latitudeShow").innerHTML="latitude: " + lat;
        document.getElementById("longitudeShow").innerHTML="longitude: " + lng;

    }

    // moves the marker and center of map
    function redraw() {
        map.setCenter({lat: lat, lng : lng, alt: 0})
        map_marker.setPosition({lat: lat, lng : lng, alt: 0});
        pushCoordToArray(lat, lng);

        var lineCoordinatesPath = new google.maps.Polyline({
            path: lineCoordinatesArray,
            geodesic: true,
            strokeColor: 'darkcyan',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

        lineCoordinatesPath.setMap(map);

    }


    function pushCoordToArray(latIn, lngIn) {
        lineCoordinatesArray.push(new google.maps.LatLng(latIn, lngIn));
    }


    function pubs() {
        pubnub = PUBNUB.init({
            publish_key: 'pub-c-05689563-c009-4718-95ef-5693489d7cf7',
            subscribe_key: 'sub-c-68f88146-1885-11e7-aca9-02ee2ddab7fe'
        })

        pubnub.subscribe({
            channel: "mymaps",
            message: function(message, channel) {
                console.log(message)
                lat = message['lat'];
                lng = message['lng'];
                //custom method
                redraw();
            },
            connect: function() {console.log("PubNub Connected")}
        })
    }
</script>
<div id="latitudeShow" style="width:100%;margin:0 auto; text-align:center;"></div>
<div id="longitudeShow" style="width:100%;margin:0 auto; text-align:center;"></div>

<div style="width:100%;margin:0 auto; text-align:center;">
<input type="button" id="startGPS" value="Start Trip" onclick="startCommute()" style ="width:100px; margin:10px auto; padding:10px;">
<input type="button" id="endGPS" value="End Trip" style ="width:100px; margin:10px auto; padding:10px;">
</div>
</body>
</html>