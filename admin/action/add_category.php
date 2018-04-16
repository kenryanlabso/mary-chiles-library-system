<?php
	include("../db_con.php");
	include("../session.php");

	$classname = $con->escape_string($_POST['class-name']);
	$date_added = date("Y-m-d");

	$query_add = "INSERT INTO category_tbl (classname, category_added) VALUES ('$classname', '$date_added')";
	$result_add = $con->query($query_add);

?>