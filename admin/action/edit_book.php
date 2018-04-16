<?php
	include("../db_con.php");
	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
		if($page == "call-number")
		{
			$book_id = $con->escape_string($_POST['book_id']);
			$call_number = $con->escape_string($_POST['call_number']);
			$book_title = $con->escape_string($_POST['book_title']);
			$copyright_year = $_POST['copyright_year'];
			$edition = $_POST['edition'];
			$volume = $_POST['volume'];
			$category_id = $_POST['category_id'];
			$publisher_id = $_POST['publisher_id'];
			$isbn = $_POST['isbn'];
			$pages = $_POST['pages'];
			$book_price = $_POST['book_price'];
			$fund_source = $_POST['fund_source'];

			$query_update = "UPDATE book_tbl SET call_number = '$call_number', book_title = '$book_title', copyright_year = '$copyright_year', edition = '$edition', volume = '$volume', category_id = '$category_id', publisher_id = '$publisher_id', isbn = '$isbn', pages = '$pages', book_price = '$book_price' WHERE book_id = '$book_id'";
			$result_update = $con->query($query_update);
		}
		else if($page == "accession-number")
		{
			$accession_number = $_POST['accession_id'];
			$fund_source = $_POST['fund_source'];

			$query_update = "UPDATE acquisition_tbl SET fund_source = '$fund_source' WHERE accession_number = '$accession_number'";
			$result_update = $con->query($query_update);
		}
		else
		{
			echo "Invalid page address!";
		}
	}
	
?>