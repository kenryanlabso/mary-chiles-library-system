<?php
	require("../db_con.php");
	require("../session.php");

	$book_id = $_POST['add-call-number'];
	$copies = $_POST['add-copies'];
	$source = $_POST['add-source'];


	for($i=1;$i<=$copies;$i++)
	{
		$query_max_accession = "SELECT MAX(accession_number) FROM acquisition_tbl";
		$result_max_accession = $con->query($query_max_accession);
		$row_max_accession = $result_max_accession->fetch_assoc();
		$max_accession_number = $row_max_accession['MAX(accession_number)'];
		$accession_number = $max_accession_number + 1;
		$accession_length = strlen($accession_number);

		//Conditions for generating barcode
		if($accession_length == 1)
		{
			$barcode_id = "01".rand(11, 99).rand(10000, 99999).$accession_number.substr($copyright_year, 2, 2).rand(10, 99);
		}
		else if($accession_length == 2)
		{
			$barcode_id = "02".rand(11, 99).rand(1000, 9999).$accession_number.substr($copyright_year, 2, 2).rand(10, 99);
		}
		else if($accession_length == 3)
		{
			$barcode_id = "03".rand(11, 99).rand(100, 999).$accession_number.substr($copyright_year, 2, 2).rand(10, 99);
		}
		else if($accession_length == 4)
		{
			$barcode_id = "04".rand(11, 99).rand(10, 99).$accession_number.substr($copyright_year, 2, 2).rand(10, 99);	
		}
		else if($accession_length == 5)
		{
			$barcode_id = "05".rand(11, 99).rand(1, 9).$accession_number.substr($copyright_year, 2, 2).rand(10, 99);
		}
		else if($accession_length == 6)
		{
			$barcode_id = "06".rand(11, 99).$accession_number.substr($copyright_year, 2, 2).rand(10, 99);
		}

		$query_add_copy = "INSERT INTO acquisition_tbl (accession_number, barcode_id, book_status, fund_source, date_acquired, book_id) VALUES ('$accession_number', '$barcode_id', 'Available', '$add_source', '$date_acquired', '$book_id')";
		$result_add_copy = $con->query($query_add_copy);

	}

?>