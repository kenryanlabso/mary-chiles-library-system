<?php
	include("../db_con.php");
	$publisher_id = $_POST['publisher_id'];
	$true = 1;
	$query_delete = "UPDATE publisher_tbl SET publisher_delete = '$true' WHERE publisher_id = '$publisher_id'";
	if($result_delete = $con->query($query_delete))
	{
		echo "<script>window.location='../maintenance_publisher.php'; </script>";
	}
?>