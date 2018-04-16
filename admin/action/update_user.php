<?php
	include("../db_con.php");

	if(isset($_GET['type']))
	{
		$type = $_GET['type'];
		if($type == "employee")
		{
			$employee_id = $_POST['account_number'];
			$employee_firstname = $con->escape_string($_POST['firstname']);
			$employee_mi = $con->escape_string($_POST['mi']);
			$employee_lastname = $con->escape_string($_POST['lastname']);
			$employee_birthday = $_POST['birthday'];
			$employee_email = $con->escape_string($_POST['email']);
			$employee_contact = $_POST['contact_number'];
			$department_id = $_POST['department_id'];

			$query_employee = "UPDATE employee_tbl SET employee_fname = '$employee_firstname', employee_mi = '$employee_mi', employee_lname = '$employee_lastname', employee_birthday = '$employee_birthday', employee_email = '$employee_email', employee_contact = '$employee_contact', department_id = '$department_id' WHERE employee_id = '$employee_id'";
			$result_employee = $con->query($query_employee);

		}
		else if($type == "student")
		{
			$student_id = $_POST['account_number'];
			$student_firstname = $con->escape_string($_POST['firstname']);
			$student_mi = $con->escape_string($_POST['mi']);
			$student_lastname = $con->escape_string($_POST['lastname']);
			$student_birthday = $_POST['birthday'];
			$student_email = $con->escape_string($_POST['email']);
			$student_contact = $con->escape_string($_POST['contact_number']);
			$course_id = $_POST['course_id'];

			$query_student = "UPDATE student_tbl SET student_fname = '$student_firstname', student_mi = '$student_mi', student_lname = '$student_lastname', student_birthday = '$student_birthday', student_email = '$student_email', student_contact = '$student_contact', course_id = '$course_id' WHERE student_id = '$student_id'";
			$result_employee = $con->query($query_student);

		}
	}

?>