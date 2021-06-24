<!-- User cannot enter the page without being logged in -->
<?php
	
	if(!$_SESSION['loggedin']){
		//User is not logged in
		echo "<h1>Access Denied</h1>";
		echo "<script> window.location.assign('index.php?p=login'); </script>";
		exit;
	}
	
?>
<!-- Calls the getUser function from the users classes file, this retrieves users data and displays it below, it starts off empty and the user can edit the page to display their details and store it in the database, the
editaccount page is where changes are made -->
<?php
	
	if($_SESSION['loggedin'] = true){
		//Include users class
		require_once('classes/users.classes.php');
		//Get user details
		$userObj = new users($DBH); //Lets pass through our DB connection
		$account = $userObj->getUser($_SESSION['userData'][username]); //Call the getUser function 
		
	}else{
		//Display error
		$error = "No account found.";
	}
	
?>

<div class="container card mt-5 accounts">
	<div class="card-body">
		<?php 
			if($error){
				echo "<h1>Error!</h1>";
				echo "<p>".$error."</p>";
			}else{
		?>
		
				<h1><?php echo $account['forename']; ?>'s account page </h1>
				<p><strong>Gender:</strong> <?php echo $account['gender']; ?></p>
				<p><strong>County:</strong> <?php echo $account['county']; ?></p>
				<div class="editaccountbutton col text-center">
					<button class="btn" onclick="window.location.href='index.php?p=editaccount';">Edit Account</button>
				</div>
			<?php } ?>
		<!-- users can search for pubs they have added -->
		<form class="form-inline" action="" method="post" id="userpubs">
			<div class="form-group">
				<label for="name">Search for pubs you have uploaded:</label>
				<input type="text" class="form-control" id="search" name="search" style="margin-left: 5px;">
			</div>
			<button type="submit" class="btn btn-default" style="margin-left: 5px;">Search</button>
		</form>
		<ul>
		<!-- Displays all the pubs a user has uploaded, calls the getAllPubsForUser function, retrieves the users data from the current logged in session and uses it as a parametre to retrieve the correct pubs for that user,
		loops through all the pubs and displays the pubname (retrieved from db) and if a pub is clicked it sets the editpub url to include the pub_id of the pub selected -->
		<?php
			$userObj = new users($DBH);
			$pub = $userObj->getAllPubsForUser($_SESSION['userData']['user_id'],$_POST['search']); 
			
			foreach ($pub as $key => $value) { //Loop over returned items
				echo '<li><a href="index.php?p=editpub&id='.$value['pub_id'].'">'.$value['pubname'].'</a></li>';
			}
		?>
		</ul>
	</div>
</div>

