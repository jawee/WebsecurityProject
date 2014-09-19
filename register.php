<?php
	require 'includes/database.include.php';
	require 'templates/head.html';
?>
	
<body>
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
