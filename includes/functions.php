<?php
session_start();

function check_login() {
	if(isset($_SESSION['username'], $_SESSION['login_string'])) {
		$user_agent = "";
		if(isset($_SESSION['HTTP_USER_AGENT'])) {
			$user_agent = $_SESSION['HTTP_USER_AGENT'];
		}
		$login_check = hash('sha512', "password" . $user_agent);

		if($login_check == $_SESSION['login_string']) {
			return true;
		}
	}
	echo "not set";
	return false;
}
