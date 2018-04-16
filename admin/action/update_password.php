<?php
	include("../db_con.php");
	include("../session.php");

	$account_number = $_SESSION['id'];
	$old_password = md5($con->escape_string($_POST['old-password']));
	$new_password = md5($con->escape_string($_POST['new-password']));

	$query_check = "SELECT account_password FROM account_tbl WHERE account_number = '$account_number'";
	$result_check = $con->query($query_check);
	$row_check = $result_check->fetch_assoc();
	$account_password = $row_check['account_password'];

	if($account_password == $old_password)
	{
		$query_update = "UPDATE account_tbl SET account_password = '$new_password' WHERE account_number = '$account_number'";
		if($result_update = $con->query($query_update))
		{
			$response = "Password successfully updated!";
			echo json_encode($response);
		}
	}
	else
	{
		$response = "Incorrect Password!";
		echo json_encode($response);
	}
?>