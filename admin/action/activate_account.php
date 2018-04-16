<?php
	include("../db_con.php");
	include("../session.php");

	$account_number = $con->escape_string($_POST['account-number']);

	$query_activate = "UPDATE account_tbl SET account_status = 'Active' WHERE account_number = '$account_number'";
	$result_activate = $con->query($query_activate);
?>