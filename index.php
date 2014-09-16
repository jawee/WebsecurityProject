<?php

require 'config/database.php';


try {
	$dbh = new PDO('mysql:host=localhost;dbname=websecurity', $DB_USERNAME, $DB_PASSWORD);
	echo "Seems like great success";
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage();
	die();
}

?>
	
