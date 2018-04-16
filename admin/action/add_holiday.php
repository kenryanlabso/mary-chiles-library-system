<?php
	include("../session.php");
	include("../db_con.php");

	$holiday_type = $_POST['holiday-type'];
	$holiday_date = $_POST['holiday-date'];
	$holiday_name = $_POST['holiday-name'];
	$holiday_description = $_POST['holiday-description'];
	$date_added = date("Y-m-d");

	$query_add = "INSERT INTO holiday_tbl (holiday_date, holiday_name, holiday_description, holiday_type, holiday_added) VALUES ('$holiday_date', '$holiday_name', '$holiday_description', '$holiday_type', '$date_added')";
	$result_add = $con->query($query_add);


?>