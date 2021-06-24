<!-- Displays the map -->
<div id="map"></div>

<div class="container card mt-5 pubsearch">
	<div class="card-body">
		<h1>Search for a pub with live sports channels</h1>
		<form action="index.php?p=live_sports" method="post">
		<?php if ($error){
			echo '<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			'.$error.'
			</div>';
		}
		?>
		<!-- Based on the submit button being pressed and which live sports channel is entered in the select form below it will set the image variable to the correct pin to be used in the geocoding function below,
		calls the getChannel function to grab the pub details based on which live sports channel is selected -->
		<?php 
			require_once('classes/users.classes.php');
    		$userObj = new users($DBH);
			 if (isset($_POST['submit2']) && $_POST['livesportschannelboo'] == 'BBC Sports'){
				echo '<script> var image = "images/BbcPin.png";</script>';
				$addressPub = $userObj->getChannel($_POST['livesportschannelboo']);
			 }elseif (isset($_POST['submit2']) && $_POST['livesportschannelboo'] == 'BT Sports'){
				echo '<script> var image = "images/BtPin.png";</script>';
				$addressPub = $userObj->getChannel($_POST['livesportschannelboo']);
			 }elseif (isset($_POST['submit2']) && $_POST['livesportschannelboo'] == 'Sky Sports'){
				 echo '<script> var image = "images/SkyPin.png";</script>';
				$addressPub = $userObj->getChannel($_POST['livesportschannelboo']);
			 }else{
				 echo '<script> var image = "";</script>';
				 $addressPub = $userObj->getChannel('jikjjj');
			 }
		?>
		<script>
			/* the adressPub variable is wrote out into an array using json_encode, this is used to loop through each pub and to display a marker on the map for each pub */
			function livesportsmap() {
				var map2;
				var geocoder2;
				var markerCoords;
				var addressPub = <?php echo json_encode($addressPub); ?>;
				var livesportsaddress;
				var livesportsname;
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
				while (addressPub.length >0){
					livesportsaddress = addressPub[0]['address'];
					livesportsname = addressPub[0]['pubname'];
					address.push (livesportsaddress);
					geocoder2 = new google.maps.Geocoder();
					GeocodeMarker(address);
					count1 = count1 + 1;
					addressPub.shift();
				}
				
				function GeocodeMarker (address){
					count = 0;
					geocoder2.geocode( { 'address': address[count1]}, 
					function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							markerCoords = results[0].geometry.location;
							Name = results[0].formatted_address;
							createMarker(markerCoords);
							count = count + 1;
						}
					});
				}
				
				/* creates a marker based on the geocoding coords, uses the images set above based on which livesportschannelboo is set in the form */
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
			<div class="form-group livesportschannelboo">
				<label for="livesportschannel">Live Sports Channel:</label>
					<select class="form-control" id="livesportschannelboo" name="livesportschannelboo">
						<option value="">Live Sports Channel</option>
						<option value="BBC Sports">BBC Sports</option>
						<option value="BT Sports">BT Sports</option>
						<option value="Sky Sports">Sky Sports</option>
					</select>
			</div>
			<div class="col text-center">
				<button type="submit" id="submit2" class="btn btn-default" name="submit2">Search</button>
			</div>
		</form>
	</div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCm3Wh8Oyqa2OFmeyad1LdfRsCuxn5_NDE&callback=livesportsmap&libraries=&v=weekly" async></script>