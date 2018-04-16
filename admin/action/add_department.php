<?php
	include("../session.php");
	include("../db_con.php");

	$department_name = $_POST['department-name'];
	$department_description = $_POST['department-description'];
	$date_added = date("Y-m-d");

	$query_add = "INSERT INTO department_tbl (department_name, department_description, department_added) VALUES ('$department_name', '$department_description', '$date_added')";
	$result_add = $con->query($query_add);

?>