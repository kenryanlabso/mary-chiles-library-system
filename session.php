<?php
	session_start();
	
	if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) 
	{
		echo "<script>window.location='login.php?failed'</script>";
		exit();
	}
		$session_id=$_SESSION['id'];
?>