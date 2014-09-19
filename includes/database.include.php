<?php

require 'config/database.php';

$loggedIn = false;
if(isset($_SESSION['loggedIn'])) {
	$loggedIn = $_SESSION['loggedIn'];
}
try {
	$dbh = new PDO('mysql:host=localhost;dbname=websecurity', $DB_USERNAME, $DB_PASSWORD);
	$error_message = "Seems like great success";
} catch (PDOException $e) {
	$error_message = "Error! " . $e->getMessage();
	die();
}
?>