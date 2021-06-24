<!-- Displays a map -->
<div id="map"></div>

<div class="container card mt-5 pubsearch">
	<div class="card-body">
		<h1>Search for a pub with sports facilities</h1>
		<form action="index.php?p=sports_facilities" method="post">
		<?php if ($error){
			echo '<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			'.$error.'
			</div>';
		}
		?>
		<!-- Based on the submit button being pressed and which sports facility is entered in the select form below it will set the image variable to the correct pin to be used in the geocoding function below,
		calls the getFacility function to grab the pub details based on which sports facility is selected -->
		<?php 
			require_once('classes/users.classes.php');
    		$userObj = new users($DBH);
			 if (isset($_POST['submit3']) && $_POST['sportsfacilitiesboo'] == 'Darts'){
				echo '<script> var image = "images/DartsPin.png";</script>';
				$facilityPub = $userObj->getFacility($_POST['sportsfacilitiesboo']);
			 }elseif (isset($_POST['submit3']) && $_POST['sportsfacilitiesboo'] == 'Pool Table'){
				echo '<script> var image = "images/PoolPin.png";</script>';
				$facilityPub = $userObj->getFacility($_POST['sportsfacilitiesboo']);
			 }elseif (isset($_POST['submit3']) && $_POST['sportsfacilitiesboo'] == 'Skittles'){
				echo '<script> var image = "images/SkittlesPin.png";</script>';
				$facilityPub = $userObj->getFacility($_POST['sportsfacilitiesboo']);
			}elseif (isset($_POST['submit3']) && $_POST['sportsfacilitiesboo'] == 'Snooker Table'){
				echo '<script> var image = "images/SnookerPin.png";</script>';
				$facilityPub = $userObj->getFacility($_POST['sportsfacilitiesboo']);
			 }else{
				echo '<script> var image = "";</script>';
				$facilityPub = $userObj->getFacility('jikjjj');
			 }
		?>
		<script>
		/* the facilityPub variable is wrote out into an array using json_encode, this is used to loop through each pub and to display a marker on the map for each pub */
			function sportsfacilitymap() {
				var map2;
				var geocoder3;
				var markerCoords;
				var facilityPub = <?php echo json_encode($facilityPub); ?>;
				var sportsfacilityaddress;
				var sportsfacilityname;
				var address = [];
				var count;
				var Name;
				var count1 = 0;
				
				/* Creates a new map */
				const map = new google.maps.Map(document.getElementById('map'), {
					center: { lat: 51.5074, lng: 0.1278},
					zoom: 5,
				});
				
				var infoWindow = new google.maps.InfoWindow;
				
				/* Loops through each address and geocodes coords for each address */
				while (facilityPub.length >0){
					sportsfacilityaddress = facilityPub[0]['address'];
					sportsfacilityname = facilityPub[0]['pubname'];
					address.push(sportsfacilityaddress);
					geocoder3 = new google.maps.Geocoder();
					GeocodeMarker(address);
					count1 = count1 + 1;
					facilityPub.shift();
				}
				
				function GeocodeMarker (address){
					count = 0;
					geocoder3.geocode( { 'address': address[count1]},
					function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							markerCoords = results[0].geometry.location;
							Name = results[0].formatted_address;
							console.log(results);
							createMarker(markerCoords);
							count = count + 1;
						}
					});
				}
				
				/* creates a marker based on the geocoding coords, uses the images set above based on which sportsfacilitiesboo is set in the form */
				function createMarker(markerCoords){
					var infowincontent = document.createElement('div');
					var strong = document.createElement('strong');
					strong.textContent = Name
					infowincontent.appendChild(strong);
					var marker = new google.maps.Marker({
						title: Name,
						position:  markerCoords,
						map: map,
						icon: image,
					});
					marker.addListener("click", function() {
						infoWindow.setContent(infowincontent);
						infoWindow.open(map, marker);
					});
				}
				
			}
		</script>
			<div class="form-group sportsfacilitiesboo">
				<label for="sportsfacilities">Sports Facilities:</label>
					<select class="form-control" id="sportsfacilitiesboo" name="sportsfacilitiesboo">
						<option value="">Sports Facilities</option>
						<option value="Darts">Darts</option>
						<option value="Pool Table">Pool Table</option>
						<option value="Skittles">Skittles</option>
						<option value="Snooker Table">Snooker Table</option>
					</select>
			</div>
			<div class="col text-center">
				<button type="submit" id="submit3" class="btn btn-default" name="submit3">Search</button>
			</div>
		</form>
	</div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCm3Wh8Oyqa2OFmeyad1LdfRsCuxn5_NDE&callback=sportsfacilitymap&libraries=&v=weekly" async></script>