<?php
	include("../session.php");
	include("../db_con.php");

	$course_name = $_POST['course-name'];
	$course_description = $_POST['course-description'];
	$date_added = date("Y-m-d");

	$query_add = "INSERT INTO course_tbl (course_name, course_description, course_added) VALUES ('$course_name', '$course_description', '$date_added')";
	$result_add = $con->query($query_add);

?>