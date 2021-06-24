<?php

	class users
	{
		protected $db = null;
		
		public function __construct($db){
			$this->db = $db;
		}
		
		//Function to check whats entered into the login screen is in the database
		public function checkUser($email, $username, $password){
			//lets get user
			$query = "SELECT * FROM Users WHERE email = :email AND username = :username";
			$pdo = $this->db->prepare($query);
			$pdo->bindParam(':email',$email);
			$pdo->bindParam(':username',$username);
			$pdo->execute();
		
			$user = $pdo->fetch(PDO::FETCH_ASSOC);
		
			if(empty($user)){
				return false;
			}else if(password_verify($password, $user['password'])){
				return $user;
			}else{
				return false;
			}
		}
		
		//Function to retrieve users data for the accounts page
		public function getUser($username){
			//Let's get the users information
			$query = "SELECT * FROM Users WHERE username = :username";
			$pdo = $this->db->prepare($query);
			$pdo->bindParam(':username', $username);
			$pdo->execute();
			
			return $pdo->fetch(PDO::FETCH_ASSOC);
		}
		
		//Function to update the users details
		public function updateAccount($username, $forename, $gender, $county){
			//Update a users record
			$query = "UPDATE Users SET forename = :forename, gender = :gender,
			county = :county WHERE username = :username";
			
			$pdo = $this->db->prepare($query);
			$pdo->bindParam(':forename', $forename);
			$pdo->bindParam(':gender', $gender);
			$pdo->bindParam(':county', $county);
			$pdo->bindParam(':username', $username);
			
			if($pdo->execute()){
				return true;
			}else{
				return false;
			}
		}
		
		//Gets pub details for each pub
		public function getPub($pub_id){
			//Let's get the users information
			$query = "SELECT * FROM Pub WHERE pub_id = :pub_id";
			$pdo = $this->db->prepare($query);
			$pdo->bindParam(':pub_id', $pub_id);
			$pdo->execute();
			
			return $pdo->fetch(PDO::FETCH_ASSOC);
		}
		
		//Deletes a pub from the database, keeps them on the accounts page after reload
		public function deletePub($pub_id){
			//Let's get the users information
			$query = "DELETE FROM Pub WHERE pub_id = :pub_id";
			$pdo = $this->db->prepare($query);
			$pdo->bindParam(':pub_id', $pub_id);
			$pdo->execute();
			
			echo "<script> window.location.assign('index.php?p=account'); </script>";
			return $pdo->fetch(PDO::FETCH_ASSOC);
		}
		
		//Gets pubs dependent on the channel, for the individual markers on the livesports map
		public function getChannel($livesportschannel){
			 if ($livesportschannel == 'BBC Sports'){
				$query = "SELECT * FROM Pub WHERE livesportschannel = 'BBC Sports' OR livesportschannel2 = 'BBC Sports' OR livesportschannel3 = 'BBC Sports'";
				$pdo = $this->db->prepare($query);
				$pdo->execute();
			
				return $pdo->fetchAll(PDO::FETCH_ASSOC);
			 }elseif ($livesportschannel == 'BT Sports'){
				$query = "SELECT * FROM Pub WHERE livesportschannel = 'BT Sports' OR livesportschannel2 = 'BT Sports' OR livesportschannel3 = 'BT Sports'";
				$pdo = $this->db->prepare($query);
				$pdo->execute();
			
				return $pdo->fetchAll(PDO::FETCH_ASSOC);
			 }elseif ($livesportschannel == 'Sky Sports'){
				$query = "SELECT * FROM Pub WHERE livesportschannel = 'Sky Sports' OR livesportschannel2 = 'Sky Sports' OR livesportschannel3 = 'Sky Sports'";
				$pdo = $this->db->prepare($query);
				$pdo->execute();
			
				return $pdo->fetchAll(PDO::FETCH_ASSOC);
			 }else {
				 $query = "SELECT * FROM Pub WHERE livesportschannel = 'monke' OR livesportschannel2 = 'monke' OR livesportschannel3 = 'monke'";
				$pdo = $this->db->prepare($query);
				$pdo->execute();
			 }
		}
		
		//Gets pubs dependent on the sports facility, for the individual markers on the sportsfacility map
		public function getFacility($sportsfacilities){
			 if ($sportsfacilities == 'Darts'){
				$query = "SELECT * FROM Pub WHERE sportsfacilities = 'Darts' OR sportsfacilities2 = 'Darts' OR sportsfacilities3 = 'Darts' OR sportsfacilities4 = 'Darts'";
				$pdo = $this->db->prepare($query);
				$pdo->execute();
			
				return $pdo->fetchAll(PDO::FETCH_ASSOC);
			 }elseif ($sportsfacilities == 'Pool Table'){
				$query = "SELECT * FROM Pub WHERE sportsfacilities = 'Pool Table' OR sportsfacilities2 = 'Pool Table' OR sportsfacilities3 = 'Pool Table' OR sportsfacilities4 = 'Pool Table'";
				$pdo = $this->db->prepare($query);
				$pdo->execute();
			
				return $pdo->fetchAll(PDO::FETCH_ASSOC);
			 }elseif ($sportsfacilities == 'Skittles'){
				$query = "SELECT * FROM Pub WHERE sportsfacilities = 'Skittles' OR sportsfacilities2 = 'Skittles' OR sportsfacilities3 = 'Skittles' OR sportsfacilities4 = 'Skittles'";
				$pdo = $this->db->prepare($query);
				$pdo->execute();
			
				return $pdo->fetchAll(PDO::FETCH_ASSOC);
			 }elseif ($sportsfacilities == 'Snooker Table'){
				$query = "SELECT * FROM Pub WHERE sportsfacilities = 'Snooker Table' OR sportsfacilities2 = 'Snooker Table' OR sportsfacilities3 = 'Snooker Table' OR sportsfacilities4 = 'Snooker Table'";
				$pdo = $this->db->prepare($query);
				$pdo->execute();
			
				return $pdo->fetchAll(PDO::FETCH_ASSOC);
			 }else {
				 $query = "SELECT * FROM Pub WHERE sportsfacilities = 'monke' OR sportsfacilities2 = 'monke' OR sportsfacilities3 = 'monke' OR sportsfacilities4 = 'monke'";
				$pdo = $this->db->prepare($query);
				$pdo->execute();
			 }
		}
		
		//Function to display the pubs a specific user has added, shows on accounts page
		public function getAllPubsForUser($userid, $searchTerm = null){
			if(isset($searchTerm)){
				$searchTerm = '%'.$searchTerm.'%';
				$query = "SELECT * FROM Pub WHERE user_id = :userid AND pubname LIKE :search";
				$pdo = $this->db->prepare($query);
				$pdo->bindParam(':userid', $userid);
				$pdo->bindParam(':search', $searchTerm);
			}else{
				$query = "SELECT * FROM Pub WHERE user_id = :userid";
				$pdo = $this->db->prepare($query);
				$pdo->bindParam(':userid', $userid);
			}
			$pdo->execute();
			return $pdo->fetchAll();
		}
		
		//Function to update a pub, a user can choose to update pub details from the accounts page
		public function updatePub($pub_id, $pubname, $address, $postcode, $livesportschannel, $livesportschannel2, $livesportschannel3, $sportsfacilities, $sportsfacilities2, $sportsfacilities3, $sportsfacilities4){
			//Update a pub record
			echo '<script> console.log("hello");</script>';
			$query = "UPDATE Pub SET pubname = :pubname, address = :address, postcode = :postcode, livesportschannel = :livesportschannel, livesportschannel2 = :livesportschannel2, 
			livesportschannel3 = :livesportschannel3, sportsfacilities = :sportsfacilities, sportsfacilities2 = :sportsfacilities2, sportsfacilities3 = :sportsfacilities3, 
			sportsfacilities4 = :sportsfacilities4  WHERE pub_id = :pub_id";
			
			$pdo = $this->db->prepare($query);
			$pdo->bindParam(':pubname', $pubname);
			$pdo->bindParam(':address', $address);
			$pdo->bindParam(':postcode', $postcode);
			$pdo->bindParam(':livesportschannel', $livesportschannel);
			$pdo->bindParam(':livesportschannel2', $livesportschannel2);
			$pdo->bindParam(':livesportschannel3', $livesportschannel3);
			$pdo->bindParam(':sportsfacilities', $sportsfacilities);
			$pdo->bindParam(':sportsfacilities2', $sportsfacilities2);
			$pdo->bindParam(':sportsfacilities3', $sportsfacilities3);
			$pdo->bindParam(':sportsfacilities4', $sportsfacilities4);
			$pdo->bindParam(':pub_id', $pub_id);
			
			if($pdo->execute()){
				return true;
			}else{
				return false;
			}
		}
	}
	
?>