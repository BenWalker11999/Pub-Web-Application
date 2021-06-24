/*Creates a new map, if the user clicks show on map on the addpub page then a marker will show on the map based on the address typed into the addpub form*/
function initMap() {
	const map = new google.maps.Map(document.getElementById('map'), {
		center: { lat: 51.5074, lng: 0.1278},
		zoom: 5,
	});
	
	const geocoder = new google.maps.Geocoder();
	document.getElementById("submit1").addEventListener("click", () => {
		geocodeAddress(geocoder, map);
	});
	 
}

function geocodeAddress(geocoder, resultsMap) {
	const address = document.getElementById("address").value;
	geocoder.geocode({ 'address': address }, (results, status) => {
		if (status === "OK") {
			resultsMap.setCenter(results[0].geometry.location);
			new google.maps.Marker({
				map: resultsMap,
				position: results[0].geometry.location,
			});
		} else {
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}

