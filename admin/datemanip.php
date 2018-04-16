<?php
	include("db_con.php");

	$date_today = new DateTime();
	$xxx = date("2017-08-16");
	$start = new DateTime();
	$end = new DateTime($xxx);
	$period = new DatePeriod($start, new DateInterval('P1D'), $end);
	$interval = $end->diff($start);
	$days = $interval->days;
	++$days;
	$holidays = array();
	$query_dates = "SELECT * FROM holiday_tbl WHERE holiday_delete = 0";
	$result_dates = $con->query($query_dates);
	while($row_dates = $result_dates->fetch_assoc())
	{
		array_push($holidays, $row_dates['holiday_date']);
	}

	foreach($period as $date_time)
	{
		$day_of_week = $date_time->format('D');
		if ($day_of_week == 'Sun') 
		{
			$days--;
		}
		else if(in_array($date_time->format("Y-m-d"), $holidays)) 
		{
			$days--;
		}
	}

	echo $days;
?>