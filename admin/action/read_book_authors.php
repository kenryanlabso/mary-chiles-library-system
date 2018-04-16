<?php
	include("../db_con.php");
	include("../session.php");

	$book_id = $_POST['book_id'];

	if(isset($_GET['get']))
	{
		$get = $_GET['get'];
		if($get == "id")
		{
			$author_ids = "";
			$query_authors = "SELECT * FROM book_tbl INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id WHERE book_author_tbl.book_id = '$book_id' GROUP BY book_author_tbl.author_id";
			$result_authors = $con->query($query_authors);
			while($row_authors = $result_authors->fetch_assoc())
			{
				$author_ids = $author_ids.$row_authors['author_id'].",";
			}
			echo json_encode($author_ids);
		}
		else
		{
			$author_names = "";
			$query_authors = "SELECT * FROM book_tbl INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id WHERE book_author_tbl.book_id = '$book_id' GROUP BY book_author_tbl.author_id";
			$result_authors = $con->query($query_authors);
			while($row_authors = $result_authors->fetch_assoc())
			{
				$author_names = $author_names.$row_authors['author_fname']." ".$row_authors['author_lname'].",";
			}
			echo json_encode($author_names);	
		}
	}
	
?>