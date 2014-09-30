<?php
	session_start();
	include 'includes/database.include.php';
	if(check_login() == true) {
		$loggedIn = true;
	} else {
		$loggedIn = false;
	}
	

	$error = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($pdo)) {
			$sql = "SELECT * FROM Users WHERE username = '".$_POST['username']."'";
			if($pdo->query($sql) == true) {
				$error .= "User already exists";
			} else {
				$username = $_POST['username'];
				$password = password_hash($_POST['real-password'], PASSWORD_DEFAULT, array("cost" => 11));
				$streetAddress = $_POST['street-address'];
				$zipcode = $_POST['zipcode'];
				$city = $_POST['city'];
				$country = $_POST['country'];

				// echo $username . " " . $password  . " " . $streetAddress . " " . $zipcode . " " . $city . " " . $country;

				$sql = "INSERT INTO Users (username, password, streetaddress, zipcode, city, country) VALUES (:username, :password, :streetaddress, :zipcode, :city, :country)";
				$stmt = $pdo->prepare($sql);

				// $stmt->bindParam(':filmName', $_POST['filmName'], PDO::PARAM_STR);
				$stmt->bindParam(':username', $username, PDO::PARAM_STR);
				$stmt->bindParam(':password', $password, PDO::PARAM_STR);
				$stmt->bindParam(':streetaddress', $streetAddress, PDO::PARAM_STR);
				$stmt->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
				$stmt->bindParam(':city', $city, PDO::PARAM_STR);
				$stmt->bindParam(':country', $country, PDO::PARAM_STR);
				if($stmt->execute() != 1) {
					$error .= "Awfully Sorry, something went wrong";
				}

			}
		}
	}

?>
	
	<?php

		include('templates/head.html');
		require 'templates/navigation.php';
	?>
	<div class="jumbotron">
		<div class="container">
			<h1>Register</h1>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<p style="color: red;"><?php echo $error; ?></p>
				<form id="register" class="form-horizontal" method="post" role="register" action="register.php">
					<input class="form-control" type="text" name="username" placeholder="Username">
					<input class="form-control" type="password" name="real-password" placeholder="Password">
					<input class="form-control" type="password" name="confirm-password" placeholder="Confirm Password">
					<input class="form-control" type="text" name="street-address" placeholder="Street Address">
					<input class="form-control" type="text" name="zipcode" placeholder="Zip Code">
					<input class="form-control" type="text" name="city" placeholder="City">
					<input class="form-control" type="text" name="country" placeholder="Country">
					<button type="submit" class="btn btn-default">Register</button>
				</form>
			</div>
		</div>
	</div>
	
<?php
	include 'templates/footer.html';
?>
