<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Validate Product</title>
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>

	<body>
	<?php
		include 'connection.php';

		$cost = $_POST["cost"];
		$price = $_POST["price"];
		$quantity = $_POST["quantity"];
		$name = $_POST["name"];
		$description = $_POST["description"];
		$vendor = $_POST["vendor"];

		if (!is_numeric($cost) or (int)$cost < 0) {
			fail_print("Cost must be a non-negative integer.");
		}
		if (!is_numeric($price) or (int)$price < 0) {
			fail_print("Price must be a non-negative integer.");
		}
		if (!is_numeric($quantity) or (int)$quantity < 1) {
			fail_print("Quantity must be a positive integer.");
		}
		if ((int)$price < (int)$cost) {
			fail_print("Sell price may not be less than cost");
		}

		$query = "SELECT name FROM Products_vincenlu WHERE name='$name'";
		$result = mysql_query($query);
		if (!mysql_num_rows($result) == 0) {
			fail_print("Product already exists");
		}

		$query = "SELECT V_Id from Vendors WHERE Name='$vendor'";
		$result = mysql_query($query);
		$row = mysql_fetch_row($result);
		$vendor_id = $row[0];
		$user_id = $_COOKIE['user_id'];

		if (mysql_query("INSERT INTO Products_vincenlu(name, description, sell_price, cost, quantity, user_id, vendor_id)
						 VALUES ('$name', '$description', $price, $cost, $quantity, $user_id, $vendor_id)")) {
			echo "<span class='sucess'>Sucessfully added product.</span>";
		} else {
			fail_print("Failed to add product.");
		}

		echo "<br><br><a href='view_products.php'>View Products</a>";
	?>
	</body>
</html>
