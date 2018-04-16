<?php
	include("../db_con.php");

	$author_id = $_POST['author_id'];
	$true = 1;
	$query_delete = "UPDATE author_tbl SET author_delete = '$true' WHERE author_id = '$author_id'";
	if($result_delete = $con->query($query_delete))
	{
		echo "<script>window.location='../maintenance_authors.php;'</script>";
	}
?>