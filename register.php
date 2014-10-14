<?php
	include 'includes/database.include.php';
	$loggedIn = check_login();
	if($loggedIn) {
		header('Location: /');
		die();
	}
	

	$error = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($pdo)) {
			try {
				$username = $_POST['username'];
				$sql = "SELECT username, password FROM Users WHERE username = :username";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':username', $username, PDO::PARAM_STR);

				$stmt->execute();
				$result = $stmt->fetchAll();

			} catch(PDOException $ex) {
				var_dump($ex);
			}
			if(sizeof($result) > 0) {
				$error .= "User already exists";
			} else {
				$password = password_hash($_POST['real-password'], PASSWORD_DEFAULT, array("cost" => 11));
				$streetAddress = $_POST['street-address'];
				$zipcode = $_POST['zipcode'];
				$city = $_POST['city'];
				$country = $_POST['country'];

				//Unsafe	
				// $sql = "INSERT INTO Users (username, password, streetAddress, zipcode, city, country) VALUES ('$username', '$password', '$streetAddress', '$zipcode', '$city', '$country')";

				// if($pdo->exec($sql) == false) {
				// 	$error .= "Something went wrong";
				// }

				$sql = "INSERT INTO Users (username, password, streetAddress, zipcode, city, country) VALUES (:username, :password, :streetaddress, :zipcode, :city, :country)";
				$stmt = $pdo->prepare($sql);
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
		$pageName = "Register";
		include('templates/head.php');
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
					<button type="submit" class="btn btn-danger pull-right">Register</button>
				</form>
			</div>
		</div>
	</div>
	
<?php
	include 'templates/footer.html';
?>