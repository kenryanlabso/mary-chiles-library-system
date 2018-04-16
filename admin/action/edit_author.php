<?php
	include("../db_con.php");

	$author_id = $con->escape_string($_POST['author_id']);
	$last_name = $con->escape_string($_POST['lastname']);
	$first_name = $con->escape_string($_POST['firstname']);
	$middle_initital = $con->escape_string($_POST['mi']);

	$query_update = "UPDATE author_tbl SET author_fname = '$first_name', author_mi = '$middle_initital', author_lname = '$last_name' WHERE author_id = '$author_id'";
	if($result_update = $con->query($query_update))
	{
		echo "<script>window.location='../maintenance_authors.php; </script>";
	}
?>