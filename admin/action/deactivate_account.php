<?php
	include("../db_con.php");
	include("../session.php");

	$account_number = $con->escape_string($_POST['account-number']);

	$query_deactivate = "UPDATE account_tbl SET account_status = 'Inactive' WHERE account_number = '$account_number'";
	$result_deactivate = $con->query($query_deactivate);
?>