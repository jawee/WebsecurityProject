<?php
session_start();

if(isset($_POST['username']) && isset($_POST['password'])) {
	if($_POST['username'] == "admin" && $_POST['password'] == "password") {
		$user_agent = "";
		if(isset($_SESSION['HTTP_USER_AGENT'])) {
			$user_agent = $_SESSION['HTTP_USER_AGENT'];
		}
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['login_string'] = hash('sha512', "password" . $user_agent); 
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	} else {
		header("Location: /?login=error");
	}
}
?>
