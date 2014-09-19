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
						echo "omg some error";
					}
				?>
			</div>
		</div>
	</div>
	
	</body>
</html>
