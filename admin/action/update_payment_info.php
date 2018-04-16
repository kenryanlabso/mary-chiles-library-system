<?php
	include("../db_con.php");
	include("../session.php");

	$penalty_id = $_POST['penalty-id'];
	$receipt_number = $_POST['receipt-number'];
	$date_paid = $_POST['date-paid'];

	$query_update = "UPDATE penalty_tbl SET receipt_number = '$receipt_number', date_paid = '$date_paid' WHERE penalty_id = '$penalty_id'";
	$result_update = $con->query($query_update);

?>