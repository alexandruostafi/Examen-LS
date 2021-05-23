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
    <h3>My Google Maps Demo</h3>
    <div id="map"></div>
    <script>
        function initMap() {
            var uluru = {
                lat: -25.363,
                lng: 131.044
            };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                center: uluru
            });
            
			<?php
	$conn=mysqli_connect("localhost", "root", "") or die(mysqli_error());
	mysqli_select_db($conn, "pai");

	$sql_read = "SELECT * FROM locatii";

	$result = mysqli_query($conn, $sql_read);
	if(! $result )
	{
		die('Could not read data: ' . mysqli_error());
	}
	while($row = mysqli_fetch_array($result)) {
			$lat = $row['Latitudine'];
			$lng = $row['Longitudine'];
		echo "var marker = new google.maps.Marker({position:{lat:$lat,lng:$lng}\n, map: map, label : '".$row['Nume']."'});";
		echo "iconFile = 'http://maps.google.com/mapfiles/ms/icons/". $row['Culoare'] . "-dot.png';";
		echo "marker.setIcon(iconFile);\n";
		}
			?>
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByKEo-eVV5YXXbbpGUsL7_Leuxb8c543U&callback=initMap">
    </script>
    <button onclick="window.location.href='home.php'">Home</button>
</body>

</html>
