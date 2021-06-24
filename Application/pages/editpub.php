<!-- The user must be logged in to access the page -->
<?php
	if(!$_SESSION['loggedin']){
		//User is not logged in
		echo "<h1>Access Denied</h1>";
		echo "<script> window.location.assign('index.php?p=login'); </script>";
		exit;
	}
?>
<div class="container card mt-5 editpub">
	<div class="card-body">
		<h1>Edit details of the pub</h1>
		<!-- Similar to the editaccount page, we can allow a user to edit a pub based on whats entered into the form below, uses the pub_id set in the url in the account page to ensure the correct pub details are edited, 
		calls the updatePub function -->
		<?php
    		//Include users class
    		require_once('classes/users.classes.php');
    		$userObj = new users($DBH); //Lets pass through our DB connection

    		if(isset($_POST['submit'])){

    			$update = $userObj->updatePub($_GET['id'], $_POST['pubname'], $_POST['address'], $_POST['postcode'], $_POST['livesportschannel'], $_POST['livesportschannel2'], 
				$_POST['livesportschannel3'], $_POST['sportsfacilities'], $_POST['sportsfacilities2'], $_POST['sportsfacilities3'], $_POST['sportsfacilities4']); 

    			if($update){
    				echo '<div class="alert alert-success" role="alert">Your profile has been updated!</div>';
    			}
    			
    		}
			
			/* Gets the current pub details to be used in the form and upon submission, this is done by using the id set in the url and calling the getPub function to retrieve the pub details */
			$pub_id = $_GET['id'];
    		$currentPub = $userObj->getPub($pub_id); //Call the getPub function
    	?>

    	<form method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
				<label for="pubname">Pub Name:</label>
				<input type="text" class="form-control" id="pubname" name="pubname" value="<?php echo $currentPub['pubname']; ?>">
			</div>
			<div class="form-group">
				<label for="address">Address:</label>
				<input type="text" class="form-control" id="address" name="address" value="<?php echo $currentPub['address']; ?>">
			</div>
			<div class="form-group">
				<label for="postcode">Postcode:</label>
				<input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $currentPub['postcode']; ?>">
			</div>
			<div class="form-group">
				<label for="livesportschannel">Live Sports Channel:</label>
					<select class="form-control" id="livesportschannel" name="livesportschannel">
						<option value=""<?php if ($currentPub['livesportschannel'] == '') echo ' selected="selected"'; ?>>Live Sports Channel</option>
						<option value="BBC Sports"<?php if ($currentPub['livesportschannel'] == 'BBC Sports') echo ' selected="selected"'; ?>>BBC Sports</option>
						<option value="BT Sports"<?php if ($currentPub['livesportschannel'] == 'BT Sports') echo ' selected="selected"'; ?>>BT Sports</option>
						<option value="Sky Sports"<?php if ($currentPub['livesportschannel'] == 'Sky Sports') echo ' selected="selected"'; ?>>Sky Sports</option>
					</select>
			</div>
			<div class="form-group">
				<label for="livesportschannel2">Live Sports Channel:</label>
					<select class="form-control" id="livesportschannel2" name="livesportschannel2">
						<option value=""<?php if ($currentPub['livesportschannel2'] == '') echo ' selected="selected"'; ?>>Live Sports Channel</option>
						<option value="BBC Sports"<?php if ($currentPub['livesportschannel2'] == 'BBC Sports') echo ' selected="selected"'; ?>>BBC Sports</option>
						<option value="BT Sports"<?php if ($currentPub['livesportschannel2'] == 'BT Sports') echo ' selected="selected"'; ?>>BT Sports</option>
						<option value="Sky Sports"<?php if ($currentPub['livesportschannel2'] == 'Sky Sports') echo ' selected="selected"'; ?>>Sky Sports</option>
					</select>
			</div>
			<div class="form-group">
				<label for="livesportschannel3">Live Sports Channel:</label>
					<select class="form-control" id="livesportschannel3" name="livesportschannel3">
						<option value=""<?php if ($currentPub['livesportschannel3'] == '') echo ' selected="selected"'; ?>>Live Sports Channel</option>
						<option value="BBC Sports"<?php if ($currentPub['livesportschannel3'] == 'BBC Sports') echo ' selected="selected"'; ?>>BBC Sports</option>
						<option value="BT Sports"<?php if ($currentPub['livesportschannel3'] == 'BT Sports') echo ' selected="selected"'; ?>>BT Sports</option>
						<option value="Sky Sports"<?php if ($currentPub['livesportschannel3'] == 'Sky Sports') echo ' selected="selected"'; ?>>Sky Sports</option>
					</select>
			</div>
			<div class="form-group">
				<label for="sportsfacilities">Sports Facilities:</label>
					<select class="form-control" id="sportsfacilities" name="sportsfacilities">
						<option value=""<?php if ($currentPub['sportsfacilities'] == '') echo ' selected="selected"'; ?>>Sports Facilities</option>
						<option value="Darts"<?php if ($currentPub['sportsfacilities'] == 'Darts') echo ' selected="selected"'; ?>>Darts</option>
						<option value="Pool Table"<?php if ($currentPub['sportsfacilities'] == 'Pool Table') echo ' selected="selected"'; ?>>Pool Table</option>
						<option value="Skittles"<?php if ($currentPub['sportsfacilities'] == 'Skittles') echo ' selected="selected"'; ?>>Skittles</option>
						<option value="Snooker Table"<?php if ($currentPub['sportsfacilities'] == 'Snooker Table') echo ' selected="selected"'; ?>>Snooker Table</option>
					</select>
			</div>
			<div class="form-group">
				<label for="sportsfacilities2">Sports Facilities:</label>
					<select class="form-control" id="sportsfacilities2" name="sportsfacilities2">
						<option value=""<?php if ($currentPub['sportsfacilities2'] == '') echo ' selected="selected"'; ?>>Sports Facilities</option>
						<option value="Darts"<?php if ($currentPub['sportsfacilities2'] == 'Darts') echo ' selected="selected"'; ?>>Darts</option>
						<option value="Pool Table"<?php if ($currentPub['sportsfacilities2'] == 'Pool Table') echo ' selected="selected"'; ?>>Pool Table</option>
						<option value="Skittles"<?php if ($currentPub['sportsfacilities2'] == 'Skittles') echo ' selected="selected"'; ?>>Skittles</option>
						<option value="Snooker Table"<?php if ($currentPub['sportsfacilities2'] == 'Snooker Table') echo ' selected="selected"'; ?>>Snooker Table</option>
					</select>
			</div>
			<div class="form-group">
				<label for="sportsfacilities3">Sports Facilities:</label>
					<select class="form-control" id="sportsfacilities3" name="sportsfacilities3">
						<option value=""<?php if ($currentPub['sportsfacilities3'] == '') echo ' selected="selected"'; ?>>Sports Facilities</option>
						<option value="Darts"<?php if ($currentPub['sportsfacilities3'] == 'Darts') echo ' selected="selected"'; ?>>Darts</option>
						<option value="Pool Table"<?php if ($currentPub['sportsfacilities3'] == 'Pool Table') echo ' selected="selected"'; ?>>Pool Table</option>
						<option value="Skittles"<?php if ($currentPub['sportsfacilities3'] == 'Skittles') echo ' selected="selected"'; ?>>Skittles</option>
						<option value="Snooker Table"<?php if ($currentPub['sportsfacilities3'] == 'Snooker Table') echo ' selected="selected"'; ?>>Snooker Table</option>
					</select>
			</div>
			<div class="form-group">
				<label for="sportsfacilities4">Sports Facilities:</label>
					<select class="form-control" id="sportsfacilities4" name="sportsfacilities4">
						<option value=""<?php if ($currentPub['sportsfacilities4'] == '') echo ' selected="selected"'; ?>>Sports Facilities</option>
						<option value="Darts"<?php if ($currentPub['sportsfacilities4'] == 'Darts') echo ' selected="selected"'; ?>>Darts</option>
						<option value="Pool Table"<?php if ($currentPub['sportsfacilities4'] == 'Pool Table') echo ' selected="selected"'; ?>>Pool Table</option>
						<option value="Skittles"<?php if ($currentPub['sportsfacilities4'] == 'Skittles') echo ' selected="selected"'; ?>>Skittles</option>
						<option value="Snooker Table"<?php if ($currentPub['sportsfacilities4'] == 'Snooker Table') echo ' selected="selected"'; ?>>Snooker Table</option>
					</select>
			</div>
			<div class="col text-center">
				<button type="submit" name="submit" class="btn btn-default">Update Pub</button>
			</div>
			<div class="col text-center">
				<button type="submit" name="deletePub" id="deletePub" class="btn btn-default deletePub" style="margin-top: 10px">Delete Pub</button>
			</div>
			<?php
			/* Calls the deletePub function if the deletePub button is clicked, this passes the current pub_id into the function so it deletes the correct pub */
				if(isset($_POST['deletePub'])){
					$deletePub = $userObj->deletePub($pub_id);
				}
			?>
		</form>
	</div>
</div>