<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Update Products / Luigi Vincent Project 4</title>
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	<?php
		include "connection.php";
		
		if(!isset($_COOKIE['user_id'])) {
			fail_print("You are not logged in.");
		}
		$id = $_COOKIE['user_id'];

		$query = "SELECT * FROM Users WHERE id = $id AND role = 'staff'";
		$result = mysql_query($query);
		if (mysql_num_rows($result) == 0) {
			fail_print("You are not staff.");
		}

		$id = $_POST["id"];
		$name = $_POST["name"];
		$description = $_POST["description"];
		$cost = $_POST["cost"];
		$price = $_POST["sell_price"];
		$quantity = $_POST["quantity"];

		for($i = 0; $i < count($id); $i++) {
			if (!is_numeric($cost[$i]) or (int)$cost[$i] < 0) {
				fail_print("Cost for $name[$i] must be a non-negative integer.");
			}
			if (!is_numeric($price[$i]) or (int)$price[$i] < 0) {
				fail_print("Price for $name[$i] must be a non-negative integer.");
			}
			if (!is_numeric($quantity[$i]) or (int)$quantity[$i] < 1) {
				fail_print("Quantity for $name[$i] must be a positive integer.");
			}
			if ((int)$price[$i] < (int)$cost[$i]) {
				fail_print("Sell price for $name[$i] may not be less than cost");
			}
			if (strlen(trim($description[$i])) == 0) {
				fail_print("Must enter description for $name[$i].");
			}

			mysql_query("UPDATE Products_vincenlu SET cost=$cost[$i], sell_price=$price[$i], quantity=$quantity[$i], description='$description[$i]' WHERE id=$id[$i]");
		}

		mysql_close();
		echo "<span class='sucess'>Sucessfully updated products.</span>";
		echo "<br><br><a href='view_products.php'>View products</a>";
		echo "<br><br><a href='logout.php'>Logout</a>";
	?>
</html>