<?php
session_start();

include 'includes/database.include.php';

$username = $_POST['username'];
$password = $_POST['password'];

//sql injection fungerar med "test'; delete from Users where 1 or username = '"
$sql = "SELECT username, password FROM Users WHERE username = '".$username."'";

$sth = $pdo->query($sql);
if($sth != false) {
	$result = $sth->fetchAll();	
}

// try {
// 	//REAL STUFF
// 	$sql = "SELECT username, password FROM Users WHERE username = :username";
// 	$stmt = $pdo->prepare($sql);
// 	$stmt->bindParam(':username', $username, PDO::PARAM_STR);

// 	$stmt->execute();
// 	$result = $stmt->fetchAll();

// } catch(PDOException $ex) {
// 	var_dump($ex);
// }


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


?>
