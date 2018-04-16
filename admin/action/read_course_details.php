<?php
	include("../session.php");
	include("../db_con.php");

	if(isset($_POST['course_id']))
	{
		$course_id = $_POST['course_id'];
		$response = array();

		$query_course = "SELECT * FROM course_tbl WHERE course_id = '$course_id'";
		if($result_course = $con->query($query_course))
		{
			$row_course = $result_course->fetch_assoc();
			$response = $row_course;

			echo json_encode($response);
		}
	}
?>