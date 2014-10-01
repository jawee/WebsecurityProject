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

// if(count($_SESSION['cart_items'])>0){
 
//     // get the product ids
//     $ids = "";
//     foreach($_SESSION['cart_items'] as $id=>$value){
//         $ids = $ids . $id . ",";
//     }
 
//     // remove the last comma
//     $ids = rtrim($ids, ',');
 
//     //start table
//     echo "<table class='table table-hover table-responsive table-bordered'>";
 
//         // our table heading
//         echo "<tr>";
//             echo "<th class='textAlignLeft'>Product Name</th>";
//             echo "<th>Price (USD)</th>";
//             echo "<th>Action</th>";
//         echo "</tr>";
 
//         $query = "SELECT id, name, price FROM products WHERE id IN ({$ids}) ORDER BY name";
 
//         $stmt = $con->prepare( $query );
//         $stmt->execute();
 
//         $total_price=0;
//         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//             extract($row);
 
//             echo "<tr>";
//                 echo "<td>{$name}</td>";
//                 echo "<td>&#36;{$price}</td>";
//                 echo "<td>";
//                     echo "<a href='remove_from_cart.php?id={$id}&name={$name}' class='btn btn-danger'>";
//                         echo "<span class='glyphicon glyphicon-remove'></span> Remove from cart";
//                     echo "</a>";
//                 echo "</td>";
//             echo "</tr>";
 
//             $total_price+=$price;
//         }
 
//         echo "<tr>";
//                 echo "<td><b>Total</b></td>";
//                 echo "<td>&#36;{$total_price}</td>";
//                 echo "<td>";
//                     echo "<a href='#' class='btn btn-success'>";
//                         echo "<span class='glyphicon glyphicon-shopping-cart'></span> Checkout";
//                     echo "</a>";
//                 echo "</td>";
//             echo "</tr>";
 
//     echo "</table>";
// }
