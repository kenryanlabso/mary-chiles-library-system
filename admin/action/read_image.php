<?php
	include("../db_con.php");

	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
		if($page == "user")
		{
			$account_number = $_POST['account_id'];
			$response = array();

			$query_check = "SELECT COUNT(*) FROM student_tbl WHERE student_id = '$account_number'";
			$result_check = $con->query($query_check);
			$row_check = $result_check->fetch_assoc();
			$result_true = $row_check['COUNT(*)'];
			if($result_true == 1)
			{
				$query_student = "SELECT student_image AS user_image FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id WHERE account_tbl.account_number = '$account_number'";
				$result_student = $con->query($query_student);
				$row_student = $result_student->fetch_assoc();
				$response = $row_student;
				echo json_encode($response);
			}
			else
			{
				$query_employee = "SELECT employee_image AS user_image FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number INNER JOIN department_tbl ON employee_tbl.department_id = department_tbl.department_id WHERE account_tbl.account_number = '$account_number'";
				$result_employee = $con->query($query_employee);
				$row_employee = $result_employee->fetch_assoc();
				$response = $row_employee;
				echo json_encode($response);
			}
		}
		else if($page == "book")
		{
			$book_id = $_POST['book_id'];
			$response = array();
			
			$query_book = "SELECT * FROM book_tbl WHERE book_id = '$book_id'";
			$result_book = $con->query($query_book);
			$row_book = $result_book->fetch_assoc();
			$response = $row_book;
			echo json_encode($response);
		}
	}	
?>