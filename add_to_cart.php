<?php
include('includes/database.include.php');

$id = -1;
if(isset($_GET['id'])) {
	$id = $_GET['id'];
}

if (!preg_match('/^[0-9]*$/', $id)) {
	echo "Stop messing with shit!";
	die();
}

$sql = "SELECT * FROM Products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll();

if(sizeof($result) == 0) {
	echo "Id does not exist!";
	die();
}

if(!isset($_SESSION['shopping_cart'])) {
	$_SESSION['shopping_cart'] = array();
}

if(array_key_exists($id, $_SESSION['shopping_cart'])) {
	$_SESSION['shopping_cart'][$id] += 1;
} else {
	$_SESSION['shopping_cart'][$id] = 1;
}

header('Location: ' . $_SERVER['HTTP_REFERER']);



?>