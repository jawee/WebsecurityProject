<?php
	include 'includes/database.include.php';
	$loggedIn = check_login();

	if(!$loggedIn) {
		header('Location: /');
	}

	if(!isset($_SESSION['shopping_cart'])) {
		header('Location: /');
	}
	$pageName = "View Cart";
	include('templates/head.php');
	include('templates/navigation.php');
	?>
	<div class="jumbotron">
		<div class="container">
			<h1>Your shopping cart</h1>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				
				<table class="table table-hover table-striped">
  					<thead>
  						<tr>
  							<th>Image</th>
  							<th>Name</th>
  							<th>Price</th>
  							<th>Count</th>
  							<th>Sum</th>
  							<th></th>
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
									<td><a href="remove_from_cart.php?id=<?php echo $row[0]['id'];?>" class="btn btn-default" id="<?php echo $row[0]['id']; ?>">Remove from cart</a></td>
								</tr>
								<?php
							}
						?>
  					</tbody>
				</table>
				<?php
					if(get_shopping_cart_value($pdo) != 0) {
						echo 'Sum of costs: '.get_shopping_cart_value($pdo).' $';
						echo '<a href="checkout.php" class="pull-right btn btn-success">Checkout</a>	';
					}
				?>
				
			</div>
		</div>
	</div>
<?php
	include 'templates/footer.html';
?>
