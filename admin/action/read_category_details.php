<?php
	include("../db_con.php");
	include("../session.php");

	$category_id = $_POST['category_id'];
	$response = array();

	$query_select = "SELECT * FROM category_tbl WHERE category_id = '$category_id'";
	if($result_select = $con->query($query_select))
	{
		$row_select = $result_select->fetch_assoc();
		$response = $row_select;

		echo json_encode($response);

	}
?>