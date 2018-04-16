<?php
	include("../session.php");
	include("../db_con.php");

	$holiday_id = $_POST['holiday-id'];
	$holiday_type = $_POST['holiday-type'];
	$holiday_date = $_POST['holiday-date'];
	$holiday_name = $con->escape_string($_POST['holiday-name']);
	$holiday_description = $con->escape_string($_POST['holiday-description']);

	$query_update = "UPDATE holiday_tbl SET holiday_type = '$holiday_type', holiday_date = '$holiday_date', holiday_name = '$holiday_name', holiday_description = '$holiday_description' WHERE holiday_id = '$holiday_id'";
	$result_update = $con->query($query_update);
?>