<?php 
	error_reporting(E_ALL ^ E_DEPRECATED);
	require_once('User.php');
	require_once('DataBase.php');
	if((isset($_POST['email'])&& isset($_POST['password'])) && (!empty($_POST['email'])&& !empty($_POST['password']))){
		$Email = mysql_real_escape_string($_POST['email']);
		$Password = mysql_real_escape_string($_POST['password']);
		$DB = new Database();
		$validation = $DB->loginAsUser($Email, $Password);
		if($validation == "error"){
			header('Location: login.html');
		}elseif ($validation == "invalid"){
			header('Location: login.html');
		}else{
			session_start();
			$_SESSION["UserID"] = $validation;
			header('Location: MobilesList.php');
		}
	}else {
		header('Location: login.html');
	}
?>