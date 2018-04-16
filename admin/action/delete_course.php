<?php
	include("../session.php");
	include("../db_con.php");

	$course_id = $_POST['course-id'];
	$query_delete = "UPDATE course_tbl SET course_delete = 1 WHERE course_id = '$course_id'";
	$result_delete = $con->query($query_delete);
?>