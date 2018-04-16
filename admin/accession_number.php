<?php
	include("db_con.php");

	$query_accession = "SELECT MAX(accession_number) FROM acquisition_tbl";
	$result_query = $con->query($query_accession);
	$row_accession = $result_query->fetch_assoc();
	$accession_number = $row_accession['MAX(accession_number)']+1;
	$accession_length = strlen($accession_number);

	if($accession_length == 1)
	{
		$accession_number = "00000".$accession_number;
	}
	else if($accession_length == 2)
	{
		$accession_number = "0000".$accession_number;	
	}
	else if($accession_length == 3)
	{
		$accession_number = "000".$accession_number;	
	}
	else if($accession_length == 4)
	{
		$accession_number = "00".$accession_number;	
	}
	else if($accession_length == 5)
	{
		$accession_number = "0".$accession_number;	
	}
	else
	{
		$accession_number = $accession_number;
	}
?>
<input type="text" id="accession-number" name="accession-number"class="form-control" value="<?php echo $accession_number; ?>" disabled/>
