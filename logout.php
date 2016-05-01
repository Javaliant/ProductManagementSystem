<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Submission / Luigi Vincent Project 4</title>
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
<?php
if ($_COOKIE['user_id'] === '-1' || !isset($_COOKIE['user_id'])) {
	echo "You have already logged out.";
} else {
	unset($_COOKIE['user_id']);
	setcookie('user_id', '-1');
	echo "You have successfully logged out.";
}
?>
</html>