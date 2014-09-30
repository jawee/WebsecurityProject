<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			
			<?php if(!$loggedIn) { ?>
			<form class="navbar-form navbar-right" method="post" role="login" action="login.php">
				<div class="form-group">
					<input type="text" name="username" class="form-control" placeholder="Username">
					<input type="password" name="password" class="form-control" placeholder="Password">
				</div>			
				<button type="submit" class="btn btn-default">Login</button>
				<a href="register.php" type="submit" class="btn btn-default">Register</a>
			</form>
			<?php } else { ?>
			<a class="navbar-brand" href="#">Logged in as: <?php echo $_SESSION['username']; ?></a>
			<form class="navbar-form navbar-right">
				<a href="logout.php" type="submit" class="btn btn-danger">Log Out</a>
			</form>
			<?php } ?>
		</div>
	</nav>