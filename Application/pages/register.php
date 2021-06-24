<?php
	/* if an email username and password are set and follow the restrictions then the users details are added to the db, if they fail to meet the restrictions (i.e. password length or if an email is not wrote correctly)
	it will error, the password is hash so is encrypted in the database, uses the PASSWORD_DEFAULT bcrypt algorithm to encrypt the password */
	if(isset($_POST['email']) || isset($_POST['username']) || isset($_POST['password'])){
		
		if(!$_POST['email'] || !$_POST['username'] || !$_POST['password']){
			$error = "Please enter an email, username and password";
		}
		
		if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		
			if (strlen($_POST['password']) > 3 && strlen($_POST['password']) <= 20){
		
				if(!$error){
					//No errors- let's create the account
					//Encrypt the password with a salt
					$encryptedPass = password_hash($_POST['password'], PASSWORD_DEFAULT);
					//Insert DB
					$query = "INSERT INTO Users (Email, Username, Password) VALUES (:email, :username, :password)";
					$result = $DBH->prepare($query);
					$result->bindParam(':email', $_POST['email']);
					$result->bindParam(':username', $_POST['username']);
					$result->bindParam(':password', $encryptedPass);
					$result->execute();
			
					echo "<script> window.location.assign('index.php?p=registersuccess'); </script>";
				}
			}else{
				$passworderror = "Please enter a valid password over 3 characters long and less than 20";
			}
		}else{
			$emailerror = "Please enter a valid email address";
		}
	}
	
?>


<div class="card container mt-5 regForm">
	<div class="card-body">
		<h1 class="mb-3">Register</h1>
		<form action="index.php?p=register" method="post">
			<?php if($error){
				echo '<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<span class="sr-only">Error:</span>
				'.$error.'
				</div>';
			}
			if($passworderror){
				echo '<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<span class="sr-only">PasswordError:</span>
				'.$passworderror.'
				</div>';
			} 
			if($emailerror){
				echo '<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<span class="sr-only">EmailError:</span>
				'.$emailerror.'
				</div>';
			}
			?>
				<div class="form-group">
					<label for="email">Email address:</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="email">
				</div>
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="username" class="form-control" id="username" name="username" placeholder="username">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="password">
				</div>
				<div class="col text-center">
					<button type="submit" class="btn btn-default">Register</button>
				</div>
		</form>
	</div>
</div>