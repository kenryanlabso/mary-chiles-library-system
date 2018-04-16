<?php
	include("db_con.php");

	$query_settings = "SELECT * FROM settings_tbl WHERE settings_id = 1";
	$result_settings = $con->query($query_settings);
	$row_settings = $result_settings->fetch_assoc();	
	$reserve_days_student = $row_settings['reserve_days_student'];
	$reserve_days_employee = $row_settings['reserve_days_employee'];
?>
<div class="settings-form">
	<div class="settings-header">
		<span class="fa fa-calendar"></span>
		&nbsp;Allowed Days - Reserve
	</div>
	<div class="settings-fields">
		<table width="100%">
			<tr>
				<td>
					<label for="borrow-student">Student:</label>
					<input type="text" id="reserve-student" name="reserve-student" class="form-control" value="<?php echo $reserve_days_student; ?>" ondblclick="enableReserveDaysStudent()"maxlength="6" readonly/>
				</td>
				<td width="40">
					<button id="edit-reserve-student" name="edit-reserve-student" class="btn btn-warning" onclick="enableReserveDaysStudent()" title="Edit">
						<span class="fa fa-pencil"></span>
					</button>
				</td>
			</tr>
			<tr>
				<td>
					<label for="reserve-employee">Employee:</label>
					<input type="text" id="reserve-employee" name="reserve-employee" class="form-control" value="<?php echo $reserve_days_employee; ?>" ondblclick="enableReserveDaysEmployee()" maxlength="6" readonly/>
				</td>
				<td width="40">
					<button id="edit-reserve-employee" name="edit-reserve-employee" class="btn btn-warning" onclick="enableReserveDaysEmployee()" title="Edit">
						<span class="fa fa-pencil"></span>
					</button>
				</td>
			</tr>
		</table>
	</div>
	<div class="settings-footer">
		<button id="update-reserve-days" class="btn btn-primary" onclick="updateReserveDays()" title="Update Settings" disabled>
			<tagname id="reserve-submit-text">Save</tagname>
			<div id="reserve-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>
		</button>
	</div>
</div>