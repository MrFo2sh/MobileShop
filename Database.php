<?php 
	class Database{
		private $db_host;
		private $db_user;
		private $db_pass;
		private $db_name;
		function __construct(){
			//init
			$this->db_host = 'localhost';
			$this->db_user = 'root';
			$this->db_pass = 'GetOut';
			$this->db_name = 'mobileshop';
		}
		
		function loginAsUser($email,$password){
			$conn = mysqli_connect($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
			if (mysqli_connect_errno()){
				return "error" ;     
			}
			$sql = "SELECT * FROM `user` WHERE email='$email' AND password='$password'";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$ID = $row["id"];
					$conn->close();
					return $ID;
				}
			}else{
				$conn->close();
				return "invalid";
			}
		}
		
		function registerUser(User $User){
			$conn = mysqli_connect($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
			if (mysqli_connect_errno()){
				return "error" ;
			}
			$FirstName = $User->FirstName;
			$LastName = $User->LastName;
			$ImageUrl = $User->ImageURL;
			$Email = $User->EMail;
			$Username = $User->Username;
			$Password = $User->Password;
			
			$sql = "SELECT * FROM `user` WHERE email='$Email'";
			$result = $conn->query($sql);
			//if there are one or more results then user exists
			if ($result->num_rows > 0) {
				$conn->close();
				return "exist";
			}else{
				$sql = "INSERT INTO user (firstName,lastName,imageUrl,email,username,password)
				VALUES ('$FirstName','$LastName','$ImageUrl','$Email','$Username','$Password')";
				if($conn->query($sql)){
					$conn->close();
					return "valid";
				}else{
					$conn->close();
					return "error";
				}
			}
		}
		
		function getUserById($id){
			$conn = mysqli_connect($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
			if (mysqli_connect_errno()){
				return "error" ;
			}
			$sql = "SELECT * FROM `user` WHERE id='$id'";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$ID = $row["id"];
					$FirstName = $row["firstName"];
					$LastName = $row["lastName"];
					$ImageURL = $row["imageUrl"];
					$Email = $row["email"];
					$Username = $row["username"];
					$Password = $row["password"];
					$user = new User($ID, $FirstName, $LastName, $ImageURL, $Email, $Username, $Password);
					$conn->close();
					return $user;
				}
			}else{
				$conn->close();
				return "invalid";
			}
		}		
		
		
	}
?>