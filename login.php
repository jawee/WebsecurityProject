<?php
include 'includes/database.include.php';

$username = $_POST['username'];
$password = $_POST['password'];


//Dålig inloggning
//sql injection fungerar med "test'; delete from Users where 1 or username = '"
// $sql = "SELECT username, password FROM Users WHERE username = '".$username."'";

// $sth = $pdo->query($sql);
// if($sth != false) {
// 	$result = $sth->fetchAll();	
// }


//Korrekt inloggning
try {
	
	$sql = "SELECT id, username, password FROM Users WHERE username = :username";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);

	$stmt->execute();
	$result = $stmt->fetchAll();

} catch(PDOException $ex) {
	var_dump($ex);
}


if(sizeof($result) < 1) {
	header("Location: /?login=error");
} else {
	$id = $result[0]['id'];
	$fetched_password = $result[0]['password'];
	if(password_verify($password, $fetched_password)) {
		$user_agent = "";
		if(isset($_SESSION['HTTP_USER_AGENT'])) {
			$user_agent = $_SESSION['HTTP_USER_AGENT'];
		}
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['login_string'] = hash('sha512', "password" . $user_agent); 
		$sql = "UPDATE LoginAttempts SET attempts = 0 WHERE userId = :userId";
		$stmt = $pdo->prepare($sql);
		$stmt->bindparam(':userId', $id);
		$stmt->execute();
		header('Location: /');
	} else {
		$sql = "SELECT attempts FROM LoginAttempts WHERE userId = :userId";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':userId', $id);
		$stmt->execute();
		$result = $stmt->fetch();

		if(sizeof($result) > 0) {
			// UPDATE Customers SET ContactName='Alfred Schmidt', City='Hamburg' WHERE CustomerName='Alfreds Futterkiste';
			$attempts = $result['attempts'] + 1;
			$sql = "UPDATE LoginAttempts SET attempts = :attempts WHERE userId = :userId";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':attempts', $attempts);
			$stmt->bindparam(':userId', $id);
			$stmt->execute();

			if($attempts > 4) {
				header("Location: /?login=blocked");
			} else {
				header("Location: /?login=error");
			}
		} else {
			$sql = "INSERT INTO LoginAttempts (userId, attempts) VALUES (:userId, 1)";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':userId', $id);
			$stmt->execute();
			header("Location: /?login=error");
		}
		
	}
}


?>