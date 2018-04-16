<?php
	include("admin/db_con.php");
	include("session.php");
	
	if(isset($_SESSION['id']))
	{
		$account_number = $_SESSION['id'];
		$query_log_id = "SELECT MAX(log_id) FROM userlog_tbl WHERE account_number = '$account_number' AND logout_time = '00:00:00'";
		$result_log_id = $con->query($query_log_id);
		$row_log_id = $result_log_id->fetch_assoc();
		$log_id = $row_log_id['MAX(log_id)'];

		$query_logout = "UPDATE userlog_tbl SET logout_time = NOW() WHERE log_id = '$log_id'";
		if($result_logout = $con->query($query_logout))
		{
			session_destroy();
			header("location: login.php");
		}
	}
?>