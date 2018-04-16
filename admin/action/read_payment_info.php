<?php
	include("../db_con.php");
	include("../session.php");

	$penalty_id = $_POST['penalty_id'];

	$response = array();
	$query_select = "SELECT * FROM penalty_tbl WHERE penalty_id = '$penalty_id'";
	$result_select = $con->query($query_select);
	$row_select = $result_select->fetch_assoc();
	$response = $row_select;

	echo json_encode($response);
?>