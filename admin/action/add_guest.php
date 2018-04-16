<?php
	include("../db_con.php");
	include("../session.php");

	$admin_id = $_SESSION['id'];
	$guest_name = $con->escape_string($_POST['guest-name']);
	$receipt_number = $con->escape_string($_POST['receipt-number']);
	$school_company = $con->escape_string($_POST['school-company']);
	$contact_number = $con->escape_string($_POST['contact-number']);
	$date_visited = date("Y-m-d");
	$check_in = date("H:i:s");

	$query_add = "INSERT INTO guest_tbl (guest_receipt, guest_name, guest_company, guest_contact, date_visited, check_in, account_number) VALUES ('$receipt_number', '$guest_name', '$school_company', '$contact_number', '$date_visited', '$check_in', '$admin_id')";
	$result_add = $con->query($query_add);
?>