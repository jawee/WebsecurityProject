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
	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title></title>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<a class="navbar-brand" href="/">Webshop</a>
			<?php if(!$loggedIn) { ?>
			<form class="navbar-form navbar-right" method="post" role="login" action="login.php">
				<div class="form-group">
					<input type="text" name="username" class="form-control" placeholder="Username">
					<input type="password" name="password" class="form-control" placeholder="Password">
				</div>			
				<button type="submit" class="btn btn-default">Login</button>
				<a href="register.php" type="submit" class="btn btn-default">Register</a>
			</form>
			<?php } else { ?>
			<p class="navbar-text">Signed in as Mark Otto</p>
			<form class="navbar-form navbar-right">
				<a href="logout.php" type="submit" class="btn btn-danger">Log Out</a>
			</form>
			<?php } ?>
		</div>
	</nav>
	<div class="jumbotron">
		<div class="container">
			<h1>Register</h1>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<form class="form-horizontal" method="post" role="register" action="register.php">
					<input class="form-control" type="text" name="username" placeholder="Username">
					<input class="form-control" type="password" name="password" placeholder="Password">
					<input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password">
					<input class="form-control" type="text" name="street_address" placeholder="Street Address">
					<input class="form-control" type="text" name="zipcode" placeholder="Zip Code">
					<input class="form-control" type="text" name="city" placeholder="City">
					<input class="form-control" type="text" name="country" placeholder="Country">
					<button type="submit" class="btn btn-default">Register</button>
				</form>
			</div>
		</div>
	</div>
	
	</body>
</html>
