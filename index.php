<?php

require 'config/database.php';


try {
	$dbh = new PDO('mysql:host=localhost;dbname=websecurity', $DB_USERNAME, $DB_PASSWORD);
	$error_message = "Seems like great success";
} catch (PDOException $e) {
	$error_message = "Error! " . $e->getMessage();
	die();
}

?>
	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<title></title>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<a class="navbar-brand" href="/">Webshop</a>
			<form class="navbar-form navbar-right" role="login" action="login.php">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Username">
					<input type="password" class="form-control" placeholder="Password">
				</div>			
				<button type="submit" class="btn btn-default">Login</button>
				<a href="register.php" type="submit" class="btn btn-default">Register</a>
			</form>
		</div>
	</nav>
	<div class="jumbotron">
		<div class="container">
			<h1>Hello, world!</h1>
			<p>Some awesome text</p>
			<p><a class="btn btn-primary btn-lg" href="#">Learn more</a></p>
		</div>
	</body>
</html>
