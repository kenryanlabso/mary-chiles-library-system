<?php
	include("../session.php");
	include("../db_con.php");

	$holidays = array();
	$account_number = $_SESSION['id'];
	$book_id = $_POST['book-id'];
	$reserve_date = date("Y-m-d H:i:s");
	$reserve_status = "Pending";

	$query_expiration = "SELECT reserve_days_student, reserve_days_employee FROM settings_tbl WHERE settings_id = 1";
	$result_expiration = $con->query($query_expiration);
	$row_expiration = $result_expiration->fetch_assoc();

	$reserve_days_student = $row_expiration['reserve_days_student'];
	$reserve_days_employee = $row_expiration['reserve_days_employee'];

	$query_holidays = "SELECT * FROM holiday_tbl WHERE holiday_delete = 0";
	$result_holidays = $con->query($query_holidays);
	while($row_holidays = $result_holidays->fetch_assoc())
	{
		array_push($holidays, $row_holidays['holiday_date']);
	}

	$query_check = "SELECT * FROM student_tbl WHERE student_id = '$account_number'";
	$result_check = $con->query($query_check);
	if($result_check->num_rows > 0)
	{
		$allowable_days = $reserve_days_student;
	}
	else
	{
		$allowable_days = $reserve_days_employee;
	}

	for($i=1;$i<=$allowable_days;$i++)
	{
		$day_of_week = date("D", strtotime($reserve_date."+ ".$i." days"));
		$temp_dates = date("Y-m-d", strtotime($reserve_date."+ ".$i." days"));

		if($day_of_week == "Sun")
		{
			$allowable_days++;
		}
		else if(in_array($temp_dates, $holidays))
		{
			$allowable_days++;	
		}
	}

	$expiration_date = date("Y-m-d H:i:s", strtotime($reserve_date."+ ".$allowable_days." days"));

	$query_reserve = "INSERT INTO reservation_tbl (account_number, book_id, reserve_date, expiration_date, reserve_status) VALUES ('$account_number', '$book_id', '$reserve_date', '$expiration_date', '$reserve_status')";
	$result_reserve = $con->query($query_reserve);
?>