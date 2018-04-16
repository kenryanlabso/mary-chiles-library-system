<?php
	//Database connection
	include("../db_con.php");

	//Handling file
	$file=$_FILES['user-image']['tmp_name'];
	$image = $_FILES['user-image'] ['name'];
	$image_name= addslashes($_FILES['user-image']['name']);
	$size = $_FILES['user-image'] ['size'];
	$error = $_FILES['user-image'] ['error'];

	//Conditions for the file
	if($size > 10000000)
	{
		die("Format is not allowed or file size is too big!");
	}
	else
	{
		//Upload book image
		move_uploaded_file($_FILES['user-image']['tmp_name'],"../uploads/users/".$_FILES['user-image']['name']);
	}

	$account_type = $_POST['account-class'];
	$account_class = "Regular";
	$account_status = "Active";
	$date_registered = date("Y-m-d");

	if($account_type == "Employee")
	{
		$employee_number = $con->escape_string($_POST['employee-number']);
		$department_id = $_POST['department-id'];
		if(!empty($employee_number) && !empty($department_id))
		{
			$account_number = $employee_number;
			$employee_firstname = $con->escape_string($_POST['first-name']);
			$employee_mi = $con->escape_string($_POST['middle-initial']);
			$employee_lastname = $con->escape_string($_POST['last-name']);
			$employee_birthday = $_POST['birthday'];
			$employee_email = $con->escape_string($_POST['e-mail']);
			$employee_contact = $con->escape_string($_POST['contact-number']);
			$employee_image = $_FILES['user-image']['name'];
			$account_password = $con->escape_string(md5(substr($employee_firstname, 0, 1)."".substr($employee_mi, 0, 1)."".substr($employee_lastname, 0, 1)."".substr($employee_birthday, 5, 2)."".substr($employee_birthday, 8, 2)."".substr($account_number, -3)));

			$query_account = "INSERT INTO account_tbl (account_number, account_password, account_type, account_registered, account_status) VALUES ('$account_number', '$account_password', '$account_class', '$date_registered', '$account_status')";
			if($result_account = $con->query($query_account))
			{
				$query_employee = "INSERT INTO employee_tbl (employee_id, employee_fname, employee_mi, employee_lname, employee_birthday, employee_email, employee_contact, employee_image, department_id, account_number) VALUES ('$employee_number', '$employee_firstname', '$employee_mi', '$employee_lastname', '$employee_birthday', '$employee_email', '$employee_contact', '$employee_image', '$department_id', '$account_number')";
				if($result_employee = $con->query($query_employee))
				{
					echo "Employee registered!";

				}
			}
		}
	}
	else if($account_type == "Student")
	{
		$student_number = $con->escape_string($_POST['student-number']);
		$course_id = $_POST['course-id'];
		if(!empty($student_number) && !empty($course_id))
		{
			$account_number = $student_number;
			$student_firstname = $con->escape_string($_POST['first-name']);
			$student_mi = $con->escape_string($_POST['middle-initial']);
			$student_lastname = $con->escape_string($_POST['last-name']);
			$student_birthday = $_POST['birthday'];
			$student_email = $con->escape_string($_POST['e-mail']);
			$student_contact = $con->escape_string($_POST['contact-number']);
			$student_image = $_FILES['user-image']['name'];
			$account_password = $con->escape_string(md5(substr($student_firstname, 0, 1)."".substr($student_mi, 0, 1)."".substr($student_lastname, 0, 1)."".substr($student_birthday, 5, 2)."".substr($student_birthday, 8, 2)."".substr($account_number, -3)));

			$query_account = "INSERT INTO account_tbl (account_number, account_password, account_type, account_registered, account_status) VALUES ('$account_number', '$account_password', '$account_class', '$date_registered', '$account_status')";
			if($result_account = $con->query($query_account))
			{
				$query_student = "INSERT INTO student_tbl (student_id, student_fname, student_mi, student_lname, student_birthday, student_email, student_contact, student_image, course_id, account_number) VALUES ('$student_number', '$student_firstname', '$student_mi', '$student_lastname', '$student_birthday', '$student_email', '$student_contact', '$student_image', '$course_id', '$account_number')";
				if($result_student = $con->query($query_student))
				{
					echo "Student registered!";
				}
			}
		}
	}
?>
