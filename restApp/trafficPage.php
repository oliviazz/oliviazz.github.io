<!DOCTYPE html>
<html>
 <head>
     <title>Restaurant Traffic View</title>
     <link rel="stylesheet" href="CSS/traffic.css" type="text/css">
  <style type="text/css">
      html, body { height: 100%; padding: 0; align-content: center }
      #map { height: 80%;
             width: 100%;
         margin-left: 30px;
          margin-right: 60px;
          }
  </style>
 </head>
 <body align = "center">
     <?php   
        session_start();
       // echo "<h1 align = \"center\"> Real-Time Traffic near ", $_SESSION['restName'], ": </h1>";
        $name = $_GET["name"];
        str_replace($name, "Y", "&nbsp;");
        echo "<h2 align = \"center\"> Real-Time Traffic near ",$name, ": </h2>";
     ?>
     <div id="lat" >
        <?php  echo $_GET["lat"] ?>
        
     </div>
     <br>
     <div id="long" >
        <?php echo $_GET['long']; ?>
     </div>
     <form>
     Latitude: <input type = "text" id = "lat_coord" value = "40.7127" onKeyPress = "reloadMap(event)">
     Longitude: <input type = "text" id = "long_coord" value = "-74.0059" onKeyPress = "reloadMap(event)">
         <br><br>
     <button type = "button" id = "traffBtn" onClick = "toggleTraffic()"> Hide Traffic</button>
     </form>
     <br>
     <div id = "distance"> 
         Driving Time/Distance: 
     </div>
    <div id="map" align = "center"></div>
     
    <script type="text/javascript">
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();s
  
        var showTraffic = true;
        var map, origin1;
        var trafficLayer;
        
        var lat_coord = parseFloat(document.getElementById('lat').innerHTML);
        var long_coord = parseFloat(document.getElementById('long').innerHTML);
        document.getElementById('lat_coord').value = lat_coord;
        document.getElementById('long_coord').value = long_coord; 
        
        var latdiv = document.getElementById( 'lat' );
        latdiv.parentNode.removeChild( latdiv );
        var longdiv = document.getElementById( 'long' );
        longdiv.parentNode.removeChild(longdiv );
        
        
        if(lat_coord == "" || long_coord == ""){
            lat_coord = 24.3; //Change to Current Location 
            long_coord = 29.3; //Change to Current Location 
        }
        
      function toggleTraffic(){
          if(showTraffic){
              showTraffic = false;
              trafficLayer.setMap(null); 
              document.getElementById('traffBtn').innerHTML = "Show Traffic";
          }
          else{
              showTraffic = true;
              trafficLayer.setMap(map); 
          }
      
          document.getElementById('traffBtn').innerHTML = "Hide Traffic";
      }

      function reloadMap(e){

        var newlat = parseFloat(document.getElementById('lat_coord').value);
        var newlong = parseFloat(document.getElementById('long_coord').value); 
        if(!(newlat != lat_coord || newlong != long_coord || newlat == NaN || newlong == NaN)){
           lat_coord = parseFloat(document.getElementById('lat_coord').value);
           long_coord = parseFloat(document.getElementById('long_coord').value);
           initMap();
        }

      }
      function initMap() {
          directionsDisplay = new google.maps.DirectionsRenderer();
          map = new google.maps.Map(document.getElementById('map'),{
          center: {lat: lat_coord, lng: long_coord},
          zoom: 17
         
          });
          directionsDisplay.setMap(map);
          trafficLayer = new google.maps.TrafficLayer();
          if(showTraffic){
         trafficLayer.setMap(map);
          }
          
           origin1 = new google.maps.LatLng(38.818662, -77.168763);

var destinationA = new google.maps.LatLng(lat_coord, long_coord);

var service = new google.maps.DistanceMatrixService();
service.getDistanceMatrix(
  {
    origins: [origin1],
    destinations: [destinationA],
    travelMode: google.maps.TravelMode.DRIVING,
//    transitOptions: TransitOptions,
//    drivingOptions: DrivingOptions,
//    unitSystem: UnitSystem,
//    avoidHighways: Boolean,
//    avoidTolls: Boolean,
  }, callback);
      }
       

function callback(response, status) {
    if (status == google.maps.DistanceMatrixStatus.OK) {
    var origins = response.originAddresses;
    var destinations = response.destinationAddresses;

    for (var i = 0; i < origins.length; i++) {
      var results = response.rows[i].elements;
      for (var j = 0; j < results.length; j++) {
        var element = results[j];
        var distance = element.distance.text;
        var duration = element.duration.text;
        document.getElementById('distance').innerHTML += (duration + ", " + distance);
        var from = origins[i];
        var to = destinations[j];
      }
    }
  }
}

        
  </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNSYDKc0j6v9C5vqog8jE79WEIjq7VwOo&callback=initMap">
    </script>
  
    
 </body>
</html>