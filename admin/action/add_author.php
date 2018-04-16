<?php
	include("../db_con.php");

	$date_registred = date("Y-m-d");
	$last_name = $con->escape_string($_POST['last-name']);
	$first_name = $con->escape_string($_POST['first-name']);
	$middle_initial = $con->escape_string($_POST['middle-initial']);

	$query_add_author = "INSERT INTO author_tbl (author_fname, author_mi, author_lname, author_registered) VALUES ('$first_name', '$middle_initial', '$last_name', '$date_registred')";
	if($result = $con->query($query_add_author))
	{
		echo "<script>window.location='../maintenance_authors.php';</script>";
	}
?>