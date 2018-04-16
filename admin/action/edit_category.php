<?php
	include("../db_con.php");
	include("../session.php");

	$category_id = $_POST['category-id'];
	$classname = $_POST['classname'];

	$query_update = "UPDATE category_tbl SET classname = '$classname' WHERE category_id = '$category_id'";
	$result_update = $con->query($query_update);
?>