<?php
	include("../db_con.php");

	$date_registered = date("Y-m-d");
	$publisher_name = $con->escape_string($_POST['publisher-name']);
	$publisher_address = $con->escape_string($_POST['publisher-address']);
	$publisher_contact = $con->escape_string($_POST['publisher-contact']);
	$publisher_email = $con->escape_string($_POST['publisher-email']);

	$query_add = "INSERT INTO publisher_tbl(publisher_name, publisher_address, publisher_contact, publisher_email, publisher_registered) VALUES ('$publisher_name', '$publisher_address', '$publisher_contact', '$publisher_email', '$date_registered')";
	if($result_add = $con->query($query_add))
	{
		echo "<script>window.location='../maintenance_publisher.php';</script>";
	}
?>