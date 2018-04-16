<?php
	include("../db_con.php");
	include("../session.php");

	$department_id = $_POST['department-id'];

	$query_delete = "UPDATE department_tbl SET department_delete = 1 WHERE department_id = '$department_id'";
	$result_delete = $con->query($query_delete);
?>