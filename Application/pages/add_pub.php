<!-- Have to be logged in to enter the page -->
<?php
	
	if(!$_SESSION['loggedin']){
		//User is not logged in
		echo "<h1>Access Denied</h1>";
		echo "<script> window.location.assign('index.php?p=login'); </script>";
		exit;
	}
	
?>
<!-- displays the map -->
<div id="map"></div>

<div class="container card mt-5 addpub">
	<div class="card-body">
		<h1>Add Pub</h1>
		<form action="index.php?p=add_pub" method="post">
		<?php if ($error){
			echo '<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			'.$error.'
			</div>';
		}
		?>
		
			<div class="form-group">
				<label for="pubname">Pub Name:</label>
				<input type="text" class="form-control" id="pubname" name="pubname" placeholder="Pub Name">
			</div>
			<div class="form-group">
				<label for="address">Address:</label>
				<input type="text" class="form-control" id="address" name="address" placeholder="Address">
			</div>
			<div class="form-group">
				<label for="postcode">Postcode:</label>
				<input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode">
			</div>
			<div class="form-group livesportschannel">
				<label for="livesportschannel">Live Sports Channel:</label>
					<select class="form-control" id="livesportschannel" name="livesportschannel">
						<option value="">Live Sports Channel</option>
						<option value="BBC Sports">BBC Sports</option>
						<option value="BT Sports">BT Sports</option>
						<option value="Sky Sports">Sky Sports</option>
					</select>
			</div>
			<button class="btn btn-default" id="livesportsadd" type="button" style="margin-bottom: 5px;">Add another live sports channel</button>
			<div class="form-group" id="livesportschannelb">
				<label for="livesportschannel2">Live Sports Channel:</label>
					<select class="form-control" id="livesportschannel2" name="livesportschannel2">
						<option value="">Live Sports Channel</option>
						<option value="BBC Sports">BBC Sports</option>
						<option value="BT Sports">BT Sports</option>
						<option value="Sky Sports">Sky Sports</option>
					</select>
			</div>
			<button class="btn btn-default" id="livesportsadd2" type="button" style="margin-bottom: 5px; display: none;">Add another live sports channel</button>
			<div class="form-group" id="livesportschannelc">
				<label for="livesportschannel3">Live Sports Channel:</label>
					<select class="form-control" id="livesportschannel3" name="livesportschannel3">
						<option value="">Live Sports Channel</option>
						<option value="BBC Sports">BBC Sports</option>
						<option value="BT Sports">BT Sports</option>
						<option value="Sky Sports">Sky Sports</option>
					</select>
			</div>
			<div class="form-group sportsfacilities">
				<label for="sportsfacilities">Sports Facilities:</label>
					<select class="form-control" id="sportsfacilities" name="sportsfacilities">
						<option value="">Sports Facilities</option>
						<option value="Darts">Darts</option>
						<option value="Pool Table">Pool Table</option>
						<option value="Skittles">Skittles</option>
						<option value="Snooker Table">Snooker Table</option>
					</select>
			</div>
			<button class="btn btn-default" id="sportsfacilityadd" type="button" style="margin-bottom: 5px;">Add another live sports channel</button>
			<div class="form-group" id="sportsfacilitiesb">
				<label for="sportsfacilities2">Sports Facilities:</label>
					<select class="form-control" id="sportsfacilities2" name="sportsfacilities2">
						<option value="">Sports Facilities</option>
						<option value="Darts">Darts</option>
						<option value="Pool Table">Pool Table</option>
						<option value="Skittles">Skittles</option>
						<option value="Snooker Table">Snooker Table</option>
					</select>
			</div>
			<button class="btn btn-default" id="sportsfacilityadd2" type="button" style="margin-bottom: 5px; display: none;">Add another live sports channel</button>
			<div class="form-group" id="sportsfacilitiesc">
				<label for="sportsfacilities3">Sports Facilities:</label>
					<select class="form-control" id="sportsfacilities3" name="sportsfacilities3">
						<option value="">Sports Facilities</option>
						<option value="Darts">Darts</option>
						<option value="Pool Table">Pool Table</option>
						<option value="Skittles">Skittles</option>
						<option value="Snooker Table">Snooker Table</option>
					</select>
			</div>
			<button class="btn btn-default" id="sportsfacilityadd3" type="button" style="margin-bottom: 5px; display: none;">Add another live sports channel</button>
			<div class="form-group" id="sportsfacilitiesd">
				<label for="sportsfacilities4">Sports Facilities:</label>
					<select class="form-control" id="sportsfacilities4" name="sportsfacilities4">
						<option value="">Sports Facilities</option>
						<option value="Darts">Darts</option>
						<option value="Pool Table">Pool Table</option>
						<option value="Skittles">Skittles</option>
						<option value="Snooker Table">Snooker Table</option>
					</select>
			</div>
			<div class="col text-center">
				<input id="submit1" type="button" class="btn btn-default" value="Add Pub to Map">
				<button type="submit" id="submit" class="btn btn-default" name="submitaddpub">Confirm</button>
			</div>
		</form>
	</div>
</div>
<?php
	/*If parts of the form are set (not the optional fields (more live sports channels or sports facilities) and there are no errors, then the details in the form will be added to the database (uses the POST method to retrieve
	data entered into the form, if there are errors or the required form elements are not filled an error message will display, takes them to a page saying they were successful if a pub is added to the db correctly */
	if (isset($_POST['pubname']) && strlen($_POST['address']) && ($_POST['postcode']) && isset($_POST['livesportschannel']) && isset($_POST['sportsfacilities'])){
		
		if(!$_POST['pubname'] || !$_POST['address'] || !$_POST['postcode'] || !$_POST['livesportschannel'] || !$_POST['sportsfacilities']){
			$error = "Please enter a Pub name, Address, Postcode, Live Sports Channel(s) and Sports Facility(Facilities)";
		}
		
		if(!$error){
			//No errors - let's add the pub
			//Insert DB
			$query = "INSERT INTO Pub (user_id, pubname, address, postcode, livesportschannel, livesportschannel2, livesportschannel3, sportsfacilities, sportsfacilities2, sportsfacilities3, sportsfacilities4) VALUES (:user_id, :pubname, :address, :postcode, :livesportschannel, :livesportschannel2, :livesportschannel3, :sportsfacilities, :sportsfacilities2, :sportsfacilities3, :sportsfacilities4)";
			$result = $DBH->prepare($query);
			$result->bindParam(':user_id',$_SESSION["userData"]["user_id"]);
			$result->bindParam(':pubname',$_POST['pubname']);
			$result->bindParam(':pubname',$_POST['pubname']);
			$result->bindParam(':address',$_POST['address']);
			$result->bindParam(':postcode',$_POST['postcode']);
			$result->bindParam(':livesportschannel',$_POST['livesportschannel']);
			$result->bindParam(':livesportschannel2',$_POST['livesportschannel2']);
			$result->bindParam(':livesportschannel3',$_POST['livesportschannel3']);
			$result->bindParam(':sportsfacilities',$_POST['sportsfacilities']);
			$result->bindParam(':sportsfacilities2',$_POST['sportsfacilities2']);
			$result->bindParam(':sportsfacilities3',$_POST['sportsfacilities3']);
			$result->bindParam(':sportsfacilities4',$_POST['sportsfacilities4']);
			$result->execute();
			
			echo "<script> window.location.assign('index.php?p=pubadded'); </script>";
		}
	}
	
?>
<!-- The google map api key and callback method -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCm3Wh8Oyqa2OFmeyad1LdfRsCuxn5_NDE&callback=initMap&libraries=&v=weekly" async></script>