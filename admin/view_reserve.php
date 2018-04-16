<?php
	include("db_con.php");
?>
	<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
	<div class="table table-responsive">
		<table class="table table-striped table-hover" id="example">
			<thead>
				<th><center>User ID</center></th>
				<th><center>User Name</center></th>
				<th><center>User Type</center></th>
				<th><center>Call Number</center></th>
				<th><center>Book Title</center></th>
				<th><center>Date Reserved</center></th>
				<th><center>Expiration Date</center></th>
				<th><center>Status</center></th>
				<th><center>Remove</center></th>
			</thead>
			<tbody>
			<?php	
			$query_student = "SELECT * FROM book_tbl INNER JOIN reservation_tbl ON book_tbl.book_id = reservation_tbl.book_id INNER JOIN student_tbl ON reservation_tbl.account_number = student_tbl.account_number WHERE reservation_tbl.reserve_status = 'Pending' ORDER BY reservation_tbl.reserve_date DESC";
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
					<td>
						<center>
							<?php 
								if($reserve_status == 'Pending')
								{
									?>
									<button class="btn btn-danger btn-xs" onclick="removeReserveModal(<?php echo $reservation_id; ?>)" title="Remove reservation">
										<span class="fa fa-remove"></span>
									</button>
									<?php
								}
								else
								{
									?>
									<button class="btn btn-danger btn-xs" onclick="removeReserveModal(<?php echo $reservation_id; ?>)" title="Expired already" disabled>
										<span class="fa fa-remove"></span>
									</button>
									<?php
								}
							?>
						</center>
					</td>
				</tr>
				<?php
			}
			$query_employee = "SELECT * FROM book_tbl INNER JOIN reservation_tbl ON book_tbl.book_id = reservation_tbl.book_id INNER JOIN employee_tbl ON reservation_tbl.account_number = employee_tbl.account_number WHERE reservation_tbl.reserve_status = 'Pending' ORDER BY reservation_tbl.reserve_date DESC";
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
					<td>
						<center>
							<button class="btn btn-danger btn-xs" onclick="removeReserveModal(<?php echo $reservation_id; ?>)" title="Remove reservation">
								<span class="fa fa-remove"></span>
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