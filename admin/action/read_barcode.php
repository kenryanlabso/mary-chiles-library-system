<?php
	include("../db_con.php");

	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
		if($page == "book")
		{
			$accession_number = $_POST['accession_no'];
			$response = array();
			
			$query_barcode = "SELECT barcode_id FROM acquisition_tbl WHERE accession_number = '$accession_number'";
			$result_barcode = $con->query($query_barcode);
			$row_barcode = $result_barcode->fetch_assoc();
			$response = $row_barcode;
			echo json_encode($response);
		}
	}	
?>