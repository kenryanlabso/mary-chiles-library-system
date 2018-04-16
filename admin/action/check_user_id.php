<?php
	include("../db_con.php");
	include("../session.php");

	if(isset($_GET['type']))
	{
		$type = $_GET['type'];
		if($type == 'student')
		{
			$student_number = $_POST['student_number'];

			$query_check = "SELECT COUNT(*) FROM account_tbl INNER JOIN student_tbl ON account_tbl.account_number = student_tbl.account_number WHERE student_id = '$student_number'";
			$result_check = $con->query($query_check);
			$row_check = $result_check->fetch_assoc();
			$result_found = $row_check['COUNT(*)'];
			if($result_found > 0)
			{
				$response = "Account already exists";
				echo json_encode($response);
			}
			else
			{
				$response = "Valid account";
				echo json_encode($response);
			}
		}
		else
		{
			$employee_number = $_POST['employee_number'];

			$query_check = "SELECT COUNT(*) FROM account_tbl INNER JOIN employee_tbl ON account_tbl.account_number = employee_tbl.account_number WHERE employee_id = '$employee_number'";
			$result_check = $con->query($query_check);
			$row_check = $result_check->fetch_assoc();
			$result_found = $row_check['COUNT(*)'];
			if($result_found > 0)
			{
				$response = "Account already exists";
				echo json_encode($response);
			}
			else
			{
				$response = "Valid account";
				echo json_encode($response);
			}

		}
	}
?>