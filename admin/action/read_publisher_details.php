<?php
	include("../db_con.php");

	if(isset($_POST['publisher_id']))
	{
		$publisher_id = $_POST['publisher_id'];
		$query_select = "SELECT * FROM publisher_tbl WHERE publisher_id = '$publisher_id'";
		$result = $con->query($query_select);
		$response = array();

		while($row = $result->fetch_assoc())
		{
			$response = $row;
		}
		echo json_encode($response);
	}
?>