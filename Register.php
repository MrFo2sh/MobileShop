<?php 
	error_reporting(E_ALL ^ E_DEPRECATED);
	require_once('User.php');
	require_once('DataBase.php');
	
	$Email = mysql_real_escape_string($_POST['email']);
	$Password = mysql_real_escape_string($_POST['password']);
	$FirstName = mysql_real_escape_string($_POST['firstName']);
	$Lastname= mysql_real_escape_string($_POST['lastName']);
	$Username= mysql_real_escape_string($_POST['username']);
	$Confirm = mysql_real_escape_string($_POST['confirm']);
	
	if($Confirm != $Password){
		header("Location: Register.html");
	}else{
		$DB = new Database();
		$user = new User(0, $FirstName, $Lastname, "UserProfiles/DefaultUser.jpg", $Email, $Username, $Password);
		$validate = $DB->registerUser($user);
		switch ($validate){
			case "error":
				header('Location: Register.html');
				break;
			case "exist":
				header('Location: Register.html');
				break;
			case "valid":
				session_start();
				$_SESSION["UserID"] = $DB->loginAsUser($Email, $Password);
				header('Location: welcomePage.php');
				break;
		}
	}
?>