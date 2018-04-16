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
				<th><center>Accession No.</center></th>
				<th><center>Book Title</center></th>
				<th><center>Date Borrowed</center></th>
				<th><center>Due Date</center></th>
				<th><center>Date Returned</center></th>
			</thead>
			<tbody>
			<?php	
			$query_student = "SELECT * FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id INNER JOIN transaction_tbl ON acquisition_tbl.accession_number = transaction_tbl.accession_number INNER JOIN student_tbl ON transaction_tbl.account_number = student_tbl.account_number";
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
				$due_date = date("m/d/Y", strtotime($date_due));
				$return_date = $row_student['return_date'];
				$date_returned = date("m/dY", strtotime($return_date));
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
					<td>
						<?php
							if($date_returned != "0000-00-00")
							{
								echo $date_returned;
							}
							else
							{
								echo "Pending";
							}
						?>
					</td>
				</tr>
				<?php
			}
			$query_employee = "SELECT * FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id INNER JOIN transaction_tbl ON acquisition_tbl.accession_number = transaction_tbl.accession_number INNER JOIN employee_tbl ON transaction_tbl.account_number = employee_tbl.account_number";
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
				$due_date = date("m/d/Y", strtotime($date_due));
				$return_date = $row_employee['return_date'];
				$date_returned = date("m/dY", strtotime($return_date));
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
					<td>
						<?php
							if($date_returned != "0000-00-00")
							{
								echo $date_returned;
							}
							else
							{
								echo "Pending";
							}
						?>
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
	</div>