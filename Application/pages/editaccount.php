<!-- A user can only enter this page if they are logged in -->
<?php
	
	if(!$_SESSION['loggedin']){
		//User is not logged in
		echo "<h1>Access Denied</h1>";
		echo "<script> window.location.assign('index.php?p=login'); </script>";
		exit;
	}
	
?>

<div class="container card editaccounts">
	<div class="card-body">
		<h1>Edit your account</h1>
		
		<?php
			/*If the submit button on the form below is pressed it will call the updateAccount function, passes the form data in as parametres along with the sessions username so that it sets details for the correct user */
    		//Include users class
    		require_once('classes/users.classes.php');
    		$userObj = new users($DBH); //Lets pass through our DB connection

    		if(isset($_POST['submit'])){

    			$updateAccount = $userObj->updateAccount($_SESSION['userData']['username'], $_POST['forename'], $_POST['gender'], $_POST['county']); //Call the updateAccount function

    			if($updateAccount){
    				echo '<div class="alert alert-success" role="alert">Your profile has been updated!</div>';
    			}
    			
    		}
			
    		/* If there are already pre set details for the user they will already display in the form and upon submission details will display, this is done through the getUser function which retrieves users data based on the current
			logged in users username */
    		$account = $userObj->getUser($_SESSION['userData']['username']); //Call the getUser function
    	?>
		
    	<form method="post" action="" enctype="multipart/form-data">
    		<div class="form-group">
    			<label for="forename">Forename:</label>
    			<input type="text" class="form-control" id="forename" name="forename" value="<?php echo $account['forename']; ?>">
    		</div>
    		<div class="form-group">
    			<label for="gender">Gender:</label>
    			<select class="form-control" id="gender" name="gender">
					<option value="" <?php if ($account['gender'] == '') echo ' selected="selected"'; ?>>Gender</option>
					<option value="Male" <?php if ($account['gender'] == 'Male') echo ' selected="selected"'; ?>>Male</option>
					<option value="Female" <?php if ($account['gender'] == 'Female') echo ' selected="selected"'; ?>>Female</option>
					<option value="Other" <?php if ($account['gender'] == 'Other') echo ' selected="selected"'; ?>>Other</option>
				</select>
    		</div>
    		<div class="form-group">
    			<label for="county">County:</label>
    			<input type="text" class="form-control" id="county" name="county" value="<?php echo $account['county']; ?>">
    		</div>
			<div class="col text-center">
				<button type="submit" name="submit" class="btn btn-default">Update Account</button>
			</div>
    	</form>
	</div>
</div>