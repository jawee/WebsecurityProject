<?php
session_start();

require 'config/database.php';
require 'includes/functions.php';

try {
	$pdo = new PDO('mysql:host=localhost;dbname=websecurity', $DB_USERNAME, $DB_PASSWORD);
	$error_message = "Seems like great success";
} catch (PDOException $e) {
	$error_message = "Error! " . $e->getMessage();
	die();
}
?>