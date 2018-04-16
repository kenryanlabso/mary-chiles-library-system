<?php
	include("../db_con.php");
	include("../session.php");

	$guest_id = $_POST['guest-id'];
	$check_out = date("H:i:s");

	$query_logout = "UPDATE guest_tbl SET check_out = '$check_out' WHERE guest_id = '$guest_id'";
	$result_logout = $con->query($query_logout);

?>