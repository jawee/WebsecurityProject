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
					if(isset($_GET['login'])) {
						?>
							<script>alert("Wrong username and/or password");</script>
						<?php
					}
				?>
				<table class="table table-hover">
  					<thead>
  						<tr>
  							<th>Image</th>
  							<th>Name</th>
  							<th>Description</th>
  							<th>Stock</th>
  							<th>Price</th>
  							<th></th>
  						</tr>
  					</thead>
  					<tbody>
						<?php
							$result = fetch_products($pdo);
							foreach ($result as $row) {
								?>
								<tr>
									<td><img src="images/<?php echo $row['image']; ?>" style="max-height: 100px; max-width: 100px;"></td>
									<td><?php echo $row['productname']; ?></td>
									<td><?php echo $row['description']; ?></td>
									<td><?php echo $row['stock']; ?></td>
									<td><?php echo $row['price'].' $'; ?></td>
									<td><a href="add_to_cart.php?id=<?php echo $row['id'];?>" class="btn btn-default" id="<?php echo $row['id']; ?>">Add to cart</a></td>
								</tr>
								<?php
							}
						?>
  					</tbody>
				</table>	
			</div>
		</div>
	</div>
<?php
	include 'templates/footer.html';
?>
