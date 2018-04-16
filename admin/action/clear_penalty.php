<?php
	include("../db_con.php");
	include("../session.php");

	$penalty_id = $_POST['penalty-id'];
	$receipt_number = $_POST['receipt-number'];
	$date_paid = $_POST['date-paid'];

	$query_clear_penalty = "UPDATE penalty_tbl SET receipt_number = '$receipt_number', date_paid = '$date_paid', payment_status = 'Paid' WHERE penalty_id = '$penalty_id'";
	$result_clear_penalty = $con->query($query_clear_penalty);
?>