<?php
	include("db_con.php");

	session_start();
	
	if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) 
	{
		echo "<script>window.location='../login.php?failed'</script>";
		exit();
	}
	$session_id=$_SESSION['id'];

	$query_type = "SELECT * FROM account_tbl WHERE account_number = '$session_id'";
	$result_type = $con->query($query_type);
	$row_type = $result_type->fetch_assoc();
	$user_level = $row_type['account_type'];

	if($user_level != "Admin")
	{
		if($user_level == "Regular")
		{
			header("location: ../borrower/home.php");
		}
		else if($user_level == "Staff")
		{
			header("location: ../staff/home.php");	
		}
	}
?>