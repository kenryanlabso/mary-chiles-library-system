<?php
	include("../session.php");
	include("../db_con.php");

	$department_id = $_POST['department-id'];
	$department_name = $_POST['department-name'];
	$department_description = $_POST['department-description'];

	$query_update = "UPDATE department_tbl SET department_name = '$department_name', department_description = '$department_description' WHERE department_id = '$department_id'";
	$result_update = $con->query($query_update);
?>