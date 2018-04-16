<?php
	include("../session.php");
	include("../db_con.php");

	$holiday_id = $_POST['holiday_id'];
	$response = array();

	$query_select = "SELECT * FROM holiday_tbl WHERE holiday_id = '$holiday_id'";
	if($result_select = $con->query($query_select))
	{
		$row_select = $result_select->fetch_assoc();	
		$response = $row_select;

		echo json_encode($response);
	}
?>