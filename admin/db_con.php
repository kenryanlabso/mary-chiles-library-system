<?php
	date_default_timezone_set("Asia/Manila");
	
	$server_name = "localhost";
	$user_name = "root";
	$password = "";
	$db_name = "marychiles_db";

	$con = new mysqli($server_name, $user_name, $password, $db_name);

	if ($con->connect_error) 
	{
	    die("Connection failed: " . $con->connect_error);
	} 

?>