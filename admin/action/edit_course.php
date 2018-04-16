<?php
	include("../session.php");
	include("../db_con.php");

	$course_id = $_POST['course-id'];
	$course_name = $_POST['course-name'];
	$course_description = $_POST['course-description'];

	$query_update = "UPDATE course_tbl SET course_name = '$course_name', course_description = '$course_description' WHERE course_id = '$course_id'";
	$result_update = $con->query($query_update);
?>