<?php
	/* destroys the session and takes then back to the login page if the logout button is pressed */
	//Remove all Global Variables
	$_SESSION = [];
	//Destroy Session
	session_destroy();
	echo "<script> window.location.assign('index.php?p=login'); </script>";

?>