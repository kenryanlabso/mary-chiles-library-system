<?php
	include("../db_con.php");

	if(isset($_POST['book_id']))
	{
		$book_id = $_POST['book_id'];
		$query_select = "SELECT acquisition_tbl.*, book_tbl.*, publisher_tbl.*, GROUP_CONCAT(DISTINCT(author_tbl.author_fname), ' ', (author_tbl.author_lname)) AS author_names FROM book_tbl LEFT JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id LEFT JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id LEFT JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id WHERE book_tbl.book_id = '$book_id'";
		$result = $con->query($query_select);
		$response = array();

		while($row = $result->fetch_assoc())
		{
			$response = $row;
		}
		echo json_encode($response);
	}
?>