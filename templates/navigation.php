<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			
			<?php if(!$loggedIn) { 
				$randomString = getRandomString();
				$_SESSION['request-token'] = $randomString;
			?>
			<form class="navbar-form navbar-right" method="post" role="login" action="login.php">
				<div class="form-group">
					<input type="text" name="username" class="form-control" placeholder="Username">
					<input type="password" name="password" class="form-control" placeholder="Password">
					<input type="hidden" name="csrf" value="<?php echo $randomString; ?>">
				</div>			
				<button type="submit" class="btn btn-default">Login</button>
				<a href="register.php" type="submit" class="btn btn-default">Register</a>
			</form>
			<?php } else { ?>
			<!-- unsafe version -->
			<!-- <a class="navbar-brand" href="/">Logged in as: <?php echo $_SESSION['username']; ?></a> -->
			<a class="navbar-brand" href="/">Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></a>
			<form class="navbar-form navbar-right">
				<?php 
					if(!isset($_SESSION['shopping_cart'])) {
						echo "Current cost: 0 $  ";
					} else {
						echo "Current cost: " . get_shopping_cart_value($pdo). " $  ";
						if(get_shopping_cart_value($pdo) != 0) {
							echo '<a href="view_cart.php" class="btn btn-default">View Cart</a>';
						}
					}
				?>
				<a href="logout.php" type="submit" class="btn btn-danger">Log Out</a>
			</form>
			<?php } ?>
		</div>
	</nav>