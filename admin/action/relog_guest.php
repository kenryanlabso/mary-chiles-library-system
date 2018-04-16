<?php
	include("../db_con.php");
	include("../session.php");

	$guest_id = $_POST['guest-id'];

	$query_relog = "UPDATE guest_tbl SET check_out = '00:00:00' WHERE guest_id = '$guest_id'";
	$result_relog = $con->query($query_relog);

?>