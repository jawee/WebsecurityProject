<?php
	include 'includes/database.include.php';
	$loggedIn = check_login();
	if(!$loggedIn) {
		header('Location: /');
		die();
	}
	$pageName = "Checkout";	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(!isset($_POST['credit-card']) || strlen($_POST['credit-card']) == 0) {
			$error = "Credit card info must be filled in";
		} else {
			$pageName = "Receipt";
		}
	}
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
				<?php 
				if($_SERVER['REQUEST_METHOD'] != 'POST') {
					?>
				
				<p>Enter your credit card information for payment.</p>
				<?php if(isset($error)) { echo '<p style="color: red;">'.$error.'</p>'; } ?>
				<form id="credit-card" class="form-horizontal" method="post" role="credit-card" action="checkout.php">
					<input class="form-control" type="text" name="credit-card" placeholder="Credit card number">
					<button type="submit" class="btn btn-danger pull-right">Submit</button>
				</form>
				<?php 
					} else {
						$result = get_user_info($pdo);
						?>

						<h3>Receipt</h3>
						<address>
							<strong><?php echo $result[0]['username']; ?></strong><br>
							<?php echo $result[0]['streetAddress']; ?><br>
							<?php echo $result[0]['city']; ?>, <?php echo $result[0]['zipcode']; ?><br>
							<?php echo $result[0]['country']; ?> 
						</address>
						<table class="table table-hover table-striped">
	  					<thead>
	  						<tr>
	  							<th>Image</th>
	  							<th>Name</th>
	  							<th>Price</th>
	  							<th>Count</th>
	  							<th>Sum</th>
	  						</tr>
	  					</thead>
	  					<tbody>
							<?php
								$rows = $_SESSION['shopping_cart'];
								$result = get_shopping_cart_items($pdo);
								foreach ($result as $row) {
									// var_dump($row);
									// die();
									?>

									<tr>
										<td><img src="images/<?php echo $row[0]['image']; ?>" style="max-height: 50px; max-width: 50px;"></td>
										<td><?php echo $row[0]['productname']; ?></td>
										<td><?php echo $row[0]['price'].' $'; ?></td>
										<td><?php echo $row['count']; ?></td>
										<td><?php echo $row['count']*$row[0]['price'].' $'; ?></td>
									</tr>
									<?php
								}
							?>
	  					</tbody>
					</table>
					<?php
						if(get_shopping_cart_value($pdo) != 0) {
							echo 'Sum of costs: '.get_shopping_cart_value($pdo).' $';
						}
						unset($_SESSION['shopping_cart']);
					}
				?>
			</div>
		</div>
	</div>
<?php
	include 'templates/footer.html';
?>


