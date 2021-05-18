<?php

$db_host = "localhost";
$db_name = "avamas_db";
$db_user = "root";
$db_pass = "";
$edit_state ="";
$u_name ="";
$u_telephone ="";
$u_email ="";
$u_username ="";
$u_type ="";
$mysqli = new mysqli ($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
	printf("Connection failed: %s\n", $mysqli->connect_error);
	exit();
}
?>