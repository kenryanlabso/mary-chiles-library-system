<?php
	include("admin/db_con.php");
	$current_date_time = date("Y-m-d h:i:s A");
	$current_date = date("Y-m-d");
	$current_time = date("H:i:s");

	//Refresh reservations
	$query_refresh_reserve = "SELECT * FROM reservation_tbl";
	$result_refresh_reserve = $con->query($query_refresh_reserve);
	while($row_refresh_reserve = $result_refresh_reserve->fetch_assoc())
	{
		$reservation_id = $row_refresh_reserve['reservation_id'];
		$expiration_date = date($row_refresh_reserve['expiration_date']);
		if(strtotime($current_date_time) > strtotime($expiration_date))
		{
			$query_expire = "UPDATE reservation_tbl SET reserve_status = 'Expired' WHERE reservation_id = '$reservation_id'";
			$result_pepe = $con->query($query_expire);
		}
	}

	//Refresh Userlogs
	$query_student_logs = "SELECT * FROM account_tbl INNER JOIN student_tbl ON account_tbl.account_number = student_tbl.account_number INNER JOIN userlog_tbl ON account_tbl.account_number = userlog_tbl.account_number WHERE userlog_tbl.date_login = '$current_date' AND userlog_tbl.logout_time = '00:00:00' AND account_tbl.account_type = 'Regular'";
	$result_student_logs = $con->query($query_student_logs);
	while($row_student_logs = $result_student_logs->fetch_assoc())
	{
		$log_id = $row_student_logs['log_id'];
		$login_time = $row_student_logs['login_time'];
		$expired_time = date("H:i:s", strtotime($login_time."+ 1 hour"));

		if(strtotime($current_time) >= strtotime($expired_time))
		{
			$query_student_logout = "UPDATE userlog_tbl SET logout_time = '$current_time' WHERE log_id = '$log_id'";
			if($result_student_logout = $con->query($query_student_logout))
			{
				session_destroy();
				echo "<script>alert('Session expired. Login again to continue.'); window.location='../login.php?failed'; </script>";
			}
		}
	}

	$query_employee_logs = "SELECT * FROM account_tbl INNER JOIN employee_tbl ON account_tbl.account_number = employee_tbl.account_number INNER JOIN userlog_tbl ON account_tbl.account_number = userlog_tbl.account_number WHERE userlog_tbl.date_login = '$current_date' AND userlog_tbl.logout_time = '00:00:00' AND account_tbl.account_type = 'Regular'";
	$result_employee_logs = $con->query($query_employee_logs);
	while($row_employee_logs = $result_employee_logs->fetch_assoc())
	{
		$log_id = $row_employee_logs['log_id'];
		$login_time = $row_employee_logs['login_time'];
		$expired_time = date("H:i:s", strtotime($login_time."+ 1 hour"));

		if(strtotime($current_time) >= strtotime($expired_time))
		{
			$query_employee_logout = "UPDATE userlog_tbl SET logout_time = '$current_time' WHERE log_id = '$log_id'";
			if($result_employee_logout = $con->query($query_employee_logout))
			{
				session_destroy();
				header("location: ../login.php?page=failed");
			}
		}
	}

	$query_all_logs = "SELECT * FROM account_tbl INNER JOIN userlog_tbl ON account_tbl.account_number = userlog_tbl.account_number WHERE userlog_tbl.logout_time = '00:00:00'";
	$result_all_logs = $con->query($query_all_logs);
	while($row_all_logs = $result_all_logs->fetch_assoc())
	{
		$log_id = $row_all_logs['log_id'];
		$login_time = $row_all_logs['login_time'];
		$date_login = $row_all_logs['date_login'];
		$expired_time_temp = $date_login." ".$login_time;
		$expired_date_time = date("Y-m-d H:i:s", strtotime($expired_time_temp."+ 4 hours"));

		if(strtotime($current_date_time) >= strtotime($expired_date_time))
		{
			$query_all_logout = "UPDATE userlog_tbl SET logout_time = '$current_time' WHERE log_id = '$log_id'";
			if($result_all_logout = $con->query($query_all_logout))
			{
				session_destroy();
				echo "<script>alert('Session expired. Login again to continue.'); window.location='../login.php?failed'; </script>";
			}
		}
	}

	//Refresh Penalty
	$query_refresh_penalty = "SELECT * FROM transaction_tbl WHERE return_date = '0000-00-00 00:00:00' AND transaction_status = 'Borrowed'";
	$result_refresh_penalty = $con->query($query_refresh_penalty);
	while($row_refresh_penalty = $result_refresh_penalty->fetch_assoc())
	{
		$transaction_id = $row_refresh_penalty['transaction_id'];
		$due_date = date($row_refresh_penalty['due_date']);

		if(strtotime($current_date) > strtotime($due_date))
		{
			$query_fine_rate = "SELECT fine_student, fine_employee FROM settings_tbl WHERE settings_id = 1";
			$result_fine_rate = $con->query($query_fine_rate);
			$row_fine_rate = $result_fine_rate->fetch_assoc();
			$fine_student = $row_fine_rate['fine_student'];
			$fine_employee = $row_fine_rate['fine_employee'];

			$query_check_user ="SELECT COUNT(*) FROM transaction_tbl INNER JOIN student_tbl ON transaction_tbl.account_number = student_tbl.account_number WHERE transaction_id = '$transaction_id'";
			$result_check_user = $con->query($query_check_user);
			$row_check_user = $result_check_user->fetch_assoc();
			$check_user = $row_check_user['COUNT(*)'];
			if($check_user > 0)
			{
				$fine_rate = $fine_student;
			}
			else
			{
				$fine_rate = $fine_employee;
			}

			$query_check_penalty = "SELECT COUNT(*) FROM penalty_tbl WHERE penalty_tbl.transaction_id = '$transaction_id'";
			$result_check_penalty = $con->query($query_check_penalty);
			$row_check_penalty = $result_check_penalty->fetch_assoc();
			$existing_penalty = $row_check_penalty['COUNT(*)'];
			if($existing_penalty > 0)
			{
				$holidays = array();
				$query_holidays = "SELECT * FROM holiday_tbl WHERE holiday_delete = 0";
				$result_holidays = $con->query($query_holidays);
				while($row_holidays = $result_holidays->fetch_assoc())
				{
					array_push($holidays, $row_holidays['holiday_date']);
				}

				$query_penalty_info = "SELECT * FROM penalty_tbl WHERE transaction_id = '$transaction_id'";
				$result_penalty_info = $con->query($query_penalty_info);
				$row_penalty_info = $result_penalty_info->fetch_assoc();
				$penalty_id = $row_penalty_info['penalty_id'];
				$amount_receivable = $row_penalty_info['amount_receivable'];
				$date_updated = date($row_penalty_info['date_updated']);

				$days_initial = (strtotime($current_date) - strtotime($date_updated)) / 86400;
				$days_count = $days_initial;
				for($i=1;$i<=$days_initial;$i++)
				{
					$day_of_week = date("D", strtotime($date_updated."+ ".$i." days"));
					$date_loop = date("Y-m-d", strtotime($date_updated."+ ".$i." days"));
					if($day_of_week == "Sun")
					{
						$days_count--;
					}
					else if(in_array($date_loop, $holidays)) 
					{
						$days_count--;
					}
				}
				$days_count;
				$temporary_fine_amount = $fine_rate * $days_count;
				$fine_amount = $temporary_fine_amount + $amount_receivable;

				$query_update_penalty = "UPDATE penalty_tbl SET amount_receivable = '$fine_amount', date_updated = '$current_date' WHERE penalty_id = '$penalty_id'";
				$result_update_penalty = $con->query($query_update_penalty);
			}
			else
			{
				$holidays = array();
				$query_holidays = "SELECT * FROM holiday_tbl WHERE holiday_delete = 0";
				$result_holidays = $con->query($query_holidays);
				while($row_holidays = $result_holidays->fetch_assoc())
				{
					array_push($holidays, $row_holidays['holiday_date']);
				}

				$days_initial = (strtotime($current_date) - strtotime($due_date)) / 86400;
				$days_count = $days_initial;

				for($i=1;$i<=$days_initial;$i++)
				{
					$day_of_week = date("D", strtotime($due_date."+ ".$i." days"));
					$date_loop = date("Y-m-d", strtotime($due_date."+ ".$i." days"));
					if($day_of_week == "Sun")
					{
						$days_count--;
					}
					else if(in_array($date_loop, $holidays)) 
					{
						$days_count--;
					}
				}
				$days_count;
				$fine_amount = $fine_rate * $days_count;
				$query_add_penalty = "INSERT INTO penalty_tbl (amount_receivable, date_updated, payment_status, transaction_id) VALUES ('$fine_amount', '$current_date', 'Pending', '$transaction_id')";
				$result_add_penalty = $con->query($query_add_penalty);
			}
		}
	}
?>