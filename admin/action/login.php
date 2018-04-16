<?php
	include("../db_con.php");

	$account_number = $con->escape_string($_POST['user-id']);
	$password = md5($_POST['password']);

	$query_account_number = "SELECT COUNT(*) FROM account_tbl WHERE account_number = '$account_number'";
	$result_account_number = $con->query($query_account_number);
	$row_account_number = $result_account_number->fetch_assoc();
	if($row_account_number['COUNT(*)'] == 1)
	{
		$query_login = "SELECT COUNT(*) FROM account_tbl WHERE account_number = '$account_number' AND account_password = '$password'";
		$result_login = $con->query($query_login);
		$row_login = $result_login->fetch_assoc();
		if($row_login['COUNT(*)'] == 1)
		{
			$query_status = "SELECT account_status FROM account_tbl WHERE account_number = '$account_number' AND account_password = '$password'";
			$result_status = $con->query($query_status);
			$row_status = $result_status->fetch_assoc();
			$account_status = $row_status['account_status'];
			if($account_status == 'Inactive')
			{
				$response = "Sorry. The account you entered is not activated.";
				echo json_encode($response);
			}
			else if($account_status == 'Banned')
			{
				$response = "Sorry. The account you entered is currently banned and is not allowed to access the online library.";
				echo json_encode($response);
			}
			else
			{
				
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$date_login = date("Y-m-d");
				$login_time = date("H:i:s");

				$query_user_log = "INSERT INTO userlog_tbl (ip_address, date_login, login_time, account_number) VALUES ('$ip_address', '$date_login', '$login_time', '$account_number')";
				if($result_user_log = $con->query($query_user_log))
				{
					session_start();
					$_SESSION['id'] = $account_number;
					$response = "Login successfully!";
					echo json_encode($response);
				}
			}
		}
		else
		{
			$response = "Incorrect password.";
			echo json_encode($response);	
		}
	}
	else
	{
		$response = "Account does not exists.";
		echo json_encode($response);
	}
?>