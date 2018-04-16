<?php
	include("../db_con.php");

	if(isset($_POST['account_id']))
	{
		$account_number = $_POST['account_id'];
		if(isset($_GET['page']))
		{
			$page = $_GET['page'];
			if($page == "employee")
			{
				$query_employee = "SELECT * FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number INNER JOIN department_tbl ON employee_tbl.department_id = department_tbl.department_id WHERE account_tbl.account_number = '$account_number'";
				$result_employee = $con->query($query_employee);
				$response = array();
				while($row_employee = $result_employee->fetch_assoc())
				{
					$response = $row_employee;
				}
				echo json_encode($response);
			}
			else if($page == "student")
			{
				$query_student = "SELECT * FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id WHERE account_tbl.account_number = '$account_number'";
				$result_student = $con->query($query_student);
				$response = array();
				while($row_student = $result_student->fetch_assoc())
				{
					$response = $row_student;
				}
				echo json_encode($response);
			}
		}
	}
?>