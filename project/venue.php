


	<?php

require_once("conn.php");
$venueid = $_GET['venue'];
$venuequery = "SELECT * FROM venues WHERE venueID = $venueid";
$results = $dbConn->query($venuequery)
or die ('problem with query: ' . $dbConn->error);

while ($venuerow = $results->fetch_assoc()) {
	$latitude = $venuerow["latitude"];
	$longitude = $venuerow["longitude"];
	?>

	<!DOCTYPE html>
    <html lang="en">
		<head>
			<meta charset="utf-8">
    		<title> TWA Project A-League Ladder </title>
    		<link rel="stylesheet" href="css/projectMaster.css">
            <style type="text/css">

                </style>
    	   </head>
        <body>
			<nav class="nav">
				<div = class ="homePage">
					<a href="index.php">A-League</a> <br> <br>
				</div>
				<a href="ladder.php">Ladder</a>
				<a href="fixtures.php">Fixtures </a>
				<a href="scoreEntry.php">Enter Results</a>
				<?php if (isset($_SESSION["password"])){?>
					<a class = "logoff" href="logoff.php">Logoff</a>
				<?php } else { ?>
					<a class = "logoff" href="login.php">Login</a>
				<?php } ?>
			</nav>
			<script>


// Initialize and add the map
      function initMap() {
        var longitude = <?php echo $longitude ?>;
        var latitude = <?php echo $latitude ?>;
        // The location of Uluru
        const venueLocation = { lat: latitude, lng: longitude };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("mapSize"), {
          zoom: 15,
          center: venueLocation,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
          position: venueLocation,
          map: map,
        });
      }


</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9Uv3GBri_zroYJx3XStQlF3etFM_9LHw&callback=initMap&libraries=&v=weekly"async></script>
<!-- the maps Initialization was assisted and custimized by the following resource below -->
<!-- reference: https://developers.google.com/maps/documentation/javascript/adding-a-google-map -->

<h2> Venue: <?php echo $venuerow["venueName"]; ?> </h2>
<h3> Address: <?php echo $venuerow["address"]; ?> </h3>
<?php } ?>

<div id="mapSize"></div>
<!-- display the map here  -->



</body>
</html>
