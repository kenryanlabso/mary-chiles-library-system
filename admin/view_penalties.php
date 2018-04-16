<?php
	include("db_con.php");
	include("session.php");

	if(isset($_GET['page']))
	{
		$page =$_GET['page'];
		if($page == "unpaid")
		{
			$query_penalty_rate = "SELECT fine_student, fine_employee FROM settings_tbl WHERE settings_id = 1";
			$result_penalty_rate = $con->query($query_penalty_rate);
			$row_penalty_rate = $result_penalty_rate->fetch_assoc();
			$student_rate = $row_penalty_rate['fine_student'];
			$employee_rate = $row_penalty_rate['fine_employee'];

			?>
			<script type="text/javascript" src="../js/DT_bootstrap.js"></script>

			<div class="filter-navbar">
				<button class="btn btn-info active" onclick="filterUnpaidPenalty()" disabled>Unpaid Fines</button>
				<button class="btn btn-info" onclick="filterPaidPenalty()">Paid Fines</button>
			</div>

			<div class="table table-responsive">
				<table class="table table-striped table-hover" id="example">
					<thead>
						<th><center>Account Number</center></th>
						<th><center>Name</center></th>
						<th><center>Type</center></th>
						<th><center>Book Title</center></th>
						<th><center>Due Date</center></th>
						<th><center>Days</center></th>
						<th><center>Payable</center></th>
						<th><center>Rate/Day</center></th>
						<th><center>Status</center></th>
						<th><center>Action</center></th>
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
							<td><?php echo $amount_payable; ?></td>
							<td><?php echo $student_rate." pesos"; ?></td>
							<td><?php echo $payment_status; ?></td>
							<td>
								<center>
									<?php
									if($transaction_status == "Returned")
									{
										?>
										<button class="btn btn-primary btn-sm" onclick="clearPenaltyModal(<?php echo $penalty_id; ?>)" title="Mark as paid">
											<span class="fa fa-check"></span>
										</button>
										<?php
									}
									else
									{
										?>
										<button class="btn btn-primary btn-sm" onclick="clearPenaltyModal(<?php echo $penalty_id; ?>)" title="Return the book first" disabled>
											<span class="fa fa-check"></span>
										</button>
										<?php
									}
								
								?>
								</center>
							</td>
						</tr>
					<?php
						}
						$query_view_employee = "SELECT * FROM penalty_tbl INNER JOIN transaction_tbl ON penalty_tbl.transaction_id = transaction_tbl.transaction_id INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN employee_tbl ON transaction_tbl.account_number = employee_tbl.account_number WHERE penalty_tbl.payment_status = 'Pending'";
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
							<td><?php echo $amount_payable; ?></td>
							<td><?php echo $employee_rate." pesos"; ?></td>
							<td><?php echo $payment_status; ?></td>
							<td>
								<center>
								<?php
									if($transaction_status == "Returned")
									{
										?>
										<button class="btn btn-primary btn-sm" onclick="clearPenaltyModal(<?php echo $penalty_id; ?>)" title="Mark as paid">
											<span class="fa fa-check"></span>
										</button>
										<?php
									}
									else
									{
										?>
										<button class="btn btn-primary btn-sm" onclick="clearPenaltyModal(<?php echo $penalty_id; ?>)" title="Return the book first" disabled>
											<span class="fa fa-check"></span>
										</button>
										<?php
									}
								
								?>
								</center>
							</td>
						</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			</div>
			<?php

		}
		else if($page == "paid")
		{
			?>
			<script type="text/javascript" src="../js/DT_bootstrap.js"></script>

			<div class="filter-navbar">
				<button class="btn btn-info" onclick="filterUnpaidPenalty()">Unpaid Fines</button>
				<button class="btn btn-info active" onclick="filterPaidPenalty()" disabled>Paid Fines</button>
			</div>

			<div class="table table-responsive">
				<table class="table table-striped table-hover" id="example">
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
						<th><center>Action</center></th>
					</thead>
					<tbody>
					<?php
						$query_view_student = "SELECT * FROM penalty_tbl INNER JOIN transaction_tbl ON penalty_tbl.transaction_id = transaction_tbl.transaction_id INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN student_tbl ON transaction_tbl.account_number = student_tbl.account_number WHERE penalty_tbl.payment_status = 'Paid'";
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
							$paid_date = date($row_view_student['date_paid']);
							$date_paid = date("m/d/Y", strtotime($paid_date));
							$penalty_amount = $row_view_student['amount_receivable'];
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
							<td><?php echo $penalty_amount." pesos"; ?></td>
							<td><?php echo $days_count; ?></td>
							<td><?php echo $receipt_number; ?></td>
							<td><?php echo $due_date; ?></td>
							<td><?php echo $payment_status; ?></td>
							<td>
								<center>
									<button class="btn btn-warning btn-sm" onclick="editPaymentModal(<?php echo $penalty_id; ?>)" title="Mark as paid">
										<span class="fa fa-pencil"></span>
									</button>
								</center>
							</td>
						</tr>
					<?php
						}
						$query_view_employee = "SELECT * FROM penalty_tbl INNER JOIN transaction_tbl ON penalty_tbl.transaction_id = transaction_tbl.transaction_id INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN employee_tbl ON transaction_tbl.account_number = employee_tbl.account_number WHERE penalty_tbl.payment_status = 'Paid'";
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
							$paid_date = date($row_view_employee['date_paid']);
							$date_paid = date("m/d/Y", strtotime($paid_date));
							$penalty_amount = $row_view_employee['amount_receivable'];
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
							<td><?php echo $penalty_amount." pesos"; ?></td>
							<td><?php echo $days_count; ?></td>
							<td><?php echo $receipt_number; ?></td>
							<td><?php echo $date_paid; ?></td>
							<td><?php echo $payment_status; ?></td>
							<td>
								<center>
									<button class="btn btn-warning btn-sm" onclick="editPaymentModal(<?php echo $penalty_id; ?>)" title="Mark as paid">
										<span class="fa fa-pencil"></span>
									</button>
								</center>
							</td>
						</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			</div>
			<?php
		}
		else
		{
			echo "Invalid URL";
		}
	}
	
?>

	