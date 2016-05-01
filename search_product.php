<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Product Search / Luigi Vincent Project 4</title>
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	
	<body>
	<?php
		include 'connection.php';

		$keywords = $_GET["keywords"];
		if (strlen(trim($keywords)) == 0) {
			fail_print("No keyword entered.");
		}

		$table_header ="<table border='1'>
			<tr>
				<th>ID</th> <th>Name</th> <th>Description</th>
	 			<th>Sell Price</th> <th>Cost</th> <th>Quantity</th>
	      		<th>User Name</th> <th>Vendor Name</th>
	      	</tr>";

	    if ($keywords === '*') {
		    $query = "SELECT id, name, description, sell_price, cost, quantity, user_id, vendor_id FROM Products_vincenlu";
			$result = mysql_query($query);
			echo $table_header;
			while ($row = mysql_fetch_row($result)) {
				$vendor_name = mysql_fetch_row(mysql_query("SELECT name FROM Vendors WHERE V_Id= '$row[7]'"));
				$user_name = mysql_fetch_row(mysql_query("SELECT first_name FROM Users WHERE id='$row[6]'"));

				echo "<tr>
						<td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td>
					  	<td>$row[3]</td><td>$row[4]</td><td>$row[5]</td>
					  	<td>$user_name[0]</td><td>$vendor_name[0]</td>
					</tr>";
			}
			echo "</table>";
			die;
	    }

		$query = "SELECT id, name, description, sell_price, cost, quantity, user_id, vendor_id FROM Products_vincenlu WHERE name LIKE '%$keywords%' OR description like '%$keywords%'";
		$result = mysql_query($query);
		if (mysql_num_rows($result) == 0) {
			fail_print("No record found with keyword: $keywords");
		} else {
			echo $table_header;
			while ($row = mysql_fetch_row($result)) {
				$vendor_name = mysql_fetch_row(mysql_query("SELECT name FROM Vendors WHERE V_Id= '$row[7]'"));
				$user_name = mysql_fetch_row(mysql_query("SELECT first_name FROM Users WHERE id='$row[6]'"));

				echo "<tr>
						<td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td>
					  	<td>$row[3]</td><td>$row[4]</td><td>$row[5]</td>
					  	<td>$user_name[0]</td><td>$vendor_name[0]</td>
					</tr>";
			}
			echo "</table>";
		}
	?>
	</body>
</html>