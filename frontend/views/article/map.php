<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $map['title'];?></title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
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
    </style>
    <script>
   const citymap = {
        chicago: {
          center: { lat: <?php echo $map['lat'];?>, lng:<?php echo $map['lng'];?> },
          population: 271,
        },
       
      };

      function initMap() {
        // Create the map.
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 14,
          center: { lat: <?php echo $map['lat'];?>, lng:<?php echo $map['lng'];?> },
          mapTypeId: "terrain",
        });

        // Construct the circle for each value in citymap.
        // Note: We scale the area of the circle based on the population.
        for (const city in citymap) {
          // Add the circle for this city to the map.
          const cityCircle = new google.maps.Circle({
            strokeColor: "#FF0000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#FF0000",
            fillOpacity: 0.35,
            map,
            center: citymap[city].center,
            radius: Math.sqrt(citymap[city].population) * 100,
          });
        }
      }
    </script>
  </head>
  <body>
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZRndzLg2xfkvmo7LVrHpPL8_AmmfKibA&callback=initMap&libraries=&v=weekly"
      async
    ></script>
  </body>
</html>
