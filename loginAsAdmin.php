<?php 
	error_reporting(E_ALL ^ E_DEPRECATED);
	require_once('User.php');
	require_once('DataBase.php');
	if((isset($_POST['email'])&& isset($_POST['password'])) && (!empty($_POST['email'])&& !empty($_POST['password']))){
		$Email = mysql_real_escape_string($_POST['email']);
		$Password = mysql_real_escape_string($_POST['password']);
		$DB = new Database();
		$validation = $DB->loginAsAdmin($Email, $Password);
		if($validation == "error"){
			header('Location: LoginAsAdmin.html');
		}elseif ($validation == "invalid"){
			header('Location: LoginAsAdmin.html');
		}else{
			session_start();
			$_SESSION["AdminID"] = $validation;
			header('Location: AdminPage.php');
		}
	}else {
		header('Location: LoginAsAdmin.html');
	}
?>