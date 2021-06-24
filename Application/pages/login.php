<?php
	/* if users details are set in the form below it will check them against details in the database and send them to the account page and set the session loggedin to be true, elsewise it will error
	and keep the session as being logged out */
	if(isset($_POST['email']) || isset($_POST['username']) || isset($_POST['password'])){
		if(!$_POST['email'] || !$_POST['username'] || !$_POST['password']){
			$error = "Please enter an email, username and password";
		}
		
		if(!$error){
			require_once('classes/users.classes.php');
			
			$usersObj = new users($DBH);
			$checkUser = $usersObj->checkUser($_POST['email'],$_POST['username'],$_POST['password']);
			
			if($checkUser){
				//User found
				$_SESSION['loggedin'] = true;
				$_SESSION['userData'] = $checkUser;
				
				echo "<script> window.location.assign('index.php?p=account');</script>";
			}else{
				$error = "Email/Username/Password Incorrect";
			}
		}
	}

?>	

<div class="card container mt-5 formLogin">
	<div class="card-body">
		<h1 class="mb-3">Login to your account</h1>
		<form action="index.php?p=login" method="post">
			<?php if($error){
				echo '<div class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						'.$error.'
				</div>';
			} ?>
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
				<button type="submit" class="btn btn-default">Login</button>
			</div>
		</form>
	</div>
</div>