<?php
	include("../db_con.php");

	if(isset($_POST['author_id']))
	{
		$author_id = $_POST['author_id'];
		$query_select = "SELECT * FROM author_tbl WHERE author_id = '$author_id'";
		$result = $con->query($query_select);
		$response = array();

		while($row = $result->fetch_assoc())
		{
			$response = $row;
		}
		echo json_encode($response);
	}
?>