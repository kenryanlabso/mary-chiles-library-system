<?php
	include("../db_con.php");
	include("../session.php");

	if(isset($_GET['stage']))
	{
		$stage = $_GET['stage'];

		if($stage == "delete-old")
		{
			$book_id = $_POST['book-id'];

			$query_delete = "DELETE FROM book_author_tbl WHERE book_id = '$book_id'";
			$result_delete = $con->query($query_delete);
		}
		else
		{
			if(isset($_POST['author-id']) && isset($_POST['book-id']))
			{
				$book_id = $_POST['book-id'];
				$author_id = $_POST['author-id'];

				$query_save = "INSERT INTO book_author_tbl (book_id, author_id) VALUES ('$book_id', '$author_id')";
				if($result_save = $con->query($query_save))
				{
					$response = "Saved successfully.";
					echo json_encode($response);
				}
			}
		}
	}

?>