<?php
	include("../db_con.php");
	
	$start_date = $_POST['start-date'];
	$end_date = $_POST['end-date'];
	$report_type = $_POST['report-type'];
?>
	<input type="hidden" id="start-report" value="<?php echo $start_date; ?>"/>
	<input type="hidden" id="end-report" value="<?php echo $end_date; ?>"/>
	<input type="hidden" id="type-report" value="<?php echo $report_type; ?>"/>
<?php

	if($report_type == "acquisition")
	{
		?>
		<button class="btn btn-info pull-right" onclick="printReport()">
			<span class="fa fa-print"></span>
			&nbsp;Print
		</button>
		<div class="report-label">Contents of Report</div>
		<div class="table table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<th><center>Call Number</center></th>
					<th><center>Book Title</center></th>
					<th><center>Authors</center></th>
					<th><center>Year</center></th>
					<th><center>Edition</center></th>
					<th><center>Volume</center></th>
					<th><center>Publisher</center></th>
					<th><center>ISBN</center></th>
					<th><center>Source</center></th>
					<th><center>Price</center></th>
					<th><center>Date Added</center></th>
					<th><center>Copies</center></th>
				</thead>
				<tbody>
				<?php
					$query_report = "SELECT acquisition_tbl.*, book_tbl.*, publisher_tbl.*, GROUP_CONCAT(DISTINCT(author_tbl.author_fname), ' ',(author_tbl.author_lname)) AS authors_name FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id INNER JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id INNER JOIN category_tbl ON book_tbl.category_id = category_tbl.category_id WHERE date_acquired BETWEEN '$start_date' AND '$end_date' GROUP BY book_tbl.book_id";
					$result_report = $con->query($query_report);
					while($row_report = $result_report->fetch_assoc())
					{
						$accession_number = $row_report['accession_number'];
						$book_id = $row_report['book_id'];
						$call_number = $row_report['call_number'];
						$book_title = $row_report['book_title'];
						$authors_name = $row_report['authors_name'];
						$copyright_year = $row_report['copyright_year'];
						$edition = $row_report['edition'];
						$volume = $row_report['volume'];
						$publisher_name = $row_report['publisher_name'];
						$isbn = $row_report['isbn'];
						$fund_source = $row_report['fund_source'];
						$book_price = $row_report['book_price'];
						$date_added = $row_report['date_acquired'];
						$date_acquired = date("m/d/Y", strtotime($date_added));

						$query_copies = "SELECT COUNT(*) FROM acquisition_tbl INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE book_tbl.book_id = '$book_id'";
						$result_copies = $con->query($query_copies);
						$row_copies = $result_copies->fetch_assoc();
						$copies = $row_copies['COUNT(*)'];
						?>
						<tr>
							<td><?php echo $call_number; ?></td>
							<td><?php echo $book_title; ?></td>
							<td><?php echo $authors_name; ?></td>
							<td><?php echo "c".$copyright_year; ?></td>
							<td><?php echo $edition; ?></td>
							<td><?php echo $volume; ?></td>
							<td><?php echo $publisher_name; ?></td>
							<td><?php echo $isbn; ?></td>
							<td><?php echo $fund_source; ?></td>
							<td><?php echo $book_price; ?></td>
							<td><?php echo $date_acquired; ?></td>
							<td><?php echo $copies; ?></td>
						</tr>
						<?php					
					}
				?>
				</tbody>
			</table>
		</div>
		<?php
	}
	else if($report_type == "archived")
	{
		?>
		<button class="btn btn-info pull-right" onclick="printReport()">
			<span class="fa fa-print"></span>
			&nbsp;Print
		</button>
		<div class="report-label">Contents of Report</div>
		<div class="table table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<th><center>Accession No.</center></th>
					<th><center>Call No.</center></th>
					<th><center>Book Title</center></th>
					<th><center>Year</center></th>
					<th><center>Edition</center></th>
					<th><center>Volume</center></th>
					<th><center>Date Archived</center></th>
					<th><center>In Charge</center></th>
				</thead>
				<tbody>
				<?php
					$query_report = "SELECT * FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id INNER JOIN archive_tbl ON acquisition_tbl.accession_number = archive_tbl.accession_number WHERE archive_tbl.archive_date BETWEEN '$start_date' AND '$end_date' GROUP BY archive_tbl.accession_number";
					$result_report = $con->query($query_report);
					while($row_report = $result_report->fetch_assoc())
					{
						$accession_number = $row_report['accession_number'];
						$call_number = $row_report['call_number'];
						$book_title = $row_report['book_title'];
						$copyright_year = $row_report['copyright_year'];
						$edition = $row_report['edition'];
						$volume = $row_report['volume'];
						$archive_date = $row_report['archive_date'];
						$date_archived = date("m/d/Y", strtotime($archive_date));
						$account_number = $row_report['account_number'];
						?>
						<tr>
							<td>
							<?php 
								$accession_length = strlen($accession_number);
								for($i=$accession_length;$i<6;$i++)
								{
									if($i != 0)
									{
										echo 0;
									}
								}
									echo $accession_number;
							?>
							</td>
							<td><?php echo $call_number; ?></td>
							<td><?php echo $book_title; ?></td>
							<td><?php echo "c".$copyright_year; ?></td>
							<td><?php echo $edition; ?></td>
							<td>
								<?php
									if($volume != 0)
									{
										echo $volume;
									}
								?>
							</td>
							<td><?php echo $date_archived; ?></td>
							<td><?php echo $account_number; ?></td>
						</tr>
						<?php					
					}
				?>
				</tbody>
			</table>
		</div>
		<?php
	}
	else if($report_type == "borrowed")
	{
		?>
		<button class="btn btn-info pull-right" onclick="printReport()">
			<span class="fa fa-print"></span>
			&nbsp;Print
		</button>
		<div class="report-label">Contents of Report</div>
		<div class="table table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<th><center>User ID</center></th>
					<th><center>User Name</center></th>
					<th><center>User Type</center></th>
					<th><center>Accession No.</center></th>
					<th><center>Book Title</center></th>
					<th><center>Date Borrowed</center></th>
					<th><center>Due Date</center></th>
				</thead>
				<tbody>
				<?php	

				$query_student = "SELECT * FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id INNER JOIN transaction_tbl ON acquisition_tbl.accession_number = transaction_tbl.accession_number INNER JOIN student_tbl ON transaction_tbl.account_number = student_tbl.account_number WHERE transaction_tbl.borrow_date BETWEEN '$start_date' AND '$end_date' AND transaction_tbl.transaction_status = 'Borrowed'";
				$result_student = $con->query($query_student);
				while($row_student = $result_student->fetch_assoc())
				{
					$transaction_id = $row_student['transaction_id'];
					$account_number = $row_student['account_number'];
					$account_name = $row_student['student_lname'].", ".$row_student['student_fname']." ".$row_student['student_mi'].".";
					$book_id = $row_student['book_id'];
					$accession_number = $row_student['accession_number'];
					$book_title = $row_student['book_title'];
					$date_borrow = $row_student['borrow_date'];
					$borrow_date = date("m/d/Y - h:i A", strtotime($date_borrow));
					$date_due = $row_student['due_date'];
					$due_date = date("m/d/Y - h:i A", strtotime($date_due));
					?>
					<tr>
						<td><?php echo $account_number?></td>
						<td><?php echo $account_name?></td>
						<td><?php echo "Student"; ?></td>
						<td>
							<?php 
								$accession_no = $accession_number; 
								$accession_length = strlen($accession_no);
								for($i=$accession_length;$i<6;$i++)
								{
									if($i != 0)
									{
										echo 0;
									}
								}
								echo $accession_no;
							?>
						</td>
						<td><?php echo $book_title; ?></td>
						<td><?php echo $borrow_date; ?></td>
						<td><?php echo $due_date; ?></td>
					</tr>
					<?php
				}
				$query_employee = "SELECT * FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id INNER JOIN transaction_tbl ON acquisition_tbl.accession_number = transaction_tbl.accession_number INNER JOIN employee_tbl ON transaction_tbl.account_number = employee_tbl.account_number WHERE transaction_tbl.borrow_date BETWEEN '$start_date' AND '$end_date' AND transaction_tbl.transaction_status = 'Borrowed'";
				$result_employee = $con->query($query_employee);
				while($row_employee = $result_employee->fetch_assoc())
				{
					$transaction_id = $row_employee['transaction_id'];
					$account_number = $row_employee['account_number'];
					$account_name = $row_employee['employee_lname'].", ".$row_employee['employee_fname']." ".$row_employee['employee_mi'].".";
					$book_id = $row_employee['book_id'];
					$accession_number = $row_employee['accession_number'];
					$book_title = $row_employee['book_title'];
					$date_borrow = $row_employee['borrow_date'];
					$borrow_date = date("m/d/Y - h:i A", strtotime($date_borrow));
					$date_due = $row_employee['due_date'];
					$due_date = date("m/d/Y - h:i A", strtotime($date_due));
					?>
					<tr>
						<td><?php echo $account_number?></td>
						<td><?php echo $account_name?></td>
						<td><?php echo "Employee"; ?></td>
						<td>
							<?php 
								$accession_no = $accession_number; 
								$accession_length = strlen($accession_no);
								for($i=$accession_length;$i<6;$i++)
								{
									if($i != 0)
									{
										echo 0;
									}
								}
								echo $accession_no;
							?>
						</td>
						<td><?php echo $book_title; ?></td>
						<td><?php echo $borrow_date; ?></td>
						<td><?php echo $due_date; ?></td>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table>
		</div>
		<?php
	}
	else if($report_type == "returned")
	{
		?>
		<button class="btn btn-info pull-right" onclick="printReport()">
			<span class="fa fa-print"></span>
			&nbsp;Print
		</button>
		<div class="report-label">Contents of Report</div>
		<div class="table table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<th><center>User ID</center></th>
					<th><center>User Name</center></th>
					<th><center>User Type</center></th>
					<th><center>Accession No.</center></th>
					<th><center>Book Title</center></th>
					<th><center>Date Borrowed</center></th>
					<th><center>Return Date</center></th>
				</thead>
				<tbody>
				<?php	
				$query_student = "SELECT * FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id INNER JOIN transaction_tbl ON acquisition_tbl.accession_number = transaction_tbl.accession_number INNER JOIN student_tbl ON transaction_tbl.account_number = student_tbl.account_number WHERE transaction_tbl.return_date BETWEEN '$start_date' AND '$end_date' AND transaction_tbl.transaction_status = 'Returned'";
				$result_student = $con->query($query_student);
				while($row_student = $result_student->fetch_assoc())
				{
					$transaction_id = $row_student['transaction_id'];
					$account_number = $row_student['account_number'];
					$account_name = $row_student['student_lname'].", ".$row_student['student_fname']." ".$row_student['student_mi'].".";
					$book_id = $row_student['book_id'];
					$accession_number = $row_student['accession_number'];
					$book_title = $row_student['book_title'];
					$date_borrow = $row_student['borrow_date'];
					$borrow_date = date("m/d/Y - h:i A", strtotime($date_borrow));
					$date_returned = $row_student['return_date'];
					$return_date = date("m/d/Y - h:i A", strtotime($date_returned));
					?>
					<tr>
						<td><?php echo $account_number?></td>
						<td><?php echo $account_name?></td>
						<td><?php echo "Student"; ?></td>
						<td>
							<?php 
								$accession_no = $accession_number; 
								$accession_length = strlen($accession_no);
								for($i=$accession_length;$i<6;$i++)
								{
									if($i != 0)
									{
										echo 0;
									}
								}
								echo $accession_no;
							?>
						</td>
						<td><?php echo $book_title; ?></td>
						<td><?php echo $borrow_date; ?></td>
						<td><?php echo $return_date; ?></td>
					</tr>
					<?php
				}
				$query_employee = "SELECT * FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id INNER JOIN transaction_tbl ON acquisition_tbl.accession_number = transaction_tbl.accession_number INNER JOIN employee_tbl ON transaction_tbl.account_number = employee_tbl.account_number WHERE transaction_tbl.return_date BETWEEN '$start_date' AND '$end_date' AND transaction_tbl.transaction_status = 'Returned'";
				$result_employee = $con->query($query_employee);
				while($row_employee = $result_employee->fetch_assoc())
				{
					$transaction_id = $row_employee['transaction_id'];
					$account_number = $row_employee['account_number'];
					$account_name = $row_employee['employee_lname'].", ".$row_employee['employee_fname']." ".$row_employee['employee_mi'].".";
					$book_id = $row_employee['book_id'];
					$accession_number = $row_employee['accession_number'];
					$book_title = $row_employee['book_title'];
					$date_borrow = $row_employee['borrow_date'];
					$borrow_date = date("m/d/Y - h:i A", strtotime($date_borrow));
					$date_returned = $row_employee['return_date'];
					$return_date = date("m/d/Y - h:i A", strtotime($date_returned));
					?>
					<tr>
						<td><?php echo $account_number?></td>
						<td><?php echo $account_name?></td>
						<td><?php echo "Employee"; ?></td>
						<td>
							<?php 
								$accession_no = $accession_number; 
								$accession_length = strlen($accession_no);
								for($i=$accession_length;$i<6;$i++)
								{
									if($i != 0)
									{
										echo 0;
									}
								}
								echo $accession_no;
							?>
						</td>
						<td><?php echo $book_title; ?></td>
						<td><?php echo $borrow_date; ?></td>
						<td><?php echo $return_date; ?></td>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table>
		</div>
		<?php
	}
	else if($report_type == "reservations")
	{
		?>
		<button class="btn btn-info pull-right" onclick="printReport()">
			<span class="fa fa-print"></span>
			&nbsp;Print
		</button>
		<div class="report-label">Contents of Report</div>
		<div class="table table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<th><center>User ID</center></th>
					<th><center>User Name</center></th>
					<th><center>User Type</center></th>
					<th><center>Call Number</center></th>
					<th><center>Book Title</center></th>
					<th><center>Date Reserved</center></th>
					<th><center>Expiration Date</center></th>
					<th><center>Status</center></th>
				</thead>
				<tbody>
				<?php	
				$query_student = "SELECT * FROM book_tbl INNER JOIN reservation_tbl ON book_tbl.book_id = reservation_tbl.book_id INNER JOIN student_tbl ON reservation_tbl.account_number = student_tbl.account_number WHERE reservation_tbl.reserve_date BETWEEN '$start_date' AND '$end_date' AND reserve_status = 'Reserved'";
				$result_student = $con->query($query_student);
				while($row_student = $result_student->fetch_assoc())
				{
					$reservation_id = $row_student['reservation_id'];
					$account_number = $row_student['account_number'];
					$account_name = $row_student['student_lname'].", ".$row_student['student_fname']." ".$row_student['student_mi'].".";
					$book_id = $row_student['book_id'];
					$call_number = $row_student['call_number'];
					$book_title = $row_student['book_title'];
					$date_reserve = $row_student['reserve_date'];
					$reserve_date = date("m/d/Y - h:i A", strtotime($date_reserve));
					$date_expire = $row_student['expiration_date'];
					$expiration_date = date("m/d/Y - h:i A", strtotime($date_expire));
					$reserve_status = $row_student['reserve_status'];
					?>
					<tr>
						<td><?php echo $account_number?></td>
						<td><?php echo $account_name?></td>
						<td><?php echo "Student"; ?></td>
						<td><?php echo $call_number; ?></td>
						<td><?php echo $book_title; ?></td>
						<td><?php echo $reserve_date; ?></td>
						<td><?php echo $expiration_date; ?></td>
						<td><?php echo $reserve_status; ?></td>
					</tr>
					<?php
				}
				$query_employee = "SELECT * FROM book_tbl INNER JOIN reservation_tbl ON book_tbl.book_id = reservation_tbl.book_id INNER JOIN employee_tbl ON reservation_tbl.account_number = employee_tbl.account_number WHERE reservation_tbl.reserve_status = 'Pending'";
				$result_employee = $con->query($query_employee);
				while($row_employee = $result_employee->fetch_assoc())
				{
					$reservation_id = $row_employee['reservation_id'];
					$account_number = $row_employee['account_number'];
					$account_name = $row_employee['employee_lname'].", ".$row_employee['employee_fname']." ".$row_employee['employee_mi'].".";
					$book_id = $row_employee['book_id'];
					$call_number = $row_employee['call_number'];
					$book_title = $row_employee['book_title'];
					$date_reserve = $row_employee['reserve_date'];
					$reserve_date = date("m/d/Y - h:i A", strtotime($date_reserve));
					$date_expire = $row_employee['expiration_date'];
					$expiration_date = date("m/d/Y - h:i A", strtotime($date_expire));
					$reserve_status = $row_employee['reserve_status'];
					?>
					<tr>
						<td><?php echo $account_number?></td>
						<td><?php echo $account_name?></td>
						<td><?php echo "Employee"; ?></td>
						<td><?php echo $call_number; ?></td>
						<td><?php echo $book_title; ?></td>
						<td><?php echo $reserve_date; ?></td>
						<td><?php echo $expiration_date; ?></td>
						<td><?php echo $reserve_status; ?></td>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table>
		</div>
		<?php
	}
	else if($report_type == "unpaid-penalties")
	{
		$query_penalty_rate = "SELECT fine_student, fine_employee FROM settings_tbl WHERE settings_id = 1";
		$result_penalty_rate = $con->query($query_penalty_rate);
		$row_penalty_rate = $result_penalty_rate->fetch_assoc();
		$student_rate = $row_penalty_rate['fine_student'];
		$employee_rate = $row_penalty_rate['fine_employee'];

		?>
		<button class="btn btn-info pull-right" onclick="printReport()">
			<span class="fa fa-print"></span>
			&nbsp;Print
		</button>
		<div class="report-label">Contents of Report</div>
		<div class="table table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<th><center>Account Number</center></th>
					<th><center>Name</center></th>
					<th><center>Type</center></th>
					<th><center>Book Title</center></th>
					<th><center>Due Date</center></th>
					<th><center>Days</center></th>
					<th><center>Payable</center></th>
					<th><center>Rate/Day</center></th>
					<th><center>Transaction</center></th>
					<th><center>Payment</center></th>
				</thead>
				<tbody>
				<?php
					$query_view_student = "SELECT * FROM penalty_tbl INNER JOIN transaction_tbl ON penalty_tbl.transaction_id = transaction_tbl.transaction_id INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN student_tbl ON transaction_tbl.account_number = student_tbl.account_number WHERE penalty_tbl.payment_status = 'Pending'";
					$result_view_student = $con->query($query_view_student);
					while($row_view_student = $result_view_student->fetch_array())
					{
						$penalty_id = $row_view_student['penalty_id'];
						$account_number = $row_view_student['student_id'];
						$account_name = $row_view_student['student_fname']." ".$row_view_student['student_mi'].". ".$row_view_student['student_lname'];
						$book_title = $row_view_student['book_title'];
						$date_due = date($row_view_student['due_date']);
						$due_date = date("m/d/Y", strtotime($date_due));
						$date_return = date($row_view_student['return_date']);
						$return_date = date("m/d/Y", strtotime($date_return));
						$amount_payable = $row_view_student['amount_receivable'];
						$payment_status = $row_view_student['payment_status'];
						$transaction_status = $row_view_student['transaction_status'];

						$current_date = date("Y-m-d");
						$holidays = array();
						$query_holidays = "SELECT * FROM holiday_tbl WHERE holiday_delete = 0";
						$result_holidays = $con->query($query_holidays);
						while($row_holidays = $result_holidays->fetch_assoc())
						{
							array_push($holidays, $row_holidays['holiday_date']);
						}
						if($transaction_status == "Returned")
						{
							$days_initial = (strtotime($return_date) - strtotime($due_date)) / 86400;
						}
						else
						{
							$days_initial = (strtotime($current_date) - strtotime($due_date)) / 86400;
						}

						$days_count = $days_initial;
						for($i=1;$i<=$days_initial;$i++)
						{
							$day_of_week = date("D", strtotime($due_date."+ ".$i." days"));
							$date_loop = date("Y-m-d", strtotime($due_date."+ ".$i." days"));
							if($day_of_week == "Sun")
							{
								$days_count--;
							}
							else if(in_array($date_loop, $holidays)) 
							{
								$days_count--;
							}
						}
					?>
					<tr>
						<td><?php echo $account_number; ?></td>
						<td><?php echo $account_name; ?></td>
						<td><?php echo "Student"; ?></td>
						<td><?php echo $book_title; ?></td>
						<td><?php echo $due_date; ?></td>
						<td><?php echo $days_count; ?></td>
						<td><?php echo $amount_payable." pesos"; ?></td>
						<td><?php echo $student_rate." pesos"; ?></td>
						<td><?php echo $transaction_status; ?></td>
						<td><?php echo $payment_status; ?></td>
					</tr>
						<?php
					}
					$query_view_employee = "SELECT * FROM penalty_tbl INNER JOIN transaction_tbl ON penalty_tbl.transaction_id = transaction_tbl.transaction_id INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN employee_tbl ON transaction_tbl.account_number = employee_tbl.account_number WHERE penalty_tbl.payment_status = 'Pending'	";
					$result_view_employee = $con->query($query_view_employee);
					while($row_view_employee = $result_view_employee->fetch_array())
					{
						$penalty_id = $row_view_employee['penalty_id'];
						$account_number = $row_view_employee['employee_id'];
						$account_name = $row_view_employee['employee_fname']." ".$row_view_employee['employee_mi'].". ".$row_view_employee['employee_lname'];
						$book_title = $row_view_employee['book_title'];
						$date_due = date($row_view_employee['due_date']);
						$due_date = date("m/d/Y", strtotime($date_due));
						$date_return = date($row_view_employee['return_date']);
						$return_date = date("m/d/Y", strtotime($date_return));
						$amount_payable = $row_view_employee['amount_receivable'];
						$payment_status = $row_view_employee['payment_status'];
						$transaction_status = $row_view_employee['transaction_status'];

						$current_date = date("Y-m-d");
						$holidays = array();
						$query_holidays = "SELECT * FROM holiday_tbl WHERE holiday_delete = 0";
						$result_holidays = $con->query($query_holidays);
						while($row_holidays = $result_holidays->fetch_assoc())
						{
							array_push($holidays, $row_holidays['holiday_date']);
						}
						if($transaction_status == "Returned")
						{
							$days_initial = (strtotime($return_date) - strtotime($due_date)) / 86400;
						}
						else
						{
							$days_initial = (strtotime($current_date) - strtotime($due_date)) / 86400;
						}

						$days_count = $days_initial;
						for($i=1;$i<=$days_initial;$i++)
						{
							$day_of_week = date("D", strtotime($due_date."+ ".$i." days"));
							$date_loop = date("Y-m-d", strtotime($due_date."+ ".$i." days"));
							if($day_of_week == "Sun")
							{
								$days_count--;
							}
							else if(in_array($date_loop, $holidays)) 
							{
								$days_count--;
							}
						}
					?>
					<tr>
						<td><?php echo $account_number; ?></td>
						<td><?php echo $account_name; ?></td>
						<td><?php echo "Employee"; ?></td>
						<td><?php echo $book_title; ?></td>
						<td><?php echo $due_date; ?></td>
						<td><?php echo $days_count; ?></td>
						<td><?php echo $amount_payable." pesos"; ?></td>
						<td><?php echo $student_rate." pesos"; ?></td>
						<td><?php echo $transaction_status; ?></td>
						<td><?php echo $payment_status; ?></td>
					</tr>
					<?php
					}
				?>
				</tbody>
			</table>
		</div>
		<?php
	}
	else if($report_type == "paid-penalties")
	{
		$query_penalty_rate = "SELECT fine_student, fine_employee FROM settings_tbl WHERE settings_id = 1";
		$result_penalty_rate = $con->query($query_penalty_rate);
		$row_penalty_rate = $result_penalty_rate->fetch_assoc();
		$student_rate = $row_penalty_rate['fine_student'];
		$employee_rate = $row_penalty_rate['fine_employee'];

		?>
		<button class="btn btn-info pull-right" onclick="printReport()">
			<span class="fa fa-print"></span>
			&nbsp;Print
		</button>
		<div class="report-label">Contents of Report</div>
		<div class="table table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<th><center>Account Number</center></th>
					<th><center>Name</center></th>
					<th><center>Type</center></th>
					<th><center>Book Title</center></th>
					<th><center>Amount</center></th>
					<th><center>Days</center></th>
					<th><center>Receipt No.</center></th>
					<th><center>Date Paid</center></th>
					<th><center>Status</center></th>
				</thead>
				<tbody>
				<?php
					$query_view_student = "SELECT * FROM penalty_tbl INNER JOIN transaction_tbl ON penalty_tbl.transaction_id = transaction_tbl.transaction_id INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN student_tbl ON transaction_tbl.account_number = student_tbl.account_number WHERE penalty_tbl.date_paid BETWEEN '$start_date' AND '$end_date' AND penalty_tbl.payment_status = 'Paid'";
					$result_view_student = $con->query($query_view_student);
					while($row_view_student = $result_view_student->fetch_array())
					{
						$penalty_id = $row_view_student['penalty_id'];
						$account_number = $row_view_student['student_id'];
						$account_name = $row_view_student['student_fname']." ".$row_view_student['student_mi'].". ".$row_view_student['student_lname'];
						$book_title = $row_view_student['book_title'];
						$date_due = date($row_view_student['due_date']);
						$due_date = date("m/d/Y", strtotime($date_due));
						$paid_date = date($row_view_student['date_paid']);
						$date_paid = date("m/d/Y", strtotime($paid_date));
						$amount = $row_view_student['amount_receivable'];
						$receipt_number = $row_view_student['receipt_number'];
						$payment_status = $row_view_student['payment_status'];

						$current_date = date("Y-m-d");
						$holidays = array();
						$query_holidays = "SELECT * FROM holiday_tbl WHERE holiday_delete = 0";
						$result_holidays = $con->query($query_holidays);
						while($row_holidays = $result_holidays->fetch_assoc())
						{
							array_push($holidays, $row_holidays['holiday_date']);
						}
								
						$days_initial = (strtotime($paid_date) - strtotime($due_date)) / 86400;
						$days_count = $days_initial;
								
						for($i=1;$i<=$days_initial;$i++)
						{
							$day_of_week = date("D", strtotime($due_date."+ ".$i." days"));
							$date_loop = date("Y-m-d", strtotime($due_date."+ ".$i." days"));
							if($day_of_week == "Sun")
							{
								$days_count--;
							}
							else if(in_array($date_loop, $holidays)) 
							{
								$days_count--;
							}
						}
					?>
					<tr>
						<td><?php echo $account_number; ?></td>
						<td><?php echo $account_name; ?></td>
						<td><?php echo "Student"; ?></td>
						<td><?php echo $book_title; ?></td>
						<td><?php echo $amount." pesos"; ?></td>
						<td><?php echo $days_count; ?></td>
						<td><?php echo $receipt_number; ?></td>
						<td><?php echo $date_paid; ?></td>
						<td><?php echo $payment_status; ?></td>
					</tr>
						<?php
					}
					$query_view_employee = "SELECT * FROM penalty_tbl INNER JOIN transaction_tbl ON penalty_tbl.transaction_id = transaction_tbl.transaction_id INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN employee_tbl ON transaction_tbl.account_number = employee_tbl.account_number WHERE penalty_tbl.date_paid BETWEEN '$start_date' AND '$end_date' AND penalty_tbl.payment_status = 'Paid'";
					$result_view_employee = $con->query($query_view_employee);
					while($row_view_employee = $result_view_employee->fetch_array())
					{
						$penalty_id = $row_view_employee['penalty_id'];
						$account_number = $row_view_employee['employee_id'];
						$account_name = $row_view_employee['employee_fname']." ".$row_view_employee['employee_mi'].". ".$row_view_employee['employee_lname'];
						$book_title = $row_view_employee['book_title'];
						$date_due = date($row_view_employee['due_date']);
						$due_date = date("m/d/Y", strtotime($date_due));
						$paid_date = date($row_view_employee['date_paid']);
						$date_paid = date("m/d/Y", strtotime($paid_date));
						$amount = $row_view_employee['amount_receivable'];
						$receipt_number = $row_view_employee['receipt_number'];
						$payment_status = $row_view_employee['payment_status'];

						$current_date = date("Y-m-d");
						$holidays = array();
						$query_holidays = "SELECT * FROM holiday_tbl WHERE holiday_delete = 0";
						$result_holidays = $con->query($query_holidays);
						while($row_holidays = $result_holidays->fetch_assoc())
						{
							array_push($holidays, $row_holidays['holiday_date']);
						}
							
						$days_initial = (strtotime($paid_date) - strtotime($due_date)) / 86400;
							
						$days_count = $days_initial;
						for($i=1;$i<=$days_initial;$i++)
						{
							$day_of_week = date("D", strtotime($due_date."+ ".$i." days"));
							$date_loop = date("Y-m-d", strtotime($due_date."+ ".$i." days"));
							if($day_of_week == "Sun")
							{
								$days_count--;
							}
							else if(in_array($date_loop, $holidays)) 
							{
								$days_count--;
							}
						}
					?>
					<tr>
						<td><?php echo $account_number; ?></td>
						<td><?php echo $account_name; ?></td>
						<td><?php echo "Employee"; ?></td>
						<td><?php echo $book_title; ?></td>
						<td><?php echo $amount." pesos"; ?></td>
						<td><?php echo $days_count; ?></td>
						<td><?php echo $receipt_number; ?></td>
						<td><?php echo $date_paid; ?></td>
						<td><?php echo $payment_status; ?></td>
					</tr>
					<?php
					}
				?>
				</tbody>
			</table>
		</div>
		<?php
	}
	else if($report_type == "guest-transactions")
	{
		?>
		<button class="btn btn-info pull-right" onclick="printReport()">
			<span class="fa fa-print"></span>
			&nbsp;Print
		</button>
		<div class="report-label">Contents of Report</div>
		<div class="table table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<th><center>Receipt No.</center></th>
					<th><center>Guest Name</center></th>
					<th><center>School/Company</center></th>
					<th><center>Contact Number</center></th>
					<th><center>Visit Date</center></th>
					<th width="90"><center>Time In</center></th>
					<th width="90"><center>Time Out</center></th>
					<th><center>Books Used</center></th>
				</thead>
				<tbody>
				<?php
					$query_view = "SELECT guest_tbl.*, GROUP_CONCAT(DISTINCT(book_tbl.book_title)) AS borrowed_books FROM guest_tbl LEFT JOIN guest_transaction_tbl ON guest_tbl.guest_id = guest_transaction_tbl.guest_id LEFT JOIN acquisition_tbl ON guest_transaction_tbl.accession_number = acquisition_tbl.accession_number LEFT JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE guest_tbl.date_visited BETWEEN '$start_date' AND '$end_date' GROUP BY guest_tbl.guest_id ORDER BY guest_tbl.date_visited ASC";
					$result_view = $con->query($query_view);
					while($row_view = $result_view->fetch_assoc())
					{
						$guest_id = $row_view['guest_id'];
						$receipt_number = $row_view['guest_receipt'];
						$guest_name = $row_view['guest_name'];
						$school_company = $row_view['guest_company'];
						$contact_number = $row_view['guest_contact'];
						$visited_date = date($row_view['date_visited']);
						$date_visited = date("m/d/Y", strtotime($visited_date));
						$date_today = date("Y-m-d");
						$check_in = $row_view['check_in'];
						$check_out = $row_view['check_out'];
						$time_check_in = date("h:i A", strtotime($check_in));
						$time_check_out = date("h:i A", strtotime($check_out));
						$borrowed_books = $row_view['borrowed_books'];

						?>
						<tr>
							<td><?php echo $receipt_number; ?></td>
							<td><?php echo $guest_name; ?></td>
							<td><?php echo $school_company; ?></td>
							<td><?php echo $contact_number; ?></td>
							<td><?php echo $date_visited; ?></td>
							<td>
								<?php
									if($check_in != "00:00:00")
									{
										echo $time_check_in;
									}
								?>
							</td>
							<td>
								<?php
									if($check_out != "00:00:00")
									{
										echo $time_check_out;
									}
								?>
							</td>
							<td><?php echo $borrowed_books; ?></td>
						</tr>
						<?php
					}
				?>
				</tbody>
			</table>
		</div>
		<?php
	}
	else if($report_type == "user-registration")
	{
		?>
		<button class="btn btn-info pull-right" onclick="printReport()">
			<span class="fa fa-print"></span>
			&nbsp;Print
		</button>
		<div class="report-label">Contents of Report</div>
		<div class="table table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<th><center>Account No.</center></th>
					<th><center>First Name</center></th>
					<th><center>MI</center></th>
					<th><center>Last Name</center></th>
					<th><center>Birthday</center></th>
					<th><center>E-mail Address</center></th>
					<th><center>Contact Number</center></th>
					<th><center>Course/Department</center></th>
					<th><center>Type</center></th>
					<th><center>Date Registered</center></th>
				</thead>
				<tbody>
				<?php
					$query_borrower = "SELECT * FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id WHERE account_tbl.account_registered BETWEEN '$start_date' AND '$end_date' AND account_tbl.account_type = 'Regular'";
					$result_borrower = $con->query($query_borrower);
					while($row_borrower = $result_borrower->fetch_assoc())
					{
						$account_number = $row_borrower['account_number'];
						$student_number = $row_borrower['student_id'];
						$student_fname = $row_borrower['student_fname'];
						$student_mi = $row_borrower['student_mi'].".";
						$student_lname = $row_borrower['student_lname'];
						$birthday_student = date($row_borrower['student_birthday']);
						$student_birthday = date("m/d/Y", strtotime($birthday_student));
						$student_email = $row_borrower['student_email'];
						$student_contact = $row_borrower['student_contact'];
						$student_image = $row_borrower['student_image'];
						$date_registered = $row_borrower['account_registered'];
						$student_registered = date("m/d/Y", strtotime($date_registered));
						$course_name = $row_borrower['course_name'];
						?>
						<tr>
							<td><?php echo $student_number; ?></td>
							<td><?php echo $student_fname; ?></td>
							<td><?php echo $student_mi; ?></td>
							<td><?php echo $student_lname; ?></td>
							<td><?php echo $student_birthday; ?></td>
							<td><?php echo $student_email; ?></td>
							<td><?php echo $student_contact; ?></td>
							<td><?php echo $course_name; ?></td>
							<td>Student</td>
							<td><?php echo $student_registered; ?></td>
						</tr>
						<?php
					}
					$query_employee = "SELECT * FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number INNER JOIN department_tbl ON employee_tbl.department_id = department_tbl.department_id WHERE account_tbl.account_registered BETWEEN '$start_date' AND '$end_date' AND account_tbl.account_type = 'Regular'";
					$result_employee = $con->query($query_employee);
					while($row_employee = $result_employee->fetch_assoc())
					{
						$employee_number = $row_employee['employee_id'];
						$employee_fname = $row_employee['employee_fname'];
						$employee_mi = $row_employee['employee_mi'].".";
						$employee_lname = $row_employee['employee_lname'];
						$birthday_employee = $row_employee['employee_birthday'];
						$employee_birthday = date("m/d/Y", strtotime($birthday_employee));
						$employee_email = $row_employee['employee_email'];
						$employee_contact = $row_employee['employee_contact'];
						$employee_image = $row_employee['employee_image'];
						$date_registered = $row_employee['account_registered'];
						$employee_registered = date("m/d/Y", strtotime($date_registered));
						$department_name = $row_employee['department_name'];
						?>
						<tr>
							<td><?php echo $employee_number; ?></td>
							<td><?php echo $employee_fname; ?></td>
							<td><?php echo $employee_mi; ?></td>
							<td><?php echo $employee_lname; ?></td>
							<td><?php echo $employee_birthday; ?></td>
							<td><?php echo $employee_email; ?></td>
							<td><?php echo $employee_contact; ?></td>
							<td><?php echo $department_name; ?></td>
							<td><?php echo "Faculty"; ?></td>
							<td><?php echo $employee_registered; ?></td>
						</tr>
						<?php
					}
				?>
				</tbody>
			</table>
		</div>
		<?php
	}
	else if($report_type == "user-log")
	{
		?>
		<button class="btn btn-info pull-right" onclick="printReport()">
			<span class="fa fa-print"></span>
			&nbsp;Print
		</button>
		<div class="report-label">Contents of Report</div>
		<div class="table table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<th><center>Account No.</center></th>
					<th><center>First Name</center></th>
					<th><center>MI</center></th>
					<th><center>Last Name</center></th>
					<th><center>User Type</center></th>
					<th><center>Date</center></th>
					<th><center>Time Login</center></th>
					<th><center>Time Logout</center></th>
					<th><center>IP Address</center></th>
				</thead>
				<tbody>
				<?php
					$query_students = "SELECT * FROM account_tbl INNER JOIN student_tbl ON account_tbl.account_number = student_tbl.account_number INNER JOIN userlog_tbl ON account_tbl.account_number = userlog_tbl.account_number WHERE userlog_tbl.date_login BETWEEN '$start_date' AND '$end_date' GROUP BY userlog_tbl.log_id ORDER BY userlog_tbl.date_login ASC";
					$result_students = $con->query($query_students);
					while($row_students = $result_students->fetch_array())
					{
						$account_number = $row_students['account_number'];
						$first_name = $row_students['student_fname'];
						$middle_initial = $row_students['student_mi'].".";
						$last_name = $row_students['student_lname'];
						$login_date = $row_students['date_login'];
						$date_login = date("m/d/Y", strtotime($login_date));
						$time_login = $row_students['login_time'];
						$login_time = date("h:i A", strtotime($time_login));
						$time_logout = $row_students['logout_time'];
						$logout_time = date("h:i A", strtotime($time_logout));
						$ip_address = $row_students['ip_address'];
						?>
						<tr align="center">
							<td><?php echo $account_number; ?></td>
							<td><?php echo $first_name; ?></td>
							<td><?php echo $middle_initial; ?></td>
							<td><?php echo $last_name; ?></td>
							<td><?php echo "Student"; ?></td>
							<td><?php echo $date_login; ?></td>
							<td><?php echo $login_time; ?></td>
							<td>
							<?php 
								if($time_logout != '00:00:00')
								{
									echo $logout_time;

								}
							?>
							</td>
							<td><?php echo $ip_address; ?></td>
						</tr>
					<?php
					}
					$query_employee = "SELECT * FROM account_tbl INNER JOIN employee_tbl ON account_tbl.account_number = employee_tbl.account_number INNER JOIN userlog_tbl ON account_tbl.account_number = userlog_tbl.account_number WHERE userlog_tbl.date_login BETWEEN '$start_date' AND '$end_date' GROUP BY userlog_tbl.log_id ORDER BY userlog_tbl.date_login ASC";
					$result_employee = $con->query($query_employee);
					while($row_employee = $result_employee->fetch_assoc())
					{
						$account_number = $row_employee['account_number'];
						$first_name = $row_employee['employee_fname'];
						$middle_initial = $row_employee['employee_mi'].".";
						$last_name = $row_employee['employee_lname'];
						$login_date = $row_employee['date_login'];
						$date_login = date("m/d/Y", strtotime($login_date));
						$time_login = $row_employee['login_time'];
						$login_time = date("h:i A", strtotime($time_login));
						$time_logout = $row_employee['logout_time'];
						$logout_time = date("h:i A", strtotime($time_logout));
						$ip_address = $row_employee['ip_address'];
						?>
						<tr align="center">
							<td><?php echo $account_number; ?></td>
							<td><?php echo $first_name; ?></td>
							<td><?php echo $middle_initial; ?></td>
							<td><?php echo $last_name; ?></td>
							<td><?php echo "Employee"; ?></td>
							<td><?php echo $date_login; ?></td>
							<td><?php echo $login_time; ?></td>
							<td>
							<?php 
								if($time_logout != '00:00:00')
								{
									echo $logout_time;

								}
							?>
							</td>
							<td><?php echo $ip_address; ?></td>
						</tr>
						<?php
					}
				?>
				</tbody>
			</table>
		</div>
		<?php
	}

?>
