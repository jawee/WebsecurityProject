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
			<form class="navbar-form navbar-right">
				<a href="logout.php" type="submit" class="btn btn-danger">Log Out</a>
			</form>
			<?php } ?>
		</div>
	</nav>
	<div class="jumbotron">
		<div class="container">
			<h1>Hello, world!</h1>
			<p>Some awesome text</p>
			<p><a class="btn btn-primary btn-lg" href="#">Learn more</a></p>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php
					if(isset($_GET['login'])) {
						echo "omg some error";
					}
				?>
			</div>
		</div>
	</div>
	
	</body>
</html>
