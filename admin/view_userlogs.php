<?php
	include("db_con.php");
?>
	<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
	<div class="table table-responsive">
		<table class="table table-striped table-hover" id="example">
			<thead>
				<th><center>Account No.</center></th>
				<th><center>First Name</center></th>
				<th><center>MI</center></th>
				<th><center>Last Name</center></th>
				<th><center>Date</center></th>
				<th><center>Time Login</center></th>
				<th><center>Time Logout</center></th>
				<th><center>IP Address</center></th>
			</thead>
			<tbody>
			<?php
				$query_students = "SELECT * FROM account_tbl INNER JOIN student_tbl ON account_tbl.account_number = student_tbl.account_number INNER JOIN userlog_tbl ON account_tbl.account_number = userlog_tbl.account_number GROUP BY userlog_tbl.log_id";
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
				$query_employee = "SELECT * FROM account_tbl INNER JOIN employee_tbl ON account_tbl.account_number = employee_tbl.account_number INNER JOIN userlog_tbl ON account_tbl.account_number = userlog_tbl.account_number GROUP BY userlog_tbl.log_id";
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
