<?php
session_start();

include 'includes/database.include.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = 'SELECT * FROM Users WHERE username = "'.$username.'"';

$sth = $pdo->query($sql);
$result = $sth->fetchAll();

if(sizeof($result) < 1) {
	header("Location: /?login=error");
} else {
	$fetched_password = $result[0]['password'];
	if(password_verify($password, $fetched_password)) {
		$user_agent = "";
		if(isset($_SESSION['HTTP_USER_AGENT'])) {
			$user_agent = $_SESSION['HTTP_USER_AGENT'];
		}
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['login_string'] = hash('sha512', "password" . $user_agent); 
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	} else {
		header("Location: /?login=error");
	}
}




// echo uniqid();
		// 	$passHash = password_hash("password", PASSWORD_DEFAULT, array("cost" => 11));
		// 	echo $passHash;

		// 	if (password_verify("password", $passHash)) {
		// 	    echo "pass correct";
		// 	} else {
		// 	    echo "pass wrong";
		// 	}
		// }

// if(isset($_POST['username']) && isset($_POST['password'])) {
// 	if($_POST['username'] == "admin" && $_POST['password'] == "password") {
// 		$user_agent = "";
// 		if(isset($_SESSION['HTTP_USER_AGENT'])) {
// 			$user_agent = $_SESSION['HTTP_USER_AGENT'];
// 		}
// 		$_SESSION['username'] = $_POST['username'];
// 		$_SESSION['login_string'] = hash('sha512', "password" . $user_agent); 
// 		header('Location: ' . $_SERVER['HTTP_REFERER']);
// 	} else {
// 		header("Location: /?login=error");
// 	}
// }
?>
