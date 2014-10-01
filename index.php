<?php
	include 'includes/database.include.php';
	$loggedIn = check_login();
	
	include('templates/head.html');
	include('templates/navigation.php');
	?>
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
					if($loggedIn == true) {
						echo "logged in";
					} else if(isset($_GET['login'])) {
						echo "error";
					}
				?>
				<table class="table">
  					<thead>
  						<tr>
  							<th>Name</th>
  							<th>Description</th>
  							<th>Quantity</th>
  							<th>Price</th>
  						</tr>
  					</thead>
  					<tbody>
						
  					</tbody>
				</table>	
			</div>
		</div>
	</div>
<?php
	include 'templates/footer.html';
?>
