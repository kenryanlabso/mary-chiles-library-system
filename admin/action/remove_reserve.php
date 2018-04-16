<?php
	include("../session.php");
	include("../db_con.php");

	$reservation_id = $_POST['reservation-id'];

	$query_remove = "UPDATE reservation_tbl SET reserve_status = 'Cancelled' WHERE reservation_id = '$reservation_id' AND reserve_status = 'Pending'";
	$result_remove = $con->query($query_remove);
	
?>