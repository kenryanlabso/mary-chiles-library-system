<?php
	include("../session.php");
	include("../db_con.php");

	$department_id = $_POST['department_id'];
	$response = array();

	$query_view = "SELECT * FROM department_tbl WHERE department_id = '$department_id'";
	if($result_view = $con->query($query_view))
	{
		$row_view = $result_view->fetch_assoc();
		$response = $row_view;

		echo json_encode($response);
	}
?>