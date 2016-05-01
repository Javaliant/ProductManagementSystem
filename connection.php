<?php
$hostname = "imc.kean.edu";
$username = "vincenlu";
$password = "737358";
$dbname = "CPS3740_2016S";

mysql_connect($hostname, $username, $password);
mysql_select_db($dbname);

function fail_print($message) {
	echo "<span class='error'>$message</span>";
	die;
}
?>