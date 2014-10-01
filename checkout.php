<?php
	include 'includes/database.include.php';
	$loggedIn = check_login();
	$pageName = "Checkout";	
	include('templates/head.php');
	include('templates/navigation.php');
	?>

	<div class="jumbotron">
		<div class="container">
			<h1>Super awesome fruit shop</h1>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<p>omg checkout</p>
			</div>
		</div>
	</div>
<?php
	include 'templates/footer.html';
?>
