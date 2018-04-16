<?php
	include("../session.php");
	include("../db_con.php");

	$account_number = $_SESSION['id'];
	$book_id = $_POST['book-id'];

	$query_remove = "UPDATE reservation_tbl SET reserve_status = 'Cancelled' WHERE account_number = '$account_number' AND book_id = '$book_id'";
	$result_remove = $con->query($query_remove);
?>