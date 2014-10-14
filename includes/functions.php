<?php

function check_login() {
	if(isset($_SESSION['username'], $_SESSION['login_string'])) {
		$user_agent = "";
		if(isset($_SESSION['HTTP_USER_AGENT'])) {
			$user_agent = $_SESSION['HTTP_USER_AGENT'];
		}
		$login_check = hash('sha512', "password" . $user_agent);

		if($login_check == $_SESSION['login_string']) {
			return true;
		}
	}
	return false;
}

function get_user_info($pdo) {
	$username = $_SESSION['username'];
	$sql = "SELECT username, streetAddress, zipcode, city, country FROM Users WHERE username = :username LIMIT 1";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll();
	if(sizeof($result) == 0) {
		die();
	}

	return $result;
}

function fetch_products($pdo) {
	$stmt = $pdo->prepare("select * from Products");
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}


function get_shopping_cart_value($pdo) {
	$price = 0;
	foreach($_SESSION['shopping_cart'] as $id=>$count) {
		$stmt = $pdo->prepare("SELECT * FROM Products WHERE id = :id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if(sizeof($result) == 0) {
			die();
		}
		$price += $count*$result[0]['price'];
	}

	return $price;
}

function get_shopping_cart_items($pdo) {
	$products = array();
	foreach($_SESSION['shopping_cart'] as $id=>$count) {
		$stmt = $pdo->prepare("SELECT * FROM Products WHERE id = :id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if(sizeof($result) == 0) {
			die();
		}
		$products[$id] = $result;
		$products[$id]['count'] = $count;
	}

	return $products;
}

function getRandomString($length = 10) {
	return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}