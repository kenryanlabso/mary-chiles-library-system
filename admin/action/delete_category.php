<?php
	include("../db_con.php");
	include("../session.php");

	$category_id = $_POST['category-id'];

	$query_delete = "UPDATE category_tbl SET category_delete = 1 WHERE category_id = '$category_id'";
	$result_delete = $con->query($query_delete);

?>