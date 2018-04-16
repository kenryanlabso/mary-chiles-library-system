<?php
	include("../db_con.php");

	$book_id = $_POST['book_id'];
	$resonse = array();
	
	$query_select = "SELECT * FROM book_tbl WHERE book_id = '$book_id'";
	$result_select = $con->query($query_select);
	$row_select = $result_select->fetch_assoc();
	$response = $row_select;

	echo json_encode($response);
?>