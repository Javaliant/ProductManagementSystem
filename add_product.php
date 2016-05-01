<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Add Products</title>
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>

	<body>
	<?php
		include 'connection.php';
		
		if(!isset($_COOKIE['user_id'])){
			fail_print("You are not logged in.");
		}
	?>
		<h2>Add Products</h2>	
		<div><form action="validate_product.php" method="post">
			<div>Product Name: <input type="text" class="input" name="name" required="required" /></div>
			<div>Description: <input type="text" class="input" name="description" style="margin-left: 23px;" required="required" /></div>
			<div>Cost: <input type="text" name="cost" class="input" style="margin-left: 71px;" required="required" /></div>
			<div>Sell Price: <input type="text" name="price" class="input" style="margin-left: 38px;" required="required" /></div>
			<div>Quantity: <input type="text" name="quantity" class="input" style="margin-left: 40px;" required="required" /></div>
			<div>Select Vendor:
				<select name="vendor">
				<?php
					$query = "SELECT Name FROM Vendors";
					$result = mysql_query($query);
					while ($row = mysql_fetch_row($result)) {
						echo "<option value='$row[0]'>$row[0]</option>";
					}
				?>
				</select> <input id="submit" type="submit" value="Submit">
			</div>
		</form></div>
	</body>
</html>