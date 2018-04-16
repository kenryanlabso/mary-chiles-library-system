<?php
	include("../db_con.php");
	include("../session.php");

	$accession_number = $_POST['accession-id'];

	$query_restore = "DELETE FROM archive_tbl WHERE accession_number = '$accession_number'";
	if($result_restore = $con->query($query_restore))
	{
		$query_status = "UPDATE acquisition_tbl SET book_status = 'Available' WHERE accession_number = '$accession_number'";
		$result_status = $con->query($query_status);
	}
?>