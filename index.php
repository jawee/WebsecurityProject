<?php
	include 'includes/database.include.php';
	$loggedIn = check_login();
	$pageName = "Start";	
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
					if(isset($_GET['login'])) {
						if($_GET['login'] == "blocked") {
							?> <script>alert("Your user has been blocked, too many password attempts");</script> <?
						} else {
							?>
							<script>alert("Wrong username and/or password");</script>
							<?php
						}
						
					}
				?>
				<table class="table table-hover table-striped">
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
