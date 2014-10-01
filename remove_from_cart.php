<?php
include('includes/database.include.php');

$isLoggedIn = check_login();
if(!$isLoggedIn) {
	header('Location: /');
	die();
}

$id = -1;
if(isset($_GET['id'])) {
	$id = $_GET['id'];
}

if (!preg_match('/^[0-9]*$/', $id)) {
	echo "Stop messing with shit!";
	die();
}

unset($_SESSION['shopping_cart'][$id]);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>