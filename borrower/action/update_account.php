<?php
	include("../db_con.php");
	include("../session.php");

	$account_number = $_SESSION['id'];
	$birthday = $_POST['birthday'];
	$email = $_POST['email'];
	$contact_number = $_POST['contact-number'];

	$check_student = $con->query("SELECT * FROM student_tbl WHERE student_id = '$account_number'");
	if($check_student->num_rows > 0)
	{
		$update_student = $con->query("UPDATE student_tbl SET student_birthday = '$birthday', student_email = '$email', student_contact = '$contact_number' WHERE student_id = '$account_number'");
	}
	else
	{
		$update_employee = $con->query("UPDATE employee_tbl SET employee_birthday = '$birthday', employee_email = '$email', employee_contact = '$contact_number' WHERE employee_id = '$account_number'");
	}

?>