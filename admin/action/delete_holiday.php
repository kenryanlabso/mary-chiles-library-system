<?php
	include("../session.php");
	include("../db_con.php");

	$holiday_id = $_POST['holiday-id'];

	$query_delete = "UPDATE holiday_tbl SET holiday_delete = 1 WHERE holiday_id = '$holiday_id'";
	$result_delete = $con->query($query_delete);

?>