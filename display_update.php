<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Display Update / Luigi Vincent Project 4</title>
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
	?>

	<form action="update_products.php" method="post">
		<table border='1'>
			<tr>
				<th>Product ID</th> <th>Product Name</th> <th>Description</th>
	 			<th>Cost</th> <th>Sell Price</th> <th>Quantity</th>
	      		<th>User ID</th> <th>Vendor</th>
	      	</tr>
	    <?php
	    $query = "SELECT P.id, P.name, description, cost, sell_price, quantity, U.id, V.name FROM Products_vincenlu P, Users U, Vendors V WHERE P.user_id = U.id AND vendor_id = V_Id ORDER BY P.id";
	    $result = mysql_query($query);
	    while ($row = mysql_fetch_row($result)) {
			echo "<tr>
					<td><input type='hidden' name='id[]' value='$row[0]'>$row[0]</td>
					<td><input type='hidden' name='name[]' value='$row[1]'>$row[1]</td>
					<td><input type='text' name='description[]' value='$row[2]'></td>
				  	<td><input type='text' name='cost[]' style='width:50px;' value='$row[3]'></td>
				  	<td><input type='text' name='sell_price[]' style='width:70px;' value='$row[4]'></td>
				  	<td><input type='text' name='quantity[]' style='width:70px;' value='$row[5]'></td>
				  	<td>$row[6]</td></td><td>$row[7]</td>
				</tr>";
		}
		echo "</table>";
	    ?>
		
		<input class="submit" type="submit" value="Update Products">
	</form>
</html>