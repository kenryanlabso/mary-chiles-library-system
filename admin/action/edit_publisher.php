<?php
	include("../db_con.php");

	$publisher_id = $con->escape_string($_POST['publisher_id']);
	$publisher_name = $con->escape_string($_POST['publisher_name']);
	$publisher_address = $con->escape_string($_POST['publisher_address']);
	$publisher_contact = $con->escape_string($_POST['publisher_contact']);
	$publisher_email = $con->escape_string($_POST['publisher_email']);

	$query_update = "UPDATE publisher_tbl SET publisher_name = '$publisher_name', publisher_address = '$publisher_address', publisher_contact = '$publisher_contact', publisher_email = '$publisher_email' WHERE publisher_id = '$publisher_id'";
	if($result_update = $con->query($query_update))
	{
		echo "<script>window.location='../maintenance_publisher.php'; </script>";
	}
?>