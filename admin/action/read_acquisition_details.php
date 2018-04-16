<?php
	include("../db_con.php");

	if(isset($_POST['accession_id']))
	{
		$accession_id = $_POST['accession_id'];
		
		$query_select = "SELECT * FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id WHERE acquisition_tbl.accession_number = '$accession_id'";
		$result = $con->query($query_select);
		$response = array();

		while($row = $result->fetch_assoc())
		{
			$response = $row;
		}
		echo json_encode($response);
	}
?>