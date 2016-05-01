<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Submission / Luigi Vincent Project 4</title>
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	<?php
		include 'connection.php';

		$username = strtolower($_POST["username"]);
		$password = $_POST["password"];

		$query = "SELECT login, password, first_name, last_name, role, address, state, zipcode, id FROM Users WHERE login='$username'";
		$result = mysql_query($query);
		$row = mysql_fetch_row($result);

		if (strcmp($username, $row[0]) != 0) {
			fail_print("Login ID '$username' doesn't exist in the database.");
		}
		setcookie('user_id', $row[8], time() + (86400)); // 86400 = 1 day

		if (strcmp($password, $row[1]) != 0) {
			fail_print("Existing user but incorrect password.");
		}

		$ip = $_SERVER["REMOTE_ADDR"];
		echo "Welcome <b>" . $row[2] . ' ' . $row[3] . "</b> from IP: " . $ip . '<br>';
		echo "You are a <b>" . $row[4] . '.</b><br>';
		if (strcmp(substr($ip, 0, 3), "10.") == 0 || strcmp(substr($ip, 0, 8), "131.125")) {
			echo "You are from Kean domain.<br>";
		}
		echo "Your address is: " . $row[5] . ', ' . $row[6] . ' ' . $row[7] . '.<br><br>';
		if ($row[4] === 'staff') {
			echo "<br><br><a href='display_update.php'>Update products</a>";
		}
		echo "<br><br><a href='add_product.php'>Add product</a>";
		echo "<br><br><a href='view_products.php'>View products</a>";
		echo "<br><br><a href='logout.php'>Logout</a>";
	?>
</html>