<?php
if(isset($_POST['username']) && isset($_POST['password'])) {
	if($_POST['username'] == "admin" && $_POST['password'] == "password") {
		echo "great success";
	} else {
		header("Location: /?login=error");
	}
}
	echo $_POST['username'];
	echo $_POST['password'];
?>
