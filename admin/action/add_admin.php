<?php
	include("../db_con.php");

	$account_id = $_POST['account-id'];
	$account_type = $_POST['account-priviledge'];

	if($account_type == "Admin")
	{
		$query_admin = "UPDATE account_tbl SET account_type = '$account_type' WHERE account_number = '$account_id'";
		$result_admin = $con->query($query_admin);
	}
	else if($account_type == "Staff")
	{
		$query_staff = "UPDATE account_tbl SET account_type = '$account_type' WHERE account_number = '$account_id'";
		$result_staff = $con->query($query_staff);
	}
?>