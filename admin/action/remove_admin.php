<?php
	include("../db_con.php");

	$account_number = $_POST['account-number'];

	$query_remove_admin = "UPDATE account_tbl SET account_type = 'Regular' WHERE account_number = '$account_number'";
	$result_remove_admin = $con->query($query_remove_admin);
	
?>