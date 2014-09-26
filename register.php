<?php
	session_start();
	include 'includes/database.include.php';
	if(check_login() == true) {
		$loggedIn = true;
	} else {
		$loggedIn = false;
	}
	
	include('templates/head.html');
	include('templates/navigation.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
	} 

?>
	
	<?php
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
