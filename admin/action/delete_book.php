<?php
	include("../db_con.php");
	include("../session.php");

	if(isset($_GET['quantity']))
	{
		$quantity = $_GET['quantity'];
		if($quantity == "single")
		{
			$accession_number = $_POST['accession-id'];
			$archive_reason = $con->escape_string($_POST['reason']);
			$archive_remarks = $con->escape_string($_POST['remarks']);
			$account_number = $_SESSION['id'];
			$archive_date = date("Y-m-d");

			$query_archive = "INSERT INTO archive_tbl (accession_number, archive_reason, archive_remarks, archive_date, account_number) VALUES ('$accession_number', '$archive_reason', ' $archive_remarks', '$archive_date', '$account_number')";
			if($result_archive = $con->query($query_archive))
			{
				$query_status = "UPDATE acquisition_tbl SET book_status = 'Archived' WHERE accession_number = '$accession_number'";
				$result_status = $con->query($query_status);
			}
		}
	}
?>